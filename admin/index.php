<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>

        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>

        <br>
        <br>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php include('partials/footer.php') ?>