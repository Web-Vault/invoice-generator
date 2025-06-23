<?php

interface UserInterface
{
        function signup($fname, $lname, $email, $pass);
        public function add_user();
        public function login($email, $pass);
        public function update_profile($new_email = "", $new_pass = "");
        public function update_name($firstname = "", $lastname = "");
        public function fetch_all();
}

?>