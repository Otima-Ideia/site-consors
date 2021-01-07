=== WP Cloudflare Super Page Cache ===
Contributors: salvatorefresta, isaumya
Tags: cloudflare cache, improve speed, improve performance, page caching
Requires at least: 3.0.1
Tested up to: 5.6
Requires PHP: 7.0
Stable tag: 4.3.9.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Speed up a Wordpress website by enabling and managing a page cache on a Cloudflare free plan.

== Description ==

The free Cloudflare plan allows you to enable a page cache by entering the *Cache Everything* rule, greatly improving response times. 

However for dynamic websites such as Wordpress, it is not possible to use this rule without running into problems as it is not possible to exclude critical web pages from the cache, the sessions for logged in users, ajax requests and much more.

**Thanks to this plugin all of this becomes possible.**

You will be able to significantly **improve the response times of your Wordpress website** by taking advantage of the very fast Cloudflare cache also for HTML pages, **saving a lot of bandwidth**. The alternative to this plugin is to purchase and configure the Enterprise plan.

**This plugin is 100% jQuery free and compatible with all versions of Wordpress and all Wordpress themes.** It can also be used in conjunction with other performance plugins - such like [Autoptimize](https://wordpress.org/plugins/autoptimize/) and [LiteSpeed Cache](https://wordpress.org/plugins/litespeed-cache/) - as long as their rules do not interfere with the Cloudflare cache.

If you are using Kinsta as your hosting provider, this plugin works flawlessly with Kinsta's Server Level Caching and this plugin has also been thoroughly tested on Kinsta Servers to ensure it is fully compatible with Kinsta Server Caching.

If you are still hesitant about using this plugin, take a look at the plugin review video below by IdeaSpot, where you can take a quick look on how the plugin works.

[youtube https://www.youtube.com/watch?v=c-U5Nw2xTj8]

== Installation ==

FROM YOUR WORDPRESS DASHBOARD

1. Visit "Plugins" > Add New
2. Search for WP Cloudflare Super Page Cache
3. Activate WP Cloudflare Super Page Cache from your Plugins page.

FROM WORDPRESS.ORG

1. Download WP Cloudflare Super Page Cache
2. Upload the "wp-cloudflare-super-page-cache" directory to your "/wp-content/plugins/" directory, using ftp, sftp, scp etc.
3. Activate WP Cloudflare Super Page Cache from your Plugins page.

== Frequently Asked Questions ==

= How do I know if everything is working properly? =

To verify that everything is working properly, I invite you to check the HTTP response headers of the displayed page in Incognito mode (browse in private). WP Cloudflare Super Page Cache returns two headers:

**x-wp-cf-super-cache**

If its value is **cache**, WP Cloudflare Super Page Cache is active on the displayed page and the page cache is enabled. If **no-cache**, WP Cloudflare Super Page Cache is active but the page cache is disabled for the displayed page.

**x-wp-cf-super-cache-active**

This header is present only if the previous header has the value **cache**.

If its value is **1**, the displayed page should have been placed in the Cloudflare cache.

To find out if the page is returned from the cache, Cloudflare sets its header called **cf-cache-status**. 

If its value is **HIT**, the page has been returned from cache. 

If **MISS**, the page was not found in cache. Refresh the page.

If **BYPASS**, the page was excluded from WP Cloudflare Super Page Cache. 

If **EXPIRED**, the page was cached but the cache has expired.

= Do you allow to bypass the cache for logged in users even on free plan? =

Yes. This is the main purpose of this plugin.

= What is the swcfpc query variabile I see to every internal links when I'm logged in? =

It is a cache buster. Allows you, while logged in, to bypass the Cloudflare cache for pages that could be cached.

= Do you automatically clean up the cache on website changes? =

Yes, you can enable this option from the settings page.

= Can I restore all Cloudflare settings as before the plugin activation? =

Yes, there is a reset button.

= What happens if I delete the plugin? =

I advise you to disable the plugin before deleting it, to allow you to restore all the information on Cloudflare. Then you can proceed with the elimination. This plugin will delete all the data stored into the database so that your Wordpress installation remains clean.

= What happens to the browser caching settings on Cloudflare? =

You will not be able to use them anymore. However, there is an option to enable browser caching rules

= Does it work with multisite? =

Yes but it must be installed separately for each website in the network as each site requires an ad-hoc configuration and may also be part of different Cloudflare accounts.

= Can I use this plugin together with other performance plugins such like Autoptimize, WP Rocket or W3 Total Cache? =

Yes, you can. Read the FAQ section into the settings page for further information

= Something is not working, what can I do? =

Enable the log mode and send me the log file and the steps to reproduce the issue. Make sure you are using the latest version of the plugin.


== Changelog ==

= VERSION 4.3.9.2 (2ST JANUARY 2021) =
* Fix: minor bugs when click on Purge Cache and the option to purge HTML pages only is enabled
* Improvement: improve Litespeed Cache support
* Improvement: option to purge HTML pages only. Now it supports all Wordpress-type posts
* Update: plugin is now 100% PHP 8 compatible
* Update: change the default s-maxage from 604800 (1 week) to 31536000 (1 year)
* Update: better scheduled events management
* Update: default excluded URIs

= VERSION 4.3.9.1 (1ST JANUARY 2021) =
* Fix: PHP fatal error on lines 2830 and 514 of cache_controller.class.php when option to purge HTML pages only is enabled

= VERSION 4.3.9 (31TH DECEMBER 2020) =
* New: option to purge HTML pages only instead of full Cloudflare cache (assets + pages) (Cache tab)
* New: option to auto prefetch URLs in Viewport (Other tab)
* New: support for WP Performance (Third Party tab)
* New: new WP Rocket firing actions (Third Party tab)
* New: purge post Cloudflare cache on Elementor AJAX update (elementor/ajax/register_actions)
* New: option to purge Cloudflare cache for WooCommerce scheduled sales (Third Party tab)
* New: support for Swift Performance Lite (Third Party tab)
* New: automatically add the cache buster for redirects made using wp_redirect PHP function
* New: option to disable cache purging using queue (Cache tab)
* Fix: minor bug when click on reset all
* Improvement: replaced fnmatch with a custom function
* Update: the updated worker script removes certain query parameters (fbclid, fb_action_ids, fb_action_types, fb_source, _ga, age-verified, ao_noptimize, usqp, cn-reloaded, klaviyo, amp, gclid, utm_source, utm_medium, utm_campaign, utm_content, utm_term) from the URL before it handles it

= VERSION 4.3.8 (14TH DECEMBER 2020) =
* New: support for WP Engine hosting provider (beta)
* New: support for SpinupWP hosting provider (beta)
* New: support for Kinsta hosting provider (beta)
* New: support for Siteground SuperCacher (beta)
* New: log verbosity option
* Update: advanced-cache.php (deleted unuseful old code)
* Fix: logged in user getting cached version with the new worker code
* Fix: Undefined index: REQUEST_METHOD when using WP CLI
* Fix: Varnish cache purging on Cloudways

= VERSION 4.3.7.4 (1OTH DECEMBER 2020) =
* Update: removed the option "Bypass cache for the following user agents" 'cause it slow down the TTFB
* Update: new optimized worker code
* Fix: prevent the cache buster to be added for anchor links on the current page

= VERSION 4.3.7.3 =
* Update: load assets on frontend only for users which have permission to purge cache and only if the "Remove purge option from toolbar" is not enabled

= VERSION 4.3.7.2 =
* Fix: looking for existing routes and workers also on CF instead of local database only
* Update: delete the main plugin folder from wp-content on plugin deletion

*IMPORTANT NOTICE!* Due to Cloudflare's change of API for worker management, users who use tokens as authentication will also need to specify the email address of the Cloudflare account used (General tab).

If not, users who manage multiple cloudflare accounts from the same interface may have problems uploading or deleting the worker.

= VERSION 4.3.7.1 =
* Fix: Cloudflare Worker Error 1101
* Fix: the preloader must also be started during manual cache purging if the "Automatically preload the pages you have purged from Cloudflare cache with this plugin" option is enabled
* Fix: added "no-cache" in Cache-Control response header when downloading the log file

= VERSION 4.3.7 =
* New: option to bypass cache for specific user agents in worker mode (Cache tab)
* New: option to bypass cache for specific cookies in worker mode (Cache tab)
* New: option to automatically purge the object cache (Advanced tab)
* New: option to select user roles allowed to purge the cache (Other tab)
* New: option to prevent fallback cache to cache URLs without trailing slash (Cache tab)
* New: support for WP Assets Clean Up Pro (Third Party tab)
* New: support for Nginx Helper (Third Party tab)
* New: cache status icon on admin bar
* New: the plugin is now jQuery free
* New: use the faster typecasting instead of intval
* New: SWCFPC_PURGE_CACHE_CRON_INTERVAL PHP constant to define the interval of the purge cache cronjob (default: 10 seconds)
* New: action "swcfpc_purge_cache" to purge Cloudflare cache programmatically (read FAQ section)
* New: cache-control in Nginx browser caching rules
* Fix: error code 1014 when purging single urls cache
* Fix: show "Purge CF Cache" on frontend admin bar
* Fix: URL on page rule for Wordpress installed in subdirectory
* Fix: Varnish invalid hostname
* Fix: purge whole cache via cronjob
* Fix: IfModule directive when "Strip response cookies on pages that should be cached" option is enabled
* Fix: error fnmatch(): Filename exceeds the maximum allowed length
* Fix: remove s-max-age directive from cache-control response header
* Fix: excluding Wordpress, WooCommerce and EDD API requests from fallback and Cloudflare cache
* Fix: "Prevent the following URIs to be Cached" is automatically getting delete when a single URI is present
* Update: Worker id is now unique
* Update: Updated the worker script massively and written it from the ground up for better performance and uncase handle
* Security: making sure that the debug.log file is not accessible publicly with web server rules

= VERSION 4.3.6 =
* New: import/export configurations
* Fix:  Uncaught Error: [] operator not supported for strings in wp-cloudflare-super-page-cache.php:458

= VERSION 4.3.5 =
* New: purge cache using a fast queue for a better backend performance
* New: support for EDD - Easy Digital Downloads
* Update: turn off autocomplete for Cloudflare API token and API key fields (thanks @alx359)
* Update: bypass cache when DOING_CRON is true (thanks @alx359)
* Update: remove WP_CACHE constant from wp-config.php when uninstalled
* Update: reduce default value of SWCFPC_PRELOADER_MAX_POST_NUMBER to 50
* Fix: disable fallback cache when plugin is deactivated or on reset all
* Fix: Undefined variable in fallback_cache.class.php:570
* Fix: load custom CF worker via PHP constant
* Fix: notice warning on media upload when fallback cache is enabled
* Fix: automatically purge the cache on post edit event only if one of "automatic cache purging" option is enabled
* Fix: new lines at bottom of wp-config.php when fallback cache is enabled
* Fix: bypass fallback cache on WP CLI commands
* Fix: enable or disable fallback cache in real time when the cloudflare one is being enabled or disabled
* Fix: delete worker and route on reset all

= VERSION 4.3.4.3
* Fix: warning on str_replace

= VERSION 4.3.4.2 =
* Fix: Error message: Uncaught Error: [] operator not supported for strings in wp-cloudflare-super-page-cache.php:408

= VERSION 4.3.4.1 =
* Fix: page rule on Cloudflare is deleted when update to 4.3.4. To solve this problem please click on Reset all and enable again the page cache. Sorry for the inconvenience

= VERSION 4.3.4 =
* New: FAQ tab
* New: SWCFPC_CF_WOKER_FULL_PATH PHP constant to define a full path to a custom CF Worker
* New: SWCFPC_CURL_TIMEOUT PHP constant to define the timeout in seconds for cURL calls (default: 10 seconds)
* New: added option to enable/disable Autoptimize support (Third Party tab)
* New: added option to disable cache buster in Worker Mode (Other tab)
* New: added option to skip fallback cache if specific request cookies exist (Cache tab)
* New: added option to save response headers together with HTML code for fallback cache (Cache tab)
* New: added option to automatically purge OPcache when Cloudflare cache is purged (Advanced tab)
* New: CF Worker section under Cache tab
* New: WP CLI support
* New: added option to automatically reset the log file when it exceeded the max file size in MB (Other tab)
* New: merge and collapse options for a better UX (thank you isaumya)
* Fix: tab focus when update settings
* Fix: 403 error on wc-ajax=update_order_review
* Fix: error "The plugin is not detected on your home page..." while testing static resource when clicking Test cache
* Fix: PHP Parse error: syntax error, unexpected (T_STRING) in ttl_registry.php
* Fix: double slashes in assets URIs
* Fix: error "There is not page rule to delete"
* Fix: prevent wp-login.php and wp-register.php pages to be cached by fallback cache
* Fix: preloader operation "Preload last 20 published posts and pages"
* Update: automatic SEO redirect disabled by default
* Update: improved CF worker code
* Update: removed support for Cache Enabler, WP Fastest Cache and WP Super Cache. Use the fallback cache option instead.
* Update: a5hleyrich/wp-background-processing to 1.0.2
* Update: prevent to cache URLs with ao_noptirocket parameters
* Update: transform most of backend.js code from jQuery to Vanilla Javascript for better performance (thank you isaumya)

= VERSION 4.3.3 =
* New: added option to force bypass of whole Wordpress backend with an additional page rule on Cloudflare
* New: WP Asset Clean Up support
* New: start preloader via Cronjob
* Update: force worker to bypass the requests to /wp-admin/ URLs. You need to disable and re-enable the page cache
* Update: moved Varnish options under Advanced tab
* Update: improved test cache
* Fix: cache bypass for edit.php

= VERSION 4.3.2 =
* New: added option to disable the automatic SEO redirect for URLs with cache buster for logged out users
* New: added option to enable or disable Varnish support
* New: added option to exclude some URIs from fallback cache only
* New: added option to enable or disable preloader
* New: preload URLs from sitemaps
* New: tabs for a better UX
* New: more intuitive fallback cache keys
* New: new htaccess rules for cache-control response header
* New: cpu saving by running only one preloading process at once thanks to lock
* Fix: yars fatal error
* Fix: automatically purge fallback cache for edited posts
* Fix: new lines into wp-config.php when enable the fallback cache

Many thanks to Saumya Majumder for the great support and the time passed with me for bug fixing and testing

= VERSION 4.3.1 =
* Fix: error in fallback cache that did not allow the correct form submission

= VERSION 4.3.0 =
* Fix: Increased the timeout for Cloudflare HTTP requests to 10 seconds
* Fix: avoid fallback cache to cache non-GET requests
* Fix: avoid download sensitive information of fallback cache settings files
* New: automatic SEO redirect (301) for all URLs that for any reason have been indexed together with the cache buster

= VERSION 4.2.9 =
* Fix: fatal error when purging cache from Varnish

= VERSION 4.2.8 =
* Fix: drop swcfpc_logs table
* Fix: purge cache in chunks when the related URLs exceed the 30 units
* Fix: prevent preload/purge external URLs

= VERSION 4.2.7 =
* Fix: error on delete source advanced-cache.php

= VERSION 4.2.6 =
* Fix: copy advanced-cache.php

= VERSION 4.2.4 =
* New: Varnish support
* New: Preloading internal links for chosen Wordpress menus
* New: Disable WP-Rocket page cache only without installing third-party addons
* New: WP-Optimize support
* New: Cache Enabler support

= VERSION Version 4.2.2 =
* Fixed PHP Fatal Error for SWCFPC_Cache_Controller::purge_cache_when_comment_is_deleted

= VERSION Version 4.2.1 =
* Merged pro features with free ones

= VERSION Version 4.2 =
* New: page caching via Cloudflare Workers
* New: page caching as fallback to Cloudflare
* New: automatically start the preloader when Cloudflare cache is purged
* New: Yasr support – Yet Another Stars Rating
* Replaced MySQL log table with log file
* Fixed cache preloader
* Automatically log preloader activities
* Show purge cache links to administrators only
* Improved AMP support
* Disable page cache on plugin deactivation instead of resetting all

= VERSION Version 4.1.4 =
* Added an option to automatically purge the whole cache when WP Fastest Cache purges its own cache
* Added an option to automatically purge the whole cache when Hummingbird purges its own cache
* Move the menu inside Settings page

= VERSION Version 4.1.3 =
* Cloudflare has finally solved a bug that allows you to use access tokens with permissions limited to the domain being configured only.
* Added an option to remove purge options from toolbar
* Added an option to disable metaboxes from single pages and posts

= VERSION Version 4.1.2 =
* Added an option to automatically purge cache for WooCommerce product page and related categories when stock quantity changes
* Added an option to automatically purge the whole cache when LiteSpeed Cache purges its own cache

= VERSION Version 4.1.1 =
* Fix javascript error Uncaught TypeError: Cannot read property 'addEventListener' of null

= VERSION Version 4.1 =
* Fix ajax url for Wordpress multisite
* Fix other minor bugs

= VERSION Version 4.0.6 =
* Fixed error Call to undefined function wp_generate_password()

= VERSION Version 4.0.5 =
* Fix other minor bugs

= VERSION Version 4.0.4 =
* Fix bug (cache buster also for not logged in users). Thanks to Tim Marringa

= VERSION Version 4.0.3 =
* Show page actions only if page cache is enabled

= VERSION Version 4.0.2 =
* Fixing default page number for preloader

= VERSION Version 4.0.1 =
* Fast fix for page testing function

= VERSION Version 4.0 =
* Added pages to top-level menu
* New logs page
* Added ability to define some values (API Key, API Token, API Email, API Zone ID, API Subdomain, Cache buster) using PHP constants
* Added a cache preloader
* Added an option to strip response cookies from pages that should be cached
* Now the cache purging is doing via Ajax
* Improved the page cache testing system
* New UX
* Added an option to bypass the cache for POST requests
* Added an option to bypass the cache for requests with query variables (query string)
* Added metabox to exclude single page/post from the cache

= VERSION Version 3.8 =
* Added the ability to use the API tokens instead of the API keys to authenticate with Cloudflare
* Added in the admin toolbar the option to purge the cache for the current page/post only
* Added more debug details
* Added page/post action links to purge the cache for the selected page/post only

= VERSION Version 3.7.2 =
* Fixed a sentence for italian language

= VERSION Version 3.7.1 =
* Added option for automatically purge single post cache when a new comment is inserted into the database or when a comment is approved or deleted

= VERSION Version 3.7 =
* Added options for WP Rocket users
* Added options for W3 Total Cache users
* Added options for WP Super Cache users
* Improve some internal hooks

= VERSION Version 3.6.1 =
* Added options for WooCommerce

= VERSION Version 3.6 =
* Added Nginx support for "Overwrite the cache-control header" option

= VERSION Version 3.5 =
* Added Nginx support
* Italian translation

= VERSION Version 3.4 =
* Fixed notice Undefined index: HTTP_X_REQUESTED_WITH

= OLDER VERSIONS =
Version 1.5   - Added support for WooCommerce, filters and actions
Version 1.6   - Added support for scheduled posts, cronjobs, robots.txt and Yoast sitemaps
Version 1.7   - Little bugs fix
Version 1.7.1 - Fixed little incompatibilities due to swcfpc parameter
Version 1.7.2 - Added other cache exclusion options
Version 1.7.3 - Add support for AMP pages
Version 1.7.6 - Fixed little bugs
Version 1.7.8 - Added support for robots.txt and sitemaps generated by Yoast. Added a link to admin toolbar to purge cache fastly. Added custom header "Wp-cf-super-cache" for debug purposes
Version 1.8 - Solved some incompatibility with WP SES - Thanks to Davide Prevosto
Version 1.8.1 - Added support for other WooCommerce page types and AJAX requests
Version 1.8.4 - Fixed little bugs
Version 1.8.5 - Added support for subdomains
Version 1.8.7 - Prevent 304 response code
Version 2.0 - Database optimization and added support for browser cache-control max-age
Version 2.1 - Fixed warning on line 1200
Version 2.3 - Added support for wildcard URLs
Version 2.4 - Added support for pagination (thanks to Davide Prevosto)
Version 2.5 - Fixed little bugs and added support for Gutenberg editor
Version 2.6 - Auto-purge cache when edit posts/pages using Elementor and fix the warning on purge_cache_on_post_published
Version 2.7 - Fixed a little bug when calling purge_cache_on_post_published
Version 2.8 - Fixed the last warning
Version 3.0 - Improved the UX interface, added browser caching option and added support for htaccess so that it is possible to improve the coexistence of this plugin with other performance plugins.
Version 3.1 - Fixed PHP warning implode() for option Prevent the following urls to be cached
Version 3.2 - Improved cache-control flow via htaccess
Version 3.3 - Fixed missing checks in backend


== Upgrade Notice ==

= Version 4.3.4 =

* Please disable and re-enable the cache after upgrading.

= Version 3.6.1 =

* New update is available.


== Screenshots ==

1. This screen shot description corresponds to screenshot-1.jpg
Step 1 - Enter your Cloudflare's API Key and e-mail 
2. This screen shot description corresponds to screenshot-2.jpg
Step 2 - Select the domain
3. This screen shot description corresponds to screenshot-3.jpg
Step 3 - Enable the page Cache
