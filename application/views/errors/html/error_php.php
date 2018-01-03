<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4><?php echo lang('php_error'); ?></h4>

<p><?php echo lang('severity'); ?>: <?php echo $severity; ?></p>
<p><?php echo lang('message'); ?>:  <?php echo $message; ?></p>
<p><?php echo lang('filename'); ?>: <?php echo $filepath; ?></p>
<p><?php echo lang('line_number'); ?>: <?php echo $line; ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p><?php echo lang('backtrace'); ?>:</p>
	<?php foreach (debug_backtrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p style="margin-left:10px">
			<?php echo lang('file'); ?>: <?php echo $error['file'] ?><br />
			<?php echo lang('line'); ?>: <?php echo $error['line'] ?><br />
			<?php echo lang('function'); ?>: <?php echo $error['function'] ?>
			</p>

		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>

</div>