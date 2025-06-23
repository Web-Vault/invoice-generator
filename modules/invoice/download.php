<?php
require_once "../app/invoice.php";
// require_once "../dompdf/autoload.inc.php";

$invoice = new Invoice();
$invoice_id = $_REQUEST['invoice_id'];
$invoice_data = $invoice->fetch_invoice($invoice_id);

$uid = $invoice_data['user_id'];
$fetch_visibility = "SELECT * FROM `visibility` WHERE `user_id` = $uid";
$res = $db->query($fetch_visibility);

if ($res) {
    $row_visibility = $res->fetch_assoc();
    $fields = explode(",", $row_visibility['field_visibility']);
}

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #' . htmlspecialchars($invoice_data['invoice_number']) . '</title>
</head>
<body style="margin: 0; padding: 0; font-family: \'Helvetica Neue\', Arial, sans-serif; color: #334155; line-height: 1.4; font-size: 14px;">
    <div style="max-width: 800px; margin: 0 auto; background: #ffffff; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        
        <!-- Header Section -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr>';

if (!in_array("invoice_logo", $fields) && !empty($invoice_data['invoice_logo']) || 
    (in_array("invoice_logo", $fields) && !empty($invoice_data['invoice_logo']))) {
    $html .= '<td style="width: 50%; vertical-align: top; padding: 5px;">
                    <img src="company_logo/' . htmlspecialchars($invoice_data['invoice_logo']) . '" alt="Company Logo" style="height: 100px; display: block; margin: 0;">
              </td>';
}

$html .= '<td style="width: 50%; text-align: right; padding: 5px;">
            <h1 style="margin: 0; color: #1e40af; font-size: 24px; font-weight: 700;">' . htmlspecialchars($invoice_data['company_name']) . '</h1>
            <p style="margin: 3px 0 0; color: #64748b; font-size: 15px;">Invoice #' . htmlspecialchars($invoice_data['invoice_number']) . '</p>
            <p style="margin: 0; color: #64748b;">Date: ' . htmlspecialchars($invoice_data['invoice_date']) . '</p>
          </td>
        </tr>
        </table>';

$html .= '
        <!-- Billing Information -->
        <table style="width: 100%; margin-bottom: 20px; border-collapse: collapse;">
            <tr>
                <td style="width: 50%; padding-right: 15px; vertical-align: top;">
                    <h3 style="margin: 0 0 5px; color: #1e40af; font-size: 16px;">From</h3>
                    <p style="margin: 0; color: #475569;">' . nl2br(htmlspecialchars($invoice_data['invoice_from'])) . '</p>
                </td>
            </tr>
            <br />
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <h3 style="margin: 0 0 5px; color: #1e40af; font-size: 16px;">Bill To</h3>
                    <p style="margin: 0; color: #475569;">' . nl2br(htmlspecialchars($invoice_data['bill_to'])) . '</p>
                    <p style="margin: 0; color: #475569;">' . nl2br(htmlspecialchars($invoice_data['ship_to'])) . '</p>
                </td>
            </tr>
        </table>

        <!-- Items Table -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background: #f1f5f9;">
                    <th style="padding: 10px; text-align: left; font-size: 14px; border-bottom: 2px solid #e2e8f0; color: #1e40af;">Item</th>
                    <th style="padding: 10px; text-align: right; font-size: 14px; border-bottom: 2px solid #e2e8f0; color: #1e40af;">Qty</th>
                    <th style="padding: 10px; text-align: right; font-size: 14px; border-bottom: 2px solid #e2e8f0; color: #1e40af;">Rate</th>
                    <th style="padding: 10px; text-align: right; font-size: 14px; border-bottom: 2px solid #e2e8f0; color: #1e40af;">Amount</th>
                </tr>
            </thead>
            <tbody>';

foreach ($invoice_data['items'] as $item) {
    $html .= '<tr>
                <td style="padding: 10px; border-bottom: 1px solid #e2e8f0; color: #475569;">' . htmlspecialchars($item['item_name']) . '</td>
                <td style="padding: 10px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #475569;">' . htmlspecialchars($item['item_quantity']) . '</td>
                <td style="padding: 10px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #475569;">' . htmlspecialchars(number_format($item['item_amount'], 2)) . '</td>
                <td style="padding: 10px; border-bottom: 1px solid #e2e8f0; text-align: right; color: #475569;">' . htmlspecialchars(number_format($item['item_total'], 2)) . '</td>
              </tr>';
}

