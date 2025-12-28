<?php
require_once __DIR__.'/db.php';

function cb_current_user() : ?array {
    return $_SESSION['user'] ?? null;
}

function cb_require_login() : array {
    if (!$u = cb_current_user()) {
        header('Location: login.php?redir='.urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
    return $u;
}

function cb_login(string $name, string $pass) : bool {
    $stmt = cb_db()->prepare('SELECT * FROM users WHERE username=?');
    $stmt->execute([$name]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && password_verify($pass, $row['passhash'])) {
        // Update last login
        $upd = cb_db()->prepare('UPDATE users SET last_login=NOW() WHERE id=?');
        $upd->execute([$row['id']]);
        $_SESSION['user'] = $row;
        return true;
    }
    return false;
}

function cb_logout() : void {
    $_SESSION = [];
    session_destroy();
}

function cb_is_mod(array $u=null) : bool {
    $u ??= cb_current_user();
    return $u && $u['is_mod'];
}

/**
 * Register a new user
 */
function cb_register(string $username, string $email, string $password) : array {
    $errors = [];

    // Validate username
    $username = trim($username);
    if (strlen($username) < 3 || strlen($username) > 20) {
        $errors[] = 'Username must be between 3 and 20 characters.';
    }
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = 'Username can only contain letters, numbers, and underscores.';
    }

    // Validate email
    $email = trim($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    // Validate password
    if (strlen($password) < 4 || strlen($password) > 32) {
        $errors[] = 'Password must be between 4 and 32 characters.';
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    // Check if username exists
    $stmt = cb_db()->prepare('SELECT id FROM users WHERE username=?');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        return ['success' => false, 'errors' => ['Username already taken.']];
    }

    // Check if email exists
    $stmt = cb_db()->prepare('SELECT id FROM users WHERE email=?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return ['success' => false, 'errors' => ['Email already registered.']];
    }

    // Create user
    $passhash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = cb_db()->prepare('INSERT INTO users (username, email, passhash, registered) VALUES (?, ?, ?, NOW())');
    $stmt->execute([$username, $email, $passhash]);

    return ['success' => true, 'user_id' => cb_db()->lastInsertId()];
}

/**
 * Update user profile
 */
function cb_update_profile(int $userId, array $data) : array {
    $errors = [];
    $updates = [];
    $params = [];

    // Update email if provided
    if (isset($data['email'])) {
        $email = trim($data['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        } else {
            // Check if email is used by another user
            $stmt = cb_db()->prepare('SELECT id FROM users WHERE email=? AND id!=?');
            $stmt->execute([$email, $userId]);
            if ($stmt->fetch()) {
                $errors[] = 'Email already in use by another account.';
            } else {
                $updates[] = 'email=?';
                $params[] = $email;
            }
        }
    }

    // Update signature if provided
    if (isset($data['signature'])) {
        $updates[] = 'signature=?';
        $params[] = substr(trim($data['signature']), 0, 500);
    }

    // Update password if provided
    if (!empty($data['new_password'])) {
        if (strlen($data['new_password']) < 4 || strlen($data['new_password']) > 32) {
            $errors[] = 'Password must be between 4 and 32 characters.';
        } else {
            $updates[] = 'passhash=?';
            $params[] = password_hash($data['new_password'], PASSWORD_DEFAULT);
        }
    }

    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }

    if (!empty($updates)) {
        $params[] = $userId;
        $sql = 'UPDATE users SET ' . implode(', ', $updates) . ' WHERE id=?';
        $stmt = cb_db()->prepare($sql);
        $stmt->execute($params);

        // Refresh session
        $stmt = cb_db()->prepare('SELECT * FROM users WHERE id=?');
        $stmt->execute([$userId]);
        $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return ['success' => true];
}

/**
 * Generate password reset token
 */
function cb_generate_reset_token(string $email) : ?string {
    $stmt = cb_db()->prepare('SELECT id FROM users WHERE email=?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return null;
    }

    $token = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

    $stmt = cb_db()->prepare('UPDATE users SET reset_token=?, reset_expires=? WHERE id=?');
    $stmt->execute([$token, $expires, $user['id']]);

    return $token;
}

/**
 * Validate and use password reset token
 */
function cb_reset_password(string $token, string $newPassword) : array {
    if (strlen($newPassword) < 4 || strlen($newPassword) > 32) {
        return ['success' => false, 'error' => 'Password must be between 4 and 32 characters.'];
    }

    $stmt = cb_db()->prepare('SELECT id FROM users WHERE reset_token=? AND reset_expires > NOW()');
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return ['success' => false, 'error' => 'Invalid or expired reset token.'];
    }

    $passhash = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = cb_db()->prepare('UPDATE users SET passhash=?, reset_token=NULL, reset_expires=NULL WHERE id=?');
    $stmt->execute([$passhash, $user['id']]);

    return ['success' => true];
}

/**
 * Get user's rank based on post count
 */
function cb_get_rank(int $postCount) : string {
    if ($postCount >= 2000) return 'Guru';
    if ($postCount >= 1000) return 'Graduate';
    if ($postCount >= 500) return 'Amateur';
    if ($postCount >= 200) return 'Apprentice';
    if ($postCount >= 50) return 'Novice';
    return 'Bearcub';
}

/**
 * Get user's post count
 */
function cb_get_post_count(int $userId) : int {
    $stmt = cb_db()->prepare('SELECT COUNT(*) FROM posts WHERE user_id=?');
    $stmt->execute([$userId]);
    return (int)$stmt->fetchColumn();
}

/**
 * Check if current user is an admin
 */
function cb_is_admin(?array $u = null) : bool {
    $u ??= cb_current_user();
    return $u && !empty($u['is_admin']);
}

/**
 * Require admin privileges - redirect to login if not admin
 */
function cb_require_admin() : array {
    $u = cb_current_user();
    if (!$u) {
        header('Location: ../login.php?redir=' . urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
    if (!cb_is_admin($u)) {
        die('<h1>Access Denied</h1><p>You do not have permission to access this area.</p><p><a href="../index.php">Return to forum</a></p>');
    }
    return $u;
}

/**
 * Check if user can moderate (is mod or admin)
 */
function cb_can_moderate(?array $u = null) : bool {
    $u ??= cb_current_user();
    return $u && ($u['is_mod'] || $u['is_admin']);
}

/**
 * Check if user can moderate a specific board
 */
function cb_can_moderate_board(int $boardId, ?array $u = null) : bool {
    $u ??= cb_current_user();
    if (!$u) return false;
    if ($u['is_admin']) return true;
    if (!$u['is_mod']) return false;

    // Check if user is listed as moderator for this board
    $stmt = cb_db()->prepare('SELECT moderators FROM boards WHERE id=?');
    $stmt->execute([$boardId]);
    $board = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$board || empty($board['moderators'])) return true; // Mods can moderate all if no specific mods listed

    $mods = array_map('trim', explode(',', $board['moderators']));
    return in_array($u['username'], $mods);
}

/**
 * Log a moderation action
 */
function cb_log_mod_action(int $userId, string $action, string $targetType, int $targetId, ?string $details = null) : void {
    $stmt = cb_db()->prepare('INSERT INTO mod_log (user_id, action, target_type, target_id, details, created) VALUES (?, ?, ?, ?, ?, NOW())');
    $stmt->execute([$userId, $action, $targetType, $targetId, $details]);
}

/**
 * Get all users with pagination
 */
function cb_get_users(int $offset = 0, int $limit = 50, ?string $search = null) : array {
    $params = [];
    $where = '';

    if ($search) {
        $where = 'WHERE username LIKE ? OR email LIKE ?';
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $countSql = "SELECT COUNT(*) FROM users $where";
    $stmt = cb_db()->prepare($countSql);
    $stmt->execute($params);
    $total = (int)$stmt->fetchColumn();

    $sql = "SELECT u.*, (SELECT COUNT(*) FROM posts WHERE user_id=u.id) as post_count
            FROM users u $where ORDER BY u.registered DESC LIMIT $limit OFFSET $offset";
    $stmt = cb_db()->prepare($sql);
    $stmt->execute($params);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return ['users' => $users, 'total' => $total];
}

/**
 * Get user by ID
 */
function cb_get_user(int $userId) : ?array {
    $stmt = cb_db()->prepare('SELECT * FROM users WHERE id=?');
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

/**
 * Update user (admin function)
 */
function cb_admin_update_user(int $userId, array $data) : array {
    $updates = [];
    $params = [];

    if (isset($data['email'])) {
        $updates[] = 'email=?';
        $params[] = $data['email'];
    }
    if (isset($data['signature'])) {
        $updates[] = 'signature=?';
        $params[] = $data['signature'];
    }
    if (isset($data['is_mod'])) {
        $updates[] = 'is_mod=?';
        $params[] = $data['is_mod'] ? 1 : 0;
    }
    if (isset($data['is_admin'])) {
        $updates[] = 'is_admin=?';
        $params[] = $data['is_admin'] ? 1 : 0;
    }
    if (isset($data['banned'])) {
        $updates[] = 'banned=?';
        $params[] = $data['banned'] ? 1 : 0;
    }
    if (!empty($data['password'])) {
        $updates[] = 'passhash=?';
        $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    if (empty($updates)) {
        return ['success' => true];
    }

    $params[] = $userId;
    $sql = 'UPDATE users SET ' . implode(', ', $updates) . ' WHERE id=?';
    $stmt = cb_db()->prepare($sql);
    $stmt->execute($params);

    return ['success' => true];
}

/**
 * Delete user (admin function)
 */
function cb_admin_delete_user(int $userId) : bool {
    $stmt = cb_db()->prepare('DELETE FROM users WHERE id=?');
    return $stmt->execute([$userId]);
}

/**
 * Get all boards
 */
function cb_get_boards() : array {
    return cb_db()->query('SELECT * FROM boards ORDER BY ordering, name')->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get board by ID
 */
function cb_get_board(int $boardId) : ?array {
    $stmt = cb_db()->prepare('SELECT * FROM boards WHERE id=?');
    $stmt->execute([$boardId]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

/**
 * Create board
 */
function cb_create_board(string $name, string $description, int $ordering = 0, ?string $moderators = null) : int {
    $stmt = cb_db()->prepare('INSERT INTO boards (name, description, ordering, moderators) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $description, $ordering, $moderators]);
    return (int)cb_db()->lastInsertId();
}

/**
 * Update board
 */
function cb_update_board(int $boardId, array $data) : bool {
    $updates = [];
    $params = [];

    if (isset($data['name'])) {
        $updates[] = 'name=?';
        $params[] = $data['name'];
    }
    if (isset($data['description'])) {
        $updates[] = 'description=?';
        $params[] = $data['description'];
    }
    if (isset($data['ordering'])) {
        $updates[] = 'ordering=?';
        $params[] = (int)$data['ordering'];
    }
    if (array_key_exists('moderators', $data)) {
        $updates[] = 'moderators=?';
        $params[] = $data['moderators'];
    }

    if (empty($updates)) return true;

    $params[] = $boardId;
    $sql = 'UPDATE boards SET ' . implode(', ', $updates) . ' WHERE id=?';
    $stmt = cb_db()->prepare($sql);
    return $stmt->execute($params);
}

/**
 * Delete board
 */
function cb_delete_board(int $boardId) : bool {
    $stmt = cb_db()->prepare('DELETE FROM boards WHERE id=?');
    return $stmt->execute([$boardId]);
}

/**
 * Get moderation log
 */
function cb_get_mod_log(int $limit = 50) : array {
    $stmt = cb_db()->prepare('
        SELECT ml.*, u.username
        FROM mod_log ml
        JOIN users u ON ml.user_id = u.id
        ORDER BY ml.created DESC
        LIMIT ?
    ');
    $stmt->execute([$limit]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get forum statistics
 */
function cb_get_stats() : array {
    $stats = [];
    $stats['users'] = (int)cb_db()->query('SELECT COUNT(*) FROM users')->fetchColumn();
    $stats['boards'] = (int)cb_db()->query('SELECT COUNT(*) FROM boards')->fetchColumn();
    $stats['threads'] = (int)cb_db()->query('SELECT COUNT(*) FROM threads')->fetchColumn();
    $stats['posts'] = (int)cb_db()->query('SELECT COUNT(*) FROM posts')->fetchColumn();
    $stats['newest_user'] = cb_db()->query('SELECT username FROM users ORDER BY registered DESC LIMIT 1')->fetchColumn();
    return $stats;
}
