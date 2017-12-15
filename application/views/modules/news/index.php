<style>
	.bg-mg{

		background: url(<?php echo base_url(); ?>assets/landing/img/vector/news_v1.jpg);
		background-size: 100% 100%;
		background-repeat: no-repeat;
		height: 100%;
	}
</style>
<div class="row">
	<?php foreach($articles->result() as $article): ?>
		<div class="col-sm-4 col-md-4  col-lg-4">
			<div class="box box-primary">
				<div class="box-header">
					<div class="box-title">
						<a href="<?php echo site_url('news/view/' . $article->id); ?>">
							<?php echo $article->article_name; ?>
						</a>
					</div>
				</div>
				<div class="box-body">
					<div style="height:150px; overflow: hidden">
						<?php echo word_limiter($article->article_body,50); ?>
					</div>

				</div>
				<div class="box-footer">
					<a href="<?php echo site_url('news/view/' . $article->id); ?>">
						<?php echo lang('read'); ?> <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
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