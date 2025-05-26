 <?php session_start(); ?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Food Order System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- You can move this CSS to admin.css if you prefer -->
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .login {
            background: #fff;
            padding: 2.5rem 2rem;
            border-radius: 1.2rem;
            box-shadow: 0 8px 32px rgba(60, 72, 100, 0.15);
            width: 100%;
            max-width: 370px;
        }

        .login h1 {
            margin-bottom: 2rem;
            color: #ff4757;
            font-weight: 700;
            font-size: 2rem;
        }

        .login-box label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 0.7rem 1rem;
            margin-bottom: 1.2rem;
            border: 1px solid #c7d2fe;
            border-radius: 0.5rem;
            background: #f1f5f9;
            font-size: 1rem;
            transition: border 0.2s;
        }

        .login-box input[type="text"]:focus,
        .login-box input[type="password"]:focus {
            border-color: #ff4757;
            outline: none;
        }

        .login-box input[type="submit"] {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(90deg, #ff4757 0%, #ff4757 100%);
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .login-box input[type="submit"]:hover {
            background: linear-gradient(90deg, #ff4757 0%, #ff4757 100%);
        }

        .login p {
            text-align: center;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .login p a {
            color: #ff4757;
            text-decoration: none;
            font-weight: 500;
        }

        .login p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login">
        <h1>Login</h1>

        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>



        <?php
            if (isset($_GET['error'])) {
                echo "<div style='color: red;'>" . htmlspecialchars($_GET['error']) . "</div>";
            }
        ?>


        <form action="process-login.php" method="POST" class="text-center p-2">
            <div class="login-box">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Username">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter Password">
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
        <br>
        <p>Created By - <a href="#">Ozil</a></p>
    </div>
</body>

</html>