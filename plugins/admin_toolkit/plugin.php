<?php
/**
 * Admin Toolkit Plugin - Example Plugin #3
 * =========================================
 * 
 * This plugin demonstrates the administrative, security, and development
 * capabilities of the SteamCMS Plugin API. It showcases:
 * - Role-based plugin permissions and security
 * - Development tools and debugging features
 * - Advanced cache management strategies
 * - Plugin scaffolding and code generation
 * - Administrative interface enhancements
 * - Multi-language admin interface support
 * - System monitoring and maintenance tools
 * 
 * This plugin provides comprehensive administrative tools for managing
 * the CMS, debugging issues, and maintaining optimal performance.
 */

declare(strict_types=1);

// ============================================================================
// ROLE-BASED PLUGIN PERMISSIONS DEMONSTRATION
// ============================================================================

/**
 * Register comprehensive permission system for admin toolkit
 * This demonstrates creating granular permissions that control access
 * to different areas of the administrative toolkit. Permissions can
 * be hierarchical and inherited, providing flexible security control.
 */
cms_register_plugin_permissions('admin_toolkit', [
    // Core administrative permissions
    'manage_admin_toolkit' => [
        'label' => 'Manage Admin Toolkit',
        'description' => 'Full access to all admin toolkit features and settings',
        'category' => 'core',
        'inherits' => [],  // Top-level permission
        'default_roles' => ['super_admin'],  // Only super admins get this by default
        'dangerous' => true  // Requires extra confirmation to grant
    ],
    
    // Development and debugging permissions
    'use_development_tools' => [
        'label' => 'Use Development Tools',
        'description' => 'Access to code generation, scaffolding, and development utilities',
        'category' => 'development',
        'inherits' => ['manage_admin_toolkit'],  // Inherits from core permission
        'default_roles' => ['developer', 'super_admin'],
        'dangerous' => false
    ],
    
    'view_debug_information' => [
        'label' => 'View Debug Information',
        'description' => 'Access to debug logs, system diagnostics, and performance metrics',
        'category' => 'debugging',
        'inherits' => ['use_development_tools'],
        'default_roles' => ['developer', 'administrator', 'super_admin'],
        'dangerous' => false
    ],
    
    'modify_debug_settings' => [
        'label' => 'Modify Debug Settings',
        'description' => 'Change debug levels, logging configuration, and diagnostic settings',
        'category' => 'debugging',
        'inherits' => ['view_debug_information'],
        'default_roles' => ['developer', 'super_admin'],
        'dangerous' => true  // Can impact system performance
    ],
    
    // Cache management permissions
    'manage_cache_system' => [
        'label' => 'Manage Cache System',
        'description' => 'Clear caches, modify cache settings, and monitor cache performance',
        'category' => 'performance',
        'inherits' => ['manage_admin_toolkit'],
        'default_roles' => ['administrator', 'super_admin'],
        'dangerous' => false
    ],
    
    'clear_all_caches' => [
        'label' => 'Clear All Caches',
        'description' => 'Nuclear option to clear all system caches (can impact performance)',
        'category' => 'performance',
        'inherits' => ['manage_cache_system'],
        'default_roles' => ['super_admin'],
        'dangerous' => true  // Can significantly impact site performance
    ],
    
    // System monitoring permissions
    'view_system_metrics' => [
        'label' => 'View System Metrics',
        'description' => 'Access to system performance metrics, server statistics, and monitoring data',
        'category' => 'monitoring',
        'inherits' => ['manage_admin_toolkit'],
        'default_roles' => ['administrator', 'super_admin'],
        'dangerous' => false
    ],
    
    'access_system_logs' => [
        'label' => 'Access System Logs',
        'description' => 'Read system logs, error logs, and security audit trails',
        'category' => 'monitoring',
        'inherits' => ['view_system_metrics'],
        'default_roles' => ['administrator', 'super_admin'],
        'dangerous' => false
    ],
    
    // Plugin management permissions
    'manage_plugin_system' => [
        'label' => 'Manage Plugin System',
        'description' => 'Install, activate, deactivate, and configure plugins',
        'category' => 'plugins',
        'inherits' => ['manage_admin_toolkit'],
        'default_roles' => ['super_admin'],
        'dangerous' => true  // Installing plugins can execute arbitrary code
    ],
    
    'generate_plugin_code' => [
        'label' => 'Generate Plugin Code',
        'description' => 'Use plugin scaffolding and code generation tools',
        'category' => 'development',
        'inherits' => ['use_development_tools', 'manage_plugin_system'],
        'default_roles' => ['developer', 'super_admin'],
        'dangerous' => true  // Code generation can create files
    ],
    
    // Maintenance and backup permissions
    'perform_maintenance' => [
        'label' => 'Perform System Maintenance',
        'description' => 'Run maintenance tasks, database cleanup, and system optimization',
        'category' => 'maintenance',
        'inherits' => ['manage_admin_toolkit'],
        'default_roles' => ['administrator', 'super_admin'],
        'dangerous' => false
    ],
    
    'access_backup_system' => [
        'label' => 'Access Backup System',
        'description' => 'Create, restore, and manage system backups',
        'category' => 'maintenance',
        'inherits' => ['perform_maintenance'],
        'default_roles' => ['administrator', 'super_admin'],
        'dangerous' => true  // Backup operations can be resource intensive
    ]
]);

// ============================================================================
// PLUGIN DEVELOPMENT TOOLS DEMONSTRATION
// ============================================================================

/**
 * Register advanced code scaffolding development tool
 * This tool provides comprehensive plugin scaffolding with advanced
 * options for creating different types of plugins with pre-configured
 * functionality and best practices built in.
 */
cms_register_dev_tool(
    'admin_toolkit',            // Plugin identifier
    'advanced_scaffolding',     // Tool name
    [
        'label' => 'Advanced Plugin Scaffolding',
        'description' => 'Generate complete plugin structures with advanced features and best practices',
        'category' => 'code_generation',
        'permissions' => ['generate_plugin_code'],  // Required permissions
        'interface' => 'form',   // How the tool is presented (form, wizard, command)
        'config_fields' => [     // Configuration options for the tool
            'plugin_name' => [
                'type' => 'text',
                'label' => 'Plugin Name',
                'required' => true,
                'validation' => '/^[a-z][a-z0-9_]*$/',
                'description' => 'Plugin identifier (lowercase, underscores allowed)'
            ],
            'plugin_title' => [
                'type' => 'text',
                'label' => 'Plugin Display Title',
                'required' => true,
                'description' => 'Human-readable plugin name'
            ],
            'plugin_type' => [
                'type' => 'select',
                'label' => 'Plugin Type',
                'options' => [
                    'content' => 'Content Management Plugin',
                    'theme' => 'Theme Enhancement Plugin',
                    'admin' => 'Administrative Tool Plugin',
                    'widget' => 'Widget/Component Plugin',
                    'integration' => 'Third-party Integration Plugin',
                    'custom' => 'Custom Plugin Template'
                ],
                'default' => 'content'
            ],
            'include_database' => [
                'type' => 'checkbox',
                'label' => 'Include Database Features',
                'description' => 'Add database tables, migrations, and ORM functionality'
            ],
            'include_admin_pages' => [
                'type' => 'checkbox',
                'label' => 'Include Admin Pages',
                'description' => 'Generate admin interface pages and navigation'
            ],
            'include_template_tags' => [
                'type' => 'checkbox',
                'label' => 'Include Template Tags',
                'description' => 'Add custom template tags and template system integration'
            ],
            'include_widgets' => [
                'type' => 'checkbox',
                'label' => 'Include Dashboard Widgets',
                'description' => 'Generate dashboard widgets and admin interface enhancements'
            ],
            'include_cache' => [
                'type' => 'checkbox',
                'label' => 'Include Cache Management',
                'description' => 'Add cache namespaces and performance optimization features'
            ],
            'include_multilang' => [
                'type' => 'checkbox',
                'label' => 'Include Multi-language Support',
                'description' => 'Generate translation files and internationalization features'
            ],
            'include_tests' => [
                'type' => 'checkbox',
                'label' => 'Include Unit Tests',
                'description' => 'Generate PHPUnit test files and testing infrastructure'
            ],
            'author_name' => [
                'type' => 'text',
                'label' => 'Author Name',
                'description' => 'Plugin author name for documentation and credits'
            ],
            'author_email' => [
                'type' => 'email',
                'label' => 'Author Email',
                'description' => 'Contact email for plugin support'
            ],
            'license' => [
                'type' => 'select',
                'label' => 'License',
                'options' => [
                    'MIT' => 'MIT License',
                    'GPL-2.0' => 'GNU GPL v2',
                    'GPL-3.0' => 'GNU GPL v3',
                    'Apache-2.0' => 'Apache License 2.0',
                    'BSD-3-Clause' => 'BSD 3-Clause License',
                    'proprietary' => 'Proprietary License'
                ],
                'default' => 'MIT'
            ]
        ],
        'generator' => function($config) {  // Function that performs the scaffolding
            $plugin_name = $config['plugin_name'];
            $plugin_title = $config['plugin_title'];
            $plugin_type = $config['plugin_type'];
            
            // Log the scaffolding operation for debugging
            cms_plugin_debug_log(
                'admin_toolkit',
                'Starting advanced plugin scaffolding',
                'info',
                [
                    'plugin_name' => $plugin_name,
                    'plugin_type' => $plugin_type,
                    'features' => array_filter($config, fn($key) => str_starts_with($key, 'include_'), ARRAY_FILTER_USE_KEY)
                ]
            );
            
            // Use the basic scaffolding as a foundation
            $result = cms_generate_plugin_scaffold($plugin_name, $config);
            
            if (!$result['success']) {
                return $result;
            }
            
            $plugin_dir = $result['path'];
            $generated_files = ['plugin.php', 'README.md'];
            
            // Generate additional files based on selected features
            if ($config['include_database'] ?? false) {
                $generated_files = array_merge($generated_files, 
                    generate_database_files($plugin_dir, $plugin_name));
            }
            
            if ($config['include_admin_pages'] ?? false) {
                $generated_files = array_merge($generated_files,
                    generate_admin_pages($plugin_dir, $plugin_name, $plugin_title));
            }
            
            if ($config['include_template_tags'] ?? false) {
                $generated_files = array_merge($generated_files,
                    generate_template_files($plugin_dir, $plugin_name));
            }
            
            if ($config['include_widgets'] ?? false) {
                $generated_files = array_merge($generated_files,
                    generate_widget_files($plugin_dir, $plugin_name));
            }
            
            if ($config['include_cache'] ?? false) {
                $generated_files = array_merge($generated_files,
                    generate_cache_files($plugin_dir, $plugin_name));
            }
            
            if ($config['include_multilang'] ?? false) {
                $generated_files = array_merge($generated_files,
                    generate_language_files($plugin_dir, $plugin_name));
            }
            
            if ($config['include_tests'] ?? false) {
                $generated_files = array_merge($generated_files,
                    generate_test_files($plugin_dir, $plugin_name));
            }
            
            // Generate composer.json for dependency management
            generate_composer_file($plugin_dir, $config);
            $generated_files[] = 'composer.json';
            
            // Log successful completion
            cms_plugin_debug_log(
                'admin_toolkit',
                'Advanced plugin scaffolding completed successfully',
                'info',
                [
                    'plugin_name' => $plugin_name,
                    'files_generated' => count($generated_files),
                    'file_list' => $generated_files
                ]
            );
            
            return [
                'success' => true,
                'message' => "Advanced plugin '{$plugin_title}' scaffolded successfully with " . count($generated_files) . " files",
                'path' => $plugin_dir,
                'files_generated' => $generated_files,
                'next_steps' => [
                    'Review generated configuration in plugin.php',
                    'Customize database schema if applicable',
                    'Add your business logic to the generated templates',
                    'Test the plugin functionality',
                    'Enable the plugin in the admin panel'
                ]
            ];
        }
    ]
);

