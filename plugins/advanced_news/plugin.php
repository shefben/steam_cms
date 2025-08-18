<?php
/**
 * Advanced News Plugin - Example Plugin #1
 * ==========================================
 * 
 * This plugin demonstrates the comprehensive database, content management,
 * and template features of the SteamCMS Plugin API. It showcases:
 * - Database migrations and custom table creation
 * - Plugin settings with type validation
 * - Custom content types and news categories
 * - Template blocks and overrides
 * - Page builder components
 * - Multi-language support
 * 
 * This plugin creates an advanced news system with custom fields,
 * categories, and enhanced display options.
 */

declare(strict_types=1);

// ============================================================================
// DATABASE MIGRATION SYSTEM DEMONSTRATION
// ============================================================================

/**
 * Register database migration for version 1.0.0
 * This creates the initial table structure for our advanced news features.
 * Migrations allow plugins to evolve their database schema over time while
 * tracking which updates have been applied to prevent duplicate execution.
 */
cms_register_plugin_migration(
    'advanced_news',                    // Plugin identifier used for tracking
    '1.0.0',                           // Version number for this migration
    __DIR__ . '/migrations/001_initial_tables.sql',  // Path to SQL migration file
    'Create initial advanced news tables with custom fields and categories'  // Human-readable description
);

/**
 * Register database migration for version 1.1.0
 * This demonstrates how plugins can add new features over time through
 * additional migrations. Each migration builds upon the previous structure.
 */
cms_register_plugin_migration(
    'advanced_news',                    // Same plugin identifier
    '1.1.0',                           // New version number
    __DIR__ . '/migrations/002_add_featured_system.sql',  // Additional migration
    'Add featured articles system with priority ordering and expiration dates'
);

// ============================================================================
// CUSTOM DATABASE TABLE REGISTRATION
// ============================================================================

/**
 * Register custom table schema for advanced news articles
 * This creates a table structure that extends the core news system with
 * additional fields for enhanced functionality. The schema definition
 * includes column types, constraints, indexes, and foreign key relationships.
 */
cms_register_plugin_table(
    'advanced_news',           // Plugin name for organization
    'advanced_news_articles',  // Table name (without prefix)
    [
        'columns' => [
            'id' => [
                'type' => 'INT',
                'length' => 11,
                'null' => false,
                'auto_increment' => true,
                'comment' => 'Primary key for advanced news articles'
            ],
            'core_news_id' => [
                'type' => 'INT',
                'length' => 11,
                'null' => false,
                'comment' => 'Foreign key to core news table'
            ],
            'featured_priority' => [
                'type' => 'INT',
                'length' => 3,
                'null' => true,
                'default' => 0,
                'comment' => 'Priority for featured articles (higher = more prominent)'
            ],
            'featured_expires' => [
                'type' => 'DATETIME',
                'null' => true,
                'comment' => 'When featured status expires'
            ],
            'custom_excerpt' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Custom excerpt override for article summaries'
            ],
            'tags' => [
                'type' => 'VARCHAR',
                'length' => 500,
                'null' => true,
                'comment' => 'Comma-separated tags for categorization'
            ],
            'reading_time_minutes' => [
                'type' => 'INT',
                'length' => 4,
                'null' => true,
                'comment' => 'Estimated reading time in minutes'
            ],
            'author_bio' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Extended author biography for this article'
            ],
            'social_image' => [
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => true,
                'comment' => 'Custom social media sharing image path'
            ]
        ],
        'primary_key' => 'id',  // Define primary key
        'indexes' => [
            'idx_core_news' => 'core_news_id',  // Index for foreign key lookups
            'idx_featured' => ['featured_priority', 'featured_expires'],  // Composite index for featured articles
            'idx_tags' => 'tags'  // Index for tag-based searches
        ],
        'foreign_keys' => [
            [
                'column' => 'core_news_id',     // Local column
                'table' => 'news',              // Referenced table
                'reference' => 'id'             // Referenced column
            ]
        ]
    ]
);

/**
 * Register custom table for news article comments
 * This demonstrates creating additional related tables that work together
 * to provide comprehensive functionality for the plugin.
 */
cms_register_plugin_table(
    'advanced_news',
    'advanced_news_comments',
    [
        'columns' => [
            'id' => [
                'type' => 'INT',
                'length' => 11,
                'null' => false,
                'auto_increment' => true
            ],
            'article_id' => [
                'type' => 'INT',
                'length' => 11,
                'null' => false,
                'comment' => 'References advanced_news_articles.id'
            ],
            'author_name' => [
                'type' => 'VARCHAR',
                'length' => 100,
                'null' => false,
                'comment' => 'Comment author display name'
            ],
            'author_email' => [
                'type' => 'VARCHAR',
                'length' => 255,
                'null' => false,
                'comment' => 'Comment author email (not displayed publicly)'
            ],
            'comment_text' => [
                'type' => 'TEXT',
                'null' => false,
                'comment' => 'The actual comment content'
            ],
            'is_approved' => [
                'type' => 'BOOLEAN',
                'default' => 0,
                'comment' => 'Whether comment has been approved for display'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
                'comment' => 'When comment was submitted'
            ]
        ],
        'primary_key' => 'id',
        'indexes' => [
            'idx_article' => 'article_id',
            'idx_approved' => 'is_approved',
            'idx_created' => 'created_at'
        ]
    ]
);

// ============================================================================
// PLUGIN SETTINGS CONFIGURATION
// ============================================================================

/**
 * Register comprehensive plugin settings schema
 * This defines all configurable options for the plugin with type validation,
 * default values, and administrative interfaces. Settings are automatically
 * validated and type-cast when retrieved or stored.
 */
