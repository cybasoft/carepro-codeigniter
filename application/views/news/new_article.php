<?php echo form_open('news/create'); ?>

<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('Title'), 'title');
                echo form_input('title', null, ['class' => 'form-control', 'required' => 'required']);

                echo form_label(lang('Content'), 'content');
                echo form_textarea('content', null, ['class' => 'form-control editor', 'rows' => 10]);

                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-3">

        <div class="card">
            <div class="card-body">
                <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit')); ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('Status'), 'status');
                echo form_dropdown('status', ['published' => lang('Published'), 'draft' => lang('Draft')], 'draft', ['class' => 'form-control']);
                ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('Date'), 'publish_date');
                echo form_date('publish_date', date('Y-m-d'), ['class' => 'form-control']);
                echo form_label(lang('Time'), 'Time');
                echo form_time('publish_time', date('H:i'), ['class' => 'form-control']);
                ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('Category'), 'category');
                echo form_dropdown('category_id', $categories, null, ['class' => 'form-control']);

                echo form_input('category', NULL, ['class' => 'form-control', 'placeholder' => lang('Enter new category')]);
                ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <?php
                echo form_label(lang('list_order'), 'list_order');
                echo form_input('list_order', 0, ['class' => 'form-control', 'required' => 'required']);
                ?>
            </div>
        </div>
    </div>
</div>


<?php echo form_close(); ?>
