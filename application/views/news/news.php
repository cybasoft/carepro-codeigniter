<div class="row">

    <div class="col-sm-9 col-sm-offset-1">
        <?php foreach ($articles as $article): ?>
            <div class="news-box" style="height:auto;">
                <div class="box-body">
                    <h3>
                        <a href="<?php echo site_url('news/article/'.$article->id); ?>">
                            <?php echo $article->title; ?>
                        </a>
                    </h3>
                    <?php echo word_limiter(html_entity_decode($article->content), 50); ?>

                    <br/>
                    <a class="pull-right" href="<?php echo site_url('news/article/'.$article->id); ?>">
                        <?php echo lang('read'); ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

        <div>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>