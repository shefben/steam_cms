<?php
/**
 * Theme Enhancement Plugin - Example Plugin #2
 * =============================================
 * 
 * This plugin demonstrates the theme and UI enhancement capabilities of the
 * SteamCMS Plugin API. It showcases:
 * - Theme asset overrides and dynamic CSS/JS injection
 * - Dashboard widget system with AJAX functionality
 * - Admin notification system with custom types
 * - Dynamic template block positioning
 * - Asset management with conditional loading
 * - Cache management for performance optimization
 * 
 * This plugin provides advanced theming capabilities, custom widgets,
 * and enhanced user interface elements across different Steam themes.
 */

declare(strict_types=1);

// ============================================================================
// THEME ASSET OVERRIDE SYSTEM DEMONSTRATION
// ============================================================================

/**
 * Register CSS asset override for 2005 Steam theme
 * Asset overrides allow plugins to replace theme-specific CSS files
 * with enhanced versions that provide additional functionality or
 * improved styling while maintaining theme compatibility.
 */
cms_register_asset_override(
    'theme_enhancer',                    // Plugin identifier for tracking
    '2005_v1',                          // Target theme variant
    'css',                              // Asset type (css, js, image)
    'styles/main.css',                  // Original asset path to override
    'plugins/theme_enhancer/assets/2005_enhanced.css'  // Plugin's replacement asset
);

/**
 * Register JavaScript asset override for enhanced functionality
 * This demonstrates overriding JavaScript files to add new features
 * like advanced navigation, AJAX loading, or enhanced user interactions
 * while preserving the original theme's visual design.
 */
cms_register_asset_override(
    'theme_enhancer',
    '2005_v1',
    'js',
    'scripts/navigation.js',            // Original navigation script
    'plugins/theme_enhancer/assets/enhanced_navigation.js'  // Enhanced version with extra features
);

/**
 * Register image asset override for high-resolution icons
 * Asset overrides can also replace images, allowing plugins to provide
 * higher resolution icons, updated graphics, or theme-specific imagery
 * that enhances the visual experience.
 */
cms_register_asset_override(
    'theme_enhancer',
    '2006_v1',                          // Different theme for demonstration
    'image',
    'images/logo.png',                  // Original logo image
    'plugins/theme_enhancer/assets/hd_logo.png'  // High-resolution replacement
);

/**
 * Register asset override for Steam button graphics
 * This shows how plugins can enhance multiple themes with improved
 * button graphics while maintaining the authentic Steam aesthetic.
 */
cms_register_asset_override(
    'theme_enhancer',
    '2006_v1',
    'image',
    'images/buttons/download.png',      // Original download button
    'plugins/theme_enhancer/assets/buttons/enhanced_download.png'  // Enhanced button with better graphics
);

// ============================================================================
// DYNAMIC CSS/JS INJECTION SYSTEM
// ============================================================================

/**
 * Register dynamic CSS for admin interface enhancements
 * Dynamic CSS injection allows plugins to add styling that adapts
 * to different contexts, themes, and user preferences without
 * requiring theme file modifications.
 */
cms_register_dynamic_asset(
    'theme_enhancer',           // Plugin identifier
    'css',                      // Asset type
    '.theme-enhanced { 
        animation: enhance-fade-in 0.3s ease-in-out; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 4px;
    }
    @keyframes enhance-fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .enhanced-notification {
        background: linear-gradient(135deg, #4c5844, #5a6a50);
        border: 1px solid #899281;
        color: #c4b550;
        padding: 12px;
        margin: 8px 0;
        border-radius: 4px;
        animation: slide-in-right 0.5s ease-out;
    }
    @keyframes slide-in-right {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }',                         // CSS content to inject
    [                          // Conditional loading parameters
        'user_permission' => 'manage_themes',  // Only load for users with theme management permission
        'page' => ['admin_dashboard', 'theme_manager']  // Only on specific admin pages
    ],
    'admin'                    // Location: admin interface only
);

/**
 * Register dynamic JavaScript for enhanced user interactions
 * This demonstrates injecting JavaScript that provides enhanced
 * functionality like smooth scrolling, advanced tooltips, and
 * improved form validation.
 */
