<?php

require_once "../app/connect.php";

$conn = new connect();
$db = $conn->connect_db();

require_once "phpmailer/PHPMailer.php";
require_once "phpmailer/SMTP.php";
require_once "phpmailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email = trim($_POST['email']);

// Validate email
if (empty($email)) {
        header("Location: f_pass.php?error=Email is required");
        exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: f_pass.php?error=Invalid email format");
        exit();
}

// Generate reset token
$token = bin2hex(random_bytes(32));

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $db->query($sql);

if ($result->num_rows > 0) {

        $sql = "UPDATE users SET reset_token = '$token' WHERE email = '$email'";
        $result = $db->query($sql);

        if ($result) {
                // Create new PHPMailer instance
                $mail = new PHPMailer(true);

                try {
                        // Server settings
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'aryanlathigara@gmail.com'; 
                        $mail->Password = 'hite utam afae jbka'; 
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        // Recipients
                        $mail->setFrom('aryanlathigara@gmail.com', 'Invoice Generator');
                        $mail->addAddress($email);

                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Password Reset Request';
                        $resetLink = "https://6e72-2401-4900-1f3f-b0ed-79da-d9c1-9d7d-9a0e.ngrok-free.app/invoice-generator/modules/auth/reset_confirm.php?email=" . $email . "&token=" . $token;

                        $mail->Body = "
                    <h2>Password Reset Request</h2>
                    <p>You have requested to reset your password. Click the link below to proceed:</p>
                    <p><a href='{$resetLink}'>Reset Password</a></p>
                    <p>If you didn't request this, please ignore this email.</p>
                ";

                        if($mail->send()){
                                echo "Email sent successfully";
                                sleep(3);
                                echo "check your email for the password reset link.";
                                exit();
                        }else{
                                echo "Email not sent";
                                sleep(3);
                                echo "<script>alert('Email not sent');</script>";
                                exit();
                        }


                } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        exit(); 
                }
        } else {
                echo "Token not updated";
        }
} else {
        echo "Email not found";
        sleep(3);
        header("Location: f_pass.php");
        exit();
}


?>