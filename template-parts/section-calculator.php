<section id="calculator" class="section-calculator">
    <div class="container">
        <div class="section-calculator__header">
            <h2 class="section-calculator__title">Калькулятор</h2>
            <b class="section-calculator__subtitle">вы можете выбрать и рассчитать самы выгодный пакет</b>
        </div>
        <!--<pre>
            <?php
/*            //$query = new WP_Query( array('tax_query' => array(37,47)) );
            //print_r($query);
            //print_r(get_post_taxonomies(223));
            //print_r(wp_get_post_terms(223, 'wpsc-variation'));
//            print_r(get_terms(array(
//                'taxonomy' => 'wpsc-variation',
//                'hide_empty' => false,
//            ) ));
//            $args = array(
//                'post_parent' => 84,
//                'post_type'   => 'any',
//                'numberposts' => -1,
//                'post_status' => 'any'
//            );
//            $children = get_children( $args );
//            print_r($children)
            */?>
        </pre>-->
        <div class="calculation-form">
            <div class="calculation-form__item --place">
                <label for="place-of-distribution">Место распростронения</label>
                <div class="select--wrap">
                    <select data-js="select" name="place-of-distribution" id="place-of-distribution">
                        <option value="macro">Макро</option>
                        <option value="korzinka">Корзинка</option>
                        <option value="davo">Аптеки Davo</option>
                    </select>
                </div>
            </div>
            <div class="calculation-form__item">
                <label>Пакеты</label>
                <div class="calculation-form__checkboxes-wrap">
                    <div>
                        <input class="styled-checkbox" type="checkbox" name="light-package" id="light-package">
                        <label for="light-package"><span class="checkbox-icon"></span>Light</label>
                    </div>

                    <div>
                        <input class="styled-checkbox" type="checkbox" name="max-package" id="max-package" disabled>
                        <label for="max-package"><span class="checkbox-icon"></span>Max</label>
                    </div>

                    <div>
                        <input class="styled-checkbox" type="checkbox" name="vip-package" id="vip-package" checked="checked">
                        <label for="vip-package"><span class="checkbox-icon"></span>vip</label>
                    </div>
                </div>
            </div>
            <div class="calculation-form__item">
                <label for="address-of-distribution">Адрес распростронения</label>
                <select data-js="select" name="address-of-distribution" id="address-of-distribution">
                    <option value="0">ул. Ю.Х.Ходжиб, 1А</option>
                    <option value="1">ул. Кичик Халка Йули, 87А</option>
                    <option value="2">ул. Абая, 13</option>
                    <option value="3">ул. Кичик Халка Йули, 57</option>
                </select>
            </div>
            <div class="calculation-form__item">
                <label>Размер модуля</label>
                <div class="calculation-form__checkboxes-wrap">
                    <div>
                        <input class="styled-checkbox" type="checkbox" name="s-module-size" id="s-module-size">
                        <label for="s-module-size"><span class="checkbox-icon"></span>s</label>
                    </div>

                    <div>
                        <input class="styled-checkbox" type="checkbox" name="l-module-size" id="l-module-size">
                        <label for="l-module-size"><span class="checkbox-icon"></span>l</label>
                    </div>

                    <div>
                        <input class="styled-checkbox" type="checkbox" name="m-module-size" id="m-module-size">
                        <label for="m-module-size"><span class="checkbox-icon"></span>m</label>
                    </div>

                    <div>
                        <input class="styled-checkbox" type="checkbox" name="vip-module-size" id="vip-module-size">
                        <label for="vip-module-size"><span class="checkbox-icon"></span>vip</label>
                    </div>
                </div>
            </div>
            <div class="calculation-form__item">
                <label>Срок размещения</label>
                <div class="period-range-slider">
                    <label class="ran" type="text" data-view="period-range-slider">3 месяца</label>
                    <input data-js="period-range-slider" value="3"/>
                </div>
            </div>
            <div class="calculation-form__item --total">
                <label>Итоговая сумма</label>
                <span class="calculation-form__total">180.000 Сум</span>
            </div>
        </div>
        <div class="section-calculator__footer">
            <button class="button">добавить в корзину</button>
        </div>
    </div>
</section>