<div class="row">
    <div class="col-sm-3">
        <?php $this->load->view($this->module.'sidebar'); ?>
    </div>
    <div class="col-sm-9 col-md-9 col-lg-9">
        <h2>
            <i class="fa fa-clipboard" aria-hidden="true"></i> <?php echo lang('new_article'); ?></h2>
        <?php echo form_open('news/create');

        echo form_label(lang('Title'), 'title');
        echo form_input('title', null, ['class' => 'form-control', 'required' => 'required']);

        echo form_label(lang('list_order'), 'list_order');
        echo form_input('list_order', set_value('list_order', 0), ['class' => 'form-control', 'required' => 'required']);

        echo form_label(lang('Content'), 'article_body');
        echo form_input('article_body', null, ['class' => 'form-control', 'rows' => 10]);
        echo '<br/>';

        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit'));
        echo form_close(); ?>
    </div>

</div>