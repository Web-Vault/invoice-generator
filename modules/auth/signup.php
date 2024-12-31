<?php

require_once "../app/user.php";

if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['signup'])) {
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
        <title>Sign Up - Invoice Generator</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
                integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
                crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
                integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://code.jquery.com/jquery-3.7.1.js"
                integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <style>
                body {
                        background-color: #f9f9f9 !important;
                }

                .main-body {
                        background-color: #fff !important;
                        border-radius: 0.71rem;
                        border: 1px solid #eee;
                        /* box-shadow: 0px 6px 8px 2px rgba(0, 0, 0, 0.1); */
                }

                .input>input {
                        border: 1px solid #ddd;
                        height: 40px;
                        border-radius: 5px;
                }

                .text {
                        font-size: 14.3px;
                }

                input[type="checkbox"]:checked {
                        background-color: #4CAF50 !important;

                }
        </style>
</head>

<body style="backgound-color: #d1d1d1;">
        <div class="container main d-flex flex-column justify-content-center align-items-center min-vh-100">
                <div class="head-logo w-100 text-center my-4">
                        <img src="../../assets/invoice_img.png" alt="logo" class="img" height="45">
                </div>

                <div class="main-body p-4 bg-white rounded-3 shadow-sm w-100" style="max-width: 500px;">
                        <p class="head-text fs-2 text-dark fw-semibold text-center">Sign Up</p>
                        <p class="head-sub-text fw-normal text-secondary text-center" style="font-size: 14.6px;">
                                Gain access to more features with an Invoice-Generator.com account.
                        </p>

                        <form action="" id="signup" method="post" class="form">
                                <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                                <label for="fname" class="form-label text-dark fw-normal">First
                                                        name</label>
                                                <input type="text" name="fname" id="fname" class="form-control">
                                                <span class="text-danger" style="font-size: 15px;"
                                                        id="fname_err"></span>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                                <label for="lname" class="form-label text-dark fw-normal">Last
                                                        name</label>
                                                <input type="text" name="lname" id="lname" class="form-control">
                                                <span class="text-danger" style="font-size: 15px;"
                                                        id="lname_err"></span>
                                        </div>
                                </div>

                                <div class="mb-3">
                                        <label for="email" class="form-label text-dark fw-normal">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                        <span class="text-danger" style="font-size: 15px;" id="email_err"></span>
                                </div>

                                <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                                <label for="password"
                                                        class="form-label text-dark fw-normal">Password</label>
                                                <a href="#" class="text-secondary text-decoration-none">Forgot
                                                        Password?</a>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control">
                                        <span class="text-danger" style="font-size: 15px;" id="pass_err"></span>
                                </div>

                                <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="keep" name="keep">
                                        <label for="keep" class="form-check-label text-secondary">
                                                I agree to the Terms of Service
                                        </label>
                                </div>

                                <button type="submit" name="signup" id="signup" class="btn btn-success w-100 py-2">Sign
                                        Up</button>

                                <p class="py-2 text-secondary text-center fs-6">
                                        Already have an account?
                                        <a href="login.php" class="text-success text-decoration-none">Sign In</a>
                                </p>
                        </form>
                </div>
        </div>

        <script>
                document.getElementById("signup").addEventListener("submit", function (e) {
                        e.preventDefault();

                        clearErrors();

                        let fname = document.getElementById("fname").value.trim();
                        let lname = document.getElementById("lname").value.trim();
                        let email = document.getElementById("email").value.trim();
                        let password = document.getElementById("password").value.trim();

                        let valid = true;

                        if (fname === "") {
                                document.getElementById("fname_err").textContent = "First name cannot be empty";
                                valid = false;
                        } else if (/[^a-zA-Z\s]/.test(fname)) {
                                document.getElementById("fname_err").textContent = "First name cannot contain numbers or special characters";
                                valid = false;
                        }

                        if (lname === "") {
                                document.getElementById("lname_err").textContent = "Last name cannot be empty";
                                valid = false;
                        } else if (/[^a-zA-Z\s]/.test(lname)) {
                                document.getElementById("lname_err").textContent = "Last name cannot contain numbers or special characters";
                                valid = false;
                        }

                        if (email === "") {
                                document.getElementById("email_err").textContent = "Email cannot be empty";
                                valid = false;
                        } else if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(email)) {
                                document.getElementById("email_err").textContent = "Invalid email format";
                                valid = false;
                        }

                        if (password === "") {
                                document.getElementById("pass_err").textContent = "Password cannot be empty";
                                valid = false;
                        } else if (password.length < 6) {
                                document.getElementById("pass_err").textContent = "Password must be at least 6 characters long";
                                valid = false;
                        }

                        if (valid) {

                                <?php
                                $fname = $_POST['fname'];
                                $lname = $_POST['lname'];
                                $email = $_POST['email'];
                                $pass = $_POST['password'];

                                $user = new user();
                                $user->signup($fname, $lname, $email, $pass);

                                ?>

                                document.getElementById("signup").submit();
                        }
                });

                function clearErrors() {
                        document.getElementById("fname_err").textContent = "";
                        document.getElementById("lname_err").textContent = "";
                        document.getElementById("email_err").textContent = "";
                        document.getElementById("pass_err").textContent = "";
                }

        </script>

</body>

</html>