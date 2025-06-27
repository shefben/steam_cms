<?php
/**
 * SteamCMS Frontend
 * Main entry point for the public-facing Steam site
 * Author: MiniMax Agent
 */

require_once 'code/cms.php';

// Error handling
error_reporting(E_ALL);
ini_set('display_errors', 0); // Disable for production

try {
    // Initialize CMS
    $cms = new SteamCMS();
    
    // Get current theme from URL parameter or default
    $current_theme = $_GET['theme'] ?? '2004';
    
    // Validate theme exists
    $available_themes = $cms->getDatabase()->query("SELECT theme FROM theme_configs WHERE is_active = 1");
    $valid_themes = array_column($available_themes, 'theme');
    
    if (!in_array($current_theme, $valid_themes)) {
        $current_theme = '2004'; // Fallback to default
    }
    
    // Set theme
    $cms->setTheme($current_theme);
    
    // Check maintenance mode
    $maintenance_mode = $cms->getSetting('maintenance_mode', '0');
    if ($maintenance_mode === '1') {
        showMaintenancePage($cms);
        exit;
    }
    
    // Get page from URL - support original Steam URL patterns
    $page = $_GET['page'] ?? 'index';
    $page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page); // Sanitize
    
    // Handle Steam-style URLs
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'faq':
                renderFAQPage($cms);
                break;
            case 'news':
                renderNewsPage($cms);
                break;
            default:
                renderHomePage($cms);
                break;
        }
    } else {
        // Handle different pages
        switch ($page) {
            case 'index':
            default:
                renderHomePage($cms);
                break;
            case 'news':
                renderNewsPage($cms);
                break;
            case 'faq':
                renderFAQPage($cms);
                break;
            case 'custom':
                renderCustomPage($cms);
                break;
        }
    }
    
} catch (Exception $e) {
    // Log error and show generic error page
    error_log("SteamCMS Error: " . $e->getMessage());
    showErrorPage();
}

/**
 * Render the home page
 */
function renderHomePage($cms) {
    try {
        echo $cms->renderPage('index');
    } catch (Exception $e) {
        showThemeErrorPage($cms, $e);
    }
}

/**
 * Render news page
 */
function renderNewsPage($cms) {
    $news_model = new NewsModel($cms->getDatabase());
    $current_theme = $_GET['theme'] ?? '2004';
    
    // Handle individual news article viewing (Steam-style URLs)
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $article = $news_model->getById($_GET['id']);
        if ($article && $article['theme'] === $current_theme) {
            try {
                echo $cms->renderPage('news_single', ['article' => $article]);
            } catch (Exception $e) {
                renderFallbackSingleNews($cms, $article);
            }
            return;
        }
    }
    
    // Get news articles list
    $news_articles = $news_model->getAll($current_theme, 20);
    
    try {
        echo $cms->renderPage('news', ['news_articles' => $news_articles]);
    } catch (Exception $e) {
        // Fallback news rendering
        renderFallbackNews($cms, $news_articles);
    }
}

/**
 * Render FAQ page
 */
function renderFAQPage($cms) {
    $faq_model = new FAQModel($cms->getDatabase());
    $current_theme = $_GET['theme'] ?? '2004';
    
    // Handle Steam-style FAQ URLs with category filtering
    $selected_category = null;
    if (isset($_GET['category']) && is_numeric($_GET['category'])) {
        $selected_category = $cms->getDatabase()->queryOne(
            "SELECT * FROM faq_categories WHERE id = ? AND theme = ?", 
            [$_GET['category'], $current_theme]
        );
    }
    
    // Get FAQ categories and entries
    $categories = $faq_model->getCategories($current_theme);
    $faq_data = [];
    
    if ($selected_category) {
        // Show only selected category
        $faq_data[] = [
            'category' => $selected_category,
            'entries' => $faq_model->getEntriesByCategory($selected_category['id'])
        ];
    } else {
        // Show all categories
        foreach ($categories as $category) {
            $faq_data[] = [
                'category' => $category,
                'entries' => $faq_model->getEntriesByCategory($category['id'])
            ];
        }
    }
    
    try {
        echo $cms->renderPage('faq', [
            'faq_data' => $faq_data, 
            'categories' => $categories,
            'selected_category' => $selected_category
        ]);
    } catch (Exception $e) {
        // Fallback FAQ rendering
        renderFallbackFAQ($cms, $faq_data);
    }
}

/**
 * Show maintenance page
 */
