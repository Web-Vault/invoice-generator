<?php
require_once "../app/user.php";


?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password | Invoice Generator</title>
        <style>
                :root {
                        --primary-color: #1a56db;
                        --background-color: #f9fafb;
                        --border-color: #e5e7eb;
                        --text-color: #111827;
                }

                body {
                        background-color: #F3F4F6;
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
                                <img src="../../assets/173745502034560481.png" alt="Invoice Generator" class="img-fluid mb-4" 
                                        style="height: 70px; width: auto;">
                                <h1 class="h4 mb-2">Reset Your Password</h1>
                                <p class="text-muted">Enter your email to receive reset instructions</p>
                        </div>

                        <form action="reset_password.php" method="POST">
                                <div class="mb-4">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                                placeholder="name@company.com" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mb-3">Send Reset Link</button>

                                <p class="text-center text-muted mb-0">
                                        Remember your password? 
                                        <a href="login.php" class="text-primary text-decoration-none">Sign in</a>
                                </p>
                        </form>
                </div>
        </div>
</body>
</html>