<?php
/**
 * renderInstructionBar()
 * ----------------------
 * Returns HTML for the green “instruction bar” with inline styles.
 *
 *  • If the phrase has ONE word, the first half of its characters are white,
 *    *unless* it matches a special-split rule (e.g. TROUBLESHOOTING → TROUBLE/SHOOTING).
 *  • If it has TWO+ words, the first ⌊word-count ÷ 2⌋ words are white.
 *
 * @param string $text
 * @return string
 */
function renderInstructionBar(string $text): string
{
    static $special = [
        'TROUBLESHOOTING' => ['TROUBLE', 'SHOOTING'],
    ];

    $words = preg_split('/\s+/', trim($text));
    $wc    = count($words);

    if ($wc === 0) return '';

    if ($wc === 1) {
        $word = $words[0];
        $key = strtoupper($word);

        if (isset($special[$key])) {
            [$strong, $light] = $special[$key];
        } else {
            $half   = (int) ceil(strlen($word) / 2);
            $strong = substr($word, 0, $half);
            $light  = substr($word, $half);
        }

        $strong = htmlspecialchars($strong, ENT_QUOTES, 'UTF-8');
        $light  = htmlspecialchars($light,  ENT_QUOTES, 'UTF-8');
    } else {
        $break  = (int) floor($wc / 2);
        $strong = htmlspecialchars(implode(' ', array_slice($words, 0, $break)) . ' ', ENT_QUOTES, 'UTF-8');
        $light  = htmlspecialchars(implode(' ', array_slice($words, $break)), ENT_QUOTES, 'UTF-8');
    }

    // ---- Build a URL to /includes/fonts/din1451alt.ttf relative to the install root ----
    // This file is assumed to live at: <install_root>/cms/utilities/this_file.php
    // Font is at:                    <install_root>/includes/fonts/din1451alt.ttf

    $docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
    $thisDir = str_replace('\\', '/', __DIR__);

    // URL path to this directory, e.g. "/2004_cms/cms/utilities"
    $thisUrlDir = '/' . ltrim(str_replace($docRoot, '', $thisDir), '/');

    // install root = two levels up from /cms/utilities
    $installRootUrl = preg_replace('#/cms/utilities$#', '', $thisUrlDir);

    // final font URL (absolute from site root)
    $fontUrl = $installRootUrl . '/includes/fonts/din1451alt.ttf';
    $fontUrlCss = htmlspecialchars($fontUrl, ENT_QUOTES, 'UTF-8');

    return '
<style>
@font-face{
    font-family:"din1451alt";
    src:url("' . $fontUrlCss . '") format("truetype");
}
</style>
<div style="width:531px;height:38px;background:#626d5c;
            font:15px/36px \'din1451alt\';
            letter-spacing:.5px;padding-left:7px;position:relative;
            white-space:nowrap;overflow:hidden;color:#f0f0f0;">
    <span style="font-weight:100;">' . $strong . '</span>
    <span style="color:#a6aca1;">'. $light  . '</span>
    <div style="position:absolute;left:7px;bottom:4px;
                width:34px;height:4px;background:#000;"></div>
</div>';
}
/* ---------- demo ---------- */
/*echo renderInstructionBar('GET ANSWERS TO YOUR QUESTIONS');
echo renderInstructionBar('TROUBLESHOOTING');
echo renderInstructionBar('QUICK START GUIDE');*/
?>
