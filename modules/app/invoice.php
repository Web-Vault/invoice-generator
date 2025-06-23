<?php

require_once "InvoiceInterface.php";
require_once "connect.php";
// require_once "../dompdf/autoload.inc.php";


// require_once __DIR__ . '/../vendor/autoload.php';
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";



class Invoice extends connect implements InvoiceInterface
{
        private $db;

        private $logo;
        private $company_name;
        private $invoice_number;
        private $invoice_from;
        private $bill_to;
        private $ship_to;
        private $invoice_date;
        private $due_date;
        private $payment_terms;
        private $po_number;
        private $notes;
        private $terms;
        private $subtotal;
        private $discount;
        private $tax_charge;
        private $shipping_charge;
        private $total_amount;
        private $paid_amount;
        private $remaining_amount;
        private $currency;
        private $items = [];

        public function __construct()
        {
                $this->items = [];

                $connect = new connect();
                $this->db = $connect->connect_db();
                // $this->delete_guest();
        }

        public function add_items()
        {
                $this->logo = $_FILES['invoice_logo']['name'] ?? "";
                $this->invoice_number = $_POST['invoice_number'] ?? "";
                $this->company_name = $_POST['company_name'] ?? "";
                $this->invoice_from = $_POST['from_address'] ?? "";
                $this->bill_to = $_POST['bill_to'] ?? "";
                $this->invoice_date = $_POST['date'] ?? "";
                $this->due_date = $_POST['due_date'] ?? "";
                $this->payment_terms = $_POST['payment_terms'] ?? "";
                $this->po_number = $_POST['po_number'] ?? 0;
                $this->terms = $_POST['terms'] ?? "";
                $this->notes = $_POST['notes'] ?? "";
                $this->discount = $_POST['discount'] ?? 0;
                $this->tax_charge = $_POST['tax'] ?? 0;
                $this->paid_amount = $_POST['amount_paid'] ?? 0;
                $this->currency = $_POST['currency'] ?? "";

                $item_names = $_POST['items'];
                $item_quantities = $_POST['quantities'];
                $item_amounts = $_POST['rates'];

                foreach ($item_names as $index => $item_name) {
                        $item_quantity = $item_quantities[$index];
                        $item_amount = $item_amounts[$index];
                        $item_total = $this->item_total($item_quantity, $item_amount);

                        $this->items[] = [
                                'item_name' => $item_name,
                                'item_quantity' => $item_quantity,
                                'item_amount' => $item_amount,
                                'item_total' => $item_total
                        ];
                }

                $this->subtotal = $this->calculate_subtotal();
                $this->total_amount = $this->calculate_total_amount(
                        $this->subtotal,
                        $this->tax_charge,
                        $this->discount
                );
                $this->remaining_amount = $this->calculate_remaining_amount(
                        $this->total_amount,
                        $this->paid_amount
                );




                $this->insert_into_db();
        }


        public function item_total($qty, $amt)
        {
                return $qty * $amt;
        }

        public function insert_into_db()
        {
                $file_name = "";
                if (isset($_FILES['invoice_logo'])) {
                        $target_dir = "company_logo/";

                        if (!empty($this->logo)) {
                                $file_name = time() . "_" . basename($_FILES['invoice_logo']['name']);
                        } else {
                                $file_name = "";
                        }

                        // $file_name = time() . "_" . basename($_FILES['invoice_logo']['name']);

                        $target_file = $target_dir . $file_name;

                        if (!is_dir($target_dir)) {
                                mkdir($target_dir, 0755, true);
                        }

                        if (move_uploaded_file($_FILES['invoice_logo']['tmp_name'], $target_file)) {
                                // echo "<script>alert('Logo uploaded successfully');</script>";
                                // echo "Uploaded logo path: " . $target_file;
                        } else {
                                // echo "<script>alert('Failed to upload logo');</script>";
                        }
                } else {
                        //     $_POST['invoice_logo'] = "default.png";

                }
                // if (isset($_FILES['invoice_logo']) && $_FILES['invoice_logo']['error'] === UPLOAD_ERR_OK) {
                // } else {
                // echo "<script>alert('No file uploaded or an error occurred');</script>";
                // }

                if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                } else {
                        $user_id = 0;
                }

