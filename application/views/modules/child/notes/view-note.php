<?php $note = $this->db->where('id', $_GET['viewNote'])->get('child_notes')->row(); ?>
    <h2 class="text-purple"><?php echo $note->title; ?></h2>
    <em><?php
        echo lang('created_at') . ': '
            . format_date($note->created_at)
            . ' ' . lang('by') . ' '
            . $this->user->user($note->user_id)->first_name . ' '
            . $this->user->user($note->user_id)->last_name;
        ?>
    </em><br/>

<?php echo $note->content; ?>