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
                                echo "<script>alert('Email already in use! please enter a new one.');</script>";
                                header("Location: signup.php");
                                exit;
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
                                ?>

                                <?php

                                header("Location: login.php");
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

                $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
                $res = $db->query($sql);

                if ($res->num_rows > 0) {
                        $user = $res->fetch_assoc();
                        // print_r($user);

                        if (password_verify($pass, $user['password'])) {
                                // echo "Login successful!";

                                $_SESSION['email'] = $user['email'];
                                $_SESSION['user_id'] = $user['id'];

                                header('Location: ../invoice/create.php');
                                exit;

                        } else {
                                echo "<script>alert('Invalid password! Try again');</script>";
                        }
                } else {
                        echo "<script>alert('No user found with this email.');</script>";
                }
        }

        public function update_profile($new_email = "", $new_pass = "")
        {
                $connect = new connect();
                $db = $connect->connect_db();

                $user_id = $_SESSION['user_id'];

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

                if (!empty($new_email) && !empty($new_pass)) {
                        $update_sql = "UPDATE `users` SET `email` = '$new_email', `password` = '$new_pass' WHERE `id` = $user_id";
                } elseif (!empty($new_email)) {
                        $update_sql = "UPDATE `users` SET `email` = '$new_email' WHERE `id` = $user_id";
                } elseif (!empty($new_pass)) {
                        $update_sql = "UPDATE `users` SET `password` = '$new_pass' WHERE `id` = $user_id";
                } else {
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

        public function update_name($firstname = "", $lastname = "")
        {
                $connect = new connect();
                $db = $connect->connect_db();

                $user_id = $_SESSION['user_id'];

                $firstname = $db->real_escape_string($firstname);
                $lastname = $db->real_escape_string($lastname);

                $sql = "SELECT * FROM `users` WHERE `id` = $user_id";
                $res = $db->query($sql);

                if ($res && $res->num_rows > 0) {
                        $update_both = "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname' WHERE `id` = $user_id";
                        if ($db->query($update_both)) {
                                echo "<script>alert('First and last name updated successfully');</script>";
                                ?>
                                <script>
                                        window.location.href = "../invoice/account.php";
                                </script>
                                <?php
                        } else {
                                echo "<script>alert('Error updating first and last name');</script>";
                        }
                } else {
                        echo "<script>alert('User not found');</script>";
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
}

?>