<?php
session_start();

// The installer can run for a long time (esp. step that imports the 2.3GB
// vBulletin dump). Disable PHP execution / input timeouts and raise memory
// from inside the script so this works even if Apache hasn't been restarted
// to pick up php.ini changes.
@set_time_limit(0);
@ini_set('max_execution_time', '0');
@ini_set('max_input_time',     '-1');
@ini_set('memory_limit',       '2048M');
@ignore_user_abort(true);

if (file_exists(__DIR__.'/cms/config.php')) {
    echo 'CMS already installed.';
    exit;
}
$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;
$errors = [];

/**
 * Convert a loose, human-readable date (e.g. "Wed, 24 Aug 2005"
 * or "February 24, 2005, 12:33 pm") to 'Y-m-d H:i:s'.
 * If PHP can't parse it, return the original string unchanged.
 */
function normalizeDate(string $raw): string
{
    // strip outer quotes that str_getcsv removed earlier
    $clean = trim($raw, " \t\n\r\0\x0B'\"");
    $ts    = strtotime($clean);
    return $ts !== false ? date('Y-m-d H:i:s', $ts) : $raw;
}

/**
 * Split a multi_query batch buffer back into individual statements when the
 * whole-batch path fails. We built the buffer ourselves with `;\n` between
 * statements, so a literal split is safe here — no need for a full SQL parser.
 */
function self_split_sql_batch(string $buf): array
{
    $parts = explode(";\n", $buf);
    $out   = [];
    foreach ($parts as $p) {
        $t = trim($p);
        if ($t !== '' && $t !== ';') {
            $out[] = $t;
        }
    }
    return $out;
}

/**
 * Convert a single SQL VALUES-tuple line into one TSV row.
 *
 * Input  : "(1005, '[2004] Steam Discussions', '', 0, NULL, 1),"
 * Output : "1005\t[2004] Steam Discussions\t\t0\t\\N\t1\n"
 *
 * Critical correctness note: mysqldump's INSERT-string escape sequences
 * (\n, \r, \t, \0, \\, \', \") decode byte-for-byte the same way under
 * LOAD DATA's default escape rules. So we copy the bytes between the outer
 * `'` quotes verbatim — no decoding+re-encoding pass needed. This is what
 * makes the conversion fast enough for a 2GB+ dump.
 *
 * Returns "" on parse failure (caller skips the row).
 */
function vbimport_tuple_to_tsv(string $line): string
{
    $n = strlen($line);
    $i = 0;

    // Skip to opening `(`
    while ($i < $n && $line[$i] !== '(') $i++;
    if ($i >= $n) return '';
    $i++;

    $fields = [];
    while ($i < $n) {
        // Skip whitespace
        while ($i < $n) {
            $c = $line[$i];
            if ($c === ' ' || $c === "\t" || $c === "\n" || $c === "\r") $i++;
            else break;
        }
        if ($i >= $n) break;

        $c = $line[$i];

        if ($c === "'") {
            // Quoted string: walk to matching `'`, skipping `\X` pairs
            $i++;
            $start = $i;
            while ($i < $n) {
                $ch = $line[$i];
                if ($ch === '\\') {
                    $i += 2;        // skip escaped char (incl. its body byte)
                } elseif ($ch === "'") {
                    break;
                } else {
                    $i++;
                }
            }
            $fields[] = substr($line, $start, $i - $start);
            if ($i < $n) $i++;       // past closing '
        } elseif (($c === 'N' || $c === 'n')
                  && $i + 3 < $n
                  && strcasecmp(substr($line, $i, 4), 'NULL') === 0) {
            $fields[] = "\\N";
            $i += 4;
        } else {
            // Unquoted (number / boolean / unquoted ident) — copy until `,` or `)`
            $start = $i;
            while ($i < $n && $line[$i] !== ',' && $line[$i] !== ')') $i++;
            $fields[] = trim(substr($line, $start, $i - $start));
        }

        // Skip whitespace, then expect `,` (next field) or `)` (end of tuple)
        while ($i < $n) {
            $c = $line[$i];
            if ($c === ' ' || $c === "\t") $i++;
            else break;
        }
        if ($i >= $n) break;
        if ($line[$i] === ',') { $i++; continue; }
        if ($line[$i] === ')') break;
        // Anything else is a parse error — bail
        return '';
    }

    return implode("\t", $fields) . "\n";
}

/**
 * Split a tail-of-line tuple sequence like:
 *   "(1, 'a'), (2, 'b'), (3, 'c');"
 * into ["(1, 'a')", "(2, 'b')", "(3, 'c')"]
 *
 * Handles strings (so commas/parens inside `'...'` don't split the tuple).
 * Used only when an INSERT header has tuples appended on the same line —
 * mysqldump's default extended-INSERT format puts each tuple on its own line,
 * so this path is rare but cheap to support.
 */
function vbimport_split_inline_tuples(string $s): array
{
    $n = strlen($s);
    $i = 0;
    $out = [];
    while ($i < $n) {
        while ($i < $n && $s[$i] !== '(') $i++;
        if ($i >= $n) break;
        $start = $i;
        $i++;
        // Walk to matching `)`, respecting strings
        while ($i < $n) {
            $c = $s[$i];
            if ($c === "'") {
                $i++;
                while ($i < $n) {
                    $cc = $s[$i];
                    if ($cc === '\\')      { $i += 2; }
                    elseif ($cc === "'")   { $i++; break; }
                    else                   { $i++; }
                }
            } elseif ($c === ')') {
                $i++;
                break;
            } else {
                $i++;
            }
        }
        $out[] = substr($s, $start, $i - $start);
    }
    return $out;
}

/**
 * Preprocess SQL statement to convert human-readable dates to MySQL format.
 * Detects and converts date values like 'Friday, April 1 2005' or 'Jan 15, 2005' to '2005-04-01'.
 */
function normalizeSqlDates(string $sql): string
{
    // Pattern to match quoted date strings that look like human-readable dates
    // Examples: 'Friday, April 1 2005', 'Jan 15, 2005', 'Monday, January 15, 2004', etc.
    // This pattern looks for: 'Optional-Weekday, Month Day[,] Year'
    // The comma after the day is optional (,?)
    $pattern = "/'((?:[A-Z][a-z]+day,\s*)?[A-Z][a-z]+\s+\d{1,2},?\s+\d{4})'/";

    return preg_replace_callback($pattern, function($matches) {
        $dateStr = $matches[1];
        $timestamp = strtotime($dateStr);

        // If strtotime successfully parsed it, convert to Y-m-d format
        if ($timestamp !== false) {
            // For DATE columns, use Y-m-d format
            $mysqlDate = date('Y-m-d', $timestamp);
            return "'" . $mysqlDate . "'";
        }

        // If parsing failed, return the original match unchanged
        return $matches[0];
    }, $sql);
}

/**
 * Split SQL content into individual statements, handling multi-line strings and blocks
 */
function split_sql_statements($sql)
{
    $stmts = [];
    $buffer = '';
    $inBlock = false;
    $blockDepth = 0;
    $inString = false;
    $stringChar = '';
    $escaped = false;
    $delimiter = ';';

    foreach (preg_split("/\r?\n/", $sql) as $line) {
        $trim = trim($line);
        if ($inBlock) {
            if (strpos($trim, '*/') !== false) {
                $inBlock = false;
            }
            continue;
        }
        if (!$inString && ($trim === '' || str_starts_with($trim, '--') || $trim[0] === '#')) {
            continue;
        }
        if (!$inString && str_starts_with($trim, '/*')) {
            $inBlock = true;
            continue;
        }

        if (!$inString && preg_match('/^DELIMITER\s+(\S+)/i', $trim, $matches)) {
            $delimiter = $matches[1] !== '' ? $matches[1] : ';';
            // Reset buffer when switching delimiters to avoid partial statements carrying over
            $buffer = '';
            continue;
        }

        if (!$inString && preg_match('/\bBEGIN\b/i', $trim)) {
            $blockDepth++;
        }
        if (!$inString && $blockDepth > 0 && preg_match('/\bEND\b/i', $trim) && !preg_match('/\bEND\s+(IF|LOOP|CASE|REPEAT)\b/i', $trim)) {
            $blockDepth--;
        }

        $buffer .= $line."\n";

        // Track string state to avoid splitting on delimiters inside quoted strings
        for ($i = 0; $i < strlen($line); $i++) {
            $char = $line[$i];

            if ($escaped) {
                $escaped = false;
                continue;
            }

            if ($char === '\\') {
                $escaped = true;
                continue;
            }

            if (!$inString && ($char === "'" || $char === '"')) {
                $inString = true;
                $stringChar = $char;
            } elseif ($inString && $char === $stringChar) {
                $inString = false;
                $stringChar = '';
            }
        }

        $bufferTrimmed = rtrim($buffer);
        if ($bufferTrimmed === '') {
            continue;
        }

        if ($delimiter === ';') {
            if ($blockDepth === 0 && !$inString && str_ends_with(rtrim($trim), $delimiter)) {
                $stmts[] = trim(substr($bufferTrimmed, 0, -strlen($delimiter)));
                $buffer = '';
            }
        } else {
            if (!$inString && str_ends_with($bufferTrimmed, $delimiter)) {
                $stmts[] = trim(substr($bufferTrimmed, 0, -strlen($delimiter)));
                $buffer = '';
            }
        }
    }
    if (trim($buffer) !== '') {
        $stmts[] = trim($buffer);
    }
    return $stmts;
}

/**
 * Convert SQL string from any encoding to UTF-8
 * Handles ISO-8859-1 (Latin-1) and other common encodings
 */
function ensureUtf8Encoding(string $sql): string
{
    // Detect the encoding of the string
    $encoding = mb_detect_encoding($sql, ['UTF-8', 'ISO-8859-1', 'ASCII', 'Windows-1252'], true);

    // If not UTF-8, convert it
    if ($encoding && $encoding !== 'UTF-8') {
        $sql = mb_convert_encoding($sql, 'UTF-8', $encoding);
    }

    return $sql;
}

/**
 * Execute SQL file with date normalization
 */
function run_sql_file(PDO $pdo, string $file): void
{
    $sql = file_get_contents($file);

    // Convert from detected encoding to UTF-8
    $sql = ensureUtf8Encoding($sql);

    // Preprocess SQL to normalize date formats
    $sql = normalizeSqlDates($sql);

    foreach (split_sql_statements($sql) as $stmt) {
        $stmt = trim($stmt);
        if ($stmt === '') {
            continue;
        }
        $pdo->exec($stmt);
    }
}

/**
 * Convert phpBB schema.json type to MySQL column definition
 */
function phpbb_type_to_mysql($type, $default = null, $extra = null): string
{
    $unsigned = '';
    $mysql_type = '';

    // Handle type with size specifier (e.g., VCHAR:50, TINT:2)
    if (strpos($type, ':') !== false) {
        [$base_type, $size] = explode(':', $type, 2);
    } else {
        $base_type = $type;
        $size = null;
    }

    switch ($base_type) {
        case 'UINT':
            $mysql_type = 'INT(10) UNSIGNED';
            break;
        case 'ULINT':
            $mysql_type = 'BIGINT(20) UNSIGNED';
            break;
        case 'USINT':
            $mysql_type = 'SMALLINT(4) UNSIGNED';
            break;
        case 'BINT':
            $mysql_type = 'BIGINT(20)';
            break;
        case 'TINT':
            $mysql_type = 'TINYINT(' . ($size ?? 4) . ')';
            break;
        case 'INT':
            $mysql_type = 'INT(' . ($size ?? 11) . ')';
            break;
        case 'VCHAR':
        case 'VCHAR_UNI':
        case 'VCHAR_CI':
            $mysql_type = 'VARCHAR(' . ($size ?? 255) . ')';
            break;
        case 'CHAR':
            $mysql_type = 'CHAR(' . ($size ?? 1) . ')';
            break;
        case 'XSTEXT':
        case 'XSTEXT_UNI':
            $mysql_type = 'VARCHAR(' . ($size ?? 1000) . ')';
            break;
        case 'STEXT':
        case 'STEXT_UNI':
            $mysql_type = 'TEXT';
            break;
        case 'TEXT':
        case 'TEXT_UNI':
            $mysql_type = 'TEXT';
            break;
        case 'MTEXT':
        case 'MTEXT_UNI':
            $mysql_type = 'MEDIUMTEXT';
            break;
        case 'TIMESTAMP':
            $mysql_type = 'INT(11) UNSIGNED';
            break;
        case 'BOOL':
            $mysql_type = 'TINYINT(1) UNSIGNED';
            break;
        case 'PDEC':
            // Decimal with precision, size format is "precision,scale"
            $mysql_type = 'DECIMAL(' . ($size ?? '5,2') . ')';
            break;
        default:
            $mysql_type = 'TEXT';
    }

    // Build the column definition
    $def = $mysql_type;

    // MySQL 5.7+ strict mode and MySQL 8 reject DEFAULT clauses on TEXT/BLOB columns
    // (error 1101). phpBB's native installer omits DEFAULT for these types and uses
    // NOT NULL, requiring callers to supply an explicit value on INSERT. MariaDB
    // 10.2.1+ allows it, but skipping is safe on both engines.
    $is_text_blob = in_array($mysql_type, ['TEXT', 'MEDIUMTEXT', 'LONGTEXT', 'BLOB', 'MEDIUMBLOB', 'LONGBLOB'], true);

    // Handle default value
    if ($default !== null) {
        if ($is_text_blob) {
            $def .= ' NOT NULL';
        } elseif (is_string($default) && $default !== '') {
            $def .= " DEFAULT '" . addslashes($default) . "'";
        } elseif (is_numeric($default)) {
            $def .= " DEFAULT " . $default;
        } elseif ($default === '') {
            $def .= " DEFAULT ''";
        }
    } else {
        $def .= ' NOT NULL';
    }

    // Handle auto_increment
    if ($extra === 'auto_increment') {
        $def .= ' AUTO_INCREMENT';
    }

    return $def;
}

/**
 * Generate MySQL CREATE TABLE statements from phpBB schema.json
 */
function generate_phpbb_schema(string $schema_json_path): array
{
    $statements = [];

    if (!file_exists($schema_json_path)) {
        throw new Exception("Schema file not found: $schema_json_path");
    }

    $json_content = file_get_contents($schema_json_path);
    if ($json_content === false) {
        throw new Exception("Failed to read schema file: $schema_json_path");
    }

    $schema = json_decode($json_content, true);
    if ($schema === null) {
        $json_error = json_last_error_msg();
        throw new Exception("Failed to parse schema JSON: $json_error (file: $schema_json_path)");
    }

    if (empty($schema)) {
        throw new Exception("Schema is empty: $schema_json_path");
    }

    foreach ($schema as $table_name => $table_def) {
        $columns = [];
        $primary_key = null;
        $keys = [];

        // Process columns
        if (isset($table_def['COLUMNS'])) {
            foreach ($table_def['COLUMNS'] as $col_name => $col_def) {
                $type = $col_def[0];
                $default = $col_def[1] ?? null;
                $extra = $col_def[2] ?? null;

                $col_sql = "`$col_name` " . phpbb_type_to_mysql($type, $default, $extra);
                $columns[] = $col_sql;
            }
        }

        // Process primary key
        if (isset($table_def['PRIMARY_KEY'])) {
            $pk = $table_def['PRIMARY_KEY'];
            if (is_array($pk)) {
                $primary_key = 'PRIMARY KEY (`' . implode('`, `', $pk) . '`)';
            } else {
                $primary_key = "PRIMARY KEY (`$pk`)";
            }
        }

        // Process indexes
        if (isset($table_def['KEYS'])) {
            foreach ($table_def['KEYS'] as $key_name => $key_def) {
                $key_type = $key_def[0];
                $key_cols = $key_def[1];

                // Handle column definitions - may include prefix length like "column_name:255"
                $format_key_col = function($col) {
                    if (strpos($col, ':') !== false) {
                        // Format: column_name:prefix_length -> `column_name`(prefix_length)
                        [$col_name, $prefix_len] = explode(':', $col, 2);
                        return "`$col_name`($prefix_len)";
                    }
                    return "`$col`";
                };

                if (is_array($key_cols)) {
                    $cols_str = implode(', ', array_map($format_key_col, $key_cols));
                } else {
                    $cols_str = $format_key_col($key_cols);
                }

                switch ($key_type) {
                    case 'UNIQUE':
                        $keys[] = "UNIQUE KEY `$key_name` ($cols_str)";
                        break;
                    case 'INDEX':
                    default:
                        $keys[] = "KEY `$key_name` ($cols_str)";
                        break;
                }
            }
        }

        // Build CREATE TABLE statement
        $parts = array_merge($columns, $primary_key ? [$primary_key] : [], $keys);
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (\n  " . implode(",\n  ", $parts) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $statements[] = $sql;
    }

    return $statements;
}

/**
 * Install phpBB modules (ACP, MCP, UCP)
 * This is required for the admin control panel to function
 */
function install_phpbb_modules(PDO $pdo): void
{
    echo "  [phpBB] Installing modules...\n";

    // Module structure based on phpBB's add_modules.php
    // Format: [class => [category => [subcategories]]]
    $module_categories = [
        'acp' => [
            'ACP_CAT_GENERAL' => [
                'ACP_QUICK_ACCESS',
                'ACP_BOARD_CONFIGURATION',
                'ACP_CLIENT_COMMUNICATION',
                'ACP_SERVER_CONFIGURATION',
            ],
            'ACP_CAT_FORUMS' => [
                'ACP_MANAGE_FORUMS',
                'ACP_FORUM_BASED_PERMISSIONS',
            ],
            'ACP_CAT_POSTING' => [
                'ACP_MESSAGES',
                'ACP_ATTACHMENTS',
            ],
            'ACP_CAT_USERGROUP' => [
                'ACP_CAT_USERS',
                'ACP_GROUPS',
                'ACP_USER_SECURITY',
            ],
            'ACP_CAT_PERMISSIONS' => [
                'ACP_GLOBAL_PERMISSIONS',
                'ACP_FORUM_BASED_PERMISSIONS',
                'ACP_PERMISSION_ROLES',
                'ACP_PERMISSION_MASKS',
            ],
            'ACP_CAT_CUSTOMISE' => [
                'ACP_STYLE_MANAGEMENT',
                'ACP_EXTENSION_MANAGEMENT',
                'ACP_LANGUAGE',
            ],
            'ACP_CAT_MAINTENANCE' => [
                'ACP_FORUM_LOGS',
                'ACP_CAT_DATABASE',
            ],
            'ACP_CAT_SYSTEM' => [
                'ACP_AUTOMATION',
                'ACP_GENERAL_TASKS',
                'ACP_MODULE_MANAGEMENT',
            ],
            'ACP_CAT_DOT_MODS' => [],
        ],
        'mcp' => [
            'MCP_MAIN' => [],
            'MCP_QUEUE' => [],
            'MCP_REPORTS' => [],
            'MCP_NOTES' => [],
            'MCP_WARN' => [],
            'MCP_LOGS' => [],
            'MCP_BAN' => [],
        ],
        'ucp' => [
            'UCP_MAIN' => [],
            'UCP_PROFILE' => [],
            'UCP_PREFS' => [],
            'UCP_PM' => [],
            'UCP_USERGROUPS' => [],
            'UCP_ZEBRA' => [],
        ],
    ];

    // Module basenames for categories that have them
    $category_basenames = [
        'UCP_PM' => 'ucp_pm',
    ];

    // ACP module info - maps basename to modes with their categories
    // Based on acp_* info files in phpBB
    $acp_modules = [
        'acp_main' => [
            'main' => ['cat' => ['ACP_QUICK_ACCESS'], 'title' => 'ACP_INDEX', 'auth' => 'acl_a_'],
        ],
        'acp_board' => [
            'settings' => ['cat' => ['ACP_BOARD_CONFIGURATION'], 'title' => 'ACP_BOARD_SETTINGS', 'auth' => 'acl_a_board'],
            'features' => ['cat' => ['ACP_BOARD_CONFIGURATION'], 'title' => 'ACP_BOARD_FEATURES', 'auth' => 'acl_a_board'],
            'avatar' => ['cat' => ['ACP_BOARD_CONFIGURATION'], 'title' => 'ACP_AVATAR_SETTINGS', 'auth' => 'acl_a_board'],
            'message' => ['cat' => ['ACP_MESSAGES'], 'title' => 'ACP_MESSAGE_SETTINGS', 'auth' => 'acl_a_board'],
            'post' => ['cat' => ['ACP_MESSAGES'], 'title' => 'ACP_POST_SETTINGS', 'auth' => 'acl_a_board'],
            'signature' => ['cat' => ['ACP_MESSAGES'], 'title' => 'ACP_SIGNATURE_SETTINGS', 'auth' => 'acl_a_board'],
            'registration' => ['cat' => ['ACP_CAT_USERS'], 'title' => 'ACP_REGISTER_SETTINGS', 'auth' => 'acl_a_board'],
            'auth' => ['cat' => ['ACP_CAT_USERS'], 'title' => 'ACP_AUTH_SETTINGS', 'auth' => 'acl_a_board'],
            'cookie' => ['cat' => ['ACP_CLIENT_COMMUNICATION'], 'title' => 'ACP_COOKIE_SETTINGS', 'auth' => 'acl_a_board'],
            'load' => ['cat' => ['ACP_SERVER_CONFIGURATION'], 'title' => 'ACP_LOAD_SETTINGS', 'auth' => 'acl_a_board'],
            'server' => ['cat' => ['ACP_SERVER_CONFIGURATION'], 'title' => 'ACP_SERVER_SETTINGS', 'auth' => 'acl_a_board'],
            'security' => ['cat' => ['ACP_SERVER_CONFIGURATION'], 'title' => 'ACP_SECURITY_SETTINGS', 'auth' => 'acl_a_board'],
            'email' => ['cat' => ['ACP_CLIENT_COMMUNICATION'], 'title' => 'ACP_EMAIL_SETTINGS', 'auth' => 'acl_a_board'],
        ],
        'acp_users' => [
            'overview' => ['cat' => ['ACP_CAT_USERS'], 'title' => 'ACP_MANAGE_USERS', 'auth' => 'acl_a_user'],
        ],
        'acp_groups' => [
            'manage' => ['cat' => ['ACP_GROUPS'], 'title' => 'ACP_GROUPS_MANAGE', 'auth' => 'acl_a_group'],
        ],
        'acp_forums' => [
            'manage' => ['cat' => ['ACP_MANAGE_FORUMS'], 'title' => 'ACP_MANAGE_FORUMS', 'auth' => 'acl_a_forum'],
        ],
        'acp_permissions' => [
            'intro' => ['cat' => ['ACP_GLOBAL_PERMISSIONS'], 'title' => 'ACP_PERMISSIONS', 'auth' => 'acl_a_viewauth'],
            'admins' => ['cat' => ['ACP_GLOBAL_PERMISSIONS'], 'title' => 'ACP_ADMINISTRATORS', 'auth' => 'acl_a_aauth'],
            'global' => ['cat' => ['ACP_GLOBAL_PERMISSIONS'], 'title' => 'ACP_GLOBAL_MODERATORS', 'auth' => 'acl_a_aauth'],
            'forum' => ['cat' => ['ACP_FORUM_BASED_PERMISSIONS'], 'title' => 'ACP_FORUM_PERMISSIONS', 'auth' => 'acl_a_fauth'],
            'moderators' => ['cat' => ['ACP_FORUM_BASED_PERMISSIONS'], 'title' => 'ACP_FORUM_MODERATORS', 'auth' => 'acl_a_fauth'],
        ],
        'acp_permission_roles' => [
            'admin_roles' => ['cat' => ['ACP_PERMISSION_ROLES'], 'title' => 'ACP_ADMIN_ROLES', 'auth' => 'acl_a_roles'],
            'user_roles' => ['cat' => ['ACP_PERMISSION_ROLES'], 'title' => 'ACP_USER_ROLES', 'auth' => 'acl_a_roles'],
            'mod_roles' => ['cat' => ['ACP_PERMISSION_ROLES'], 'title' => 'ACP_MOD_ROLES', 'auth' => 'acl_a_roles'],
            'forum_roles' => ['cat' => ['ACP_PERMISSION_ROLES'], 'title' => 'ACP_FORUM_ROLES', 'auth' => 'acl_a_roles'],
        ],
        'acp_styles' => [
            'style' => ['cat' => ['ACP_STYLE_MANAGEMENT'], 'title' => 'ACP_STYLES', 'auth' => 'acl_a_styles'],
            'install' => ['cat' => ['ACP_STYLE_MANAGEMENT'], 'title' => 'ACP_STYLES_INSTALL', 'auth' => 'acl_a_styles'],
        ],
        'acp_extensions' => [
            'main' => ['cat' => ['ACP_EXTENSION_MANAGEMENT'], 'title' => 'ACP_EXTENSIONS', 'auth' => 'acl_a_extensions'],
        ],
        'acp_language' => [
            'lang_packs' => ['cat' => ['ACP_LANGUAGE'], 'title' => 'ACP_LANGUAGE_PACKS', 'auth' => 'acl_a_language'],
        ],
        'acp_logs' => [
            'admin' => ['cat' => ['ACP_FORUM_LOGS'], 'title' => 'ACP_ADMIN_LOGS', 'auth' => 'acl_a_viewlogs'],
            'mod' => ['cat' => ['ACP_FORUM_LOGS'], 'title' => 'ACP_MOD_LOGS', 'auth' => 'acl_a_viewlogs'],
            'users' => ['cat' => ['ACP_FORUM_LOGS'], 'title' => 'ACP_USERS_LOGS', 'auth' => 'acl_a_viewlogs'],
            'critical' => ['cat' => ['ACP_FORUM_LOGS'], 'title' => 'ACP_CRITICAL_LOGS', 'auth' => 'acl_a_viewlogs'],
        ],
        'acp_database' => [
            'backup' => ['cat' => ['ACP_CAT_DATABASE'], 'title' => 'ACP_BACKUP', 'auth' => 'acl_a_backup'],
            'restore' => ['cat' => ['ACP_CAT_DATABASE'], 'title' => 'ACP_RESTORE', 'auth' => 'acl_a_backup'],
        ],
        'acp_bots' => [
            'bots' => ['cat' => ['ACP_CAT_USERS'], 'title' => 'ACP_BOTS', 'auth' => 'acl_a_bots'],
        ],
        'acp_php_info' => [
            'info' => ['cat' => ['ACP_GENERAL_TASKS'], 'title' => 'ACP_PHP_INFO', 'auth' => 'acl_a_phpinfo'],
        ],
        'acp_prune' => [
            'users' => ['cat' => ['ACP_CAT_USERS'], 'title' => 'ACP_PRUNE_USERS', 'auth' => 'acl_a_userdel'],
            'forums' => ['cat' => ['ACP_MANAGE_FORUMS'], 'title' => 'ACP_PRUNE_FORUMS', 'auth' => 'acl_a_prune'],
        ],
        'acp_modules' => [
            'acp' => ['cat' => ['ACP_MODULE_MANAGEMENT'], 'title' => 'ACP_MODULE_MANAGEMENT', 'auth' => 'acl_a_modules'],
            'ucp' => ['cat' => ['ACP_MODULE_MANAGEMENT'], 'title' => 'UCP', 'auth' => 'acl_a_modules'],
            'mcp' => ['cat' => ['ACP_MODULE_MANAGEMENT'], 'title' => 'MCP', 'auth' => 'acl_a_modules'],
        ],
        'acp_attachments' => [
            'attach' => ['cat' => ['ACP_ATTACHMENTS'], 'title' => 'ACP_ATTACHMENT_SETTINGS', 'auth' => 'acl_a_attach'],
            'extensions' => ['cat' => ['ACP_ATTACHMENTS'], 'title' => 'ACP_MANAGE_EXTENSIONS', 'auth' => 'acl_a_attach'],
            'ext_groups' => ['cat' => ['ACP_ATTACHMENTS'], 'title' => 'ACP_EXTENSION_GROUPS', 'auth' => 'acl_a_attach'],
            'orphan' => ['cat' => ['ACP_ATTACHMENTS'], 'title' => 'ACP_ORPHAN_ATTACHMENTS', 'auth' => 'acl_a_attach'],
        ],
        'acp_search' => [
            'settings' => ['cat' => ['ACP_SERVER_CONFIGURATION'], 'title' => 'ACP_SEARCH_SETTINGS', 'auth' => 'acl_a_search'],
            'index' => ['cat' => ['ACP_GENERAL_TASKS'], 'title' => 'ACP_SEARCH_INDEX', 'auth' => 'acl_a_search'],
        ],
    ];

    // MCP modules
    $mcp_modules = [
        'mcp_main' => [
            'front' => ['cat' => ['MCP_MAIN'], 'title' => 'MCP_MAIN_FRONT', 'auth' => ''],
            'forum_view' => ['cat' => ['MCP_MAIN'], 'title' => 'MCP_MAIN_FORUM_VIEW', 'auth' => 'acl_m_'],
            'topic_view' => ['cat' => ['MCP_MAIN'], 'title' => 'MCP_MAIN_TOPIC_VIEW', 'auth' => 'acl_m_'],
            'post_details' => ['cat' => ['MCP_MAIN'], 'title' => 'MCP_MAIN_POST_DETAILS', 'auth' => 'acl_m_'],
        ],
        'mcp_queue' => [
            'unapproved_topics' => ['cat' => ['MCP_QUEUE'], 'title' => 'MCP_QUEUE_UNAPPROVED_TOPICS', 'auth' => 'acl_m_approve'],
            'unapproved_posts' => ['cat' => ['MCP_QUEUE'], 'title' => 'MCP_QUEUE_UNAPPROVED_POSTS', 'auth' => 'acl_m_approve'],
            'deleted_topics' => ['cat' => ['MCP_QUEUE'], 'title' => 'MCP_QUEUE_DELETED_TOPICS', 'auth' => 'acl_m_approve'],
            'deleted_posts' => ['cat' => ['MCP_QUEUE'], 'title' => 'MCP_QUEUE_DELETED_POSTS', 'auth' => 'acl_m_approve'],
        ],
        'mcp_reports' => [
            'reports' => ['cat' => ['MCP_REPORTS'], 'title' => 'MCP_REPORTS_OPEN', 'auth' => 'acl_m_report'],
            'reports_closed' => ['cat' => ['MCP_REPORTS'], 'title' => 'MCP_REPORTS_CLOSED', 'auth' => 'acl_m_report'],
            'report_details' => ['cat' => ['MCP_REPORTS'], 'title' => 'MCP_REPORT_DETAILS', 'auth' => 'acl_m_report', 'display' => 0],
        ],
        'mcp_notes' => [
            'front' => ['cat' => ['MCP_NOTES'], 'title' => 'MCP_NOTES_FRONT', 'auth' => ''],
            'user_notes' => ['cat' => ['MCP_NOTES'], 'title' => 'MCP_NOTES_USER', 'auth' => ''],
        ],
        'mcp_warn' => [
            'front' => ['cat' => ['MCP_WARN'], 'title' => 'MCP_WARN_FRONT', 'auth' => 'acl_m_warn'],
            'list' => ['cat' => ['MCP_WARN'], 'title' => 'MCP_WARN_LIST', 'auth' => 'acl_m_warn'],
            'warn_user' => ['cat' => ['MCP_WARN'], 'title' => 'MCP_WARN_USER', 'auth' => 'acl_m_warn'],
            'warn_post' => ['cat' => ['MCP_WARN'], 'title' => 'MCP_WARN_POST', 'auth' => 'acl_m_warn', 'display' => 0],
        ],
        'mcp_logs' => [
            'front' => ['cat' => ['MCP_LOGS'], 'title' => 'MCP_LOGS_FRONT', 'auth' => 'acl_m_'],
            'forum_logs' => ['cat' => ['MCP_LOGS'], 'title' => 'MCP_LOGS_FORUM_VIEW', 'auth' => 'acl_m_'],
            'topic_logs' => ['cat' => ['MCP_LOGS'], 'title' => 'MCP_LOGS_TOPIC_VIEW', 'auth' => 'acl_m_'],
        ],
        'mcp_ban' => [
            'user' => ['cat' => ['MCP_BAN'], 'title' => 'MCP_BAN_USERNAMES', 'auth' => 'acl_m_ban'],
            'ip' => ['cat' => ['MCP_BAN'], 'title' => 'MCP_BAN_IPS', 'auth' => 'acl_m_ban'],
            'email' => ['cat' => ['MCP_BAN'], 'title' => 'MCP_BAN_EMAILS', 'auth' => 'acl_m_ban'],
        ],
    ];

    // UCP modules
    $ucp_modules = [
        'ucp_main' => [
            'front' => ['cat' => ['UCP_MAIN'], 'title' => 'UCP_MAIN_FRONT', 'auth' => ''],
            'subscribed' => ['cat' => ['UCP_MAIN'], 'title' => 'UCP_MAIN_SUBSCRIBED', 'auth' => ''],
            'bookmarks' => ['cat' => ['UCP_MAIN'], 'title' => 'UCP_MAIN_BOOKMARKS', 'auth' => 'cfg_allow_bookmarks'],
            'drafts' => ['cat' => ['UCP_MAIN'], 'title' => 'UCP_MAIN_DRAFTS', 'auth' => ''],
        ],
        'ucp_profile' => [
            'profile_info' => ['cat' => ['UCP_PROFILE'], 'title' => 'UCP_PROFILE_PROFILE_INFO', 'auth' => ''],
            'signature' => ['cat' => ['UCP_PROFILE'], 'title' => 'UCP_PROFILE_SIGNATURE', 'auth' => ''],
            'avatar' => ['cat' => ['UCP_PROFILE'], 'title' => 'UCP_PROFILE_AVATAR', 'auth' => ''],
            'reg_details' => ['cat' => ['UCP_PROFILE'], 'title' => 'UCP_PROFILE_REG_DETAILS', 'auth' => ''],
            'autologin_keys' => ['cat' => ['UCP_PROFILE'], 'title' => 'UCP_PROFILE_AUTOLOGIN_KEYS', 'auth' => ''],
        ],
        'ucp_prefs' => [
            'personal' => ['cat' => ['UCP_PREFS'], 'title' => 'UCP_PREFS_PERSONAL', 'auth' => ''],
            'post' => ['cat' => ['UCP_PREFS'], 'title' => 'UCP_PREFS_POST', 'auth' => ''],
            'view' => ['cat' => ['UCP_PREFS'], 'title' => 'UCP_PREFS_VIEW', 'auth' => ''],
        ],
        'ucp_pm' => [
            'view' => ['cat' => ['UCP_PM'], 'title' => 'UCP_PM_VIEW', 'auth' => 'cfg_allow_privmsg'],
            'compose' => ['cat' => ['UCP_PM'], 'title' => 'UCP_PM_COMPOSE', 'auth' => 'cfg_allow_privmsg'],
            'drafts' => ['cat' => ['UCP_PM'], 'title' => 'UCP_PM_DRAFTS', 'auth' => 'cfg_allow_privmsg'],
            'options' => ['cat' => ['UCP_PM'], 'title' => 'UCP_PM_OPTIONS', 'auth' => 'cfg_allow_privmsg'],
        ],
        'ucp_groups' => [
            'membership' => ['cat' => ['UCP_USERGROUPS'], 'title' => 'UCP_USERGROUPS_MEMBER', 'auth' => ''],
            'manage' => ['cat' => ['UCP_USERGROUPS'], 'title' => 'UCP_USERGROUPS_MANAGE', 'auth' => ''],
        ],
        'ucp_zebra' => [
            'friends' => ['cat' => ['UCP_ZEBRA'], 'title' => 'UCP_ZEBRA_FRIENDS', 'auth' => ''],
            'foes' => ['cat' => ['UCP_ZEBRA'], 'title' => 'UCP_ZEBRA_FOES', 'auth' => ''],
        ],
        'ucp_notifications' => [
            'notification_options' => ['cat' => ['UCP_PREFS'], 'title' => 'UCP_NOTIFICATION_OPTIONS', 'auth' => ''],
        ],
        'ucp_attachments' => [
            'attachments' => ['cat' => ['UCP_MAIN'], 'title' => 'UCP_MAIN_ATTACHMENTS', 'auth' => 'acl_u_attach'],
        ],
    ];

    // Clear existing modules
    $pdo->exec("DELETE FROM phpbb_modules");

    // Helper to insert module and return its ID
    $insert_module = function($module_class, $parent_id, $langname, $basename = '', $mode = '', $auth = '', $display = 1) use ($pdo) {
        // Get max right_id for this class
        $stmt = $pdo->query("SELECT MAX(right_id) as max_right FROM phpbb_modules WHERE module_class = " . $pdo->quote($module_class));
        $row = $stmt->fetch();
        $left_id = ($row['max_right'] ?? 0) + 1;
        $right_id = $left_id + 1;

        $stmt = $pdo->prepare("INSERT INTO phpbb_modules
            (module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth)
            VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$display, $basename, $module_class, $parent_id, $left_id, $right_id, $langname, $mode, $auth]);
        return $pdo->lastInsertId();
    };

    $category_ids = [];
    $module_count = 0;

    // First pass: Create all categories
    foreach ($module_categories as $module_class => $categories) {
        $category_ids[$module_class] = [];

        foreach ($categories as $cat_name => $subs) {
            // Check if this category has a basename
            $basename = $category_basenames[$cat_name] ?? '';

            // Insert top-level category
            $cat_id = $insert_module($module_class, 0, $cat_name, $basename);
            $category_ids[$module_class][$cat_name] = $cat_id;
            $module_count++;

            // Insert subcategories
            if (is_array($subs) && !empty($subs)) {
                foreach ($subs as $sub_name) {
                    $sub_basename = $category_basenames[$sub_name] ?? '';
                    $sub_id = $insert_module($module_class, $cat_id, $sub_name, $sub_basename);
                    $category_ids[$module_class][$sub_name] = $sub_id;
                    $module_count++;
                }
            }
        }
    }

    // Second pass: Add ACP modules
    foreach ($acp_modules as $basename => $modes) {
        foreach ($modes as $mode => $info) {
            foreach ($info['cat'] as $cat_name) {
                if (isset($category_ids['acp'][$cat_name])) {
                    $display = $info['display'] ?? 1;
                    $insert_module('acp', $category_ids['acp'][$cat_name], $info['title'], $basename, $mode, $info['auth'], $display);
                    $module_count++;
                }
            }
        }
    }

    // Third pass: Add MCP modules
    foreach ($mcp_modules as $basename => $modes) {
        foreach ($modes as $mode => $info) {
            foreach ($info['cat'] as $cat_name) {
                if (isset($category_ids['mcp'][$cat_name])) {
                    $display = $info['display'] ?? 1;
                    $insert_module('mcp', $category_ids['mcp'][$cat_name], $info['title'], $basename, $mode, $info['auth'], $display);
                    $module_count++;
                }
            }
        }
    }

    // Fourth pass: Add UCP modules
    foreach ($ucp_modules as $basename => $modes) {
        foreach ($modes as $mode => $info) {
            foreach ($info['cat'] as $cat_name) {
                if (isset($category_ids['ucp'][$cat_name])) {
                    $display = $info['display'] ?? 1;
                    $insert_module('ucp', $category_ids['ucp'][$cat_name], $info['title'], $basename, $mode, $info['auth'], $display);
                    $module_count++;
                }
            }
        }
    }

    // Rebuild nested set tree (left_id, right_id) properly
    // This is a simplified rebuild that just numbers everything sequentially
    foreach (['acp', 'mcp', 'ucp'] as $module_class) {
        $counter = 1;

        // Get all top-level categories
        $stmt = $pdo->prepare("SELECT module_id FROM phpbb_modules WHERE module_class = ? AND parent_id = 0 ORDER BY module_id");
        $stmt->execute([$module_class]);
        $top_cats = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($top_cats as $cat_id) {
            $left = $counter++;

            // Get all children
            $stmt = $pdo->prepare("SELECT module_id FROM phpbb_modules WHERE module_class = ? AND parent_id = ? ORDER BY module_id");
            $stmt->execute([$module_class, $cat_id]);
            $children = $stmt->fetchAll(PDO::FETCH_COLUMN);

            foreach ($children as $child_id) {
                $child_left = $counter++;

                // Get grandchildren
                $stmt2 = $pdo->prepare("SELECT module_id FROM phpbb_modules WHERE module_class = ? AND parent_id = ? ORDER BY module_id");
                $stmt2->execute([$module_class, $child_id]);
                $grandchildren = $stmt2->fetchAll(PDO::FETCH_COLUMN);

                foreach ($grandchildren as $gchild_id) {
                    $pdo->prepare("UPDATE phpbb_modules SET left_id = ?, right_id = ? WHERE module_id = ?")
                        ->execute([$counter, $counter + 1, $gchild_id]);
                    $counter += 2;
                }

                $child_right = $counter++;
                $pdo->prepare("UPDATE phpbb_modules SET left_id = ?, right_id = ? WHERE module_id = ?")
                    ->execute([$child_left, $child_right, $child_id]);
            }

            $right = $counter++;
            $pdo->prepare("UPDATE phpbb_modules SET left_id = ?, right_id = ? WHERE module_id = ?")
                ->execute([$left, $right, $cat_id]);
        }
    }

    echo "  [phpBB] Installed $module_count modules\n";
}

