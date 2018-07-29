var left_side_width = 220; //Sidebar width in pixels
$(document).ready(function () {

    //Enable sidebar toggle
    $("[data-toggle='offcanvas']").click(function (e) {
        e.preventDefault();

        //If window is small enough, enable sidebar push menu
        if ($(window).width() <= 992) {
            $('.row-offcanvas').toggleClass('active');
            $('.left-side').removeClass("collapse-left");
            $(".right-side").removeClass("strech");
            $('.row-offcanvas').toggleClass("relative");
        } else {
            //Else, enable content streching
            $('.left-side').toggleClass("collapse-left").toggleClass('animate');
            $('.left-side span').toggleClass("hidden");
            $(".right-side").toggleClass("strech");
        }
    });

    /* Smooth Scroll to Top
    * ====================== */
    $("#totop").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 300);
        return false;
    });
    //notices
    setTimeout(function () {
        $('#msg').slideUp('slow');
    }, 6000);

    //allergies
    $('.new-allergy').hide();
    $('.new-allergy-btn').click(function () {
        $('.new-allergy').toggle('slow');
    });
    //medications
    $('.new-med').hide();
    $('.new-med-btn').click(function () {
        $('.new-med').toggle('slow');
    });
    //food prefs
    $('.new-foodpref').hide();
    $('.new-food-btn').click(function () {
        $('.new-foodpref').toggle('slow');
    });
    //charges
    $('.pay-charge-form').hide();
    $('.pay-charge-btn').click(function () {
        $('.pay-charge-form').hide('fast');
        $(this).closest('tr').next('tr').show('fast');
    });
    //help articles
    $('.help-doc-menu>li>a').click(function () {
        var article_id = $(this).attr('id');
        var thisUrl = window.location.href.split('#')[0];
        var page = thisUrl + '/help_article/' + article_id;

        $('.help-doc').html('loading <img src="../assets/img/loader.gif"/>').load(page);
    });
    //news articles
    $('.news-sidebar>li>a').click(function () {
        var article_id = $(this).attr('id');
        var thisUrl = window.location.href.split('#')[0];
        var page = thisUrl + '/view_article/' + article_id;

        $('.news-article').html('loading <img src="../assets/img/loader.gif"/>').load(page);
    });
    //delete news article
    $('.del-article-btn').click(function () {
        var article_id = $(this).attr('id');
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = '../news/delete/' + article_id;
        }
    });
    //all form inputs have this class
    $('input[type=text],input[type=password]').addClass('form-control');
    $('input[type=submit]').addClass('btn btn-primary');
    //tooltips
    $('.send-mail,.show-pin,.show-tip').tooltip();

    //  /*
    // * Manipulate tabs for redirection history
    // */
    //  // navigate to a tab when the history changes
    //  window.addEventListener("popstate", function (e) {
    //      var activeTab = $('[href=' + location.hash + ']');
    //      if (activeTab.length) {
    //          activeTab.tab('show');
    //      } else {
    //          $('.nav-tabs a:first').tab('show');
    //      }
    //  });
    //  if (window.location.hash) {
    //      var thisTab = window.location.hash.substring(1);
    //      $('#' + thisTab).addClass('active');
    //      var t = $('[href=' + location.hash + ']');
    //      t.tab('show');
    //  } else {
    //      $('.nav-tabs a:first').tab('show');
    //  }
    // // add a hash to the URL when the user clicks on a tab
    $('a[data-toggle="tab"]').on('click', function (e) {
        history.pushState(null, null, $(this).attr('href'));
    });
    /*begin persistent tabs*/
    if (location.hash !== '') {
        $('a[href="' + location.hash + '"]').tab('show');
        return $('a[data-toggle="tab"]').on('shown', function (e) {
            return location.hash = $(e.target).attr('href').substr(1);
        });
    }
    /*end persistent tabs*/
});
$(function () {
    "use strict";
    // $('[data-toggle="popover"]').popover();
    //Editors
    $('.editor').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'hr']]
        ],
    });
    $('.editor-full').summernote();
    $('.editor-media').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'hr']],
            ['code',['video','picture','codeview']]
        ],
    });
});

/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2006, 2014 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    var pluses = /\+/g;

    function encode(s) {
        return config.raw ? s : encodeURIComponent(s);
    }

    function decode(s) {
        return config.raw ? s : decodeURIComponent(s);
    }

    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value));
    }

    function parseCookieValue(s) {
        if (s.indexOf('"') === 0) {
            // This is a quoted cookie as according to RFC2068, unescape...
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            // Replace server-side written pluses with spaces.
            // If we can't decode the cookie, ignore it, it's unusable.
            // If we can't parse the cookie, ignore it, it's unusable.
            s = decodeURIComponent(s.replace(pluses, ' '));
            return config.json ? JSON.parse(s) : s;
        } catch (e) {
        }
    }

    function read(s, converter) {
        var value = config.raw ? s : parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value;
    }

    var config = $.cookie = function (key, value, options) {
        // Write
        if (arguments.length > 1 && !$.isFunction(value)) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setTime(+t + days * 864e+5);
            }
            return (document.cookie = [
                encode(key), '=', stringifyCookieValue(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }
        // Read
        var result = key ? undefined : {};
        // To prevent the for loop in the first place assign an empty array
        // in case there are no cookies at all. Also prevents odd result when
        // calling $.cookie().
        var cookies = document.cookie ? document.cookie.split('; ') : [];
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = parts.join('=');

            if (key && key === name) {
                // If second argument (value) is a function it's a converter...
                result = read(cookie, value);
                break;
            }
            // Prevent storing a cookie that we couldn't decode.
            if (!key && (cookie = read(cookie)) !== undefined) {
                result[name] = cookie;
            }
        }
        return result;
    };
    config.defaults = {};
    $.removeCookie = function (key, options) {
        if ($.cookie(key) === undefined) {
            return false;
        }
        // Must not alter options, thus extending a fresh object...
        $.cookie(key, '', $.extend({}, options, {expires: -1}));
        return !$.cookie(key);
    };

}));

