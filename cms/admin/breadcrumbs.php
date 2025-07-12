<?php
function cms_admin_breadcrumb(): string {
    $path = $_SERVER['PHP_SELF'] ?? '';
    $path = trim($path, '/');
    if ($path === '') {
        return '';
    }
    $parts = explode('/', $path);
    $crumbs = [];
    $accum = '';
    $last = count($parts) - 1;
    foreach ($parts as $i => $p) {
        $accum .= '/' . $p;
        $label = ucwords(str_replace(['_', '.php'], [' ', ''], $p));
        if ($i !== $last) {
            $crumbs[] = '<a href="' . htmlspecialchars($accum) . '">' . htmlspecialchars($label) . '</a>';
        } else {
            $crumbs[] = '<span>' . htmlspecialchars($label) . '</span>';
        }
    }
    return '<nav class="breadcrumb">' . implode(' / ', $crumbs) . '</nav>';
}
?>
