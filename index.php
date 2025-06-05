<?php
    include 'partials-front/menu.php';
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
            $sql   = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res   = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0) {
                while($row = mysqli_fetch_assoc($res ))
                {
                    $id    = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    // Check if image is available
                    if($image_name != "") {
                        // Display the image
                        ?>
        <a href="category-foods.php?category_id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <img src="images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                    class="img-responsive img-curve">

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
        </a>
        <?php
                    } else {            
                        // Display message if image is not available
                        echo "<div class='error'>Image not available.</div>";
                    }
                }
             } else {
                echo "<div class='error'>Category not found.</div>";
            }

        ?>




        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
            // SQL query to get foods from database
            $sql = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            // Check if foods are available
            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    // Check if image is available
                    if($image_name != "") {
                        ?>
        <div class="food-menu-box">
            <div class="food-menu-img">
                <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                    class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $title; ?></h4>
                <p class="food-price">$<?php echo $price; ?></p>
                <p class="food-detail"></p>
                <?php echo $description; ?>
                </p>
                <br>
                <a href="order.html" class="btn btn-primary">Order Now</a>
            </div>
        </div>
        <?php   
                    } else {
                        // Display message if image is not available
                        echo "<div class='error'>Image not available.</div>";
                    }
                }
            } else {
                // Display message if no foods are available
                echo "<div class='error'>Food not found.</div>";
            }
        ?>








        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->


<?php
include 'partials-front/footer.php';
?>