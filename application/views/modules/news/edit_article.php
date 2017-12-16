<div class="row">
	<div class="col-sm-3 col-md-3 col-lg-3">
		<ul class="nav news-menu">
			<?php
			//list articles
			//$this->db->order_by('order', 'asc');
			foreach($articles->result() as $row) {
				echo '<li>' . anchor('news/editor/' . $row->id, $row->article_name) . '</li>';
			}
			?>
		</ul>
	</div>

	<div class="col-sm-9 col-md-9 col-lg-9">
		<div class="box box-primary">
			<?php echo form_open('news/edit'); ?>
			<div class="box-header">
				<input type="text" name="article_name" class="form-control" required=""
					   placeholder="<?php echo lang('title'); ?>" value="<?php echo $article->article_name; ?>"/>
				<br/>
				<input type="text" name="article_order" class="form-control" required=""
					   placeholder="<?php echo lang('list_order'); ?>" value="<?php echo $article->order; ?>"/>
			</div>
			<div class="box-body">
				<textarea name="article_body" class="form-control summernote" id="editor" required=""
						  style="height:400px"><?php echo $article->article_body; ?></textarea>
			</div>
			<div class="box-footer">
				<button class="btn btn-primary"><?php echo lang('update'); ?></button>
				<button  onclick="deleteArticle('<?php echo $article->id; ?>')" type="button" class="btn btn-danger pull-right">
					<span class="fa fa-trash-o"></span>
					<?php echo lang('delete'); ?>
				</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function deleteArticle(id) {
		if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
			window.location.href = '<?php echo site_url(); ?>news/delete/' + id;
		}
	}
</script>