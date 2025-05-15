<?php include 'partials/menu.php'; ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>

        <?php

            // get the id of the admin to be updated
            $id = $_GET['id'];
            // create sql query to get the details

            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            // execute the query
            $res = mysqli_query($conn, $sql);

            // check if the query was successful
            if ($res == true) {
                //chdeck if we have data in the database
                $count = mysqli_num_rows($res);

                //check whether we have admin data or not

                if ($count == 1) {
                    //get the details
                    echo "Admin Found";
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];

                } else {
                    //redirect to manage admin
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }

                //ch
            }

        ?>


        <form action="store-edit-admin.php" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" value="<?php echo $full_name  ?>" name="full_name" id=""></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" value="<?php echo $username ?>" name="username" id=""></td>

                <tr>
                    <td colspan="2"> 
                        <input type="hidden" name="id" value="<?php echo $id ?>" id="">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                </tr>

                </td>
                </tr>


            </table>
        </form>
    </div>
</div>



<?php include 'partials/footer.php'; ?>