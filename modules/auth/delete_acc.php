<?php 
require_once "../app/connect.php";

session_start();

$em = $_SESSION['email'];
$id = $_SESSION['user_id'];

$conn = new connect();
$db = $conn->connect_db();

$sql = "DELETE FROM `USERS` WHERE `email` = '$em'";
$res = $db->query($sql);

if ($res) {
        session_destroy();
        session_unset();

        header("Location: ../invoice/create.php");
        exit;
}

?>