                $insert_invoice = "INSERT INTO `invoice` (
                        `user_id`, `invoice_logo`, `company_name`, `invoice_number`, `invoice_from`, 
                        `bill_to`, `invoice_date`, `due_date`, `payment_terms`, 
                        `po_number`, `notes`, `terms`, `subtotal`, `discount`, `tax_charge`, 
                        `shipping_charge`, `total_amount`, `paid_amount`, `remainig_amount`, `currency`
                    ) VALUES (
                        " . intval($user_id) . ",
                        '" . $this->db->real_escape_string($file_name) . "', 
                        '" . $this->db->real_escape_string($this->company_name) . "',
                        " . intval($this->invoice_number) . ",
                        '" . $this->db->real_escape_string($this->invoice_from) . "',
                        '" . $this->db->real_escape_string($this->bill_to) . "',
                        '" . $this->db->real_escape_string($this->invoice_date) . "',
                        '" . $this->db->real_escape_string($this->due_date) . "',
                        '" . $this->db->real_escape_string($this->payment_terms) . "',
                        " . intval($this->po_number) . ",
                        '" . $this->db->real_escape_string($this->notes) . "',
                        '" . $this->db->real_escape_string($this->terms) . "',
                        " . floatval($this->subtotal) . ",
                        " . floatval($this->discount) . ",
                        " . floatval($this->tax_charge) . ",
                        " . floatval($this->shipping_charge) . ",
                        " . floatval($this->total_amount) . ",
                        " . floatval($this->paid_amount) . ",
                        " . floatval($this->remaining_amount) . ",
                        '" . $this->db->real_escape_string($this->currency) . "'
                    )";

                $invoice_res = $this->db->query($insert_invoice);

                if ($invoice_res) {
                        // Uncomment this if you want to confirm insertion.
                        // echo "<script>alert('Invoice data inserted successfully!');</script>";
                } else {
                        // Log or display error for debugging.
                        echo "<script>alert('Error inserting invoice data: " . $this->db->error . "');</script>";
                        error_log("Insert Error: " . $this->db->error);
                        error_log("Generated Query: " . $insert_invoice);
                }


                if ($invoice_res) {
                        // echo "<script>alert('Invoice data inserted successfully');</script>";

                } else {
                        echo "<script>alert('Invoice data not inserted');</script>";
                }

                $invoice_id = $this->db->insert_id;

                foreach ($this->items as $item) {
                        $insert_invoice_items = "INSERT INTO `invoice_items` (`invoice_id`, `item_name`, `item_quantity`, 
                                                               `item_amount`, `item_total`)
                                 VALUES ($invoice_id, '{$item['item_name']}', {$item['item_quantity']}, 
                                         {$item['item_amount']}, {$item['item_total']})";

                        $invoice_item_res = $this->db->query($insert_invoice_items);

                        if ($invoice_item_res) {
                                // echo "<script>alert('Invoice item data inserted successfully');</script>";
                        } else {
                                echo "<script>alert('Invoice item data not inserted');</script>";
                        }
                }

                ?>

                <script>
                        window.location.href = "thanks.php?invoice_id=<?php echo $invoice_id; ?>";
                        // window.location.href = "temp.php?invoice_id=<?php echo $invoice_id; ?>";
                </script>

                <?php
        }



        public function calculate_subtotal()
        {
                $subtotal = 0.0;
                foreach ($this->items as $item) {
                        if (isset($item['item_total'])) {
                                $subtotal += $item['item_total'];
                        }
                }
                return $subtotal;
        }


        public function calculate_total_amount($subtotal, $tax, $discount)
        {
                $tax = empty($tax) ? 0.0 : (float) $tax;
                $discount = empty($discount) ? 0.0 : (float) $discount;

                // Calculate tax amount based on percentage
                $tax_amount = ($subtotal - $discount) * ($tax / 100);

                return $subtotal + $tax_amount - $discount;
        }


        public function calculate_remaining_amount($total, $paid)
        {
                $paid = empty($paid) ? 0 : (int) $paid;
                return $total - $paid;
        }



        // 


        public function fetch_invoice($invoice_id)
        {
                $invoice_data = [];

                $invoice_query = "SELECT * FROM `invoice` WHERE `invoice_id` = $invoice_id";
                $invoice_result = $this->db->query($invoice_query);

                if ($invoice_result->num_rows > 0) {
                        $invoice_data = $invoice_result->fetch_assoc();
                } else {
                        echo "<script>alert('Invoice not found');</script>";
                        return [];
                }

                $items_query = "SELECT * FROM `invoice_items` WHERE `invoice_id` = $invoice_id";
                $items_result = $this->db->query($items_query);

                $items = [];
                if ($items_result->num_rows > 0) {
                        while ($item = $items_result->fetch_assoc()) {
                                $items[] = $item;
                        }
                }

                $invoice_data['items'] = $items;

                // echo "<pre>";
                // print_r($invoice_data);
                // echo "</pre>";

                return $invoice_data;
        }

        // public function download($html)
        // {
        //         $code = $html;

        //         $dompdf = new Dompdf();

        //         $dompdf->loadHtml($code);

        //         $dompdf->setPaper('A4', 'portrait');


        //         $dompdf->render();
        //         $dompdf->stream();
        // }


        public function download($html)
        {

                $mpdf = new \Mpdf\Mpdf();
                $mpdf->WriteHTML($html);
                $mpdf->Output();
        }


        public function history()
        {
                if (!isset($_SESSION['user_id'])) {
                        echo "<script>alert('Please, Login first to view your invoice history..');</script>";
                        // echo "<script>window.location.href = '../auth/login.php';</script>";
                        // exit;
                }

                $user_id = $_SESSION['user_id'];
                $history = "SELECT * FROM `invoice` WHERE `user_id` = $user_id";
                $result = $this->db->query($history);

                if ($result->num_rows > 0) {
                        $rows = [];
                        while ($row = $result->fetch_assoc()) {
                                $rows[] = $row;
                        }
                        return $rows;
                } else {
                        return "No Data Found!";
                }
        }

        public function all_invoices($page = 1, $limit = 10)
        {
                $offset = ($page - 1) * $limit;

                $sql = "SELECT * FROM `invoice` LIMIT $offset, $limit";
                $res = $this->db->query($sql);

                if ($res) {
                        $rows = [];
                        while ($row = $res->fetch_assoc()) {
                                $rows[] = $row;
                        }
                        return $rows;
                } else {
                        return [];
                }
        }

        public function total_invoices()
        {
                $sql = "SELECT COUNT(*) AS total FROM `invoice`";
                $res = $this->db->query($sql);

                if ($res) {
                        $row = $res->fetch_assoc();
                        return $row['total'];
                } else {
                        return 0;
                }
        }

        public function invoice_visibility($user_id, $field_string)
        {

                // echo "user: ". $user_id . "<br>";
                // echo "string: ". $field_string   . "<br>";

                if (!isset($_SESSION['email'])) {
                        echo "<script>alert('Please, Login first to alter your invoice..');</script>";
                        echo "<script>window.location.href = '../auth/login.php';</script>";
                        exit;
                }


                $checkSql = "SELECT * FROM `visibility` WHERE `user_id` = $user_id";
                $checkRes = $this->db->query($checkSql);

                if ($checkRes->num_rows > 0) {

                        $updateSql = "UPDATE `visibility` SET `field_visibility` = '$field_string' WHERE `user_id` = $user_id";
                        $updateRes = $this->db->query($updateSql);

                        if ($updateRes) {
                                echo "<script>alert('Fields updated successfully!');</script>";
                                header('Location: ../invoice/create.php');
                                // $this->demo();
                                exit;
                        } else {
                                echo "Error updating fields.";
                        }
                } else {

                        $insertSql = "INSERT INTO `visibility`(`user_id`, `field_visibility`) VALUES ($user_id, '$field_string')";
                        $insertRes = $this->db->query($insertSql);

                        if ($insertRes) {
                                echo "<script>alert('Columns stored successfully!');</script>";
                                header('Location: ../invoice/create.php');
                                exit;
                        } else {
                                echo "Error inserting fields.";
                        }
                }
        }

        public function delete_guest()
        {
                $sql = "DELETE FROM `invoice` WHERE `user_id` = 0";
                $res = $this->db->query($sql);

                if ($res) {
                        // echo "Guest data deleted successfully!";
                } else {
                        // echo "Error deleting guest data.";
                }
        }
}


?>