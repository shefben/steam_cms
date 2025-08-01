ALTER TABLE download_files
    ADD COLUMN visibleontheme VARCHAR(255) DEFAULT '' AFTER main_url,
    ADD COLUMN usingbutton TINYINT(1) DEFAULT 0 AFTER visibleontheme,
    ADD COLUMN buttonText VARCHAR(100) DEFAULT NULL AFTER usingbutton;
