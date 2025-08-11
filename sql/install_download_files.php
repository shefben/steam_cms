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
$parsed = parse_2004_downloads(__DIR__.'/../archived_steampowered/2004/getsteamnow_v1.html');
foreach($parsed as $p){
    $url = '';
    if($p['title'] === 'Minimal Steam Installer'){
        $url = './download/steaminstaller.exe';
    }
    $downloads[] = ['title'=>$p['title'],'size'=>$p['size'],'url'=>$url,'mirrors'=>$p['mirrors']];
}
$downloads[] = ['title'=>'Windows HLDS Update Tool','size'=>'<3 MB','url'=>'https://web.archive.org/download/hlds_updatetool.exe','mirrors'=>[]];
$downloads[] = ['title'=>'Linux HLDS Update Tool','size'=>'<3 MB','url'=>'https://web.archive.org/download/hldsupdatetool.bin','mirrors'=>[]];
$fileStmt = $pdo->prepare('INSERT INTO download_files(title,file_size,main_url,visibleontheme,usingbutton,buttonText,created,updated) VALUES(?,?,?,?,?,?,NOW(),NOW())');
$mirStmt   = $pdo->prepare('INSERT INTO download_file_mirrors(file_id,host,url,ord) VALUES(?,?,?,?)');
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

$visStmt = $pdo->prepare('INSERT INTO download_page_visibility(theme,version,file_id) VALUES(?,?,?)');
$fileIds = $pdo->query('SELECT id,title FROM download_files')->fetchAll(PDO::FETCH_KEY_PAIR);
$map = [
    '2003_v2' => [
        1 => ["If you're upgrading from Counter-Strike 1.5"],
        2 => ['Steam Installer'],
        3 => ['Steam Installer',"If you're upgrading from Counter-Strike 1.5",'Dedicated Server (Windows)','Dedicated Server (Linux)','Windows HLDS Update Tool','Linux HLDS Update Tool'],
    ],
    '2004' => [
        1 => ['Steam Installer','Dedicated Server (Windows)','Dedicated Server (Linux)'],
        2 => ['Steam Installer','Dedicated Server (Windows)','Dedicated Server (Linux)'],
        3 => ['Steam Installer','Dedicated Server (Windows)','Dedicated Server (Linux)'],
    ],
];
foreach ($map as $theme=>$versions) {
    foreach ($versions as $ver=>$titles) {
        foreach ($titles as $title) {
            if(isset($fileIds[$title])) {
                $visStmt->execute([$theme,$ver,$fileIds[$title]]);
            }
        }
    }
}

