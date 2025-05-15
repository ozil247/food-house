<?php 
include('../config/constants.php');


if(isset($_POST['submit']))

{

    // get the data from the form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];   
    $username = $_POST['username'];

    // create sql query to update admin

    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username'
    WHERE id = '$id'
    ";

    // execute the query
    $res = mysqli_query($conn, $sql);  
    
    // check if the query was successful

    if( $res == true)
    {
        $_SESSION['message'] = "<div class='success'>Admin updated successfully</div>";
        // redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['message'] = "<div class='error'>Failed to update admin</div>";
        // redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}


?>