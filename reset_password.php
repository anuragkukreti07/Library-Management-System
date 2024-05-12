<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset_password"])) {
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Validation: Ensure new password and confirm password match
    if ($new_password != $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Update password in the database
        require_once "database.php";

        // You might want to retrieve the user's email from the session or from a query parameter
        $email = $_SESSION["email"]; // Assuming you store the email in the session

        // Hash the new password before storing it
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        // Update the user's password in the database
        $sql = "UPDATE user_info SET password = '$hashed_password' WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            // Password updated successfully
            $success = "Password updated successfully.";

            // Redirect the user to the login page
            header("Location: login.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            $error = "Error updating password: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Library Management System</title>
    <link rel="stylesheet" href="styles1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Teachers:ital,wght@0,400..800;1,400..800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
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
                <h2>Reset Password</h2>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } elseif (isset($success)) { ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php } ?>

                <form action="reset_password.php" method="post">
                    <div class="form-group">
                        <input type="password" placeholder="New Password" name="new_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control">
                    </div>
                    <div class="form-btn">
                        <input type="submit" value="Reset Password" name="reset_password" class="btn btn-primary">
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