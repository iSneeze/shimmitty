<?php

// use local memcached
define('CACHE_DSN', 'memcache://memcached:11211');

// trust X-FORWARDED-FOR Headers from Caddy so Shimmie can see the user's real IP
define("TRUSTED_PROXIES", [ '192.168.0.0/16', '172.16.0.0/12', '10.0.0.0/8', ]);
