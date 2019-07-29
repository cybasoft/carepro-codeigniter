<div class="row">
    <div class="col-sm-6">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo lang('Categories'); ?></h4>
            </div>
            <div class="card-body">
                <?php echo form_open('notes/storeCategory');
                echo form_label(lang('Name'), 'name', ['class' => 'required']);
                ?>
                <div class="input-group">
                    <?php echo form_input('name', NULL, ['class' => 'form-control', 'id' => 'name']); ?>
                    <span class="input-group-btn">
                <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit')); ?>
            </span>
                </div>
                <?php echo form_close(); ?>

                <?php foreach ($this->db->get('notes_categories')->result() as $row): ?>
                    <hr/>
                    <div><?php echo $row->name.' '.anchor('notes/destroyCategory/'.$row->id, '<i class="fa fa-trash"></i>', ['class' => 'pull-right delete text-danger']); ?></div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
        	<div class="card-header">
        		<h4 class="card-title"><?php echo lang('Tags'); ?></h4>
        	</div>
        	<div class="card-body">
                <?php echo form_open('notes/storeTag');
                echo form_label(lang('Name'), 'name', ['class' => 'required']);
                ?>
                <div class="input-group">
                    <?php echo form_input('name', NULL, ['class' => 'form-control', 'id' => 'name']); ?>
                    <span class="input-group-btn">
                <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit')); ?>
            </span>
                </div>
                <?php echo form_close(); ?>

                <?php foreach ($this->db->get('notes_tags')->result() as $row): ?>
                    <hr/>
                    <div><?php echo $row->name.' '.anchor('notes/destroyTag/'.$row->id, '<i class="fa fa-trash"></i>', ['class' => 'pull-right delete text-danger']); ?></div>
                <?php endforeach; ?>
        	</div>
        </div>
    </div>
</div>