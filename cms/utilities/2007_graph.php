<?php
/**
 * graph.php – PHP GD replacement for the old ActionScript DoAction.as chart
 *
 * Usage examples
 *   graph.php?data=data.xml                    # XML sits next to this script
 *   graph.php?data=https://example.com/data.xml# remote XML
 *   graph.php?style=bars                      # override _global.graphStyle
 *
 * Flash globals that can be overridden via query-string:
 *   graphWidth, graphHeight, graphStyle, barColor, lineColor,
 *   pieColors (comma separated hex), YlabCount, YlabFormat, etc.
 *
 * Requires PHP ≥ 7.4 with GD extension.
 */

error_reporting(E_ALL);
ini_set('display_errors', 0); // keep PNG output clean

if (!extension_loaded('gd')) {
    header('Content-Type: text/plain', true, 500);
    exit("GD extension not loaded\n");
}

/* -------------------------------------------------------------
 * 1. Default settings – mirrors the ActionScript _global.* vars
 * ----------------------------------------------------------- */
$G = [
    'graphWidth'        => 720,
    'graphHeight'       => 180,
    'graphStyle'        => 'lines',      // 'lines', 'bars', 'pies'
    'barWidth'          => 20,
    'barColor'          => '1E90FF',
    'lineColor'         => 'FF4500',
    'pieColors'         => ['1E90FF','32CD32','FF4500','9370DB'],
    'YlabCount'         => 5,
    'YlabFormat'        => 'number',     // 'number','currency','thousand','million','percent'
    'YlabColor'         => '000000',
    'showYlab'          => 'true',
    'showVertLine'      => 'true',
    'spacing'           => 30,           // left/right padding
    'background'        => 'FFFFFF',
];

/* Override from query-string ( ?graphWidth=800&graphStyle=bars&pieColors=... ) */
foreach ($_GET as $k => $v) {
    if (isset($G[$k])) {
        $G[$k] = is_numeric($G[$k]) ? (float)$v
               : (is_array($G[$k]) ? explode(',', $v) : $v);
    }
}

/* -------------------------------------------------------------
 * 2. Load the XML data
 * ----------------------------------------------------------- */
$dataParam = $_GET['data'] ?? 'data.xml';
if (preg_match('#^https?://#', $dataParam)) {
    header('Content-Type: text/plain', true, 400);
    exit("Remote data URLs are not allowed\n");
}
$dataURL = realpath(__DIR__ . '/' . $dataParam);
if ($dataURL === false || strncmp($dataURL, __DIR__, strlen(__DIR__)) !== 0 || !is_file($dataURL)) {
    header('Content-Type: text/plain', true, 404);
    exit("Data source not found\n");
}

libxml_use_internal_errors(true);
$xml = simplexml_load_string(file_get_contents($dataURL));
if (!$xml) {
    header('Content-Type: text/plain', true, 500);
    exit("Invalid XML\n");
}

/* ActionScript expected <row><x>Label</x><y>Value</y></row>… */
$points = [];
foreach ($xml->row as $row) {
    $points[] = [
        'label' => (string)$row->x,
        'value' => (float)$row->y
    ];
}

if (!$points) {
    header('Content-Type: text/plain', true, 500);
    exit("No data rows\n");
}

/* -------------------------------------------------------------
 * 3. Basic calculations
 * ----------------------------------------------------------- */
$maxY = max(array_column($points, 'value'));
$minY = min(array_column($points, 'value'));
if ($maxY == $minY) $maxY += 1;  // avoid divide-by-zero

$plotW = $G['graphWidth']  - $G['spacing']*2;
$plotH = $G['graphHeight'] - $G['spacing']*2;
$img   = imagecreatetruecolor($G['graphWidth'], $G['graphHeight']);

/* Utility for colours */
$hex2gd = fn($hex) => sscanf($hex, "%02x%02x%02x");
$col    = fn($hex) => imagecolorallocate($img, ...$hex2gd($hex));

$bg = $col($G['background']); // background
imagefill($img, 0, 0, $bg);

/* -------------------------------------------------------------
 * 4. Draw grid & Y labels (left)
 * ----------------------------------------------------------- */
$gridCol = $col('DDDDDD');
$fontH   = 3;          // built-in GD font
$stepY   = $plotH / ($G['YlabCount']-1);

for ($i = 0; $i < $G['YlabCount']; $i++) {
    $y = $G['spacing'] + $i * $stepY;
    imageline($img, $G['spacing'], $y, $G['graphWidth']-$G['spacing'], $y, $gridCol);

    if ($G['showYlab'] == 'true') {
        $raw  = $maxY - ($maxY-$minY) / ($G['YlabCount']-1) * $i;
        $text = formatLabel($raw, $G['YlabFormat']);
        imagestring($img, $fontH, 2, $y-7, $text, $col($G['YlabColor']));
    }
}

