<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Library Management System</title>
    <link rel="stylesheet" href="styles1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Teachers:ital,wght@0,400..800;1,400..800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
    </style>
    <style>
        .alert {
            color: white;
            background-color: #dc3545;
            /* Red background color */
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body style="font-family: 'Source Code Pro', monospace; font-weight: 400;">
    <header>
        <span style="font-size: 50px;padding:20px" class="material-symbols-outlined">local_library</span>
        <h1 style="display: inline-block; vertical-align: middle; padding-bottom:30px">
            Library Management System</h1>
    </header>

    <main style="display:flex; align-items:center;">
        <div style="display:flex; flex-direction:column; align-items:center;padding-top:100px;" class="container">
            <div style=" width:50vh; max-width: 800px;margin: 0 auto;padding: 50px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <h2>Login</h2>

                <?php
                require_once "database.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    // Fetch user information including failed attempts
                    $sql = "SELECT * FROM user_info WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_assoc($result);

                    if ($user) {
                        if ($user['failed_attempts'] < 3) { // Check if the user is not already locked out
                            if ($password === $email) {
                                $_SESSION["email"] = $user["email"];
                                // Check if password is same as email
                                echo "<div class='alert'>Please reset your password. <a href='reset_password.php'>Reset Password</a></div>";
                            } elseif (password_verify($password, $user["password"])) {
                                // Reset failed attempts on successful login
                                $sql_reset_attempts = "UPDATE user_info SET failed_attempts = 0 WHERE email = '$email'";
                                mysqli_query($conn, $sql_reset_attempts);

                                $_SESSION["user"] = "yes";
                                $_SESSION["email"] = $user["email"];
                                header("Location: home.php");
                                exit();
                            } else {
                                // Increment failed attempts
                                $failed_attempts = $user['failed_attempts'] + 1;
                                $sql_update_attempts = "UPDATE user_info SET failed_attempts = $failed_attempts WHERE email = '$email'";
                                mysqli_query($conn, $sql_update_attempts);

                                echo "<div class='alert'>Password does not match. Attempt " . $failed_attempts . "/3</div>";
                            }
                        } else {
                            echo "<div class='alert'>You have been locked out. Please contact support.</div>";
                        }
                    } else {
                        echo "<div class='alert'>Email does not exist.</div>";
                    }
                }

                mysqli_close($conn);
                ?>

                <form action="login.php" method="post">
                    <div class="form-group">
                        <input type="email" placeholder="Enter Email:" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Enter Password:" name="password" class="form-control">
                    </div>
                    <div class="form-btn">
                        <input type="submit" value="Login" name="login" class="btn btn-primary">
                    </div>
                    <div>
                        <br>
                        <p style="text-align: center;">Not registered yet?? <a style="text-decoration:underline; " href=" signup.php">Register Here</a></p>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Library Management System</p>
    </footer>
</body>

</html>