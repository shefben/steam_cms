<?php
/**
 * Returns the legend/tooltip text for a given series index.
 * Called via fetch() from the browser when the user hovers a label.
 *
 *   GET /legend.php?i=0   →  "Players online"
 *   GET /legend.php?i=1   →  "Servers up"
 *
 * You can change the $series array to whatever descriptions you like.
 * The index *must* match the order you plot the data in graph.php.
 */
header('Content-Type: text/plain; charset=utf-8');

// ----------- EDIT THESE DESCRIPTIONS TO MATCH YOUR DATA -----------
$series = [
    'Players online',
    'Servers online',
    'Peak players (24 h)',
    'Bandwidth (Mbps)',
    'Whatever else…'
];
// ---------------------------------------------------------------

$idx = isset($_GET['i']) ? (int)$_GET['i'] : -1;
echo $series[$idx] ?? 'n/a';
