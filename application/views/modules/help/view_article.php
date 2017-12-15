<?php
foreach ($my_articles->result() as $row) {
    echo '<div class="alert alert-info">';
    //article title
    echo $row->article_name;

    //allow admin to edit help pages
    if ($this->conf->isManager()==true || $this->conf->isAdmin()==true): ?>

        <span class="label label-default cursor pull-right"
              onclick="window.location.href='help/editor/<?php echo $row->id; ?>'">
            <span class="glyphicon glyphicon-pencil"></span>
            edit</span>
    <?php
    endif;
    echo '</div>';

    //show article body
    echo $row->article_body;
}