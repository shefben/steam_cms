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

$downloads = [
    ['title'=>'Default','size'=>'<1 MB','url'=>'./download/steaminstaller.exe','mirrors'=>[
        ['host'=>'Fileplanet','url'=>'http://www.fileplanet.com/files/120000/127009.shtml'],
        ['host'=>'Fileshack','url'=>'http://www.fileshack.com/file.x?fid=2088'],
        ['host'=>'Games-Fusion.net','url'=>'http://www.games-fusion.net/filedb/pafiledb.php?action=file&id=725'],
        ['host'=>'Boomtown','url'=>'http://download.boomtown.net/en_uk/mods_onlinegames/Counter-Strike/steam_final/'],
        ['host'=>'Gamespot','url'=>'http://dlx.gamespot.com/pc/halflife/moreinfo_6075010.html'],
        ['host'=>'FileFront','url'=>'http://files.filefront.com/982526'],
    ]]
];
$parsed = parse_2004_downloads(__DIR__.'/../archived_steampowered/2004/getsteamnow_dlv1.html');
foreach($parsed as $p){
    $downloads[] = ['title'=>$p['title'],'size'=>$p['size'],'url'=>'','mirrors'=>$p['mirrors']];
}
$downloads[] = ['title'=>'Windows HLDS Update Tool','size'=>'<3 MB','url'=>'./download/hlds_updatetool.exe','mirrors'=>[]];
$downloads[] = ['title'=>'Linux HLDS Update Tool','size'=>'<3 MB','url'=>'./download/hldsupdatetool.bin','mirrors'=>[]];

$stmt = $pdo->prepare('INSERT INTO download_files(title,file_size,main_url,visibleontheme,usingbutton,buttonText,created,updated) VALUES(?,?,?,?,?,?,NOW(),NOW())');
$mirStmt = $pdo->prepare('INSERT INTO download_file_mirrors(file_id,host,url,ord) VALUES(?,?,?,?)');
foreach($downloads as $d){
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
    $stmt->execute([
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