/**
 * Install phpBB forum database and config
 */
function install_phpbb_forum(PDO $pdo, array $config, string $admin_user, string $admin_pass, string $admin_email): bool
{
    $forum_dir = __DIR__ . '/forum';
    $schema_json = $forum_dir . '/install1/schemas/schema.json';
    $schema_data_sql = $forum_dir . '/install1/schemas/schema_data.sql';

    echo "  [phpBB] Forum dir: $forum_dir\n";

    // Generate and run schema
    if (!file_exists($schema_json)) {
        throw new Exception("phpBB schema.json not found at: $schema_json");
    }
    echo "  [phpBB] Schema JSON found\n";

    $schema_statements = generate_phpbb_schema($schema_json);
    if (empty($schema_statements)) {
        throw new Exception("Failed to generate phpBB schema from: $schema_json");
    }
    echo "  [phpBB] Generated " . count($schema_statements) . " schema statements\n";

    // Drop existing phpBB tables first (clean install)
    $result = $pdo->query("SHOW TABLES LIKE 'phpbb_%'");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);
    if (!empty($tables)) {
        echo "  [phpBB] Dropping " . count($tables) . " existing tables\n";
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
        foreach ($tables as $table) {
            $pdo->exec("DROP TABLE IF EXISTS `$table`");
        }
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    }

    // Create tables
    echo "  [phpBB] Creating tables...\n";
    $table_count = 0;
    foreach ($schema_statements as $sql) {
        try {
            $pdo->exec($sql);
            $table_count++;
        } catch (PDOException $e) {
            // Extract table name from CREATE TABLE statement for better error message
            if (preg_match('/CREATE TABLE.*?`(\w+)`/i', $sql, $m)) {
                throw new Exception("Failed to create table {$m[1]}: " . $e->getMessage());
            }
            throw $e;
        }
    }
    echo "  [phpBB] Created $table_count tables\n";

    // Verify critical tables were created
    $verify_tables = ['phpbb_styles', 'phpbb_config', 'phpbb_users', 'phpbb_forums', 'phpbb_topics', 'phpbb_posts', 'phpbb_modules'];
    foreach ($verify_tables as $table) {
        $check = $pdo->query("SHOW TABLES LIKE '$table'");
        if (!$check->fetch()) {
            throw new Exception("Critical table '$table' was not created. Schema generation may have failed.");
        }
    }
    echo "  [phpBB] Verified critical tables exist\n";

    // Load schema_data.sql (initial configuration)
    if (file_exists($schema_data_sql)) {
        echo "  [phpBB] Loading schema_data.sql...\n";
        $data_sql = file_get_contents($schema_data_sql);
        // The file has # POSTGRES BEGIN # and # POSTGRES COMMIT # markers as comments
        // split_sql_statements already skips comment lines starting with #

        // Replace phpBB language placeholders with actual English text
        $lang_replacements = [
            '{L_FORUMS_FIRST_CATEGORY}' => 'Your first category',
            '{L_FORUMS_TEST_FORUM_TITLE}' => 'Your first forum',
            '{L_FORUMS_TEST_FORUM_DESC}' => 'Description of your first forum.',
            '{L_TOPICS_TOPIC_TITLE}' => 'Welcome to phpBB3',
        ];
        $data_sql = str_replace(array_keys($lang_replacements), array_values($lang_replacements), $data_sql);

        $statements = split_sql_statements($data_sql);
        $data_count = 0;
        foreach ($statements as $stmt) {
            $stmt = trim($stmt);
            if ($stmt === '' || strpos($stmt, '#') === 0) {
                continue;
            }
            try {
                $pdo->exec($stmt);
                $data_count++;
            } catch (PDOException $e) {
                // Ignore duplicate key errors on initial data
            }
        }
        echo "  [phpBB] Executed $data_count data statements\n";
    }

    // Install phpBB modules (ACP, MCP, UCP) - required for admin panel to work
    install_phpbb_modules($pdo);

    // Get phpBB settings from config
    $cookie_name = $config['phpbb_cookie_name'] ?? 'stmserverbb__';
    $board_email = $config['phpbb_board_email'] ?? 'forum@steampowered.com';
    $root_path = $config['root_path'] ?? '';
    $script_path = $root_path . '/forum';
    $server_name = $_SERVER['HTTP_HOST'] ?? 'localhost';

    // Update phpBB configuration values
    $config_updates = [
        'sitename' => 'Steam Users Forums',
        'site_desc' => '',
        'board_email' => $board_email,
        'board_contact' => $board_email,
        'server_name' => $server_name,
        'script_path' => $script_path,
        'cookie_name' => $cookie_name,
        'cookie_domain' => '',
        'cookie_path' => '/',
        'default_style' => '1',
        // vBulletin 2004-style date formats
        'default_dateformat' => 'm-d-Y h:i A',
        'board_timezone' => 'UTC',
    ];

    echo "  [phpBB] Updating config values...\n";
    $update_stmt = $pdo->prepare('UPDATE phpbb_config SET config_value = ? WHERE config_name = ?');
    foreach ($config_updates as $name => $value) {
        $update_stmt->execute([$value, $name]);
    }

    // Update admin user (user_id 2 is the admin created by schema_data.sql)
    echo "  [phpBB] Setting up admin user...\n";
    $now = time();
    $password_hash = password_hash($admin_pass, PASSWORD_BCRYPT);

    $pdo->prepare('UPDATE phpbb_users SET username = ?, username_clean = ?, user_email = ?, user_password = ?, user_regdate = ? WHERE user_id = 2')
        ->execute([$admin_user, strtolower($admin_user), $admin_email, $password_hash, $now]);

    // Also update the forum post author name to match
    $pdo->prepare('UPDATE phpbb_forums SET forum_last_poster_name = ? WHERE forum_last_poster_id = 2')
        ->execute([$admin_user]);

    // Update user_group for admin
    $pdo->exec("INSERT IGNORE INTO phpbb_user_group (group_id, user_id, user_pending, group_leader) VALUES (5, 2, 0, 1)");

    try {
        // Register Steam styles in phpbb_styles table
        // Style names must match what get_steam_theme_by_date() returns in functions_steam_theme.php
        echo "  [phpBB] Registering Steam styles...
    ";


        // Get prosilver style_id for parent inheritance (incomplete styles fall back to prosilver)
        // Use try-catch in case table doesn't have prosilver yet
        $prosilver_id = 1; // Default prosilver ID
        try {
            $prosilver_check = $pdo->query("SELECT style_id FROM phpbb_styles WHERE style_path = 'prosilver' LIMIT 1");
            $prosilver_result = $prosilver_check->fetchColumn();
            if ($prosilver_result) {
                $prosilver_id = $prosilver_result;
            }
        } catch (PDOException $e) {
            // Table might not have prosilver yet, use default ID
        }

        // All Steam styles that can be selected by date-based theme selection
        // These names MUST match the theme names returned by get_steam_theme_by_date()
        // Styles with 'needs_parent' => true have incomplete templates and inherit from prosilver
        $steam_styles = [
            '2002_v1'        => ['copyright' => 'Valve Corporation, 2002', 'path' => '2002_v1', 'needs_parent' => true],
            '2002_v2'        => ['copyright' => 'Valve Corporation, 2002', 'path' => '2002_v2', 'needs_parent' => true],
            'steam_2003_v1'  => ['copyright' => 'Valve Corporation, 2003', 'path' => 'steam_2003_v1', 'needs_parent' => false],
            'steam_2003_v2'  => ['copyright' => 'Valve Corporation, 2003', 'path' => 'steam_2003_v2', 'needs_parent' => false],
            'steam_2004'     => ['copyright' => 'Valve Corporation, 2004', 'path' => 'steam_2004', 'needs_parent' => true],
            'steam_2008'     => ['copyright' => 'Valve Corporation, 2008', 'path' => 'steam_2008', 'needs_parent' => false],
            'steam_2011'     => ['copyright' => 'Valve Corporation, 2011', 'path' => 'steam_2011', 'needs_parent' => false],
        ];

        foreach ($steam_styles as $style_name => $style_data) {
            $parent_id = $style_data['needs_parent'] ? $prosilver_id : 0;
            $parent_tree = $style_data['needs_parent'] ? 'prosilver' : '';
            $pdo->exec("INSERT IGNORE INTO phpbb_styles (style_name, style_copyright, style_active, style_path, bbcode_bitfield, style_parent_id, style_parent_tree)
                VALUES (" . $pdo->quote($style_name) . ", " . $pdo->quote($style_data['copyright']) . ", 1, " . $pdo->quote($style_data['path']) . ", 'kNg=', $parent_id, " . $pdo->quote($parent_tree) . ")");
        }
        echo "  [phpBB] Registered " . count($steam_styles) . " Steam styles
    ";


        // Update existing styles to have proper parent inheritance (for upgrades)
        $pdo->exec("UPDATE phpbb_styles SET style_parent_id = $prosilver_id, style_parent_tree = 'prosilver'
                    WHERE style_path IN ('2002_v1', '2002_v2', 'steam_2004', 'steam_2006_v1') AND style_parent_id = 0");

        // Get the steam_2004 style_id and set it as default
        $steam2004_check = $pdo->query("SELECT style_id FROM phpbb_styles WHERE style_name = 'steam_2004' LIMIT 1");
        $steam2004_id = $steam2004_check->fetchColumn();
        if ($steam2004_id) {
            $pdo->prepare("UPDATE phpbb_config SET config_value = ? WHERE config_name = 'default_style'")->execute([$steam2004_id]);
            echo "  [phpBB] Set default style to steam_2004 (ID: $steam2004_id)\n";
        } else {
            echo "  [phpBB] Warning: Could not find steam_2004 style to set as default\n";
        }

    } catch (PDOException $e) {
        echo "  [phpBB] Warning: Failed to register Steam styles: " . $e->getMessage() . "
";
        echo "  [phpBB] This may indicate the phpbb_styles table was not created properly.
";
        // Continue with installation - styles can be registered manually later
    }

    // Enable the steamcms/theme_sync extension
    $pdo->exec("INSERT IGNORE INTO phpbb_ext (ext_name, ext_active, ext_state)
        VALUES ('steamcms/theme_sync', 1, 'b:0;')");

    // Add is_historical columns for historical forum data filtering
    echo "  [phpBB] Adding is_historical columns...\n";
    // This is done manually instead of via phpBB migrations since we're installing from scratch
    $historical_columns = [
        'phpbb_users' => 'is_historical',
        'phpbb_forums' => 'is_historical',
        'phpbb_topics' => 'is_historical',
        'phpbb_posts' => 'is_historical',
    ];

    foreach ($historical_columns as $table => $column) {
        // Check if column exists
        $check = $pdo->query("SHOW COLUMNS FROM `$table` LIKE '$column'")->fetch();
        if (!$check) {
            $pdo->exec("ALTER TABLE `$table` ADD COLUMN `$column` TINYINT(1) NOT NULL DEFAULT 0");
        }
    }

    // Add indexes for is_historical columns
    $tables_with_index = ['phpbb_users', 'phpbb_topics', 'phpbb_posts'];
    foreach ($tables_with_index as $table) {
        // Check if index exists
        $check = $pdo->query("SHOW INDEX FROM `$table` WHERE Key_name = 'is_historical'")->fetch();
        if (!$check) {
            try {
                $pdo->exec("CREATE INDEX `is_historical` ON `$table` (`is_historical`)");
            } catch (PDOException $e) {
                // Ignore if index already exists
            }
        }
    }

    // Enable the steamcms/historical_filter extension
    // ext_state serialized format indicates migration has been run
    $migration_state = serialize([
        'steamcms\\historical_filter\\migrations\\add_historical_columns' => [
            'effectively_installed' => true,
            'state' => 'installed',
        ]
    ]);
    $pdo->exec("INSERT IGNORE INTO phpbb_ext (ext_name, ext_active, ext_state)
        VALUES ('steamcms/historical_filter', 1, " . $pdo->quote($migration_state) . ")");
    echo "  [phpBB] Enabled historical_filter extension\n";

    // Enable the steamcms/historical_manager extension
    $manager_migration_state = serialize([
        'steamcms\\historical_manager\\migrations\\install_acp_module' => [
            'effectively_installed' => true,
            'state' => 'installed',
        ]
    ]);
    $pdo->exec("INSERT IGNORE INTO phpbb_ext (ext_name, ext_active, ext_state)
        VALUES ('steamcms/historical_manager', 1, " . $pdo->quote($manager_migration_state) . ")");
    echo "  [phpBB] Enabled historical_manager extension\n";

    // Register Historical Manager ACP module in phpbb_modules
    // Find parent module for extensions category (ACP_CAT_DOT_MODS)
    $ext_cat_id = 0;
    $stmt = $pdo->query("SELECT module_id FROM phpbb_modules WHERE module_class = 'acp' AND module_langname = 'ACP_CAT_DOT_MODS' LIMIT 1");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $ext_cat_id = (int) $row['module_id'];
    } else {
        // Create the extensions category if it doesn't exist
        $max_stmt = $pdo->query("SELECT MAX(right_id) as max_right FROM phpbb_modules WHERE module_class = 'acp'");
        $max_row = $max_stmt->fetch();
        $left = ($max_row['max_right'] ?? 0) + 1;
        $pdo->prepare("INSERT INTO phpbb_modules (module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) VALUES (1, 1, '', 'acp', 0, ?, ?, 'ACP_CAT_DOT_MODS', '', '')")
             ->execute([$left, $left + 1]);
        $ext_cat_id = (int) $pdo->lastInsertId();
    }

    if ($ext_cat_id) {
        // Create the Historical Manager parent module
        $max_stmt = $pdo->query("SELECT MAX(right_id) as max_right FROM phpbb_modules WHERE module_class = 'acp'");
        $max_row = $max_stmt->fetch();
        $left = ($max_row['max_right'] ?? 0) + 1;
        $pdo->prepare("INSERT INTO phpbb_modules (module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) VALUES (1, 1, '', 'acp', ?, ?, ?, 'ACP_HISTORICAL_MANAGER', '', '')")
             ->execute([$ext_cat_id, $left, $left + 1]);
        $hist_parent_id = (int) $pdo->lastInsertId();

        // Add sub-modules (modes)
        $modes = [
            ['dashboard', 'ACP_HISTORICAL_MANAGER_DASHBOARD'],
            ['users', 'ACP_HISTORICAL_MANAGER_USERS'],
            ['forums', 'ACP_HISTORICAL_MANAGER_FORUMS'],
            ['topics', 'ACP_HISTORICAL_MANAGER_TOPICS'],
            ['import', 'ACP_HISTORICAL_MANAGER_IMPORT'],
        ];
        foreach ($modes as $m) {
            $max_stmt = $pdo->query("SELECT MAX(right_id) as max_right FROM phpbb_modules WHERE module_class = 'acp'");
            $max_row = $max_stmt->fetch();
            $left = ($max_row['max_right'] ?? 0) + 1;
            $pdo->prepare("INSERT INTO phpbb_modules (module_enabled, module_display, module_basename, module_class, parent_id, left_id, right_id, module_langname, module_mode, module_auth) VALUES (1, 1, '\\\\steamcms\\\\historical_manager\\\\acp\\\\main_module', 'acp', ?, ?, ?, ?, ?, 'ext_steamcms/historical_manager && acl_a_board')")
                 ->execute([$hist_parent_id, $left, $left + 1, $m[1], $m[0]]);
        }
        echo "  [phpBB] Registered Historical Manager ACP modules\n";
    }

    // Run steam_theme_setup.sql for Steam-specific settings
    $steam_theme_sql = $forum_dir . '/install/steam_theme_setup.sql';
    if (file_exists($steam_theme_sql)) {
        $sql_content = file_get_contents($steam_theme_sql);
        $statements = array_filter(array_map('trim', explode(';', $sql_content)));
        foreach ($statements as $stmt) {
            if (!empty($stmt) && strpos($stmt, '--') !== 0) {
                try {
                    $pdo->exec($stmt);
                } catch (PDOException $e) {
                    // Ignore errors for INSERT IGNORE type statements
                }
            }
        }
    }

    // Ensure the historical_filter extension files exist
    // These provide the event listeners for style-based filtering
    $ext_dir = $forum_dir . '/ext/steamcms/historical_filter';
    $config_dir = $ext_dir . '/config';

    // Create config directory if needed
    if (!is_dir($config_dir)) {
        @mkdir($config_dir, 0755, true);
    }

    // Create services.yml if it doesn't exist
    $services_file = $config_dir . '/services.yml';
    if (!file_exists($services_file)) {
        $services_yml = "services:\n    steamcms.historical_filter.listener:\n        class: steamcms\\historical_filter\\event\\main_listener\n        arguments:\n            - '@user'\n            - '@template'\n            - '@dbal.conn'\n        tags:\n            - { name: event.listener }\n";
        file_put_contents($services_file, $services_yml);
    }

    // Create helper functions file for phpBB integration
    $helper_file = $forum_dir . '/includes/historical_filter.php';
    if (!file_exists($helper_file)) {
        $helper_code = '<?php
/**
 * Historical Data Filter Helper Functions
 * Style names must match what get_steam_theme_by_date() returns in functions_steam_theme.php
 */
if (!defined(\'IN_PHPBB\')) { exit; }

function is_historical_style_active() {
    global $user;
    $style_name = isset($user->style[\'style_name\']) ? $user->style[\'style_name\'] : \'\';
    // All styles that should show historical forum data
    $allowed_styles = [
        \'steam_2003_v1\', \'steam_2003_v2\', \'steam_2004\',  // Date-based theme names
        \'Steam 2003\', \'Steam 2004\', \'steam_2003\', \'2003_v2\', \'2004\'  // Legacy names
    ];
    return in_array($style_name, $allowed_styles, true);
}

function get_historical_filter_sql($table_alias = \'\') {
    if (is_historical_style_active()) { return \'\'; }
    $prefix = $table_alias ? $table_alias . \'.\' : \'\';
    return \' AND (\' . $prefix . \'is_historical IS NULL OR \' . $prefix . \'is_historical = 0)\';
}
';
        file_put_contents($helper_file, $helper_code);
    }

    // Clear phpBB cache to ensure extension is loaded properly
    echo "  [phpBB] Clearing cache...\n";
    $cache_dirs = [
        $forum_dir . '/cache/',
        $forum_dir . '/cache/production/',
        $forum_dir . '/cache/production/twig/',
    ];
    foreach ($cache_dirs as $cache_dir) {
        if (is_dir($cache_dir)) {
            $files = glob($cache_dir . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                } elseif (is_dir($file) && basename($file) !== '.' && basename($file) !== '..') {
                    // Recursively delete subdirectories
                    $subfiles = glob($file . '/*');
                    foreach ($subfiles as $subfile) {
                        if (is_file($subfile)) {
                            @unlink($subfile);
                        }
                    }
                }
            }
        }
    }
    // Also remove container cache files
    $container_files = glob($forum_dir . '/cache/production/container_*.php');
    foreach ($container_files as $cf) {
        @unlink($cf);
    }

    // Generate phpBB config.php
    echo "  [phpBB] Generating config.php...\n";
    $phpbb_config = "<?php
// phpBB 3.x auto-generated configuration file
// Created by SteamCMS installer

\$dbms = 'phpbb\\\\db\\\\driver\\\\mysqli';
\$dbhost = '{$config['host']}';
\$dbport = '{$config['port']}';
\$dbname = '{$config['dbname']}';
\$dbuser = '{$config['user']}';
\$dbpasswd = '{$config['pass']}';

\$table_prefix = 'phpbb_';
\$phpbb_adm_relative_path = 'adm/';
\$acm_type = 'phpbb\\\\cache\\\\driver\\\\file';

@define('PHPBB_INSTALLED', true);
@define('PHPBB_ENVIRONMENT', 'production');
// @define('DEBUG_CONTAINER', true);
";

    $config_path = $forum_dir . '/config.php';
    echo "  [phpBB] Writing config to: $config_path\n";
    $result = file_put_contents($config_path, $phpbb_config);
    if ($result === false) {
        throw new Exception("Failed to write phpBB config.php to: $config_path - Check directory permissions");
    }
    echo "  [phpBB] Config written ($result bytes)\n";

    // Remove the install directory placeholder to prevent redirect loops
    $install_dir = $forum_dir . '/install';
    if (is_dir($install_dir)) {
        // Create a simple index.php that redirects to forum root
        file_put_contents($install_dir . '/app.php', "<?php\nheader('Location: ../index.php');\nexit;\n");
    }

    echo "  [phpBB] Installation complete!\n";
    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($step == 1) {
        $host = trim($_POST['host']);
        $dbPort = filter_input(INPUT_POST, 'port', FILTER_VALIDATE_INT);
        if (!$dbPort) {
            $dbPort = 3306;
        }
        $user = trim($_POST['dbuser']);
        $pass = trim($_POST['dbpass']);
        $dbname = trim($_POST['dbname']);
        $root_path = trim($_POST['root_path'] ?? '');
        $phpbb_cookie_name = trim($_POST['phpbb_cookie_name'] ?? 'stmserverbb__');
        $phpbb_board_email = trim($_POST['phpbb_board_email'] ?? 'forum@steampowered.com');
        try {
            $dsn = "mysql:host=$host;port=$dbPort;charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            // Ensure connection uses UTF-8
            $pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $_SESSION['cms_install'] = [
                'host' => $host,
                'port' => $dbPort,
                'user' => $user,
                'pass' => $pass,
                'dbname' => $dbname,
                'root_path' => $root_path,
                'phpbb_cookie_name' => $phpbb_cookie_name,
                'phpbb_board_email' => $phpbb_board_email,
            ];
            header('Location: install.php?step=2');
            exit;
        } catch (PDOException $e) {
            $errors[] = $e->getMessage();
        }
    } elseif ($step == 2 && isset($_SESSION['cms_install'])) {
        // Disable execution timeout entirely — the vBulletin import alone can
        // run for a long time. The top-of-file ini_set already disables this,
        // but call again here to override any SAPI-level reset between requests.
        @set_time_limit(0);
        @ini_set('max_execution_time', '0');
        @ini_set('max_input_time',     '-1');
        @ini_set('memory_limit',       '2048M');
        @ignore_user_abort(true);

        $config = $_SESSION['cms_install'];
        $host = $config['host'];
        $dbPort = isset($config['port']) && (int) $config['port'] > 0 ? (int) $config['port'] : 3306;
        $user = $config['user'];
        $pass = $config['pass'];
        $dbname = $config['dbname'];
        $root_path = $config['root_path'] ?? '';
        $admin_user = trim($_POST['admin_user']);
        $admin_pass = trim($_POST['admin_pass']);
        $admin_email = trim($_POST['admin_email']);
        $install_historical_data = isset($_POST['install_2004_forum_data']) ? 1 : 0;
        $install_historical_data = isset($_POST['install_2004_forum_data']) ? 1 : 0;
        $install_historical_data = isset($_POST['install_2004_forum_data']) ? 1 : 0;
        $install_historical_data = isset($_POST['install_2004_forum_data']) ? 1 : 0;
        try {
            $dsn = "mysql:host=$host;port=$dbPort;charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            // Ensure connection uses UTF-8
            $pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("USE `$dbname`");
            // Re-ensure connection charset after selecting database
            $pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("DROP TABLE IF EXISTS news");
            $pdo->exec("CREATE TABLE news(
                id BIGINT AUTO_INCREMENT PRIMARY KEY,
                title TEXT,
                author TEXT,
                category VARCHAR(100) DEFAULT '',
                publish_date INT(11) DEFAULT 0,
                publish_at INT(11) DEFAULT 0,
                views INT DEFAULT 0,
                content TEXT,
                products TEXT,
                is_official TINYINT(1) DEFAULT 1,
                status VARCHAR(20) DEFAULT 'draft',
                associated_appids TEXT DEFAULT '',
                INDEX(publish_date),
                INDEX(publish_at)
            );
CREATE TABLE download_pages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(50) UNIQUE,
    years TEXT,
    content MEDIUMTEXT,
    created DATETIME,
    updated DATETIME
);
CREATE TABLE download_links(
    id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(50),
    category VARCHAR(255),
    label VARCHAR(255),
    url TEXT,
    ord INT DEFAULT 0,
    FOREIGN KEY(version) REFERENCES download_pages(version) ON DELETE CASCADE
);
CREATE TABLE download_categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE,
    file_size VARCHAR(50)
);");
            $pdo->exec("DROP TABLE IF EXISTS content_servers");
            $pdo->exec("CREATE TABLE content_servers(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255),
                ip VARCHAR(100),
                port INT,
                total_capacity INT,
                region VARCHAR(100),
                filtered TINYINT(1) NOT NULL DEFAULT 0,
                website VARCHAR(255) DEFAULT NULL
            )");
            $pdo->exec("DROP TABLE IF EXISTS server_stats");
            $pdo->exec("CREATE TABLE server_stats(
                id INT AUTO_INCREMENT PRIMARY KEY,
                server_id INT,
                available_bandwidth INT,
                unique_connections INT,
                last_checked DATETIME,
                status VARCHAR(10)
            )");
            require __DIR__ . '/sql/install_content_servers.php';
            $pdo->exec("DROP TABLE IF EXISTS faq_categories");
            $pdo->exec("CREATE TABLE faq_categories(id1 BIGINT,id2 BIGINT,name TEXT,hidden TINYINT(1) DEFAULT 0,PRIMARY KEY(id1,id2))");
            $pdo->exec("DROP TABLE IF EXISTS faq_content");
            $pdo->exec("CREATE TABLE faq_content(catid1 BIGINT,catid2 BIGINT,faqid1 BIGINT,faqid2 BIGINT,title TEXT,body TEXT,views INT DEFAULT 0,PRIMARY KEY(faqid1,faqid2))");
            $pdo->exec("DROP TABLE IF EXISTS ccafe_registration");
            $pdo->exec("CREATE TABLE ccafe_registration(
                id INT AUTO_INCREMENT PRIMARY KEY,
                created DATETIME,
                company TEXT,
                address1 TEXT,
                address2 TEXT,
                city TEXT,
                state TEXT,
                zip TEXT,
                country TEXT,
                firstname TEXT,
                lastname TEXT,
                email TEXT,
                phone TEXT,
                fax TEXT,
                locations INT,
                seats INT,
                prepaid_hours TEXT,
                ship_name TEXT,
                ship_address1 TEXT,
                ship_address2 TEXT,
                ship_city TEXT,
                ship_state TEXT,
                ship_zip TEXT,
                ship_country TEXT,
                directory TEXT,
                contact_email TEXT,
                ship_phone TEXT,
                wire_transfer TEXT
            );
CREATE TABLE `0405_storefront_games` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appid INT UNIQUE,
    title TEXT,
    description TEXT,
    image_thumb TEXT,
    image_screenshot TEXT,
    purchaseButtonStr VARCHAR(255),
    isHidden TINYINT(1) NOT NULL DEFAULT 0
);
CREATE TABLE `0405_storefront_thirdpartGames` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title TEXT,
    description TEXT,
    image_thumb TEXT,
    image_screenshot TEXT,
    websiteUrl TEXT,
    isHidden TINYINT(1) NOT NULL DEFAULT 0
);
CREATE TABLE `0405_storefront_packages` (
    subid INT PRIMARY KEY,
    title TEXT,
    description TEXT,
    image_thumb TEXT,
    image_screenshot TEXT,
    price TEXT,
    steamOnlyBadge TINYINT(1) NOT NULL DEFAULT 0,
    isHidden TINYINT(1) NOT NULL DEFAULT 0
);");
            $pdo->exec("DROP TABLE IF EXISTS custom_pages");
            $pdo->exec("CREATE TABLE custom_pages (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(255) NOT NULL,
    page_name VARCHAR(255) DEFAULT NULL,
    title TEXT,
    content MEDIUMTEXT,
    theme VARCHAR(255) DEFAULT NULL,
    template VARCHAR(255) DEFAULT NULL,
    header_image VARCHAR(255) DEFAULT NULL,
    created DATETIME,
    updated DATETIME,
    status VARCHAR(20) DEFAULT 'draft',
    UNIQUE KEY slug_theme (slug, theme)
);");

            $pdo->exec("DROP TABLE IF EXISTS platform_update_history");
            $pdo->exec('CREATE TABLE platform_update_history (
                id INT AUTO_INCREMENT PRIMARY KEY,
                appid INT NOT NULL,
                date DATE NOT NULL,
                title TEXT,
                content LONGTEXT NOT NULL,
                INDEX idx_appid (`appid`),
                INDEX idx_date (`date`)
            )');
            $pdo->exec("DROP TABLE IF EXISTS support_pages");
            $pdo->exec("CREATE TABLE support_pages(
                id INT AUTO_INCREMENT PRIMARY KEY,
                version VARCHAR(50) UNIQUE,
                years TEXT,
                content MEDIUMTEXT,
                created DATETIME,
                updated DATETIME
            )");
            $pdo->exec("DROP TABLE IF EXISTS support_page_faqs");
            $pdo->exec("CREATE TABLE support_page_faqs(
                support_id INT,
                faqid1 BIGINT,
                faqid2 BIGINT,
                ord INT,
                PRIMARY KEY(support_id, ord),
                FOREIGN KEY(support_id) REFERENCES support_pages(id) ON DELETE CASCADE
            )");
            $pdo->exec("DROP TABLE IF EXISTS troubleshooter_pages");
            $pdo->exec("CREATE TABLE troubleshooter_pages(
                id INT AUTO_INCREMENT PRIMARY KEY,
                lang VARCHAR(8) NOT NULL,
                slug VARCHAR(64) NOT NULL,
                title TEXT,
                content MEDIUMTEXT,
                created DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY(lang,slug)
            )");
            $pdo->exec("DROP TABLE IF EXISTS support_requests");
            $pdo->exec("CREATE TABLE support_requests(
                id INT AUTO_INCREMENT PRIMARY KEY,
                page VARCHAR(64) NOT NULL,
                language VARCHAR(8) NOT NULL,
                f1 TEXT,f2 TEXT,f3 TEXT,f4 TEXT,f5 TEXT,
                f6 TEXT,f7 TEXT,f8 TEXT,f9 TEXT,f10 TEXT,
                created DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
            $pdo->exec("DROP TABLE IF EXISTS bug_reports");
            $pdo->exec("CREATE TABLE bug_reports(
                id INT AUTO_INCREMENT PRIMARY KEY,
                email_address VARCHAR(256) NOT NULL,
                description TEXT,
                reproducible VARCHAR(10),
                repro_steps TEXT,
                os VARCHAR(50),
                connection_type VARCHAR(50),
                file_system VARCHAR(50),
                reporter_comments TEXT,
                created DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
            $pdo->exec("DROP TABLE IF EXISTS cafe_directory");
            $pdo->exec("CREATE TABLE cafe_directory(
                id INT AUTO_INCREMENT PRIMARY KEY,
                url TEXT,
                name TEXT,
                phone TEXT,
                address TEXT,
                city_state TEXT,
                zip TEXT,
                ord INT DEFAULT 0,
                country CHAR(2) NOT NULL DEFAULT 'US',
                state VARCHAR(100) NULL
            )");
            $pdo->exec("DROP TABLE IF EXISTS cafe_representatives");
            $pdo->exec("CREATE TABLE cafe_representatives(
                id INT AUTO_INCREMENT PRIMARY KEY,
                url TEXT,
                website TEXT,
                email TEXT,
                rep_name TEXT,
                address TEXT,
                city_province TEXT,
                zip TEXT,
                country TEXT,
                phone TEXT,
                ord INT DEFAULT 0
            )");
            $pdo->exec("DROP TABLE IF EXISTS media");
            $pdo->exec("CREATE TABLE media(
                id INT AUTO_INCREMENT PRIMARY KEY,
                filename TEXT,
                uploaded DATETIME
            )");
            $pdo->exec("DROP TABLE IF EXISTS redirects");
            $pdo->exec("CREATE TABLE redirects(
                id INT AUTO_INCREMENT PRIMARY KEY,
                slug VARCHAR(200) COLLATE utf8mb4_bin UNIQUE,
                target TEXT,
                hits INT DEFAULT 0,
                created DATETIME
            )");

            // Seed default redirects so legacy paths resolve
            $pdo->exec("INSERT INTO redirects (slug, target, created) VALUES
                ('html/betasignup.html', 'index.php?area=getsteamnow', NOW()),
                ('legal.html', 'index.php?area=legal', NOW()),
                ('status.php', 'index.php?area=status', NOW()),
                ('Games_Available/Games.htm', 'index.php?area=games', NOW()),
                ('BetaSupport/support.htm', 'index.php?area=support', NOW()),
                ('Faq/FAQ.htm', 'index.php?area=beta1faq', NOW()),
                ('marketing/', 'steam/marketing/', NOW()),
                ('steamid_instructions.html', 'index.php?area=steamid_instructions', NOW()),
                ('autoupdate/', 'index.php?area=autoupdate', NOW()),
                ('v/', '/', NOW()),
                ('v2/', '/', NOW()),
                ('v3/', '/', NOW()),
                ('marketing/css_preload/', 'Marketing.php?t=css_preload', NOW()),
                ('marketing/hl2_preload/', 'Marketing.php?t=hl2_preload', NOW()),
                ('marketing/hl2_preload2/', 'Marketing.php?t=hl2_preload2', NOW()),
                ('marketing/cz_pricechange/', 'Marketing.php?t=cz_pricechange', NOW()),
                -- Marketing page redirects to dynamic PHP endpoint
                ('steam/marketing/64bit/', '/steam/marketing/index.php?page=64bit', NOW()),
                ('steam/marketing/April1.2005/', '/steam/marketing/index.php?page=April1.2005', NOW()),
                ('steam/marketing/April14.2006/', '/steam/marketing/index.php?page=April14.2006', NOW()),
                ('steam/marketing/April15.2005/', '/steam/marketing/index.php?page=April15.2005', NOW()),
                ('steam/marketing/April21.2006/', '/steam/marketing/index.php?page=April21.2006', NOW()),
                ('steam/marketing/April22.2005/', '/steam/marketing/index.php?page=April22.2005', NOW()),
                ('steam/marketing/April28.2006/', '/steam/marketing/index.php?page=April28.2006', NOW()),
                ('steam/marketing/April29.2005/', '/steam/marketing/index.php?page=April29.2005', NOW()),
                ('steam/marketing/April7.2006/', '/steam/marketing/index.php?page=April7.2006', NOW()),
                ('steam/marketing/April8.2005/', '/steam/marketing/index.php?page=April8.2005', NOW()),
                ('steam/marketing/August12.2005/', '/steam/marketing/index.php?page=August12.2005', NOW()),
                ('steam/marketing/August19.2005/', '/steam/marketing/index.php?page=August19.2005', NOW()),
                ('steam/marketing/August26.2005/', '/steam/marketing/index.php?page=August26.2005', NOW()),
                ('steam/marketing/August5.2005/', '/steam/marketing/index.php?page=August5.2005', NOW()),
                ('steam/marketing/buy_hl2_1/', '/steam/marketing/index.php?page=buy_hl2_1', NOW()),
                ('steam/marketing/buy_hl2_2/', '/steam/marketing/index.php?page=buy_hl2_2', NOW()),
                ('steam/marketing/buy_hl2_3/', '/steam/marketing/index.php?page=buy_hl2_3', NOW()),
                ('steam/marketing/Darwinia_02_prepurchase/', '/steam/marketing/index.php?page=Darwinia_02_prepurchase', NOW()),
                ('steam/marketing/December16.2005/', '/steam/marketing/index.php?page=December16.2005', NOW()),
                ('steam/marketing/December2.2005/', '/steam/marketing/index.php?page=December2.2005', NOW()),
                ('steam/marketing/December23.2005/', '/steam/marketing/index.php?page=December23.2005', NOW()),
                ('steam/marketing/December9.2005/', '/steam/marketing/index.php?page=December9.2005', NOW()),
                ('steam/marketing/demo_released/', '/steam/marketing/index.php?page=demo_released', NOW()),
                ('steam/marketing/DODS_preload1/', '/steam/marketing/index.php?page=DODS_preload1', NOW()),
                ('steam/marketing/DODS_preload2/', '/steam/marketing/index.php?page=DODS_preload2', NOW()),
                ('steam/marketing/Feb11.2005/', '/steam/marketing/index.php?page=Feb11.2005', NOW()),
                ('steam/marketing/Feb17.2005/', '/steam/marketing/index.php?page=Feb17.2005', NOW()),
                ('steam/marketing/Feb23.2005/', '/steam/marketing/index.php?page=Feb23.2005', NOW()),
                ('steam/marketing/Feb3.2006/', '/steam/marketing/index.php?page=Feb3.2006', NOW()),
                ('steam/marketing/Feb4.2005/', '/steam/marketing/index.php?page=Feb4.2005', NOW()),
                ('steam/marketing/February10.2006/', '/steam/marketing/index.php?page=February10.2006', NOW()),
                ('steam/marketing/February17.2006/', '/steam/marketing/index.php?page=February17.2006', NOW()),
                ('steam/marketing/February24.2006/', '/steam/marketing/index.php?page=February24.2006', NOW()),
                ('steam/marketing/HL2DM/', '/steam/marketing/index.php?page=HL2DM', NOW()),
                ('steam/marketing/HL2LC_PlayItNow/', '/steam/marketing/index.php?page=HL2LC_PlayItNow', NOW()),
                ('steam/marketing/Jan15.2005/', '/steam/marketing/index.php?page=Jan15.2005', NOW()),
                ('steam/marketing/Jan19.2005/', '/steam/marketing/index.php?page=Jan19.2005', NOW()),
                ('steam/marketing/Jan26.2005/', '/steam/marketing/index.php?page=Jan26.2005', NOW()),
                ('steam/marketing/January13.2006/', '/steam/marketing/index.php?page=January13.2006', NOW()),
                ('steam/marketing/January20.2006/', '/steam/marketing/index.php?page=January20.2006', NOW()),
                ('steam/marketing/January27.2006/', '/steam/marketing/index.php?page=January27.2006', NOW()),
                ('steam/marketing/January6.2006/', '/steam/marketing/index.php?page=January6.2006', NOW()),
                ('steam/marketing/July1.2005/', '/steam/marketing/index.php?page=July1.2005', NOW()),
                ('steam/marketing/July15.2005/', '/steam/marketing/index.php?page=July15.2005', NOW()),
                ('steam/marketing/July22.2005/', '/steam/marketing/index.php?page=July22.2005', NOW()),
                ('steam/marketing/July29.2005/', '/steam/marketing/index.php?page=July29.2005', NOW()),
                ('steam/marketing/June10.2005/', '/steam/marketing/index.php?page=June10.2005', NOW()),
                ('steam/marketing/June17.2005/', '/steam/marketing/index.php?page=June17.2005', NOW()),
                ('steam/marketing/June24.2005/', '/steam/marketing/index.php?page=June24.2005', NOW()),
                ('steam/marketing/June3.2005/', '/steam/marketing/index.php?page=June3.2005', NOW()),
                ('steam/marketing/Mar10.2005/', '/steam/marketing/index.php?page=Mar10.2005', NOW()),
                ('steam/marketing/Mar18.2005/', '/steam/marketing/index.php?page=Mar18.2005', NOW()),
                ('steam/marketing/Mar2.2005/', '/steam/marketing/index.php?page=Mar2.2005', NOW()),
                ('steam/marketing/Mar25.2005/', '/steam/marketing/index.php?page=Mar25.2005', NOW()),
                ('steam/marketing/March03.2006/', '/steam/marketing/index.php?page=March03.2006', NOW()),
                ('steam/marketing/March10.2006/', '/steam/marketing/index.php?page=March10.2006', NOW()),
                ('steam/marketing/March17.2006/', '/steam/marketing/index.php?page=March17.2006', NOW()),
                ('steam/marketing/March24.2006/', '/steam/marketing/index.php?page=March24.2006', NOW()),
                ('steam/marketing/March31.2006/', '/steam/marketing/index.php?page=March31.2006', NOW()),
                ('steam/marketing/May12.2005/', '/steam/marketing/index.php?page=May12.2005', NOW()),
                ('steam/marketing/May20.2005/', '/steam/marketing/index.php?page=May20.2005', NOW()),
                ('steam/marketing/May25.2006/', '/steam/marketing/index.php?page=May25.2006', NOW()),
                ('steam/marketing/May27.2005/', '/steam/marketing/index.php?page=May27.2005', NOW()),
                ('steam/marketing/May6.2005/', '/steam/marketing/index.php?page=May6.2005', NOW()),
                ('steam/marketing/November11.2005/', '/steam/marketing/index.php?page=November11.2005', NOW()),
                ('steam/marketing/November18.2005/', '/steam/marketing/index.php?page=November18.2005', NOW()),
                ('steam/marketing/November23.2005/', '/steam/marketing/index.php?page=November23.2005', NOW()),
                ('steam/marketing/November4.2005/', '/steam/marketing/index.php?page=November4.2005', NOW()),
                ('steam/marketing/now_playing/', '/steam/marketing/index.php?page=now_playing', NOW()),
                ('steam/marketing/October11.2005/', '/steam/marketing/index.php?page=October11.2005', NOW()),
                ('steam/marketing/October14.2005/', '/steam/marketing/index.php?page=October14.2005', NOW()),
                ('steam/marketing/October21.2005/', '/steam/marketing/index.php?page=October21.2005', NOW()),
                ('steam/marketing/October28.2005/', '/steam/marketing/index.php?page=October28.2005', NOW()),
                ('steam/marketing/RDKF_Preload/', '/steam/marketing/index.php?page=RDKF_Preload', NOW()),
                ('steam/marketing/September16.2005/', '/steam/marketing/index.php?page=September16.2005', NOW()),
                ('steam/marketing/September2.2005/', '/steam/marketing/index.php?page=September2.2005', NOW()),
                ('steam/marketing/September23.2005/', '/steam/marketing/index.php?page=September23.2005', NOW()),
                ('steam/marketing/September9.2005/', '/steam/marketing/index.php?page=September9.2005', NOW()),
                ('steam/marketing/valve_store01/', '/steam/marketing/index.php?page=valve_store01', NOW()),
                -- Case-insensitive Steam Marketing redirects
                ('Steam/Marketing/', 'steam/marketing/', NOW()),
                ('STEAM/MARKETING/', 'steam/marketing/', NOW()),
                ('Steam/marketing/', 'steam/marketing/', NOW()),
                ('steam/Marketing/', 'steam/marketing/', NOW())
            ");
            $pdo->exec("
                DROP TABLE IF EXISTS random_content;
                DROP TABLE IF EXISTS random_groups;
            
                CREATE TABLE random_groups (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) UNIQUE NOT NULL
                );
            
                CREATE TABLE random_content (
                    uniqueid INT AUTO_INCREMENT PRIMARY KEY,
                    tag_name VARCHAR(64) NOT NULL,
                    content TEXT NOT NULL,
                    group_id INT NOT NULL,
                    FOREIGN KEY (group_id) REFERENCES random_groups(id) ON DELETE CASCADE
                );
            ");

            $pdo->exec('INSERT INTO random_groups (name) VALUES ("0304_character_image")');
            $groupId = (int)$pdo->lastInsertId();
            $stmt    = $pdo->prepare('INSERT INTO random_content(tag_name, content, group_id) VALUES (?,?,?)');
            $stmt->execute([
                '0304_character_image_gordon',
                '<div class="content" id="container" style="background-image:url(images/gordon.gif); background-position:top right; background-repeat:no-repeat;">',
                $groupId
            ]);
            $stmt->execute([
                '0304_character_image_cz_guy',
                '<div class="content" id="container" style="background-image:url(images/cz_guy.gif); background-position:top right; background-repeat:no-repeat;">',
                $groupId
            ]);
            $stmt->execute([
                '0304_character_image_shieldguy',
                '<div class="content" id="container" style="background-image:url(images/shieldguy.gif); background-position:top right; background-repeat:no-repeat;">',
                $groupId
            ]);

            $pdo->exec("DROP TABLE IF EXISTS scheduled_content");
            $pdo->exec("CREATE TABLE scheduled_content(
                content_id INT AUTO_INCREMENT PRIMARY KEY,
                theme_name VARCHAR(64),
                description VARCHAR(255) NOT NULL,
                tag_name VARCHAR(25) NOT NULL,
                content TEXT NOT NULL,
                schedule_type ENUM('every_n_days','day_of_month','fixed_range') NOT NULL,
                every_n_days INT DEFAULT NULL,
                day_of_month TINYINT DEFAULT NULL,
                start_date DATE DEFAULT NULL,
                end_date DATE DEFAULT NULL,
                fixed_start_datetime DATETIME DEFAULT NULL,
                fixed_end_datetime DATETIME DEFAULT NULL,
                active BOOLEAN DEFAULT TRUE,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )");
            $pdo->exec("DROP TABLE IF EXISTS custom_titles");
            $pdo->exec("CREATE TABLE custom_titles(
                uniqueid INT AUTO_INCREMENT PRIMARY KEY,
                title_name VARCHAR(100) UNIQUE,
                themes VARCHAR(255),
                title_content TEXT NOT NULL
            )");
            $pdo->exec("DROP TABLE IF EXISTS settings");
            $pdo->exec("CREATE TABLE settings(`key` VARCHAR(64) PRIMARY KEY,value TEXT)");
            $pdo->exec("DROP TABLE IF EXISTS themes");
            $pdo->exec("CREATE TABLE themes(name VARCHAR(255) PRIMARY KEY, css_path TEXT DEFAULT NULL)");
            $pdo->exec("DROP TABLE IF EXISTS theme_settings");
            $pdo->exec("CREATE TABLE theme_settings(theme VARCHAR(50), name VARCHAR(50), value TEXT, PRIMARY KEY(theme,name))");
            $pdo->exec("DROP TABLE IF EXISTS theme_headers");
            $pdo->exec("CREATE TABLE theme_headers(
                id INT AUTO_INCREMENT PRIMARY KEY,
                theme VARCHAR(50),
                page VARCHAR(50) DEFAULT '',
                ord INT DEFAULT 0,
                logo TEXT,
                text TEXT,
                img TEXT,
                hover TEXT,
                depressed TEXT,
                url TEXT,
                visible TINYINT(1) DEFAULT 1,
                bold TINYINT(1) DEFAULT 0,
                spacer TEXT,
                INDEX(theme),
                INDEX(page)
            )");

            $pdo->exec("DROP TABLE IF EXISTS theme_footers");
              $pdo->exec("CREATE TABLE theme_footers(
                  theme VARCHAR(50) PRIMARY KEY,
                  html MEDIUMTEXT
              )");

              $pdo->exec("DROP TABLE IF EXISTS plugin_migrations");
              $pdo->exec("CREATE TABLE plugin_migrations(
                  id INT AUTO_INCREMENT PRIMARY KEY,
                  plugin_name VARCHAR(100) NOT NULL,
                  version VARCHAR(50) NOT NULL,
                  executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                  UNIQUE KEY plugin_version (plugin_name, version)
              )");
              $pdo->exec("DROP TABLE IF EXISTS plugin_settings");
              $pdo->exec("CREATE TABLE plugin_settings(
                  id INT AUTO_INCREMENT PRIMARY KEY,
                  plugin_name VARCHAR(100) NOT NULL,
                  setting_key VARCHAR(100) NOT NULL,
                  setting_value TEXT,
                  setting_type VARCHAR(20) DEFAULT 'string',
                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  UNIQUE KEY plugin_setting (plugin_name, setting_key)
              )");

              $pdo->exec("DROP TABLE IF EXISTS admin_users");
              $pdo->exec("DROP TABLE IF EXISTS player_sessions");
              $pdo->exec("CREATE TABLE player_sessions (
                  id            BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  user_id       BIGINT UNSIGNED NOT NULL,
                session_start DATETIME        NOT NULL,
                session_end   DATETIME        NOT NULL,
                INDEX(user_id, session_start)
            )");

            $pdo->exec("DROP TABLE IF EXISTS player_history");
            $pdo->exec("CREATE TABLE player_history (
                ts           TIMESTAMP PRIMARY KEY,
                players      INT UNSIGNED NOT NULL,
                game_servers INT UNSIGNED NOT NULL
            )");

            $pdo->exec("DROP TABLE IF EXISTS bw_history");
            $pdo->exec("CREATE TABLE bw_history (
                ts     TIMESTAMP PRIMARY KEY,
                mbps   INT UNSIGNED NOT NULL 
            )");

            $pdo->exec("DROP TABLE IF EXISTS admin_roles");
            $pdo->exec("CREATE TABLE admin_roles(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) UNIQUE,
                permissions TEXT
            )");

            $pdo->exec("CREATE TABLE admin_users(
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100),
                email TEXT,
                first_name TEXT,
                last_name TEXT,
                language VARCHAR(8) DEFAULT 'en',
                permissions TEXT,
                role_id INT DEFAULT NULL,
                created DATETIME,
                password VARCHAR(255),
                FOREIGN KEY (role_id) REFERENCES admin_roles(id)
            )");
            $pdo->exec("DROP TABLE IF EXISTS admin_tokens");
            $pdo->exec("CREATE TABLE admin_tokens(
                token_hash VARCHAR(64) PRIMARY KEY,
                user_id INT,
                expires DATETIME,
                FOREIGN KEY (user_id) REFERENCES admin_users(id) ON DELETE CASCADE
            )");
            $pdo->exec("DROP TABLE IF EXISTS admin_logs");
            $pdo->exec("CREATE TABLE admin_logs(
                id INT AUTO_INCREMENT PRIMARY KEY,
                user INT,
                action TEXT,
                ts DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user) REFERENCES admin_users(id) ON DELETE SET NULL
            )");
            $pdo->exec("DROP TABLE IF EXISTS notifications");
            $pdo->exec("CREATE TABLE notifications(
                id INT AUTO_INCREMENT PRIMARY KEY,
                admin_id INT DEFAULT 0,
                type VARCHAR(50) NOT NULL,
                message TEXT NOT NULL,
                data JSON NULL,
                is_read TINYINT(1) DEFAULT 0,
                created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            $pdo->exec("DROP TABLE IF EXISTS page_views");
            $pdo->exec("CREATE TABLE page_views(
                date DATE,
                page VARCHAR(255),
                views INT DEFAULT 0,
                PRIMARY KEY(date,page)
            )");
            $pdo->exec("DROP TABLE IF EXISTS help_texts");
            $pdo->exec("CREATE TABLE help_texts(
                page VARCHAR(64),
                field VARCHAR(64),
                content TEXT,
                PRIMARY KEY(page,field)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
            $pdo->exec("DROP TABLE IF EXISTS error_logs");
            $pdo->exec("CREATE TABLE error_logs(
                id INT AUTO_INCREMENT PRIMARY KEY,
                level VARCHAR(20),
                message TEXT,
                file TEXT,
                line INT,
                created DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
            $pdo->exec("DROP TABLE IF EXISTS survey_entries");
            $pdo->exec("DROP TABLE IF EXISTS survey_categories");
            $pdo->exec("DROP TABLE IF EXISTS survey_info");
            $pdo->exec("CREATE TABLE survey_info(
                id INT AUTO_INCREMENT PRIMARY KEY,
                unique_samples INT,
                start_date DATETIME,
                last_updated DATETIME
            )");
            $pdo->exec("CREATE TABLE survey_categories(
                id INT AUTO_INCREMENT PRIMARY KEY,
                slug VARCHAR(100) UNIQUE,
                title VARCHAR(255),
                ord INT DEFAULT 0
            );
CREATE TABLE IF NOT EXISTS map_contest_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    full_name VARCHAR(255) NOT NULL,
    address VARCHAR(255) DEFAULT NULL,
    city VARCHAR(100) DEFAULT NULL,
    state VARCHAR(100) DEFAULT NULL,
    country VARCHAR(100) DEFAULT NULL,
    zip VARCHAR(20) DEFAULT NULL,
    dob VARCHAR(20) DEFAULT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    email VARCHAR(255) NOT NULL,
    group_name VARCHAR(255) DEFAULT NULL,
    group_member1 VARCHAR(255) DEFAULT NULL,
    group_member2 VARCHAR(255) DEFAULT NULL,
    group_member3 VARCHAR(255) DEFAULT NULL,
    group_member4 VARCHAR(255) DEFAULT NULL,
    map_name VARCHAR(255) DEFAULT NULL,
    map_file VARCHAR(255) DEFAULT NULL,
    source_files VARCHAR(255) DEFAULT NULL,
    map_description TEXT,
    recommended_players VARCHAR(50) DEFAULT NULL,
    game_mode VARCHAR(50) DEFAULT NULL,
    development_time VARCHAR(50) DEFAULT NULL,
    tools VARCHAR(255) DEFAULT NULL,
    inspiration TEXT,
    screenshot1 VARCHAR(255) DEFAULT NULL,
    screenshot2 VARCHAR(255) DEFAULT NULL,
    screenshot3 VARCHAR(255) DEFAULT NULL,
    previous_experience TEXT,
    additional_comments TEXT,
    how_did_you_hear VARCHAR(255) DEFAULT NULL,
    original_work TINYINT(1) DEFAULT 0,
    agree_rules TINYINT(1) DEFAULT 0,
    agree_license TINYINT(1) DEFAULT 0,
    confirm_age TINYINT(1) DEFAULT 0,
    UNIQUE KEY uniq_name_email (full_name,email)
);

");
            $pdo->exec("CREATE TABLE survey_entries(
                id INT AUTO_INCREMENT PRIMARY KEY,
                category_id INT NOT NULL,
                label VARCHAR(255),
                percentage DECIMAL(5,2),
                count INT,
                ord INT DEFAULT 0,
                FOREIGN KEY (category_id) REFERENCES survey_categories(id) ON DELETE CASCADE
            );
DROP TABLE IF EXISTS store_categories;
DROP TABLE IF EXISTS store_developers;
DROP TABLE IF EXISTS store_apps;
DROP TABLE IF EXISTS subscriptions;
DROP TABLE IF EXISTS subscription_apps;
DROP TABLE IF EXISTS app_categories;
DROP TABLE IF EXISTS store_screenshots;
DROP TABLE IF EXISTS store_sidebar_links;
DROP TABLE IF EXISTS store_capsules;
DROP TABLE IF EXISTS storefront_capsules_all;
DROP TABLE IF EXISTS storefront_capsules_per_theme;
DROP TABLE IF EXISTS storefront_capsule_items;
DROP TABLE IF EXISTS multicapsule;
DROP TABLE IF EXISTS storefront_tabs;
DROP TABLE IF EXISTS storefront_tab_games;
DROP TABLE IF EXISTS store_pages;

CREATE TABLE store_categories(id INT PRIMARY KEY,name TEXT,ord INT,visible TINYINT DEFAULT 1);
CREATE TABLE store_developers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    website_url VARCHAR(255),
    description TEXT,
    logo_image VARCHAR(255)
);
CREATE TABLE store_apps(
    appid INT PRIMARY KEY,
    name TEXT,
    developer TEXT,
    availability TEXT,
    price DECIMAL(10,2),
    metacritic TEXT DEFAULT NULL,
    metacritic_url TEXT,
    description TEXT,
    sysreq TEXT,
    sysreq_min TEXT,
    sysreq_rec TEXT,
    trailer_url TEXT,
    hide_trailer TINYINT DEFAULT 0,
    main_image TEXT,
    images TEXT,
    show_metascore TINYINT DEFAULT 0,
    is_preload TINYINT DEFAULT 0,
    preload_start DATE DEFAULT NULL,
    preload_end DATE DEFAULT NULL,
    release_state ENUM('released', 'prerelease', 'coming_soon') NOT NULL DEFAULT 'released',
    release_date DATETIME NULL,
    preorder_available TINYINT(1) NOT NULL DEFAULT 0,
    preload_available TINYINT(1) NOT NULL DEFAULT 0,
    preorder_bonus_text TEXT
);
CREATE INDEX idx_storefront_products_appid ON store_apps(appid);
CREATE TABLE subscriptions(subid INT PRIMARY KEY,name TEXT,price DECIMAL(10,2));
CREATE TABLE subscription_apps(subid INT,appid INT,PRIMARY KEY(subid,appid));
CREATE TABLE app_categories(appid INT,category_id INT,PRIMARY KEY(appid,category_id));
CREATE TABLE store_screenshots(
    id INT AUTO_INCREMENT PRIMARY KEY,
    appid INT,
    filename TEXT,
    hidden TINYINT DEFAULT 0,
    ord INT,
    CONSTRAINT fk_store_screenshots_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE
);
CREATE TABLE store_sidebar_links(
    id INT AUTO_INCREMENT PRIMARY KEY,
    label TEXT,
    url TEXT,
    type VARCHAR(10) DEFAULT 'link',
    ord INT,
    visible TINYINT DEFAULT 1
);
CREATE TABLE store_capsules(position VARCHAR(20) PRIMARY KEY, image TEXT, appid INT);
CREATE TABLE storefront_capsules_all(position VARCHAR(20) PRIMARY KEY, size VARCHAR(10), image_path TEXT, appid INT, price DECIMAL(10,2), hidden TINYINT DEFAULT 0);
CREATE TABLE storefront_capsules_per_theme(
    theme VARCHAR(20),
    ord INT,
    size VARCHAR(10),
    image_path TEXT,
    appid INT,
    price DECIMAL(10,2),
    hidden TINYINT DEFAULT 0,
    title TEXT,
    content TEXT,
    PRIMARY KEY(theme, ord)
);
CREATE TABLE storefront_capsule_items(
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(20),
    type VARCHAR(10),
    appid INT,
    image_path TEXT,
    price DECIMAL(10,2),
    title TEXT,
    content TEXT,
    ord INT
);
ALTER TABLE storefront_capsule_items
    ADD CONSTRAINT fk_storefront_capsule_items_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;
CREATE TABLE multicapsule(
    id INT AUTO_INCREMENT PRIMARY KEY,
    `group` VARCHAR(100) NOT NULL,
    `order` INT NOT NULL DEFAULT 0,
    appid INT,
    image_path VARCHAR(255),
    price DECIMAL(10,2),
    INDEX idx_group (`group`),
    INDEX idx_group_order (`group`, `order`),
    FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE
);
CREATE TABLE storefront_tabs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(20),
    title TEXT,
    ord INT
);
CREATE TABLE marketing (
    msgtype VARCHAR(50) NOT NULL,
    language VARCHAR(30) NOT NULL,
    content TEXT NOT NULL,
    PRIMARY KEY (msgtype, language)
);
CREATE TABLE storefront_tab_games(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tab_id INT,
    appid INT,
    image_path TEXT,
    ord INT
);
CREATE TABLE tabbed_capsules(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tab_name VARCHAR(255) NOT NULL,
    tab_order INT NOT NULL DEFAULT 0,
    active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_order (tab_order)
);
CREATE TABLE tabbed_capsule_games(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tab_id INT NOT NULL,
    appid INT NOT NULL,
    game_order INT NOT NULL DEFAULT 0,
    image_path VARCHAR(255),
    custom_name VARCHAR(255),
    custom_price DECIMAL(10,2),
    release_date DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tab_id) REFERENCES tabbed_capsules(id) ON DELETE CASCADE,
    FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE,
    INDEX idx_tab_order (tab_id, game_order)
);
CREATE TABLE single_large_capsule(
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(50) NOT NULL,
    appid INT DEFAULT NULL,
    image_path VARCHAR(255) NOT NULL DEFAULT '',
    description TEXT,
    url VARCHAR(255) NOT NULL DEFAULT '',
    `order` INT NOT NULL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_theme (theme),
    INDEX idx_theme_order (theme, `order`),
    FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE SET NULL
);
CREATE TABLE game_stats (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    game_name VARCHAR(255) NOT NULL,
    game_website VARCHAR(255) DEFAULT NULL,
    current_players INT UNSIGNED NOT NULL DEFAULT 0,
    current_servers INT UNSIGNED NOT NULL DEFAULT 0,
    player_minutes_per_month BIGINT UNSIGNED NOT NULL DEFAULT 0,
    display_order INT UNSIGNED NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_game_stats_name (game_name)
);
CREATE TABLE store_pages(
    slug VARCHAR(20) PRIMARY KEY,
    title TEXT,
    title_image TEXT
);

-- Content overlays for product headers
CREATE TABLE product_content_overlays (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appid INT NOT NULL,
    title VARCHAR(255) NOT NULL DEFAULT '',
    content TEXT,
    start_date DATETIME NULL,
    end_date DATETIME NULL,
    active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_appid (appid),
    INDEX idx_active (active),
    INDEX idx_dates (start_date, end_date)
);

-- Discounts for packages/products
CREATE TABLE product_discounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appid INT NULL,
    package_id INT NULL,
    discount_type ENUM('percentage', 'fixed_amount') NOT NULL DEFAULT 'percentage',
    discount_value DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    discount_label VARCHAR(255) NOT NULL DEFAULT 'Discount',
    start_date DATETIME NULL,
    end_date DATETIME NULL,
    active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_appid (appid),
    INDEX idx_package_id (package_id),
    INDEX idx_active (active),
    INDEX idx_dates (start_date, end_date)
);

CREATE TABLE download_files(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description MEDIUMTEXT,
    file_size VARCHAR(50),
    main_url TEXT,
    visibleontheme VARCHAR(64) DEFAULT NULL,
    usingbutton TINYINT(1) NOT NULL DEFAULT 0,
    buttonText VARCHAR(64) NOT NULL DEFAULT '',
    created DATETIME,
    updated DATETIME,
    sort_order INT DEFAULT 0
);
CREATE TABLE download_file_mirrors(
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_id INT NOT NULL,
    host VARCHAR(255) DEFAULT NULL,
    url TEXT,
    ord INT DEFAULT 0,
    FOREIGN KEY(file_id) REFERENCES download_files(id) ON DELETE CASCADE
);
CREATE TABLE download_file_versions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_id INT NOT NULL,
    theme VARCHAR(32) NOT NULL,
    page_version VARCHAR(32) NOT NULL,
    is_visible TINYINT(1) DEFAULT 1,
    render_type ENUM(
        'title_size_mirrors_buttons',
        'title_size_mirrors_links',
        'title_no_size_mirrors_links',
        'mirrors_buttons_no_title',
        'single_button',
        'single_link',
        'title_single_link_with_size',
        'floating_box_single_link',
        'floating_box_title_mirrors_links'
    ) DEFAULT 'title_size_mirrors_buttons',
    location VARCHAR(32) DEFAULT 'main_content',
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_file_theme_version (file_id, theme, page_version),
    INDEX idx_theme_version (theme, page_version),
    INDEX idx_visible_sort (is_visible, sort_order),
    FOREIGN KEY (file_id) REFERENCES download_files(id) ON DELETE CASCADE
);
CREATE TABLE tournaments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    submission_reference CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    organizer_name VARCHAR(255) DEFAULT NULL,
    organizer_first_name VARCHAR(100) DEFAULT NULL,
    organizer_last_name VARCHAR(100) DEFAULT NULL,
    organizer_company VARCHAR(255) DEFAULT NULL,
    organizer_type VARCHAR(100) DEFAULT NULL,
    organizer_is_cafe TINYINT(1) NOT NULL DEFAULT 0,
    organizer_email VARCHAR(255) NOT NULL,
    organizer_phone VARCHAR(50) DEFAULT NULL,
    organizer_fax VARCHAR(50) DEFAULT NULL,
    organizer_address1 VARCHAR(255) DEFAULT NULL,
    organizer_address2 VARCHAR(255) DEFAULT NULL,
    organizer_city VARCHAR(120) DEFAULT NULL,
    organizer_state VARCHAR(120) DEFAULT NULL,
    organizer_postal_code VARCHAR(32) DEFAULT NULL,
    organizer_country VARCHAR(120) DEFAULT NULL,
    venue_name VARCHAR(255) DEFAULT NULL,
    venue_address1 VARCHAR(255) DEFAULT NULL,
    venue_address2 VARCHAR(255) DEFAULT NULL,
    venue_city VARCHAR(120) DEFAULT NULL,
    venue_state VARCHAR(120) DEFAULT NULL,
    venue_postal_code VARCHAR(32) DEFAULT NULL,
    venue_country VARCHAR(120) DEFAULT NULL,
    is_online_only TINYINT(1) NOT NULL DEFAULT 0,
    event_website VARCHAR(255) DEFAULT NULL,
    event_email VARCHAR(255) DEFAULT NULL,
    lan_or_online ENUM('lan','online','both') DEFAULT NULL,
    expected_participants INT DEFAULT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    start_time TIME DEFAULT NULL,
    end_time TIME DEFAULT NULL,
    timezone VARCHAR(64) DEFAULT NULL,
    requested_calendar_listing TINYINT(1) NOT NULL DEFAULT 0,
    show_on_calendar TINYINT(1) NOT NULL DEFAULT 0,
    show_on_sidebar TINYINT(1) NOT NULL DEFAULT 0,
    show_on_landing TINYINT(1) NOT NULL DEFAULT 0,
    temporary_accounts_requested TINYINT(1) NOT NULL DEFAULT 0,
    temporary_accounts_quantity INT DEFAULT NULL,
    description MEDIUMTEXT,
    game_list_summary TEXT,
    registration_notes TEXT,
    status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
    moderator_notes MEDIUMTEXT,
    status_reason TEXT,
    status_changed_at DATETIME DEFAULT NULL,
    status_changed_by INT DEFAULT NULL,
    approved_at DATETIME DEFAULT NULL,
    rejected_at DATETIME DEFAULT NULL,
    confirmation_sent_at DATETIME DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_tournaments_status (status),
    INDEX idx_tournaments_start_date (start_date),
    INDEX idx_tournaments_calendar (show_on_calendar, start_date),
    INDEX idx_tournaments_sidebar (show_on_sidebar, start_date),
    UNIQUE KEY uniq_tournaments_reference (submission_reference)
);

CREATE TABLE tournament_registration_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(32) NOT NULL,
    label VARCHAR(120) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    active TINYINT(1) NOT NULL DEFAULT 1,
    UNIQUE KEY uniq_tournament_registration_slug (slug)
);

CREATE TABLE tournament_registration_selection (
    tournament_id INT NOT NULL,
    option_id INT NOT NULL,
    PRIMARY KEY (tournament_id, option_id),
    FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
    FOREIGN KEY (option_id) REFERENCES tournament_registration_options(id) ON DELETE CASCADE
);

CREATE TABLE tournament_games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(32) NOT NULL,
    label VARCHAR(150) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    active TINYINT(1) NOT NULL DEFAULT 1,
    UNIQUE KEY uniq_tournament_game_slug (slug)
);

CREATE TABLE tournament_game_selection (
    tournament_id INT NOT NULL,
    game_id INT NOT NULL,
    PRIMARY KEY (tournament_id, game_id),
    FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
    FOREIGN KEY (game_id) REFERENCES tournament_games(id) ON DELETE CASCADE
);

CREATE TABLE tournament_content_blocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_slug VARCHAR(64) NOT NULL,
    theme VARCHAR(64) NOT NULL,
    block_key VARCHAR(64) NOT NULL,
    block_label VARCHAR(255) NOT NULL,
    content MEDIUMTEXT NOT NULL,
    position INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_tournament_content_block (page_slug, theme, block_key)
);

