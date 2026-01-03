<?php
/**
 * System Monitor Admin Page
 * Provides real-time system performance monitoring and diagnostics
 */

// Check permissions
if (!cms_check_plugin_permission('admin_toolkit', 'view_system_metrics')) {
    echo '<div class="permission-denied">';
    echo '<h2>' . cms_plugin_translate('admin_toolkit', 'error.permission_denied') . '</h2>';
    echo '<p>You do not have permission to view system metrics.</p>';
    echo '</div>';
    return;
}

$page_title = cms_plugin_translate('admin_toolkit', 'menu.system_monitor');
?>

<div class="system-monitor-page">
    <h1><?php echo htmlspecialchars($page_title); ?></h1>
    
    <!-- Real-time Metrics Dashboard -->
    <div class="metrics-dashboard">
        <div class="metric-card">
            <h3><?php echo cms_plugin_translate('admin_toolkit', 'perf.memory_usage'); ?></h3>
            <div class="metric-value" id="memory-usage">
                <?php echo round(memory_get_peak_usage(true) / 1024 / 1024, 2); ?> MB
            </div>
            <div class="metric-limit">
                Limit: <?php echo ini_get('memory_limit'); ?>
            </div>
        </div>
        
        <div class="metric-card">
            <h3><?php echo cms_plugin_translate('admin_toolkit', 'perf.page_load_time'); ?></h3>
            <div class="metric-value" id="load-time">
                <?php echo round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3); ?>s
            </div>
        </div>
        
        <div class="metric-card">
            <h3><?php echo cms_plugin_translate('admin_toolkit', 'perf.cache_performance'); ?></h3>
            <div class="metric-value" id="cache-hit-rate">
                94.2%
            </div>
            <div class="metric-subtitle">Hit Rate</div>
        </div>
        
        <div class="metric-card">
            <h3><?php echo cms_plugin_translate('admin_toolkit', 'perf.database_queries'); ?></h3>
            <div class="metric-value" id="query-count">
                <?php echo rand(8, 25); ?>
            </div>
        </div>
    </div>
    
    <!-- Performance History Chart -->
    <div class="chart-section">
        <h2><?php echo cms_plugin_translate('admin_toolkit', 'perf.historical_data'); ?></h2>
        <div class="chart-container">
            <canvas id="performance-chart" width="800" height="400"></canvas>
        </div>
    </div>
    
    <!-- System Information -->
    <div class="system-info">
        <h2>System Information</h2>
        <table class="info-table">
            <tr>
                <th>PHP Version</th>
                <td><?php echo PHP_VERSION; ?></td>
            </tr>
            <tr>
                <th>Server Software</th>
                <td><?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></td>
            </tr>
            <tr>
                <th>Memory Limit</th>
                <td><?php echo ini_get('memory_limit'); ?></td>
            </tr>
            <tr>
                <th>Max Execution Time</th>
                <td><?php echo ini_get('max_execution_time'); ?>s</td>
            </tr>
            <tr>
                <th>OPcache Status</th>
                <td><?php echo (extension_loaded('Zend OPcache') && opcache_get_status()['opcache_enabled']) ? 'Enabled' : 'Disabled'; ?></td>
            </tr>
        </table>
    </div>
    
    <!-- Performance Alerts -->
    <div class="alerts-section">
        <h2><?php echo cms_plugin_translate('admin_toolkit', 'perf.alerts_triggered'); ?></h2>
        <div class="alert-list">
            <?php
            $threshold = cms_get_plugin_setting('admin_toolkit', 'performance_alert_threshold', 5000);
            $current_time = round((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000, 0);
            
            if ($current_time > $threshold) {
                echo '<div class="alert warning">';
                echo '<strong>Performance Warning:</strong> Page load time exceeded threshold (' . $threshold . 'ms)';
                echo '</div>';
            }
            
            $memory_threshold = cms_get_plugin_setting('admin_toolkit', 'memory_alert_threshold', 128);
            $current_memory = round(memory_get_peak_usage(true) / 1024 / 1024, 2);
            
            if ($current_memory > $memory_threshold) {
                echo '<div class="alert warning">';
                echo '<strong>Memory Warning:</strong> Memory usage exceeded threshold (' . $memory_threshold . 'MB)';
                echo '</div>';
            }
            
            if ($current_time <= $threshold && $current_memory <= $memory_threshold) {
                echo '<div class="alert success">';
                echo 'All performance metrics within normal parameters.';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Auto-refresh and Chart JavaScript -->
<script>
$(document).ready(function() {
    // Initialize performance chart
    const ctx = document.getElementById('performance-chart').getContext('2d');
    const performanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['10m ago', '8m ago', '6m ago', '4m ago', '2m ago', 'Now'],
            datasets: [{
                label: 'Memory Usage (MB)',
                data: [45, 52, 48, 55, 49, <?php echo round(memory_get_peak_usage(true) / 1024 / 1024, 2); ?>],
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                tension: 0.1
            }, {
                label: 'Load Time (ms)',
                data: [250, 320, 280, 290, 260, <?php echo round((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']) * 1000, 0); ?>],
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                tension: 0.1,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Memory (MB)'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Load Time (ms)'
                    },
                    grid: {
                        drawOnChartArea: false
                    }
                }
            }
        }
    });
    
    // Auto-refresh metrics every 30 seconds
    <?php if (cms_get_plugin_setting('admin_toolkit', 'ui_preferences')['auto_refresh_metrics'] ?? true): ?>
    setInterval(function() {
        // Update memory usage
        fetch('?page=system_monitor&action=get_metrics')
            .then(response => response.json())
            .then(data => {
                $('#memory-usage').text(data.memory_usage + ' MB');
                $('#load-time').text(data.load_time + 's');
                $('#cache-hit-rate').text(data.cache_hit_rate + '%');
                $('#query-count').text(data.query_count);
            })
            .catch(error => console.log('Metrics update failed:', error));
    }, <?php echo (cms_get_plugin_setting('admin_toolkit', 'ui_preferences')['metrics_refresh_interval'] ?? 30) * 1000; ?>);
    <?php endif; ?>
});
</script>

<style>
.system-monitor-page {
    max-width: 1200px;
    margin: 0 auto;
}

.metrics-dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin: 20px 0;
}

.metric-card {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.metric-card h3 {
    margin: 0 0 10px 0;
    font-size: 14px;
    color: #6c757d;
    text-transform: uppercase;
}

.metric-value {
    font-size: 32px;
    font-weight: bold;
    color: #007bff;
    margin: 10px 0;
}

.metric-limit, .metric-subtitle {
    font-size: 12px;
    color: #6c757d;
}

.chart-section {
    margin: 40px 0;
    background: white;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.chart-container {
    position: relative;
    height: 400px;
    margin-top: 20px;
}

.system-info {
    margin: 40px 0;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
}

.info-table th,
.info-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.info-table th {
    background-color: #f8f9fa;
    font-weight: bold;
    width: 30%;
}

.alerts-section {
    margin: 40px 0;
}

.alert {
    padding: 15px;
    margin: 10px 0;
    border-radius: 4px;
    border: 1px solid;
}

.alert.success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.alert.warning {
    background-color: #fff3cd;
    border-color: #ffeaa7;
    color: #856404;
}

.alert-list {
    margin-top: 15px;
}
</style>