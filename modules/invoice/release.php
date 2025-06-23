<?php
session_start();
require_once "../app/invoice.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['field'])) {
        // Get the keys of the array
        $keys = array_keys($_POST['field']);

        // Remove single quotes from each key
        $keys_trimmed = array_map(function ($key) {
                return str_replace("'", "", $key); // Remove single quotes
        }, $keys);

        // Implode the keys into a single string
        $fields_string = implode(',', $keys_trimmed);

        $field_string = htmlspecialchars($fields_string);

        // Output the final result
        // echo "fields_string: " . $field_string . "<br>";

        // print_r($_SESSION);

        $user_id = $_SESSION['user_id'];

        $invoice = new invoice();
        $invoice->invoice_visibility($user_id,$field_string);

} else {
        echo "No fields submitted.";
}
?>