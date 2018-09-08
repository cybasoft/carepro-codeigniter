<?php foreach ($this->child->getParents($child->id)->result() as $u) : //iterate through users   ?>
    <div class="info-box">
        <div class="info-box-img" style="margin-right:10px;">
            <img style="width:100px;" class="img-rounded"
                 src="<?php echo is_file(APPPATH.'../assets/uploads/users/'.$u->photo) ? base_url().'assets/uploads/users/'.$u->photo : base_url('assets/img/content/no-image.png'); ?>"/>
        </div>
        <div class="info-box-content">
            <?php if(!is('parent')): ?>
                <a href="<?php echo site_url('child/'.$child->id.'/'.$u->id.'/removeParent'); ?>"
                   class="btn btn-danger btn-xs delete pull-right">
                    <span class="fa fa-unlink"></span>
                </a>
            <?php endif; ?>

            <h3>
                <a class="editUserBtn" id="<?php echo $u->id; ?>" href="#">
                    <?php echo $u->last_name.' '.$u->first_name; ?>
                </a>
            </h3>

            <div class="info-box-light">
                <span class="fa fa-lock"></span> <?php echo $this->user->get($u->id,'pin'); ?>
            </div>

            <div class="info-box-text">
                <?php echo !empty($u->phone) ? '<br/><span class="fa fa-phone"></span>'.$u->phone : '' ?>
            </div>

            <div class="info-box-text">
                <span class="fa fa-inbox"></span> <?php echo $u->email; ?>
            </div>

            <div class="info-box-text">
                <?php if(!empty($u->address)): ?>
                    <span class="fa fa-envelope"></span>
                    <span class="parent-address"><?php echo $u->address; ?></span>
                    <br/>
                <?php endif; ?>
            </div>

        </div>
    </div>

<?php endforeach; ?>

<script type="text/javascript">
    $('.assign-user').hide();
    $('.assign-user-btn').click(function () {
        $('.assign-user').toggle().load('<?php echo site_url('child/'.$child->id.'/assignParent'); ?>');
    });
</script>