<?php
function extract_content(string $html): string {
    if (preg_match('/<div class="content"[^>]*>(.*)<div class="footer">/s', $html, $m)) {
        return trim($m[1]);
    }
    if (preg_match('/<body[^>]*>(.*)<\/body>/s', $html, $m)) {
        return trim($m[1]);
    }
    return trim($html);
}
function parse_links(string $content): array {
    $sections = [];
    if (preg_match_all('/<h2[^>]*>([^<]*)<\/h2>(.*?)((?=<h2|<\/div>))/s', $content, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $sec) {
            $cat = trim(strip_tags($sec[1]));
            $links_html = $sec[2];
            if (preg_match_all('/<a[^>]*href="([^"]+)"[^>]*>(.*?)<\/a>/s', $links_html, $links, PREG_SET_ORDER)) {
                $ord = 1;
                foreach ($links as $l) {
                    $sections[] = [
                        'category'=>$cat,
                        'label'=>trim(strip_tags($l[2])),
                        'url'=>html_entity_decode($l[1]),
                        'ord'=>$ord++
                    ];
                }
            }
        }
    }
    return $sections;
}
$versions = [
    '2003_v2_dlv1' => ['file'=>__DIR__.'/../archived_steampowered/2003/v2/getsteamnow_dlv1.html','years'=>'2003_v2'],
    '2003_v2_dlv2' => ['file'=>__DIR__.'/../archived_steampowered/2003/v2/getsteamnow_dlv2.html','years'=>'2003_v2'],
    '2004_dlv1' => ['file'=>__DIR__.'/../archived_steampowered/2004/getsteamnow_dlv1.html','years'=>'2004'],
    '2004_dlv2' => ['file'=>__DIR__.'/../archived_steampowered/2004/getsteamnow_dlv2.html','years'=>'2004'],
    '2004_dlv3' => ['file'=>__DIR__.'/../archived_steampowered/2004/getsteamnow_dlv3.html','years'=>'2004'],
];
$pageStmt = $pdo->prepare('INSERT INTO download_pages(version,years,content,created,updated) VALUES(?,?,?,?,?)');
$linkStmt = $pdo->prepare('INSERT INTO download_links(version,category,label,url,ord) VALUES(?,?,?,?,?)');
foreach ($versions as $ver=>$info) {
    $html = file_get_contents($info['file']);
    $body = extract_content($html);
    $pageStmt->execute([$ver,$info['years'],$body,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')]);
    foreach (parse_links($body) as $l) {
        $linkStmt->execute([$ver,$l['category'],$l['label'],$l['url'],$l['ord']]);
    }
}
