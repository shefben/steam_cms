<?php
function extract_body(string $html): string {
    if (preg_match('/<div class="content"[^>]*>(.*)<div class="footer">/s', $html, $m)) {
        return trim($m[1]);
    }
    if (preg_match('/<body[^>]*>(.*)<\/body>/s', $html, $m)) {
        return trim($m[1]);
    }
    return trim($html);
}

function rewrite_paths(string $html, string $area): string {
    $html = preg_replace('#https://web\.archive\.org/.+?steampowered\.com(:80)?/index\.php#','index.php',$html);
    $html = str_replace('action="index.php"','action="/index.php"',$html);
    return $html;
}
$cafeFiles = [
    '2004_signup_v1' => __DIR__.'/../archived_steampowered/2004/Cyber Café Sign-up_version_1.html',
    '2004_signup_v2' => __DIR__.'/../archived_steampowered/2004/Cyber Café Sign-up_version_2.html',
];
$cheatFiles = [
    '2004_cheat_v1' => __DIR__.'/../archived_steampowered/2004/cheat_form_version_1.html',
    '2004_cheat_v2' => __DIR__.'/../archived_steampowered/2004/cheat_form_version_2.html',
];
$cdFiles = [
    '2004_cd_v1' => __DIR__.'/../archived_steampowered/2004/cd_account_form_version_1.html',
    '2004_cd_v2' => __DIR__.'/../archived_steampowered/2004/cd_account_form_version_2.html',
];
$stmtCafe = $pdo->prepare('INSERT INTO cafe_signup_pages(version,content,created,updated) VALUES(?,?,NOW(),NOW())');
foreach ($cafeFiles as $ver=>$file) {
    $html = file_get_contents($file);
    $html = rewrite_paths($html,'cafe_signup');
    $stmtCafe->execute([$ver, extract_body($html)]);
}
$stmtCheat = $pdo->prepare('INSERT INTO cheat_form_pages(version,content,created,updated) VALUES(?,?,NOW(),NOW())');
foreach ($cheatFiles as $ver=>$file) {
    $html = file_get_contents($file);
    $html = rewrite_paths($html,'cheat_form');
    $stmtCheat->execute([$ver, extract_body($html)]);
}
$stmtCd = $pdo->prepare('INSERT INTO cd_account_pages(version,content,created,updated) VALUES(?,?,NOW(),NOW())');
foreach ($cdFiles as $ver=>$file) {
    $html = file_get_contents($file);
    $html = rewrite_paths($html,'cd_account_form');
    $stmtCd->execute([$ver, extract_body($html)]);
}

