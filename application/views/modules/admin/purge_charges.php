<div class="alert alert-danger">
    Warning! This is an admin action. This will delete all records. Type "PURGE" to
    continue
</div>
<?php
if (!isset($_POST['confirm'])) { //double check this is the action
    echo form_open();
    ?>
    <div class="input-group">
        <input type="text" name="confirm" class="form-control"/>
    <span class="input-group-btn">
        <button class="btn btn-danger">PURGE!</button>
    </span>
    </div>
    <?php
    echo form_close();
} else {
    if ($_POST['confirm'] == "PURGE") {

        $this->db->where('child_id', $this->my_child->getChildId());

        $this->db->delete('child_charges');

        if ($this->db->affected_rows() > 0) {

            $this->conf->msg('success', 'Success! Charges purged');
        } else {

            $this->conf->msg('danger', 'Error! Unable to purge charges');
        }
        redirect('child#charges');
    } else {
        redirect('admin/purge_charges');
    }
}
?>