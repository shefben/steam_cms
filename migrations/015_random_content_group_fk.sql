ALTER TABLE random_content ADD COLUMN group_id INT;
UPDATE random_content rc
JOIN random_groups rg ON rc.`group` = rg.name
SET rc.group_id = rg.id;
ALTER TABLE random_content DROP COLUMN `group`;
ALTER TABLE random_content
  ADD CONSTRAINT fk_random_content_group
  FOREIGN KEY (group_id) REFERENCES random_groups(id)
  ON DELETE CASCADE;
