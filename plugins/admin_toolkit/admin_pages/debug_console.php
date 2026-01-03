<?php
/**
 * Debug Console Admin Page
 * Provides comprehensive debugging tools and diagnostic information
 */

// Check permissions
if (!cms_check_plugin_permission('admin_toolkit', 'access_debug_tools')) {
    echo '<div class="permission-denied">';
    echo '<h2>' . cms_plugin_translate('admin_toolkit', 'error.permission_denied') . '</h2>';
    echo '<p>You do not have permission to access debug tools.</p>';
    echo '</div>';
    return;
}

$page_title = cms_plugin_translate('admin_toolkit', 'menu.debug_console');

// Handle debug operations
$message = '';
$message_type = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clear_debug_log'])) {
        $cleared = cms_clear_debug_log();
        $message = $cleared ? 'Debug log cleared successfully.' : 'Failed to clear debug log.';
        $message_type = $cleared ? 'success' : 'error';
    } elseif (isset($_POST['export_debug_data'])) {
        $exported = cms_export_debug_data();
        $message = $exported ? 'Debug data exported successfully.' : 'Failed to export debug data.';
        $message_type = $exported ? 'success' : 'error';
    } elseif (isset($_POST['run_diagnostic'])) {
        $diagnostic_results = cms_run_system_diagnostic();
        $message = 'System diagnostic completed.';
        $message_type = 'info';
    }
}

// Get debug information
$debug_info = [
    'php_version' => PHP_VERSION,
    'memory_usage' => memory_get_usage(true),
    'memory_peak' => memory_get_peak_usage(true),
    'execution_time' => microtime(true) - ($_SERVER['REQUEST_TIME_FLOAT'] ?? microtime(true)),
    'included_files' => get_included_files(),
    'defined_constants' => get_defined_constants(true)['user'] ?? [],
    'loaded_extensions' => get_loaded_extensions(),
    'error_log_size' => file_exists(ini_get('error_log')) ? filesize(ini_get('error_log')) : 0
];

// Get recent error log entries
$recent_errors = cms_get_recent_error_log_entries(20);
$debug_log = cms_get_debug_log_entries(50);
?>

