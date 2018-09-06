<h2><?php echo lang('allergies'); ?>

    <?php if(!is('parent')): ?>
        <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#allergyModal">
            <i class="fa fa-plus-circle"></i> <?php echo lang('Add new'); ?>
        </button>
    <?php endif; ?>

</h2>

<?php if(is('parent')): ?>
<div class="callout callout-info"><?php echo lang('Please notify daycare of any allergies'); ?></div>
<?php endif; ?>

<div>
    <div class="modal fade" id="allergyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo lang('allergies'); ?></h4>
                </div>

                <?php echo form_open('child/addAllergy'); ?>
                <?php echo form_hidden('child_id', $child->id); ?>
                <div class="modal-body">
                    <?php
                    echo form_label(lang('name'), 'allergy');
                    echo form_input('allergy', null, ['class' => 'form-control', 'required' => '']);

                    echo form_label(lang('reaction'), 'reaction');
                    echo form_input('reaction', null, ['class' => 'form-control']);

                    echo form_label(lang('notes'), 'notes');
                    echo form_input('notes', null, ['class' => 'form-control']);
                    ?>
                </div>
                <div class="modal-footer">
                    <?php
                    echo form_button(
                        [
                            'type' => 'submit',
                            'class' => 'btn btn-primary'
                        ], lang('submit'));
                    echo form_button(
                        [
                            'data-dismiss' => 'modal',
                            'class' => 'btn btn-default'
                        ], lang('close'));
                    ?>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>


<hr/>
<div class="row">
    <div class="col-lg-12">
        <?php
        $allergies = $this->db->where('child_id', $child->id)->get('child_allergy');
        if($allergies->num_rows() > 0) {
            foreach ($allergies->result() as $allergy) {
                ?>
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?php echo $allergy->allergy; ?>
                            &raquo;
                            <?php echo $allergy->reaction; ?>
                        </h3>
                        <?php if(!is('parent')): ?>
                            <a href="<?php echo site_url('child/deleteAllergy/'.$allergy->id); ?>"
                               class="delete pull-right">
                                <span class="fa fa-trash-alt cursor"></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="box-body">
                        <?php echo $allergy->notes; ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<div class="callout callout-warning">'.lang('no_known_allergies').'</div>';
        }
        ?>
    </div>
</div>