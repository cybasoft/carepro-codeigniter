<div class="modal fade" id="noteViewModal" tabindex="-1" role="dialog" aria-labelledby="noteViewLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="noteViewLabel"></h4>
            </div>
            <div class="modal-body" style="max-height:700px">
                <div class="row h4 text-purple">
                    <div class="col-xs-4 note-cat"></div>
                    <div class="col-xs-4 note-user"></div>
                    <div class="col-xs-4 note-date"></div>
                </div>
                <hr/>
                <div class="note-tags"></div>
                <hr/>
                <div class="note-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('Close'); ?></button>
            </div>
        </div>
    </div>
</div>