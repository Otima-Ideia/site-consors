<?php

defined( 'ABSPATH' ) || die( 'Cheatin&#8217; uh?' );

class SWCFPC_Cache_Controller
{

    private $main_instance = null;

    private $objects;
    
    private $skip_cache = false;
    private $cache_status = "cache";
    private $cache_buster = "swcfpc";
    private $htaccess_path = "";

    function __construct( $cache_buster, $main_instance )
    {

        $this->cache_buster  = $cache_buster;
        $this->main_instance = $main_instance;

        if( !function_exists('get_home_path') )
            require_once ABSPATH . 'wp-admin/includes/file.php';

        $this->htaccess_path = get_home_path().".htaccess";

        $this->actions();
        
    }


    function actions() {

        // Purge cache cronjob
        add_action( 'swcfpc_cache_purge_cron', array($this, 'purge_cache_queue_job') );
        add_filter( 'cron_schedules', array($this, 'purge_cache_queue_custom_interval') );
        add_action( 'shutdown', array($this, 'purge_cache_queue_start_cronjob'), PHP_INT_MAX );

        // SEO redirect for all URLs that for any reason have been indexed together with the cache buster
        if( $this->main_instance->get_single_config("cf_seo_redirect", 1) > 0 ) {
            add_action('init', array($this, 'redirect_301_real_url'), 0);
        }

        add_action( 'wp_footer',    array($this, 'inject_js_code'), PHP_INT_MAX );
        add_action( 'admin_footer', array($this, 'inject_js_code'), PHP_INT_MAX );

        // Ajax preloader start
        add_action( 'wp_ajax_swcfpc_preloader_start', array($this, 'ajax_preloader_start') );

        // Ajax unlock preloader
        add_action( 'wp_ajax_swcfpc_preloader_unlock', array($this, 'ajax_preloader_unlock') );

        // Ajax clear whole cache
        add_action( 'wp_ajax_swcfpc_purge_whole_cache', array($this, 'ajax_purge_whole_cache') );

        // Ajax clear single post cache
        add_action( 'wp_ajax_swcfpc_purge_whole_cache', array($this, 'ajax_purge_single_post_cache') );

        // Ajax reset all
        add_action( 'wp_ajax_swcfpc_reset_all', array($this, 'ajax_reset_all') );

        add_action( 'init', array( $this, 'force_bypass_for_logged_in_users' ), PHP_INT_MAX );

        // This sets response headers for backend
        add_action( 'init', array($this, 'setup_response_headers_backend'), 0 );

        // These set response headers for frontend
        add_action( 'send_headers', array($this, 'bypass_cache_on_init'), PHP_INT_MAX );
        add_action( 'template_redirect', array($this, 'apply_cache'), PHP_INT_MAX );

        // Purge cache via cronjob
        add_action( 'init', array($this, 'cronjob_purge_cache') );

        // Start preloader via cronjob
        add_action( 'init', array($this, 'cronjob_preloader') );

        // W3TC actions
        add_action( 'w3tc_flush_dbcache',       array($this, 'w3tc_hooks'), PHP_INT_MAX );
        add_action( 'w3tc_flush_all',           array($this, 'w3tc_hooks'), PHP_INT_MAX );
        add_action( 'w3tc_flush_fragmentcache', array($this, 'w3tc_hooks'), PHP_INT_MAX );
        add_action( 'w3tc_flush_objectcache',   array($this, 'w3tc_hooks'), PHP_INT_MAX );
        add_action( 'w3tc_flush_posts',         array($this, 'w3tc_hooks'), PHP_INT_MAX );
        add_action( 'w3tc_flush_post',          array($this, 'w3tc_hooks'), PHP_INT_MAX );
        add_action( 'w3tc_flush_minify',        array($this, 'w3tc_hooks'), PHP_INT_MAX );

        // WP-Optimize actions
        add_action( 'wpo_cache_flush',   array($this, 'wpo_hooks'), PHP_INT_MAX );

        // WP Rocket actions
        add_action( 'after_rocket_clean_post',   array($this, 'wp_rocket_hooks'), PHP_INT_MAX );
        add_action( 'after_rocket_clean_domain', array($this, 'wp_rocket_hooks'), PHP_INT_MAX );
        add_action( 'admin_init',                array($this, 'wp_rocket_disable_page_cache'), PHP_INT_MAX );

        // LiteSpeed actions
        add_action( 'litespeed_purged_all',   array($this, 'litespeed_hooks'), PHP_INT_MAX );

        // Hummingbird actions
        add_action( 'wphb_clear_cache_url', array($this, 'hummingbird_hooks'), PHP_INT_MAX );

        // Woocommerce actions
        add_action( 'woocommerce_updated_product_stock', array($this, 'woocommerce_purge_product_page_on_stock_change'), PHP_INT_MAX, 1 );

        // Edd actions
        add_action( 'edd_insert_payment', array($this, 'edd_purge_cache_on_payment_add', PHP_INT_MAX, 2) );

        // YASR actions
        add_action( 'yasr_action_on_overall_rating', array($this, 'yasr_hooks'), PHP_INT_MAX, 2 );
        add_action( 'yasr_action_on_visitor_vote', array($this, 'yasr_hooks'), PHP_INT_MAX, 2 );

        // WP Asset Clean Up actions
        add_action( 'wpacu_clear_cache_after', array($this, 'wpacu_hooks'), PHP_INT_MAX );

        // Autoptimize actions
        add_action( 'autoptimize_action_cachepurged', array($this, 'autoptimize_hooks'), PHP_INT_MAX );

        // Purge cache on comments
        add_action( 'transition_comment_status', array($this, 'purge_cache_when_comment_is_approved'), PHP_INT_MAX, 3 );
        add_action( 'comment_post',              array($this, 'purge_cache_when_new_comment_is_added'), PHP_INT_MAX, 3 );
        add_action( 'delete_comment',            array($this, 'purge_cache_when_comment_is_deleted'), PHP_INT_MAX );


        $purge_actions = array(
            'wp_update_nav_menu',                                     // When a custom menu is updated
            'update_option_theme_mods_' . get_option( 'stylesheet' ), // When any theme modifications are updated
            'avada_clear_dynamic_css_cache',                          // When Avada theme purge its own cache
            'switch_theme',                                           // When user changes the theme
            'customize_save_after',                                   // Edit theme
            'permalink_structure_changed',                            // When permalink structure is update
        );

        foreach ($purge_actions as $action) {
            add_action( $action, array($this, 'purge_cache_on_theme_edit'), PHP_INT_MAX );
        }

        $purge_actions = array(
            'deleted_post',                     // Delete a post
            'wp_trash_post',                    // Before a post is sent to the Trash
            'clean_post_cache',                 // After a post’s cache is cleaned
            'edit_post',                        // Edit a post - includes leaving comments
            'delete_attachment',                // Delete an attachment - includes re-uploading
            'elementor/editor/after_save',      // Elementor edit
            'elementor/core/files/clear_cache', // Elementor clear cache
        );

        foreach ($purge_actions as $action) {
            add_action( $action, array($this, 'purge_cache_on_post_edit'), PHP_INT_MAX, 2 );
        }

        add_action( 'transition_post_status', array($this, 'purge_cache_when_post_is_published'), PHP_INT_MAX, 3 );

        // Metabox
        if( $this->main_instance->get_single_config("cf_disable_single_metabox", 0) == 0 ) {
            add_action('add_meta_boxes', array($this, 'add_metaboxes'), PHP_INT_MAX);
            add_action('save_post', array($this, 'swcfpc_cache_mbox_save_values'), PHP_INT_MAX);
        }

        // Ajax enable page cache
        add_action( 'wp_ajax_swcfpc_enable_page_cache', array($this, 'ajax_enable_page_cache') );

        // Ajax disable page cache
        add_action( 'wp_ajax_swcfpc_disable_page_cache', array($this, 'ajax_disable_page_cache') );

    }


    function wp_rocket_disable_page_cache() {

        // Disable page caching in WP Rocket
        if( $this->main_instance->get_single_config("cf_wp_rocket_disable_cache", 0) > 0 && $this->is_cache_enabled() ) {
            add_filter( 'do_rocket_generate_caching_files', '__return_false', PHP_INT_MAX );
        }

    }


    function get_cache_buster() {

        return $this->cache_buster;

    }


    function add_metaboxes() {

        add_meta_box(
            'swcfpc_cache_mbox',
            __('Cloudflare Page Cache Settings', 'wp-cloudflare-page-cache'),
            array($this, 'swcfpc_cache_mbox_callback'),
            array("post", "page"),
            'side'
        );

    }