<div class="debug-console-page">
    <h1><?php echo htmlspecialchars($page_title); ?></h1>
    
    <?php if ($message): ?>
    <div class="alert alert-<?php echo $message_type; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>
    
    <!-- Debug Controls -->
    <div class="debug-controls">
        <div class="control-buttons">
            <form method="post" style="display: inline;">
                <button type="submit" name="clear_debug_log" class="btn btn-warning">
                    🗑️ Clear Debug Log
                </button>
            </form>
            
            <form method="post" style="display: inline;">
                <button type="submit" name="export_debug_data" class="btn btn-info">
                    📁 Export Debug Data
                </button>
            </form>
            
            <form method="post" style="display: inline;">
                <button type="submit" name="run_diagnostic" class="btn btn-primary">
                    🔍 Run System Diagnostic
                </button>
            </form>
            
            <button type="button" class="btn btn-secondary" onclick="refreshDebugInfo()">
                🔄 Refresh Information
            </button>
        </div>
    </div>
    
    <!-- System Information -->
    <div class="debug-section">
        <h2>System Information</h2>
        <div class="info-grid">
            <div class="info-card">
                <h3>PHP Environment</h3>
                <table class="info-table">
                    <tr><td>PHP Version</td><td><?php echo $debug_info['php_version']; ?></td></tr>
                    <tr><td>Memory Usage</td><td><?php echo cms_format_bytes($debug_info['memory_usage']); ?></td></tr>
                    <tr><td>Peak Memory</td><td><?php echo cms_format_bytes($debug_info['memory_peak']); ?></td></tr>
                    <tr><td>Memory Limit</td><td><?php echo ini_get('memory_limit'); ?></td></tr>
                    <tr><td>Execution Time</td><td><?php echo round($debug_info['execution_time'], 4); ?>s</td></tr>
                    <tr><td>Max Execution Time</td><td><?php echo ini_get('max_execution_time'); ?>s</td></tr>
                </table>
            </div>
            
            <div class="info-card">
                <h3>File Information</h3>
                <table class="info-table">
                    <tr><td>Included Files</td><td><?php echo count($debug_info['included_files']); ?> files</td></tr>
                    <tr><td>User Constants</td><td><?php echo count($debug_info['defined_constants']); ?> defined</td></tr>
                    <tr><td>Loaded Extensions</td><td><?php echo count($debug_info['loaded_extensions']); ?> loaded</td></tr>
                    <tr><td>Error Log Size</td><td><?php echo cms_format_bytes($debug_info['error_log_size']); ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Recent Errors -->
    <div class="debug-section">
        <h2>Recent Error Log <span class="badge"><?php echo count($recent_errors); ?></span></h2>
        <div class="error-log-container">
            <?php if (empty($recent_errors)): ?>
                <div class="no-errors">No recent errors found.</div>
            <?php else: ?>
                <div class="error-log">
                    <?php foreach ($recent_errors as $error): ?>
                    <div class="error-entry <?php echo strtolower($error['level'] ?? 'unknown'); ?>">
                        <div class="error-header">
                            <span class="error-level"><?php echo htmlspecialchars($error['level'] ?? 'UNKNOWN'); ?></span>
                            <span class="error-time"><?php echo htmlspecialchars($error['timestamp'] ?? 'Unknown time'); ?></span>
                        </div>
                        <div class="error-message"><?php echo htmlspecialchars($error['message'] ?? 'No message'); ?></div>
                        <?php if (!empty($error['file'])): ?>
                        <div class="error-file">
                            <?php echo htmlspecialchars($error['file']); ?>
                            <?php if (!empty($error['line'])): ?>
                                : line <?php echo intval($error['line']); ?>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Debug Log -->
    <div class="debug-section">
        <h2>CMS Debug Log <span class="badge"><?php echo count($debug_log); ?></span></h2>
        <div class="debug-log-container">
            <?php if (empty($debug_log)): ?>
                <div class="no-debug-entries">No debug entries found.</div>
            <?php else: ?>
                <div class="debug-log">
                    <?php foreach ($debug_log as $entry): ?>
                    <div class="debug-entry <?php echo strtolower($entry['level'] ?? 'info'); ?>">
                        <div class="debug-header">
                            <span class="debug-level"><?php echo htmlspecialchars($entry['level'] ?? 'INFO'); ?></span>
                            <span class="debug-time"><?php echo htmlspecialchars($entry['timestamp'] ?? date('Y-m-d H:i:s')); ?></span>
                            <?php if (!empty($entry['category'])): ?>
                            <span class="debug-category"><?php echo htmlspecialchars($entry['category']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="debug-message"><?php echo htmlspecialchars($entry['message'] ?? 'No message'); ?></div>
                        <?php if (!empty($entry['context'])): ?>
                        <div class="debug-context">
                            <details>
                                <summary>Context Data</summary>
                                <pre><?php echo htmlspecialchars(json_encode($entry['context'], JSON_PRETTY_PRINT)); ?></pre>
                            </details>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Advanced Debug Tools -->
    <div class="debug-section">
        <h2>Advanced Debug Tools</h2>
        
        <div class="debug-tools">
            <div class="tool-card">
                <h3>Memory Analysis</h3>
                <div class="tool-content">
                    <button type="button" class="btn btn-info" onclick="analyzeMemoryUsage()">
                        Analyze Memory Usage
                    </button>
                    <div id="memory-analysis" class="analysis-result"></div>
                </div>
            </div>
            
            <div class="tool-card">
                <h3>Database Queries</h3>
                <div class="tool-content">
                    <button type="button" class="btn btn-info" onclick="showDatabaseQueries()">
                        Show Recent Queries
                    </button>
                    <div id="database-queries" class="analysis-result"></div>
                </div>
            </div>
            
            <div class="tool-card">
                <h3>Performance Profiler</h3>
                <div class="tool-content">
                    <button type="button" class="btn btn-info" onclick="runPerformanceProfile()">
                        Run Performance Profile
                    </button>
                    <div id="performance-profile" class="analysis-result"></div>
                </div>
            </div>
            
            <div class="tool-card">
                <h3>Template Debug</h3>
                <div class="tool-content">
                    <button type="button" class="btn btn-info" onclick="debugTemplateCache()">
                        Debug Template Cache
                    </button>
                    <div id="template-debug" class="analysis-result"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Debug Configuration -->
    <div class="debug-section">
        <h2>Debug Configuration</h2>
        <form class="debug-config-form">
            <div class="config-grid">
                <div class="config-section">
                    <h3>Logging Settings</h3>
                    
                    <div class="form-row">
                        <label>Debug Mode Enabled</label>
                        <select name="debug_enabled">
                            <option value="1" <?php echo cms_get_plugin_setting('admin_toolkit', 'debug_enabled', false) ? 'selected' : ''; ?>>Yes</option>
                            <option value="0" <?php echo !cms_get_plugin_setting('admin_toolkit', 'debug_enabled', false) ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <label>Log Level</label>
                        <select name="log_level">
                            <option value="debug">Debug</option>
                            <option value="info" selected>Info</option>
                            <option value="warning">Warning</option>
                            <option value="error">Error</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <label>Max Log Entries</label>
                        <input type="number" name="max_log_entries" 
                               value="<?php echo cms_get_plugin_setting('admin_toolkit', 'max_log_entries', 1000); ?>" 
                               min="100" max="10000">
                    </div>
                </div>
                
                <div class="config-section">
                    <h3>Performance Settings</h3>
                    
                    <div class="form-row">
                        <label>Query Logging</label>
                        <select name="query_logging">
                            <option value="1">Enabled</option>
                            <option value="0" selected>Disabled</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <label>Memory Tracking</label>
                        <select name="memory_tracking">
                            <option value="1" selected>Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <label>Performance Profiling</label>
                        <select name="performance_profiling">
                            <option value="1">Enabled</option>
                            <option value="0" selected>Disabled</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Save Debug Configuration</button>
                <button type="button" class="btn btn-secondary" onclick="resetDebugConfig()">Reset to Defaults</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Handle debug config form submission
    $('.debug-config-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.post('?page=debug_console&action=save_config', formData)
            .done(function(response) {
                if (response.success) {
                    showMessage('Debug configuration saved successfully.', 'success');
                } else {
                    showMessage('Failed to save debug configuration: ' + (response.error || 'Unknown error'), 'error');
                }
            })
            .fail(function() {
                showMessage('Failed to save debug configuration due to network error.', 'error');
            });
    });
    
    // Auto-refresh debug information if enabled
    <?php if (cms_get_plugin_setting('admin_toolkit', 'debug_auto_refresh', false)): ?>
    setInterval(refreshDebugInfo, 60000); // Refresh every minute
    <?php endif; ?>
});