/**
 * Register database analysis development tool
 * This tool analyzes the database structure and suggests optimizations,
 * indexes, and potential issues. It's particularly useful for
 * performance tuning and maintenance.
 */
cms_register_dev_tool(
    'admin_toolkit',
    'database_analyzer',
    [
        'label' => 'Database Structure Analyzer',
        'description' => 'Analyze database tables, indexes, and performance characteristics',
        'category' => 'analysis',
        'permissions' => ['view_debug_information'],
        'interface' => 'report',
        'config_fields' => [
            'analysis_depth' => [
                'type' => 'select',
                'label' => 'Analysis Depth',
                'options' => [
                    'basic' => 'Basic Structure Analysis',
                    'detailed' => 'Detailed Performance Analysis',
                    'comprehensive' => 'Comprehensive Security & Optimization Review'
                ],
                'default' => 'detailed'
            ],
            'include_suggestions' => [
                'type' => 'checkbox',
                'label' => 'Include Optimization Suggestions',
                'default' => true
            ],
            'check_plugin_tables' => [
                'type' => 'checkbox',
                'label' => 'Analyze Plugin Tables',
                'default' => true,
                'description' => 'Include tables created by plugins in the analysis'
            ]
        ],
        'analyzer' => function($config) {  // Function that performs database analysis
            cms_plugin_debug_log(
                'admin_toolkit',
                'Starting database analysis',
                'info',
                ['analysis_depth' => $config['analysis_depth'] ?? 'basic']
            );
            
            $db = cms_get_db();
            $analysis_results = [
                'tables' => [],
                'indexes' => [],
                'suggestions' => [],
                'warnings' => [],
                'statistics' => []
            ];
            
            // Get all tables in the database
            $tables_stmt = $db->query("SHOW TABLES");
            $tables = $tables_stmt->fetchAll(PDO::FETCH_COLUMN);
            
            foreach ($tables as $table) {
                // Skip plugin tables if not requested
                if (!($config['check_plugin_tables'] ?? true) && strpos($table, 'plugin_') !== false) {
                    continue;
                }
                
                // Analyze table structure
                $table_info = analyze_table_structure($db, $table);
                $analysis_results['tables'][$table] = $table_info;
                
                // Check for missing indexes
                $index_suggestions = suggest_indexes($db, $table, $table_info);
                if (!empty($index_suggestions)) {
                    $analysis_results['suggestions'] = array_merge(
                        $analysis_results['suggestions'], 
                        $index_suggestions
                    );
                }
                
                // Check for potential issues
                $warnings = check_table_issues($db, $table, $table_info);
                if (!empty($warnings)) {
                    $analysis_results['warnings'] = array_merge(
                        $analysis_results['warnings'],
                        $warnings
                    );
                }
            }
            
            // Generate overall statistics
            $analysis_results['statistics'] = [
                'total_tables' => count($analysis_results['tables']),
                'plugin_tables' => count(array_filter($tables, fn($t) => strpos($t, 'plugin_') !== false)),
                'total_suggestions' => count($analysis_results['suggestions']),
                'total_warnings' => count($analysis_results['warnings']),
                'analysis_date' => date('Y-m-d H:i:s'),
                'analysis_depth' => $config['analysis_depth'] ?? 'basic'
            ];
            
            cms_plugin_debug_log(
                'admin_toolkit',
                'Database analysis completed',
                'info',
                $analysis_results['statistics']
            );
            
            return $analysis_results;
        }
    ]
);

/**
 * Register plugin dependency checker development tool
 * This tool analyzes plugin dependencies, conflicts, and compatibility
 * issues across all installed plugins.
 */
cms_register_dev_tool(
    'admin_toolkit',
    'plugin_dependency_checker',
    [
        'label' => 'Plugin Dependency Checker',
        'description' => 'Analyze plugin dependencies, conflicts, and compatibility issues',
        'category' => 'analysis',
        'permissions' => ['manage_plugin_system'],
        'interface' => 'report',
        'config_fields' => [
            'check_conflicts' => [
                'type' => 'checkbox',
                'label' => 'Check for Conflicts',
                'default' => true,
                'description' => 'Look for plugins that might conflict with each other'
            ],
            'verify_dependencies' => [
                'type' => 'checkbox',
                'label' => 'Verify Dependencies',
                'default' => true,
                'description' => 'Check that all plugin dependencies are satisfied'
            ],
            'suggest_optimizations' => [
                'type' => 'checkbox',
                'label' => 'Suggest Optimizations',
                'default' => true,
                'description' => 'Provide suggestions for plugin load order and optimization'
            ]
        ],
        'checker' => function($config) {
            cms_plugin_debug_log(
                'admin_toolkit',
                'Starting plugin dependency check',
                'info',
                $config
            );
            
            // This would normally analyze actual plugin files and dependencies
            $dependency_results = [
                'plugins_analyzed' => ['advanced_news', 'theme_enhancer', 'admin_toolkit'],
                'dependencies' => [
                    'advanced_news' => ['core_cms' => '>=1.0.0'],
                    'theme_enhancer' => ['core_cms' => '>=1.0.0'],
                    'admin_toolkit' => ['core_cms' => '>=1.0.0', 'advanced_news' => '>=1.0.0']
                ],
                'conflicts' => [],
                'missing_dependencies' => [],
                'suggestions' => [
                    'Consider loading admin_toolkit after advanced_news for optimal performance',
                    'Theme_enhancer has optimal loading priority',
                    'All plugins are compatible with current CMS version'
                ],
                'load_order' => ['advanced_news', 'theme_enhancer', 'admin_toolkit'],
                'analysis_date' => date('Y-m-d H:i:s')
            ];
            
            cms_plugin_debug_log(
                'admin_toolkit',
                'Plugin dependency check completed',
                'info',
                [
                    'plugins_checked' => count($dependency_results['plugins_analyzed']),
                    'conflicts_found' => count($dependency_results['conflicts']),
                    'suggestions_generated' => count($dependency_results['suggestions'])
                ]
            );
            
            return $dependency_results;
        }
    ]
);