cms_register_plugin_settings('advanced_news', [
    // Boolean setting for enabling/disabling the entire plugin
    'enabled' => [
        'type' => 'bool',           // Data type validation
        'default' => true,          // Default value when not set
        'label' => 'Enable Advanced News Features',
        'description' => 'Master switch to enable or disable all advanced news functionality'
    ],
    
    // Integer setting for controlling display behavior
    'featured_articles_limit' => [
        'type' => 'int',
        'default' => 5,
        'label' => 'Featured Articles Limit',
        'description' => 'Maximum number of featured articles to display on the homepage'
    ],
    
    // String setting for customizing display text
    'read_more_text' => [
        'type' => 'string',
        'default' => 'Continue Reading →',
        'label' => 'Read More Link Text',
        'description' => 'Custom text for article read-more links'
    ],
    
    // Array setting for managing multiple values
    'allowed_tags' => [
        'type' => 'array',
        'default' => ['gaming', 'updates', 'community', 'technical', 'announcements'],
        'label' => 'Allowed Article Tags',
        'description' => 'Predefined tags that can be assigned to articles'
    ],
    
    // JSON setting for complex configuration data
    'display_options' => [
        'type' => 'json',
        'default' => [
            'show_reading_time' => true,
            'show_author_bio' => false,
            'enable_comments' => true,
            'auto_excerpt_length' => 150
        ],
        'label' => 'Display Configuration',
        'description' => 'Advanced display options for article presentation'
    ]
]);

// ============================================================================
// CUSTOM CONTENT TYPE REGISTRATION
// ============================================================================

/**
 * Register advanced article content type
 * This creates a new content type that extends beyond basic news articles,
 * providing additional fields and functionality. Content types can have
 * custom admin interfaces, validation rules, and display templates.
 */
cms_register_content_type(
    'advanced_news',              // Plugin identifier
    'advanced_article',           // Content type slug
    [
        'label' => 'Advanced Article',
        'description' => 'Enhanced news article with additional features and metadata',
        'icon' => 'newspaper',     // Icon identifier for admin interface
        'supports' => [            // Features this content type supports
            'title',
            'content', 
            'excerpt',
            'featured_image',
            'comments',
            'tags',
            'seo_metadata'
        ],
        'fields' => [              // Custom fields specific to this content type
            'subtitle' => [
                'type' => 'text',
                'label' => 'Article Subtitle',
                'description' => 'Optional subtitle displayed below the main title'
            ],
            'reading_difficulty' => [
                'type' => 'select',
                'label' => 'Reading Difficulty',
                'options' => ['beginner', 'intermediate', 'advanced', 'expert'],
                'default' => 'intermediate'
            ],
            'related_games' => [
                'type' => 'multiselect',
                'label' => 'Related Games',
                'description' => 'Select games that this article discusses'
            ],
            'external_links' => [
                'type' => 'repeater',    // Allows multiple entries
                'label' => 'External Links',
                'fields' => [
                    'title' => ['type' => 'text', 'label' => 'Link Title'],
                    'url' => ['type' => 'url', 'label' => 'URL'],
                    'description' => ['type' => 'textarea', 'label' => 'Description']
                ]
            ]
        ],
        'admin_columns' => [       // Columns shown in admin list view
            'title',
            'reading_difficulty', 
            'featured_priority',
            'created_date'
        ],
        'admin_permissions' => [   // Required permissions for managing this content type
            'create' => 'create_advanced_articles',
            'edit' => 'edit_advanced_articles',
            'delete' => 'delete_advanced_articles'
        ]
    ]
);

// ============================================================================
// NEWS SYSTEM EXTENSIONS
// ============================================================================

/**
 * Register custom news category for game reviews
 * This extends the core news system with specialized categories that have
 * their own display templates, metadata, and processing rules.
 */
cms_register_news_category(
    'advanced_news',              // Plugin identifier
    'game_reviews',               // Category slug
    [
        'label' => 'Game Reviews',
        'description' => 'In-depth reviews of Steam games with scoring and recommendations',
        'icon' => 'star-rating',
        'template_override' => 'news/game-review.twig',  // Custom template for this category
        'custom_fields' => [       // Additional fields specific to this category
            'overall_score' => [
                'type' => 'number',
                'label' => 'Overall Score',
                'min' => 0,
                'max' => 10,
                'step' => 0.1,
                'description' => 'Overall game rating out of 10'
            ],
            'gameplay_score' => [
                'type' => 'number',
                'label' => 'Gameplay Score',
                'min' => 0,
                'max' => 10,
                'step' => 0.1
            ],
            'graphics_score' => [
                'type' => 'number', 
                'label' => 'Graphics Score',
                'min' => 0,
                'max' => 10,
                'step' => 0.1
            ],
            'sound_score' => [
                'type' => 'number',
                'label' => 'Sound Score', 
                'min' => 0,
                'max' => 10,
                'step' => 0.1
            ],
            'recommended' => [
                'type' => 'boolean',
                'label' => 'Recommended',
                'description' => 'Whether this game is recommended for purchase'
            ],
            'playtime_hours' => [
                'type' => 'number',
                'label' => 'Playtime (Hours)',
                'description' => 'How many hours the reviewer spent playing'
            ]
        ],
        'display_options' => [
            'show_scores_summary' => true,
            'enable_user_ratings' => true,
            'require_playtime' => true
        ]
    ]
);

/**
 * Register custom news category for developer interviews
 * This demonstrates creating multiple specialized categories with different
 * field sets and display requirements.
 */
