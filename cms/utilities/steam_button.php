<?php
// steam_button.php
// This script outputs a PNG image that resembles the "Get Steam" button shipped with Steam's
// official website.  You can customise the label by passing a `text` query parameter.
//
// Usage examples:
//   php steam_button.php                 -- outputs the default text button
//   php steam_button.php?text=Play%20Now -- outputs a button saying "PLAY NOW"

// Determine the text to print.  Fallback to the original label if none supplied.
$inputText = isset($_GET['text']) ? trim($_GET['text']) : '';
if ($inputText === '') {
    $inputText = '  CLICK HERE TO DOWNLOAD THE STEAM INSTALLER ( < 1MB )';
}
// Limit length to prevent excessive memory usage
$inputText = function_exists('mb_substr') ? mb_substr($inputText, 0, 100, 'UTF-8') : substr($inputText, 0, 100);
// Normalise to uppercase for consistency with the original button.
if (function_exists('mb_strtoupper')) {
    $text = mb_strtoupper($inputText, 'UTF-8');
} else {
    $text = strtoupper($inputText);
}

// Load the original template GIF.  We draw the text on top of this so that the button
// retains its original colours, border, and rounded corners.  The GIF is shipped in the
// same directory as this script.  If the file cannot be read, we bail out early.
$templatePath = '../../images/getSteamNowButton_template.gif';
if (!file_exists($templatePath)) {
    // Fail gracefully if the template is missing.
    header('Content-Type: text/plain');
    echo "Missing template image.";
    return;
}
// GD cannot draw directly on palette based images cleanly, so convert to a truecolour image.
$template = imagecreatefromgif($templatePath);
$width    = imagesx($template);
$height   = imagesy($template);
$button   = imagecreatetruecolor($width, $height);
// Preserve alpha blending: fill background with transparency and copy the template over.
imagealphablending($button, true);
imagesavealpha($button, true);
$transparent = imagecolorallocatealpha($button, 0, 0, 0, 127);
imagefill($button, 0, 0, $transparent);
imagecopy($button, $template, 0, 0, 0, 0, $width, $height);
imagedestroy($template);

// Define the colour used for the text.  The original button uses a muted yellow/gold
// (approximately RGB 191, 186, 80).  We allocate the colour on our truecolour canvas.
$textColour = imagecolorallocate($button, 191, 186, 80);
/**
 * Draw TTF text with constant extra letter‑spacing.
 *
 * @param resource $im          GD image
 * @param float    $size        Point‑size
 * @param int      $angle       Rotation (0 = horizontal)
 * @param int      $x           X of *first* glyph
 * @param int      $y           Baseline Y
 * @param int      $color       GD colour index
 * @param string   $fontfile    Absolute path to .ttf / .otf
 * @param string   $text        UTF‑8 string
 * @param int      $spacing     Extra pixels between glyphs
 */
function imagettftext_spaced($im, $size, $angle, $x, $y, $color, $font, $text, $spacing = 1.5)
{
    $cursor = $x;                            // keep as float
    $chars  = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($chars as $ch) {
        // Get glyph width
        $bbox = imagettfbbox($size, $angle, $font, $ch);
        $glyphW = $bbox[2] - $bbox[0];

        // Render at the nearest pixel
        imagettftext($im, $size, $angle, (int)round($cursor), $y, $color, $font, $ch);

        // Advance cursor by glyph width + fractional spacing
        $cursor += $glyphW + $spacing;
    }
}

/* ---------- helper to measure total width incl. fractional spacing ---------- */
function spaced_text_width($size, $angle, $font, $text, $spacing = 1.5)
{
    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $total = 0.0;

    foreach ($chars as $ch) {
        $bbox   = imagettfbbox($size, $angle, $font, $ch);
        $total += ($bbox[2] - $bbox[0]);
    }
    if (count($chars) > 1) {
        $total += $spacing * (count($chars) - 1);
    }
    return $total;
}
// Choose a bold sans‑serif font.  DejaVu Sans Bold is usually available on Linux
// distributions.  If it cannot be found, you can change the path below to a font of
// your liking.  The path is relative to common font directories on Linux.
$fontPathCandidates = [
  '../../includes/font/DejaVuSans-Bold.ttf' // fallback if a copy is shipped alongside
];
$fontPath = null;
foreach ($fontPathCandidates as $path) {
    if (file_exists($path)) {
        $fontPath = $path;
        break;
    }
}
if ($fontPath === null) {
    // If no TTF font is available, we cannot render.  Inform the client accordingly.
    header('Content-Type: text/plain');
    echo "No suitable TrueType font found for rendering text.";
    return;
}

// Determine an appropriate font size by trial.  The original button text occupies roughly
// two thirds of the vertical space.  With a height of 37 pixels and a single line of text,
// a size of 11–13 points looks good.  We'll start at 13 and adjust down if the text would
// overflow the button width.  We loop to find the largest size that fits.
$maxFontSize = 16;
$paddingLeftRight = 12; // horizontal padding from the border before text begins
$paddingTop       = 1;  // vertical offset; adjust to match original placement
$fontSize = $maxFontSize;
$spacingPx = 1.5;

do {
    $textWidth = spaced_text_width($fontSize, 0, $fontPath, $text, $spacingPx);
    $bbox = imagettfbbox($fontSize, 0, $fontPath, $text);
    $textHeight = $bbox[1] - $bbox[7];
    if ($textWidth <= $width - 2 * $paddingLeftRight) {
        break;
    }
    $fontSize -= 0.5;
} while ($fontSize > 8);

$x = ($width  - $textWidth)  / 2;
$y = ($height + $textHeight) / 2 - $paddingTop;

/* ----------------------------------------------------------------
 *  Draw the text
 * ---------------------------------------------------------------- */
/*imageantialias($button, true);
imagettftext(
    $button,
    $fontSize,
    0,                 // angle
    (int) round($x),
    (int) round($y),
    $textColour,
    $fontPath,
    $text
);*/
imageantialias($button, true);
imagettftext_spaced(
    $button,
    $fontSize,
    0,
    (int) round($x),
    (int) round($y),
    $textColour,
    $fontPath,
    $text,
    $spacingPx
);

// Output the image as a PNG.  We choose PNG for crispness and wide support.
header('Content-Type: image/png');
// Disable caching so that changes to the text parameter are always visible.
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
imagepng($button);
imagedestroy($button);
?>