    function swcfpc_cache_mbox_callback($post) {

        $bypass_cache = intval( get_post_meta( $post->ID, "swcfpc_bypass_cache", true ) );

        ?>

        <label for="swcfpc_bypass_cache"><?php _e('Bypass the cache for this page', 'wp-cloudflare-page-cache'); ?></label>
        <select name="swcfpc_bypass_cache">
            <option value="0" <?php if($bypass_cache == 0) echo "selected"; ?>><?php _e('No', 'wp-cloudflare-page-cache'); ?></option>
            <option value="1" <?php if($bypass_cache == 1) echo "selected"; ?>><?php _e('Yes', 'wp-cloudflare-page-cache'); ?></option>
        </select>

        <?php

    }


    function swcfpc_cache_mbox_save_values($post_id) {

        if( array_key_exists('swcfpc_bypass_cache', $_POST) ) {
            update_post_meta( $post_id, 'swcfpc_bypass_cache', $_POST['swcfpc_bypass_cache'] );
        }

    }


    function force_bypass_for_logged_in_users() {

        if( !function_exists('is_user_logged_in') ) {
            include_once( ABSPATH . "wp-includes/pluggable.php" );
        }

        if ( is_user_logged_in() && $this->is_cache_enabled() ) {
            add_action( 'wp_footer', array( $this, 'inject_js_code' ), 100 );
            add_action( 'admin_footer', array( $this, 'inject_js_code' ), 100 );
        }

    }


    function redirect_301_real_url() {

        if( !is_user_logged_in() && isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0 && strpos( $_SERVER['QUERY_STRING'], $this->get_cache_buster() ) !== false ) {

            // Build the full URL
            $parts = parse_url( home_url() );
            $current_uri = "{$parts['scheme']}://{$parts['host']}" . add_query_arg(NULL, NULL);

            // Strip out the cache buster
            $parsed = parse_url($current_uri);
            $query_string = $parsed['query'];

            parse_str($query_string, $params);

            unset($params[ $this->get_cache_buster() ]);
            $query_string = http_build_query($params);

            // Rebuild the full URL without the cache buster
            $current_uri = "{$parts['scheme']}://{$parts['host']}";

            if( isset($parsed['path']) )
                $current_uri .= $parsed['path'];

            if( strlen($query_string) > 0 )
                $current_uri .= "?".$query_string;

            // SEO redirect
            wp_redirect( $current_uri, 301 );
            die();

        }


    }


    function setup_response_headers_backend() {

        if( !is_admin() )
            return;

        $this->objects = $this->main_instance->get_objects();

        if( ! $this->is_cache_enabled() ) {

            $this->objects["fallback_cache"]->fallback_cache_disable();

            add_filter('nocache_headers', function() {

                return array(
                    "X-WP-CF-Super-Cache" => "disabled"
                );

            }, PHP_INT_MAX);

        }
        else if( $this->is_url_to_bypass() || $this->can_i_bypass_cache() ) {

            $this->objects["fallback_cache"]->fallback_cache_disable();

            add_filter('nocache_headers', function() {

                return array(
                    "Cache-Control" => "no-store, no-cache, must-revalidate, max-age=0",
                    "X-WP-CF-Super-Cache-Cache-Control" => "no-store, no-cache, must-revalidate, max-age=0",
                    "X-WP-CF-Super-Cache" => "no-cache",
                    "Pragma" => "no-cache",
                    "Expires" => gmdate('D, d M Y H:i:s \G\M\T', time())
                );

            }, PHP_INT_MAX);

        }
        else {

            $this->objects["fallback_cache"]->fallback_cache_enable();

            add_filter('nocache_headers', function() {

                return array(
                    "Cache-Control" => $this->get_cache_control_value(), // Used by Cloudflare
                    "X-WP-CF-Super-Cache-Cache-Control" => $this->get_cache_control_value(), // Used by all
                    "X-WP-CF-Super-Cache-Active" => "1", // Used by CF Worker
                    "X-WP-CF-Super-Cache" => "cache"
                );

            }, PHP_INT_MAX);

        }

    }


    function bypass_cache_on_init() {

        if( is_admin() )
            return;

        $this->objects = $this->main_instance->get_objects();

        if( ! $this->is_cache_enabled() ) {
            header("X-WP-CF-Super-Cache: disabled");
            $this->objects["fallback_cache"]->fallback_cache_disable();
            return;
        }

        if( $this->skip_cache )
            return;

        header_remove('Pragma');
        header_remove('Expires');
        header_remove('Cache-Control');

        if( $this->is_url_to_bypass() ) {
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Pragma: no-cache");
            header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time()));
            header("X-WP-CF-Super-Cache: no-cache");
            header('X-WP-CF-Super-Cache-Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            $this->skip_cache = true;
            $this->objects["fallback_cache"]->fallback_cache_disable();
            return;
        }

