<?php
$base = __DIR__ . '/../troubleshooter/live';
$langs = ['en','fr','de','it','es'];
$stmt = $pdo->prepare('INSERT INTO troubleshooter_pages(lang,slug,title,content,created,updated) VALUES(?,?,?,?,NOW(),NOW())');
foreach ($langs as $lang) {
    $dir = "$base/$lang";
    if (!is_dir($dir)) continue;
    foreach (glob("$dir/*.php") as $file) {
        $slug = basename($file, '.php');
        if ($slug === 'process_form') continue;
        $html = file_get_contents($file);
        preg_match('/<h1>([^<]*)<\/h1>/', $html, $m);
        $title = $m[1] ?? $slug;
        $stmt->execute([$lang,$slug,$title,$html]);
    }
}
?>
