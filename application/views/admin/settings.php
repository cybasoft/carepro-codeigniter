<div class="row">
    <div class="col-sm-2">
        <?php $this->load->view('admin/settings_nav'); ?>
    </div>
    <div class="tab-content col-sm-10">

        <div class="tab-pane active" id="home">
            <?php $this->load->view('admin/site_settings'); ?>
        </div>
        <div class="tab-pane" id="billing">
            <?php $this->load->view('admin/billing'); ?>
        </div>
        <div class="tab-pane" id="logo">
            <?php $this->load->view('admin/logo'); ?>

        </div>
        <div class="tab-pane" id="theme">
            <?php $this->load->view('admin/theme'); ?>
        </div>
        <div class="tab-pane" id="integrations">
            <?php $this->load->view('admin/integrations'); ?>
        </div>
        <div class="tab-pane" id="backup">
            <?php $this->load->view('admin/backup'); ?>
        </div>
        <div class="tab-pane" id="event_log">
            <?php $this->load->view('admin/event_log'); ?>
        </div>
        <div class="tab-pane" id="support">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><?php echo lang('support'); ?></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li><a target="_blank" href="<?php echo site_url('docs'); ?>">User Guide</a></li>
                                <li><a target="_blank" href="https://support.amdtllc.com">Support tickets</a></li>
                                <li><a target="_blank" href="<?php echo site_url('docs/#/changelog'); ?>">Change log</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h3>Thank you for your support!</h3>
                                <p>Your donation helps us keep working on this script and make it available at a
                                    very affordable price and provide free support</p>
                                <form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="Q3N6CNB3RRJBJ">
                                    <button class="btn btn-primary btn-block"><i class="fa fa-paypal"></i> DONATE</button>
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </form>

                                <h3>Join our mailing list for the latest updates</h3>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $('.settings').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                if (response == "success") {
                    swal({
                        type: 'success',
                        'title': ''
                    })
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000)
                }else{                    
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000)
                }
            },
            error: function(error) {
                swal({
                    type: 'error',
                    'title': ''
                })
            }
        });
    });
    $("input[name=login_bg_image]").click(function() {
        var img = $(this).val();
        $('.currentLoginImg').attr('src', '<?php echo base_url(); ?>' + 'assets/uploads/content/login/' + img)
    })
</script>