<?php
/**
 * Draw TTF text with constant extra letter‑spacing.
 *
 * @param resource $im        GD image
 * @param float    $size      Point‑size
 * @param int      $angle     Rotation (0 = horizontal)
 * @param int      $x         X of *first* glyph
 * @param int      $y         Baseline Y
 * @param int      $color     GD colour index
 * @param string   $fontfile  Absolute path to .ttf / .otf
 * @param string   $text      UTF‑8 string
 * @param float    $spacing   Extra pixels between glyphs
 */
function imagettftext_spaced($im, $size, $angle, $x, $y, $color, $fontfile, $text, $spacing = 1.5)
{
    $cursor = $x;
    $chars  = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($chars as $ch) {
        $bbox   = imagettfbbox($size, $angle, $fontfile, $ch);
        $glyphW = $bbox[2] - $bbox[0];
        imagettftext($im, $size, $angle, (int) round($cursor), $y, $color, $fontfile, $ch);
        $cursor += $glyphW + $spacing;
    }
}

/**
 * render2002Title() — Render a stylized multi-line 2002_v1 title banner with dynamic font sizes
 * @param array $lines Array of [int $fontSize, string $text] pairs
 * @return string      Complete <div> with inline styling
 */
function render2002Title(array $lines): string
{
    $totalHeight = 0;
    $maxLineWidth = 0;
    $lineData = [];

    // Calculate dimensions for each line
    foreach ($lines as $entry) {
        [$fontSize, $text] = $entry;
        $escaped = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        $charWidth = $fontSize * 0.6;
        $lineWidth = (int) ceil(strlen($text) * $charWidth);
        $lineHeight = (int) ceil($fontSize * 1.5);

        $lineData[] = [
            'fontSize' => $fontSize,
            'text' => $escaped,
            'width' => $lineWidth,
            'height' => $lineHeight,
        ];

        $maxLineWidth = max($maxLineWidth, $lineWidth);
        $totalHeight += $lineHeight;
    }

    $paddingX = 20;
    $paddingY = 12;
    $bannerWidth = $maxLineWidth + $paddingX * 2;
    $bannerHeight = $totalHeight + $paddingY * 2;

    // Begin banner
    $output = '<div style="'
            . "background:#7B7F8D;"
            . "width:{$bannerWidth}px;"
            . "height:{$bannerHeight}px;"
            . "color:#FFFFFF;"
            . "font-family:Verdana,Arial,sans-serif;"
            . "text-align:center;"
            . "position:relative;"
            . '">';

    // Vertical positioning
    $y = $paddingY;
    foreach ($lineData as $line) {
        $style = sprintf(
            'position:absolute;top:%dpx;left:0;width:100%%;'
          . 'margin:0;padding:0;line-height:1;letter-spacing:.25px;'
          . 'font:%dpx Verdana,Arial,sans-serif;'
          . 'text-shadow:'
          . ' 1px 1px 0 rgba(0,0,0,.55),'
          . ' 2px 2px 2px rgba(0,0,0,.40),'
          . ' 3px 3px 4px rgba(0,0,0,.25),'
          . ' 4px 4px 6px rgba(0,0,0,.15);',
            $y, $line['fontSize']
        );
        $output .= "<span style=\"$style\">{$line['text']}</span>";
        $y += $line['height'];
    }

    $output .= '</div>';
    return $output;
}

/**
 * render0203CatagoryBar()
 * ----------------------
 * Returns HTML for the green “instruction bar” with inline styles.
 *
 *  • If the phrase has ONE word, the first half of its characters are white.
 *  • If it has TWO+ words, the first ⌊word-count ÷ 2⌋ words are white.
 *
 * @param string $text
 * @return string
 */
function render0203CatagoryBar(string $text): string
{
    $words = preg_split('/\s+/', trim($text));
    $wc    = count($words);

    if ($wc === 0) {
        return '';
    }

    if ($wc === 1) {                       // single word → split by characters
        $word = $words[0];
        $half = (int) ceil(strlen($word) / 2);
        $strong = htmlspecialchars(substr($word, 0, $half), ENT_QUOTES, 'UTF-8');
        $light  = htmlspecialchars(substr($word, $half),   ENT_QUOTES, 'UTF-8');
    } else {                               // multi-word → split by words
        $break = floor($wc / 2);
        $strong = htmlspecialchars(implode(' ', array_slice($words, 0, $break)) . ' ', ENT_QUOTES, 'UTF-8');
        $light  = htmlspecialchars(implode(' ', array_slice($words, $break)),          ENT_QUOTES, 'UTF-8');
    }

    // Inline-styled bar markup
    return '
<style>
@font-face {
    font-family: "DINMittelschriftStd";
    src: url("DINMittelschriftStd.otf") format("opentype");
}
</style>
<div style="width:531px;height:36px;background:#626d5c;
            font:16px/36px \'DINMittelschriftStd\', sans-serif; color:#f0f0f0;
            letter-spacing:.0px;padding-left:7px;position:relative;
            white-space:nowrap;overflow:hidden;">
    <span style="">' . $strong . '</span>
    <span style="color:#a6aca1;">'   . $light  . '</span>
    <div style="position:absolute;left:7px;bottom:4px;width:34px;height:5px;background:#000;"></div>
</div>';
}

