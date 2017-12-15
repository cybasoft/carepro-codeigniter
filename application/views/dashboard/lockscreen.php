<!DOCTYPE html>
<html class="lockscreen">
<head>
	<meta charset="UTF-8">
	<title><?php echo $this->config->item('name', 'company'); ?> - Lockscreen </title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="center">
	<?php echo $this->session->flashdata('message'); ?>

	<div class="headline text-center" id="time"></div>
	<div class="lockscreen-name">
		<?php echo strtoupper($this->user->user()->username); ?>
	</div>
	<div class="lockscreen-item">
		<div class="lockscreen-image">
			<?php //todo avatar gender ?>
			<?php echo $this->users->getPhoto(); ?>
		</div>
		<div class="lockscreen-credentials">
			<?php echo form_open('dashboard/login'); ?>
			<div class="input-group">
				<input type="password" class="form-control" name="pin" placeholder="pin" />
				<div class="input-group-btn">
					<button class="btn btn-flat"><i class="fa fa-arrow-right text-muted"></i></button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>

	<div class="lockscreen-link">

		<a class="lockscreen-name label label-success" href="<?php echo site_url('logout'); ?>">Switch user</a>
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(function() {
		startTime();
		$(".center").center();
		$(window).resize(function() {
			$(".center").center();
		});
	});

	/*  */
	function startTime()
	{
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();

		// add a zero in front of numbers<10
		m = checkTime(m);
		s = checkTime(s);

		//Check for PM and AM
		var day_or_night = (h > 11) ? "PM" : "AM";

		//Convert to 12 hours system
		if (h > 12)
			h -= 12;

		//Add time to the headline and update every 500 milliseconds
		$('#time').html(h + ":" + m + ":" + s + " " + day_or_night);
		setTimeout(function() {
			startTime()
		}, 500);
	}

	function checkTime(i)
	{
		if (i < 10)
		{
			i = "0" + i;
		}
		return i;
	}

	/* CENTER ELEMENTS IN THE SCREEN */
	jQuery.fn.center = function() {
		this.css("position", "absolute");
		this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
		$(window).scrollTop()) - 30 + "px");
		this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
		$(window).scrollLeft()) + "px");
		return this;
	}
</script>
</body>
</html>