<div class="row">
    <?php echo form_open('news/update/'.$article->id); ?>
    <div class="col-sm-9">
        <?php
        echo form_label(lang('Title'), 'title');
        echo form_input('title', $article->title, ['class' => 'form-control', 'required' => 'required']);

        echo form_label(lang('Content'), 'content');
        echo form_textarea('content', html_entity_decode($article->content), ['class' => 'form-control editor', 'rows' => 10]);

        ?>
    </div>
    <div class="col-sm-3">
        <?php
        echo form_label(lang('Date'),'publish_date');
        echo form_date('publish_date',NULL, ['class'=>'form-control']);
        echo form_label(lang('Status'),'status');
        echo form_dropdown('status',['published'=>lang('Published'),'draft'=>lang('Draft')],'draft', ['class'=>'form-control']);
        echo form_label(lang('Category'),'category');
        echo form_dropdown('category_id',$categories,$article->category_id, ['class'=>'form-control']);
        echo form_input('category',null, ['class'=>'form-control','placeholder'=>lang('Enter new category')]);
        echo form_label(lang('list_order'), 'list_order');
        echo form_input('list_order', $article->list_order, ['class' => 'form-control', 'required' => 'required']);
        ?>
        <br/>
        <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit')); ?>

        <a href="#" onclick="deleteArticle('<?php echo $article->id; ?>')" type="button"
                class="btn btn-danger pull-right">
            <span class="fa fa-trash-alt"></span>
            <?php echo lang('delete'); ?>
        </a>
    </div>
    <?php echo form_close(); ?>


</div>
<script type="text/javascript">
    function deleteArticle(id) {
        if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
            window.location.href = '<?php echo site_url(); ?>news/delete/' + id;
        }
    }
</script>