<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('new_item'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open('invoice/'.$invoice[0]->id.'/addItem'); ?>
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
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>