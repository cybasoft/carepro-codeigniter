<div class="box box-info box-solid">
    <div class="box-header">
        <h3 class="box-title"><?php echo sprintf(lang('child_page_heading'), $child->first_name.' '.$child->last_name); ?></h3>
        <div class="box-tools pull-right">
            <?php if(is('admin') || is('staff')): ?>
                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal"><span
                            class="fa fa-pencil-alt"></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?php if(!empty($child->nickname)): ?>
            <div class="row text-primary">
                <div class="col-md-6">
                    <strong><?php echo lang('nickname'); ?></strong>:
                    <?php echo $child->nickname; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('name'); ?></strong>:
                <?php echo $child->first_name.' '.$child->last_name; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('date_of_birth'); ?></strong>:
                <?php echo format_date($child->bday, false); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('national_id'); ?></strong>:
                <?php echo decrypt($child->national_id); ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('gender'); ?></strong>:
                <?php echo $child->gender; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('blood_type'); ?></strong>:
                <?php echo $child->blood_type; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('ethnicity'); ?></strong>:
                <?php echo $child->ethnicity; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('religion'); ?></strong>:
                <?php echo $child->religion; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('birthplace'); ?></strong>:
                <?php echo $child->birthplace; ?>
            </div>
        </div>
    </div>
</div>
<?php if(is('admin') || is('staff')): ?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <?php echo form_open('child/'.$child->id); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"
                        id="myModalLabel"><?php echo $child->first_name.' '.$child->last_name; ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo form_hidden('child_id', $child->id); ?>
                    <div class="row">
                        <div class="col-md-2">
                            <?php echo lang('nickname'); ?>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" required="" type="text" name="nickname"
                                   value="<?php echo $child->nickname; ?>"/>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-2">
                            <?php echo lang('first_name'); ?>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" required="" type="text" name="first_name"
                                   value="<?php echo $child->first_name; ?>"/>
                        </div>
                        <div class="col-md-2">
                            <?php echo lang('last_name'); ?>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control" required="" type="text" name="last_name"
                                   value="<?php echo $child->last_name; ?>"/>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-2"><?php echo lang('birthday'); ?></div>
                        <div class="col-md-4">
                            <input class="form-control" id="bday" required="" type="date" name="bday"
                                   value="<?php echo date('Y-m-d', strtotime($child->bday)); ?>"/>
                        </div>
                        <div class="col-md-2"><?php echo lang('gender'); ?></div>
                        <div class="col-md-4"><select required class="form-control" name="gender">
                                <option value="">--<?php echo lang('select'); ?>--</option>
                                <option value="male" <?php echo selected_option($child->gender, 'male'); ?>>
                                    <?php echo lang('male'); ?>
                                </option>
                                <option value="female" <?php echo selected_option($child->gender, 'female'); ?>>
                                    <?php echo lang('female'); ?>
                                </option>
                                <option value="other" <?php echo selected_option($child->gender, 'other'); ?>>
                                    <?php echo lang('other'); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-2"><?php echo lang('ID'); ?></div>
                        <div class="col-md-4"><input type="text" name="national_id" required
                                                     value="<?php echo decrypt($child->national_id); ?>"
                                                     class="form-control"/></div>
                        <div class="col-md-2"><?php echo lang('blood_type'); ?></div>
                        <div class="col-md-4">
                            <select name="blood_type" required="" class="form-control">
                                <option value="unknown">--<?php echo lang('select'); ?>--</option>
                                <option <?php echo selected_option("A-", $child->blood_type); ?>
                                        value="A-">A-
                                </option>
                                <option <?php echo selected_option("A+", $child->blood_type); ?>
                                        value="A+">A+
                                </option>
                                <option <?php echo selected_option("B-", $child->blood_type); ?>
                                        value="B-">B-
                                </option>
                                <option <?php echo selected_option("B+", $child->blood_type); ?>
                                        value="B+">B+
                                </option>
                                <option <?php echo selected_option("AB-", $child->blood_type); ?>
                                        value="AB-">AB-
                                </option>
                                <option <?php echo selected_option("AB+", $child->blood_type); ?>
                                        value="AB+">AB+
                                </option>
                                <option <?php echo selected_option("O-", $child->blood_type); ?>
                                        value="O-">O-
                                </option>
                                <option <?php echo selected_option("O+", $child->blood_type); ?>
                                        value="O+">O+
                                </option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-2"><?php echo lang('status'); ?></div>
                        <div class="col-md-4">
                            <select
                                    class="form-control"
                                    name="status" required>
                                <option <?php echo selected_option($child->status, 1); ?> value="1">
                                    <?php echo lang('active'); ?>
                                </option>
                                <option <?php echo selected_option($child->status, 0); ?> value="0">
                                    <?php echo lang('inactive'); ?>
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2"><?php echo lang('ethnicity'); ?></div>
                        <div class="col-md-4">
                            <input class="form-control"
                                   id="ethnicity" required=""
                                   type="text" name="ethnicity"
                                   value="<?php echo $child->ethnicity; ?>"/>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-2"><?php echo lang('religion'); ?></div>
                        <div class="col-md-4">
                            <input class="form-control"
                                   id="religion" required=""
                                   type="text" name="religion"
                                   value="<?php echo $child->religion; ?>"/>
                        </div>
                        <div class="col-md-2"><?php echo lang('birthplace'); ?></div>
                        <div class="col-md-4">
                            <input class="form-control"
                                   id="birthplace" required=""
                                   type="text" name="birthplace"
                                   value="<?php echo $child->birthplace; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <?php echo lang('close'); ?>
                    </button>
                    <button class="btn btn-primary"><?php echo lang('update'); ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<?php endif; ?>