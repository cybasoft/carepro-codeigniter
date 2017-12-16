<button class="btn btn-default"
        data-toggle="modal"
        data-target="#new-child-note">
    <span class="fa fa-plus"></span>
<?php echo lang('add').' '.lang('note'); ?>
</button>
<?php
$this->db->where('child_id', $row->id);
$q = $this->db->get('child_notes')->result();
foreach ($q as $r):
    ?>
    <div class="col-lg-4 children-notes">
        <div class="children-notes-title">
            <?php
            echo date('m-d-y G:i', strtotime($r->date));
            echo ' by ';
            echo $this->conf->getUser($r->user_id, 'username');
            ?>
        </div>
        <div class="children-notes-content">
            <?php echo $r->content; ?>

        </div>
    </div>

<?php endforeach; ?>


<div class="modal fade" id="new-child-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only"><?php echo lang('close'); ?></span></button>
                <h4 class="modal-title" id="myModalLabel">
                    Note for:
                    <?php echo $row->lname . ', ' . $row->fname; ?></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('children/add_note/' . $row->id); ?>
                <textarea class="form-control" name="note-content" placeholder="Note content" required=""></textarea>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('cancel'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>