cms_register_dynamic_asset(
    'theme_enhancer',
    'js',
    'function initThemeEnhancements() {
        // Add smooth scrolling to all anchor links
        document.querySelectorAll(\'a[href^="#"]\').forEach(anchor => {
            anchor.addEventListener(\'click\', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute(\'href\'));
                if (target) {
                    target.scrollIntoView({ behavior: \'smooth\', block: \'start\' });
                }
            });
        });
        
        // Enhanced tooltips for theme elements
        document.querySelectorAll(\'[data-tooltip]\').forEach(element => {
            element.addEventListener(\'mouseenter\', function() {
                const tooltip = document.createElement(\'div\');
                tooltip.className = \'enhanced-tooltip\';
                tooltip.textContent = this.getAttribute(\'data-tooltip\');
                document.body.appendChild(tooltip);
                
                const rect = this.getBoundingClientRect();
                tooltip.style.left = rect.left + \'px\';
                tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + \'px\';
            });
            
            element.addEventListener(\'mouseleave\', function() {
                document.querySelectorAll(\'.enhanced-tooltip\').forEach(t => t.remove());
            });
        });
        
        // Theme transition effects
        document.body.classList.add(\'theme-enhanced\');
    }
    
    // Initialize when DOM is ready
    if (document.readyState === \'loading\') {
        document.addEventListener(\'DOMContentLoaded\', initThemeEnhancements);
    } else {
        initThemeEnhancements();
    }',
    [
        'theme' => ['2005_v1', '2006_v1', '2007_v1']  // Only load for specific themes
    ],
    'both'  // Load on both admin and frontend
);

/**
 * Register theme-specific CSS enhancements for 2007 theme
 * This demonstrates how plugins can provide theme-specific
 * enhancements that only activate when certain themes are in use.
 */
cms_register_dynamic_asset(
    'theme_enhancer',
    'css',
    '.steam-2007-enhanced .window {
        background: linear-gradient(145deg, #4c5844, #3e4637);
        border: 2px solid #899281;
        box-shadow: inset 2px 2px 4px rgba(137, 146, 129, 0.3);
    }
    .steam-2007-enhanced .button {
        background: linear-gradient(145deg, #5a6a50, #4c5844);
        transition: all 0.2s ease;
    }
    .steam-2007-enhanced .button:hover {
        background: linear-gradient(145deg, #6a7a60, #5c6854);
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }',
    [
        'theme' => ['2007_v1']  // Only load for 2007 theme
    ],
    'frontend'
);

// ============================================================================
// DASHBOARD WIDGET SYSTEM DEMONSTRATION
// ============================================================================

/**
 * Register theme statistics dashboard widget
 * Dashboard widgets provide administrators with quick access to important
 * information and metrics. This widget shows theme usage statistics
 * and provides insights into user preferences.
 */
cms_register_dashboard_widget(
    'theme_enhancer',           // Plugin identifier
    'theme_statistics',         // Widget identifier
    [
        'title' => 'Theme Usage Statistics',
        'description' => 'Overview of theme popularity and usage patterns across the site',
        'icon' => 'chart-bar',
        'priority' => 10,       // Display priority (higher = more prominent)
        'refresh_interval' => 300,  // Auto-refresh every 5 minutes (300 seconds)
        'permissions' => ['view_analytics', 'manage_themes'],  // Required permissions
        'size' => 'medium',     // Widget size: small, medium, large
        'position' => 'main',   // Preferred dashboard position
        'renderer' => function($config) {  // Function that generates widget HTML
            // Get theme usage data (would normally query database)
            $theme_stats = [
                '2005_v1' => ['users' => 245, 'percentage' => 35],
                '2006_v1' => ['users' => 189, 'percentage' => 27],
                '2007_v1' => ['users' => 156, 'percentage' => 22],
                '2008_v1' => ['users' => 112, 'percentage' => 16]
            ];
            
            $total_users = array_sum(array_column($theme_stats, 'users'));
            
            $output = '<div class="theme-stats-widget">';
            $output .= '<div class="widget-header">';
            $output .= '<h4>Active Theme Distribution</h4>';
            $output .= '<span class="total-users">Total Users: ' . $total_users . '</span>';
            $output .= '</div>';
            
            $output .= '<div class="stats-chart">';
            foreach ($theme_stats as $theme => $stats) {
                $output .= '<div class="stat-bar">';
                $output .= '<div class="stat-label">' . $theme . '</div>';
                $output .= '<div class="stat-progress">';
                $output .= '<div class="stat-fill" style="width: ' . $stats['percentage'] . '%"></div>';
                $output .= '</div>';
                $output .= '<div class="stat-value">' . $stats['users'] . ' (' . $stats['percentage'] . '%)</div>';
                $output .= '</div>';
            }
            $output .= '</div>';
            
            $output .= '<div class="widget-actions">';
            $output .= '<a href="admin.php?page=theme_analytics" class="btn-link">View Detailed Analytics</a>';
            $output .= '</div>';
            
            $output .= '</div>';
            return $output;
        }
    ]
);

/**
 * Register asset optimization dashboard widget
 * This widget provides information about asset loading performance
 * and shows how the plugin's asset optimizations are improving
 * site speed and user experience.
 */
cms_register_dashboard_widget(
    'theme_enhancer',
    'asset_optimization',
    [
        'title' => 'Asset Optimization Status',
        'description' => 'Monitor asset loading performance and optimization effectiveness',
        'icon' => 'speedometer',
        'priority' => 8,
        'refresh_interval' => 600,  // Refresh every 10 minutes
        'permissions' => ['manage_performance'],
        'size' => 'small',
        'position' => 'sidebar',
        'renderer' => function($config) {
            // Get asset optimization metrics
            $metrics = [
                'css_files_optimized' => 15,
                'js_files_optimized' => 12,
                'images_optimized' => 48,
                'total_size_saved' => '2.3 MB',
                'load_time_improvement' => '34%'
            ];
            
            $output = '<div class="asset-optimization-widget">';
            $output .= '<div class="optimization-summary">';
            $output .= '<div class="metric">';
            $output .= '<span class="metric-value">' . $metrics['total_size_saved'] . '</span>';
            $output .= '<span class="metric-label">Size Saved</span>';
            $output .= '</div>';
            $output .= '<div class="metric">';
            $output .= '<span class="metric-value">' . $metrics['load_time_improvement'] . '</span>';
            $output .= '<span class="metric-label">Faster Loading</span>';
            $output .= '</div>';
            $output .= '</div>';
            
            $output .= '<div class="optimization-details">';
            $output .= '<ul>';
            $output .= '<li>' . $metrics['css_files_optimized'] . ' CSS files optimized</li>';
            $output .= '<li>' . $metrics['js_files_optimized'] . ' JS files optimized</li>';
            $output .= '<li>' . $metrics['images_optimized'] . ' images compressed</li>';
            $output .= '</ul>';
            $output .= '</div>';
            
            $output .= '<div class="widget-status">';
            $output .= '<span class="status-indicator status-good">All Systems Optimal</span>';
            $output .= '</div>';
            
            $output .= '</div>';
            return $output;
        }
    ]
);

/**
 * Register theme compatibility dashboard widget
 * This widget helps administrators understand theme compatibility
 * issues and provides quick access to resolution tools.
 */
cms_register_dashboard_widget(
    'theme_enhancer',
    'theme_compatibility',
    [
        'title' => 'Theme Compatibility Check',
        'description' => 'Monitor theme compatibility and potential issues across different Steam theme versions',
        'icon' => 'check-circle',
        'priority' => 6,
        'refresh_interval' => 1800,  // Refresh every 30 minutes
        'permissions' => ['manage_themes'],
        'size' => 'large',
        'position' => 'main',
        'renderer' => function($config) {
            // Check theme compatibility status
            $compatibility_checks = [
                '2005_v1' => ['status' => 'excellent', 'issues' => 0, 'optimizations' => 5],
                '2006_v1' => ['status' => 'good', 'issues' => 1, 'optimizations' => 3],
                '2007_v1' => ['status' => 'excellent', 'issues' => 0, 'optimizations' => 4],
                '2008_v1' => ['status' => 'warning', 'issues' => 2, 'optimizations' => 1]
            ];
            
            $output = '<div class="theme-compatibility-widget">';
            $output .= '<div class="compatibility-overview">';
            
            foreach ($compatibility_checks as $theme => $check) {
                $status_class = 'status-' . $check['status'];
                $output .= '<div class="compatibility-item ' . $status_class . '">';
                $output .= '<div class="theme-name">' . $theme . '</div>';
                $output .= '<div class="status-indicator">';
                
                switch ($check['status']) {
                    case 'excellent':
                        $output .= '<span class="icon">✓</span> Excellent';
                        break;
                    case 'good':
                        $output .= '<span class="icon">○</span> Good';
                        break;
                    case 'warning':
                        $output .= '<span class="icon">⚠</span> Needs Attention';
                        break;
                }
                
                $output .= '</div>';
                $output .= '<div class="compatibility-details">';
                $output .= '<span class="issues">' . $check['issues'] . ' issues</span>';
                $output .= '<span class="optimizations">' . $check['optimizations'] . ' optimizations active</span>';
                $output .= '</div>';
                $output .= '</div>';
            }
            
            $output .= '</div>';
            
            $output .= '<div class="widget-actions">';
            $output .= '<a href="admin.php?page=theme_compatibility" class="btn">Run Full Compatibility Scan</a>';
            $output .= '<a href="admin.php?page=optimization_tools" class="btn btn-secondary">Optimization Tools</a>';
            $output .= '</div>';
            
            $output .= '</div>';
            return $output;
        }
    ]
);

// ============================================================================
// ADMIN NOTIFICATION SYSTEM DEMONSTRATION
// ============================================================================

/**
 * Register theme update notification type
 * Custom notification types allow plugins to create specific categories
 * of notifications with their own styling, behavior, and handling.
 * This helps organize different types of administrative alerts.
 */
cms_register_notification_type(
    'theme_enhancer',           // Plugin identifier
    'theme_update',             // Notification type slug
    [
        'label' => 'Theme Update',
        'description' => 'Notifications about theme updates, compatibility changes, and new features',
        'icon' => 'palette',
        'color' => '#4c5844',   // Notification color theme
        'priority' => 'medium', // Priority level: low, medium, high, critical
        'auto_dismiss' => false, // Whether notifications auto-dismiss
        'sound_alert' => false,  // Whether to play sound
        'email_notify' => true,  // Whether to send email notifications
        'channels' => ['dashboard', 'sidebar', 'email'],  // Where to show notifications
        'template' => 'theme_update_notification.twig',   // Custom template for rendering
        'actions' => [          // Available actions for this notification type
            'view_details' => [
                'label' => 'View Details',
                'icon' => 'eye',
                'url_pattern' => 'admin.php?page=theme_details&id={theme_id}'
            ],
            'apply_update' => [
                'label' => 'Apply Update',
                'icon' => 'download',
                'action' => 'apply_theme_update',
                'confirm' => true
            ],
            'dismiss' => [
                'label' => 'Dismiss',
                'icon' => 'times',
                'action' => 'dismiss_notification'
            ]
        ]
    ]
);

/**
 * Register performance alert notification type
 * This demonstrates creating notifications for performance monitoring
 * and alerting administrators to potential issues or optimization
 * opportunities.
 */
cms_register_notification_type(
    'theme_enhancer',
    'performance_alert',
    [
        'label' => 'Performance Alert',
        'description' => 'Alerts about theme performance issues, slow loading assets, and optimization opportunities',
        'icon' => 'speedometer',
        'color' => '#c4b550',
        'priority' => 'high',
        'auto_dismiss' => false,
        'sound_alert' => true,   // High priority alerts get sound notification
        'email_notify' => true,
        'channels' => ['dashboard', 'popup', 'email'],
        'template' => 'performance_alert_notification.twig',
        'actions' => [
            'view_metrics' => [
                'label' => 'View Performance Metrics',
                'icon' => 'chart-line',
                'url_pattern' => 'admin.php?page=performance_metrics'
            ],
            'run_optimization' => [
                'label' => 'Run Optimization',
                'icon' => 'magic',
                'action' => 'run_asset_optimization',
                'confirm' => true,
                'confirm_message' => 'This will optimize assets and may temporarily affect site performance. Continue?'
            ],
            'schedule_maintenance' => [
                'label' => 'Schedule Maintenance',
                'icon' => 'calendar',
                'url_pattern' => 'admin.php?page=maintenance_scheduler'
            ]
        ]
    ]
);

/**
 * Register compatibility warning notification type
 * This notification type handles warnings about theme compatibility
 * issues, deprecated features, and migration requirements.
 */
cms_register_notification_type(
    'theme_enhancer',
    'compatibility_warning',
    [
        'label' => 'Compatibility Warning',
        'description' => 'Warnings about theme compatibility issues and required updates',
        'icon' => 'exclamation-triangle',
        'color' => '#e74c3c',   // Red color for warnings
        'priority' => 'high',
        'auto_dismiss' => false,
        'sound_alert' => false,
        'email_notify' => false, // Don't email for warnings, just dashboard display
        'channels' => ['dashboard', 'sidebar'],
        'template' => 'compatibility_warning_notification.twig',
        'actions' => [
            'view_compatibility_report' => [
                'label' => 'View Full Report',
                'icon' => 'file-text',
                'url_pattern' => 'admin.php?page=compatibility_report&theme={theme_id}'
            ],
            'fix_automatically' => [
                'label' => 'Auto-Fix Issues',
                'icon' => 'wrench',
                'action' => 'auto_fix_compatibility',
                'confirm' => true,
                'confirm_message' => 'This will automatically fix known compatibility issues. Backup recommended.'
            ],
            'ignore_warning' => [
                'label' => 'Ignore This Warning',
                'icon' => 'times-circle',
                'action' => 'ignore_compatibility_warning'
            ]
        ]
    ]
);

// ============================================================================
// CACHE MANAGEMENT DEMONSTRATION
// ============================================================================

/**
 * Register theme assets cache namespace
 * Cache namespaces allow plugins to organize their cached data
 * and provide efficient invalidation strategies for different
 * types of cached content.
 */
cms_register_cache_namespace(
    'theme_enhancer',           // Plugin identifier
    'theme_assets',             // Cache namespace
    [
        'description' => 'Cached theme asset information and optimization data',
        'default_ttl' => 3600,  // Default time-to-live: 1 hour
        'max_size' => '50MB',   // Maximum cache size for this namespace
        'auto_cleanup' => true, // Automatically clean expired entries
        'compression' => true,  // Compress cached data to save space
        'tags' => ['assets', 'themes', 'optimization']  // Tags for cache organization
    ]
);

/**
 * Register theme compatibility cache namespace
 * This cache stores compatibility check results to avoid
 * repeating expensive compatibility analysis operations.
 */
cms_register_cache_namespace(
    'theme_enhancer',
    'compatibility_checks',
    [
        'description' => 'Theme compatibility analysis results and recommendations',
        'default_ttl' => 7200,  // 2 hours - compatibility doesn\'t change often
        'max_size' => '10MB',
        'auto_cleanup' => true,
        'compression' => true,
        'tags' => ['compatibility', 'analysis', 'themes']
    ]
);

/**
 * Register performance metrics cache namespace
 * Performance metrics are cached to provide fast dashboard
 * updates without repeatedly calculating expensive statistics.
 */
cms_register_cache_namespace(
    'theme_enhancer',
    'performance_metrics',
    [
        'description' => 'Performance monitoring data and analytics',
        'default_ttl' => 1800,  // 30 minutes - performance data changes frequently
        'max_size' => '25MB',
        'auto_cleanup' => true,
        'compression' => true,
        'tags' => ['performance', 'metrics', 'monitoring']
    ]
);

// ============================================================================
// PLUGIN SETTINGS CONFIGURATION
// ============================================================================

/**
 * Register comprehensive plugin settings for theme enhancement features
 * These settings control various aspects of the plugin's behavior
 * and allow administrators to customize the enhancement features.
 */
cms_register_plugin_settings('theme_enhancer', [
    // Master enable/disable switch
    'enabled' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Theme Enhancements',
        'description' => 'Master switch to enable or disable all theme enhancement features'
    ],
    
    // Asset optimization settings
    'optimize_assets' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Asset Optimization',
        'description' => 'Automatically optimize CSS, JS, and image assets for better performance'
    ],
    
    'optimization_level' => [
        'type' => 'string',
        'default' => 'moderate',
        'label' => 'Optimization Level',
        'description' => 'Level of asset optimization to apply (conservative, moderate, aggressive)'
    ],
    
    // Widget configuration
    'dashboard_widgets_enabled' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Dashboard Widgets',
        'description' => 'Show theme-related widgets on the admin dashboard'
    ],
    
    'widget_refresh_interval' => [
        'type' => 'int',
        'default' => 300,
        'label' => 'Widget Refresh Interval (seconds)',
        'description' => 'How often dashboard widgets should automatically refresh their data'
    ],
    
    // Notification settings
    'notifications_enabled' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Theme Notifications',
        'description' => 'Show notifications about theme updates, performance issues, and compatibility warnings'
    ],
    
    'notification_channels' => [
        'type' => 'array',
        'default' => ['dashboard', 'sidebar'],
        'label' => 'Notification Channels',
        'description' => 'Where to display notifications (dashboard, sidebar, email, popup)'
    ],
    
    // Advanced theming options
    'theme_transition_effects' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Theme Transition Effects',
        'description' => 'Add smooth transition animations when switching between themes'
    ],
    
    'custom_css_injection' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Custom CSS Injection',
        'description' => 'Allow dynamic injection of custom CSS for enhanced styling'
    ],
    
    // Performance monitoring
    'performance_monitoring' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Performance Monitoring',
        'description' => 'Monitor theme performance and asset loading times'
    ],
    
    'performance_alert_threshold' => [
        'type' => 'int',
        'default' => 3000,
        'label' => 'Performance Alert Threshold (ms)',
        'description' => 'Send performance alerts when page load times exceed this threshold'
    ],
    
    // Cache configuration
    'cache_enabled' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Theme Caching',
        'description' => 'Cache theme assets and compatibility data for better performance'
    ],
    
    'cache_duration' => [
        'type' => 'int',
        'default' => 3600,
        'label' => 'Default Cache Duration (seconds)',
        'description' => 'How long to cache theme data before checking for updates'
    ],
    
    // Advanced configuration as JSON
    'advanced_config' => [
        'type' => 'json',
        'default' => [
            'asset_bundling' => true,
            'css_minification' => true,
            'js_minification' => true,
            'image_compression' => true,
            'lazy_loading' => true,
            'critical_css_inline' => false,
            'prefetch_assets' => true,
            'service_worker_cache' => false
        ],
        'label' => 'Advanced Configuration',
        'description' => 'Advanced settings for asset optimization and performance tuning'
    ]
]);

