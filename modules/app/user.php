<?php

require_once "UserInterface.php";

require_once "connect.php";
if (session_status() === PHP_SESSION_NONE) {
        session_start();
}


class user implements UserInterface
{
        private $firstname;
        private $lastname;
        private $email;
        private $password;

        function signup($fname, $lname, $email, $pass)
        {
                $connect = new connect();
                $db = $connect->connect_db();

                $this->firstname = $fname;
                $this->lastname = $lname;
                $this->email = $email;
                $this->password = $pass;

                if ($this->firstname != "" && $this->lastname != "" && $this->email != "" && $this->password != "") {

                        $check_unique = "SELECT `email` FROM `users` WHERE `email` = '$this->email'";
                        $res = $db->query($check_unique);

                        // print_r($res);

                        if ($res->num_rows == 0) {
                                $this->add_user();
                        } else {
                                if (!$_SESSION['admin']) {
                                        echo "<script>alert('Email already in use! please enter a new one.');</script>";
                                        // header("Location: ../modules/auth/login.php");
                                        echo "<script>window.location.href='../auth/signup.php';</script>";
                                        exit;
                                } else {
                                        header("Location: ../admin/users.php");
                                        exit;
                                }
                        }
                }
        }

        public function add_user()
        {

                $connect = new connect();
                $db = $connect->connect_db();

                $hashed = password_hash($this->password, PASSWORD_BCRYPT);

                if ($db) {
                        // echo "connection successfull!";

                        $insert_user = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`) 
                                VALUES ('" . $this->firstname . "', '" . $this->lastname . "', '" . $this->email . "', '" . $hashed . "')";

                        $res = $db->query($insert_user);

                        if ($res) {
                                // echo "user added successfully";

                                echo "<script>window.location.href='../auth/login.php';</script>";
                                // header("Location: ../modules/auth/login.php");
                                // exit;
                        }
                } else {
                        echo "error in connection. please try again!";
                }
        }

        public function login($email, $pass)
        {
                $connect = new connect();
                $db = $connect->connect_db();

                // echo $email . "<br>" . $pass;

                $sql = "SELECT * FROM `users` WHERE `email` = '$email'"; // change table name
                $res = $db->query($sql);

                if ($res->num_rows > 0) {
                        $user = $res->fetch_assoc();
                        // print_r($user);

                        if (password_verify($pass, $user['password'])) {
                                // echo "Login successful!";

                                $_SESSION['email'] = $user['email'];
                                $_SESSION['user_id'] = $user['id'];
                                $fields = "invoice_number";

                                $user_id = $user['id'];

                                $sql = "INSERT INTO `visibility`(`user_id`, `field_visibility`) VALUES ($user_id, '$fields')";
                                $res = $db->query($sql);

                                // if ($row['status'] == "active") {

                                if ($res) {
                                        header('Location: ../invoice/create.php'); // path to home page.
                                        exit;
                                }

                                // } else {
                                
                                        // window.location.href == "login.php";

                                // }

                        } else {
                                echo "<script>alert('Invalid password! Try again');</script>";
                        }
                } else if ($email == "admin@invoice.com") { // admin email replacement
                        $_SESSION['admin'] = $email;
                        header("Location: ../../admin/index.php"); // path to admin dashboard                
                        exit;
                } else {
                        echo "<script>alert('No user found with this email.');</script>";
                }
        }

        public function update_profile($new_email = "", $new_pass = "", $user_id = 0)
        {
                $connect = new connect();
                $db = $connect->connect_db();

                if ($user_id == 0) {
                        $user_id = $_SESSION['user_id'];
                }

                $new_email = $db->real_escape_string($new_email);
                $new_pass = $new_pass ? password_hash($new_pass, PASSWORD_BCRYPT) : "";

                if (!empty($new_email)) {
                        $check_email_sql = "SELECT `email` FROM `users` WHERE `email` = '$new_email' AND `id` != $user_id";
                        $check_email_res = $db->query($check_email_sql);

                        if ($check_email_res->num_rows > 0) {
                                echo "<script>alert('Email already in use. Please use a different email');</script>";
                                return;
                        }
                }

                switch (true) {
                        case (!empty($new_email) && !empty($new_pass)):
                                $update_sql = "UPDATE `users` SET `email` = '$new_email', `password` = '$new_pass' WHERE `id` = $user_id";
                                break;
                        case (!empty($new_email)):
                                $update_sql = "UPDATE `users` SET `email` = '$new_email' WHERE `id` = $user_id";
                                break;
                        case (!empty($new_pass)):
                                $update_sql = "UPDATE `users` SET `password` = '$new_pass' WHERE `id` = $user_id";
                                break;
                        default:
                                echo "<script>alert('Nothing to update');</script>";
                                return;
                }

                if ($db->query($update_sql)) {
                        if (!empty($new_email)) {
                                $_SESSION['email'] = $new_email;
                        }
                        echo "<script>alert('Profile updated successfully');window.location.href='../invoice/account.php';</script>";
                } else {
                        echo "<script>alert('Error updating profile');</script>";
                }
        }

        public function update_name($firstname = "", $lastname = "", $user_id = 0)
        {
                $connect = new connect();
                $db = $connect->connect_db();

                if ($user_id == 0) {
                        $user_id = $_SESSION['user_id'];
                }

                $firstname = $db->real_escape_string($firstname);
                $lastname = $db->real_escape_string($lastname);

                $sql = "SELECT * FROM `users` WHERE `id` = $user_id";
                $res = $db->query($sql);

                if ($res && $res->num_rows > 0) {
                        $update_both = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname' WHERE `id` = $user_id";
                        if ($db->query($update_both)) {
                                echo "<script>alert('First and last name updated successfully');</script>";
                                if ($user_id == 0) {
                                        header("Location: ../modules/invoice/account.php");
                                        exit;
                                } else {
                                        // header("Location: users.php");
                                        echo "<script>window.location.href='users.php';</script>";
                                }
                                exit;

                        } else {
                                echo "<script>alert('Error updating first and last name');</script>";
                        }
                } else {
                        echo "<script>alert('User not found');</script>";
                }
        }

        public function fetch_all()
        {

                $connect = new connect();
                $db = $connect->connect_db();

                $sql = "SELECT * FROM `users`";
                $res = $db->query($sql);

                if ($res) {
                        return $res;
                } else {
                        return "Oops! No Users Found..";
                }
        }

        public function fetch_user_invoice($user_id)
        {

                $connect = new connect();
                $db = $connect->connect_db();

                $sql = "SELECT count(*) as invoice_count FROM `invoice` WHERE `user_id` = $user_id";
                $res = $db->query($sql);

                if ($res) {
                        $row = $res->fetch_assoc();

                        return $row['invoice_count'];
                } else {
                        return 0;
                }

        }

        // public function delete_acc($id)
        // {

        //         $conn = new connect();
        //         $db = $conn->connect_db();

        //         $sql = "DELETE FROM `USERS` WHERE `id` = $id";
        //         $res = $db->query($sql);

        //         if ($res) {
        //                 session_destroy();
        //                 session_unset();

        //                 header("Location: ../invoice/create.php");
        //                 exit;
        //         }

        // }


        public function fetch_one($user_id)
        {

                $connect = new connect();
                $db = $connect->connect_db();

                $sql = "SELECT * FROM `users` WHERE `id` = $user_id";
                $res = $db->query($sql);

                if (!empty($res)) {
                        $row = $res->fetch_assoc();
                        return $row;
                } else {
                        return "No UserData Available";
                }
        }

        public function change_pass($email, $pass)
        {
                $connect = new connect();
                $db = $connect->connect_db();

                // echo $email;
                // echo $pass;

                $hashed = password_hash($pass, PASSWORD_BCRYPT);

                // echo $hashed;
                $new = "";

                $sql = "UPDATE `users` SET `password` = '$hashed' WHERE `email` = '$email', 'reset_token' = '$new'";
                $res = $db->query($sql);
                if ($res) {
                        echo "<script>alert('Password changed successfully');</script>";
                        echo "<script>window.location.href='../auth/login.php';</script>";
                } else {
                        echo "<script>alert('Error changing password');</script>";
                }
        }
}

?>