function refreshDebugInfo() {
    fetch('?page=debug_console&action=refresh_info')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Simple reload for now
            } else {
                showMessage('Failed to refresh debug information.', 'error');
            }
        })
        .catch(error => {
            console.error('Debug info refresh failed:', error);
        });
}

function analyzeMemoryUsage() {
    $('#memory-analysis').html('<div class="loading">Analyzing memory usage...</div>');
    
    fetch('?page=debug_console&action=analyze_memory')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                var html = '<div class="memory-results">';
                html += '<h4>Memory Usage Analysis</h4>';
                html += '<ul>';
                html += '<li>Current Usage: ' + formatBytes(data.current_usage) + '</li>';
                html += '<li>Peak Usage: ' + formatBytes(data.peak_usage) + '</li>';
                html += '<li>Available Memory: ' + formatBytes(data.available_memory) + '</li>';
                html += '<li>Memory Efficiency: ' + data.efficiency + '%</li>';
                html += '</ul>';
                if (data.recommendations && data.recommendations.length > 0) {
                    html += '<h5>Recommendations:</h5><ul>';
                    data.recommendations.forEach(function(rec) {
                        html += '<li>' + rec + '</li>';
                    });
                    html += '</ul>';
                }
                html += '</div>';
                $('#memory-analysis').html(html);
            } else {
                $('#memory-analysis').html('<div class="error">Failed to analyze memory usage.</div>');
            }
        })
        .catch(error => {
            $('#memory-analysis').html('<div class="error">Memory analysis failed.</div>');
        });
}

