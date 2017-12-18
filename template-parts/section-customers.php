<?php $posts_array = get_posts(array('post_type' => 'customers', 'posts_per_page' => 1));
foreach ($posts_array as $post) :
    $gallery = get_post_gallery_images($post);

    if (count($gallery)): ?>
        <section class="section-customers">
            <div class="container">
                <div class="section-customers__header">
                    <h2 class="section-customers__title">НАШИ КЛИЕНТЫ</h2>
                </div>
                <div class="section-customers__carousel owl-carousel" data-js="customers-carousel">
                    <?php foreach ($gallery as $key => $url): ?>
                        <img src="<?php echo esc_url($url) ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>