<?php  include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br> <br>

        <?php 
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']); 
        }

        
        ?>

        <br> <br>

        <form action="process-category.php" method="POST" enctype="multipart/form-data">
            <table class="tb1-full">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" class="input-responsive">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image" class="input-responsive">

                    </td>
                </tr>
                <tr>
                    <td>Featured</td>

                    <td>
                        <input type="radio" name="featured" value="Yes" id="">Yes
                        <input type="radio" name="featured" value="No" id="">No
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>
<?php include('partials/footer.php') ?>