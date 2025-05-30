<?php  include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br> <br>


        <br> <br>

        <?php 

        $id = $_GET['id'];

        $sql = "SELECT * FROM tbl_category WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        if($res == true){
            $count = mysqli_num_rows($res);
            if($count == 1){
                echo "<div class='success'>Category found</div>";
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
                
            } else {
                echo "<div class='error'>Category not found</div>";
                header("Location: " . SITEURL . "admin/manage-category.php");
                exit();
            }
        }


        
        ?>

        <form action="process-category.php" method="POST" enctype="multipart/form-data">
            <table class="tb1-full">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" value="<?php echo $title ?>" name="title" placeholder="Category Title"
                            class="input-responsive">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                    if ($image_name != "") {
                        echo "<img src='" . SITEURL . "images/category/$image_name' width='100px'>";
                    } else {
                        echo "<div class='error'>No image added.</div>";
                    }
                ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($featured == "Yes") echo "checked"; ?>>
                        Yes
                        <input type="radio" name="featured" value="No" <?php if($featured == "No") echo "checked"; ?>>
                        No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($active == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if($active == "No") echo "checked"; ?>> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $image_name; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<?php include('partials/footer.php') ?>