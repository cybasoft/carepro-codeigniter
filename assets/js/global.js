$(document).ready(function () {
    $('.msg').hide().slideDown('slow').delay(5000).slideUp("slow");

    // add a hash to the URL when the user clicks on a tab
    $('a[data-toggle="tab"]').on('click', function (e) {
        history.pushState(null, null, $(this).attr('href'));
    });
    /*
     * Manipulate tabs for redirection history
     */
    // navigate to a tab when the history changes
    window.addEventListener("popstate", function (e) {
        var activeTab = $('[href=' + location.hash + ']');
        if (activeTab.length) {
            activeTab.tab('show');
        } else {
            $('.nav-tabs a:first').tab('show');
        }
    });
    if (window.location.hash) {
        var thisTab = window.location.hash.substring(1);
        $('#' + thisTab).addClass('active');
        var t = $('[href=' + location.hash + ']');
        t.tab('show');
    } else {
        $('.nav-tabs a:first').tab('show');
    }


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

        $('.help-doc').html('loading <img src="../assets/images/loader.gif"/>').load(page);
    });
    //delete help article
    $('.del-help-btn').click(function () {
        var article_id = $(this).attr('id');
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = '../help/delete/'+article_id;
        }

    });


    //news articles
    $('.news-sidebar>li>a').click(function () {
        var article_id = $(this).attr('id');
        var thisUrl = window.location.href.split('#')[0];
        var page = thisUrl + '/view_article/' + article_id;

        $('.news-article').html('loading <img src="../assets/images/loader.gif"/>').load(page);
    });
    //delete news article
    $('.del-article-btn').click(function () {
        var article_id = $(this).attr('id');
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = '../news/delete/'+article_id;
        }

    });

    //all form inputs have this class
    $('input[type=text],input[type=password]').addClass('form-control');
    $('input[type=submit]').addClass('btn btn-primary');

    //tooltips
    $('.send-mail,.show-pin').tooltip();

    $('.delete').click(function(e){
        var loc =$(this).attr('href');
        swal({
            title:'Please confirm',
            text:'You are about to delete a record...',
            type:'warning',
            showCancelButton:true,
            confirmButtonColor:'#DD6B55',
            confirmButtonText:'Yes, Do it!',
            closeOnConfirm:false
        },function(){
            swal('processing...');
            if(loc !=undefined)
                window.location.href=loc;
        });
        e.preventDefault();
    });

    /*begin persistent tabs*/
    if (location.hash !== ''){
        $('a[href="' + location.hash + '"]').tab('show');
        return $('a[data-toggle="tab"]').on('shown', function(e) {
            return location.hash = $(e.target).attr('href').substr(1);
        });
    }
    /*end persistent tabs*/
});

$(function () {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

    $('.daterange').daterangepicker(
        {
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
                'Last 30 Days': [moment().subtract('days', 29), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            startDate: moment().subtract('days', 29),
            endDate: moment()
        },
        function (start, end) {
            alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });


    //The Calender
    $("#calendar").datepicker();

    var todo = $('.todo-list');
    todo.sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();

    todo.todolist({
        onCheck: function (ele) {
        },
        onUncheck: function (ele) {
        }
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
        } catch(e) {}
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
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
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
        $.cookie(key, '', $.extend({}, options, { expires: -1 }));
        return !$.cookie(key);
    };

}));

