<?php 
require_once "../app/connect.php";


$conn = new connect();
$db = $conn->connect_db();

$invoice_id = $_REQUEST['invoice_id'];

$sql = "DELETE FROM `invoice` WHERE `invoice_id` = $invoice_id";
$res = $db->query($sql);

if ($res) {
        $sql_data = "DELETE FROM `invoice_items` WHERE `invoice_id` = $invoice_id";
        $res_data = $db->query($sql_data);
        if ($res_data) {
                header("Location: ../invoice/invoices.php");
                exit;
        }
}

?>