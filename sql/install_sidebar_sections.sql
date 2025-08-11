CREATE TABLE sidebar_sections (
    section_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    icon_path VARCHAR(255) DEFAULT NULL,
    is_collapsible TINYINT(1) NOT NULL DEFAULT 0,
    collapsible_id VARCHAR(255) DEFAULT NULL,
    has_icicles TINYINT(1) NOT NULL DEFAULT 0,
    sort_order INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE sidebar_section_variants (
    variant_id INT AUTO_INCREMENT PRIMARY KEY,
    section_id INT NOT NULL,
    theme_list VARCHAR(255) NOT NULL,
    html_content TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (section_id) REFERENCES sidebar_sections(section_id) ON DELETE CASCADE
);

INSERT INTO sidebar_sections (section_id, title, icon_path, is_collapsible, collapsible_id, has_icicles, sort_order) VALUES
(1, '', NULL, 0, NULL, 0, 1),
(2, '', NULL, 0, NULL, 0, 2),
(3, 'New On Steam', 'img/ico/ico_new_16.gif', 0, NULL, 0, 3),
(4, 'Find', 'img/ico/ico_srch_16.gif', 0, NULL, 0, 4),
(5, 'Spotlight', NULL, 0, NULL, 0, 5),
(6, 'Latest News', 'img/ico/ico_docs_16.gif', 0, NULL, 1, 6),
(7, 'Publisher Catalogs', NULL, 0, NULL, 0, 7),
(8, 'Browse The Catalog', NULL, 0, NULL, 0, 8),
(9, 'Coming Soon To Steam', NULL, 0, NULL, 0, 9);

INSERT INTO sidebar_section_variants (section_id, theme_list, html_content) VALUES
(1, '2007_v1,2007_v2', '{{ index_search_bar()|raw }}'),
(2, '2006_v1,2006_v2', '{{ get_steam_now_button()|raw }}'),
(3, '2006_v1,2006_v2,2007_v1,2007_v2', '{{ new_on_steam_list()|raw }}'),
(4, '2006_v1,2006_v2', '{{ find_list()|raw }}'),
(4, '2007_v1,2007_v2', '{{ find_more_list()|raw }}'),
(5, '2007_v1,2007_v2', '{{ spotlight_content()|raw }}'),
(6, '2006_v1,2006_v2,2007_v1,2007_v2', '{{ latest_news_list()|raw }}'),
(7, '2007_v1,2007_v2', '{{ publisher_catalogs_list()|raw }}'),
(8, '2007_v1,2007_v2', '{{ browse_catalog_list()|raw }}'),
(9, '2007_v1,2007_v2', '{{ coming_soon_list()|raw }}');
