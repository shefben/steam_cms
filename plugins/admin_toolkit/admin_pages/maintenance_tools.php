<?php
/**
 * Maintenance Tools Admin Page
 * Provides comprehensive system maintenance and optimization tools
 */

// Check permissions
if (!cms_check_plugin_permission('admin_toolkit', 'use_maintenance_tools')) {
    echo '<div class="permission-denied">';
    echo '<h2>' . cms_plugin_translate('admin_toolkit', 'error.permission_denied') . '</h2>';
    echo '<p>You do not have permission to access maintenance tools.</p>';
    echo '</div>';
    return;
}

$page_title = cms_plugin_translate('admin_toolkit', 'menu.maintenance_tools');

// Handle maintenance operations
$message = '';
$message_type = '';
$maintenance_results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cleanup_temporary_files'])) {
        $result = cms_cleanup_temporary_files();
        $maintenance_results['temp_cleanup'] = $result;
        $message = $result['success'] ? "Temporary files cleanup completed. {$result['files_removed']} files removed, {$result['space_freed']} freed." : 'Temporary files cleanup failed.';
        $message_type = $result['success'] ? 'success' : 'error';
        
    } elseif (isset($_POST['optimize_database'])) {
        $result = cms_optimize_database_tables();
        $maintenance_results['db_optimize'] = $result;
        $message = $result['success'] ? "Database optimization completed. {$result['tables_optimized']} tables optimized." : 'Database optimization failed.';
        $message_type = $result['success'] ? 'success' : 'error';
        
    } elseif (isset($_POST['repair_database'])) {
        $result = cms_repair_database_tables();
        $maintenance_results['db_repair'] = $result;
        $message = $result['success'] ? "Database repair completed. {$result['tables_repaired']} tables repaired." : 'Database repair failed.';
        $message_type = $result['success'] ? 'success' : 'error';
        
    } elseif (isset($_POST['update_search_index'])) {
        $result = cms_rebuild_search_index();
        $maintenance_results['search_index'] = $result;
        $message = $result['success'] ? "Search index rebuilt successfully. {$result['items_indexed']} items indexed." : 'Search index rebuild failed.';
        $message_type = $result['success'] ? 'success' : 'error';
        
    } elseif (isset($_POST['validate_file_integrity'])) {
        $result = cms_validate_file_integrity();
        $maintenance_results['file_integrity'] = $result;
        $message = $result['success'] ? "File integrity check completed. {$result['files_checked']} files checked, {$result['issues_found']} issues found." : 'File integrity check failed.';
        $message_type = ($result['success'] && $result['issues_found'] == 0) ? 'success' : ($result['issues_found'] > 0 ? 'warning' : 'error');
        
    } elseif (isset($_POST['run_full_maintenance'])) {
        $results = cms_run_full_system_maintenance();
        $maintenance_results = $results;
        $message = 'Full system maintenance completed. Check results below for details.';
        $message_type = 'info';
    }
}

// Get system health information
$system_health = cms_get_system_health_status();
$disk_usage = cms_get_disk_usage_info();
$backup_status = cms_get_backup_status();
?>

