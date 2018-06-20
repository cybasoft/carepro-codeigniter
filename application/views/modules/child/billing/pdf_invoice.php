<?php
/**
 * @package     daycarepro
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = lang('invoice') . ' - ' . $child->first_name . ' ' . $child->last_name . "\n| DOB: " . format_date($child->bday, false);
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, 60, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('courier', '', 12);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();


ob_start();

?>
    <style>
        table {
            width: 100%;
        }

        th {
            font-weight: bolder;
        }

        table th, .invoice-items td {
            text-align: right;
        }
    </style>
    <table>
        <tr>
            <td>
                <strong><?php echo lang('invoice'); ?>#:</strong>
                <?php echo $invoice->id; ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong><?php echo lang('status'); ?></strong>
                <?php echo lang($invoice->invoice_status); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong><?php echo lang('date'); ?>:</strong>
                <?php echo format_date($invoice->created_at, false); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong><?php echo lang('due'); ?>:</strong>
                <?php echo format_date($invoice->date_due, false); ?>
            </td>
        </tr>
    </table>
    <p><br/></p>
    <table>
        <tr>
            <th><?php echo lang('item'); ?></th>
            <th><?php echo lang('description'); ?></th>
            <th><?php echo lang('quantity'); ?></th>
            <th><?php echo lang('amount'); ?></th>
            <th><?php echo lang('sub_total'); ?></th>
        </tr>
        <tbody>
        <?php foreach ($invoice_items as $item) {
            ?>
            <tr class="invoice-items">
                <td>
                    <?php echo $item->item_name; ?>
                </td>
                <td>
                    <?php echo $item->description; ?>
                </td>

                <td>
                    <?php echo $item->qty; ?>
                </td>
                <td>
                    <?php echo $item->price; ?>
                </td>

                <td>
                    <?php echo(($item->qty * $item->price)); ?>
                </td>
            </tr>
            <?php
            $subTotal = $this->invoice->invoice_subtotal($invoice->id);
        }
        ?>
        <tr>
            <td colspan="5">
                <hr/>
            </td>
        </tr>
        <tr class="invoice-items">
            <td colspan="4"><?php echo lang('sub_total'); ?> :</td>
            <td>
                <?php echo get_option('currency_symbol');
                echo number_format($subTotal, 2); ?>
            </td>
        </tr>
        <tr class="invoice-items" style="color:green">
            <td colspan="4">
                <?php echo lang('amount_paid'); ?> :
            </td>
            <td>
                <?php
                echo get_option('currency_symbol');
                $totalPaid = $this->invoice->amount_paid($invoice->id);

                echo($totalPaid > 0 ? $totalPaid : "0.00"); ?>
            </td>
        </tr>
        <tr class="invoice-items" style="font-weight:bold;color:red">
            <td colspan="4">
                <?php echo lang('amount_due'); ?> :
            </td>
            <td>
                <?php

                $totalDue = (float)$subTotal - (float)$totalPaid;
                if ($totalDue > 0) {
                    echo get_option('currency_symbol') . $totalDue;
                } else {
                    echo '<span class="label label-success">' . lang('refund') . '</span> ' . get_option('currency_symbol') . $totalDue;
                }
                ?>
            </td>
        </tr>
        </tbody>
    </table>

    <h4><?php echo lang('invoice_terms'); ?></h4>
<?php echo $invoice->invoice_terms; ?>
<?php
// we can have any view part here like HTML, PHP etc
$content = ob_get_contents();
ob_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$fileName = 'invoice-' . $invoice->id . '_' . rand(111, 999) . '.pdf';
$path = '../../../../../../application/temp/' . $fileName;
$obj_pdf->Output(__DIR__ . $path, $action);

if ($send) {
//send to user
    $parents = $this->child->getParents($child->id);
    foreach ($parents->result() as $parent) {
        $data = array(
            'to' => $parent->email,
            'subject' => sprintf(lang('invoice_email_subject'), $child->last_name),
            'message' => sprintf(lang('invoice_email_message'), $child->last_name),
            'file' => $fileName
        );
        $this->mailer->send($data);
    }
    flash('success', lang('request_success'));
    redirectPrev();
}

?>