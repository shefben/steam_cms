<?php
require_once __DIR__.'/../config.php';

function cb_db() : PDO {
    static $pdo = null;
    if (!$pdo) {
        $pdo = new PDO(CB_DB_DSN, CB_DB_USER, CB_DB_PASS,
                       [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    }
    return $pdo;
}
