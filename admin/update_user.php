<?php

require_once "../modules/app/connect.php";
require_once "../modules/app/user.php";

print_r($_POST);

$user = new user();
$user->update_name($_POST['first_name'], $_POST['last_name'], $_POST['user_id']);
$user->update_profile($_POST['email'], $_POST['password'], $_POST['user_id']);


?>