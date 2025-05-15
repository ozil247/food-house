<?php

include('../config/constants.php');

// this will Check if the request method is POST (i.e., form submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $password_raw = trim($_POST['password']); // This is the plain-text password

    // Check if any field is empty
    if (empty($full_name) || empty($username) || empty($password_raw)) {
         header("Location: add-admin.php?error=All fields are required");
        exit();
    }

    // this will Hash the password securely using PHP's built-in password hashing function
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);
    

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO tbl_admin (full_name, username, password) VALUES (?, ?, ?)");

    // Bind the actual values to the placeholders in the SQL query
    $stmt->bind_param("sss", $full_name, $username, $password_hashed);
    // "sss" means three string values are being passed

    // Execute the statement and check if   it was successful
    if ($stmt->execute()) {
        
        $_SESSION['message'] = "<div class='success'>Admin added successfully.</div>";
        header("Location:". SITEURL . 'admin/manage-admin.php');

        exit();
    } else {
      
         $_SESSION['message'] = "<div class='success'>Failed to add Admin .</div>";
        header("Location:". SITEURL . 'admin/add-admin.php');
    }
}
?>
