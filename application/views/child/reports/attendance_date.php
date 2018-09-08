

<link rel="stylesheet" href="<?php echo assets('css/bootstrap.min.css'); ?>"/>
<link rel="stylesheet" href="<?php echo assets('plugins/datepicker/bootstrap-datetimepicker.css'); ?>"/>

<div class="container" style="position:relative">
    <div class="row">
        <div class="col-sm-12 form-inline">
            <form method="post">
            <div class="input-group" id="DateDemo">
                <input type='text' name="date" id='weeklyDatePicker' class="form-control" placeholder="Select Week"/>
                <span class="input-group-btn"> <button class="btn btn-default">Go</button></span>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="<?php echo assets('js/jquery.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.10.6/moment.min.js"></script>
<script src="<?php echo assets('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo assets('plugins/datepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
<script>

    $(document).ready(function () {

        //Initialize the datePicker(I have taken format as mm-dd-yyyy, you can     //have your owh)
        $("#weeklyDatePicker").datetimepicker({
            format: 'MM-DD-YYYY'
        });

        //Get the value of Start and End of Week
        $('#weeklyDatePicker').on('dp.change', function (e) {
            var value = $("#weeklyDatePicker").val();
            var firstDate = moment(value, "MM-DD-YYYY").day(1).format("MM-DD-YYYY");
            var lastDate = moment(value, "MM-DD-YYYY").day(5).format("MM-DD-YYYY");
            $("#weeklyDatePicker").val(firstDate + " - " + lastDate);
        });
    });
</script>