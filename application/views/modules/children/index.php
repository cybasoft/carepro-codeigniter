<div class="row">
    <div class="col-md-4 col-sm-6">
        <select class="list-limit label label-default" name=limit>
            <option value=5 <?php echo list_selected(5); ?>>5 <?php echo lang('records'); ?></option>
            <option value=10 <?php echo list_selected(10); ?>>10 <?php echo lang('records'); ?></option>
            <option value=25 <?php echo list_selected(25); ?>>25 <?php echo lang('records'); ?></option>
            <option value=50 <?php echo list_selected(50); ?>>50 <?php echo lang('records'); ?></option>
        </select>
    </div>
    <div class="col-md-4 col-sm-6">
        <?php echo form_open('children', 'class="input-group"'); ?>
        <input type="text" name="search" class="form-control" placeholder="<?php echo lang('search'); ?>..."/>
        <span class="input-group-btn">
            <button class="btn btn-default">
                <span class="fa fa-search"></span>
			</button>
        </span>
        <?php echo form_close(); ?>

    </div>
    <div class="col-md-4 col-sm-6 text-right">
        <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#newChildModal">
            <span class="fa fa-plus"></span>
            <?php echo lang('register_child'); ?>
        </button>
        <a href="<?php echo site_url('children/roster'); ?>" target="_blank" class="btn btn-warning btn-flat">
            <span class="fa fa-print"></span>
            <?php echo lang('children_roster'); ?>
        </a>
    </div>
</div>
<hr/>
<?php
$page_name = $this->uri->segment(2);
if (!isset($_GET['limit'])) {
    $limit = 5;
} else {
    $limit = $_GET['limit'];
}
if (strlen($limit) > 0 and !is_numeric($limit)) {
    echo 'Data Error';
    exit;
}

if (!isset($_GET['start'])) {
    $start = 0;
} else {
    $start = $_GET['start'];
}
if (strlen($start) > 0 and !is_numeric($start)) {
    echo 'Data Error';
    exit;
}

//selected option
function list_selected($select)
{
    if (isset($_GET['limit'])) {
        $limit = $_GET['limit'];
    } else {
        $limit = '';
    }
    if ($limit == $select) {
        return 'selected';
    }
    return false;
}

//pagination limits
$eu = ($start - 0);

if (!$limit > 0) {
    $limit = 10; //default limit
}
$this1 = $eu + $limit;
$back = $eu - $limit;
$next = $eu + $limit;

if ($this->input->post('search')) {
    $this->db->like('last_name', $this->input->post('search'));
    $this->db->or_like('first_name', $this->input->post('search'));
}
$this->db->limit($limit, $eu);
$query = $this->db->get('children')->result();
?>
<div class="row">
    <?php if (!empty($query)) { ?>
        <?php foreach ($query

                       as $row): ?>
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tr>
                        <td class="cursor" onclick="window.location.href='<?php echo site_url('child/' . $row->id); ?>'">
                            <?php
                            if ($row->photo !== "") {
                                echo '<img class=""
         src="' . base_url() . 'assets/uploads/users/children/' . $row->photo . '" style="width: 120px; height:120px"/>';
                            } else {
                                echo '<img class="img-circle"
         src="' . base_url() . 'assets/img/content/no-image.png" style="width: 120px; height:120px"/>';
                            }
                            ?>
                        </td>
                        <td>
                            <h4>
                                <a href="<?php echo site_url('/child/' . $row->id); ?>">
                                    <?php echo $row->last_name . ', ' . $row->first_name; ?>
                                </a>
                            </h4>
                            ID:
                            <?php echo decrypt($row->national_id); ?>
                            <br/>
                            <?php echo lang('birthday'); ?>:
                            <?php echo format_date($row->bday,false); ?> <br/>

                            <hr/>
                            <?php if ($this->child->is_checked_in($row->id) == 1) : ?>
                                <a id="<?php echo $row->id; ?>" href="#"
                                   class="btn btn-danger btn-flat btn-sm child-check-out">
                                    <span class="fa fa-new-window"></span>
                                    <?php echo lang('check_out'); ?>
                                </a>
                            <?php else : ?>
                                <a id="<?php echo $row->id; ?>" href="#"
                                   class="btn btn-primary btn-flat btn-sm child-check-in">
                                    <span class="fa fa-check"></span>
                                    <?php echo lang('check_in') . ' &nbsp; '; ?>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        <a href="<?php echo site_url('children'); ?>" class="btn btn-primary"><i class="fa fa-chevron-left"></i> <?php echo lang('back'); ?></a>
        <hr/>
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i> <?php echo lang('no_results_found'); ?></div>
    <?php } ?>
</div>
<hr/>
<div class="row">
    <div class="col-sm-12 col-md-12 col-sm-12">
        <div class="btn-group">
            <?php
            //navigation
            if ($back >= 0) {
                echo '<a class="btn btn-default" href="' . $page_name . '?start=' . $back . '&limit=' . $limit . '">&laquo;</a>';
            } else {
                echo '<button disabled class="btn btn-default">&laquo;</button>';
            }
            $i = 0;
            $l = 1;
            for ($i = 0; $i < $this->child->getCount(); $i = $i + $limit) {
                if ($i <> $eu) {
                    echo '<a class="btn btn-default" href="' . $page_name . '?start=' . $i . '&limit=' . $limit . '">' . $l . '</a>';
                } else {
                    echo '<button class="btn btn-danger">' . $l . '</button>';
                }
                $l = $l + 1;
            }

            if ($this1 < $this->child->getCount()) {
                echo '<a class="btn btn-default" href="' . $page_name . '?start=' . $next . '&limit=' . $limit . '">&raquo;</a>';
            } else {
                echo '<button disabled class="btn btn-default">&raquo;</button>';
            }
            ?>
        </div>
    </div>
</div>

<div class="my_modal"></div>

<?php $this->load->view('modules/children/register'); ?>

<script type="text/javascript">
    $('.list-limit').change(function () {
        var limit = $(this).val();
        window.location.href = '<?php echo $page_name; ?>?limit=' + limit;
    });
    $('.child-check-in').click(function () {
        var child_id = $(this).attr('id');
        $('.my_modal').load('<?php echo site_url('child'); ?>/' + child_id + '/checkIn').modal();
    });
    $('.child-check-out').click(function () {
        var child_id = $(this).attr('id');
        $('.my_modal').load('<?php echo site_url('child'); ?>/' + child_id + '/checkOut').modal();
    });

</script>