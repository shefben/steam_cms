<?php
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

echo render0203PageTitle('GET ANSWERS TO YOUR QUESTIONS');

?>
