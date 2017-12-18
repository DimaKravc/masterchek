<?php $posts_array = get_posts(array('post_type' => 'achievements', 'posts_per_page' => 1));
foreach ($posts_array as $post) {
    $meta_data = get_post_meta($post->ID, '', true); ?>
    <section class="section-achievements">
        <div class="container">
            <div class="list-achievements">
                <fieldset class="list-achievements__item">
                    <legend class="legend">
                    <span class="legend__inner">
                        <span class="legend__left"></span>
                        <span class="legend__content"><span class="smile-icon"></span></span>
                        <span class="legend__right"></span>
                    </span>
                    </legend>
                    <p class="list-achievements__item__amount" data-js="achievements-counter"
                       data-count="<?php echo esc_attr($meta_data['_meta-happy-customers-num'][0]) ?>">0</p>
                    <p class="list-achievements__item__text"><?php echo esc_html($meta_data['_meta-happy-customers-title'][0]) ?></p>
                </fieldset>
                <fieldset class="list-achievements__item">
                    <legend class="legend">
                    <span class="legend__inner">
                        <span class="legend__left"></span>
                        <span class="legend__content"><span class="like-icon"></span></span>
                        <span class="legend__right"></span>
                    </span>
                    </legend>
                    <p class="list-achievements__item__amount" data-js="achievements-counter"
                       data-count="<?php echo esc_attr($meta_data['_meta-completed-requests-num'][0]) ?>">0</p>
                    <p class="list-achievements__item__text"><?php echo esc_html($meta_data['_meta-completed-requests-title'][0]) ?></p>
                </fieldset>
                <fieldset class="list-achievements__item">
                    <legend class="legend">
                    <span class="legend__inner">
                        <span class="legend__left"></span>
                        <span class="legend__content"><span class="web-icon"></span></span>
                        <span class="legend__right"></span>
                    </span>
                    </legend>
                    <p class="list-achievements__item__amount" data-js="achievements-counter"
                       data-count="<?php echo esc_attr($meta_data['_meta-pre-orders-num'][0]) ?>">0</p>
                    <p class="list-achievements__item__text"><?php echo esc_html($meta_data['_meta-pre-orders-title'][0]) ?></p>
                </fieldset>
            </div>
        </div>
    </section>
<?php } ?>