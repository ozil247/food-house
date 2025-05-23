<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config/constants.php'); // Make sure this defines $conn properly

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = "<div class='error'>Please fill in all fields.</div>";
        header("Location:" . SITEURL . "admin/login.php");
        exit;
    }

    // Check database connection
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Show actual SQL error
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // If passwords in DB are hashed:
        if (password_verify($password, $row['password'])) {
            $_SESSION['message'] = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;
            header("Location: " . SITEURL . "admin/");
            exit;
        } else {
            $_SESSION['message'] = "<div class='error'>Invalid password.</div>";
            header("Location:" . SITEURL . "admin/login.php");
        }
    } else {
        $_SESSION['message'] = "<div class='error'>User not found.</div>";
        header("Location:" . SITEURL . "admin/login.php");
    }

    header("Location:" . SITEURL . "admin/login.php");
    exit;
}
?>
