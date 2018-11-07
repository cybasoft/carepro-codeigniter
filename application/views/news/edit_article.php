<?php echo form_open('news/update/'.$article->id); ?>

<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('Title'), 'title');
                echo form_input('title', $article->title, ['class' => 'form-control', 'required' => 'required']);

                echo form_label(lang('Content'), 'content');
                echo form_textarea('content', html_entity_decode($article->content), ['class' => 'form-control editor', 'rows' => 10]);

                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-3">

        <div class="card">
            <div class="card-body">
                <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit')); ?>
                <?php echo anchor('news/delete/'.$article->id, icon('trash-alt'), 'class="btn btn-danger delete pull-right"'); ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('Status'), 'status');
                echo form_dropdown('status', ['published' => lang('Published'), 'draft' => lang('Draft')], $article->status, ['class' => 'form-control']);
                ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('Date'), 'publish_date');
                echo form_date('publish_date', date('Y-m-d',strtotime($article->publish_date)), ['class' => 'form-control']);
                echo form_label(lang('Time'), 'Time');
                echo form_time('publish_time', date('H:i',strtotime($article->publish_date)), ['class' => 'form-control']);
                ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('Category'), 'category');
                echo form_dropdown('category_id', $categories, $article->category_id, ['class' => 'form-control']);

                echo form_input('category', NULL, ['class' => 'form-control', 'placeholder' => lang('Enter new category')]);
                ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('list_order'), 'list_order');
                echo form_input('list_order', $article->list_order, ['class' => 'form-control', 'required' => 'required']);
                ?>
            </div>
        </div>
    </div>
</div>


<?php echo form_close(); ?>
