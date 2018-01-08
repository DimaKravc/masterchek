<?php
/**
 *  MASTERCHEK functions and definitions
 *
 * @since 1.0
 */

define('MASTERCHEK_VERSION', 1.0);

if (!function_exists('theme_setup_callback')) :
    /**
     * Theme setup
     */
    function theme_setup_callback()
    {
        /**
         * Add feed links
         */
        add_theme_support('automatic-feed-links');

        /**
         * Add title tag
         */
        add_theme_support('title-tag');

        /**
         * Register new menu locations
         */
        register_nav_menus(array(
            'header' => 'Header menu',
            'footer' => 'Footer menu',
        ));

        /**
         * Add feature image support
         */
        add_theme_support('post-thumbnails');

        /**
         * Add localizations file
         */
        load_theme_textdomain('mch_localization', get_template_directory() . '/languages');
    }
endif;
add_action('after_setup_theme', 'theme_setup_callback');

if (!function_exists('recent_comments_style')):
    /**
     * Remove recent comments style
     */
    function recent_comments_style()
    {
        global $wp_widget_factory;
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style',
        ));
    }
endif;
add_action('widgets_init', 'recent_comments_style');

if (!function_exists('theme_load_scripts')) :
    /**
     * Register and enqueue styles/scripts
     */
    function theme_load_scripts()
    {
        /**
         * Load styles
         */
        wp_enqueue_style('owlcarousel', get_template_directory_uri() . '/styles/owl.carousel.min.css', array(), MASTERCHEK_VERSION);
        wp_enqueue_style('owlcarousel-default', get_template_directory_uri() . '/styles/owl.theme.default.min.css', array('owlcarousel'), MASTERCHEK_VERSION);
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/styles/bootstrap.min.css', array(), MASTERCHEK_VERSION);
        wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/styles/bootstrap-theme.min.css', array('bootstrap'), MASTERCHEK_VERSION);
        wp_enqueue_style('range-slider', get_template_directory_uri() . '/styles/jquery.range.css', array(), MASTERCHEK_VERSION);
        wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), MASTERCHEK_VERSION);

        /**
         * Load scripts
         */
        wp_enqueue_script("jquery-ui-core", array('jquery'), MASTERCHEK_VERSION, true);
        wp_enqueue_script("jquery-ui-selectmenu", array('jquery', 'jquery-ui-core'), MASTERCHEK_VERSION, true);
        //wp_enqueue_script("jquery-ui-slider", array('jquery', 'jquery-ui-core'), MASTERCHEK_VERSION, true);
        wp_enqueue_script("range-slider", get_template_directory_uri() . '/js/jquery.range-min.js', array('jquery'), MASTERCHEK_VERSION, true);
        wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), MASTERCHEK_VERSION, true);
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), MASTERCHEK_VERSION, true);
        wp_enqueue_script('application', get_template_directory_uri() . '/js/application.js', array('jquery-ui-selectmenu', 'range-slider', 'owlcarousel'), MASTERCHEK_VERSION, true);
        wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('application'), MASTERCHEK_VERSION, true);

        $google_api_key = get_google_api_key();
        if ($google_api_key) {
            wp_enqueue_script('google-map-settings', get_template_directory_uri() . '/js/mapSet.js', array(), MASTERCHEK_VERSION, true);
            wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?key=' . $google_api_key . '&callback=initMap#asyncload', array('google-map-settings'), MASTERCHEK_VERSION, true);
        }

        wp_localize_script('application', 'mch_ajax_data',
            array(
                'url' => admin_url('admin-ajax.php')
            )
        );
    }
endif;
add_action('wp_enqueue_scripts', 'theme_load_scripts');

if (!function_exists('add_async_for_script')):
    /**
     * Util add async param to script tag
     */
    function add_async_for_script($url)
    {
        if (strpos($url, '#asyncload') === false)
            return $url;
        else if (is_admin())
            return str_replace('#asyncload', '', $url);
        else
            return str_replace('#asyncload', '', $url) . "' async='async";
    }
endif;
add_filter('clean_url', 'add_async_for_script', 11, 1);

if (!function_exists('get_google_api_key')):
    /**
     * Get Google Api Key from post meta
     */
    function get_google_api_key()
    {
        $posts_array = get_posts(array('post_type' => 'maps', 'posts_per_page' => 1));

        foreach ($posts_array as $post):
            $meta_data = get_post_meta($post->ID);

            return $meta_data['_meta-map-api'][0];
        endforeach;

        return '';
    }
endif;

if (!function_exists('save_profile_fields')):
    /**
     * Save additional profile fields.
     */
    function save_profile_fields($user_id)
    {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        if (empty($_POST['achievements'])) {
            return false;
        }

        update_user_meta($user_id, 'achievements', $_POST['achievements']);
    }
endif;
add_action('personal_options_update', 'save_profile_fields');
add_action('edit_user_profile_update', 'save_profile_fields');

if (class_exists('MultiPostThumbnails')) {
    /**
     * Add additional featured image for post-type points
     */
    new MultiPostThumbnails(
        array(
            'label' => __('Миниатюра записи', 'mch_localization'),
            'id' => 'logo-small',
            'post_type' => 'points'
        )
    );
}

function request_for_advice_callback()
{
    global $Mch_Support;

    if (empty($_POST) || !check_ajax_referer('request_for_advice')) {
        die();
    } else {
        $args = array(
            'author' => $_POST['author'],
            'time' => current_time('mysql'),
            'email' => $_POST['email'],
            'tel' => $_POST['tel'],
            'subject' => $_POST['subject'],
            'message' => $_POST['message']
        );

        $Mch_Support->add_entry($args);
    }

    wp_die();
}

if (wp_doing_ajax()) {
    add_action('wp_ajax_request_for_advice', 'request_for_advice_callback');
    add_action('wp_ajax_nopriv_request_for_advice', 'request_for_advice_callback');
}

if (!function_exists('additional_contact_methods')):
    /**
     * Add new fields into 'Contact Info' section.
     *
     * @param  array $fields Existing fields array.
     * @return array
     */
    function additional_contact_methods($fields)
    {
        $fields['instagram'] = 'Instagram';
        $fields['facebook'] = 'Facebook';
        $fields['telegram'] = 'Telegram';
        return $fields;
    }
endif;
add_filter('user_contactmethods', 'additional_contact_methods');

if (!function_exists('theme_mime_types')) :
    /**
     * Allow SVG through WordPress Media Uploader
     */
    function theme_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
endif;
add_filter('upload_mimes', 'theme_mime_types');

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Include files
 */
require get_template_directory() . '/inc/mch-class-support.php';
require get_template_directory() . '/inc/mch-post-types.php';
require get_template_directory() . '/inc/mch-meta-boxes.php';
#require get_template_directory() . '/inc/tgm/tgm-plugin-registration.php';

