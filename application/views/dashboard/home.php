<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-4">
        <div class="box box-info">
            <div class="box-body">
                <table class="table">
                    <tr>
                        <td colspan="2" class="text-bold"><?php echo $this->config->item('name', 'company'); ?></td>
                    </tr>
            
                    <tr>
                        <td colspan="2"><?php echo $this->config->item('slogan', 'company'); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('timezone'); ?>:</td>
                        <td><?php echo $this->config->item('timezone', 'company'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="box box-success">
            <div class="box-body">
                <table class="table">
                    <tr>
                        <td colspan="2">
                            <?php echo $this->config->item('street', 'company'); ?>
                            <br/>
                            <?php echo $this->config->item('city', 'company'); ?>
                            <?php echo $this->config->item('state', 'company'); ?>,
                            <?php echo $this->config->item('postal_code', 'company'); ?>
                            <?php echo $this->config->item('country', 'company'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo lang('phone'); ?></td>
                        <td><?php echo $this->config->item('phone', 'company'); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('fax'); ?>:</td>
                        <td><?php echo $this->config->item('fax', 'company'); ?></td>
                    </tr>
                </table>
            </div>
        </div>


        <div class="box box-warning">
            <div class="box-header with-border">
                <div class="box-title"><i class="fa fa-money"></i> <?php echo lang('invoices_due'); ?></div>
            </div>
            <div class="box-body">
                <?php echo lang('total'); ?>
                <span  class="badge"> <?php echo $this->db->where('invoice_status', 2)->get('invoices')->num_rows(); ?>
                </span>

                <h2>
                    <?php echo $this->config->item('currency_symbol') . $this->invoice->getTotalDue(); ?>

                </h2>
            </div>
        </div>
        <div class="box box-primary">
        <ul class="nav nav-pills nav-stacked">
            <li class="active">
                <?php echo anchor('children/roster', '<i class="fa fa-file-pdf-o"></i> Children Roster', 'target="_blank"'); ?>
<!--                --><?php //echo anchor('parent/roster', '<i class="fa fa-file-pdf-o"></i> Parents Roster', 'target="_blank"'); ?>
            </li>
        </ul>
            </div>
    </div>


    <div class="col-lg-9 col-md-8 col-sm-8">
        <div class="row">

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua cursor" onclick="location.href='<?php echo site_url('children'); ?>'">
                    <div class="inner">
                        <h3>
                            <?php echo $this->child->getCount(); ?>
                        </h3>

                        <p>
                            <?php echo lang('children'); ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="<?php echo site_url('children'); ?>" class="small-box-footer">
                        <?php echo lang('open'); ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>

                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow cursor" onclick="location.href='<?php echo site_url('users'); ?>'">
                    <div class="inner">
                        <h3>
                            <?php echo $this->user->getCount(); ?>
                        </h3>

                        <p>
                            <?php echo lang('users'); ?>
                        </p>
                    </div>
                    <div class="icon">
                       <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <a href="<?php echo site_url('users'); ?>" class="small-box-footer">
                        <?php echo lang('open'); ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green cursor" onclick="location.href='<?php echo site_url('children'); ?>'">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->select('id')->get('invoices')->num_rows();
                            ?>
                        </h3>

                        <p>
                            <?php echo lang('invoices'); ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </div>
                    <a href="<?php echo site_url('children'); ?>" class="small-box-footer">
                        <?php echo lang('open'); ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-gray cursor" onclick="location.href='<?php echo site_url('news'); ?>'">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->select('id')->get('news')->num_rows();
                            ?>
                        </h3>

                        <p>
                            <?php echo lang('articles'); ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                    </div>
                    <a href="<?php echo site_url('news'); ?>" class="small-box-footer">
                        <?php echo lang('open'); ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row hidden-xs">
            <section class="col-sm-12 connectedSortable">
                <?php $this->load->view('modules/calendar/widget'); ?>
            </section>
        </div>
    </div>
</div>