+function ($) {
    'use strict';
    var DataKey = 'lte.boxwidget';

    var Default = {
        animationSpeed: 500,
        collapseTrigger: '[data-widget="collapse"]',
        removeTrigger: '[data-widget="remove"]',
        collapseIcon: 'fa-minus',
        expandIcon: 'fa-plus',
        removeIcon: 'fa-times'
    };
    var Selector = {
        data: '.box',
        collapsed: '.collapsed-box',
        body: '.box-body',
        footer: '.box-footer',
        tools: '.box-tools'
    };
    var ClassName = {
        collapsed: 'collapsed-box'
    };
    var Event = {
        collapsed: 'collapsed.boxwidget',
        expanded: 'expanded.boxwidget',
        removed: 'removed.boxwidget'
    };

    // BoxWidget Class Definition
    // =====================
    var BoxWidget = function (element, options) {
        this.element = element;
        this.options = options;

        this._setUpListeners()
    };
    BoxWidget.prototype.toggle = function () {
        var isOpen = !$(this.element).is(Selector.collapsed);
        if (isOpen) {
            this.collapse()
        } else {
            this.expand()
        }
    };

    BoxWidget.prototype.expand = function () {
        var expandedEvent = $.Event(Event.expanded);
        var collapseIcon = this.options.collapseIcon;
        var expandIcon = this.options.expandIcon;
        $(this.element).removeClass(ClassName.collapsed);
        $(this.element)
            .find(Selector.tools)
            .find('.' + expandIcon)
            .removeClass(expandIcon)
            .addClass(collapseIcon);

        $(this.element).find(Selector.body + ', ' + Selector.footer)
            .slideDown(this.options.animationSpeed, function () {
                $(this.element).trigger(expandedEvent)
            }.bind(this))
    };
    BoxWidget.prototype.collapse = function () {
        var collapsedEvent = $.Event(Event.collapsed);
        var collapseIcon = this.options.collapseIcon;
        var expandIcon = this.options.expandIcon;

        $(this.element)
            .find(Selector.tools)
            .find('.' + collapseIcon)
            .removeClass(collapseIcon)
            .addClass(expandIcon);
        $(this.element).find(Selector.body + ', ' + Selector.footer)
            .slideUp(this.options.animationSpeed, function () {
                $(this.element).addClass(ClassName.collapsed);
                $(this.element).trigger(collapsedEvent)
            }.bind(this))
    };

    BoxWidget.prototype.remove = function () {
        var removedEvent = $.Event(Event.removed);

        $(this.element).slideUp(this.options.animationSpeed, function () {
            $(this.element).trigger(removedEvent);
            $(this.element).remove()
        }.bind(this))
    };

    // Private
    BoxWidget.prototype._setUpListeners = function () {
        var that = this;

        $(this.element).on('click', this.options.collapseTrigger, function (event) {
            if (event) event.preventDefault();
            that.toggle()
        });
        $(this.element).on('click', this.options.removeTrigger, function (event) {
            if (event) event.preventDefault();
            that.remove()
        });
    };

    // Plugin Definition
    // =================
    function Plugin(option) {
        return this.each(function () {
            var $this = $(this);
            var data = $this.data(DataKey);

            if (!data) {
                var options = $.extend({}, Default, $this.data(), typeof option === 'object' && option);
                $this.data(DataKey, (data = new BoxWidget($this, options)))
            }
            if (typeof option === 'string') {
                if (typeof data[option] === 'undefined') {
                    throw new Error('No method named ' + option)
                }
                data[option]()
            }
        })
    }
    var old = $.fn.boxWidget;
    $.fn.boxWidget = Plugin;
    $.fn.boxWidget.Constructor = BoxWidget;
    // No Conflict Mode
    // ================
    $.fn.boxWidget.noConflict = function () {
        $.fn.boxWidget = old;
        return this
    };
    // BoxWidget Data API
    // ==================
    $(window).on('load', function () {
        $(Selector.data).each(function () {
            Plugin.call($(this))
        })
    })

}(jQuery);

function decodeHtml(str) {
    var map =
        {
            '&amp;': '&',
            '&lt;': '<',
            '&gt;': '>',
            '&quot;': '"',
            '&#039;': "'"
        };
    return str.replace(/&amp;|&lt;|&gt;|&quot;|&#039;/g, function (m) {
        return map[m];
    });
}