// ============================================================================
// ADMIN PAGE REGISTRATION
// ============================================================================

/**
 * Register main theme enhancement admin page
 * This provides a central control panel for all theme enhancement
 * features, showing status information and providing quick access
 * to configuration options.
 */
cms_register_admin_page(
    'theme_enhancer_dashboard',
    'Theme Enhancements',
    function() {
        echo '<div class="theme-enhancer-dashboard">';
        echo '<h1>Theme Enhancement Dashboard</h1>';
        
        // Plugin status overview
        $enabled = cms_get_plugin_setting('theme_enhancer', 'enabled', true);
        $status_class = $enabled ? 'status-active' : 'status-inactive';
        
        echo '<div class="status-overview ' . $status_class . '">';
        echo '<h2>Plugin Status</h2>';
        echo '<p>Theme enhancements are currently ' . ($enabled ? 'ACTIVE' : 'INACTIVE') . '</p>';
        
        if ($enabled) {
            $optimization = cms_get_plugin_setting('theme_enhancer', 'optimize_assets', true);
            $widgets = cms_get_plugin_setting('theme_enhancer', 'dashboard_widgets_enabled', true);
            $notifications = cms_get_plugin_setting('theme_enhancer', 'notifications_enabled', true);
            
            echo '<ul class="feature-status">';
            echo '<li>Asset Optimization: ' . ($optimization ? 'Enabled' : 'Disabled') . '</li>';
            echo '<li>Dashboard Widgets: ' . ($widgets ? 'Enabled' : 'Disabled') . '</li>';
            echo '<li>Notifications: ' . ($notifications ? 'Enabled' : 'Disabled') . '</li>';
            echo '</ul>';
        }
        echo '</div>';
        
        // Quick statistics
        echo '<div class="quick-stats">';
        echo '<div class="stat-card">';
        echo '<h3>15</h3>';
        echo '<p>Assets Optimized</p>';
        echo '</div>';
        echo '<div class="stat-card">';
        echo '<h3>3</h3>';
        echo '<p>Active Widgets</p>';
        echo '</div>';
        echo '<div class="stat-card">';
        echo '<h3>2.3MB</h3>';
        echo '<p>Size Saved</p>';
        echo '</div>';
        echo '</div>';
        
        // Quick action buttons
        echo '<div class="quick-actions">';
        echo '<a href="?page=asset_optimization" class="btn">Asset Optimization</a>';
        echo '<a href="?page=theme_compatibility" class="btn">Compatibility Check</a>';
        echo '<a href="?page=performance_metrics" class="btn">Performance Metrics</a>';
        echo '</div>';
        
        echo '</div>';
    }
);

