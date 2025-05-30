<?php
include 'partials/menu.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM tbl_category WHERE id = ?");

    $stmt->bind_param("i", $id);

    $result = $stmt->execute();

    if ($result) {
        $_SESSION['message'] = "<div class='success'> Category deleted successfully </div>";
    } else {
        $_SESSION['message'] = "<div class='error'> Failed to delete category </div>";
    }

    header("Location: " . SITEURL . "admin/manage-category.php");
    exit();
} else {
    $_SESSION["message"] = "<div class = 'error'> Invalid category </div>";

    header("Location: " . SITEURL . "admin/manage-category.php");
    exit();

}
