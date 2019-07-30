<div class="row">

    <div class="col-sm-9 col-sm-offset-1">
        <?php foreach ($articles as $article): ?>
           <div class="card">
               <div class="news-box" style="height:auto;">
                   <div class="card-body">
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
           </div>
        <?php endforeach; ?>
        <div>
            <?php
               if(count($articles) >= 15){
                   echo $this->pagination->create_links();
               }
            ?>
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