cms_register_news_category(
    'advanced_news',
    'developer_interviews', 
    [
        'label' => 'Developer Interviews',
        'description' => 'Exclusive interviews with game developers and industry professionals',
        'icon' => 'microphone',
        'template_override' => 'news/developer-interview.twig',
        'custom_fields' => [
            'interviewee_name' => [
                'type' => 'text',
                'label' => 'Interviewee Name',
                'required' => true
            ],
            'interviewee_title' => [
                'type' => 'text',
                'label' => 'Job Title/Role',
                'required' => true
            ],
            'company_name' => [
                'type' => 'text',
                'label' => 'Company/Studio',
                'required' => true
            ],
            'interview_date' => [
                'type' => 'date',
                'label' => 'Interview Date'
            ],
            'interview_format' => [
                'type' => 'select',
                'label' => 'Interview Format',
                'options' => ['written', 'video', 'audio', 'live_stream'],
                'default' => 'written'
            ],
            'featured_projects' => [
                'type' => 'textarea',
                'label' => 'Featured Projects',
                'description' => 'Games or projects discussed in the interview'
            ]
        ]
    ]
);

// ============================================================================
// TEMPLATE BLOCK REGISTRATION
// ============================================================================

/**
 * Register template block for featured articles slider
 * Template blocks allow plugins to inject custom content into existing
 * templates at specific positions. This block creates a featured articles
 * carousel that can be positioned on any page.
 */
cms_register_template_block(
    'advanced_news',                    // Plugin identifier
    'featured_articles_slider',         // Block name
    function($context) {                // Rendering function that receives template context
        // Get plugin settings to determine how many articles to show
        $limit = cms_get_plugin_setting('advanced_news', 'featured_articles_limit', 5);
        
        // Get display options from plugin settings
        $display_options = cms_get_plugin_setting('advanced_news', 'display_options', []);
        
        // Generate dynamic content based on current context and settings
        $output = '<div class="featured-articles-slider" data-limit="' . $limit . '">';
        $output .= '<h3>Featured Articles</h3>';
        $output .= '<div class="slider-container">';
        
        // This would normally query the database for featured articles
        // For demo purposes, we'll show placeholder content
        for ($i = 1; $i <= $limit; $i++) {
            $output .= '<div class="featured-article-slide">';
            $output .= '<h4>Featured Article ' . $i . '</h4>';
            $output .= '<p>This is a placeholder for featured article content...</p>';
            if ($display_options['show_reading_time'] ?? true) {
                $output .= '<span class="reading-time">5 min read</span>';
            }
            $output .= '</div>';
        }
        
        $output .= '</div></div>';
        return $output;
    },
    [
        'locations' => ['homepage_main', 'news_index_top'],  // Where this block can appear
        'themes' => ['2005_v1', '2006_v1']  // Theme compatibility
    ],
    15  // Priority (higher numbers render first)
);

/**
 * Register template block for article statistics
 * This block demonstrates how to create informational widgets that can
 * be placed in sidebars or other template positions.
 */
cms_register_template_block(
    'advanced_news',
    'article_statistics',
    function($context) {
        $stats = [
            'total_articles' => 150,  // Would normally query database
            'featured_articles' => 8,
            'total_comments' => 1250,
            'avg_reading_time' => 7
        ];
        
        $output = '<div class="article-statistics-widget">';
        $output .= '<h4>Article Statistics</h4>';
        $output .= '<ul class="stats-list">';
        $output .= '<li><strong>' . $stats['total_articles'] . '</strong> Total Articles</li>';
        $output .= '<li><strong>' . $stats['featured_articles'] . '</strong> Featured</li>';
        $output .= '<li><strong>' . $stats['total_comments'] . '</strong> Comments</li>';
        $output .= '<li><strong>' . $stats['avg_reading_time'] . '</strong> min avg read time</li>';
        $output .= '</ul></div>';
        
        return $output;
    },
    [
        'locations' => ['sidebar_primary', 'sidebar_secondary', 'dashboard_widgets']
    ],
    5  // Lower priority, renders later
);

// ============================================================================
// TEMPLATE OVERRIDE REGISTRATION
// ============================================================================

/**
 * Register template override for news article display
 * Template overrides allow plugins to completely replace how certain
 * content is rendered, providing a fallback hierarchy from plugin to
 * theme to core templates.
 */
cms_register_template_override(
    'advanced_news',                    // Plugin identifier
    'news/article.twig',                // Original template path to override
    __DIR__ . '/templates/enhanced-article.twig',  // Plugin's replacement template
    ['2005_v1', '2006_v1', '2007_v1']   // Only override for these themes
);

/**
 * Register template override for news listing page
 * This demonstrates overriding list views to provide enhanced functionality
 * such as filtering, sorting, and advanced pagination.
 */
cms_register_template_override(
    'advanced_news',
    'news/index.twig',
    __DIR__ . '/templates/enhanced-news-index.twig',
    []  // Empty array means applies to all themes
);

/**
 * Register template override for news RSS feed
 * This shows how plugins can even override non-HTML templates to provide
 * enhanced data formats or additional metadata.
 */
cms_register_template_override(
    'advanced_news',
    'news/rss.xml.twig',
    __DIR__ . '/templates/enhanced-rss.xml.twig'
);

// ============================================================================
// PAGE BUILDER COMPONENTS
// ============================================================================

/**
 * Register article showcase page builder component
 * Page builder components allow content creators to drag and drop
 * pre-built elements onto pages. Each component has configurable
 * options and renders dynamic content.
 */
