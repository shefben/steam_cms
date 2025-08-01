// src/Controller/HomeController.php
#[Route('/', name: 'homepage')]
public function index(): Response
{
    return $this->render('home/index.html.twig', [
        // page + nav
        'page_title'   => 'Welcome to Steam',
        'homepage_url' => $this->generateUrl('homepage'),
        'global_nav'   => [
            ['url'=>'v/index.php',                 'title'=>'Home',               'label'=>'HOME'],
            ['url'=>'v/index.php?area=news',       'title'=>'News',               'label'=>'NEWS'],
            ['url'=>'v/index.php?area=getsteamnow','title'=>'Get Steam',          'label'=>'GET STEAM NOW'],
            ['url'=>'https://cafe.steampowered.com/','title'=>'Cyber Cafés',     'label'=>'CYBER CAFÉS'],
            ['url'=>'http://support.steampowered.com/','title'=>'Support',       'label'=>'SUPPORT'],
            ['url'=>'v/index.php?area=forums',     'title'=>'Forums',             'label'=>'FORUMS'],
            ['url'=>'status/status.html',          'title'=>'Status',             'label'=>'STATUS'],
        ],

        // left column – capsules
        'join_steam_text' => 'Join Steam for free and get games delivered straight to your desktop with automatic updates and a massive gaming community.',

        'small_capsules_top' => [
            ['appId'=>1510, 'name'=>'Uplink',           'image_sm'=>'gfx/apps/1510/capsule_sm.jpg', 'price'=>'$9.95'],
            ['appId'=>3010, 'name'=>'Xpand Rally',      'image_sm'=>'gfx/apps/3010/capsule_sm.jpg', 'price'=>'$19.95'],
        ],

        'large_capsule' => [
            'appId'=>380,
            'name'=>'Half-Life 2: Episode One',
            'image_lg'=>'gfx/apps/380/capsule_lrg.jpg',
            'price'=>'$19.95'
        ],

        'small_capsules_bottom' => [
            ['appId'=>2400, 'name'=>'The Ship',         'image_sm'=>'gfx/apps/2400/capsule_sm.jpg', 'price'=>'$19.95'],
            ['appId'=>2810, 'name'=>'X³: Reunion',      'image_sm'=>'gfx/apps/2810/capsule_sm.jpg', 'price'=>'$19.95'],
            ['appId'=>1300, 'name'=>'SiN Episodes: Emergence','image_sm'=>'gfx/apps/1300/capsule_sm.jpg','price'=>'$14.95'],
            ['appId'=>1500, 'name'=>'Darwinia',         'image_sm'=>'gfx/apps/1500/capsule_sm.jpg', 'price'=>'$19.95'],
        ],

        // gear & free-stuff widgets
        'gear' => [
            'title'=>'Get The Gear!',
            'text'=>'Check out the new Logitech® MOMO® Racing wheel! Visit the <a href="http://store.valvesoftware.com/" target="_blank">Valve Store</a> for official shirts, posters, hats and more!',
        ],
        'free_stuff' => [
            'title'=>'Free Stuff!',
            'text'=>'In addition to a catalog of great games, your free Steam account gives you access to <a href="http://storefront.steampowered.com/v/index.php?area=search&amp;browse=1&amp;category=&amp;price=1&amp;">games + demos</a>, <a href="http://storefront.steampowered.com/v/index.php?area=media&amp;">HD movies + trailers</a>, and more.',
        ],

        // right column
        'get_steam_subtext' => 'Everything you need to start playing now!',

        'new_on_steam' => [
            ['appId'=>3000,  'name'=>'GTI Racing',                        'icon'=>'mouse', 'date'=>new \DateTime('2006-08-24')],
            ['appId'=>3010,  'name'=>'Xpand Rally',                       'icon'=>'mouse', 'date'=>new \DateTime('2006-08-24')],
            ['appId'=>927,   'name'=>'GTI Racing Trailer',                'icon'=>'film',  'date'=>new \DateTime('2006-08-24')],
            ['appId'=>1510,  'name'=>'Uplink',                            'icon'=>'mouse', 'date'=>new \DateTime('2006-08-23')],
            ['appId'=>929,   'name'=>'Uplink Trailer',                    'icon'=>'film',  'date'=>new \DateTime('2006-08-23')],
            ['appId'=>928,   'name'=>'Source Forts Trailer',              'icon'=>'film',  'date'=>new \DateTime('2006-08-04')],
            ['appId'=>90034, 'name'=>'Source Forts',                      'icon'=>'mouse', 'date'=>new \DateTime('2006-08-01')],
            ['appId'=>924,   'name'=>'Red Orchestra Infantry Tutorial',   'icon'=>'film',  'date'=>new \DateTime('2006-07-28')],
        ],

        'find_links_left' => [
            ['url'=>'v/index.php?area=all&amp;',                       'label'=>'All Games'],
            ['url'=>'v/index.php?area=browse&amp;',                    'label'=>'Browse Games'],
            ['url'=>'v/index.php?area=search&amp;',                    'label'=>'Search'],
        ],
        'find_links_right' => [
            ['url'=>'v/index.php?area=media&amp;',                     'label'=>'Videos'],
            ['url'=>'v/index.php?area=search&amp;browse=1&amp;category=10&amp;','label'=>'Demos'],
            ['url'=>'http://store.valvesoftware.com',                  'label'=>'Gear'],
        ],

        'latest_news' => [
            [
                'id'=>730,
                'title'=>'GTI Racing and Xpand Rally Available on Steam',
                'summary'=>'Racing games, GTI Racing and Xpand Rally have come to Steam. Purchase either for $19.95, or both for $29.95. Also available in North America as a package with Logitech’s MOMO Racing wheel and pedal set for $214.95 (+shipping).',
            ],
            [
                'id'=>728,
                'title'=>'Counter-Strike: Source Update Released',
                'summary'=>'Updates to Counter-Strike: Source have been released. The updates will be applied automatically when your Steam client is restarted.',
            ],
            [
                'id'=>727,
                'title'=>'DEFCON On Steam In September',
                'summary'=>'In September, Valve and Introversion will deliver DEFCON, a new online strategy game from the creators of the award-winning Darwinia, via Steam. In addition, Introversion\'s first game and cult hit Uplink is now available via Steam.',
            ],
            [
                'id'=>725,
                'title'=>'Source Engine Update Released',
                'summary'=>'Updates to the Source Engine have been released. The updates will be applied automatically when your Steam client is restarted.',
            ],
            [
                'id'=>724,
                'title'=>'Day of Defeat: Source, Source Engine and SourceTV Updates Released',
                'summary'=>'Updates to Day of Defeat: Source and the Source Engine, along with some improvements to SourceTV have been released. The updates will be applied automatically when your Steam client is restarted.',
            ],
        ],
    ]);
}
