<div class="row">
	<div class="col-lg-6">
		<div class="box box-solid box-primary">
			<div class="box-header"><h3 class="box-title"><?php echo lang('reports'); ?></h3></div>
			<div class="box-body">
				<?php $this->load->view($this->module . 'view_backup_list'); ?>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="box box-solid box-primary">
			<div class="box-header"><h3 class="box-title"><?php echo lang('reports'); ?></h3></div>
			<div class="box-body">
				<?php $this->load->view($this->module . 'generate_csv'); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('.del_sql').click(function () {
            if(confirm('<?php echo lang('confirm_delete_item'); ?>')){
                var id = $(this).attr('id');
                window.location.href = '<?php echo site_url('reports/delete_sql_backup'); ?>/' + id;
            }
        });
        $('.del_csv').click(function () {
            if(confirm('<?php echo lang('confirm_delete_item'); ?>')){
                var id = $(this).attr('id');
                window.location.href = '<?php echo site_url('reports/delete_csv_backup'); ?>/' + id;
            }
        });
    });
</script>