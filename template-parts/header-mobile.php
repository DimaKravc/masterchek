<button class="menu-trigger" data-js="open-mob-menu">
    <span class="menu-trigger__icon"></span>
</button>
<div class="mobile-menu" data-js="mob-menu">
    <button class="mobile-menu__close" data-js="close-mob-menu"></button>
    <div class="mobile-menu__inner">
        <div class="mobile-menu__balancer">
            <div class="mobile-menu__balancer__inner">
                <?php wp_nav_menu( array(
                    'theme_location'  => 'header',
                    'container'       => 'nav',
                    'container_class' => 'site-nav-mobile',
                    'fallback_cb' => ''
                ) ); ?>
                <button class="button order-button-mobile">заказать чек</button>
            </div>
        </div>
    </div>
</div>