function showMaintenancePage($cms) {
    $current_theme = $_GET['theme'] ?? '2004';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Steam - Under Maintenance</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                background: #171a21; 
                color: #c7d5e0; 
                text-align: center; 
                padding: 50px; 
            }
            .maintenance-box {
                background: #2a475e;
                border: 1px solid #3c4043;
                border-radius: 8px;
                padding: 40px;
                max-width: 600px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="maintenance-box">
            <h1>Steam is Currently Under Maintenance</h1>
            <p>We're performing scheduled maintenance to improve your Steam experience.</p>
            <p>Please check back soon!</p>
            <?php if ($current_theme): ?>
                <p><small>Theme: <?= htmlspecialchars($current_theme) ?></small></p>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
}

/**
 * Show error page
 */
function showErrorPage() {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Steam - Error</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                background: #171a21; 
                color: #c7d5e0; 
                text-align: center; 
                padding: 50px; 
            }
            .error-box {
                background: #2a475e;
                border: 1px solid #3c4043;
                border-radius: 8px;
                padding: 40px;
                max-width: 600px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="error-box">
            <h1>Something Went Wrong</h1>
            <p>We're experiencing technical difficulties. Please try again later.</p>
            <p><a href="/" style="color: #66c0f4;">Return to Home</a></p>
        </div>
    </body>
    </html>
    <?php
}

/**
 * Show theme-specific error page
 */
function showThemeErrorPage($cms, $exception) {
    $current_theme = $_GET['theme'] ?? '2004';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Steam - Theme Error</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                background: #171a21; 
                color: #c7d5e0; 
                text-align: center; 
                padding: 50px; 
            }
            .error-box {
                background: #2a475e;
                border: 1px solid #3c4043;
                border-radius: 8px;
                padding: 40px;
                max-width: 600px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="error-box">
            <h1>Theme Error</h1>
            <p>There was an error loading the <?= htmlspecialchars($current_theme) ?> theme.</p>
            <p>Template file may be missing or corrupted.</p>
            <details style="text-align: left; margin: 20px 0;">
                <summary style="color: #66c0f4; cursor: pointer;">Show Error Details</summary>
                <pre style="background: #000; color: #fff; padding: 15px; border-radius: 4px; font-size: 12px; overflow: auto; white-space: pre-wrap;"><?= htmlspecialchars($exception->getMessage()) ?></pre>
            </details>
            <p><a href="?theme=2004" style="color: #66c0f4;">Try Default Theme</a></p>
        </div>
    </body>
    </html>
    <?php
}

/**
 * Fallback news rendering
 */
