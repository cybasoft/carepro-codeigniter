<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only"><?php echo lang('toggle'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" onclick="window.location.href='<?php echo site_url(); ?>'">
                <img src="<?php echo base_url() . 'assets/img/' . $this->config->item('logo', 'company'); ?>" class="logo"/>
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="<?php echo cur_nav('children'); ?>">
                    <a href="#" onclick="window.location.href='<?php echo site_url('parents'); ?>'">
                        <span class="fa fa-user"></span> <?php echo lang('my_children'); ?>
                    </a>
                </li>
                <li class="<?php echo cur_nav('inbox'); ?>">
                    <a href="#" onclick="window.location.href='<?php echo site_url('inbox'); ?>'">
                        <span
                            class="badge"><?php echo $this->mail->totalUnread(); ?></span>
                        <?php echo lang('inbox'); ?>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="<?php echo cur_nav('help'); ?>">
                    <a href="#" onclick="window.location.href='<?php echo site_url('help'); ?>'">
                        <span class="fa fa-warning-sign"></span> <?php echo lang('help'); ?>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="window.location.href='<?php echo site_url('logout'); ?>'">
                        <span class="fa fa-log-out"></span> <?php echo lang('logout'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


<?php
//highlight current nav
function cur_nav($page)
{
    $ci = &get_instance();

    if ($ci->uri->segment(1) == $page) {
        return 'active';
    }
    return false;
}
$this->load->view('inc/sidebar');
?>