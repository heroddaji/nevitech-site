!function($) {
    "use strict";

    var Subcontent = function (element, options) {
        this.options = options;
        this.$element = $(element);
        this.$container = $(this.options.container).delegate('[data-dismiss="subcontent"]', 'click.dismiss.subcontent', $.proxy(this.hide, this));
    }

    Subcontent.prototype = {
        constructor: Subcontent,

        toggle: function () {
            return this[!this.isShown ? 'show' : 'hide']();
        },

        show: function() {
            var e = $.Event('show')

            this.$element.trigger(e);

            if (this.isShown || e.isDefaultPrevented()) return;

            this.isShown = true;

            this.$element.show();
            this.$container.animate({height: 'toggle'}, this.options.speed);
            $('html, body').animate({scrollTop: this.$container.offset().top}, this.options.speed);

            this.$element.trigger('shown');
        },

        hide: function(e) {
            e && e.preventDefault();

            e = $.Event('hide');

            this.$element.trigger(e);

            if (!this.isShown || e.isDefaultPrevented()) return;

            this.isShown = false;

            this.$element.fadeOut(250);
            this.$container.animate({height: 'toggle'}, this.options.speed);

            this.$element.trigger('hidden');
        }
    }

    $.fn.subcontent = function (option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data('subcontent'),
                options = $.extend({}, $.fn.subcontent.defaults, $this.data(), typeof option == 'object' && options);

            if (!data) $this.data('subcontent', (data = new Subcontent(this, options)))
            if (typeof option == 'string') data[option]();
            else if (options.show) data.show();
        })
    }

    $.fn.subcontent.Constructor = Subcontent;

    $.fn.subcontent.defaults = {
        speed: 250,
        container: '#subcontent-container',
        show: true
    }

    $(document).on('click.subcontent.data-api', '[data-toggle="subcontent"]', function (e) {
        var $this = $(this),
            $target = $($this.attr('data-target')),
            option = $.extend({}, $target.data(), $this.data());

        e.preventDefault();

        $target.subcontent(option).one('hide', function() {
            $('html, body').animate({scrollTop: $($this.data('callback')).offset().top}, 'slow');
        })
    })
}(window.jQuery);

(function($) {
    $(function() {
        $("img.lazy").lazyload();

        $("form.contact").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true
                }
            }
        });

        $(document).on('click.goto.data-api', '.goto', function (e) {
            var $this = $(this),
                $target = $($this.attr('data-target'));

            e.preventDefault();

            $('html, body').animate({scrollTop: $target.offset().top}, 250);
        });

        $('.nevitech-slider').touchSlider({
            namespace: "nevitech-slider",
            viewport: ".nevitech-slider-viewport",
            next: ".nevitech-slider-next",
            prev: ".nevitech-slider-prev",
            autoplay: true,
            duration: 250,
            delay: 5000
        });

        setTimeout(function() {
            $('#messages').slideUp(150);
        }, 5000);
    });
})(jQuery)

;(function($) {
    "use strict";

    var Portfolio = function(element, options) {
        this.options = options;
        this.$element = $(element);
        this.$nav = this.$element.find('nav')
            .on('click.portfolio.category', '[data-category]', $.proxy(this.loadCategory, this));
        this.$list = this.$element.find(this.options.list);
    }

    Portfolio.prototype = {
        constructor: Portfolio,

        loadCategory: function(e) {
            e && e.preventDefault();

            var that = this,
                $target = $(e.target),
                category = $target.data('category');

            this.$nav.find('a').removeClass('active');
            $target.addClass('active');

            this.$list.fadeTo(this.options.speed, 0, function() {
                $.ajax({
                    url: '/portfolio/bycategory/',
                    type: 'GET',
                    dataType: 'json',
                    data: {category: category},
                    success: function(data) {
                        var html = '';
                        $.each(data, function(i, item) {
                            html += '<li class="grid_3">';
                            html += '<a href="http://' + item._link + '" target="_blank" titile="' + item._name + '">';
                            html += '<img src="/uploads/' + item._image + '" alt="' + item._name +  '" height="147" width="200" />';
                            html += '<div><span>' + item._name + '</span></div>';
                            html += '</a>';
                            html += '</li>';
                        });

                        that.$list.empty().append(html).fadeTo(that.options.speed, 100);

                        that.$element.trigger('loaded');
                    }
                })
            });
        }
    }

    $.fn.portfolio = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data('portfolio'),
                options = $.extend({}, $.fn.portfolio.defaults, $this.data(), typeof option == 'object' && option);

            if (!data) $this.data('portfolio', (data = new Portfolio(this, options)));
            if (typeof option == 'string') data[option]();
        })
    }

    $.fn.portfolio.Constructor = Portfolio;

    $.fn.portfolio.defaults = {
        speed: 150
    }

    $(window).on('load', function() {
        $('[data-create="portfolio"]').each(function() {
            var $portfolio = $(this);
            $portfolio.portfolio($portfolio.data());
        })
    });
})(jQuery)
