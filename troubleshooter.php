<?php
require_once 'includes/db.php';
require_once 'includes/template_engine.php';

// Get parameters
$lang = $_GET['lang'] ?? 'en';
$page = $_GET['page'] ?? 's_main';
$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';

// Validate language
$allowed_langs = ['en', 'fr', 'de', 'it', 'es'];
if (!in_array($lang, $allowed_langs)) {
    $lang = 'en';
}

// Validate page slug (basic sanitization)
$page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page);
if (empty($page)) {
    $page = 's_main';
}

// Get page content from database
$stmt = $pdo->prepare('SELECT title, content FROM troubleshooter_pages WHERE lang = ? AND slug = ?');
$stmt->execute([$lang, $page]);
$troubleshooter_page = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$troubleshooter_page) {
    // Fallback to English if page not found in requested language
    if ($lang !== 'en') {
        $stmt->execute(['en', $page]);
        $troubleshooter_page = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (!$troubleshooter_page) {
        // Final fallback to main page
        $stmt->execute(['en', 's_main']);
        $troubleshooter_page = $stmt->fetch(PDO::FETCH_ASSOC);
        $page = 's_main';
    }
}

// Extract and process the content
$content = $troubleshooter_page['content'] ?? '';
$title = $troubleshooter_page['title'] ?? 'Steam Troubleshooter';

// Convert internal links to use new URL structure
$content = preg_replace_callback('/href=["\']([^"\']*\.php)["\']/', function($matches) use ($lang) {
    $link = $matches[1];
    $slug = basename($link, '.php');
    return 'href="troubleshooter.php?lang=' . $lang . '&page=' . $slug . '"';
}, $content);

// Process content through template engine for asset path rewriting
$processed_content = process_template_content($content);

// Extract the body content (remove html/head tags from stored content)
if (preg_match('/<body[^>]*>(.*?)<\/body>/s', $processed_content, $matches)) {
    $body_content = $matches[1];
} else {
    $body_content = $processed_content;
}

// Handle form processing
$is_form_page = strpos($body_content, '<form') !== false;
if ($is_form_page) {
    // Update form action to use our form handler
    $body_content = preg_replace('/action=["\']process_form\.php["\']/', 'action="troubleshooter_form.php"', $body_content);

    // Add hidden fields for language
    $body_content = preg_replace('/(<form[^>]*>)/', '$1<input type="hidden" name="language" value="' . htmlspecialchars($lang) . '">', $body_content);
}

// Get theme info
$theme = get_active_theme();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($title); ?></title>
    <meta charset="UTF-8">
    <style type="text/css">
        body {
            background-color: #4C5844;
            padding: 16px;
            scrollbar-base-color: #4C5844;
            margin: 0;
            font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
        }

        .content_area {
            background-color: #3E4637;
            border: 1px solid #202020;
            width: 100%;
            height: 100%;
        }

        td.content {
            padding: 24px 24px 0 24px;
        }

        td.bottom {
            padding: 0 24px 24px 24px;
        }

        p, li {
            font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
            font-size: 13px;
            font-style: normal;
            font-weight: normal;
            color: #dadada;
        }

        li {
            list-style: square;
            list-style-type: square;
            margin-bottom: 4pt;
        }

        hr {
            margin: 0;
            border-bottom: 1px solid #818D7C;
            border-top: 1px solid #000000;
            text-align: left;
        }

        a {
            color: #c0c0c0;
        }

        a.boldlink {
            font-weight: bold;
            color: #c0c0c0;
            text-decoration: none;
        }

        a.boldlink:hover {
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
        }

        a:hover {
            color: #ffffff;
        }

        h1 {
            color: #eeeeee;
            font-family: Arial, Verdana;
            font-size: 15px;
            font-style: normal;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .small {
            font-family: Tahoma;
            font-size: 12px;
            color: #c1c1c1;
        }

        .form_100p {
            font-family: Verdana;
            font-size: 10px;
            width: 100%;
            background-color: #495141;
            border-style: solid;
            border-width: 1px;
            border-top-color: #1C261E;
            border-right-color: #818D7C;
            border-bottom-color: #818D7C;
            border-left-color: #1C261E;
            color: #BFBA50;
            scrollbar-base-color: #4C5844;
        }

        .form_generic {
            font-family: Verdana;
            font-size: 10px;
            background-color: #3E4637;
            border-style: solid;
            border-width: 1px;
            border-top-color: #1C261E;
            border-right-color: #818D7C;
            border-bottom-color: #818D7C;
            border-left-color: #1C261E;
            color: White;
            scrollbar-base-color: #4C5844;
        }

        .maize {
            color: #bdbe52;
        }
    </style>
    <script language="JavaScript">
        function displaylimit(field, limit) {
            if (field && field.value && field.value.length > limit) {
                field.value = field.value.substring(0, limit);
            }
        }

        // Add character limit display functionality
        document.addEventListener('DOMContentLoaded', function() {
            var textareas = document.querySelectorAll('textarea[name="f_4"]');
            textareas.forEach(function(textarea) {
                textarea.addEventListener('input', function() {
                    displaylimit(this, 500);
                });
            });
        });
    </script>
</head>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">

<?php if ($message): ?>
    <div style="background-color: #2d4a1a; border: 1px solid #4a6b2f; color: #a8d65a; padding: 10px; margin: 10px; text-align: center;">
        <?php echo htmlspecialchars(urldecode($message)); ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div style="background-color: #4a1a1a; border: 1px solid #6b2f2f; color: #d65a5a; padding: 10px; margin: 10px; text-align: center;">
        <?php echo htmlspecialchars(urldecode($error)); ?>
    </div>
<?php endif; ?>

<?php echo $body_content; ?>

</body>
</html>