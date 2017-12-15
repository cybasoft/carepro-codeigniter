<div class="row">
	<div class="col-lg-3 col-md-3 col-lg-3">
		<select class="list-limit label label-default" name=limit>
			<option value=5 <?php echo list_selected(5); ?>>5 <?php echo lang('records'); ?></option>
			<option value=10 <?php echo list_selected(10); ?>>10 <?php echo lang('records'); ?></option>
			<option value=25 <?php echo list_selected(25); ?>>25 <?php echo lang('records'); ?></option>
			<option value=50 <?php echo list_selected(50); ?>>50 <?php echo lang('records'); ?></option>
		</select>
	</div>
	<div class="col-lg-4 col-md-4 col-lg-4">
		<?php echo form_open('children', 'class="input-group"'); ?>
		<span class="input-group-addon">
        <input type="radio" name="search_term" value="fname"/><?php echo lang('first_name'); ?>
			<input type="radio" name="search_term" checked value="lname"/><?php echo lang('last_name'); ?>
    </span>
		<input type="text" name="search" class="form-control" placeholder="<?php echo lang('search'); ?>..."/>
		<span class="input-group-btn"><button class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
			</button> </span>
		<?php echo form_close(); ?>

	</div>
	<div class="col-lg-4 col-md-4 col-lg-4">
		<?php echo anchor('children/register', '<span class="glyphicon glyphicon-plus"></span>'
		. lang('register') . ' ' . lang('child'), 'class="btn btn-primary btn-flat"'); ?>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-lg-12">
		<?php
	$page_name = $this->uri->segment(2);
	if (!isset($_GET['limit'])) {
		$limit = 5;
	} else {
		$limit = $_GET['limit'];
	}
	if (strlen($limit) > 0 and !is_numeric($limit)) {
		echo 'Data Error';
		exit;
	}

	if (!isset($_GET['start'])) {
		$start = 0;
	} else {
		$start = $_GET['start'];
	}
	if (strlen($start) > 0 and !is_numeric($start)) {
		echo 'Data Error';
		exit;
	}

		//selected option
	function list_selected($select)
	{
		if (isset($_GET['limit'])) {
			$limit = $_GET['limit'];
		} else {
			$limit = '';
		}
		if ($limit == $select) {
			return 'selected';
		}
		return false;
	}

		//pagination limits
	$eu = ($start - 0);

	if (!$limit > 0) {
		$limit = 10; //default limit
	}
	$this1 = $eu + $limit;
	$back = $eu - $limit;
	$next = $eu + $limit;

	if ($this->input->post('search')) {
		$this->db->like($this->input->post('search_term'), $this->input->post('search'));
	}
	$this->db->limit($limit, $eu);
	$query = $this->db->get('children');
	foreach ($query->result() as $row) :
	?>
			<div class="col-sm-3 col-md-3 col-lg-3" style="width:320px">
				<div class="box box-solid box-success">
					<div class="box-header">
						<div class="box-title">
							<?php echo $row->lname . ', ' . $row->fname; ?>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-5 col-md-5 col-lg-5 image pull-left">
								<div>
								<?php
							if ($row->photo !== "") {
								echo '<img class="img-circle"
         src="' . base_url() . 'assets/img/children/' . $row->photo . '" style="width: 120px; height:120px"/>';
							} else {
								echo '<img class="img-circle"
         src="' . base_url() . 'assets/img/no-image.png" style="width: 120px; height:120px"/>';
							}
							?>
								</div>
							</div>
							<div class="col-sm-7 col-md-7 col-lg-7 pull-right">
								<span class="label label-info"><?php echo lang('birthday'); ?></span><br/>
								<?php echo $row->bday; ?>
								<br/>
								<span class="label label-info"><?php echo lang('registered_date'); ?></span><br/>
								<?php echo date('d M, y G:i', $row->enroll_date); ?>

								<br/>
								<span class="label label-info"><?php echo lang('status'); ?></span>
								<?php echo lang($this->children->status($row->status)); ?>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<?php if ($this->child->is_checked_in($row->id) == 1) : ?>
							<a id="<?php echo $row->id; ?>" href="#"
							   class="btn btn-danger btn-flat btn-sm child-check-out">
								<span class="glyphicon glyphicon-new-window"></span>
								<?php echo lang('check_out'); ?>
							</a>
						<?php else : ?>
							<a id="<?php echo $row->id; ?>" href="#"
							   class="btn btn-primary btn-flat btn-sm child-check-in">
								<span class="glyphicon glyphicon-check"></span>
								<?php echo lang('check_in') . ' &nbsp; '; ?>
							</a>
						<?php endif; ?>

						<a href="<?php echo site_url('child/' . $row->id); ?>"
						   class="btn btn-info btn-flat btn-sm viewChild">
							<span class="glyphicon glyphicon-eye-open"></span> <?php echo lang('open'); ?>
						</a>
					</div>
				</div>
			</div>
		<?php endforeach ?>

	</div>
</div>
<hr/>
<div class="row">
	<div class="col-sm-12 col-md-12 col-sm-12">
		<div class="btn-group">
			<?php
			//navigation
		if ($back >= 0) {
			echo '<a class="btn btn-default" href="' . $page_name . '?start=' . $back . '&limit=' . $limit . '">&laquo;</a>';
		} else {
			echo '<button disabled class="btn btn-default">&laquo;</button>';
		}
		$i = 0;
		$l = 1;
		for ($i = 0; $i < $this->children->getCount(); $i = $i + $limit) {
			if ($i <> $eu) {
				echo '<a class="btn btn-default" href="' . $page_name . '?start=' . $i . '&limit=' . $limit . '">' . $l . '</a>';
			} else {
				echo '<button class="btn btn-danger">' . $l . '</button>';
			}
			$l = $l + 1;
		}

		if ($this1 < $this->children->getCount()) {
			echo '<a class="btn btn-default" href="' . $page_name . '?start=' . $next . '&limit=' . $limit . '">&raquo;</a>';
		} else {
			echo '<button disabled class="btn btn-default">&raquo;</button>';
		}
		?>
		</div>
	</div>
</div>

<div class="my_modal"></div>

<script type="text/javascript">
	$('.list-limit').change(function () {
		var limit = $(this).val();
		window.location.href = '<?php echo $page_name; ?>?limit=' + limit;
	});
	$('.child-check-in').click(function () {
		var child_id = $(this).attr('id');
		$('.my_modal').load('<?php echo site_url('child/check_in'); ?>/' + child_id).modal();
	});
	$('.child-check-out').click(function () {
		var child_id = $(this).attr('id');
		$('.my_modal').load('<?php echo site_url('child/check_out'); ?>/' + child_id).modal();
	});

</script>