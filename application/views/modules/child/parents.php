<table class="table table-bordered parent-info">
    <?php foreach ($this->child->getParents($child->id)->result() as $u) : //iterate through users ?>
        <tr>
            <td class="col-sm-2">
                <div>
                    <?php if (is_file(APPPATH.'../assets/uploads/users/staff/'.$this->user->user($u->user_id)->photo)) : ?>
                        <img class="img-circle img-responsive img-thumbnail"
                             src="<?php echo base_url() . 'assets/uploads/users/staff/' . $this->user->user($u->user_id)->photo; ?>"/>
                    <?php else : ?>
                        <img class="img-circle img-responsive img-thumbnail"
                             src="<?php echo base_url('assets/img/content/no-image.png'); ?>"/>
                    <?php endif; ?>
                </div>
            </td>
            <td>
                <span class="label-text parent-name">
                    <?php echo $u->last_name; ?>, <?php echo $u->first_name; ?>
                </span>
                <hr/>
                <table>
                    <tr>
                        <td>
                            <span class="fa fa-inbox"></span>
                            <?php echo $u->email; ?>
                        </td>
                    </tr>
                </table>
                <table>
                    <?php if (!empty($this->user->user($u->user_id)->address)): ?>
                        <tr>
                            <td><span class="fa fa-envelope"> </span></td>
                            <td>
                                <div class="parent-address">
                                    <?php echo $this->user->user($u->user_id)->address; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td><span class="fa fa-lock"></span></td>
                        <td>
                            <?php echo $this->user->user($u->user_id)->pin; ?>
                        </td>
                    </tr>
                </table>
                <?php if(!is('parent')): ?>
                <hr/>
                <a href="<?php echo site_url('child/' . $child->id . '/' . $u->id); ?>/removeParent"
                   class="btn btn-danger btn-sm pull-right delete">
                    <span class="fa fa-trash-o"></span>
                    <?php echo lang('remove'); ?>
                </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script type="text/javascript">
    $('.assign-user').hide();
    $('.assign-user-btn').click(function () {
        $('.assign-user').toggle().load('<?php echo site_url('child/' . $child->id . '/assignParent'); ?>');
    });
</script>