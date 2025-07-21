CREATE TABLE support_pages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(50) UNIQUE,
    years TEXT,
    content MEDIUMTEXT,
    created DATETIME,
    updated DATETIME
);
CREATE TABLE support_page_faqs(
    support_id INT,
    faqid1 BIGINT,
    faqid2 BIGINT,
    ord INT,
    PRIMARY KEY(support_id, ord),
    FOREIGN KEY(support_id) REFERENCES support_pages(id) ON DELETE CASCADE
);
