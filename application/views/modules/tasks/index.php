<div class="row">
	<div class="col-sm-6 col-md-6 col-lg-6">
		<?php echo form_open('tasks/createList'); ?>
		<div class="input-group">
			<input class="form-control" name="list_name" placeholder="<?php echo lang('new_list'); ?>"/>
			<span class="input-group-btn">
				<button class="btn btn-info btn-flat"><?php echo lang('add'); ?></button>
			</span>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<hr/>
<div class="row">
	<?php foreach($todos as $todo): ?>
	<div class="col-sm-4 col-md-4 col-lg-4">
		<div class="box <?php echo $this->tasks->changeColor($todo->id); ?>">
			<div class="box-header ui-sortable-handle" style="cursor: move;">
				<i class="fa fa-clipboard"></i>
				<h3 class="box-title"><?php echo $todo->list_name; ?></h3>
				<div class="box-tools pull-right">
					<button class="btn bg-red btn-sm" onclick="deleteList('<?php echo $todo->id; ?>');" data-widget="collapse">
						<i class="fa fa-trash-o"></i></i>
					</button>
					<button class="btn bg-teal btn-sm" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<ul class="todo-list ui-sortable">
					<?php foreach($this->tasks->todoItems($todo->id) as $item): ?>
					<li>
						<div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;">
							<?php echo $this->tasks->checkComplete($item->id); ?>
						</div>
						<span class="text"><?php echo $item->item_name; ?></span>
						<small class="label label-danger"><i class="fa fa-clock-o"></i>
							<?php echo $this->tasks->modified($item->last_modified); ?>
						</small>
						<div class="tools">
							<i class="fa fa-check-square" onclick="markComplete('<?php echo $item->id; ?>')"></i>
							<i class="fa fa-trash-o del-todo-item" onclick="deleteItem('<?php echo $item->id; ?>')"></i>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="box-footer clearfix no-border">
				<?php echo form_open('tasks/createItem/'.$todo->id); ?>
				<div class="input-group">
					<input class="form-control" name="item_name" placeholder="<?php echo lang('new_task_item'); ?>"/>
					<span class="input-group-btn">
						<button class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> <?php echo lang('submit'); ?> </button>
					</span>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>

<script>
	function markComplete(id){
		window.location.href = '<?php echo site_url(); ?>tasks/markItemComplete/' + id;
	}
	function deleteList(id){
		if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
			window.location.href = '<?php echo site_url(); ?>tasks/deleteList/' + id;
		}
	}

	function deleteItem(id){
		if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
			window.location.href = '<?php echo site_url(); ?>tasks/deleteItem/' + id;
		}
	}

</script>