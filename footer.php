<?php
/**
 * The template for displaying the footer.
 *
 * @package PAYMO
 * @version 1.0
 */

$map_array = get_posts(array('post_type' => 'maps', 'posts_per_page' => 1));
$points_array = get_posts(array('post_type' => 'points'));
?>
<footer class="site-footer container">
    <p class="site-footer__copyright">&copy; <?php echo date('Y'); ?> All Rights Reserved.</p>
    <?php wp_nav_menu(array(
        'theme_location' => 'footer',
        'container' => 'nav',
        'container_class' => 'site-nav',
        'fallback_cb' => ''
    )); ?>
</footer>
<?php foreach ($map_array as $map): ?>
    <?php $post_meta = get_post_meta($map->ID); ?>
    <script>
        var mapSettings = {
            center: {
                lat: <?php echo esc_js($post_meta['_meta-map-lat'][0])?>,
                lng: <?php echo esc_js($post_meta['_meta-map-lng'][0])?>
            },
            zoom: <?php echo esc_js($post_meta['_meta-map-zoom'][0])?>,
            points: [
                <?php foreach ($points_array as $point):
                $post_meta = get_post_meta($point->ID);
                if (!empty($post_meta['_meta-point-lat'][0]) && !empty($post_meta['_meta-point-lng'][0])): ?>
                {
                    id: '<?php echo $point->ID?>',
                    title: '<?php echo esc_js($point->post_title); ?>',
                    icon: '<?php echo get_template_directory_uri(); ?>/images/icon-marker.png',
                    lat: <?php echo esc_js($post_meta['_meta-point-lat'][0]); ?>,
                    lng: <?php echo esc_js($post_meta['_meta-point-lng'][0]); ?>,
                    zIndex: <?php echo !$post_meta['_meta-point-parent-id'] ? '10' : '5'; ?>
                },
                <?php endif; ?>
                <?php endforeach;?>
            ]
        }
    </script>
<?php endforeach; ?>
<?php wp_footer(); ?>
</body>
</html>