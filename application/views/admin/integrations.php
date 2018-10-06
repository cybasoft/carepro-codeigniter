<div class="card">
    <div class="card-header">
        <div class="card-title"><?php echo lang('Integrations'); ?></div>
    </div>
    <div class="card-body">
            <?php echo form_open('settings/update', ['class' => 'settings', 'demo' => 1]); ?>
            <h3>Tawk.to <?php echo lang('embed URL'); ?></h3>
            <?php
            echo anchor('https://dashboard.tawk.to/#/admin', ' '.lang('get link'), ['target' => '_blank']);
            echo form_input('tawkto_embed_url', $option['tawkto_embed_url'], ['class' => 'form-control',
                'placeholder' => 'https://embed.tawk.to/xxxxx/xxxxxx']);
            echo '<br/>';
            ?>
        <?php
        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('Update'));
        echo form_close('demo');
        ?>
    </div>
</div>