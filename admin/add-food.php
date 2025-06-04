<?php include 'partials/menu.php'?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1> <br>
        <br>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
        ?>
        <br>
        <br>

        <form action="process-food.php" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title" >
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" rows="5" placeholder="Food Description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Food Price" >
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
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
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>

</div>


<?php include 'partials/footer.php'?>