// ============================================================================
// ADVANCED CACHE MANAGEMENT DEMONSTRATION
// ============================================================================

/**
 * Register performance cache namespace for system metrics
 * This cache stores comprehensive system performance data including
 * memory usage, query performance, and resource utilization statistics.
 */
cms_register_cache_namespace(
    'admin_toolkit',            // Plugin identifier
    'performance_metrics',      // Cache namespace
    [
        'description' => 'System performance metrics, query statistics, and resource usage data',
        'default_ttl' => 1800,  // 30 minutes - performance data changes frequently
        'max_size' => '100MB',  // Larger cache for comprehensive metrics
        'auto_cleanup' => true, // Automatically remove expired entries
        'compression' => true,  // Compress data to save space
        'encryption' => false,  // No encryption needed for performance data
        'versioning' => true,   // Keep multiple versions for trend analysis
        'tags' => ['performance', 'system', 'monitoring', 'metrics'],
        'invalidation_rules' => [  // Rules for when to invalidate cache
            'on_plugin_activation' => true,
            'on_theme_change' => true,
            'on_settings_change' => false,  // Settings changes don't affect performance metrics
            'manual_clear_only' => false
        ]
    ]
);

/**
 * Register debug logs cache namespace for development information
 * This cache stores debug logs, error traces, and development information
 * with shorter TTL since debug info becomes stale quickly.
 */
cms_register_cache_namespace(
    'admin_toolkit',
    'debug_logs',
    [
        'description' => 'Debug logs, error traces, and development diagnostic information',
        'default_ttl' => 600,   // 10 minutes - debug info becomes stale quickly
        'max_size' => '50MB',
        'auto_cleanup' => true,
        'compression' => true,
        'encryption' => false,
        'versioning' => false,  // Debug logs don't need versioning
        'tags' => ['debug', 'logs', 'development', 'diagnostics'],
        'invalidation_rules' => [
            'on_plugin_activation' => true,
            'on_theme_change' => false,
            'on_settings_change' => true,   // Settings changes affect debug behavior
            'manual_clear_only' => false
        ]
    ]
);

/**
 * Register system analysis cache namespace for expensive operations
 * This cache stores results of expensive analysis operations like
 * database structure analysis, plugin dependency checks, and security scans.
 */
cms_register_cache_namespace(
    'admin_toolkit',
    'system_analysis',
    [
        'description' => 'Results from expensive system analysis operations and diagnostic scans',
        'default_ttl' => 7200,  // 2 hours - analysis results are relatively stable
        'max_size' => '25MB',
        'auto_cleanup' => true,
        'compression' => true,
        'encryption' => true,   // Analysis results might contain sensitive info
        'versioning' => true,   // Keep analysis history for comparison
        'tags' => ['analysis', 'diagnostics', 'security', 'optimization'],
        'invalidation_rules' => [
            'on_plugin_activation' => true,   // New plugins change the analysis
            'on_theme_change' => false,      // Themes don't affect system analysis
            'on_settings_change' => true,    // Settings changes can affect analysis
            'manual_clear_only' => false
        ]
    ]
);

// ============================================================================
// COMPREHENSIVE PLUGIN SETTINGS
// ============================================================================

/**
 * Register comprehensive administrative toolkit settings
 * These settings control all aspects of the admin toolkit functionality
 * including debugging levels, cache behavior, and security options.
 */
cms_register_plugin_settings('admin_toolkit', [
    // Core functionality settings
    'enabled' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Admin Toolkit',
        'description' => 'Master switch for all administrative toolkit functionality'
    ],
    
    'debug_mode' => [
        'type' => 'bool',
        'default' => false,
        'label' => 'Enable Debug Mode',
        'description' => 'Enable comprehensive debugging and logging (can impact performance)'
    ],
    
    'debug_level' => [
        'type' => 'string',
        'default' => 'info',
        'label' => 'Debug Logging Level',
        'description' => 'Minimum level for debug messages (debug, info, warning, error, critical)'
    ],
    
    // Development tools settings
    'development_tools_enabled' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Development Tools',
        'description' => 'Allow access to code generation, scaffolding, and analysis tools'
    ],
    
    'allow_code_generation' => [
        'type' => 'bool',
        'default' => false,
        'label' => 'Allow Code Generation',
        'description' => 'Enable plugin scaffolding and automatic code generation (security risk in production)'
    ],
    
    'dev_tools_auto_backup' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Auto-backup Before Code Generation',
        'description' => 'Automatically create backups before generating or modifying code'
    ],
    
    // Performance monitoring settings
    'performance_monitoring' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Performance Monitoring',
        'description' => 'Monitor system performance and resource usage'
    ],
    
    'performance_alert_threshold' => [
        'type' => 'int',
        'default' => 5000,
        'label' => 'Performance Alert Threshold (ms)',
        'description' => 'Send alerts when operations exceed this time in milliseconds'
    ],
    
    'memory_alert_threshold' => [
        'type' => 'int',
        'default' => 128,
        'label' => 'Memory Alert Threshold (MB)',
        'description' => 'Send alerts when memory usage exceeds this threshold'
    ],
    
    // Cache management settings
    'cache_management_enabled' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Advanced Cache Management',
        'description' => 'Provide advanced cache control and monitoring features'
    ],
    
    'auto_cache_cleanup' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Automatic Cache Cleanup',
        'description' => 'Automatically clean expired cache entries and optimize cache storage'
    ],
    
    'cache_statistics_enabled' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Track Cache Statistics',
        'description' => 'Monitor cache hit/miss rates and performance metrics'
    ],
    
    // Security and audit settings
    'security_monitoring' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Security Monitoring',
        'description' => 'Monitor for security issues and suspicious activity'
    ],
    
    'audit_logging' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Enable Audit Logging',
        'description' => 'Log administrative actions and security events'
    ],
    
    'failed_login_monitoring' => [
        'type' => 'bool',
        'default' => true,
        'label' => 'Monitor Failed Login Attempts',
        'description' => 'Track and alert on suspicious login activity'
    ],
    
    // Notification settings
    'email_notifications' => [
        'type' => 'bool',
        'default' => false,
        'label' => 'Email Notifications',
        'description' => 'Send email alerts for critical issues and security events'
    ],
    
    'notification_email' => [
        'type' => 'string',
        'default' => '',
        'label' => 'Notification Email Address',
        'description' => 'Email address to receive admin toolkit notifications'
    ],
    
    // Advanced configuration as JSON
    'advanced_settings' => [
        'type' => 'json',
        'default' => [
            'max_log_file_size' => '10MB',
            'log_retention_days' => 30,
            'enable_query_profiling' => false,
            'enable_memory_profiling' => false,
            'auto_optimize_database' => false,
            'backup_before_maintenance' => true,
            'maintenance_window_start' => '02:00',
            'maintenance_window_end' => '04:00'
        ],
        'label' => 'Advanced Configuration',
        'description' => 'Advanced settings for logging, profiling, and maintenance operations'
    ],
    
    // User interface preferences
    'ui_preferences' => [
        'type' => 'json',
        'default' => [
            'show_debug_toolbar' => false,
            'highlight_slow_queries' => true,
            'show_memory_usage' => true,
            'compact_log_display' => false,
            'auto_refresh_metrics' => true,
            'metrics_refresh_interval' => 30
        ],
        'label' => 'User Interface Preferences',
        'description' => 'Customize the admin toolkit user interface'
    ]
]);

// ============================================================================
// MULTI-LANGUAGE ADMIN INTERFACE SUPPORT
// ============================================================================

/**
 * Register English language pack for administrative interface
 * This provides comprehensive translations for all admin toolkit features
 * including technical terms, user interface elements, and system messages.
 */
