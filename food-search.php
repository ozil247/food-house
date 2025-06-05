<?php include 'partials-front/menu.php'; ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"Momo"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            $search = $_POST['search'];

            // SQL query to search for food items
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            // Check if any food items are found
            if ($count > 0) {
                // Food items found
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    // Check if image is available
                    if ($image_name != "") {
                        // Display the food item
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
                                <a href="#" class="btn btn-primary">Order Now</a>

                            </div>  
                        </div>
                        <?php
                    } else {
                        // Display message if image is not available
                        echo "<div class='error'>Image not available for $title.</div>";
                    }
                }
            } else {
                // No food items found
                echo "<div class='error'>Food not found with the search term '$search'.</div>";
            }

            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include 'partials-front/footer.php'; ?>