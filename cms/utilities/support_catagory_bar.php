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
    // ---------- SPECIAL SPLIT RULES ----------
    // key  = entire word  (case-insensitive match)
    // val  = [ left-segment, right-segment ]
    static $special = [
        'TROUBLESHOOTING' => ['TROUBLE', 'SHOOTING'],
    ];

    $words = preg_split('/\s+/', trim($text));
    $wc    = count($words);

    if ($wc === 0) {
        return '';
    }

    if ($wc === 1) {  // single “word” --------------------------------------
        $word = $words[0];

        // Check for a hard-coded split (e.g. TROUBLESHOOTING)
        $key = strtoupper($word);
        if (isset($special[$key])) {
            [$strong, $light] = $special[$key];
        } else {       // default: split the word in half
            $half   = (int) ceil(strlen($word) / 2);
            $strong = substr($word, 0, $half);
            $light  = substr($word, $half);
        }

        $strong = htmlspecialchars($strong, ENT_QUOTES, 'UTF-8');
        $light  = htmlspecialchars($light,  ENT_QUOTES, 'UTF-8');

    } else {          // two or more words ----------------------------------
        $break  = floor($wc / 2);
        $strong = htmlspecialchars(
                    implode(' ', array_slice($words, 0, $break)) . ' ',
                    ENT_QUOTES, 'UTF-8'
                  );
        $light  = htmlspecialchars(
                    implode(' ', array_slice($words, $break)),
                    ENT_QUOTES, 'UTF-8'
                  );
    }

    // ---------- HTML / CSS ----------
    return '
<style>
@font-face{
    font-family:"din1451alt";
    src:url("din1451alt.ttf") format("truetype");
}
</style>
<div style="width:531px;height:38px;background:#626d5c;
            font:15px/36px \'din1451alt\';
            letter-spacing:.5px;padding-left:7px;position:relative;
            white-space:nowrap;overflow:hidden;color:#f0f0f0;">
    <span style="font-weight:thin;">' . $strong . '</span>
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
