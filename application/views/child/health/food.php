<div class="card">
	<div class="card-header">
      <h4 class="card-title"><?php echo lang('food_pref_header'); ?>
          <button type="button" class="btn btn-warning btn-sm card-tools" data-toggle="modal" data-target="#foodPrefModal">
              <i class="fa fa-plus-circle"></i> <?php echo lang('New preference'); ?>
          </button>
      </h4>
	</div>
	<div class="card-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><?php echo lang('food_item'); ?></th>
                <th><?php echo lang('time'); ?></th>
                <th><?php echo lang('remarks'); ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $foods = $this->db->where('child_id', $child->id)->get('child_foodpref');
            if($foods->num_rows() > 0): ?>
                <?php foreach ($foods->result() as $item): ?>
                    <tr>
                        <td>
                            <?php echo $item->food; ?>
                        </td>
                        <td>
                            <?php echo $item->food_time; ?>
                        </td>
                        <td>
                            <?php echo $item->comment; ?>
                        </td>
                        <td>
                            <?php if(!is('parent')): ?>
                            <a class="delete" href="<?php echo site_url('child/deletePref/'.$item->id); ?>">
                                <span class="fa fa-trash-alt cursor"></span>
                                <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="alert alert-warning h3"><?php echo lang('nothing_to_display'); ?></div>
            <?php endif; ?>
            </tbody>
        </table>
	</div>
</div>


<div class="card">
	<div class="card-header">
		<h4 class="card-title"><?php echo lang('Intake history'); ?>
            <?php if(!is('parent')): ?>
                <button type="button" class="btn btn-success btn-sm card-tools" data-toggle="modal"
                        data-target="#foodIntakeModal">
                    <i class="fa fa-plus-circle"></i> <?php echo lang('Record intake'); ?>
                </button>
            <?php endif; ?>
        </h4>

	</div>
	<div class="card-body">


        <table class="table table-hover" id="datatable">
            <thead>
            <tr>
                <th><?php echo lang('Date'); ?></th>
                <th><?php echo lang('Meal time'); ?></th>
                <th><?php echo lang('Quantity'); ?></th>
                <th><?php echo lang('remarks'); ?></th>
                <?php if(!is('parent')): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->food->getIntake($child->id) as $intake): ?>
                <tr>
                    <td><?php echo format_date($intake->taken_at); ?></td>
                    <td><?php echo $this->food->mealTime($intake->meal_time); ?></td>
                    <td><?php echo $intake->quantity; ?></td>
                    <td><?php echo $intake->remarks; ?></td>
                    <?php if(!is('parent')): ?>
                        <td>
                            <?php echo anchor('food/deleteIntake/'.$intake->id, '<i  class="fa fa-trash"></i>', 'class="delete text-danger"'); ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
	</div>
	<div class="card-footer">

	</div>
</div>

<div class="modal fade" id="foodPrefModal" tabindex="-1" role="dialog" aria-labelledby="foodPrefModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="foodPrefModalLabel">
                    <?php echo lang('New food preference'); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>

            <?php echo form_open('food/newPref'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>

            <div class="modal-body">
                <?php
                echo form_label(lang('Food name'),'food', ['class' => 'required']);
                echo form_input('food', null, ['class' => 'form-control', 'required' => '','id' => 'food']);

                echo form_label(lang('Meal time'));
                echo form_dropdown('food_time',
                    [
                        'B' => lang('Breakfast'),
                        'AM' => lang('AM Snack'),
                        'L' => lang('Lunch'),
                        'PM' => lang('PM Snack'),
                        'S' => lang('Supper'),
                        'EV' => lang('Evening Snack')
                    ], null,
                    [
                        'class' => 'form-control'
                    ]
                );

                echo form_label(lang('remarks'));
                echo form_input('comment', null, ['class' => 'form-control']);
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

<div class="modal fade" id="foodIntakeModal" tabindex="-1" role="dialog" aria-labelledby="foodIntakeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="foodIntakeModalLabel">
                    <?php echo lang('Record intake'); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>

            <?php echo form_open('food/recordIntake'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('Date'), 'date');
                        echo form_date('date', date('Y-m-d'), ['class' => 'form-control']);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('Time'), 'time');
                        echo form_time('time', date('H:i:s'), ['class' => 'form-control']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('Meal time'));
                        echo form_dropdown('meal_time',
                            [
                                'B' => lang('Breakfast'),
                                'AM' => lang('AM Snack'),
                                'L' => lang('Lunch'),
                                'PM' => lang('PM Snack'),
                                'S' => lang('Supper'),
                                'EV' => lang('Evening Snack')
                            ], null,
                            [
                                'class' => 'form-control'
                            ]
                        );
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('Quantity'), 'quantity');
                        echo form_dropdown('quantity', [
                            'All' => lang('All'),
                            'Most' => lang('Most'),
                            'Some' => lang('Some'),
                            'None' => lang('None')
                        ], 'All', ['class' => 'form-control']);

                        ?>
                    </div>
                </div>
                <?php
                echo form_label(lang('remarks'));
                echo form_input('remarks', null, ['class' => 'form-control']);
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