CREATE TABLE tournament_audit_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tournament_id INT NOT NULL,
    admin_id INT DEFAULT NULL,
    action VARCHAR(64) NOT NULL,
    notes TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE SET NULL
);

INSERT INTO tournament_registration_options (slug, label, sort_order)
VALUES
    ('email', 'Email-In Registration', 1),
    ('walk-in', 'Walk-In Registration', 2),
    ('web', 'Web Registration', 3)
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order), active = 1;

INSERT INTO tournament_games (slug, label, sort_order)
VALUES
    ('all', 'All Games', 1),
    ('cs', 'Counter-Strike', 2),
    ('css', 'Counter-Strike: Source', 3),
    ('cscz', 'Counter-Strike: Condition Zero', 4),
    ('dod', 'Day of Defeat', 5),
    ('dods', 'Day of Defeat: Source', 6),
    ('dmc', 'Deathmatch Classic', 7),
    ('hl', 'Half-Life', 8),
    ('hldm', 'Half-Life Deathmatch', 9),
    ('hl2', 'Half-Life 2', 10),
    ('hl2dm', 'Half-Life 2 Deathmatch', 11),
    ('hls', 'Half-Life: Source', 12),
    ('rico', 'Ricochet', 13),
    ('tfc', 'Team Fortress Classic', 14)
