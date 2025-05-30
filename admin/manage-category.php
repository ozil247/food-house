<?php include 'partials/menu.php'?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br><br>

        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
        ?>

        <br><br>

        <table class="tb1-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                // Fetch all categories from database
                $sql = "SELECT * FROM tbl_category ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id         = $row['id'];
                            $title      = $row['title'];
                            $image_name = $row['image_name'];
                            $featured   = $row['featured'];
                            $active     = $row['active'];
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php 
                                
                                        if ($image_name != "") {
                                            echo "<img src='" . SITEURL . "images/category/$image_name' width='100px'>";
                                        } else {
                                            echo "<div class='error'>Image not added</div>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        // No categories found
                        echo "<tr><td colspan='6' class='error'>No Category Added Yet.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='error'>Failed to fetch categories.</td></tr>";
                }
            ?>

        </table>

    </div>
</div>

<?php include 'partials/footer.php'?>
