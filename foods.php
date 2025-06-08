<?php include 'partials-front/menu.php'; ?>

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
                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>">Order Now</a>
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

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include 'partials-front/footer.php'; ?>