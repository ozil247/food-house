<?php 
include('../config/constants.php');


if(isset($_POST['submit']))

{
    // get the data from the form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $image_name = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // check if a new image is uploaded
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        // upload new image
        $image_name = $_FILES['image']['name'];
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/" . $image_name;

        // upload the image
        $upload = move_uploaded_file($source_path, $destination_path);

        // check if the image upload was successful
        if (!$upload) {
            $_SESSION['message'] = "<div class='error'>Failed to upload new image</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            exit();
        }
    }

    // create sql query to update category
    $sql = "UPDATE tbl_category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id = '$id'";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check if the query was successful
    if ($res == true) {
        $_SESSION['message'] = "<div class='success'>Category updated successfully</div>";
    } else {
        $_SESSION['message'] = "<div class='error'>Failed to update category</div>";
    }

    // redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>