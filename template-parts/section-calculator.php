<section id="calculator" class="section-calculator">
    <div class="container">
        <div class="section-calculator__header">
            <h2 class="section-calculator__title">Калькулятор</h2>
            <b class="section-calculator__subtitle">вы можете выбрать и рассчитать самы выгодный пакет</b>
        </div>
        <div class="calculation-form--wrap">
            <div data-node="ajax-overlay" class="loading-overlay">
                <div class="preloader"></div>
            </div>
            <div data-area="filter">
                <?php get_filter(); ?>
            </div>
        </div>
    </div>
</section>