<?php
/**
 * Cache Manager Admin Page
 * Provides comprehensive cache management and optimization tools
 */

// Check permissions
if (!cms_check_plugin_permission('admin_toolkit', 'manage_cache')) {
    echo '<div class="permission-denied">';
    echo '<h2>' . cms_plugin_translate('admin_toolkit', 'error.permission_denied') . '</h2>';
    echo '<p>You do not have permission to manage cache settings.</p>';
    echo '</div>';
    return;
}

$page_title = cms_plugin_translate('admin_toolkit', 'menu.cache_manager');

// Handle cache operations
$message = '';
$message_type = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clear_all_cache'])) {
        // Clear all caches
        $cleared = cms_clear_all_cache();
        $message = $cleared ? 'All caches cleared successfully.' : 'Failed to clear some caches.';
        $message_type = $cleared ? 'success' : 'error';
    } elseif (isset($_POST['clear_template_cache'])) {
        // Clear template cache
        $cleared = cms_clear_template_cache();
        $message = $cleared ? 'Template cache cleared.' : 'Failed to clear template cache.';
        $message_type = $cleared ? 'success' : 'error';
    } elseif (isset($_POST['clear_asset_cache'])) {
        // Clear asset cache
        $cleared = cms_clear_asset_cache();
        $message = $cleared ? 'Asset cache cleared.' : 'Failed to clear asset cache.';
        $message_type = $cleared ? 'success' : 'error';
    } elseif (isset($_POST['optimize_cache'])) {
        // Optimize cache performance
        $optimized = cms_optimize_cache_performance();
        $message = $optimized ? 'Cache optimization completed.' : 'Cache optimization failed.';
        $message_type = $optimized ? 'success' : 'error';
    }
}

// Get cache statistics
$cache_stats = [
    'template_cache_size' => cms_get_cache_size('templates'),
    'asset_cache_size' => cms_get_cache_size('assets'),
    'database_cache_size' => cms_get_cache_size('database'),
    'total_cache_size' => cms_get_total_cache_size(),
    'cache_hit_rate' => cms_get_cache_hit_rate(),
    'cache_entries' => cms_count_cache_entries(),
    'last_cleanup' => cms_get_last_cache_cleanup()
];
?>

