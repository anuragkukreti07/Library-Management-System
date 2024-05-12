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

            // Update user_info table to set book_id to 0 and issue_date to default for returned book
            $update_query = "UPDATE user_info SET book_id = 0, issue_date = '0000-00-00' WHERE id = $user_id";
            if (mysqli_query($conn, $update_query)) {
                // Increase the number of copies of the book in book_info table
                $update_copies_query = "UPDATE book_info SET copies = copies + 1 WHERE id = $book_id";
                if (mysqli_query($conn, $update_copies_query)) {
                    header("Location: books.php?returned=true");
                    exit;
                } else {
                    echo "<div class='alert alert-danger'>Error increasing copies.</div>";
                }
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
echo "<div class='alert alert-success'>Book returned successfully.</div>";
?>