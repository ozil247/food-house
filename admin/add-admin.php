<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <?php

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

?>
        <h1>Add Admin</h1>
        <br><br>

        <?php
        if (isset($_GET['error'])) {
            echo "<div style='color: red;'>" . htmlspecialchars($_GET['error']) . "</div>";
        }
        ?>

        <form action="process-admin.php" method="POST">
            <table style="width: 30%;" class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>