ON DUPLICATE KEY UPDATE label = VALUES(label), sort_order = VALUES(sort_order), active = 1;
-- Index already created inline in news table (line ~225)
-- Removed duplicate: CREATE INDEX idx_news_publish_date ON news(publish_date);

ALTER TABLE admin_users
    ADD CONSTRAINT fk_admin_users_role FOREIGN KEY (role_id) REFERENCES admin_roles(id);

ALTER TABLE admin_tokens
    ADD CONSTRAINT fk_admin_tokens_user FOREIGN KEY (user_id) REFERENCES admin_users(id) ON DELETE CASCADE;

ALTER TABLE admin_logs
    ADD CONSTRAINT fk_admin_logs_user FOREIGN KEY (user) REFERENCES admin_users(id) ON DELETE SET NULL;

ALTER TABLE tournaments
    ADD CONSTRAINT fk_tournaments_status_admin FOREIGN KEY (status_changed_by) REFERENCES admin_users(id) ON DELETE SET NULL;

ALTER TABLE subscription_apps
    ADD CONSTRAINT fk_subscription_apps_sub FOREIGN KEY (subid) REFERENCES subscriptions(subid) ON DELETE CASCADE,
    ADD CONSTRAINT fk_subscription_apps_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE app_categories
    ADD CONSTRAINT fk_app_categories_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE,
    ADD CONSTRAINT fk_app_categories_cat FOREIGN KEY (category_id) REFERENCES store_categories(id) ON DELETE CASCADE;

ALTER TABLE store_capsules
    ADD CONSTRAINT fk_store_capsules_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE storefront_capsules_all
    ADD CONSTRAINT fk_storefront_capsules_all_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE storefront_capsules_per_theme
    ADD CONSTRAINT fk_storefront_capsules_per_theme_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE storefront_tab_games
    ADD CONSTRAINT fk_storefront_tab_games_tab FOREIGN KEY (tab_id) REFERENCES storefront_tabs(id) ON DELETE CASCADE,
    ADD CONSTRAINT fk_storefront_tab_games_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE product_content_overlays
    ADD CONSTRAINT fk_product_content_overlays_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE product_discounts
    ADD CONSTRAINT fk_product_discounts_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE,
    ADD CONSTRAINT fk_product_discounts_package FOREIGN KEY (package_id) REFERENCES subscriptions(subid) ON DELETE CASCADE;

");
            // Migration SQL files are for upgrades only and are not executed during
            // a fresh installation.

            $storefrontFile = __DIR__.'/sql/install_storefront.sql';
            if (file_exists($storefrontFile)) {
                run_sql_file($pdo, $storefrontFile);
            }

            $sidebarFile = __DIR__.'/sql/install_sidebar_sections.sql';
            if (file_exists($sidebarFile)) {
                run_sql_file($pdo, $sidebarFile);
            }

            $sqlFiles = glob(__DIR__.'/sql/*.sql');
            sort($sqlFiles);

            // Separate files by type to ensure proper loading order
            // This prevents "table does not exist" errors by ensuring CREATE TABLE
            // statements are executed before INSERT INTO statements
            $schemaFiles = [];       // Files with only CREATE TABLE
            $mixedFiles = [];        // Files with both CREATE TABLE and INSERT INTO
            $dataOnlyFiles = [];     // Files with only INSERT INTO

            foreach ($sqlFiles as $file) {
                $base = basename($file);
                // Skip files that are already loaded separately
                if (in_array($base, [
                    'install_storefront.sql',
                    'install_official_survey_stats.sql',
                    'install_sidebar_sections.sql',
                    'fix_forum_style_parents.sql',
                    // The fix_* files below operate on phpbb_* tables which don't
                    // exist yet at this point — phpBB is installed later. They run
                    // after install_phpbb_forum() further down.
                    'fix_forum_categories.sql',
                    'fix_topic_views.sql',
                ], true)) {
                    continue;
                }

                // Performance optimization files are now IDEMPOTENT and safe to auto-load
                // They check for existing indexes/triggers/columns before creating
                // This ensures fresh installations get all optimizations automatically

                // Read and classify file by its SQL statement types
                $sql = file_get_contents($file);
                $hasCreate = stripos($sql, 'CREATE TABLE') !== false;
                // Check for both INSERT INTO and INSERT IGNORE INTO
                $hasInsert = (stripos($sql, 'INSERT INTO') !== false) || (stripos($sql, 'INSERT IGNORE') !== false);

                if ($hasCreate && !$hasInsert) {
                    // Pure schema file (CREATE TABLE only)
                    $schemaFiles[] = ['file' => $file, 'sql' => $sql];
                } elseif ($hasCreate && $hasInsert) {
                    // Mixed file (both CREATE and INSERT) - load after pure schema
                    $mixedFiles[] = ['file' => $file, 'sql' => $sql];
                } else {
                    // Data-only file (INSERT INTO only) - load last
                    $dataOnlyFiles[] = ['file' => $file, 'sql' => $sql];
                }
            }

            // Process in correct dependency order:
            // 1. Pure schema files (table definitions)
            // 2. Mixed files (tables + their data)
            // 3. Data-only files (data referencing previously created tables)
            foreach (array_merge($schemaFiles, $mixedFiles, $dataOnlyFiles) as $fileData) {
                $sql = $fileData['sql'];
                // Convert from detected encoding to UTF-8
                $sql = ensureUtf8Encoding($sql);
                // Preprocess SQL to normalize date formats
                $sql = normalizeSqlDates($sql);
                foreach (split_sql_statements($sql) as $stmt) {
                    $stmt = trim($stmt);
                    if ($stmt === '') {
                        continue;
                    }

                    if (stripos($stmt, 'INSERT INTO news') === 0) {
                        // The SQL file now contains complete INSERT statements with explicit
                        // column names (id, title, author, category, publish_date, publish_at,
                        // views, content, products, is_official, status, associated_appids)
                        // and ON DUPLICATE KEY UPDATE clauses. Execute directly.
                        $pdo->exec($stmt);
                        continue;
                    }

                    $pdo->exec($stmt);
                }
            }

            // dedupe news and clean escaped newlines
            $pdo->exec('DELETE n1 FROM news n1 JOIN news n2 ON n1.title = n2.title AND n1.publish_date = n2.publish_date AND n1.id > n2.id');
            $pdo->exec("UPDATE news SET content = REPLACE(content, '\\n', '')");

            require_once 'sql/install_custom_pages.php';
            require_once 'sql/install_support_page.php';
            require_once 'sql/install_troubleshooter.php';
            require_once 'sql/install_download_pages.php';
            require_once 'sql/install_download_files.php';
            require_once 'sql/install_game_stats.php';
            require_once 'sql/install_single_large_capsule.php';
            require_once 'sql/install_legacy_forms.php';
            require_once 'sql/install_cafe_directory_names.php';
            if (!empty($_POST['use_official_survey'])) {
                run_sql_file($pdo, __DIR__.'/sql/install_official_survey_stats.sql');
            }
            // use first inserted content server as default network target
            try {
                $res = $pdo->query("SELECT ip,port FROM content_servers ORDER BY id ASC LIMIT 1");
                $server = $res ? $res->fetch(PDO::FETCH_ASSOC) : false;
                if ($server) {
                    $stmt = $pdo->prepare('INSERT INTO settings(`key`,value) VALUES(?,?)');
                    $stmt->execute(['main_network_ip',$server['ip']]);
                    $stmt->execute(['main_network_port',$server['port']]);
                }
            } catch (PDOException $e) {
                // table might not exist; ignore
            }
            $hash = password_hash($admin_pass, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare(
                'INSERT INTO admin_users(username,email,first_name,last_name,language,permissions,role_id,created,password) '
                . 'VALUES(?,?,?,?,?,?,?,NOW(),?)'
            );
            $stmt->execute([
                $admin_user,
                $admin_email,
                '',
                '',
                'en',
                '',
                1,
                $hash
            ]);
            // default settings
            $footer = <<<'HTML'
© 2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="index.php?area=privacy">Privacy Policy</a>. <a href="index.php?area=legal">Legal</a>. <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>.
HTML;
            $error_html = <<<'HTML'
            <!-- invalid_area -->
            
            <div class="content" id="container">
            <h1>INVALID AREA</H1>
            <h2>PERHAPS  <em>YOU MISTYPED?</em></h2><img src="Graphic_box.jpg" height="6" width="24" alt=""><br>
            <div class="narrower">
            <br>
            Please select an option from the top menu.
            
            </div>
            </div>
            HTML;
            $header_buttons = [
                ['url' => 'index.php?area=news',          'text' => 'news'],
                ['url' => 'index.php?area=getsteamnow',   'text' => 'getSteamNow'],
                ['url' => 'index.php?area=cybercafes',    'text' => 'Cyber Cafes'],
                ['url' => '/support.php','text' => 'Support'],
                ['url' => '/forums.php','text' => 'Forums'],
                //['url' => '/status/status.html','text' => 'Status']
                ['url' => 'index.php?area=status','text' => 'Status']
            ];
            $default_nav = [
                ['file' => 'index.php','label' => 'Dashboard','visible' => 1,'icon' => '📊'],
                ['file' => 'main_content.php','label' => 'Main Content','visible' => 1,'icon' => '📝'],
                ['file' => 'news.php','label' => 'News','visible' => 1,'icon' => '📰'],
                ['file' => 'map_contest_submissions.php','label' => 'Map Contest Submissions','visible' => 1,'icon' => '🗺️'],
                ['file' => 'cafe_management','label' => 'Cafe Management','visible' => 1,'icon' => '☕'],
                ['file' => 'cafe_signups.php','label' => 'Cafe Signup Requests','visible' => 1, 'parent' => 'cafe_management','icon' => '☕'],
                ['file' => 'cafe_directory.php','label' => 'Cafe Directory','visible' => 1, 'parent' => 'cafe_management','icon' => '📑'],
                ['file' => 'cafe_pricing.php','label' => 'Cafe Pricing','visible' => 1, 'parent' => 'cafe_management','icon' => '💲'],
                ['file' => 'cafe_representatives.php','label' => 'Cafe Representatives','visible' => 1, 'parent' => 'cafe_management','icon' => '🤝'],
                ['file' => 'tournaments.php','label' => 'Tournament Management','visible' => 1,'icon' => '🏆'],
                ['file' => 'media.php','label' => 'Media','visible' => 1,'icon' => ''],
                ['file' => 'support_faq','label' => 'Support & FAQ Management','visible' => 1,'icon' => '🛟'],
                ['file' => 'faq_management','label' => 'FAQ Management','visible' => 1, 'parent' => 'support_faq','icon' => '📚'],
                ['file' => 'faq.php','label' => 'FAQ','visible' => 1, 'parent' => 'faq_management','icon' => '❓'],
                ['file' => 'faq_categories.php','label' => 'FAQ Categories','visible' => 1, 'parent' => 'faq_management','icon' => '📂'],
                ['file' => 'support_page.php','label' => 'Support Page','visible' => 1, 'parent' => 'support_faq','icon' => '🛟'],
                ['file' => 'bug_reports.php','label' => 'Bug Reports','visible' => 1, 'parent' => 'support_faq','icon' => '🐛'],
                ['file' => 'troubleshooter','label' => 'Troubleshooter','visible' => 1, 'parent' => 'support_faq','icon' => '🆘'],
                ['file' => 'troubleshooter_manage.php','label' => 'Troubleshooter Management','visible' => 1, 'parent' => 'troubleshooter','icon' => '📝'],
                ['file' => 'troubleshooter_requests.php','label' => 'Requests Viewer','visible' => 1, 'parent' => 'troubleshooter','icon' => '📬'],
                ['file' => 'content_management','label' => 'Content Management','visible' => 1,'icon' => '🗃️'],
                ['file' => 'custom_pages.php','label' => 'Custom Pages','visible' => 1, 'parent' => 'content_management','icon' => '📄'],
                ['file' => 'error_page.php','label' => 'Error Page','visible' => 1, 'parent' => 'content_management','icon' => '❌'],
                ['file' => 'custom_titles.php','label' => 'Custom Titles','visible' => 1, 'parent' => 'content_management','icon' => '🔤'],
                ['file' => 'page_selection.php','label' => 'Page Version Management','visible' => 1, 'parent' => 'content_management','icon' => '📄'],
                ['file' => 'scheduled_content.php','label' => 'Scheduled Content','visible' => 1, 'parent' => 'content_management','icon' => '📅'],
                ['file' => 'random_content','label' => 'Random Content Management','visible' => 1, 'parent' => 'content_management','icon' => '🎲'],
                ['file' => 'random_content.php','label' => 'Random Content','visible' => 1, 'parent' => 'random_content','icon' => '🎲'],
                ['file' => 'random_groups.php','label' => 'Random Groups','visible' => 1, 'parent' => 'random_content','icon' => '📁'],
                ['file' => 'preload_marketing.php','label' => 'Preload Marketing Content','visible' => 1,'icon' => ''],
                ['file' => 'marketing_messages.php','label' => 'Marketing Messages','visible' => 1,'icon' => '📢'],
                ['file' => 'content_server_management','label' => 'Content Server Management','visible' => 1,'icon' => '🖥️'],
                ['file' => 'content_servers.php','label' => 'Servers','visible' => 1, 'parent' => 'content_server_management','icon' => '🖥️'],
                ['file' => 'contentserver_banners.php','label' => 'ContentServer Banner Management','visible' => 1, 'parent' => 'content_server_management','icon' => '🖼️'],
                ['file' => 'stats_management','label' => 'Stats Management','visible' => 1,'icon' => '📊'],
                ['file' => 'game_stats.php','label' => 'Game Stats','visible' => 1, 'parent' => 'stats_management','icon' => '🎮'],
                ['file' => 'survey_stats.php','label' => 'Survey Stats','visible' => 1, 'parent' => 'stats_management','icon' => '📈'],
                ['file' => 'update_history.php','label' => 'Update History Management','visible' => 1,'icon' => '📜'],
                ['file' => 'download_management','label' => 'Download Management','visible' => 1,'icon' => '📥'],
                ['file' => 'download_files.php','label' => 'File Management','visible' => 1, 'parent' => 'download_management','icon' => '⬇️'],
                ['file' => 'download_settings.php','label' => 'Download Settings','visible' => 1, 'parent' => 'download_management','icon' => '🛠️'],
                ['file' => 'cms_settings','label' => 'CMS Settings','visible' => 1,'icon' => '🛠️'],
                ['file' => 'activity_log.php','label' => 'Activity Log','visible' => 1, 'parent' => 'cms_settings','icon' => '📜'],
                ['file' => 'admin_users.php','label' => 'Administrators','visible' => 1, 'parent' => 'cms_settings','icon' => '👥'],
                ['file' => 'error_log.php','label' => 'Error Log','visible' => 1, 'parent' => 'cms_settings','icon' => '🐞'],
                ['file' => 'header_footer.php','label' => 'Header & Footer','visible' => 1, 'parent' => 'cms_settings','icon' => '📑'],
                ['file' => 'redirects.php','label' => 'Redirects','visible' => 1, 'parent' => 'cms_settings','icon' => '↪️'],
                ['file' => 'roles.php','label' => 'Roles','visible' => 1, 'parent' => 'cms_settings','icon' => '🔑'],
                ['file' => 'settings.php','label' => 'Settings','visible' => 1, 'parent' => 'cms_settings','icon' => '⚙️'],
                ['file' => 'theme.php','label' => 'Themes','visible' => 1, 'parent' => 'cms_settings','icon' => '🎨'],
                ['file' => 'storefront_management','label' => 'Storefront Management','visible' => 1,'icon' => '🏪'],
                ['file' => 'storefront','label' => 'Storefront','visible' => 1, 'parent' => 'storefront_management','icon' => '🏬'],
                ['file' => 'storefront_main.php','label' => 'Main Page','visible' => 1, 'parent' => 'storefront','icon' => '🖼️'],
                ['file' => 'storefront_products.php','label' => 'Products','visible' => 1, 'parent' => 'storefront','icon' => '🛒'],
                ['file' => 'storefront_categories.php','label' => 'Categories','visible' => 1, 'parent' => 'storefront','icon' => '📂'],
                ['file' => 'storefront_sidebar.php','label' => 'Sidebar','visible' => 1, 'parent' => 'storefront','icon' => '🔗'],
                ['file' => 'storefront_developers.php','label' => 'Developers','visible' => 1, 'parent' => 'storefront','icon' => '👥'],
                ['file' => 'index_management','label' => '2006+ Index Management','visible' => 1,'icon' => '🗂️'],
                ['file' => 'capsule_management_2006.php','label' => 'Index Capsule Management','visible' => 1, 'parent' => 'index_management','icon' => '🧩'],
                ['file' => 'single_large_capsule.php','label' => 'Single Large Capsule','visible' => 1, 'parent' => 'index_management','icon' => '🖼️'],
                ['file' => 'index_sidebar_management.php','label' => 'Index Sidebar Management','visible' => 1, 'parent' => 'index_management','icon' => '📚'],
                ['file' => 'legacy_storefront','label' => '2004/2005 Storefront Management','visible' => 1, 'parent' => 'storefront','icon' => '🎮'],
                ['file' => 'legacy_storefront_games.php','label' => 'Game management','visible' => 1, 'parent' => 'legacy_storefront','icon' => '🎮'],
                ['file' => 'legacy_storefront_thirdparty.php','label' => 'Thirdparty Game management','visible' => 1, 'parent' => 'legacy_storefront','icon' => '🎮'],
                ['file' => 'legacy_storefront_packages.php','label' => 'Package/Subscription Management','visible' => 1, 'parent' => 'legacy_storefront','icon' => '🎮'],
                ['file' => '../logout.php','label' => 'Logout','visible' => 1,'icon' => '🚪']
            ];
            $defaults = [
                'theme' => '2004',
                'admin_theme' => 'v2',
                'site_title' => 'Steam',
                'smtp_host' => '',
                'smtp_port' => '',
                'smtp_user' => '',
                'smtp_pass' => '',
                'header_overrides' => '',
                'header_config' => json_encode(['logo' => 'themes/2004/images/valve_head.gif','buttons' => $header_buttons]),
                'footer_html' => $footer,
                'favicon' => '/favicon.ico',
                'error_html' => $error_html,
                'nav_items' => json_encode($default_nav),
                'forum_base_url' => '/forum',
                'forum_site_name' => 'Steam Support Forums',
                'forum_admin_username' => 'admin',
                'root_path' => $root_path,
                'gzip' => '0',
                'enable_cache'   => '0',
                'news_year_only' => '1',
                'news_date_format' => 'long'
            ];
            $stmt = $pdo->prepare('INSERT INTO settings(`key`,value) VALUES(?,?)');
            foreach ($defaults as $k => $v) {
                $stmt->execute([$k,$v]);
            }
            $pageStmt = $pdo->prepare('INSERT INTO custom_pages(slug,page_name,title,content,theme,template,created,updated,status) VALUES(?,?,?,?,?,?,?,?,?)');

            /* -----------------------------------------------------------
             *  HEADER-BAR SEEDS
             * --------------------------------------------------------- */

            $default_buttons = [
                ['url' => '/index.php?area=news',          'text' => 'news'],
                ['url' => '/index.php?area=getsteamnow',   'text' => 'getSteamNow'],
                ['url' => '/index.php?area=cybercafes',    'text' => 'Cyber Cafes'],
                ['url' => '/support.php',       'text' => 'Support'],
                ['url' => '/index.php?area=forums',        'text' => 'Forums'],
                ['url' => '/index.php?area=status','text' => 'Status']
            ];

            /* theme-specific overrides                                    */
            $button_overrides = [
                /* 2003_v1 → Support | Forums | Contact ------------------ */
                '2003_v1' => [
                    ['url' => 'support.php',   'text' => 'Support'],
                    ['url' => 'index.php?area=forums',    'text' => 'Forums'],
                    ['url' => 'contact.php',   'text' => 'Contact'],
                ],

                /* 2002_v2 → Try Steam Now! | Steam Support Site | Valve Home */
                '2002_v2' => [
                    ['url' => 'index.php?area=getsteamnow','text' => 'Try Steam Now!'],
                    ['url' => 'support.php',   'text' => 'Steam Support Site'],
                    ['url' => 'http://www.valvesoftware.com','text' => 'Valve Home'],
                ],
            ];

            /* -----------------------------------------------------------
             *  LOGOS PER THEME
             * --------------------------------------------------------- */
            $logos = [
                '2002_v1' => '',   // special-case: no header bar
                '2002_v2' => 'images/LOGO_Steam2.gif',
                '2003_v1' => 'images/LOGO_Steam2.gif',
                '2003_v2' => 'images/valve_head.gif',
                '2004'    => 'images/valve_head.gif',
                '2005_v1' => 'images/steam_logo_onblack.gif',
                '2005_v2' => 'images/steam_logo_onblack.gif',
                '2006_v1' => 'themes/2006_v1/images/logo_steam_header.jpg',
                '2006_v2' => 'themes/2006_v2/images/logo_steam_header.jpg',
                '2007_v1' => 'themes/2007_v1/images/logo_steam_header.jpg',
                '2007_v2' => 'themes/2007_v2/images/logo_steam_header.jpg',
            ];

            /* -----------------------------------------------------------
             *  INSERT
             * --------------------------------------------------------- */
            $thStmt = $pdo->prepare(
                'INSERT INTO theme_headers
                 (theme,page,ord,logo,text,img,hover,depressed,url,visible,bold,spacer)
                 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)'
            );

            foreach ($logos as $theme => $logo) {

                /* 2002_v1 has **no** header bar ----------------------------------- */
                if ($theme === '2002_v1') {
                    continue;
                }

                /* pick button seed: override or default --------------------------- */
                $buttons = $button_overrides[$theme] ?? $default_buttons;

                $ord     = 0;
                $spacer  = in_array($theme, ['2002_v2','2003_v1']) ? ' <font size="2" color="white"><b><font face="Arial,Helvetica,Geneva,Swiss,SunSans-Regular">| </font></b></font> ' : '';

                foreach ($buttons as $btn) {
                    $thStmt->execute([
                        $theme,
                        '',
                        $ord++,
                        $logo,
                        $btn['text'],
                        null,           // img
                        null,           // hover
                        null,           // depressed
                        $btn['url'],
                        1,
                        0,
                        $spacer
                    ]);
                }
            }

            $tfStmt = $pdo->prepare('INSERT INTO theme_footers(theme,html) VALUES(?,?)');

