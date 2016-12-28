/**
 * iA4 – by Information Architects
 * Author: iA
 * http://ia.net
 */
var iA4 = (function($) {
    /**
     * Jetpack contact form markup optimization
     */
    $(".contact-form :input").each(function(index, elem) {
        var eId = $(elem).attr("id");
        var label = null;
        if (eId && (label = $(elem).parents("form").find("label[for=" + eId + "]")).length == 1) {
            $(elem).attr("placeholder", $(label).text());
            $(label).remove();
        }
    });

    /**
     * Private methods
     */
    var methods = {
        /**
         * Toggle the search bar
         */
        toggleSearch: function(e) {
            var input = $('.navigation input');
            $('.search').toggleClass('current_page_item');

            // focus input on click
            if (!$('body').hasClass('mobile')) {
                setTimeout(function() {
                    input.focus();
                }, 1);
            }

            $('body').toggleClass('searching');

            if (!$('body').hasClass('searching')) {
                $('#result #iA4search').fadeOut('fast');
                $('#result').height(0);
                input.val('').blur();
            }
            $("#searchterm").focus();

            setTimeout(function() {
                $('#result').empty();
            }, 450);
        },

        /**
         * Toggle the mobile menu
         */
        toggleMenu: function() {
            $('body').toggleClass('menu-open');
        },

        /**
         * Load search results
         */
        search: function(ev) {
            // escape
            if (ev.keyCode === 27) {
                return methods.toggleSearch();
            }

            var val = $.trim(this.value),
                result = $('#result');

            $('.menu').toggleClass('hidden', val.length > 0);

            // start searching from one word
            if (!val.length)  { 
                result.height(0);
                setTimeout(function() {
                    $('#result').empty();
                }, 350);
                return true;
            }

            if (val.length < 2) {
                return false;
            }

            $("#result").load(ia4ajax.homeurl + '/?s=' + encodeURIComponent(val) + ' #iA4search', function() {
                var height = result.find('#iA4search').height() + 64;
                result.height(height);
                result.find('h2, p:not(.meta--blog)').highlight(val);
            });
        },

        /**
         * Trigger actions when certain keys are pressed and no input is focussed
         */
        keyboardShortcuts: function(e) {
            if ($(':input:focus').size() === 0) {
                var key = e.keyCode ? e.keyCode : e.which;
                
                if (key === 83) {
                    // Bind "s" key to search
                    methods.toggleSearch();
                    e.preventDefault();
                }
            }
        },

        adjustPlaceholder: function(ev) {
            $(window.document).width() > 767 ? $('#searchterm').attr('placeholder', 'What are you looking for?') : $('#searchterm').attr('placeholder', 'Search');
        },

        registerEvents: function() {
            $('[class*=js-action]').off().on('click.ia4', function(e) {
                e.preventDefault();
                methods[$(this).attr('data-action')].call(this, e);
            });
        }
    };

    $('.js-search').on('keyup', $.debounce(250, methods.search));
    $(window).on('resize', methods.adjustPlaceholder);
    $(document).on('keydown', methods.keyboardShortcuts);

    return {
        initialize: function() {
            methods.registerEvents();
            methods.adjustPlaceholder();
        },
    };

})(window.iA4 = jQuery || {});

iA4.initialize();