cms_register_plugin_language_pack('admin_toolkit', 'en', [
    // Main navigation and menu items
    'menu.admin_toolkit' => 'Admin Toolkit',
    'menu.dashboard' => 'Toolkit Dashboard',
    'menu.development_tools' => 'Development Tools',
    'menu.system_monitor' => 'System Monitor',
    'menu.cache_manager' => 'Cache Manager',
    'menu.debug_console' => 'Debug Console',
    'menu.security_center' => 'Security Center',
    'menu.maintenance_tools' => 'Maintenance Tools',
    
    // Development tools interface
    'dev.scaffolding_title' => 'Plugin Scaffolding',
    'dev.generate_plugin' => 'Generate New Plugin',
    'dev.plugin_name' => 'Plugin Name',
    'dev.plugin_title' => 'Plugin Title',
    'dev.plugin_type' => 'Plugin Type',
    'dev.include_features' => 'Include Features',
    'dev.database_features' => 'Database Features',
    'dev.admin_interface' => 'Admin Interface',
    'dev.template_system' => 'Template System',
    'dev.widget_system' => 'Widget System',
    'dev.cache_system' => 'Cache System',
    'dev.multilang_support' => 'Multi-language Support',
    'dev.unit_tests' => 'Unit Tests',
    'dev.generate_code' => 'Generate Code',
    'dev.scaffolding_success' => 'Plugin scaffolding completed successfully',
    'dev.scaffolding_error' => 'Error during plugin scaffolding',
    
    // Database analysis interface
    'db.analysis_title' => 'Database Analysis',
    'db.run_analysis' => 'Run Analysis',
    'db.analysis_depth' => 'Analysis Depth',
    'db.basic_analysis' => 'Basic Analysis',
    'db.detailed_analysis' => 'Detailed Analysis',
    'db.comprehensive_analysis' => 'Comprehensive Analysis',
    'db.include_suggestions' => 'Include Suggestions',
    'db.check_plugin_tables' => 'Check Plugin Tables',
    'db.analysis_results' => 'Analysis Results',
    'db.table_structure' => 'Table Structure',
    'db.index_analysis' => 'Index Analysis',
    'db.performance_suggestions' => 'Performance Suggestions',
    'db.security_warnings' => 'Security Warnings',
    
    // Cache management interface
    'cache.manager_title' => 'Cache Manager',
    'cache.cache_statistics' => 'Cache Statistics',
    'cache.cache_namespaces' => 'Cache Namespaces',
    'cache.clear_cache' => 'Clear Cache',
    'cache.clear_all' => 'Clear All Caches',
    'cache.clear_namespace' => 'Clear Namespace',
    'cache.cache_hit_rate' => 'Hit Rate',
    'cache.cache_size' => 'Cache Size',
    'cache.entries_count' => 'Entries',
    'cache.last_cleanup' => 'Last Cleanup',
    'cache.auto_cleanup' => 'Auto Cleanup',
    'cache.manual_cleanup' => 'Manual Cleanup',
    'cache.optimization_suggestions' => 'Optimization Suggestions',
    
    // Performance monitoring interface
    'perf.monitor_title' => 'Performance Monitor',
    'perf.current_metrics' => 'Current Metrics',
    'perf.historical_data' => 'Historical Data',
    'perf.page_load_time' => 'Page Load Time',
    'perf.memory_usage' => 'Memory Usage',
    'perf.cpu_usage' => 'CPU Usage',
    'perf.database_queries' => 'Database Queries',
    'perf.slow_queries' => 'Slow Queries',
    'perf.cache_performance' => 'Cache Performance',
    'perf.resource_usage' => 'Resource Usage',
    'perf.performance_trends' => 'Performance Trends',
    'perf.alerts_triggered' => 'Alerts Triggered',
    
    // Security monitoring interface
    'security.center_title' => 'Security Center',
    'security.threat_level' => 'Threat Level',
    'security.recent_events' => 'Recent Security Events',
    'security.failed_logins' => 'Failed Login Attempts',
    'security.suspicious_activity' => 'Suspicious Activity',
    'security.security_audit' => 'Security Audit',
    'security.vulnerability_scan' => 'Vulnerability Scan',
    'security.access_logs' => 'Access Logs',
    'security.firewall_status' => 'Firewall Status',
    'security.intrusion_detection' => 'Intrusion Detection',
    
    // Debug console interface
    'debug.console_title' => 'Debug Console',
    'debug.debug_level' => 'Debug Level',
    'debug.log_entries' => 'Log Entries',
    'debug.error_logs' => 'Error Logs',
    'debug.query_logs' => 'Query Logs',
    'debug.performance_logs' => 'Performance Logs',
    'debug.clear_logs' => 'Clear Logs',
    'debug.download_logs' => 'Download Logs',
    'debug.real_time_monitoring' => 'Real-time Monitoring',
    'debug.log_filtering' => 'Log Filtering',
    'debug.search_logs' => 'Search Logs',
    
    // Maintenance tools interface
    'maint.tools_title' => 'Maintenance Tools',
    'maint.database_optimization' => 'Database Optimization',
    'maint.cleanup_tasks' => 'Cleanup Tasks',
    'maint.backup_restore' => 'Backup & Restore',
    'maint.system_update' => 'System Update',
    'maint.plugin_maintenance' => 'Plugin Maintenance',
    'maint.scheduled_tasks' => 'Scheduled Tasks',
    'maint.maintenance_mode' => 'Maintenance Mode',
    'maint.system_health' => 'System Health Check',
    
    // Common UI elements
    'ui.save_settings' => 'Save Settings',
    'ui.reset_defaults' => 'Reset to Defaults',
    'ui.apply_changes' => 'Apply Changes',
    'ui.cancel_operation' => 'Cancel',
    'ui.confirm_action' => 'Confirm Action',
    'ui.loading_data' => 'Loading Data...',
    'ui.processing' => 'Processing...',
    'ui.operation_complete' => 'Operation Complete',
    'ui.operation_failed' => 'Operation Failed',
    'ui.refresh_data' => 'Refresh Data',
    'ui.export_data' => 'Export Data',
    'ui.import_data' => 'Import Data',
    
    // Status messages and notifications
    'status.toolkit_enabled' => 'Admin Toolkit is enabled and functioning normally',
    'status.toolkit_disabled' => 'Admin Toolkit is currently disabled',
    'status.debug_mode_active' => 'Debug mode is active - performance may be impacted',
    'status.maintenance_required' => 'System maintenance is recommended',
    'status.security_alert' => 'Security alert detected - review security center',
    'status.performance_warning' => 'Performance warning - check system monitor',
    'status.cache_optimized' => 'Cache system is optimized and performing well',
    'status.database_healthy' => 'Database is healthy and optimized',
    
    // Error messages and warnings
    'error.permission_denied' => 'Permission denied - insufficient privileges',
    'error.operation_failed' => 'Operation failed - check debug logs for details',
    'error.invalid_configuration' => 'Invalid configuration detected',
    'error.database_connection' => 'Database connection error',
    'error.cache_failure' => 'Cache operation failed',
    'error.file_system_error' => 'File system error occurred',
    'error.security_violation' => 'Security violation detected',
    'error.resource_limit' => 'Resource limit exceeded',
    
    // Help and documentation text
    'help.getting_started' => 'Getting Started with Admin Toolkit',
    'help.troubleshooting' => 'Troubleshooting Guide',
    'help.best_practices' => 'Best Practices',
    'help.performance_tuning' => 'Performance Tuning Guide',
    'help.security_guidelines' => 'Security Guidelines',
    'help.development_guide' => 'Plugin Development Guide',
    'help.api_reference' => 'API Reference',
    'help.support_contact' => 'Support Contact Information'
]);

/**
 * Register Spanish language pack for international support
 * This demonstrates how administrative tools can be fully localized
 * for international teams and multi-language environments.
 */
cms_register_plugin_language_pack('admin_toolkit', 'es', [
    // Main navigation and menu items
    'menu.admin_toolkit' => 'Kit de Administración',
    'menu.dashboard' => 'Panel del Kit',
    'menu.development_tools' => 'Herramientas de Desarrollo',
    'menu.system_monitor' => 'Monitor del Sistema',
    'menu.cache_manager' => 'Gestor de Caché',
    'menu.debug_console' => 'Consola de Depuración',
    'menu.security_center' => 'Centro de Seguridad',
    'menu.maintenance_tools' => 'Herramientas de Mantenimiento',
    
    // Development tools interface
    'dev.scaffolding_title' => 'Generación de Plugins',
    'dev.generate_plugin' => 'Generar Nuevo Plugin',
    'dev.plugin_name' => 'Nombre del Plugin',
    'dev.plugin_title' => 'Título del Plugin',
    'dev.plugin_type' => 'Tipo de Plugin',
    'dev.include_features' => 'Incluir Características',
    'dev.database_features' => 'Características de Base de Datos',
    'dev.admin_interface' => 'Interfaz de Administración',
    'dev.template_system' => 'Sistema de Plantillas',
    'dev.widget_system' => 'Sistema de Widgets',
    'dev.cache_system' => 'Sistema de Caché',
    'dev.multilang_support' => 'Soporte Multi-idioma',
    'dev.unit_tests' => 'Pruebas Unitarias',
    'dev.generate_code' => 'Generar Código',
    'dev.scaffolding_success' => 'Generación de plugin completada exitosamente',
    'dev.scaffolding_error' => 'Error durante la generación del plugin',
    
    // Cache management interface
    'cache.manager_title' => 'Gestor de Caché',
    'cache.cache_statistics' => 'Estadísticas de Caché',
    'cache.cache_namespaces' => 'Espacios de Nombres de Caché',
    'cache.clear_cache' => 'Limpiar Caché',
    'cache.clear_all' => 'Limpiar Todo el Caché',
    'cache.clear_namespace' => 'Limpiar Espacio de Nombres',
    'cache.cache_hit_rate' => 'Tasa de Aciertos',
    'cache.cache_size' => 'Tamaño del Caché',
    'cache.entries_count' => 'Entradas',
    'cache.last_cleanup' => 'Última Limpieza',
    'cache.auto_cleanup' => 'Limpieza Automática',
    'cache.manual_cleanup' => 'Limpieza Manual',
    
    // Performance monitoring interface
    'perf.monitor_title' => 'Monitor de Rendimiento',
    'perf.current_metrics' => 'Métricas Actuales',
    'perf.historical_data' => 'Datos Históricos',
    'perf.page_load_time' => 'Tiempo de Carga de Página',
    'perf.memory_usage' => 'Uso de Memoria',
    'perf.cpu_usage' => 'Uso de CPU',
    'perf.database_queries' => 'Consultas de Base de Datos',
    'perf.slow_queries' => 'Consultas Lentas',
    'perf.cache_performance' => 'Rendimiento del Caché',
    
    // Common UI elements
    'ui.save_settings' => 'Guardar Configuración',
    'ui.reset_defaults' => 'Restablecer Valores Predeterminados',
    'ui.apply_changes' => 'Aplicar Cambios',
    'ui.cancel_operation' => 'Cancelar',
    'ui.confirm_action' => 'Confirmar Acción',
    'ui.loading_data' => 'Cargando Datos...',
    'ui.processing' => 'Procesando...',
    'ui.operation_complete' => 'Operación Completada',
    'ui.operation_failed' => 'Operación Fallida',
    
    // Status messages
    'status.toolkit_enabled' => 'El Kit de Administración está habilitado y funcionando normalmente',
    'status.toolkit_disabled' => 'El Kit de Administración está actualmente deshabilitado',
    'status.debug_mode_active' => 'El modo de depuración está activo - el rendimiento puede verse afectado',
    'status.performance_warning' => 'Advertencia de rendimiento - revisar monitor del sistema',
    
    // Error messages
    'error.permission_denied' => 'Permiso denegado - privilegios insuficientes',
    'error.operation_failed' => 'Operación fallida - revisar registros de depuración para detalles',
    'error.invalid_configuration' => 'Configuración inválida detectada',
    'error.database_connection' => 'Error de conexión a la base de datos',
    'error.cache_failure' => 'Falla en operación de caché'
]);

