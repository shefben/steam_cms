<?php
/**
 * render0203PageTitle()
 * ----------------------
 * Returns HTML for the “Page Title” with inline styles.
 *
 * Font file is assumed to be at:
 *   <install_root>/includes/fonts/DINEngschriftStd.otf
 *
 * This script is assumed to live under:
 *   <install_root>/cms/utilities/
 */
function render0203PageTitle(string $text): string
{
    $docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
    $thisDir = str_replace('\\', '/', __DIR__);

    // URL path to this directory, e.g. "/2004_cms/cms/utilities"
    $thisUrlDir = '/' . ltrim(str_replace($docRoot, '', $thisDir), '/');

    // install root = two levels up from /cms/utilities
    $installRootUrl = preg_replace('#/cms/utilities$#', '', $thisUrlDir);

    // Build URLs
    $fontUrl  = $installRootUrl . '/includes/fonts/DINEngschriftStd.otf';
    $arrowUrl = $installRootUrl . '/includes/fonts/title_arrow.gif'; // adjust if your gif lives elsewhere

    // Escape for CSS/HTML contexts
    $fontUrlCss  = htmlspecialchars($fontUrl, ENT_QUOTES, 'UTF-8');
    $arrowUrlAttr = htmlspecialchars($arrowUrl, ENT_QUOTES, 'UTF-8');

    return '
<style>
@font-face {
    font-family: "DINEngschriftStd";
    src: url("' . $fontUrlCss . '") format("opentype");
}
</style>
<div style="width:531px;height:38px;
            font:20px/36px \'DINEngschriftStd\';
            letter-spacing:1px;padding-left:7px;position:relative;
            color:#f0f0f0;white-space:nowrap;overflow:hidden;">
    <span style="display:inline-flex;align-items:center;gap:5px;">
        <img src="' . $arrowUrlAttr . '" alt=">">
        ' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '
    </span>
</div>';
}

echo render0203PageTitle('GET ANSWERS TO YOUR QUESTIONS');
?>
