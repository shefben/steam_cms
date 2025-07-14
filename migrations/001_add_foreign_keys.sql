ALTER TABLE admin_users
    ADD CONSTRAINT fk_admin_users_role FOREIGN KEY (role_id) REFERENCES admin_roles(id);

ALTER TABLE admin_tokens
    ADD CONSTRAINT fk_admin_tokens_user FOREIGN KEY (user_id) REFERENCES admin_users(id) ON DELETE CASCADE;

ALTER TABLE admin_logs
    ADD CONSTRAINT fk_admin_logs_user FOREIGN KEY (user) REFERENCES admin_users(id) ON DELETE SET NULL;

ALTER TABLE subscription_apps
    ADD CONSTRAINT fk_subscription_apps_sub FOREIGN KEY (subid) REFERENCES subscriptions(subid) ON DELETE CASCADE,
    ADD CONSTRAINT fk_subscription_apps_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE app_categories
    ADD CONSTRAINT fk_app_categories_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE,
    ADD CONSTRAINT fk_app_categories_cat FOREIGN KEY (category_id) REFERENCES store_categories(id) ON DELETE CASCADE;

ALTER TABLE store_capsules
    ADD CONSTRAINT fk_store_capsules_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE storefront_capsules_all
    ADD CONSTRAINT fk_storefront_capsules_all_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE storefront_capsules_per_theme
    ADD CONSTRAINT fk_storefront_capsules_per_theme_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;

ALTER TABLE storefront_tab_games
    ADD CONSTRAINT fk_storefront_tab_games_tab FOREIGN KEY (tab_id) REFERENCES storefront_tabs(id) ON DELETE CASCADE,
    ADD CONSTRAINT fk_storefront_tab_games_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;
