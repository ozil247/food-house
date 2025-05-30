<?php
session_start();
include '../config/constants.php';

// Enable error reporting (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $featured = isset($_POST['featured']) ? mysqli_real_escape_string($conn, $_POST['featured']) : 'No';
    $active = isset($_POST['active']) ? mysqli_real_escape_string($conn, $_POST['active']) : 'No';

    // Handle image upload
    $image_name = "";

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];

        // Get the file extension
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);

        // Rename the image to avoid name conflict
        $image_name = "Category_" . uniqid() . "." . $ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/" . $image_name;

        // Create folder if it doesn't exist
        if (!is_dir("../images/category")) {
            mkdir("../images/category", 0777, true);
        }

        // Upload the image
        $upload = move_uploaded_file($source_path, $destination_path);

        // Check if the upload was successful
        if (!$upload) {
            $_SESSION['message'] = "<div class='error'>Failed to upload image.</div>";
            header('Location: ' . SITEURL . 'admin/add-category.php');
            exit();
        }
    }

    // Insert into database with image_name
    $sql = "INSERT INTO tbl_category (title, featured, active, image_name)
            VALUES ('$title', '$featured', '$active', '$image_name')";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['message'] = "<div class='success'>Category Added Successfully.</div>";
        header('Location: ' . SITEURL . 'admin/manage-category.php');
        exit();
    } else {
        $_SESSION['message'] = "<div class='error'>Failed to Add Category. Error: " . mysqli_error($conn) . "</div>";
        header('Location: ' . SITEURL . 'admin/add-category.php');
        exit();
    }
} else {
    $_SESSION['message'] = "<div class='error'>Unauthorized Access.</div>";
    header('Location: ' . SITEURL . 'admin/add-category.php');
    exit();
}
