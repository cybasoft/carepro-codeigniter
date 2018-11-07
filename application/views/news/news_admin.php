<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?php echo anchor('news/create',icon('plus').' '.lang('New article'),'class="btn btn-primary pull-right"'); ?></h4>
    </div>
    <br/>
    <div class="card-content">
        <table class="table  table-striped" id="datatable">
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
                        <?php echo anchor('news/edit/'.$article->id,icon('pencil-alt'),'class="btn btn-default btn-sm"'); ?>
                        <?php echo anchor('news/delete/'.$article->id,icon('trash-alt'),'class="delete btn btn-danger btn-sm"'); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>