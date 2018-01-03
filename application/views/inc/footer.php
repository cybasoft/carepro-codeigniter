<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert2.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>

<script type="text/javascript">

    $('.lock-screen').click(function () {
        location.href = "<?php echo site_url('lockscreen'); ?>";
    });
    setTimeout(function () {
        location.href = "<?php echo site_url('lockscreen'); ?>";
    }, 1800000);

    function confirmDelete(loc) {
        swal({
            title: '<?php echo lang('confirm_delete_title'); ?>',
            text: '<?php echo lang('confirm_delete_warning'); ?>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '<?php echo lang('confirm_delete_btn'); ?>',
            closeOnConfirm: false,
            backdrop:false,
            allowOutsideClick:false
        }, function () {
            swal('processing...');
            if (loc != undefined)
                window.location.href = loc;
        });
        e.preventDefault();
    }

    $('.delete').click(function (e) {
        var loc = $(this).attr('href');
        swal({
            title: '<?php echo lang('confirm_delete_title'); ?>',
            text: '<?php echo lang('confirm_delete_warning'); ?>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '<?php echo lang('confirm_delete_btn'); ?>',
            closeOnConfirm: false,
            backdrop:false,
            allowOutsideClick:false
        }, function () {
            swal('processing...');
            if (loc != undefined)
                window.location.href = loc;
        });
        e.preventDefault();
    });
</script>

</body>
</html>
