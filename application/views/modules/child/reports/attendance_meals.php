<!DOCTYPE html>
<html>
<head>
    <style>
        #content {
            letter-spacing: normal;
            width: 750.75pt;
            border-collapse: collapse;
            border: none;
            font-family: "Arial", sans-serif;
            font-size: 10px;
        }

        #topRow td {
            width: 122pt;
            border-top: 1.5pt solid;
            border-left: none;
            border-bottom: none;
            border-right: 1.5pt solid;
            padding: 0 5.4pt;
            height: 11.5pt;
            text-align: center;
            font-size: 10px;
        }

        #topRow td:last-child {
            border-bottom: solid 1px;
        }

        #topRow td:first-child {
            border-left: solid 1.5pt;
            height: 11.5pt;
            border-bottom: solid 1px;
        }

        #topRow span {
            font-weight: bold;
        }

        #headerRow td {
            width: 40.4pt;
            border-top: none;
            border-right: solid 2px;
            border-left: none;
            border-bottom: solid 1px;
            padding: 0 5.4pt;
            height: 11.55pt;
            font-weight: bold;
            font-size: 10px;
        }

        #firstNameRow {
            height: 18.7pt;
        }

        #firstNameRow td {
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid;
            border-right: 1pt solid;
            padding: 0 5.4pt;
        }

        #firstNameRow td:first-child {
            border-left: 2px solid;
        }

        #lastNameRow {
            height: 12.95pt;
        }

        #lastNameRow td {
            width: 99.8pt;
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid;
            border-right: 1pt solid;
            padding: 0 5.4pt;
            height: 12.95pt;
        }

        #lastNameRow td:first-child {
            border-left: 2px solid;
        }

        #healthRow td {
            width: 80.95pt;
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid;
            border-right: 1.5pt solid;
            padding: 0in 5.4pt;
            height: 20.15pt;
        }

        input[type=checkbox] {
            width: 16px;
            height: 16px;
        }

        #footRow {
            height: 4.3pt;
        }

        #footRow td {
            width: 99.8pt;
            border-top: none;
            border-left: 1.5pt solid;
            border-bottom: 1pt solid;
            border-right: 1pt solid;
            background: #d9d9d9;
            padding: 0in 5.4pt;
            height: 4.3pt;
        }

        #countRow {
            height: 17.3pt;
        }

        #countRow td:first-child {
            width: 99.8pt;
            border-top: none;
            border-left: 1.5pt solid;
            border-right: 1.5pt solid;
        }

        #countRow td {
            width: 40.4pt;
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid;
            border-right: 1pt solid;
            padding: 0 5.4pt;
            height: 17.3pt;
        }

        #countRow strong {
            display: block;
            text-align: center;
            text-decoration: underline;
        }

        #countRow .checkFood {
            width: 37.45pt;
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid;
            border-right: 1pt solid;
            padding: 0in 5.4pt;
            height: 17.3pt;
        }

        #countRow .checkIn {
            width: 43.55pt;
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid;
            border-right: 1pt solid;
            padding: 0in 5.4pt;
            height: 17.3pt;
        }

        #countRow .checkOut {
            width: 41.95pt;
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid;
            border-right: 1.5pt solid;
            padding: 0in 5.4pt;
            height: 17.3pt;
        }

        #countRow .weekTotals {
            width: 42.15pt;
            border-top: none;
            border-left: none;
            border-bottom: 1pt solid;
            border-right: 1.5pt solid;
            padding: 0in 2.15pt;
            height: 17.3pt;
        }

        .weekTotals p {
        }

        .weekTotals span {
            margin-right: 5px;
            margin-left: 10px;
        }

        #lastTd {
            font-size: 15px;
        }

        #lastTd span {
            margin-right: 10px;
            text-decoration: underline;
        }

        #lastTd span:first-child {
            text-decoration: none;
        }

        .check {
            display: block;
            position: relative;
            padding-left: 24px;
            margin-bottom: 3px;
            cursor: pointer;
            font-size: 12px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            padding-top: 3px;
            margin-top: 5px;
        }

        .check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 16px;
            width: 16px;
            /* background-color: #b9b9b9; */
            border: solid 1px #333;
        }

        .check:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .check input:checked ~ .checkmark {
            background-color: #fff;
            border: solid 1px #333;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .check input:checked ~ .checkmark:after {
            display: block;
        }

        .check .checkmark:after {
            left: 4px;
            top: 0px;
            width: 5px;
            height: 10px;
            border: solid #333;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .weekTotals td {
            border: none !important;
            padding: 0 !important;
            font-size: 15px;
            width: auto !important;
            margin: 0 !important;
            height: auto !important;
            padding-bottom: 4px !important;
        }

        .weekTotals td:nth-child(2) {
            text-indent: 5px;
        }

        .weekTotals table {
            margin-top: 5px;
        }

        .weekTotals td:first-child {
            font-weight: bold;
            color: #1974cc;
        }

        .bootstrap-datetimepicker-widget tr:hover {
            background-color: #808080;
        }

    </style>