cms_register_page_builder_component(
    'advanced_news',                    // Plugin identifier
    'article_showcase',                 // Component identifier
    [
        'title' => 'Article Showcase',
        'description' => 'Display a customizable grid of featured articles with filtering options',
        'icon' => 'grid-layout',
        'category' => 'content',        // Component category for organization
        'config_fields' => [            // Configuration options for content creators
            'display_style' => [
                'type' => 'select',
                'label' => 'Display Style',
                'options' => [
                    'grid' => 'Grid Layout',
                    'list' => 'List Layout', 
                    'carousel' => 'Carousel',
                    'masonry' => 'Masonry Grid'
                ],
                'default' => 'grid'
            ],
            'articles_per_row' => [
                'type' => 'number',
                'label' => 'Articles Per Row',
                'min' => 1,
                'max' => 6,
                'default' => 3,
                'description' => 'Only applies to grid layouts'
            ],
            'article_limit' => [
                'type' => 'number',
                'label' => 'Maximum Articles',
                'min' => 1,
                'max' => 50,
                'default' => 12
            ],
            'filter_by_category' => [
                'type' => 'multiselect',
                'label' => 'Filter by Categories',
                'options' => ['game_reviews', 'developer_interviews', 'announcements', 'community'],
                'description' => 'Leave empty to show all categories'
            ],
            'show_excerpts' => [
                'type' => 'checkbox',
                'label' => 'Show Article Excerpts',
                'default' => true
            ],
            'show_reading_time' => [
                'type' => 'checkbox',
                'label' => 'Show Reading Time',
                'default' => true
            ],
            'enable_lazy_loading' => [
                'type' => 'checkbox',
                'label' => 'Enable Lazy Loading',
                'default' => true,
                'description' => 'Improves page performance for large article lists'
            ]
        ],
        'renderer' => function($config, $content) {  // Function that renders the component
            $style = $config['display_style'] ?? 'grid';
            $per_row = $config['articles_per_row'] ?? 3;
            $limit = $config['article_limit'] ?? 12;
            $categories = $config['filter_by_category'] ?? [];
            
            $output = '<div class="article-showcase" data-style="' . $style . '" data-per-row="' . $per_row . '">';
            
            if (!empty($categories)) {
                $output .= '<div class="showcase-filters">';
                $output .= '<h4>Filtered by: ' . implode(', ', $categories) . '</h4>';
                $output .= '</div>';
            }
            
            $output .= '<div class="showcase-grid">';
            
            // Generate sample articles (would normally query database)
            for ($i = 1; $i <= $limit; $i++) {
                $output .= '<article class="showcase-article">';
                $output .= '<h3>Sample Article ' . $i . '</h3>';
                
                if ($config['show_excerpts'] ?? true) {
                    $output .= '<p class="excerpt">This is a sample excerpt for article ' . $i . '...</p>';
                }
                
                if ($config['show_reading_time'] ?? true) {
                    $output .= '<span class="reading-time">' . rand(3, 15) . ' min read</span>';
                }
                
                $output .= '</article>';
            }
            
            $output .= '</div></div>';
            return $output;
        }
    ]
);

/**
 * Register comment system page builder component
 * This component provides an embeddable comment system that can be
 * added to any page through the page builder interface.
 */
cms_register_page_builder_component(
    'advanced_news',
    'comment_system',
    [
        'title' => 'Advanced Comment System',
        'description' => 'Add a threaded comment system with moderation to any page',
        'icon' => 'comments',
        'category' => 'interactive',
        'config_fields' => [
            'enable_threading' => [
                'type' => 'checkbox',
                'label' => 'Enable Threaded Replies',
                'default' => true,
                'description' => 'Allow users to reply to specific comments'
            ],
            'max_thread_depth' => [
                'type' => 'number',
                'label' => 'Maximum Thread Depth',
                'min' => 1,
                'max' => 10,
                'default' => 3,
                'description' => 'How deep reply threads can go'
            ],
            'require_approval' => [
                'type' => 'checkbox',
                'label' => 'Require Comment Approval',
                'default' => true
            ],
            'allow_guest_comments' => [
                'type' => 'checkbox',
                'label' => 'Allow Guest Comments',
                'default' => false,
                'description' => 'Allow comments from non-registered users'
            ],
            'spam_protection' => [
                'type' => 'select',
                'label' => 'Spam Protection Level',
                'options' => [
                    'none' => 'None',
                    'basic' => 'Basic Filtering',
                    'moderate' => 'Moderate Protection',
                    'strict' => 'Strict Protection'
                ],
                'default' => 'moderate'
            ]
        ],
        'renderer' => function($config, $content) {
            $threading = $config['enable_threading'] ?? true;
            $max_depth = $config['max_thread_depth'] ?? 3;
            $require_approval = $config['require_approval'] ?? true;
            
            $output = '<div class="advanced-comment-system">';
            $output .= '<h4>Comments</h4>';
            
            if ($require_approval) {
                $output .= '<p class="moderation-notice">Comments are moderated and may take time to appear.</p>';
            }
            
            $output .= '<div class="comment-form">';
            $output .= '<textarea placeholder="Write your comment..."></textarea>';
            $output .= '<button type="submit">Post Comment</button>';
            $output .= '</div>';
            
            $output .= '<div class="comments-list">';
            $output .= '<div class="comment" data-threading="' . ($threading ? 'enabled' : 'disabled') . '">';
            $output .= '<strong>Sample User:</strong> This is an example comment to show the layout.';
            if ($threading) {
                $output .= '<button class="reply-btn">Reply</button>';
            }
            $output .= '</div>';
            $output .= '</div>';
            
            $output .= '</div>';
            return $output;
        }
    ]
);

// ============================================================================
// MULTI-LANGUAGE SUPPORT
// ============================================================================

/**
 * Register English language pack
 * Multi-language support allows plugins to provide translations for all
 * user-facing text. This enables the same plugin to work across different
 * language installations of the CMS.
 */