/**
 * render0203PageTitle()
 * ----------------------
 * Returns HTML for the “Page Title” with inline styles.
 *
 *  • Creates the title text that is displayed in the 2002_v2 and 2003_v1 themes
 *
 * @param string $text
 * @return string
 */
function render0203PageTitle(string $text): string
{
    return '
<style>
@font-face {
    font-family: "DINEngschriftStd";
    src: url("DINEngschriftStd.otf") format("opentype");
}
</style>
<div style="width:531px;height:38px;
            font:20px/36px \'DINEngschriftStd\';
            letter-spacing:1px;padding-left:7px;position:relative;
            color:#f0f0f0;white-space:nowrap;overflow:hidden;">
    <span style="display:inline-flex;align-items:center;gap:5px;">
        <img src="title_arrow.gif" alt=">">
        ' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '
    </span>
</div>';
}



/**
 * Measure total width of a UTF‑8 string including extra letter‑spacing.
 *
 * @param float  $size     Point‑size
 * @param int    $angle    Rotation (0 = horizontal)
 * @param string $fontfile Absolute path to .ttf / .otf
 * @param string $text     UTF‑8 string
 * @param float  $spacing  Extra pixels between glyphs
 * @return float
 */
function spaced_text_width($size, $angle, $fontfile, $text, $spacing = 1.5)
{
    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $total = 0.0;
    foreach ($chars as $ch) {
        $bbox = imagettfbbox($size, $angle, $fontfile, $ch);
        $total += ($bbox[2] - $bbox[0]);
    }
    if (count($chars) > 1) {
        $total += $spacing * (count($chars) - 1);
    }
    return $total;
}

/**
 * Renders the Steam “Get Steam Now” button as an inline PNG <img> tag.
 *
 * @param string $inputText  The text to display on the button.
 * @return string            HTML <img> tag with base64‑encoded PNG data.
 */
function renderGetSteamNowButton(string $inputText): string
{
    // Determine the text to print. Fallback if empty.
    if (trim($inputText) === '') {
        $inputText = '  CLICK HERE TO DOWNLOAD THE STEAM INSTALLER ( < 1MB )';
    }
    // Normalize to uppercase.
    $text = mb_strtoupper($inputText, 'UTF-8');

    // Load template GIF.
    $templatePath = __DIR__ . '/../../images/getSteamNowButton_template.gif';
    if (!file_exists($templatePath)) {
        return 'Missing template image.';
    }
    $template = imagecreatefromgif($templatePath);
    $width    = imagesx($template);
    $height   = imagesy($template);

    // Create truecolour canvas and preserve transparency.
    $button = imagecreatetruecolor($width, $height);
    imagealphablending($button, true);
    imagesavealpha($button, true);
    $transparent = imagecolorallocatealpha($button, 0, 0, 0, 127);
    imagefill($button, 0, 0, $transparent);
    imagecopy($button, $template, 0, 0, 0, 0, $width, $height);
    imagedestroy($template);

    // Allocate text colour.
    $textColour = imagecolorallocate($button, 191, 186, 80);

    // Locate a TrueType font.
    $fontPathCandidates = [
        __DIR__ . '/../../includes/font/DejaVuSans-Bold.ttf'
    ];
    $fontPath = null;
    foreach ($fontPathCandidates as $path) {
        if (file_exists($path)) {
            $fontPath = $path;
            break;
        }
    }
    if ($fontPath === null) {
        return 'No suitable TrueType font found for rendering text.';
    }

    // Determine font size and spacing.
    $fontSize       = 8;
    $spacingPx      = 0;
    $bbox           = imagettfbbox($fontSize, 0, $fontPath, $text);
    $textWidth      = spaced_text_width($fontSize, 0, $fontPath, $text, $spacingPx);
    $textHeight     = $bbox[1] - $bbox[7];
    // Slight size adjustment loop (as per original logic).
    $fontSize -= 0.05;
    $bbox       = imagettfbbox($fontSize, 0, $fontPath, $text);
    $textWidth  = $bbox[2] - $bbox[0];
    $textHeight = $bbox[1] - $bbox[7];

    // Center text.
    $x = ($width  - $textWidth)  / 20;
    $y = ($height + $textHeight) / 2.1;

    // Draw the text with letter‑spacing.
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

    // Capture PNG output.
    ob_start();
    imagepng($button);
    $pngData = ob_get_clean();
    imagedestroy($button);

    // Return inline <img> tag.
    return '<img src="data:image/png;base64,' . base64_encode($pngData) . '">';
}

/* -------------------------------------------------------------------------
 * Demos
 * ------------------------------------------------------------------------- */

// 2002_v1 Title
//header('Content-Type: text/html; charset=UTF-8');
//echo render2002Title([
//    [11, 'Game Player License Agreement'],
//    [18, 'VALVE, L.L.C.'],
//    [18, 'STEAM GAME PLAYER AGREEMENT']
//]);

// 2002_v2/2003_v1 catagory bar
//echo render0203CatagoryBar('GET ANSWERS TO YOUR QUESTIONS');

// 2002_v2/2003_v1 Webpage Title
//echo render0203PageTitle('Support');

// 2004/2005_v1 Download Steam button
//echo renderGetSteamNowButton("  CLICK HERE TO DOWNLOAD THE STEAM INSTALLER ( < 1MB )");
?>


