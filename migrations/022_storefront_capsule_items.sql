CREATE TABLE storefront_capsule_items(
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(20),
    type VARCHAR(10),
    appid INT,
    image_path TEXT,
    price DECIMAL(10,2),
    ord INT
);
ALTER TABLE storefront_capsule_items
    ADD CONSTRAINT fk_storefront_capsule_items_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;
