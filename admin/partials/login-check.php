<?php 
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access the admin panel.</div>";
    header('Location: ' . SITEURL . 'admin/login.php');
    exit();
}
?>


