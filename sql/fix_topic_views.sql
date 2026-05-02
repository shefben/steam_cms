-- Set realistic view counts for historical topics based on reply counts
-- Views are typically 10-50x the number of replies
-- This uses a formula: views = (posts * random_multiplier) + base_views

-- Update topics with 0 views to have realistic counts
UPDATE phpbb_topics
SET topic_views = FLOOR(
    (topic_posts_approved * (10 + FLOOR(RAND() * 40))) +
    FLOOR(RAND() * 200) + 50
)
WHERE topic_views = 0
AND topic_posts_approved > 0;

-- Also set a minimum view count for topics with only 1 post
UPDATE phpbb_topics
SET topic_views = FLOOR(RAND() * 100) + 10
WHERE topic_views = 0
AND topic_posts_approved <= 1
AND topic_id > 1000;
