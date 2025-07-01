<?php
/*********************************************************************
 * Steam-style line graph – pixel-accurate replica
 *********************************************************************/

// DEBUG SWITCH
$debug = isset($_GET['debug']);
if ($debug) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

// LOAD XML
$xmlFile = __DIR__ . '/graph.xml';
if (!is_readable($xmlFile)) {
    http_response_code(500);
    exit("graph.xml missing");
}
libxml_use_internal_errors(true);
$xml = simplexml_load_file($xmlFile);
if (!$xml) {
    http_response_code(500);
    exit("graph.xml is malformed:\n" .
        implode("\n", array_map(function($e) { return $e->message; }, libxml_get_errors())));
}

$gw = max(1, (int)$xml->graphWidth);
$gh = max(1, (int)$xml->graphHeight);

// COLLECT SERIES
$series = [];
$yMax = 0;
foreach ($xml->dataSet->children() as $member) {
    $points = [];
    foreach ($member->p as $pt) {
        $v = (float)$pt['v'];
        $points[] = ['label' => (string)$pt['label'], 'v' => $v];
        $yMax = max($yMax, $v);
    }
    if ($points) $series[] = $points;
}
if (!$series) {
    http_response_code(500);
    exit("graph.xml contains no data sets");
}
$yMax = ceil($yMax / 1000) * 1000 ?: 1;

// CREATE CANVAS
if (!function_exists('imagecreatetruecolor')) {
    http_response_code(500);
    exit("GD extension is not enabled");
}
$im = imagecreatetruecolor($gw, $gh);
imagesavealpha($im, true);
$trans = imagecolorallocatealpha($im, 0, 0, 0, 127);
imagefill($im, 0, 0, $trans);

// COLORS (Steam-style)
$clr_bg     = imagecolorallocate($im, 43, 45, 50);    // #2b2d32
$clr_grid   = imagecolorallocate($im, 62, 66, 70);    // #3e4246
$clr_line   = imagecolorallocate($im, 58,161,217);    // #3aa1d9
$clr_border = imagecolorallocate($im, 46,48,53);      // #2e3035
$clr_text   = imagecolorallocate($im, 255,255,255);   // white

// BACKGROUND
imagefilledrectangle($im, 0, 0, $gw, $gh, $clr_bg);

// GRID (dotted horizontal lines only)
$hDivs = isset($xml->horizontalDivs) ? max(1, (int)$xml->horizontalDivs) : 6;
$style = [$clr_grid, $clr_grid, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT];
imagesetstyle($im, $style);
for ($i = 1; $i <= $hDivs; $i++) {
    $y = intval($i * ($gh / ($hDivs + 1)));
    imageline($im, 1, $y, $gw - 2, $y, IMG_COLOR_STYLED);
}

// PLOT LINE
$vDivs = max(1, count($series[0]) - 1);
$font = __DIR__.'/fonts/silkscreen.ttf';
$haveFont = is_file($font) && function_exists('imagettftext');

$dotPng = is_file(__DIR__.'/assets/dot_big.png')
    ? imagecreatefrompng(__DIR__.'/assets/dot_big.png') : null;

foreach ($series as $points) {
    $prev = null;
    foreach ($points as $pos => $pt) {
        $x = round($pos * $gw / $vDivs);
        $y = $gh - round($pt['v'] / $yMax * $gh);

        if ($prev) {
            imageline($im, $prev['x'], $prev['y'], $x, $y, $clr_line);
        }

        if ($dotPng) {
            $dw = imagesx($dotPng);
            $dh = imagesy($dotPng);
            imagecopy($im, $dotPng, $x - $dw/2, $y - $dh/2, 0, 0, $dw, $dh);
        } else {
            imagefilledellipse($im, $x, $y, 4, 4, $clr_line);
        }

        $prev = ['x' => $x, 'y' => $y];
    }
}

// LEGEND
$legendLineX = 10;
$legendLineY = 14;
$legendLineW = 25;
$legendLabel = "Steam users logged in";

imageline($im, $legendLineX, $legendLineY, $legendLineX + $legendLineW, $legendLineY, $clr_line);
if ($haveFont) {
    imagettftext($im, 8, 0, $legendLineX + $legendLineW + 6, $legendLineY + 3, $clr_text, $font, $legendLabel);
}

// X-AXIS LABELS
$xLabels = $series[0] ?? [];
if ($haveFont) {
    foreach ($xLabels as $i => $pt) {
        $x = round($i * $gw / $vDivs);
        $label = strtoupper($pt['label']);
        imagettftext($im, 6, 270, $x - 5, $gh - 4, $clr_text, $font, $label);
    }
}

// Y-AXIS VALUES
for ($i = 0; $i <= $hDivs; $i++) {
    $val = number_format($yMax / $hDivs * $i);
    $y = $gh - round($i * $gh / $hDivs) - 2;
    if ($haveFont) {
        imagettftext($im, 6, 0, $gw - 50, $y, $clr_text, $font, $val);
    } else {
        imagestring($im, 2, $gw - 50, $y - 6, $val, $clr_text);
    }
}

// BORDER
imagerectangle($im, 0, 0, $gw - 1, $gh - 1, $clr_border);

// OPTIONAL LOGO
$logoPath = __DIR__.'/assets/logo_valve.png';
if (is_file($logoPath)) {
    $logo = imagecreatefrompng($logoPath);
    $lw = imagesx($logo);
    $lh = imagesy($logo);
    imagecopy($im, $logo, 4, $gh - $lh - 4, 0, 0, $lw, $lh);
}

// OUTPUT
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
