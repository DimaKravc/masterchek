<section id="calculator" class="section-calculator">
    <div class="container">
        <div class="section-calculator__header">
            <h2 class="section-calculator__title">Калькулятор</h2>
            <b class="section-calculator__subtitle">вы можете выбрать и рассчитать самы выгодный пакет</b>
        </div>
        <script>
            var filter = {
                distributionPlaces: {
                    1: {
                        name: 'Makro',
                        slug: 'makro',
                        packages: {
                            1: {
                                name: 'Light',
                                slug: 'light',
                                distributionAddress: {
                                    1: {
                                        name: 'Корзинка Чиланзар',
                                        slug: 'korzinka-chilanzar',
                                        size: {
                                            1: {
                                                name: 's',
                                                slug: 'small',
                                                period: {
                                                    1: {
                                                        name: '3',
                                                        slug: '3',
                                                        price: {
                                                            name: '300 000',
                                                            slug: '300000'
                                                        }
                                                    },
                                                    2: {
                                                        name: '6',
                                                        slug: '6',
                                                        price: {
                                                            name: '300 000',
                                                            slug: '300000'
                                                        }
                                                    },
                                                    3: {
                                                        name: '9',
                                                        slug: '9',
                                                        price: {
                                                            name: '300 000',
                                                            slug: '300000'
                                                        }
                                                    },
                                                    4: {
                                                        name: '12',
                                                        slug: '12',
                                                        price: {
                                                            name: '300 000',
                                                            slug: '300000'
                                                        }
                                                    }
                                                }
                                            },
                                            2: {
                                                name: 'm',
                                                slug: 'middle'
                                            },
                                            3: {
                                                name: 'l',
                                                slug: 'large'
                                            },
                                            4: {
                                                name: 'vip',
                                                slug: 'vip'
                                            }
                                        }
                                    }
                                }
                            },
                            2: {
                                name: 'Max',
                                slug: 'max'
                            }
                        }
                    },
                    2: {
                        name: 'Davo',
                        slug: 'davo',
                        packages: {
                            1: {
                                name: 'Light',
                                slug: 'light'
                            },
                            2: {
                                name: 'Max',
                                slug: 'max'
                            },
                            3: {
                                name: 'Vip',
                                slug: 'vip'
                            }
                        }
                    }
                }
            };
        </script>
        <div class="calculation-form">
            <div class="calculation-form__item --place">
                <label for="place-of-distribution">Место распростронения</label>
                <div class="select--wrap">
                    <select data-js="select" name="place-of-distribution" id="place-of-distribution">
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
                <label for="address-of-distribution">Адрес распространения</label>
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
                <input type="hidden" id="period" name="period">
                <div class="period-slider">
                    <span class="period-slider__view" data-view="period-slider"></span>
                    <div class="period-slider__inner">
                        <div class="round1" data-value="3"></div>
                        <div class="round2" data-value="6"></div>
                        <div class="round3" data-value="9"></div>
                        <div class="round4" data-value="12"></div>
                        <div data-js="period-slider"></div>
                    </div>
                </div>
            </div>
            <div class="calculation-form__item total">
                <label>Итоговая сумма</label>
                <span class="calculation-form__total">180.000 Сум</span>
            </div>
        </div>
        <div class="section-calculator__footer">
            <button class="button">добавить в корзину</button>
        </div>
    </div>
</section>