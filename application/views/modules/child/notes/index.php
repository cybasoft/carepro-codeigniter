<?php $this->load->view('modules/child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#notes" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="fa fa-clipboard"></i>
                        <span class="hidden-xs"><?php echo lang('notes'); ?></span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#incidents" aria-controls="incidents" role="tab" data-toggle="tab">
                        <i class="fa fa-exclamation-triangle text-warning"></i>
                        <span class="hidden-xs"><?php echo lang('incident_reports'); ?></span>
                    </a>
                </li>
                <?php if(isset($_GET['viewNote']) || isset($_GET['viewIncident'])): ?>
                    <li role="presentation">
                        <a href="#view-notes" aria-controls="view-notes" role="tab" data-toggle="tab">
                            <i class="fa fa-folder-open"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(!is('parent')): ?>
                    <li class="pull-right">
                        <button type="button" class="btn btn-warning btn-flat btn-sm" data-toggle="modal"
                                data-target="#newIncidentModal">
                            <i class="fa fa-plus-circle"></i>
                            <span class="hidden-xs"><?php echo lang('new incident'); ?></span>
                        </button>
                        <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal"
                                data-target="#newNoteModal">
                            <i class="fa fa-plus-circle"></i>
                            <span class="hidden-xs"><?php echo lang('new_note'); ?> </span>
                        </button>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="notes">

                    <?php foreach ($notes as $note): ?>
                        <div class="box box-default box-solid">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a style="color: #1974cc;"
                                       id="<?php echo $note->id; ?>"
                                       class="viewNote"
                                       href="#">
                                        <?php echo $note->title; ?>
                                    </a>
                                </h4>

                                <?php if(!is('parent')): ?>
                                    <a class="pull-right delete "
                                       href="<?php echo site_url('notes/destroy/'.$note->id); ?>">
                                        <i class="fa fa-trash-alt text-danger"></i></a>
                                <?php endif; ?>
                            </div>
                            <div class="box-body">
                                <?php echo word_limiter(htmlspecialchars_decode($note->content)); ?>
                            </div>
                            <div class="box-footer">
                                <?php echo format_date($note->created_at); ?>
                                |
                                <?php echo $this->user->user($note->user_id)->first_name; ?>
                                <?php echo $this->user->user($note->user_id)->last_name; ?>
                                |
                                <strong><?php echo lang('Category'); ?>:</strong>
                                <?php echo $this->notes->category($note->category_id); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="incidents">
                    <br/>
                    <?php foreach ($incidents as $incident): ?>
                        <div class="box  box-info">
                            <div class="box-header with-border">
                                <div class="box-title">
                                    <em class="text-olive small">
                                        <?php echo format_date($incident->date_occurred); ?>
                                        <?php echo lang('by'); ?>
                                        <?php echo $this->user->user($incident->user_id)->first_name; ?>
                                        <?php echo $this->user->user($incident->user_id)->last_name; ?>
                                    </em>
                                    <br/>
                                    <a style="color: #1974cc;"
                                       href="?viewIncident=<?php echo $incident->id; ?>#view-notes"
                                       class="text-info"> <?php echo $incident->title; ?></a>
                                </div>
                                <?php if(!is('parent')): ?>
                                    <a class="pull-right delete "
                                       href="<?php echo site_url('notes/deleteIncident/'.$incident->id); ?>">
                                        <i class="fa fa-trash-alt text-danger"></i></a>
                                <?php endif; ?>
                            </div>
                            <div class="box-body">
                                <?php echo word_limiter($incident->description); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if(!is('parent')): ?>
                <?php endif; ?>
                <?php if(isset($_GET['viewNote']) || isset($_GET['viewIncident'])): ?>
                    <div role="tabpanel" class="tab-pane fade" id="view-notes">
                        <?php if(isset($_GET['viewNote'])) {

                        }
                        if(isset($_GET['viewIncident'])) {
                            $this->load->view('modules/child/notes/view-incident');
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view('modules/child/notes/create-note-modal'); ?>
<?php $this->load->view($this->module.'create-incident-modal'); ?>
<?php $this->load->view('modules/child/notes/view-note-modal'); ?>
<script>

    $('.viewNote').click(function () {
        var modal = $('#noteViewModal');
        var note_id = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('notes/view'); ?>',
            data: {note_id: note_id},
            type: 'POST',
            success: function (response) {
                res = JSON.parse(response);
                modal.find('.modal-title').html(res.title);
                modal.find('.note-content').html(decodeHtml(res.content));
                modal.find('.note-user').html(res.user);
                modal.find('.note-date').html(res.created_at);
                modal.find('.note-cat').html(res.category);
                modal.find('.note-tags').html(res.tags);
                modal.modal('show')
            },
            error: function (error) {
                console.log(error);
            }
        });
    })
</script>