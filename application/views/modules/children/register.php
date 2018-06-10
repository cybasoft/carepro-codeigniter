<?php echo form_open('child/register'); ?>
    <div class="row">
        <div class="col-md-2">
            <?php echo lang('nickname'); ?>
        </div>
        <div class="col-md-4">
            <input class="form-control" required="" type="text" name="nickname"
                   value=""/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-2">
            <?php echo lang('first_name'); ?>
        </div>
        <div class="col-md-4">
            <input class="form-control" required="" type="text" name="first_name" value=""/>
        </div>
        <div class="col-md-2">
            <?php echo lang('last_name'); ?>
        </div>
        <div class="col-md-4">
            <input class="form-control" required="" type="text" name="last_name" value=""/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-2"><?php echo lang('birthday'); ?></div>
        <div class="col-md-4">
            <input class="form-control" id="bday" required="" type="date" name="bday"
                   value="<?php echo date('Y-m-d'); ?>"/>
        </div>
        <div class="col-md-2"><?php echo lang('gender'); ?></div>
        <div class="col-md-4"><select required class="form-control" name="gender">
                <option value="">--<?php echo lang('select'); ?>--</option>
                <option value="male"><?php echo lang('male'); ?></option>
                <option value="female"><?php echo lang('female'); ?></option>
                <option value="other"><?php echo lang('other'); ?></option>
            </select>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-2"><?php echo lang('ID'); ?></div>
        <div class="col-md-4">
            <input type="text" name="national_id" required value="" class="form-control"/>
        </div>
        <div class="col-md-2"><?php echo lang('blood_type'); ?></div>
        <div class="col-md-4">
            <select name="blood_type" required="" class="form-control">
                <option value="unknown">--<?php echo lang('select'); ?>--</option>
                <option value="A-">A-</option>
                <option value="A+">A+</option>
                <option value="B-">B-</option>
                <option value="B+">B+</option>
                <option value="AB-">AB-</option>
                <option value="AB+">AB+</option>
                <option value="O-">O-</option>
                <option value="O+">O+</option>
            </select>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-2"><?php echo lang('status'); ?></div>
        <div class="col-md-4">
            <select class="form-control" name="status" required>
                <option value="1"><?php echo lang('active'); ?></option>
                <option value="0"><?php echo lang('inactive'); ?></option>
            </select>
        </div>
        <div class="col-md-2"><?php echo lang('ethnicity'); ?></div>
        <div class="col-md-4">
            <input class="form-control" id="ethnicity" required="" type="text" name="ethnicity" value=""/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-2"><?php echo lang('religion'); ?></div>
        <div class="col-md-4">
            <input class="form-control" id="religion" required="" type="text" name="religion" value=""/>
        </div>
        <div class="col-md-2"><?php echo lang('birthplace'); ?></div>
        <div class="col-md-4">
            <input class="form-control" id="birthplace" required="" type="text" name="birthplace" value=""/>
        </div>
    </div>
    <button class="btn btn-primary"><?php echo lang('update'); ?></button>
<?php echo form_close(); ?>