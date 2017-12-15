<?php function g_decor($name)
{
	switch ($name) {
		case 'admin':
			return 'danger';
			break;
		case 'manager':
			return 'success';
			break;
		case 'staff':
			return 'primary';
			break;
		case 'parent':
			return 'default';
			break;
		default:
			return 'warning';
			break;
	}
}

?>
<div class="row">
	<div class="col-lg-12">
		<div class="callout callout-warning">
			<h4>
				<?php echo $this->users->getCount(); ?>
				<?php echo lang('users') . ' ' . lang('found'); ?>
			</h4>
		</div>

		<table class="table table-bordered table-hover table-striped">
			<thead>
			<tr align="center">
				<td>#</td>
				<td><?php echo ucwords(lang('username')); ?></td>
				<td class="col-lg-1"><?php echo lang('first_name'); ?></td>
				<td class="col-lg-2"><?php echo lang('last_name'); ?></td>
				<td><?php echo lang('index_email_th'); ?></td>
				<td><?php echo lang('index_groups_th'); ?></td>
				<td><?php echo lang('index_status_th'); ?></td>
				<td><?php echo lang('index_action_th'); ?></td>
			</tr>
			</thead>
			<?php
			$start = 1;
			foreach($users as $user):
				if($this->conf->in_group($this->users->uid(), 'admin') == false && $this->conf->in_group($user->id, 'admin') == true):
					continue;
				else:
					?>
					<tr>
						<td>
							<?php echo $start; ?>
						</td>
						<td><?php echo anchor('user/edit/' . $user->id, $user->username); ?></td>
						<td><?php echo $user->first_name; ?></td>
						<td><?php echo $user->last_name; ?></td>
						<td><?php echo $user->email; ?></td>
						<td>
							<?php foreach($user->groups as $group): ?>
								<?php //echo anchor("users/edit_group/" . $group->id, $group->name); ?>
								<span
									class="label label-<?php echo g_decor($group->name); ?>"><?php echo $group->name; ?></span>
							<?php endforeach ?>
						</td>
						<td align="center" valign="top">
							<?php echo ($user->active) ? anchor("users/deactivate/" . $user->id, '<span class="label label-info">'
								. lang('index_active_link') . '</span>') : anchor("users/activate/" . $user->id, '<span class="label label-danger">'
								. lang('index_inactive_link') . '</span>'); ?>
						</td>
						<td>
							<?php echo anchor("user/edit/" . $user->id, '<i class="fa fa-pencil"></i>'); ?>
							&nbsp;
							<?php echo anchor("user/delete/" . $user->id, '<i class="fa fa-trash-o"></i>'); ?>
						</td>
					</tr>
					<?php
					$start++;
				endif;
			endforeach;
			?>
		</table>
	</div>
</div>