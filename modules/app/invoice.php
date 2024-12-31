<?php

require_once "InvoiceInterface.php";
require_once "connect.php";
require_once "../dompdf/autoload.inc.php";


use Dompdf\Dompdf;

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
                $this->item = [
                        'item_name' => null,
                        'item_quantity' => null,
                        'item_amount' => null,
                        'item_total' => null,
                ];

                $connect = new connect();
                $this->db = $connect->connect_db();
        }

        public function add_items()
        {
                $this->logo = $_FILES['invoice_logo']['name'];
                $this->company_name = $_POST['company_name'];
                $this->invoice_number = $_POST['invoice_number'];
                $this->invoice_from = $_POST['invoice_from'];
                $this->bill_to = $_POST['bill_to'];
                $this->ship_to = $_POST['ship_to'];
                $this->invoice_date = $_POST['invoice_date'];
                $this->due_date = $_POST['due_date'];
                $this->payment_terms = $_POST['payment_terms'];
                $this->po_number = $_POST['po_number'];
                $this->terms = $_POST['terms_info'];
                $this->notes = $_POST['notes_info'];
                $this->discount = $_POST['discount'];
                $this->tax_charge = $_POST['tax_charge'];
                $this->shipping_charge = $_POST['shipping_charge'];
                $this->paid_amount = $_POST['paid_amount'];
                $this->currency = $_POST['currency'];

                $item_names = $_POST['item_name'];
                $item_quantities = $_POST['item_quantity'];
                $item_amounts = $_POST['item_amount'];

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
                        $this->shipping_charge,
                        $this->discount
                );
                $this->remaining_amount = $this->calculate_remaining_amount(
                        $this->total_amount,
                        $this->paid_amount
                );


                // echo "logo = " . $this->logo . "<br>";
                // echo "company name = " . $this->company_name . "<br>";
                // echo "invoicen number = " . $this->invoice_number . "<br>";
                // echo "from = " . $this->invoice_from . "<br>";
                // echo "bill to = " . $this->bill_to . "<br>";
                // echo "ship to = " . $this->ship_to . "<br>";
                // echo "invoice date = " . $this->invoice_date . "<br>";
                // echo "due date = " . $this->due_date . "<br>";
                // echo "payment terms = " . $this->payment_terms . "<br>";
                // echo "po number = " . $this->po_number . "<br>";
                // echo "terms = " . $this->terms . "<br>";
                // echo "notes = " . $this->notes . "<br>";


                // echo "Subtotal = " . $this->subtotal . "<br>"; // total of all invoice items
                // echo "tax = " . $this->tax_charge . "<br>";
                // echo "shipping = " . $this->shipping_charge . "<br>";
                // echo "discount = " . $this->discount . "<br>";
                // echo "total amount = " . $this->total_amount . "<br>"; // subtotal + tax + shipping - discount
                // echo "paid = " . $this->paid_amount . "<br>";
                // echo "remaining amount = " . $this->remaining_amount . "<br>";  // total amount - advanced paid amount
                // echo "currency = " . $this->currency . "<br>";



                $this->insert_into_db();
        }


        public function item_total($qty, $amt)
        {
                return $qty * $amt;
        }

        public function insert_into_db()
        {

                if (isset($_FILES['invoice_logo']) && $_FILES['invoice_logo']['error'] === UPLOAD_ERR_OK) {
                        $target_dir = "company_logo/";

                        $file_name = time() . "_" . basename($_FILES['invoice_logo']['name']);

                        $target_file = $target_dir . $file_name;

                        if (!is_dir($target_dir)) {
                                mkdir($target_dir, 0755, true);
                        }

                        if (move_uploaded_file($_FILES['invoice_logo']['tmp_name'], $target_file)) {
                                // echo "<script>alert('Logo uploaded successfully');</script>";
                                // echo "Uploaded logo path: " . $target_file;
                        } else {
                                echo "<script>alert('Failed to upload logo');</script>";
                        }
                } else {
                        echo "<script>alert('No file uploaded or an error occurred');</script>";
                }

                if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];

                        $insert_invoice = "INSERT INTO `invoice` (`user_id`,`invoice_logo`, `company_name`, `invoice_number`, `invoice_from`, 
                                           `bill_to`, `ship_to`, `invoice_date`, `due_date`, `payment_terms`, 
                                           `po_number`, `notes`, `terms`, `subtotal`, `discount`, `tax_charge`, 
                                           `shipping_charge`, `total_amount`, `paid_amount`, `remainig_amount`, 
                                           `currency`)
                   VALUES (" . $user_id . ",
                           '" . $this->db->real_escape_string($this->logo) . "',
                           '" . $this->db->real_escape_string($this->company_name) . "',
                           " . $this->db->real_escape_string($this->invoice_number) . ",
                           '" . $this->db->real_escape_string($this->invoice_from) . "',
                           '" . $this->db->real_escape_string($this->bill_to) . "',
                           '" . $this->db->real_escape_string($this->ship_to) . "',
                           '" . $this->db->real_escape_string($this->invoice_date) . "',
                           '" . $this->db->real_escape_string($this->due_date) . "',
                           '" . $this->db->real_escape_string($this->payment_terms) . "',
                           " . $this->db->real_escape_string($this->po_number) . ",
                           '" . $this->db->real_escape_string($this->notes) . "',
                           '" . $this->db->real_escape_string($this->terms) . "',
                           " . $this->db->real_escape_string($this->subtotal) . ",
                           " . $this->db->real_escape_string($this->discount) . ",
                           " . $this->db->real_escape_string($this->tax_charge) . ",
                           " . $this->db->real_escape_string($this->shipping_charge) . ",
                           " . $this->db->real_escape_string($this->total_amount) . ",
                           " . $this->db->real_escape_string($this->paid_amount) . ",
                           " . $this->db->real_escape_string($this->remaining_amount) . ",
                           '" . $this->db->real_escape_string($this->currency) . "')";


                        $invoice_res = $this->db->query($insert_invoice);

                        if ($invoice_res) {
                                // echo "<script>alert('Invoice data inserted successfully!');</script>";
                        } else {
                                echo "<script>alert('Error inserting invoice data: " . $this->db->error . "');</script>";
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

                } else {
                        $user_id = 0;
                }

                ?>

                <script>
                        window.location.href = "temp.php?invoice_id=<?php echo $invoice_id; ?>";
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


        public function calculate_total_amount($subtotal, $tax, $shipping, $discount)
        {
                return $subtotal + $tax + $shipping - $discount;
        }


        public function calculate_remaining_amount($total, $paid)
        {
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

        public function download($html)
        {
                $code = $html;
                
                $dompdf = new Dompdf();

                $dompdf->loadHtml($code);

                $dompdf->setPaper('A4', 'portrait');


                $dompdf->render();
                $dompdf->stream();

                // return true;
        }



        public function history()
        {
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
}

?>