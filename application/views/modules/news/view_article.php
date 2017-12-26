<div class="row">
    <div class="col-sm-3">
        <?php $this->load->view($this->module . 'sidebar'); ?>
    </div>
    <div class="col-sm-9">
        <div class="box box-success">
            <div class="box-header">
                <div class="box-title">
                    <h3>
                        <?php echo $article->article_name; ?>
                    </h3>
                </div>

                <div class="pull-right box-tools">
                    <?php if (is('manager') == true || is('admin') == true): ?>
                        <a href="<?php echo site_url('news/editor/' . $article->id); ?>" class="btn btn-success btn-sm">
                            <span class="fa fa-edit"></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-body">
                <div class="">
                    By: <span class=" label label-default"><?php echo $this->user->getUser($article->user_id, 'first_name'); ?></span>
                    &nbsp;
                    on: <span class=" label label-default"><?php echo date('d-M-Y', $article->publish_date); ?></span>
                </div>
                <hr/>
                <?php echo $article->article_body; ?>
            </div>
            <div class="box-footer">

            </div>
        </div>
    </div>
</div>