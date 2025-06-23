<?php
require_once "../app/user.php";

if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new user();
        $user->login($email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign In | Invoice Generator</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

        <!-- Custom CSS -->
        <style>
                :root {
                        --primary-color: #1a56db;
                        --background-color: #f9fafb;
                        --border-color: #e5e7eb;
                        --hover-color: #1e40af;
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
                        max-width: 450px;
                        width: 100%;
                        padding: 2.5rem;
                }

                .auth-header {
                        text-align: center;
                        margin-bottom: 2rem;
                }

                .auth-header img {
                        /* height: 50px; */
                        width: 100%;
                        margin-bottom: 1.5rem;
                }

                .form-control {
                        border: 1px solid var(--border-color);
                        padding: 0.75rem 1rem;
                        border-radius: 0.5rem;
                        font-size: 0.95rem;
                }

                .form-control:focus {
                        border-color: var(--primary-color);
                        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
                }

                .btn-primary {
                        background-color: var(--primary-color);
                        border: none;
                        padding: 0.75rem;
                        font-weight: 500;
                }

                .btn-primary:hover {
                        background-color: var(--hover-color);
                }

                .btn-google {
                        border: 1px solid var(--border-color);
                        padding: 0.75rem;
                        font-weight: 500;
                }

                .error-text {
                        color: #DC2626;
                        font-size: 0.875rem;
                        margin-top: 0.25rem;
                }
        </style>
</head>

<body>
        <div class="container auth-container d-flex align-items-center justify-content-center">
                <div class="auth-card">
                        <div class="auth-header d-flex align-items-center justify-content-center gap-3">

                                <img src="../../assets/173745502034560481.png" alt="Invoice Generator" class="img-fluid"
                                        style="height: 70px; width: auto;">

                                <div>
                                        <h1 class="h4 mb-2">Welcome Back</h1>
                                        <p class="text-muted">Sign in to your account</p>
                                </div>
                        </div>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="login" name="loginForm" method="post">
                                <?php
                                $email_err = $pass_err = "";
                                $email = $password = "";

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // Validate email
                                    if (empty(trim($_POST["email"]))) {
                                        $email_err = "Email is required";
                                    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
                                        $email_err = "Please enter a valid email address";
                                    } else {
                                        $email = trim($_POST["email"]);
                                    }

                                    // Validate password
                                    if (empty(trim($_POST["password"]))) {
                                        $pass_err = "Password is required";
                                    } else {
                                        $password = trim($_POST["password"]);
                                    }

                                    // If no errors, process login
                                    if (empty($email_err) && empty($pass_err)) {
                                        require_once "../app/user.php";
                                        $user = new User();
                                        $user->login($email, $password);
                                    }
                                }
                                ?>
                                <div class="mb-4">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                                                placeholder="name@company.com" value="<?php echo $email; ?>">
                                        <span class="error-text"><?php echo $email_err; ?></span>
                                </div>

                                <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                <label class="form-label mb-0">Password</label>
                                                <a href="f_pass.php" class="text-primary text-decoration-none small">Forgot
                                                        Password?</a>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>"
                                                placeholder="••••••••">
                                        <span class="error-text"><?php echo $pass_err; ?></span>
                                </div>

                                <div class="mb-4">
                                        <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="keep" name="keep">
                                                <label class="form-check-label text-muted" for="keep">Keep me signed
                                                        in</label>
                                        </div>
                                </div>

                                <button type="submit" name="login" class="btn btn-primary w-100 mb-3">Sign In</button>

                                <!-- <button type="button" class="btn btn-google w-100 mb-4">
                                        <i class="fab fa-google me-2"></i>Sign in with Google
                                </button> -->

                                <p class="text-center text-muted mb-0">
                                        Don't have an account?
                                        <a href="signup.php" class="text-primary text-decoration-none">Create
                                                account</a>
                                </p>
                        </form>

                </div>
        </div>



        <!-- Bootstrap Bundle JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>