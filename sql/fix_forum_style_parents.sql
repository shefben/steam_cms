-- Fix forum style parent relationships for incomplete styles
-- Run this after forum installation to fix missing template issues

-- Get prosilver style_id and update incomplete styles to inherit from it
SET @prosilver_id = (SELECT style_id FROM phpbb_styles WHERE style_path = 'prosilver' LIMIT 1);

-- Update styles with incomplete templates to inherit from prosilver
UPDATE phpbb_styles 
SET style_parent_id = COALESCE(@prosilver_id, 1), 
    style_parent_tree = 'prosilver'
WHERE style_path IN ('2002_v1', '2002_v2', 'steam_2004', 'steam_2006_v1') 
  AND style_parent_id = 0;

-- Verify the changes
SELECT style_id, style_name, style_path, style_parent_id, style_parent_tree 
FROM phpbb_styles 
WHERE style_path IN ('2002_v1', '2002_v2', 'steam_2004', 'steam_2006_v1', 'prosilver');