$tfStmt->execute(['2002_v2', <<<'HTML'
(c) 2002 Valve, L.L.C. All rights reserved. Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve, L.L.C.
HTML]);

$tfStmt->execute(['2003_v1',<<<'HTML'
<br>(c) 2003 Valve, L.L.C. All rights reserved. Steam, the Steam logo, Valve, and the Valve logo are trademarks<br>
                                and/or registered trademarks of Valve, L.L.C.
HTML]);
            
$tfStmt->execute(['2003_v2',<<<'HTML'
<a href="http://www.valvesoftware.com"><img align="left" src="valve_greenlogo.gif"></a> ©2003 Valve, L.L.C. All rights reserved. Read our <a href="index.php?area=privacy">privacy policy</a>.<br>
Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve, L.L.C.
HTML]);

$tfStmt->execute(['2004',<<<'HTML'
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td><a href="http://www.valvesoftware.com"><img src="img/valve_greenlogo.gif"></a></td>
<td>&nbsp;</td>
<td><span class="footerfix">©2004 Valve Corporation. All rights reserved. <a href="index.php?area=privacy">Privacy Policy</a>. <a href="index.php?area=legal">Legal</a>. <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>.<br>
                            Steam, the Steam logo, Valve, and the Valve logo are trademarks and/or registered trademarks of Valve Corporation.</span></td>
<td width="15%">&nbsp;</td>
</tr>
</tbody></table>
HTML]);

            
$tfStmt->execute(['2005_v1',<<<'HTML'
2005 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="http://www.valvesoftware.com/privacy.htm">Privacy Policy</a>. <a href="http://www.valvesoftware.com/legal.htm">Legal</a>. <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>.
HTML]);


$tfStmt->execute(['2005_v2',<<<'HTML'
<table cellpadding="0" cellspacing="0">
<tr>
		<td><a href="http://www.valvesoftware.com/"><img src="valve_greenlogo.gif"></a></td>
		<td>&nbsp;</td>
		<td><span class="footerfix">© 2005 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, the Steam logo, Team Fortress, the Team Fortress logo, Opposing Force, Day of Defeat, the Day of Defeat logo, Counter-Strike, the Counter-Strike logo, Source, the Source logo, Valve Source and Counter-Strike: Condition Zero are trademarks and/or registered trademarks of Valve Corporation. <a href="index.php?area=privacy">Privacy Policy.</a> &nbsp;<a href="index.php?area=legal">Legal.</a> &nbsp;<a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a></span></td>
		<td width="15%">&nbsp;</td>
	</tr>
</table>
HTML]);

$tfStmt->execute(['2006_v1',<<<'HTML'
<div class="footer">
<table background="img_footer_bg.jpg" border="0" cellpadding="0" cellspacing="0" width="910px">
<tbody><tr>
<td background="img_footer_l.jpg" height="73" width="12">&nbsp;</td>
<td align="center" width="110"><a href="http://www.valvesoftware.com"><img alt="link: Valve Software" border="0" height="26" src="logo_valve_footer.jpg" width="92"></a></td>
<td>
<div class="legal">© 2006 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.<br>
<a href="index.php?area=privacy"> Privacy Policy.</a> <a href="index.php?area=legal">Legal.</a> <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a></div>
</td>
<td background="img_footer_r.jpg" height="73" width="14">&nbsp;</td>
</tr>
</tbody></table>
</div>
HTML]);

$tfStmt->execute(['2006_v2',<<<'HTML'
<div class="footer">
<table background="img_footer_bg.jpg" border="0" cellpadding="0" cellspacing="0" width="910px">
<tbody><tr>
<td background="img_footer_l.jpg" height="73" width="12">&nbsp;</td>
<td align="center" width="110"><a href="http://www.valvesoftware.com"><img alt="link: Valve Software" border="0" height="26" src="logo_valve_footer.jpg" width="92"></a></td>
<td>
<div class="legal">© 2006 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.<br>
<a href="index.php?area=privacy"> Privacy Policy.</a> <a href="index.php?area=legal">Legal.</a> <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a></div>
</td>
<td background="img_footer_r.jpg" height="73" width="14">&nbsp;</td>
</tr>
</tbody></table>
</div>
HTML]);

$tfStmt->execute(['2007',<<<'HTML'
<div class="footer">
<table background="img_footer_bg.jpg" border="0" cellpadding="0" cellspacing="0" width="910px">
<tbody><tr>
<td background="img_footer_l.jpg" height="73" width="12">&nbsp;</td>
<td align="center" width="110"><a href="http://www.valvesoftware.com"><img alt="link: Valve Software" border="0" height="26" src="logo_valve_footer.jpg" width="92"></a></td>
<td>
<div class="legal">
<form action="index.php">
<input name="area" type="hidden" value="main">
<input name="cc" type="hidden" value="US">
<select name="l" onchange="submit();">
<option id="l_danish" value="danish">Danish</option>
<option id="l_dutch" value="dutch">Dutch</option>
<option id="l_english" selected="" value="english">English</option>
<option id="l_finnish" value="finnish">Finnish</option>
<option id="l_french" value="french">French</option>
<option id="l_german" value="german">German</option>
<option id="l_italian" value="italian">Italian</option>
<option id="l_japanese" value="japanese">Japanese</option>
<option id="l_korean" value="korean">Korean</option>
<option id="l_norwegian" value="norwegian">Norwegian</option>
<option id="l_polish" value="polish">Polish</option>
<option id="l_portuguese" value="portuguese">Portuguese</option>
<option id="l_russian" value="russian">Russian</option>
<option id="l_schinese" value="schinese">Simplified Chinese</option>
<option id="l_tchinese" value="tchinese">Traditional Chinese</option>
<option id="l_spanish" value="spanish">Spanish</option>
<option id="l_swedish" value="swedish">Swedish</option>
<option id="l_thai" value="thai">Thai</option>
</select><br>
<br></form>				© 2006 Valve Corporation. All rights reserved. All trademarks are property of their respective owners in the US and other countries.<br>
<a href="index.php?area=privacy"> Privacy Policy.</a> <a href="index.php?area=legal">Legal.</a> <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement.</a>
<br></div>
</td>
<td background="img_footer_r.jpg" height="73" width="14">&nbsp;</td>
</tr>
</tbody></table>
</div>
HTML]);

$cafepromotion_html = <<<'HTML'
<h1>APRIL CYBER CAFÉ PROMOTION</h1>
<h2>VALVE&apos;S <em> OFFICIAL CYBER CAFÉ PROGRAM</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
During the month of April 2004, Valve is extending a special offer to Cyber Cafés. <b>During this time, a 12-month cyber café license for Valve’s games is being offered at a savings of 33%</b>. The license includes all of Valve’s available Steam content, including Counter-Strike: Condition Zero, Counter-Strike, Half-Life, Day of Defeat, Team Fortress Classic, and more. Licensed Cyber Café’s also receive product key protection, promotional materials, tournament licenses, and priority access to Valve support.<br>
<br>
This offer ends at 11:59 pm PST on April 30, 2004, is subject to change and is not available in every territory. For more information, please email <a href="mailto:cafe@valvesoftware.com">cafe@valvesoftware.com</a>.
<br><br><br><br>&nbsp;
HTML;
$pageStmt->execute(['cybercafe_promotion',null,'Cybercafe Promotion',$cafepromotion_html,'2003_v2,2004','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$cybercafe_html = <<<'HTML'
<h1>CYBER CAFÉS</h1>
<h2>BRING<em> STEAM GAMES TO YOUR CUSTOMERS</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="box">
<div class="boxTop2">For Cyber Café<br>Program Members</div>

<strong><a href="index.php?area=cafe_setup" style="text-decoration: none;">Step-by-Step Instructions</a></strong><br>Read about <a href="index.php?area=cafe_setup">how to get your cafe up and running</a> with Steam.<br>
<br>
<strong><a href="index.php?area=faq§ion=cybercafe" style="text-decoration: none;">Frequently Asked Questions</a></strong><br>
Check the <a href="index.php?area=faq§ion=cybercafe">FAQ</a> for info on cyber cafés, the official program, Steam, etc.<br>
<br>
<strong><a href="index.php?area=support" style="text-decoration: none;">Support</a></strong><br>
Members can contact us via <a href="./cgi-bin/steampowered.cfg/php/enduser/entry.php">support</a> any time for assistance with Steam or any Steam game.<br>
<br>
<strong><a href="index.php?area=cybercafe_changeform" style="text-decoration: none;">Change Account Information</a></strong><br>
Members can contact us via <a href="mailto:cybercafes@valvesoftware.com">cybercafes@valvesoftware.com</a> to change contact information, café locations, number of seats, etc.<br>
<!-- <p align="right"><sub><a href="incdex.php?area=news" style="text-decoration: none;">read more &gt;</a></sub></p> -->
</div>
<br>

If you run a cybercafe or other gaming venue, Valve makes it easy for you to bring our games to your customers. There are currently over 800 gaming venues in our program, and more are signing up every day. Valve&aposs cybercafé program is the only legal way to use Valve games in your cybercafé or gaming center.<br>
<br>

<!--
<h3 style="text-transform:uppercase;">APRIL CYBER CAF&Eacute; PROMOTION</h3>
During the month of April 2004, Valve is extending a <a href="index.php?area=cybercafe_promotion">special offer to Cyber Caf&eacute;s</a>. During this time, a 12-month cyber café license for Valve’s games is being offered at a savings of 33%. <a href="http://steampowered.com/?area=cybercafe_promotion">See this page for details</a>.<br><br>
-->

<h3 style="text-transform:uppercase;">The Official Valve Cyber Café Program</h3>

<img src="./images/valve_maizelogo.gif" align="left">
The Official Valve Cyber Café Program is here. One low monthly fee gets you the most popular action games on the Internet, regular content updates, low maintenance, and fully legal licenses for all of your computers. Here are the details:<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cybercafe_program">Features and Benefits</a><br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cafe_pricing">Pricing and Licensing</a><br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cafe_signup">Cyber Café Sign-Up Form</a><br>
<br>
<br>

<h3 style="text-transform:uppercase;">Valve Cyber Café Representatives</h3>

If you would like to participate in the Official Valve Cyber Café Program, contact the representative nearest you.<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cafe_representatives">Browse the Cyber Café Representatives</a><br>
<br>
<br>

<h3 style="text-transform:uppercase;">Valve Cyber Café Directory</h3>

Find an Official Valve Cyber Café and play our latest games.<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cafe_directory">Browse the Cyber Café Directory</a><br>
<br>
<br>

<h3 style="text-transform:uppercase;">For Immediate Release</h3>
<br>
Monday, November 29 at 4:52 pm PST.<br>
<br>
VALVE WINS SUMMARY JUDGMENT MOTIONS IN COPYRIGHT INFRINGEMENT CASE<br>
<br>
Valve today announced the U.S. Federal District Court in Seattle, WA granted its motion for summary judgment on the matters of Cyber Café Rights and Contractual Limitation of Liability in its copyright infringement suit with Sierra/Vivendi Universal Games.<br>
<br>
Judge Thomas S. Zilly ruled that Sierra/Vivendi Universal Games, and its affiliates, are not authorized to distribute (directly or indirectly) Valve games through cyber cafés to end users for pay-to-play activities pursuant to the parties' current publishing agreement. Valve games such as Counter-Strike, Counter-Strike: Condition Zero and the recently released Half-Life 2 and Counter-Strike: Source are all popular in cyber cafés.<br>
<br>
In addition, Judge Zilly ruled in favor of the Valve motion regarding the contractual limitation of liability, allowing Valve to recover copyright damages for any infringement as allowed by law without regard to the publishing agreement's limitation of liability clause. <br>
<br>
"We're happy the court has affirmed the meaning of our publishing contract. This is good news for Valve and its cyber café partners around the world," said Gabe Newell, founder and CEO of Valve. "We continue to add value to our program and we look forward to working with cafés to get them signed up and offering Valve&aposs latest games to their customers." <br>
<br>
The Valve Cyber Café Program is the only legal way to use Valve games in your cyber café or gaming center. There are currently thousands of cyber cafés participating in the program throughout the world. <br>


<!-- Fill out <a href="#">the sign-up form</a> and we'll get back to you right away. Once you're a member, your customers can begin playing right away.<br>-->
<br>
HTML;
$pageStmt->execute(['cybercafes',null,'Cyber Cafés',$cybercafe_html,'2003_v2,2004,2005_v1','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$cybercafe_2005_html = <<<'HTML'
<h1>CYBER CAFÉS</h1>
<h2>BRING<em> STEAM GAMES TO YOUR CUSTOMERS</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="box">
<div class="boxTop2">Valve Cyber Café Representatives</div>

If your café is located outside of the US and you would like to participate in the Official Valve Cyber Café Program, contact the representative nearest you.<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cafe_representatives">Browse the Cyber Café Representatives</a><br><br>

<div class="boxTop2">Valve Tournament Calendar</div>

The calendar below displays all of the Valve licensed tournaments occurring in the next 30 days.  (Tournament organizers may opt out of having their events displayed on this calendar.)<br><br>

<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=tourney_calendar">view the full calendar</a><br><br>

<table align="center" cellspacing="0" cellpadding="0"><tbody><tr><td><b>December 2005</b><br><span style="font-family: courier new;"><span style="border: 1px solid #282E22;" title="">&nbsp;&nbsp;</span>&nbsp;<span style="border: 1px solid #282E22;" title="">&nbsp;&nbsp;</span>&nbsp;<span style="border: 1px solid #282E22;" title="">&nbsp;&nbsp;</span>&nbsp;<span style="border: 1px solid #282E22;" title="">&nbsp;&nbsp;</span>&nbsp;<a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid red;" title="1 event is running today">&nbsp;1</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="2 events are running today">&nbsp;2</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="4 events are running today">&nbsp;3</span></a> <br><a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="3 events are running today">&nbsp;4</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">&nbsp;5</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">&nbsp;6</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">&nbsp;7</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">&nbsp;8</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">&nbsp;9</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">10</span></a> <br><a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">11</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">12</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">13</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="2 events are running today">14</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="4 events are running today">15</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="4 events are running today">16</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="5 events are running today">17</span></a> <br><a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="4 events are running today">18</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">19</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">20</span></a> <a href="https://web.archive.org/web/20051201224756/http://steampowered.com/?area=tourney_calendar"><span style="background-color: #4B5640; border: 1px solid silver;" title="1 event is running today">21</span></a> <span style="border: 1px solid #282E22;;">22</span> <span style="border: 1px solid #282E22;;">23</span> <span style="border: 1px solid #282E22;;">24</span> <br><span style="border: 1px solid #282E22;;">25</span> <span style="border: 1px solid #282E22;;">26</span> <span style="border: 1px solid #282E22;;">27</span> <span style="border: 1px solid #282E22;;">28</span> <span style="border: 1px solid #282E22;;">29</span> <span style="border: 1px solid #282E22;;">30</span> <span style="border: 1px solid #282E22;;">31</span> <br></span><br><br></td></tr></tbody></table>

</div>

<br>

If you run a cybercafe or other gaming venue, Valve makes it easy for you to bring our games to your customers. There are currently over 2500 gaming venues in our program, and more are signing up every day. Valve&aposs cybercafé program is the only legal way to use Valve games in your cybercafé or gaming center.<br>
<br>

<!--
<h3 style="text-transform:uppercase;">APRIL CYBER CAF&Eacute; PROMOTION</h3>
During the month of April 2004, Valve is extending a <a href="index.php?area=cybercafe_promotion">special offer to Cyber Caf&eacute;s</a>. During this time, a 12-month cyber café license for Valve’s games is being offered at a savings of 33%. <a href="http://steampowered.com/?area=cybercafe_promotion">See this page for details</a>.<br><br>
-->

<h3 style="text-transform:uppercase;">The Official Valve Cyber Café Program</h3>

<img src="./images/valve_maizelogo.gif" align="left">
The Official Valve Cyber Café Program is here. One low monthly fee gets you the most popular action games on the Internet, regular content updates, low maintenance, and fully legal licenses for all of your computers. Here are the details:<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cybercafe_program">Features and Benefits</a><br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cafe_pricing">Pricing and Licensing</a><br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cafe_signup">Cyber Café Sign-Up Form</a><br>
<br>
<br>

<h3 style="text-transform:uppercase;">New Product Releases:</h3>
In the past few months we have added four new games to the Cyber Café Program: DOD: Source, Rag Doll Kung Fu, Blue Shift and most recently Half-Life 2: Lost Coast.  Don't miss out on having these great new games in your café.  <a href="index.php?area=cafe_signup">Sign up today</a>!<br>
<br>
Half-Life 2: Lost Coast, a single-player level custom-created to showcase High-Dynamic Range lighting (HDR) in the Source engine, is available now to all owners of HL2. As a technology showcase, Half-Life 2: Lost Coast's system requirements are very high. During installation, Steam will prompt you if your system does not meet the recommended configuration. We hope you and your customers enjoy it.<br>
<br>
<br>

<h3 style="text-transform:uppercase;">New Time Based Billing System: Valve Time Tracker (VTT)  Beta</h3>

Valve is continuing to improve cyber café software tools.  We are currently beta testing our new time based billing system: Valve Time Tracker (VTT).  VTT will allow cafés to choose between the current billing system (flat-rate per PC per month) or a new billing option that will allow you to pay only for the actual play time in your café.  Other major benefits of VTT include:<br>
<br>
1) Café owners will no longer have to worry about having their accounts stolen.  Your PCs will get login information directly from a Valve-controlled master server when the game is run.  No more hassles and down times waiting to have your passwords and secret questions reset.<br>
<br>
2) Direct integration with Steam to reduce maintenance during updates and improved compatibility with other cyber café tools.<br>
<br>
3) VTT will allow cafés to have any number of PCs playing Valve games concurrently - you are no longer limited to a certain number of PCs that can play Valve games.  This is great for tournaments or other peak times when you have more customers wanting to play the games for a short period of time.  You no longer have to worry about "adding" accounts - you can simply start playing on more PCs in your café.<br>
<br>
<br>

<script>
function popUp(URL, x, y) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width='+x+',height='+y);");
}
</script><h3 style="text-transform:uppercase;">Valve Cyber Café Support</h3>

Café members can contact us via our new <a href="/cafesupport/">Café Support Site</a> for priority assistance with technical/software support questions or to update your café account information (café phone number/address, number of licenses, credit card billing number, etc.)  For the most successful visit to our support site, we suggest reading through our <a href="javascript:popUp('index.php?area=cybercafes&amp;tips=1', 600, 550)">Café Support Tips</a> first.<br>
<br>
<br>

<h3 style="text-transform:uppercase;">Valve Cyber Café Directory</h3>

Find an Official Valve Cyber Café and play our latest games.<br>
<br>
<img src="./images/yellowSquare.gif"> &nbsp;<a href="index.php?area=cafe_directory">Browse the Cyber Café Directory</a><br>
<br>
<br>

<h3 style="text-transform:uppercase;">Valve Tournament Webpage &amp; Calendar</h3>
<br>
Valve has launched a new <a href="index.php?area=tourney_limited">Tournament Webpage</a> for Tournaments. From this site, tournament organizers may submit a tournament registration request for their event to be posted on the <a href="index.php?area=tourney_calendar">Valve Tournament Calendar</a>. Organizers may also purchase Temporary Tournament Steam Accounts for their event. The price for these accounts is $2 USD per account, per day (25 account, 2 day minimum required). Members of our Cyber Cafe Program may receive a discount. <br>

<br><br><br><br><br><br><br>


