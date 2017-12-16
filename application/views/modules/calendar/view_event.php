<!-- view event -->
<div class="modal fade" id="view-event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only"><?php echo lang('close'); ?></span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td><?php echo lang('start'); ?>:</td>
                        <td class="event-start-sm"></td>
                        <td><?php echo lang('end'); ?>:</td>
                        <td class="event-end-sm"></td>
                    </tr>
                    <tr>
                        <td class="event-desc" colspan="4"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger pull-left trash-event-btn">
                    <span class="fa fa-trash "></span> <?php echo lang('delete'); ?>
                </button>
                <button class="btn btn-info edit-event-btn">
                    <span class="fa fa-pencil"></span> <?php echo lang('edit'); ?>
                </button>
            </div>
        </div>
    </div>
</div>