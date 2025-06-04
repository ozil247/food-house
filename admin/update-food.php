<?php include 'partials/menu.php'?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br> <br>

        <?php
        
          if(isset($_GET['id'])) {
            $id = (int) $_GET['id'];

            // Fetch food details
            $sql = "SELECT * FROM tbl_food WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    // Food found
                    $row = mysqli_fetch_assoc($res);
                    $title       = $row['title'];
                    $description = $row['description'];
                    $price       = $row['price'];
                    $image_name  = $row['image_name'];
                    $category_id = $row['category_id'];
                    $featured    = $row['featured'];
                    $active      = $row['active'];
                } else {
                    // Food not found
                    $_SESSION['no-food-found'] = "<div class='error'>Food not found.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }
            }
          } else {
            // Redirect to manage food page if id is not set
            $_SESSION['no-food-found'] = "<div class='error'>Invalid food ID.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
          }

        ?>
        <br> <br>
        <form action="store-edit-food.php" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" value="<?php echo $title ?>" name="title" placeholder="Food Title">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea  name="description" rows="5" placeholder="Food Description">                                                                                                <?php echo $description ?> </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input value="<?php echo $price ?>" type="number" name="price" placeholder="Food Price">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php if ($image_name != "") {
                                echo "<img src='" . SITEURL . "images/food/$image_name' width = '100px'>";
                            } else {
                                echo "<div class='error'>No image added.</div>";
                        }?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                // Fetch categories from database
                                $sql   = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res   = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if ($count > 0) {
                                    // Categories available

                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id    = $row['id'];
                                        $title = $row['title'];

                                        echo "<option value='$id'>$title</option>";
                                    }

                                } else {
                                    // No categories available
                                    echo "<option value='0'>No Category Found</option>";
                                }

                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($featured == "Yes") echo "checked" ?> > Yes
                        <input type="radio" name="featured" value="No"  <?php if($featured == "No") echo "checked" ?> > No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"  <?php if($active == "Yes") echo "checked" ?>> Yes
                        <input type="radio" name="active" value="No"  <?php if($active == "No") echo "checked" ?>> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $image_name; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>


    </div>
</div>

<?php include 'partials/footer.php'?>