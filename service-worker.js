/**
 * Service Worker for Offline Caching (Optimization #25)
 *
 * Caches static assets and pages for offline access
 * Implements stale-while-revalidate strategy for best performance
 *
 * PERFORMANCE IMPACT: Instant page loads for repeat visits
 * Reduces server load by serving from client-side cache
 *
 * Installation: Add to your HTML <head>:
 * <script>
 * if ('serviceWorker' in navigator) {
 *     navigator.serviceWorker.register('/service-worker.js');
 * }
 * </script>
 */

const CACHE_NAME = 'steamcms-v1';
const CACHE_VERSION = '1.0.0';

// Assets to cache immediately on install
const PRECACHE_ASSETS = [
    '/',
    '/index.php',
    // Add critical CSS/JS
    '/themes/2004/css/steampowered02.css',
    '/themes/2004/images/logo_steam_header.jpg',
    // Add more critical assets
];

// Cache strategies by URL pattern
const CACHE_STRATEGIES = {
    // Static assets: Cache first, fallback to network
    static: {
        pattern: /\.(css|js|jpg|jpeg|png|gif|svg|woff2?|ttf|eot)$/i,
        strategy: 'cache-first',
        maxAge: 86400 * 30, // 30 days
    },
    // API/Data: Network first, fallback to cache
    api: {
        pattern: /\/api\//,
        strategy: 'network-first',
        maxAge: 3600, // 1 hour
    },
    // HTML pages: Stale-while-revalidate
    pages: {
        pattern: /\.php$/,
        strategy: 'stale-while-revalidate',
        maxAge: 3600, // 1 hour
    },
};

/**
 * Install event: Pre-cache critical assets
 */
self.addEventListener('install', (event) => {
    console.log('[ServiceWorker] Installing version', CACHE_VERSION);

    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('[ServiceWorker] Pre-caching critical assets');
            return cache.addAll(PRECACHE_ASSETS);
        }).then(() => {
            // Force activation
            return self.skipWaiting();
        })
    );
});

/**
 * Activate event: Clean up old caches
 */
self.addEventListener('activate', (event) => {
    console.log('[ServiceWorker] Activating version', CACHE_VERSION);

    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames
                    .filter((name) => name !== CACHE_NAME)
                    .map((name) => {
                        console.log('[ServiceWorker] Deleting old cache:', name);
                        return caches.delete(name);
                    })
            );
        }).then(() => {
            // Take control of all clients immediately
            return self.clients.claim();
        })
    );
});

/**
 * Fetch event: Apply caching strategies
 */
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);

    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }

    // Skip cross-origin requests
    if (url.origin !== location.origin) {
        return;
    }

    // Skip admin area
    if (url.pathname.includes('/admin/')) {
        return;
    }

    // Determine strategy
    const strategy = getStrategy(request);

    event.respondWith(
        handleRequest(request, strategy)
    );
});

/**
 * Determine caching strategy for request
 */
function getStrategy(request) {
    const url = new URL(request.url);

    for (const [name, config] of Object.entries(CACHE_STRATEGIES)) {
        if (config.pattern.test(url.pathname)) {
            return config;
        }
    }

    // Default: network first
    return {
        strategy: 'network-first',
        maxAge: 3600,
    };
}

/**
 * Handle request based on strategy
 */
async function handleRequest(request, { strategy, maxAge }) {
    switch (strategy) {
        case 'cache-first':
            return cacheFirst(request, maxAge);

        case 'network-first':
            return networkFirst(request, maxAge);

        case 'stale-while-revalidate':
            return staleWhileRevalidate(request, maxAge);

        default:
            return fetch(request);
    }
}

/**
 * Cache-first strategy: Check cache, then network
 * Best for static assets that rarely change
 */
async function cacheFirst(request, maxAge) {
    const cache = await caches.open(CACHE_NAME);
    const cached = await cache.match(request);

    if (cached && !isCacheExpired(cached, maxAge)) {
        return cached;
    }

    try {
        const response = await fetch(request);
        if (response.ok) {
            await cache.put(request, response.clone());
        }
        return response;
    } catch (error) {
        // Return stale cache if network fails
        if (cached) {
            return cached;
        }
        throw error;
    }
}

/**
 * Network-first strategy: Try network, fallback to cache
 * Best for dynamic content
 */
async function networkFirst(request, maxAge) {
    const cache = await caches.open(CACHE_NAME);

    try {
        const response = await fetch(request);
        if (response.ok) {
            await cache.put(request, response.clone());
        }
        return response;
    } catch (error) {
        const cached = await cache.match(request);
        if (cached) {
            return cached;
        }
        throw error;
    }
}

/**
 * Stale-while-revalidate: Return cache immediately, update in background
 * Best for pages that change occasionally
 */
async function staleWhileRevalidate(request, maxAge) {
    const cache = await caches.open(CACHE_NAME);
    const cached = await cache.match(request);

    // Update in background
    const fetchPromise = fetch(request).then((response) => {
        if (response.ok) {
            cache.put(request, response.clone());
        }
        return response;
    });

    // Return cached immediately if available
    return cached || fetchPromise;
}

/**
 * Check if cached response is expired
 */
function isCacheExpired(response, maxAge) {
    const cached = response.headers.get('date');
    if (!cached) {
        return true;
    }

    const cacheTime = new Date(cached).getTime();
    const now = Date.now();
    const age = (now - cacheTime) / 1000;

    return age > maxAge;
}

/**
 * Message handler for cache management
 */
self.addEventListener('message', (event) => {
    if (event.data.action === 'skipWaiting') {
        self.skipWaiting();
    }

    if (event.data.action === 'clearCache') {
        event.waitUntil(
            caches.delete(CACHE_NAME).then(() => {
                console.log('[ServiceWorker] Cache cleared');
            })
        );
    }

    if (event.data.action === 'getCacheSize') {
        event.waitUntil(
            caches.open(CACHE_NAME).then(async (cache) => {
                const keys = await cache.keys();
                const size = keys.length;

                event.ports[0].postMessage({
                    cacheSize: size,
                    cacheName: CACHE_NAME,
                });
            })
        );
    }
});

console.log('[ServiceWorker] Loaded version', CACHE_VERSION);