<div class="maintenance-tools-page">
    <h1><?php echo htmlspecialchars($page_title); ?></h1>
    
    <?php if ($message): ?>
    <div class="alert alert-<?php echo $message_type; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>
    
    <!-- System Health Overview -->
    <div class="health-overview">
        <h2>System Health Overview</h2>
        <div class="health-grid">
            <div class="health-card <?php echo $system_health['overall_status']; ?>">
                <h3>Overall Status</h3>
                <div class="health-indicator">
                    <?php echo strtoupper($system_health['overall_status']); ?>
                </div>
                <div class="health-score">
                    Health Score: <?php echo $system_health['health_score']; ?>/100
                </div>
            </div>
            
            <div class="health-card <?php echo $disk_usage['status']; ?>">
                <h3>Disk Usage</h3>
                <div class="health-indicator">
                    <?php echo $disk_usage['used_percentage']; ?>% Used
                </div>
                <div class="health-details">
                    <?php echo cms_format_bytes($disk_usage['used']); ?> / <?php echo cms_format_bytes($disk_usage['total']); ?>
                </div>
            </div>
            
            <div class="health-card <?php echo $backup_status['status']; ?>">
                <h3>Last Backup</h3>
                <div class="health-indicator">
                    <?php echo $backup_status['last_backup'] ? date('M j, H:i', strtotime($backup_status['last_backup'])) : 'Never'; ?>
                </div>
                <div class="health-details">
                    <?php echo $backup_status['backup_size'] ? cms_format_bytes($backup_status['backup_size']) : 'No backup'; ?>
                </div>
            </div>
            
            <div class="health-card <?php echo $system_health['performance_status']; ?>">
                <h3>Performance</h3>
                <div class="health-indicator">
                    <?php echo $system_health['avg_response_time']; ?>ms avg
                </div>
                <div class="health-details">
                    <?php echo $system_health['active_sessions']; ?> active sessions
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Maintenance Actions -->
    <div class="maintenance-section">
        <h2>Quick Maintenance Actions</h2>
        <div class="maintenance-grid">
            <div class="maintenance-card">
                <h3>🗑️ Cleanup Temporary Files</h3>
                <p>Remove temporary files, cache remnants, and log files to free up disk space.</p>
                <form method="post" style="display: inline;">
                    <button type="submit" name="cleanup_temporary_files" class="btn btn-warning"
                            onclick="return confirm('This will remove all temporary files. Continue?')">
                        Run Cleanup
                    </button>
                </form>
                <?php if (isset($maintenance_results['temp_cleanup'])): ?>
                <div class="maintenance-result <?php echo $maintenance_results['temp_cleanup']['success'] ? 'success' : 'error'; ?>">
                    <?php if ($maintenance_results['temp_cleanup']['success']): ?>
                        ✅ Removed <?php echo $maintenance_results['temp_cleanup']['files_removed']; ?> files, 
                        freed <?php echo $maintenance_results['temp_cleanup']['space_freed']; ?>
                    <?php else: ?>
                        ❌ Cleanup failed: <?php echo $maintenance_results['temp_cleanup']['error']; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="maintenance-card">
                <h3>⚡ Optimize Database</h3>
                <p>Optimize database tables to improve performance and reduce storage overhead.</p>
                <form method="post" style="display: inline;">
                    <button type="submit" name="optimize_database" class="btn btn-primary"
                            onclick="return confirm('Database optimization may take several minutes. Continue?')">
                        Optimize Database
                    </button>
                </form>
                <?php if (isset($maintenance_results['db_optimize'])): ?>
                <div class="maintenance-result <?php echo $maintenance_results['db_optimize']['success'] ? 'success' : 'error'; ?>">
                    <?php if ($maintenance_results['db_optimize']['success']): ?>
                        ✅ Optimized <?php echo $maintenance_results['db_optimize']['tables_optimized']; ?> tables, 
                        saved <?php echo $maintenance_results['db_optimize']['space_saved'] ?? '0 B'; ?>
                    <?php else: ?>
                        ❌ Optimization failed: <?php echo $maintenance_results['db_optimize']['error']; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="maintenance-card">
                <h3>🔧 Repair Database</h3>
                <p>Check and repair corrupted database tables to ensure data integrity.</p>
                <form method="post" style="display: inline;">
                    <button type="submit" name="repair_database" class="btn btn-danger"
                            onclick="return confirm('Database repair should only be run if you suspect corruption. Continue?')">
                        Repair Database
                    </button>
                </form>
                <?php if (isset($maintenance_results['db_repair'])): ?>
                <div class="maintenance-result <?php echo $maintenance_results['db_repair']['success'] ? 'success' : 'error'; ?>">
                    <?php if ($maintenance_results['db_repair']['success']): ?>
                        ✅ Checked <?php echo $maintenance_results['db_repair']['tables_checked']; ?> tables, 
                        repaired <?php echo $maintenance_results['db_repair']['tables_repaired']; ?>
                    <?php else: ?>
                        ❌ Repair failed: <?php echo $maintenance_results['db_repair']['error']; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="maintenance-card">
                <h3>🔍 Update Search Index</h3>
                <p>Rebuild the search index to ensure accurate and fast search results.</p>
                <form method="post" style="display: inline;">
                    <button type="submit" name="update_search_index" class="btn btn-info"
                            onclick="return confirm('Rebuilding search index may take time. Continue?')">
                        Rebuild Index
                    </button>
                </form>
                <?php if (isset($maintenance_results['search_index'])): ?>
                <div class="maintenance-result <?php echo $maintenance_results['search_index']['success'] ? 'success' : 'error'; ?>">
                    <?php if ($maintenance_results['search_index']['success']): ?>
                        ✅ Indexed <?php echo $maintenance_results['search_index']['items_indexed']; ?> items in 
                        <?php echo $maintenance_results['search_index']['time_taken']; ?>s
                    <?php else: ?>
                        ❌ Indexing failed: <?php echo $maintenance_results['search_index']['error']; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="maintenance-card">
                <h3>✅ Validate File Integrity</h3>
                <p>Check core system files for corruption or unauthorized modifications.</p>
                <form method="post" style="display: inline;">
                    <button type="submit" name="validate_file_integrity" class="btn btn-info"
                            onclick="return confirm('File integrity check will scan all core files. Continue?')">
                        Validate Files
                    </button>
                </form>
                <?php if (isset($maintenance_results['file_integrity'])): ?>
                <div class="maintenance-result <?php echo $maintenance_results['file_integrity']['success'] ? ($maintenance_results['file_integrity']['issues_found'] == 0 ? 'success' : 'warning') : 'error'; ?>">
                    <?php if ($maintenance_results['file_integrity']['success']): ?>
                        <?php if ($maintenance_results['file_integrity']['issues_found'] == 0): ?>
                            ✅ All <?php echo $maintenance_results['file_integrity']['files_checked']; ?> files validated successfully
                        <?php else: ?>
                            ⚠️ Found <?php echo $maintenance_results['file_integrity']['issues_found']; ?> issues in 
                            <?php echo $maintenance_results['file_integrity']['files_checked']; ?> files checked
                        <?php endif; ?>
                    <?php else: ?>
                        ❌ Validation failed: <?php echo $maintenance_results['file_integrity']['error']; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="maintenance-card full-width">
                <h3>🔄 Run Full System Maintenance</h3>
                <p>Perform all maintenance tasks in sequence. This may take several minutes to complete.</p>
                <form method="post" style="display: inline;">
                    <button type="submit" name="run_full_maintenance" class="btn btn-success btn-large"
                            onclick="return confirm('Full maintenance will run all tasks sequentially. This may take 10+ minutes. Continue?')">
                        🚀 Run Full Maintenance Suite
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Scheduled Maintenance -->
    <div class="maintenance-section">
        <h2>Scheduled Maintenance</h2>
        <div class="schedule-info">
            <div class="schedule-card">
                <h3>Automatic Maintenance Schedule</h3>
                <table class="schedule-table">
                    <tr>
                        <td>Daily Cleanup</td>
                        <td><?php echo cms_get_plugin_setting('admin_toolkit', 'daily_cleanup_enabled', true) ? 'Enabled' : 'Disabled'; ?></td>
                        <td>
                            <span class="schedule-time">
                                <?php echo cms_get_plugin_setting('admin_toolkit', 'daily_cleanup_time', '02:00'); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Weekly Database Optimization</td>
                        <td><?php echo cms_get_plugin_setting('admin_toolkit', 'weekly_db_optimize', true) ? 'Enabled' : 'Disabled'; ?></td>
                        <td>
                            <span class="schedule-time">Sundays at 03:00</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Monthly Full Maintenance</td>
                        <td><?php echo cms_get_plugin_setting('admin_toolkit', 'monthly_full_maintenance', false) ? 'Enabled' : 'Disabled'; ?></td>
                        <td>
                            <span class="schedule-time">1st of month at 01:00</span>
                        </td>
                    </tr>
                </table>
                
                <div class="schedule-actions">
                    <button type="button" class="btn btn-secondary" onclick="configureSchedule()">
                        Configure Schedule
                    </button>
                    <button type="button" class="btn btn-info" onclick="viewMaintenanceLog()">
                        View Maintenance Log
                    </button>
                </div>
            </div>
            
            <div class="schedule-card">
                <h3>Next Scheduled Tasks</h3>
                <div class="next-tasks">
                    <?php
                    $next_tasks = cms_get_next_scheduled_maintenance();
                    if (empty($next_tasks)):
                    ?>
                        <div class="no-tasks">No scheduled maintenance tasks.</div>
                    <?php else: ?>
                        <?php foreach ($next_tasks as $task): ?>
                        <div class="task-entry">
                            <div class="task-name"><?php echo htmlspecialchars($task['name']); ?></div>
                            <div class="task-time"><?php echo date('M j, Y H:i', strtotime($task['next_run'])); ?></div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Maintenance History -->
    <div class="maintenance-section">
        <h2>Recent Maintenance History</h2>
        <div class="history-container">
            <?php
            $maintenance_history = cms_get_maintenance_history(10);
            if (empty($maintenance_history)):
            ?>
                <div class="no-history">No maintenance history available.</div>
            <?php else: ?>
                <div class="history-log">
                    <?php foreach ($maintenance_history as $entry): ?>
                    <div class="history-entry <?php echo $entry['status']; ?>">
                        <div class="history-header">
                            <span class="history-task"><?php echo htmlspecialchars($entry['task_name']); ?></span>
                            <span class="history-time"><?php echo date('M j, Y H:i', strtotime($entry['completed_at'])); ?></span>
                            <span class="history-status status-<?php echo $entry['status']; ?>">
                                <?php echo strtoupper($entry['status']); ?>
                            </span>
                        </div>
                        <div class="history-details">
                            Duration: <?php echo $entry['duration']; ?>s | 
                            <?php if ($entry['items_processed']): ?>
                                Processed: <?php echo number_format($entry['items_processed']); ?> items
                            <?php endif; ?>
                            <?php if ($entry['space_freed']): ?>
                                | Freed: <?php echo cms_format_bytes($entry['space_freed']); ?>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($entry['notes'])): ?>
                        <div class="history-notes">
                            <?php echo htmlspecialchars($entry['notes']); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Auto-refresh system health every 2 minutes
    <?php if (cms_get_plugin_setting('admin_toolkit', 'auto_refresh_health', true)): ?>
    setInterval(refreshSystemHealth, 120000);
    <?php endif; ?>
    
    // Add loading states to maintenance buttons
    $('.maintenance-card button[type="submit"]').on('click', function() {
        var $btn = $(this);
        var originalText = $btn.text();
        
        $btn.prop('disabled', true).text('Running...');
        
        // Re-enable after form submission (page reload)
        setTimeout(function() {
            $btn.prop('disabled', false).text(originalText);
        }, 1000);
    });
});

