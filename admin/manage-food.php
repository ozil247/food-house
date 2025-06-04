<?php include 'partials/menu.php'?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <br>

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br>
        <br>
        <br>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
        ?>
        <table class="tb1-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

           <?php 
           $sql  = "SELECT * FROM tbl_food ORDER BY id DESC";
           $res = mysqli_query($conn, $sql);

           if($res == TRUE){
            $count = mysqli_num_rows($res);
            $sn = 1;

            if($count > 0){
                while($row = mysqli_fetch_assoc($res)){
                    $id          = $row['id'];
                    $title       = $row['title'];
                    $description = $row['description'];
                    $price       = $row['price'];
                    $image_name  = $row['image_name'];
                    $category_id = $row['category_id'];
                    $featured    = $row['featured'];
                    $active      = $row['active'];

                    // Fetch category name
                    $category_sql = "SELECT title FROM tbl_category WHERE id='$category_id'";
                    $category_res = mysqli_query($conn, $category_sql);
                    $category_row = mysqli_fetch_assoc($category_res);
                    $category_title = isset($category_row['title']) ? $category_row['title'] : 'Uncategorized';

                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo number_format($price, 2); ?></td>
                        <td>
                            <?php 
                            if ($image_name != "") {
                                echo "<img src='".SITEURL."images/food/".$image_name."' width='100px'>";
                            } else {
                                echo "<div class='error'>Image not available</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $category_title; ?></td>
                        <td><?php echo ucfirst($featured); ?></td>
                        <td><?php echo ucfirst($active); ?></td>

                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                        </td>
                        
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='8' class='error'>Food not added yet.</td></tr>";
            }
           }

            ?>
           
        </table>

    </div>
</div>
<?php include 'partials/footer.php'?>