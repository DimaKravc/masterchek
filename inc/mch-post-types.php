<?php
if (!function_exists('mch_register_post_types')):
    /**
     * Register custom post types
     */
    function mch_register_post_types()
    {
        register_post_type('loader', array(
            'labels' => array(
                'name' => 'Loaders',
                'all_items' => 'All loaders',
                'add_new' => 'Add loader',
                'add_new_item' => 'Add new loader',
                'not_found' => 'Loaders not found',
                'menu_name' => 'Loaders'
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 30,
            'supports' => array('title', 'editor')
        ));

        register_post_type('offers', array(
            'labels' => array(
                'name' => 'Offers',
                'all_items' => 'All offers',
                'add_new' => 'Add offer',
                'add_new_item' => 'Add new offer',
                'not_found' => 'Offer not found',
                'menu_name' => 'Offers'
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
                'name' => 'Achievements',
                'all_items' => 'All achievements',
                'add_new' => 'Add achievement',
                'add_new_item' => 'Add new achievement',
                'not_found' => 'Achievement not found',
                'menu_name' => 'Achievements'
            ),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'menu_icon' => get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            'menu_position' => 32,
            'supports' => array('title')
        ));

        register_post_type('points', array(
            'labels' => array(
                'name' => 'Points',
                'all_items' => 'All points',
                'add_new' => 'Add point',
                'add_new_item' => 'Add new point',
                'not_found' => 'Points not found',
                'menu_name' => 'Points'
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
                'name' => 'Maps',
                'all_items' => 'All maps',
                'add_new' => 'Add map',
                'add_new_item' => 'Add new map',
                'not_found' => 'Maps not found',
                'menu_name' => 'Maps'
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
                'name' => 'Customers',
                'all_items' => 'All customers',
                'add_new' => 'Add customer',
                'add_new_item' => 'Add new customer',
                'not_found' => 'Customers not found',
                'menu_name' => 'Customers'
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
                'name' => 'Contacts',
                'all_items' => 'All contacts',
                'add_new' => 'Add contact',
                'add_new_item' => 'Add new contact',
                'not_found' => 'Contacts not found',
                'menu_name' => 'Contacts'
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
