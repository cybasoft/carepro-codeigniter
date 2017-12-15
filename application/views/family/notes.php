<div class="row">
	<?php foreach($notes as $note): ?>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header">
					<div class="text-left pull-left"><?php echo $this->users->user($note->user_id)->username; ?></div>
					<div class="text-right"><?php echo date('d M Y H:i',$note->date); ?></div>
				</div>
				<div class="box-body">
					<?php echo $note->content; ?>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>