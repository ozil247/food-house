<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>
        <form action="" method="POST">
            <table style="width: 30  %;" class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your full name"> </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td> <input type="text" name="username" id="" placeholder="enter your username"> </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td> <input type="password" name="password" id="" placeholder="enter your password"> </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary" id="">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php
if(isset($_POST['submit']))
{
    //get data from the form 
$full_name = $_POST['full_name'];
   $username = $_POST['username'];
    $password = md5($_POST['password']); //password encrypted with md5
} 

// sql query
$sql = "INSERT INTO tbl_admin SET 
full_name = '$full_name',
username = '$username',
password = '$password'
"; 


?>