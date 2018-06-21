<div class="row">
    <?php foreach ($this->child->getParents($child->id)->result() as $u) : //iterate through users   ?>
        <div class="col-sm-6">
            <table>
                <tr>
                    <td valign="top">
                        <?php if(is_file(APPPATH.'../assets/uploads/users/'.$this->user->user($u->user_id)->photo)) : ?>
                            <img style="width:150px" class="img-circle"
                                 src="<?php echo base_url().'assets/uploads/users/'.$this->user->user($u->user_id)->photo; ?>"/>
                        <?php else : ?>
                            <img style="width:150px" class="img-circle"
                                 src="<?php echo base_url('assets/img/content/no-image.png'); ?>"/>
                        <?php endif; ?>
                    </td>
                    <td style="position: relative;">
                        <span class="label-text parent-name">
                            <a href="<?php echo site_url('user/'.$u->id); ?>">
                                <?php echo $u->last_name.' '.$u->first_name; ?>
                            </a>
                        </span>
                        <br/>
                        <span class="fa fa-phone"></span> <?php echo $u->phone; ?>
                        <br/>
                        <span class="fa fa-inbox"></span> <?php echo $u->email; ?>
                        <br/>
                        <?php if(!empty($this->user->user($u->user_id)->address)): ?>
                            <span class="fa fa-envelope"></span>
                            <span class="parent-address"><?php echo $this->user->user($u->user_id)->address; ?></span>
                            <br/>
                        <?php endif; ?>
                        <span class="fa fa-lock"></span> <?php echo $this->user->user($u->user_id)->pin; ?>
                        <?php if(!is('parent')): ?>
                            <a href="<?php echo site_url('child/'.$child->id.'/'.$u->id); ?>/removeParent"
                               class="btn btn-danger btn-xs delete" style="position:absolute;top:0;right:0">
                                <span class="fa fa-trash-alt"></span>
                                <span class="hidden-sm"><?php echo lang('remove'); ?></span>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    $('.assign-user').hide();
    $('.assign-user-btn').click(function () {
        $('.assign-user').toggle().load('<?php echo site_url('child/'.$child->id.'/assignParent'); ?>');
    });
</script>