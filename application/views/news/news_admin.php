
<?php echo anchor('news/create',icon('plus').' '.lang('New article'),'class="btn btn-primary pull-right"'); ?>
<br/>
<br/>
<table class="table table-responsive table-striped" id="datatable">
    <thead>
    <tr>
        <th><?php echo lang('Date'); ?></th>
        <th><?php echo lang('Title'); ?></th>
        <th><?php echo lang('Status'); ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($articles as $article): ?>
    <tr>
        <td><?php echo format_date($article->publish_date); ?></td>
        <td><?php echo $article->title; ?></td>
        <td><?php echo $article->status; ?></td>
        <td data-sortable="false">
            <?php echo anchor('news/'.$article->id.'/edit',icon('pencil')); ?>
            <a href="#" class="delete" id="<?php echo $article->id; ?>"><i class="fa fa-trash"></i> </a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>