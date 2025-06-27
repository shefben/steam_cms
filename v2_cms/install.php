<?php
/**
 * SteamCMS Installation Script
 * Sets up the complete CMS with historical data for all Steam eras
 * Author: MiniMax Agent
 */

require_once 'code/cms.php';

// Check if already installed
if (file_exists('installed.lock')) {
    die('SteamCMS is already installed. Delete "installed.lock" file to reinstall.');
}

$step = $_GET['step'] ?? 1;
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($step) {
        case 1:
            // Database configuration
            try {
                $host = $_POST['db_host'];
                $username = $_POST['db_username'];
                $password = $_POST['db_password'];
                $database = $_POST['db_database'];
                
                // Test connection
                $test_pdo = new PDO(
                    "mysql:host=$host;dbname=$database;charset=utf8",
                    $username,
                    $password
                );
                
                // Save config
                $config = [
                    'host' => $host,
                    'username' => $username,
                    'password' => $password,
                    'database' => $database
                ];
                
                file_put_contents('config.json', json_encode($config));
                header('Location: install.php?step=2');
                exit;
                
            } catch (Exception $e) {
                $error = 'Database connection failed: ' . $e->getMessage();
            }
            break;
            
        case 2:
            // Create admin user and install
            try {
                $config = json_decode(file_get_contents('config.json'), true);
                $cms = new SteamCMS($config);
                
                // Install schema and data
                $admin_user = [
                    'username' => $_POST['admin_username'],
                    'password' => $_POST['admin_password'],
                    'email' => $_POST['admin_email']
                ];
                
                $cms->install($admin_user);
                
                // Insert comprehensive historical data
                insertHistoricalData($cms);
                
                // Import 2004 FAQ data
                require_once 'code/steam_2004_faq_import.php';
                import2004FAQ($cms->getDatabase());
                
                // Create lock file
                file_put_contents('installed.lock', date('Y-m-d H:i:s'));
                
                header('Location: install.php?step=3');
                exit;
                
            } catch (Exception $e) {
                $error = 'Installation failed: ' . $e->getMessage();
            }
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SteamCMS Installation</title>
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
        
        .feature-list {
            background: rgba(42, 71, 94, 0.5);
            border: 1px solid #3c4043;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .feature-list h3 {
            color: #66c0f4;
            margin-bottom: 15px;
        }
        
        .feature-list ul {
            list-style: none;
        }
        
        .feature-list li {
            padding: 5px 0;
            position: relative;
            padding-left: 20px;
        }
        
        .feature-list li:before {
            content: "✓";
            color: #27ae60;
            position: absolute;
            left: 0;
            font-weight: bold;
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
        
        <!-- Progress Bar -->
        <div class="progress-bar">
            <div class="progress-fill" style="width: <?= ($step / 3) * 100 ?>%;"></div>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        
        <?php if ($step == 1): ?>
            <!-- Step 1: Database Configuration -->
            <h2 style="color: #ffffff; margin-bottom: 20px;">Step 1: Database Configuration</h2>
            
            <form method="POST">
                <div class="form-group">
                    <label for="db_host">Database Host</label>
                    <input type="text" id="db_host" name="db_host" class="form-control" value="localhost" required>
                </div>
                
                <div class="form-group">
                    <label for="db_database">Database Name</label>
                    <input type="text" id="db_database" name="db_database" class="form-control" value="steamcms" required>
                </div>
                
                <div class="form-group">
                    <label for="db_username">Database Username</label>
                    <input type="text" id="db_username" name="db_username" class="form-control" value="root" required>
                </div>
                
                <div class="form-group">
                    <label for="db_password">Database Password</label>
                    <input type="password" id="db_password" name="db_password" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">Test Connection & Continue</button>
            </form>
            
        <?php elseif ($step == 2): ?>
            <!-- Step 2: Admin User & Installation -->
            <h2 style="color: #ffffff; margin-bottom: 20px;">Step 2: Create Admin User</h2>
            
            <form method="POST">
                <div class="form-group">
                    <label for="admin_username">Admin Username</label>
                    <input type="text" id="admin_username" name="admin_username" class="form-control" value="admin" required>
                </div>
                
                <div class="form-group">
                    <label for="admin_password">Admin Password</label>
                    <input type="password" id="admin_password" name="admin_password" class="form-control" value="steamcms" required>
                </div>
                
                <div class="form-group">
                    <label for="admin_email">Admin Email</label>
                    <input type="email" id="admin_email" name="admin_email" class="form-control" value="admin@steampowered.com">
                </div>
                
                <div class="feature-list">
                    <h3>What will be installed:</h3>
                    <ul>
                        <li>Database schema with all tables</li>
                        <li>8 Steam era themes (2002-2009)</li>
                        <li>Historical news articles for each era</li>
                        <li>Default navigation structures</li>
                        <li>FAQ categories and entries</li>
                        <li>Admin panel with full functionality</li>
                    </ul>
                </div>
                
                <button type="submit" class="btn btn-primary">Install SteamCMS</button>
            </form>
            
        <?php elseif ($step == 3): ?>
            <!-- Step 3: Installation Complete -->
            <h2 style="color: #ffffff; margin-bottom: 20px;">Installation Complete!</h2>
            
            <div class="alert alert-success">
                SteamCMS has been successfully installed with historical data for all Steam eras (2002-2009).
            </div>
            
            <div class="feature-list">
                <h3>What's ready to use:</h3>
                <ul>
                    <li>Admin panel at <strong>/admin/</strong></li>
                    <li>Default login: admin / steamcms</li>
                    <li>8 different Steam era themes</li>
                    <li>Historical content for each era</li>
                    <li>Full content management system</li>
                </ul>
            </div>
            
            <div style="display: grid; gap: 10px; margin-top: 20px;">
                <a href="admin/" class="btn btn-primary">Access Admin Panel</a>
                <a href="index.php?theme=2004" class="btn btn-primary" style="background: #27ae60;">View Site (2004 Theme)</a>
            </div>
            
            <div style="margin-top: 30px; text-align: center; font-size: 12px; color: #8f8f8f;">
                <p>SteamCMS - Multi-era Steam website content management system</p>
                <p>Delete the <strong>install.php</strong> file for security.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php

/**
 * Insert comprehensive historical data for all Steam eras
 */
function insertHistoricalData($cms) {
    $db = $cms->getDatabase();
    
    // Comprehensive historical news data
    $historical_news = [
        // 2002 Era
        [
            'theme' => '2002',
            'title' => 'Steam Beta Launch Announced',
            'content' => 'Valve Software today announced the beta launch of Steam, a revolutionary new platform for digital game distribution. Steam aims to provide automatic updates, enhanced security, and a seamless gaming experience for players worldwide.',
            'excerpt' => 'Valve announces revolutionary Steam platform beta.',
            'author' => 'Valve Corporation',
            'published_date' => '2002-09-12'
        ],
        [
            'theme' => '2002',
            'title' => 'Counter-Strike 1.6 Beta Available',
            'content' => 'Counter-Strike 1.6 is now available for beta testing through the Steam platform. This version includes improved anti-cheat protection, enhanced server browser functionality, and optimized performance.',
            'excerpt' => 'Counter-Strike 1.6 beta launches on Steam.',
            'author' => 'Valve Corporation',
            'published_date' => '2002-10-15'
        ],
        
        // 2003 Era
        [
            'theme' => '2003',
            'title' => 'Steam Public Beta Opens to All Players',
            'content' => 'Steam opens its doors to the public with an expanded beta program. Users can now download and install Steam to access their favorite Valve games with automatic updates, friends lists, and improved multiplayer features.',
            'excerpt' => 'Steam public beta now available for download.',
            'author' => 'Valve Corporation',
            'published_date' => '2003-05-12'
        ],
        [
            'theme' => '2003',
            'title' => 'Day of Defeat Steam Integration Complete',
            'content' => 'Day of Defeat is now fully integrated with Steam, providing players with automatic updates, statistics tracking, enhanced anti-cheat protection, and seamless multiplayer matchmaking.',
            'excerpt' => 'Day of Defeat joins the Steam platform.',
            'author' => 'Valve Corporation',
            'published_date' => '2003-08-20'
        ],
        
        // 2004 Era
        [
            'theme' => '2004',
            'title' => 'Half-Life 2 Goes Gold!',
            'content' => 'Valve announces that Half-Life 2 has reached gold master status and will be available through Steam on November 16th, 2004. Pre-purchasing is now available with multiple package options including the Collector\'s Edition.',
            'excerpt' => 'Half-Life 2 reaches gold master, launching November 16th.',
            'author' => 'Gabe Newell',
            'published_date' => '2004-10-15'
        ],
        [
            'theme' => '2004',
            'title' => 'Source Engine Revolutionizes Gaming',
            'content' => 'The Source Engine debuts with Half-Life 2, featuring advanced physics simulation, realistic graphics rendering, facial animation technology, and innovative gameplay mechanics that will power the next generation of Valve games.',
            'excerpt' => 'Source Engine debuts with revolutionary features.',
            'author' => 'Valve Corporation',
            'published_date' => '2004-11-16'
        ],
        [
            'theme' => '2004',
            'title' => 'Counter-Strike: Source Available Now',
            'content' => 'Counter-Strike: Source, the complete remake of the world\'s most popular online action game, is now available through Steam. Built on the Source engine, it features enhanced graphics, physics, and gameplay.',
            'excerpt' => 'Counter-Strike: Source launches with Source engine.',
            'author' => 'Valve Corporation',
            'published_date' => '2004-08-11'
        ],
        
        // 2005 Era
        [
            'theme' => '2005',
            'title' => 'Half-Life 2: Lost Coast Released',
            'content' => 'Half-Life 2: Lost Coast is now available as a free download for owners of Half-Life 2. This technical demonstration showcases HDR lighting technology and introduces the developer commentary mode.',
            'excerpt' => 'Half-Life 2: Lost Coast available for free.',
            'author' => 'Valve Corporation',
            'published_date' => '2005-10-27'
        ],
        [
            'theme' => '2005',
            'title' => 'Steam Platform Major Update Released',
            'content' => 'Steam receives major updates including improved friends system, better download management, enhanced user interface, server browser improvements, and community features based on user feedback.',
            'excerpt' => 'Steam platform receives major enhancements.',
            'author' => 'Valve Corporation',
            'published_date' => '2005-12-15'
        ],
        
        // 2006 Era
        [
            'theme' => '2006',
            'title' => 'Half-Life 2: Episode One Available',
            'content' => 'Half-Life 2: Episode One, the first in a trilogy of new episodes, is now available through Steam. Continue Gordon Freeman\'s story with Alyx Vance in this action-packed adventure featuring new gameplay mechanics.',
            'excerpt' => 'Half-Life 2: Episode One begins the trilogy.',
            'author' => 'Valve Corporation',
            'published_date' => '2006-06-01'
        ],
        [
            'theme' => '2006',
            'title' => 'Steam Store Launches',
            'content' => 'Valve today launched the Steam Store, allowing users to browse, purchase, and download games directly through the Steam client. The store features games from Valve and select third-party publishers.',
            'excerpt' => 'Steam Store opens for digital game purchases.',
            'author' => 'Valve Corporation',
            'published_date' => '2006-09-12'
        ],
        
        // 2007 Era
        [
            'theme' => '2007',
            'title' => 'The Orange Box Announced',
            'content' => 'Valve announces The Orange Box, featuring Half-Life 2: Episode Two, Portal, and Team Fortress 2. This collection represents the next evolution in Valve\'s innovative game design and storytelling.',
            'excerpt' => 'The Orange Box brings three groundbreaking games.',
            'author' => 'Valve Corporation',
            'published_date' => '2007-07-11'
        ],
        [
            'theme' => '2007',
            'title' => 'Portal Revolutionizes Puzzle Gaming',
            'content' => 'Portal, the innovative puzzle-platform game, introduces players to the Aperture Science Handheld Portal Device. Solve mind-bending puzzles using portals in this critically acclaimed game.',
            'excerpt' => 'Portal introduces innovative portal-based gameplay.',
            'author' => 'Valve Corporation',
            'published_date' => '2007-10-10'
        ],
        
        // 2008 Era
        [
            'theme' => '2008',
            'title' => 'Left 4 Dead Shambles onto Steam',
            'content' => 'Left 4 Dead, the cooperative first-person shooter, is now available on Steam. Fight through zombie-infested campaigns with up to four players in this intense survival horror experience.',
            'excerpt' => 'Left 4 Dead brings cooperative zombie survival.',
            'author' => 'Valve Corporation',
            'published_date' => '2008-11-17'
        ],
        [
            'theme' => '2008',
            'title' => 'Steam Reaches 15 Million Users',
            'content' => 'Steam celebrates reaching 15 million registered users worldwide. The platform continues to grow as more publishers join Steam and more players discover digital game distribution.',
            'excerpt' => 'Steam community reaches 15 million users.',
            'author' => 'Valve Corporation',
            'published_date' => '2008-12-03'
        ],
        
        // 2009 Era
        [
            'theme' => '2009',
            'title' => 'Left 4 Dead 2 Announced',
            'content' => 'Valve announces Left 4 Dead 2, featuring new survivors, new infected, new campaigns, and enhanced AI Director technology. Experience the zombie apocalypse in the American South.',
            'excerpt' => 'Left 4 Dead 2 brings new survivors and campaigns.',
            'author' => 'Valve Corporation',
            'published_date' => '2009-06-01'
        ],
        [
            'theme' => '2009',
            'title' => 'Steam Workshop Beta Launches',
            'content' => 'Steam Workshop enters beta testing, allowing players to create, share, and download user-generated content for supported games. This marks a new era of community-driven game content.',
            'excerpt' => 'Steam Workshop beta enables user-generated content.',
            'author' => 'Valve Corporation',
            'published_date' => '2009-12-15'
        ]
    ];
    
    // Insert news articles
    $stmt = $db->getConnection()->prepare(
        "INSERT INTO news_articles (theme, title, content, excerpt, author, published_date) 
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    
    foreach ($historical_news as $news) {
        $stmt->execute([
            $news['theme'],
            $news['title'],
            $news['content'],
            $news['excerpt'],
            $news['author'],
            $news['published_date']
        ]);
    }
    
    // Insert default navigation links for each theme
    insertDefaultNavigation($db);
    
    // Insert sample FAQ data
    insertSampleFAQ($db);
}

/**
 * Insert default navigation links for each theme
 */
function insertDefaultNavigation($db) {
    $navigation_data = [
        // 2002-2005: Simple navigation
        ['2002', 'Try Steam Now!', 'http://steampowered.com/html/betasignup.html', 'text', '', '', '_self', 1],
        ['2002', 'Steam Support', 'http://steampowered.com/support/', 'text', '', '', '_self', 2],
        ['2002', 'Valve Home', 'http://www.valvesoftware.com/', 'text', '', '', '_blank', 3],
        
        ['2003', 'Home', '/', 'text', '', '', '_self', 1],
        ['2003', 'Download Steam', '/download/', 'text', '', '', '_self', 2],
        ['2003', 'Games', '/games/', 'text', '', '', '_self', 3],
        ['2003', 'Support', 'http://support.steampowered.com/', 'text', '', '', '_blank', 4],
        
        ['2004', 'Home', '/', 'text', '', '', '_self', 1],
        ['2004', 'Half-Life 2', '/hl2/', 'text', '', '', '_self', 2],
        ['2004', 'Counter-Strike: Source', '/css/', 'text', '', '', '_self', 3],
        ['2004', 'My Steam', '/mysteam/', 'text', '', '', '_self', 4],
        ['2004', 'Support', 'http://support.steampowered.com/', 'text', '', '', '_blank', 5],
        
        ['2005', 'Store', '/', 'text', '', '', '_self', 1],
        ['2005', 'My Games', '/mygames/', 'text', '', '', '_self', 2],
        ['2005', 'Community', '/community/', 'text', '', '', '_self', 3],
        ['2005', 'Support', 'http://support.steampowered.com/', 'text', '', '', '_blank', 4],
        
        // 2006-2009: Modern store navigation
        ['2006', 'HOME', '/', 'text', '', '', '_self', 1],
        ['2006', 'NEWS', '/news/', 'text', '', '', '_self', 2],
        ['2006', 'GET STEAM NOW', '/download/', 'text', '', '', '_self', 3],
        ['2006', 'CYBER CAFÉS', 'https://cafe.steampowered.com/', 'text', '', '', '_blank', 4],
        ['2006', 'SUPPORT', 'http://support.steampowered.com/', 'text', '', '', '_blank', 5],
        ['2006', 'FORUMS', '/forums/', 'text', '', '', '_self', 6],
        ['2006', 'STATS', '/stats/', 'text', '', '', '_self', 7],
        
        ['2007', 'STORE', '/', 'text', '', '', '_self', 1],
        ['2007', 'MY GAMES', '/mygames/', 'text', '', '', '_self', 2],
        ['2007', 'NEWS', '/news/', 'text', '', '', '_self', 3],
        ['2007', 'COMMUNITY', '/community/', 'text', '', '', '_self', 4],
        ['2007', 'SUPPORT', 'http://support.steampowered.com/', 'text', '', '', '_blank', 5],
        
        ['2008', 'STORE', '/', 'text', '', '', '_self', 1],
        ['2008', 'LIBRARY', '/library/', 'text', '', '', '_self', 2],
        ['2008', 'COMMUNITY', '/community/', 'text', '', '', '_self', 3],
        ['2008', 'NEWS', '/news/', 'text', '', '', '_self', 4],
        ['2008', 'SUPPORT', 'http://support.steampowered.com/', 'text', '', '', '_blank', 5],
        
        ['2009', 'STORE', '/', 'text', '', '', '_self', 1],
        ['2009', 'LIBRARY', '/library/', 'text', '', '', '_self', 2],
        ['2009', 'COMMUNITY', '/community/', 'text', '', '', '_self', 3],
        ['2009', 'PROFILE', '/profile/', 'text', '', '', '_self', 4],
        ['2009', 'NEWS', '/news/', 'text', '', '', '_self', 5],
        ['2009', 'SUPPORT', 'http://support.steampowered.com/', 'text', '', '', '_blank', 6],
    ];
    
    $stmt = $db->getConnection()->prepare(
        "INSERT INTO navigation_links (theme, title, url, link_type, image_path, image_alt, target, sort_order) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    
    foreach ($navigation_data as $nav) {
        $stmt->execute($nav);
    }
}

/**
 * Insert sample FAQ data
 */
function insertSampleFAQ($db) {
    // Create FAQ categories for each theme
    $categories = [
        ['2002', 'Steam Beta', 'Questions about the Steam beta program'],
        ['2002', 'Technical Support', 'Technical issues and troubleshooting'],
        
        ['2003', 'Getting Started', 'How to get started with Steam'],
        ['2003', 'Account & Billing', 'Account management and billing questions'],
        
        ['2004', 'Half-Life 2', 'Questions about Half-Life 2'],
        ['2004', 'Steam Platform', 'General Steam platform questions'],
        
        ['2005', 'Games & Downloads', 'Questions about games and downloading'],
        ['2005', 'Community Features', 'Friends, groups, and community'],
        
        ['2006', 'Steam Store', 'Questions about the Steam Store'],
        ['2006', 'Purchasing Games', 'How to buy and download games'],
        
        ['2007', 'The Orange Box', 'Questions about The Orange Box'],
        ['2007', 'Account Security', 'Keeping your account secure'],
        
        ['2008', 'Steam Client', 'Using the Steam client application'],
        ['2008', 'Game Updates', 'Automatic updates and patches'],
        
        ['2009', 'Steam Workshop', 'User-generated content and mods'],
        ['2009', 'Steam Community', 'Community features and social gaming']
    ];
    
    foreach ($categories as $cat) {
        $cat_id = $db->insert('faq_categories', [
            'theme' => $cat[0],
            'name' => $cat[1],
            'description' => $cat[2],
            'sort_order' => 1
        ]);
        
        // Add sample FAQ entries for each category
        $sample_entries = [
            [
                'question' => 'What is ' . $cat[1] . '?',
                'answer' => 'This section covers all aspects of ' . $cat[1] . ' including basic information, troubleshooting, and advanced features.'
            ],
            [
                'question' => 'How do I get started?',
                'answer' => 'To get started with ' . $cat[1] . ', follow the installation guide and make sure your system meets the minimum requirements.'
            ]
        ];
        
        foreach ($sample_entries as $entry) {
            $db->insert('faq_entries', [
                'category_id' => $cat_id,
                'question' => $entry['question'],
                'answer' => $entry['answer'],
                'sort_order' => 1
            ]);
        }
    }
}

?>
