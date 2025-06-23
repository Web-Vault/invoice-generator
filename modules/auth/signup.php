<?php
require_once "../app/user.php";

if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['signupForm'])) {
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new user();
        $user->signup($firstname, $lastname, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account | Invoice Generator</title>

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
                        background-color: var(--background-color);
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
                        max-width: 500px;
                        width: 100%;
                        padding: 2.5rem;
                }

                .auth-header {
                        text-align: center;
                        margin-bottom: 2rem;
                }

                .auth-header img {
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
                        color: #dc3545;
                        font-size: 0.875rem;
                        margin-top: 0.25rem;
                }
                
                .warning-text {
                        color: #dc3545;
                        font-size: 0.785rem;
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
                                        <h1 class="h4 mb-2">Create your account</h1>
                                        <p class="text-muted">Get started with Invoice Generator</p>
                                </div>
                        </div>





                        <form name="signup" id="signup" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <?php
                                $fname_err = $lname_err = $email_err = $pass_err = $terms_err = "";
                                $fname = $lname = $email = $password = "";

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // Validate first name
                                    if (empty(trim($_POST["fname"]))) {
                                        $fname_err = "First name is required";
                                    } elseif (!preg_match("/^[a-zA-Z\s]*$/", trim($_POST["fname"]))) {
                                        $fname_err = "Please enter a valid first name";
                                    } else {
                                        $fname = trim($_POST["fname"]);
                                    }

                                    // Validate last name
                                    if (empty(trim($_POST["lname"]))) {
                                        $lname_err = "Last name is required";
                                    } elseif (!preg_match("/^[a-zA-Z\s]*$/", trim($_POST["lname"]))) {
                                        $lname_err = "Please enter a valid last name";
                                    } else {
                                        $lname = trim($_POST["lname"]);
                                    }

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
                                    } elseif (strlen(trim($_POST["password"])) < 6) {
                                        $pass_err = "Password must be at least 6 characters";
                                    } else {
                                        $password = trim($_POST["password"]);
                                    }

                                    // Validate terms
                                    if (!isset($_POST["terms"])) {
                                        $terms_err = "You must accept the Terms of Service";
                                    }

                                    // If no errors, process signup
                                    if (empty($fname_err) && empty($lname_err) && empty($email_err) && empty($pass_err) && empty($terms_err)) {
                                        require_once "../app/user.php";
                                        $user = new User();
                                        $user->signup($fname, $lname, $email, $password);
                                    }
                                }
                                ?>
                                <div class="row mb-3">
                                        <div class="col-md-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" name="fname" id="fname" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>"
                                                        placeholder="John" value="<?php echo $fname; ?>" maxlength="20">
                                                        <?php if(!empty($fname_err)): ?>        
                                                                <span class="error-text"><?php echo $fname_err ; ?></span>
                                                        <?php else: ?>
                                                                <span class="warning-text text-secondary"><?php echo "Max char. limit is 20." ; ?></span>
                                                        <?php endif?>
                                        </div>
                                        <div class="col-md-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" name="lname" id="lname" class="form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>"
                                                        placeholder="Doe" value="<?php echo $lname; ?>" maxlength="20">
                                                <?php if(!empty($lname_err)): ?>        
                                                                <span class="error-text"><?php echo $lname_err ; ?></span>
                                                        <?php else: ?>
                                                                <span class="warning-text text-secondary"><?php echo "Max char. limit is 20." ; ?></span>
                                                        <?php endif?>
                                        </div>
                                </div>

                                <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                                                placeholder="name@company.com" value="<?php echo $email; ?>">
                                        <span class="error-text"><?php echo $email_err; ?></span>
                                </div>

                                <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>"
                                                placeholder="••••••••" maxlength="50">
                                        <?php if(!empty($pass_err)): ?>        
                                                                <span class="error-text"><?php echo $pass_err ; ?></span>
                                                        <?php else: ?>
                                                                <span class="warning-text text-secondary"><?php echo "Max char. limit is 50." ; ?></span>
                                                        <?php endif?>
                                </div>

                                <div class="mb-4">
                                        <div class="form-check">
                                                <input type="checkbox" class="form-check-input <?php echo (!empty($terms_err)) ? 'is-invalid' : ''; ?>" id="terms" name="terms">
                                                <label class="form-check-label text-muted">
                                                        I agree to the <a href="#" class="text-primary">Terms of
                                                                Service</a> and <a href="#" class="text-primary">Privacy
                                                                Policy</a>
                                                </label>
                                                <div class="error-text"><?php echo $terms_err; ?></div>
                                        </div>
                                </div>

                                <button type="submit" name="signup" class="btn btn-primary w-100 mb-3">Create
                                        Account</button>

                                <!-- <button type="button" class="btn btn-google w-100 mb-4">
                                        <i class="fab fa-google me-2"></i>Sign up with Google
                                </button> -->

                                <p class="text-center text-muted mb-0">
                                        Already have an account?
                                        <a href="login.php" class="text-primary text-decoration-none">Sign in</a>
                                </p>
                        </form>

                        
                </div>
        </div>
</body>

</html>