<?php
// graph.php – Steam-style 48 h bandwidth graph (720×225 PNG)
// PHP ≥ 7.4 + GD extension

error_reporting(0);
ini_set('display_errors', 0);
if (!extension_loaded('gd')) {
    header('Content-Type: text/plain', true, 500);
    exit("GD extension not loaded\n");
}

// ── CONFIGURATION ───────────────────────────────────────────────
$W        = 720;
// ↑ height bumped from 180 → 225 to accommodate one extra grid row
$H        = 250;
$SPAN_H   = 48;              // hours to display
$STEP_MIN = 20;              // one point every 20 min → 144 data pts
$PTS      = $SPAN_H * 60 / $STEP_MIN;
$LABELS   = 41;              // x-axis slots
$CAP      = 200000;          // ↑ capacity raised from 15 000 → 200 000
// five evenly spaced ticks (0, 50k, 100k, 150k, 200k)
$Y_TICKS  = [0, 50000, 100000, 150000, 200000];

// margins
$LM = 80;   // left (y-labels)
$RM = 10;
$TM = 10;
$BM = 40;   // bottom (rotated labels)
$plotW = $W - $LM - $RM;
$plotH = $H - $TM - $BM;

// font
$fontFile = __DIR__ . '/lucon.ttf';
if (!file_exists($fontFile)) {
    die("Missing font: $fontFile");
}

// ── SYNTHETIC DATA ────────────────────────────────────────────────
// Usage: larger swings ±30 000, clamped to [0, CAP]
$now   = time();
$start = $now - $SPAN_H*3600;
$stepS = $STEP_MIN * 60;

$usage = [];
for ($i = 0; $i <= $PTS; $i++) {
    $ts   = $start + $i * $stepS;
    $prev = $usage[$i-1]['v'] ?? rand(20000,80000);
    $val  = $prev + rand(-30000, 30000);
    $usage[] = [
      't' => $ts,
      'v' => max(0, min($CAP, $val))
    ];
}

// Capacity line with heavier spikes
$baseline = 150000;
$capArr   = array_fill(0, $PTS+1, $baseline);
for ($j = 0; $j < 10; $j++) {
    $k = rand(10, $PTS-10);
    // bump by up to +50k
    $capArr[$k] += rand(200, 50000);
}

// ── PALETTE ─────────────────────────────────────────────────────
$im       = imagecreatetruecolor($W, $H);
$col_bg   = imagecolorallocate($im,  78,  88,  69); // #2C3329
$col_grid = imagecolorallocate($im,  45,  51,  41); // #4C5844
$col_txt  = imagecolorallocate($im, 160, 170, 149); // #D0D6D1
$col_use  = imagecolorallocate($im, 190, 173, 69); // #F0C800
$col_red  = imagecolorallocate($im, 196,   0,   0); // #C40000
$col_axis = imagecolorallocate($im,  45,  51,  41); // #4C5844

// fill main bg & axis padding
imagefilledrectangle($im,   75,   0, $W,      $H,      $col_bg);
imagefilledrectangle($im,    0,    0, $W,      $TM,     $col_axis);       // top strip
imagefilledrectangle($im,    0, $TM+$plotH, $W,      $H,      $col_axis); // bottom strip
imagefilledrectangle($im,    0,    0, $LM,     $H,      $col_axis);       // left strip
imagefilledrectangle($im, $W-$RM, 0, $W,      $H,      $col_axis);       // right strip

// ── DRAW GRID ────────────────────────────────────────────────────
// horizontal lines & labels
foreach ($Y_TICKS as $tick) {
    $y = $TM + (int)round($plotH * (1 - $tick / $CAP));
    imageline($im, $LM, $y, $W - $RM, $y, $col_grid);

    $label = number_format($tick, 0, '', '');
    $fs    = 8;
    $bbox  = imagettfbbox($fs, 7, $fontFile, $label);
    $tw    = abs($bbox[4] - $bbox[0]);
    $x     = $LM - $tw - 6;
    imagettftext($im, $fs, 0, $x, $y + 3, $col_txt, $fontFile, $label);
}

// vertical grid
$stepX = $plotW / ($LABELS - 1);
for ($i = 1; $i < $LABELS - 1; $i++) {
    $x = $LM + (int)round($i * $stepX);
    imageline($im, $x, $TM, $x, $TM + $plotH, $col_grid);
}

// ── DAY MARKERS ───────────────────────────────────────────────────
$firstMid = strtotime(date('Y-m-d 00:00:00', $start));
if ($firstMid < $start) $firstMid += 86400;
for ($m = $firstMid; $m <= $start + $SPAN_H*3600; $m += 86400) {
    $x = $LM + (int)round((($m - $start) / ($SPAN_H*3600)) * $plotW);
    $bw = 2;
    $x  = max($LM, min($x, $LM + $plotW - $bw));
    imagefilledrectangle($im, $x, $TM, $x+$bw-1, $TM+$plotH, $col_txt);
    $lbl = date('D M-d', $m);
    imagestring($im, 2, $x + 4, $TM+1, $lbl, $col_txt);
}

// ── X-AXIS LABELS ──────────────────────────────────────────────────
for ($i = 0; $i < $LABELS; $i++) {
    $x      = $LM + (int)round($i * $stepX);
    $isLast = ($i === $LABELS - 1);

    if (!$isLast) {
        $ts  = $start + $i * ($SPAN_H*3600/($LABELS-1));
        $txt = date('G:i', $ts);
        if (date('i', $ts) === '00') {
            imagestringup($im, 1,
                $x,
                $TM + $plotH + 2 + imagefontwidth(1)*strlen($txt),
                $txt,
                $col_txt
            );
        } else {
            // rotated TTF text
            $fs    = 9;
            $ang   = 90;
            $bbox  = imagettfbbox($fs, $ang, $fontFile, $txt);
            $ys    = [$bbox[1],$bbox[3],$bbox[5],$bbox[7]];
            $top   = min($ys);
            $zeroY = $TM + $plotH;
            $baseY = $zeroY - $top;
            imagettftext($im, $fs, $ang, $x + 5, $baseY + 4, $col_txt, $fontFile, $txt);
        }
    }
    else {
        // final red arrow
        $by = $TM + $plotH;
        imagettftext($im, 8, 0, $x -2, $by + 13, $col_red, $fontFile, '^');
    }
}

// ── THICKEN & DRAW CURVES ──────────────────────────────────────────
imagesetthickness($im, 4);

// capacity (cream)
for ($i = 0; $i < $PTS; $i++) {
    $x1 = $LM + $i*($plotW/$PTS);
    $x2 = $LM + ($i+1)*($plotW/$PTS);
    $y1 = $TM + $plotH*(1 - $capArr[$i]/$CAP);
    $y2 = $TM + $plotH*(1 - $capArr[$i+1]/$CAP);
    imageline($im, (int)$x1, (int)$y1, (int)$x2, (int)$y2, $col_txt);
}

// usage (yellow)
for ($i = 0; $i < $PTS; $i++) {
    $x1 = $LM + $i*($plotW/$PTS);
    $x2 = $LM + ($i+1)*($plotW/$PTS);
    $z1 = $TM + $plotH*(1 - $usage[$i]['v']/$CAP);
    $z2 = $TM + $plotH*(1 - $usage[$i+1]['v']/$CAP);
    imageline($im, (int)$x1, (int)$z1, (int)$x2, (int)$z2, $col_use);
}

imagesetthickness($im, 1);

header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
exit;