<!-- Fill out <a href="#">the sign-up form</a> and we'll get back to you right away. Once you're a member, your customers can begin playing right away.<br>-->
<br>
HTML;
$pageStmt->execute(['cybercafes',null,'Cyber Cafés',$cybercafe_html,'2005_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$cafesetup_html = <<<'HTML'
<h1>CAFÉ SETUP INSTRUCTIONS</h1>
<h2>HOW TO<em> GET UP AND RUNNING WITH STEAM</em></h2><img src="./image/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

Here are instructions for setting up Steam in your café. Before you begin this process, you must be a member of the <a href="index.php?area=cybercafes">official Valve Cyber Café Program</a>. For additional information not covered here, please check the <a href="index.php?area=FAQ§ion=cybercafe">café section of our FAQ</a>.<br>
<br>
<h3 style="text-transform:uppercase;">1. Download the Steam Installer (or use the supplied DVD-ROM)</h3>
When you join the Cyber Café Program, we will send you a DVD-ROM containing the Steam installer. If you would rather not wait for that to arrive, you can download the Steam client installer from the <a href="index.php?area=getsteamnow">Get Steam Now</a> page on this site. If you choose to download this installer rather than using the DVD-ROM, be sure to save the installer to disk -- you'll need to use it on each licensed computer in your café.<br>
<br>

<h3 style="text-transform:uppercase;">2. Run the Steam Installer</h3>
To make things simple, you will probably want to choose the same install location on every machine in your café. We recommend that you have at least 1GB of free space on the drive before installing Steam.<br>
To make things simple, you will probably want to choose the same install location on every machine in your café. We recommend that you have at least 1GB of free space on the drive before installing Steam.<br>
<br>
<h3 style="text-transform:uppercase;">3. Create an Account</h3>
Follow these steps to create a Steam account:<br>
<br>
<img src="./image/square2.gif"> <strong>Email Address</strong><br>
The first thing the Create Account wizard will ask you to do is enter a valid email address. Please note that for café Steam accounts, the address that you enter into this box does not actually need to be a valid email address. Instead, it should be an address like "computer1@the_name_of_your_cafe.com". Again, this does NOT need to be a valid email address -- it only needs to uniquely identify the specific machine in your café. The second machine on which you install Steam can use the address "computer2@the_name_of_your_cafe.com", and so on.<br>
<br>
<img src="./image/square2.gif"> <strong style="margin-bottom:4px;">Choose a Password and Secret Question &amp; Answer</strong><br>
The normal security concerns apply when choosing your Steam password. Note that it is possible to use the same password on all of the machines in your café (but obviously, somewhat less secure).<br>
<br>
As an added security feature for cyber cafés, Steam will require this password to be entered in order to log OUT. A customer in your café will therefore not be able to log out of Steam or log in as a different user. Also, Steam will run automatically when your computer starts up, and will log in to the Steam servers using the credentials you've supplied during account creation.<br>
<br>
<img src="./image/square2.gif"> <strong>Enter a Nickname</strong><br>
When entering a "Nickname" for each of your café computers, you should again use the name of the computer ("computer1" or similar). It is not necessary to enter a First or Last name.<br>
<br>
<img src="./image/square2.gif"> <strong>Finished creating account</strong><br>
That's it for account creation. All that's left is entering your Product Keys.<br>
<br>
<h3 style="text-transform:uppercase;">4. Enter Your Cyber Café Product Key</h3>
When Valve adds you to the Official Cyber Café Program, you will receive (via email and/or FedEx) a set of Product Keys. You will receive one for each computer you wish to license.<br>
<br>
After Steam is installed, open the "My Games" list. There, you'll see a list of all Steam Games. Double-Click on one that you intend to offer in your café. Steam will ask you for a product key at this point. Each computer will use one of the keys in your list. (Once you have used each Product Key in this way, it will be associated with the Steam account that you've created on that computer. Your Product Keys will, from this point on, not be usable by other people to create accounts or to play Steam games.)<br>
<br>
<h3 style="text-transform:uppercase;">5. Repeat Steps 2-4 for Each Computer</h3>
Repeat these steps for every licensed computer on your network, using unique "email addresses" and Nicknames each time.<br>
<br>
<h3 style="text-transform:uppercase;">6. Configure Internet Ports</h3>
Note that Steam requires certain ports to be open from your gaming machines to the Internet. If you haven't already done so, check that the following ports must are "open":<br>
<br>
UDP 1200<br>
UDP 27000 to 27015 inclusive<br>
TCP 27030 to 27039 inclusive<br>
<br>
<h3 style="text-transform:uppercase;">7. Start Playing!</h3>
Log in to Steam and sit your first customer down. Be sure to have them try the Server Browser (for finding Internet game servers). Also, they can send instant messages through "Friends" to any other Steam user. Automatic updates will be sent to each of your computers automatically, and new games will be added as they become available.<br>
<br><a href="mailto:cafesupport@valvesoftware.com">Let us know</a> if you have any difficulty.<br>
<br>

<a href="index.php?area=cybercafes">Return to main Cyber Café page</a>

</div>
HTML;
$pageStmt->execute(['cafe_setup', null, 'Cyber Café Setup Instructions',$cafesetup_html,'2003_v2,2004','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$features_html = <<<'HTML'
<!-- features -->
<h1>FEATURES</H1>
<h2>WHAT <em>CAN STEAM DO?</em></h2><img src="Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
Once you've installed Steam, all of the following features are available on your desktop <i>and while you're playing Steam games</i>.
<br><br>
<h3>EASY AND FAST ACCESS TO GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="thumb_games.gif">
After installing Steam, you'll have instant access to Valve&aposs full library of games. And when you choose one to play, you don't have to wait for the whole thing to download -- you can start playing in a matter of minutes.<br clear="all">
<br clear="all">
<h3>AUTOMATIC UPDATES</h3>
<img width="88" height="88" align="left" vspace="4" src="thumb_updates.gif">
Say goodbye to game patches forever--they're a thing of the past. Steam will keep all of its games up-to-date for as long as you want to keep playing them. No more hunting for download sites just to get up and running!<br clear="all">
<br clear="all">
<h3>INSTANT MESSAGING, EVEN IN GAME</h3>
<img width="88" height="88" align="left" vspace="4" src="thumb_im.gif">
Keep in touch with your buddies through "Friends," Steam's instant-messenger. It even works while you or your friends are playing games -- you don't have to stop playing to communicate.<br clear="all">
<br clear="all">
<h3>SERVER BROWSER - FIND YOUR FRIENDS' GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="thumb_servers.gif">
Now it's incredibly easy to find a quality game server -- one that's fast, that's running your favorite game, and even one that has your friends already playing on it.<br clear="all">
<br clear="all">
<h3>PARLOR GAMES</h3>
<img width="88" height="88" align="left" vspace="4" src="thumb_chess.gif">
Maybe you're dodging your homework. Maybe you're just bored while waiting for another turn in Counter-Strike. Either way -- why not enjoy a nice game of Chess? Or Checkers? Or Go? Or Hearts... Or....<br clear="all">
<br clear="all">

<!-- <h3>AND LOTS MORE</h3>
<img width="88" height="88" align="left" vspace="4" src="thumb_xxx.gif">
xxxxxx xxxxx xxxxx x xxx xxxxxxx xxxxxx xxx xxxxxx x xxxxxx xxxxxxx. xxxxxx xxxxx xxxxx x xxx xxxxxxx xxxxxx xxx xxxxxx x xxxxxx xxxxxxx.

-->
</div><br clear="all">
<a href="index.php?area=getsteamnow"><img src="but_getsteamnow.gif" height="24" width="124" alt="get steam now"></a><br>
HTML;

$pageStmt->execute(['features',null,'Features',$features_html,'2003_v1,2003_v2,2004','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$onlineconduct_html = <<<'HTML'
<h1>STEAM ONLINE CONDUCT</H1>
<br>
<div class="narrower">

As a <a href="steam_subscriber_agreement.php">Steam subscriber</a> you agree to abide by the following conduct rules.<br><br>
You will not:<br>

<ul>
<li>Upload, or otherwise make available, files that contain images, photographs, software or other material protected by intellectual property laws, including, by way of example, and not as limitation, copyright or trademark laws (or by rights of privacy or publicity) unless you own or control the rights thereto or have received all necessary consents to do the same.</li>
<li>Use any material or information, including images or photographs, via Steam in any manner that infringes any copyright, trademark, patent, trade secret, or other proprietary right of any party. </li>
<li>Upload files that contain viruses, trojan horses, worms, or any other similar software or programs that may damage the operation of another&aposs computer or property of another.</li>
<li>Institute attacks upon a Steam server or otherwise disrupt Steam.</li>
<li>Use Steam in connection with surveys, contests, pyramid schemes, chain letters, junk email, spamming or any duplicative or unsolicited messages (commercial or otherwise).</li>
<li>Defame, abuse, harass, stalk, threaten or otherwise violate the legal rights (such as rights of privacy and publicity) of others.</li>
<li>Restrict or inhibit any other user from using and enjoying Steam services, software or other content. <br>
<li>Harvest or otherwise collect information about others, including e-mail addresses.</li>
<li>Create a false identity for the purpose of misleading others.</li>
<li>Violate any applicable laws or regulations.</li>
</ul>

</div>
HTML;

$pageStmt->execute(['online_conduct',null,'Steam Online Conduct',$onlineconduct_html,null,'default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$mapcontestrules_html = <<<'HTML'
<h1>HALF-LIFE 2: DEATHMATCH MAP CONTEST OFFICIAL RULES</h1>
<br>
<br>
The Valve Half-Life 2 Map Contest (the "Contest") is sponsored by Valve Corporation ("Valve").    NO PURCHASE NECESSARY. VOID WHERE PROHIBITED.<br>
<br>
1.	Eligibility.  The Contest is open to individuals or groups of individuals (each an "Entrant"), each of whom must be (a) a subscriber to Half-Life 2 via Valve’s Steam service; and (b) at least 18 years old at the time of submitting their Contest Entry.  The Contest is open worldwide, except where prohibited by law.  Employees of Valve or its affiliates (the "Contest Sponsors"), and their immediate family or household members, are not eligible to participate.<br>
<br>
2.	Contest Dates.  Registration for the Contest begins at 12:00:01 a.m. Pacific Standard Time (PST) on December 1, 2004 and ends at 11:59:59 pm PST on January 15, 2005 (the "Contest Registration Period".)  All Contest registration forms and Contest Entries must be received by 11:59:59 pm PST on January 15, 2005.<br>
<br>
3.	How to Enter.  Visit <a href="https://web.archive.org/web/20051218104220/http://steampowered.com/?area=map_contest">http://steampowered.com/?area=map_contest</a> and follow the links to the Contest registration form.  Print out, complete and submit the Contest registration form before the end of the Contest Registration Period together with a Contest Entry meeting the requirements set forth in Section 4 of these Official Rules.  Submit your completed Contest registration form and Contest Entry to:<br>
<br>
Half-Life 2 Map Contest<br>
Valve Corporation<br>
P.O. Box 1688<br>
Bellevue, WA 98009<br>
 <br>
4.	Contest Entry Requirements.  Each Contest Entry must consist of a map for a single level of Half-Life 2 Deathmatch created using Valve’s proprietary game engine, containing only textures from Half-Life 2, and submitted on a CD-ROM or DVD-ROM.  Each Contest Entry must be created solely by the Entrant(s) submitting the Contest Entry.  If the Entrant is a group, all individuals who contributed to the Contest Entry must be included, and each Entrant warrants that all contributing Entrants have agreed to the Contest Rules.  Each Entrant warrants that his or her Contest Entry does not include any trademarks, trade names, depictions of actual people, copyrighted materials, or other materials subject to the personal or proprietary rights of third parties, without the written permission of their respective owners sufficient to allow Contest Entrant to grant Valve the rights set forth in Section 8.  Each Contest Entry may not have been distributed prior to December 1, 2004.    Eligibility of Contest Entries will be determined in the discretion of the Contest Sponsors.<br>
<br>
5.	Judging of Entries.  After the end of the Contest Registration Period, all eligible Contest Entries will be judged by a panel of 3 members drawn from personnel of the Contest Sponsors (the "Contest Judges"), whose decisions are final and binding for all aspects of the Contest.  The Contest Judges will determine the potential winners of the first, second, and third place prizes based upon which Contest Entries, in the Contest Judges’ sole discretion, display superior playability, fun factor, and artistic merit. <br>
<br>
6.	Notification of Winners.  Each potential winner will be notified by the Contest Sponsor via email and overnight mail on or about January 30, 2005 and required to complete and return an affidavit of eligibility and release of liability no later than February 15, 2005 in the overnight envelope provided by the Contest Sponsor.  If the Contest Sponsor does not receive completed affidavits of eligibility, confirmation of Valve’s rights under Section 8 and/or releases of liability from any potential winner, or if a potential winner is determined in Contest Sponsor’s sole discretion to be ineligible to win, another winner will be selected by the Contest Judges.  The final winners will be notified via email and overnight mail on or about February 28, 2005 and a list will simultaneously be posted at www.steampowered.com.<br>
<br>
7.	Prizes.  The first place prize will be five thousand dollars (US$5,000.00) and the second and third place prizes will be three thousand dollars (US$3,000.00) each.   Each winner must contact the Contest Sponsor no later than March 15, 2005 to arrange delivery of their prize.  Each winner is responsible for all federal, state, local, provisional, or other taxes, and will be issued a U.S. 1099 tax form or other statement for the prize awarded.  Contest Sponsor reserves the right to withhold amounts from the prizes as may be required by taxing authorities.  If a group Entrant is selected as a winner, one prize will be awarded to the group by delivery to the group leader identified in the Entry, and the group members are responsible for distribution of the prize among the members. <br>
<br>
8.	Valve Rights to Contest Entries.  By accepting a prize, each winner grants Valve the royalty-free, fully-paid, worldwide, irrevocable, nonexclusive, perpetual right to exploit the intellectual property rights in the Contest Entry, including without limitation, at Valve’s option, distributing the Contest Entry to the public commercially or for free.  <br>
<br>
9.	General.  By submitting a Contest Entry, each Entrant warrants and represents that the Contest Entry was created solely by the Entrant(s) submitting it and that the Contest Entry is original.  By entering the Contest, each Entrant agrees to be bound by the terms of these Official Rules.  The Contest Sponsors are not responsible for incompletion, illegible, or misdirected e-mail or postal mail, or for phone, electrical, network, computer, hardware or software program malfunctions, failures or difficulties. The laws of the United States govern this Contest. All Federal, State and Local laws and regulations apply. Acceptance of prize constitutes permission for the Contest Sponsors to use winner's name and likeness for advertising and promotional purposes without additional compensation unless prohibited by law. By entering, Entrants release and hold harmless the Contest Sponsors and their respective subsidiaries, affiliates, directors, officers, prize suppliers, employees and agents, including advertising and promotion agencies, from any and all liability or any injuries, loss or damage of any kind arising from or in connection with this Contest or acceptance or use of prize. The Contest Sponsors reserve the right to cancel or modify the Contest if fraud or technical failure destroys the integrity of the Contest, as determined by the Contest Sponsors in their sole discretion. The Contest Sponsors reserve the right to disqualify any winner, as determined in their sole discretion. <br>
<br><br>
©2004 Valve Corporation. All rights reserved. Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, and Hammer are trademarks and/or registered trademarks of Valve Corporation.
<br>
HTML;

$pageStmt->execute(['map_contest_rules',null,'Half-Life 2: Deathmatch Map Contest Official Rules',$mapcontestrules_html,"2004,2005_v1,2005_v2",'default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$hl2goldcontest_html = <<<'HTML'
<h1>VALVE HQ TRIP GIVEAWAY</h1>
<h2>WIN<em> A TRIP TO Valve&aposs OFFICES</em></h2><img src="/web/20041011044601im_/http://steampowered.com/img/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
So you want to see Valve&aposs headquarters? Well, how about if we fly you to Valve HQ to tour the facility and meet some of the team members responsible for Half-Life 2 and Valve&aposs other games?<br>
<br>
Beginning now and ending December 31, 2004, Valve will automatically enter each eligible purchaser of the Half-Life 2 Gold package in the Valve HQ Trip Giveaway. On January 19th, 2005, Valve will randomly select one lucky winner for every 5,000 copies of the Half-Life 2 Gold package purchased by customers through Steam between October 7, 2004 and December 31, 2004 -- it could be you!<br>
<br>
The trip to Valve&aposs headquarters includes:<br>
<br>
<ul>
<li>Two nights&apos accommodation at a hotel of Valve&aposs choice near Valve&aposs Washington state headquarters.</li>
<li>Coach class airfare to Seattle, Washington.</li>
<li>A tour of Valve&aposs facilities.</li>
<li>Lunch with a select group of Valve employees.</li>
<li>An autographed Half-Life 2 poster.</li>
</ul>
<br>
NO PURCHASE NECESSARY<br>
<br>
How to enter:<br>
<br>
You can enter the Giveaway in one of two ways.<br>
<br>
1. Purchase the Half-Life 2 Gold Package via Steam by December 31, 2004.<br>
2. Or if you are a United States resident you can enter by sending a postcard marked "Valve HQ Trip Giveaway" to the following address: PO Box 1688, Bellevue, WA 98009. Your postcard must be received by December 31, 2004 and include your full name, birth date, address, phone number and email. Incomplete or late entries will be rejected.<br>
<hr>
Conditions of Entry / Official Rules:<br>
<br>
1)      GIVEAWAY DESCRIPTION: Giveaway ends at 11:59 PM (PST) on December 31, 2004. The prize(s) will be awarded in a random drawing from eligible entries received. Only one entry per person accepted. Contestants must be over the age of 12.<br>
<br>
2)      HOW TO ENTER: You can enter the Giveaway in one of two ways.  You can purchase the Half-Life 2 Gold package via Steam by December 31, 2004. Or, if you are a United States resident, you can enter by sending a postcard marked "Valve HQ Giveaway" to the following address: PO Box 1688, Bellevue, WA 98009.  Your postcard must be received by 11:59 pm PST, December 31, 2004 and include your full name, birth date, address, phone number and email. Incomplete or late entries will be rejected.<br>
<br>
3)      WINNER SELECTION &amp; NOTIFICATION: A random drawing will be conducted by Valve on January 19, 2005. Valve&aposs decision is final on all matters relating to the Giveaway. Odds of winning depend on the number of copies of the Half-Life 2 Gold package sold via Steam and the number of eligible entries received. The potential winner(s) will be notified by e-mail within one (1) week of prize drawing.<br>
<br>
4)      PRIZE: Valve will pay (i) two nights&apos accommodation at a hotel of Valve&aposs choice near Valve&aposs Washington state headquarters and (ii) coach class airfare to Seattle, Washington from either the major airport nearest to the winner's residence (if the winner resides in the United States) or the major international airport nearest to the winner's residence (if the winner does not reside in the United States).  Valve will give the prize winner(s) at least 8 weeks notice of the dates scheduled for the trip and prize winner(s) must provide Valve with any necessary information required for Valve to book air travel and hotel accommodations within 6 weeks of such date.  Any prize winner(s) under the age of 18 must travel with a parent or legal guardian.<br>
<br>
5)      GENERAL CONDITIONS: Giveaway entrants agree to be bound by the terms of these official rules.  The Giveaway is offered by Valve, which is not responsible for incompletion, illegible, or misdirected e-mail or postal mail, or for phone, electrical, network, computer, hardware or software program malfunctions, failures or difficulties. The laws of the United States govern this Giveaway. All Federal, State and Local laws and regulations apply. Acceptance of prize constitutes permission for Valve to use winner&aposs name and likeness for advertising and promotional purposes without additional compensation unless prohibited by law. By entering, participants release and hold harmless Valve and its respective subsidiaries, affiliates, directors, officers, prize suppliers, employees and agents, including advertising and promotion agencies, from any and all liability or any injuries, loss or damage of any kind arising from or in connection with this Giveaway or acceptance or use of prize. Valve reserves the right to cancel or modify the Giveaway if fraud or technical failure destroys the integrity of the Giveaway, as determined by Valve in its sole discretion. Valve reserves the right to disqualify any winner, as determined by Valve in its sole discretion. No cash or other substitution for prizes except at the option of Valve, for a prize of equal or greater value. Taxes are the sole responsibility of the winners. Actual prizes may differ from images shown.<br>
<br>
<br>&nbsp;
HTML;
$pageStmt->execute(['HL2GOLD_contest',null,'VALVE HQ TRIP GIVEAWAY',$hl2goldcontest_html,"2004,2005_v1,2005_v2",'default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$e3_html = <<<'HTML'
<!-- e3 movies -->
<h1>Half-Life 2: E3 2003</H1>
<h2>MOVIES<em> FROM THE ELECTRONIC ENTERTAINMENT EXPO</em></h2><img src="Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
Half-Life 2 debuted last year at E3, and won <a href="http://www.gamecriticsawards.com/past.html">Best of Show, Best PC Game, Best Action Game, and Special Commendation for Graphics</a>. On this page you can download video footage (captured directly from the game engine) showing all of the gameplay demos from the 2003 E3 booth.<br><br>
<nobr>
<img style="border:6px solid black;" width="180" height="100" src="movie_thumbs/hl2_movie1.jpg"> &nbsp;
<img style="border:6px solid black;" width="180" height="100" src="movie_thumbs/hl2_movie2.jpg"> &nbsp;
<img style="border:6px solid black;" width="180" height="100" src="movie_thumbs/hl2_movie3.jpg">
</nobr><br>
<br>
These files are high-resolution, so they are pretty large. A <a href="http://bitconjurer.org/BitTorrent/download.html">BitTorrent</a> client is needed to download them, so please install that first.<br><br>
<span style="color:red;font-weight:bold;">Note: These files have been taken offline for now. (They will soon be replaced by the E3 2004 movies.)</span><br><br>
<table width="480">
<tr>
<td>The GMan</a> (70MB)</td>
<td>Docks</a> (50MB)</td>
</tr><tr>
<td>Kleiner's Lab</a> (85MB)</td>
<td>Traptown</a> (190MB)</td>
</tr><tr>
<td>Tunnels</a> (100MB)</td>
<td>Bugbait</a> (170MB)</td>
</tr><tr>
<td>Barricade</a> (120MB)</td>
<td>Coastline</a> (170MB)</td>
</tr><tr>
<td>Striders</a> (150MB)</td>
<td>Psyche</a> (16MB)</td>
</tr>
</table>
<br><br>
Note that these movies are in Bink .exe format. If your computer has trouble playing the movies, you may want to download the <a href="http://www.radgametools.com/bnkdown.htm">the RAD video tools</a> and try different playback settings.
</div>
HTML;

$pageStmt->execute(['e3_movies',null,'Half-Life 2 E3 Movies',$e3_html,'2003_v1,2003_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$contact_html = <<<'HTML'
<h1>CONTACT</h1>
<h2>TALK <em>TO US (&amp; THE STEAM COMMUNITY)</em></h2><img src="/web/20050323095856im_/http://steampowered.com/img/Graphic_box.jpg" height="6" width="24" alt=""><br>

<div class="boxTop">Support Email Contacts</div><br clear="all">
<div class="box">
<strong>For technical inquiries:</strong><br>
<a href="https://web.archive.org/web/20050323095856/mailto:support@steampowered.com">support@steampowered.com</a><br><br>

<!-- <strong>For billing inquiries:</strong><br>
<a href="support_billing.shtml">Billing Support</a> page<br><br> -->

<strong>For feature suggestions:</strong><br>
<a href="https://web.archive.org/web/20050323095856/mailto:ideas@steampowered.com">ideas@steampowered.com</a><br><br>
</div>

<div class="narrower">

<h3>MESSAGE BOARDS &amp; FAQ</h3>
If you're using Steam and running into trouble, you may find a solution in our list of <a href="/web/20050323095856/http://steampowered.com/index.php?area=faq">Frequently Asked Questions</a>. For issues not covered there, <a href="/web/20050323095856/http://steampowered.com/index.php?area=forums">the online forums</a> on this website are another resource worth investigating.<br><br>

<h3>TECHNICAL SUPPORT ISSUES</h3>
For technical issues not covered in the above places, feel free to contact the Steam team directly. Support email addresses are listed at the right.<br><br>

<!-- <h3>BILLING QUESTIONS & PROBLEMS</h3>
For any issues related to credit cards or billing, please visit the <a href="/index.php?area=support_billing">Steam Billing Support</a> page.<br><br> -->

<h3>BUSINESS AND PARTNERSHIP INQUIRIES</h3>
For inquiries regarding business relationships such as becoming a content server, offering Valve&aposs games at cybercafes, or developing your own Steam-enabled software applications, please contact us directly at <a href="https://web.archive.org/web/20050323095856/mailto:biz@steampowered.com">biz@steampowered.com</a>.<br>

</div>
HTML;

$pageStmt->execute(['contact',null,'Contact',$contact_html,'2003_v22004,2005_v1,2005_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);


$forums_html = <<<'HTML'
<h1>FORUMS</h1>
<h2>FOR <em>SUPPORT AND DISCUSSION</em></h2><img src="Graphic_box.jpg" height="6" width="24" alt=""><br>
<div class="narrower">
<br>
<p>Before posting a problem in the forums, please use the new interactive Steam Support system..  It contains answers for many of the most common problems and questions.</p>
<p align="center"><a href="support.php">Use the Steam Support system.</a></p>
<p>Below are some forum usage guidelines. They are posted here as a general reminder in an effort to keep the forums friendly and usable for everyone.</p>
<ul><em>
<li style="list-style-image:url(./images/square2.gif);"> The forums are for everyone, new and advanced user alike.<br>
<br>
<li style="list-style-image:url(./images/square2.gif);"> Before you post a question, use the <a href="/forums/search.php" target="_blank">forum search feature</a> to determine whether your topic has already been covered.<br>
<br>
<li style="list-style-image:url(./images/square2.gif);"> Do not start flame wars. If you have a problem with someone, message that person and carry on a private discussion. Also, if someone has engaged in behavior that is a detriment to the message board -- spamming, flaming people, etc -- contact one of the forum moderators. Flaming the offensive user will only increase the problem.<br>
<br>
<li style="list-style-image:url(./images/square2.gif);"> Please post in the correct forum.<br>
<br>
<li style="list-style-image:url(./images/square2.gif);"> Administrators/Moderators reserve the right to change, edit, or delete any content at any time if they feel it is inappropriate.<br>
</em></ul>
<p>The bottom line is: respect others and you will be treated with respect. Be rude and disrespectful, and you'll not find much help here.</p>
<p align="center"><a href="forums/"> I agree to these terms.</a></p>
</div>
HTML;
$pageStmt->execute(['forums',null,'Forums',$forums_html,'2003_v1,2003_v2,2004,2005_v1,2005_v2,2006_v1,2006_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);


$steamidinstructions_html = <<<'HTML'
<html>
<head>
<title>SteamID instructions</title>
<style>
	<!--
	body { scrollbar-base-color: #4C5844; }
	body, p, td, h1 { font-family: Verdana; font-size: 12px; }
	h1 { font-size: 14px; font-weight: bold; }
	body { background:#4C5844; color:#D8DED3; }
	.content { background:#3E4637; }
	a { color: White; }
	-->
	</style>
</head>
<body bottommargin='\"20\"' leftmargin='\"20\"' marginheight='\"20\"' marginwidth='\"20\"' rightmargin='\"20\"' topmargin='\"20\"'>
<table cellpadding='\"10\"' cellspacing='\"0\"' class='\"content\"' height='\"100%\"' width='\"100%\"'>
<tr>
<td #56634d;\"="" 1px="" align='\"left\"' solid="" style='\"border:' valign='\"top\"' width='\"100%\"'>
<h1>How to find your Steam User ID</h1>

	Your Steam ID is your unique numeric identifier. It is the piece of identification that Steam uses to determine which games you own, whether you've ever cheated on a public game server, etc.<br/><br/>
	If you don't know your Steam ID, here's how to find it:<br/><br/>
	You must first connect to an internet game server. (If you've been banned by VAC for cheating, you'll have to find an "insecure" server for this purpose). After you're connected, open the console by pressing the tilde (~) key. In the console, type "status" (without quotes). Look for your own player name, and note the number that follows it. This is your official Steam ID.<br/>
</td>
</tr>
</table>
</body>
</html>
HTML;

$pageStmt->execute(['steamid_instructions',null,'SteamID instructions',$steamidinstructions_html,'2003_v2,2004,2005_v1,2005_v2','none.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$ded_html = <<<'HTML'
<!-- dedicated server -->
<h1>Dedicated Server update files</h1>
<h2>WINDOWS<em> AND LINUX VERSIONS</em></h2><img src="Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
For those server admins who have trouble with the Steam HLDS update tool, or have trouble getting the dedicated server update through Steam, here are the changed files.<br>
<br>
<h3 style="text-transform:uppercase;">March 23rd (CS:CZ) Release</h3>
NOTE: This release includes only those files which have changed since the last dedicated server release. This download is an update only -- it requires that you have a Half-Life dedicated game server already installed. If you're looking for the full dedicated server Steam installer, you can find it on the <a href="/?area=getsteamnow">Get Steam Now</a> page (towards the bottom).<br><br>
<b>NOTE: This download requires you to have <a href="http://www.bitconjurer.org/BitTorrent/download.html">BitTorrent</a> installed.</b><br>
<br>
<a href="files/HLserver/mar22/czero_dedicated_server_032204.zip.torrent">Windows Dedicated Server Update</a><br>
<br>
<a href="files/HLserver/mar22/czero_dedicated_server_linux_032204.tgz.torrent">Linux Dedicated Server Update</a><br>
</div>
HTML;
$pageStmt->execute(['dedicated_server',null,'Dedicated Server update files',$ded_html,'2003_v1,2003_v2,2004,2005_v1,2005_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$css_html = <<<'HTML'
<!-- CS:S Beta 1 FAQ -->
<h1>COUNTER-STRIKE: SOURCE</h1>
<h2>BETA 1 <em>QUESTIONS AND ANSWERS</em></h2><img src="Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
<ul>
<li style="list-style-image:url(./images/square2.gif);"> <a href="#q1"><em>When will Counter-Strike: Source beta 1 be released?</em></a>
<li style="list-style-image:url(./images/square2.gif);"> <a href="#q2"><em>How can I get Counter-Strike: Source beta 1?</em></a>
<li> <a href="#q3"><em>I am a member of the Valve Cyber Caf&eacute; Program, or I own Condition Zero.  How will I know when Counter-Strike: Source beta 1 is available?</em></a>
<li> <a href="#q8"><em>If I purchased the ATI/Half-Life 2 Video Card bundle, how do I participate in the Counter-Strike: Source Beta??</em></a>
<li> <a href="#q4"><em>Can I get access to the beta if I am not part of the Valve Cyber Caf&eacute; Program, and do not own Condition Zero?</em></a>
<li> <a href="#q5"><em>How will Counter-Strike: Source be different from the Half-Life 1 based Counter-Strike?</em></a>
<li> <a href="#q6"><em>What will the system requirements be for Counter-Strike: Source?</em></a>
<li> <a href="#q7"><em>Do I get to keep Counter-Strike: Source after the beta period has ended?</em></a>
</ul>
<table cellspacing="3" cellpadding="3" align="center">
<tr>
        <td colspan="2" align="center"><hr style="width: 100%;"></td>
</tr>
<tr bgcolor="#606060">
        <td><a href="cs_source_01.jpg"><img src="cs_source_01_tn.jpg"></td>
        <td><a href="cs_source_02.jpg"><img src="cs_source_02_tn.jpg"></td>
</tr>
<tr>
        <td colspan="2" align="center"><hr style="width: 100%;"></td>
</tr>
</table>
<p>Starting later this summer, Valve will be conducting a limited-time beta of Counter-Strike: Source via Steam.</p>
<p>The beta will first be open to subscribers of the Valve Cyber Caf&eacute; Program, and then extended to owners of Counter-Strike: Condition Zero and owners of ATI Half-Life 2 vouchers.</p>
<p>If you do not already have a Steam account, you can create a Steam account and use your ATI/Half-Life 2 product key printed on the coupon that came with the video card.  Once you have entered the key, you will be prompted to join the beta.</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?area=getsteamnow">Click here to install Steam</a></p>
<p>If you have a Steam account and have not yet registered your ATI/Half-Life 2 product key printed on the coupon that came with the video card, you can register your key below and join the beta.</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="steam://open/registerproduct/">Click here register your ATI key</a></p>
<p>No.</p>
</div>
HTML;
$pageStmt->execute(['css_b1',null,'Counter-Strike: Source Beta 1 FAQ',$css_html,'2003_v1,2003_v2,2004,2005_v1,2005_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$pricing_html = <<<'HTML'
<h1>PRICING AND LICENSING</H1>
<h2>Valve&aposs<em> OFFICIAL CYBER CAF&Eacute; PROGRAM</em></h2><img src="Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

Valve&aposs Official Cyber Caf&eacute; Program makes things simple for the caf&eacute; owner.<br>
<br>
<h3 style="text-transform:uppercase;">One low monthly fee</h3>
For a low monthly fee per licensed computer, your caf&eacute; gets access to all of Valve&aposs games. See the <a href="index.php?area=cybercafe_program">full list of Features and Benefits</a> for the details of what's included. Payment is handled in three-month blocks, in advance, either by recurring automatic billing or by invoice. <!-- For full details about licensing, payment, and the details of the Caf&eacute; Program, please see the official <a href="cafe_signup.php">Valve Cyber Caf&eacute; Agreement</a>. --><br>
<br>
<!--
<h3 style="text-transform:uppercase;">APRIL CYBER CAF&Eacute; PROMOTION</h3>
During the month of April 2004, Valve is extending a <a href="index.php?area=cybercafe_promotion">special offer to Cyber Caf&eacute;s</a>. During this time, a 12-month cyber caf&eacute; license for Valve&aposs games is being offered at a savings of 33%. <a href="/?area=cybercafe_promotion">See this page for details</a>.<br>
<Br>
-->
<h3 style="text-transform:uppercase;">Fully licensed software</h3>
Software purchased at retail is not licensed for commercial use such as cyber caf&eacute; play. If you operate a gaming center, our program is the legal way to obtain a commercial license and offer Valve&aposs games to your customers.<br>
<br>
<h3 style="text-transform:uppercase;">As Always, Tournament Licenses Are Free</h3>
If you'd like to host a LAN event or competition, just <a href="mailto:cafe@valvesoftware.com">let us know</a> and we'll issue you a Tournament License, free of charge.<br>
<br>
<a href="index.php?area=cafe_signup">Sign up now for the CyberCaf&eacute; Program!</a><br>
<br>
<a href="index.php?area=cybercafes">Return to main Cyber Caf&eacute; page</a>

</div>
HTML;
$pageStmt->execute([
    'cafe_pricing',
    null,
    'Cyber Café Pricing and Licensing',
    $pricing_html,
    null,
    'default.twig',
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s'),
    'published'
]);

$cdaccountfaq_html = <<<'HTML'
<div class="content" id="container">
<h1>CD KEYS AND STEAM ACCOUNTS</h1>
<h2><em>FREQUENTLY</em> ASKED QUESTIONS</h2><img src="/web/20040414001040im_/http://www.steampowered.com/img/Graphic_box.jpg" height="6" width="24" alt=""><br><br>

<div class="narrower">

<h3>How do "accounts" and "CD keys" work in Steam?</h3>

<ul>
<p>When you sign up for Steam, you create a Steam account, which contains all of your Steam games.  You can use your Steam account on any computer, so that you can play your games no matter whether you're at home, at work, or on a friend's computer.  If you buy a new computer or need to re-format your old computer, you can keep using your old account-Steam will automatically download all of your information to the new computer.  Although you can use your account at any computer, it can only be used at one computer at a time.</p>

<p>CD keys are special serial numbers printed on retail copies of Half-Life and other games in the Half-Life family.  Before Steam, this key was used as an anti-piracy measure, and became the user's unique ID code when playing the game online.  With Steam, the CD key can be used as a "Proof of Purchase" code that will grant your Steam account access to some of the available games through Steam.</p>

<p>Each CD key may only be used with one Steam account. Once used, it is permanently bound to that account, and may not be used with another. Deleting the account will not free the CD key to be used again.  One Steam account, however, may have more than one CD key registered to it. For instance, if you have an account with a Counter-Strike CD key registered to it, and you purchase HL2 in the store, you may use the HL2 key on your Steam account to grant access to HL2.</p>
</ul>

<h3>When I try to enter my CD key, Steam says my key is already in use.</h3>

<ul>
<p><strong style="color: White;">Have you previously used this CD key with another account?</strong><br>
A CD key can only be used with one account.  To play this game, you'll need to use the account you originally registered your CD key with.  See the accounts section below if you need help accessing your old account.</p>

<p><strong style="color: White;">Has anyone else already used this CD key?</strong><br>
A CD key can only be used with one account.  If anyone else has used this key, you won't be able to use it.  This can happen if you've shared your key with a friend, if you've been given this key by a friend, or if you bought the game used.</p>

<p><strong style="color: White;">Did you just buy this game?</strong><br>
If you just bought this game in the past few days and were unable to register the CD key, please contact us.  Send mail to <a href="https://web.archive.org/web/20040414001040/mailto:support@steampowered.com">support@steampowered.com</a> with the CD key and information about when and where you bought the game.</p>
</ul>


<h3>I created a Steam account a while ago, and now I can't access it.</h3>
<ul>
<p><strong style="color: White;">Do you know your account name?</strong><br>
If you know your account name but have forgotten your password, you can reset your password using the "Reset Password" button on the login screen.</p>

<p><strong style="color: White;">Have you forgotten your account name?</strong><br>
Your account name is likely to be your email address, or perhaps an old email address that you used in the past.  Try logging in using any old email addresses you might have used.</p>

<p><strong style="color: White;">Are you still unable to access your account?</strong><br>
Unfortunately, if you can't remember your account name or are unable to reset your password, you will not be able to access your account.  You will need to create a new Steam account.</p>
</ul>

<h3>I've tried everything, and I still can't get my CD key to work.</h3>

<ul>
<p><strong style="color: White;">Do you still have your original retail package with the printed CD key?</strong><br>
If you still have your original printed CD key, we can reset your key.  This will remove it from the account that is currently using it, and add it to your account.  To do this, you will need to have a working Steam account (create a new one, if you don't have access to your old account).  You will need to mail us the original printed CD key, along with your email address and the Steam account that you want the CD key assigned to.  Please note that we need the original CD key-we are unable to accept copies or photos.  Send your package to:</p>

<ul>CD Key Reset<br>
Valve Software<br>
PO Box 1688<br>
Bellevue WA 98009<br>
USA</ul>

<p><strong style="color: White;">Have you lost the original retail package?</strong><br>
If you don't have the original retail package with the printed CD key and you're unable to get access to your Steam account, we will be unable to help you.</p>
<br><br>
</ul>


<h2>OTHER QUESTIONS</h2><br>

<h3>Is my Steam Account Name my email address?</h3>
<ul>
<p>Your Steam Account Name is what you enter into the "Account Name" field of the Login screen to log in to Steam. This may or may not be the same as your email address.</p>

<p>Before March 3, 2004, Steam Account Names were email addresses. After that date, new accounts could be created that were not necessarily email addresses. Also, the option was added to change the email address associated with your Steam Account.</p>

<p>Currently, you can not change the Account Name of your Steam Account. However, in the future this feature may be added.</p>

<p>In the Steam Settings window, you have the option of changing the contact email address associated to your Steam Account. If you do this, a verification email will be sent to that address with a special code. You then enter that code into Steam to validate the new email address.</p>

<p>Note that this does not change your Steam Account Name. Even if your Account Name is the same as your old email address. It may seem a little odd to type your old email address in the Login screen, but that is the way it works. </p>
</ul>

<h3>How do I delete my Steam account?</h3>
<ul>
<p>To delete your Steam Account, you must contact us. Deleting your account will not allow you to use any of the cd-keys registered to it on a new account. It will also not cause any previous purchases through Steam to be refunded.</p>
</ul>

<h3>What if the Valve Anti-Cheat system (VAC) bans me? How to I make my account work again?</h3>
<ul>
<p>Please visit <a href="index.php?area=cheat_form">this page</a>, read about VAC, and submit the form if necessary. </p>
</ul>

<h3>Where do I get a new CD key?</h3>
<ul>
<p>For now, you you'll need to buy a new copy of your game in a retail store or from an online retailer. </p>
</ul>

<h3>Do I get a CD key if I buy my games on Steam?</h3>
<ul>
<p>No.  When you buy games directly through Steam, your SteamID serves as your online identifier, and proof of your purchase is attached to your Steam account records. The CD key is therefore unnecessary.</p>
</ul>
<img src="https://web.archive.org/web/20040414001040im_/http://steampowered.com/img/Graphic_box.jpg" height="6" width="100%"><br><br>
<h3>I've read through these issues, but I still need help</h3>
If you have a problem related to CD Keys or your Steam account which is not covered above, then please tell us about it using <a href="https://web.archive.org/web/20040414001040/http://steampowered.com/index.php?area=cd_account_form">this form</a>.

</div>
</div>
HTML;
$pageStmt->execute(['cd_account_faq',null, 'CD Keys and Steam Accounts',$cdaccountfaq_html,'2003_v2,2004,2005_v1,2005_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$autoupdate_html = <<<'HTML'
<html style="--wm-toolbar-height: 67px;">
<head>
	<title>Auto-Update via Steam</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta name="ROBOTS" content="ALL">
	<meta name="DESCRIPTION" content="Valve - Steam">
	<meta name="KEYWORDS" content="Steam">
	<meta name="AUTHOR" content="Valve">
	<meta http-equiv="refresh" content="300">
	<link rel="stylesheet" type="text/css" href="steampowered.css">
<body>

<!-- begin header -->
<div class="header">
<nobr><a href="index.php"><img src="steam_logo_onblack.gif" align="top" alt="[Valve]" height="54" width="152"></a>
</nobr>
</div>
<!-- end header -->

<center>
<div style="
	width:440px;
	background:url(bg.jpg);
	text-align:center;
	padding:24px 48px 32px 48px;
	color:black;
	border:8px solid black;
	line-height:150%;
	">

<img border="0" src="./images/dod_logo.gif"><br>
<br><br>
<b style="font-size:14px;">The version of Day of Defeat you currently<br>have installed is now out of date.</b><br>
<br>
In order to continue playing online using the Valve master servers, you'll need to upgrade to the latest version of the game.  A free upgrade for this game is provided via Steam.  To get the latest version of DoD, install Steam using the link below.  Steam will then keep DoD (and your other Valve games) up to date automatically.<br>
<br><br>
<a style="background:black;padding:6px;font-weight:bold;" href="index.php/?area=getsteamnow">Get Steam Now</a><br>
<br><br>
<a style="background:black;padding:6px;font-weight:bold;" href="index.php">More information about Steam</a><br>
</div>
</center>
<br><br><br><br>
<!-- begin footer -->
<div class="footer">
	<a href="https://web.archive.org/web/20040901032055/http://www.valvesoftware.com/"><img src="valve_greenlogo.gif" align="left"></a>{{footer()}}</div>
<!-- end footer -->
</body></html>
HTML;
$pageStmt->execute(['autoupdate',null, 'Auto-Update via Steam',$autoupdate_html,'2003_v2,2004,2005_v1,2005_v2','none.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);

$cafeprogram_html = <<<'HTML'
<h1>FEATURES AND BENEFITS</h1>
<h2>OF Valve&aposs<em> OFFICIAL CYBER CAFÉ PROGRAM</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

<img src="./images/valve_maizelogo.gif" align="left">If you run a cybercafe or other gaming venue, Valve makes it easy for you to bring our games to your customers. When you <a href="index.php?area=cafe_signup">sign up</a> and become a memeber of our Cybercafé program, you'll enjoy the following benefits:<br>
<br>
<h3 style="text-transform:uppercase;">Current &amp; future products</h3>
Cyber Café subscribers automatically receive access to newly released products in the Cyber Café program as long as they continue their regular monthly subscription.<br>
<br>

Products currently included in the Cyber Café Program are:<br>
<ul>
{{ theme_specific_content_start('2005_v1,2005_v2') }}
	 <li>Half-Life 2</li>
	 <li>Half-Life 2: Deathmatch</li>
	 <li>Half-Life: Source</li>
	 <li>Counter-Strike: Source</li>
 {{ theme_specific_content_end() }}
	 <li>Counter-Strike</li>
	 <li>Counter-Strike: Condition Zero {{ theme_specific_content_start('2003_v2') }} (available upon release to retail) {{ theme_specific_content_end() }}</li>
	 <li>Deathmatch Classic</li>
	 <li>Day of Defeat</li>
	 <li>Half-Life</li>
	 <li>Opposing Force</li>
	 <li>Half-Life Deathmatch</li>
	 <li>Ricochet</li>
	 <li>Team Fortress Classic</li>
</ul>
<br>

<h3 style="text-transform:uppercase;">Automatic Updates Delivered Via Steam</h3>
All of your game subscriptions will be kept up-to-date with the latest versions using Steam's distribution system. New content, bug fixes, and other items which have traditionally been distributed as "patches" will be handled automatically.<br>
<br>
<h3 style="text-transform:uppercase;">Fully licensed software and product keys</h3>
When you sign up and become a member of our Cybercafé program, Valve will provide you with software and product keys for each computer you have licensed. <br>
<!-- All commercial licensing of Valve&aposs software is done directly with Valve Corporation -- games purchased at a retail store do not include a license for commercial cyber café use. -->
<br>
<h3 style="text-transform:uppercase;">Access to Valve Product Support</h3>
Members will have priority access to Valve&aposs product support services, for Steam issues and any game-related problems.<br>
<br>
<h3 style="text-transform:uppercase;">Product Key Protection</h3>
Valve&aposs Cyber Café program also protects members against banned accounts. We understand that it is sometimes difficult to prevent users from misusing your computers. To help combat this problem, cafés in the program can contact Valve to correct problems with "banned" accounts.<br>
<br>
<h3 style="text-transform:uppercase;">promotional materials</h3>
We've got plenty of posters for your walls and windows, and other fun stuff that we'll send you when you sign up.<br>
<br>
<h3 style="text-transform:uppercase;">Free Tournament License</h3>
Any time you'd like to host a gaming tournament or other local event, just drop us a line and let us know the details. We'll send you a tournament license right away, free of charge.<br>
<br>
<a href="index.php?area=cafe_signup">Sign up now!</a><br>
<br>
<a href="index.php?area=cybercafes">Return to main Cyber Café page</a>

</div>
HTML;

$pageStmt->execute(['cybercafe_program',null,'Cyber Café Program',$cafeprogram_html,'2003_v2,2004,2005_v1,2005_v2','default.twig',date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),'published']);


$dirStmt = $pdo->prepare('INSERT INTO cafe_directory(url,name,phone,address,city_state,zip,ord) VALUES(?,?,?,?,?,?,?)');
$defaultCafes = [
                ['http://www.gparadise.com','Gamers Paradise (IGUK)','(178) 424-7985','5 Station Road','Ashford','TW15 2UW'],
                [null,'Fragz R Us Ltd','+441268271650','11 East Walk','Basildon, Essex','SS141HG'],
                ['http://ozzis.co.uk','Ozzi\'s Online Gaming (IGUK)','(192) 447-1777','23 Commercial Street','Batley','WF17 5HJ'],
                ['http://www.quarks.co.uk','Quarks - Reading (IGUK)','0118 9782229','7 Union Street - Reading','Berkshire','RG1 1EU'],
                ['http://www.dotcomicide.net','Dotcomicide (IGUK)','(+44) (0) 1214725248','616 Bristol Road - Selly Oak','Birmingham','B29 6BQ'],
                [null,'NetAdventure/GlobalGaming Arena (IGUK)','44-121-693-6655','68-70 Dalton Street - Dale End','Birmingham','B4 7LX'],
                ['http://www.wireworld.co.uk','Wireworld Bournemouth','(44) 1202 859680','280 Charminster Road','Bournemouth','BH8 9RT'],
                [null,"Surf 'N' Play (IGUK)",'44 (0) 117 950 8833','14 High Street - Westbury on Trym','Bristol','BS93DU'],
                ['http://www.thelanrooms.co.uk','The LAN Rooms (IGUK)','973-3886','6 Cotham Hill - Cotham','Bristol','BS6 6LF'],
                ['http://www.plexusweb.co.uk','Plexus (IGUK)','01282 422858','5 Yorkshire St','Burnley','BB11 2DB'],
                ['http://www.cyberemporium.co.uk','Cyber Emporium (IGUK)','01298214455','28 High Street','Buxton','SK17 6EU'],
                ['http://lansport.co.uk','Lansport(iGUK)','332344177','Agard street','Derby','DE1 1DZ'],
                ['http://www.ubernet.org.uk','I.G.Net/UberNet (IGUK)','01382 322949','6 Panmure street','Dundee','DD5 2ll'],
                ['http://www.impactgaming.co.uk','Impact Gaming Ltd','01323 642299','21a Langney Road','Eastbourne','Bn21 3QA'],
                ['http://www.netplay.co.uk','NetPlay LTD (IGUK)','01424 853996','117-119 Seaside Road','Eastbourne','BN21 3PH'],
                ['http://www.cyber-gamer.net','CyberNetHX (IGUK)','01422 300011','1-9 Silver Street','Halifax','HX1 1HS'],
                ['http://cyberscene.co.uk','Cyberscene(IGUK)','01279 419111','Shop 4 Bush house - Bush fair shopping centre','Harlow,Esssex','cm18 6ns'],
                ['http://www.harrowarena.com','HarrowArena (IGUK)','02088638264','276 Station Road','Harrow','HA1 2EA'],
                ['http://www.webfrenzy.co.uk','Web Frenzy ltd (IGUK)','01424 426777','1 Breeds Place','hastings','TN34 3AA'],
                ['http://www.cyber-gamer.net','CyberNetHD(IGUK)','713497','80 John William Street','Huddersfield','HD6 3RG'],
                [null,'Compsel Ltd/The Hub (IGUK)','(441) 482-6582','206 Newland Avenue','Hull','HU106JG'],
                ['http://www.equestiow.tk','E-Quest (IGUK)','(198) 353-2597','14 Scarrots Lane - Newport','Isle of Wight','PO30 1JD'],
                ['http://www.cafeclix.co.uk','Cafe Clix (IGUK)','01926 863200','46 Abby End','Kenilworth','CV8 1QJ'],
                ['http://www.gamesgenius.com','Games Genius Limited(IGUK)','355- 281','10 High Street - Gravesend','Kent','DA11 0BQ'],
                ['http://www.lcionline.co.uk','LCI Online (IGUK)','264-0620','1093-1095 Melton Road - Syston','Leicester','LE7 2JS'],
                ['http://www.gametheworld.com','GAMETHEWORLD Lisburn (IGUK)','02892 628880','3 Graham Gardens','Lisburn','BT28 1 XE'],
                ['http://www.lanforce.co.uk','LANFORCE','','1st Floor - 6 & 8 Norwich Street','Norfolk','NR21 9AE'],
                ['http://www.battlenet.co.uk','Battlenet (IGUK)','01603 765595','2a Queens Road','Norwich','NR2 3PR'],
                [null,'CombatStrike Ltd.','44 115 9881880','The Cornerhouse - Burton Street','Nottingham','NG9 5EA'],
                [null,'Gamecentre2 (IGUK)','01723 500505','1 Harcourt Place','SCARBOROUGH','YO11 2EP'],
                ['http://www.starbytes.co.uk','StarBytes Cyber Cafes Limited (IGUK)','023 8033 0000','12 New Road','Southampton','SO14 0AA'],
                ['http://www.xcession.com','Xcession Cybercafe (IGUK)','245-6549','Stevenage Leisure Centre - Lytton Way','Stevenage','SG1 1LZ'],
                ['http://enamorgaming.co.uk','Enamor (IGUK)','01915658855','46 Frederick Street','Sunderland','SR1NF'],
                ['http://www.quarks.co.uk','Quarks - Guildford (IGUK)','','7 Jeffries Passage - Guildford','Surrey','GU1 4AP'],
                ['http://www.quarks.co.uk','Quarks - Richmond (IGUK)','','4 Red Lion Street - Richmond','Surrey','TW3 1RW'],
                ['http://www.wiredinn.co.uk','Wired Inn (IGUK)','(0) 1793 430 300','Fleetway House - Queen Street','SWINDON','SN1 1RN'],
                ['http://www.escape-interactive.com','e-scape (IGUK)','+44 (0) 1926 887211','111 Warwick Street - Leamington Spa','Warwickshire','CN32 4QZ'],
                ['http://www.ecobwebs.co.uk','Cobwebs (IGUK)','01305 779688','28 St Thomas Street','Weymouth','DT4 8EJ'],
                ['http://www.cyber-realm.co.uk','Cyber Realm Limited (IGUK)','07739 024954','56 High Street','Wickford','SS12 9AT'],
                [null,"Snor'z Game Systems Ltd (IGUK)",'01902 781451','Unit 10 Marsh Lane Parade - Stafford Road','Wolverhampton','WV10 6RT'],
                ['http://www.lan-den.net','landen ltd(IGUK)','(190) 5 2-6260','Top floor,22-24 New street','worcester','WR1 2DN']
            ];
            $ord = 1;
            foreach ($defaultCafes as $c) {
                $dirStmt->execute(array_merge($c, [$ord++]));
            }

            $repStmt = $pdo->prepare('INSERT INTO cafe_representatives(url,website,email,rep_name,address,city_province,zip,country,phone,ord) VALUES(?,?,?,?,?,?,?,?,?,?)');
            $defaultReps = [
                ['http://www.transferbg.com/','TRANSFER GROUP LTD.','transfer@transferbg.com','Vasil Enfedzhiyan','80 Danail Nikolaev Street','Plovdiv','4000','Bulgaria','359 32 624 080'],
                ['http://www.ledzone.com/index_steam.html','NAMCO LIMITED','steam@ledzone.com','Reina Yagishita','Tokyu-Plaza Annex 2F','Tokyo','144-0051','Japan',''],
                ['http://www.valvepcbang.com/','GNA Soft Co., Ltd.','west@gnasoft.com','Sean Lee','249-4 Urban Light Bldg 7th Floor','Seoul','135-010','Korea',''],
                ['http://www.boomtown.net/','BOOMTOWN','JAPC@cafe.boomtown.net','Jakob Christiansen','Larslejsstrde 6','Kobenhavn C, Copenhagen','0900','Denmark','+45-51909111'],
                ['http://www.computergames.ro/','COMPUTER GAMES ONLINE SRL','silviu@computergames.ro','Silviu Stroie','Unirii 75 Blvd, bl. H1','Bucharest','','Romania',''],
                ['http://www.unalis.com.tw/','UNALIS CORPORATION','leon@unalis.com.tw','Leon Chang','10F, No 168 SEC 2','Taipei','','Taiwan','']
            ];
            foreach ($defaultReps as $r) {
                $repStmt->execute(array_merge($r, [$ord++]));
            }
            $stmt2 = $pdo->prepare('REPLACE INTO themes(name, css_path) VALUES(?,?)');
            foreach (glob(__DIR__.'/themes/*', GLOB_ONLYDIR) as $dir) {
                $name = basename($dir);
                if (substr($name, -6) === '_admin') {
                    continue;
                }
                $css = 'steampowered02.css';
                if (!file_exists("$dir/css/$css")) {
                    $css = file_exists("$dir/css/steampowered.css") ? 'steampowered.css' : '';
                    if ($css === '') {
                        $files = glob("$dir/css/*.css");
                        $css = $files ? basename($files[0]) : '';
                    }
                }
                $css_path = $css ? 'css/'.$css : '';
                $stmt2->execute([$name,$css_path]);
                $cfg_file = "$dir/config.php";
                if (file_exists($cfg_file)) {
                    $cfg = include $cfg_file;
                    if (is_array($cfg)) {
                        $set = $pdo->prepare('REPLACE INTO theme_settings(theme,name,value) VALUES(?,?,?)');
                        foreach ($cfg as $k => $v) {
                            $set->execute([$name,$k,(string)$v]);
                        }
                    }
                }
                $sql_dir = "$dir/sql";
                if (is_dir($sql_dir)) {
                    foreach (glob($sql_dir.'/*.sql') as $sql) {
                        $sqlContent = file_get_contents($sql);
                        // Convert from detected encoding to UTF-8
                        $sqlContent = ensureUtf8Encoding($sqlContent);
                        $sqlContent = normalizeSqlDates($sqlContent);
                        $pdo->exec($sqlContent);
                    }
                }
            }

            // Add 2008 theme default tabbed capsule data
            try {
                // Insert default tabbed capsules
                $tabStmt = $pdo->prepare('INSERT INTO tabbed_capsules (id, tab_name, tab_order, active) VALUES (?, ?, ?, ?)');
                $tabStmt->execute([1, 'New releases', 1, 1]);
                $tabStmt->execute([2, 'Top Sellers', 2, 1]);
                $tabStmt->execute([3, 'Top Rated', 3, 1]);
                $tabStmt->execute([4, 'Coming soon', 4, 1]);

                // Add some sample apps for 2008 theme (historical games from that period)
                $appStmt = $pdo->prepare('INSERT IGNORE INTO store_apps (appid, name, price, release_date, publisher, genre) VALUES (?, ?, ?, ?, ?, ?)');
                $appStmt->execute([22300, 'Fallout 3', 49.99, '2008-10-28', 'Bethesda Softworks', 'RPG']);
                $appStmt->execute([19980, 'Prince of Persia', 49.99, '2008-12-09', 'Ubisoft', 'Action']);
                $appStmt->execute([10090, 'Call of Duty: World at War', 49.99, '2008-11-11', 'Activision', 'Action']);
                $appStmt->execute([500, 'Left 4 Dead', 49.99, '2008-11-17', 'Valve', 'Action']);
                $appStmt->execute([8140, 'Tomb Raider: Underworld', 39.99, '2008-11-18', 'Eidos Interactive', 'Action']);
                $appStmt->execute([19900, 'Far Cry 2', 49.99, '2008-10-21', 'Ubisoft', 'Action']);
                $appStmt->execute([12210, 'Grand Theft Auto IV', 49.99, '2008-12-02', 'Rockstar Games', 'Action']);
                $appStmt->execute([3560, 'Bejeweled Twist', 19.99, '2008-10-17', 'PopCap Games', 'Casual']);
                $appStmt->execute([21000, 'LEGO Batman', 29.99, '2008-09-23', 'Warner Bros', 'Action']);
                $appStmt->execute([12900, 'AudioSurf', 9.99, '2008-02-15', 'Invisible Handlebar', 'Indie']);

                // Add games to tabs
                $gameStmt = $pdo->prepare('INSERT INTO tabbed_capsule_games (tab_id, appid, game_order) VALUES (?, ?, ?)');
                
                // New releases tab
                $gameStmt->execute([1, 22300, 1]);
                $gameStmt->execute([1, 19980, 2]);
                $gameStmt->execute([1, 10090, 3]);
                $gameStmt->execute([1, 8140, 4]);
                
                // Top Sellers tab
                $gameStmt->execute([2, 500, 1]);
                $gameStmt->execute([2, 12210, 2]);
                $gameStmt->execute([2, 10090, 3]);
                $gameStmt->execute([2, 22300, 4]);
                
                // Top Rated tab
                $gameStmt->execute([3, 500, 1]);
                $gameStmt->execute([3, 22300, 2]);
                $gameStmt->execute([3, 12900, 3]);
                $gameStmt->execute([3, 12210, 4]);
                
                // Coming soon tab
                $gameStmt->execute([4, 19980, 1]);
                $gameStmt->execute([4, 12210, 2]);
                $gameStmt->execute([4, 21000, 3]);
                $gameStmt->execute([4, 3560, 4]);

                // Add 2008 theme configuration
                $settingsStmt = $pdo->prepare('INSERT IGNORE INTO settings (`key`, value) VALUES (?, ?)');
                $settingsStmt->execute(['2008_theme_installed', '1']);
                $settingsStmt->execute(['theme', '2008']);
                
            } catch (PDOException $e) {
                // Ignore errors for now as this is sample data
            }

            // Install the 2002 forum schema using the CMS connection so data lives
            // in the same database as the rest of the site.
            $forumSqlPath = __DIR__ . '/2002_forum/db.sql';
            if (file_exists($forumSqlPath)) {
                foreach (['posts', 'threads', 'boards', 'users'] as $forumTable) {
                    $pdo->exec("DROP TABLE IF EXISTS `$forumTable`");
                }

                run_sql_file($pdo, $forumSqlPath);

                // Use the same credentials as the CMS admin so they can log in without re-registering
                $forumAdminUsername = $admin_user;
                $forumAdminPassword = $admin_pass;
                $forumAdminEmail    = $admin_email;

                // Remove the default admin created by db.sql (if any)
                $pdo->exec("DELETE FROM users WHERE username = 'admin'");

                // Check if admin user already exists
                $forumUserCheck = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
                $forumUserCheck->execute([$forumAdminUsername]);

                if ((int) $forumUserCheck->fetchColumn() === 0) {
                    $now = date('Y-m-d H:i:s');
                    $forumInsert = $pdo->prepare(
                        'INSERT INTO users '
                        . '(username, passhash, email, registered, last_login, signature, is_mod, is_admin, banned) '
                        . 'VALUES (?,?,?,?,?,?,?,?,?)'
                    );
                    $forumInsert->execute([
                        $forumAdminUsername,
                        password_hash($forumAdminPassword, PASSWORD_DEFAULT),
                        $forumAdminEmail,
                        $now,
                        $now,
                        '',
                        1,  // is_mod
                        1,  // is_admin
                        0,  // banned
                    ]);
                }
            }

            // Install phpBB forum (uses same database with phpbb_ prefix)
            $phpbbInstallConfig = [
                'host' => $host,
                'port' => $dbPort,
                'dbname' => $dbname,
                'user' => $user,
                'pass' => $pass,
                'root_path' => $root_path,
                'phpbb_cookie_name' => $config['phpbb_cookie_name'] ?? 'stmserverbb__',
                'phpbb_board_email' => $config['phpbb_board_email'] ?? 'forum@steampowered.com',
            ];

            try {
                install_phpbb_forum($pdo, $phpbbInstallConfig, $admin_user, $admin_pass, $admin_email);
                echo "✓ phpBB forum installed successfully\n";

                // Install historical 2004 forum data if checkbox was checked
                if ($install_historical_data) {
                    echo "Installing historical 2004 forum data...\n";

                    // Try complete file first (with real content), then attachments version, then basic fallback
                    $historical_sql_files = [
                        __DIR__ . '/scripts/historical_forum_data_complete.sql',  // Complete file with real extracted content
                        __DIR__ . '/scripts/historical_forum_data_with_attachments.sql',  // Fallback with attachments
                        __DIR__ . '/scripts/historical_forum_data.sql',  // Basic fallback
                    ];

                    $historical_data_installed = false;
                    foreach ($historical_sql_files as $historical_sql_file) {
                        if (file_exists($historical_sql_file) && !$historical_data_installed) {
                            try {
                                // Use detailed per-statement execution for better error reporting
                                $hist_sql = file_get_contents($historical_sql_file);
                                $hist_sql = ensureUtf8Encoding($hist_sql);
                                $hist_stmts = split_sql_statements($hist_sql);
                                $hist_ok = 0;
                                $hist_err = 0;
                                foreach ($hist_stmts as $hist_stmt) {
                                    $hist_stmt = trim($hist_stmt);
                                    if ($hist_stmt === '') continue;
                                    try {
                                        $pdo->exec($hist_stmt);
                                        $hist_ok++;
                                    } catch (PDOException $he) {
                                        $hist_err++;
                                        // Log first 200 chars of failing statement for debugging
                                        $preview = substr($hist_stmt, 0, 200);
                                        error_log("Historical SQL error: {$he->getMessage()} | Statement: {$preview}");
                                    }
                                }
                                echo "✓ Installed historical forum data from: " . basename($historical_sql_file) . " ($hist_ok OK, $hist_err errors)\n";
                                $historical_data_installed = true;
                            } catch (Exception $e) {
                                error_log('Historical forum data installation error (' . basename($historical_sql_file) . '): ' . $e->getMessage());
                                echo "⚠ Failed to install from " . basename($historical_sql_file) . ": " . $e->getMessage() . "\n";
                            }
                        }
                    }

                    if (!$historical_data_installed) {
                        echo "⚠ No historical forum data files found in scripts/ directory\n";
                    }

                    // Install attachment files from staging directory
                    $attachments_staging = __DIR__ . '/attachments_staging';
                    $phpbb_files_dir = __DIR__ . '/forum/files';
                    if (is_dir($attachments_staging)) {
                        try {
                            if (!is_dir($phpbb_files_dir)) {
                                mkdir($phpbb_files_dir, 0755, true);
                            }

                            $attachment_files = glob($attachments_staging . '/attachment_*.???*');
                            $copied_count = 0;

                            foreach ($attachment_files as $source_file) {
                                $filename = basename($source_file);
                                if (preg_match('/attachment_(\d+)\.(\w+)/', $filename, $matches)) {
                                    $vb_id = intval($matches[1]);
                                    $extension = $matches[2];
                                    $phpbb_id = 100000 + $vb_id;
                                    $timestamp = time();
                                    $dest_filename = "{$phpbb_id}_{$timestamp}.{$extension}";
                                    $dest_file = $phpbb_files_dir . '/' . $dest_filename;

                                    if (copy($source_file, $dest_file)) {
                                        chmod($dest_file, 0644);
                                        $copied_count++;
                                    }
                                }
                            }

                            if ($copied_count > 0) {
                                echo "✓ Installed {$copied_count} historical attachment files\n";
                            }
                        } catch (Exception $e) {
                            error_log('Historical attachment installation error: ' . $e->getMessage());
                            echo "⚠ Historical attachment installation failed: " . $e->getMessage() . "\n";
                        }
                    }

                    // Install vBulletin SQL dump import (full database) AFTER the archived page data
                    // This contains the complete forum database and uses INSERT IGNORE
                    // so it won't overwrite any records already inserted above
                    $vbulletin_import_file = __DIR__ . '/scripts/historical_forum_vbulletin_import.sql';
                    if (file_exists($vbulletin_import_file)) {
                        echo "Installing vBulletin database import (this may take a while)...\n";
                        @ob_flush(); @flush();

                        // Force-disable execution timeout & raise memory regardless of php.ini.
                        // Apache may not have been restarted to pick up php.ini changes; these
                        // ini_set/set_time_limit calls override for this request.
                        @set_time_limit(0);
                        @ini_set('max_execution_time', '0');
                        @ini_set('max_input_time', '-1');
                        @ini_set('memory_limit', '2048M');
                        @ignore_user_abort(true);

                        // Strategy: stream the dump, parse INSERT-IGNORE row tuples into
                        // per-table TSV chunks, and bulk-load each chunk with
                        // `LOAD DATA LOCAL INFILE`. This is the canonical fast path for
                        // restoring large mysqldump-style files — the server skips the
                        // SQL parser per-row and InnoDB does batch index builds, which is
                        // typically 10-20× faster than executing the INSERTs directly.
                        //
                        // Why we can write SQL string contents straight into TSV without
                        // re-encoding: mysqldump's INSERT escape sequences (\n, \r, \t,
                        // \0, \\, \', \") decode identically to LOAD DATA's default
                        // escape rules. So the bytes between an INSERT string's outer `'`
                        // already form a valid TSV field. No O(N) re-escaping pass.
                        $vb_started = microtime(true);
                        $vb_mysqli  = null;
                        $tsv_dir    = sys_get_temp_dir() . DIRECTORY_SEPARATOR
                                    . 'vbimport_' . bin2hex(random_bytes(4));

                        try {
                            if (!is_dir($tsv_dir) && !mkdir($tsv_dir, 0700, true)) {
                                throw new RuntimeException("Could not create temp dir: $tsv_dir");
                            }

                            // Connect with LOCAL INFILE option enabled. `mysqli.allow_local_infile`
                            // defaults to Off in PHP 8.1+, so we must request it per-connection.
                            mysqli_report(MYSQLI_REPORT_OFF);
                            $vb_mysqli = mysqli_init();
                            $vb_mysqli->options(MYSQLI_OPT_LOCAL_INFILE, true);
                            if (!@$vb_mysqli->real_connect($host, $user, $pass, $dbname, (int)$dbPort)) {
                                throw new RuntimeException(
                                    'mysqli connect failed: ' . mysqli_connect_error()
                                );
                            }
                            $vb_mysqli->set_charset('utf8mb4');

                            // Some MySQL/MariaDB builds ship with local_infile = OFF.
                            // Best-effort flip it on; user is install-time admin.
                            @$vb_mysqli->query('SET GLOBAL local_infile = 1');

                            // Bulk-import session tweaks (per-INSERT InnoDB cost killers)
                            $vb_mysqli->query('SET SESSION FOREIGN_KEY_CHECKS = 0');
                            $vb_mysqli->query('SET SESSION UNIQUE_CHECKS = 0');
                            $vb_mysqli->query('SET SESSION autocommit = 0');

                            // Probe LOAD DATA LOCAL INFILE up-front. If the server (or PHP's
                            // mysqli.allow_local_infile) refuses it, we silently load 0 rows
                            // forever — so detect once and switch to direct-INSERT mode.
                            $use_load_data = true;
                            $probe_path = $tsv_dir . DIRECTORY_SEPARATOR . '_probe.tsv';
                            @file_put_contents($probe_path, "1\n");
                            @$vb_mysqli->query('DROP TEMPORARY TABLE IF EXISTS _vbimport_probe');
                            @$vb_mysqli->query('CREATE TEMPORARY TABLE _vbimport_probe (n INT)');
                            $probe_load = str_replace('\\', '/', $probe_path);
                            $probe_esc  = $vb_mysqli->real_escape_string($probe_load);
                            $probe_sql  = "LOAD DATA LOCAL INFILE '{$probe_esc}' "
                                        . "INTO TABLE _vbimport_probe "
                                        . "FIELDS TERMINATED BY '\\t' "
                                        . "LINES TERMINATED BY '\\n' (n)";
                            if (!@$vb_mysqli->query($probe_sql)) {
                                echo "  ⚠ LOAD DATA LOCAL INFILE unavailable: "
                                   . $vb_mysqli->error . "\n";
                                echo "    Falling back to direct INSERT mode "
                                   . "(slower, but works without local_infile).\n";
                                @ob_flush(); @flush();
                                $use_load_data = false;
                            }
                            @$vb_mysqli->query('DROP TEMPORARY TABLE IF EXISTS _vbimport_probe');
                            @unlink($probe_path);
                            $load_data_warned = false;

                            // Pre-compiled regex for INSERT-header detection: captures
                            // table name, column list, and any tail after VALUES (in case
                            // tuples are inlined on the same line).
                            $insert_re = '/^INSERT\s+(?:IGNORE\s+)?INTO\s+`?(\w+)`?\s*\(([^)]+)\)\s*VALUES\b\s*(.*)$/is';

                            $vb_handle = fopen($vbulletin_import_file, 'rb');
                            if (!$vb_handle) {
                                throw new RuntimeException('Could not open vBulletin import file');
                            }

                            // Per-table accumulator state
                            $cur_table   = null;        // current table being loaded
                            $cur_cols    = null;        // column names from INSERT header
                            $tsv_handle  = null;        // open file handle for current TSV chunk
                            $tsv_path    = null;
                            $tsv_bytes   = 0;
                            $tsv_rows    = 0;
                            $flush_size  = 32 * 1024 * 1024;  // bulk-load every 32MB of TSV

                            // Misc-statement accumulator (for ALTER, SET, etc.)
                            $misc_stmt   = '';

                            $rows_loaded = 0;
                            $errors      = 0;
                            // Periodic-commit checkpoint. With autocommit=0 and a single
                            // COMMIT at the end of a 2 GB import, a crash mid-stream rolls
                            // back every row — so we batch a COMMIT every ~250 K rows. The
                            // resume script keys on MAX(pk) of each table, so any work
                            // already committed will be skipped on restart.
                            $commit_every  = 250000;
                            $rows_at_last_commit = 0;

                            // ─── Helpers ────────────────────────────────────────────
                            $exec_misc = function (string $sql) use ($vb_mysqli, &$errors) {
                                $sql = trim($sql);
                                if ($sql === '' || $sql === ';') return;
                                if (!$vb_mysqli->query($sql)) {
                                    $errors++;
                                    if ($errors <= 10) {
                                        error_log('vBulletin misc SQL error: '
                                            . $vb_mysqli->error . ' | '
                                            . substr($sql, 0, 200));
                                    }
                                }
                            };

                            // Direct-INSERT fallback. Reads the staged TSV chunk and replays
                            // it as one or more `INSERT IGNORE ... VALUES (...)...` statements.
                            //
                            // The TSV preserves mysqldump's SQL-escape sequences verbatim within
                            // each field (we copied bytes directly from between the source `'`
                            // quotes), so we can safely re-wrap each field in single quotes —
                            // MySQL parses the escapes back out. NULL is encoded as `\N` in TSV
                            // and emitted as the SQL NULL literal.
                            $do_load_via_insert = function () use (
                                &$tsv_path, &$tsv_rows,
                                &$cur_table, &$cur_cols, &$rows_loaded, &$errors,
                                $vb_mysqli
                            ) {
                                $fh = @fopen($tsv_path, 'rb');
                                if (!$fh) {
                                    $errors++;
                                    @unlink($tsv_path);
                                    return;
                                }
                                $cols_sql = '`' . implode('`, `', $cur_cols) . '`';
                                $tbl_esc  = str_replace('`', '``', $cur_table);
                                $insert_prefix = "INSERT IGNORE INTO `{$tbl_esc}` ({$cols_sql}) VALUES ";

                                $batch       = [];
                                $batch_bytes = 0;
                                $max_batch   = 4 * 1024 * 1024;  // ~4MB per packet — safe under default max_allowed_packet

                                $flush = function () use (
                                    &$batch, &$batch_bytes, $vb_mysqli, $insert_prefix,
                                    &$rows_loaded, &$errors
                                ) {
                                    if (empty($batch)) return;
                                    $sql = $insert_prefix . implode(',', $batch);
                                    if ($vb_mysqli->query($sql)) {
                                        $rows_loaded += $vb_mysqli->affected_rows;
                                    } else {
                                        $errors++;
                                        if ($errors <= 10) {
                                            error_log('vBulletin INSERT fallback error: '
                                                . $vb_mysqli->error);
                                        }
                                    }
                                    $batch       = [];
                                    $batch_bytes = 0;
                                };

                                while (($line = fgets($fh, 1048576)) !== false) {
                                    $line = rtrim($line, "\n\r");
                                    if ($line === '') continue;
                                    $fields = explode("\t", $line);
                                    $parts  = [];
                                    foreach ($fields as $f) {
                                        if ($f === '\\N') {
                                            $parts[] = 'NULL';
                                        } else {
                                            $parts[] = "'" . $f . "'";
                                        }
                                    }
                                    $tuple = '(' . implode(',', $parts) . ')';
                                    $tlen  = strlen($tuple) + 1;
                                    if ($batch_bytes + $tlen >= $max_batch && !empty($batch)) {
                                        $flush();
                                    }
                                    $batch[]      = $tuple;
                                    $batch_bytes += $tlen;
                                }
                                fclose($fh);
                                $flush();
                                @unlink($tsv_path);
                            };

                            $do_load = function () use (
                                &$tsv_handle, &$tsv_path, &$tsv_bytes, &$tsv_rows,
                                &$cur_table, &$cur_cols, &$rows_loaded, &$errors,
                                &$use_load_data, &$load_data_warned,
                                $vb_mysqli, $do_load_via_insert
                            ) {
                                if (!$tsv_handle) return;
                                fclose($tsv_handle);
                                $tsv_handle = null;

                                if ($tsv_rows === 0 || !$cur_table) {
                                    @unlink($tsv_path);
                                    $tsv_path = null;
                                    $tsv_bytes = 0;
                                    $tsv_rows  = 0;
                                    return;
                                }

                                if ($use_load_data) {
                                    $cols_sql = '`' . implode('`, `', $cur_cols) . '`';
                                    // LOAD DATA wants forward-slash paths, even on Windows
                                    $load_path     = str_replace('\\', '/', $tsv_path);
                                    $load_path_esc = $vb_mysqli->real_escape_string($load_path);
                                    $tbl_esc       = str_replace('`', '``', $cur_table);

                                    $sql = "LOAD DATA LOCAL INFILE '{$load_path_esc}' "
                                         . "IGNORE INTO TABLE `{$tbl_esc}` "
                                         . "CHARACTER SET utf8mb4 "
                                         . "FIELDS TERMINATED BY '\\t' "
                                         . "ENCLOSED BY '' "
                                         . "ESCAPED BY '\\\\' "
                                         . "LINES TERMINATED BY '\\n' "
                                         . "({$cols_sql})";

                                    if ($vb_mysqli->query($sql)) {
                                        $rows_loaded += $vb_mysqli->affected_rows;
                                        @unlink($tsv_path);
                                        $tsv_path  = null;
                                        $tsv_bytes = 0;
                                        $tsv_rows  = 0;
                                        @set_time_limit(0);
                                        return;
                                    }
                                    // First failure: surface to user output and switch modes.
                                    if (!$load_data_warned) {
                                        echo "  ⚠ LOAD DATA failed for `{$cur_table}`: "
                                           . $vb_mysqli->error . "\n";
                                        echo "    Switching to direct INSERT mode for the rest of the import.\n";
                                        @ob_flush(); @flush();
                                        $load_data_warned = true;
                                    }
                                    $use_load_data = false;
                                    // Fall through to INSERT fallback for this chunk.
                                }

                                $do_load_via_insert();
                                $tsv_path  = null;
                                $tsv_bytes = 0;
                                $tsv_rows  = 0;
                                @set_time_limit(0);
                            };

                            $open_tsv = function () use (
                                &$tsv_handle, &$tsv_path, &$tsv_bytes, &$tsv_rows,
                                &$cur_table, $tsv_dir
                            ) {
                                $tsv_path = $tsv_dir . DIRECTORY_SEPARATOR
                                          . $cur_table . '_' . bin2hex(random_bytes(3)) . '.tsv';
                                $tsv_handle = fopen($tsv_path, 'wb');
                                if (!$tsv_handle) {
                                    throw new RuntimeException("Could not open TSV temp file: $tsv_path");
                                }
                                $tsv_bytes = 0;
                                $tsv_rows  = 0;
                            };

                            // ─── Main streaming loop ────────────────────────────────
                            while (($vb_line = fgets($vb_handle, 1048576)) !== false) {
                                // Mid-tuple state: line begins with `(` and we have an
                                // active table — parse fastest.
                                if ($cur_table !== null && isset($vb_line[0]) && $vb_line[0] === '(') {
                                    $tsv_row = vbimport_tuple_to_tsv($vb_line);
                                    if ($tsv_row !== '') {
                                        $written = fwrite($tsv_handle, $tsv_row);
                                        $tsv_bytes += $written;
                                        $tsv_rows++;

                                        // Detect end of INSERT block (line ends with `;`)
                                        $tail = rtrim($vb_line);
                                        $is_end = $tail !== '' && substr($tail, -1) === ';';

                                        if ($is_end || $tsv_bytes >= $flush_size) {
                                            $do_load();
                                            if ($is_end) {
                                                $cur_table = null;
                                                $cur_cols  = null;

                                                // Periodic checkpoint: commit so a later
                                                // crash doesn't wipe progress already loaded.
                                                if ($rows_loaded - $rows_at_last_commit >= $commit_every) {
                                                    $vb_mysqli->query('COMMIT');
                                                    $rows_at_last_commit = $rows_loaded;
                                                }

                                                $elapsed = (int)(microtime(true) - $vb_started);
                                                $rate    = $elapsed > 0
                                                         ? (int)($rows_loaded / $elapsed) : 0;
                                                echo "  ...{$rows_loaded} rows loaded ({$elapsed}s, {$rate}/s)\n";
                                                @ob_flush(); @flush();
                                            } else {
                                                // mid-block flush: re-open TSV for same table
                                                $open_tsv();
                                            }
                                        }
                                    }
                                    continue;
                                }

                                $first = ltrim($vb_line);
                                if ($first === '' || $first[0] === "\n" || $first[0] === "\r"
                                    || strncmp($first, '--', 2) === 0
                                    || strncmp($first, '/*', 2) === 0) {
                                    continue;
                                }

                                // INSERT header on its own line (most common in mysqldump)
                                if (preg_match($insert_re, $first, $m)) {
                                    // Close any active block from previous table
                                    if ($tsv_handle) $do_load();
                                    $cur_table = $m[1];
                                    $cur_cols  = array_map(
                                        fn($c) => trim($c, " \t`"),
                                        explode(',', $m[2])
                                    );
                                    $open_tsv();

                                    // Inline tuples after VALUES on the same line?
                                    $tail = trim($m[3]);
                                    if ($tail !== '') {
                                        // Could be one or more tuples. Split on `),(` boundaries.
                                        $tuples = vbimport_split_inline_tuples($tail);
                                        foreach ($tuples as $tup) {
                                            $row = vbimport_tuple_to_tsv($tup);
                                            if ($row !== '') {
                                                $tsv_bytes += fwrite($tsv_handle, $row);
                                                $tsv_rows++;
                                            }
                                        }
                                        // If the original line ended with `;`, close the block
                                        if (substr(rtrim($vb_line), -1) === ';') {
                                            $do_load();
                                            $cur_table = null;
                                            $cur_cols  = null;
                                        }
                                    }
                                    continue;
                                }

                                // Misc statement (ALTER, SET, CREATE, etc.) — accumulate to `;`
                                $misc_stmt .= $vb_line;
                                if (substr(rtrim($vb_line), -1) === ';') {
                                    $exec_misc($misc_stmt);
                                    $misc_stmt = '';
                                }
                            }
                            fclose($vb_handle);

                            // Tail flush
                            if ($tsv_handle) $do_load();
                            if (trim($misc_stmt) !== '') $exec_misc($misc_stmt);

                            $vb_mysqli->query('COMMIT');

                            $total = (int)(microtime(true) - $vb_started);
                            echo "✓ Installed vBulletin database import "
                               . "({$rows_loaded} rows, {$errors} errors, {$total}s)\n";
                        } catch (Exception $e) {
                            if ($vb_mysqli) {
                                @$vb_mysqli->query('ROLLBACK');
                            }
                            error_log('vBulletin import error: ' . $e->getMessage());
                            echo "⚠ vBulletin database import failed: " . $e->getMessage() . "\n";
                        } finally {
                            if ($vb_mysqli) {
                                @$vb_mysqli->query('SET SESSION FOREIGN_KEY_CHECKS = 1');
                                @$vb_mysqli->query('SET SESSION UNIQUE_CHECKS = 1');
                                @$vb_mysqli->query('SET SESSION autocommit = 1');
                                @$vb_mysqli->close();
                            }
                            // Best-effort cleanup of the temp dir (any remaining TSVs)
                            if (is_dir($tsv_dir)) {
                                foreach (glob($tsv_dir . DIRECTORY_SEPARATOR . '*.tsv') ?: [] as $f) {
                                    @unlink($f);
                                }
                                @rmdir($tsv_dir);
                            }
                        }
                    }

                    echo "✓ Historical forum data installation complete\n";
                }

                // Relax sql_mode so fix_forum_categories.sql's INSERTs into
                // phpbb_forums (which omit `forum_parents` — a MEDIUMBLOB NOT NULL
                // with no default) aren't rejected by STRICT_TRANS_TABLES. phpBB
                // regenerates forum_parents lazily so an empty value is fine.
                try { $pdo->exec("SET SESSION sql_mode = ''"); } catch (Exception $e) {}

                // Run phpBB-dependent fix scripts now that phpbb_* tables exist
                foreach (['fix_forum_categories.sql', 'fix_topic_views.sql'] as $fixFile) {
                    $fixPath = __DIR__ . '/sql/' . $fixFile;
                    if (file_exists($fixPath)) {
                        try {
                            run_sql_file($pdo, $fixPath);
                            echo "  [phpBB] Applied $fixFile\n";
                        } catch (PDOException $e) {
                            // These fixes are best-effort — log but don't fail the install
                            error_log("$fixFile failed: " . $e->getMessage());
                            echo "  ⚠ $fixFile failed: " . $e->getMessage() . "\n";
                        }
                    }
                }

                // Fix forum_type and rebuild phpBB nested set tree for ALL forums
                // Historical forums are inserted without forum_type (defaults to 0 = category)
                // and without left_id/right_id which phpBB needs for its nested set model.
                // Also fixes the default forums from schema_data.sql.
                try {
                    echo "Rebuilding phpBB forum tree...\n";

                    // Set historical forums: categories (parent_id=0) = forum_type 0, others = forum_type 1
                    // Dynamically detect categories rather than hardcoding IDs, since the
                    // vBulletin import adds many more categories beyond the original 4
                    $pdo->exec("UPDATE phpbb_forums SET forum_type = 0 WHERE is_historical = 1 AND parent_id = 0");
                    $pdo->exec("UPDATE phpbb_forums SET forum_type = 1 WHERE is_historical = 1 AND parent_id != 0");

                    // Rebuild the nested set (left_id / right_id) for the entire forum tree
                    // phpBB uses a modified preorder tree traversal (nested set model)
                    $forums = $pdo->query("SELECT forum_id, parent_id FROM phpbb_forums ORDER BY parent_id, forum_id")->fetchAll(PDO::FETCH_ASSOC);

                    // Build parent->children map
                    $children = [];
                    foreach ($forums as $f) {
                        $pid = (int)$f['parent_id'];
                        $children[$pid][] = (int)$f['forum_id'];
                    }

                    // Recursive nested set numbering
                    $counter = 0;
                    $updates = [];
                    $rebuild_tree = function($parent_id) use (&$rebuild_tree, &$children, &$counter, &$updates) {
                        if (empty($children[$parent_id])) return;
                        foreach ($children[$parent_id] as $forum_id) {
                            $counter++;
                            $left = $counter;
                            $rebuild_tree($forum_id);
                            $counter++;
                            $right = $counter;
                            $updates[] = ['id' => $forum_id, 'left' => $left, 'right' => $right];
                        }
                    };
                    $rebuild_tree(0);

                    $update_stmt = $pdo->prepare("UPDATE phpbb_forums SET left_id = ?, right_id = ? WHERE forum_id = ?");
                    foreach ($updates as $u) {
                        $update_stmt->execute([$u['left'], $u['right'], $u['id']]);
                    }

                    echo "✓ Rebuilt nested set for " . count($updates) . " forums\n";

                    // Fix visibility: phpBB 3.3 defaults topic_visibility and post_visibility to 0
                    // (unapproved). Historical data must be set to 1 (ITEM_APPROVED) to be visible.
                    $pdo->exec("UPDATE phpbb_topics SET topic_visibility = 1 WHERE is_historical = 1");
                    $pdo->exec("UPDATE phpbb_posts SET post_visibility = 1 WHERE is_historical = 1");
                    echo "  [phpBB] Set visibility=approved on historical topics and posts\n";

                    // Update forum counters (phpBB reads these cached counts, not live queries)
                    $pdo->exec("UPDATE phpbb_forums f SET
                        forum_topics_approved = (SELECT COUNT(*) FROM phpbb_topics t WHERE t.forum_id = f.forum_id AND t.topic_visibility = 1),
                        forum_posts_approved = (SELECT COUNT(*) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1)
                    WHERE f.is_historical = 1");

                    // Update per-topic post counts
                    $pdo->exec("UPDATE phpbb_topics t SET
                        topic_posts_approved = (SELECT COUNT(*) FROM phpbb_posts p WHERE p.topic_id = t.topic_id AND p.post_visibility = 1)
                    WHERE t.is_historical = 1");

                    // Set topic_first_post_id and topic_last_post_id for proper thread display
                    $pdo->exec("UPDATE phpbb_topics t SET
                        topic_first_post_id = (SELECT MIN(post_id) FROM phpbb_posts p WHERE p.topic_id = t.topic_id),
                        topic_last_post_id = (SELECT MAX(post_id) FROM phpbb_posts p WHERE p.topic_id = t.topic_id),
                        topic_last_post_time = (SELECT MAX(post_time) FROM phpbb_posts p WHERE p.topic_id = t.topic_id)
                    WHERE t.is_historical = 1");

                    // Set forum last post info for forum index display
                    $pdo->exec("UPDATE phpbb_forums f SET
                        forum_last_post_id = (SELECT MAX(post_id) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1),
                        forum_last_post_time = (SELECT MAX(post_time) FROM phpbb_posts p WHERE p.forum_id = f.forum_id AND p.post_visibility = 1)
                    WHERE f.is_historical = 1");

                    echo "  [phpBB] Updated forum and topic counters\n";

                    // Fix historical users: set user_lang (phpBB requires it for display)
                    $pdo->exec("UPDATE phpbb_users SET user_lang = 'en' WHERE is_historical = 1 AND (user_lang = '' OR user_lang IS NULL)");

                    // Add historical users to the REGISTERED user group (group_id=2)
                    // phpBB memberlist and many queries JOIN on phpbb_user_group, so without
                    // this entry users won't appear in memberlist or profile pages.
                    $pdo->exec("INSERT IGNORE INTO phpbb_user_group (group_id, user_id, user_pending, group_leader)
                        SELECT 2, user_id, 0, 0 FROM phpbb_users WHERE is_historical = 1");

                    // Update user_posts count from actual approved posts
                    $pdo->exec("UPDATE phpbb_users u SET
                        user_posts = (SELECT COUNT(*) FROM phpbb_posts p WHERE p.poster_id = u.user_id AND p.post_visibility = 1)
                    WHERE u.is_historical = 1");

                    // Set poster username on ALL historical posts (phpBB caches this in the posts table)
                    $affected = $pdo->exec("UPDATE phpbb_posts p
                        INNER JOIN phpbb_users u ON p.poster_id = u.user_id
                        SET p.post_username = u.username
                    WHERE p.is_historical = 1");
                    echo "  [phpBB] Set post_username on $affected historical posts\n";

                    // Verify: check how many historical posts still have no matching user
                    $orphaned = $pdo->query("SELECT COUNT(*) FROM phpbb_posts p
                        LEFT JOIN phpbb_users u ON p.poster_id = u.user_id
                        WHERE p.is_historical = 1 AND u.user_id IS NULL")->fetchColumn();
                    if ($orphaned > 0) {
                        echo "  ⚠ Warning: $orphaned historical posts have poster_id with no matching user\n";
                    }

                    // Set topic last poster name for forum display
                    $pdo->exec("UPDATE phpbb_topics t
                        INNER JOIN phpbb_posts p ON p.post_id = t.topic_last_post_id
                        INNER JOIN phpbb_users u ON u.user_id = p.poster_id
                        SET t.topic_last_poster_id = p.poster_id,
                            t.topic_last_poster_name = u.username,
                            t.topic_last_poster_colour = ''
                    WHERE t.is_historical = 1");

                    // Set topic first poster name
                    $pdo->exec("UPDATE phpbb_topics t
                        INNER JOIN phpbb_posts p ON p.post_id = t.topic_first_post_id
                        INNER JOIN phpbb_users u ON u.user_id = p.poster_id
                        SET t.topic_first_poster_name = u.username,
                            t.topic_first_poster_colour = ''
                    WHERE t.is_historical = 1");

                    // Set forum last poster name for forum index
                    $pdo->exec("UPDATE phpbb_forums f
                        INNER JOIN phpbb_posts p ON p.post_id = f.forum_last_post_id
                        INNER JOIN phpbb_users u ON u.user_id = p.poster_id
                        SET f.forum_last_poster_id = p.poster_id,
                            f.forum_last_poster_name = u.username,
                            f.forum_last_poster_colour = ''
                    WHERE f.is_historical = 1");

                    // Update REGISTERED group user count
                    $pdo->exec("UPDATE phpbb_groups SET group_type = 3 WHERE group_id = 2");

                    // Set user_type = 0 (USER_NORMAL) for historical users
                    $pdo->exec("UPDATE phpbb_users SET user_type = 0 WHERE is_historical = 1 AND (user_type IS NULL OR user_type != 0)");

                    echo "  [phpBB] Fixed historical users: lang, group membership, post counts, poster names\n";

                    // Add ACL permissions for historical forums
                    // Without these, no group can view/access the forums even if they exist
                    // Role IDs: 14=FORUM_FULL, 15=FORUM_STANDARD, 17=FORUM_READONLY, 19=FORUM_BOT, 10=MOD_FULL
                    // Group IDs: 1=GUESTS, 2=REGISTERED, 3=REGISTERED_COPPA, 4=GLOBAL_MODS, 5=ADMINS, 6=BOTS, 7=NEW_MEMBERS
                    echo "Setting up ACL permissions for historical forums...\n";
                    $hist_forums = $pdo->query("SELECT forum_id FROM phpbb_forums WHERE is_historical = 1")->fetchAll(PDO::FETCH_COLUMN);
                    if (!empty($hist_forums)) {
                        $acl_stmt = $pdo->prepare("INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting) VALUES (?, ?, 0, ?, 0)");
                        foreach ($hist_forums as $hfid) {
                            // GUESTS: readonly access
                            $acl_stmt->execute([1, $hfid, 17]);
                            // REGISTERED: standard access (can read and post)
                            $acl_stmt->execute([2, $hfid, 15]);
                            // REGISTERED_COPPA: standard access
                            $acl_stmt->execute([3, $hfid, 15]);
                            // GLOBAL_MODERATORS: standard access + polls
                            $acl_stmt->execute([4, $hfid, 21]);
                            // ADMINISTRATORS: full forum access + full moderator access
                            $acl_stmt->execute([5, $hfid, 14]);
                            $acl_stmt->execute([5, $hfid, 10]);
                            // BOTS: bot access
                            $acl_stmt->execute([6, $hfid, 19]);
                            // NEW_MEMBERS: on queue
                            $acl_stmt->execute([7, $hfid, 24]);
                        }
                        echo "  [phpBB] Added ACL permissions for " . count($hist_forums) . " historical forums\n";
                    }

                    // Create "Forum Staff" moderation group and assign all historical forums to it
                    echo "Creating Forum Staff moderation group...\n";
                    $pdo->exec("INSERT IGNORE INTO phpbb_groups (group_name, group_type, group_desc, group_colour)
                        VALUES ('Forum Staff', 3, 'Forum moderation staff', '00AA00')");
                    $forum_staff_gid = $pdo->query("SELECT group_id FROM phpbb_groups WHERE group_name = 'Forum Staff'")->fetchColumn();
                    if ($forum_staff_gid) {
                        // Add admin (user_id=2) as group leader
                        $pdo->exec("INSERT IGNORE INTO phpbb_user_group (group_id, user_id, user_pending, group_leader)
                            VALUES ($forum_staff_gid, 2, 0, 1)");

                        // Assign Forum Staff as moderator of all historical forums
                        if (!empty($hist_forums)) {
                            $mod_stmt = $pdo->prepare("INSERT IGNORE INTO phpbb_acl_groups (group_id, forum_id, auth_option_id, auth_role_id, auth_setting) VALUES (?, ?, 0, 10, 0)");
                            foreach ($hist_forums as $hfid) {
                                $mod_stmt->execute([$forum_staff_gid, $hfid]);
                            }
                        }
                        echo "  [phpBB] Created Forum Staff group (ID: $forum_staff_gid) with admin as leader\n";
                    }
                } catch (Exception $e) {
                    error_log('Forum tree rebuild error: ' . $e->getMessage());
                    echo "⚠ Forum tree rebuild failed: " . $e->getMessage() . "\n";
                }
            } catch (Exception $e) {
                // Log phpBB installation errors and store in session to display on step 3
                error_log('phpBB installation error: ' . $e->getMessage());
                $_SESSION['phpbb_install_error'] = $e->getMessage();

                // FALLBACK: Try to create config.php anyway so phpBB doesn't show install page
                $forum_config_path = __DIR__ . '/forum/config.php';
                if (!file_exists($forum_config_path)) {
                    $fallback_config = "<?php
// phpBB 3.x configuration file (created after installation error)
// Error during install: " . addslashes($e->getMessage()) . "

\$dbms = 'phpbb\\\\db\\\\driver\\\\mysqli';
\$dbhost = '{$host}';
\$dbport = '{$dbPort}';
\$dbname = '{$dbname}';
\$dbuser = '{$user}';
\$dbpasswd = '{$pass}';

\$table_prefix = 'phpbb_';
\$phpbb_adm_relative_path = 'adm/';
\$acm_type = 'phpbb\\\\cache\\\\driver\\\\file';

@define('PHPBB_INSTALLED', true);
@define('PHPBB_ENVIRONMENT', 'production');
";
                    $write_result = @file_put_contents($forum_config_path, $fallback_config);
                    if ($write_result === false) {
                        $_SESSION['phpbb_install_error'] .= ' | Additionally, failed to write fallback config.php - check forum directory permissions';
                        error_log('Failed to write fallback phpBB config.php');
                    } else {
                        $_SESSION['phpbb_install_error'] .= ' | Fallback config.php was created - you may need to reinstall';
                        error_log('Created fallback phpBB config.php');
                    }
                }
            }

            // Double-check: Ensure forum config.php exists
            $forum_config_final_check = __DIR__ . '/forum/config.php';
            if (!file_exists($forum_config_final_check)) {
                error_log('CRITICAL: forum/config.php still does not exist after installation!');
                $_SESSION['phpbb_config_missing'] = true;
            }

            $cfgArray = [
                'host' => $host,
                'port' => $dbPort,
                'dbname' => $dbname,
                'user' => $user,
                'pass' => $pass,
            ];
            $cfg = "<?php\nreturn " . var_export($cfgArray, true) . ";\n?>";
            file_put_contents(__DIR__ . '/cms/config.php', $cfg);
            unset($_SESSION['cms_install']);
            header('Location: install.php?step=3');
            exit;
        } catch (PDOException $e) {
            $errors[] = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Install CMS</title>
    <?php if ($step > 2 && empty($errors) && !isset($_SESSION['phpbb_install_error'])): ?>
    <meta http-equiv="refresh" content="5;url=cms/">
    <?php endif; ?>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #171a21 0%, #2a475e 100%);
            color: #c7d5e0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .install-container {
            background: #1e3a52;
            border: 1px solid #3c4043;
            border-radius: 10px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .install-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .install-header h1 {
            color: #ffffff;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .install-header p {
            color: #8f8f8f;
            font-size: 16px;
        }

        .steam-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #66c0f4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #ffffff;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #3c4043;
            border-radius: 6px;
            font-size: 14px;
            background: #2a475e;
            color: #ffffff;
        }

        .form-control:focus {
            outline: none;
            border-color: #66c0f4;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary {
            background: #66c0f4;
            color: #1e3a52;
        }

        .btn-primary:hover {
            background: #5aa9e6;
        }

        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.2);
            border: 1px solid #e74c3c;
            color: #ffffff;
        }

        .alert-success {
            background: rgba(39, 174, 96, 0.2);
            border: 1px solid #27ae60;
            color: #ffffff;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #3c4043;
            border-radius: 3px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #66c0f4;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
<div class="install-container">
    <div class="install-header">
        <div class="steam-logo">CMS</div>
        <h1>SteamCMS Installation</h1>
        <p>Multi-era Steam website content management system</p>
    </div>
    <div class="progress-bar">
        <div class="progress-fill" style="width: <?php echo ($step / 3) * 100; ?>%;"></div>
    </div>
    <?php if ($errors): ?>
        <ul style="color:#ff8080;">
        <?php foreach ($errors as $e) {
            echo '<li>'.htmlspecialchars($e).'</li>';
        } ?>
        </ul>
    <?php endif; ?>
    <?php if ($step == 1): ?>
        <h2 style="color:#ffffff; margin-bottom:20px;">Step 1: Database Configuration</h2>
        <form method="post">
            <div class="form-group">
                <label for="host">Database Host</label>
                <input id="host" class="form-control" name="host" value="localhost">
            </div>
            <div class="form-group">
                <label for="port">Database Port</label>
                <input id="port" class="form-control" type="number" name="port" value="3306" min="1" max="65535">
            </div>
            <div class="form-group">
                <label for="dbname">Database Name</label>
                <input id="dbname" class="form-control" name="dbname" value="steamcms">
            </div>
            <div class="form-group">
                <label for="dbuser">Database User</label>
                <input id="dbuser" class="form-control" name="dbuser" value="root">
            </div>
            <div class="form-group">
                <label for="dbpass">Database Password</label>
                <input id="dbpass" type="password" class="form-control" name="dbpass">
            </div>
            <div class="form-group">
                <label for="root_path">CMS Root Path</label>
                <input id="root_path" class="form-control" name="root_path" value="<?php
                    $script_name = $_SERVER['SCRIPT_NAME'] ?? '/install.php';
                    $root_path = dirname($script_name);
                    echo htmlspecialchars($root_path === '/' ? '' : $root_path);
                ?>" placeholder="e.g. /somefolder or leave empty for root">
                <small class="form-text text-muted">The directory path where the CMS is installed (without domain name). Leave empty if installed in domain root.</small>
            </div>

            <h3 style="color:#ffffff; margin: 30px 0 15px 0; border-top: 1px solid #3c4043; padding-top: 20px;">phpBB Forum Settings</h3>

            <div class="form-group">
                <label for="phpbb_cookie_name">phpBB Cookie Name</label>
                <input id="phpbb_cookie_name" class="form-control" name="phpbb_cookie_name" value="stmserverbb__" placeholder="e.g. stmserverbb__">
                <small class="form-text text-muted">Cookie prefix used by phpBB forum. Change if you have multiple phpBB installations.</small>
            </div>
            <div class="form-group">
                <label for="phpbb_board_email">Forum Contact Email</label>
                <input id="phpbb_board_email" type="email" class="form-control" name="phpbb_board_email" value="forum@steampowered.com" placeholder="e.g. forum@steampowered.com">
                <small class="form-text text-muted">Email address displayed for forum contact and notifications.</small>
            </div>
            <button class="btn btn-primary" type="submit">Continue</button>
        </form>
    <?php elseif ($step == 2): ?>
        <h2 style="color:#ffffff; margin-bottom:20px;">Step 2: Admin User</h2>
        <form method="post">
            <div class="form-group">
                <label for="admin_user">Admin Username</label>
                <input id="admin_user" class="form-control" name="admin_user" value="admin">
            </div>
            <div class="form-group">
                <label for="admin_pass">Admin Password</label>
                <input id="admin_pass" type="password" class="form-control" name="admin_pass" value="steamcms">
            </div>
            <div class="form-group">
                <label for="admin_email">Admin Email</label>
                <input id="admin_email" type="email" class="form-control" name="admin_email" value="admin@steampowered.com">
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="use_official_survey" value="1"> Use official survey stats</label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="install_2004_forum_data" value="1" checked> Insert official 2004 forum data</label>
                <small class="form-text text-muted">Includes historical Steam forum threads and posts from 2004. Only visible when using 2003_v2 or 2004 phpBB styles.</small>
            </div>
            <button class="btn btn-primary" type="submit">Install</button>
        </form>
    <?php else: ?>
        <h2 style="color:#ffffff; margin-bottom:20px;">Installation Complete</h2>
        <?php if (isset($_SESSION['phpbb_install_error']) || isset($_SESSION['phpbb_config_missing'])): ?>
            <div style="background:#ff6b6b;color:#fff;padding:15px;margin:15px 0;border-radius:5px;">
                <strong>⚠ phpBB Forum Installation Error:</strong><br>
                <?php if (isset($_SESSION['phpbb_install_error'])): ?>
                    <?php echo nl2br(htmlspecialchars($_SESSION['phpbb_install_error'])); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['phpbb_config_missing'])): ?>
                    <br><strong>CRITICAL:</strong> forum/config.php could not be created. Check directory permissions!
                <?php endif; ?>
                <br><br>
                <strong>Debug info:</strong>
                <ul style="margin-top:10px;margin-left:20px;">
                    <li>Check your PHP error log for detailed messages</li>
                    <li>Verify forum/ directory is writable</li>
                    <li>Forum path: <?php echo htmlspecialchars(__DIR__ . '/forum/'); ?></li>
                    <li>Config exists: <?php echo file_exists(__DIR__ . '/forum/config.php') ? 'YES' : 'NO'; ?></li>
                </ul>
                <br>
                <a href="install.php" style="color:#fff;text-decoration:underline;">Re-run installer</a>
            </div>
            <?php
            unset($_SESSION['phpbb_install_error']);
            unset($_SESSION['phpbb_config_missing']);
            ?>
        <?php endif; ?>
        <p style="margin-bottom: 15px;">You will be automatically redirected to the CMS in <span id="countdown">5</span> seconds.</p>
        <p style="margin-bottom: 10px;"><a href="cms/" class="btn btn-primary">Go to CMS</a></p>
        <p><a href="cms/login.php" class="btn btn-primary" style="background: #3c4043;">Log in directly</a></p>
        <script>
            (function() {
                var seconds = 5;
                var countdown = document.getElementById('countdown');
                var timer = setInterval(function() {
                    seconds--;
                    if (countdown) countdown.textContent = seconds;
                    if (seconds <= 0) clearInterval(timer);
                }, 1000);
            })();
        </script>
    <?php endif; ?>
</div>
</body>
</html>
