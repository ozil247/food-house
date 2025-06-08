<?php
session_start();
include "config/constants.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {

    // Extract and trim inputs
    $food             = trim($_POST['food']);
    $price            = (float) $_POST['price'];
    $qty              = (int) $_POST['qty'];
    $customer_name    = trim($_POST['full_name']);
    $customer_contact = trim($_POST['contact']);
    $customer_email   = trim($_POST['email']);
    $customer_address = trim($_POST['address']);

    // Validate required fields
    if (
        empty($food) || $price <= 0 || $qty <= 0 ||
        empty($customer_name) || empty($customer_contact) ||
        empty($customer_email) || empty($customer_address)
    ) {
        $_SESSION['message'] = "<div class='error text-center'>All fields are required and must be valid.</div>";
        header('location:' . SITEURL . 'order.php');
        exit();
    }
 
    // Escape inputs after validation
    $food             = mysqli_real_escape_string($conn, $food);
    $customer_name    = mysqli_real_escape_string($conn, $customer_name);
    $customer_contact = mysqli_real_escape_string($conn, $customer_contact);
    $customer_email   = mysqli_real_escape_string($conn, $customer_email);
    $customer_address = mysqli_real_escape_string($conn, $customer_address);

    $total      = $price * $qty;
    $order_date = date("Y-m-d H:i:s");
    $status     = "Ordered";

    // Proceed with DB insert
    $sql = "INSERT INTO tbl_order SET
            food = '$food',
            price = $price,
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['message'] = "<div class='success text-center'>Food ordered successfully.</div>";
    } else {
        $_SESSION['message'] = "<div class='error text-center'>Failed to order food.</div>";
    }

    header('location:' . SITEURL);
}
