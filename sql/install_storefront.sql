CREATE TABLE store_categories(id INT PRIMARY KEY,name TEXT,ord INT,visible TINYINT DEFAULT 1);
CREATE TABLE store_developers(id INT AUTO_INCREMENT PRIMARY KEY,name TEXT);
CREATE TABLE store_apps(appid INT PRIMARY KEY,name TEXT,developer TEXT,availability TEXT,price DECIMAL(10,2),metacritic TEXT DEFAULT NULL,description TEXT,sysreq TEXT,main_image TEXT,images TEXT,show_metascore TINYINT DEFAULT 0);
CREATE INDEX idx_storefront_products_appid ON store_apps(appid);
CREATE TABLE subscriptions(subid INT PRIMARY KEY,name TEXT,price DECIMAL(10,2));
CREATE TABLE subscription_apps(subid INT,appid INT,PRIMARY KEY(subid,appid));
CREATE TABLE app_categories(appid INT,category_id INT,PRIMARY KEY(appid,category_id));
CREATE TABLE store_sidebar_links(
    id INT AUTO_INCREMENT PRIMARY KEY,
    label TEXT,
    url TEXT,
    type VARCHAR(10) DEFAULT 'link',
    ord INT,
    visible TINYINT DEFAULT 1
);
CREATE TABLE store_capsules(position VARCHAR(20) PRIMARY KEY, image TEXT, appid INT);
CREATE TABLE storefront_capsules_all(position VARCHAR(20) PRIMARY KEY, size VARCHAR(10), image_path TEXT, appid INT, price DECIMAL(10,2), hidden TINYINT DEFAULT 0);
CREATE TABLE storefront_capsules_per_theme(theme VARCHAR(20), position VARCHAR(20), size VARCHAR(10), image_path TEXT, appid INT, price DECIMAL(10,2), hidden TINYINT DEFAULT 0, PRIMARY KEY(theme, position));
CREATE TABLE storefront_tabs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(20),
    title TEXT,
    ord INT
);
CREATE TABLE storefront_tab_games(
    id INT AUTO_INCREMENT PRIMARY KEY,
    tab_id INT,
    appid INT,
    ord INT
);
ALTER TABLE subscription_apps
    ADD CONSTRAINT fk_subscription_apps_sub FOREIGN KEY (subid) REFERENCES subscriptions(subid) ON DELETE CASCADE,
    ADD CONSTRAINT fk_subscription_apps_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;
ALTER TABLE app_categories
    ADD CONSTRAINT fk_app_categories_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE,
    ADD CONSTRAINT fk_app_categories_cat FOREIGN KEY (category_id) REFERENCES store_categories(id) ON DELETE CASCADE;
ALTER TABLE store_capsules
    ADD CONSTRAINT fk_store_capsules_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;
ALTER TABLE storefront_capsules_all
    ADD CONSTRAINT fk_storefront_capsules_all_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;
ALTER TABLE storefront_capsules_per_theme
    ADD CONSTRAINT fk_storefront_capsules_per_theme_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;
ALTER TABLE storefront_tab_games
    ADD CONSTRAINT fk_storefront_tab_games_tab FOREIGN KEY (tab_id) REFERENCES storefront_tabs(id) ON DELETE CASCADE,
    ADD CONSTRAINT fk_storefront_tab_games_app FOREIGN KEY (appid) REFERENCES store_apps(appid) ON DELETE CASCADE;
