ALTER TABLE marketing DROP PRIMARY KEY;
ALTER TABLE marketing CHANGE message content TEXT NOT NULL;
ALTER TABLE marketing ADD COLUMN language VARCHAR(30) NOT NULL DEFAULT 'english' AFTER msgtype;
ALTER TABLE marketing DROP COLUMN id, DROP COLUMN created_at;
ALTER TABLE marketing ADD PRIMARY KEY (msgtype, language);