function refreshSystemHealth() {
    fetch('?page=maintenance_tools&action=get_health_status')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateHealthDisplay(data.health);
            }
        })
        .catch(error => {
            console.error('Health status refresh failed:', error);
        });
}

function updateHealthDisplay(health) {
    $('.health-card').each(function(index) {
        var $card = $(this);
        switch(index) {
            case 0: // Overall status
                $card.removeClass('good warning critical').addClass(health.overall_status);
                $card.find('.health-indicator').text(health.overall_status.toUpperCase());
                $card.find('.health-score').text('Health Score: ' + health.health_score + '/100');
                break;
            case 1: // Disk usage
                $card.removeClass('good warning critical').addClass(health.disk_status);
                $card.find('.health-indicator').text(health.disk_usage_percentage + '% Used');
                break;
            case 3: // Performance
                $card.removeClass('good warning critical').addClass(health.performance_status);
                $card.find('.health-indicator').text(health.avg_response_time + 'ms avg');
                $card.find('.health-details').text(health.active_sessions + ' active sessions');
                break;
        }
    });
}

function configureSchedule() {
    // Open modal or redirect to schedule configuration
    window.open('?page=maintenance_tools&action=configure_schedule', '_blank');
}

function viewMaintenanceLog() {
    // Open maintenance log viewer
    window.open('?page=maintenance_tools&action=view_log', '_blank');
}

