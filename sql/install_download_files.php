<?php
try{
    $pdo->query("SELECT host FROM download_file_mirrors LIMIT 1");
}catch(PDOException $e){
    if($e->getCode()==="42S22"){
        $pdo->exec("ALTER TABLE download_file_mirrors ADD COLUMN host VARCHAR(255)");
    }
}
try{
    $pdo->query("SELECT visibleontheme FROM download_files LIMIT 1");
}catch(PDOException $e){
    if($e->getCode()==="42S22"){
        $pdo->exec("ALTER TABLE download_files ADD COLUMN visibleontheme VARCHAR(255) DEFAULT ''");
    }
}
try{
    $pdo->query("SELECT usingbutton FROM download_files LIMIT 1");
}catch(PDOException $e){
    if($e->getCode()==="42S22"){
        $pdo->exec("ALTER TABLE download_files ADD COLUMN usingbutton TINYINT(1) DEFAULT 0");
    }
}
try{
    $pdo->query("SELECT buttonText FROM download_files LIMIT 1");
}catch(PDOException $e){
    if($e->getCode()==="42S22"){
        $pdo->exec("ALTER TABLE download_files ADD COLUMN buttonText VARCHAR(100) DEFAULT NULL");
    }
}
try{
    $pdo->query("SELECT 1 FROM download_page_visibility LIMIT 1");
}catch(PDOException $e){
    if($e->getCode()==="42S02"){
        $pdo->exec("CREATE TABLE download_page_visibility(theme VARCHAR(32) NOT NULL, version INT NOT NULL, file_id INT NOT NULL, PRIMARY KEY(theme,version,file_id))");
    }
}

function parse_2004_downloads(string $file): array {
    $html = file_get_contents($file);
    if(!$html) return [];
    if(preg_match('/<h3>DOWNLOAD LOCATIONS:\s*<\/h3>(.*?)<h3>SYSTEM REQUIREMENTS/s',$html,$section)){
        $html = $section[1];
    }
    $blocks = [];
    if(preg_match_all('/<h2>(.*?)<\/h2>(.*?)((?=<h2|<hr))/s',$html,$matches,PREG_SET_ORDER)){
        foreach($matches as $g){
            $header = trim(strip_tags($g[1]));
            if(!preg_match('/^(.*?)\s*:(?:\s*\(([^)]*)\))?$/',$header,$hm)) continue;
            $title = $hm[1];
            $size  = $hm[2] ?? '';
            $mirrors = [];
            if(preg_match_all('/<a[^>]*href="([^"]+)"[^>]*>(.*?)<\/a>/s',$g[2],$links,PREG_SET_ORDER)){
                foreach($links as $l){
                    $host = trim(strip_tags($l[2]));
                    $host = preg_replace('/^\d+:\s*/','',$host);
                    $mirrors[] = ['host'=>$host,'url'=>html_entity_decode($l[1])];
                }
            }
            $blocks[] = ['title'=>$title,'size'=>$size,'mirrors'=>$mirrors];
        }
    }
    return $blocks;
}

$downloads = [];

// Parse 2004 downloads
$parsed = parse_2004_downloads(__DIR__.'/../archived_steampowered/2004/getsteamnow_v1.html');
foreach($parsed as $p){
    $url = '';
    if($p['title'] === 'Minimal Steam Installer'){
        $url = './download/steaminstaller.exe';
    }
    $downloads[] = ['title'=>$p['title'],'size'=>$p['size'],'url'=>$url,'mirrors'=>$p['mirrors']];
}

