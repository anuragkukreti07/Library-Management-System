<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Library Management System</title>
    <link rel="stylesheet" href="styles1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
            <div
                style=" width:50vh; max-width: 800px;margin: 0 auto;padding: 50px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <h2>Admin Login</h2>

                <?php
                require_once "database.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    // Fetch admin information including failed attempts
                    $sql = "SELECT * FROM admin_info WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $admin = mysqli_fetch_assoc($result);

                    if ($admin) {
                        if ($admin['failed_attempts'] < 3) { // Check if the admin is not already locked out
                            if ($password == $admin["password"]) {
                                // Reset failed attempts on successful login
                                $sql_reset_attempts = "UPDATE admin_info SET failed_attempts = 0 WHERE email = '$email'";
                                mysqli_query($conn, $sql_reset_attempts);

                                $_SESSION["admin"] = "yes";
                                $_SESSION["email"] = $admin["email"];
                                header("Location: admin.php");
                                exit();
                            } else {
                                // Increment failed attempts
                                $failed_attempts = $admin['failed_attempts'] + 1;
                                $sql_update_attempts = "UPDATE admin_info SET failed_attempts = $failed_attempts WHERE email = '$email'";
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

                <form action="admin_login.php" method="post">
                    <div class="form-group">
                        <input type="email" placeholder="Enter Username" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Enter Password:" name="password" class="form-control">
                    </div>
                    <div class="form-btn">
                        <input type="submit" value="Login" name="login" class="btn btn-primary">
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