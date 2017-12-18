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
        },
        selectMenu: function () {
            $('[data-js="select"]').selectmenu();
        },
        slider: function () {
            $('[data-js="period-range-slider"]').jRange({
                width: '300',
                from: 3,
                to: 12,
                step: 3,
                scale: [3, 6, 9, 12],
                format: '%s',
                showLabels: true,
                snap: true,
                onstatechange: function (e) {
                    var label = '';

                    if (e === '1') {
                        label = '1 Месяц';
                    } else if (e < 5) {
                        label = e + ' Месяца';
                    } else {
                        label = e + ' Месяцев';
                    }

                    $('[data-view="period-range-slider"]').text(label)
                }
            });
        },
        offerCarousel: function () {
            $('[data-js="offer-carousel"]').owlCarousel({
                items: 1,
                autoHeight: true,
                mouseDrag: false,
                nav: true,
                navSpeed: 400,
                dotsSpeed: 400
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
                if (!$('[data-tab="' + this.dataset.id + '"]').hasClass('--active')) {
                    $(item).hide();
                }
            });

            $tabs.on('click', function () {
                var $this = $(this);

                if (!$this.hasClass('--active')) {
                    // Tab classes update
                    $tabs.removeClass('--active');
                    $this.addClass('--active');

                    // Entry update
                    $entries.hide();
                    $('[data-id="' + this.dataset.tab + '"]').show(0, function () {
                        if ($(this).find('#map').length) {
                            document.dispatchEvent(event);
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
        mobileMenu: function () {
            var $menu = $('[data-js="mob-menu"]');

            $('[data-js="open-mob-menu"]').on('click', function () {
                $menu.addClass('--show');
            });

            $('[data-js="close-mob-menu"]').on('click', function () {
                $menu.removeClass('--show');
            });

            $(window).on('resize', function () {
                $menu.removeClass('--show');
            })
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
        }
    })
});