// Add 2003 v3 downloads manually extracted from archived_steampowered/2003/v2/getsteamnow_v3.html
$downloads2003v3 = [
    [
        'title' => 'Minimal Steam Installer',
        'size' => 'Approx. 500 KB',
        'url' => 'http://www.steampowered.com/download/SteamInstall.exe',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/120000/127009.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=2088'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=725'],
            ['host' => 'Boomtown', 'url' => 'http://download.boomtown.net/en_uk/mods_onlinegames/Counter-Strike/steam_final/'],
            ['host' => 'Gamespot', 'url' => 'http://dlx.gamespot.com/pc/halflife/moreinfo_6075010.html'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/982526'],
        ]
    ],
    [
        'title' => 'Full Steam Installer (includes caches for all games)',
        'size' => '723.4 MB',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130416.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3669'],
            ['host' => 'GameTab.com (BT)', 'url' => 'http://www.gametab.com/files/torrents.php?fuse=81'],
            ['host' => 'Halflife2files.com', 'url' => 'http://www.halflife2files.com/file.info?ID=18861'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=733'],
            ['host' => 'Boomtown', 'url' => 'http://download.boomtown.net/en_uk/mods_onlinegames/Counter-Strike/steam_complete/'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2061'],
            ['host' => 'Gamespot', 'url' => 'http://dlx.gamespot.com/pc/halflife/moreinfo_6075372.html'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/1983031'],
        ]
    ],
    [
        'title' => 'Counter-Strike Steam Installer',
        'size' => '379.4 MB',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130271.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3630'],
            ['host' => 'Gametab.com (BT)', 'url' => 'http://www.gametab.com/files/torrents.php?fuse=77'],
            ['host' => 'Halflife2files.com', 'url' => 'http://www.halflife2files.com/file.info?ID=18828'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=727'],
            ['host' => 'Boomtown', 'url' => 'http://download.boomtown.net/en_uk/mods_onlinegames/Counter-Strike/steam_full/'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2023'],
            ['host' => 'Gamespot', 'url' => 'http://dlx.gamespot.com/pc/halflifecounterstrike/moreinfo_6075101.html'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/986734'],
        ]
    ],
    [
        'title' => 'Half-Life Steam Installer',
        'size' => '211.6 MB',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130418.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3664'],
            ['host' => 'GameTab.com (BT)', 'url' => 'http://www.gametab.com/files/torrents.php?fuse=76'],
            ['host' => 'Halflife2files.com', 'url' => 'http://www.halflife2files.com/file.info?ID=18859'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=734'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2054'],
            ['host' => 'Gamespot', 'url' => 'http://dlx.gamespot.com/pc/halflife/moreinfo_6075368.html'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/986741'],
        ]
    ],
    [
        'title' => 'Opposing Force Steam Installer',
        'size' => '289.8 MB',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130412.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3668'],
            ['host' => 'GameTab.com (BT)', 'url' => 'http://www.gametab.com/files/torrents.php?fuse=79'],
            ['host' => 'Halflife2files.com', 'url' => 'http://www.halflife2files.com/file.info?ID=18858'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=735'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2055'],
            ['host' => 'Gamespot', 'url' => 'http://dlx.gamespot.com/pc/halflifeopposingforce/moreinfo_6075292.html'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/986742'],
        ]
    ],
    [
        'title' => 'Day of Defeat Steam Installer',
        'size' => '396.2 MB',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130409.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3665'],
            ['host' => 'GameTab.com (BT)', 'url' => 'http://www.gametab.com/files/torrents.php?fuse=78'],
            ['host' => 'Halflife2files.com', 'url' => 'http://www.halflife2files.com/file.info?ID=18857'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=731'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2060'],
            ['host' => 'Gamespot', 'url' => 'http://dlx.gamespot.com/pc/dayofdefeat/moreinfo_6076399.html'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/986736'],
        ]
    ],
    [
        'title' => 'Team Fortress Classic Steam Installer',
        'size' => '272.3 MB',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130417.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3663'],
            ['host' => 'GameTab.com (BT)', 'url' => 'http://www.gametab.com/files/torrents.php?fuse=80'],
            ['host' => 'Halflife2files.com', 'url' => 'http://www.halflife2files.com/file.info?ID=18856'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=730'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2053'],
            ['host' => 'Gamespot', 'url' => 'http://dlx.gamespot.com/pc/teamfortressclassic/moreinfo_6075367.html'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/986743'],
        ]
    ],
    [
        'title' => 'Deathmatch Classic Steam Installer',
        'size' => '23.7 MB',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130420.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3666'],
            ['host' => 'Halflife2files.com', 'url' => 'http://www.halflife2files.com/file.info?ID=18855'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=732'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2059'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/986735'],
        ]
    ],
    [
        'title' => 'Ricochet Steam Installer',
        'size' => '15.5 MB',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130419.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3667'],
            ['host' => 'Halflife2files.com', 'url' => 'http://www.halflife2files.com/file.info?ID=18854'],
            ['host' => 'Games-Fusion.net', 'url' => 'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=729'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2058'],
            ['host' => 'FileFront', 'url' => 'http://files.filefront.com/986744'],
        ]
    ],
    [
        'title' => 'Dedicated Server (Windows)',
        'size' => '',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130426.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3671'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2052'],
        ]
    ],
    [
        'title' => 'Dedicated Server (Linux)',
        'size' => '',
        'url' => '',
        'mirrors' => [
            ['host' => 'Fileplanet', 'url' => 'http://www.fileplanet.com/files/130000/130424.shtml'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=3672'],
            ['host' => 'computergames.ro', 'url' => 'http://www.computergames.ro/download.php?optiune=show_download&did=2051'],
        ]
    ],
];

// Merge 2003 v3 downloads with existing downloads (avoid duplicates)
foreach($downloads2003v3 as $d2003){
    // Check if this download already exists in the 2004 downloads
    $exists = false;
    foreach($downloads as $existing){
        if($existing['title'] === $d2003['title']){
            $exists = true;
            break;
        }
    }
    if(!$exists){
        $downloads[] = $d2003;
    }
}

// Add 2003 v2 downloads manually extracted from archived_steampowered/2003/v2/getsteamnow_v2.html
$downloads2003v2 = [
    [
        'title' => 'Minimal Steam Installer',
        'size' => '500kB',
        'url' => '',
        'mirrors' => [
            ['host' => 'GAME-STORM.net', 'url' => 'http://www.game-storm.net/services/download.aspx'],
            ['host' => 'Fileshack', 'url' => 'http://www.fileshack.com/file.x?fid=2088'],
            ['host' => 'AusGamers', 'url' => 'http://www.ausgamers.com/files/details/html/7370'],
            ['host' => 'Worthplaying', 'url' => 'http://www.worthplaying.com/article.php?sid=11630'],
            ['host' => 'Extreme-Players', 'url' => 'http://www.extreme-players.de/showfiles.asp?ID=5814'],
            ['host' => 'FilePlanet', 'url' => 'http://www.fileplanet.com/files/120000/127009.shtml'],
            ['host' => 'halflife.de', 'url' => 'http://hl.gamigo.de/?id=2&detail=185'],
            ['host' => 'multiplayer.it', 'url' => 'http://www.multiplayer.it/files/scheda.php3?id=14099'],
            ['host' => 'IGN', 'url' => 'http://downloads.ign.com/objects/570/570110.html'],
            ['host' => 'onetelgaming', 'url' => 'http://www.onetelgaming.net/content/news/shownews.asp?nid=3196'],
        ]
    ]
];

// Merge 2003 v2 downloads with existing downloads - update mirrors for existing entries
foreach($downloads2003v2 as $d2003v2){
    foreach($downloads as &$d){
        if($d['title'] === $d2003v2['title']){
            // Add v2 mirrors to existing download if they're not already there
            foreach($d2003v2['mirrors'] as $newMirror){
                $exists = false;
                foreach($d['mirrors'] as $existingMirror){
                    if($existingMirror['host'] === $newMirror['host']){
                        $exists = true;
                        break;
                    }
                }
                if(!$exists){
                    $d['mirrors'][] = $newMirror;
                }
            }
            break;
        }
    }
}

$downloads[] = ['title'=>'Windows HLDS Update Tool','size'=>'<3 MB','url'=>'https://web.archive.org/download/hlds_updatetool.exe','mirrors'=>[]];
$downloads[] = ['title'=>'Linux HLDS Update Tool','size'=>'<3 MB','url'=>'https://web.archive.org/download/hldsupdatetool.bin','mirrors'=>[]];
$fileStmt = $pdo->prepare('INSERT IGNORE INTO download_files(title,file_size,main_url,visibleontheme,usingbutton,buttonText,created,updated) VALUES(?,?,?,?,?,?,NOW(),NOW())');
$mirStmt   = $pdo->prepare('INSERT IGNORE INTO download_file_mirrors(file_id,host,url,ord) VALUES(?,?,?,?)');
foreach ($downloads as $d) {
    $title = $d['title'];
    if (in_array($title, ['Windows HLDS Update Tool','Linux HLDS Update Tool'])) {
        $visible = '2004';
    } elseif (in_array($title, [
        'Full Steam Installer (includes caches for all games)',
        'Counter-Strike Steam Installer',
        'Half-Life Steam Installer',
        'Opposing Force Steam Installer',
        'Day of Defeat Steam Installer',
        'Team Fortress Classic Steam Installer',
        'Deathmatch Classic Steam Installer',
        'Ricochet Steam Installer'
    ])) {
        $visible = '2003_v2';
    } else {
        $visible = '2004,2003_v2';
    }
    $fileStmt->execute([
        $title,
        $d['size'],
        $d['url'],
        $visible,
        0,
        '',
    ]);
    $fileId = $pdo->lastInsertId();
    $ord = 1;
    foreach($d['mirrors'] as $m){
        $mirStmt->execute([$fileId,$m['host'],$m['url'],$ord++]);
    }
}

// New visibility system with proper configuration for each theme/version
$fileIds = $pdo->query('SELECT id,title FROM download_files')->fetchAll(PDO::FETCH_KEY_PAIR);

// Default configurations for each theme and version based on archived pages analysis
$themeConfigs = [
    '2003_v2' => [
        'v1' => [
            'visible_files' => ['Minimal Steam Installer', 'Full Steam Installer (includes caches for all games)'],
            'render_types' => [
                'Minimal Steam Installer' => 'title_size_mirrors_links',
                'Full Steam Installer (includes caches for all games)' => 'title_size_mirrors_links',
            ]
        ],
        'v2' => [
            'visible_files' => ['Minimal Steam Installer'],
            'render_types' => [
                'Minimal Steam Installer' => 'black_buttons_table',
            ]
        ],
        'v3' => [
            'visible_files' => [
                'Minimal Steam Installer',
                'Full Steam Installer (includes caches for all games)',
                'Counter-Strike Steam Installer',
                'Half-Life Steam Installer',
                'Opposing Force Steam Installer',
                'Day of Defeat Steam Installer',
                'Team Fortress Classic Steam Installer',
                'Deathmatch Classic Steam Installer',
                'Ricochet Steam Installer',
                'Dedicated Server (Windows)',
                'Dedicated Server (Linux)'
            ],
            'render_types' => [
                'Minimal Steam Installer' => 'title_size_mirrors_links',
                'Full Steam Installer (includes caches for all games)' => 'title_size_mirrors_links',
                'Counter-Strike Steam Installer' => 'title_size_mirrors_links',
                'Half-Life Steam Installer' => 'title_size_mirrors_links',
                'Opposing Force Steam Installer' => 'title_size_mirrors_links',
                'Day of Defeat Steam Installer' => 'title_size_mirrors_links',
                'Team Fortress Classic Steam Installer' => 'title_size_mirrors_links',
                'Deathmatch Classic Steam Installer' => 'title_size_mirrors_links',
                'Ricochet Steam Installer' => 'title_size_mirrors_links',
                'Dedicated Server (Windows)' => 'title_no_size_mirrors_links',
                'Dedicated Server (Linux)' => 'title_no_size_mirrors_links',
            ]
        ]
    ],
    '2004' => [
        'v1' => [
            'visible_files' => ['Minimal Steam Installer', 'Dedicated Server (Windows)', 'Dedicated Server (Linux)'],
            'render_types' => [
                'Minimal Steam Installer' => 'single_button',
                'Dedicated Server (Windows)' => 'title_no_size_mirrors_links',
                'Dedicated Server (Linux)' => 'title_no_size_mirrors_links',
            ]
        ],
        'v2' => [
            'visible_files' => ['Minimal Steam Installer', 'Dedicated Server (Windows)', 'Dedicated Server (Linux)'],
            'render_types' => [
                'Minimal Steam Installer' => 'single_button',
                'Dedicated Server (Windows)' => 'floating_box_title_mirrors_links',
                'Dedicated Server (Linux)' => 'floating_box_title_mirrors_links',
            ],
            'locations' => [
                'Minimal Steam Installer' => 'main_content',
                'Dedicated Server (Windows)' => 'floating_box',
                'Dedicated Server (Linux)' => 'floating_box',
            ]
        ],
        'v3' => [
            'visible_files' => ['Minimal Steam Installer', 'Dedicated Server (Windows)', 'Dedicated Server (Linux)'],
            'render_types' => [
                'Minimal Steam Installer' => 'single_button',
                'Dedicated Server (Windows)' => 'title_size_mirrors_buttons',
                'Dedicated Server (Linux)' => 'title_size_mirrors_buttons',
            ]
        ]
    ]
];

// Create new table structure for version-specific settings
try {
    $pdo->query("SELECT 1 FROM download_file_versions LIMIT 1");
} catch(PDOException $e) {
    if($e->getCode() === "42S02") {
        $pdo->exec("
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
                    'floating_box_title_mirrors_links',
                    'black_buttons_table'
                ) DEFAULT 'title_size_mirrors_buttons',
                location VARCHAR(32) DEFAULT 'main_content',
                sort_order INT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                UNIQUE KEY unique_file_theme_version (file_id, theme, page_version),
                FOREIGN KEY (file_id) REFERENCES download_files(id) ON DELETE CASCADE
            )
        ");
    }
}

// Insert version-specific configurations
$versionStmt = $pdo->prepare('
    INSERT INTO download_file_versions (file_id, theme, page_version, is_visible, render_type, location, sort_order)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE 
        is_visible = VALUES(is_visible),
        render_type = VALUES(render_type),
        location = VALUES(location),
        sort_order = VALUES(sort_order)
');

foreach ($themeConfigs as $theme => $versions) {
    foreach ($versions as $version => $config) {
        $sortOrder = 1;
        foreach ($config['visible_files'] as $title) {
            if (isset($fileIds[$title])) {
                $renderType = $config['render_types'][$title] ?? 'title_size_mirrors_buttons';
                $location = ($config['locations'][$title] ?? 'main_content');
                
                $versionStmt->execute([
                    $fileIds[$title],
                    $theme,
                    $version,
                    1, // is_visible
                    $renderType,
                    $location,
                    $sortOrder++
                ]);
            }
        }
    }
}