INSERT INTO storefront_tabs(theme,title,ord) VALUES
('2007_v2','Top Sellers',1),
('2007_v2','Top Rated',2);
INSERT INTO storefront_tab_games(tab_id,appid,ord) VALUES
(1,1200,1),
(1,6980,2),
(2,9340,1);
INSERT INTO storefront_capsules_per_theme(theme,position,size,image_path,appid,price,hidden) VALUES
('2006_v1','top1','small','2006_v1/1510.png',1510,9.95,0),
('2006_v1','top2','small','2006_v1/3010.png',3010,19.95,0),
('2006_v1','large','large','2006_v1/380.png',380,19.95,0),
('2006_v1','under1','small','2006_v1/2400.png',2400,19.95,0),
('2006_v1','under2','small','2006_v1/2810.png',2810,19.95,0),
('2006_v1','bottom1','small','2006_v1/1300.png',1300,14.95,0),
('2006_v1','bottom2','small','2006_v1/1500.png',1500,19.95,0),
('2006_v2','top1','small','2006_v2/1510.png',1510,9.95,0),
('2006_v2','top2','small','2006_v2/3000.png',3000,19.95,0),
('2006_v2','large','large','2006_v2/900352.png',900352,0,0),
('2006_v2','under1','small','2006_v2/300.png',300,19.95,0),
('2006_v2','under2','small','2006_v2/2400.png',2400,19.95,0),
('2006_v2','bottom1','small','2006_v2/380.png',380,19.95,0),
('2006_v2','bottom2','small','2006_v2/1200.png',1200,24.95,0),
('2007_v1','top1','small','2007_v1/4700.png',4700,49.95,0),
('2007_v1','top2','small','2007_v1/380.png',380,19.95,0),
('2007_v1','large','large','2007_v1/2100.png',2100,49.95,0),
('2007_v1','under1','small','2007_v1/1510.png',1510,9.95,0),
('2007_v1','under2','small','2007_v1/3900.png',3900,49.95,0),
('2007_v1','bottom1','small','2007_v1/2400.png',2400,19.95,0),
('2007_v1','bottom2','small','2007_v1/300.png',300,19.95,0),
('2007_v2','top1','small','2007_v2/1200.png',1200,19.95,0),
('2007_v2','top2','small','2007_v2/6980.png',6980,19.95,0),
('2007_v2','large','large','2007_v2/9340.png',9340,39.95,0),
('2007_v2','under1','small','2007_v2/7260.png',7260,39.95,0),
('2007_v2','under2','small','2007_v2/8400.png',8400,3.95,0);
INSERT INTO store_categories(id,name,ord,visible) VALUES(2,'Single-player',1,1);
INSERT INTO store_categories(id,name,ord,visible) VALUES(1,'Multi-player',2,1);
INSERT INTO store_categories(id,name,ord,visible) VALUES(3,'New releases',3,1);
INSERT INTO store_categories(id,name,ord,visible) VALUES(4,'Pre-release',4,1);
INSERT INTO store_categories(id,name,ord,visible) VALUES(7,'Mods (require HL1)',5,1);
INSERT INTO store_categories(id,name,ord,visible) VALUES(6,'Mods (require HL2)',6,1);
INSERT INTO store_categories(id,name,ord,visible) VALUES(10,'Game Demo',7,1);
INSERT INTO store_developers(name) VALUES('Action Half-Life Team');
INSERT INTO store_developers(name) VALUES('Adam Foster');
INSERT INTO store_developers(name) VALUES('Adrenaline Gamer');
INSERT INTO store_developers(name) VALUES('BG2 Team');
INSERT INTO store_developers(name) VALUES('Black Cat Games');
INSERT INTO store_developers(name) VALUES('BrainBread Team');
INSERT INTO store_developers(name) VALUES('Digital Paintball Team');
INSERT INTO store_developers(name) VALUES('Dystopia Team');
INSERT INTO store_developers(name) VALUES('Earth''s Special Forces Team');
INSERT INTO store_developers(name) VALUES('Firearms Team');
INSERT INTO store_developers(name) VALUES('Frontline Force Team');
INSERT INTO store_developers(name) VALUES('Frozenbyte');
INSERT INTO store_developers(name) VALUES('Garry');
INSERT INTO store_developers(name) VALUES('Gearbox');
INSERT INTO store_developers(name) VALUES('Hidden: Source Team');
INSERT INTO store_developers(name) VALUES('HL2:CTF Team');
INSERT INTO store_developers(name) VALUES('Hostile Intent Team');
INSERT INTO store_developers(name) VALUES('I.O.S. Team');
INSERT INTO store_developers(name) VALUES('Introversion Software');
INSERT INTO store_developers(name) VALUES('Malfador Machinations');
INSERT INTO store_developers(name) VALUES('Mark Healey');
INSERT INTO store_developers(name) VALUES('Nuclear Vision');
INSERT INTO store_developers(name) VALUES('Outerlight');
INSERT INTO store_developers(name) VALUES('Plan of Attack Team');
INSERT INTO store_developers(name) VALUES('Reality Pump Studios');
INSERT INTO store_developers(name) VALUES('Ritual');
INSERT INTO store_developers(name) VALUES('Science and Industry Team');
INSERT INTO store_developers(name) VALUES('Sonalysts');
INSERT INTO store_developers(name) VALUES('Sven Co-Op Team');
INSERT INTO store_developers(name) VALUES('The Battle Grounds Team');
INSERT INTO store_developers(name) VALUES('The Specialists Team');
INSERT INTO store_developers(name) VALUES('The Trenches Team');
INSERT INTO store_developers(name) VALUES('Tripwire');
INSERT INTO store_developers(name) VALUES('Unknown Worlds');
INSERT INTO store_developers(name) VALUES('Valve');
INSERT INTO store_developers(name) VALUES('Vampire Slayer');
INSERT INTO store_developers(name) VALUES('Zombie Panic Team');
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90021,"Action Half-Life","Action Half-Life Team","Available",0,"","","","0000000108_thumb.jpg","[\"0000000108_thumb.jpg\", \"0000000107_thumb.jpg\", \"0000000106_thumb.jpg\", \"0000000105_thumb.jpg\", \"0000000104_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90009,"Adrenaline Gamer","Adrenaline Gamer","Available",0,"","","","0000000078_thumb.jpg","[\"0000000078_thumb.jpg\", \"0000000077_thumb.jpg\", \"0000000076_thumb.jpg\", \"0000000075_thumb.jpg\", \"0000000074_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90001,"Alien Swarm: Infested","Black Cat Games","n/a",0,"","","","0000000221_thumb.jpg","[\"0000000221_thumb.jpg\", \"0000000220_thumb.jpg\", \"0000000219_thumb.jpg\", \"0000000218_thumb.jpg\", \"0000000217_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90026,"Battle Grounds 2 (beta)","BG2 Team","n/a",0,"","","","0000000235_thumb.jpg","[\"0000000235_thumb.jpg\", \"0000000234_thumb.jpg\", \"0000000233_thumb.jpg\", \"0000000232_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90006,"BrainBread","BrainBread Team","Available",0,"","","","0000000063_thumb.jpg","[\"0000000063_thumb.jpg\", \"0000000062_thumb.jpg\", \"0000000061_thumb.jpg\", \"0000000060_thumb.jpg\", \"0000000059_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(92,"Codename Gordon","Nuclear Vision","Available",0,"","Created by Nuclearvision Entertainment, Codename Gordon takes players through dozens of levels inspired by Half-Life and Half-Life 2, challenges players to a slew of puzzles, and showcases many of the familiar creatures in an all new, 2 dimensional playing field.","","0000000041_thumb.jpg","[\"0000000041_thumb.jpg\", \"0000000040_thumb.jpg\", \"0000000039_thumb.jpg\", \"0000000038_thumb.jpg\", \"0000000037_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(10,"Counter-Strike","Valve","Available",19.95,"88","Play the world's number 1 online action game. Engage in an incredibly realistic brand of terrorist warfare in this wildly popular team-based game. Ally with teammates to complete strategic missions. Take out enemy sites. Rescue hostages. Your role affects your team's success. Your team's success affects your role.","Minimum:\n 500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP/ME/SE, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000136_thumb.jpg","[\"0000000136_thumb.jpg\", \"0000000135_thumb.jpg\", \"0000000134_thumb.jpg\", \"0000000133_thumb.jpg\", \"0000000132_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(80,"Counter-Strike: Condition Zero","Valve","Available",14.95,"65","With its extensive Tour of Duty campaign, a near-limitless number of skirmish modes, updates and new content for Counter-Strike's award-winning multiplayer game play, plus over 12 bonus single player missions, Counter-Strike: Condition Zero is a tremendous offering of single and multiplayer content.","","0000000141_thumb.jpg","[\"0000000141_thumb.jpg\", \"0000000140_thumb.jpg\", \"0000000139_thumb.jpg\", \"0000000138_thumb.jpg\", \"0000000137_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(240,"Counter-Strike: Source","Valve","Available",19.95,"88","THE NEXT INSTALLMENT OF THE WORLD'S # 1 ONLINE ACTION GAME","Minimum:\n 1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000031_thumb.jpg","[\"0000000031_thumb.jpg\", \"0000000030_thumb.jpg\", \"0000000029_thumb.jpg\", \"0000000028_thumb.jpg\", \"0000000027_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(1600,"Dangerous Waters","Sonalysts","Coming soon",39.95,"82","S.C.S. - Dangerous Waters allows you total control over multiple air, surface, and submarine platforms in a modern-day naval environment. Take direct control of individual crew stations and also plan and execute combined arms naval strategies from a top-down 'Commanders Eye' perspective.","Minimum\nWindows 98SE/ME/2000/XP, 550Mhz CPU, 128 MB RAM, 8x CD-ROM, D3D Video Card with 32MB RAM (DirectX 9.0b drivers), DX9 Sound Card, 590MB hard drive space, Internet or LAN connection for multiplayer\n\nRecommended\n1GHz+ CPU, 256 MB RAM, D3D Video Card with 64MB RAM (with DirectX 9.0b compatible drivers), 1GB hard-drive space","0000000252_thumb.jpg","[\"0000000252_thumb.jpg\", \"0000000251_thumb.jpg\", \"0000000250_thumb.jpg\", \"0000000249_thumb.jpg\", \"0000000248_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(1500,"Darwinia","Introversion Software","New release",19.95,"85","","Windows 98/Me/2000/XP, 600MHz CPU, 128MB RAM, DX7 based video card","0000000231_thumb.jpg","[\"0000000231_thumb.jpg\", \"0000000230_thumb.jpg\", \"0000000229_thumb.jpg\", \"0000000228_thumb.jpg\", \"0000000227_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(30,"Day of Defeat","Valve","Available",9.95,"79","Enlist in an intense brand of Axis vs. Allied teamplay set in the WWII European Theatre of Operations. Players assume the role of light/assault/heavy infantry, sniper or machine-gunner class, each with a unique arsenal of historical weaponry at their disposal. Missions are based on key historical operations. And, as war rages, players must work together with their squad to accomplish a variety of mission-specific objectives.","Minimum:\n 500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP/ME/SE, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000173_thumb.jpg","[\"0000000173_thumb.jpg\", \"0000000172_thumb.jpg\", \"0000000171_thumb.jpg\", \"0000000170_thumb.jpg\", \"0000000169_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(300,"Day of Defeat: Source","Valve","Available",19.95,"80","Day of Defeat offers an intense brand of online gameplay set in the WWII European Theatre of Operations. Players assume the role of light/assault/heavy infantry, sniper or machine-gunner class, and missions are based on historical operations. Day of Defeat: Source features enhanced graphics and sounds design to leverage the power of Source, Valve's new engine technology.","","0000000045_thumb.jpg","[\"0000000045_thumb.jpg\", \"0000000044_thumb.jpg\", \"0000000043_thumb.jpg\", \"0000000042_thumb.jpg\", \"0000000023_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(40,"Deathmatch Classic","Valve","Available",9.95,"","Enjoy fast-paced multiplayer gaming with Deathmatch Classic (a.k.a. DMC). Valve's tribute to the work of id software, DMC invites players to grab their rocket launchers and put their reflexes to the test in a collection of futuristic settings.","Minimum:\n 500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP/ME/SE, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000145_thumb.jpg","[\"0000000145_thumb.jpg\", \"0000000144_thumb.jpg\", \"0000000143_thumb.jpg\", \"0000000142_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90010,"Digital Paintball","Digital Paintball Team","n/a",0,"","","","","[]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90023,"Dystopia","Dystopia Team","Available",0,"","","","0000000213_thumb.jpg","[\"0000000213_thumb.jpg\", \"0000000212_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90003,"Earth's Special Forces","Earth's Special Forces Team","Available",0,"","","","0000000178_thumb.jpg","[\"0000000178_thumb.jpg\", \"0000000177_thumb.jpg\", \"0000000176_thumb.jpg\", \"0000000175_thumb.jpg\", \"0000000174_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90016,"Firearms","Firearms Team","Available",0,"","","","","[]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90014,"Frontline Force","Frontline Force Team","Available",0,"","","","0000000088_thumb.jpg","[\"0000000088_thumb.jpg\", \"0000000087_thumb.jpg\", \"0000000086_thumb.jpg\", \"0000000085_thumb.jpg\", \"0000000084_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90024,"Garry's Mod","Garry","Available",0,"","","","0000000216_thumb.jpg","[\"0000000216_thumb.jpg\", \"0000000215_thumb.jpg\", \"0000000214_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(70,"Half-Life","Valve","Available",9.95,"96","Named Game of the Year by over 50 publications, Valve's debut title blends action and adventure with award-winning technology to create a frighteningly realistic world where players must think to survive. Also includes an exciting multiplayer mode that allows you to play against friends and enemies around the world.","Minimum:\n 500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP/ME/SE, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000150_thumb.jpg","[\"0000000150_thumb.jpg\", \"0000000149_thumb.jpg\", \"0000000147_thumb.jpg\", \"0000000146_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(220,"Half-Life 2","Valve","Available",39.95,"96","Half-Life 2 defines a new benchmark in gaming with startling realism and responsiveness. Powered by Source\u2122 technology, Half-Life 2 features the most sophisticated in-game characters ever witnessed, advanced AI, stunning graphics and physical gameplay.","","0000000194_thumb.jpg","[\"0000000194_thumb.jpg\", \"0000000193_thumb.jpg\", \"0000000192_thumb.jpg\", \"0000000118_thumb.jpg\", \"0000000114_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90013,"Half-Life 2: Capture the Flag","HL2:CTF Team","Available",0,"","","","0000000191_thumb.jpg","[\"0000000191_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(320,"Half-Life 2: Deathmatch","Valve","Available",9.95,"","Fast multiplayer action set in the Half-Life 2 universe! HL2's physics adds a new dimension to deathmatch play. Play straight deathmatch or try Combine vs. Resistance teamplay. Toss a toilet at your friend today!","Minimum:\n 1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","","[]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(219,"Half-Life 2: Demo","Valve","Available",0,"","Half-Life 2 defines a new benchmark in gaming with startling realism and responsiveness. Powered by Source\u2122 technology, Half-Life 2 features the most sophisticated in-game characters ever witnessed, advanced AI, stunning graphics and physical gameplay.","Minimum:\n 1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000199_thumb.jpg","[\"0000000199_thumb.jpg\", \"0000000198_thumb.jpg\", \"0000000197_thumb.jpg\", \"0000000196_thumb.jpg\", \"0000000195_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(340,"Half-Life 2: Lost Coast","Valve","Available",29.95,"","Originally planned as a section of the Highway 17 chapter of Half-Life 2, Lost Coast is a playable technology showcase that introduces High Dynamic Range lighting to the Source engine. Upon its release, Half-Life 2: Lost Coast will be available free of charge to all owners of Half-Life 2.","Minimum:\n 1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000015_thumb.jpg","[\"0000000015_thumb.jpg\", \"0000000014_thumb.jpg\", \"0000000013_thumb.jpg\", \"0000000011_thumb.jpg\", \"0000000010_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(130,"Half-Life: Blue Shift","Gearbox","Available",9.95,"71","Made by Gearbox Software and originally released in 2001 as an add-on to Half-Life, Blue Shift is a return to the Black Mesa Research Facility in which you play as Barney Calhoun, the security guard sidekick who helped Gordon out of so many sticky situations.","Minimum:\n 500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP/ME/SE, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000131_thumb.jpg","[\"0000000131_thumb.jpg\", \"0000000130_thumb.jpg\", \"0000000129_thumb.jpg\", \"0000000128_thumb.jpg\", \"0000000127_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(280,"Half-Life: Source","Valve","Available",9.95,"","Winner of over 50 Game of the Year awards, Half-Life set new standards for action games when it was released in 1998. Half-Life: Source is a digitally remastered version of the critically acclaimed and best selling PC game, enhanced via Source technology to include physics simulation, enhanced effects, and more.","Minimum:\n 1.2 GHz Processor, 256MB RAM, DirectX 7 level graphics card, Windows 2000/XP/ME/98, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 2.4 GHz Processor, 512MB RAM, DirectX 9 level graphics card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000190_thumb.jpg","[\"0000000190_thumb.jpg\", \"0000000189_thumb.jpg\", \"0000000188_thumb.jpg\", \"0000000187_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90025,"Hidden: Source","Hidden: Source Team","Available",0,"","","","0000000226_thumb.jpg","[\"0000000226_thumb.jpg\", \"0000000225_thumb.jpg\", \"0000000224_thumb.jpg\", \"0000000223_thumb.jpg\", \"0000000222_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90015,"Hostile Intent","Hostile Intent Team","Available",0,"","","","0000000093_thumb.jpg","[\"0000000093_thumb.jpg\", \"0000000092_thumb.jpg\", \"0000000091_thumb.jpg\", \"0000000090_thumb.jpg\", \"0000000089_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90007,"International Online Soccer","I.O.S. Team","Available",0,"","","","0000000068_thumb.jpg","[\"0000000068_thumb.jpg\", \"0000000067_thumb.jpg\", \"0000000066_thumb.jpg\", \"0000000065_thumb.jpg\", \"0000000064_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90000,"Minerva","Adam Foster","Available",0,"","","","0000000048_thumb.jpg","[\"0000000048_thumb.jpg\", \"0000000047_thumb.jpg\", \"0000000046_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90002,"Natural Selection","Unknown Worlds","Available",0,"","","","0000000211_thumb.jpg","[\"0000000211_thumb.jpg\", \"0000000210_thumb.jpg\", \"0000000202_thumb.jpg\", \"0000000201_thumb.jpg\", \"0000000200_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(50,"Opposing Force","Gearbox","Available",9.95,"","Return to the Black Mesa Research Facility as one of the military specialists assigned to eliminate Gordon Freeman. Experience an entirely new episode of single player action. Meet fierce alien opponents, and experiment with new weaponry. Named 'Game of the Year' by the Academy of Interactive Arts and Sciences.","Minimum:\n 500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP/ME/SE, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000159_thumb.jpg","[\"0000000159_thumb.jpg\", \"0000000158_thumb.jpg\", \"0000000157_thumb.jpg\", \"0000000156_thumb.jpg\", \"0000000155_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90011,"Plan of Attack","Plan of Attack Team","Available",0,"","","","0000000083_thumb.jpg","[\"0000000083_thumb.jpg\", \"0000000082_thumb.jpg\", \"0000000081_thumb.jpg\", \"0000000080_thumb.jpg\", \"0000000079_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(1002,"Rag Doll Kung Fu","Mark Healey","Available",14.95,"70","","","0000000209_thumb.jpg","[\"0000000209_thumb.jpg\", \"0000000208_thumb.jpg\", \"0000000207_thumb.jpg\", \"0000000206_thumb.jpg\", \"0000000205_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(60,"Ricochet","Valve","Available",9.95,"","A futuristic action game that challenges your agility as well as your aim, Ricochet features one-on-one and team matches played in a variety of futuristic battle arenas.","Minimum:\n 500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP/ME/SE, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000163_thumb.jpg","[\"0000000163_thumb.jpg\", \"0000000162_thumb.jpg\", \"0000000161_thumb.jpg\", \"0000000160_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90017,"Science and Industry","Science and Industry Team","Available",0,"","","","0000000098_thumb.jpg","[\"0000000098_thumb.jpg\", \"0000000097_thumb.jpg\", \"0000000096_thumb.jpg\", \"0000000095_thumb.jpg\", \"0000000094_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(1610,"Space Empires IV Deluxe","Malfador Machinations","Coming soon",19.95,"79","The award-winning Space Empires IV Deluxe is the latest edition in the Space Empires series. A grand strategy title in the space 4X (explore, expand, exploit, and exterminate) genre, Space Empires has already found a place in the heart of strategy gamers everywhere.","Minimum\nPentium Processor; Windows 98/ME/2000/XP; 128MB RAM; 800x600 screen resolution; 16bit colour; 300 MB hard drive space; 6X CD-ROM; DirectX 8.1 or higher, Windows Compatible Sound Card.","0000000247_thumb.jpg","[\"0000000247_thumb.jpg\", \"0000000246_thumb.jpg\", \"0000000245_thumb.jpg\", \"0000000243_thumb.jpg\", \"0000000242_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90005,"Sven Co-Op","Sven Co-Op Team","Available",0,"","","","0000000058_thumb.jpg","[\"0000000058_thumb.jpg\", \"0000000057_thumb.jpg\", \"0000000056_thumb.jpg\", \"0000000055_thumb.jpg\", \"0000000054_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(20,"Team Fortress Classic","Valve","Available",9.95,"","One of the most popular online action games of all time, Team Fortress Classic features over nine character classes -- from Medic to Spy to Demolition Man -- enlisted in a unique style of online team warfare. Each character class possesses unique weapons, items, and abilities, as teams compete online in a variety of game play modes.","Minimum:\n 500 mhz processor, 96mb ram, 16mb video card, Windows 2000/XP/ME/SE, Mouse, Keyboard, Internet Connection\n \n Recommended:\n 800 mhz processor, 128mb ram, 32mb+ video card, Windows 2000/XP, Mouse, Keyboard, Internet Connection","0000000168_thumb.jpg","[\"0000000168_thumb.jpg\", \"0000000167_thumb.jpg\", \"0000000166_thumb.jpg\", \"0000000165_thumb.jpg\", \"0000000164_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90008,"The Battle Grounds","The Battle Grounds Team","Available",0,"","","","0000000073_thumb.jpg","[\"0000000073_thumb.jpg\", \"0000000072_thumb.jpg\", \"0000000071_thumb.jpg\", \"0000000070_thumb.jpg\", \"0000000069_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90022,"The Ship","Outerlight Ltd.","Available",0,"","","","0000000113_thumb.jpg","[\"0000000113_thumb.jpg\", \"0000000112_thumb.jpg\", \"0000000111_thumb.jpg\", \"0000000110_thumb.jpg\", \"0000000109_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90004,"The Specialists","The Specialists Team","Available",0,"","","","0000000053_thumb.jpg","[\"0000000053_thumb.jpg\", \"0000000052_thumb.jpg\", \"0000000051_thumb.jpg\", \"0000000050_thumb.jpg\", \"0000000049_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90018,"The Trenches","The Trenches Team","Available",0,"","","","0000000186_thumb.jpg","[\"0000000186_thumb.jpg\", \"0000000185_thumb.jpg\", \"0000000184_thumb.jpg\", \"0000000183_thumb.jpg\", \"0000000182_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90020,"Vampire Slayer","Vampire Slayer","Available",0,"","","","0000000181_thumb.jpg","[\"0000000181_thumb.jpg\", \"0000000180_thumb.jpg\", \"0000000179_thumb.jpg\"]",0);
INSERT INTO store_apps(appid,name,developer,availability,price,metacritic,description,sysreq,main_image,images,show_metascore) VALUES(90012,"Zombie Panic","Zombie Panic Team","Available",0,"","","","0000000036_thumb.jpg","[\"0000000036_thumb.jpg\", \"0000000035_thumb.jpg\", \"0000000034_thumb.jpg\", \"0000000033_thumb.jpg\", \"0000000032_thumb.jpg\"]",0);
INSERT INTO subscriptions(subid,name,price) VALUES(7,"Counter-Strike",19.95);
INSERT INTO subscriptions(subid,name,price) VALUES(25,"Day of Defeat: Source",19.95);
INSERT INTO subscriptions(subid,name,price) VALUES(29,"Team Fortress Classic",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(30,"Day of Defeat",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(31,"Deathmatch Classic",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(32,"Opposing Force",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(33,"Ricochet",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(34,"Half-Life 1",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(35,"Half-Life: Blue Shift",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(36,"Half-Life 2",39.95);
INSERT INTO subscriptions(subid,name,price) VALUES(37,"Counter-Strike: Source",19.95);
INSERT INTO subscriptions(subid,name,price) VALUES(38,"Half-Life 1: Source",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(39,"Half-Life 2: Deathmatch",9.95);
INSERT INTO subscriptions(subid,name,price) VALUES(40,"Half-Life 1 Anthology",14.95);
INSERT INTO subscriptions(subid,name,price) VALUES(41,"Counter-Strike 1 Anthology",19.95);
INSERT INTO subscriptions(subid,name,price) VALUES(42,"Source Multiplayer Pack",29.95);
INSERT INTO subscriptions(subid,name,price) VALUES(43,"Source Premier Pack",59.95);
INSERT INTO subscriptions(subid,name,price) VALUES(44,"Valve Complete Pack",79.95);
INSERT INTO subscriptions(subid,name,price) VALUES(45,"Rag Doll Kung Fu",14.95);
INSERT INTO subscriptions(subid,name,price) VALUES(54,"Darwinia",19.95);
INSERT INTO subscriptions(subid,name,price) VALUES(57,"Space Empires IV Deluxe",19.95);
INSERT INTO subscriptions(subid,name,price) VALUES(58,"Dangerous Waters",39.95);
INSERT INTO subscription_apps(subid,appid) VALUES(7,10);
INSERT INTO subscription_apps(subid,appid) VALUES(7,80);
INSERT INTO subscription_apps(subid,appid) VALUES(25,300);
INSERT INTO subscription_apps(subid,appid) VALUES(29,20);
INSERT INTO subscription_apps(subid,appid) VALUES(30,30);
INSERT INTO subscription_apps(subid,appid) VALUES(31,40);
INSERT INTO subscription_apps(subid,appid) VALUES(32,50);
INSERT INTO subscription_apps(subid,appid) VALUES(33,60);
INSERT INTO subscription_apps(subid,appid) VALUES(34,70);
INSERT INTO subscription_apps(subid,appid) VALUES(35,130);
INSERT INTO subscription_apps(subid,appid) VALUES(36,220);
INSERT INTO subscription_apps(subid,appid) VALUES(36,340);
INSERT INTO subscription_apps(subid,appid) VALUES(37,240);
INSERT INTO subscription_apps(subid,appid) VALUES(38,280);
INSERT INTO subscription_apps(subid,appid) VALUES(39,320);
INSERT INTO subscription_apps(subid,appid) VALUES(40,20);
INSERT INTO subscription_apps(subid,appid) VALUES(40,50);
INSERT INTO subscription_apps(subid,appid) VALUES(40,70);
INSERT INTO subscription_apps(subid,appid) VALUES(40,130);
INSERT INTO subscription_apps(subid,appid) VALUES(41,10);
INSERT INTO subscription_apps(subid,appid) VALUES(41,30);
INSERT INTO subscription_apps(subid,appid) VALUES(41,40);
INSERT INTO subscription_apps(subid,appid) VALUES(41,60);
INSERT INTO subscription_apps(subid,appid) VALUES(41,80);
INSERT INTO subscription_apps(subid,appid) VALUES(42,240);
INSERT INTO subscription_apps(subid,appid) VALUES(42,300);
INSERT INTO subscription_apps(subid,appid) VALUES(42,320);
INSERT INTO subscription_apps(subid,appid) VALUES(43,220);
INSERT INTO subscription_apps(subid,appid) VALUES(43,240);
INSERT INTO subscription_apps(subid,appid) VALUES(43,280);
INSERT INTO subscription_apps(subid,appid) VALUES(43,300);
INSERT INTO subscription_apps(subid,appid) VALUES(43,320);
INSERT INTO subscription_apps(subid,appid) VALUES(43,340);
INSERT INTO subscription_apps(subid,appid) VALUES(44,10);
INSERT INTO subscription_apps(subid,appid) VALUES(44,20);
INSERT INTO subscription_apps(subid,appid) VALUES(44,30);
INSERT INTO subscription_apps(subid,appid) VALUES(44,40);
INSERT INTO subscription_apps(subid,appid) VALUES(44,50);
INSERT INTO subscription_apps(subid,appid) VALUES(44,60);
INSERT INTO subscription_apps(subid,appid) VALUES(44,70);
INSERT INTO subscription_apps(subid,appid) VALUES(44,80);
INSERT INTO subscription_apps(subid,appid) VALUES(44,130);
INSERT INTO subscription_apps(subid,appid) VALUES(44,220);
INSERT INTO subscription_apps(subid,appid) VALUES(44,240);
INSERT INTO subscription_apps(subid,appid) VALUES(44,280);
INSERT INTO subscription_apps(subid,appid) VALUES(44,300);
INSERT INTO subscription_apps(subid,appid) VALUES(44,320);
INSERT INTO subscription_apps(subid,appid) VALUES(44,340);
INSERT INTO subscription_apps(subid,appid) VALUES(45,1002);
INSERT INTO subscription_apps(subid,appid) VALUES(54,1500);
INSERT INTO subscription_apps(subid,appid) VALUES(57,1610);
INSERT INTO subscription_apps(subid,appid) VALUES(58,1600);
INSERT INTO app_categories(appid,category_id) VALUES(10,1);
INSERT INTO app_categories(appid,category_id) VALUES(20,1);
INSERT INTO app_categories(appid,category_id) VALUES(30,1);
INSERT INTO app_categories(appid,category_id) VALUES(40,1);
INSERT INTO app_categories(appid,category_id) VALUES(50,2);
INSERT INTO app_categories(appid,category_id) VALUES(60,1);
INSERT INTO app_categories(appid,category_id) VALUES(70,1);
INSERT INTO app_categories(appid,category_id) VALUES(70,2);
INSERT INTO app_categories(appid,category_id) VALUES(80,1);
INSERT INTO app_categories(appid,category_id) VALUES(80,2);
INSERT INTO app_categories(appid,category_id) VALUES(92,2);
INSERT INTO app_categories(appid,category_id) VALUES(130,2);
INSERT INTO app_categories(appid,category_id) VALUES(219,2);
INSERT INTO app_categories(appid,category_id) VALUES(219,10);
INSERT INTO app_categories(appid,category_id) VALUES(220,2);
INSERT INTO app_categories(appid,category_id) VALUES(240,1);
INSERT INTO app_categories(appid,category_id) VALUES(280,2);
INSERT INTO app_categories(appid,category_id) VALUES(300,1);
INSERT INTO app_categories(appid,category_id) VALUES(300,3);
INSERT INTO app_categories(appid,category_id) VALUES(320,1);
INSERT INTO app_categories(appid,category_id) VALUES(340,2);
INSERT INTO app_categories(appid,category_id) VALUES(340,3);
INSERT INTO app_categories(appid,category_id) VALUES(1002,1);
INSERT INTO app_categories(appid,category_id) VALUES(1002,2);
INSERT INTO app_categories(appid,category_id) VALUES(1200,3);
INSERT INTO app_categories(appid,category_id) VALUES(1500,2);
INSERT INTO app_categories(appid,category_id) VALUES(1500,3);
INSERT INTO app_categories(appid,category_id) VALUES(1502,10);
INSERT INTO app_categories(appid,category_id) VALUES(1600,1);
INSERT INTO app_categories(appid,category_id) VALUES(1600,2);
INSERT INTO app_categories(appid,category_id) VALUES(1600,3);
INSERT INTO app_categories(appid,category_id) VALUES(1610,2);
INSERT INTO app_categories(appid,category_id) VALUES(1610,3);
INSERT INTO app_categories(appid,category_id) VALUES(2510,10);
INSERT INTO app_categories(appid,category_id) VALUES(90000,2);
INSERT INTO app_categories(appid,category_id) VALUES(90000,6);
INSERT INTO app_categories(appid,category_id) VALUES(90001,1);
INSERT INTO app_categories(appid,category_id) VALUES(90001,6);
INSERT INTO app_categories(appid,category_id) VALUES(90002,1);
INSERT INTO app_categories(appid,category_id) VALUES(90002,7);
INSERT INTO app_categories(appid,category_id) VALUES(90003,1);
INSERT INTO app_categories(appid,category_id) VALUES(90003,7);
INSERT INTO app_categories(appid,category_id) VALUES(90004,1);
INSERT INTO app_categories(appid,category_id) VALUES(90004,7);
INSERT INTO app_categories(appid,category_id) VALUES(90005,1);
INSERT INTO app_categories(appid,category_id) VALUES(90005,7);
INSERT INTO app_categories(appid,category_id) VALUES(90006,1);
INSERT INTO app_categories(appid,category_id) VALUES(90006,7);
INSERT INTO app_categories(appid,category_id) VALUES(90007,1);
INSERT INTO app_categories(appid,category_id) VALUES(90007,7);
INSERT INTO app_categories(appid,category_id) VALUES(90008,1);
INSERT INTO app_categories(appid,category_id) VALUES(90008,7);
INSERT INTO app_categories(appid,category_id) VALUES(90009,1);
INSERT INTO app_categories(appid,category_id) VALUES(90009,7);
INSERT INTO app_categories(appid,category_id) VALUES(90010,1);
INSERT INTO app_categories(appid,category_id) VALUES(90010,7);
INSERT INTO app_categories(appid,category_id) VALUES(90011,1);
INSERT INTO app_categories(appid,category_id) VALUES(90011,6);
INSERT INTO app_categories(appid,category_id) VALUES(90012,1);
INSERT INTO app_categories(appid,category_id) VALUES(90012,7);
INSERT INTO app_categories(appid,category_id) VALUES(90013,1);
INSERT INTO app_categories(appid,category_id) VALUES(90013,6);
INSERT INTO app_categories(appid,category_id) VALUES(90014,1);
INSERT INTO app_categories(appid,category_id) VALUES(90014,7);
INSERT INTO app_categories(appid,category_id) VALUES(90015,1);
INSERT INTO app_categories(appid,category_id) VALUES(90015,7);
INSERT INTO app_categories(appid,category_id) VALUES(90016,1);
INSERT INTO app_categories(appid,category_id) VALUES(90016,7);
INSERT INTO app_categories(appid,category_id) VALUES(90017,1);
INSERT INTO app_categories(appid,category_id) VALUES(90017,7);
INSERT INTO app_categories(appid,category_id) VALUES(90018,1);
INSERT INTO app_categories(appid,category_id) VALUES(90018,7);
INSERT INTO app_categories(appid,category_id) VALUES(90020,1);
INSERT INTO app_categories(appid,category_id) VALUES(90020,7);
INSERT INTO app_categories(appid,category_id) VALUES(90021,1);
INSERT INTO app_categories(appid,category_id) VALUES(90021,7);
INSERT INTO app_categories(appid,category_id) VALUES(90022,1);
INSERT INTO app_categories(appid,category_id) VALUES(90022,7);
INSERT INTO app_categories(appid,category_id) VALUES(90023,1);
INSERT INTO app_categories(appid,category_id) VALUES(90023,3);
INSERT INTO app_categories(appid,category_id) VALUES(90023,6);
INSERT INTO app_categories(appid,category_id) VALUES(90024,2);
INSERT INTO app_categories(appid,category_id) VALUES(90024,6);
INSERT INTO app_categories(appid,category_id) VALUES(90025,1);
INSERT INTO app_categories(appid,category_id) VALUES(90025,3);
INSERT INTO app_categories(appid,category_id) VALUES(90025,6);
INSERT INTO app_categories(appid,category_id) VALUES(90026,1);
INSERT INTO app_categories(appid,category_id) VALUES(90026,6);
INSERT INTO settings(`key`,value) VALUES('store_featured',"{\"top\": 2400, \"middle\": 380, \"bottom_left\": 1200, \"bottom_right\": 1300}");
INSERT INTO store_capsules(position,image,appid) VALUES('top','top/08_01_2006.png',2400),('middle','middle/08_01_2006.png',380),('bottom_left','bottom_left/08_01_2006.png',1200),('bottom_right','bottom_right/08_01_2006.png',1300);
INSERT INTO store_sidebar_links(label,url,type,ord,visible) VALUES
 ('Home','/storefront/index.php','link',1,1),
 ('','', 'spacer',2,1),
 ('Browser Games','/storefront/browse.php','link',3,1),
 ('All Games','/storefront/allgames.php','link',4,1),
 ('Search','/storefront/search.php','link',5,1),
 ('','', 'spacer',6,1),
 ('Media','/storefront/media.php','link',7,1);
