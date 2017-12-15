<?php $this->load->view($this->module . 'nav'); ?>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8">
		<?php
		$this->db->where('child_id', $this->child->getID());
		$q = $this->db->get('child_notes')->result();
		foreach($q as $r):
			?>
			<div class="col-sm-6 col-md-6 col-lg-6">
				<div class="box box-solid box-success">
					<div class="box-header">
						<?php echo date('m-d-y G:i', $r->date); ?>
						<?php echo lang('by'); ?>
						<?php echo $this->users->user($r->user_id)->username; ?>
					</div>
					<div class="box-body">
						<?php echo $r->content; ?>
					</div>
					<div class="box-footer">
						<span class="glyphicon glyphicon-trash cursor"
							  onclick="deleteNote('<?php echo $r->id; ?>');"></span>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4">
		<div class="box box-solid box-info">
			<div class="box-header"><span class="box-title"><?php echo lang('new_note'); ?></span> </div>
			<?php echo form_open('notes/add_note'); ?>
			<div class="box-body">
				<textarea class="form-control textarea" rows="5" name="note-content" placeholder="Note content" required=""></textarea>
			</div>
			<div class="box-footer">
				<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script>
	function deleteNote(id){
		if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
			window.location.href = '<?php echo site_url(); ?>notes/delete_note/' + id;
		}
	}
</script>