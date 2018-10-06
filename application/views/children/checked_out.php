<div id="checkedout-children">

	<input class="search form-control" placeholder="Search" />
	<br />
	<div class="row list">
		<?php foreach ($checkedOutChildren as $child): ?>
		<div class="col-sm-6">
			<div class="row">
				<div class="col-xs-4">
					<img style="width:110px;height:108px;margin-right:5px;" class="img-thumbnail" src="<?php echo $this->child->photo($child->photo); ?>" />
				</div>
				<div class="col-xs-8">
					<a class="name" href="<?php echo site_url('/child/' . $child->id); ?>">
						<?php echo $child->last_name . ', ' . $child->first_name; ?>
					</a>
					<div class="born">
						<?php echo format_date($child->bday, false); ?>
					</div>
					<div class="nid">
						<?php echo decrypt($child->national_id); ?>
					</div>
					<a onclick="loadCheckInModal('<?php echo $child->id; ?>')" href="#"
					 class="btn btn-primary btn-flat btn-sm child-check-in">
						<span class="fa fa-check"></span>
						<?php echo lang('check_in') . ' &nbsp; '; ?>
					</a>
					<hr />
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<ul class="pagination"></ul>
</div>
