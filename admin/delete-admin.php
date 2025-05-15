<?php
// Include the constants file for DB connection and base URL
include('../config/constants.php');

// Check if the 'id' is passed in the URL, is numeric, and is greater than 0
if (isset($_GET['id']) && is_numeric($_GET['id']) && (int)$_GET['id'] > 0) {
    
    // Sanitize the 'id' by converting it to an integer
    $id = (int)$_GET['id'];

    // Prepare the SQL statement to delete the admin record with the given ID
    $stmt = $conn->prepare("DELETE FROM tbl_admin WHERE id = ?");

    // Bind the sanitized ID to the SQL statement as an integer
    $stmt->bind_param("i", $id);

    // Execute the prepared statement
    $result = $stmt->execute();

    // Check if the deletion was successful
    if ($result) {
        // If successful, set a success message in session
        $_SESSION['add'] = "<div class='success'>Admin deleted successfully.</div>";
    } else {
        // If failed, set an error message in session
        $_SESSION['add'] = "<div class='error'>Failed to delete admin.</div>";
    }

    // Redirect the user back to the Manage Admin page
    header("Location: " . SITEURL . "admin/manage-admin.php");
    exit(); // Stop further script execution

} else {
    // If the 'id' is not valid or not passed at all
    $_SESSION['add'] = "<div class='error'>Invalid admin ID.</div>";

    // Redirect the user back to the Manage Admin page
    header("Location: " . SITEURL . "admin/manage-admin.php");
    exit(); // Stop further script execution
}