cms_register_plugin_language_pack(
    'advanced_news',    // Plugin identifier
    'en',              // Language code (ISO 639-1)
    [
        // Navigation and menu items
        'menu.advanced_news' => 'Advanced News',
        'menu.manage_articles' => 'Manage Articles',
        'menu.featured_articles' => 'Featured Articles',
        'menu.comment_moderation' => 'Comment Moderation',
        'menu.analytics' => 'News Analytics',
        
        // Article management
        'article.title' => 'Article Title',
        'article.subtitle' => 'Subtitle',
        'article.content' => 'Article Content', 
        'article.excerpt' => 'Excerpt',
        'article.tags' => 'Tags',
        'article.featured' => 'Featured Article',
        'article.reading_time' => 'Reading Time',
        'article.author_bio' => 'Author Biography',
        
        // Comments system
        'comments.title' => 'Comments',
        'comments.add_comment' => 'Add Comment',
        'comments.reply' => 'Reply',
        'comments.approve' => 'Approve',
        'comments.reject' => 'Reject',
        'comments.moderate' => 'Moderate',
        'comments.guest_name' => 'Your Name',
        'comments.guest_email' => 'Your Email',
        
        // User interface elements
        'ui.save' => 'Save',
        'ui.cancel' => 'Cancel',
        'ui.delete' => 'Delete',
        'ui.edit' => 'Edit',
        'ui.view' => 'View',
        'ui.loading' => 'Loading...',
        'ui.search' => 'Search',
        'ui.filter' => 'Filter',
        'ui.sort' => 'Sort',
        
        // Status messages
        'status.saved' => 'Article saved successfully',
        'status.deleted' => 'Article deleted successfully',
        'status.featured' => 'Article featured successfully',
        'status.unfeatured' => 'Article removed from featured',
        'status.comment_approved' => 'Comment approved',
        'status.comment_rejected' => 'Comment rejected',
        
        // Error messages
        'error.title_required' => 'Article title is required',
        'error.content_required' => 'Article content is required',
        'error.invalid_tag' => 'Invalid tag format',
        'error.save_failed' => 'Failed to save article',
        'error.delete_failed' => 'Failed to delete article',
        'error.permission_denied' => 'Permission denied',
        
        // Validation messages
        'validation.email_invalid' => 'Please enter a valid email address',
        'validation.name_too_short' => 'Name must be at least 2 characters',
        'validation.comment_too_short' => 'Comment must be at least 10 characters',
        'validation.tags_invalid' => 'Tags must be comma-separated words',
        
        // Analytics and statistics
        'analytics.total_views' => 'Total Views',
        'analytics.unique_visitors' => 'Unique Visitors',
        'analytics.avg_time_on_page' => 'Average Time on Page',
        'analytics.bounce_rate' => 'Bounce Rate',
        'analytics.popular_articles' => 'Most Popular Articles',
        'analytics.trending_tags' => 'Trending Tags'
    ]
);

/**
 * Register Spanish language pack
 * This demonstrates how the same plugin can support multiple languages
 * with complete translation coverage. Users can switch languages and
 * see the plugin interface in their preferred language.
 */
cms_register_plugin_language_pack(
    'advanced_news',
    'es',  // Spanish language code
    [
        // Navigation and menu items
        'menu.advanced_news' => 'Noticias Avanzadas',
        'menu.manage_articles' => 'Gestionar Artículos',
        'menu.featured_articles' => 'Artículos Destacados',
        'menu.comment_moderation' => 'Moderación de Comentarios',
        'menu.analytics' => 'Análisis de Noticias',
        
        // Article management
        'article.title' => 'Título del Artículo',
        'article.subtitle' => 'Subtítulo',
        'article.content' => 'Contenido del Artículo',
        'article.excerpt' => 'Extracto',
        'article.tags' => 'Etiquetas',
        'article.featured' => 'Artículo Destacado',
        'article.reading_time' => 'Tiempo de Lectura',
        'article.author_bio' => 'Biografía del Autor',
        
        // Comments system
        'comments.title' => 'Comentarios',
        'comments.add_comment' => 'Agregar Comentario',
        'comments.reply' => 'Responder',
        'comments.approve' => 'Aprobar',
        'comments.reject' => 'Rechazar',
        'comments.moderate' => 'Moderar',
        'comments.guest_name' => 'Tu Nombre',
        'comments.guest_email' => 'Tu Email',
        
        // User interface elements
        'ui.save' => 'Guardar',
        'ui.cancel' => 'Cancelar',
        'ui.delete' => 'Eliminar',
        'ui.edit' => 'Editar',
        'ui.view' => 'Ver',
        'ui.loading' => 'Cargando...',
        'ui.search' => 'Buscar',
        'ui.filter' => 'Filtrar',
        'ui.sort' => 'Ordenar',
        
        // Status messages
        'status.saved' => 'Artículo guardado exitosamente',
        'status.deleted' => 'Artículo eliminado exitosamente',
        'status.featured' => 'Artículo destacado exitosamente',
        'status.unfeatured' => 'Artículo removido de destacados',
        'status.comment_approved' => 'Comentario aprobado',
        'status.comment_rejected' => 'Comentario rechazado',
        
        // Error messages
        'error.title_required' => 'El título del artículo es requerido',
        'error.content_required' => 'El contenido del artículo es requerido',
        'error.invalid_tag' => 'Formato de etiqueta inválido',
        'error.save_failed' => 'Error al guardar el artículo',
        'error.delete_failed' => 'Error al eliminar el artículo',
        'error.permission_denied' => 'Permiso denegado',
        
        // Validation messages
        'validation.email_invalid' => 'Por favor ingresa un email válido',
        'validation.name_too_short' => 'El nombre debe tener al menos 2 caracteres',
        'validation.comment_too_short' => 'El comentario debe tener al menos 10 caracteres',
        'validation.tags_invalid' => 'Las etiquetas deben estar separadas por comas',
        
        // Analytics and statistics
        'analytics.total_views' => 'Vistas Totales',
        'analytics.unique_visitors' => 'Visitantes Únicos',
        'analytics.avg_time_on_page' => 'Tiempo Promedio en Página',
        'analytics.bounce_rate' => 'Tasa de Rebote',
        'analytics.popular_articles' => 'Artículos Más Populares',
        'analytics.trending_tags' => 'Etiquetas en Tendencia'
    ]
);

