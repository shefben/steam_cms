<?php
/**
 * Steam 2004 FAQ Import Script
 * Imports comprehensive FAQ data based on 2004 Steam era content
 * Author: MiniMax Agent
 */

function import2004FAQ($db, $theme = '2004') {
    echo "Importing 2004 Steam FAQ data for theme {$theme}...\n";
    
    $faq_data = [
        'Getting Started' => [
            [
                'question' => 'What is Steam?',
                'answer' => 'Steam is Valve\'s digital distribution platform that delivers games directly to your computer. Steam provides automatic updates, anti-cheat technology, and connects you to a community of millions of gamers worldwide.',
                'sort_order' => 1
            ],
            [
                'question' => 'How do I install Steam?',
                'answer' => 'Download the Steam installer from steampowered.com, run the installer, and follow the on-screen instructions. You\'ll need to create a Steam account to get started.',
                'sort_order' => 2
            ],
            [
                'question' => 'What are the system requirements for Steam?',
                'answer' => 'Steam requires Windows 2000 or XP, DirectX 8.0 or higher, 256MB RAM, and an Internet connection. For Half-Life 2, you\'ll need additional disk space and a DirectX 9.0 compatible video card.',
                'sort_order' => 3
            ],
            [
                'question' => 'Do I need to be online to play Steam games?',
                'answer' => 'You need an Internet connection to install and initially activate Steam games. After that, you can play most single-player games offline, though multiplayer games require an Internet connection.',
                'sort_order' => 4
            ]
        ],
        
        'Half-Life 2' => [
            [
                'question' => 'I purchased Half-Life 2 in a store. How do I play it?',
                'answer' => 'Install Steam, create an account, and enter your Half-Life 2 CD-Key when prompted. The game will be added to your Steam account and you can download and play it.',
                'sort_order' => 1
            ],
            [
                'question' => 'What\'s the difference between the Bronze, Silver, and Gold packages?',
                'answer' => 'Bronze ($49.95) includes Half-Life 2 and Counter-Strike: Source. Silver ($59.95) adds Half-Life: Source and Day of Defeat: Source. Gold ($89.95) includes everything plus collector\'s items like posters, strategy guide, and soundtrack.',
                'sort_order' => 2
            ],
            [
                'question' => 'Can I play Half-Life 2 without Steam?',
                'answer' => 'No, Half-Life 2 requires Steam to play. Steam provides the copy protection, automatic updates, and online features for the game.',
                'sort_order' => 3
            ],
            [
                'question' => 'Why is Half-Life 2 taking so long to download?',
                'answer' => 'Half-Life 2 is a large game (several gigabytes). Download times depend on your Internet connection speed. You can pause and resume downloads, and play as soon as the first portion is downloaded.',
                'sort_order' => 4
            ]
        ],
        
        'Steam Client Issues' => [
            [
                'question' => 'Steam won\'t start or keeps crashing. What should I do?',
                'answer' => 'Try restarting your computer, running Steam as Administrator, or reinstalling Steam. Make sure your video drivers are up to date and disable any firewall or antivirus software temporarily.',
                'sort_order' => 1
            ],
            [
                'question' => 'I\'m getting a "Steam is having trouble connecting" error.',
                'answer' => 'This usually indicates a network connectivity issue. Check your Internet connection, firewall settings, and make sure Steam isn\'t blocked by your security software. Steam uses various ports for connection.',
                'sort_order' => 2
            ],
            [
                'question' => 'My game files are corrupted or missing. How do I fix this?',
                'answer' => 'Right-click the game in your Steam library, select Properties, go to the Local Files tab, and click "Verify Integrity of Game Cache." Steam will check and repair any corrupted files.',
                'sort_order' => 3
            ],
            [
                'question' => 'Steam is using too much bandwidth. Can I limit it?',
                'answer' => 'Yes, go to Steam Settings > Downloads and set a download rate limit. You can also schedule downloads for specific times or pause downloads when playing online games.',
                'sort_order' => 4
            ]
        ],
        
        'Account & Purchasing' => [
            [
                'question' => 'I forgot my Steam password. How do I reset it?',
                'answer' => 'On the Steam login screen, click "I can\'t sign in" and follow the instructions to reset your password using your email address or account name.',
                'sort_order' => 1
            ],
            [
                'question' => 'Can I share my Steam account with family members?',
                'answer' => 'Steam accounts are intended for individual use only. Sharing accounts violates the Steam Subscriber Agreement and can result in account restrictions.',
                'sort_order' => 2
            ],
            [
                'question' => 'What payment methods does Steam accept?',
                'answer' => 'Steam accepts major credit cards (Visa, MasterCard, American Express), PayPal, and various regional payment methods depending on your location.',
                'sort_order' => 3
            ],
            [
                'question' => 'Can I get a refund for a Steam purchase?',
                'answer' => 'Refund policies vary by region and purchase type. Generally, pre-purchased games may be refundable before release. Contact Steam Support for specific refund requests.',
                'sort_order' => 4
            ]
        ],
        
        'Counter-Strike: Source' => [
            [
                'question' => 'What\'s new in Counter-Strike: Source compared to Counter-Strike 1.6?',
                'answer' => 'Counter-Strike: Source features updated graphics using the Source engine, improved physics, enhanced sound effects, and better networking code while maintaining the classic Counter-Strike gameplay.',
                'sort_order' => 1
            ],
            [
                'question' => 'Can I use my old Counter-Strike configs and settings?',
                'answer' => 'Some settings may transfer, but you\'ll need to recreate your config files for Counter-Strike: Source. The console commands are mostly the same, but file locations have changed.',
                'sort_order' => 2
            ],
            [
                'question' => 'Why is my ping higher in Counter-Strike: Source?',
                'answer' => 'The Source engine uses different networking code. Your displayed ping might look higher but actual responsiveness may be better. Make sure your rates are configured properly for your connection.',
                'sort_order' => 3
            ]
        ],
        
        'Technical Support' => [
            [
                'question' => 'My Steam games have no sound. How do I fix this?',
                'answer' => 'Check your Windows sound settings, update your audio drivers, and verify that Steam isn\'t muted in the Windows Volume Mixer. Some games may have separate audio settings to configure.',
                'sort_order' => 1
            ],
            [
                'question' => 'Steam games are running slowly or have low FPS.',
                'answer' => 'Update your video card drivers, lower the game\'s graphics settings, close unnecessary background programs, and ensure your computer meets the minimum system requirements.',
                'sort_order' => 2
            ],
            [
                'question' => 'I\'m having problems with my USB headset/microphone.',
                'answer' => 'Steam uses Windows\' default audio devices. Set your headset as the default device in Windows Sound settings, and configure the voice settings in Steam\'s Settings menu.',
                'sort_order' => 3
            ],
            [
                'question' => 'Can I move my Steam installation to a different drive?',
                'answer' => 'Yes, but it requires reinstalling Steam. You can backup your game files first to avoid re-downloading them. Install Steam on the new drive and restore your games from backup.',
                'sort_order' => 4
            ]
        ]
    ];
    
    $category_order = 1;
    foreach ($faq_data as $category_name => $questions) {
        // Insert or get category
        $existing_category = $db->queryOne(
            "SELECT id FROM faq_categories WHERE name = ? AND theme = ?", 
            [$category_name, $theme]
        );
        
        if ($existing_category) {
            $category_id = $existing_category['id'];
            echo "Category '{$category_name}' already exists, using existing ID {$category_id}\n";
        } else {
            $category_id = $db->insert('faq_categories', [
                'name' => $category_name,
                'description' => "Frequently asked questions about {$category_name}",
                'theme' => $theme,
                'sort_order' => $category_order,
                'is_active' => 1
            ]);
            echo "Created FAQ category: {$category_name} (ID: {$category_id})\n";
        }
        
        // Insert questions for this category
        foreach ($questions as $faq) {
            $existing_question = $db->queryOne(
                "SELECT id FROM faq_entries WHERE category_id = ? AND question = ?",
                [$category_id, $faq['question']]
            );
            
            if (!$existing_question) {
                $entry_id = $db->insert('faq_entries', [
                    'category_id' => $category_id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'sort_order' => $faq['sort_order'],
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                echo "  Added FAQ: " . substr($faq['question'], 0, 50) . "... (ID: {$entry_id})\n";
            } else {
                echo "  FAQ already exists: " . substr($faq['question'], 0, 50) . "...\n";
            }
        }
        
        $category_order++;
    }
    
    echo "Steam FAQ import for theme {$theme} completed!\n";
    echo "Imported " . count($faq_data) . " categories with comprehensive Q&A content.\n";
}

// If run directly, execute the import
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    require_once 'database.php';
    $db = new Database();
    import2004FAQ($db);
}
?>
