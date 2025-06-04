<?php 

include 'partials/menu.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM tbl_food WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "<div class='success'> Food deleted successfully </div>";
    } else {
        $_SESSION['message'] = "<div class='error'> Failed to delete food </div>";
    }

    header("Location: " . SITEURL . "admin/manage-food.php");
    exit();
} else {
    $_SESSION["message"] = "<div class='error'> Invalid food </div>";
    header("Location: " . SITEURL . "admin/manage-food.php");
    exit();
}

?>