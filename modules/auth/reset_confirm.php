<?php

require_once "../app/user.php";
require_once "../app/connect.php";

// Get token from URL
$token = isset($_GET['token']) ? trim($_GET['token']) : '';
$email = isset($_GET['email']) ? trim($_GET['email']) : '';

if (empty($token) || empty($email)) {
        echo "Invalid reset link";
        exit();
}

$conn = new connect();
$db = $conn->connect_db();

$SQL = "SELECT * FROM users WHERE email = ? AND reset_token = ?";
$stmt = $db->prepare($SQL);
$stmt->bind_param("ss", $email, $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
        echo "Token is valid";
        echo "<a href='change_pass.php?email=$email&token=$token'>Change Password</a>";
} else {
        echo "Token is invalid";
}

?>