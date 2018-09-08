<div class="row">
    <div class="col-sm-3">
        <?php $this->load->view($this->module.'sidebar'); ?>
    </div>
    <div class="col-sm-9">
        <?php foreach ($articles->result() as $article): ?>
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
                        <?php echo word_limiter($article->article_body, 50); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?php echo site_url('news/view/' . $article->id); ?>">
                        <?php echo lang('read'); ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>