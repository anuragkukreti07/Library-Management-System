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
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
    </style>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header>
        <span style="font-size: 50px;padding:20px" class="material-symbols-outlined">local_library</span>
        <h1
            style="font-family: 'Source Code Pro', monospace; font-weight: 400; display: inline-block; vertical-align: middle; padding-bottom:30px">
            Library Management System</h1>
    </header>

    <main>
        <div
            style="max-width: 600px;margin: 0 auto;padding: 50px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <h2>Sign Up</h2>
            <div>
                <?php

                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                if (isset($_POST["submit"])) {
                    $fullName = $_POST["fullname"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $passwordRepeat = $_POST["repeat_password"];

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    $errors = array();

                    if (empty($fullName) or empty($email) or empty($password) or empty($passwordRepeat)) {
                        array_push($errors, "All fields are required");
                    }
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push($errors, "Email is not valid");
                    }
                    if (strlen($password) < 8) {
                        array_push($errors, "Password must be at least 8 charactes long");
                    }
                    if ($password !== $passwordRepeat) {
                        array_push($errors, "Password does not match");
                    }
                    require_once "database.php";
                    $sql = "SELECT * FROM user_info WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = mysqli_num_rows($result);
                    if ($rowCount > 0) {
                        array_push($errors, "Email already exists!");
                    }
                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    } else {
                        $sql = "INSERT INTO user_info (full_name, email, password) VALUES (?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                        if ($prepareStmt) {
                            mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                            mysqli_stmt_execute($stmt);
                            echo "<div class='alert alert-success'>You are registered successfully.</div>";
                            header("Location: home.php");
                            $_SESSION["email"] = $user["email"];
                            exit();
                        } else {
                            die("Something went wrong");
                        }
                    }
                }
                ?>
            </div>

            <form action="signup.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email:">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password:">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Register" name="submit">
                </div>
            </form>
            <div>
                <br>
                <p>Already Registered <a href="login.php">Login Here</a></p>
            </div>
        </div>
        <footer>
            <p>&copy; 2024 Library Management System</p>
        </footer>
    </main>




</body>

</html>