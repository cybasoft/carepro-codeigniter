<div class="row">
    <?php echo form_open('news/create'); ?>
    <div class="col-sm-9">
        <?php
        echo form_label(lang('Title'), 'title');
        echo form_input('title', set_value('title'), ['class' => 'form-control', 'required' => 'required']);

        echo form_label(lang('Content'), 'content');
        echo form_textarea('content', html_entity_decode(set_value('content')), ['class' => 'form-control editor-full', 'rows' => 10]);

        ?>
    </div>
    <div class="col-sm-3">
        <?php
        echo form_label(lang('Date'),'publish_date');
        echo form_date('publish_date',set_value('publish_date'), ['class'=>'form-control']);
        echo form_label(lang('Status'),'status');
        echo form_dropdown('status',['published'=>lang('Published'),'draft'=>lang('Draft')],'draft', ['class'=>'form-control']);
        echo form_label(lang('Category'),'category');
        echo form_dropdown('category_id',$categories,set_value('category'), ['class'=>'form-control']);
        echo form_input('category',null, ['class'=>'form-control','placeholder'=>lang('Enter new category')]);
        echo form_label(lang('list_order'), 'list_order');
        echo form_input('list_order', set_value('list_order', 0), ['class' => 'form-control', 'required' => 'required']);
        ?>
        <br/>
        <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit')); ?>
    </div>
    <?php echo form_close(); ?>

</div>