function showDatabaseQueries() {
    $('#database-queries').html('<div class="loading">Loading recent database queries...</div>');
    
    fetch('?page=debug_console&action=get_queries')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.queries) {
                var html = '<div class="query-results">';
                html += '<h4>Recent Database Queries (' + data.queries.length + ')</h4>';
                if (data.queries.length === 0) {
                    html += '<p>No queries recorded.</p>';
                } else {
                    data.queries.forEach(function(query) {
                        html += '<div class="query-entry">';
                        html += '<div class="query-time">' + query.execution_time + 'ms</div>';
                        html += '<div class="query-sql"><code>' + query.sql + '</code></div>';
                        html += '</div>';
                    });
                }
                html += '</div>';
                $('#database-queries').html(html);
            } else {
                $('#database-queries').html('<div class="error">Failed to load database queries.</div>');
            }
        });
}

function runPerformanceProfile() {
    $('#performance-profile').html('<div class="loading">Running performance profile...</div>');
    
    fetch('?page=debug_console&action=performance_profile')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                var html = '<div class="performance-results">';
                html += '<h4>Performance Profile Results</h4>';
                html += '<div class="profile-metrics">';
                html += '<div class="metric">Page Load Time: ' + data.page_load_time + 'ms</div>';
                html += '<div class="metric">Database Time: ' + data.database_time + 'ms</div>';
                html += '<div class="metric">Template Time: ' + data.template_time + 'ms</div>';
                html += '<div class="metric">Plugin Time: ' + data.plugin_time + 'ms</div>';
                html += '</div>';
                if (data.bottlenecks && data.bottlenecks.length > 0) {
                    html += '<h5>Performance Bottlenecks:</h5><ul>';
                    data.bottlenecks.forEach(function(bottleneck) {
                        html += '<li>' + bottleneck + '</li>';
                    });
                    html += '</ul>';
                }
                html += '</div>';
                $('#performance-profile').html(html);
            } else {
                $('#performance-profile').html('<div class="error">Performance profiling failed.</div>');
            }
        });
}

function debugTemplateCache() {
    $('#template-debug').html('<div class="loading">Analyzing template cache...</div>');
    
    fetch('?page=debug_console&action=template_debug')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                var html = '<div class="template-results">';
                html += '<h4>Template Cache Analysis</h4>';
                html += '<div class="cache-stats">';
                html += '<div class="stat">Cached Templates: ' + data.cached_count + '</div>';
                html += '<div class="stat">Cache Hit Rate: ' + data.hit_rate + '%</div>';
                html += '<div class="stat">Total Size: ' + formatBytes(data.total_size) + '</div>';
                html += '</div>';
                if (data.templates && data.templates.length > 0) {
                    html += '<h5>Recent Templates:</h5><ul>';
                    data.templates.forEach(function(template) {
                        html += '<li>' + template.name + ' (' + formatBytes(template.size) + ')</li>';
                    });
                    html += '</ul>';
                }
                html += '</div>';
                $('#template-debug').html(html);
            } else {
                $('#template-debug').html('<div class="error">Template debug failed.</div>');
            }
        });
}

function resetDebugConfig() {
    if (confirm('Reset all debug settings to defaults?')) {
        $.post('?page=debug_console&action=reset_config')
            .done(function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    showMessage('Failed to reset debug configuration.', 'error');
                }
            });
    }
}

