<?php

require_once "../modules/app/connect.php";
require_once "../modules/app/user.php";

print_r($_POST);

$user = new user();
$user->signup($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);

?>