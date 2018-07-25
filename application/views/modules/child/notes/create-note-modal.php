<div class="modal fade" id="newNoteModal" tabindex="-1" role="dialog" aria-labelledby="newNoteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="newNoteLabel"><?php echo lang('new_note'); ?></h4>
            </div>
            <?php echo form_open('notes/store'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>
            <div class="modal-body">
                <?php

                echo form_label(lang('Title'));
                echo form_input('title', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('Category'));

                echo '<div class="clearfix">';
                foreach ($this->db->get('notes_categories')->result() as $cat) {
                    echo '<label class="options">';
                    echo '<span>'.lang($cat->name).'</span>';
                    echo form_radio('category_id', lang($cat->id));
                    echo '<span class="radio"></span>';
                    echo '</label>';
                }
                echo '</div>';

                echo form_label(lang('Note tags'));
                echo '<div class="clearfix">';
                foreach ($this->db->get('notes_tags')->result() as $tag) {
                    echo '<label class="options">';
                    echo '<span>'.lang($tag->name).'</span>';
                    echo form_checkbox('tags[]', lang($tag->name));
                    echo '<span class="checkmark"></span>';
                    echo '</label>';
                }
                echo '</div>';
                echo '<div class="clearfix"></div>';

                echo form_label(lang('Notes'));
                echo form_textarea('note-content', null, ['class' => 'form-control editor-media']);

                ?>
            </div>
            <div class="modal-footer">
                <?php

                echo form_button(
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ], lang('submit'));
                echo form_button(
                    [
                        'data-dismiss' => 'modal',
                        'class' => 'btn btn-default'
                    ], lang('close'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>