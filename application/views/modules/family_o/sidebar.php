    <div class="container-fluid">
    <div class="row">

    <div class="col-sm-3 col-md-2 sidebar">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <span class="glyphicon glyphicon-folder-close"></span>
                        <a data-toggle="collapse" data-parent="#accordion" href="#content"><?php echo lang('content'); ?></a>
                    </h4>
                </div>
                <div id="content" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-flash text-success"></span>
                                    <?php echo anchor('news', lang('news')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-calendar text-info"></span>
                                    <?php echo anchor('calendar', lang('calendar')); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <span class="glyphicon glyphicon-user"></span>
                        <a data-toggle="collapse" data-parent="#accordion" href="#accounts"><?php echo lang('account'); ?></a>
                    </h4>
                </div>
                <div id="accounts" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-user text-info"></span>
                                    <?php echo anchor('account/profile/' . $this->users->uid(), lang('profile')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-lock text-info"></span>
                                    <?php echo anchor('account/profile/' . $this->users->uid().'#demograph', lang('password')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="glyphicon glyphicon-link text-info"></span>
                                    <?php echo anchor('account/profile/'.$this->users->uid().'#address', lang('address')); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //remember last clicked menu
        $('a[data-toggle=collapse]').click(function () {
            var att = $(this).closest("div").next().attr('id'); //next collapse div
            $.removeCookie('menu');
            $.cookie('menu', att); //set cookie
        });
        //remember last selected menu
        if ($.cookie('menu')) {
            var c = $.cookie('menu');
            $('#' + c).addClass('in');
        } else {
            $('#content').addClass('in');
        }
    </script>
