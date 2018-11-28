<div class="card">
	<div class="card-header">
		<h4 class="card-title">
            <?php $this->load->view('rooms/create-room'); ?>
        </h4>

	</div>
	<div class="card-body">

        <div class="row">

            <?php foreach ($rooms as $room): ?>
                <div class="col-md-3 cursor"
                     onclick="window.location.href='<?php echo site_url('rooms/view/'.$room->id); ?>'"
                     id="<?php echo $room->id; ?>">

                    <div class="box box-solid box-warning">
                        <div class="box-header">
                            <h4 class="box-title">
                                <?php echo $room->name; ?></h4>
                        </div>
                        <div class="box-body">
                            <p style="font-size:12px;color:#ccc"><?php echo $room->description; ?></p>
                        </div>

                        <div class="card-footer">
                            <div class="row text-sm">
                                <div class="col-md-6">
                                    <span class="label label-success"><?php echo $room->total_staff; ?></span>
                                    <?php echo lang('staff'); ?>
                                </div>
                                <div class="col-md-6">
                                    <i class="label label-success"><?php echo $room->total_children; ?></i>
                                    <?php echo lang('children'); ?>
                                </div>
                            </div>

                            <?php if(isset($_GET['room']) && $_GET['room'] == $room->id): ?>
                                <span class="arrow-right"></span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>
        </div>
	</div>
</div>