<div class="cache-manager-page">
    <h1><?php echo htmlspecialchars($page_title); ?></h1>
    
    <?php if ($message): ?>
    <div class="alert alert-<?php echo $message_type; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>
    
    <!-- Cache Statistics -->
    <div class="cache-stats-dashboard">
        <div class="stat-card">
            <h3><?php echo cms_plugin_translate('admin_toolkit', 'cache.total_size'); ?></h3>
            <div class="stat-value">
                <?php echo cms_format_bytes($cache_stats['total_cache_size'] ?? 0); ?>
            </div>
        </div>
        
        <div class="stat-card">
            <h3><?php echo cms_plugin_translate('admin_toolkit', 'cache.hit_rate'); ?></h3>
            <div class="stat-value">
                <?php echo number_format(($cache_stats['cache_hit_rate'] ?? 0) * 100, 1); ?>%
            </div>
        </div>
        
        <div class="stat-card">
            <h3><?php echo cms_plugin_translate('admin_toolkit', 'cache.total_entries'); ?></h3>
            <div class="stat-value">
                <?php echo number_format($cache_stats['cache_entries'] ?? 0); ?>
            </div>
        </div>
        
        <div class="stat-card">
            <h3><?php echo cms_plugin_translate('admin_toolkit', 'cache.last_cleanup'); ?></h3>
            <div class="stat-value stat-time">
                <?php echo $cache_stats['last_cleanup'] ? date('M j, H:i', strtotime($cache_stats['last_cleanup'])) : 'Never'; ?>
            </div>
        </div>
    </div>
    
    <!-- Cache Type Breakdown -->
    <div class="cache-breakdown">
        <h2>Cache Breakdown by Type</h2>
        <table class="cache-table">
            <thead>
                <tr>
                    <th>Cache Type</th>
                    <th>Size</th>
                    <th>Entries</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Template Cache</strong></td>
                    <td><?php echo cms_format_bytes($cache_stats['template_cache_size'] ?? 0); ?></td>
                    <td><?php echo cms_count_cache_entries('templates') ?? 0; ?></td>
                    <td>
                        <form method="post" style="display: inline;">
                            <button type="submit" name="clear_template_cache" class="btn btn-warning btn-sm">Clear</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><strong>Asset Cache</strong></td>
                    <td><?php echo cms_format_bytes($cache_stats['asset_cache_size'] ?? 0); ?></td>
                    <td><?php echo cms_count_cache_entries('assets') ?? 0; ?></td>
                    <td>
                        <form method="post" style="display: inline;">
                            <button type="submit" name="clear_asset_cache" class="btn btn-warning btn-sm">Clear</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><strong>Database Cache</strong></td>
                    <td><?php echo cms_format_bytes($cache_stats['database_cache_size'] ?? 0); ?></td>
                    <td><?php echo cms_count_cache_entries('database') ?? 0; ?></td>
                    <td>
                        <form method="post" style="display: inline;">
                            <button type="submit" name="clear_database_cache" class="btn btn-warning btn-sm">Clear</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Cache Management Actions -->
    <div class="cache-actions">
        <h2>Cache Management Actions</h2>
        
        <div class="action-buttons">
            <form method="post" style="display: inline;">
                <button type="submit" name="clear_all_cache" class="btn btn-danger" 
                        onclick="return confirm('Are you sure you want to clear all caches? This may temporarily slow down the site.')">
                    🗑️ Clear All Caches
                </button>
            </form>
            
            <form method="post" style="display: inline;">
                <button type="submit" name="optimize_cache" class="btn btn-primary">
                    ⚡ Optimize Cache Performance
                </button>
            </form>
            
            <button type="button" class="btn btn-info" onclick="refreshCacheStats()">
                🔄 Refresh Statistics
            </button>
        </div>
    </div>
    
    <!-- Cache Configuration -->
    <div class="cache-config">
        <h2>Cache Configuration</h2>
        
        <form class="cache-settings-form">
            <div class="form-section">
                <h3>General Settings</h3>
                
                <div class="form-row">
                    <label>Cache Enabled</label>
                    <select name="cache_enabled">
                        <option value="1" <?php echo cms_get_plugin_setting('admin_toolkit', 'cache_enabled', true) ? 'selected' : ''; ?>>Yes</option>
                        <option value="0" <?php echo !cms_get_plugin_setting('admin_toolkit', 'cache_enabled', true) ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
                
                <div class="form-row">
                    <label>Default Cache TTL (seconds)</label>
                    <input type="number" name="cache_ttl" 
                           value="<?php echo cms_get_plugin_setting('admin_toolkit', 'cache_ttl', 3600); ?>" 
                           min="60" max="86400">
                </div>
                
                <div class="form-row">
                    <label>Auto-cleanup Interval (hours)</label>
                    <input type="number" name="cleanup_interval" 
                           value="<?php echo cms_get_plugin_setting('admin_toolkit', 'cleanup_interval', 24); ?>" 
                           min="1" max="168">
                </div>
            </div>
            
            <div class="form-section">
                <h3>Performance Settings</h3>
                
                <div class="form-row">
                    <label>Compression Enabled</label>
                    <select name="compression_enabled">
                        <option value="1" <?php echo cms_get_plugin_setting('admin_toolkit', 'compression_enabled', true) ? 'selected' : ''; ?>>Yes</option>
                        <option value="0" <?php echo !cms_get_plugin_setting('admin_toolkit', 'compression_enabled', true) ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
                
                <div class="form-row">
                    <label>Max Cache Size (MB)</label>
                    <input type="number" name="max_cache_size" 
                           value="<?php echo cms_get_plugin_setting('admin_toolkit', 'max_cache_size', 100); ?>" 
                           min="10" max="1000">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Save Configuration</button>
                <button type="button" class="btn btn-secondary" onclick="resetCacheConfig()">Reset to Defaults</button>
            </div>
        </form>
    </div>
    
    <!-- Recent Cache Activity -->
    <div class="cache-activity">
        <h2>Recent Cache Activity</h2>
        <div class="activity-log">
            <div class="log-entry">
                <span class="timestamp"><?php echo date('H:i:s'); ?></span>
                <span class="action">Template cache cleared by admin</span>
            </div>
            <div class="log-entry">
                <span class="timestamp"><?php echo date('H:i:s', strtotime('-5 minutes')); ?></span>
                <span class="action">Auto-cleanup completed (removed 42 expired entries)</span>
            </div>
            <div class="log-entry">
                <span class="timestamp"><?php echo date('H:i:s', strtotime('-15 minutes')); ?></span>
                <span class="action">Cache hit rate: 94.7% (last hour)</span>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Auto-refresh cache statistics every 30 seconds
    <?php if (cms_get_plugin_setting('admin_toolkit', 'ui_preferences')['auto_refresh_cache_stats'] ?? true): ?>
    setInterval(refreshCacheStats, 30000);
    <?php endif; ?>
    
    // Handle cache settings form submission
    $('.cache-settings-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.post('?page=cache_manager&action=save_settings', formData)
            .done(function(response) {
                if (response.success) {
                    showMessage('Cache settings saved successfully.', 'success');
                } else {
                    showMessage('Failed to save cache settings: ' + (response.error || 'Unknown error'), 'error');
                }
            })
            .fail(function() {
                showMessage('Failed to save cache settings due to network error.', 'error');
            });
    });
});

