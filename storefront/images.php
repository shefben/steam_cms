<?php
require_once __DIR__.'/../cms/template_engine.php';
require_once __DIR__.'/../cms/db.php';

$db = cms_get_db();
$appid = (int)($_GET['appid'] ?? 0);
$imageid = $_GET['id'] ?? '';

if (!$appid || !$imageid) {
    echo '<p>Invalid parameters.</p>';
    exit;
}

// Get app info for title
$stmt = $db->prepare('SELECT name FROM store_apps WHERE appid=?');
$stmt->execute([$appid]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$app) {
    echo '<p>App not found.</p>';
    exit;
}

// Get screenshot info
$images = [];
try {
    $images = cms_get_app_screenshots($appid);
    if (!$images) {
        $images = json_decode($app['images'] ?? '[]', true);
        if ($images) {
            // Convert to expected format
            $images = array_map(function($img) {
                return ['filename' => $img, 'hidden' => false];
            }, $images);
        }
    }
} catch (Exception $e) {
    $images = [];
}

$current_image = null;
$current_index = 0;
foreach ($images as $index => $img) {
    if ($img['filename'] === $imageid) {
        $current_image = $img;
        $current_index = $index;
        break;
    }
}

if (!$current_image) {
    echo '<p>Image not found.</p>';
    exit;
}

$prev_image = $current_index > 0 ? $images[$current_index - 1]['filename'] : null;
$next_image = $current_index < count($images) - 1 ? $images[$current_index + 1]['filename'] : null;

?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title><?php echo htmlspecialchars($app['name']); ?> - Screenshot</title>
    <style>
        body { 
            background: #000000; 
            margin: 0; 
            padding: 10px; 
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .image-container {
            margin: 10px auto;
        }
        .nav-links {
            margin: 10px 0;
        }
        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 10px;
            padding: 5px 10px;
            background: #333333;
            border: 1px solid #555555;
        }
        .nav-links a:hover {
            background: #555555;
        }
        .close-link {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            background: #cc0000;
            border: 1px solid #ff0000;
        }
        .close-link:hover {
            background: #ff0000;
        }
        .title {
            color: #ffffff;
            margin-bottom: 10px;
            font-size: 14px;
        }
        img {
            max-width: 100%;
            max-height: 80vh;
            border: 1px solid #555555;
        }
    </style>
    <script>
        function closeWindow() {
            window.close();
        }
        
        function showImage(imageid) {
            window.location.href = 'images.php?appid=<?php echo $appid; ?>&id=' + imageid;
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeWindow();
            } else if (e.key === 'ArrowLeft' && <?php echo $prev_image ? "'".$prev_image."'" : 'null'; ?>) {
                showImage(<?php echo $prev_image ? "'".$prev_image."'" : 'null'; ?>);
            } else if (e.key === 'ArrowRight' && <?php echo $next_image ? "'".$next_image."'" : 'null'; ?>) {
                showImage(<?php echo $next_image ? "'".$next_image."'" : 'null'; ?>);
            }
        });
    </script>
</head>
<body>
    <a href="#" onclick="closeWindow(); return false;" class="close-link">Close</a>
    
    <div class="title"><?php echo htmlspecialchars($app['name']); ?></div>
    
    <div class="image-container">
        <img src="images/apps/<?php echo $appid; ?>/screenshots/<?php echo htmlspecialchars($imageid); ?>.jpg" alt="Screenshot">
    </div>
    
    <div class="nav-links">
        <?php if ($prev_image): ?>
            <a href="#" onclick="showImage('<?php echo htmlspecialchars($prev_image); ?>'); return false;">&lt; Previous</a>
        <?php endif; ?>
        
        <span style="color: #ffffff;">Image <?php echo $current_index + 1; ?> of <?php echo count($images); ?></span>
        
        <?php if ($next_image): ?>
            <a href="#" onclick="showImage('<?php echo htmlspecialchars($next_image); ?>'); return false;">Next &gt;</a>
        <?php endif; ?>
    </div>
</body>
</html>