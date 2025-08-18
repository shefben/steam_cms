-- Add tables for plugin-defined sidebar sections
CREATE TABLE sidebar_section_types (
    type_name VARCHAR(100) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    theme_list VARCHAR(255) DEFAULT NULL,
    entry_template TEXT NOT NULL
);

CREATE TABLE sidebar_section_type_fields (
    field_id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(100) NOT NULL,
    field_key VARCHAR(100) NOT NULL,
    field_label VARCHAR(255) NOT NULL,
    field_type VARCHAR(50) NOT NULL,
    field_order INT NOT NULL DEFAULT 0,
    FOREIGN KEY (type_name) REFERENCES sidebar_section_types(type_name) ON DELETE CASCADE
);

CREATE TABLE sidebar_section_entry_fields (
    entry_id INT NOT NULL,
    field_key VARCHAR(100) NOT NULL,
    field_value TEXT NOT NULL,
    PRIMARY KEY (entry_id, field_key),
    FOREIGN KEY (entry_id) REFERENCES sidebar_section_entries(entry_id) ON DELETE CASCADE
);
