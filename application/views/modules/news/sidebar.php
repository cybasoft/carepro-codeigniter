<ul class="nav news-sidebar">
    <?php if (is('manager') == true || is('admin') == true): ?>
        <a href="<?php echo site_url('news/create'); ?>" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            <?php echo lang('new_article'); ?>
        </a>
        <hr/>
    <?php endif; ?>

    <?php
    //list articles
    $this->db->order_by('order', 'asc');
    foreach ($this->db->get('news')->result() as $row): ?>
        <li>
            <a href="<?php echo site_url('news/view/' . $row->id); ?>">
          <span class="label label-default">
              <?php echo format_date($row->publish_date, false); ?>
          </span>
                <br/><?php echo $row->article_name; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>