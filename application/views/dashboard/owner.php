<div id="accordion">
    <?php foreach ($all_daycares as $daycare) : ?>
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link pl-0" data-toggle="collapse" data-target="#daycare_<?php echo $daycare['id'] ?>" aria-expanded="true" aria-controls="collapseOne" style="font-size: 16px;">
                        <?php echo $daycare['name'] . " (" . $daycare['email'] . ")" ?>
                    </button>
                </h5>
            </div>
            <div id="daycare_<?php echo $daycare['id'] ?>" class="collapse <?php if($daycare['id'] == 1){ echo "show"; } ?>" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p style="font-weight: 700;">Admin Details:</p>
                    <div class="table-responsive">
                    <table class="table">
                    <?php foreach ($all_users as $user): if($user['daycare_id'] == $daycare['id'] && $user['group_id'] == 1):?>
                         <tr align="center">
                             <td><?php if($user['first_name'] == ''){ echo $user['name']; }else{ echo $user['first_name'] ." " . $user['last_name']; } ?></td>
                             <td><?php echo $user['email'] ?></td>
                         </tr>
                        <?php elseif($user['daycare_id'] == $daycare['id'] && $user['group_id'] != 1): ?>
                        <tr align="center">
                            <td>No admin details found</td>
                        </tr>
                    <?php endif; endforeach; ?>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>