<?php $posts_array = get_posts(array('post_type' => 'offers', 'posts_per_page' => 1));
foreach ($posts_array as $post) :
    $gallery = get_post_gallery_images($post);

    if (count($gallery)): ?>
        <section class="section-offer">
            <div class="container">
                <div class="section-offer__header">
                    <h2 class="section-offer__title">Специальные предложения</h2>
                    <b class="section-offer__subtitle">рекламные акции, лотереи, купоны, скидки</b>
                </div>
                <div class="section-offer__carousel owl-carousel" data-js="offer-carousel">
                    <?php foreach ($gallery as $key => $url): ?>
                        <img src="<?php echo esc_url($url) ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endforeach; ?>