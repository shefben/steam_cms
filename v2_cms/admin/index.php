<?php
session_start();

require_once '../code/cms.php';

/**
 * SteamCMS Admin Panel
 * Complete admin interface for managing content across all Steam eras
 * Author: MiniMax Agent
 */

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        // Handle login
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        try {
            $cms = new SteamCMS();
            $db = $cms->getDatabase();
            
            $user = $db->queryOne(
                "SELECT * FROM users WHERE username = ? AND role = 'admin'",
                [$username]
            );
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user'] = $user;
                header('Location: index.php');
                exit;
            } else {
                $login_error = "Invalid credentials";
            }
        } catch (Exception $e) {
            $login_error = "Login failed: " . $e->getMessage();
        }
    }
    
    // Show login form
    include 'login.php';
    exit;
}

// Initialize CMS
$cms = new SteamCMS();
$db = $cms->getDatabase();

// Handle actions
$action = $_GET['action'] ?? 'dashboard';
$current_theme = $_GET['theme'] ?? '2004';
$cms->setTheme($current_theme);

// Get available themes
$themes = $db->query("SELECT * FROM theme_configs ORDER BY theme ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SteamCMS Admin Panel</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/admin.js"></script>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-content">
                <h1>SteamCMS Admin Panel</h1>
                <div class="header-controls">
                    <select id="theme-selector" onchange="changeTheme(this.value)">
                        <?php foreach ($themes as $theme): ?>
                            <option value="<?= $theme['theme'] ?>" <?= $current_theme === $theme['theme'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($theme['display_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="user-info">Welcome, <?= htmlspecialchars($_SESSION['admin_user']['username']) ?></span>
                    <a href="logout.php" class="btn btn-small">Logout</a>
                </div>
            </div>
        </header>

        <div class="admin-layout">
            <!-- Sidebar -->
            <nav class="admin-sidebar">
                <ul class="nav-menu">
                    <li><a href="?action=dashboard&theme=<?= $current_theme ?>" class="<?= $action === 'dashboard' ? 'active' : '' ?>">
                        📊 Dashboard
                    </a></li>
                    <li><a href="?action=news&theme=<?= $current_theme ?>" class="<?= $action === 'news' ? 'active' : '' ?>">
                        📰 News Articles
                    </a></li>
                    <li><a href="?action=faq&theme=<?= $current_theme ?>" class="<?= $action === 'faq' ? 'active' : '' ?>">
                        ❓ FAQ Management
                    </a></li>
                    <li><a href="?action=navigation&theme=<?= $current_theme ?>" class="<?= $action === 'navigation' ? 'active' : '' ?>">
                        🧭 Navigation
                    </a></li>
                    <li><a href="?action=media&theme=<?= $current_theme ?>" class="<?= $action === 'media' ? 'active' : '' ?>">
                        🖼️ Media Files
                    </a></li>
                    <li><a href="?action=custom_pages&theme=<?= $current_theme ?>" class="<?= $action === 'custom_pages' ? 'active' : '' ?>">
                        📄 Custom Pages
                    </a></li>
                    <?php if (in_array($current_theme, ['2007', '2008', '2009'])): ?>
                    <li><a href="?action=game_capsules&theme=<?= $current_theme ?>" class="<?= $action === 'game_capsules' ? 'active' : '' ?>">
                        🎮 Game Capsules
                    </a></li>
                    <?php endif; ?>
                    <?php if (in_array($current_theme, ['2002', '2003', '2004'])): ?>
                    <li><a href="?action=main_content&theme=<?= $current_theme ?>" class="<?= $action === 'main_content' ? 'active' : '' ?>">
                        📝 Main Page Content
                    </a></li>
                    <?php endif; ?>
                    <li><a href="?action=settings&theme=<?= $current_theme ?>" class="<?= $action === 'settings' ? 'active' : '' ?>">
                        ⚙️ Settings
                    </a></li>
                    <li><a href="?action=themes&theme=<?= $current_theme ?>" class="<?= $action === 'themes' ? 'active' : '' ?>">
                        🎨 Theme Config
                    </a></li>
                    <li><a href="../index.php?theme=<?= $current_theme ?>" target="_blank">
                        👁️ View Site
                    </a></li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="admin-content">
                <div class="content-header">
                    <h2>
                        <?php
                        $titles = [
                            'dashboard' => 'Dashboard',
                            'news' => 'News Articles',
                            'faq' => 'FAQ Management',
                            'navigation' => 'Navigation Links',
                            'media' => 'Media Files',
                            'custom_pages' => 'Custom Pages',
                            'game_capsules' => 'Game Capsules',
                            'main_content' => 'Main Page Content',
                            'settings' => 'Site Settings',
                            'themes' => 'Theme Configuration'
                        ];
                        echo $titles[$action] ?? 'Admin Panel';
                        ?>
                    </h2>
                    <div class="current-theme">
                        Current Theme: <strong><?= htmlspecialchars($current_theme) ?></strong>
                    </div>
                </div>

                <div class="content-body">
                    <?php
                    // Include the appropriate admin page
                    switch ($action) {
                        case 'dashboard':
                            include 'pages/dashboard.php';
                            break;
                        case 'news':
                            include 'pages/news.php';
                            break;
                        case 'faq':
                            include 'pages/faq.php';
                            break;
                        case 'navigation':
                            include 'pages/navigation.php';
                            break;
                        case 'media':
                            include 'pages/media.php';
                            break;
                        case 'settings':
                            include 'pages/settings.php';
                            break;
                        case 'themes':
                            include 'pages/themes.php';
                            break;
                        case 'custom_pages':
                            include 'pages/custom_pages.php';
                            break;
                        case 'game_capsules':
                            include 'pages/game_capsules.php';
                            break;
                        case 'main_content':
                            include 'pages/main_content.php';
                            break;
                        default:
                            echo '<p>Page not found.</p>';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <script>
        function changeTheme(theme) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('theme', theme);
            window.location.search = urlParams.toString();
        }
    </script>
</body>
</html>
