<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>Error</h4>

<p>severity: <?php echo $severity; ?></p>
<p>message:  <?php echo $message; ?></p>
<p>filename: <?php echo $filepath; ?></p>
<p>line number: <?php echo $line; ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p>Backtrace:</p>
	<?php foreach (debug_backtrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p style="margin-left:10px">
			File: <?php echo $error['file'] ?><br />
			Line: <?php echo $error['line'] ?><br />
			Function: <?php echo $error['function'] ?>
			</p>

		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>

</div>