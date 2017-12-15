<ul class="nav news-sidebar">
    <?php
    //list articles
    $this->db->order_by('order', 'asc');
    foreach ($this->db->get('news')->result() as $row) {
        echo '<li> <a href="#" id="' . $row->id . '"><span class="label label-default"> '.date('d-M-Y',$row->publish_date).'</span><br/>' . $row->article_name . '</a> </li>';
    }
    ?>
</ul>