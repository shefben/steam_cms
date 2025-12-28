<?php
/**
 * Steam Marketing Index
 * Displays archived Steam marketing pages from the database
 */

require_once '../../includes/db.php';
require_once '../../includes/template_engine.php';

// Get the requested page
$page = $_GET['page'] ?? '';
$language = $_GET['l'] ?? 'english';

// Validate and sanitize page parameter
$page = preg_replace('/[^a-zA-Z0-9._-]/', '', $page);

if (empty($page)) {
    // Show marketing index/listing page
    show_marketing_index();
} else {
    // Show specific marketing page
    show_marketing_page($page);
}

function show_marketing_index() {
    global $pdo;

    // Get all marketing pages from database
    $stmt = $pdo->prepare('SELECT filename, title, date_published FROM steam_marketing ORDER BY date_published DESC, filename ASC');
    $stmt->execute();
    $pages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Steam Marketing Archive</title>
        <style>
            body {
                background-color: #3e4533;
                color: white;
                font-family: verdana, arial, sans-serif;
                margin: 24px;
            }
            h1 {
                color: #BFBA50;
                font-family: trebuchet ms;
                font-size: 18pt;
                margin-bottom: 20px;
            }
            .page-list {
                list-style-type: none;
                padding: 0;
            }
            .page-list li {
                margin: 8px 0;
                padding: 8px;
                background-color: #2a2f24;
                border-left: 3px solid #BFBA50;
            }
            .page-list a {
                color: #c0c0c0;
                text-decoration: none;
                font-weight: bold;
            }
            .page-list a:hover {
                color: #BFBA50;
            }
            .date {
                color: #888;
                font-size: 10pt;
                margin-left: 10px;
            }
        </style>
    </head>
    <body>
        <h1>Steam Marketing Archive</h1>
        <ul class="page-list">
            <?php foreach ($pages as $page): ?>
            <li>
                <a href="?page=<?php echo htmlspecialchars($page['filename']); ?>">
                    <?php echo htmlspecialchars($page['title']); ?>
                </a>
                <?php if ($page['date_published']): ?>
                <span class="date"><?php echo htmlspecialchars($page['date_published']); ?></span>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </body>
    </html>
    <?php
}

function show_marketing_page($page) {
    global $pdo;

    // Get specific marketing page from database
    $stmt = $pdo->prepare('SELECT * FROM steam_marketing WHERE filename = ?');
    $stmt->execute([$page]);
    $marketing_page = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$marketing_page) {
        // Page not found, show 404
        http_response_code(404);
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Page Not Found - Steam Marketing</title>
            <style>
                body {
                    background-color: #3e4533;
                    color: white;
                    font-family: verdana, arial, sans-serif;
                    margin: 24px;
                    text-align: center;
                }
                h1 {
                    color: #BFBA50;
                    font-family: trebuchet ms;
                }
                a {
                    color: #c0c0c0;
                }
                a:hover {
                    color: #BFBA50;
                }
            </style>
        </head>
        <body>
            <h1>Page Not Found</h1>
            <p>The requested marketing page "<?php echo htmlspecialchars($page); ?>" was not found.</p>
            <p><a href="?">Return to Marketing Archive</a></p>
        </body>
        </html>
        <?php
        return;
    }

    // Process the content through template engine for theme compatibility
    $content = $marketing_page['content'];

    // Additional processing for Steam URLs and external links
    $content = preg_replace('/steam:\/\/openurl\//', '', $content);
    $content = process_template_content($content);

    // Set appropriate headers
    header('Content-Type: text/html; charset=utf-8');

    // Output the processed content
    echo $content;
}
?>