function showMessage(message, type) {
    var alertClass = 'alert-' + (type || 'info');
    var alertHtml = '<div class="alert ' + alertClass + ' auto-dismiss">' + message + '</div>';
    $('.debug-console-page h1').after(alertHtml);
    
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
.debug-console-page {
    max-width: 1400px;
    margin: 0 auto;
}

.alert {
    padding: 15px;
    margin: 15px 0;
    border-radius: 4px;
    border: 1px solid;
}

.alert-success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
.alert-error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
.alert-info { background-color: #cce7ff; border-color: #b8daff; color: #004085; }

.debug-controls {
    margin: 20px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.control-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.debug-section {
    margin: 30px 0;
    background: white;
    padding: 25px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.debug-section h2 {
    margin-top: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.badge {
    background: #007bff;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: normal;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.info-card {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.info-card h3 {
    margin-top: 0;
    color: #495057;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
}

.info-table td {
    padding: 8px 12px;
    border-bottom: 1px solid #dee2e6;
}

.info-table td:first-child {
    font-weight: 500;
    color: #495057;
    width: 40%;
}

.error-log-container, .debug-log-container {
    max-height: 500px;
    overflow-y: auto;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    margin-top: 15px;
}

.no-errors, .no-debug-entries {
    padding: 40px;
    text-align: center;
    color: #6c757d;
    font-style: italic;
}

.error-entry, .debug-entry {
    padding: 15px;
    border-bottom: 1px solid #f1f1f1;
    margin-bottom: 0;
}

.error-entry:last-child, .debug-entry:last-child {
    border-bottom: none;
}

.error-entry.error { border-left: 4px solid #dc3545; }
.error-entry.warning { border-left: 4px solid #ffc107; }
.error-entry.notice { border-left: 4px solid #17a2b8; }

.debug-entry.error { border-left: 4px solid #dc3545; }
.debug-entry.warning { border-left: 4px solid #ffc107; }
.debug-entry.info { border-left: 4px solid #007bff; }
.debug-entry.debug { border-left: 4px solid #6c757d; }

.error-header, .debug-header {
    display: flex;
    gap: 15px;
    margin-bottom: 8px;
    font-size: 12px;
}

.error-level, .debug-level {
    background: #495057;
    color: white;
    padding: 2px 6px;
    border-radius: 3px;
    font-weight: bold;
    text-transform: uppercase;
}

.error-time, .debug-time {
    color: #6c757d;
    font-family: monospace;
}

.debug-category {
    background: #007bff;
    color: white;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 11px;
}

.error-message, .debug-message {
    font-family: monospace;
    background: #f8f9fa;
    padding: 8px;
    border-radius: 3px;
    margin: 5px 0;
    white-space: pre-wrap;
}

.error-file {
    color: #6c757d;
    font-size: 12px;
    font-family: monospace;
}

.debug-context {
    margin-top: 10px;
}

.debug-context details summary {
    cursor: pointer;
    font-weight: 500;
    color: #007bff;
}

.debug-context pre {
    background: #f8f9fa;
    padding: 10px;
    border-radius: 3px;
    overflow-x: auto;
    font-size: 12px;
    margin: 5px 0;
}

.debug-tools {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.tool-card {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.tool-card h3 {
    margin-top: 0;
    color: #495057;
}

.tool-content {
    margin-top: 15px;
}

.analysis-result {
    margin-top: 15px;
    min-height: 50px;
}

.loading {
    color: #007bff;
    font-style: italic;
    padding: 10px;
}

.error {
    color: #dc3545;
    padding: 10px;
    background: #f8d7da;
    border-radius: 3px;
}

.config-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
    margin-top: 20px;
}

.config-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.config-section h3 {
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
    min-width: 150px;
}

.form-row input, .form-row select {
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

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin-right: 10px;
    transition: all 0.2s;
}

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

.memory-results, .query-results, .performance-results, .template-results {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.query-entry {
    margin: 10px 0;
    padding: 10px;
    background: white;
    border-radius: 4px;
    border-left: 3px solid #007bff;
}

.query-time {
    font-weight: bold;
    color: #007bff;
    margin-bottom: 5px;
}

.query-sql code {
    background: #f1f3f4;
    padding: 2px 4px;
    border-radius: 2px;
    font-size: 12px;
}

.profile-metrics, .cache-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin: 15px 0;
}

.metric, .stat {
    background: white;
    padding: 15px;
    border-radius: 4px;
    text-align: center;
    font-weight: 500;
    border: 1px solid #e9ecef;
}
</style>