<h3>
	<?php echo lang('help'); ?>
	<?php if($this->conf->isManager()==true || $this->conf->isStaff()==true): ?>
		<span class="pull-right"><?php $this->load->view($this->module . 'new_article_form'); ?></span>
	<?php endif; ?>
</h3>

<table class="table table-responsive">
    <tr>
        <td class="col-sm-3">
            <?php $this->load->view($this->module . 'sidebar'); ?>
        </td>
		<td>

			<div class="spacer"></div>
			<div class="help-doc"></div>
		</td>
    </tr>
</table>