function renderFallbackNews($cms, $news_articles) {
    $current_theme = $_GET['theme'] ?? '2004';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Steam News</title>
        <style>
            body { font-family: Arial, sans-serif; background: #171a21; color: #c7d5e0; padding: 20px; }
            .container { max-width: 800px; margin: 0 auto; }
            .news-item { background: #2a475e; border: 1px solid #3c4043; padding: 20px; margin-bottom: 20px; border-radius: 4px; }
            .news-title { color: #ffffff; font-size: 18px; margin-bottom: 10px; }
            .news-meta { color: #8f8f8f; font-size: 12px; margin-bottom: 15px; }
            a { color: #66c0f4; text-decoration: none; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Steam News - <?= htmlspecialchars($current_theme) ?></h1>
            <p><a href="?theme=<?= $current_theme ?>">← Back to Home</a></p>
            
            <?php if (empty($news_articles)): ?>
                <p>No news articles available for this theme.</p>
            <?php else: ?>
                <?php foreach ($news_articles as $article): ?>
                    <div class="news-item">
                        <div class="news-title"><?= htmlspecialchars($article['title']) ?></div>
                        <div class="news-meta">
                            Published <?= date('F j, Y', strtotime($article['published_date'])) ?> by <?= htmlspecialchars($article['author']) ?>
                        </div>
                        <?php if ($article['excerpt']): ?>
                            <p><strong><?= htmlspecialchars($article['excerpt']) ?></strong></p>
                        <?php endif; ?>
                        <div><?= nl2br(htmlspecialchars($article['content'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
}

/**
 * Render custom page
 */
function renderCustomPage($cms) {
    $current_theme = $_GET['theme'] ?? '2004';
    $page_slug = $_GET['slug'] ?? '';
    
    if (empty($page_slug)) {
        showErrorPage();
        return;
    }
    
    // Get custom page
    $page = $cms->getDatabase()->queryOne(
        "SELECT * FROM custom_pages WHERE slug = ? AND theme = ? AND is_active = 1",
        [$page_slug, $current_theme]
    );
    
    if (!$page) {
        showErrorPage();
        return;
    }
    
    try {
        echo $cms->renderPage('custom_page', ['page' => $page]);
    } catch (Exception $e) {
        renderFallbackCustomPage($cms, $page);
    }
}

/**
 * Fallback single news rendering
 */
function renderFallbackSingleNews($cms, $article) {
    $current_theme = $_GET['theme'] ?? '2004';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title><?= htmlspecialchars($article['title']) ?> - Steam News</title>
        <style>
            body { font-family: Arial, sans-serif; background: #171a21; color: #c7d5e0; padding: 20px; }
            .container { max-width: 800px; margin: 0 auto; }
            .news-article { background: #2a475e; border: 1px solid #3c4043; padding: 20px; border-radius: 4px; }
            .news-title { color: #ffffff; font-size: 24px; margin-bottom: 10px; }
            .news-meta { color: #8f8f8f; font-size: 12px; margin-bottom: 15px; }
            a { color: #66c0f4; text-decoration: none; }
        </style>
    </head>
    <body>
        <div class="container">
            <p><a href="?page=news&theme=<?= $current_theme ?>">← Back to News</a></p>
            <div class="news-article">
                <div class="news-title"><?= htmlspecialchars($article['title']) ?></div>
                <div class="news-meta">
                    Published <?= date('F j, Y', strtotime($article['published_date'])) ?> by <?= htmlspecialchars($article['author']) ?>
                </div>
                <div><?= nl2br(htmlspecialchars($article['content'])) ?></div>
            </div>
        </div>
    </body>
    </html>
    <?php
}

/**
 * Fallback custom page rendering
 */
function renderFallbackCustomPage($cms, $page) {
    $current_theme = $_GET['theme'] ?? '2004';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title><?= htmlspecialchars($page['title']) ?></title>
        <style>
            body { font-family: Arial, sans-serif; background: #171a21; color: #c7d5e0; padding: 20px; }
            .container { max-width: 800px; margin: 0 auto; }
            .page-content { background: #2a475e; border: 1px solid #3c4043; padding: 20px; border-radius: 4px; }
            .page-title { color: #ffffff; font-size: 24px; margin-bottom: 20px; }
            a { color: #66c0f4; text-decoration: none; }
        </style>
    </head>
    <body>
        <div class="container">
            <p><a href="?theme=<?= $current_theme ?>">← Back to Home</a></p>
            <div class="page-content">
                <div class="page-title"><?= htmlspecialchars($page['title']) ?></div>
                <div><?= $page['content'] ?></div>
            </div>
        </div>
    </body>
    </html>
    <?php
}

/**
 * Fallback FAQ rendering
 */
function renderFallbackFAQ($cms, $faq_data) {
    $current_theme = $_GET['theme'] ?? '2004';
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Steam FAQ</title>
        <style>
            body { font-family: Arial, sans-serif; background: #171a21; color: #c7d5e0; padding: 20px; }
            .container { max-width: 800px; margin: 0 auto; }
            .faq-category { background: #2a475e; border: 1px solid #3c4043; padding: 20px; margin-bottom: 20px; border-radius: 4px; }
            .category-title { color: #ffffff; font-size: 18px; margin-bottom: 15px; }
            .faq-item { margin-bottom: 15px; }
            .question { color: #66c0f4; font-weight: bold; margin-bottom: 5px; }
            .answer { margin-left: 20px; }
            a { color: #66c0f4; text-decoration: none; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Steam FAQ - <?= htmlspecialchars($current_theme) ?></h1>
            <p><a href="?theme=<?= $current_theme ?>">← Back to Home</a></p>
            
            <?php if (empty($faq_data)): ?>
                <p>No FAQ entries available for this theme.</p>
            <?php else: ?>
                <?php foreach ($faq_data as $category_data): ?>
                    <div class="faq-category">
                        <div class="category-title"><?= htmlspecialchars($category_data['category']['name']) ?></div>
                        <?php if (!empty($category_data['entries'])): ?>
                            <?php foreach ($category_data['entries'] as $entry): ?>
                                <div class="faq-item">
                                    <div class="question"><?= htmlspecialchars($entry['question']) ?></div>
                                    <div class="answer"><?= nl2br(htmlspecialchars($entry['answer'])) ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No entries in this category.</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
}
?>
