<div class="modal modal_checkout fade" id="checkoutModal" tabindex="-1" role="dialog">
    <div class="aligner">
        <div class="aligner__inner">
            <div class="modal-dialog" role="document">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
                <div class="modal-content">
                    <div class="checkout">
                        <div class="checkout__order">
                            <div class="checkout-header">
                                <h3 class="checkout-header__heading"><span class="i-basket"></span>Корзина</h3>
                                <dl class="checkout__total">
                                    <dt>Общий итог:</dt>
                                    <dd>753.000 сум</dd>
                                </dl>
                            </div>
                            <div class="order">
                                <ul class="order__tab-list">
                                    <li class="order__tab-list__item">
                                        <button class="order__tab active" data-tab="#order-1">
                                            <a href="#" class="order__cancel" data-order="1"></a>
                                            Заказ №1
                                        </button>
                                    </li>
                                    <li class="order__tab-list__item">
                                        <button class="order__tab" data-tab="#order-2">
                                            <a href="#" class="order__cancel" data-order="2"></a>
                                            Заказ №2
                                        </button>
                                    </li>
                                    <li class="order__tab-list__item">
                                        <button class="order__tab" data-tab="#order-3">
                                            <a href="#" class="order__cancel" data-order="3"></a>
                                            Заказ №3
                                        </button>
                                    </li>
                                </ul>
                                <div class="order__item" data-id="#order-1">
                                    <dl class="order__item__row">
                                        <dt>Место распростронения:</dt>
                                        <dd>makro</dd>
                                    </dl>
                                    <dl class="order__item__row">
                                        <dt>Адрес:</dt>
                                        <dd>ТАШКЕНТ Чиланзарский район ул. МУКИМИ, 1А</dd>
                                    </dl>
                                    <dl class="order__item__row">
                                        <dt>Пакет:</dt>
                                        <dd>лайт</dd>
                                    </dl>
                                    <dl class="order__item__row">
                                        <dt>Размер модуля:</dt>
                                        <dd>L</dd>
                                    </dl>
                                    <dl class="order__item__row">
                                        <dt>Срок размещения:</dt>
                                        <dd>3 месяца</dd>
                                    </dl>
                                    <div class="order__item__footer">
                                        <dl class="order__item__total">
                                            <dt>итоговая сумма заказа№ 1:</dt>
                                            <dd>180.000 сум</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__form">
                            <form class="form" data-form="advice">
                                <div class="form__group">
                                    <label for="name">Ф.И.О.</label>
                                    <input data-js="input" type="text" id="name" name="name" required
                                           autocomplete="off">
                                </div>
                                <div class="form__group">
                                    <label for="org">Организация</label>
                                    <input data-js="input" type="text" id="org" name="org"
                                           autocomplete="off">
                                </div>
                                <div class="form__group">
                                    <label for="email">Email</label>
                                    <input data-js="input" type="email" id="email" name="email" required
                                           autocomplete="off"
                                           onkeypress='return /[^А-ЯЁа-яё]/.test(event.key)'>
                                </div>
                                <div class="form__group">
                                    <label for="tel">Телефон</label>
                                    <input data-js="input" type="tel" id="tel" name="tel" required
                                           autocomplete="off"
                                           onkeypress='return /[\d()+\-\s]/.test(event.key)'>
                                </div>
                                <?php wp_nonce_field('request_for_order'); ?>
                                <input type="hidden" name="action" value="request_for_order"/>
                                <div class="form__control">
                                    <input type="submit" class="button" value="оформить заказ">
                                </div>
                                <div data-tooltip="success" style="display: none">
                                    <div class="form__success-tooltip">Ваш запрос успешно отправлен.</div>
                                </div>
                                <div data-tooltip="error" style="display: none">
                                    <div class="form__error-tooltip">Запрос не отправлени, попробуйте еще раз.</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>