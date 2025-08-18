<?php
// graph.php – Steam-style 48 h bandwidth graph (720×180 PNG)
// PHP ≥ 7.4 + GD extension
require_once __DIR__.'/functions.php';

// — Silence PHP errors from corrupting the PNG —
error_reporting(0);
ini_set('display_errors', 0);

if (!extension_loaded('gd')) {
    header('Content-Type: text/plain', true, 500);
    throw new RuntimeException('GD extension not loaded');
}

// ── CONFIGURATION ───────────────────────────────────────────────────────
$W        = 720;
$H        = 180;
$SPAN_H   = 48;             // hours to display
$STEP_MIN = 20;             // one point every 20 min → 144 data pts
$PTS      = $SPAN_H * 60 / $STEP_MIN;
$LABELS   = 41;             // x-axis slots (last slot is red arrow)
$CAP      = 15000;          // capacity line (Mbps)
$Y_TICKS  = [0, 5000, 10000, 15000];

// margins
$LM = 80;   // left (y-labels)
$RM = 4;
$TM = 4;
$BM = 40;   // bottom (rotated labels)
$plotW = $W - $LM - $RM;
$plotH = $H - $TM - $BM;

// Set your custom TTF font
$fontFile =  '../../includes/font/lucon.ttf';
if (!file_exists($fontFile)) {
    throw new RuntimeException("Missing font: $fontFile");
}

// ── SYNTHETIC DATA (just for demo) ──────────────────────────────────────
// Replace this block with your DB query (20-min buckets for last 48 h).

$now   = time();
$start = $now - $SPAN_H*3600;
$stepS = $STEP_MIN * 60;

[$usage, $capArr] = (
    __FILE__ === __DIR__.'/player_graph.php'
    ? player_data($PTS, $start, $stepS, $CAP)
    : bw_data     ($PTS, $start, $stepS, $CAP)
);

$usage = [];
for ($i = 0; $i <= $PTS; $i++) {
    $ts   = $start + $i * $stepS;
    $prev = $usage[$i-1]['v'] ?? rand(2500, 5500);
    $usage[] = ['t'=>$ts, 'v'=> max(1200, min(6500, $prev + rand(-300,300)))];
}
// Add a few capacity “spikes” for the white stubs
$capArr = array_fill(0, $PTS+1, $CAP);
for ($j = 0; $j < 6; $j++) {
    $k = rand(5, $PTS-5);
    $capArr[$k] += rand(400,1600);
}

// ── PALETTE ───────────────────────────────────────────────────────────────
$im      = imagecreatetruecolor($W, $H);
$col_bg  = imagecolorallocate($im,  78,  88,  69); // #2C3329
$col_grid= imagecolorallocate($im,  45,  51,  41); // #4C5844
$col_txt = imagecolorallocate($im, 160, 168, 149); // #D0D6D1
$col_use = imagecolorallocate($im, 240, 200,   0); // #F0C800
$col_red = imagecolorallocate($im, 196,   0,   0); // #C40000
$col_axis_bg = imagecolorallocate($im,  45,  51,  41); // #4C5844

// fill bg
imagefilledrectangle($im, 75,0, $W,$H, $col_bg);
imagefilledrectangle($im, 80,0, 0,$H, $col_axis_bg);
imagefilledrectangle($im, 0,140, $W,$H, $col_axis_bg);
imagefilledrectangle($im, 0,0, $W,$H-170, $col_axis_bg);
imagefilledrectangle($im, 715,0, $W ,$H, $col_axis_bg);

// ── DRAW GRID: horizontal + vertical slots ───────────────────────────────
// horizontal lines
foreach ($Y_TICKS as $tick) {
    // base Y position
    $y = $TM + (int)round($plotH * (1 - $tick / $CAP));

    // apply offset only to 5000
    if ($tick === 5000) {
        $y += 2;  // move up
    } else if ($tick === 10000){
        $y += 4;  // regular offset
    }
	else
{

        $y += 3;  
}

    // draw line
    imageline($im, $LM, $y, $W - $RM, $y, $col_grid);

    // draw label
    $label = $tick . 'Mbps';
    $fontSize = 8;
    $bbox = imagettfbbox($fontSize, 0, $fontFile, $label);
    $textWidth = abs($bbox[4] - $bbox[0]);
    $x = $LM - $textWidth - 6;

    $labelYOffset = ($tick === 15000) ? 5 : 2;

imagettftext($im, $fontSize, 0, $x - 1, $y + $labelYOffset, $col_txt, $fontFile, $label);
}
// vertical grid at each of the 39 interior label slots
$stepX  = $plotW / ($LABELS - 1);
for ($i = 1; $i < $LABELS - 1; $i++) {
    $x = $LM + (int)round($i * $stepX);
    imageline($im, $x, $TM, $x, $TM + $plotH, $col_grid);
}

