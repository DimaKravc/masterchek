<?php
if (!function_exists('get_filter')):
    function get_filter($place = Null, $package = Null, $address = Null, $size = Null, $period = Null)
    {
        $args = array(
            'post_type' => 'product',
            'numberposts' => 1,
            'meta_query' => array(
                array(
                    'compare' => '=',
                    'key' => '_stock_status',
                    'value' => 'instock',
                )
            )
        );
        $product = get_posts($args);

        if ($product) {
            $product_id = $product[0]->ID;
            $args = array(
                'post_type' => 'product_variation',
                'post_parent' => $product_id,
                'meta_query' => array(
                    array(
                        'key' => 'attribute_pa_place',
                    ),
                    array(
                        'key' => 'attribute_pa_package',
                    ),
                    array(
                        'key' => 'attribute_pa_size',
                    ),
                    array(
                        'key' => 'attribute_pa_period',
                    ),
                    array(
                        'compare' => '>',
                        'key' => '_price',
                        'value' => 0,
                    ),
                ),
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'numberposts' => -1,
            );
            $variation_posts = get_posts($args);

            if ($variation_posts) {
                $product_variations = array(
                    'places' => array(),
                    'packages' => array(),
                    'addresses' => array(),
                    'sizes' => array(),
                    'periods' => array(),
                );
                $active_variations = array(
                    'place' => $place,
                    'package' => $package,
                    'address' => $address,
                    'size' => $size,
                    'period' => $period,
                    'price' => Null
                );

                foreach ($variation_posts as $key => $post) {
                    $post_meta = get_post_meta($post->ID, '');
                    $post_place_variation = get_term_by('slug', $post_meta['attribute_pa_place'][0], 'pa_place', 'ARRAY_A');
                    $post_address_variation = get_term_by('slug', $post_meta['attribute_pa_address'][0], 'pa_address', 'ARRAY_A');
                    $product_variations['places'][$post_place_variation['slug']] = $post_place_variation;

                    if ($key == 0) {
                        if (!$place) {
                            $active_variations['place'] = $post_place_variation['slug'];
                        }
                    }

                    if ($active_variations['place'] == $post_place_variation['slug']) {
                        $product_variations['packages'][$post_meta['attribute_pa_package'][0]] = True;

                        if (!$package) {
                            reset($product_variations['packages']);
                            $active_variations['package'] = key($product_variations['packages']);
                        }

                        if ($active_variations['package'] == $post_meta['attribute_pa_package'][0]) {
                            if ($post_address_variation) {
                                $product_variations['addresses'][$post_address_variation['slug']] = $post_address_variation;
                            } else {
                                $product_variations['addresses']['-'] = array('slug' => '-', 'name' => '-');
                            }

                            if (!$address) {
                                reset($product_variations['addresses']);
                                $active_variations['address'] = key($product_variations['addresses']);
                            }

                            if ($active_variations['address'] == '-' || $active_variations['address'] == $post_address_variation['slug']) {
                                $product_variations['sizes'][$post_meta['attribute_pa_size'][0]] = True;

                                if (!$size) {
                                    reset($product_variations['sizes']);
                                    $active_variations['size'] = key($product_variations['sizes']);
                                }

                                if ($active_variations['size'] == $post_meta['attribute_pa_size'][0]) {
                                    $product_variations['periods'][$post_meta['attribute_pa_period'][0]] = True;

                                    if (!$period) {
                                        reset($product_variations['periods']);
                                        $active_variations['period'] = key($product_variations['periods']);
                                    }

                                    if ($active_variations['period'] == $post_meta['attribute_pa_period'][0]) {
                                        $active_variations['price'] = $post_meta['_price'][0];
                                    }
                                }
                            }
                        }
                    }
                }  ?>
                <form class="calculation-form" data-node="filter-form">
                    <div class="calculation-form__inner">
                        <div class="calculation-form__item">
                            <label for="place">Место распростронения</label>
                            <div class="styled-select place">
                                <select data-filter="place" name="place" id="place">
                                    <?php foreach ($product_variations['places'] as $place) {
                                        $selected = $place['slug'] == $active_variations['place'] ? 'selected' : '';
                                        echo "<option " . $selected . " value='" . esc_attr($place['slug']) . "'>" . esc_attr($place['name']) . "</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="calculation-form__item">
                            <label>Пакеты</label>
                            <div class="calculation-form__checkboxes-wrap">
                                <div>
                                    <input data-filter="package" <?php echo $active_variations['package'] == 'light-package' ? 'checked' : '' ?> class="styled-radio" type="radio"
                                           name="package"
                                           id="light-package" <?php echo !isset($product_variations['packages']['light-package']) ? 'disabled' : '' ?>>
                                    <label for="light-package">Light</label>
                                </div>
                                <div>
                                    <input data-filter="package" <?php echo $active_variations['package'] == 'max-package' ? 'checked' : '' ?> class="styled-radio" type="radio"
                                           name="package"
                                           id="max-package" <?php echo !isset($product_variations['packages']['max-package']) ? 'disabled' : '' ?>>
                                    <label for="max-package">Max</label>
                                </div>
                                <div>
                                    <input data-filter="package" <?php echo $active_variations['package'] == 'vip-package' ? 'checked' : '' ?> class="styled-radio" type="radio"
                                           name="package"
                                           id="vip-package" <?php echo !isset($product_variations['packages']['vip-package']) ? 'disabled' : '' ?>>
                                    <label for="vip-package">Vip</label>
                                </div>
                            </div>
                        </div>
                        <div class="calculation-form__item">
                            <?php if ($product_variations['addresses']): ?>
                                <label for="address">Адрес распространения</label>
                                <div class="styled-select">
                                    <select data-filter="address" name="address" id="address">
                                        <?php foreach ($product_variations['addresses'] as $address) {
                                            $selected = $address['slug'] == $active_variations['address'] ? 'selected' : '';
                                            echo "<option " . $selected . " value='" . esc_attr($address['slug']) . "'>" . esc_attr($address['name']) . "</option>";
                                        } ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="calculation-form__item">
                            <label>Размер модуля</label>
                            <div class="calculation-form__checkboxes-wrap">
                                <div>
                                    <input data-filter="size" <?php echo $active_variations['size'] == 'small-size' ? 'checked' : '' ?> class="styled-radio" type="radio" name="size"
                                           id="small-size" <?php echo !isset($product_variations['sizes']['small-size']) ? 'disabled' : '' ?>>
                                    <label for="small-size">s</label>
                                </div>
                                <div>
                                    <input data-filter="size" <?php echo $active_variations['size'] == 'middle-size' ? 'checked' : '' ?> class="styled-radio" type="radio" name="size"
                                           id="middle-size" <?php echo !isset($product_variations['sizes']['middle-size']) ? 'disabled' : '' ?>>
                                    <label for="middle-size">m</label>
                                </div>
                                <div>
                                    <input data-filter="size" <?php echo $active_variations['size'] == 'large-size' ? 'checked' : '' ?> class="styled-radio" type="radio" name="size"
                                           id="large-size" <?php echo !isset($product_variations['sizes']['large-size']) ? 'disabled' : '' ?>>
                                    <label for="large-size">l</label>
                                </div>
                                <div>
                                    <input data-filter="size" <?php echo $active_variations['size'] == 'vip-size' ? 'checked' : '' ?> class="styled-radio" type="radio" name="size"
                                           id="vip-size" <?php echo !isset($product_variations['sizes']['vip-size']) ? 'disabled' : '' ?>>
                                    <label for="vip-size">vip</label>
                                </div>
                            </div>
                        </div>
                        <div class="calculation-form__item">
                            <label>Срок размещения</label>
                            <input data-filter="period" type="hidden" id="period" name="period">
                            <div class="period-slider">
                                <span class="period-slider__view" data-view="period-slider"></span>
                                <div class="period-slider__inner">
                                    <div class="round1" data-value="3"></div>
                                    <div class="round2" data-value="6"></div>
                                    <div class="round3" data-value="9"></div>
                                    <div class="round4" data-value="12"></div>
                                    <div data-js="period-slider" data-current="<?php echo $active_variations['period']; ?>"></div>
                                </div>
                            </div>
                        </div>
                        <div class="calculation-form__item total">
                            <label>Итоговая сумма</label>
                            <span data-filter="amount" class="calculation-form__total"><?php echo format_amount($active_variations['price']); ?> Сум</span>
                        </div>
                    </div>
                    <div class="section-calculator__footer">
                        <button class="button">добавить в корзину</button>
                    </div>
                </form>
                <?php
            } else {
                print_r('Not found product variation post!');
            }
        } else {
            print_r('Not found product post!');
        }
    }
endif;

if (!function_exists('format_amount')):
    function format_amount($amount)
    {
        $str = (string)$amount;
        $subst = '$1 ';

        if (strlen($str) == 4) {
            $re = '/^(\d{1})/';
        } elseif (strlen($str) == 5) {
            $re = '/^(\d{2})/';
        } elseif (strlen($str) == 6) {
            $re = '/^(\d{3})/';
        } elseif (strlen($str) == 7) {
            $re = '/^(\d{1})(\d{3})/';
            $subst = '$1 $2 ';
        } elseif (strlen($str) == 8) {
            $re = '/^(\d{2})(\d{3})/';
            $subst = '$1 $2 ';
        } elseif (strlen($str) == 9) {
            $re = '/^(\d{3})(\d{3})/';
            $subst = '$1 $2 ';
        } else {
            return $str;
        }

        return preg_replace($re, $subst, $str);
    }
endif;