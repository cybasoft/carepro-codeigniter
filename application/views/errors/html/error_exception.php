<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('lang')){
    function lang($text){
        return $text;
    }
}
?>

<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4><?php echo lang('exception_title'); ?></h4>

<p><?php echo lang('type'); ?>: <?php echo get_class($exception); ?></p>
<p><?php echo lang('message'); ?>: <?php echo $message; ?></p>
<p><?php echo lang('filename'); ?>: <?php echo $exception->getFile(); ?></p>
<p><?php echo lang('line_number'); ?>: <?php echo $exception->getLine(); ?></p>

<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

	<p><?php echo lang('backtrace'); ?>:</p>
	<?php foreach ($exception->getTrace() as $error): ?>

		<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

			<p style="margin-left:10px">
			<?php echo lang('file'); ?>: <?php echo $error['file']; ?><br />
			<?php echo lang('line'); ?>: <?php echo $error['line']; ?><br />
			<?php echo lang('function'); ?>: <?php echo $error['function']; ?>
			</p>
		<?php endif ?>

	<?php endforeach ?>

<?php endif ?>

</div>