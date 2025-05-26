<?php 

include('../config/constants.php'); // Include the constants file
session_destroy(); // Destroy the session

// Redirect to login page
header("Location: " . SITEURL . "admin/login.php");
exit();
?>