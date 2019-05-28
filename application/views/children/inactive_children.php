<table class="table table-striped" id="datatable">
    <thead>
    <tr>
        <th></th>
        <th>
            <?php echo lang('Name'); ?>
        </th>
        <th>
            <?php echo lang('DOB'); ?>
        </th>
        <th>ID</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($inactiveChildren as $child): ?>
        <tr>
            <td><img style="width:80px;"
                     src="<?php echo $child->photo == '' ? base_url().'assets/img/content/no-image.png' : base_url().'assets/uploads/children/'.$child->photo; ?>">
            </td>
            <td><a href="<?php echo site_url($daycare_id.'/child/'.$child->id); ?>">
                    <?php echo $child->last_name.', '.$child->first_name; ?>
                </a>
            </td>
            <td>
                <?php echo format_date($child->bday, FALSE); ?>
            </td>
            <td>
                <?php echo decrypt($child->national_id); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
