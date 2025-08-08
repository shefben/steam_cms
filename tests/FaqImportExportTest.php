<?php
$pdo = new PDO('sqlite::memory:');
$pdo->exec('CREATE TABLE faq_content(catid1 INT, catid2 INT, faqid1 INT, faqid2 INT, title TEXT, body TEXT, views INT)');
$pdo->exec("INSERT INTO faq_content VALUES(1,1,1,1,'Q','A',0)");
$data = $pdo->query('SELECT faqid1,faqid2,catid1,catid2,title,body,views FROM faq_content')->fetchAll(PDO::FETCH_ASSOC);
$csv = fopen('php://temp','r+');
fputcsv($csv, array_keys($data[0]), ',', '"', '\\');
foreach($data as $r){fputcsv($csv,$r, ',', '"', '\\');}
rewind($csv);
$out = stream_get_contents($csv);
fclose($csv);
assert(str_contains($out,'Q'));
$json = json_encode($data);
assert(str_contains($json,'"title":"Q"'));
$import = json_decode('[{"catid1":2,"catid2":2,"faqid1":2,"faqid2":2,"title":"Q2","body":"B2","views":5}]', true);
$ins=$pdo->prepare('INSERT INTO faq_content(catid1,catid2,faqid1,faqid2,title,body,views) VALUES(?,?,?,?,?,?,?)');
foreach($import as $row){$ins->execute([$row['catid1'],$row['catid2'],$row['faqid1'],$row['faqid2'],$row['title'],$row['body'],$row['views']]);}
assert($pdo->query('SELECT COUNT(*) FROM faq_content')->fetchColumn()==2);
?>
