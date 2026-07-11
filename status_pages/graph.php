<?php
/**************************************************************
 * Steam-style line graph – pixel-perfect recreation
 **************************************************************/

// Image dimensions and plot area
$gw = 800;
$gh = 600;
$plotX = 50;
$plotY = 50;
$plotWidth = 700;
$plotHeight = 500;

// Generate exact data points (2-hour intervals from March 29-30)
$start = new DateTime('2025-03-29 00:00:00');
$points = [];
foreach (range(0, 24) as $i) {
    $time = clone $start;
    $time->modify("+$i hours");
    $label = $time->format('j M H:i');
    
    // Peak at 14:00 on both days
    if (in_array($i, [14, 14+24])) {
        $value = 3825375089; // Matches tooltip value
    } 
    // Trough at 22:00 on both days
    elseif (in_array($i, [22, 22+24])) {
        $value = 18000000;
    } 
    // Linear interpolation between peaks/troughs
    else {
        $cycle = ($i % 24) / 24;
        $value = 18000000 + (38000000-18000000) * sin($cycle * M_PI);
    }
    
    $points[] = ['label' => $label, 'v' => $value];
}

$yMin = 18000000;
$yMax = 38000000;

// Create image
$im = imagecreatetruecolor($gw, $gh);
imagesavealpha($im, true);
$trans = imagecolorallocatealpha($im, 0, 0, 0, 127);
imagefill($im, 0, 0, $trans);

// Background
$bg = imagecolorallocate($im, 48, 50, 56); // #303238
imagefilledrectangle($im, 0, 0, $gw, $gh, $bg);

// Grid lines
$grid = imagecolorallocate($im, 64, 66, 72); // #404248
$hDivs = 6;
$vDivs = count($points) - 1;

// Horizontal grid
for ($i = 0; $i <= $hDivs; $i++) {
    $y = (int) ($plotY + round($i * $plotHeight / $hDivs));
    imageline($im, $plotX, $y, $plotX + $plotWidth, $y, $grid);
}

// Vertical grid
for ($i = 0; $i <= $vDivs; $i++) {
    $x = (int) ($plotX + round($i * $plotWidth / $vDivs));
    imageline($im, $x, $plotY, $x, $plotY + $plotHeight, $grid);
}

// Colors and resources
$font = __DIR__.'/fonts/silkscreen.ttf';
$white = imagecolorallocate($im, 255, 255, 255);
$steamBlue = imagecolorallocate($im, 102, 192, 244); // #66c0f4

// Legend
imageline($im, 8, 10, 30, 10, $steamBlue);
imagettftext($im, 8, 0, 36, 14, $white, $font, "Steam users logged in");

// Draw data line
$prev = null;
foreach ($points as $pos => $pt) {
    $x = (int) ($plotX + round($pos * $plotWidth / $vDivs));
    $y = (int) ($plotY + $plotHeight - (($pt['v'] - $yMin) / ($yMax - $yMin)) * $plotHeight);
    
    if ($prev) imageline($im, $prev['x'], $prev['y'], $x, $y, $steamBlue);
    
    imagefilledellipse($im, $x, $y, 4, 4, $steamBlue);
    $prev = ['x' => $x, 'y' => $y];
}

// X-axis labels
foreach ($points as $i => $pt) {
    $x = (int) ($plotX + round($i * $plotWidth / $vDivs));
    imagettftext($im, 6, 270, $x - 5, $gh - 5, $white, $font, strtoupper($pt['label']));
}

// Tooltip at center
imagettftext($im, 10, 0, $plotX + $plotWidth/2 - 60, $plotY + $plotHeight/2, $white, $font, "38,25375089 USERS");

// Output
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
?>