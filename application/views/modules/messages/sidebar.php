 <ul class="nav nav-pills nav-stacked">
	 <li>
		 <a href="#" class="list-group-item list-group-item-success compose-btn">
			 <i class="fa fa-envelope"></i>
			 <span class="hidden-xs"><?php echo lang('compose'); ?></span>
		 </a>
	 </li>
	 <li>
		 <a href="<?php echo site_url('mailbox'); ?>" class="list-group-item" id="1">
			 <i class="fa fa-inbox"></i>
			 <span class="hidden-xs"><?php echo lang('inbox'); ?> (<?php echo $this->mail->totalUnread(); ?>)</span>
		 </a>
	 </li>
	 <!--li>
		 <a href="<?php echo site_url('mailbox/index/starred'); ?>" class="list-group-item" id="2">
			 <i class="fa fa-star"></i>
			 <span class="hidden-xs"><?php echo lang('starred'); ?></span>
		 </a>
	 </li>
	 <li>
		 <a href="<?php echo site_url('mailbox/index/important'); ?>" class="list-group-item" id="3">
			 <i class="fa fa-bookmark"></i>
			 <span class="hidden-xs"><?php echo lang('important'); ?></span>
		 </a>
	 </li-->
	 <!--li>
		 <a href="<?php echo site_url('mailbox/sent'); ?>" class="list-group-item" id="4">
			 <i class="fa fa-share-alt"></i>
			 <span class="hidden-xs"><?php echo lang('sent'); ?></span>
		 </a>
	 </li>
	 <li>
		 <a href="<?php echo site_url('mailbox/index/trash'); ?>" class="list-group-item" id="9">
			 <i class="fa fa-trash-o"></i>
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