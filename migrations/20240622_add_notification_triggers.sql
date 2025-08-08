CREATE TRIGGER trg_ccafe_registration_notify
AFTER INSERT ON ccafe_registration
FOR EACH ROW
    INSERT INTO notifications(type, message, target_role)
    VALUES('signup', CONCAT('New cafe signup: ', NEW.company), 'manage_signups');

CREATE TABLE IF NOT EXISTS import_jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    created DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TRIGGER trg_import_jobs_notify
AFTER INSERT ON import_jobs
FOR EACH ROW
BEGIN
    IF NEW.status <> 'complete' THEN
        INSERT INTO notifications(type, message, target_role)
        VALUES('import', CONCAT('Import ', NEW.type, ' pending'), 'admin');
    END IF;
END;

CREATE TRIGGER trg_platform_update_notify
AFTER INSERT ON platform_update_history
FOR EACH ROW
    INSERT INTO notifications(type, message, target_role)
    VALUES('release', CONCAT('Platform update for app ', NEW.appid), 'all');
