
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert2.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>

<script type="text/javascript">
    setTimeout("jQuery('#msg').slideUp('slow');", 4000);
    $('.lock-screen').click(function () {
        location.href = "<?php echo site_url('lockscreen'); ?>";
    });
    setTimeout(function () {
        location.href = "<?php echo site_url('lockscreen'); ?>";
    }, 1800000);
</script>

</body>
</html>
