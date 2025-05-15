<?php include('partials/menu.php') ?>



<div class="main-content">
    <div class="wrapper">

        <?php

        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }

        ?>

        <?php
        if(isset($_SESSION['password'])) {
            echo $_SESSION['password'];
            unset($_SESSION['password']);
        }

        ?>

        <br>
        <br>

        <h1>Manage Admin</h1>

        <br>
        <a href="add-admin.php" class="btn-primary"> Add Admin</a>
        <br><br><br>




        <table class="tb1-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php

            // Query to get all admin
            $sql = "SELECT * FROM tbl_admin";

            // Execute the query

            $res = mysqli_query($conn, $sql);

            // Check if the query was successful

            if($res == TRUE)
            {
                //Count rows to check if we have data in the database
                $count = mysqli_num_rows($res); // Function to get all rows in database

                $sn = 1; // Create a variable and assign the value of 1

                //check the num of rows
                if($count>0)
                {
                    while($rows = mysqli_fetch_assoc($res))
                    {
                        //Get the values from the database
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Display the values in our table
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                             <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Reset Password</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>

                            </td>
                        </tr>
                  
                        <?php
                    }

                }
                else
                {

                }
            }




            ?>

        </table>
    </div>
</div>


<?php include('partials/footer.php') ?>