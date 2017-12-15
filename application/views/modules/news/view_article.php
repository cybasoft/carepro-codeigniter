<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="box box-success">
			<div class="box-header">
				<div class="box-title"> <?php echo $article->article_name; ?></div>

				<div class="pull-right box-tools">
					<?php if($this->conf->isManager()==true || $this->conf->isAdmin()==true): ?>
						<a href="<?php echo site_url('news/editor/'.$article->id); ?>" class="btn btn-success btn-sm">
							<span class="fa fa-edit"></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="box-body">
				<div class="">
					By: <span class=" label label-default"><?php echo $this->users->getUser($article->user_id, 'username'); ?></span>
					&nbsp;
					on: <span class=" label label-default"><?php echo date('d-M-Y', $article->publish_date); ?></span>
				</div>
				<hr/>
				<?php echo $article->article_body; ?>
			</div>
			<div class="box-footer">

			</div>
		</div>
	</div>
</div>

<?php if($this->conf->isManager()==true || $this->conf->isAdmin()==true): ?>
	<script>
		var n_ico = '<i class="fa fa-plus"></i>';
		var n_link = '<?php echo site_url('news/create'); ?>';
		$('.content-header>h1').append('<a href="'
		+ n_link
		+ '" class="btn btn-primary btn-flat">'
		+ n_ico
		+ ' <?php echo lang('new_article'); ?>');
	</script>
<?php endif; ?>