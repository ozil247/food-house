<?php 

session_start(); // Start session to use $_SESSION
include '../config/constants.php'; 

if (isset($_POST['submit'])) {
    // Get the values from the form
    $id = $_POST['id'];
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    // Update the order in the database
    $sql = "UPDATE tbl_order SET 
            status='$status', 
            customer_name='$customer_name', 
            customer_contact='$customer_contact', 
            customer_email='$customer_email', 
            customer_address='$customer_address' 
            WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($res) {
        $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
} else {
    // Redirect to manage order page if submit is not set
    header('location:'.SITEURL.'admin/manage-order.php');
}







?>