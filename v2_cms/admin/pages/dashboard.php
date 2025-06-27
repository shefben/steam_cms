<?php
// Dashboard page

// Get statistics
$news_count = $db->queryOne("SELECT COUNT(*) as count FROM news_articles WHERE theme = ?", [$current_theme])['count'];
$faq_count = $db->queryOne("SELECT COUNT(*) as count FROM faq_entries fe JOIN faq_categories fc ON fe.category_id = fc.id WHERE fc.theme = ?", [$current_theme])['count'];
$nav_count = $db->queryOne("SELECT COUNT(*) as count FROM navigation_links WHERE theme = ?", [$current_theme])['count'];
$media_count = $db->queryOne("SELECT COUNT(*) as count FROM media_files WHERE theme = ? OR theme IS NULL", [$current_theme])['count'];

// Get recent activity
$recent_news = $db->query("SELECT * FROM news_articles WHERE theme = ? ORDER BY created_at DESC LIMIT 5", [$current_theme]);
$recent_media = $db->query("SELECT * FROM media_files WHERE theme = ? OR theme IS NULL ORDER BY created_at DESC LIMIT 5", [$current_theme]);

// Get theme info
$theme_config = $cms->getThemeConfig();
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number"><?= $news_count ?></div>
        <div class="stat-label">News Articles</div>
        <a href="?action=news&theme=<?= $current_theme ?>" style="font-size: 12px; color: #3498db;">Manage →</a>
    </div>
    
    <div class="stat-card success">
        <div class="stat-number"><?= $faq_count ?></div>
        <div class="stat-label">FAQ Entries</div>
        <a href="?action=faq&theme=<?= $current_theme ?>" style="font-size: 12px; color: #3498db;">Manage →</a>
    </div>
    
    <div class="stat-card warning">
        <div class="stat-number"><?= $nav_count ?></div>
        <div class="stat-label">Navigation Links</div>
        <a href="?action=navigation&theme=<?= $current_theme ?>" style="font-size: 12px; color: #3498db;">Manage →</a>
    </div>
    
    <div class="stat-card danger">
        <div class="stat-number"><?= $media_count ?></div>
        <div class="stat-label">Media Files</div>
        <a href="?action=media&theme=<?= $current_theme ?>" style="font-size: 12px; color: #3498db;">Manage →</a>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <!-- Recent News -->
    <div class="card">
        <div class="card-header">
            <h3>Recent News Articles</h3>
        </div>
        <div class="card-body">
            <?php if (empty($recent_news)): ?>
                <p style="color: #7f8c8d;">No news articles yet. <a href="?action=news&theme=<?= $current_theme ?>">Create your first article!</a></p>
            <?php else: ?>
                <?php foreach ($recent_news as $article): ?>
                    <div style="border-bottom: 1px solid #ecf0f1; padding: 10px 0;">
                        <strong><?= htmlspecialchars($article['title']) ?></strong>
                        <br>
                        <small style="color: #7f8c8d;">
                            <?= date('M j, Y', strtotime($article['published_date'])) ?> by <?= htmlspecialchars($article['author']) ?>
                        </small>
                        <?php if ($article['excerpt']): ?>
                            <br>
                            <small><?= htmlspecialchars(substr($article['excerpt'], 0, 80)) ?>...</small>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <div style="margin-top: 15px;">
                    <a href="?action=news&theme=<?= $current_theme ?>" class="btn btn-small btn-primary">View All</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Theme Information -->
    <div class="card">
        <div class="card-header">
            <h3>Current Theme: <?= htmlspecialchars($current_theme) ?></h3>
        </div>
        <div class="card-body">
            <?php if ($theme_config): ?>
                <p><strong><?= htmlspecialchars($theme_config['display_name']) ?></strong></p>
                <p><?= htmlspecialchars($theme_config['description']) ?></p>
                
                <div style="margin: 15px 0;">
                    <span class="badge <?= $theme_config['layout_type'] === 'table' ? 'badge-warning' : 'badge-success' ?>">
                        <?= ucfirst($theme_config['layout_type']) ?> Layout
                    </span>
                    
                    <span class="badge <?= $theme_config['has_navigation'] ? 'badge-success' : 'badge-danger' ?>">
                        <?= $theme_config['has_navigation'] ? 'Has Navigation' : 'No Navigation' ?>
                    </span>
                </div>
                
                <p><strong>Header Style:</strong> <?= ucfirst($theme_config['header_style']) ?></p>
                <p><strong>Color Scheme:</strong> <?= ucfirst($theme_config['color_scheme']) ?></p>
                
                <div style="margin-top: 15px;">
                    <a href="../index.php?theme=<?= $current_theme ?>" target="_blank" class="btn btn-small btn-primary">
                        👁️ Preview Site
                    </a>
                    <a href="?action=settings&theme=<?= $current_theme ?>" class="btn btn-small btn-warning">
                        ⚙️ Configure
                    </a>
                </div>
            <?php else: ?>
                <p style="color: #e74c3c;">Theme configuration not found!</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Recent Media & Quick Actions -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
    <!-- Recent Media -->
    <div class="card">
        <div class="card-header">
            <h3>Recent Media Files</h3>
        </div>
        <div class="card-body">
            <?php if (empty($recent_media)): ?>
                <p style="color: #7f8c8d;">No media files yet. <a href="?action=media&theme=<?= $current_theme ?>">Upload your first file!</a></p>
            <?php else: ?>
                <?php foreach ($recent_media as $media): ?>
                    <div style="display: flex; align-items: center; padding: 8px 0; border-bottom: 1px solid #ecf0f1;">
                        <div style="width: 40px; height: 40px; background: #f8f9fa; margin-right: 10px; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                            <?php if ($media['file_type'] === 'image'): ?>
                                <img src="<?= htmlspecialchars($media['file_path']) ?>" style="max-width: 100%; max-height: 100%; object-fit: cover; border-radius: 4px;">
                            <?php else: ?>
                                📄
                            <?php endif; ?>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-size: 12px; font-weight: bold;"><?= htmlspecialchars($media['original_name']) ?></div>
                            <div style="font-size: 10px; color: #7f8c8d;">
                                <?= date('M j, Y', strtotime($media['created_at'])) ?> • 
                                <?= number_format($media['file_size'] / 1024, 1) ?> KB
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div style="margin-top: 15px;">
                    <a href="?action=media&theme=<?= $current_theme ?>" class="btn btn-small btn-primary">View All</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <h3>Quick Actions</h3>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 10px;">
                <a href="?action=news&theme=<?= $current_theme ?>" class="btn btn-primary">
                    📰 Create News Article
                </a>
                <a href="?action=navigation&theme=<?= $current_theme ?>" class="btn btn-success">
                    🧭 Add Navigation Link
                </a>
                <a href="?action=faq&theme=<?= $current_theme ?>" class="btn btn-warning">
                    ❓ Manage FAQ
                </a>
                <a href="?action=settings&theme=<?= $current_theme ?>" class="btn btn-danger">
                    🖼️ Upload Logo
                </a>
            </div>
            
            <hr style="margin: 20px 0;">
            
            <h4 style="margin-bottom: 10px; color: #2c3e50;">Switch Theme</h4>
            <div style="display: grid; gap: 5px;">
                <?php 
                $all_themes = $db->query("SELECT * FROM theme_configs ORDER BY theme ASC");
                foreach ($all_themes as $theme): 
                ?>
                    <a href="?action=dashboard&theme=<?= $theme['theme'] ?>" 
                       class="btn btn-small <?= $theme['theme'] === $current_theme ? 'btn-primary' : '' ?>" 
                       style="text-align: left; font-size: 11px;">
                        <?= htmlspecialchars($theme['display_name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- System Status -->
<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <h3>System Status</h3>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div>
                <strong>PHP Version:</strong><br>
                <span style="color: #27ae60;"><?= PHP_VERSION ?></span>
            </div>
            <div>
                <strong>Upload Max Size:</strong><br>
                <span style="color: #3498db;"><?= ini_get('upload_max_filesize') ?></span>
            </div>
            <div>
                <strong>Memory Limit:</strong><br>
                <span style="color: #f39c12;"><?= ini_get('memory_limit') ?></span>
            </div>
            <div>
                <strong>Database Status:</strong><br>
                <span style="color: #27ae60;">Connected ✓</span>
            </div>
        </div>
    </div>
</div>

<style>
.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: bold;
    text-transform: uppercase;
    display: inline-block;
    margin-right: 5px;
}

.badge-success {
    background: #27ae60;
    color: white;
}

.badge-danger {
    background: #e74c3c;
    color: white;
}

.badge-warning {
    background: #f39c12;
    color: white;
}
</style>
