ALTER TABLE random_content ADD COLUMN `group` VARCHAR(100) NOT NULL DEFAULT '';

CREATE TABLE random_groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL
);

INSERT INTO random_groups(name)
    SELECT DISTINCT tag_name FROM random_content;

UPDATE random_content SET `group` = tag_name;