</head>
<body>

    <table id="content" width="0">
        <tbody>
        <tr id="topRow">
            <td rowspan="2" valign="bottom"><span>CHILD'S NAME</span></td>
            <td colspan="3"><span>MONDAY</td>
            <td colspan="3"><span>TUESDAY</span></td>
            <td colspan="4"><span>WEDNESDAY</span></td>
            <td colspan="3"><span>THURSDAY</span></td>
            <td colspan="3"><span>FRIDAY</span></td>
            <td rowspan="2"><span>Food Totals</span></td>
        </tr>

        <tr id="headerRow">
            <?php
            $food = unserialize($nyForm->food);

            $start_date = new DateTime(date('Y-m-d H:i:s'));
            for ($i = 0; $i < 5; $i++):
                $start_date->modify('+'.$i.' day');
                ?>
                <td <?php echo $i == 2 ? 'colspan="2"' : ''; ?>><span>FOOD*</span></td>
                <td colspan="2">Date: <?php echo $start_date->format('m/d/Y'); ?></td>
            <?php endfor; ?>
        </tr>


        <tr id="countRow">
            <td></td>
            <?php for ($i = 0; $i < 5; $i++): ?>
                <td rowspan="4" <?php echo $i == 2 ? 'colspan="2"' : ''; ?> class="checkFood">
                    <label class="check">B
                        <input type="checkbox" <?php echo ($food['B']==1) ? 'checked':''; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="check">AM
                        <input type="checkbox" <?php echo ($food['AM']==1) ? 'checked':''; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="check">L
                        <input type="checkbox"  <?php echo ($food['L']==1) ? 'checked':''; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="check">PM
                        <input type="checkbox" <?php echo ($food['PM']==1) ? 'checked':''; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="check">S
                        <input type="checkbox"  <?php echo ($food['S']==1) ? 'checked':''; ?>>
                        <span class="checkmark"></span>
                    </label>
                    <label class="check">EV
                        <input type="checkbox"  <?php echo ($food['EV']==1) ? 'checked':''; ?>>
                        <span class="checkmark"></span>
                    </label>
                </td>
                <td class="checkIn"><strong>IN</strong></td>
                <td class="checkOut"><strong>OUT</strong></td>
            <?php endfor; ?>

            <td class="weekTotals" rowspan="4" valign="top">
                <table cellspacing="0" cellpadding="0" border="0" style="border:none">
                    <tr>
                        <td>2</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>AM</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>L</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>PM</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>S</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>EV</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr id="firstNameRow">
            <td valign="top"><span>First Name</span></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr id="lastNameRow">
            <td rowspan="2" width="133" valign="top">
                Last Name
                <br/>
                <br/>
                DOB: <?php echo date('m/d/Y'); ?>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr id="healthRow">
            <?php for ($i = 0; $i <= 4; $i++): ?>
                <td colspan="2">
                    <label class="check">Absent
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <label class="check">Health check
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </td>
            <?php endfor; ?>
        </tr>
        <tr id="footRow">
            <td colspan="18"></td>
        </tr>
        <tr>
            <td colspan="8">
                *<strong>B</strong>=Breakfast
                <strong>AM</strong>= AM snack
                <strong>L</strong>= Lunch
                <strong>PM</strong>= PM snack
                <strong>S</strong>= Supper
                <strong>EV</strong>= Night snack

            </td>
            <td colspan="8" id="lastTd">
                <strong><span>Page totals:</span></strong>

                <strong>B</strong> <span>3</span>
                <strong>AM</strong> <span>3</span>
                <strong>L</strong> <span>3</span>
                <strong>PM</strong> <span>3</span>
                <strong>S</strong> <span>3</span>
                <strong>EV</strong> <span>3</span>
            </td>
        </tr>

        </tbody>
    </table>

</body>
</html>