// ── DAY MARKERS & BANNERS ────────────────────────────────────────────────
// find every midnight in range
$firstMid = strtotime(date('Y-m-d 00:00:00', $start));
if ($firstMid < $start) {
    $firstMid += 86400;
}for ($m = $firstMid; $m <= $start + $SPAN_H*3600; $m += 86400) {
    $x = $LM + (int)round((($m - $start) / ($SPAN_H*3600)) * $plotW);
    // thick white bar
    //imageline($im, $x, $TM, $x, $TM + $plotH, $col_txt);
    $barWidth = 2; // width in pixels
    $x = max($LM, min($x, $LM + $plotW - $barWidth));
imagefilledrectangle($im, $x, $TM+6, $x + $barWidth - 1, $TM + $plotH - 1, $col_txt);

    // centred date banner
    $label = date('D M-d', $m);
    $fw = imagefontwidth(1) * strlen($label);
    imagestring($im, 2, $x + 3, $TM +6, $label, $col_txt);
}

// ── X-AXIS LABELS & RED ARROW ────────────────────────────────────────────
for ($i = 0; $i < $LABELS; $i++) {
    $x    = $LM + (int)round($i * $stepX);
    $isLast = ($i === $LABELS - 1);

    if (!$isLast) {
        // compute timestamp for this label
        $ts = $start + $i * ($SPAN_H*3600/($LABELS-1));
        $txt= ltrim(date('G:i', $ts), '0');
        // skip label at 00:00? (we already have a date banner there)
        if (date('i',$ts) === '00') {
            // we still draw “0:00” under the date banner
            imagestringup(
                $im, 1,
                $x,
                $TM + $plotH + 2 + imagefontwidth(1)*strlen($txt),
                $txt,
                $col_txt
            );
        } else {
// inside your for($i=0; $i<$LABELS; $i++) { … } else { … } block,
// replace your current imagettftext() call with this:

$fontSize = 9;
$angle    = 90;           // rotate *clockwise* so text reads bottom→top
$txt      = date('G:i', $ts);

// 1) get the rotated text box
$bbox = imagettfbbox($fontSize, $angle, $fontFile, $txt);

// 2) extract all Y offsets from that box
$ys = [ $bbox[1], $bbox[3], $bbox[5], $bbox[7] ];

// 3) find the *highest* point (lowest number) -- that's how far above
//    the baseline the *top* of your string will sit
$topOffset = min($ys);

// 4) define the Y of your 0 Mbps line
$zeroLineY = $TM + $plotH;

// 5) compute baseline Y so that the *bottom* of the string (last char)
//    which sits at baseline + $topOffset, lands exactly *at* $zeroLineY
$baselineY = $zeroLineY - $topOffset;

// 6) draw it
imagettftext(
    $im,
    $fontSize,
    $angle,
    $x + 4,         // horizontal tick alignment
    $baselineY+5,     // vertical baseline
    $col_txt,
    $fontFile,
    $txt
);
        }
    } else {
        // final slot: draw red ^ character instead of polygon
        $by = $TM + $plotH;
        $fontSize = 8;
        $arrowChar = '^';

        // adjust horizontal (left) and vertical (baseline) positioning
        imagettftext(
            $im,
            $fontSize,
            0,             // no rotation
            $x - 4,        // shift 8px left from final gridline
            $by + 9,       // place just below the plot area
            $col_red,
            $fontFile,
            $arrowChar
        );    }
}

// ── CAPACITY (white) & USAGE (yellow) CURVES ─────────────────────────────
for ($i = 0; $i < $PTS; $i++) {
    $x1 = $LM + $i * ($plotW/$PTS);
    $x2 = $LM + ($i+1) * ($plotW/$PTS);

    // capacity
    $y1 = $TM + $plotH * (1 - $capArr[$i]/$CAP);
    $y2 = $TM + $plotH * (1 - $capArr[$i+1]/$CAP);
    imageline($im, (int)$x1, (int)$y1+15, (int)$x2, (int)$y2+15, $col_txt);

    // usage
    $u1 = $usage[$i]['v'];   $u2 = $usage[$i+1]['v'];
    $z1 = $TM + $plotH * (1 - $u1/$CAP);
    $z2 = $TM + $plotH * (1 - $u2/$CAP);
    imageline($im, (int)$x1, (int)$z1, (int)$x2, (int)$z2, $col_use);
}

// ── “NOW” BAR ─────────────────────────────────────────────────────────────
imageline($im, $W - $RM, $TM, $W - $RM, $TM + $plotH, $col_txt);

// ── OUTPUT ────────────────────────────────────────────────────────────────
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);