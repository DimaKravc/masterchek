<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package PAYMO
 * @version 1.0
 */

?>
<!--<pre>-->
<?php
//require __DIR__ . '/vendor/autoload.php';
//
//use Automattic\WooCommerce\Client;
//
//$woocommerce = new Client(
//    'http://masterchek.192.168.1.100.xip.io/',
//    'ck_495e7f52bc890e8e6690ea60fdd382c18ea87011',
//    'cs_879c037828e2814fbf2164087a02569985e30a63',
//    [
//        'wp_api' => true,
//        'version' => 'wc/v1',
//    ]
//);
//$parameters = ['per_page' => 1, 'order' => 'asc', 'orderby' => 'id'];
//print_r($woocommerce->get('products/', $parameters));
//?>
<!--</pre>-->
<?php get_header(); ?>
<?php get_template_part('template-parts/section', 'promo'); ?>
<?php get_template_part('template-parts/section', 'advantages'); ?>
<?php get_template_part('template-parts/section', 'rates'); ?>
<?php get_template_part('template-parts/section', 'offer'); ?>
<?php get_template_part('template-parts/section', 'achievements'); ?>
<?php get_template_part('template-parts/section', 'points'); ?>
<?php get_template_part('template-parts/section', 'customers'); ?>
<?php get_template_part('template-parts/section', 'calculator'); ?>
<?php get_template_part('template-parts/section', 'contacts'); ?>
<?php get_footer(); ?>