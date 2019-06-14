<div class="login100-more"
     style="background-image: url('<?php echo assets('uploads/content/login/'.session('company_login_bg_image', 'login-bg-02.jpg')); ?>')">

    <div class="page-copyright">
        <?php echo lang('powered by'); ?><?php echo lang('copyright'); ?>
    </div>
</div>
</div>
</div>
</div>


<script src="<?php echo assets('plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo assets('plugins/popper/popper.min.js'); ?>"></script>
<script src="<?php echo assets('plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo assets('plugins/bootstrap-select/js/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo assets('js/login.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/plugins/extras/jquery-ui.min.js"></script>
<script>
    $(document).ready(function(){
        $(".notifictions").delay(2000).hide("slide", {
            direction: "right"
        }, 5000);
    });
</script>

</body>

</html>