        if( $this->is_cache_enabled() )
            $this->objects["fallback_cache"]->fallback_cache_enable();

    }


    function apply_cache() {

        if( is_admin() )
            return;

        $this->objects = $this->main_instance->get_objects();

        if( ! $this->is_cache_enabled() ) {
            header("X-WP-CF-Super-Cache: disabled");
            header('X-WP-CF-Super-Cache-Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            $this->objects["fallback_cache"]->fallback_cache_disable();
            return;
        }

        if( $this->skip_cache ) {
            return;
        }

        if ( $this->can_i_bypass_cache() ) {
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Pragma: no-cache");
            header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time()));
            header("X-WP-CF-Super-Cache: no-cache");
            header('X-WP-CF-Super-Cache-Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            $this->objects["fallback_cache"]->fallback_cache_disable();
            return;
        }

        if( $this->main_instance->get_single_config("cf_strip_cookies", 0) > 0 ) {
            header_remove('Set-Cookie');
        }

        header_remove('Pragma');
        header_remove('Expires');
        header_remove('Cache-Control');
        header('Cache-Control: '.$this->get_cache_control_value());
        header("X-WP-CF-Super-Cache: cache");
        header("X-WP-CF-Super-Cache-Active: 1");
        header('X-WP-CF-Super-Cache-Cache-Control: '.$this->get_cache_control_value());

        if( $this->is_cache_enabled() )
            $this->objects["fallback_cache"]->fallback_cache_enable();

    }


    function purge_all($disable_preloader=false, $queue_mode=true) {

        $this->objects = $this->main_instance->get_objects();
        $error = "";

        if( $queue_mode ) {

            $this->purge_cache_queue_write(array(), true);

        }
        else {

            if (!$this->objects["cloudflare"]->purge_cache($error)) {
                $this->objects["logs"]->add_log("cache_controller::purge_all", "Unable to purge the whole Cloudlare cache due to error: " . $error);
                return false;
            }

            if ($this->main_instance->get_single_config("cf_varnish_support", 0) > 0 && $this->main_instance->get_single_config("cf_varnish_auto_purge", 0) > 0)
                $this->objects["varnish"]->purge_whole_cache($error);

            if ($this->main_instance->get_single_config("cf_fallback_cache", 0) > 0 && $this->main_instance->get_single_config("cf_fallback_cache_auto_purge", 0) > 0)
                $this->objects["fallback_cache"]->fallback_cache_purge_all();

            if ($this->main_instance->get_single_config("cf_opcache_purge_on_flush", 0) > 0)
                $this->purge_opcache();

            if ($disable_preloader === false && $this->main_instance->get_single_config("cf_preloader", 1) > 0 && $this->main_instance->get_single_config("cf_preloader_start_on_purge", 0) > 0)
                $this->start_preloader_for_all_urls();

            $this->objects["logs"]->add_log("cache_controller::purge_all", "Purge whole Cloudflare cache");

            do_action("swcfpc_purge_all");

        }

        return true;

    }


    function purge_urls( $urls, $queue_mode=true ) {

        if( !is_array($urls) )
            return false;

        $this->objects = $this->main_instance->get_objects();
        $error = "";

        // Strip out external links or invalid URLs
        foreach( $urls as $array_index => $single_url ) {

            if( $this->is_external_link($single_url) || substr( strtolower($single_url), 0, 4) != "http" )
                unset($urls[$array_index]);

        }

        if( $queue_mode ) {

            $this->purge_cache_queue_write( $urls );

        }
        else {

            if (!$this->objects["cloudflare"]->purge_cache_urls($urls, $error)) {
                $this->objects["logs"]->add_log("cache_controller::purge_urls", "Unable to purge some URLs from Cloudlare due to error: " . $error);
                return false;
            }

            if ($this->main_instance->get_single_config("cf_varnish_support", 0) > 0 && $this->main_instance->get_single_config("cf_varnish_auto_purge", 0) > 0)
                $this->objects["varnish"]->purge_urls($urls);

            if ($this->main_instance->get_single_config("cf_fallback_cache", 0) > 0 && $this->main_instance->get_single_config("cf_fallback_cache_auto_purge", 0) > 0)
                $this->objects["fallback_cache"]->fallback_cache_purge_urls($urls);

            if ($this->main_instance->get_single_config("cf_opcache_purge_on_flush", 0) > 0)
                $this->purge_opcache();

            if ($this->main_instance->get_single_config("cf_preloader", 1) > 0 && $this->main_instance->get_single_config("cf_preloader_start_on_purge", 0) > 0)
                $this->start_cache_preloader_for_specific_urls($urls);

            //$this->unlock_cache_purge();

            $this->objects["logs"]->add_log("cache_controller::purge_urls", "Purge whole Cloudflare cache");

            do_action("swcfpc_purge_urls");

        }

        return true;

    }


    function cronjob_purge_cache() {

        if( $this->is_cache_enabled() && isset($_GET[$this->cache_buster]) && isset($_GET['swcfpc-purge-all']) && $_GET['swcfpc-purge-all'] == $this->main_instance->get_single_config("cf_purge_url_secret_key", wp_generate_password(20, false, false)) ) {

            $this->objects = $this->main_instance->get_objects();
            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::cronjob_purge_cache", "Purge whole Cloudflare cache" );

            die("Cache purged");

        }

    }


    function cronjob_preloader() {

        if( isset($_GET[$this->cache_buster]) && isset($_GET['swcfpc-preloader']) && $_GET['swcfpc-sec-key'] == $this->main_instance->get_single_config("cf_preloader_url_secret_key", wp_generate_password(20, false, false)) && $this->main_instance->get_single_config("cf_preloader", 1) > 0 ) {

            $this->start_preloader_for_all_urls();
            $this->objects = $this->main_instance->get_objects();
            $this->objects["logs"]->add_log("cache_controller::cronjob_preloader", "Preloader started" );

            die("Preloader started");

        }

    }


    function purge_cache_when_comment_is_approved($new_status, $old_status, $comment) {

        if( $this->main_instance->get_single_config("cf_auto_purge_on_comments", 0) > 0 && $this->is_cache_enabled() ) {

            if ($old_status != $new_status && $new_status == 'approved') {

                $this->objects = $this->main_instance->get_objects();
                $urls = array();

                $urls[] = get_permalink($comment->comment_post_ID);

                $this->purge_urls( $urls );

                $this->objects["logs"]->add_log("cache_controller::purge_cache_when_comment_is_approved", "Purge Cloudflare cache for only post ".$comment->comment_post_ID );

            }

        }

    }


    function purge_cache_when_new_comment_is_added( $comment_ID, $comment_approved, $commentdata ) {

        if( $this->main_instance->get_single_config("cf_auto_purge_on_comments", 0) > 0 && $this->is_cache_enabled() ) {

            if (isset($commentdata['comment_post_ID'])) {

                $this->objects = $this->main_instance->get_objects();

                $error = "";
                $urls = array();

                $urls[] = get_permalink($commentdata['comment_post_ID']);

                $this->purge_urls( $urls );

                $this->objects["logs"]->add_log("cache_controller::purge_cache_when_new_comment_is_added", "Purge Cloudflare cache for only post ".$commentdata['comment_post_ID'] );

            }

        }

    }


    function purge_cache_when_comment_is_deleted( $comment_ID ) {

        if( $this->main_instance->get_single_config("cf_auto_purge_on_comments", 0) > 0 && $this->is_cache_enabled() ) {

            $this->objects = $this->main_instance->get_objects();
            $urls    = array();

            $comment = get_comment( $comment_ID );
            $urls[]  = get_permalink($comment->comment_post_ID);

            $this->purge_urls( $urls );

            $this->objects["logs"]->add_log("cache_controller::purge_cache_when_comment_is_deleted", "Purge Cloudflare cache for only post $comment->comment_post_ID" );

        }

    }


    function purge_cache_when_post_is_published( $new_status, $old_status, $post ) {

        if( ($this->main_instance->get_single_config("cf_auto_purge", 0) > 0 || $this->main_instance->get_single_config("cf_auto_purge_all", 0) > 0) && $this->is_cache_enabled() ) {

            if ($old_status != 'publish' && $new_status == 'publish') {

                $this->objects = $this->main_instance->get_objects();

                if ($this->main_instance->get_single_config("cf_auto_purge_all", 0) > 0) {

                    $this->purge_all();
                    $this->objects["logs"]->add_log("cache_controller::purge_cache_when_post_is_published", "Purge whole Cloudflare cache");

                } else {

                    $urls = $this->get_post_related_links($post->ID);

                    $this->purge_urls($urls);
                    $this->objects["logs"]->add_log("cache_controller::purge_cache_when_post_is_published", "Purge Cloudflare cache for only post id $post->ID and related contents");

                }

            }

        }

    }


    function purge_cache_on_post_edit( $postId ) {

        if( ($this->main_instance->get_single_config("cf_auto_purge", 0) > 0 || $this->main_instance->get_single_config("cf_auto_purge_all", 0) > 0) && $this->is_cache_enabled() ) {

            $this->objects = $this->main_instance->get_objects();

            $error = "";

            $validPostStatus = array('publish', 'trash');
            $thisPostStatus = get_post_status($postId);

            if (get_permalink($postId) != true || !in_array($thisPostStatus, $validPostStatus)) {
                return;
            }

            if (is_int(wp_is_post_autosave($postId)) || is_int(wp_is_post_revision($postId))) {
                return;
            }

            if ($this->main_instance->get_single_config("cf_auto_purge_all", 0) > 0) {
                $this->purge_all();
                return;
            }

            $savedPost = get_post($postId);

            if (is_a($savedPost, 'WP_Post') == false) {
                return;
            }

            $urls = $this->get_post_related_links($postId);

            $this->purge_urls($urls);
            $this->objects["logs"]->add_log("cache_controller::purge_cache_on_post_edit", "Purge Cloudflare cache for only post id $postId and related contents");

        }

    }


    function purge_cache_on_theme_edit() {

        if( ($this->main_instance->get_single_config("cf_auto_purge", 0) > 0 || $this->main_instance->get_single_config("cf_auto_purge_all", 0) > 0) && $this->is_cache_enabled() ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::purge_cache_on_theme_edit", "Purge whole Cloudflare cache" );

        }

    }


    function get_post_related_links($postId) {

        $this->objects = $this->main_instance->get_objects();

        $listofurls = array();
        $postType = get_post_type($postId);

        //Purge taxonomies terms URLs
        $postTypeTaxonomies = get_object_taxonomies($postType);

        foreach ($postTypeTaxonomies as $taxonomy) {
            $terms = get_the_terms($postId, $taxonomy);

            if (empty($terms) || is_wp_error($terms)) {
                continue;
            }

            foreach ($terms as $term) {

                $termLink = get_term_link($term);

                if (!is_wp_error($termLink)) {

                    array_push($listofurls, $termLink);

                    if( $this->main_instance->get_single_config("cf_post_per_page", 0) > 0 ) {

                        // Thanks to Davide Prevosto for the suggest
                        $term_count   = $term->count;
                        $pages_number = ceil($term_count / $this->main_instance->get_single_config("cf_post_per_page", 0) );
                        $max_pages    = $pages_number > 10 ? 10 : $pages_number; // Purge max 10 pages

                        for ($i=2; $i<=$max_pages; $i++) {
                            $paginated_url = $termLink . 'page/' . user_trailingslashit($i);
                            array_push($listofurls, $paginated_url);
                        }

                    }

                }

            }

        }

        // Author URL
        array_push(
            $listofurls,
            get_author_posts_url(get_post_field('post_author', $postId)),
            get_author_feed_link(get_post_field('post_author', $postId))
        );

        // Archives and their feeds
        if (get_post_type_archive_link($postType) == true) {
            array_push(
                $listofurls,
                get_post_type_archive_link($postType),
                get_post_type_archive_feed_link($postType)
            );
        }

        // Post URL
        array_push($listofurls, get_permalink($postId));

        // Also clean URL for trashed post.
        if (get_post_status($postId) == 'trash') {
            $trashPost = get_permalink($postId);
            $trashPost = str_replace('__trashed', '', $trashPost);
            array_push($listofurls, $trashPost, $trashPost.'feed/');
        }

        // Feeds
        /*
        array_push(
            $listofurls,
            get_bloginfo_rss('rdf_url'),
            get_bloginfo_rss('rss_url'),
            get_bloginfo_rss('rss2_url'),
            get_bloginfo_rss('atom_url'),
            get_bloginfo_rss('comments_rss2_url'),
            get_post_comments_feed_link($postId)
        );
        */

        // Home Page and (if used) posts page
        array_push($listofurls, home_url('/'));
        $pageLink = get_permalink(get_option('page_for_posts'));
        if (is_string($pageLink) && !empty($pageLink) && get_option('show_on_front') == 'page') {
            array_push($listofurls, $pageLink);
        }

        // Purge https and http URLs
        /*
        if (function_exists('force_ssl_admin') && force_ssl_admin()) {
            $listofurls = array_merge($listofurls, str_replace('https://', 'http://', $listofurls));
        } elseif (!is_ssl() && function_exists('force_ssl_content') && force_ssl_content()) {
            $listofurls = array_merge($listofurls, str_replace('http://', 'https://', $listofurls));
        }
        */

        return $listofurls;
    }


    function reset_all() {

        $this->objects = $this->main_instance->get_objects();
        $error = "";

        // Purge all caches and prevent preloader to start
        $this->purge_all( true, false );

        // Reset old browser cache TTL
        $this->objects["cloudflare"]->change_browser_cache_ttl( $this->main_instance->get_single_config("cf_old_bc_ttl", 0), $error );

        // Delete worker and route
        if( $this->main_instance->get_single_config("cf_woker_enabled", 0) > 0 ) {

            $this->objects["cloudflare"]->worker_delete($error);

            if( $this->main_instance->get_single_config("cf_woker_route_id", "") != "" ) {
                $this->objects["cloudflare"]->worker_route_delete($error);
            }

        }

        // Delete the page rule
        if( $this->main_instance->get_single_config("cf_page_rule_id", "") != "" ) {
            $this->objects["cloudflare"]->delete_page_rule($this->main_instance->get_single_config("cf_page_rule_id", ""), $error);
        }

        // Delete additional page rule if exists
        if( $this->main_instance->get_single_config("cf_bypass_backend_page_rule_id", "") != "" ) {
            $this->objects["cloudflare"]->delete_page_rule( $this->main_instance->get_single_config("cf_bypass_backend_page_rule_id", ""), $error );
        }

        // Disable fallback cache
        if( defined('SWCFPC_ADVANCED_CACHE') ) {
            $this->objects["fallback_cache"]->fallback_cache_advanced_cache_disable();
        }

        // Restore default plugin config
        $this->main_instance->set_config( $this->main_instance->get_default_config() );
        $this->main_instance->update_config();

        // Delete all htaccess rules
        $this->reset_htaccess();

        // Unschedule purge cache cron
        $timestamp = wp_next_scheduled( 'swcfpc_cache_purge_cron' );
        wp_unschedule_event( $timestamp, 'swcfpc_cache_purge_cron' );

        // Reset log
        $this->objects["logs"]->reset_log();
        $this->objects["logs"]->add_log("cache_controller::reset_all", "Reset complete" );

    }


    function inject_js_code() {

        if( !$this->is_cache_enabled() )
            return;

        if( !is_user_logged_in() )
            return;

        $this->objects = $this->main_instance->get_objects();

        // You can disable the cache buster only in worker mode
        if( $this->main_instance->get_single_config("cf_disable_cache_buster", 0) > 0 && $this->main_instance->get_single_config("cf_woker_enabled", 0) > 0 )
            return;

        $selectors = "a";

        if( is_admin() )
            $selectors = "#wp-admin-bar-my-sites-list a, #wp-admin-bar-site-name a, #wp-admin-bar-view-site a, #wp-admin-bar-view a, .row-actions a, .preview, #sample-permalink a, #message a, #editor .is-link, #editor .editor-post-preview, #editor .editor-post-permalink__link";

        ?>

        <script id="swcfpc" data-cfasync="false">

            function swcfpc_adjust_internal_links( selectors_txt ) {

                var comp = new RegExp(location.host);

                [].forEach.call(document.querySelectorAll( selectors_txt ), function(el) {

                    if( comp.test( el.href ) && !el.href.includes("<?php echo $this->cache_buster; ?>=1") ) {

                        if( el.href.indexOf('#') != -1 ) {

                            var link_split = el.href.split("#");
                            el.href = link_split[0];
                            el.href += (el.href.indexOf('?') != -1 ? "&<?php echo $this->cache_buster; ?>=1" : "?<?php echo $this->cache_buster; ?>=1");
                            el.href += "#"+link_split[1];

                        }
                        else {
                            el.href += (el.href.indexOf('?') != -1 ? "&<?php echo $this->cache_buster; ?>=1" : "?<?php echo $this->cache_buster; ?>=1");
                        }

                    }

                });

            }

            document.addEventListener("DOMContentLoaded", function() {

                swcfpc_adjust_internal_links("<?php echo $selectors; ?>");

            });

            window.addEventListener("load", function() {

                swcfpc_adjust_internal_links("<?php echo $selectors; ?>");

            });

            setInterval(function(){ swcfpc_adjust_internal_links("<?php echo $selectors; ?>"); }, 3000);


            // Looking for dynamic link added after clicking on Pusblish/Update button
            var swcfpc_wordpress_btn_publish = document.querySelector(".editor-post-publish-button__button");

            if( swcfpc_wordpress_btn_publish !== undefined && swcfpc_wordpress_btn_publish !== null ) {

                swcfpc_wordpress_btn_publish.addEventListener('click', function() {

                    var swcfpc_wordpress_edited_post_interval = setInterval(function() {

                        var swcfpc_wordpress_edited_post_link = document.querySelector(".components-snackbar__action");

                        if( swcfpc_wordpress_edited_post_link !== undefined ) {
                            swcfpc_adjust_internal_links(".components-snackbar__action");
                            clearInterval(swcfpc_wordpress_edited_post_link);
                        }

                    }, 100);

                }, false);

            }

        </script>

        <?php

    }


    function is_url_to_bypass() {

        $this->objects = $this->main_instance->get_objects();

        // Bypass AMP
        if( $this->main_instance->get_single_config("cf_bypass_amp", 0) > 0 && preg_match("/(\/amp\/page\/[0-9]*)|(\/amp\/?)/", $_SERVER['REQUEST_URI']) ) {
            return true;
        }

        // Bypass sitemap
        if( $this->main_instance->get_single_config("cf_bypass_sitemap", 0) > 0 && strcasecmp($_SERVER['REQUEST_URI'], "/sitemap_index.xml") == 0 || preg_match("/[a-zA-Z0-9]-sitemap.xml$/", $_SERVER['REQUEST_URI']) ) {
            return true;
        }

        // Bypass robots.txt
        if( $this->main_instance->get_single_config("cf_bypass_file_robots", 0) > 0 && preg_match("/^\/robots.txt/", $_SERVER['REQUEST_URI']) ) {
            return true;
        }

        // Bypass the cache on excluded URLs
        $excluded_urls = $this->main_instance->get_single_config("cf_excluded_urls", array());

        if( is_array($excluded_urls) && count($excluded_urls) > 0 ) {

            $current_url = $_SERVER['REQUEST_URI'];

            if( isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0 )
                $current_url .= "?".$_SERVER['QUERY_STRING'];

            foreach( $excluded_urls as $url_to_exclude ) {

                if( fnmatch($url_to_exclude, $current_url, FNM_CASEFOLD) ) {
                    return true;
                }

            }

        }

        if( isset($_GET[$this->cache_buster]) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') || (defined('DOING_AJAX') && DOING_AJAX) || (defined( 'DOING_CRON' ) && DOING_CRON) ) {
            return true;
        }

        if( in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) )
            return true;

        return false;

    }


    function can_i_bypass_cache() {

        global $post;

        $this->objects = $this->main_instance->get_objects();

        // Bypass the cache using filter
        if( has_filter('swcfpc_cache_bypass') ) {

            $cache_bypass = apply_filters('swcfpc_cache_bypass', false);

            if( $cache_bypass === true )
                return true;

        }

        // Bypass single post by metabox
        if( $this->main_instance->get_single_config("cf_disable_single_metabox", 0) == 0 && is_object($post) && intval( get_post_meta( $post->ID, "swcfpc_bypass_cache", true ) ) > 0 ) {
            return true;
        }

        // Bypass requests with query var
        if( $this->main_instance->get_single_config("cf_bypass_query_var", 0) > 0 && isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0 ) {
            return true;
        }

        // Bypass POST requests
        if( $this->main_instance->get_single_config("cf_bypass_post", 0) > 0 && isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" ) {
            return true;
        }

        // Bypass AJAX requests
        if( $this->main_instance->get_single_config("cf_bypass_ajax", 0) > 0 ) {

            if( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) {
                return true;
            }

            if( function_exists( 'is_ajax' ) && is_ajax() ) {
                return true;
            }

            if( (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') || (defined('DOING_AJAX') && DOING_AJAX) ) {
                return true;
            }

        }

        // Bypass EDD pages
        if( is_object($post) && $this->main_instance->get_single_config("cf_bypass_edd_checkout_page", 0) > 0 && function_exists( 'edd_get_option' ) && edd_get_option('purchase_page', 0) == $post->ID ) {
            return true;
        }

        if( is_object($post) && $this->main_instance->get_single_config("cf_bypass_edd_success_page", 0) > 0 && function_exists( 'edd_get_option' ) && edd_get_option('success_page', 0) == $post->ID ) {
            return true;
        }

        if( is_object($post) && $this->main_instance->get_single_config("cf_bypass_edd_failure_page", 0) > 0 && function_exists( 'edd_get_option' ) && edd_get_option('failure_page', 0) == $post->ID ) {
            return true;
        }

        if( is_object($post) && $this->main_instance->get_single_config("cf_bypass_edd_purchase_history_page", 0) > 0 && function_exists( 'edd_get_option' ) && edd_get_option('purchase_history_page', 0) == $post->ID ) {
            return true;
        }

        if( is_object($post) && $this->main_instance->get_single_config("cf_bypass_edd_login_redirect_page", 0) > 0 && function_exists( 'edd_get_option' ) && edd_get_option('login_redirect_page', 0) == $post->ID ) {
            return true;
        }

        // Bypass WooCommerce pages
        if( $this->main_instance->get_single_config("cf_bypass_woo_cart_page", 0) > 0 && function_exists( 'is_cart' ) && is_cart() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_woo_checkout_page", 0) > 0 && function_exists( 'is_checkout' ) && is_checkout() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_woo_checkout_pay_page", 0) > 0 && function_exists( 'is_checkout_pay_page' ) && is_checkout_pay_page() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_woo_shop_page", 0) > 0 && function_exists( 'is_shop' ) && is_shop() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_woo_product_page", 0) > 0 && function_exists( 'is_product' ) && is_product() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_woo_product_cat_page", 0) > 0 && function_exists( 'is_product_category' ) && is_product_category() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_woo_product_tag_page", 0) > 0 && function_exists( 'is_product_tag' ) && is_product_tag() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_woo_product_tax_page", 0) > 0 && function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_woo_pages", 0) > 0 && function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
            return true;
        }


        // Bypass Wordpress pages
        if( $this->main_instance->get_single_config("cf_bypass_front_page", 0) > 0 && is_front_page() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_pages", 0) > 0 && is_page() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_home", 0) > 0 && is_home() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_archives", 0) > 0 && is_archive() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_tags", 0) > 0 && is_tag() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_category", 0) > 0 && is_category() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_feeds", 0) > 0 && is_feed() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_search_pages", 0) > 0 && is_search() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_author_pages", 0) > 0 && is_author() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_single_post", 0) > 0 && is_single() ) {
            return true;
        }


        if( $this->main_instance->get_single_config("cf_bypass_404", 0) > 0 && is_404() ) {
            return true;
        }


        /*
        if( $this->main_instance->get_single_config("cf_bypass_logged_in", 0) > 0 && is_user_logged_in() ) {
            return true;
        }
        */

        if( is_user_logged_in() ) {
            return true;
        }


        // Bypass cache if the parameter swcfpc is setted or we are on backend
        if( isset($_GET[$this->cache_buster]) || is_admin() ) {
            return true;
        }

        return false;

    }


    function get_cache_control_value() {

        $this->objects = $this->main_instance->get_objects();

        $value = 's-max-age='.$this->main_instance->get_single_config("cf_maxage", 604800).', s-maxage='.$this->main_instance->get_single_config("cf_maxage", 604800).', max-age='.$this->main_instance->get_single_config("cf_browser_maxage", 60);

        return $value;

    }

    
    function is_cache_enabled() {

        $this->objects = $this->main_instance->get_objects();

        if( $this->main_instance->get_single_config("cf_cache_enabled", 0) > 0 )
            return true;

        return false;

    }


    function w3tc_hooks() {

        if( $this->main_instance->get_single_config("cf_w3tc_purge_on_flush_minfy", 0) > 0 ||
            $this->main_instance->get_single_config("cf_w3tc_purge_on_flush_posts", 0) > 0 ||
            $this->main_instance->get_single_config("cf_w3tc_purge_on_flush_objectcache", 0) > 0 ||
            $this->main_instance->get_single_config("cf_w3tc_purge_on_flush_fragmentcache", 0) > 0 ||
            $this->main_instance->get_single_config("cf_w3tc_purge_on_flush_dbcache", 0) > 0 ||
            $this->main_instance->get_single_config("cf_w3tc_purge_on_flush_all", 0) > 0
        ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::w3tc_hooks", "Purge whole Cloudflare cache" );

        }

    }


    function wpo_hooks() {

        if( $this->main_instance->get_single_config("cf_wp_optimize_purge_on_cache_flush", 0) > 0 ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::wpo_hooks", "Purge whole Cloudflare cache" );

        }

    }


    function wp_rocket_hooks() {

        if( $this->main_instance->get_single_config("cf_wp_rocket_purge_on_post_flush", 0) > 0 || $this->main_instance->get_single_config("cf_wp_rocket_purge_on_domain_flush", 0) > 0 ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::wp_rocket_hooks", "Purge whole Cloudflare cache" );

        }

    }


    function litespeed_hooks() {

        if( $this->main_instance->get_single_config("cf_litespeed_purge_on_cache_flush", 0) > 0 ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::litespeed_hooks", "Purge whole Cloudflare cache" );

        }

    }


    function hummingbird_hooks() {

        if( $this->main_instance->get_single_config("cf_hummingbird_purge_on_cache_flush", 0) > 0 ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::hummingbird_hooks", "Purge whole Cloudflare cache" );

        }

    }


    function yasr_hooks( $post_id, $rating ) {

        if( $this->main_instance->get_single_config("cf_yasr_purge_on_rating", 0) > 0 ) {

            $this->objects = $this->main_instance->get_objects();

            $urls = array();
            $urls[] = get_permalink( $post_id );

            $this->purge_urls( $urls );

            $this->objects["logs"]->add_log("cache_controller::yasr_hooks", "Purge Cloudflare cache for only post $post_id" );

        }

    }


    function wpacu_hooks() {

        if( $this->main_instance->get_single_config("cf_wpacu_purge_on_cache_flush", 0) > 0 ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::wpacu_hooks", "Purge whole Cloudflare cache" );

        }

    }


    function autoptimize_hooks() {

        if( $this->main_instance->get_single_config("cf_autoptimize_purge_on_cache_flush", 0) > 0 ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::autoptimize_hooks", "Purge whole Cloudflare cache" );

        }

    }


    function edd_purge_cache_on_payment_add($payment_id, $payment_data) {

        if( $this->main_instance->get_single_config("cf_auto_purge_edd_payment_add", 0) > 0 ) {

            $this->objects = $this->main_instance->get_objects();

            $this->purge_all();
            $this->objects["logs"]->add_log("cache_controller::edd_purge_cache_on_payment_add", "Purge whole Cloudflare cache" );

        }

    }


    /*function woocommerce_purge_product_page_on_stock_change( $order ) {

        if( $this->main_instance->get_single_config("cf_auto_purge_woo_product_page", 0) > 0 && function_exists('wc_get_order') ) {

            $items = $order->get_items();
            $product_cats_ids = array();

            $this->objects = $this->main_instance->get_objects();
            $urls = array();
            $error = "";

            if( function_exists('wc_get_page_id') ) {
                $urls[] = get_permalink( wc_get_page_id('shop') );
            }

            foreach ( $items as $item ) {

                $product_id = $item->get_product_id();
                //$product_variation_id = $item->get_variation_id();

                $product_cats_ids[] = wc_get_product_cat_ids( $product_id );

                $urls = array_merge( $urls, $this->get_post_related_links( $product_id) );

            }

            $urls = array_unique( $urls );

            // Reduce the multidimensional array to a flat one and get rid of ducplicate product_cat IDS
            $product_cats_ids = call_user_func_array('array_merge', $product_cats_ids);
            $product_cats_ids = array_unique($product_cats_ids);

            foreach ( $product_cats_ids as $category_id ) {
                $urls[] = get_category_link( $category_id );
            }


            $this->objects["cloudflare"]->purge_cache_urls( $urls, $error );

            $this->objects["logs"]->add_log("cache_controller::woocommerce_purge_product_page_on_stock_change", "Purge product pages and categories for WooCommerce order" );

        }

    }*/


    function woocommerce_purge_product_page_on_stock_change( $product_id ) {

        if( $this->main_instance->get_single_config("cf_auto_purge_woo_product_page", 0) > 0 && function_exists('wc_get_order') ) {

            $this->objects = $this->main_instance->get_objects();
            $urls = array();

            // Get shop page URL
            if( function_exists('wc_get_page_id') ) {
                $urls[] = get_permalink( wc_get_page_id('shop') );
            }

            // Get product categories URLs
            $product_cats_ids = wc_get_product_cat_ids( $product_id );

            foreach ( $product_cats_ids as $category_id ) {
                $urls[] = get_category_link( $category_id );
            }

            // GET other related URLs
            $urls = array_merge( $urls, $this->get_post_related_links( $product_id ) );
            $urls = array_unique( $urls );

            $this->purge_urls( $urls );
            $this->objects["logs"]->add_log("cache_controller::woocommerce_purge_product_page_on_stock_change", "Purge product pages and categories for WooCommerce order");

        }

    }


    function reset_htaccess() {

        insert_with_markers( $this->htaccess_path, "WP Cloudflare Super Page Cache", array() );

    }


    function write_htaccess(&$error_msg) {

        $this->objects = $this->main_instance->get_objects();

        $htaccess_lines = array();

        if( $this->main_instance->get_single_config("cf_cache_control_htaccess", 0) > 0 && $this->is_cache_enabled() && $this->main_instance->get_single_config("cf_woker_enabled", 0) == 0 ) {

            $htaccess_lines[] = "<IfModule mod_headers.c>";
            //$htaccess_lines[] = "Header unset Pragma \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";
            //$htaccess_lines[] = "Header always unset Pragma \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";
            //$htaccess_lines[] = "Header unset Expires \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";
            //$htaccess_lines[] = "Header always unset Expires \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";
            //$htaccess_lines[] = "Header unset Cache-Control \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";
            //$htaccess_lines[] = "Header always unset Cache-Control \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";
            //$htaccess_lines[] = "Header always set Cache-Control \"" . $this->get_cache_control_value() . "\" \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";

            $htaccess_lines[] = "Header unset Pragma \"expr=resp('x-wp-cf-super-cache-cache-control') != ''\"";
            $htaccess_lines[] = "Header always unset Pragma \"expr=resp('x-wp-cf-super-cache-cache-control') != ''\"";
            $htaccess_lines[] = "Header unset Expires \"expr=resp('x-wp-cf-super-cache-cache-control') != ''\"";
            $htaccess_lines[] = "Header always unset Expires \"expr=resp('x-wp-cf-super-cache-cache-control') != ''\"";
            $htaccess_lines[] = "Header unset Cache-Control \"expr=resp('x-wp-cf-super-cache-cache-control') != ''\"";
            $htaccess_lines[] = "Header always unset Cache-Control \"expr=resp('x-wp-cf-super-cache-cache-control') != ''\"";

            // Add a cache-control header with the value of x-wp-cf-super-cache-cache-control response header
            $htaccess_lines[] = "Header always set Cache-Control \"expr=%{resp:x-wp-cf-super-cache-cache-control}\" \"expr=resp('x-wp-cf-super-cache-cache-control') != ''\"";

            $htaccess_lines[] = "</IfModule>";

        }

        if( $this->main_instance->get_single_config("cf_strip_cookies", 0) > 0 && $this->is_cache_enabled() ) {

            $htaccess_lines[] = "<IfModule mod_expires.c>";
            $htaccess_lines[] = "Header unset Set-Cookie \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";
            $htaccess_lines[] = "Header always unset Set-Cookie \"expr=resp('x-wp-cf-super-cache-active') == '1'\"";
            $htaccess_lines[] = "</IfModule>";

        }

        if( $this->main_instance->get_single_config("cf_bypass_sitemap", 0) > 0 && $this->is_cache_enabled() ) {

            $htaccess_lines[] = "<IfModule mod_expires.c>";
            $htaccess_lines[] = "ExpiresActive on";
            $htaccess_lines[] = 'ExpiresByType application/xml "access plus 0 seconds"';
            $htaccess_lines[] = "</IfModule>";

        }

        if( $this->main_instance->get_single_config("cf_bypass_file_robots", 0) > 0 && $this->is_cache_enabled() ) {

            $htaccess_lines[] = '<FilesMatch "robots\.txt">';
            $htaccess_lines[] = "<IfModule mod_headers.c>";
            $htaccess_lines[] = 'Header set Cache-Control "max-age=0, public"';
            $htaccess_lines[] = "</IfModule>";
            $htaccess_lines[] = "</FilesMatch>";

        }

        if( $this->main_instance->get_single_config("cf_browser_caching_htaccess", 0) > 0 && $this->is_cache_enabled() ) {

            $htaccess_lines[] = "<IfModule mod_expires.c>";
            $htaccess_lines[] = "ExpiresActive on";
            //$htaccess_lines[] = 'ExpiresDefault                              "access plus 4 months"';

            // Data
            $htaccess_lines[] = 'ExpiresByType application/json              "access plus 0 seconds"';
            $htaccess_lines[] = 'ExpiresByType application/xml               "access plus 0 seconds"';

            // Feed
            $htaccess_lines[] = 'ExpiresByType application/rss+xml           "access plus 1 hour"';
            $htaccess_lines[] = 'ExpiresByType application/atom+xml          "access plus 1 hour"';
            $htaccess_lines[] = 'ExpiresByType image/x-icon                  "access plus 1 week"';

            // Media: images, video, audio
            $htaccess_lines[] = 'ExpiresByType image/gif                     "access plus 6 months"';
            $htaccess_lines[] = 'ExpiresByType image/png                     "access plus 6 months"';
            $htaccess_lines[] = 'ExpiresByType image/jpeg                    "access plus 6 months"';
            $htaccess_lines[] = 'ExpiresByType image/webp                    "access plus 6 months"';
            $htaccess_lines[] = 'ExpiresByType video/ogg                     "access plus 4 months"';
            $htaccess_lines[] = 'ExpiresByType audio/ogg                     "access plus 4 months"';
            $htaccess_lines[] = 'ExpiresByType video/mp4                     "access plus 4 months"';
            $htaccess_lines[] = 'ExpiresByType video/webm                    "access plus 4 months"';

            // HTC files  (css3pie)
            $htaccess_lines[] = 'ExpiresByType text/x-component              "access plus 1 month"';

            // Webfonts
            $htaccess_lines[] = 'ExpiresByType font/ttf                      "access plus 6 months"';
            $htaccess_lines[] = 'ExpiresByType font/otf                      "access plus 6 months"';
            $htaccess_lines[] = 'ExpiresByType font/woff                     "access plus 6 months"';
            $htaccess_lines[] = 'ExpiresByType font/woff2                    "access plus 6 months"';
            $htaccess_lines[] = 'ExpiresByType image/svg+xml                 "access plus 4 months"';
            $htaccess_lines[] = 'ExpiresByType application/vnd.ms-fontobject "access plus 4 months"';

            // CSS and JavaScript
            $htaccess_lines[] = 'ExpiresByType text/css                      "access plus 1 year"';
            $htaccess_lines[] = 'ExpiresByType application/javascript        "access plus 1 year"';

            $htaccess_lines[] = "</IfModule>";

        }

        if( !insert_with_markers( $this->htaccess_path, "WP Cloudflare Super Page Cache", $htaccess_lines ) ) {
            $error_msg = __( sprintf('The .htaccess file (%s) could not be edited. Check if the file has write permissions.', $this->htaccess_path), 'wp-cloudflare-page-cache');
            return false;
        }

        return true;

    }


    function get_nginx_rules() {

        $this->objects = $this->main_instance->get_objects();

        $nginx_lines = array();

        if( $this->main_instance->get_single_config("cf_bypass_sitemap", 0) > 0 ) {
            $nginx_lines[] = "location ~* \.(xml)$ { expires -1; }";
        }

        if( $this->main_instance->get_single_config("cf_bypass_file_robots", 0) > 0 ) {
            $nginx_lines[] = "location /robots.txt { expires -1; }";
        }

        if( $this->main_instance->get_single_config("cf_browser_caching_htaccess", 0) > 0 ) {

            $nginx_lines[] = "location ~* \.(css|js)$ { expires 365d; }";
            $nginx_lines[] = "location ~* \.(jpg|jpeg|png|gif|ico|svg|webp)$ { expires 180d; }";
            $nginx_lines[] = "location ~* \.(ogg|mp4|mpeg|avi|mkv|webm|mp3)$ { expires 30d; }";
            $nginx_lines[] = "location ~* \.(ttf|otf|woff|woff2)$ { expires 120d; }";
            $nginx_lines[] = "location ~* \.(pdf)$ { expires 30d; }";
            $nginx_lines[] = "location ~* \.(json)$ { expires -1; }";

            if( $this->main_instance->get_single_config("cf_bypass_sitemap", 0) == 0 )
                $nginx_lines[] = "location ~* \.(xml)$ { expires -1; }";

        }

        return $nginx_lines;

    }


    function ajax_purge_whole_cache() {

        check_ajax_referer( 'ajax-nonce-string', 'security' );

        $return_array = array("status" => "ok");

        $this->objects = $this->main_instance->get_objects();

        $this->purge_all(true, false);
        $this->objects["logs"]->add_log("cache_controller::ajax_purge_whole_cache", "Purge whole Cloudflare cache" );

        $return_array["success_msg"] = __("Cache purged successfully! It may take up to 30 seconds for the cache to be permanently cleaned by Cloudflare.", 'wp-cloudflare-page-cache');

        die(json_encode($return_array));

    }


    function ajax_purge_single_post_cache() {

        check_ajax_referer( 'ajax-nonce-string', 'security' );

        $return_array = array("status" => "ok");

        $data = stripslashes($_POST['data']);
        $data = json_decode($data, true);

        $this->objects = $this->main_instance->get_objects();

        $post_id = intval($data["post_id"]);

        $urls = $this->get_post_related_links( $post_id );

        if( ! $this->purge_urls( $urls, false ) ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("An error occurred while cleaning the cache. Please check log file for further details.");
            die(json_encode($return_array));
        }

        $this->objects["logs"]->add_log("cache_controller::ajax_purge_single_post_cache", "Purge Cloudflare cache for only post id $post_id and related contents" );

        $return_array["success_msg"] = __("Cache purged successfully! It may take up to 30 seconds for the cache to be permanently cleaned by Cloudflare.", 'wp-cloudflare-page-cache');

        die(json_encode($return_array));

    }


    function ajax_reset_all() {

        check_ajax_referer( 'ajax-nonce-string', 'security' );

        $return_array = array("status" => "ok");

        if( !current_user_can('manage_options') ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Permission denied", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        $this->reset_all();

        $return_array["success_msg"] = __("Cloudflare and all configurations have been reset to the initial settings.", 'wp-cloudflare-page-cache');

        die(json_encode($return_array));

    }


    function can_i_start_preloader() {

        $preloader_lock = get_option("swcfpc_preloader_lock", 0);

        if( $preloader_lock == 0 || ((time()-$preloader_lock)/60) > 15 )
            return true;

        return false;

    }


    function lock_preloader() {

        update_option("swcfpc_preloader_lock", time());

    }


    function unlock_preloader() {

        update_option("swcfpc_preloader_lock", 0);

    }


    function is_purge_cache_queue_writable() {

        $purge_cache_lock = get_option("swcfpc_purge_cache_lock", 0);

        if( $purge_cache_lock == 0 || (time()-$purge_cache_lock) > 60 )
            return true;

        return false;

    }


    function lock_cache_purge_queue() {

        update_option("swcfpc_purge_cache_lock", time());

    }


    function unlock_cache_purge_queue() {

        update_option("swcfpc_purge_cache_lock", 0);

    }


    function purge_cache_queue_init_directory() {

        $cache_path = $this->main_instance->get_plugin_wp_content_directory()."/purge_cache_queue/";

        if( ! file_exists($cache_path) )
            wp_mkdir_p( $cache_path );

        return $cache_path;

    }


    function purge_cache_queue_write($urls=array(), $purge_all=false) {

        while( ! $this->is_purge_cache_queue_writable() ) {
            $this->objects["logs"]->add_log("cache_controller::purge_cache_queue_write", "Queue file not writable. Sleep 1 second" );
            sleep( 1 );
        }

        $this->lock_cache_purge_queue();

        $cache_queue_path = $this->purge_cache_queue_init_directory()."cache_queue.php";

        if( file_exists($cache_queue_path) ) {

            include $cache_queue_path;

            $swcfpc_cache_queue = json_decode( stripslashes($swcfpc_cache_queue), true );

            if( !is_array($swcfpc_cache_queue) || (is_array($swcfpc_cache_queue) && (!isset($swcfpc_cache_queue["purge_all"]) || !isset($swcfpc_cache_queue["urls"])) )) {
                $this->unlock_cache_purge_queue();
                return true;
            }

            if( $swcfpc_cache_queue["purge_all"] ) {
                $this->unlock_cache_purge_queue();
                return true;
            }

            if( $swcfpc_cache_queue["purge_all"] === false && $purge_all === true ) {
                $swcfpc_cache_queue["purge_all"] = true;
            }
            else {
                $swcfpc_cache_queue["urls"] = array_unique( array_merge( $swcfpc_cache_queue["urls"], $urls ) );
            }

        }
        else {

            $this->objects["logs"]->add_log("cache_controller::purge_cache_queue_write", "queue file not exist");

            if( !is_array($urls) )
                $urls = array();

            $swcfpc_cache_queue = array("purge_all" => $purge_all, "urls" => $urls);

        }

        $file_content = "<?php \$swcfpc_cache_queue='".addslashes( json_encode($swcfpc_cache_queue) )."'; ?>";
        file_put_contents( $cache_queue_path, $file_content);

        $this->unlock_cache_purge_queue();

    }


    function purge_cache_queue_custom_interval( $schedules ) {

        $schedules['ten_seconds'] = array(
            'interval' => 10,
            'display'  => esc_html__( 'Every Ten Seconds' ), );

        return $schedules;

    }


    function purge_cache_queue_start_cronjob() {

        $cache_queue_path = $this->purge_cache_queue_init_directory()."cache_queue.php";

        if( ! file_exists($cache_queue_path) ) {
            $timestamp = wp_next_scheduled( 'swcfpc_cache_purge_cron' );
            wp_unschedule_event( $timestamp, 'swcfpc_cache_purge_cron' );
            return false;
        }

        if ( ! wp_next_scheduled( 'swcfpc_cache_purge_cron' ) ) {
            wp_schedule_event( time(), 'ten_seconds', 'swcfpc_cache_purge_cron' );
        }

        return true;

    }


    function purge_cache_queue_job() {

        $this->objects["logs"]->add_log("cache_controller::purge_cache_queue_job", "I'm the purge cache cronjob" );

        $cache_queue_path = $this->purge_cache_queue_init_directory()."cache_queue.php";

        if( ! file_exists($cache_queue_path) ) {
            $this->objects["logs"]->add_log("cache_controller::purge_cache_queue_job", "Queue file does not exists. Exit." );
            return false;
        }

        while( ! $this->is_purge_cache_queue_writable() ) {
            $this->objects["logs"]->add_log("cache_controller::purge_cache_queue_job", "Queue file not writable. Sleep 1 second" );
            sleep( 1 );
        }

        $this->lock_cache_purge_queue();

        include $cache_queue_path;

        $swcfpc_cache_queue = json_decode( stripslashes($swcfpc_cache_queue), true );

        if( isset($swcfpc_cache_queue["purge_all"]) && $swcfpc_cache_queue["purge_all"] ) {
            $this->purge_all(false, false);
        }
        else if( isset($swcfpc_cache_queue["urls"]) && is_array($swcfpc_cache_queue["urls"]) && count($swcfpc_cache_queue["urls"]) > 0 ) {
            $this->purge_urls( $swcfpc_cache_queue["urls"], false );
        }

        @unlink( $cache_queue_path );

        $this->unlock_cache_purge_queue();

        $this->objects["logs"]->add_log("cache_controller::purge_cache_queue_job", "Cache purged" );

        return true;

    }


    function start_cache_preloader_for_specific_urls( $urls ) {

        if( class_exists('SWCFPC_Preloader_Process') ) {

            // Remove empty and duplicated URLs
            $urls = array_filter( $urls );
            $urls = array_unique( $urls );

            $this->objects = $this->main_instance->get_objects();

            if( $this->can_i_start_preloader() ) {

                $this->lock_preloader();

                $cf_cookie = $this->objects["cloudflare"]->get_cloudflare_cookie();

                $this->objects["logs"]->add_log("cache_controller::start_cache_preloader_for_specific_urls", "Adding these URLs to preloader queue: ".print_r($urls, true) );

                $num_url = count($urls);
                $preloader = new SWCFPC_Preloader_Process($this->main_instance);

                // Add URLs to preloader
                for ($i = 0; $i < $num_url && $i < SWCFPC_PRELOADER_MAX_POST_NUMBER; $i++) {

                    if ( $this->is_external_link($urls[$i]) === false )
                        $preloader->push_to_queue( array("cf_cookie" => $cf_cookie, "url" => $urls[$i]) );

                }

                // Start background preloader
                $preloader->save()->dispatch();

            }
            else {

                $this->objects["logs"]->add_log("cache_controller::start_cache_preloader_for_specific_urls", "Unable to start the preloader. Another preloading process is currently running." );

            }

        }

    }


    function start_preloader_for_all_urls() {

        $this->objects = $this->main_instance->get_objects();
        $home_url      = home_url("/");
        $urls          = array();

        // Preload all registered navigation menu locations URLs
        if( count( $this->main_instance->get_single_config("cf_preloader_nav_menus", array()) ) > 0 ) {

            // Get urls from wordpress menus
            //$wordpress_menus = get_nav_menu_locations();
            $wordpress_menus = $this->main_instance->get_single_config("cf_preloader_nav_menus", array());

            foreach ($wordpress_menus as $nav_menu_id) {

                $single_menu_items = wp_get_nav_menu_items($nav_menu_id);

                if ($single_menu_items) {

                    foreach ($single_menu_items as $menu_item) {

                        if( in_array( $menu_item->url, $urls ) )
                            continue;

                        if( $menu_item->url && $this->is_external_link($menu_item->url) )
                            continue;

                        if ( $menu_item->type == "post_type" && $menu_item->url && strlen($menu_item->url) > 0 && (substr( strtolower($menu_item->url), 0, 6) == "https:" || substr( strtolower($menu_item->url), 0, 5) == "http:") ) {
                            $urls[] = $menu_item->url;
                            continue;
                        }

                        if( $menu_item->url && strcasecmp(substr($menu_item->url, 0, strlen($home_url)-1), $home_url) == 0 ) {
                            $urls[] = $menu_item->url;
                            continue;
                        }

                    }

                }

            }

        }

        // Preload URLs in sitemaps
        if( count( $this->main_instance->get_single_config("cf_preload_sitemap_urls", array()) ) > 0 ) {

            $sitemap_urls = $this->main_instance->get_single_config("cf_preload_sitemap_urls", array());

            if( is_array($sitemap_urls) && count($sitemap_urls) > 0 ) {

                foreach( $sitemap_urls as $single_sitemap_url ) {

                    $single_sitemap_url = home_url( $single_sitemap_url );

                    $this->objects["logs"]->add_log("cloudflare::start_preloader_for_all_urls", "Preload sitemap $single_sitemap_url");

                    $response = wp_remote_post(
                        esc_url_raw( $single_sitemap_url ),
                        array(
                            'timeout'    => defined('SWCFPC_CURL_TIMEOUT') ? SWCFPC_CURL_TIMEOUT : 10,
                            'sslverify'  => false,
                            'blocking'   => true,
                            'user-agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'
                        )
                    );

                    if ( is_wp_error( $response ) ) {
                        $error = sprintf( __('Connection error while retriving the sitemap %s: %s', 'wp-cloudflare-page-cache'), $single_sitemap_url, $response->get_error_message());
                        $this->objects["logs"]->add_log("cloudflare::start_preloader_for_all_urls", "Error wp_remote_post: $error");
                        continue;
                    }

                    if( wp_remote_retrieve_response_code( $response ) != 200 ) {
                        $this->objects["logs"]->add_log("cloudflare::start_preloader_for_all_urls", "Response code for $single_sitemap_url is not 200. Response code: ".wp_remote_retrieve_response_code( $response ));
                        continue;
                    }

                    $response_body = wp_remote_retrieve_body($response);

                    if( strlen($response_body) == 0 ) {
                        $this->objects["logs"]->add_log("cloudflare::start_preloader_for_all_urls", "Empty response body for sitemap $single_sitemap_url");
                        continue;
                    }

                    libxml_use_internal_errors(true);

                    $xml = simplexml_load_string($response_body);

                    if( $xml === false ) {

                        $xml_errors = libxml_get_errors();

                        foreach ($xml_errors as $single_xml_error) {
                            $this->objects["logs"]->add_log("cloudflare::start_preloader_for_all_urls", "Invalid XML for sitemap $single_sitemap_url: " . $single_xml_error->message);
                        }

                        libxml_clear_errors();

                    }

                    /*
                    try {
                        $xml = new SimpleXMLElement($response_body);
                    } catch (Exception $e){
                        $this->objects["logs"]->add_log("cloudflare::start_preloader_for_all_urls", "Invalid XML for sitemap $single_sitemap_url: " . $e->getMessage());
                        continue;
                    }
                    */

                    if( isset($xml->url) && !empty($xml->url) ) {

                        foreach ($xml->url as $url_list) {

                            if ( !isset($url_list->loc) || empty($url_list->loc) || in_array($url_list->loc, $urls) || $this->is_external_link($url_list->loc))
                                continue;

                            $urls[] = $url_list->loc->__toString();

                        }

                    }

                }

            }

        }

        // Preload last published posts
        if( $this->main_instance->get_single_config("cf_preload_last_urls", 0) > 0 ) {

            // Get public post types.
            $post_types = array("post", "page");
            $other_post_types = get_post_types(array('public' => true, '_builtin' => false, 'publicly_queryable' => true));

            foreach($other_post_types as $key => $single_post_type)
                $post_types[] = $single_post_type;

            $post_types = array_diff( $post_types, $this->main_instance->get_single_config("cf_preload_excluded_post_types", array()) );

            $this->objects["logs"]->add_log("cloudflare::start_preloader_for_all_urls", "Getting last published posts for post types: ".print_r($post_types, true));

            $args = array(
                'fields' => 'ids',
                'numberposts' => 20,
                //'posts_per_page' => -1,
                'post_type' => $post_types,
                'orderby' => 'date',
                'order' => 'DESC'
           );

            $all_posts = get_posts($args);

            foreach ($all_posts as $post) {

                $permalink = get_permalink($post);

                if ( $permalink !== false && !in_array( $permalink, $urls ) && strlen($permalink) > 0 ) {
                    $urls[] = $permalink;
                }

            }

        }

        // Start preloader
        if( count($urls) > 0 ) {

            if( !in_array( $home_url, $urls ) ) {
                $urls[] = $home_url;
            }

            $this->start_cache_preloader_for_specific_urls( $urls );

        }
        else {
            $this->objects["logs"]->add_log("cloudflare::start_preloader_for_all_urls", "Nothing to preload");
        }

    }


    function is_external_link($url) {

        $source = parse_url( home_url() );
        $target = parse_url($url);

        if( !$source || empty($source['host']) || !$target || empty($target['host']) )
            return false;

        if( strcasecmp($target['host'], $source['host']) === 0 )
            return false;

        return true;

    }


    function purge_opcache() {

        if ( !extension_loaded('Zend OPcache') )
            return false;

        $opcache_status = opcache_get_status();

        if ( !$opcache_status || !isset($opcache_status["opcache_enabled"]) || $opcache_status["opcache_enabled"] === false )
            return false;

        if ( !opcache_reset() )
            return false;

        /**
         * opcache_reset() is performed, now try to clear the
         * file cache.
         * Please note: http://stackoverflow.com/a/23587079/1297898
         *   "Opcache does not evict invalid items from memory - they
         *   stay there until the pool is full at which point the
         *   memory is completely cleared"
         */
        foreach( $opcache_status['scripts'] as $key => $data ) {
            $dirs[dirname($key)][basename($key)] = $data;
            opcache_invalidate($data['full_path'] , $force=true);
        }

        return true;

    }


    function ajax_preloader_unlock() {

        check_ajax_referer( 'ajax-nonce-string', 'security' );

        $this->objects = $this->main_instance->get_objects();

        $return_array = array("status" => "ok");

        if( !current_user_can('manage_options') ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Permission denied", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( $this->main_instance->get_single_config("cf_preloader", 1) == 0 ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Preloader is not enabled", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( $this->can_i_start_preloader() ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Preloader is already unlocked", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        $this->unlock_preloader();

        $return_array["success_msg"] = __("Preloader unlocked successfully", "wp-cloudflare-page-cache");

        die(json_encode($return_array));

    }


    function ajax_preloader_start() {

        check_ajax_referer( 'ajax-nonce-string', 'security' );

        $this->objects = $this->main_instance->get_objects();

        $return_array = array("status" => "ok");

        if( !current_user_can('manage_options') ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Permission denied", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( $this->main_instance->get_single_config("cf_preloader", 1) == 0 ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Preloader is not enabled", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( !$this->can_i_start_preloader() ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Unable to start the preloader. Another preloading process is currently running.", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( !class_exists('WP_Background_Process') ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Unable to start background processes: WP_Background_Process does not exists.", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( !class_exists('SWCFPC_Preloader_Process') ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Unable to start background processes: SWCFPC_Preloader_Process does not exists.", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( ! $this->is_cache_enabled() ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("You cannot start the preloader while the page cache is disabled.", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        $this->start_preloader_for_all_urls();

        $return_array["success_msg"] = __("Preloader started successfully", "wp-cloudflare-page-cache");

        die(json_encode($return_array));

    }


    function ajax_enable_page_cache() {

        check_ajax_referer( 'ajax-nonce-string', 'security' );

        $this->objects = $this->main_instance->get_objects();

        $return_array = array("status" => "ok");
        $error = "";

        if( !current_user_can('manage_options') ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Permission denied", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( ! $this->objects["cloudflare"]->enable_page_cache($error) ) {
            $return_array["status"] = "error";
            $return_array["error"] = $error;
            die(json_encode($return_array));
        }

        if( $this->main_instance->get_single_config("cf_fallback_cache", 0) > 0 && $this->main_instance->get_single_config("cf_fallback_cache_curl", 0) == 0 && !defined('SWCFPC_ADVANCED_CACHE') ) {
            $this->objects["fallback_cache"]->fallback_cache_advanced_cache_enable();
        }

        $return_array["success_msg"] = __("Page cache enabled successfully", 'wp-cloudflare-page-cache');

        die(json_encode($return_array));

    }


    function ajax_disable_page_cache() {

        check_ajax_referer( 'ajax-nonce-string', 'security' );

        $return_array = array("status" => "ok");
        $error = "";

        if( !current_user_can('manage_options') ) {
            $return_array["status"] = "error";
            $return_array["error"] = __("Permission denied", "wp-cloudflare-page-cache");
            die(json_encode($return_array));
        }

        if( ! $this->objects["cloudflare"]->disable_page_cache($error) ) {
            $return_array["status"] = "error";
            $return_array["error"] = $error;
            die(json_encode($return_array));
        }

        if( $this->main_instance->get_single_config("cf_fallback_cache", 0) > 0 && $this->main_instance->get_single_config("cf_fallback_cache_curl", 0) == 0 && defined('SWCFPC_ADVANCED_CACHE') ) {
            $this->objects["fallback_cache"]->fallback_cache_advanced_cache_disable();
        }

        $return_array["success_msg"] = __("Page cache disabled successfully", 'wp-cloudflare-page-cache');

        die(json_encode($return_array));

    }


}