<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('new_item'); ?></h4>
            </div>
            <?php echo form_open('invoice/'.$invoice->id.'/addItem'); ?>
            <div class="modal-body">
                <label><?php echo lang('item_name'); ?></label>
                <input type="text" name="item_name" class="form-control" required/>
                <label><?php echo lang('description'); ?></label>
                <input type="text" name="description" class="form-control" required/>
                <label><?php echo lang('price'); ?></label>
                <input type="text" name="price" class="form-control" required/>
                <label><?php echo lang('quantity'); ?></label>
                <input type="number" name="qty" class="form-control" required/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>