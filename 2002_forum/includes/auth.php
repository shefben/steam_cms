<?php
require_once __DIR__.'/db.php';

function cb_current_user() : ?array {
    return $_SESSION['user'] ?? null;
}
function cb_require_login() : array {
    if (!$u = cb_current_user()) {
        header('Location: login.php?redir='.urlencode($_SERVER['REQUEST_URI']));
        exit;
    }
    return $u;
}
function cb_login(string $name, string $pass) : bool {
    $row = cb_db()->prepare('SELECT * FROM users WHERE username=?')->execute([$name])->fetch(PDO::FETCH_ASSOC);
    if ($row && password_verify($pass,$row['passhash'])) {
        $_SESSION['user'] = $row;
        return true;
    }
    return false;
}
function cb_logout() { session_destroy(); }
function cb_is_mod(array $u=null) : bool {
    $u ??= cb_current_user();  return $u && $u['is_mod'];
}
