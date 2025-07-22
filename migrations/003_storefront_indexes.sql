CREATE INDEX idx_app_categories_category ON app_categories(category_id);
CREATE INDEX idx_store_apps_name ON store_apps(name(191));
CREATE INDEX idx_store_apps_developer ON store_apps(developer(191));
CREATE INDEX idx_store_developers_name ON store_developers(name(191));