// ============================================================================
// ADMIN PAGE REGISTRATION WITH PERMISSION CHECKING
// ============================================================================

/**
 * Register main admin toolkit dashboard with comprehensive feature overview
 * This page provides a central hub for all administrative functions with
 * role-based access control and real-time system status information.
 */
cms_register_admin_page(
    'admin_toolkit_dashboard',
    cms_plugin_translate('admin_toolkit', 'menu.admin_toolkit', null, 'Admin Toolkit'),
    function() {
        // Check permissions before displaying content
        if (!cms_check_plugin_permission('admin_toolkit', 'manage_admin_toolkit')) {
            echo '<div class="permission-denied">';
            echo '<h2>' . cms_plugin_translate('admin_toolkit', 'error.permission_denied') . '</h2>';
            echo '<p>You do not have sufficient permissions to access the Admin Toolkit.</p>';
            echo '</div>';
            return;
        }
        
        $title = cms_plugin_translate('admin_toolkit', 'menu.admin_toolkit');
        $enabled = cms_get_plugin_setting('admin_toolkit', 'enabled', true);
        $debug_mode = cms_get_plugin_setting('admin_toolkit', 'debug_mode', false);
        
        echo '<div class="admin-toolkit-dashboard">';
        echo '<h1>' . htmlspecialchars($title) . '</h1>';
        
        // System status overview
        echo '<div class="system-status">';
        echo '<h2>System Status</h2>';
        
        $status_class = $enabled ? 'status-good' : 'status-warning';
        echo '<div class="status-indicator ' . $status_class . '">';
        echo '<h3>Admin Toolkit: ' . ($enabled ? 'ACTIVE' : 'INACTIVE') . '</h3>';
        
        if ($debug_mode) {
            echo '<div class="debug-notice">';
            echo cms_plugin_translate('admin_toolkit', 'status.debug_mode_active');
            echo '</div>';
        }
        echo '</div>';
        
        // Quick metrics display
        echo '<div class="quick-metrics">';
        echo '<div class="metric-card">';
        echo '<h4>Memory Usage</h4>';
        $memory_mb = round(memory_get_peak_usage(true) / 1024 / 1024, 2);
        echo '<span class="metric-value">' . $memory_mb . ' MB</span>';
        echo '</div>';
        
        echo '<div class="metric-card">';
        echo '<h4>Cache Hit Rate</h4>';
        echo '<span class="metric-value">94.2%</span>';  // Would get from cache statistics
        echo '</div>';
        
        echo '<div class="metric-card">';
        echo '<h4>Active Plugins</h4>';
        echo '<span class="metric-value">3</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        // Feature access grid with permission checking
        echo '<div class="feature-grid">';
        
        if (cms_check_plugin_permission('admin_toolkit', 'use_development_tools')) {
            echo '<div class="feature-card">';
            echo '<h3>' . cms_plugin_translate('admin_toolkit', 'menu.development_tools') . '</h3>';
            echo '<p>Code generation, scaffolding, and analysis tools</p>';
            echo '<a href="?page=development_tools" class="btn">Access Tools</a>';
            echo '</div>';
        }
        
        if (cms_check_plugin_permission('admin_toolkit', 'view_system_metrics')) {
            echo '<div class="feature-card">';
            echo '<h3>' . cms_plugin_translate('admin_toolkit', 'menu.system_monitor') . '</h3>';
            echo '<p>Performance monitoring and system diagnostics</p>';
            echo '<a href="?page=system_monitor" class="btn">View Monitor</a>';
            echo '</div>';
        }
        
        if (cms_check_plugin_permission('admin_toolkit', 'manage_cache_system')) {
            echo '<div class="feature-card">';
            echo '<h3>' . cms_plugin_translate('admin_toolkit', 'menu.cache_manager') . '</h3>';
            echo '<p>Cache optimization and management tools</p>';
            echo '<a href="?page=cache_manager" class="btn">Manage Cache</a>';
            echo '</div>';
        }
        
        if (cms_check_plugin_permission('admin_toolkit', 'view_debug_information')) {
            echo '<div class="feature-card">';
            echo '<h3>' . cms_plugin_translate('admin_toolkit', 'menu.debug_console') . '</h3>';
            echo '<p>Debug logs and diagnostic information</p>';
            echo '<a href="?page=debug_console" class="btn">Open Console</a>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
    }
);

/**
 * Register development tools admin page with code generation features
 * This page provides access to plugin scaffolding, database analysis,
 * and other development utilities with appropriate permission checks.
 */
cms_register_admin_page(
    'development_tools',
    cms_plugin_translate('admin_toolkit', 'menu.development_tools', null, 'Development Tools'),
    function() {
        if (!cms_check_plugin_permission('admin_toolkit', 'use_development_tools')) {
            echo '<div class="permission-denied">';
            echo '<h2>' . cms_plugin_translate('admin_toolkit', 'error.permission_denied') . '</h2>';
            echo '</div>';
            return;
        }
        
        $title = cms_plugin_translate('admin_toolkit', 'menu.development_tools');
        echo '<div class="development-tools-page">';
        echo '<h1>' . htmlspecialchars($title) . '</h1>';
        
        // Plugin scaffolding section
        if (cms_check_plugin_permission('admin_toolkit', 'generate_plugin_code')) {
            echo '<div class="tool-section">';
            echo '<h2>' . cms_plugin_translate('admin_toolkit', 'dev.scaffolding_title') . '</h2>';
            echo '<p>Generate complete plugin structures with advanced features and best practices.</p>';
            
            echo '<form class="scaffolding-form">';
            echo '<div class="form-row">';
            echo '<label>' . cms_plugin_translate('admin_toolkit', 'dev.plugin_name') . '</label>';
            echo '<input type="text" name="plugin_name" required pattern="[a-z][a-z0-9_]*">';
            echo '</div>';
            
            echo '<div class="form-row">';
            echo '<label>' . cms_plugin_translate('admin_toolkit', 'dev.plugin_title') . '</label>';
            echo '<input type="text" name="plugin_title" required>';
            echo '</div>';
            
            echo '<div class="form-row">';
            echo '<label>' . cms_plugin_translate('admin_toolkit', 'dev.plugin_type') . '</label>';
            echo '<select name="plugin_type">';
            echo '<option value="content">Content Management Plugin</option>';
            echo '<option value="theme">Theme Enhancement Plugin</option>';
            echo '<option value="admin">Administrative Tool Plugin</option>';
            echo '<option value="widget">Widget/Component Plugin</option>';
            echo '</select>';
            echo '</div>';
            
            echo '<div class="form-row">';
            echo '<h3>' . cms_plugin_translate('admin_toolkit', 'dev.include_features') . '</h3>';
            echo '<label><input type="checkbox" name="include_database"> ' . cms_plugin_translate('admin_toolkit', 'dev.database_features') . '</label>';
            echo '<label><input type="checkbox" name="include_admin_pages"> ' . cms_plugin_translate('admin_toolkit', 'dev.admin_interface') . '</label>';
            echo '<label><input type="checkbox" name="include_template_tags"> ' . cms_plugin_translate('admin_toolkit', 'dev.template_system') . '</label>';
            echo '<label><input type="checkbox" name="include_widgets"> ' . cms_plugin_translate('admin_toolkit', 'dev.widget_system') . '</label>';
            echo '<label><input type="checkbox" name="include_cache"> ' . cms_plugin_translate('admin_toolkit', 'dev.cache_system') . '</label>';
            echo '<label><input type="checkbox" name="include_multilang"> ' . cms_plugin_translate('admin_toolkit', 'dev.multilang_support') . '</label>';
            echo '<label><input type="checkbox" name="include_tests"> ' . cms_plugin_translate('admin_toolkit', 'dev.unit_tests') . '</label>';
            echo '</div>';
            
            echo '<button type="submit">' . cms_plugin_translate('admin_toolkit', 'dev.generate_code') . '</button>';
            echo '</form>';
            echo '</div>';
        }
        
        // Database analysis section
        if (cms_check_plugin_permission('admin_toolkit', 'view_debug_information')) {
            echo '<div class="tool-section">';
            echo '<h2>' . cms_plugin_translate('admin_toolkit', 'db.analysis_title') . '</h2>';
            echo '<p>Analyze database structure, performance, and optimization opportunities.</p>';
            
            echo '<form class="analysis-form">';
            echo '<div class="form-row">';
            echo '<label>' . cms_plugin_translate('admin_toolkit', 'db.analysis_depth') . '</label>';
            echo '<select name="analysis_depth">';
            echo '<option value="basic">' . cms_plugin_translate('admin_toolkit', 'db.basic_analysis') . '</option>';
            echo '<option value="detailed">' . cms_plugin_translate('admin_toolkit', 'db.detailed_analysis') . '</option>';
            echo '<option value="comprehensive">' . cms_plugin_translate('admin_toolkit', 'db.comprehensive_analysis') . '</option>';
            echo '</select>';
            echo '</div>';
            
            echo '<div class="form-row">';
            echo '<label><input type="checkbox" name="include_suggestions" checked> ' . cms_plugin_translate('admin_toolkit', 'db.include_suggestions') . '</label>';
            echo '<label><input type="checkbox" name="check_plugin_tables" checked> ' . cms_plugin_translate('admin_toolkit', 'db.check_plugin_tables') . '</label>';
            echo '</div>';
            
            echo '<button type="submit">' . cms_plugin_translate('admin_toolkit', 'db.run_analysis') . '</button>';
            echo '</form>';
            echo '</div>';
        }
        
        echo '</div>';
    },
    'admin_toolkit_dashboard'  // Parent page
);

// ============================================================================
// SIDEBAR NAVIGATION WITH PERMISSION CHECKING
// ============================================================================

/**
 * Register sidebar links with proper permission checking
 * Only show navigation items that the current user has permission to access.
 */

// System monitor link - only for users with system metrics permission
if (cms_check_plugin_permission('admin_toolkit', 'view_system_metrics')) {
    cms_register_sidebar_link(
        'system_monitor',
        cms_plugin_translate('admin_toolkit', 'menu.system_monitor', null, 'System Monitor'),
        'plugin.php?page=system_monitor',
        'admin_toolkit_dashboard'
    );
}

// Cache manager link - only for cache management permission
if (cms_check_plugin_permission('admin_toolkit', 'manage_cache_system')) {
    cms_register_sidebar_link(
        'cache_manager',
        cms_plugin_translate('admin_toolkit', 'menu.cache_manager', null, 'Cache Manager'),
        'plugin.php?page=cache_manager',
        'admin_toolkit_dashboard'
    );
}

// Debug console link - only for debug information permission
if (cms_check_plugin_permission('admin_toolkit', 'view_debug_information')) {
    cms_register_sidebar_link(
        'debug_console',
        cms_plugin_translate('admin_toolkit', 'menu.debug_console', null, 'Debug Console'),
        'plugin.php?page=debug_console',
        'admin_toolkit_dashboard'
    );
}

// Maintenance tools link - only for maintenance permission
if (cms_check_plugin_permission('admin_toolkit', 'perform_maintenance')) {
    cms_register_sidebar_link(
        'maintenance_tools',
        cms_plugin_translate('admin_toolkit', 'menu.maintenance_tools', null, 'Maintenance Tools'),
        'plugin.php?page=maintenance_tools',
        'admin_toolkit_dashboard'
    );
}

// ============================================================================
// TEMPLATE TAG REGISTRATION WITH PERMISSION CHECKING
// ============================================================================

/**
 * Register template tag for displaying system metrics
 * This tag allows themes to show system performance information
 * but only for users with appropriate permissions.
 */
cms_register_template_tag(
    'system_metrics',
    function($metric_type = 'summary', $include_debug = false) {
        // Check permissions before displaying any system information
        if (!cms_check_plugin_permission('admin_toolkit', 'view_system_metrics')) {
            return '<!-- System metrics hidden: insufficient permissions -->';
        }
        
        // Additional permission check for debug information
        if ($include_debug && !cms_check_plugin_permission('admin_toolkit', 'view_debug_information')) {
            $include_debug = false;
        }
        
        // Get metrics from cache for performance
        $cache_key = 'system_metrics_' . $metric_type;
        $metrics = cms_get_plugin_cache('performance_metrics', $cache_key);
        
        if (!$metrics) {
            // Generate fresh metrics
            $metrics = [
                'memory_usage' => memory_get_peak_usage(true),
                'memory_limit' => ini_get('memory_limit'),
                'execution_time' => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
                'queries_executed' => rand(8, 25),  // Would get from query profiler
                'cache_hit_rate' => 94.2,  // Would get from cache statistics
                'cpu_usage' => rand(15, 45),  // Would get from system monitoring
                'disk_usage' => 68.5,  // Would get from disk monitoring
                'active_sessions' => rand(45, 120)
            ];
            
            // Cache for 30 seconds
            cms_set_plugin_cache('performance_metrics', $cache_key, $metrics, 30);
        }
        
        $output = '<div class="system-metrics" data-type="' . $metric_type . '">';
        
        switch ($metric_type) {
            case 'memory':
                $memory_mb = round($metrics['memory_usage'] / 1024 / 1024, 2);
                $output .= '<div class="metric memory">';
                $output .= '<span class="label">Memory:</span> ';
                $output .= '<span class="value">' . $memory_mb . ' MB</span>';
                $output .= '</div>';
                break;
                
            case 'performance':
                $output .= '<div class="metric performance">';
                $output .= '<span class="label">Load Time:</span> ';
                $output .= '<span class="value">' . round($metrics['execution_time'], 3) . 's</span>';
                $output .= '</div>';
                break;
                
            case 'cache':
                $output .= '<div class="metric cache">';
                $output .= '<span class="label">Cache Hit Rate:</span> ';
                $output .= '<span class="value">' . $metrics['cache_hit_rate'] . '%</span>';
                $output .= '</div>';
                break;
                
            default: // summary
                $memory_mb = round($metrics['memory_usage'] / 1024 / 1024, 2);
                $output .= '<div class="metrics-summary">';
                $output .= '<span class="metric">Memory: ' . $memory_mb . 'MB</span>';
                $output .= '<span class="metric">Time: ' . round($metrics['execution_time'], 3) . 's</span>';
                $output .= '<span class="metric">Queries: ' . $metrics['queries_executed'] . '</span>';
                $output .= '<span class="metric">Cache: ' . $metrics['cache_hit_rate'] . '%</span>';
                $output .= '</div>';
        }
        
        if ($include_debug) {
            $output .= '<div class="debug-info">';
            $output .= '<div class="debug-metric">CPU: ' . $metrics['cpu_usage'] . '%</div>';
            $output .= '<div class="debug-metric">Disk: ' . $metrics['disk_usage'] . '%</div>';
            $output .= '<div class="debug-metric">Sessions: ' . $metrics['active_sessions'] . '</div>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }
);

/**
 * Register template tag for debug information display
 * This provides detailed debugging information but only for users
 * with appropriate debug permissions.
 */
cms_register_template_tag(
    'debug_info',
    function($show_queries = false, $show_includes = false) {
        // Strict permission checking for debug information
        if (!cms_check_plugin_permission('admin_toolkit', 'view_debug_information')) {
            return '<!-- Debug information hidden: insufficient permissions -->';
        }
        
        // Additional permission for sensitive debug data
        if ($show_queries && !cms_check_plugin_permission('admin_toolkit', 'modify_debug_settings')) {
            $show_queries = false;
        }
        
        $debug_enabled = cms_get_plugin_setting('admin_toolkit', 'debug_mode', false);
        if (!$debug_enabled) {
            return '<!-- Debug mode disabled -->';
        }
        
        $output = '<div class="debug-information">';
        $output .= '<h4>Debug Information</h4>';
        
        // Basic debug info
        $output .= '<div class="debug-section">';
        $output .= '<h5>Execution Details</h5>';
        $output .= '<ul>';
        $output .= '<li>PHP Version: ' . PHP_VERSION . '</li>';
        $output .= '<li>Memory Peak: ' . round(memory_get_peak_usage(true) / 1024 / 1024, 2) . ' MB</li>';
        $output .= '<li>Execution Time: ' . round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 4) . 's</li>';
        $output .= '<li>Request Method: ' . ($_SERVER['REQUEST_METHOD'] ?? 'Unknown') . '</li>';
        $output .= '</ul>';
        $output .= '</div>';
        
        if ($show_queries) {
            $output .= '<div class="debug-section">';
            $output .= '<h5>Database Queries</h5>';
            $output .= '<p>Query logging would appear here in a real implementation.</p>';
            $output .= '</div>';
        }
        
        if ($show_includes) {
            $output .= '<div class="debug-section">';
            $output .= '<h5>Included Files</h5>';
            $included_files = get_included_files();
            $output .= '<p>Files included: ' . count($included_files) . '</p>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }
);

// ============================================================================
// INITIALIZATION AND SECURITY SETUP
// ============================================================================

/**
 * Initialize plugin with security checks and default settings
 * Set up the plugin with appropriate security measures and
 * ensure all required permissions and settings are in place.
 */
if (cms_get_plugin_setting('admin_toolkit', 'enabled') === null) {
    // Initialize default settings with security in mind
    cms_set_plugin_setting('admin_toolkit', 'enabled', true, 'bool');
    cms_set_plugin_setting('admin_toolkit', 'debug_mode', false, 'bool');  // Debug off by default for security
    cms_set_plugin_setting('admin_toolkit', 'debug_level', 'warning', 'string');  // Conservative debug level
    cms_set_plugin_setting('admin_toolkit', 'development_tools_enabled', true, 'bool');
    cms_set_plugin_setting('admin_toolkit', 'allow_code_generation', false, 'bool');  // Code generation off by default
    cms_set_plugin_setting('admin_toolkit', 'performance_monitoring', true, 'bool');
    cms_set_plugin_setting('admin_toolkit', 'performance_alert_threshold', 5000, 'int');
    cms_set_plugin_setting('admin_toolkit', 'cache_management_enabled', true, 'bool');
    cms_set_plugin_setting('admin_toolkit', 'security_monitoring', true, 'bool');
    cms_set_plugin_setting('admin_toolkit', 'audit_logging', true, 'bool');
    cms_set_plugin_setting('admin_toolkit', 'email_notifications', false, 'bool');  // Email off by default
    
    // Set conservative advanced settings
    $safe_advanced_settings = [
        'max_log_file_size' => '5MB',     // Smaller log files
        'log_retention_days' => 14,       // Shorter retention
        'enable_query_profiling' => false, // Profiling off by default
        'enable_memory_profiling' => false,
        'auto_optimize_database' => false, // No auto-optimization
        'backup_before_maintenance' => true
    ];
    cms_set_plugin_setting('admin_toolkit', 'advanced_settings', $safe_advanced_settings, 'json');
    
    // Log plugin initialization for security audit
    cms_plugin_debug_log(
        'admin_toolkit',
        'Admin Toolkit plugin initialized with secure default settings',
        'info',
        [
            'debug_mode' => false,
            'code_generation' => false,
            'email_notifications' => false,
            'security_monitoring' => true
        ]
    );
}

/**
 * Warm performance caches for better initial load times
 * Pre-populate caches with system information that's expensive
 * to calculate but frequently accessed.
 */
if (cms_get_plugin_setting('admin_toolkit', 'performance_monitoring', true)) {
    // Cache system metrics
    $system_metrics_key = 'system_overview';
    if (!cms_get_plugin_cache('performance_metrics', $system_metrics_key)) {
        $system_overview = [
            'php_version' => PHP_VERSION,
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown',
            'cache_enabled' => extension_loaded('memcached') || extension_loaded('redis'),
            'opcache_enabled' => extension_loaded('Zend OPcache') && opcache_get_status()['opcache_enabled'] ?? false
        ];
        cms_set_plugin_cache('performance_metrics', $system_metrics_key, $system_overview, 3600);
    }
}

// ============================================================================
// HELPER FUNCTIONS FOR DEVELOPMENT TOOLS
// ============================================================================

/**
 * Generate database-related files for plugin scaffolding
 * Creates migration files, model classes, and database schema definitions.
 */
function generate_database_files(string $plugin_dir, string $plugin_name): array {
    $files = [];
    
    // Create migrations directory
    $migrations_dir = $plugin_dir . '/migrations';
    if (!is_dir($migrations_dir)) {
        mkdir($migrations_dir, 0755, true);
    }
    
    // Generate initial migration file
    $migration_content = "-- Initial migration for {$plugin_name} plugin\n";
    $migration_content .= "-- Generated on " . date('Y-m-d H:i:s') . "\n\n";
    $migration_content .= "CREATE TABLE IF NOT EXISTS `{$plugin_name}_data` (\n";
    $migration_content .= "    `id` INT AUTO_INCREMENT PRIMARY KEY,\n";
    $migration_content .= "    `title` VARCHAR(255) NOT NULL,\n";
    $migration_content .= "    `content` TEXT,\n";
    $migration_content .= "    `status` VARCHAR(20) DEFAULT 'active',\n";
    $migration_content .= "    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n";
    $migration_content .= "    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP\n";
    $migration_content .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n";
    
    file_put_contents($migrations_dir . '/001_initial_tables.sql', $migration_content);
    $files[] = 'migrations/001_initial_tables.sql';
    
    return $files;
}

/**
 * Generate admin page files for plugin scaffolding
 * Creates admin interface files with proper permission checking and UI elements.
 */
function generate_admin_pages(string $plugin_dir, string $plugin_name, string $plugin_title): array {
    $files = [];
    
    // Create admin directory
    $admin_dir = $plugin_dir . '/admin';
    if (!is_dir($admin_dir)) {
        mkdir($admin_dir, 0755, true);
    }
    
    // Generate admin page template
    $admin_content = "<?php\n";
    $admin_content .= "// Admin page for {$plugin_title}\n";
    $admin_content .= "// Generated on " . date('Y-m-d H:i:s') . "\n\n";
    $admin_content .= "function render_{$plugin_name}_admin_page() {\n";
    $admin_content .= "    echo '<div class=\"{$plugin_name}-admin\">';\n";
    $admin_content .= "    echo '<h1>{$plugin_title} Administration</h1>';\n";
    $admin_content .= "    echo '<p>Configure your {$plugin_title} settings here.</p>';\n";
    $admin_content .= "    echo '</div>';\n";
    $admin_content .= "}\n";
    
    file_put_contents($admin_dir . '/admin_page.php', $admin_content);
    $files[] = 'admin/admin_page.php';
    
    return $files;
}

/**
 * Generate template files for plugin scaffolding
 * Creates Twig template files and template tag definitions.
 */
function generate_template_files(string $plugin_dir, string $plugin_name): array {
    $files = [];
    
    // Create templates directory
    $templates_dir = $plugin_dir . '/templates';
    if (!is_dir($templates_dir)) {
        mkdir($templates_dir, 0755, true);
    }
    
    // Generate sample template
    $template_content = "{# Template for {$plugin_name} #}\n";
    $template_content .= "{# Generated on " . date('Y-m-d H:i:s') . " #}\n\n";
    $template_content .= "<div class=\"{$plugin_name}-content\">\n";
    $template_content .= "    <h2>{{ title|default('Default Title') }}</h2>\n";
    $template_content .= "    <div class=\"content\">\n";
    $template_content .= "        {{ content|raw }}\n";
    $template_content .= "    </div>\n";
    $template_content .= "</div>\n";
    
    file_put_contents($templates_dir . '/default.twig', $template_content);
    $files[] = 'templates/default.twig';
    
    return $files;
}

/**
 * Generate widget files for plugin scaffolding
 * Creates dashboard widget definitions and rendering functions.
 */
function generate_widget_files(string $plugin_dir, string $plugin_name): array {
    $files = [];
    
    // Create widgets directory
    $widgets_dir = $plugin_dir . '/widgets';
    if (!is_dir($widgets_dir)) {
        mkdir($widgets_dir, 0755, true);
    }
    
    // Generate sample widget
    $widget_content = "<?php\n";
    $widget_content .= "// Widget definitions for {$plugin_name}\n";
    $widget_content .= "// Generated on " . date('Y-m-d H:i:s') . "\n\n";
    $widget_content .= "function render_{$plugin_name}_widget(\$config = []) {\n";
    $widget_content .= "    \$output = '<div class=\"{$plugin_name}-widget\">';\n";
    $widget_content .= "    \$output .= '<h4>Sample Widget</h4>';\n";
    $widget_content .= "    \$output .= '<p>This is a sample widget for {$plugin_name}.</p>';\n";
    $widget_content .= "    \$output .= '</div>';\n";
    $widget_content .= "    return \$output;\n";
    $widget_content .= "}\n";
    
    file_put_contents($widgets_dir . '/sample_widget.php', $widget_content);
    $files[] = 'widgets/sample_widget.php';
    
    return $files;
}

/**
 * Generate cache configuration files for plugin scaffolding
 * Creates cache namespace definitions and cache management utilities.
 */
function generate_cache_files(string $plugin_dir, string $plugin_name): array {
    $files = [];
    
    // Create cache directory
    $cache_dir = $plugin_dir . '/cache';
    if (!is_dir($cache_dir)) {
        mkdir($cache_dir, 0755, true);
    }
    
    // Generate cache configuration
    $cache_content = "<?php\n";
    $cache_content .= "// Cache configuration for {$plugin_name}\n";
    $cache_content .= "// Generated on " . date('Y-m-d H:i:s') . "\n\n";
    $cache_content .= "// Register cache namespaces\n";
    $cache_content .= "cms_register_cache_namespace('{$plugin_name}', '{$plugin_name}_data', [\n";
    $cache_content .= "    'description' => 'Main data cache for {$plugin_name}',\n";
    $cache_content .= "    'default_ttl' => 3600,\n";
    $cache_content .= "    'max_size' => '10MB',\n";
    $cache_content .= "    'auto_cleanup' => true\n";
    $cache_content .= "]);\n";
    
    file_put_contents($cache_dir . '/cache_config.php', $cache_content);
    $files[] = 'cache/cache_config.php';
    
    return $files;
}

/**
 * Generate language files for plugin scaffolding
 * Creates translation files for internationalization support.
 */
function generate_language_files(string $plugin_dir, string $plugin_name): array {
    $files = [];
    
    // Create languages directory
    $lang_dir = $plugin_dir . '/languages';
    if (!is_dir($lang_dir)) {
        mkdir($lang_dir, 0755, true);
    }
    
    // Generate English language file
    $en_content = "<?php\n";
    $en_content .= "// English translations for {$plugin_name}\n";
    $en_content .= "// Generated on " . date('Y-m-d H:i:s') . "\n\n";
    $en_content .= "return [\n";
    $en_content .= "    'plugin.title' => '" . ucfirst(str_replace('_', ' ', $plugin_name)) . "',\n";
    $en_content .= "    'plugin.description' => 'Description for {$plugin_name} plugin',\n";
    $en_content .= "    'ui.save' => 'Save',\n";
    $en_content .= "    'ui.cancel' => 'Cancel',\n";
    $en_content .= "    'ui.delete' => 'Delete',\n";
    $en_content .= "    'status.saved' => 'Changes saved successfully',\n";
    $en_content .= "    'error.save_failed' => 'Failed to save changes'\n";
    $en_content .= "];\n";
    
    file_put_contents($lang_dir . '/en.php', $en_content);
    $files[] = 'languages/en.php';
    
    return $files;
}

/**
 * Generate test files for plugin scaffolding
 * Creates PHPUnit test files and testing infrastructure.
 */
function generate_test_files(string $plugin_dir, string $plugin_name): array {
    $files = [];
    
    // Create tests directory
    $tests_dir = $plugin_dir . '/tests';
    if (!is_dir($tests_dir)) {
        mkdir($tests_dir, 0755, true);
    }
    
    // Generate sample test file
    $test_content = "<?php\n";
    $test_content .= "// Tests for {$plugin_name}\n";
    $test_content .= "// Generated on " . date('Y-m-d H:i:s') . "\n\n";
    $test_content .= "use PHPUnit\\Framework\\TestCase;\n\n";
    $test_content .= "class " . ucfirst($plugin_name) . "Test extends TestCase\n";
    $test_content .= "{\n";
    $test_content .= "    public function testPluginInitialization()\n";
    $test_content .= "    {\n";
    $test_content .= "        // Test plugin initialization\n";
    $test_content .= "        \$this->assertTrue(true);\n";
    $test_content .= "    }\n\n";
    $test_content .= "    public function testPluginSettings()\n";
    $test_content .= "    {\n";
    $test_content .= "        // Test plugin settings\n";
    $test_content .= "        \$this->assertTrue(true);\n";
    $test_content .= "    }\n";
    $test_content .= "}\n";
    
    file_put_contents($tests_dir . '/' . ucfirst($plugin_name) . 'Test.php', $test_content);
    $files[] = 'tests/' . ucfirst($plugin_name) . 'Test.php';
    
    return $files;
}

/**
 * Generate composer.json file for plugin scaffolding
 * Creates dependency management configuration for the plugin.
 */
function generate_composer_file(string $plugin_dir, array $config): void {
    $composer_data = [
        'name' => 'steamcms/' . $config['plugin_name'],
        'description' => $config['plugin_title'] ?? 'A SteamCMS plugin',
        'type' => 'steamcms-plugin',
        'license' => $config['license'] ?? 'MIT',
        'authors' => [
            [
                'name' => $config['author_name'] ?? 'Plugin Author',
                'email' => $config['author_email'] ?? 'author@example.com'
            ]
        ],
        'require' => [
            'php' => '>=8.0'
        ],
        'autoload' => [
            'psr-4' => [
                ucfirst($config['plugin_name']) . '\\' => 'src/'
            ]
        ]
    ];
    
    if ($config['include_tests'] ?? false) {
        $composer_data['require-dev'] = [
            'phpunit/phpunit' => '^9.0'
        ];
        $composer_data['autoload-dev'] = [
            'psr-4' => [
                ucfirst($config['plugin_name']) . '\\Tests\\' => 'tests/'
            ]
        ];
    }
    
    file_put_contents($plugin_dir . '/composer.json', json_encode($composer_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

/**
 * Analyze table structure for database analysis tool
 * Examines table columns, indexes, and constraints.
 */
function analyze_table_structure(PDO $db, string $table): array {
    // This is a simplified example - real implementation would be more comprehensive
    $table_info = [
        'name' => $table,
        'columns' => [],
        'indexes' => [],
        'row_count' => 0,
        'data_size' => 0,
        'created' => null
    ];
    
    try {
        // Get column information
        $columns_stmt = $db->query("DESCRIBE `{$table}`");
        $table_info['columns'] = $columns_stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get index information
        $indexes_stmt = $db->query("SHOW INDEX FROM `{$table}`");
        $table_info['indexes'] = $indexes_stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get table statistics
        $stats_stmt = $db->query("SELECT COUNT(*) as row_count FROM `{$table}`");
        $stats = $stats_stmt->fetch(PDO::FETCH_ASSOC);
        $table_info['row_count'] = $stats['row_count'];
        
    } catch (Exception $e) {
        cms_plugin_debug_log('admin_toolkit', 'Error analyzing table: ' . $e->getMessage(), 'error');
    }
    
    return $table_info;
}

/**
 * Suggest indexes for database optimization
 * Analyzes table structure and suggests missing indexes.
 */
function suggest_indexes(PDO $db, string $table, array $table_info): array {
    $suggestions = [];
    
    // Simple example: suggest indexes for foreign key columns
    foreach ($table_info['columns'] as $column) {
        $column_name = $column['Field'];
        
        // Look for potential foreign key columns
        if (str_ends_with($column_name, '_id') && $column['Key'] !== 'PRI') {
            $has_index = false;
            foreach ($table_info['indexes'] as $index) {
                if ($index['Column_name'] === $column_name) {
                    $has_index = true;
                    break;
                }
            }
            
            if (!$has_index) {
                $suggestions[] = [
                    'type' => 'index',
                    'table' => $table,
                    'column' => $column_name,
                    'reason' => 'Foreign key column without index',
                    'sql' => "ALTER TABLE `{$table}` ADD INDEX `idx_{$column_name}` (`{$column_name}`)"
                ];
            }
        }
    }
    
    return $suggestions;
}

/**
 * Check for table issues and warnings
 * Identifies potential problems with table structure or data.
 */
function check_table_issues(PDO $db, string $table, array $table_info): array {
    $warnings = [];
    
    // Check for tables without primary keys
    $has_primary_key = false;
    foreach ($table_info['indexes'] as $index) {
        if ($index['Key_name'] === 'PRIMARY') {
            $has_primary_key = true;
            break;
        }
    }
    
    if (!$has_primary_key) {
        $warnings[] = [
            'type' => 'warning',
            'table' => $table,
            'issue' => 'No primary key defined',
            'impact' => 'May affect replication and performance',
            'recommendation' => 'Add a primary key column'
        ];
    }
    
    // Check for large tables without indexes
    if ($table_info['row_count'] > 1000 && count($table_info['indexes']) <= 1) {
        $warnings[] = [
            'type' => 'performance',
            'table' => $table,
            'issue' => 'Large table with few indexes',
            'impact' => 'Queries may be slow',
            'recommendation' => 'Consider adding indexes on frequently queried columns'
        ];
    }
    
    return $warnings;
}