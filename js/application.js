jQuery(document).ready(function ($) {
    'use strict';

    /**
     *  Application Init
     *  Init Application widgets and components.
     */

    Application.init({
        preLoader: function () {
            var $loader = $('[data-js="loader"]');
            var countLoader = 1;
            var timer;

            function loaderSvg() {
                $loader.find('text').attr('fill', 'url(#pattern' + countLoader + ')');
                countLoader = countLoader < $loader.find('pattern').length ? countLoader + 1 : 1;
            }

            function stopLoader() {
                $loader.fadeOut(300);
                clearInterval(timer);
            }

            $(document).on('ready', function () {
                if ($loader.find('pattern').length) {
                    timer = setInterval(
                        function () {
                            loaderSvg();
                        }, 200);
                }
            });

            $(window).on('load', function () {
                if ($loader.find('pattern').length) {
                    setTimeout(stopLoader, 900);
                }
            });

            return $loader
        },
        goTo: function () {
            var $linkTo = $('a[href^="#"]');
            $linkTo.on('click', function (event) {
                event.preventDefault();

                var offset = $.attr(this, 'href') === '#rates' && $(window).width() < 1400 ? 90 : 0


                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).offset().top + offset
                }, 500);
            })
        },
        offerCarousel: function () {
            $(window).load(function () {
                $('[data-js="offer-carousel"]').owlCarousel({
                    items: 1,
                    autoHeight: true,
                    mouseDrag: false,
                    nav: true,
                    navSpeed: 400,
                    dotsSpeed: 400
                });
            });
        },
        achievementsCounter: function () {
            var $counters = $('[data-js="achievements-counter"]');
            var didScroll = false;
            if (!$counters.length) return;

            var startAnimation = function () {
                if (!didScroll) {
                    $counters.each(function (index, value) {
                        var currentNumber = $(value).text();
                        var targetNumber = value.dataset.count

                        $({numberValue: currentNumber}).animate({numberValue: targetNumber}, {
                            duration: 4000,
                            easing: 'linear',
                            step: function () {
                                $(value).text(Math.ceil(this.numberValue));
                            }
                        });
                    });
                }
            };

            $(window).on('scroll', function () {
                if ($(this).height() + $(this).scrollTop() > $counters.offset().top) {
                    startAnimation();
                    didScroll = true;
                }
            });
        },
        tabs: function () {
            var $tabs = $('[data-tab]');
            var $entries = $('[data-id]');
            var event = new Event('change.tabs');

            $entries.each(function (index, item) {
                if (!$('[data-tab="' + this.dataset.id + '"]').hasClass('active')) {
                    $(item).hide();
                }
            });

            $tabs.on('click', function () {
                var $this = $(this);

                if (!$this.hasClass('active')) {
                    // Tab classes update
                    $tabs.removeClass('active');
                    $this.addClass('active');

                    // Entry update
                    $entries.hide();
                    $('[data-id="' + this.dataset.tab + '"]').show(0, function () {
                        if ($(this).find('#map').length) {
                            $(this).closest('.section-points').addClass('map_show')
                            document.dispatchEvent(event);
                        } else {
                            if ($(this).closest('.section-points').length) {
                                $(this).closest('.section-points').removeClass('map_show')
                            }
                        }
                    });
                }
            });
        },
        customerCarousel: function () {
            $('[data-js="customers-carousel"]').owlCarousel({
                items: 4,
                margin: 75,
                loop: true,
                autoWidth: false,
                autoplay: true,
                autoHeight: true,
                autoplayHoverPause: true,
                navSpeed: 400,
                dotsSpeed: 400,
                autoplaySpeed: 400,
                responsive: {
                    0: {
                        autoplay: false,
                        items: 1,
                        margin: 0
                    },
                    576: {
                        items: 2,
                        margin: 30
                    },
                    768: {
                        items: 3,
                        margin: 30
                    },
                    991: {
                        items: 4,
                        margin: 30
                    }
                }
            });
        },
        inputFocus: function () {
            $('[data-js="input"]').focusin(
                function () {
                    $(this).parent().addClass('--input-focused')
                }).focusout(
                function () {
                    $(this).parent().removeClass('--input-focused')
                }
            );

            $('[data-js="textarea"]').focusin(
                function () {
                    $(this).parent().addClass('--textarea-focused')
                }).focusout(
                function () {
                    $(this).parent().removeClass('--textarea-focused')
                }
            );
        },
        advice: function () {
            $('[data-form="advice"]').on('submit', function (e) {
                e.preventDefault();

                var $this = $(this);
                var $smbBtn = $this.find('input.button');
                var serializeData = $this.serialize();

                $this.removeClass('--submit-success --submit-error');
                $smbBtn.prop('disabled', true);

                $.ajax({
                    type: 'post',
                    url: mch_ajax_data.url,
                    data: serializeData,
                    success: function () {
                        $smbBtn.prop('disabled', false);
                        $this.trigger("reset").find('[data-tooltip="success"]').slideToggle();
                        setTimeout(function () {
                            $this.find('[data-tooltip="success"]').slideToggle()
                        }, 2000);
                    },
                    error: function () {
                        $smbBtn.prop('disabled', false);
                        $this.find('[data-tooltip="error"]').slideToggle();
                        setTimeout(function () {
                            $this.find('[data-tooltip="error"]').slideToggle()
                        }, 2000);
                    }
                })
            })
        },
        filter: function () {
            var $filterAreaNode = $('[data-area="filter"]');
            var $tabsAreaNode = $('[data-area="tabs"]');
            var $tabsEntryAreaNode = $('[data-area="tab-entry"]');
            var $checkoutTriggerNode = $('[data-action="checkout"]');
            var $ajaxOverlayNode = $('[data-node="ajax-overlay"]');
            var data = {};
            var checkoutStorage = [];
            var $smbBtn = $('[data-order="submit"]');

            $checkoutTriggerNode.on('click', function (e) {
                if (!checkoutStorage.length) {
                    return false
                }
            });

            function initSlider() {
                var $sliderNode = $('[data-js="period-slider"]');
                var $viewNode = $('[data-view="period-slider"]');
                var $pointNode = $('.period-slider').find('[class^="round"]');
                var currentStep = $sliderNode.data('current');

                $sliderNode.slider({
                    min: 3,
                    max: 12,
                    step: 3,
                    value: currentStep,
                    slide: function (event, ui) {
                        $('input#period').val(ui.value).trigger('change');
                        $viewNode.text(getMonthEnding(ui.value));
                        $(this).parent().attr('data-step', ui.value / $(this).slider('option', 'step'));
                    },
                    change: function (event, ui) {
                        $('input#period').val(ui.value).trigger('change');
                        $viewNode.text(getMonthEnding(ui.value));
                        $(this).parent().attr('data-step', ui.value / $(this).slider('option', 'step'));
                    },
                    create: function () {
                        $('input#period').val(currentStep);
                        $viewNode.text(getMonthEnding(currentStep));
                        $(this).parent().attr('data-step', currentStep / $(this).slider('option', 'step'));
                    }
                });
                $('input#period').val($sliderNode.slider('value'));
                $viewNode.text(getMonthEnding($sliderNode.slider('value')));
                $pointNode.on('click', function (event) {
                    event.preventDefault();

                    $sliderNode.slider('option', 'value', this.dataset.value);
                });

                function getMonthEnding(val) {
                    var objNumbers = String(val).split('');
                    var lastChar = objNumbers[objNumbers.length - 1];
                    var penultChar = objNumbers[objNumbers.length - 2];

                    if (lastChar === '1' && penultChar !== '1') {
                        return val + ' Месяц';
                    }

                    if ((lastChar === '2' || lastChar === '3' || lastChar === '4') && penultChar !== '1') {
                        return val + ' Месяца';
                    }

                    return val + ' Месяцев';
                }

                return $sliderNode;
            }

            function updateFilter() {
                $ajaxOverlayNode.fadeIn(100);
                data['action'] = 'request_for_filter';
                data['nonce_code'] = mch_ajax_data.nonce;
                $.ajax({
                    type: 'post',
                    url: mch_ajax_data.url,
                    data: data,
                    success: function (data) {
                        $filterAreaNode.html(data);
                        refreshDom();
                    },
                    complete: function () {
                        $ajaxOverlayNode.fadeOut(50);
                    }
                })
            }

            function refreshDom() {
                var $filterFormNode = $('[data-node="filter-form"]');
                var $placeFieldNode = $('[data-filter="place"]');
                var $packageFieldNode = $('[data-filter="package"]');
                var $addressFieldNode = $('[data-filter="address"]');
                var $sizeFieldNode = $('[data-filter="size"]');
                var $viewNode = $('[data-view="period-slider"]');
                var $periodFieldNode = $('[data-filter="period"]');
                var $amountFieldNode = $('[data-filter="amount"]');
                data = {};

                $placeFieldNode.on('change', function (e) {
                    e.preventDefault();

                    data['place'] = $placeFieldNode.val();
                    updateFilter();
                });
                $packageFieldNode.on('change', function (e) {
                    e.preventDefault();

                    data['place'] = $placeFieldNode.val();
                    data['package'] = $packageFieldNode.filter(':checked').attr('id');
                    updateFilter();
                });
                $addressFieldNode.on('change', function (e) {
                    e.preventDefault();

                    data['place'] = $placeFieldNode.val();
                    data['package'] = $packageFieldNode.filter(':checked').attr('id');
                    data['address'] = $addressFieldNode.val();
                    updateFilter();
                });
                $sizeFieldNode.on('change', function (e) {
                    e.preventDefault();

                    data['place'] = $placeFieldNode.val();
                    data['package'] = $packageFieldNode.filter(':checked').attr('id');
                    data['address'] = $addressFieldNode.val();
                    data['size'] = $sizeFieldNode.filter(':checked').attr('id');
                    updateFilter();
                });
                $periodFieldNode.on('change', function (e) {
                    e.preventDefault();

                    data['place'] = $placeFieldNode.val();
                    data['package'] = $packageFieldNode.filter(':checked').attr('id');
                    data['address'] = $addressFieldNode.val();
                    data['size'] = $sizeFieldNode.filter(':checked').attr('id');
                    data['period'] = $periodFieldNode.val();
                    updateFilter();
                });

                initSlider();

                $filterFormNode.on('submit', function (e) {
                    e.preventDefault();

                    var order = {
                        place: $placeFieldNode.find('option').filter(':selected').text(),
                        package: $packageFieldNode.filter(':checked').next().text(),
                        address: $addressFieldNode.find('option').filter(':selected').text(),
                        size: $sizeFieldNode.filter(':checked').next().text(),
                        period: $viewNode.text(),
                        amount: $amountFieldNode.text()
                    };
                    checkoutStorage.push(order);

                    $placeFieldNode.trigger('change');

                    updateCheckout();
                });
            }

            function updateCheckout() {
                updateTotalView();

                $tabsAreaNode.html(genNewTab());
                $tabsEntryAreaNode.html(genNewEntry());

                updateCountView();
                tabsInit();
                cancelsInit();

                if (!checkoutStorage.length) {
                    $tabsEntryAreaNode.html(generateCardEmpty());
                    $smbBtn.prop('disabled', true);
                } else {
                    $smbBtn.prop('disabled', false);
                }
            }

            function genNewTab() {
                var tabCollection = '';
                for (var i = 1; i <= checkoutStorage.length; i++) {
                    updateTotalView(checkoutStorage[i-1]['amount'])
                    tabCollection += '<li class="order__tab-list__item">' +
                        '   <button class="order__tab ' + (i === 1 ? 'active' : '') + '" data-tab="#order-' + i + '">' +
                        '       <a href="#" class="order__cancel" data-order="' + i + '"></a>Заказ № ' + i +
                        '   </button>' +
                        '</li>';
                }
                return tabCollection;
            }

            function genNewEntry() {
                var entryCollection = '';
                for (var i = 1; i <= checkoutStorage.length; i++) {
                    entryCollection += '<div class="order__item" data-id="#order-' + i + '">' +
                        '       <dl class="order__item__row">' +
                        '           <dt>Место распростронения:</dt>' +
                        '           <dd>' + checkoutStorage[i-1].place + '</dd>' +
                        '       </dl>' +
                        '       <dl class="order__item__row">' +
                        '           <dt>Адрес:</dt>' +
                        '           <dd>' + checkoutStorage[i-1].address + '</dd>' +
                        '       </dl>' +
                        '       <dl class="order__item__row">' +
                        '           <dt>Пакет:</dt>' +
                        '           <dd>' + checkoutStorage[i-1].package.toUpperCase() + '</dd>' +
                        '       </dl>' +
                        '       <dl class="order__item__row">' +
                        '           <dt>Размер модуля:</dt>' +
                        '           <dd>' + checkoutStorage[i-1].size.toUpperCase() + '</dd>' +
                        '       </dl>' +
                        '       <dl class="order__item__row">' +
                        '           <dt>Срок размещения:</dt>' +
                        '           <dd>' + checkoutStorage[i-1].period + '</dd>' +
                        '       </dl>' +
                        '       <div class="order__item__footer">' +
                        '           <dl class="order__item__total">' +
                        '               <dt>итоговая сумма заказа № ' + i + ':</dt>' +
                        '               <dd>' + checkoutStorage[i-1].amount + '</dd>' +
                        '           </dl>' +
                        '       </div>' +
                        '   </div>';
                }

                return entryCollection;
            }

            function generateCardEmpty() {
                return '<p class="bag-empty">Ваша корзина пуста</p>';
            }

            function updateCountView() {
                $('[data-view="count"]').text(checkoutStorage.length);
            }

            var total = 0;
            function updateTotalView(amount) {
                if (!amount) {
                    total = 0
                } else {
                    amount = Number(amount.replace(/\D/g, ''));
                    total = Number((total + amount).toFixed(10));
                }

                var str = String(total);
                var formatted;

                if (str.length === 4) {
                    formatted = str.replace(/^(\d{2})/g, '$1 ');
                } else if (str.length === 6) {
                    formatted = str.replace(/^(\d{3})/g, '$1 ');
                } else if (str.length === 7) {
                    formatted = str.replace(/^(\d{1})(\d{3})/g, '$1 $2 ');
                } else if (str.length === 8) {
                    formatted = str.replace(/^(\d{2})(\d{3})/g, '$1 $2 ');
                } else if (str.length === 9) {
                    formatted = str.replace(/^(\d{3})(\d{3})/g, '$1 $2 ');
                } else {
                    formatted = str;
                }

                $('[data-view="total"]').text(formatted + ' Сум');

            }

            function tabsInit() {
                var $tabs = $tabsAreaNode.find('[data-tab]');
                var $entries = $tabsEntryAreaNode.find('[data-id]');

                $entries.each(function (index, item) {
                    if (!$('[data-tab="' + this.dataset.id + '"]').hasClass('active')) {
                        $(item).hide();
                    }
                });

                $tabs.unbind('click');
                $tabs.on('click', function () {
                    var $this = $(this);

                    if (!$this.hasClass('active')) {
                        // Tab classes update
                        $tabs.removeClass('active');
                        $this.addClass('active');

                        // Entry update
                        $entries.hide();
                        $('[data-id="' + this.dataset.tab + '"]').show(0);
                    }
                });
            }

            function cancelsInit() {
                var $trigger = $tabsAreaNode.find('[data-order]');

                $trigger.unbind('click');
                $trigger.on('click', function (e) {
                    e.preventDefault();

                    var order = this.dataset.order;

                    checkoutStorage.splice(order - 1, 1);

                    updateCheckout();
                })
            }

            $('[data-form="order"]').on('submit', function (e) {
                e.preventDefault();

                $smbBtn.prop('disabled', true);
                var $this = $(this);

                data = {}
                data['action'] = 'request_for_order';
                data['nonce_code'] = mch_ajax_data.nonce_order;
                data['orders'] = checkoutStorage
                data['name'] = this.elements['name'].value
                data['org'] = this.elements['org'].value
                data['email'] = this.elements['email'].value
                data['tel'] = this.elements['tel'].value
                $.ajax({
                    type: 'post',
                    url: mch_ajax_data.url,
                    data: data,
                    success: function () {
                        $smbBtn.prop('disabled', false);
                        $this.trigger("reset").find('[data-tooltip="success"]').slideToggle();
                        setTimeout(function () {
                            $this.find('[data-tooltip="success"]').slideToggle()
                        }, 2000);
                        checkoutStorage = [];
                        updateCheckout()
                    },
                    error: function () {
                        $smbBtn.prop('disabled', false);
                        $this.find('[data-tooltip="error"]').slideToggle();
                        setTimeout(function () {
                            $this.find('[data-tooltip="error"]').slideToggle()
                        }, 2000);
                    }
                })
            });

            $(window).on('load', refreshDom);
        }
    })
});