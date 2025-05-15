<?php 
// Include the file that contains the database connection constants
include('../config/constants.php');

// Start a session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form was submitted using the POST method
if (isset($_POST['submit'])) {

    // Get and sanitize input data from the form
    $id = (int)$_POST['id']; // Cast the ID to integer to prevent injection
    $current_password = trim($_POST['current_password']); // Remove whitespace from current password
    $new_password = trim($_POST['new_password']); // Remove whitespace from new password
    $confirm_password = trim($_POST['confirm_password']); // Remove whitespace from confirm password

    // Check if any of the fields are empty
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        // Store an error message in the session
        $_SESSION['message'] = "<div class='error'>All fields are required.</div>";
        // Redirect the user to the manage admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
        exit(); // Stop further execution
    }

    // Prepare a SQL statement to select the hashed password for the given admin ID
    $stmt = $conn->prepare("SELECT password FROM tbl_admin WHERE id = ?");
    $stmt->bind_param("i", $id); // Bind the ID as an integer to the SQL query
    $stmt->execute(); // Execute the query
    $stmt->store_result(); // Store the result so we can count rows

    // Check if a user with that ID exists
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_password_from_db); // Bind the result to a variable
        $stmt->fetch(); // Fetch the result

        // Verify the current password entered matches the hashed password in the database
        if (password_verify($current_password, $hashed_password_from_db)) {

            // Check if the new password matches the confirm password
            if ($new_password === $confirm_password) {

                // Hash the new password before saving it in the database
                $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

                // Prepare a SQL statement to update the password
                $update_stmt = $conn->prepare("UPDATE tbl_admin SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $new_password_hashed, $id); // Bind the new password and user ID

                // Execute the update query
                if ($update_stmt->execute()) {
                    // Set a success message
                    $_SESSION['message'] = "<div class='success'>Password changed successfully.</div>";
                } else {
                    // Set an error message if the update fails
                    $_SESSION['message'] = "<div class='error'>Failed to update password.</div>";
                }

            } else {
                // Set an error message if the new passwords don't match
                $_SESSION['message'] = "<div class='error'>New passwords do not match.</div>";
            }

        } else {
            // Set an error message if the current password is incorrect
            $_SESSION['message'] = "<div class='error'>Current password is incorrect.</div>";
        }

    } else {
        // Set an error message if the user is not found
        $_SESSION['message'] = "<div class='error'>User not found.</div>";
    }

    // Redirect the user to the manage admin page after processing
    header('location:' . SITEURL . 'admin/manage-admin.php');
    exit(); // Stop further execution
}
?>