<?php
declare(strict_types=1);

define('USE_DATABASE', false);

// Make every script see the same clock
define('TIMEZONE', 'America/Chicago');
date_default_timezone_set(TIMEZONE);

return [
    'host' => '127.0.0.1',
    'port' => '3306',
    'dbname' => 'steamcms',
    'user' => 'root',
    'pass' => ''
];
