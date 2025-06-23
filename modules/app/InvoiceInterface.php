<?php

interface InvoiceInterface{
        public function add_items();
        public function item_total($qty, $amt);
        public function insert_into_db();
        public function calculate_subtotal();
        public function calculate_total_amount($subtotal, $tax, $discount);
        public function calculate_remaining_amount($total, $paid);
        public function fetch_invoice($invoice_id);
}

?>