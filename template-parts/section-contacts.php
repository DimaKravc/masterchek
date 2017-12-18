<?php $posts_array = get_posts(array('post_type' => 'contacts', 'posts_per_page' => 1));
foreach ($posts_array as $post) :
    $meta_data = get_post_meta($post->ID, '', true);
    $email_address = !empty($meta_data['_meta-contact-mail'][0]) ? $meta_data['_meta-contact-mail'][0] : '';
    $phone_number = !empty($meta_data['_meta-contact-phone'][0]) ? $meta_data['_meta-contact-phone'][0] : '';
    $wh_start = !empty($meta_data['_meta-wh-start'][0]) ? $meta_data['_meta-wh-start'][0] : '';
    $wh_end = !empty($meta_data['_meta-wh-end'][0]) ? $meta_data['_meta-wh-end'][0] : '';
    $instagram_profile = !empty($meta_data['_meta-socials-in'][0]) ? $meta_data['_meta-socials-in'][0] : '';
    $facebook_profile = !empty($meta_data['_meta-socials-fb'][0]) ? $meta_data['_meta-socials-fb'][0] : '';
    $telegram = !empty($meta_data['_meta-socials-tg'][0]) ? $meta_data['_meta-socials-tg'][0] : '' ?>

    <section class="section-contacts">
        <div class="container">
            <div class="section-contacts__top">
                <ul class="list-contacts">
                    <?php if ($email_address): ?>
                        <li class="list-contacts__item">
                            <span class="list-contacts__item__icon --mail"></span>
                            <a href="mailto:<?php echo esc_attr($email_address); ?>"
                               class="list-contacts__item__data"><?php echo esc_html($email_address); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($phone_number): ?>
                        <li class="list-contacts__item">
                            <span class="list-contacts__item__icon --phone"></span>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^\d]/', '', $phone_number)) ?>"
                               class="list-contacts__item__data">тел: <?php echo esc_html($phone_number); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($wh_start && $wh_end): ?>
                        <li class="list-contacts__item">
                            <span class="list-contacts__item__icon --clock"></span>
                            <p class="list-contacts__item__data"><?php echo 'с ' . esc_html($wh_start) . ' до ' . esc_html($wh_end); ?></p>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="section-contacts__bottom">
                <ul class="list-socials">
                    <?php if ($instagram_profile): ?>
                        <li class="list-socials__item">
                            <a class="list-socials__item__profile --in" href="https://www.instagram.com/<?php echo esc_attr($instagram_profile)?>/?hl=ru" target="_blank"></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($facebook_profile): ?>
                        <li class="list-socials__item">
                            <a class="list-socials__item__profile --fb" href="https://www.facebook.com/<?php echo esc_attr($facebook_profile)?>/" target="_blank"></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($telegram): ?>
                        <li class="list-socials__item">
                            <a class="list-socials__item__profile --tg" href="https://telegram.me/<?php echo esc_attr($telegram)?>" target="_blank"></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endforeach; ?>