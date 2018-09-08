<div class="row">
    <div class="col-sm-3">
        <?php $this->load->view($this->module . 'sidebar'); ?>
    </div>
    <div class="col-sm-9">
        <div class="box box-success box-solid-head">
            <div class="box-header">
                <div class="box-title">
                    <h3>
                        <?php echo $article->article_name; ?>
                    </h3>
                </div>

                <div class="pull-right box-tools">
                    <?php if (is(['manager','admin'])): ?>
                        <a href="<?php echo site_url('news/editor/' . $article->id); ?>" class="btn btn-success btn-sm">
                            <span class="fa fa-edit"></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-body">
                <em>
                    <?php echo format_date($article->publish_date); ?>
                    |
                    <?php echo $this->user->getUser($article->user_id, 'first_name'); ?>
                </em>
                <br/>
                <br/>
                <?php echo $article->article_body; ?>
            </div>

        </div>
    </div>
</div>