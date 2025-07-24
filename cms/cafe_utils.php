<?php
function cms_cafe_country_names(): array {
    static $map = null;
    if ($map !== null) {
        return $map;
    }
    $html = file_get_contents(__DIR__.'/../archived_steampowered/2004/cafe_directory.html');
    preg_match_all('/country=([A-Z]{2})[^>]*>([^<]+)/', $html, $m, PREG_SET_ORDER);
    $map = [];
    foreach ($m as $row) {
        $map[$row[1]] = trim(html_entity_decode($row[2], ENT_QUOTES));
    }
    return $map;
}

function cms_cafe_state_names(string $country): array
{
    $file = __DIR__.'/../archived_steampowered/2004/cafe_directory/'.$country.'.txt';
    if (!is_file($file)) {
        return [];
    }
    $html = file_get_contents($file);
    preg_match_all('/state=([^"&]+)[^>]*>([^<]+)/', $html, $m, PREG_SET_ORDER);
    $states = [];
    foreach ($m as $row) {
        if ($row[1] === '?') {
            continue;
        }
        $states[$row[1]] = trim(html_entity_decode($row[2], ENT_QUOTES));
    }
    return $states;
}


