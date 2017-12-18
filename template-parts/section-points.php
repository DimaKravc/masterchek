<?php
$posts_array = get_posts(array('post_type' => 'points'));

if (!empty($posts_array)): ?>
    <section class="section-points">
        <div class="section-points__header">
            <h2 class="section-points__title">наши точки</h2>
            <div class="section-points__tabs">
                <button class="section-points__tabs__item button --active" data-tab="#point-1">список</button>
                <button class="section-points__tabs__item button" data-tab="#point-2">на карте</button>
            </div>
        </div>
        <div class="list-points container" data-id="#point-1">
            <?php foreach ($posts_array as $key => $post):
                $post_meta = get_post_meta($post->ID, '', true);
                $post_thumb = get_the_post_thumbnail_url($post->ID, 'full');
                $parent_id = $post_meta['_meta-point-parent-id'][0];
                $post_title = $post->post_title;

                if (!$parent_id && $post_thumb): ?>
                    <div class="list-points__item">
                        <div class="balancer">
                            <img src="<?php echo esc_attr($post_thumb) ?>"
                                 alt="<?php echo esc_textarea($post_title) ?>">
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="points-map" data-id="#point-2">
            <div id="map" style="height: 100%"></div>
            <?php
            $info_box_container = false;
            foreach ($posts_array as $key => $post):
                $post_meta = get_post_meta($post->ID, '', true);
                $post_small_thumb = isset($post_meta['points_logo-small_thumbnail_id']) ? $post_meta['points_logo-small_thumbnail_id'][0] : Null;
                $thumb_data = $post_small_thumb ? wp_get_attachment_image_src($post_small_thumb) : Null;
                $content = isset($post_meta['_meta-point-short-desc']) ? $post_meta['_meta-point-short-desc'][0] : Null;

                if ($content && !empty($content)):
                    $info_box_container = true; ?>
                    <div id="info-box-<?php echo $post->ID; ?>">
                        <?php if (!empty($thumb_data)): ?>
                            <div class="info-box__logo"
                                 style="background-image: url('<?php echo esc_attr($thumb_data[0]); ?>')"></div>
                        <? endif; ?>
                        <div class="info-box__inner <?php echo esc_attr(empty($thumb_data) ? '--without-thumb' : ''); ?>">
                            <div class="info-box__content"><?php echo $content; ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php echo $info_box_container ? '<div id="info-box-container" class="info-box"></div>' : ''; ?>
        </div>
    </section>
<?php endif; ?>