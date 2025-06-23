<?php
require_once "../app/connect.php";

session_start();

if (isset($_REQUEST['user_id'])) {
        $id = $_REQUEST['user_id'];
} else {
        // $em = $_SESSION['email'];
        $id = $_SESSION['user_id'];
}
$conn = new connect();
$db = $conn->connect_db();

$sql = "DELETE FROM `USERS` WHERE `id` = $id";
$res = $db->query($sql);

if ($res) {
        session_destroy();
        session_unset();

//         $delete_invoice = "DELETE FROM `invoice` WHERE `user_id` = $id";

        // $delete_invoice = "DELETE FROM `invoice_item` WHERE `user_id` = $id";

        if(isset($_REQUEST['user_id'])) {

                header("Location: ../../admin/users.php");
        } else {
                header("Location: ../invoice/create.php");
         }
        exit;
}

?>