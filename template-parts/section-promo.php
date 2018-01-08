<section class="section-promo">
    <div class="container">
        <div class="section-promo__col">
            <div class="section-promo__logo">
                <img src="<?php echo get_template_directory_uri(); ?>/images/brand.png" alt="Masterchek">
            </div>
            <h2 class="section-promo__title">реклама на чековых лентах</h2>
            <p class="section-promo__text">Рекламное агентство MasterCheck предлагает вам инновационный маркетинговый
                концепт,
                нововведение, являющееся уникальным по всей Республике Узбекистан.</p>
            <button class="button --light section-promo__button" data-toggle="modal" data-target="#advicePopup">получить консультацию</button>
            <?php get_template_part('template-parts/popup-advice-form'); ?>
        </div>
    </div>
</section>