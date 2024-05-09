<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: a.html");
    exit;
}

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $query = "SELECT id FROM user_info WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];

            $update_query = "UPDATE user_info SET book_id = 0 WHERE id = $user_id";
            if (mysqli_query($conn, $update_query)) {
                header("Location: books.php");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Error returning book.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>User not found.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>User email not set in session.</div>";
    }
}
