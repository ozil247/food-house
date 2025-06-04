<?php
session_start();
include '../config/constants.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    //get the data from form
    $title       = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price       = mysqli_real_escape_string($conn, $_POST['price']);
    $featured    = isset($_POST['featured']) ? mysqli_real_escape_string($conn, $_POST['featured']) : "No";
    $active      = isset($_POST['active']) ? mysqli_real_escape_string($conn, $_POST['active']) : "No";
    $category    = mysqli_real_escape_string($conn, $_POST['category']);

    $image_name = "";

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];

        $ext = pathinfo($image_name, PATHINFO_EXTENSION);

        $image_name       = "food_name_" . uniqid() . '.' . $ext;
        $source_path      = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/" . $image_name;

        if (! is_dir("../images/food/")) {
            mkdir("../images/food/", 0777, true);
        }

        $upload = move_uploaded_file($source_path, $destination_path);

        if (! $upload) {
            $_SESSION['message'] = "<div class='error'>Failed to upload image.</div>";
            header('location:' . SITEURL . 'admin/add-food.php');
            exit();
        }

    }

    $sql = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active)
            VALUES ('$title', '$description', '$price', '$image_name', '$category', '$featured', '$active')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['message'] = "<div class='success'> Food Added Successfully. </div>";
        header('location: ' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['message'] = "<div class='error'> Failed to Add Food. </div>";
        header('location: ' . SITEURL . 'admin/add-food.php');
    }

} else {
    $_SESSION['message'] = "<div class='error'> Unauthorized Access. </div>";
    header('location: ' . SITEURL . 'admin/add-food.php');

}
