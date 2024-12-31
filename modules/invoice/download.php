<?php
require_once "../app/invoice.php";
require_once "../dompdf/autoload.inc.php";

$invoice = new Invoice();

$invoice_id = $_REQUEST['invoice_id'];
$invoice_data = $invoice->fetch_invoice($invoice_id);



// 
require_once "../app/invoice.php";
require_once "../dompdf/autoload.inc.php";


$html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body style="background-color: #f8f9fa; font-family: Arial, sans-serif; line-height: 1.3; margin: 0; padding: 0; box-sizing: border-box;">
    <div style="width: 100%; max-width: 1200px; padding: 10px 20px; background-color: #fff; border-radius: 10px;">
        <div style="display: table; width: 100%; margin-bottom: 20px;">
                <div style="display: table-cell; width: 50%; vertical-align: middle;">
                        <img src="data:image/png;base64company_logo/' . htmlspecialchars($invoice_data['invoice_logo']) . '" style="max-height: 100px;" />
                </div>
                <div style="display: table-cell; width: 50%; text-align: right; vertical-align: middle;">
                        <h1 style="font-size: 32px; color: #333; margin-top: 7px;">' . htmlspecialchars($invoice_data['company_name']) . '</h1>
                        <p style="font-size: 16px; color: #777; margin-top: 7px;">#' . htmlspecialchars($invoice_data['invoice_number']) . '</p>
                </div>
        </div>

        <div style="display: table; width: 100%; margin-top: 30px;">
                <div style="display: table-cell; width: 50%; vertical-align: middle;">
                        <div style="font-weight: bold; color: #333;">From</div>
                        <div style="font-size: 14px; color: #555;">' . htmlspecialchars($invoice_data['invoice_from']) . '</div>
                </div>
                <div style="display: table-cell; width: 50%; vertical-align: middle; text-align: right;">
                        <div style="font-weight: bold; color: #333;">To</div>
                        <div style="font-size: 14px; color: #555;">' . htmlspecialchars($invoice_data['bill_to']) . '</div>
                </div>
        </div>

        <div style="display: table; width: 100%; margin-top: 30px;">
                <div style="display: table-cell; width: 50%; vertical-align: middle;">
                        <div style="font-weight: bold; color: #333;">Ship To</div>
                        <div style="font-size: 14px; color: #555;">' . htmlspecialchars($invoice_data['ship_to']) . '</div>
                </div>
                <div style="display: table-cell; width: 50%; vertical-align: middle;  text-align: right;">
                        <div style="font-weight: bold; color: #333;">Date</div>
                        <div style="font-size: 14px; color: #555;">' . htmlspecialchars($invoice_data['invoice_date']) . '</div>
                </div>
        </div>

        <div style="margin-top: 20px;">
                <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
                        <thead>
                                <tr>
                                        <th style="padding: 12px; text-align: left; background-color: #f9f9f9;">Item</th>
                                        <th style="padding: 12px; text-align: left; background-color: #f9f9f9; text-align: end;">Quantity</th>
                                        <th style="padding: 12px; text-align: left; background-color: #f9f9f9; text-align: end;">Rate</th>
                                        <th style="padding: 12px; text-align: left; background-color: #f9f9f9; text-align: end;">Amount</th>
                                </tr>
                        </thead>
                        <tbody>';

foreach ($invoice_data['items'] as $item) {
        $html .= '
                        <tr>
                                <td style="font-size: 14px; color: #555; padding: 12px;">' . htmlspecialchars($item['item_name']) . '</td>
                                <td style="font-size: 14px; color: #555; padding: 12px; text-align: end;">' . htmlspecialchars($item['item_quantity']) . '</td>
                                <td style="font-size: 14px; color: #555; padding: 12px; text-align: end;">$' . htmlspecialchars(number_format($item['item_amount'], 2)) . '</td>
                                <td style="font-size: 14px; color: #555; padding: 12px; text-align: end;">$' . htmlspecialchars(number_format($item['item_total'], 2)) . '</td>
                        </tr>';
}

$html .= '
                        </tbody>
                </table>

                <div style="text-align: right; padding: 20px;">
                        <div style="padding: 8px 0;  display: block; width: 100%;">
                                <span style="font-weight: bold; color: #333; width: 40%; display: inline-block;">Subtotal</span>
                                <span style="color: #333; width: 40%; display: inline-block; text-align: right;">$' . htmlspecialchars(number_format($invoice_data['subtotal'], 2)) . '</span>
                        </div>
                        <div style="padding: 8px 0;  display: block; width: 100%;">
                                <span style="font-weight: bold; color: #333; width: 40%; display: inline-block;">Discount</span>
                                <span style="color: #333; width: 40%; display: inline-block; text-align: right;">$' . htmlspecialchars(number_format($invoice_data['discount'], 2)) . '</span>
                        </div>
                        <div style="padding: 8px 0;  display: block; width: 100%;">
                                <span style="font-weight: bold; color: #333; width: 40%; display: inline-block;">Tax</span>
                                <span style="color: #333; width: 40%; display: inline-block; text-align: right;">$' . htmlspecialchars(number_format($invoice_data['tax_charge'], 2)) . '</span>
                        </div>
                        <div style="padding: 8px 0;  display: block; width: 100%;">
                                <span style="font-weight: bold; color: #333; width: 40%; display: inline-block;">Shipping</span>
                                <span style="color: #333; width: 40%; display: inline-block; text-align: right;">$' . htmlspecialchars(number_format($invoice_data['shipping_charge'], 2)) . '</span>
                        </div>
                        <div style="padding: 8px 0;  display: block; width: 100%;">
                                <span style="font-weight: bold; color: #333; width: 40%; display: inline-block; font-weight: bold;">Total</span>
                                <span style="color: #333; width: 40%; display: inline-block; text-align: right; font-weight: bold;">$' . htmlspecialchars(number_format($invoice_data['total_amount'], 2)) . '</span>
                        </div>
                        <div style="padding: 8px 0;  display: block; width: 100%;">
                                <span style="font-weight: bold; color: #333; width: 40%; display: inline-block;">Amount Paid</span>
                                <span style="color: #333; width: 40%; display: inline-block; text-align: right;">$' . htmlspecialchars(number_format($invoice_data['paid_amount'], 2)) . '</span>
                        </div>
                        <div style="padding: 8px 0;  display: block; width: 100%;">
                                <span style="font-weight: bold; color: #333; width: 40%; display: inline-block; font-weight: bold;">Balance Due</span>
                                <span style="color: #333; width: 40%; display: inline-block; text-align: right; font-weight: bold;">$' . htmlspecialchars(number_format($invoice_data['remainig_amount'], 2)) . '</span>
                        </div>
                </div>
        </div>

        <div style="margin-top: 20px;">
                <div style="font-weight: bold; color: #333;">Notes</div>
                <div style="font-size: 14px; color: #555;">' . htmlspecialchars($invoice_data['notes']) . '</div>
        </div>

        <div style="margin-top: 20px;">
                <div style="font-weight: bold; color: #333;">Terms</div>
                <div style="font-size: 14px; color: #555;">' . htmlspecialchars($invoice_data['terms']) . '</div>
        </div>
    </div>
</body>

</html>';

// echo $html;

$invoice->download($html);
