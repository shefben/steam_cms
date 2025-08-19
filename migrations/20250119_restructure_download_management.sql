-- Migration: Restructure download management system
-- Date: 2025-01-19
-- Description: Remove visibility table, add per-version download configuration

-- Drop the old visibility table
DROP TABLE IF EXISTS download_page_visibility;

-- Modify download_files table to add new columns
ALTER TABLE download_files 
ADD COLUMN sort_order INT DEFAULT 0 AFTER updated;

-- Create new download_file_versions table for per-version configuration
CREATE TABLE download_file_versions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_id INT NOT NULL,
    theme VARCHAR(32) NOT NULL,
    page_version VARCHAR(32) NOT NULL,
    is_visible TINYINT(1) DEFAULT 1,
    render_type ENUM(
        'title_size_mirrors_buttons',
        'title_size_mirrors_links', 
        'title_no_size_mirrors_links',
        'mirrors_buttons_no_title',
        'single_button',
        'single_link',
        'title_single_link_with_size',
        'floating_box_single_link',
        'floating_box_title_mirrors_links'
    ) DEFAULT 'title_size_mirrors_buttons',
    location VARCHAR(32) DEFAULT 'main_content',
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_file_theme_version (file_id, theme, page_version),
    FOREIGN KEY (file_id) REFERENCES download_files(id) ON DELETE CASCADE
);

-- Create index for faster queries
CREATE INDEX idx_theme_version ON download_file_versions(theme, page_version);
CREATE INDEX idx_visible_sort ON download_file_versions(is_visible, sort_order);