<?php include 'partials-front/menu.php'; ?>

<?php
    // Check if food_id is set in the URL
    if (isset($_GET['food_id'])) {
        // Get the food ID from the URL
        $food_id = $_GET['food_id'];
        // SQL query to get the food details
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        // Execute the query
        $res   = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        // Check if food exists
        if ($count == 1) {
            // Food exists, get the details
            $row         = mysqli_fetch_assoc($res);
            $title       = $row['title'];
            $price       = $row['price'];
            $description = $row['description'];
            $image_name  = $row['image_name'];
            // Check if image is available
            if ($image_name != "") {
                $image_path = SITEURL . "images/food/" . $image_name; // Full path to the image
            } else {
                                                                    // Image not available, set a placeholder or error message
                $image_path = SITEURL . "images/food/no-image.png"; // Placeholder image
            }

        } else {
            // Food ID not set, redirect to home page or show an error
            header('location:' . SITEURL);
            exit();
        }
    } else {
        // Food ID not set, redirect to home page or show an error
        header('location:' . SITEURL);
        exit();
    }

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form method="POST" action="process-order.php" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                            if ($image_name == "") {
                                // Image not available
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                // Image available
                            ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
                        class="img-responsive img-curve">
                    <?php
                                }

                            ?>
                </div>

                <div class="food-menu-desc">
                    <h3> <?php echo $title ?></h3>
                     <input type="hidden" name="food" value="<?php echo $title ?>" id="">

                    <p class="food-price">$<?php echo $price ?></p>
                    <input type="hidden" name="price" value="<?php echo $price ?>" id="">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1">

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full_name" placeholder="E.g. Vijay Thapa" class="input-responsive">

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive">

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive">

                <div class="order-label">Address</div>
                <textarea name="address" rows="2" placeholder="E.g. Street, City, Country"
                    class="input-responsive"></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>

<?php 

 ?>
<!-- fOOD sEARCH Section Ends Here -->
<?php include 'partials-front/footer.php'; ?>