$html .= '</tbody>
        </table>

        <!-- Summary Section -->
        <div style="margin-left: auto; width: 300px; text-align: right; background: #f8fafc; padding: 15px; border-radius: 8px;">';

$html .= '<div style="display: flex; justify-content: space-between; padding: 5px 0;">
            <span style="color: #64748b;">Subtotal</span>
            <span style="color: #475569; font-weight: 500;">' . htmlspecialchars(number_format($invoice_data['subtotal'], 2)) . '</span>
          </div>';

if (!empty($invoice_data['discount']) || $invoice_data['discount'] != 0.00 || !in_array("discount", $fields)) {
    $html .= '<div style="display: flex; justify-content: space-between; padding: 5px 0;">
                <span style="color: #64748b;">Discount</span>
                <span style="color: #dc2626;">-' . htmlspecialchars(number_format($invoice_data['discount'], 2)) . '</span>
              </div>';
}

if (!empty($invoice_data['tax_charge']) || $invoice_data['tax_charge'] != 0.00 || !in_array("tax_charge", $fields)) {
    $html .= '<div style="display: flex; justify-content: space-between; padding: 5px 0;">
                <span style="color: #64748b;">Tax</span>
                <span style="color: #475569;">+' . htmlspecialchars(number_format($invoice_data['tax_charge'], 2)) . '%</span>
              </div>';
}

$html .= '<div style="display: flex; justify-content: space-between; padding: 10px 0; border-top: 2px solid #e2e8f0; margin-top: 5px;">
            <span style="color: #1e40af; font-weight: 600;">Total</span>
            <span style="color: #1e40af; font-weight: 600;">' . htmlspecialchars(number_format($invoice_data['total_amount'], 2)) . '</span>
          </div>';

if ((!in_array("paid_amount", $fields) && !empty($invoice_data['paid_amount'])) || 
    (in_array("paid_amount", $fields) && !empty($invoice_data['paid_amount']))) {
    $html .= '<div style="display: flex; justify-content: space-between; padding: 5px 0;">
                <span style="color: #64748b;">Amount Paid</span>
                <span style="color: #059669;"> -' . htmlspecialchars(number_format($invoice_data['paid_amount'], 2)) . '</span>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 5px 0; font-weight: bold;">
                <span style="color: #1e40af;">Balance Due</span>
                <span style="color: #dc2626;">' . htmlspecialchars(number_format($invoice_data['remainig_amount'], 2)) . '</span>
              </div>';
}

$html .= '</div>';

if ((!in_array("notes", $fields) && !empty($invoice_data['notes'])) || 
    (in_array("notes", $fields) && !empty($invoice_data['notes']))) {
    $html .= '<div style="margin-top: 20px; font-size: 13px; background: #f8fafc; padding: 15px; border-radius: 8px;">
                <h3 style="margin: 0 0 5px; font-size: 14px; color: #1e40af;">Notes</h3>
                <p style="margin: 0; color: #475569;">' . htmlspecialchars($invoice_data['notes']) . '</p>
              </div>';
}

if ((!in_array("terms", $fields) && !empty($invoice_data['terms'])) || 
    (in_array("terms", $fields) && !empty($invoice_data['terms']))) {
    $html .= '<div style="margin-top: 10px; font-size: 13px; background: #f8fafc; padding: 15px; border-radius: 8px;">
                <h3 style="margin: 0 0 5px; font-size: 14px; color: #1e40af;">Terms & Conditions</h3>
                <p style="margin: 0; color: #475569;">' . htmlspecialchars($invoice_data['terms']) . '</p>
              </div>';
}

$html .= '<div style="margin-top: 20px; text-align: center; font-size: 13px; color: #64748b;">
            <p style="margin: 0;">All amounts are in ' . htmlspecialchars($invoice_data['currency']) . '</p>
          </div>
    </div>
</body>
</html>';

$invoice->download($html);
