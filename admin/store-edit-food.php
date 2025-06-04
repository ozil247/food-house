<?php

include '../config/constants.php';

if (isset($_POST['submit'])) {
    $id          = $_POST['id'];
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $category_id = $_POST['category'];
    $image_name  = $_POST['current_image'];
    $featured    = $_POST['featured'];
    $active      = $_POST['active'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name       = $_FILES['image']['name'];
        $source_path      = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/" . $image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload == false) {
            $_SESSION['message'] = "<div class='error'>Failed to upload image.</div>";
            header('location:' . SITEURL . 'admin/update-food.php');
            exit();
        }
    }

    $sql = "UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category_id,
            featured = '$featured',
            active = '$active'
            WHERE id = $id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['message'] = "<div class='success'>Food updated successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['message'] = "<div class='error'>Failed to update food.</div>";
        header('location:' . SITEURL . 'admin/update-food.php');
    }

}
