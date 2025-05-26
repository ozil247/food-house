<?php
session_start(); // Start session to use $_SESSION

include('../config/constants.php'); // Ensure this file defines $conn and SITEURL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize user input
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        $_SESSION['message'] = "<div class='error'>Please fill in all fields.</div>";
        header("Location: " . SITEURL . "admin/login.php");
        exit;
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE username = ?");
    if (!$stmt) {
        $_SESSION['message'] = "<div class='error'>Login error. Try again later.</div>";
        header("Location: " . SITEURL . "admin/login.php");
        exit;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            $_SESSION['message'] = "<div class='success'>Login Successful</div>";
            header("Location: " . SITEURL . "admin/");
            exit;
        } else {
            $_SESSION['message'] = "<div class='error'>Invalid password.</div>";
        }
    } else {
        $_SESSION['message'] = "<div class='error'>User not found.</div>";
    }

    // Redirect back to login with error
    header("Location: " . SITEURL . "admin/login.php");
    exit;
}
?>