/**
 * Register asset optimization admin page
 * This page provides detailed controls for asset optimization
 * features and shows the impact of optimizations on site performance.
 */
cms_register_admin_page(
    'asset_optimization',
    'Asset Optimization',
    function() {
        echo '<div class="asset-optimization-page">';
        echo '<h1>Asset Optimization</h1>';
        
        // Current optimization status
        $optimization_level = cms_get_plugin_setting('theme_enhancer', 'optimization_level', 'moderate');
        $advanced_config = cms_get_plugin_setting('theme_enhancer', 'advanced_config', []);
        
        echo '<div class="optimization-status">';
        echo '<h2>Current Optimization Level: ' . ucfirst($optimization_level) . '</h2>';
        
        echo '<div class="optimization-features">';
        $features = [
            'css_minification' => 'CSS Minification',
            'js_minification' => 'JavaScript Minification', 
            'image_compression' => 'Image Compression',
            'asset_bundling' => 'Asset Bundling',
            'lazy_loading' => 'Lazy Loading'
        ];
        
        foreach ($features as $key => $label) {
            $enabled = $advanced_config[$key] ?? false;
            $status = $enabled ? 'enabled' : 'disabled';
            echo '<div class="feature-item ' . $status . '">';
            echo '<span class="feature-name">' . $label . '</span>';
            echo '<span class="feature-status">' . ucfirst($status) . '</span>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        
        // Optimization results
        echo '<div class="optimization-results">';
        echo '<h2>Optimization Results</h2>';
        echo '<table class="results-table">';
        echo '<thead>';
        echo '<tr><th>Asset Type</th><th>Files Processed</th><th>Size Before</th><th>Size After</th><th>Savings</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        echo '<tr><td>CSS Files</td><td>15</td><td>245 KB</td><td>178 KB</td><td>67 KB (27%)</td></tr>';
        echo '<tr><td>JavaScript Files</td><td>12</td><td>398 KB</td><td>287 KB</td><td>111 KB (28%)</td></tr>';
        echo '<tr><td>Images</td><td>48</td><td>2.1 MB</td><td>1.4 MB</td><td>700 KB (33%)</td></tr>';
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        
        echo '</div>';
    },
    'theme_enhancer_dashboard'  // Parent page
);

// ============================================================================
// SIDEBAR NAVIGATION LINKS
// ============================================================================

/**
 * Register sidebar links for quick access to plugin features
 * These provide convenient navigation to different areas of the
 * theme enhancement functionality.
 */
cms_register_sidebar_link(
    'theme_compatibility_check',
    'Theme Compatibility',
    'plugin.php?page=theme_compatibility_check',
    'theme_enhancer_dashboard'
);

cms_register_sidebar_link(
    'performance_metrics',
    'Performance Metrics',
    'plugin.php?page=performance_metrics',
    'theme_enhancer_dashboard'
);

cms_register_sidebar_link(
    'asset_manager',
    'Asset Manager',
    'plugin.php?page=asset_manager',
    'theme_enhancer_dashboard'
);

// ============================================================================
// TEMPLATE TAG REGISTRATION
// ============================================================================

/**
 * Register template tag for enhanced theme assets
 * This tag allows themes to easily include optimized assets
 * with automatic fallback to original assets if optimization fails.
 */
cms_register_template_tag(
    'enhanced_asset',
    function($asset_path, $type = 'auto', $theme = null) {
        // Auto-detect asset type if not specified
        if ($type === 'auto') {
            $extension = pathinfo($asset_path, PATHINFO_EXTENSION);
            $type = match($extension) {
                'css' => 'css',
                'js' => 'js',
                'png', 'jpg', 'jpeg', 'gif', 'webp' => 'image',
                default => 'unknown'
            };
        }
        
        // Get current theme if not specified
        if (!$theme) {
            $theme = cms_get_setting('current_theme', '2005_v1');
        }
        
        // Check for asset override
        $optimized_path = cms_get_asset_path($theme, $type, $asset_path);
        
        // Generate appropriate HTML tag based on asset type
        switch ($type) {
            case 'css':
                return '<link rel="stylesheet" type="text/css" href="' . htmlspecialchars($optimized_path) . '" data-optimized="true">';
                
            case 'js':
                return '<script src="' . htmlspecialchars($optimized_path) . '" data-optimized="true"></script>';
                
            case 'image':
                return '<img src="' . htmlspecialchars($optimized_path) . '" alt="" data-optimized="true">';
                
            default:
                return '<!-- Unknown asset type: ' . htmlspecialchars($type) . ' -->';
        }
    }
);

/**
 * Register template tag for performance metrics display
 * This allows themes to show performance information to users
 * or administrators, helping with debugging and optimization.
 */
cms_register_template_tag(
    'performance_info',
    function($show_details = false, $cache_key = null) {
        // Get performance metrics from cache
        if ($cache_key) {
            $metrics = cms_get_plugin_cache('performance_metrics', $cache_key);
        }
        
        // Default metrics if cache miss
        if (!$metrics) {
            $metrics = [
                'page_load_time' => round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3),
                'memory_usage' => memory_get_peak_usage(true),
                'queries_executed' => rand(8, 25),  // Would normally get from DB profiler
                'cache_hits' => rand(15, 40),
                'cache_misses' => rand(2, 8)
            ];
            
            // Cache the metrics if cache key provided
            if ($cache_key) {
                cms_set_plugin_cache('performance_metrics', $cache_key, $metrics, 300);
            }
        }
        
        $output = '<div class="performance-info" data-show-details="' . ($show_details ? 'true' : 'false') . '">';
        
        if ($show_details) {
            $output .= '<div class="performance-details">';
            $output .= '<div class="metric">Page Load: ' . $metrics['page_load_time'] . 's</div>';
            $output .= '<div class="metric">Memory: ' . round($metrics['memory_usage'] / 1024 / 1024, 2) . ' MB</div>';
            $output .= '<div class="metric">DB Queries: ' . $metrics['queries_executed'] . '</div>';
            $output .= '<div class="metric">Cache: ' . $metrics['cache_hits'] . ' hits / ' . $metrics['cache_misses'] . ' misses</div>';
            $output .= '</div>';
        } else {
            $output .= '<div class="performance-summary">';
            $output .= 'Load: ' . $metrics['page_load_time'] . 's | ';
            $output .= 'Memory: ' . round($metrics['memory_usage'] / 1024 / 1024, 2) . 'MB';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }
);

// ============================================================================
// EVENT HOOKS FOR INTEGRATION
// ============================================================================

/**
 * Hook into theme switching events
 * When themes are changed, clear relevant caches and send notifications
 * about any compatibility issues with the new theme.
 */
cms_add_hook('theme_switched', function($theme_data) {
    $new_theme = $theme_data['new_theme'] ?? 'unknown';
    $old_theme = $theme_data['old_theme'] ?? 'unknown';
    
    // Clear theme-related caches
    cms_clear_plugin_cache('theme_assets');
    cms_clear_plugin_cache('compatibility_checks');
    
    // Send notification about theme switch
    cms_send_plugin_notification(
        'theme_update',
        "Theme switched from {$old_theme} to {$new_theme}. Compatibility check recommended.",
        null,  // Send to all admins
        [
            'old_theme' => $old_theme,
            'new_theme' => $new_theme,
            'timestamp' => time(),
            'action_required' => false
        ]
    );
    
    // Check compatibility with new theme
    $compatibility_issues = 0;  // Would normally run actual compatibility check
    if ($compatibility_issues > 0) {
        cms_send_plugin_notification(
            'compatibility_warning',
            "Found {$compatibility_issues} compatibility issues with theme {$new_theme}. Review recommended.",
            null,
            [
                'theme' => $new_theme,
                'issues_count' => $compatibility_issues,
                'severity' => 'medium'
            ]
        );
    }
    
    return $theme_data;
});

/**
 * Hook into asset loading events
 * Monitor asset loading performance and send alerts if loading
 * times exceed configured thresholds.
 */
cms_add_hook('asset_loaded', function($asset_data) {
    $load_time = $asset_data['load_time'] ?? 0;
    $asset_path = $asset_data['path'] ?? 'unknown';
    $threshold = cms_get_plugin_setting('theme_enhancer', 'performance_alert_threshold', 3000);
    
    // Convert threshold from milliseconds to seconds
    $threshold_seconds = $threshold / 1000;
    
    if ($load_time > $threshold_seconds) {
        cms_send_plugin_notification(
            'performance_alert',
            "Slow asset loading detected: {$asset_path} took {$load_time}s to load (threshold: {$threshold_seconds}s)",
            null,
            [
                'asset_path' => $asset_path,
                'load_time' => $load_time,
                'threshold' => $threshold_seconds,
                'optimization_suggested' => true
            ]
        );
    }
    
    // Cache performance data
    $cache_key = 'asset_performance_' . md5($asset_path);
    $performance_data = [
        'path' => $asset_path,
        'load_time' => $load_time,
        'timestamp' => time(),
        'slow_loading' => $load_time > $threshold_seconds
    ];
    cms_set_plugin_cache('performance_metrics', $cache_key, $performance_data, 1800);
    
    return $asset_data;
});

// ============================================================================
// INITIALIZATION AND CACHE WARMING
// ============================================================================

/**
 * Initialize plugin settings and warm caches
 * Set up default configuration and pre-populate caches with
 * frequently accessed data for better performance.
 */
if (cms_get_plugin_setting('theme_enhancer', 'enabled') === null) {
    // Initialize default settings
    cms_set_plugin_setting('theme_enhancer', 'enabled', true, 'bool');
    cms_set_plugin_setting('theme_enhancer', 'optimize_assets', true, 'bool');
    cms_set_plugin_setting('theme_enhancer', 'optimization_level', 'moderate', 'string');
    cms_set_plugin_setting('theme_enhancer', 'dashboard_widgets_enabled', true, 'bool');
    cms_set_plugin_setting('theme_enhancer', 'widget_refresh_interval', 300, 'int');
    cms_set_plugin_setting('theme_enhancer', 'notifications_enabled', true, 'bool');
    cms_set_plugin_setting('theme_enhancer', 'notification_channels', ['dashboard', 'sidebar'], 'array');
    cms_set_plugin_setting('theme_enhancer', 'performance_monitoring', true, 'bool');
    cms_set_plugin_setting('theme_enhancer', 'performance_alert_threshold', 3000, 'int');
    cms_set_plugin_setting('theme_enhancer', 'cache_enabled', true, 'bool');
    cms_set_plugin_setting('theme_enhancer', 'cache_duration', 3600, 'int');
    
    // Advanced configuration defaults
    $advanced_defaults = [
        'asset_bundling' => true,
        'css_minification' => true,
        'js_minification' => true,
        'image_compression' => true,
        'lazy_loading' => true,
        'critical_css_inline' => false,
        'prefetch_assets' => true,
        'service_worker_cache' => false
    ];
    cms_set_plugin_setting('theme_enhancer', 'advanced_config', $advanced_defaults, 'json');
    
    // Send welcome notification
    cms_send_plugin_notification(
        'theme_update',
        'Theme Enhancement Plugin activated successfully! Dashboard widgets and asset optimization are now active.',
        null,
        [
            'plugin_version' => '1.0.0',
            'features_enabled' => array_keys($advanced_defaults),
            'action_required' => false
        ]
    );
}

/**
 * Warm caches with frequently accessed data
 * Pre-populate caches to improve initial page load performance
 * and reduce database queries for common operations.
 */
if (cms_get_plugin_setting('theme_enhancer', 'cache_enabled', true)) {
    // Cache theme compatibility data
    $themes = ['2005_v1', '2006_v1', '2007_v1', '2008_v1'];
    foreach ($themes as $theme) {
        $cache_key = 'compatibility_' . $theme;
        if (!cms_get_plugin_cache('compatibility_checks', $cache_key)) {
            $compatibility_data = [
                'theme' => $theme,
                'status' => 'excellent',  // Would normally run actual check
                'issues' => 0,
                'optimizations' => rand(3, 7),
                'last_checked' => time()
            ];
            cms_set_plugin_cache('compatibility_checks', $cache_key, $compatibility_data, 7200);
        }
    }
    
    // Cache asset optimization statistics
    $stats_cache_key = 'optimization_stats';
    if (!cms_get_plugin_cache('theme_assets', $stats_cache_key)) {
        $optimization_stats = [
            'css_files_optimized' => 15,
            'js_files_optimized' => 12,
            'images_optimized' => 48,
            'total_size_before' => 2850432,  // bytes
            'total_size_after' => 1945216,   // bytes
            'total_savings' => 905216,       // bytes
            'last_optimization' => time()
        ];
        cms_set_plugin_cache('theme_assets', $stats_cache_key, $optimization_stats, 3600);
    }
}