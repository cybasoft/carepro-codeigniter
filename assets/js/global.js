$(document).ready(function () {

    //Enable sidebar toggle
    $("[data-toggle='offcanvas']").click(function (e) {
        e.preventDefault();

        $('.left-side').toggleClass("collapse-left").toggleClass('animate');
        $('.user-info').toggleClass("hidden");
        $(".right-side").toggleClass("strech");
        $('.left-menu-link-info').toggleClass("hidden");
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

    //charges
    $('.pay-charge-form').hide();
    $('.pay-charge-btn').click(function () {
        $('.pay-charge-form').hide('fast');
        $(this).closest('tr').next('tr').show('fast');
    });

    //tooltips
    $('.send-mail,.show-pin,.show-tip').tooltip();

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
        ]
    });

    $('#attendance').DataTable({
        buttons: [
            'pdf'
        ]
    });
    $('#datatable').DataTable();
    $('#users').DataTable({
        buttons: [
            'pdf'
        ]
    });

    //lockscreen
    if (lockScreenTimer === undefined || lockScreenTimer ==="")
        lockScreenTimer = 5;

    var lockTimer = 1320000 * lockScreenTimer;

    $('.lock-screen').click(function () {
        startLockscreen();
    });

    setTimeout(function () {
        startLockscreen()
    }, lockTimer);


    //news articles
    $('.news-sidebar>li>a').click(function () {
        var article_id = $(this).attr('id');
        var page = site_url+'view_article/' + article_id;
        $('.news-article').html('loading <img src="../assets/img/loader.gif"/>').load(page);
    });

    //delete news article
    $('.del-article-btn').click(function () {
        var article_id = $(this).attr('id');
        if (confirm('Are you sure you want to delete this?')) {
            window.location.href = site_url+'news/delete/' + article_id;
        }
    });


    $('.reportsBtn').popover({
        title: lang['reports'],
        html: true,
        placement: 'bottom',
        content: function () {
            return $('#daily-report').html();
        }
    });

    $('.delete').click(function (e) {
        var loc = $(this).attr('href');
        swal({
            title: lang['confirm_delete_title'],
            text: lang['confirm_delete_warning'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: lang['confirm_delete_btn'],
            closeOnConfirm: false,
            backdrop: false,
            allowOutsideClick: false
        }, function () {
            swal('processing...');
            if (loc !== undefined)
                window.location.href = loc;
        });
        e.preventDefault();
    });
});