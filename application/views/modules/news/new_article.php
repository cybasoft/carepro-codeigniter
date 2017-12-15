<div class="row">
	<div class="col-sm-9 col-md-9 col-lg-9">
		<div class="box box-primary">
			<?php  echo form_open('news/create'); ?>
			<div class="box-header">
				<input type="text"
					   name="article_name"
					   class="form-control"
					   required="" placeholder="<?php echo lang('title'); ?>"
					   value=""/>
				<br/>
				<input
					type="text"
					name="article_order"
					class="form-control"
					required="" placeholder="<?php echo lang('list_order'); ?>"
					value="0"/>
			</div>
			<div class="box-body">
				<textarea name="article_body"
					class="summernote"
					rows="40"
					style="height:300px"></textarea>
			</div>
			<div class="box-footer">
				<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
			</div>
			<?php  echo form_close(); ?>
		</div>
	</div>
</div>