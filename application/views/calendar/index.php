<div class="card">
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>

<?php
$this->load->view('calendar/view_event');
if(is(['admin', 'manager', 'staff']))
    $this->load->view('calendar/new_event');
if(is(['admin', 'manager', 'staff']))
    $this->load->view('calendar/edit_event');
?>