<?php
/**
 *  gplaLabel() → returns an HTML fragment with the exact look
 *  @param int    $pxSize  Font size in pixels (e.g. 18)
 *  @param string $string  Text to render
 *  @return string         Ready-to-echo HTML
 *
 *  Usage example:
 *      echo gplaLabel(18, 'STEAM GAME PLAYER AGREEMENT');
 */
function gplaLabel(int $pxSize, string $string): string
{
    $text = htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    // Inline styles so the fragment works anywhere
    $style = sprintf(
        'display:block;'
      . 'margin:0;padding:0;line-height:1;letter-spacing:.25px;'
      . 'font:%1$spx Verdana,Arial,sans-serif;'
      . 'color:#FFFFFF;'
      /* four-layer feathered drop-shadow */
      . 'text-shadow:'
      . ' 1px 1px 0 rgba(0,0,0,.55),'
      . ' 2px 2px 2px rgba(0,0,0,.40),'
      . ' 3px 3px 4px rgba(0,0,0,.25),'
      . ' 4px 4px 6px rgba(0,0,0,.15);',
      $pxSize
    );

    return "<span style=\"$style\">$text</span>";
}

/* -------------------------------------------------------------------------
 * OPTIONAL: demo – remove if you only want the function
 * ------------------------------------------------------------------------- */
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    header('Content-Type: text/html; charset=UTF-8');
    ?>
    <!DOCTYPE html><html lang="en"><head><meta charset="utf-8">
    <title>gplaLabel demo</title></head><body style="margin:0;">
        <div style="width:305px;height:72px;background:#7B7F8D;
                    text-align:center;position:relative;">
            <span style="position:absolute;top:8px;left:0;width:100%;">
                <?= gplaLabel(11, 'Game Player License Agreement'); ?>
            </span>
            <span style="position:absolute;top:26px;left:0;width:100%;">
                <?= gplaLabel(18, 'VALVE, L.L.C.'); ?>
            </span>
            <span style="position:absolute;top:48px;left:0;width:100%;">
                <?= gplaLabel(18, 'STEAM GAME PLAYER AGREEMENT'); ?>
            </span>
        </div>
    </body></html>
    <?php
}

/**
 * renderInstructionBar()
 * ----------------------
 * Returns HTML for the green “instruction bar” with inline styles.
 *
 *  • If the phrase has ONE word, the first half of its characters are white.
 *  • If it has TWO+ words, the first ⌊word-count ÷ 2⌋ words are white.
 *
 * @param string $text
 * @return string
 */
function renderInstructionBar(string $text): string
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
<div style="width:531px;height:36px;background:#626d5c;
            font:12px/36px Verdana,Arial,sans-serif;color:#f0f0f0;
            letter-spacing:.4px;padding-left:7px;position:relative;
            white-space:nowrap;overflow:hidden;">
    <span style="font-weight:700;">' . $strong . '</span>
    <span style="color:#a6aca1;">'   . $light  . '</span>
    <div style="position:absolute;left:7px;bottom:4px;width:34px;height:4px;background:#000;"></div>
</div>';
}

?>
