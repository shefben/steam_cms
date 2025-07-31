CREATE TABLE cafe_signup_pages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(50) UNIQUE,
    content MEDIUMTEXT,
    created DATETIME,
    updated DATETIME
);
CREATE TABLE cheat_form_pages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(50) UNIQUE,
    content MEDIUMTEXT,
    created DATETIME,
    updated DATETIME
);
CREATE TABLE cd_account_pages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(50) UNIQUE,
    content MEDIUMTEXT,
    created DATETIME,
    updated DATETIME
);
