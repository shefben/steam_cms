-- ====================================================================
-- PERFORMANCE OPTIMIZATION: Replace FIND_IN_SET with Junction Tables
-- ====================================================================
-- FIND_IN_SET cannot use indexes and causes full table scans (200-1000ms)
-- This migration creates proper junction tables with indexes
--
-- IMPORTANT: Run data migration script AFTER creating these tables
-- to populate them from existing comma-separated values
-- ====================================================================

-- ====================================================================
-- Junction table for support_pages.years
-- ====================================================================
CREATE TABLE IF NOT EXISTS support_page_years (
    page_id INT NOT NULL,
    year_theme VARCHAR(20) NOT NULL,
    PRIMARY KEY (page_id, year_theme),
    INDEX idx_year_theme (year_theme),
    INDEX idx_page_id (page_id),
    FOREIGN KEY (page_id) REFERENCES support_pages(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================================================
-- Junction table for sidebar_section_variants.theme_list
-- ====================================================================
CREATE TABLE IF NOT EXISTS sidebar_variant_themes (
    variant_id INT NOT NULL,
    theme VARCHAR(50) NOT NULL,
    PRIMARY KEY (variant_id, theme),
    INDEX idx_theme (theme),
    INDEX idx_variant_id (variant_id),
    FOREIGN KEY (variant_id) REFERENCES sidebar_section_variants(variant_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================================================
-- Junction table for sidebar_section_entries.theme_list
-- ====================================================================
CREATE TABLE IF NOT EXISTS sidebar_entry_themes (
    entry_id INT NOT NULL,
    theme VARCHAR(50) NOT NULL,
    PRIMARY KEY (entry_id, theme),
    INDEX idx_theme (theme),
    INDEX idx_entry_id (entry_id),
    FOREIGN KEY (entry_id) REFERENCES sidebar_section_entries(entry_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ====================================================================
-- Data Migration Script
-- ====================================================================
-- After creating the tables above, run this to populate them:

-- Migrate support_pages.years
-- Example: '2002_v1,2003_v1,2004' -> three rows in support_page_years
-- (This needs to be run as a separate script/procedure since it requires looping)

DELIMITER $$

CREATE PROCEDURE migrate_support_page_years()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE page_id_var INT;
    DECLARE years_var TEXT;
    DECLARE year_item VARCHAR(20);
    DECLARE years_cursor CURSOR FOR
        SELECT id, years FROM support_pages WHERE years IS NOT NULL AND years != '';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN years_cursor;

    read_loop: LOOP
        FETCH years_cursor INTO page_id_var, years_var;
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Split comma-separated years and insert into junction table
        SET @years_list = CONCAT(years_var, ',');
        WHILE LOCATE(',', @years_list) > 0 DO
            SET year_item = TRIM(SUBSTRING_INDEX(@years_list, ',', 1));
            SET @years_list = SUBSTRING(@years_list, LOCATE(',', @years_list) + 1);

            IF year_item != '' THEN
                INSERT IGNORE INTO support_page_years (page_id, year_theme)
                VALUES (page_id_var, year_item);
            END IF;
        END WHILE;
    END LOOP;

    CLOSE years_cursor;
END$$

-- Migrate sidebar_section_variants.theme_list
CREATE PROCEDURE migrate_sidebar_variant_themes()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE variant_id_var INT;
    DECLARE theme_list_var TEXT;
    DECLARE theme_item VARCHAR(50);
    DECLARE themes_cursor CURSOR FOR
        SELECT variant_id, theme_list FROM sidebar_section_variants
        WHERE theme_list IS NOT NULL AND theme_list != '';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN themes_cursor;

    read_loop: LOOP
        FETCH themes_cursor INTO variant_id_var, theme_list_var;
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET @theme_list = CONCAT(theme_list_var, ',');
        WHILE LOCATE(',', @theme_list) > 0 DO
            SET theme_item = TRIM(SUBSTRING_INDEX(@theme_list, ',', 1));
            SET @theme_list = SUBSTRING(@theme_list, LOCATE(',', @theme_list) + 1);

            IF theme_item != '' THEN
                INSERT IGNORE INTO sidebar_variant_themes (variant_id, theme)
                VALUES (variant_id_var, theme_item);
            END IF;
        END WHILE;
    END LOOP;

    CLOSE themes_cursor;
END$$

-- Migrate sidebar_section_entries.theme_list
CREATE PROCEDURE migrate_sidebar_entry_themes()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE entry_id_var INT;
    DECLARE theme_list_var TEXT;
    DECLARE theme_item VARCHAR(50);
    DECLARE entries_cursor CURSOR FOR
        SELECT entry_id, theme_list FROM sidebar_section_entries
        WHERE theme_list IS NOT NULL AND theme_list != '';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN entries_cursor;

    read_loop: LOOP
        FETCH entries_cursor INTO entry_id_var, theme_list_var;
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET @theme_list = CONCAT(theme_list_var, ',');
        WHILE LOCATE(',', @theme_list) > 0 DO
            SET theme_item = TRIM(SUBSTRING_INDEX(@theme_list, ',', 1));
            SET @theme_list = SUBSTRING(@theme_list, LOCATE(',', @theme_list) + 1);

            IF theme_item != '' THEN
                INSERT IGNORE INTO sidebar_entry_themes (entry_id, theme)
                VALUES (entry_id_var, theme_item);
            END IF;
        END WHILE;
    END LOOP;

    CLOSE entries_cursor;
END$$

DELIMITER ;

-- ====================================================================
-- Execute Migration Procedures
-- ====================================================================
-- Uncomment these lines after reviewing the procedures:
-- CALL migrate_support_page_years();
-- CALL migrate_sidebar_variant_themes();
-- CALL migrate_sidebar_entry_themes();

-- ====================================================================
-- Cleanup (optional, after verifying migration)
-- ====================================================================
-- Once you've verified the junction tables work correctly, you can:
-- 1. Drop the old comma-separated columns (years, theme_list)
-- 2. Drop the migration procedures

-- DROP PROCEDURE IF EXISTS migrate_support_page_years;
-- DROP PROCEDURE IF EXISTS migrate_sidebar_variant_themes;
-- DROP PROCEDURE IF EXISTS migrate_sidebar_entry_themes;

-- ALTER TABLE support_pages DROP COLUMN years;
-- ALTER TABLE sidebar_section_variants DROP COLUMN theme_list;
-- ALTER TABLE sidebar_section_entries DROP COLUMN theme_list;

-- ====================================================================
-- Verification Queries
-- ====================================================================
-- Check that data migrated correctly:

-- SELECT COUNT(*) FROM support_page_years;
-- SELECT COUNT(*) FROM sidebar_variant_themes;
-- SELECT COUNT(*) FROM sidebar_entry_themes;

-- Sample data comparison:
-- SELECT sp.id, sp.years, GROUP_CONCAT(spy.year_theme) as migrated_years
-- FROM support_pages sp
-- LEFT JOIN support_page_years spy ON sp.id = spy.page_id
-- GROUP BY sp.id
-- LIMIT 10;
