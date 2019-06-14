<style>
    .label-input100 {
        line-height: 0;
        top: 22px;
    }
    #daycare,#daycare:focus {
        border-color: transparent;
        box-shadow: 0 0 0 0rem rgba(0, 123, 255, .25);
    }
</style>
<?php echo form_open('register', ['id' => 'loginForm', 'class' => 'login100-form validate-form']); ?>
<div class="text-center" style="position:absolute;top:0;right:150px">
    <a href="<?php echo site_url(); ?>">
        <img class="logo" src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Logo">
    </a>
</div>
<span class="login100-form-title p-b-43">Select Daycare</span>
<div class="wrap-input100 validate-input" data-validate="<?php echo lang('Field is required'); ?>">
    <span class="focus-input100"></span>
    <span class="label-input100"><?php echo lang('Daycares'); ?></span>
    <select id="daycare" class="form-control" required="" name="daycare">
        <?php foreach ($daycares as $daycare) : ?>
            <option value="<?php echo $daycare['daycare_id']; ?>"><?php echo $daycare['daycare_id']; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="container-login100-form-btn">
    <button class="login100-form-btn">
        <?php echo lang('Select'); ?>
    </button>
</div>
<?php echo form_close(); ?>