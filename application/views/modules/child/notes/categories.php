<div class="row">
    <div class="col-sm-6">
        <h3><?php echo lang('Categories'); ?></h3>

        <?php echo form_open('notes/storeCategory');
        echo form_label(lang('Name'), 'name');
        ?>
        <div class="input-group">
            <?php echo form_input('name', null, ['class' => 'form-control']); ?>
            <span class="input-group-btn">
                <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit')); ?>
            </span>
        </div>

        <?php foreach ($this->db->get('notes_categories')->result() as $row): ?>
            <hr/>
            <div><?php echo $row->name.' '.anchor('notes/destroyCategory/'.$row->id, '<i class="fa fa-trash"></i>', ['class' => 'pull-right delete text-danger']); ?></div>
        <?php endforeach; ?>
    </div>
    <div class="col-sm-6">
        <h3><?php echo lang('Tags'); ?></h3>

        <?php echo form_open('notes/storeTag');
        echo form_label(lang('Name'), 'name');
        ?>
        <div class="input-group">
            <?php echo form_input('name', null, ['class' => 'form-control']); ?>
            <span class="input-group-btn">
                <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit')); ?>
            </span>
        </div>

        <?php foreach ($this->db->get('notes_tags')->result() as $row): ?>
            <hr/>
            <div><?php echo $row->name.' '.anchor('notes/destroyTag/'.$row->id, '<i class="fa fa-trash"></i>', ['class' => 'pull-right delete text-danger']); ?></div>
        <?php endforeach; ?>
    </div>
</div>