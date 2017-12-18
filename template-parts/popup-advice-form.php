<div class="modal --advice fade" id="advicePopup" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
        <div class="modal-content">
            <div class="advice">
                <div class="advice__form">
                    <form action="" class="form" data-form="advice">
                        <div class="form__group">
                            <label for="author">Ф.И.О.</label>
                            <input data-js="input" type="text" id="author" name="author" required autocomplete="off">
                        </div>
                        <div class="form__group">
                            <label for="email">Email</label>
                            <input data-js="input" type="email" id="email" name="email" required autocomplete="off"
                                   onkeypress='return /[^А-ЯЁа-яё]/.test(event.key)'>
                        </div>
                        <div class="form__group">
                            <label for="tel">Телефон</label>
                            <input data-js="input" type="tel" id="tel" name="tel" required autocomplete="off"
                                   onkeypress='return /[\d()+\-\s]/.test(event.key)'>
                        </div>
                        <div class="form__group --select">
                            <label for="subject">Тематика вопроса</label>
                            <select data-js="select" name="subject" id="subject">
                                <option value="Как работает реклама на чеках">Как работает реклама на чеках</option>
                                <option value="Индивидуальный дизайн">Индивидуальный дизайн</option>
                                <option value="Места распространения">Места распространения</option>
                                <option value="Нужна консультация">Нужна консультация</option>
                            </select>
                        </div>
                        <div class="form__group">
                            <label for="message">Сообщение</label>
                            <textarea data-js="textarea" id="message" name="message"
                                      required autocomplete="off"></textarea>
                        </div>
                        <?php wp_nonce_field('request_for_advice'); ?>
                        <input type="hidden" name="action" value="request_for_advice"/>
                        <div class="form__control">
                            <input type="submit" class="button" value="Отправить">
                        </div>
                        <div data-tooltip="success" style="display: none">
                            <div class="form__success-tooltip">Ваш запрос успешно отправлен.</div>
                        </div>
                        <div data-tooltip="error" style="display: none">
                            <div class="form__error-tooltip">Запрос не отправлени, попробуйте еще раз.</div>
                        </div>
                    </form>
                </div>
                <div class="advice__content">
                    <h3 class="advice__title">Вы можете отправить <br>
                        нам свой вопрос, <br>
                        предложение или <br>
                        замечание. <br>
                        наши специалисты <br>
                        ответят Вам <br>
                        как можно скорее.</h3>
                    <hr>
                    <p>Пожалуйста, заполните поля в форме.</p>
                </div>
            </div>
        </div>
    </div>
</div>