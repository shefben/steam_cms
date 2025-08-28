-- Subscription Counter-Strike: Condition Zero (Sub ID: 7)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (7, 'Counter-Strike: Condition Zero', '$22.48$9.99-$2.50', '$7.49', '$7.49', '$14.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(7, (SELECT id FROM languages WHERE name='English')),
(7, (SELECT id FROM languages WHERE name='French')),
(7, (SELECT id FROM languages WHERE name='German')),
(7, (SELECT id FROM languages WHERE name='Italian')),
(7, (SELECT id FROM languages WHERE name='Korean')),
(7, (SELECT id FROM languages WHERE name='Spanish')),
(7, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(7, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (7, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (7, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (7, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (7, 'Single-player');
-- Subscription Half-Life 2 (Sub ID: 36)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (36, 'Half-Life 2', '$29.99$19.99', '$19.99', '$19.99', '$10.00');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(36, (SELECT id FROM languages WHERE name='English')),
(36, (SELECT id FROM languages WHERE name='French')),
(36, (SELECT id FROM languages WHERE name='German')),
(36, (SELECT id FROM languages WHERE name='Italian')),
(36, (SELECT id FROM languages WHERE name='Korean')),
(36, (SELECT id FROM languages WHERE name='Spanish')),
(36, (SELECT id FROM languages WHERE name='Russian')),
(36, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(36, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(36, (SELECT id FROM languages WHERE name='Dutch')),
(36, (SELECT id FROM languages WHERE name='Danish')),
(36, (SELECT id FROM languages WHERE name='Finnish')),
(36, (SELECT id FROM languages WHERE name='Japanese')),
(36, (SELECT id FROM languages WHERE name='Norwegian')),
(36, (SELECT id FROM languages WHERE name='Polish')),
(36, (SELECT id FROM languages WHERE name='Portuguese')),
(36, (SELECT id FROM languages WHERE name='Swedish')),
(36, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (36, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Commentary available');
-- Subscription Half-Life 1: Source (Sub ID: 38)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (38, 'Half-Life 1: Source', '$0.00$9.99-$2.50', '$7.49', '$7.49', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(38, (SELECT id FROM languages WHERE name='English')),
(38, (SELECT id FROM languages WHERE name='French')),
(38, (SELECT id FROM languages WHERE name='German')),
(38, (SELECT id FROM languages WHERE name='Italian')),
(38, (SELECT id FROM languages WHERE name='Japanese')),
(38, (SELECT id FROM languages WHERE name='Korean')),
(38, (SELECT id FROM languages WHERE name='Spanish')),
(38, (SELECT id FROM languages WHERE name='Russian')),
(38, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(38, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(38, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (38, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (38, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (38, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (38, 'Single-player');
-- Subscription Half-Life 1 Anthology (Sub ID: 40)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (40, 'Half-Life 1 Anthology', '$18.71$14.99-$3.75', '$11.24', '$11.24', '$7.47');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(40, (SELECT id FROM languages WHERE name='English')),
(40, (SELECT id FROM languages WHERE name='French')),
(40, (SELECT id FROM languages WHERE name='German')),
(40, (SELECT id FROM languages WHERE name='Italian')),
(40, (SELECT id FROM languages WHERE name='Korean')),
(40, (SELECT id FROM languages WHERE name='Spanish')),
(40, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(40, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (40, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (40, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (40, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (40, 'Valve Anti-Cheat enabled');
-- Subscription Counter-Strike 1 Anthology (Sub ID: 41)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (41, 'Counter-Strike 1 Anthology', '$34.95$14.99', '$14.99', '$14.99', '$19.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(41, (SELECT id FROM languages WHERE name='English')),
(41, (SELECT id FROM languages WHERE name='French')),
(41, (SELECT id FROM languages WHERE name='German')),
(41, (SELECT id FROM languages WHERE name='Italian')),
(41, (SELECT id FROM languages WHERE name='Korean')),
(41, (SELECT id FROM languages WHERE name='Spanish')),
(41, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(41, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (41, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (41, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (41, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (41, 'Single-player');
-- Subscription Source Multiplayer Pack (Sub ID: 42)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (42, 'Source Multiplayer Pack', '$34.97$29.99', '$29.99', '$29.99', '$4.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(42, (SELECT id FROM languages WHERE name='English')),
(42, (SELECT id FROM languages WHERE name='French')),
(42, (SELECT id FROM languages WHERE name='German')),
(42, (SELECT id FROM languages WHERE name='Italian')),
(42, (SELECT id FROM languages WHERE name='Japanese')),
(42, (SELECT id FROM languages WHERE name='Korean')),
(42, (SELECT id FROM languages WHERE name='Spanish')),
(42, (SELECT id FROM languages WHERE name='Russian')),
(42, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(42, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(42, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (42, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Stats');
-- Subscription SiN Episodes: Emergence (Sub ID: 70)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (70, 'SiN Episodes: Emergence', '$0.00$9.99', '$9.99', '$9.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(70, (SELECT id FROM languages WHERE name='English')),
(70, (SELECT id FROM languages WHERE name='French')),
(70, (SELECT id FROM languages WHERE name='German')),
(70, (SELECT id FROM languages WHERE name='Russian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (70, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (70, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (70, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (70, 'Stats');
-- Subscription Half-Life 2: Episode One (Sub ID: 79)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (79, 'Half-Life 2: Episode One', '$24.98$9.99', '$9.99', '$9.99', '$14.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(79, (SELECT id FROM languages WHERE name='English')),
(79, (SELECT id FROM languages WHERE name='French')),
(79, (SELECT id FROM languages WHERE name='German')),
(79, (SELECT id FROM languages WHERE name='Italian')),
(79, (SELECT id FROM languages WHERE name='Korean')),
(79, (SELECT id FROM languages WHERE name='Spanish')),
(79, (SELECT id FROM languages WHERE name='Russian')),
(79, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(79, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(79, (SELECT id FROM languages WHERE name='Dutch')),
(79, (SELECT id FROM languages WHERE name='Danish')),
(79, (SELECT id FROM languages WHERE name='Finnish')),
(79, (SELECT id FROM languages WHERE name='Japanese')),
(79, (SELECT id FROM languages WHERE name='Norwegian')),
(79, (SELECT id FROM languages WHERE name='Polish')),
(79, (SELECT id FROM languages WHERE name='Portuguese')),
(79, (SELECT id FROM languages WHERE name='Swedish')),
(79, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (79, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Controller enabled');
-- Subscription Disciples II Gold (Sub ID: 95)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (95, 'Disciples II Gold', '$29.98$19.99-$10.00', '$9.99', '$9.99', '$19.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(95, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (95, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (95, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (95, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (95, 'Co-op');
-- Subscription Jagged Alliance 2 / Disciples II Gold Combo (Sub ID: 96)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (96, 'Jagged Alliance 2 / Disciples II Gold Combo', '$59.97$29.99', '$29.99', '$29.99', '$29.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(96, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (96, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (96, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (96, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (96, 'Co-op');
-- Subscription X2/X3 Pack (Sub ID: 102)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (102, 'X2/X3 Pack', '$14.98$10.99', '$10.99', '$10.99', '$3.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(102, (SELECT id FROM languages WHERE name='English')),
(102, (SELECT id FROM languages WHERE name='French')),
(102, (SELECT id FROM languages WHERE name='German')),
(102, (SELECT id FROM languages WHERE name='Spanish')),
(102, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (102, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (102, 'Single-player');
-- Subscription Uplink/Darwinia Pack (Sub ID: 113)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (113, 'Uplink/Darwinia Pack', '$19.98$14.99', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(113, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (113, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (113, 'Single-player');
-- Subscription Xpand Rally + GTI Racing Pack (Sub ID: 116)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (116, 'Xpand Rally + GTI Racing Pack', '$9.98$7.99', '$7.99', '$7.99', '$1.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(116, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (116, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (116, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (116, 'Multi-player');
-- Subscription Sam & Max: Episodes 104 - 106 (Sub ID: 364)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (364, 'Sam & Max: Episodes 104 - 106', '$47.97$19.99', '$19.99', '$19.99', '$27.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(364, (SELECT id FROM languages WHERE name='English')),
(364, (SELECT id FROM languages WHERE name='French')),
(364, (SELECT id FROM languages WHERE name='German')),
(364, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (364, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (364, 'Single-player');
-- Subscription Best of the Underground (Sub ID: 376)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (376, 'Best of the Underground', '$23.97$19.99', '$19.99', '$19.99', '$3.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(376, (SELECT id FROM languages WHERE name='English')),
(376, (SELECT id FROM languages WHERE name='Polish')),
(376, (SELECT id FROM languages WHERE name='Russian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (376, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (376, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (376, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (376, 'Multi-player');
-- Subscription RACE + Caterham Expansion (Sub ID: 379)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (379, 'RACE + Caterham Expansion', '$4.99$24.99', '$24.99', '$24.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(379, (SELECT id FROM languages WHERE name='English')),
(379, (SELECT id FROM languages WHERE name='French')),
(379, (SELECT id FROM languages WHERE name='German')),
(379, (SELECT id FROM languages WHERE name='Italian')),
(379, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (379, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (379, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (379, 'Multi-player');
-- Subscription Civilization IV® Complete Pack (Sub ID: 393)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (393, 'Civilization IV® Complete Pack', '$59.97$49.99', '$49.99', '$49.99', '$9.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(393, (SELECT id FROM languages WHERE name='English')),
(393, (SELECT id FROM languages WHERE name='French')),
(393, (SELECT id FROM languages WHERE name='German')),
(393, (SELECT id FROM languages WHERE name='Italian')),
(393, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (393, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (393, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (393, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (393, 'Includes level editor');
-- Subscription Full Spectrum Warrior Complete Pack (Sub ID: 399)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (399, 'Full Spectrum Warrior Complete Pack', '$19.98$14.99', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(399, (SELECT id FROM languages WHERE name='English')),
(399, (SELECT id FROM languages WHERE name='French')),
(399, (SELECT id FROM languages WHERE name='German')),
(399, (SELECT id FROM languages WHERE name='Italian')),
(399, (SELECT id FROM languages WHERE name='Spanish')),
(399, (SELECT id FROM languages WHERE name='Korean'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (399, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (399, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (399, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (399, 'Co-op');
-- Subscription Wolf Pack (Sub ID: 418)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (418, 'Wolf Pack', '$9.98$19.99', '$19.99', '$19.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(418, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (418, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (418, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (418, 'Multi-player');
-- Subscription DOOM II (Sub ID: 420)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (420, 'DOOM II', '$69.98$9.99', '$9.99', '$9.99', '$59.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(420, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (420, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (420, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (420, 'Multi-player');
-- Subscription DOOM 3 Pack (Sub ID: 425)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (425, 'DOOM 3 Pack', '$39.98$29.99', '$29.99', '$29.99', '$9.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(425, 9050, 'DOOM 3', '$19.99', '87'),
(425, 9070, 'DOOM 3 Resurrection of Evil', '$19.99', '78');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(425, (SELECT id FROM languages WHERE name='English')),
(425, (SELECT id FROM languages WHERE name='German')),
(425, (SELECT id FROM languages WHERE name='Italian')),
(425, (SELECT id FROM languages WHERE name='Spanish')),
(425, (SELECT id FROM languages WHERE name='French'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (425, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (425, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (425, 'Multi-player');
-- Subscription DOOM Pack Complete (Sub ID: 426)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (426, 'DOOM Pack Complete', '$79.94$39.99', '$39.99', '$39.99', '$39.95');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(426, 9050, 'DOOM 3', '$19.99', '87'),
(426, 9070, 'DOOM 3 Resurrection of Evil', '$19.99', '78'),
(426, 2300, 'DOOM II', '$9.99', '83'),
(426, 2290, 'Final DOOM', '$9.99', ''),
(426, 9160, 'Master Levels for Doom II', '$9.99', ''),
(426, 2280, 'Ultimate DOOM', '$9.99', '');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(426, (SELECT id FROM languages WHERE name='English')),
(426, (SELECT id FROM languages WHERE name='German')),
(426, (SELECT id FROM languages WHERE name='Italian')),
(426, (SELECT id FROM languages WHERE name='Spanish')),
(426, (SELECT id FROM languages WHERE name='French'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (426, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (426, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (426, 'Multi-player');
-- Subscription QUAKE Collection (Sub ID: 434)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (434, 'QUAKE Collection', '$79.92$29.99', '$29.99', '$29.99', '$49.93');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(434, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (434, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (434, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (434, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (434, 'Co-op');
-- Subscription Heretic + Hexen Collection (Sub ID: 439)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (439, 'Heretic + Hexen Collection', '$19.96$9.99', '$9.99', '$9.99', '$9.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(439, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (439, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (439, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (439, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (439, 'Co-op');
-- Subscription id Super Pack (Sub ID: 440)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (440, 'id Super Pack', '$194.79$69.99', '$69.99', '$69.99', '$124.80');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(440, (SELECT id FROM languages WHERE name='English')),
(440, (SELECT id FROM languages WHERE name='German')),
(440, (SELECT id FROM languages WHERE name='Italian')),
(440, (SELECT id FROM languages WHERE name='Spanish')),
(440, (SELECT id FROM languages WHERE name='French'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (440, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (440, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (440, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (440, 'Co-op');
-- Subscription Enemy Territory: QUAKE Wars? (Sub ID: 506)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (506, 'Enemy Territory: QUAKE Wars?', '$0.00$19.99', '$19.99', '$19.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(506, (SELECT id FROM languages WHERE name='English')),
(506, (SELECT id FROM languages WHERE name='French')),
(506, (SELECT id FROM languages WHERE name='German')),
(506, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (506, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (506, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (506, 'Multi-player');
-- Subscription Sam & Max Complete Season One (Sub ID: 766)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (766, 'Sam & Max Complete Season One', '$64.94$29.99', '$29.99', '$29.99', '$34.95');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(766, (SELECT id FROM languages WHERE name='English')),
(766, (SELECT id FROM languages WHERE name='French')),
(766, (SELECT id FROM languages WHERE name='German')),
(766, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (766, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (766, 'Single-player');
-- Subscription Shadowgrounds Pack (Sub ID: 552)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (552, 'Shadowgrounds Pack', '$4.98$19.99-$16.00', '$3.99', '$3.99', '$0.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(552, (SELECT id FROM languages WHERE name='English')),
(552, (SELECT id FROM languages WHERE name='French')),
(552, (SELECT id FROM languages WHERE name='German')),
(552, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (552, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (552, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (552, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (552, 'Includes level editor');
-- Subscription Company of Heroes: Gold (Sub ID: 553)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (553, 'Company of Heroes: Gold', '$19.98$29.99-$15.00', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(553, (SELECT id FROM languages WHERE name='English')),
(553, (SELECT id FROM languages WHERE name='French')),
(553, (SELECT id FROM languages WHERE name='Spanish')),
(553, (SELECT id FROM languages WHERE name='Italian')),
(553, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (553, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (553, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (553, 'Multi-player');
-- Subscription Garry''s Mod + Team Fortress 2 (Sub ID: 558)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (558, 'Garry''s Mod + Team Fortress 2', '$29.98$24.99', '$24.99', '$24.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(558, (SELECT id FROM languages WHERE name='English')),
(558, (SELECT id FROM languages WHERE name='Danish')),
(558, (SELECT id FROM languages WHERE name='Dutch')),
(558, (SELECT id FROM languages WHERE name='Finnish')),
(558, (SELECT id FROM languages WHERE name='French')),
(558, (SELECT id FROM languages WHERE name='German')),
(558, (SELECT id FROM languages WHERE name='Italian')),
(558, (SELECT id FROM languages WHERE name='Japanese')),
(558, (SELECT id FROM languages WHERE name='Korean')),
(558, (SELECT id FROM languages WHERE name='Norwegian')),
(558, (SELECT id FROM languages WHERE name='Polish')),
(558, (SELECT id FROM languages WHERE name='Portuguese')),
(558, (SELECT id FROM languages WHERE name='Russian')),
(558, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(558, (SELECT id FROM languages WHERE name='Spanish')),
(558, (SELECT id FROM languages WHERE name='Swedish')),
(558, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (558, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Includes level editor');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Includes Source SDK');
-- Subscription Unreal Deal Pack (Sub ID: 683)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (683, 'Unreal Deal Pack', '$69.95$39.99-$26.40', '$13.59', '$13.59', '$56.36');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(683, (SELECT id FROM languages WHERE name='English')),
(683, (SELECT id FROM languages WHERE name='French')),
(683, (SELECT id FROM languages WHERE name='German')),
(683, (SELECT id FROM languages WHERE name='Italian')),
(683, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (683, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Steam Achievements');
-- Subscription Half-Life 2 Episode Pack (Sub ID: 704)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (704, 'Half-Life 2 Episode Pack', '$22.47$19.99-$5.00', '$14.99', '$14.99', '$7.48');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(704, (SELECT id FROM languages WHERE name='English')),
(704, (SELECT id FROM languages WHERE name='French')),
(704, (SELECT id FROM languages WHERE name='German')),
(704, (SELECT id FROM languages WHERE name='Italian')),
(704, (SELECT id FROM languages WHERE name='Korean')),
(704, (SELECT id FROM languages WHERE name='Spanish')),
(704, (SELECT id FROM languages WHERE name='Russian')),
(704, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(704, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(704, (SELECT id FROM languages WHERE name='Dutch')),
(704, (SELECT id FROM languages WHERE name='Danish')),
(704, (SELECT id FROM languages WHERE name='Finnish')),
(704, (SELECT id FROM languages WHERE name='Japanese')),
(704, (SELECT id FROM languages WHERE name='Norwegian')),
(704, (SELECT id FROM languages WHERE name='Polish')),
(704, (SELECT id FROM languages WHERE name='Portuguese')),
(704, (SELECT id FROM languages WHERE name='Swedish')),
(704, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (704, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Steam Achievements');
-- Subscription LUMINES? Base+Advance Pack (Sub ID: 707)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (707, 'LUMINES? Base+Advance Pack', '$8.98$14.99-$7.50', '$7.49', '$7.49', '$1.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(707, (SELECT id FROM languages WHERE name='English')),
(707, (SELECT id FROM languages WHERE name='French')),
(707, (SELECT id FROM languages WHERE name='German')),
(707, (SELECT id FROM languages WHERE name='Italian')),
(707, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (707, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (707, 'Single-player');
-- Subscription Half-Life Complete (Sub ID: 715)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (715, 'Half-Life Complete', '$74.92$49.99', '$49.99', '$49.99', '$24.93');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(715, (SELECT id FROM languages WHERE name='English')),
(715, (SELECT id FROM languages WHERE name='French')),
(715, (SELECT id FROM languages WHERE name='German')),
(715, (SELECT id FROM languages WHERE name='Italian')),
(715, (SELECT id FROM languages WHERE name='Korean')),
(715, (SELECT id FROM languages WHERE name='Spanish')),
(715, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(715, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(715, (SELECT id FROM languages WHERE name='Russian')),
(715, (SELECT id FROM languages WHERE name='Dutch')),
(715, (SELECT id FROM languages WHERE name='Danish')),
(715, (SELECT id FROM languages WHERE name='Finnish')),
(715, (SELECT id FROM languages WHERE name='Japanese')),
(715, (SELECT id FROM languages WHERE name='Norwegian')),
(715, (SELECT id FROM languages WHERE name='Polish')),
(715, (SELECT id FROM languages WHERE name='Portuguese')),
(715, (SELECT id FROM languages WHERE name='Swedish')),
(715, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (715, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Includes level editor');
INSERT INTO sub_dates (sub_id, release_date) VALUES (715, '2008-05-02') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Half-Life 2 Complete (Sub ID: 716)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (716, 'Half-Life 2 Complete', '$49.96$34.99', '$34.99', '$34.99', '$14.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(716, (SELECT id FROM languages WHERE name='English')),
(716, (SELECT id FROM languages WHERE name='French')),
(716, (SELECT id FROM languages WHERE name='German')),
(716, (SELECT id FROM languages WHERE name='Italian')),
(716, (SELECT id FROM languages WHERE name='Korean')),
(716, (SELECT id FROM languages WHERE name='Spanish')),
(716, (SELECT id FROM languages WHERE name='Russian')),
(716, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(716, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(716, (SELECT id FROM languages WHERE name='Dutch')),
(716, (SELECT id FROM languages WHERE name='Danish')),
(716, (SELECT id FROM languages WHERE name='Finnish')),
(716, (SELECT id FROM languages WHERE name='Japanese')),
(716, (SELECT id FROM languages WHERE name='Norwegian')),
(716, (SELECT id FROM languages WHERE name='Polish')),
(716, (SELECT id FROM languages WHERE name='Portuguese')),
(716, (SELECT id FROM languages WHERE name='Swedish')),
(716, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (716, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Includes level editor');
INSERT INTO sub_dates (sub_id, release_date) VALUES (716, '2008-05-02') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Counter-Strike Complete (Sub ID: 717)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (717, 'Counter-Strike Complete', '$41.19$29.99-$7.50', '$22.49', '$22.49', '$18.70');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(717, (SELECT id FROM languages WHERE name='English')),
(717, (SELECT id FROM languages WHERE name='French')),
(717, (SELECT id FROM languages WHERE name='German')),
(717, (SELECT id FROM languages WHERE name='Italian')),
(717, (SELECT id FROM languages WHERE name='Korean')),
(717, (SELECT id FROM languages WHERE name='Spanish')),
(717, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(717, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(717, (SELECT id FROM languages WHERE name='Japanese')),
(717, (SELECT id FROM languages WHERE name='Russian')),
(717, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (717, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'Includes Source SDK');
INSERT INTO sub_dates (sub_id, release_date) VALUES (717, '2008-05-02') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Blazing Angels® Pack (Sub ID: 736)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (736, 'Blazing Angels® Pack', '$14.98$24.99-$12.50', '$12.49', '$12.49', '$2.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(736, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (736, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (736, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (736, 'Multi-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (736, '2008-05-13') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Sam & Max Complete (Sub ID: 766)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (766, 'Sam & Max Complete', '$109.89$59.99', '$59.99', '$59.99', '$49.90');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(766, (SELECT id FROM languages WHERE name='English')),
(766, (SELECT id FROM languages WHERE name='French')),
(766, (SELECT id FROM languages WHERE name='German')),
(766, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (766, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (766, 'Single-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (766, '2008-05-16') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Tom Clancy''s Ghost Recon® Complete Pack (Sub ID: 864)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (864, 'Tom Clancy''s Ghost Recon® Complete Pack', '$24.95$39.99-$20.00', '$19.99', '$19.99', '$4.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(864, (SELECT id FROM languages WHERE name='English')),
(864, (SELECT id FROM languages WHERE name='French')),
(864, (SELECT id FROM languages WHERE name='Spanish')),
(864, (SELECT id FROM languages WHERE name='Italian')),
(864, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (864, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (864, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (864, 'Multi-player');
-- Subscription Family Gaming Pack (Sub ID: 874)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (874, 'Family Gaming Pack', '$109.89$29.99', '$29.99', '$29.99', '$79.90');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(874, (SELECT id FROM languages WHERE name='English')),
(874, (SELECT id FROM languages WHERE name='French')),
(874, (SELECT id FROM languages WHERE name='German')),
(874, (SELECT id FROM languages WHERE name='Italian')),
(874, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (874, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (874, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (874, 'Multi-player');
-- Subscription Silverfall: Complete (Sub ID: 879)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (879, 'Silverfall: Complete', '$29.98$24.99', '$24.99', '$24.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(879, (SELECT id FROM languages WHERE name='English')),
(879, (SELECT id FROM languages WHERE name='French')),
(879, (SELECT id FROM languages WHERE name='German')),
(879, (SELECT id FROM languages WHERE name='Italian')),
(879, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (879, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (879, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (879, 'Multi-player');
-- Subscription The Settlers® Pack (Sub ID: 882)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (882, 'The Settlers® Pack', '$19.98$34.99-$17.50', '$17.49', '$17.49', '$2.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(882, (SELECT id FROM languages WHERE name='English')),
(882, (SELECT id FROM languages WHERE name='French')),
(882, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (882, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (882, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (882, 'Multi-player');
-- Subscription Pacific Storm Pack (Sub ID: 927)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (927, 'Pacific Storm Pack', '$48.00$14.99-$12.00', '$2.99', '$2.99', '$45.01');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(927, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (927, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (927, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (927, 'Multi-player');
-- Subscription FlatOut: Ultimate Carnage (Sub ID: 944)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (944, 'FlatOut: Ultimate Carnage', '$0.00$19.99', '$19.99', '$19.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(944, 12360, 'FlatOut: Ultimate Carnage', '', '79');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(944, (SELECT id FROM languages WHERE name='English')),
(944, (SELECT id FROM languages WHERE name='French')),
(944, (SELECT id FROM languages WHERE name='German')),
(944, (SELECT id FROM languages WHERE name='Italian')),
(944, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (944, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (944, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (944, 'Multi-player');
-- Subscription Oddworld Pack (Sub ID: 949)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (949, 'Oddworld Pack', '$3.74$9.99-$7.50', '$2.49', '$2.49', '$1.25');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(949, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (949, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (949, 'Single-player');
-- Subscription GTR Evolution Complete (Sub ID: 956)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (956, 'GTR Evolution Complete', '$39.98$29.99', '$29.99', '$29.99', '$9.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(956, (SELECT id FROM languages WHERE name='English')),
(956, (SELECT id FROM languages WHERE name='French')),
(956, (SELECT id FROM languages WHERE name='German')),
(956, (SELECT id FROM languages WHERE name='Italian')),
(956, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (956, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (956, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (956, 'Multi-player');
-- Subscription X-COM: Complete Pack (Sub ID: 964)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (964, 'X-COM: Complete Pack', '$16.70$14.99-$4.95', '$10.04', '$10.04', '$6.66');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(964, (SELECT id FROM languages WHERE name='English')),
(964, (SELECT id FROM languages WHERE name='French')),
(964, (SELECT id FROM languages WHERE name='German')),
(964, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (964, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (964, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (964, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (964, 'Co-op');
-- Subscription Multiwinia + Darwinia (Sub ID: 978)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (978, 'Multiwinia + Darwinia', '$14.98$14.99-$7.50', '$7.49', '$7.49', '$7.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(978, (SELECT id FROM languages WHERE name='English')),
(978, (SELECT id FROM languages WHERE name='French')),
(978, (SELECT id FROM languages WHERE name='Italian')),
(978, (SELECT id FROM languages WHERE name='German')),
(978, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (978, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (978, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (978, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (978, 'Steam Achievements');
-- Subscription The Gumboy Pack (Sub ID: 979)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (979, 'The Gumboy Pack', '$9.98$7.99', '$7.99', '$7.99', '$1.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(979, (SELECT id FROM languages WHERE name='English')),
(979, (SELECT id FROM languages WHERE name='Polish')),
(979, (SELECT id FROM languages WHERE name='Russian')),
(979, (SELECT id FROM languages WHERE name='Czech')),
(979, (SELECT id FROM languages WHERE name='Slovak')),
(979, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (979, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (979, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (979, 'Multi-player');
-- Subscription Counter-Strike: Condition Zero (Sub ID: 7)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (7, 'Counter-Strike: Condition Zero', '$22.48$9.99-$2.50', '$7.49', '$7.49', '$14.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(7, (SELECT id FROM languages WHERE name='English')),
(7, (SELECT id FROM languages WHERE name='French')),
(7, (SELECT id FROM languages WHERE name='German')),
(7, (SELECT id FROM languages WHERE name='Italian')),
(7, (SELECT id FROM languages WHERE name='Korean')),
(7, (SELECT id FROM languages WHERE name='Spanish')),
(7, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(7, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (7, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (7, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (7, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (7, 'Single-player');
-- Subscription Half-Life 2 (Sub ID: 36)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (36, 'Half-Life 2', '$29.99$19.99', '$19.99', '$19.99', '$10.00');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(36, (SELECT id FROM languages WHERE name='English')),
(36, (SELECT id FROM languages WHERE name='French')),
(36, (SELECT id FROM languages WHERE name='German')),
(36, (SELECT id FROM languages WHERE name='Italian')),
(36, (SELECT id FROM languages WHERE name='Korean')),
(36, (SELECT id FROM languages WHERE name='Spanish')),
(36, (SELECT id FROM languages WHERE name='Russian')),
(36, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(36, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(36, (SELECT id FROM languages WHERE name='Dutch')),
(36, (SELECT id FROM languages WHERE name='Danish')),
(36, (SELECT id FROM languages WHERE name='Finnish')),
(36, (SELECT id FROM languages WHERE name='Japanese')),
(36, (SELECT id FROM languages WHERE name='Norwegian')),
(36, (SELECT id FROM languages WHERE name='Polish')),
(36, (SELECT id FROM languages WHERE name='Portuguese')),
(36, (SELECT id FROM languages WHERE name='Swedish')),
(36, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (36, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (36, 'Commentary available');
-- Subscription Half-Life 1: Source (Sub ID: 38)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (38, 'Half-Life 1: Source', '$0.00$9.99-$2.50', '$7.49', '$7.49', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(38, (SELECT id FROM languages WHERE name='English')),
(38, (SELECT id FROM languages WHERE name='French')),
(38, (SELECT id FROM languages WHERE name='German')),
(38, (SELECT id FROM languages WHERE name='Italian')),
(38, (SELECT id FROM languages WHERE name='Japanese')),
(38, (SELECT id FROM languages WHERE name='Korean')),
(38, (SELECT id FROM languages WHERE name='Spanish')),
(38, (SELECT id FROM languages WHERE name='Russian')),
(38, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(38, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(38, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (38, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (38, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (38, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (38, 'Single-player');
-- Subscription Half-Life 1 Anthology (Sub ID: 40)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (40, 'Half-Life 1 Anthology', '$18.71$14.99-$3.75', '$11.24', '$11.24', '$7.47');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(40, (SELECT id FROM languages WHERE name='English')),
(40, (SELECT id FROM languages WHERE name='French')),
(40, (SELECT id FROM languages WHERE name='German')),
(40, (SELECT id FROM languages WHERE name='Italian')),
(40, (SELECT id FROM languages WHERE name='Korean')),
(40, (SELECT id FROM languages WHERE name='Spanish')),
(40, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(40, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (40, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (40, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (40, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (40, 'Valve Anti-Cheat enabled');
-- Subscription Counter-Strike 1 Anthology (Sub ID: 41)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (41, 'Counter-Strike 1 Anthology', '$34.95$14.99', '$14.99', '$14.99', '$19.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(41, (SELECT id FROM languages WHERE name='English')),
(41, (SELECT id FROM languages WHERE name='French')),
(41, (SELECT id FROM languages WHERE name='German')),
(41, (SELECT id FROM languages WHERE name='Italian')),
(41, (SELECT id FROM languages WHERE name='Korean')),
(41, (SELECT id FROM languages WHERE name='Spanish')),
(41, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(41, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (41, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (41, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (41, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (41, 'Single-player');
-- Subscription Source Multiplayer Pack (Sub ID: 42)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (42, 'Source Multiplayer Pack', '$34.97$29.99', '$29.99', '$29.99', '$4.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(42, (SELECT id FROM languages WHERE name='English')),
(42, (SELECT id FROM languages WHERE name='French')),
(42, (SELECT id FROM languages WHERE name='German')),
(42, (SELECT id FROM languages WHERE name='Italian')),
(42, (SELECT id FROM languages WHERE name='Japanese')),
(42, (SELECT id FROM languages WHERE name='Korean')),
(42, (SELECT id FROM languages WHERE name='Spanish')),
(42, (SELECT id FROM languages WHERE name='Russian')),
(42, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(42, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(42, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (42, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (42, 'Stats');
-- Subscription SiN Episodes: Emergence (Sub ID: 70)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (70, 'SiN Episodes: Emergence', '$0.00$9.99', '$9.99', '$9.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(70, (SELECT id FROM languages WHERE name='English')),
(70, (SELECT id FROM languages WHERE name='French')),
(70, (SELECT id FROM languages WHERE name='German')),
(70, (SELECT id FROM languages WHERE name='Russian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (70, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (70, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (70, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (70, 'Stats');
-- Subscription Half-Life 2: Episode One (Sub ID: 79)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (79, 'Half-Life 2: Episode One', '$24.98$9.99', '$9.99', '$9.99', '$14.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(79, (SELECT id FROM languages WHERE name='English')),
(79, (SELECT id FROM languages WHERE name='French')),
(79, (SELECT id FROM languages WHERE name='German')),
(79, (SELECT id FROM languages WHERE name='Italian')),
(79, (SELECT id FROM languages WHERE name='Korean')),
(79, (SELECT id FROM languages WHERE name='Spanish')),
(79, (SELECT id FROM languages WHERE name='Russian')),
(79, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(79, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(79, (SELECT id FROM languages WHERE name='Dutch')),
(79, (SELECT id FROM languages WHERE name='Danish')),
(79, (SELECT id FROM languages WHERE name='Finnish')),
(79, (SELECT id FROM languages WHERE name='Japanese')),
(79, (SELECT id FROM languages WHERE name='Norwegian')),
(79, (SELECT id FROM languages WHERE name='Polish')),
(79, (SELECT id FROM languages WHERE name='Portuguese')),
(79, (SELECT id FROM languages WHERE name='Swedish')),
(79, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (79, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (79, 'Controller enabled');
-- Subscription Disciples II Gold (Sub ID: 95)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (95, 'Disciples II Gold', '$29.98$19.99-$10.00', '$9.99', '$9.99', '$19.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(95, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (95, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (95, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (95, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (95, 'Co-op');
-- Subscription Jagged Alliance 2 / Disciples II Gold Combo (Sub ID: 96)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (96, 'Jagged Alliance 2 / Disciples II Gold Combo', '$59.97$29.99', '$29.99', '$29.99', '$29.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(96, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (96, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (96, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (96, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (96, 'Co-op');
-- Subscription X2/X3 Pack (Sub ID: 102)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (102, 'X2/X3 Pack', '$14.98$10.99', '$10.99', '$10.99', '$3.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(102, (SELECT id FROM languages WHERE name='English')),
(102, (SELECT id FROM languages WHERE name='French')),
(102, (SELECT id FROM languages WHERE name='German')),
(102, (SELECT id FROM languages WHERE name='Spanish')),
(102, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (102, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (102, 'Single-player');
-- Subscription Uplink/Darwinia Pack (Sub ID: 113)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (113, 'Uplink/Darwinia Pack', '$19.98$14.99', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(113, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (113, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (113, 'Single-player');
-- Subscription Xpand Rally + GTI Racing Pack (Sub ID: 116)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (116, 'Xpand Rally + GTI Racing Pack', '$9.98$7.99', '$7.99', '$7.99', '$1.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(116, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (116, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (116, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (116, 'Multi-player');
-- Subscription Classic Naval Combat Pack (Sub ID: 199)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (199, 'Classic Naval Combat Pack', '$44.97$19.99-$10.00', '$9.99', '$9.99', '$34.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(199, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (199, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (199, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (199, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (199, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (199, 'Includes level editor');
-- Subscription Complete Naval Combat Pack (Sub ID: 200)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (200, 'Complete Naval Combat Pack', '$44.96$29.99-$15.00', '$14.99', '$14.99', '$29.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(200, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (200, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (200, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (200, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (200, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (200, 'Includes level editor');
-- Subscription Counter-Strike: Source + Garry''s Mod (Sub ID: 219)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (219, 'Counter-Strike: Source + Garry''s Mod', '$22.48$24.99-$6.25', '$18.74', '$18.74', '$3.74');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(219, (SELECT id FROM languages WHERE name='English')),
(219, (SELECT id FROM languages WHERE name='French')),
(219, (SELECT id FROM languages WHERE name='German')),
(219, (SELECT id FROM languages WHERE name='Italian')),
(219, (SELECT id FROM languages WHERE name='Japanese')),
(219, (SELECT id FROM languages WHERE name='Korean')),
(219, (SELECT id FROM languages WHERE name='Spanish')),
(219, (SELECT id FROM languages WHERE name='Russian')),
(219, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(219, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(219, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (219, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (219, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (219, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (219, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (219, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (219, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (219, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (219, 'Includes level editor');
-- Subscription Call of Duty®: War Chest (Sub ID: 222)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (222, 'Call of Duty®: War Chest', '$59.97$29.99', '$29.99', '$29.99', '$29.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(222, (SELECT id FROM languages WHERE name='English')),
(222, (SELECT id FROM languages WHERE name='French')),
(222, (SELECT id FROM languages WHERE name='German')),
(222, (SELECT id FROM languages WHERE name='Italian')),
(222, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (222, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (222, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (222, 'Multi-player');
-- Subscription FlatOut + FlatOut 2 Pack (Sub ID: 254)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (254, 'FlatOut + FlatOut 2 Pack', '$19.98$14.99', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(254, (SELECT id FROM languages WHERE name='English')),
(254, (SELECT id FROM languages WHERE name='French')),
(254, (SELECT id FROM languages WHERE name='German')),
(254, (SELECT id FROM languages WHERE name='Italian')),
(254, (SELECT id FROM languages WHERE name='Spanish')),
(254, (SELECT id FROM languages WHERE name='Dutch'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (254, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (254, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (254, 'Multi-player');
-- Subscription The Hitman Collection (Sub ID: 283)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (283, 'The Hitman Collection', '$20.07$19.99-$6.60', '$13.39', '$13.39', '$6.68');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(283, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (283, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (283, 'Single-player');
-- Subscription Space Empires IV and V Pack (Sub ID: 287)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (287, 'Space Empires IV and V Pack', '$24.98$19.99', '$19.99', '$19.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(287, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (287, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (287, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (287, 'Multi-player');
-- Subscription The Longest Journey + Dreamfall (Sub ID: 320)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (320, 'The Longest Journey + Dreamfall', '$29.98$24.99', '$24.99', '$24.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(320, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (320, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (320, 'Single-player');
-- Subscription Railroad Tycoon Collection (Sub ID: 326)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (326, 'Railroad Tycoon Collection', '$23.42$24.99-$8.25', '$16.74', '$16.74', '$6.68');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(326, (SELECT id FROM languages WHERE name='English')),
(326, (SELECT id FROM languages WHERE name='French')),
(326, (SELECT id FROM languages WHERE name='German')),
(326, (SELECT id FROM languages WHERE name='Italian')),
(326, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (326, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (326, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (326, 'Multi-player');
-- Subscription The Ship - Complete Pack (Sub ID: 333)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (333, 'The Ship - Complete Pack', '$9.99$19.99', '$19.99', '$19.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(333, (SELECT id FROM languages WHERE name='English')),
(333, (SELECT id FROM languages WHERE name='French')),
(333, (SELECT id FROM languages WHERE name='German')),
(333, (SELECT id FROM languages WHERE name='Italian')),
(333, (SELECT id FROM languages WHERE name='Spanish')),
(333, (SELECT id FROM languages WHERE name='Polish')),
(333, (SELECT id FROM languages WHERE name='Russian')),
(333, (SELECT id FROM languages WHERE name='Japanese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (333, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (333, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (333, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (333, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (333, 'HDR available');
-- Subscription Sam & Max: Episodes 101 - 103 (Sub ID: 363)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (363, 'Sam & Max: Episodes 101 - 103', '$26.97$19.99', '$19.99', '$19.99', '$6.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(363, (SELECT id FROM languages WHERE name='English')),
(363, (SELECT id FROM languages WHERE name='French')),
(363, (SELECT id FROM languages WHERE name='German')),
(363, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (363, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (363, 'Single-player');
-- Subscription Sam & Max: Episodes 104 - 106 (Sub ID: 364)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (364, 'Sam & Max: Episodes 104 - 106', '$47.97$19.99', '$19.99', '$19.99', '$27.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(364, (SELECT id FROM languages WHERE name='English')),
(364, (SELECT id FROM languages WHERE name='French')),
(364, (SELECT id FROM languages WHERE name='German')),
(364, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (364, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (364, 'Single-player');
-- Subscription Best of the Underground (Sub ID: 376)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (376, 'Best of the Underground', '$23.97$19.99', '$19.99', '$19.99', '$3.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(376, (SELECT id FROM languages WHERE name='English')),
(376, (SELECT id FROM languages WHERE name='Polish')),
(376, (SELECT id FROM languages WHERE name='Russian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (376, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (376, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (376, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (376, 'Multi-player');
-- Subscription RACE + Caterham Expansion (Sub ID: 379)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (379, 'RACE + Caterham Expansion', '$4.99$24.99', '$24.99', '$24.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(379, (SELECT id FROM languages WHERE name='English')),
(379, (SELECT id FROM languages WHERE name='French')),
(379, (SELECT id FROM languages WHERE name='German')),
(379, (SELECT id FROM languages WHERE name='Italian')),
(379, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (379, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (379, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (379, 'Multi-player');
-- Subscription Civilization IV® Complete Pack (Sub ID: 393)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (393, 'Civilization IV® Complete Pack', '$59.97$49.99', '$49.99', '$49.99', '$9.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(393, (SELECT id FROM languages WHERE name='English')),
(393, (SELECT id FROM languages WHERE name='French')),
(393, (SELECT id FROM languages WHERE name='German')),
(393, (SELECT id FROM languages WHERE name='Italian')),
(393, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (393, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (393, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (393, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (393, 'Includes level editor');
-- Subscription Full Spectrum Warrior Complete Pack (Sub ID: 399)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (399, 'Full Spectrum Warrior Complete Pack', '$19.98$14.99', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(399, (SELECT id FROM languages WHERE name='English')),
(399, (SELECT id FROM languages WHERE name='French')),
(399, (SELECT id FROM languages WHERE name='German')),
(399, (SELECT id FROM languages WHERE name='Italian')),
(399, (SELECT id FROM languages WHERE name='Spanish')),
(399, (SELECT id FROM languages WHERE name='Korean'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (399, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (399, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (399, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (399, 'Co-op');
-- Subscription Titan Quest Gold (Sub ID: 402)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (402, 'Titan Quest Gold', '$14.98$19.99-$10.00', '$9.99', '$9.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(402, (SELECT id FROM languages WHERE name='English')),
(402, (SELECT id FROM languages WHERE name='French')),
(402, (SELECT id FROM languages WHERE name='German')),
(402, (SELECT id FROM languages WHERE name='Italian')),
(402, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (402, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (402, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (402, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (402, 'Includes level editor');
-- Subscription Wolf Pack (Sub ID: 418)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (418, 'Wolf Pack', '$9.98$19.99', '$19.99', '$19.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(418, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (418, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (418, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (418, 'Multi-player');
-- Subscription DOOM II (Sub ID: 420)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (420, 'DOOM II', '$69.98$9.99', '$9.99', '$9.99', '$59.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(420, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (420, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (420, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (420, 'Multi-player');
-- Subscription DOOM 3 Pack (Sub ID: 425)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (425, 'DOOM 3 Pack', '$39.98$29.99', '$29.99', '$29.99', '$9.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(425, 9050, 'DOOM 3', '$19.99', '87'),
(425, 9070, 'DOOM 3 Resurrection of Evil', '$19.99', '78');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(425, (SELECT id FROM languages WHERE name='English')),
(425, (SELECT id FROM languages WHERE name='German')),
(425, (SELECT id FROM languages WHERE name='Italian')),
(425, (SELECT id FROM languages WHERE name='Spanish')),
(425, (SELECT id FROM languages WHERE name='French'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (425, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (425, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (425, 'Multi-player');
-- Subscription DOOM Pack Complete (Sub ID: 426)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (426, 'DOOM Pack Complete', '$79.94$39.99', '$39.99', '$39.99', '$39.95');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(426, 9050, 'DOOM 3', '$19.99', '87'),
(426, 9070, 'DOOM 3 Resurrection of Evil', '$19.99', '78'),
(426, 2300, 'DOOM II', '$9.99', '83'),
(426, 2290, 'Final DOOM', '$9.99', ''),
(426, 9160, 'Master Levels for Doom II', '$9.99', ''),
(426, 2280, 'Ultimate DOOM', '$9.99', '');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(426, (SELECT id FROM languages WHERE name='English')),
(426, (SELECT id FROM languages WHERE name='German')),
(426, (SELECT id FROM languages WHERE name='Italian')),
(426, (SELECT id FROM languages WHERE name='Spanish')),
(426, (SELECT id FROM languages WHERE name='French'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (426, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (426, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (426, 'Multi-player');
-- Subscription QUAKE III Arena + Team Arena (Sub ID: 433)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (433, 'QUAKE III Arena + Team Arena', '$59.98$19.99', '$19.99', '$19.99', '$39.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(433, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (433, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (433, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (433, 'Multi-player');
-- Subscription QUAKE Collection (Sub ID: 434)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (434, 'QUAKE Collection', '$79.92$29.99', '$29.99', '$29.99', '$49.93');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(434, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (434, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (434, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (434, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (434, 'Co-op');
-- Subscription Heretic + Hexen Collection (Sub ID: 439)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (439, 'Heretic + Hexen Collection', '$19.96$9.99', '$9.99', '$9.99', '$9.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(439, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (439, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (439, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (439, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (439, 'Co-op');
-- Subscription id Super Pack (Sub ID: 440)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (440, 'id Super Pack', '$194.79$69.99', '$69.99', '$69.99', '$124.80');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(440, (SELECT id FROM languages WHERE name='English')),
(440, (SELECT id FROM languages WHERE name='German')),
(440, (SELECT id FROM languages WHERE name='Italian')),
(440, (SELECT id FROM languages WHERE name='Spanish')),
(440, (SELECT id FROM languages WHERE name='French'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (440, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (440, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (440, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (440, 'Co-op');
-- Subscription Dawn of War - Platinum Edition (Sub ID: 447)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (447, 'Dawn of War - Platinum Edition', '$19.98$29.99-$15.00', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(447, (SELECT id FROM languages WHERE name='English')),
(447, (SELECT id FROM languages WHERE name='French')),
(447, (SELECT id FROM languages WHERE name='German')),
(447, (SELECT id FROM languages WHERE name='Italian')),
(447, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (447, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (447, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (447, 'Multi-player');
-- Subscription Medieval II Gold (Sub ID: 460)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (460, 'Medieval II Gold', '$34.98$29.95', '$29.95', '$29.95', '$5.03');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(460, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (460, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (460, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (460, 'Multi-player');
-- Subscription Rome: Total War? - Complete (Sub ID: 463)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (463, 'Rome: Total War? - Complete', '$19.98$9.99', '$9.99', '$9.99', '$9.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(463, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (463, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (463, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (463, 'Multi-player');
-- Subscription The Orange Box (Sub ID: 469)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (469, 'The Orange Box', '$63.70$29.99-$7.50', '$22.49', '$22.49', '$41.21');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(469, (SELECT id FROM languages WHERE name='English')),
(469, (SELECT id FROM languages WHERE name='French')),
(469, (SELECT id FROM languages WHERE name='German')),
(469, (SELECT id FROM languages WHERE name='Italian')),
(469, (SELECT id FROM languages WHERE name='Korean')),
(469, (SELECT id FROM languages WHERE name='Spanish')),
(469, (SELECT id FROM languages WHERE name='Russian')),
(469, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(469, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(469, (SELECT id FROM languages WHERE name='Dutch')),
(469, (SELECT id FROM languages WHERE name='Danish')),
(469, (SELECT id FROM languages WHERE name='Finnish')),
(469, (SELECT id FROM languages WHERE name='Japanese')),
(469, (SELECT id FROM languages WHERE name='Norwegian')),
(469, (SELECT id FROM languages WHERE name='Polish')),
(469, (SELECT id FROM languages WHERE name='Portuguese')),
(469, (SELECT id FROM languages WHERE name='Swedish')),
(469, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (469, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Includes level editor');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (469, 'Valve Anti-Cheat enabled');
-- Subscription Valve Complete Pack (Sub ID: 478)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (478, 'Valve Complete Pack', '$189.82$99.99', '$99.99', '$99.99', '$89.83');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(478, 10, 'Counter-Strike', '$9.99', '88'),
(478, 80, 'Counter-Strike: Condition Zero', '$9.99', '65'),
(478, 240, 'Counter-Strike: Source', '$19.99', '88'),
(478, 30, 'Day of Defeat', '$4.99', '79'),
(478, 300, 'Day of Defeat: Source', '$9.99', '80'),
(478, 40, 'Deathmatch Classic', '$4.99', ''),
(478, 70, 'Half-Life', '$9.99', '96'),
(478, 220, 'Half-Life 2', '$19.99', '96'),
(478, 320, 'Half-Life 2: Deathmatch', '$4.99', ''),
(478, 380, 'Half-Life 2: Episode One', '$9.99', '87'),
(478, 420, 'Half-Life 2: Episode Two', '$14.99', '90'),
(478, 340, 'Half-Life 2: Lost Coast', 'N/A', ''),
(478, 360, 'Half-Life Deathmatch: Source', 'N/A', ''),
(478, 130, 'Half-Life: Blue Shift', '$4.99', '71'),
(478, 50, 'Half-Life: Opposing Force', '$4.99', ''),
(478, 280, 'Half-Life: Source', '$9.99', ''),
(478, 3483, 'Peggle Extreme', 'N/A', ''),
(478, 400, 'Portal', '$19.99', '90'),
(478, 60, 'Ricochet', '$4.99', ''),
(478, 440, 'Team Fortress 2', '$19.99', '92'),
(478, 20, 'Team Fortress Classic', '$4.99', '');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(478, (SELECT id FROM languages WHERE name='English')),
(478, (SELECT id FROM languages WHERE name='French')),
(478, (SELECT id FROM languages WHERE name='German')),
(478, (SELECT id FROM languages WHERE name='Italian')),
(478, (SELECT id FROM languages WHERE name='Korean')),
(478, (SELECT id FROM languages WHERE name='Spanish')),
(478, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(478, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(478, (SELECT id FROM languages WHERE name='Japanese')),
(478, (SELECT id FROM languages WHERE name='Russian')),
(478, (SELECT id FROM languages WHERE name='Thai')),
(478, (SELECT id FROM languages WHERE name='Dutch')),
(478, (SELECT id FROM languages WHERE name='Danish')),
(478, (SELECT id FROM languages WHERE name='Finnish')),
(478, (SELECT id FROM languages WHERE name='Norwegian')),
(478, (SELECT id FROM languages WHERE name='Polish')),
(478, (SELECT id FROM languages WHERE name='Portuguese')),
(478, (SELECT id FROM languages WHERE name='Swedish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (478, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Includes level editor');
-- Subscription Source Premier Pack (Sub ID: 478)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (478, 'Source Premier Pack', '$129.91$79.99', '$79.99', '$79.99', '$49.92');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(478, 240, 'Counter-Strike: Source', '$19.99', '88'),
(478, 300, 'Day of Defeat: Source', '$9.99', '80'),
(478, 220, 'Half-Life 2', '$19.99', '96'),
(478, 320, 'Half-Life 2: Deathmatch', '$4.99', ''),
(478, 380, 'Half-Life 2: Episode One', '$9.99', '87'),
(478, 420, 'Half-Life 2: Episode Two', '$14.99', '90'),
(478, 340, 'Half-Life 2: Lost Coast', 'N/A', ''),
(478, 360, 'Half-Life Deathmatch: Source', 'N/A', ''),
(478, 280, 'Half-Life: Source', '$9.99', ''),
(478, 3483, 'Peggle Extreme', 'N/A', ''),
(478, 400, 'Portal', '$19.99', '90'),
(478, 440, 'Team Fortress 2', '$19.99', '92');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(478, (SELECT id FROM languages WHERE name='English')),
(478, (SELECT id FROM languages WHERE name='French')),
(478, (SELECT id FROM languages WHERE name='German')),
(478, (SELECT id FROM languages WHERE name='Italian')),
(478, (SELECT id FROM languages WHERE name='Japanese')),
(478, (SELECT id FROM languages WHERE name='Korean')),
(478, (SELECT id FROM languages WHERE name='Spanish')),
(478, (SELECT id FROM languages WHERE name='Russian')),
(478, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(478, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(478, (SELECT id FROM languages WHERE name='Thai')),
(478, (SELECT id FROM languages WHERE name='Dutch')),
(478, (SELECT id FROM languages WHERE name='Danish')),
(478, (SELECT id FROM languages WHERE name='Finnish')),
(478, (SELECT id FROM languages WHERE name='Norwegian')),
(478, (SELECT id FROM languages WHERE name='Polish')),
(478, (SELECT id FROM languages WHERE name='Portuguese')),
(478, (SELECT id FROM languages WHERE name='Swedish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (478, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (478, 'Includes level editor');
-- Subscription PopCap Favorites (Sub ID: 496)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (496, 'PopCap Favorites', '$89.95$39.99', '$39.99', '$39.99', '$49.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(496, 3300, 'Bejeweled 2 Deluxe', '$19.99', ''),
(496, 3470, 'Bookworm Adventures Deluxe', '$19.99', '82'),
(496, 3320, 'Insaniquarium Deluxe', '$19.99', ''),
(496, 3480, 'Peggle Deluxe', '$9.99', '85'),
(496, 3330, 'Zuma Deluxe', '$19.99', '');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(496, (SELECT id FROM languages WHERE name='English')),
(496, (SELECT id FROM languages WHERE name='French')),
(496, (SELECT id FROM languages WHERE name='German')),
(496, (SELECT id FROM languages WHERE name='Italian')),
(496, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (496, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (496, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (496, 'New releases');
-- Subscription Enemy Territory: QUAKE Wars? (Sub ID: 506)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (506, 'Enemy Territory: QUAKE Wars?', '$0.00$19.99', '$19.99', '$19.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(506, (SELECT id FROM languages WHERE name='English')),
(506, (SELECT id FROM languages WHERE name='French')),
(506, (SELECT id FROM languages WHERE name='German')),
(506, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (506, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (506, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (506, 'Multi-player');
-- Subscription Sam & Max Complete Season One (Sub ID: 766)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (766, 'Sam & Max Complete Season One', '$64.94$29.99', '$29.99', '$29.99', '$34.95');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(766, (SELECT id FROM languages WHERE name='English')),
(766, (SELECT id FROM languages WHERE name='French')),
(766, (SELECT id FROM languages WHERE name='German')),
(766, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (766, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (766, 'Single-player');
-- Subscription Shadowgrounds Pack (Sub ID: 552)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (552, 'Shadowgrounds Pack', '$4.98$19.99-$16.00', '$3.99', '$3.99', '$0.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(552, (SELECT id FROM languages WHERE name='English')),
(552, (SELECT id FROM languages WHERE name='French')),
(552, (SELECT id FROM languages WHERE name='German')),
(552, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (552, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (552, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (552, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (552, 'Includes level editor');
-- Subscription Company of Heroes: Gold (Sub ID: 553)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (553, 'Company of Heroes: Gold', '$19.98$29.99-$15.00', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(553, (SELECT id FROM languages WHERE name='English')),
(553, (SELECT id FROM languages WHERE name='French')),
(553, (SELECT id FROM languages WHERE name='Spanish')),
(553, (SELECT id FROM languages WHERE name='Italian')),
(553, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (553, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (553, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (553, 'Multi-player');
-- Subscription Garry''s Mod + Team Fortress 2 (Sub ID: 558)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (558, 'Garry''s Mod + Team Fortress 2', '$29.98$24.99', '$24.99', '$24.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(558, (SELECT id FROM languages WHERE name='English')),
(558, (SELECT id FROM languages WHERE name='Danish')),
(558, (SELECT id FROM languages WHERE name='Dutch')),
(558, (SELECT id FROM languages WHERE name='Finnish')),
(558, (SELECT id FROM languages WHERE name='French')),
(558, (SELECT id FROM languages WHERE name='German')),
(558, (SELECT id FROM languages WHERE name='Italian')),
(558, (SELECT id FROM languages WHERE name='Japanese')),
(558, (SELECT id FROM languages WHERE name='Korean')),
(558, (SELECT id FROM languages WHERE name='Norwegian')),
(558, (SELECT id FROM languages WHERE name='Polish')),
(558, (SELECT id FROM languages WHERE name='Portuguese')),
(558, (SELECT id FROM languages WHERE name='Russian')),
(558, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(558, (SELECT id FROM languages WHERE name='Spanish')),
(558, (SELECT id FROM languages WHERE name='Swedish')),
(558, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (558, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Includes level editor');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (558, 'Includes Source SDK');
-- Subscription Unreal Deal Pack (Sub ID: 683)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (683, 'Unreal Deal Pack', '$69.95$39.99-$26.40', '$13.59', '$13.59', '$56.36');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(683, (SELECT id FROM languages WHERE name='English')),
(683, (SELECT id FROM languages WHERE name='French')),
(683, (SELECT id FROM languages WHERE name='German')),
(683, (SELECT id FROM languages WHERE name='Italian')),
(683, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (683, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Steam Achievements');
-- Subscription Half-Life 2 Episode Pack (Sub ID: 704)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (704, 'Half-Life 2 Episode Pack', '$22.47$19.99-$5.00', '$14.99', '$14.99', '$7.48');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(704, (SELECT id FROM languages WHERE name='English')),
(704, (SELECT id FROM languages WHERE name='French')),
(704, (SELECT id FROM languages WHERE name='German')),
(704, (SELECT id FROM languages WHERE name='Italian')),
(704, (SELECT id FROM languages WHERE name='Korean')),
(704, (SELECT id FROM languages WHERE name='Spanish')),
(704, (SELECT id FROM languages WHERE name='Russian')),
(704, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(704, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(704, (SELECT id FROM languages WHERE name='Dutch')),
(704, (SELECT id FROM languages WHERE name='Danish')),
(704, (SELECT id FROM languages WHERE name='Finnish')),
(704, (SELECT id FROM languages WHERE name='Japanese')),
(704, (SELECT id FROM languages WHERE name='Norwegian')),
(704, (SELECT id FROM languages WHERE name='Polish')),
(704, (SELECT id FROM languages WHERE name='Portuguese')),
(704, (SELECT id FROM languages WHERE name='Swedish')),
(704, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (704, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (704, 'Steam Achievements');
-- Subscription LUMINES? Base+Advance Pack (Sub ID: 707)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (707, 'LUMINES? Base+Advance Pack', '$8.98$14.99-$7.50', '$7.49', '$7.49', '$1.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(707, (SELECT id FROM languages WHERE name='English')),
(707, (SELECT id FROM languages WHERE name='French')),
(707, (SELECT id FROM languages WHERE name='German')),
(707, (SELECT id FROM languages WHERE name='Italian')),
(707, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (707, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (707, 'Single-player');
-- Subscription Half-Life Complete (Sub ID: 715)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (715, 'Half-Life Complete', '$74.92$49.99', '$49.99', '$49.99', '$24.93');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(715, (SELECT id FROM languages WHERE name='English')),
(715, (SELECT id FROM languages WHERE name='French')),
(715, (SELECT id FROM languages WHERE name='German')),
(715, (SELECT id FROM languages WHERE name='Italian')),
(715, (SELECT id FROM languages WHERE name='Korean')),
(715, (SELECT id FROM languages WHERE name='Spanish')),
(715, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(715, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(715, (SELECT id FROM languages WHERE name='Russian')),
(715, (SELECT id FROM languages WHERE name='Dutch')),
(715, (SELECT id FROM languages WHERE name='Danish')),
(715, (SELECT id FROM languages WHERE name='Finnish')),
(715, (SELECT id FROM languages WHERE name='Japanese')),
(715, (SELECT id FROM languages WHERE name='Norwegian')),
(715, (SELECT id FROM languages WHERE name='Polish')),
(715, (SELECT id FROM languages WHERE name='Portuguese')),
(715, (SELECT id FROM languages WHERE name='Swedish')),
(715, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (715, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (715, 'Includes level editor');
INSERT INTO sub_dates (sub_id, release_date) VALUES (715, '2008-05-02') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Half-Life 2 Complete (Sub ID: 716)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (716, 'Half-Life 2 Complete', '$49.96$34.99', '$34.99', '$34.99', '$14.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(716, (SELECT id FROM languages WHERE name='English')),
(716, (SELECT id FROM languages WHERE name='French')),
(716, (SELECT id FROM languages WHERE name='German')),
(716, (SELECT id FROM languages WHERE name='Italian')),
(716, (SELECT id FROM languages WHERE name='Korean')),
(716, (SELECT id FROM languages WHERE name='Spanish')),
(716, (SELECT id FROM languages WHERE name='Russian')),
(716, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(716, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(716, (SELECT id FROM languages WHERE name='Dutch')),
(716, (SELECT id FROM languages WHERE name='Danish')),
(716, (SELECT id FROM languages WHERE name='Finnish')),
(716, (SELECT id FROM languages WHERE name='Japanese')),
(716, (SELECT id FROM languages WHERE name='Norwegian')),
(716, (SELECT id FROM languages WHERE name='Polish')),
(716, (SELECT id FROM languages WHERE name='Portuguese')),
(716, (SELECT id FROM languages WHERE name='Swedish')),
(716, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (716, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (716, 'Includes level editor');
INSERT INTO sub_dates (sub_id, release_date) VALUES (716, '2008-05-02') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Counter-Strike Complete (Sub ID: 717)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (717, 'Counter-Strike Complete', '$41.19$29.99-$7.50', '$22.49', '$22.49', '$18.70');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(717, (SELECT id FROM languages WHERE name='English')),
(717, (SELECT id FROM languages WHERE name='French')),
(717, (SELECT id FROM languages WHERE name='German')),
(717, (SELECT id FROM languages WHERE name='Italian')),
(717, (SELECT id FROM languages WHERE name='Korean')),
(717, (SELECT id FROM languages WHERE name='Spanish')),
(717, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(717, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(717, (SELECT id FROM languages WHERE name='Japanese')),
(717, (SELECT id FROM languages WHERE name='Russian')),
(717, (SELECT id FROM languages WHERE name='Thai'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (717, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (717, 'Includes Source SDK');
INSERT INTO sub_dates (sub_id, release_date) VALUES (717, '2008-05-02') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Blazing Angels® Pack (Sub ID: 736)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (736, 'Blazing Angels® Pack', '$14.98$24.99-$12.50', '$12.49', '$12.49', '$2.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(736, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (736, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (736, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (736, 'Multi-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (736, '2008-05-13') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Sam and Max Complete Season Two (Sub ID: 766)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (766, 'Sam and Max Complete Season Two', '$44.95$29.99', '$29.99', '$29.99', '$14.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(766, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (766, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (766, 'Single-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (766, '2008-05-16') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Sam & Max Complete (Sub ID: 766)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (766, 'Sam & Max Complete', '$109.89$59.99', '$59.99', '$59.99', '$49.90');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(766, (SELECT id FROM languages WHERE name='English')),
(766, (SELECT id FROM languages WHERE name='French')),
(766, (SELECT id FROM languages WHERE name='German')),
(766, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (766, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (766, 'Single-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (766, '2008-05-16') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Eidos Collector Pack (Sub ID: 771)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (771, 'Eidos Collector Pack', '$284.80$99.99', '$99.99', '$99.99', '$184.81');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(771, (SELECT id FROM languages WHERE name='English')),
(771, (SELECT id FROM languages WHERE name='French')),
(771, (SELECT id FROM languages WHERE name='German')),
(771, (SELECT id FROM languages WHERE name='Italian')),
(771, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (771, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (771, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (771, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (771, 'New releases');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (771, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (771, 'Controller enabled');
INSERT INTO sub_dates (sub_id, release_date) VALUES (771, '2008-05-23') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Last Day of Work Complete Pack (Sub ID: 775)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (775, 'Last Day of Work Complete Pack', '$49.95$29.99', '$29.99', '$29.99', '$19.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(775, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (775, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (775, 'Single-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (775, '2008-05-28') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription MumboJumbo Classic Collection (Sub ID: 799)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (799, 'MumboJumbo Classic Collection', '$35.92$39.99', '$39.99', '$39.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(799, (SELECT id FROM languages WHERE name='English')),
(799, (SELECT id FROM languages WHERE name='French')),
(799, (SELECT id FROM languages WHERE name='German')),
(799, (SELECT id FROM languages WHERE name='Swedish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (799, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (799, 'Single-player');
-- Subscription Petz® Pack (Sub ID: 806)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (806, 'Petz® Pack', '$14.97$19.99-$10.00', '$9.99', '$9.99', '$4.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(806, (SELECT id FROM languages WHERE name='English')),
(806, (SELECT id FROM languages WHERE name='French')),
(806, (SELECT id FROM languages WHERE name='German')),
(806, (SELECT id FROM languages WHERE name='Italian')),
(806, (SELECT id FROM languages WHERE name='Spanish')),
(806, (SELECT id FROM languages WHERE name='Dutch')),
(806, (SELECT id FROM languages WHERE name='Danish')),
(806, (SELECT id FROM languages WHERE name='Norwegian')),
(806, (SELECT id FROM languages WHERE name='Swedish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (806, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (806, 'Single-player');
-- Subscription Silent Hunter Collection (Sub ID: 812)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (812, 'Silent Hunter Collection', '$39.97$29.99', '$29.99', '$29.99', '$9.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(812, (SELECT id FROM languages WHERE name='English')),
(812, (SELECT id FROM languages WHERE name='German')),
(812, (SELECT id FROM languages WHERE name='French')),
(812, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (812, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (812, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (812, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (812, 'Co-op');
-- Subscription Bone: Out from Boneville and The Great Cow Race (Sub ID: 817)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (817, 'Bone: Out from Boneville and The Great Cow Race', '$17.98$14.99', '$14.99', '$14.99', '$2.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(817, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (817, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (817, 'Single-player');
-- Subscription Team Fortress Complete (Sub ID: 829)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (829, 'Team Fortress Complete', '$18.73$22.49-$5.63', '$16.86', '$16.86', '$1.87');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(829, (SELECT id FROM languages WHERE name='English')),
(829, (SELECT id FROM languages WHERE name='Danish')),
(829, (SELECT id FROM languages WHERE name='Dutch')),
(829, (SELECT id FROM languages WHERE name='Finnish')),
(829, (SELECT id FROM languages WHERE name='French')),
(829, (SELECT id FROM languages WHERE name='German')),
(829, (SELECT id FROM languages WHERE name='Italian')),
(829, (SELECT id FROM languages WHERE name='Japanese')),
(829, (SELECT id FROM languages WHERE name='Korean')),
(829, (SELECT id FROM languages WHERE name='Norwegian')),
(829, (SELECT id FROM languages WHERE name='Polish')),
(829, (SELECT id FROM languages WHERE name='Portuguese')),
(829, (SELECT id FROM languages WHERE name='Russian')),
(829, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(829, (SELECT id FROM languages WHERE name='Spanish')),
(829, (SELECT id FROM languages WHERE name='Swedish')),
(829, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (829, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Includes level editor');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (829, 'Includes Source SDK');
-- Subscription SpellForce 2 - Shadow Wars + Dragon Storm (Sub ID: 848)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (848, 'SpellForce 2 - Shadow Wars + Dragon Storm', '$39.98$29.99', '$29.99', '$29.99', '$9.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(848, 17810, 'SpellForce 2 - Dragon Storm', '$19.99', ''),
(848, 17800, 'SpellForce 2 - Shadow Wars', '$19.99', '80');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(848, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (848, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (848, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (848, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (848, 'Co-op');
-- Subscription Tom Clancy''s Ghost Recon® Complete Pack (Sub ID: 864)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (864, 'Tom Clancy''s Ghost Recon® Complete Pack', '$24.95$39.99-$20.00', '$19.99', '$19.99', '$4.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(864, (SELECT id FROM languages WHERE name='English')),
(864, (SELECT id FROM languages WHERE name='French')),
(864, (SELECT id FROM languages WHERE name='Spanish')),
(864, (SELECT id FROM languages WHERE name='Italian')),
(864, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (864, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (864, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (864, 'Multi-player');
-- Subscription Family Gaming Pack (Sub ID: 874)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (874, 'Family Gaming Pack', '$109.89$29.99', '$29.99', '$29.99', '$79.90');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(874, (SELECT id FROM languages WHERE name='English')),
(874, (SELECT id FROM languages WHERE name='French')),
(874, (SELECT id FROM languages WHERE name='German')),
(874, (SELECT id FROM languages WHERE name='Italian')),
(874, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (874, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (874, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (874, 'Multi-player');
-- Subscription Silverfall: Complete (Sub ID: 879)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (879, 'Silverfall: Complete', '$29.98$24.99', '$24.99', '$24.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(879, (SELECT id FROM languages WHERE name='English')),
(879, (SELECT id FROM languages WHERE name='French')),
(879, (SELECT id FROM languages WHERE name='German')),
(879, (SELECT id FROM languages WHERE name='Italian')),
(879, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (879, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (879, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (879, 'Multi-player');
-- Subscription The Settlers® Pack (Sub ID: 882)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (882, 'The Settlers® Pack', '$19.98$34.99-$17.50', '$17.49', '$17.49', '$2.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(882, (SELECT id FROM languages WHERE name='English')),
(882, (SELECT id FROM languages WHERE name='French')),
(882, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (882, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (882, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (882, 'Multi-player');
-- Subscription Pacific Storm Pack (Sub ID: 927)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (927, 'Pacific Storm Pack', '$48.00$14.99-$12.00', '$2.99', '$2.99', '$45.01');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(927, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (927, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (927, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (927, 'Multi-player');
-- Subscription FlatOut: Ultimate Carnage (Sub ID: 944)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (944, 'FlatOut: Ultimate Carnage', '$0.00$19.99', '$19.99', '$19.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(944, 12360, 'FlatOut: Ultimate Carnage', '', '79');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(944, (SELECT id FROM languages WHERE name='English')),
(944, (SELECT id FROM languages WHERE name='French')),
(944, (SELECT id FROM languages WHERE name='German')),
(944, (SELECT id FROM languages WHERE name='Italian')),
(944, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (944, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (944, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (944, 'Multi-player');
-- Subscription Oddworld Pack (Sub ID: 949)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (949, 'Oddworld Pack', '$3.74$9.99-$7.50', '$2.49', '$2.49', '$1.25');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(949, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (949, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (949, 'Single-player');
-- Subscription GTR Evolution Complete (Sub ID: 956)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (956, 'GTR Evolution Complete', '$39.98$29.99', '$29.99', '$29.99', '$9.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(956, (SELECT id FROM languages WHERE name='English')),
(956, (SELECT id FROM languages WHERE name='French')),
(956, (SELECT id FROM languages WHERE name='German')),
(956, (SELECT id FROM languages WHERE name='Italian')),
(956, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (956, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (956, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (956, 'Multi-player');
-- Subscription X-COM: Complete Pack (Sub ID: 964)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (964, 'X-COM: Complete Pack', '$16.70$14.99-$4.95', '$10.04', '$10.04', '$6.66');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(964, (SELECT id FROM languages WHERE name='English')),
(964, (SELECT id FROM languages WHERE name='French')),
(964, (SELECT id FROM languages WHERE name='German')),
(964, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (964, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (964, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (964, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (964, 'Co-op');
-- Subscription Multiwinia + Darwinia (Sub ID: 978)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (978, 'Multiwinia + Darwinia', '$14.98$14.99-$7.50', '$7.49', '$7.49', '$7.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(978, (SELECT id FROM languages WHERE name='English')),
(978, (SELECT id FROM languages WHERE name='French')),
(978, (SELECT id FROM languages WHERE name='Italian')),
(978, (SELECT id FROM languages WHERE name='German')),
(978, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (978, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (978, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (978, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (978, 'Steam Achievements');
-- Subscription The Gumboy Pack (Sub ID: 979)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (979, 'The Gumboy Pack', '$9.98$7.99', '$7.99', '$7.99', '$1.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(979, (SELECT id FROM languages WHERE name='English')),
(979, (SELECT id FROM languages WHERE name='Polish')),
(979, (SELECT id FROM languages WHERE name='Russian')),
(979, (SELECT id FROM languages WHERE name='Czech')),
(979, (SELECT id FROM languages WHERE name='Slovak')),
(979, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (979, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (979, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (979, 'Multi-player');
-- Subscription Crysis® Maximum Edition (Sub ID: 987)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (987, 'Crysis® Maximum Edition', '$59.98$39.99', '$39.99', '$39.99', '$19.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(987, (SELECT id FROM languages WHERE name='English')),
(987, (SELECT id FROM languages WHERE name='French')),
(987, (SELECT id FROM languages WHERE name='German')),
(987, (SELECT id FROM languages WHERE name='Spanish')),
(987, (SELECT id FROM languages WHERE name='Italian')),
(987, (SELECT id FROM languages WHERE name='Czech')),
(987, (SELECT id FROM languages WHERE name='Polish')),
(987, (SELECT id FROM languages WHERE name='Russian')),
(987, (SELECT id FROM languages WHERE name='Hungarian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (987, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (987, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (987, 'Multi-player');
-- Subscription Children of the Nile Pack (Sub ID: 1007)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1007, 'Children of the Nile Pack', '$7.98$13.99-$7.00', '$6.99', '$6.99', '$0.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1007, (SELECT id FROM languages WHERE name='English')),
(1007, (SELECT id FROM languages WHERE name='French')),
(1007, (SELECT id FROM languages WHERE name='German')),
(1007, (SELECT id FROM languages WHERE name='Italian')),
(1007, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1007, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1007, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1007, 'Steam Achievements');
-- Subscription Heroes of Might And Magic® V Pack (Sub ID: 1036)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1036, 'Heroes of Might And Magic® V Pack', '$14.97$39.99-$25.02', '$14.97', '$14.97', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1036, (SELECT id FROM languages WHERE name='English')),
(1036, (SELECT id FROM languages WHERE name='French')),
(1036, (SELECT id FROM languages WHERE name='Italian')),
(1036, (SELECT id FROM languages WHERE name='German')),
(1036, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1036, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1036, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1036, 'Multi-player');
-- Subscription X3 Pack (Sub ID: 1041)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1041, 'X3 Pack', '$59.98$54.99', '$54.99', '$54.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1041, (SELECT id FROM languages WHERE name='English')),
(1041, (SELECT id FROM languages WHERE name='French')),
(1041, (SELECT id FROM languages WHERE name='German')),
(1041, (SELECT id FROM languages WHERE name='Spanish')),
(1041, (SELECT id FROM languages WHERE name='Italian')),
(1041, (SELECT id FROM languages WHERE name='(text')),
(1041, (SELECT id FROM languages WHERE name='only)'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1041, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1041, 'Single-player');
-- Subscription Left 4 Dead (Sub ID: 1053)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1053, 'Left 4 Dead', '$99.99$49.99', '$49.99', '$49.99', '$50.00');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1053, (SELECT id FROM languages WHERE name='English')),
(1053, (SELECT id FROM languages WHERE name='French')),
(1053, (SELECT id FROM languages WHERE name='German')),
(1053, (SELECT id FROM languages WHERE name='Spanish')),
(1053, (SELECT id FROM languages WHERE name='Russian')),
(1053, (SELECT id FROM languages WHERE name='Danish')),
(1053, (SELECT id FROM languages WHERE name='Dutch')),
(1053, (SELECT id FROM languages WHERE name='Finnish')),
(1053, (SELECT id FROM languages WHERE name='Italian')),
(1053, (SELECT id FROM languages WHERE name='Japanese')),
(1053, (SELECT id FROM languages WHERE name='Korean')),
(1053, (SELECT id FROM languages WHERE name='Norwegian')),
(1053, (SELECT id FROM languages WHERE name='Polish')),
(1053, (SELECT id FROM languages WHERE name='Portuguese')),
(1053, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(1053, (SELECT id FROM languages WHERE name='Swedish')),
(1053, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1053, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1053, 'Includes Source SDK');
-- Subscription STCC - The Game Complete (Sub ID: 1073)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1073, 'STCC - The Game Complete', '$39.98$39.99', '$39.99', '$39.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1073, (SELECT id FROM languages WHERE name='English')),
(1073, (SELECT id FROM languages WHERE name='French')),
(1073, (SELECT id FROM languages WHERE name='German')),
(1073, (SELECT id FROM languages WHERE name='Italian')),
(1073, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1073, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1073, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1073, 'Multi-player');
-- Subscription Valve Complete Pack (Sub ID: 1134)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1134, 'Valve Complete Pack', '$209.82$99.99', '$99.99', '$99.99', '$109.83');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1134, (SELECT id FROM languages WHERE name='English')),
(1134, (SELECT id FROM languages WHERE name='French')),
(1134, (SELECT id FROM languages WHERE name='German')),
(1134, (SELECT id FROM languages WHERE name='Italian')),
(1134, (SELECT id FROM languages WHERE name='Korean')),
(1134, (SELECT id FROM languages WHERE name='Spanish')),
(1134, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(1134, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(1134, (SELECT id FROM languages WHERE name='Japanese')),
(1134, (SELECT id FROM languages WHERE name='Russian')),
(1134, (SELECT id FROM languages WHERE name='Thai')),
(1134, (SELECT id FROM languages WHERE name='Dutch')),
(1134, (SELECT id FROM languages WHERE name='Danish')),
(1134, (SELECT id FROM languages WHERE name='Finnish')),
(1134, (SELECT id FROM languages WHERE name='Norwegian')),
(1134, (SELECT id FROM languages WHERE name='Polish')),
(1134, (SELECT id FROM languages WHERE name='Portuguese')),
(1134, (SELECT id FROM languages WHERE name='Swedish')),
(1134, (SELECT id FROM languages WHERE name='Traditional Chineselanguages with full audio support'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1134, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Includes level editor');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Steam Leaderboards');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1134, 'Steam Cloud');
-- Subscription PopCap Favorites (Sub ID: 1160)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1160, 'PopCap Favorites', '$37.45$39.99-$10.00', '$29.99', '$29.99', '$7.46');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1160, (SELECT id FROM languages WHERE name='English')),
(1160, (SELECT id FROM languages WHERE name='French')),
(1160, (SELECT id FROM languages WHERE name='German')),
(1160, (SELECT id FROM languages WHERE name='Italian')),
(1160, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1160, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1160, 'Single-player');
-- Subscription Complete PopCap Collection (Sub ID: 1161)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1161, 'Complete PopCap Collection', '$249.75$99.99', '$99.99', '$99.99', '$149.76');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1161, (SELECT id FROM languages WHERE name='English')),
(1161, (SELECT id FROM languages WHERE name='French')),
(1161, (SELECT id FROM languages WHERE name='German')),
(1161, (SELECT id FROM languages WHERE name='Italian')),
(1161, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1161, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1161, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1161, 'New releases');
-- Subscription Prince of Persia Pack (Sub ID: 1184)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1184, 'Prince of Persia Pack', '$79.96$64.99', '$64.99', '$64.99', '$14.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1184, (SELECT id FROM languages WHERE name='English')),
(1184, (SELECT id FROM languages WHERE name='French')),
(1184, (SELECT id FROM languages WHERE name='Italian')),
(1184, (SELECT id FROM languages WHERE name='German')),
(1184, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1184, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1184, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1184, 'Controller enabled');
-- Subscription THQ Action Pack (Sub ID: 1203)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1203, 'THQ Action Pack', '$34.96$59.99-$15.00', '$44.99', '$44.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1203, (SELECT id FROM languages WHERE name='English')),
(1203, (SELECT id FROM languages WHERE name='French')),
(1203, (SELECT id FROM languages WHERE name='Italian')),
(1203, (SELECT id FROM languages WHERE name='Spanish')),
(1203, (SELECT id FROM languages WHERE name='German')),
(1203, (SELECT id FROM languages WHERE name='Korean'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1203, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1203, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1203, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1203, 'Co-op');
-- Subscription THQ Collector Pack (Sub ID: 1205)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1205, 'THQ Collector Pack', '$239.88$99.99', '$99.99', '$99.99', '$139.89');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1205, (SELECT id FROM languages WHERE name='English')),
(1205, (SELECT id FROM languages WHERE name='French')),
(1205, (SELECT id FROM languages WHERE name='Spanish')),
(1205, (SELECT id FROM languages WHERE name='Italian')),
(1205, (SELECT id FROM languages WHERE name='German')),
(1205, (SELECT id FROM languages WHERE name='Korean')),
(1205, (SELECT id FROM languages WHERE name='Customers in Germany can only play in German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1205, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1205, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1205, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1205, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1205, 'Includes level editor');
-- Subscription Relic Super Pack (Sub ID: 1207)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1207, 'Relic Super Pack', '$79.96$49.99', '$49.99', '$49.99', '$29.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1207, (SELECT id FROM languages WHERE name='English')),
(1207, (SELECT id FROM languages WHERE name='French')),
(1207, (SELECT id FROM languages WHERE name='Spanish')),
(1207, (SELECT id FROM languages WHERE name='Italian')),
(1207, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1207, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1207, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1207, 'Multi-player');
-- Subscription Crazy Machines 2 + Add-on (Sub ID: 1244)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1244, 'Crazy Machines 2 + Add-on', '$29.98$29.99', '$29.99', '$29.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1244, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1244, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1244, 'Single-player');
-- Subscription Crazy Machines Complete Pack (Sub ID: 1245)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1245, 'Crazy Machines Complete Pack', '$69.96$49.99', '$49.99', '$49.99', '$19.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1245, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1245, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1245, 'Single-player');
-- Subscription Telltale Everything Pack (Sub ID: 1254)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1254, 'Telltale Everything Pack', '$166.85$69.99', '$69.99', '$69.99', '$96.86');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1254, (SELECT id FROM languages WHERE name='English')),
(1254, (SELECT id FROM languages WHERE name='French')),
(1254, (SELECT id FROM languages WHERE name='German')),
(1254, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1254, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1254, 'Single-player');
-- Subscription Europa Universalis: Rome - Gold Edition (Sub ID: 1255)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1255, 'Europa Universalis: Rome - Gold Edition', '$0.00$24.99', '$24.99', '$24.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(1255, 23420, 'Europa Universalis: Rome - Gold Edition', '', '77');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1255, (SELECT id FROM languages WHERE name='English')),
(1255, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1255, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1255, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1255, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1255, 'Co-op');
-- Subscription SPORE? + SPORE? Creepy & Cute Parts Pack (Sub ID: 1262)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1262, 'SPORE? + SPORE? Creepy & Cute Parts Pack', '$59.98$59.98', '$59.98', '$59.98', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1262, (SELECT id FROM languages WHERE name='English')),
(1262, (SELECT id FROM languages WHERE name='Czech')),
(1262, (SELECT id FROM languages WHERE name='Danish')),
(1262, (SELECT id FROM languages WHERE name='German')),
(1262, (SELECT id FROM languages WHERE name='Spanish')),
(1262, (SELECT id FROM languages WHERE name='Finnish')),
(1262, (SELECT id FROM languages WHERE name='French')),
(1262, (SELECT id FROM languages WHERE name='Italian')),
(1262, (SELECT id FROM languages WHERE name='Hungarian')),
(1262, (SELECT id FROM languages WHERE name='Dutch')),
(1262, (SELECT id FROM languages WHERE name='Norwegian')),
(1262, (SELECT id FROM languages WHERE name='Polish')),
(1262, (SELECT id FROM languages WHERE name='Russian')),
(1262, (SELECT id FROM languages WHERE name='Swedish')),
(1262, (SELECT id FROM languages WHERE name='Portuguese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1262, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1262, 'Single-player');
-- Subscription Luxor Complete Pack (Sub ID: 1263)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1263, 'Luxor Complete Pack', '$49.95$29.99', '$29.99', '$29.99', '$19.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1263, (SELECT id FROM languages WHERE name='English')),
(1263, (SELECT id FROM languages WHERE name='French')),
(1263, (SELECT id FROM languages WHERE name='German')),
(1263, (SELECT id FROM languages WHERE name='Swedish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1263, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1263, 'Single-player');
-- Subscription Best of TiltedMill Collection (Sub ID: 1265)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1265, 'Best of TiltedMill Collection', '$20.96$29.99-$15.00', '$14.99', '$14.99', '$5.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1265, (SELECT id FROM languages WHERE name='English')),
(1265, (SELECT id FROM languages WHERE name='French')),
(1265, (SELECT id FROM languages WHERE name='German')),
(1265, (SELECT id FROM languages WHERE name='Italian')),
(1265, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1265, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1265, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1265, 'Steam Achievements');
-- Subscription Strategy First Complete Pack (Sub ID: 1266)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1266, 'Strategy First Complete Pack', '$177.25$74.99-$26.25', '$48.74', '$48.74', '$128.51');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(1266, 2900, '688(I) Hunter-Killer', '$19.99$9.99', ''),
(1266, 6290, 'Alien Shooter - Vengeance', '$4.99$2.49', '67'),
(1266, 12400, 'Bill "Spaceman" Lee Baseball Mogul 2009', '$24.99$12.49', '65'),
(1266, 2930, 'Birth Of America', '$9.99$4.99', '71'),
(1266, 12310, 'Culpa Innata', '$9.99$4.99', '66'),
(1266, 1600, 'Dangerous Waters', '$14.99$7.49', '82'),
(1266, 12330, 'Darkstar One', '$9.99$4.99', '71'),
(1266, 1640, 'Disciples II: Galleans Return', '$19.99$9.99', '84'),
(1266, 1630, 'Disciples II: Rise of the Elves', '$19.99$9.99', '80'),
(1266, 6270, 'Ducati World Championship', '$4.99$2.49', '35'),
(1266, 12390, 'Exodus from the Earth', '$19.99$9.99', ''),
(1266, 6220, 'FlatOut', '$9.99$4.99', '72'),
(1266, 2990, 'FlatOut 2?', '$14.99$7.49', '76'),
(1266, 12360, 'FlatOut: Ultimate Carnage', '$19.99$9.99', '79'),
(1266, 2910, 'Fleet Command', '$19.99$9.99', ''),
(1266, 6200, 'Ghost Master®', '$4.99$2.49', '81'),
(1266, 1670, 'Iron Warriors: T - 72 Tank Command', '$4.99$2.49', '56'),
(1266, 12340, 'Jack Keane', '$19.99$9.99', '69'),
(1266, 1620, 'Jagged Alliance 2 Gold', '$19.99$9.99', ''),
(1266, 6250, 'Making History: The Calm & the Storm', '$19.99$9.99', '70'),
(1266, 12320, 'Sacred Gold', '$9.99$4.99', '73'),
(1266, 1610, 'Space Empires IV Deluxe', '$9.99$4.99', '79'),
(1266, 1690, 'Space Empires V', '$14.99$7.49', '68'),
(1266, 2920, 'Sub Command', '$19.99$9.99', '84'),
(1266, 6210, 'Vegas Make It Big?', '$4.99$2.49', '76');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1266, (SELECT id FROM languages WHERE name='English')),
(1266, (SELECT id FROM languages WHERE name='French')),
(1266, (SELECT id FROM languages WHERE name='Spanish')),
(1266, (SELECT id FROM languages WHERE name='German')),
(1266, (SELECT id FROM languages WHERE name='Italian')),
(1266, (SELECT id FROM languages WHERE name='Dutch'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1266, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1266, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1266, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1266, 'New releases');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1266, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1266, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1266, 'Includes level editor');
-- Subscription Meridian4 Complete Pack (Sub ID: 1267)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1267, 'Meridian4 Complete Pack', '$99.89$49.99', '$49.99', '$49.99', '$49.90');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1267, (SELECT id FROM languages WHERE name='English')),
(1267, (SELECT id FROM languages WHERE name='Polish')),
(1267, (SELECT id FROM languages WHERE name='Russian')),
(1267, (SELECT id FROM languages WHERE name='French')),
(1267, (SELECT id FROM languages WHERE name='German')),
(1267, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1267, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1267, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1267, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1267, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1267, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1267, 'Includes level editor');
-- Subscription Dawn of War Everything Pack (Sub ID: 1268)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1268, 'Dawn of War Everything Pack', '$46.97$59.98-$29.99', '$29.99', '$29.99', '$16.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
(1268, 4580, 'Warhammer 40,000: Dawn of War - Dark Crusade', '$19.99$9.99', '87'),
(1268, 4570, 'Warhammer 40,000: Dawn of War - Gold Edition', '$19.99$9.99', '86'),
(1268, 9450, 'Warhammer 40K: Dawn of War - Soulstorm', '$29.99$26.99', '73');

INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1268, (SELECT id FROM languages WHERE name='English')),
(1268, (SELECT id FROM languages WHERE name='French')),
(1268, (SELECT id FROM languages WHERE name='German')),
(1268, (SELECT id FROM languages WHERE name='Italian')),
(1268, (SELECT id FROM languages WHERE name='Spanish')),
(1268, (SELECT id FROM languages WHERE name='Customers in Germany can only play in German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1268, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1268, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1268, 'Multi-player');
-- Subscription Empire: Total War? Special Forces Edition (Sub ID: 1281)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1281, 'Empire: Total War? Special Forces Edition', '$49.99$69.99', '$69.99', '$69.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1281, (SELECT id FROM languages WHERE name='English')),
(1281, (SELECT id FROM languages WHERE name='French')),
(1281, (SELECT id FROM languages WHERE name='Italian')),
(1281, (SELECT id FROM languages WHERE name='German')),
(1281, (SELECT id FROM languages WHERE name='Spanish')),
(1281, (SELECT id FROM languages WHERE name='Russian')),
(1281, (SELECT id FROM languages WHERE name='Polish')),
(1281, (SELECT id FROM languages WHERE name='Czech'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1281, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1281, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1281, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1281, 'Stats');
-- Subscription Total War? Mega Pack (Sub ID: 1348)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1348, 'Total War? Mega Pack', '$57.45$89.99-$32.54', '$57.45', '$57.45', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1348, (SELECT id FROM languages WHERE name='English')),
(1348, (SELECT id FROM languages WHERE name='French')),
(1348, (SELECT id FROM languages WHERE name='Italian')),
(1348, (SELECT id FROM languages WHERE name='German')),
(1348, (SELECT id FROM languages WHERE name='Spanish')),
(1348, (SELECT id FROM languages WHERE name='Russian')),
(1348, (SELECT id FROM languages WHERE name='Polish')),
(1348, (SELECT id FROM languages WHERE name='Czech'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1348, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1348, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1348, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1348, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1348, 'Stats');
-- Subscription Grand Theft Auto Complete Pack (Sub ID: 1353)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1353, 'Grand Theft Auto Complete Pack', '$69.96$49.99', '$49.99', '$49.99', '$19.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1353, (SELECT id FROM languages WHERE name='English')),
(1353, (SELECT id FROM languages WHERE name='French')),
(1353, (SELECT id FROM languages WHERE name='German')),
(1353, (SELECT id FROM languages WHERE name='Italian')),
(1353, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1353, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1353, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1353, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1353, 'Controller enabled');
-- Subscription Empire: Total War? Special Forces Edition (Sub ID: 1446)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1446, 'Empire: Total War? Special Forces Edition', '$49.99$69.99', '$69.99', '$69.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1446, (SELECT id FROM languages WHERE name='English')),
(1446, (SELECT id FROM languages WHERE name='French')),
(1446, (SELECT id FROM languages WHERE name='Italian')),
(1446, (SELECT id FROM languages WHERE name='German')),
(1446, (SELECT id FROM languages WHERE name='Spanish')),
(1446, (SELECT id FROM languages WHERE name='Russian')),
(1446, (SELECT id FROM languages WHERE name='Polish')),
(1446, (SELECT id FROM languages WHERE name='Czech'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1446, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1446, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1446, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1446, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1446, 'Stats');
-- Subscription Penumbra Collector Pack (Sub ID: 1451)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1451, 'Penumbra Collector Pack', '$24.98$19.99', '$19.99', '$19.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1451, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1451, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1451, 'Single-player');
-- Subscription World in Conflict: Complete Edition (Sub ID: 1471)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1471, 'World in Conflict: Complete Edition', '$39.98$19.99-$10.00', '$9.99', '$9.99', '$29.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1471, (SELECT id FROM languages WHERE name='English')),
(1471, (SELECT id FROM languages WHERE name='French')),
(1471, (SELECT id FROM languages WHERE name='Spanish')),
(1471, (SELECT id FROM languages WHERE name='German')),
(1471, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1471, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1471, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1471, 'Multi-player');
-- Subscription Wallace and Gromit''s Grand Adventures (Sub ID: 1473)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1473, 'Wallace and Gromit''s Grand Adventures', '$0.00$34.99-$8.75', '$26.24', '$26.24', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1473, (SELECT id FROM languages WHERE name='English')),
(1473, (SELECT id FROM languages WHERE name='(full')),
(1473, (SELECT id FROM languages WHERE name='audio)')),
(1473, (SELECT id FROM languages WHERE name='French')),
(1473, (SELECT id FROM languages WHERE name='(Subtitles)')),
(1473, (SELECT id FROM languages WHERE name='German')),
(1473, (SELECT id FROM languages WHERE name='Italian')),
(1473, (SELECT id FROM languages WHERE name='Spanish')),
(1473, (SELECT id FROM languages WHERE name='All')),
(1473, (SELECT id FROM languages WHERE name='localizations')),
(1473, (SELECT id FROM languages WHERE name='are')),
(1473, (SELECT id FROM languages WHERE name='text')),
(1473, (SELECT id FROM languages WHERE name='only.'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1473, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1473, 'Single-player');
-- Subscription Peggle Complete (Sub ID: 1481)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1481, 'Peggle Complete', '$19.98$14.99', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1481, (SELECT id FROM languages WHERE name='English')),
(1481, (SELECT id FROM languages WHERE name='French')),
(1481, (SELECT id FROM languages WHERE name='Italian')),
(1481, (SELECT id FROM languages WHERE name='German')),
(1481, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1481, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1481, 'Single-player');
-- Subscription Wallace and Gromit''s Grand Adventures (Sub ID: 1502)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1502, 'Wallace and Gromit''s Grand Adventures', '$0.00$29.99-$19.80', '$10.19', '$10.19', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1502, (SELECT id FROM languages WHERE name='English')),
(1502, (SELECT id FROM languages WHERE name='(full')),
(1502, (SELECT id FROM languages WHERE name='audio)')),
(1502, (SELECT id FROM languages WHERE name='French')),
(1502, (SELECT id FROM languages WHERE name='(Subtitles)')),
(1502, (SELECT id FROM languages WHERE name='German')),
(1502, (SELECT id FROM languages WHERE name='Italian')),
(1502, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1502, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1502, 'Single-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (1502, '2009-05-05') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Ubisoft Classic Pack (Sub ID: 1511)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1511, 'Ubisoft Classic Pack', '$39.96$9.99', '$9.99', '$9.99', '$29.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1511, (SELECT id FROM languages WHERE name='English')),
(1511, (SELECT id FROM languages WHERE name='French')),
(1511, (SELECT id FROM languages WHERE name='German')),
(1511, (SELECT id FROM languages WHERE name='Italian')),
(1511, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1511, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1511, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1511, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1511, 'Valve Anti-Cheat enabled');
-- Subscription Strategy First Complete Pack (Sub ID: 1526)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1526, 'Strategy First Complete Pack', '$179.74$74.99', '$74.99', '$74.99', '$104.75');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1526, (SELECT id FROM languages WHERE name='English')),
(1526, (SELECT id FROM languages WHERE name='French')),
(1526, (SELECT id FROM languages WHERE name='Spanish')),
(1526, (SELECT id FROM languages WHERE name='German')),
(1526, (SELECT id FROM languages WHERE name='Italian')),
(1526, (SELECT id FROM languages WHERE name='Dutch'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1526, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1526, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1526, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1526, 'New releases');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1526, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1526, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1526, 'Includes level editor');
-- Subscription Company of Heroes Complete Pack (Sub ID: 1529)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1529, 'Company of Heroes Complete Pack', '$69.97$39.99', '$39.99', '$39.99', '$29.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1529, (SELECT id FROM languages WHERE name='English')),
(1529, (SELECT id FROM languages WHERE name='French')),
(1529, (SELECT id FROM languages WHERE name='Spanish')),
(1529, (SELECT id FROM languages WHERE name='Italian')),
(1529, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1529, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1529, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1529, 'Multi-player');
-- Subscription Strategy First Complete Pack (Sub ID: 1531)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1531, 'Strategy First Complete Pack', '$177.25$74.99', '$74.99', '$74.99', '$102.26');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1531, (SELECT id FROM languages WHERE name='English')),
(1531, (SELECT id FROM languages WHERE name='French')),
(1531, (SELECT id FROM languages WHERE name='Spanish')),
(1531, (SELECT id FROM languages WHERE name='German')),
(1531, (SELECT id FROM languages WHERE name='Italian')),
(1531, (SELECT id FROM languages WHERE name='Dutch'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1531, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1531, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1531, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1531, 'New releases');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1531, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1531, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1531, 'Includes level editor');
-- Subscription 2K Sports Baseball Pack (Sub ID: 1553)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1553, '2K Sports Baseball Pack', '$33.48$39.99-$13.20', '$26.79', '$26.79', '$6.69');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1553, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1553, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1553, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1553, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1553, 'Controller enabled');
-- Subscription The Mawesome Pack (Sub ID: 1582)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1582, 'The Mawesome Pack', '$13.74$11.99', '$11.99', '$11.99', '$1.75');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1582, (SELECT id FROM languages WHERE name='English')),
(1582, (SELECT id FROM languages WHERE name='French')),
(1582, (SELECT id FROM languages WHERE name='Italian')),
(1582, (SELECT id FROM languages WHERE name='German')),
(1582, (SELECT id FROM languages WHERE name='Spanish')),
(1582, (SELECT id FROM languages WHERE name='Korean')),
(1582, (SELECT id FROM languages WHERE name='Japanese')),
(1582, (SELECT id FROM languages WHERE name='Traditional Chinese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1582, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1582, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1582, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1582, 'Downloadable Content');
-- Subscription MumboJumbo Complete Pack (Sub ID: 1598)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1598, 'MumboJumbo Complete Pack', '$149.85$59.99', '$59.99', '$59.99', '$89.86');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1598, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1598, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1598, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1598, 'Multi-player');
-- Subscription Meridian4 Complete Pack (Sub ID: 1600)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1600, 'Meridian4 Complete Pack', '$29.87$59.99-$35.99', '$24.00', '$24.00', '$5.87');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1600, (SELECT id FROM languages WHERE name='English')),
(1600, (SELECT id FROM languages WHERE name='French')),
(1600, (SELECT id FROM languages WHERE name='German')),
(1600, (SELECT id FROM languages WHERE name='Polish')),
(1600, (SELECT id FROM languages WHERE name='Russian')),
(1600, (SELECT id FROM languages WHERE name='Italian')),
(1600, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1600, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1600, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1600, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1600, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1600, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1600, 'Includes level editor');
INSERT INTO sub_dates (sub_id, release_date) VALUES (1600, '2009-05-01') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Complete PopCap Collection (Sub ID: 1606)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1606, 'Complete PopCap Collection', '$224.70$99.99-$25.00', '$74.99', '$74.99', '$149.71');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1606, (SELECT id FROM languages WHERE name='English')),
(1606, (SELECT id FROM languages WHERE name='French')),
(1606, (SELECT id FROM languages WHERE name='German')),
(1606, (SELECT id FROM languages WHERE name='Italian')),
(1606, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1606, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1606, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1606, 'Steam Achievements');
INSERT INTO sub_dates (sub_id, release_date) VALUES (1606, '2009-05-06') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Sid Meier''s Civilization® IV: The Complete Edition (Sub ID: 1618)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1618, 'Sid Meier''s Civilization® IV: The Complete Edition', '$53.56$39.99-$13.20', '$26.79', '$26.79', '$26.77');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1618, (SELECT id FROM languages WHERE name='English')),
(1618, (SELECT id FROM languages WHERE name='French')),
(1618, (SELECT id FROM languages WHERE name='German')),
(1618, (SELECT id FROM languages WHERE name='Italian')),
(1618, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1618, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1618, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1618, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1618, 'Includes level editor');
INSERT INTO sub_dates (sub_id, release_date) VALUES (1618, '2009-05-14') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Complete Shooter Pack (Sub ID: 1645)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1645, 'Complete Shooter Pack', '$4.96$14.99-$11.25', '$3.74', '$3.74', '$1.22');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1645, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1645, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1645, 'Single-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (1645, '2009-05-27') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription The Bone-Breaking Racing Package (Sub ID: 1659)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1659, 'The Bone-Breaking Racing Package', '$29.98$29.98-$25.48', '$4.50', '$4.50', '$25.48');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1659, (SELECT id FROM languages WHERE name='English')),
(1659, (SELECT id FROM languages WHERE name='French')),
(1659, (SELECT id FROM languages WHERE name='Italian')),
(1659, (SELECT id FROM languages WHERE name='German')),
(1659, (SELECT id FROM languages WHERE name='Spanish')),
(1659, (SELECT id FROM languages WHERE name='Russian')),
(1659, (SELECT id FROM languages WHERE name='Polish')),
(1659, (SELECT id FROM languages WHERE name='Swedish')),
(1659, (SELECT id FROM languages WHERE name='Czech')),
(1659, (SELECT id FROM languages WHERE name='Finnish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1659, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1659, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1659, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1659, 'Steam Achievements');
INSERT INTO sub_dates (sub_id, release_date) VALUES (1659, '2009-05-29') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription Freedom Force: Freedom Pack (Sub ID: 1662)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1662, 'Freedom Force: Freedom Pack', '$6.68$7.49-$2.48', '$5.01', '$5.01', '$1.67');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1662, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1662, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1662, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1662, 'Multi-player');
INSERT INTO sub_dates (sub_id, release_date) VALUES (1662, '2009-05-29') ON DUPLICATE KEY UPDATE release_date=VALUES(release_date);
-- Subscription The Elder Scrolls ® Game of the Year Pack (Sub ID: 1682)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1682, 'The Elder Scrolls ® Game of the Year Pack', '$49.98$44.99', '$44.99', '$44.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1682, (SELECT id FROM languages WHERE name='English')),
(1682, (SELECT id FROM languages WHERE name='French')),
(1682, (SELECT id FROM languages WHERE name='German')),
(1682, (SELECT id FROM languages WHERE name='Italian')),
(1682, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1682, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1682, 'Single-player');
-- Subscription The Elder Scrolls ® Game of the Year Pack Deluxe (Sub ID: 1683)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1683, 'The Elder Scrolls ® Game of the Year Pack Deluxe', '$54.98$44.99', '$44.99', '$44.99', '$9.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1683, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1683, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1683, 'Single-player');
-- Subscription The Ankh Pack (Sub ID: 1691)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1691, 'The Ankh Pack', '$6.23$19.99-$15.00', '$4.99', '$4.99', '$1.24');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1691, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1691, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1691, 'Single-player');
-- Subscription Sword of the Stars: Complete Pack (Sub ID: 1699)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1699, 'Sword of the Stars: Complete Pack', '$38.98$15.99', '$15.99', '$15.99', '$22.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1699, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1699, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1699, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1699, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1699, 'Co-op');
-- Subscription SPORE? + SPORE? Galactic Adventures (Sub ID: 1732)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1732, 'SPORE? + SPORE? Galactic Adventures', '$69.98$69.98', '$69.98', '$69.98', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1732, (SELECT id FROM languages WHERE name='English')),
(1732, (SELECT id FROM languages WHERE name='Czech')),
(1732, (SELECT id FROM languages WHERE name='Danish')),
(1732, (SELECT id FROM languages WHERE name='German')),
(1732, (SELECT id FROM languages WHERE name='Spanish')),
(1732, (SELECT id FROM languages WHERE name='Finnish')),
(1732, (SELECT id FROM languages WHERE name='French')),
(1732, (SELECT id FROM languages WHERE name='Italian')),
(1732, (SELECT id FROM languages WHERE name='Hungarian')),
(1732, (SELECT id FROM languages WHERE name='Dutch')),
(1732, (SELECT id FROM languages WHERE name='Norwegian')),
(1732, (SELECT id FROM languages WHERE name='Polish')),
(1732, (SELECT id FROM languages WHERE name='Russian')),
(1732, (SELECT id FROM languages WHERE name='Swedish')),
(1732, (SELECT id FROM languages WHERE name='Portuguese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1732, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1732, 'Single-player');
-- Subscription Empire: Total War? - Special Forces Units & Bonus Content (Sub ID: 1736)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1736, 'Empire: Total War? - Special Forces Units & Bonus Content', '$0.00$2.49', '$2.49', '$2.49', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1736, (SELECT id FROM languages WHERE name='English')),
(1736, (SELECT id FROM languages WHERE name='French')),
(1736, (SELECT id FROM languages WHERE name='Italian')),
(1736, (SELECT id FROM languages WHERE name='German')),
(1736, (SELECT id FROM languages WHERE name='Spanish')),
(1736, (SELECT id FROM languages WHERE name='Russian')),
(1736, (SELECT id FROM languages WHERE name='Polish')),
(1736, (SELECT id FROM languages WHERE name='Czech'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1736, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1736, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1736, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1736, 'Downloadable Content');
-- Subscription SPORE? Complete Pack (Sub ID: 1741)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1741, 'SPORE? Complete Pack', '$89.97$89.97', '$89.97', '$89.97', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1741, (SELECT id FROM languages WHERE name='English')),
(1741, (SELECT id FROM languages WHERE name='Czech')),
(1741, (SELECT id FROM languages WHERE name='Danish')),
(1741, (SELECT id FROM languages WHERE name='German')),
(1741, (SELECT id FROM languages WHERE name='Spanish')),
(1741, (SELECT id FROM languages WHERE name='Finnish')),
(1741, (SELECT id FROM languages WHERE name='French')),
(1741, (SELECT id FROM languages WHERE name='Italian')),
(1741, (SELECT id FROM languages WHERE name='Hungarian')),
(1741, (SELECT id FROM languages WHERE name='Dutch')),
(1741, (SELECT id FROM languages WHERE name='Norwegian')),
(1741, (SELECT id FROM languages WHERE name='Polish')),
(1741, (SELECT id FROM languages WHERE name='Russian')),
(1741, (SELECT id FROM languages WHERE name='Swedish')),
(1741, (SELECT id FROM languages WHERE name='Portuguese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1741, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1741, 'Single-player');
-- Subscription NovaLogic Everything Pack (Sub ID: 1742)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1742, 'NovaLogic Everything Pack', '$102.34$69.99-$35.00', '$34.99', '$34.99', '$67.35');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1742, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1742, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1742, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1742, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1742, 'Co-op');
-- Subscription Delta Force Bootcamp (Sub ID: 1743)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1743, 'Delta Force Bootcamp', '$19.96$19.99-$10.00', '$9.99', '$9.99', '$9.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1743, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1743, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1743, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1743, 'Multi-player');
-- Subscription Novalogic Multiplayer Mayhem (Sub ID: 1744)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1744, 'Novalogic Multiplayer Mayhem', '$32.46$39.99-$20.00', '$19.99', '$19.99', '$12.47');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1744, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1744, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1744, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1744, 'Multi-player');
-- Subscription Novalogic Classics Volume One: Machines of War (Sub ID: 1745)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1745, 'Novalogic Classics Volume One: Machines of War', '$29.94$29.99-$15.00', '$14.99', '$14.99', '$14.95');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1745, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1745, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1745, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1745, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1745, 'Co-op');
-- Subscription Delta Force Platinum Pack (Sub ID: 1746)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1746, 'Delta Force Platinum Pack', '$12.48$19.99-$10.00', '$9.99', '$9.99', '$2.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1746, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1746, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1746, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1746, 'Multi-player');
-- Subscription 2K HUGE GAMES PACK (Sub ID: 1764)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1764, '2K HUGE GAMES PACK', '$229.80$59.99-$6.00', '$53.99', '$53.99', '$175.81');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1764, (SELECT id FROM languages WHERE name='English')),
(1764, (SELECT id FROM languages WHERE name='French')),
(1764, (SELECT id FROM languages WHERE name='German')),
(1764, (SELECT id FROM languages WHERE name='Italian')),
(1764, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1764, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1764, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1764, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1764, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1764, 'Includes level editor');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1764, 'Co-op');
-- Subscription Tales of Monkey Island Complete Pack (Sub ID: 1780)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1780, 'Tales of Monkey Island Complete Pack', '$0.00$34.99', '$34.99', '$34.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1780, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1780, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1780, 'Single-player');
-- Subscription Sandlot Collector Pack (Sub ID: 1830)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1830, 'Sandlot Collector Pack', '$49.94$49.99-$15.00', '$34.99', '$34.99', '$14.95');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1830, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1830, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1830, 'Single-player');
-- Subscription Tales of Monkey Island Complete Pack (Sub ID: 1837)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1837, 'Tales of Monkey Island Complete Pack', '$0.00$34.99', '$34.99', '$34.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1837, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1837, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1837, 'Single-player');
-- Subscription MumboJumbo Complete Pack (Sub ID: 1844)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1844, 'MumboJumbo Complete Pack', '$189.81$59.99', '$59.99', '$59.99', '$129.82');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1844, (SELECT id FROM languages WHERE name='English')),
(1844, (SELECT id FROM languages WHERE name='French')),
(1844, (SELECT id FROM languages WHERE name='German')),
(1844, (SELECT id FROM languages WHERE name='Italian')),
(1844, (SELECT id FROM languages WHERE name='Spanish')),
(1844, (SELECT id FROM languages WHERE name='Swedish')),
(1844, (SELECT id FROM languages WHERE name='Portuguese'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1844, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1844, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1844, 'Multi-player');
-- Subscription Paws and Claws Pet Pack (Sub ID: 1848)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1848, 'Paws and Claws Pet Pack', '$14.97$14.99-$7.50', '$7.49', '$7.49', '$7.48');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1848, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1848, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1848, 'Single-player');
-- Subscription Samantha Swift Combo Pack (Sub ID: 1849)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1849, 'Samantha Swift Combo Pack', '$9.98$18.98', '$18.98', '$18.98', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1849, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1849, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1849, 'Single-player');
-- Subscription MumboJumbo Complete (Sub ID: 1933)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1933, 'MumboJumbo Complete', '$85.82$59.99-$30.00', '$29.99', '$29.99', '$55.83');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1933, (SELECT id FROM languages WHERE name='English')),
(1933, (SELECT id FROM languages WHERE name='French')),
(1933, (SELECT id FROM languages WHERE name='German')),
(1933, (SELECT id FROM languages WHERE name='Italian')),
(1933, (SELECT id FROM languages WHERE name='Spanish')),
(1933, (SELECT id FROM languages WHERE name='Swedish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1933, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1933, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1933, 'Multi-player');
-- Subscription The absolute, autonomous, freewheeling, grassroots, nonaligned, nonpartisan, sovereign, unconstrained, uncontrolled, unregimented games pack (Sub ID: 1955)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1955, 'The absolute, autonomous, freewheeling, grassroots, nonaligned, nonpartisan, sovereign, unconstrained, uncontrolled, unregimented games pack', '$119.90$29.99', '$29.99', '$29.99', '$89.91');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1955, (SELECT id FROM languages WHERE name='English')),
(1955, (SELECT id FROM languages WHERE name='French')),
(1955, (SELECT id FROM languages WHERE name='Italian')),
(1955, (SELECT id FROM languages WHERE name='Portuguese')),
(1955, (SELECT id FROM languages WHERE name='German')),
(1955, (SELECT id FROM languages WHERE name='Spanish')),
(1955, (SELECT id FROM languages WHERE name='Japanese')),
(1955, (SELECT id FROM languages WHERE name='Korean')),
(1955, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(1955, (SELECT id FROM languages WHERE name='Dutch'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1955, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1955, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1955, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1955, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1955, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1955, 'Multi-player');
-- Subscription The autarchical, self-governing, self-reliant, self-ruling, self-sufficient games pack (Sub ID: 1956)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1956, 'The autarchical, self-governing, self-reliant, self-ruling, self-sufficient games pack', '$59.95$19.99', '$19.99', '$19.99', '$39.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1956, (SELECT id FROM languages WHERE name='English')),
(1956, (SELECT id FROM languages WHERE name='French')),
(1956, (SELECT id FROM languages WHERE name='Italian')),
(1956, (SELECT id FROM languages WHERE name='Portuguese')),
(1956, (SELECT id FROM languages WHERE name='German')),
(1956, (SELECT id FROM languages WHERE name='Spanish')),
(1956, (SELECT id FROM languages WHERE name='Japanese')),
(1956, (SELECT id FROM languages WHERE name='Korean')),
(1956, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(1956, (SELECT id FROM languages WHERE name='Dutch'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1956, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1956, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1956, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1956, 'Controller enabled');
-- Subscription Commandos Double Pack (Sub ID: 1974)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (1974, 'Commandos Double Pack', '$6.98$9.99-$5.00', '$4.99', '$4.99', '$1.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(1974, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (1974, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1974, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1974, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (1974, 'Co-op');
-- Subscription Fallout Collection (Sub ID: 2008)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2008, 'Fallout Collection', '$29.97$19.99', '$19.99', '$19.99', '$9.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2008, (SELECT id FROM languages WHERE name='English')),
(2008, (SELECT id FROM languages WHERE name='French')),
(2008, (SELECT id FROM languages WHERE name='German')),
(2008, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2008, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2008, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2008, 'Multi-player');
-- Subscription iWin Collectors Pack (Sub ID: 2013)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2013, 'iWin Collectors Pack', '$17.46$49.99-$37.50', '$12.49', '$12.49', '$4.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2013, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2013, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2013, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2013, 'Multi-player');
-- Subscription THQ Collector Pack (Sub ID: 2023)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2023, 'THQ Collector Pack', '$269.87$99.99', '$99.99', '$99.99', '$169.88');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2023, (SELECT id FROM languages WHERE name='English')),
(2023, (SELECT id FROM languages WHERE name='French')),
(2023, (SELECT id FROM languages WHERE name='Spanish')),
(2023, (SELECT id FROM languages WHERE name='Italian')),
(2023, (SELECT id FROM languages WHERE name='German')),
(2023, (SELECT id FROM languages WHERE name='Korean')),
(2023, (SELECT id FROM languages WHERE name='Customers in Germany can only play in German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2023, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2023, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2023, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2023, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2023, 'Includes level editor');
-- Subscription Nancy Drew Adventure Pack (Sub ID: 2061)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2061, 'Nancy Drew Adventure Pack', '$89.94$59.99-$15.00', '$44.99', '$44.99', '$44.95');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2061, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2061, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2061, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2061, 'Steam Achievements');
-- Subscription Majesty 2 Pre-order (Sub ID: 2069)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2069, 'Majesty 2 Pre-order', '$9.99$39.99', '$39.99', '$39.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2069, (SELECT id FROM languages WHERE name='English')),
(2069, (SELECT id FROM languages WHERE name='French')),
(2069, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2069, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2069, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2069, 'Multi-player');
-- Subscription SFI Complete Pack 2009 (Sub ID: 2080)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2080, 'SFI Complete Pack 2009', '$364.73$99.99', '$99.99', '$99.99', '$264.74');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2080, (SELECT id FROM languages WHERE name='English')),
(2080, (SELECT id FROM languages WHERE name='French')),
(2080, (SELECT id FROM languages WHERE name='Spanish')),
(2080, (SELECT id FROM languages WHERE name='German')),
(2080, (SELECT id FROM languages WHERE name='Italian')),
(2080, (SELECT id FROM languages WHERE name='Dutch'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2080, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2080, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2080, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2080, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2080, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2080, 'Includes level editor');
-- Subscription MDK Combo (Sub ID: 2096)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2096, 'MDK Combo', '$19.98$14.99', '$14.99', '$14.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2096, (SELECT id FROM languages WHERE name='English')),
(2096, (SELECT id FROM languages WHERE name='French')),
(2096, (SELECT id FROM languages WHERE name='German')),
(2096, (SELECT id FROM languages WHERE name='Italian')),
(2096, (SELECT id FROM languages WHERE name='Polish')),
(2096, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2096, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2096, 'Single-player');
-- Subscription LucasArts Adventure Pack (Sub ID: 2102)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2102, 'LucasArts Adventure Pack', '$9.96$9.99-$7.50', '$2.49', '$2.49', '$7.47');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2102, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2102, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2102, 'Single-player');
-- Subscription Star Wars Jedi Knight Collection (Sub ID: 2103)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2103, 'Star Wars Jedi Knight Collection', '$16.45$19.99-$10.00', '$9.99', '$9.99', '$6.46');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2103, (SELECT id FROM languages WHERE name='English')),
(2103, (SELECT id FROM languages WHERE name='French')),
(2103, (SELECT id FROM languages WHERE name='German')),
(2103, (SELECT id FROM languages WHERE name='Italian')),
(2103, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2103, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2103, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2103, 'Multi-player');
-- Subscription Left 4 Dead + Left 4 Dead 2 Bundle (Sub ID: 2188)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2188, 'Left 4 Dead + Left 4 Dead 2 Bundle', '$74.98$79.98-$15.00', '$64.98', '$64.98', '$10.00');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2188, (SELECT id FROM languages WHERE name='English')),
(2188, (SELECT id FROM languages WHERE name='French')),
(2188, (SELECT id FROM languages WHERE name='German')),
(2188, (SELECT id FROM languages WHERE name='Spanish')),
(2188, (SELECT id FROM languages WHERE name='Russian')),
(2188, (SELECT id FROM languages WHERE name='Danish')),
(2188, (SELECT id FROM languages WHERE name='Dutch')),
(2188, (SELECT id FROM languages WHERE name='Finnish')),
(2188, (SELECT id FROM languages WHERE name='Italian')),
(2188, (SELECT id FROM languages WHERE name='Japanese')),
(2188, (SELECT id FROM languages WHERE name='Korean')),
(2188, (SELECT id FROM languages WHERE name='Norwegian')),
(2188, (SELECT id FROM languages WHERE name='Polish')),
(2188, (SELECT id FROM languages WHERE name='Portuguese')),
(2188, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(2188, (SELECT id FROM languages WHERE name='Swedish')),
(2188, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(2188, (SELECT id FROM languages WHERE name='Traditional Chineselanguages with full audio support'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2188, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Steam Leaderboards');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Steam Cloud');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2188, 'Includes Source SDK');
-- Subscription X3: Gold (Sub ID: 2199)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2199, 'X3: Gold', '$14.98$29.98-$14.99', '$14.99', '$14.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2199, (SELECT id FROM languages WHERE name='English')),
(2199, (SELECT id FROM languages WHERE name='French')),
(2199, (SELECT id FROM languages WHERE name='German')),
(2199, (SELECT id FROM languages WHERE name='Spanish')),
(2199, (SELECT id FROM languages WHERE name='Italian')),
(2199, (SELECT id FROM languages WHERE name='(text')),
(2199, (SELECT id FROM languages WHERE name='only)'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2199, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2199, 'Single-player');
-- Subscription Painkiller: Resurrection (Sub ID: 2241)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2241, 'Painkiller: Resurrection', '$14.98$29.99-$3.00', '$26.99', '$26.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2241, (SELECT id FROM languages WHERE name='English')),
(2241, (SELECT id FROM languages WHERE name='French')),
(2241, (SELECT id FROM languages WHERE name='German')),
(2241, (SELECT id FROM languages WHERE name='Italian')),
(2241, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2241, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2241, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2241, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2241, 'Co-op');
-- Subscription Dawn of War Complete Pack (Sub ID: 2267)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2267, 'Dawn of War Complete Pack', '$54.96$59.99-$15.00', '$44.99', '$44.99', '$9.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2267, (SELECT id FROM languages WHERE name='English')),
(2267, (SELECT id FROM languages WHERE name='French')),
(2267, (SELECT id FROM languages WHERE name='German')),
(2267, (SELECT id FROM languages WHERE name='Italian')),
(2267, (SELECT id FROM languages WHERE name='Spanish')),
(2267, (SELECT id FROM languages WHERE name='Customers in Germany can only play in German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2267, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2267, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2267, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2267, 'Co-op');
-- Subscription Crazy Machines Everything Package (Sub ID: 2273)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2273, 'Crazy Machines Everything Package', '$74.95$49.99', '$49.99', '$49.99', '$24.96');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2273, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2273, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2273, 'Single-player');
-- Subscription RACE On Bundle (Sub ID: 2277)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2277, 'RACE On Bundle', '$64.97$29.99', '$29.99', '$29.99', '$34.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2277, (SELECT id FROM languages WHERE name='English')),
(2277, (SELECT id FROM languages WHERE name='French')),
(2277, (SELECT id FROM languages WHERE name='German')),
(2277, (SELECT id FROM languages WHERE name='Italian')),
(2277, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2277, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2277, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2277, 'Multi-player');
-- Subscription Red Faction Complete Pack (Sub ID: 2284)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2284, 'Red Faction Complete Pack', '$29.97$49.99-$20.02', '$29.97', '$29.97', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2284, (SELECT id FROM languages WHERE name='English')),
(2284, (SELECT id FROM languages WHERE name='French')),
(2284, (SELECT id FROM languages WHERE name='German')),
(2284, (SELECT id FROM languages WHERE name='Italian')),
(2284, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2284, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2284, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2284, 'Multi-player');
-- Subscription SFI Complete Pack (Sub ID: 2310)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2310, 'SFI Complete Pack', '$334.75$99.99', '$99.99', '$99.99', '$234.76');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2310, (SELECT id FROM languages WHERE name='English')),
(2310, (SELECT id FROM languages WHERE name='French')),
(2310, (SELECT id FROM languages WHERE name='Spanish')),
(2310, (SELECT id FROM languages WHERE name='German')),
(2310, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2310, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2310, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2310, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2310, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2310, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2310, 'Includes level editor');
-- Subscription Patricians and Merchants (Sub ID: 2327)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2327, 'Patricians and Merchants', '$9.99$14.99', '$14.99', '$14.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2327, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2327, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2327, 'Single-player');
-- Subscription East India Company Privateer Pack (Sub ID: 2342)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2342, 'East India Company Privateer Pack', '$21.98$21.98', '$21.98', '$21.98', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2342, (SELECT id FROM languages WHERE name='English')),
(2342, (SELECT id FROM languages WHERE name='French')),
(2342, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2342, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2342, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2342, 'Multi-player');
-- Subscription Painkiller: Collectors Pack (Sub ID: 2351)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2351, 'Painkiller: Collectors Pack', '$39.98$34.99', '$34.99', '$34.99', '$4.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2351, (SELECT id FROM languages WHERE name='English')),
(2351, (SELECT id FROM languages WHERE name='German')),
(2351, (SELECT id FROM languages WHERE name='French')),
(2351, (SELECT id FROM languages WHERE name='Spanish')),
(2351, (SELECT id FROM languages WHERE name='Italian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2351, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2351, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2351, 'Multi-player');
-- Subscription Mystery P.I.: Special Edition Bundle (Sub ID: 2353)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2353, 'Mystery P.I.: Special Edition Bundle', '$19.98$9.99', '$9.99', '$9.99', '$9.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2353, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2353, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2353, 'Single-player');
-- Subscription Men of War: Gold Edition (Sub ID: 2373)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2373, 'Men of War: Gold Edition', '$39.23$34.99-$8.75', '$26.24', '$26.24', '$12.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2373, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2373, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2373, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2373, 'Multi-player');
-- Subscription Earthworm Jim Collection (Sub ID: 2382)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2382, 'Earthworm Jim Collection', '$0.00$19.99', '$19.99', '$19.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2382, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2382, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2382, 'Single-player');
-- Subscription Massive Assault Collection (Sub ID: 2392)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2392, 'Massive Assault Collection', '$79.97$59.99', '$59.99', '$59.99', '$19.98');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2392, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2392, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2392, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2392, 'Multi-player');
-- Subscription Overlord Complete Pack (Sub ID: 2464)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2464, 'Overlord Complete Pack', '$22.97$34.99-$17.50', '$17.49', '$17.49', '$5.48');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2464, (SELECT id FROM languages WHERE name='English')),
(2464, (SELECT id FROM languages WHERE name='French')),
(2464, (SELECT id FROM languages WHERE name='German')),
(2464, (SELECT id FROM languages WHERE name='Italian')),
(2464, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2464, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2464, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2464, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2464, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2464, 'Controller enabled');
-- Subscription Left 4 Dead Bundle (Sub ID: 2487)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2487, 'Left 4 Dead Bundle', '$59.98$69.99-$17.50', '$52.49', '$52.49', '$7.49');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2487, (SELECT id FROM languages WHERE name='English')),
(2487, (SELECT id FROM languages WHERE name='French')),
(2487, (SELECT id FROM languages WHERE name='German')),
(2487, (SELECT id FROM languages WHERE name='Spanish')),
(2487, (SELECT id FROM languages WHERE name='Russian')),
(2487, (SELECT id FROM languages WHERE name='Danish')),
(2487, (SELECT id FROM languages WHERE name='Dutch')),
(2487, (SELECT id FROM languages WHERE name='Finnish')),
(2487, (SELECT id FROM languages WHERE name='Italian')),
(2487, (SELECT id FROM languages WHERE name='Japanese')),
(2487, (SELECT id FROM languages WHERE name='Korean')),
(2487, (SELECT id FROM languages WHERE name='Norwegian')),
(2487, (SELECT id FROM languages WHERE name='Polish')),
(2487, (SELECT id FROM languages WHERE name='Portuguese')),
(2487, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(2487, (SELECT id FROM languages WHERE name='Swedish')),
(2487, (SELECT id FROM languages WHERE name='Traditional Chineselanguages with full audio support'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2487, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Steam Leaderboards');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Steam Cloud');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2487, 'Includes Source SDK');
-- Subscription King''s Bounty: Gold Edition (Sub ID: 2520)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2520, 'King''s Bounty: Gold Edition', '$46.88$44.99-$14.85', '$30.14', '$30.14', '$16.74');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2520, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2520, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2520, 'Single-player');
-- Subscription Railworks Challenger Edition (Sub ID: 2530)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2530, 'Railworks Challenger Edition', '$18.99$68.98-$34.49', '$34.49', '$34.49', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2530, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2530, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2530, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2530, 'Downloadable Content');
-- Subscription LucasArts Premier Pack (Sub ID: 2532)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2532, 'LucasArts Premier Pack', '$127.84$127.84-$77.85', '$49.99', '$49.99', '$77.85');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2532, (SELECT id FROM languages WHERE name='English')),
(2532, (SELECT id FROM languages WHERE name='French')),
(2532, (SELECT id FROM languages WHERE name='German')),
(2532, (SELECT id FROM languages WHERE name='Italian')),
(2532, (SELECT id FROM languages WHERE name='Spanish')),
(2532, (SELECT id FROM languages WHERE name='French.')),
(2532, (SELECT id FROM languages WHERE name='languages')),
(2532, (SELECT id FROM languages WHERE name='with')),
(2532, (SELECT id FROM languages WHERE name='full')),
(2532, (SELECT id FROM languages WHERE name='audio')),
(2532, (SELECT id FROM languages WHERE name='support'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2532, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2532, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2532, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2532, 'Steam Leaderboards');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2532, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2532, 'MMO');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2532, 'Multi-player');
-- Subscription Serious Sam HD (Sub ID: 2535)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2535, 'Serious Sam HD', '$0.00$19.99-$5.00', '$14.99', '$14.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2535, (SELECT id FROM languages WHERE name='English')),
(2535, (SELECT id FROM languages WHERE name='French')),
(2535, (SELECT id FROM languages WHERE name='German')),
(2535, (SELECT id FROM languages WHERE name='Italian')),
(2535, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2535, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2535, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2535, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2535, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2535, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2535, 'Steam Leaderboards');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2535, 'Steam Cloud');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2535, 'Controller enabled');
-- Subscription THQ Complete Pack (Sub ID: 2539)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2539, 'THQ Complete Pack', '$192.32$99.99-$25.00', '$74.99', '$74.99', '$117.33');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2539, (SELECT id FROM languages WHERE name='English')),
(2539, (SELECT id FROM languages WHERE name='French')),
(2539, (SELECT id FROM languages WHERE name='Spanish')),
(2539, (SELECT id FROM languages WHERE name='Italian')),
(2539, (SELECT id FROM languages WHERE name='German')),
(2539, (SELECT id FROM languages WHERE name='Korean')),
(2539, (SELECT id FROM languages WHERE name='Dutch')),
(2539, (SELECT id FROM languages WHERE name='Danish')),
(2539, (SELECT id FROM languages WHERE name='Swedish')),
(2539, (SELECT id FROM languages WHERE name='Customers in Germany can only play in German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2539, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2539, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2539, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2539, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2539, 'Includes level editor');
-- Subscription Valve Complete Pack (Sub ID: 2546)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2546, 'Valve Complete Pack', '$194.81$99.99-$25.00', '$74.99', '$74.99', '$119.82');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2546, (SELECT id FROM languages WHERE name='English')),
(2546, (SELECT id FROM languages WHERE name='French')),
(2546, (SELECT id FROM languages WHERE name='German')),
(2546, (SELECT id FROM languages WHERE name='Italian')),
(2546, (SELECT id FROM languages WHERE name='Korean')),
(2546, (SELECT id FROM languages WHERE name='Spanish')),
(2546, (SELECT id FROM languages WHERE name='Simplified Chinese')),
(2546, (SELECT id FROM languages WHERE name='Traditional Chinese')),
(2546, (SELECT id FROM languages WHERE name='Japanese')),
(2546, (SELECT id FROM languages WHERE name='Russian')),
(2546, (SELECT id FROM languages WHERE name='Thai')),
(2546, (SELECT id FROM languages WHERE name='Dutch')),
(2546, (SELECT id FROM languages WHERE name='Danish')),
(2546, (SELECT id FROM languages WHERE name='Finnish')),
(2546, (SELECT id FROM languages WHERE name='Norwegian')),
(2546, (SELECT id FROM languages WHERE name='Polish')),
(2546, (SELECT id FROM languages WHERE name='Portuguese')),
(2546, (SELECT id FROM languages WHERE name='Swedish')),
(2546, (SELECT id FROM languages WHERE name='Traditional Chineselanguages with full audio support'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2546, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Valve Anti-Cheat enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'HDR available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Includes Source SDK');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Stats');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Captions available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Commentary available');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Steam Leaderboards');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Steam Cloud');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2546, 'Includes level editor');
-- Subscription Broken Sword: Twin Pack (Sub ID: 2567)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2567, 'Broken Sword: Twin Pack', '$5.98$9.99-$5.00', '$4.99', '$4.99', '$0.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2567, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2567, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2567, 'Single-player');
-- Subscription Puzzle Indie Pack (Sub ID: 2573)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2573, 'Puzzle Indie Pack', '$2.98$14.99-$12.00', '$2.99', '$2.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2573, (SELECT id FROM languages WHERE name='English')),
(2573, (SELECT id FROM languages WHERE name='Polish')),
(2573, (SELECT id FROM languages WHERE name='Russian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2573, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2573, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2573, 'Steam Achievements');
-- Subscription Action Indie Pack (Sub ID: 2574)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2574, 'Action Indie Pack', '$6.96$24.99-$20.00', '$4.99', '$4.99', '$1.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2574, (SELECT id FROM languages WHERE name='English')),
(2574, (SELECT id FROM languages WHERE name='Russian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2574, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2574, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2574, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2574, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2574, 'Co-op');
-- Subscription ItzaZoo (Sub ID: 2600)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2600, 'ItzaZoo', '$9.99$9.99-$3.30', '$6.69', '$6.69', '$3.30');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2600, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2600, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2600, 'Single-player');
-- Subscription The Itza Pack (Sub ID: 2601)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2601, 'The Itza Pack', '$18.98$14.99', '$14.99', '$14.99', '$3.99');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2601, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2601, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2601, 'Single-player');
-- Subscription Monkey Island Complete Pack (Sub ID: 2603)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2603, 'Monkey Island Complete Pack', '$0.00$34.99', '$34.99', '$34.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2603, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2603, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2603, 'Single-player');
-- Subscription Hearts of Iron III + DLCs (Sub ID: 2608)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2608, 'Hearts of Iron III + DLCs', '$8.46$20.99', '$20.99', '$20.99', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2608, (SELECT id FROM languages WHERE name='English')),
(2608, (SELECT id FROM languages WHERE name='French')),
(2608, (SELECT id FROM languages WHERE name='German'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2608, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2608, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2608, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2608, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2608, 'Downloadable Content');
-- Subscription Family Gaming Pack (Sub ID: 2631)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2631, 'Family Gaming Pack', '$54.89$29.99-$15.00', '$14.99', '$14.99', '$39.90');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2631, (SELECT id FROM languages WHERE name='English')),
(2631, (SELECT id FROM languages WHERE name='French')),
(2631, (SELECT id FROM languages WHERE name='German')),
(2631, (SELECT id FROM languages WHERE name='Italian')),
(2631, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2631, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2631, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2631, 'Multi-player');
-- Subscription Nancy Drew: Complete Pack (Sub ID: 2643)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2643, 'Nancy Drew: Complete Pack', '$224.84$99.99-$50.00', '$49.99', '$49.99', '$174.85');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2643, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2643, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2643, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2643, 'Steam Achievements');
-- Subscription Build-A-Lot 2: Town of the Year (Sub ID: 2649)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2649, 'Build-A-Lot 2: Town of the Year', '$24.99$9.99', '$9.99', '$9.99', '$15.00');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2649, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2649, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2649, 'Single-player');
-- Subscription Build-A-Lot Collection (Sub ID: 2652)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2652, 'Build-A-Lot Collection', '$9.96$24.99-$18.75', '$6.24', '$6.24', '$3.72');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2652, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2652, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2652, 'Single-player');
-- Subscription Simulation Gaming Pack (Sub ID: 2661)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2661, 'Simulation Gaming Pack', '$32.44$29.99-$15.00', '$14.99', '$14.99', '$17.45');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2661, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2661, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2661, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2661, 'Multi-player');
-- Subscription Aspyr Complete Pack (Sub ID: 2673)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2673, 'Aspyr Complete Pack', '$187.40$89.99-$45.00', '$44.99', '$44.99', '$142.41');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2673, (SELECT id FROM languages WHERE name='English')),
(2673, (SELECT id FROM languages WHERE name='French')),
(2673, (SELECT id FROM languages WHERE name='German')),
(2673, (SELECT id FROM languages WHERE name='Italian')),
(2673, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2673, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2673, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2673, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2673, 'Steam Achievements');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2673, 'Steam Leaderboards');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2673, 'Steam Cloud');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2673, 'Controller enabled');
-- Subscription Telltale Everything Pack (Sub ID: 2683)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2683, 'Telltale Everything Pack', '$191.69$99.99-$50.00', '$49.99', '$49.99', '$141.70');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2683, (SELECT id FROM languages WHERE name='English')),
(2683, (SELECT id FROM languages WHERE name='French')),
(2683, (SELECT id FROM languages WHERE name='German')),
(2683, (SELECT id FROM languages WHERE name='Italian')),
(2683, (SELECT id FROM languages WHERE name='(full')),
(2683, (SELECT id FROM languages WHERE name='audio)')),
(2683, (SELECT id FROM languages WHERE name='(Subtitles)')),
(2683, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2683, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2683, 'Single-player');
-- Subscription Codemasters Complete Pack (Sub ID: 2684)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2684, 'Codemasters Complete Pack', '$234.82$99.99-$25.00', '$74.99', '$74.99', '$159.83');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2684, (SELECT id FROM languages WHERE name='English')),
(2684, (SELECT id FROM languages WHERE name='French')),
(2684, (SELECT id FROM languages WHERE name='German')),
(2684, (SELECT id FROM languages WHERE name='Italian')),
(2684, (SELECT id FROM languages WHERE name='Spanish')),
(2684, (SELECT id FROM languages WHERE name='Dutch'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2684, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2684, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2684, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2684, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2684, 'Controller enabled');
-- Subscription JoWooD Entertainment, DreamCatcher Everything Pack (Sub ID: 2685)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2685, 'JoWooD Entertainment, DreamCatcher Everything Pack', '$82.42$89.99-$30.00', '$59.99', '$59.99', '$22.43');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2685, (SELECT id FROM languages WHERE name='English')),
(2685, (SELECT id FROM languages WHERE name='French')),
(2685, (SELECT id FROM languages WHERE name='German')),
(2685, (SELECT id FROM languages WHERE name='Spanish')),
(2685, (SELECT id FROM languages WHERE name='Italian')),
(2685, (SELECT id FROM languages WHERE name='English.'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2685, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2685, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2685, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2685, 'Co-op');
-- Subscription Eidos Collector Pack (Sub ID: 2687)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2687, 'Eidos Collector Pack', '$262.44$99.99-$50.00', '$49.99', '$49.99', '$212.45');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2687, (SELECT id FROM languages WHERE name='English')),
(2687, (SELECT id FROM languages WHERE name='French')),
(2687, (SELECT id FROM languages WHERE name='German')),
(2687, (SELECT id FROM languages WHERE name='Italian')),
(2687, (SELECT id FROM languages WHERE name='Spanish')),
(2687, (SELECT id FROM languages WHERE name='Polish')),
(2687, (SELECT id FROM languages WHERE name='Russian'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2687, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2687, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2687, 'Controller enabled');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2687, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2687, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2687, 'New releases');
-- Subscription Square Enix Pack (Sub ID: 2693)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2693, 'Square Enix Pack', '$90.96$89.99-$40.00', '$49.99', '$49.99', '$40.97');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2693, (SELECT id FROM languages WHERE name='English')),
(2693, (SELECT id FROM languages WHERE name='French')),
(2693, (SELECT id FROM languages WHERE name='German')),
(2693, (SELECT id FROM languages WHERE name='Italian')),
(2693, (SELECT id FROM languages WHERE name='Japanese')),
(2693, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2693, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2693, 'MMO');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2693, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2693, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2693, 'Controller enabled');
-- Subscription The Sherlock Holmes Collection (Sub ID: 2696)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2696, 'The Sherlock Holmes Collection', '$44.94$54.99-$11.00', '$43.99', '$43.99', '$0.95');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2696, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2696, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2696, 'Single-player');
-- Subscription Railworks and Tornado Pack (Sub ID: 2700)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (2700, 'Railworks and Tornado Pack', '$18.99$69.99-$23.10', '$46.89', '$46.89', '');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(2700, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (2700, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2700, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (2700, 'Downloadable Content');
-- Subscription Unreal Deal Pack (Sub ID: 683)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (683, 'Unreal Deal Pack', '$69.95$39.99-$26.40', '$13.59', '$13.59', '$56.36');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(683, (SELECT id FROM languages WHERE name='English')),
(683, (SELECT id FROM languages WHERE name='French')),
(683, (SELECT id FROM languages WHERE name='German')),
(683, (SELECT id FROM languages WHERE name='Italian')),
(683, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (683, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Steam Achievements');
-- Subscription Oddworld Pack (Sub ID: 949)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (949, 'Oddworld Pack', '$3.74$9.99-$7.50', '$2.49', '$2.49', '$1.25');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(949, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (949, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (949, 'Single-player');
-- Subscription Unreal Deal Pack (Sub ID: 683)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (683, 'Unreal Deal Pack', '$69.95$39.99-$26.40', '$13.59', '$13.59', '$56.36');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(683, (SELECT id FROM languages WHERE name='English')),
(683, (SELECT id FROM languages WHERE name='French')),
(683, (SELECT id FROM languages WHERE name='German')),
(683, (SELECT id FROM languages WHERE name='Italian')),
(683, (SELECT id FROM languages WHERE name='Spanish'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (683, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Single-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Multi-player');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Co-op');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (683, 'Steam Achievements');
-- Subscription Oddworld Pack (Sub ID: 949)
INSERT IGNORE INTO subs (sub_id, title, individual_total, package_price, cost_to_you, you_save) VALUES (949, 'Oddworld Pack', '$3.74$9.99-$7.50', '$2.49', '$2.49', '$1.25');
INSERT IGNORE INTO sub_apps (sub_id, app_id, app_name, item_price, item_rating) VALUES 
INSERT IGNORE INTO sub_languages (sub_id, language_id) VALUES 
(949, (SELECT id FROM languages WHERE name='English'));
INSERT IGNORE INTO sub_language_notes (sub_id, note_html) VALUES (949, '<i>Full audio support may not be present for all languages. View the individual games for more details.</i>');
INSERT IGNORE INTO sub_specs (sub_id, spec_name) VALUES (949, 'Single-player');
