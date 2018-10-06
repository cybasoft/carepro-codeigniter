<div class="row">

    <div class="col-sm-9">
        <div class="card">
            <div class="news-box">
                <a href="<?php echo site_url('news'); ?>" class="btn btn-default btn-sm pull-left"><i class="fa fa-arrow-left"></i> </a>

                <?php if(is(['manager', 'admin'])): ?>
                    <a href="<?php echo site_url('news/edit/'.$article->id); ?>" class="btn btn-default btn-sm pull-right">
                        <span class="fa fa-edit"></span>
                    </a>
                <?php endif; ?>
                <div class="clearfix"></div>
                <div class="card-header">
                    <div class="card-title">
                        <h3>
                            <?php echo $article->title; ?>
                        </h3>
                    </div>

                    <div class="pull-right box-tools">

                    </div>
                </div>
                <div class="card-body">
                    <em>
                        <?php echo format_date($article->publish_date); ?>
                        |
                        <?php echo $article->first_name; ?>
                    </em>
                    <br/>
                    <br/>
                    <?php echo $article->content; ?>
                </div>

            </div>
        </div>

    </div>
    <div class="col-sm-3">
        <?php if(is(['manager', 'admin'])): ?>
            <a href="<?php echo site_url('news/create'); ?>" class="btn btn-primary btn-sm btn-flat">
                <i class="fa fa-plus"></i>
                <?php echo lang('new_article'); ?>
            </a>
            <a href="<?php echo site_url('news/admin'); ?>" class="btn btn-primary btn-sm btn-flat">
                <i class="fa fa-clipboard"></i>
                <?php echo lang('News admin'); ?>
            </a>
            <hr/>
        <?php endif; ?>

        <ul class="nav nav-pills nav-stacked news-sidebar">
            <h3><?php echo lang('Latest news'); ?></h3>
            <?php foreach ($articles as $row): ?>
                <li class="nav-item" style="border-bottom:solid 1px #ccc;">
                    <a class="nav-link" href="<?php echo site_url('news/article/'.$row->id); ?>">
                        <?php echo $row->title; ?><br/>
                        <span class="text-sm text-success">
                            <?php echo format_date($row->publish_date, FALSE); ?>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

</div>