function showMessage(message, type) {
    var alertClass = 'alert-' + (type || 'info');
    var alertHtml = '<div class="alert ' + alertClass + ' auto-dismiss">' + message + '</div>';
    $('.maintenance-tools-page h1').after(alertHtml);
    
    setTimeout(function() {
        $('.auto-dismiss').fadeOut(function() { $(this).remove(); });
    }, 5000);
}
</script>

<style>
.maintenance-tools-page {
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
.alert-warning { background-color: #fff3cd; border-color: #ffeaa7; color: #856404; }
.alert-info { background-color: #cce7ff; border-color: #b8daff; color: #004085; }

.health-overview {
    margin: 30px 0;
    background: white;
    padding: 25px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.health-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.health-card {
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    border: 2px solid;
    transition: all 0.3s;
}

.health-card.good {
    background-color: #d4edda;
    border-color: #28a745;
    color: #155724;
}

.health-card.warning {
    background-color: #fff3cd;
    border-color: #ffc107;
    color: #856404;
}

.health-card.critical {
    background-color: #f8d7da;
    border-color: #dc3545;
    color: #721c24;
}

.health-card h3 {
    margin: 0 0 10px 0;
    font-size: 14px;
    text-transform: uppercase;
    opacity: 0.8;
}

.health-indicator {
    font-size: 24px;
    font-weight: bold;
    margin: 10px 0;
}

.health-score, .health-details {
    font-size: 12px;
    opacity: 0.8;
}

.maintenance-section {
    margin: 40px 0;
    background: white;
    padding: 25px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.maintenance-section h2 {
    margin-top: 0;
}

.maintenance-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.maintenance-card {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: all 0.2s;
}

.maintenance-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.maintenance-card.full-width {
    grid-column: 1 / -1;
    text-align: center;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border: none;
}

.maintenance-card h3 {
    margin: 0 0 10px 0;
    color: #495057;
}

.maintenance-card.full-width h3 {
    color: white;
    font-size: 20px;
}

.maintenance-card p {
    margin: 10px 0 15px 0;
    color: #6c757d;
    font-size: 14px;
    line-height: 1.4;
}

.maintenance-card.full-width p {
    color: rgba(255,255,255,0.9);
}

.maintenance-result {
    margin-top: 15px;
    padding: 10px;
    border-radius: 4px;
    font-size: 13px;
    font-weight: 500;
}

.maintenance-result.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.maintenance-result.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.maintenance-result.warning {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.schedule-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 25px;
    margin-top: 20px;
}

.schedule-card {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.schedule-card h3 {
    margin-top: 0;
    color: #495057;
}

.schedule-table {
    width: 100%;
    border-collapse: collapse;
    margin: 15px 0;
}

.schedule-table td {
    padding: 12px 8px;
    border-bottom: 1px solid #dee2e6;
}

.schedule-table td:first-child {
    font-weight: 500;
}

.schedule-table td:nth-child(2) {
    text-align: center;
}

.schedule-time {
    font-family: monospace;
    background: #e9ecef;
    padding: 2px 6px;
    border-radius: 3px;
}

.schedule-actions {
    margin-top: 20px;
}

.next-tasks {
    margin-top: 15px;
}

.no-tasks {
    text-align: center;
    color: #6c757d;
    font-style: italic;
    padding: 20px;
}

.task-entry {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #e9ecef;
}

.task-entry:last-child {
    border-bottom: none;
}

.task-name {
    font-weight: 500;
}

.task-time {
    font-size: 12px;
    color: #6c757d;
    font-family: monospace;
}

.history-container {
    margin-top: 20px;
}

.no-history {
    text-align: center;
    color: #6c757d;
    font-style: italic;
    padding: 40px;
}

.history-log {
    border: 1px solid #e9ecef;
    border-radius: 6px;
}

.history-entry {
    padding: 15px;
    border-bottom: 1px solid #f1f1f1;
}

.history-entry:last-child {
    border-bottom: none;
}

.history-entry.success { border-left: 4px solid #28a745; }
.history-entry.warning { border-left: 4px solid #ffc107; }
.history-entry.error { border-left: 4px solid #dc3545; }

.history-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 8px;
}

.history-task {
    font-weight: 500;
    flex-grow: 1;
}

.history-time {
    font-size: 12px;
    color: #6c757d;
    font-family: monospace;
}

.history-status {
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 10px;
    font-weight: bold;
}

.history-status.status-success { background: #28a745; color: white; }
.history-status.status-warning { background: #ffc107; color: #212529; }
.history-status.status-error { background: #dc3545; color: white; }

.history-details {
    font-size: 12px;
    color: #6c757d;
    margin-bottom: 5px;
}

.history-notes {
    font-size: 12px;
    color: #495057;
    font-style: italic;
    background: #f8f9fa;
    padding: 8px;
    border-radius: 3px;
    margin-top: 5px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 5px 5px 5px 0;
    transition: all 0.2s;
}

.btn-large {
    padding: 15px 30px;
    font-size: 16px;
    font-weight: 500;
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.btn-danger { background-color: #dc3545; color: white; }
.btn-warning { background-color: #ffc107; color: #212529; }
.btn-primary { background-color: #007bff; color: white; }
.btn-info { background-color: #17a2b8; color: white; }
.btn-success { background-color: #28a745; color: white; }
.btn-secondary { background-color: #6c757d; color: white; }

.btn:hover:not(:disabled) {
    opacity: 0.85;
    transform: translateY(-1px);
}

.maintenance-card.full-width .btn {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.3);
    padding: 12px 24px;
    font-size: 16px;
    font-weight: 500;
}

.maintenance-card.full-width .btn:hover {
    background: rgba(255,255,255,0.3);
    border-color: rgba(255,255,255,0.5);
}
</style>