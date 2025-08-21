<?php
/*  template.php – pulls the raw header/footer you extracted,
 *  then opens/closes a wrapper that matches index.html exactly.
 */
function cb_header() : void
{
    /* banner from header.inc (already contains <html><body…> + black bar) */
    readfile(__DIR__.'/layout/header.inc');

    /* gap between banner and forum – exactly one <br> in the archive */
    echo '<br>';

    /* open the 798-pixel olive wrapper that every ChatBear table lives in */
    echo '<table align="center" bgcolor="#626D5C" border="0" cellpadding="0" cellspacing="0" width="798"><tr><td bgcolor="#4C5844"><div align="center">';
}

function cb_footer() : void
{
    /* close olive wrapper */
    echo '</div></td></tr></table>';

    /* same extra <br> the original has */
    echo '<br>';

    /* raw Valve legal footer & closing </body></html> */
    readfile(__DIR__.'/layout/footer.inc');
}

/* helpers the content pages still call */
function cb_zebra(bool $alt): string  { return $alt ? '#4C5844' : '#424B3C'; }
function cb_fmt(string $d): string    { return date('M j, H:i', strtotime($d)); }
