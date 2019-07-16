<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-4">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h3><?php echo $daycare['name']; ?></h3>
                    <?php if($daycare['slogan'] === ''): ?>
                      <em><?php echo session('company_slogan'); ?></em>
                    <?php else: ?>
                      <em><?php echo $daycare['slogan']; ?></em>
                    <?php endif; ?>
                    <br />
                    <?php echo $address['address_line_1']; ?>
                    <br />
                    <?php echo $address['city']; ?>
                    <?php echo $address['state']; ?>,
                    <?php echo $address['zip_code']; ?>,
                    <?php echo $address['country']; ?>
                </div>
            </div>
        </div>
        <?php if(!is('staff')):?>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td><?php echo lang('Facility ID'); ?>:</td>
                        <td><?php echo $daycare['facility_id']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('Tax ID'); ?>:</td>
                        <td><?php echo $daycare['employee_tax_identifier']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('email'); ?>:</td>
                        <td><?php echo $this->session->userdata('email') ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('phone'); ?>:</td>
                        <td><?php echo $address['phone'] ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('fax'); ?>:</td>
                        <td><?php echo session('company_fax'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header with-border">
                <div class="card-title"><i class="fa fa-money"></i> <?php echo lang('invoices_due'); ?></div>
            </div>
            <div class="card-body">
                <?php echo lang('total'); ?>
                <span class="badge">
                    <?php echo $this->db->where('invoice_status', 2)->get('invoices')->num_rows(); ?>
                </span>
                <h2><?php echo session('company_currency_symbol') . $this->invoice->getTotalDue(); ?></h2>
            </div>
        </div>
        <div class="card">
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <?php echo anchor('reports/roster?daily&date=' . date('Y-m-d'), '<i class="fa fa-print"></i> Children Roster', 'target="_blank" class="bg-blue text-white"'); ?>
                </li>
            </ul>
        </div>
        <?php else: ?>
        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fa fa-money"></i>List of Rooms</div>
            </div>
            <div class="card-body">
            <table class="table">
                   <?php $rooms = $this->user->rooms(user_id());
                       foreach($rooms as $room):
                   ?>
                    <tr>                    
                        <td><a href="rooms/view/<?php echo $room->id; ?>"><?php echo  $room->name;?></a></td>
                    </tr>
                    <?php endforeach;?>
            </table>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-lg-9 col-md-8 col-sm-8">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 cursor" onclick="location.href='<?php echo site_url('children'); ?>'">
                <div class="info-box">
                    <span class="info-box-icon bg-maroon"><i class="fa fa-user-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo lang('children'); ?></span>
                        <span class="info-box-number"><?php echo $this->child->getCount(); ?></span>
                    </div>
                </div>
            </div>
            <?php if(!is('staff')):?>
            <div class="col-md-3 col-sm-6 col-xs-12 cursor" onclick="location.href='<?php echo site_url('parents'); ?>'">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo lang('parents'); ?></span>
                        <span class="info-box-number">
                            <?php if ($this->user->getCount('parent') == '') {
                                echo 0;
                            } else {
                                echo $this->user->getCount('parent');
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 cursor" onclick="location.href='<?php echo site_url('users'); ?>'">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo lang('users'); ?></span>
                        <span class="info-box-number"><?php echo $this->user->getCount(); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 cursor" onclick="location.href='<?php echo site_url('users'); ?>'">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo lang('Managers'); ?></span>
                        <span class="info-box-number">
                            <?php if ($this->user->getCount('manager') == '') {
                                echo 0;
                            } else {
                                echo $this->user->getCount('manager');
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-md-3 col-sm-6 col-xs-12 cursor" onclick="location.href='<?php echo site_url('rooms'); ?>'">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo lang('Rooms'); ?></span>
                        <span class="info-box-number"><?php echo $this->rooms->room_count(user_id());?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="row hidden-sm-up">
            <section class="col-sm-12 connectedSortable">
                <?php $this->load->view('calendar/widget'); ?>
            </section>
        </div>
    </div>
</div>