/* Optional vertical grid lines */
if ($G['showVertLine'] == 'true') {
    $stepX = $plotW / (count($points)-1 ?: 1);
    for ($i = 0; $i < count($points); $i++) {
        $x = $G['spacing'] + $i * $stepX;
        imageline($img, $x, $G['spacing'], $x, $G['graphHeight']-$G['spacing'], $gridCol);
    }
}

/* -------------------------------------------------------------
 * 5. Draw the chosen chart type
 * ----------------------------------------------------------- */
switch (strtolower($G['graphStyle'])) {
    case 'bars':
        drawBars($img, $points, $G, $maxY, $minY);
        break;
    case 'pies':
        drawPies($img, $points, $G);
        break;
    default: // lines
        drawLines($img, $points, $G, $maxY, $minY);
}

/* -------------------------------------------------------------
 * 6. X-axis labels
 * ----------------------------------------------------------- */
$stepX = $plotW / (count($points)-1 ?: 1);
foreach ($points as $i => $pt) {
    $x = $G['spacing'] + $i * $stepX;
    $label = (string)$pt['label'];
    $w = imagefontwidth(2) * strlen($label);
    imagestring($img, 2, $x - $w/2, $G['graphHeight'] - $G['spacing'] + 4, $label, $col('000000'));
}

/* -------------------------------------------------------------
 * 7. Output
 * ----------------------------------------------------------- */
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);

/* =============================================================
 * Helper functions
 * =========================================================== */

function normalise($v, $min, $max) {
    return ($v-$min) / ($max-$min);
}

function formatLabel($num, $type) {
    switch ($type) {
        case 'currency': return '$'.number_format($num, 2);
        case 'thousand': return number_format($num/1e3, 1).'k';
        case 'million':  return number_format($num/1e6, 1).'M';
        case 'percent':  return number_format($num*100, 0).'%';
        default:         return number_format($num);
    }
}

function drawBars($img, $pts, $G, $maxY, $minY) {
    $plotW = $G['graphWidth']  - $G['spacing']*2;
    $plotH = $G['graphHeight'] - $G['spacing']*2;
    $col   = fn($hex)=>imagecolorallocate($img,...sscanf($hex,"%02x%02x%02x"));

    $stepX = $plotW / count($pts);
    foreach ($pts as $i=>$pt) {
        $x1 = $G['spacing'] + $i*$stepX + $stepX/2 - $G['barWidth']/2;
        $x2 = $x1 + $G['barWidth'];
        $y2 = $G['graphHeight'] - $G['spacing'];
        $norm = normalise($pt['value'],$minY,$maxY);
        $y1 = $G['spacing'] + $plotH*(1-$norm);
        imagefilledrectangle($img,$x1,$y1,$x2,$y2,$col($G['barColor']));
        imagerectangle($img,$x1,$y1,$x2,$y2,$col('000000'));
    }
}

function drawLines($img,$pts,$G,$maxY,$minY){
    $plotW = $G['graphWidth']  - $G['spacing']*2;
    $plotH = $G['graphHeight'] - $G['spacing']*2;
    $col   = fn($hex)=>imagecolorallocate($img,...sscanf($hex,"%02x%02x%02x"));

    $stepX = $plotW / (count($pts)-1 ?: 1);
    $prev = null;
    foreach ($pts as $i=>$pt){
        $x = $G['spacing'] + $i*$stepX;
        $norm = normalise($pt['value'],$minY,$maxY);
        $y = $G['spacing'] + $plotH*(1-$norm);

        if($prev){
            imageline($img,$prev[0],$prev[1],$x,$y,$col($G['lineColor']));
        }
        imagefilledellipse($img,$x,$y,6,6,$col($G['lineColor']));
        $prev = [$x,$y];
    }
}

function drawPies($img,$pts,$G){
    $total = array_sum(array_column($pts,'value'));
    if($total==0) $total=1;
    $cx = $G['graphWidth']/2;
    $cy = $G['graphHeight']/2;
    $diam = min($G['graphWidth'],$G['graphHeight'])-40;
    $start = 0;
    foreach($pts as $i=>$pt){
        $perc = $pt['value']/$total;
        $end = $start + $perc*360;
        $col = fn($hex)=>imagecolorallocate($img,...sscanf($hex,"%02x%02x%02x"));
        $sliceCol = $col($G['pieColors'][$i % count($G['pieColors'])]);
        imagefilledarc($img,$cx,$cy,$diam,$diam,$start,$end,$sliceCol,IMG_ARC_PIE);
        $start = $end;
    }
}
