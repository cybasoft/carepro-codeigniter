<div class="chat-main-box">
    <!-- .chat-left-panel -->
    <div class="chat-left-aside">
        <div class="open-panel"><i class="ti-angle-right"></i></div>
        <div class="chat-left-inner">
            <div class="form-material">
                <input class="form-control p-20" type="text" placeholder="Search Contact">
            </div>
            <ul class="chatonline style-none ">
                <?php foreach ($senders as $sender): ?>
                    <li>
                        <a href="<?php echo site_url('messaging?m='.$sender->id); ?>"
                           class="<?php echo isset($_GET['m']) && $_GET['m'] == $sender->id ? 'active' : ''; ?>">
                            <img src="<?php echo gravatar($sender->email); ?>"
                                 alt="user-img" class="img-circle">
                            <span><?php echo $sender->name; ?>
                                <!--                                    <small class="text-muted">Away</small>-->
                                </span>
                        </a>
                    </li>
                <?php endforeach; ?>

                <li class="p-20"></li>
            </ul>
        </div>
    </div>

    <div class="chat-right-aside">
        <div class="chat-main-header">
            <div class="p-20 b-b">
                <h3 class="box-title">Conversation</h3></div>
        </div>
        <div class="chat-box">
            <ul class="chat-list slimscroll p-t-30">
                <?php if(isset($_GET['m']) && is_numeric($_GET['m'])): ?>
                    <?php foreach ($chat as $c): ?>
                        <li class="<?php echo $c->sender_id == user_id() ? 'odd' : ''; ?>">
                            <div class="chat-image">
                                <img alt="male" src="<?php echo gravatar($c->email); ?>">
                            </div>
                            <div class="chat-body">
                                <div class="chat-text">
                                    <h4><?php echo $c->name; ?></h4>
                                    <p> <?php echo $c->message; ?> </p>
                                    <b><?php echo format_date($c->created_at); ?></b>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>
                        <div class="chat-image">
                            <img alt="male" src="<?php echo gravatar(session('email')); ?>">
                        </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <h4>Messager bot</h4>
                                <p> <?php echo lang('Select a conversation on the left'); ?> </p>
                                <b><?php echo format_date(date('Y-d-m')); ?></b>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

            </ul>

            <?php if(isset($_GET['m']) && is_numeric($_GET['m'])): ?>
                <div class="row send-chat-box">
                    <div class="col-sm-12">
                        <?php echo form_open_multipart('messaging/send'); ?>
                        <?php echo form_hidden('receiver_id', $_GET['m']); ?>
                        <textarea class="form-control" name="message" placeholder="Type your message"></textarea>
                        <div class="custom-send">
                            <!--                        <a href="javacript:void(0)" class="cst-icon" data-toggle="tooltip" title=""-->
                            <!--                                                data-original-title="Insert Emojis"><i class="ti-face-smile"></i></a> <a-->
                            <!--                                href="javacript:void(0)" class="cst-icon" data-toggle="tooltip" title=""-->
                            <!--                                data-original-title="File Attachment"><i class="fa fa-paperclip"></i></a>-->
                            <button class="btn btn-danger btn-rounded">Send</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- .chat-right-panel -->
</div>