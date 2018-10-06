<link href="<?php echo base_url('assets/plugins/dz/dropzone.min.css'); ?>" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/plugins/lg/css/lightgallery.min.css'); ?>"/>
<?php $incident = $this->db->where('id', $_GET['viewIncident'])->get('child_incident')->row();
$photos = $this->photos->albums('child_incident_photos', $child->id, null, base_url('child/1/notes?viewIncident=4#view-notes'));
if(count((array)$incident) > 0):
?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
        	<div class="card-header">
        		<h4 class="card-title text-danger"><?php echo $incident->title; ?></h4>

                <em>
                    <?php
                    echo sprintf(lang('created on %s by %s'),
                        format_date($incident->created_at),
                        $this->user->user($incident->user_id)->first_name.' '
                        .$this->user->user($incident->user_id)->last_name);
                    ?>

                </em>
        	</div>
        	<div class="card-body">
                <table class="table  table-striped">
                    <tr>
                        <td><strong><?php echo lang('incident date'); ?>:</strong></td>
                        <td><?php echo format_date($incident->date_occurred); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo lang('incident_type'); ?>:</strong></td>
                        <td><?php echo $incident->incident_type; ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo lang('location'); ?>:</strong></td>
                        <td>  <?php echo $incident->location; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong><?php echo lang('description'); ?></strong> <br/>
                            <?php echo $incident->description; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong><?php echo lang('actions_taken'); ?></strong><br/>
                            <?php echo $incident->actions_taken; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong><?php echo lang('actions_taken'); ?></strong><br/>
                            <?php echo $incident->actions_taken; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong><?php echo lang('witnesses'); ?></strong><br/>
                            <?php echo $incident->witnesses; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong><?php echo lang('remarks'); ?></strong><br/>
                            <?php echo $incident->remarks; ?>
                        </td>
                    </tr>
                </table>
        	</div>
        </div>
    </div>
    <div class="col-md-4">
      <div class="card">
      	<div class="card-header">
      		<h4 class="card-title"><?php echo lang('incident photos'); ?></h4>
      	</div>
      	<div class="card-body">
            <?php if(is(['admin','staff','manager'])): ?>
                <form action="<?php echo site_url('notes/storeIncidentPhotos'); ?>"
                      enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
                    <?php echo form_hidden('child_id', $child->id); ?>
                    <?php echo form_hidden('incident_id',$incident->id); ?>
                </form>
            <?php endif; ?>
            <div class="flexbin flexbin-margin" id="lightgallery">
                <?php if(count($photos['results']) > 0): ?>
                <?php foreach ($photos['results'] as $photo): ?>
                    <a data-src="<?php echo base_url('assets/uploads/photos/'.$photo->photo); ?>?id=<?php echo $photo->id; ?>&route=/notes/deleteIncidentPhoto">
                        <img src="<?php echo base_url('assets/uploads/photos/'.$photo->photo); ?>"/>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php if(isset($photos['links'])) { ?>
            <?php echo $photos['links']; ?>
        <?php } ?>
        <?php endif; ?>
      	</div>
      </div>
    </div>
    <?php endif; ?>
</div>
<script src="<?php echo base_url('assets/plugins/dz/dropzone.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/lg/js/lightgallery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/lg/js/lg-thumbnail.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/lg/js/lg-fullscreen.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $('a[href=#view-notes]').find('i').append(' <?php echo $incident->title; ?>');
    Dropzone.options.imageUpload = {
        maxFilesize: 3,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        dictDefaultMessage: "<?php echo lang('dropzone_message'); ?>"
        //previewsContainer: ".flexbin",
        //clickable: true
    };
    lightGallery(document.getElementById('lightgallery'));
</script>