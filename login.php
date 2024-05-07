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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
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

<body>
    <header>
        <span style="font-size: 50px;padding:20px" class="material-symbols-outlined">local_library</span>
        <h1
            style="font-family: 'Source Code Pro', monospace; font-weight: 400; display: inline-block; vertical-align: middle; padding-bottom:30px">
            Library Management System</h1>
    </header>

    <main>
        <div style="display:flex; flex-direction:column; align-items:center;" class="container">
            <div
                style="max-width: 600px;margin: 0 auto;padding: 50px;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <h2>Login</h2>
                <div>
                    <?php
                    if (isset($_POST["login"])) {
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        require_once "database.php";
                        $sql = "SELECT * FROM user_info WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        if ($user) {
                            if (password_verify($password, $user["password"])) {
                                session_start();
                                $_SESSION["user"] = "yes";
                                header("Location: home.php");
                                die();
                            } else {
                                echo "<div class='alert'>Password does not match</div>";
                            }
                        } else {
                            echo "<div class='alert'>Email does not match</div>";
                        }
                    }
                    ?>
                </div>
                <div>
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
                    </form>
                    <div>
                        <p>Not registered yet <a href="signup.php">Register Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function redirectToHomePage() {
            window.location.href = "home.php";
        }
    </script>

    <footer>
        <p>&copy; 2024 Library Management System</p>
    </footer>
</body>

</html>