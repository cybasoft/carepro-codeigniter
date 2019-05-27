<div class="center">
    <?php if(!empty($this->session->flashdata('message'))) : ?>
        <div id="msg"
             class="msg alert alert-<?php echo $this->session->flashdata('type'); ?> alert-dismissable">
            <span class="fa fa-<?php echo $this->session->flashdata('icon'); ?>"></span>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>
    <div class="headline text-center" id="time"></div>
    <div class="lockscreen-name">
        <?php echo strtoupper($this->user->get(user_id(),'last_name')); ?>
    </div>
    <div class="lockscreen-item">
        <div class="lockscreen-image">
            <img src="<?php echo $this->user->photo(session('photo')); ?>"/>
        </div>
        <div class="lockscreen-credentials">
            <?php echo form_open(uri_string()); ?>
            <div class="input-group">
                <input type="password" class="form-control" name="pin" placeholder="pin"/>
                <div class="input-group-btn">
                    <button class="btn btn-flat"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="lockscreen-link">
        <a class="lockscreen-name label label-success" href="<?php echo site_url($daycare_id.'/logout'); ?>">
            <?php echo lang('switch_user'); ?>
        </a>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/sweetalert2.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        history.pushState(null, document.title, location.href);
        window.addEventListener('popstate', function (event) {
            history.pushState(null, document.title, location.href);
        });
        $('.lockscreen-credentials').find('form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: 'dashboard/login',
                type: 'post',
                data: $(this).serialize(),
                success: function( res, textStatus, jQxhr ){
                   window.location.reload();
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    window.location.href=site_url+$daycare_id+'/logout';
                }
            });
        })
    });

    /* CENTER ELEMENTS IN THE SCREEN */
    jQuery.fn.center = function () {
        this.css("position", "absolute");
        this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
            $(window).scrollTop()) - 30 + "px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
            $(window).scrollLeft()) + "px");
        return this;
    };
    $(function () {
        startTime();
        $(".center").center();
        $(window).resize(function () {
            $(".center").center();
        });
    });

    /*  */
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);
        //Check for PM and AM
        var day_or_night = (h > 11) ? "PM" : "AM";
        //Convert to 12 hours system
        if (h > 12)
            h -= 12;
        //Add time to the headline and update every 500 milliseconds
        $('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
        setTimeout(function () {
            startTime()
        }, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
</script>