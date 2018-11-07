<?php foreach ($this->child->getParents($child->id)->result() as $u) : ?>
    <div class="list list-group">
        <div class="list-group-item">
            <div class="media">
                <div class="align-self-start mr-2">
                    <img style="width:50px;height:50px;margin-right:10px;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;" class="img-rounded"
                         src="<?php echo is_file(APPPATH.'../assets/uploads/users/'.$u->photo) ? base_url().'assets/uploads/users/'.$u->photo : base_url('assets/img/content/no-image.png'); ?>"/>
                </div>
                <div class="media-body">
                    <p class="mb-1">
                        <a class="text-purple m-0 editUserBtn" id="<?php echo $u->id; ?>" href="#">
                            <?php echo $u->last_name.' '.$u->first_name; ?>
                        </a>
                        <small class="text-muted room-note-date">
                            <span class="fa fa-lock"></span>
                            <?php echo $this->user->get($u->id, 'pin'); ?>
                        </small>
                    </p>
                    <div class="text-sm room-note">
                        <?php echo !empty($u->phone) ? '<br/><span class="fa fa-phone"></span>'.$u->phone : '' ?>
                        <br/>
                        <span class="fa fa-inbox"></span> <?php echo $u->email; ?>
                        <br/>
                        <?php if(!empty($u->address)): ?>
                            <span class="fa fa-envelope"></span>
                            <span class="parent-address"><?php echo $u->address; ?></span>
                            <br/>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ml-auto">
                    <?php if(!is('parent')): ?>
                        <a href="<?php echo site_url('child/'.$child->id.'/'.$u->id.'/removeParent'); ?>"
                           class="btn btn-danger btn-xs delete pull-right">
                            <span class="fa fa-unlink"></span>
                        </a>
                    <?php endif; ?>
                </div>
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