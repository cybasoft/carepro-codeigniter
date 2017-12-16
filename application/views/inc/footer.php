
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>

<script>
    setTimeout("jQuery('#msg').slideUp('slow');", 4000);

    $('.lock-screen').click(function () {
        location.href = "<?php echo site_url('lockscreen'); ?>";
    });
    setTimeout(function () {
        location.href = "<?php echo site_url('lockscreen'); ?>";
    }, 1800000);
</script>


<script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"
        type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/datepicker/bootstrap-datepicker.js"
        type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/daterangepicker/daterangepicker.js"
        type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js/summernote.min.js" type="text/javascript"></script>
<script>
    //summernote editor
    $('.summernote').summernote();
</script>
<!-- fullCalendar -->
<script src="<?php echo base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert2.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>
</body>
</html>
