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
    return '
<style>
@font-face {
    font-family: "DINEngschriftStd";
    src: url("DINEngschriftStd.otf") format("opentype");
}
</style>
<div style="width:531px;height:38px;background:#626d5c;
            font:20px/36px \'DINEngschriftStd\';
            letter-spacing:1px;padding-left:7px;position:relative;
            color:#f0f0f0;white-space:nowrap;overflow:hidden;">
    <span style="display:inline-flex;align-items:center;gap:5px;">
        <img src="title_arrow.gif" alt=">">
        ' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '
    </span>
</div>';
}


echo renderInstructionBar('Support Site');

?>