/**
 * Register French language pack
 * Adding a third language demonstrates the scalability of the translation
 * system and how plugins can support global audiences.
 */
cms_register_plugin_language_pack(
    'advanced_news',
    'fr',  // French language code
    [
        // Navigation and menu items  
        'menu.advanced_news' => 'Actualités Avancées',
        'menu.manage_articles' => 'Gérer les Articles',
        'menu.featured_articles' => 'Articles en Vedette',
        'menu.comment_moderation' => 'Modération des Commentaires',
        'menu.analytics' => 'Analyses des Actualités',
        
        // Article management
        'article.title' => 'Titre de l\'Article',
        'article.subtitle' => 'Sous-titre',
        'article.content' => 'Contenu de l\'Article',
        'article.excerpt' => 'Extrait',
        'article.tags' => 'Étiquettes',
        'article.featured' => 'Article en Vedette',
        'article.reading_time' => 'Temps de Lecture',
        'article.author_bio' => 'Biographie de l\'Auteur',
        
        // Comments system
        'comments.title' => 'Commentaires',
        'comments.add_comment' => 'Ajouter un Commentaire',
        'comments.reply' => 'Répondre',
        'comments.approve' => 'Approuver',
        'comments.reject' => 'Rejeter',
        'comments.moderate' => 'Modérer',
        'comments.guest_name' => 'Votre Nom',
        'comments.guest_email' => 'Votre Email',
        
        // User interface elements
        'ui.save' => 'Sauvegarder',
        'ui.cancel' => 'Annuler',
        'ui.delete' => 'Supprimer',
        'ui.edit' => 'Modifier',
        'ui.view' => 'Voir',
        'ui.loading' => 'Chargement...',
        'ui.search' => 'Rechercher',
        'ui.filter' => 'Filtrer',
        'ui.sort' => 'Trier',
        
        // Status messages
        'status.saved' => 'Article sauvegardé avec succès',
        'status.deleted' => 'Article supprimé avec succès',
        'status.featured' => 'Article mis en vedette avec succès',
        'status.unfeatured' => 'Article retiré de la vedette',
        'status.comment_approved' => 'Commentaire approuvé',
        'status.comment_rejected' => 'Commentaire rejeté',
        
        // Error messages
        'error.title_required' => 'Le titre de l\'article est requis',
        'error.content_required' => 'Le contenu de l\'article est requis',
        'error.invalid_tag' => 'Format d\'étiquette invalide',
        'error.save_failed' => 'Échec de la sauvegarde de l\'article',
        'error.delete_failed' => 'Échec de la suppression de l\'article',
        'error.permission_denied' => 'Permission refusée',
        
        // Validation messages
        'validation.email_invalid' => 'Veuillez entrer une adresse email valide',
        'validation.name_too_short' => 'Le nom doit avoir au moins 2 caractères',
        'validation.comment_too_short' => 'Le commentaire doit avoir au moins 10 caractères',
        'validation.tags_invalid' => 'Les étiquettes doivent être séparées par des virgules',
        
        // Analytics and statistics
        'analytics.total_views' => 'Vues Totales',
        'analytics.unique_visitors' => 'Visiteurs Uniques',
        'analytics.avg_time_on_page' => 'Temps Moyen sur la Page',
        'analytics.bounce_rate' => 'Taux de Rebond',
        'analytics.popular_articles' => 'Articles les Plus Populaires',
        'analytics.trending_tags' => 'Étiquettes Tendance'
    ]
);

// ============================================================================
// ADMIN PAGE REGISTRATION WITH INTERNATIONALIZATION
// ============================================================================

/**
 * Register main admin page for plugin management
 * This creates the primary administrative interface for the plugin,
 * demonstrating how to use translation functions and provide a
 * comprehensive management interface.
 */
cms_register_admin_page(
    'advanced_news_dashboard',          // Page slug
    cms_plugin_translate('advanced_news', 'menu.advanced_news', null, 'Advanced News'),  // Translated title
    function() {
        // Use translation function to get localized text
        $title = cms_plugin_translate('advanced_news', 'menu.advanced_news');
        $manage_text = cms_plugin_translate('advanced_news', 'menu.manage_articles');
        $featured_text = cms_plugin_translate('advanced_news', 'menu.featured_articles');
        
        echo '<div class="advanced-news-dashboard">';
        echo '<h1>' . htmlspecialchars($title) . '</h1>';
        
        // Display plugin status and key metrics
        echo '<div class="dashboard-stats">';
        echo '<div class="stat-card">';
        echo '<h3>150</h3>';
        echo '<p>' . cms_plugin_translate('advanced_news', 'analytics.total_views') . '</p>';
        echo '</div>';
        echo '<div class="stat-card">';
        echo '<h3>45</h3>';
        echo '<p>' . $featured_text . '</p>';
        echo '</div>';
        echo '</div>';
        
        // Quick action buttons
        echo '<div class="quick-actions">';
        echo '<a href="?page=manage_articles" class="btn">' . $manage_text . '</a>';
        echo '<a href="?page=featured_articles" class="btn">' . $featured_text . '</a>';
        echo '</div>';
        
        echo '</div>';
    }
);

/**
 * Register article management admin page
 * This demonstrates creating multiple admin pages with different functionality
 * and showing how translation keys work throughout the interface.
 */
