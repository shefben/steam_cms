<?php
$supportContent = file_get_contents(__DIR__ . '/../html/support_default.html');
$supportPages = [
    ['2003_v2','2003_v2'],
    ['2004','2004'],
    ['2005_v1','2005_v1'],
    ['2005_v2','2005_v2'],
];
$stmt = $pdo->prepare('INSERT INTO support_pages(version,years,content,created,updated) VALUES(?,?,?,?,?)');
foreach ($supportPages as $sp) {
    $stmt->execute([$sp[0], $sp[1], $supportContent, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
    $id = $pdo->lastInsertId();
    $faqStmt = $pdo->prepare('INSERT INTO support_page_faqs(support_id,faqid1,faqid2,ord) VALUES(?,?,?,?)');
    $faqs = [
        [1050915714, '91503900'],
        [1050915726, '98098300'],
        [1050915754, '69234600'],
        [1063758432, '02298800'],
        [1050915738, '02222500'],
    ];
    $ord = 1;
    foreach ($faqs as $f) {
        $faqStmt->execute([$id,$f[0],$f[1],$ord++]);
    }
}
?>
