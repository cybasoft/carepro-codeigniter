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
        <div class="tab-pane" id="support">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><?php echo lang('support'); ?></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li><a href="https://github.com/amdtllc/daycarepro/wiki">Wiki</a></li>
                                <li><a href="https://amdtcllc.com/support">Support tickets</a></li>
                                <li><a href="https://github.com/amdtllc/daycarepro/wiki/Change-log">Change log</a></li>
                                <li><a href="https://github.com/amdtllc/daycarepro/wiki/Configuration">Configuration</a>
                                </li>
                                <li><a href="https://github.com/amdtllc/daycarepro/issues">Known issues</a></li>
                                <li><a href="https://github.com/amdtllc/daycarepro/wiki/Licenses">Licenses</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h3>Thank you for supporting this project!</h3>
                                <p>Your donation helps us keep working on this script and make it available at a
                                    very affordable price and provide free support</p>
                                <form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="Q3N6CNB3RRJBJ">
                                    <input type="image"
                                           src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                                           name="submit" alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1"
                                         height="1">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $('.settings').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            success: function (response) {
                swal({type: 'success', 'title': ''})
                setTimeout(function () {
                    window.location.reload();
                }, 2000)
            },
            error: function (error) {
                swal({type: 'error', 'title': ''})
            }
        });
    });
    $("input[name=login_bg_image]").click(function () {
        var img = $(this).val();
        $('.currentLoginImg').attr('src', '<?php echo base_url(); ?>' + 'assets/uploads/content/login/' + img)
    })
</script>