cms_register_admin_page(
    'manage_articles',
    cms_plugin_translate('advanced_news', 'menu.manage_articles', null, 'Manage Articles'),
    function() {
        $title = cms_plugin_translate('advanced_news', 'menu.manage_articles');
        $search_text = cms_plugin_translate('advanced_news', 'ui.search');
        $filter_text = cms_plugin_translate('advanced_news', 'ui.filter');
        
        echo '<div class="article-management">';
        echo '<h1>' . htmlspecialchars($title) . '</h1>';
        
        // Search and filter interface
        echo '<div class="management-controls">';
        echo '<input type="text" placeholder="' . $search_text . '..." class="search-input">';
        echo '<select class="filter-select">';
        echo '<option value="">' . $filter_text . ' by Category</option>';
        echo '<option value="game_reviews">Game Reviews</option>';
        echo '<option value="developer_interviews">Developer Interviews</option>';
        echo '</select>';
        echo '</div>';
        
        // Article listing table
        echo '<table class="articles-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . cms_plugin_translate('advanced_news', 'article.title') . '</th>';
        echo '<th>' . cms_plugin_translate('advanced_news', 'article.reading_time') . '</th>';
        echo '<th>' . cms_plugin_translate('advanced_news', 'article.featured') . '</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>Sample Article 1</td>';
        echo '<td>5 min</td>';
        echo '<td>Yes</td>';
        echo '<td>';
        echo '<a href="#" class="btn-edit">' . cms_plugin_translate('advanced_news', 'ui.edit') . '</a>';
        echo '<a href="#" class="btn-delete">' . cms_plugin_translate('advanced_news', 'ui.delete') . '</a>';
        echo '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        
        echo '</div>';
    },
    'advanced_news_dashboard'  // Parent page for hierarchical menu
);

// ============================================================================
// SIDEBAR NAVIGATION LINKS
// ============================================================================

/**
 * Register additional sidebar links for plugin functionality
 * These links provide quick access to different areas of the plugin
 * from the main CMS navigation sidebar.
 */
cms_register_sidebar_link(
    'advanced_news_analytics',  // Unique identifier
    cms_plugin_translate('advanced_news', 'menu.analytics', null, 'News Analytics'),  // Translated label
    'plugin.php?page=news_analytics',  // Target URL
    'advanced_news_dashboard'   // Parent item for grouping
);

cms_register_sidebar_link(
    'comment_moderation',
    cms_plugin_translate('advanced_news', 'menu.comment_moderation', null, 'Comment Moderation'),
    'plugin.php?page=comment_moderation',
    'advanced_news_dashboard'
);

// ============================================================================
// TEMPLATE TAG REGISTRATION
// ============================================================================

/**
 * Register custom template tag for displaying featured articles
 * Template tags allow themes to call plugin functionality directly
 * from template files, providing a clean integration between plugins
 * and themes.
 */
cms_register_template_tag(
    'featured_articles',        // Tag name used in templates
    function($limit = 5, $category = null, $layout = 'grid') {  // Function with configurable parameters
        // Get plugin settings for default behavior
        $default_limit = cms_get_plugin_setting('advanced_news', 'featured_articles_limit', 5);
        $display_options = cms_get_plugin_setting('advanced_news', 'display_options', []);
        
        // Use provided limit or fall back to plugin setting
        $limit = $limit ?: $default_limit;
        
        $output = '<div class="featured-articles-tag" data-layout="' . $layout . '">';
        
        if ($category) {
            $output .= '<h3>Featured ' . ucfirst($category) . '</h3>';
        } else {
            $output .= '<h3>Featured Articles</h3>';
        }
        
        $output .= '<div class="articles-container layout-' . $layout . '">';
        
        // Generate sample featured articles (would normally query database)
        for ($i = 1; $i <= $limit; $i++) {
            $output .= '<article class="featured-article">';
            $output .= '<h4>Featured Article ' . $i . '</h4>';
            $output .= '<p>This article would show real content from the database...</p>';
            
            if ($display_options['show_reading_time'] ?? true) {
                $output .= '<span class="reading-time">' . rand(3, 12) . ' min read</span>';
            }
            
            $output .= '<a href="/article/' . $i . '" class="read-more">';
            $output .= cms_get_plugin_setting('advanced_news', 'read_more_text', 'Continue Reading →');
            $output .= '</a>';
            $output .= '</article>';
        }
        
        $output .= '</div></div>';
        return $output;
    }
);

/**
 * Register template tag for article metadata display
 * This tag provides a convenient way to display article metadata
 * such as reading time, tags, and author information.
 */