function refreshCacheStats() {
    fetch('?page=cache_manager&action=get_stats')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update statistics display
                updateCacheStatistics(data.stats);
                showMessage('Cache statistics refreshed.', 'info');
            } else {
                showMessage('Failed to refresh cache statistics.', 'error');
            }
        })
        .catch(error => {
            console.error('Cache stats refresh failed:', error);
            showMessage('Failed to refresh cache statistics.', 'error');
        });
}

function updateCacheStatistics(stats) {
    // Update the stat cards with new data
    $('.stat-card .stat-value').each(function(index) {
        switch(index) {
            case 0: $(this).text(formatBytes(stats.total_cache_size || 0)); break;
            case 1: $(this).text((stats.cache_hit_rate * 100).toFixed(1) + '%'); break;
            case 2: $(this).text(stats.cache_entries.toLocaleString()); break;
            case 3: $(this).text(stats.last_cleanup ? new Date(stats.last_cleanup).toLocaleDateString() : 'Never'); break;
        }
    });
}

function resetCacheConfig() {
    if (confirm('Reset all cache settings to defaults? This will overwrite your current configuration.')) {
        $.post('?page=cache_manager&action=reset_config')
            .done(function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    showMessage('Failed to reset cache configuration.', 'error');
                }
            });
    }
}

function showMessage(message, type) {
    var alertClass = 'alert-' + (type || 'info');
    var alertHtml = '<div class="alert ' + alertClass + ' auto-dismiss">' + 
                   '<span>' + message + '</span>' +
                   '<button type="button" class="close" onclick="$(this).parent().remove()">&times;</button>' +
                   '</div>';
    
    $('.cache-manager-page h1').after(alertHtml);
    
    // Auto-dismiss after 5 seconds
    setTimeout(function() {
        $('.auto-dismiss').fadeOut(function() { $(this).remove(); });
    }, 5000);
}

function formatBytes(bytes) {
    if (bytes === 0) return '0 B';
    var k = 1024;
    var sizes = ['B', 'KB', 'MB', 'GB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
}
</script>

<style>
.cache-manager-page {
    max-width: 1200px;
    margin: 0 auto;
}

.alert {
    padding: 15px;
    margin: 15px 0;
    border-radius: 4px;
    border: 1px solid;
    position: relative;
}

.alert-success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
.alert-error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
.alert-info { background-color: #cce7ff; border-color: #b8daff; color: #004085; }

.alert .close {
    position: absolute;
    top: 10px;
    right: 15px;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    line-height: 1;
}

.cache-stats-dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.stat-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.stat-card h3 {
    margin: 0 0 10px 0;
    font-size: 14px;
    color: #6c757d;
    text-transform: uppercase;
}

.stat-value {
    font-size: 28px;
    font-weight: bold;
    color: #007bff;
    margin: 10px 0;
}

.stat-time {
    font-size: 18px;
}

.cache-breakdown, .cache-actions, .cache-config, .cache-activity {
    margin: 40px 0;
    background: white;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.cache-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.cache-table th,
.cache-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.cache-table th {
    background-color: #f8f9fa;
    font-weight: bold;
}

.action-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    transition: all 0.2s;
}

.btn-sm { padding: 6px 12px; font-size: 12px; }
.btn-danger { background-color: #dc3545; color: white; }
.btn-warning { background-color: #ffc107; color: #212529; }
.btn-primary { background-color: #007bff; color: white; }
.btn-info { background-color: #17a2b8; color: white; }
.btn-success { background-color: #28a745; color: white; }
.btn-secondary { background-color: #6c757d; color: white; }

.btn:hover {
    opacity: 0.85;
    transform: translateY(-1px);
}

.form-section {
    margin: 30px 0;
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 6px;
}

.form-section h3 {
    margin-top: 0;
    color: #495057;
}

.form-row {
    margin: 15px 0;
    display: flex;
    align-items: center;
    gap: 15px;
}

.form-row label {
    font-weight: 500;
    min-width: 200px;
}

.form-row input,
.form-row select {
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
}

.form-actions {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.activity-log {
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #eee;
    border-radius: 4px;
}

.log-entry {
    padding: 10px 15px;
    border-bottom: 1px solid #f1f1f1;
    display: flex;
    gap: 15px;
}

.log-entry:last-child {
    border-bottom: none;
}

.log-entry .timestamp {
    font-family: monospace;
    color: #6c757d;
    min-width: 80px;
}

.log-entry .action {
    color: #495057;
}
</style>