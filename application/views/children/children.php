<div class="nav-tabss">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active show" href="#active" aria-controls="active" role="tab" data-toggle="tab">
                <span class="badge badge-info">
                    <?php echo $totalChildren; ?></span>
                <?php echo lang('active_children'); ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#inactive" aria-controls="inactive" role="tab"
               data-toggle="tab">
                <i class="fa fa-info"></i>
                <?php echo lang('inactive_children'); ?>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active show" id="active">

            <div class="card">
                <div class="card-header">

                    <button type="button" data-toggle="popover"
                            class="popover-toggle btn btn-lg btn-danger btn-sm btn-flat reportsBtn">
                        <i class="fa fa-clipboard-list"></i>
                        <?php echo lang('reports'); ?>
                    </button>

                    <?php echo anchor('reports/roster?active', icon('print').' '.lang('active'), 'target="_blank" class="btn btn-success btn-flat btn-sm"'); ?>
                    <?php echo anchor('reports/roster?inactive', icon('print').' '.lang('inactive'), 'target="_blank" class="btn btn-danger btn-flat btn-sm"'); ?>
                    <?php echo anchor('reports/roster', icon('print').' '.lang('print all'), 'target="_blank" class="btn btn-warning btn-flat btn-sm"'); ?>
                </div>
                <div class="card-body">
                    <p>
                        <i class="fa fa-allergies text-danger"></i>
                        <?php echo lang('allergy'); ?> &nbsp; | &nbsp;
                        <i class="fa fa-pills text-danger"></i>
                        <?php echo lang('meds'); ?>
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <h3>
                                <?php echo lang('Currently checked-in'); ?>
                            </h3>
                            <?php $this->load->view($this->module.'checked_in'); ?>
                        </div>
                        <div class="col-md-6">
                            <h3>
                                <?php echo lang('Pending check-in'); ?>
                            </h3>
                            <?php $this->load->view($this->module.'checked_out'); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="inactive">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo lang('inactive_children'); ?></h4>
                </div>
                <div class="card-body">
                    <?php $this->load->view($this->module.'inactive_children'); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view('reports/report-form-popover');
