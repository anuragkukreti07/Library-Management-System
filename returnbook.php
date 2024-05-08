<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Library Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="books.css"> <!-- Your custom CSS file -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
    </style>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: a.html");
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "database.php";

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query = "SELECT id FROM user_info WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
        $books_query = "SELECT book_id FROM user_info WHERE id = $user_id";
        $books_result = mysqli_query($conn, $books_query);

        if ($books_result && mysqli_num_rows($books_result) > 0) {

            while ($book_row = mysqli_fetch_assoc($books_result)) {
                $book_id = $book_row['book_id'];
                $book_info_query = "SELECT * FROM book_info WHERE id = $book_id";
                $book_info_result = mysqli_query($conn, $book_info_query);

                if ($book_info_result && mysqli_num_rows($book_info_result) > 0) {
                    $book_info = mysqli_fetch_assoc($book_info_result);
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card h-100 custom-card'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $book_info['Name'] . "</h5>";
                    echo "<p class='card-text'>Author: " . $book_info['Author'] . "</p>";
                    echo "<p class='card-text'>ISBN: " . $book_info['ISBN'] . "</p>";
                    echo "<a href='return_book.php?book_id=" . $book_info['id'] . "' class='btn btn-primary'>Return Book</a>";

                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        } else {
            echo "<div class='alert alert-warning'>No books issued to you.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>User not found.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>User email not set in session.</div>";
}
?>