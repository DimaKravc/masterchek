<?php
if (!function_exists('mch_register_post_types')):
    /**
     * Register custom post types
     */
    function mch_register_post_types()
    {
        register_post_type('loader', array(
            'labels' => array(
                'name' => __('Loaders', 'mch_localization'),
                'all_items' => __('All loaders', 'mch_localization'),
                'add_new' => __('Add loader', 'mch_localization'),
                'add_new_item' => __('Add new loader', 'mch_localization'),
                'not_found' => __('Loaders not found', 'mch_localization'),
                'menu_name' => __('Loaders', 'mch_localization')
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 30,
            'supports' => array('editor')
        ));

        register_post_type('offers', array(
            'labels' => array(
                'name' => __('Offers', 'mch_localization'),
                'all_items' => __('All offers', 'mch_localization'),
                'add_new' => __('Add offer', 'mch_localization'),
                'add_new_item' => __('Add offer', 'mch_localization'),
                'not_found' => __('Add new offer', 'mch_localization'),
                'menu_name' => __('Offers', 'mch_localization')
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 31,
            'supports' => array('editor', 'editor')
        ));

        register_post_type('achievements', array(
            'labels' => array(
                'name' => __('Achievements', 'mch_localization'),
                'all_items' => __('All achievements', 'mch_localization'),
                'add_new' => __('Add achievement', 'mch_localization'),
                'add_new_item' => __('Add new achievement', 'mch_localization'),
                'not_found' => __('Achievement not found', 'mch_localization'),
                'menu_name' => __('Achievements', 'mch_localization')
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 32,
            'supports' => array('')
        ));

        register_post_type('points', array(
            'labels' => array(
                'name' => __('Points', 'mch_localization'),
                'all_items' => __('All points', 'mch_localization'),
                'add_new' => __('Add point', 'mch_localization'),
                'add_new_item' => __('Add new point', 'mch_localization'),
                'not_found' => __('Points not found', 'mch_localization'),
                'menu_name' => __('Points', 'mch_localization')
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 33,
            'supports' => array('title', 'editor', 'thumbnail')
        ));

        register_post_type('maps', array(
            'labels' => array(
                'name' => __('Maps', 'mch_localization'),
                'all_items' => __('All maps', 'mch_localization'),
                'add_new' => __('Add map', 'mch_localization'),
                'add_new_item' => __('Add new map', 'mch_localization'),
                'not_found' => __('Maps not found', 'mch_localization'),
                'menu_name' => __('Maps', 'mch_localization')
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 34,
            'supports' => array('title')
        ));

        register_post_type('customers', array(
            'labels' => array(
                'name' => __('Customers', 'mch_localization'),
                'all_items' => __('All customers', 'mch_localization'),
                'add_new' => __('Add customer', 'mch_localization'),
                'add_new_item' => __('Add new customer', 'mch_localization'),
                'not_found' => __('Customers not found', 'mch_localization'),
                'menu_name' => __('Customers', 'mch_localization')
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 35,
            'supports' => array('title', 'editor')
        ));

        register_post_type('contacts', array(
            'labels' => array(
                'name' => __('Contacts', 'mch_localization'),
                'all_items' => __('All contacts', 'mch_localization'),
                'add_new' => __('Add contact', 'mch_localization'),
                'add_new_item' => __('Add new contact', 'mch_localization'),
                'not_found' => __('Contacts not found', 'mch_localization'),
                'menu_name' => __('Contacts', 'mch_localization')
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 36,
            'supports' => array('title')
        ));
    }
endif;
add_action('init', 'mch_register_post_types'); ?>
