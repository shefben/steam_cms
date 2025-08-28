<?php
echo "<h2>Path Debug</h2>";

$basePath = dirname(__DIR__) . '/2004_cms';  // Simulating the file_manager's getBasePath()
$imagesPath = $basePath . '/images';

echo "Base Path: $basePath<br>";
echo "Images Path: $imagesPath<br>";
echo "Images directory exists: " . (is_dir($imagesPath) ? 'YES' : 'NO') . "<br>";

if (is_dir($imagesPath)) {
    $files = scandir($imagesPath);
    $imageFiles = array_filter($files, function($file) use ($imagesPath) {
        if ($file === '.' || $file === '..') return false;
        $fullPath = $imagesPath . '/' . $file;
        if (!is_file($fullPath)) return false;
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    });
    
    echo "Image files found: " . count($imageFiles) . "<br>";
    echo "First 5 files: " . implode(', ', array_slice($imageFiles, 0, 5)) . "<br>";
}
?>