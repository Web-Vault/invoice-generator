<?php
require_once "../modules/app/connect.php";

$conn = new connect();

$invoice_id = $_REQUEST['invoice_id'];

$sql = "DELETE FROM `invoice` WHERE `invoice_id` = $invoice_id";
$db = $conn->connect_db();
$res = $db->query($sql);

if ($res) {
        echo "<script>alert('invoice deleted!');</script>";
        echo "<script>window.location.href = 'invoice.php';</script>";
}
