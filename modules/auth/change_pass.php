<?php

require_once "../app/user.php";

$user = new User();

$email = isset($_GET['email']) ? trim($_GET['email']) : '';
$token = isset($_GET['token']) ? trim($_GET['token']) : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Password</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
                :root {
                        --primary-color: #2563eb;
                        --text-color: #374151;
                }

                body {
                        background-color: #f3f4f6;
                        font-family: 'Inter', sans-serif;
                }

                .auth-container {
                        min-height: 100vh;
                        padding: 2rem 1rem;
                }

                .auth-card {
                        background: white;
                        border-radius: 1rem;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                        padding: 2rem;
                        max-width: 450px;
                        width: 100%;
                }

                .auth-header {
                        text-align: center;
                        margin-bottom: 2rem;
                }

                .form-label {
                        font-weight: 500;
                        color: var(--text-color);
                }

                .btn-primary {
                        background-color: var(--primary-color);
                        border: none;
                        padding: 0.75rem;
                        font-weight: 500;
                }

                .btn-primary:hover {
                        background-color: #1e40af;
                }
        </style>
</head>

<body>
        <div class="container auth-container d-flex align-items-center justify-content-center">
                <div class="auth-card">
                        <div class="auth-header">
                                <img src="../../assets/173745502034560481.png" alt="Invoice Generator"
                                        class="img-fluid mb-4" style="height: 70px; width: auto;">
                                <h1 class="h4 mb-2">Change Your Password</h1>
                                <p class="text-muted">Enter your new password below</p>
                        </div>

                        <form action="" name="change_pass" method="POST">
                                <div class="mb-4">
                                        <label for="password" class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                                required>
                                </div>

                                <div class="mb-4">
                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                        <input type="password" name="confirm_password" class="form-control"
                                                id="confirm_password" required>
                                </div>
                                <span class="pass_e text-danger" style="font-size: 12px"></span>
                                <button type="submit" class="btn btn-primary w-100 mb-3" name="change_pass">Change
                                        Password</button>
                        </form>
                </div>
        </div>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_pass'])) {
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $error = ""; 
        
        if (empty($password) || empty($confirm_password)) {
                $error = "All fields are required.";
        }
        
        elseif ($password !== $confirm_password) {
                $error = "Passwords do not match.";
        }
        
        elseif (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
                $error = "Password must be at least 8 characters long, with at least 1 uppercase letter, 1 number, and 1 special character.";
        }

        if ($error) {
                echo "<script>document.querySelector('.pass_e').innerText = '$error';</script>";
                exit();
        }

        try {
                $user->change_pass($email, $password);
                // echo "<script>alert('Password changed successfully!'); window.location.href='login.php';</script>";
        } catch (Exception $e) {
                echo "<script>alert('Error changing password. Please try again.');</script>";
        }
}
?>