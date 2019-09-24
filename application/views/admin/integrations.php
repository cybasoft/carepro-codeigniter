<div class="card">
    <div class="card-header">
        <div class="card-title"><?php echo lang('Integrations'); ?></div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title h3">Tawk.to <?php echo lang('embed URL'); ?>
            <?php $this->load->view('help/tawkto',['modalDiv'=>'tawkto']); ?>
        </div>
    </div>
    <div class="card-body">
        <?php echo form_open('update'); ?>
        <div class="blockquote">
            This allows your patrons to chat directly with you from their account.
            <?php echo anchor('https://dashboard.tawk.to/#/admin', ' '.lang('Get Tawk.to link'), ['target' => '_blank']); ?>
        </div>
        <?php

        echo form_input('tawkto_embed_url', daycare('tawkto_embed_url'), [
            'class'       => 'form-control',
            'placeholder' => 'e.g. https://embed.tawk.to/5959be6a50fd5105d0c839c1/default',
        ]);
        echo '<br/>';
        ?>
        <?php
        echo form_button(['type'  => 'submit',
                          'class' => 'btn btn-primary',
        ], lang('Update'));
        echo form_close();
        ?>
    </div>
</div>