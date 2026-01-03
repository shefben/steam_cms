<?php
if (!isset($pdo) || !($pdo instanceof PDO)) {
    return;
}

// Insert sample data for single_large_capsule (2007-2010 theme large rotating capsules)
$stmt = $pdo->prepare('INSERT INTO single_large_capsule (theme, appid, image_path, description, url, `order`)
VALUES (:theme, :appid, :image_path, :description, :url, :order)
ON DUPLICATE KEY UPDATE
    image_path = VALUES(image_path),
    description = VALUES(description),
    url = VALUES(url),
    `order` = VALUES(`order`)');

$capsules = [
    // 2007_v1 theme (uses 2007 style capsule)
    ['2007_v1', 220, '2007_v1/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1],
    ['2007_v1', 240, '2007_v1/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2],
    ['2007_v1', 300, '2007_v1/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3],

    // 2007_v2 theme (uses 2007 style capsule)
    ['2007_v2', 220, '2007_v2/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1],
    ['2007_v2', 240, '2007_v2/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2],
    ['2007_v2', 300, '2007_v2/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3],

    // 2008 theme (uses 2008 style capsule - grey background, smaller dimensions)
    ['2008', 220, '2008/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1],
    ['2008', 240, '2008/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2],
    ['2008', 300, '2008/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3],

    // 2009 theme (uses 2008 style capsule)
    ['2009', 220, '2009/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1],
    ['2009', 240, '2009/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2],
    ['2009', 300, '2009/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3],

    // 2010 theme (uses 2008 style capsule)
    ['2010', 220, '2010/hl2.png', 'The award-winning Half-Life 2 experience', 'index.php?area=game&AppId=220', 1],
    ['2010', 240, '2010/css.png', 'The worlds #1 online action game', 'index.php?area=game&AppId=240', 2],
    ['2010', 300, '2010/dods.png', 'Intense WWII combat', 'index.php?area=game&AppId=300', 3],
];

foreach ($capsules as $row) {
    [$theme, $appid, $image_path, $description, $url, $order] = $row;
    $stmt->execute([
        ':theme'       => $theme,
        ':appid'       => $appid,
        ':image_path'  => $image_path,
        ':description' => $description,
        ':url'         => $url,
        ':order'       => $order,
    ]);
}
