<?php $incident = $this->db->where('id', $_GET['viewIncident'])->get('child_incident')->row(); ?>
<h2 class="text-purple"><?php echo $incident->title; ?></h2>
<em>
    <?php
    echo lang('created_at') . ': '
        . format_date($incident->created_at)
        . ' ' . lang('by') . ' '
        . $this->user->user($incident->user_id)->first_name . ' '
        . $this->user->user($incident->user_id)->last_name;
    ?>
</em><br/>
<h3><?php echo lang('date'); ?></h3>
<?php echo format_date($incident->date_occurred); ?>

<h3><?php echo lang('incident_type'); ?></h3>
<?php echo $incident->incident_type; ?>

<h3><?php echo lang('location'); ?></h3>
<?php echo $incident->location; ?>

<h3><?php echo lang('description'); ?></h3>
<?php echo $incident->description; ?>

<h3><?php echo lang('actions_taken'); ?></h3>
<?php echo $incident->actions_taken; ?>

<h3><?php echo lang('actions_taken'); ?></h3>
<?php echo $incident->actions_taken; ?>

<h3><?php echo lang('witnesses'); ?></h3>
<?php echo $incident->witnesses; ?>

<h3><?php echo lang('remarks'); ?></h3>
<?php echo $incident->remarks; ?>
