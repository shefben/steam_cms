INSERT INTO settings(`key`,value)
SELECT 'news_date_format','long'
WHERE NOT EXISTS (SELECT 1 FROM settings WHERE `key`='news_date_format');