cms_register_template_tag(
    'article_meta',
    function($article_id, $show_reading_time = true, $show_tags = true, $show_author = true) {
        $output = '<div class="article-meta" data-article-id="' . $article_id . '">';
        
        if ($show_reading_time) {
            $reading_time = rand(3, 15);  // Would normally get from database
            $output .= '<span class="meta-reading-time">';
            $output .= '<i class="icon-clock"></i> ' . $reading_time . ' min read';
            $output .= '</span>';
        }
        
        if ($show_tags) {
            $tags = ['gaming', 'steam', 'review'];  // Would normally get from database
            $output .= '<div class="meta-tags">';
            foreach ($tags as $tag) {
                $output .= '<span class="tag">' . htmlspecialchars($tag) . '</span>';
            }
            $output .= '</div>';
        }
        
        if ($show_author) {
            $output .= '<div class="meta-author">';
            $output .= '<span class="author-name">John Doe</span>';  // Would get from database
            $output .= '<span class="publish-date">March 15, 2024</span>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }
);

// ============================================================================
// TEMPLATE TAG HOOKS DEMONSTRATION
// ============================================================================

/**
 * Add 'before' hook to featured_articles template tag
 * Template tag hooks allow plugins to modify the behavior of template tags
 * either before they execute (to modify arguments) or after they execute
 * (to modify output).
 */
cms_hook_template_tag(
    'featured_articles',    // Target template tag
    'before',              // Hook timing
    function($args) {      // Function receives and can modify arguments
        // Log usage for analytics (demonstrates before hook usage)
        cms_plugin_debug_log(
            'advanced_news',
            'Featured articles tag called',
            'info',
            ['args' => $args, 'timestamp' => time()]
        );
        
        // Modify arguments if needed (example: enforce maximum limit)
        if (isset($args[0]) && $args[0] > 20) {
            $args[0] = 20;  // Cap at 20 articles maximum
            cms_plugin_debug_log(
                'advanced_news',
                'Featured articles limit capped at 20',
                'warning'
            );
        }
        
        return $args;  // Return modified arguments
    }
);

/**
 * Add 'after' hook to featured_articles template tag
 * After hooks receive the rendered output and can modify it before
 * it's returned to the template.
 */
cms_hook_template_tag(
    'featured_articles',
    'after',
    function($output) {    // Function receives rendered output
        // Add analytics tracking code to the output
        $tracking_code = '<script>trackFeaturedArticlesView();</script>';
        
        // Add CSS class for theme-specific styling
        $output = str_replace(
            'class="featured-articles-tag"',
            'class="featured-articles-tag advanced-news-enhanced"',
            $output
        );
        
        // Append tracking code
        $output .= $tracking_code;
        
        return $output;  // Return modified output
    }
);

// ============================================================================
// GENERIC EVENT HOOKS
// ============================================================================

/**
 * Register hook for when articles are saved
 * Generic hooks provide integration points throughout the CMS that aren't
 * tied to specific template tags. This allows plugins to respond to
 * system events and perform additional processing.
 */
cms_add_hook(
    'article_saved',           // Event name
    function($article_data) {  // Function receives event data
        // Update reading time calculation when article is saved
        $word_count = str_word_count(strip_tags($article_data['content'] ?? ''));
        $reading_time = max(1, ceil($word_count / 200));  // Assume 200 words per minute
        
        // Update advanced news table with calculated reading time
        // (This would normally update the database)
        cms_plugin_debug_log(
            'advanced_news',
            'Updated reading time for article',
            'info',
            [
                'article_id' => $article_data['id'] ?? 'unknown',
                'word_count' => $word_count,
                'reading_time' => $reading_time
            ]
        );
        
        return $article_data;  // Return data for other hooks to process
    }
);

/**
 * Register hook for when themes are switched
 * This demonstrates how plugins can respond to system-wide changes
 * and update their behavior accordingly.
 */
cms_add_hook(
    'theme_switched',
    function($theme_data) {
        $new_theme = $theme_data['new_theme'] ?? 'unknown';
        $old_theme = $theme_data['old_theme'] ?? 'unknown';
        
        // Clear plugin caches when theme changes
        cms_clear_plugin_cache('advanced_news');
        
        // Log theme change for debugging
        cms_plugin_debug_log(
            'advanced_news',
            'Theme switched, cleared plugin caches',
            'info',
            [
                'old_theme' => $old_theme,
                'new_theme' => $new_theme,
                'timestamp' => time()
            ]
        );
        
        // Update theme-specific settings if needed
        $theme_settings = cms_get_plugin_setting('advanced_news', 'theme_specific_settings', []);
        $theme_settings['last_theme_switch'] = time();
        $theme_settings['current_theme'] = $new_theme;
        cms_set_plugin_setting('advanced_news', 'theme_specific_settings', $theme_settings, 'json');
        
        return $theme_data;
    }
);

// ============================================================================
// INITIALIZATION AND EXECUTION
// ============================================================================

/**
 * Execute plugin migrations on activation
 * This ensures that the plugin's database structure is properly set up
 * when the plugin is first loaded or updated.
 */
$migration_results = cms_execute_plugin_migrations('advanced_news');
foreach ($migration_results as $result) {
    if ($result['status'] === 'error') {
        cms_plugin_debug_log(
            'advanced_news',
            'Migration error: ' . $result['message'],
            'error',
            $result
        );
    }
}

/**
 * Create plugin tables based on registered schemas
 * This automatically creates any custom tables defined by the plugin
 * using the schema registration system.
 */
$table_results = cms_create_plugin_tables('advanced_news');
foreach ($table_results as $result) {
    if ($result['status'] === 'error') {
        cms_plugin_debug_log(
            'advanced_news',
            'Table creation error: ' . $result['message'],
            'error',
            $result
        );
    }
}

/**
 * Initialize default plugin settings if not already set
 * This ensures that the plugin has sensible defaults for all its
 * configurable options when first installed.
 */
if (cms_get_plugin_setting('advanced_news', 'enabled') === null) {
    // Set initial plugin settings with defaults
    cms_set_plugin_setting('advanced_news', 'enabled', true, 'bool');
    cms_set_plugin_setting('advanced_news', 'featured_articles_limit', 5, 'int');
    cms_set_plugin_setting('advanced_news', 'read_more_text', 'Continue Reading →', 'string');
    cms_set_plugin_setting('advanced_news', 'allowed_tags', 
        ['gaming', 'updates', 'community', 'technical', 'announcements'], 'array');
    cms_set_plugin_setting('advanced_news', 'display_options', [
        'show_reading_time' => true,
        'show_author_bio' => false,
        'enable_comments' => true,
        'auto_excerpt_length' => 150
    ], 'json');
    
    cms_plugin_debug_log(
        'advanced_news',
        'Plugin initialized with default settings',
        'info'
    );
}