<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section.
 *
 * @package PAYMO
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#da8721">
    <meta name="msapplication-navbutton-color" content="#da8721">
    <meta name="apple-mobile-web-app-status-bar-style" content="#da8721">
    <?php wp_site_icon(); ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php get_template_part('template-parts/loader'); ?>
<header class="site-header container">
    <?php wp_nav_menu(array(
        'theme_location' => 'header',
        'container' => 'nav',
        'container_class' => 'site-nav',
        'fallback_cb' => ''
    )); ?>
    <button class="button order-button">заказать чек</button>
    <span class="site-header__divider"></span>
    <div class="shopping-bag">
        <span class="shopping-bag__icon"></span>
        <p class="shopping-bag__title">корзина</p>
        <span class="shopping-bag__amount">3</span>
    </div>
</header>