<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: a.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['issue_book'])) {
    require_once "database.php";

    $book_id = $_POST['book_id'];
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $query = "SELECT id FROM user_info WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];

            $update_sql = "UPDATE user_info SET book_id = $book_id WHERE id = $user_id";
            if (mysqli_query($conn, $update_sql)) {
                echo "<div class='alert alert-success'>Book issued successfully.</div>";
                echo "<a href='home.php' class='btn btn-primary'>Return to Home</a>";
            } else {
                echo "<div class='alert alert-danger'>Error issuing book.</div>";
                echo "<a href='home.php' class='btn btn-primary'>Return to Home</a>";
            }
        } else {
            echo "<div class='alert alert-danger'>User not found.</div>";
            echo "<a href='home.php' class='btn btn-primary'>Return to Home</a>";
        }
    } else {
        echo "<div class='alert alert-danger'>User email not set in session.</div>";
        echo "<a href='home.php' class='btn btn-primary'>Return to Home</a>";
    }
}
?>