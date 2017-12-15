 <ul class="nav nav-pills nav-stacked">
	 <li>
		 <a href="#" class="list-group-item list-group-item-success compose-btn">
			 <i class="fa fa-envelope"></i>
			 <span class="hidden-xs"><?php echo lang('compose'); ?></span>
		 </a>
	 </li>
	 <li>
		 <a href="<?php echo site_url('mailbox'); ?>" class="list-group-item" id="1">
			 <i class="glyphicon glyphicon-inbox"></i>
			 <span class="hidden-xs"><?php echo lang('inbox'); ?> (<?php echo $this->mail->totalUnread(); ?>)</span>
		 </a>
	 </li>
	 <!--li>
		 <a href="<?php echo site_url('mailbox/index/starred'); ?>" class="list-group-item" id="2">
			 <i class="glyphicon glyphicon-star"></i>
			 <span class="hidden-xs"><?php echo lang('starred'); ?></span>
		 </a>
	 </li>
	 <li>
		 <a href="<?php echo site_url('mailbox/index/important'); ?>" class="list-group-item" id="3">
			 <i class="glyphicon glyphicon-bookmark"></i>
			 <span class="hidden-xs"><?php echo lang('important'); ?></span>
		 </a>
	 </li-->
	 <!--li>
		 <a href="<?php echo site_url('mailbox/sent'); ?>" class="list-group-item" id="4">
			 <i class="glyphicon glyphicon-share-alt"></i>
			 <span class="hidden-xs"><?php echo lang('sent'); ?></span>
		 </a>
	 </li>
	 <li>
		 <a href="<?php echo site_url('mailbox/index/trash'); ?>" class="list-group-item" id="9">
			 <i class="glyphicon glyphicon-trash"></i>
			 <span class="hidden-xs"><?php echo lang('trash'); ?></span>
		 </a>
	 </li-->
<li>
	<em>Messages will be deleted automatically after 60 days</em>
</li>
 </ul>

 <script>
	 $('.compose-btn').click(function () {
		 $('.compose-modal').load('<?php echo site_url('mailbox/compose'); ?>').modal();
	 });
 </script>