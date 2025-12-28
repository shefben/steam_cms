-- Drop all CMS tables
-- WARNING: This will permanently delete all CMS data!
-- Run with: mysql -u username -p database_name < drop_all_tables.sql

SET FOREIGN_KEY_CHECKS = 0;

-- Admin & System tables
DROP TABLE IF EXISTS admin_logs;
DROP TABLE IF EXISTS admin_tokens;
DROP TABLE IF EXISTS admin_users;
DROP TABLE IF EXISTS admin_roles;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS error_logs;
DROP TABLE IF EXISTS help_texts;
DROP TABLE IF EXISTS page_views;
DROP TABLE IF EXISTS settings;
DROP TABLE IF EXISTS plugin_settings;
DROP TABLE IF EXISTS plugin_migrations;

-- Theme tables
DROP TABLE IF EXISTS themes;
DROP TABLE IF EXISTS theme_settings;
DROP TABLE IF EXISTS theme_headers;
DROP TABLE IF EXISTS theme_footers;

-- News & Content tables
DROP TABLE IF EXISTS news;
DROP TABLE IF EXISTS custom_pages;
DROP TABLE IF EXISTS custom_titles;
DROP TABLE IF EXISTS media;
DROP TABLE IF EXISTS redirects;
DROP TABLE IF EXISTS random_content;
DROP TABLE IF EXISTS random_groups;
DROP TABLE IF EXISTS scheduled_content;

-- Download system tables
DROP TABLE IF EXISTS download_file_mirrors;
DROP TABLE IF EXISTS download_file_versions;
DROP TABLE IF EXISTS download_files;
DROP TABLE IF EXISTS download_links;
DROP TABLE IF EXISTS download_pages;
DROP TABLE IF EXISTS download_categories;
DROP TABLE IF EXISTS download_page_visibility;
DROP TABLE IF EXISTS download_system_requirements;

-- Content servers & stats
DROP TABLE IF EXISTS content_servers;
DROP TABLE IF EXISTS server_stats;
DROP TABLE IF EXISTS player_sessions;
DROP TABLE IF EXISTS player_history;
DROP TABLE IF EXISTS bw_history;

-- FAQ tables
DROP TABLE IF EXISTS faq_content;
DROP TABLE IF EXISTS faq_categories;

-- Support tables
DROP TABLE IF EXISTS support_page_faqs;
DROP TABLE IF EXISTS support_pages;
DROP TABLE IF EXISTS support_page_years;
DROP TABLE IF EXISTS troubleshooter_pages;
DROP TABLE IF EXISTS support_requests;
DROP TABLE IF EXISTS bug_reports;

-- Cafe tables
DROP TABLE IF EXISTS cafe_representatives;
DROP TABLE IF EXISTS cafe_directory;
DROP TABLE IF EXISTS ccafe_registration;

-- Survey tables
DROP TABLE IF EXISTS survey_entries;
DROP TABLE IF EXISTS survey_categories;
DROP TABLE IF EXISTS survey_info;
DROP TABLE IF EXISTS map_contest_entries;

-- Storefront tables (legacy 0405)
DROP TABLE IF EXISTS `0405_storefront_games`;
DROP TABLE IF EXISTS `0405_storefront_thirdpartGames`;
DROP TABLE IF EXISTS `0405_storefront_packages`;

-- Store tables
DROP TABLE IF EXISTS store_screenshots;
DROP TABLE IF EXISTS subscription_apps;
DROP TABLE IF EXISTS subscriptions;
DROP TABLE IF EXISTS app_categories;
DROP TABLE IF EXISTS store_apps;
DROP TABLE IF EXISTS store_developers;
DROP TABLE IF EXISTS store_categories;
DROP TABLE IF EXISTS store_sidebar_links;
DROP TABLE IF EXISTS store_capsules;
DROP TABLE IF EXISTS store_pages;
DROP TABLE IF EXISTS product_content_overlays;
DROP TABLE IF EXISTS product_discounts;

-- Storefront capsules tables
DROP TABLE IF EXISTS storefront_capsule_items;
DROP TABLE IF EXISTS storefront_capsules_per_theme;
DROP TABLE IF EXISTS storefront_capsules_all;
DROP TABLE IF EXISTS storefront_tab_games;
DROP TABLE IF EXISTS storefront_tabs;
DROP TABLE IF EXISTS tabbed_capsule_games;
DROP TABLE IF EXISTS tabbed_capsules;
DROP TABLE IF EXISTS multicapsule;
DROP TABLE IF EXISTS marketing;

-- Platform update history
DROP TABLE IF EXISTS platform_update_history;

-- Tournament tables
DROP TABLE IF EXISTS tournament_audit_log;
DROP TABLE IF EXISTS tournament_content_blocks;
DROP TABLE IF EXISTS tournament_game_selection;
DROP TABLE IF EXISTS tournament_games;
DROP TABLE IF EXISTS tournament_registration_selection;
DROP TABLE IF EXISTS tournament_registration_options;
DROP TABLE IF EXISTS tournaments;

-- Game stats
DROP TABLE IF EXISTS game_stats;

-- Steam marketing
DROP TABLE IF EXISTS steam_marketing;

-- Sidebar sections tables
DROP TABLE IF EXISTS sidebar_section_entry_fields;
DROP TABLE IF EXISTS sidebar_section_type_fields;
DROP TABLE IF EXISTS sidebar_section_types;
DROP TABLE IF EXISTS sidebar_section_entries;
DROP TABLE IF EXISTS sidebar_entry_themes;
DROP TABLE IF EXISTS sidebar_section_variants;
DROP TABLE IF EXISTS sidebar_variant_themes;
DROP TABLE IF EXISTS sidebar_sections;

-- Games 2007 schema tables
DROP TABLE IF EXISTS trailer_languages;
DROP TABLE IF EXISTS game_trailers;
DROP TABLE IF EXISTS trailers;
DROP TABLE IF EXISTS game_packages;
DROP TABLE IF EXISTS media_links;
DROP TABLE IF EXISTS screenshots;
DROP TABLE IF EXISTS system_requirements;
DROP TABLE IF EXISTS game_options;
DROP TABLE IF EXISTS game_languages;
DROP TABLE IF EXISTS languages;
DROP TABLE IF EXISTS game_categories;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS game_details;
DROP TABLE IF EXISTS publishers;
DROP TABLE IF EXISTS developers;
DROP TABLE IF EXISTS games;

SET FOREIGN_KEY_CHECKS = 1;

-- Done
SELECT 'All CMS tables dropped successfully.' AS status;
