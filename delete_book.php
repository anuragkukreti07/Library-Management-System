<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_book'])) {
    require_once "database.php";

    // Get the book_id from the form
    $book_id = $_POST['book_id'];

    // Check if the book is issued to any user
    $check_sql = "SELECT * FROM user_info WHERE book_id = $book_id";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Book is issued to a user, so do not delete it
        echo "The book is currently issued to a user and cannot be deleted.";
    } else {
        // Book is not issued to any user, proceed with deletion
        // SQL query to delete the book with the specified book_id
        $delete_sql = "DELETE FROM book_info WHERE id = $book_id";

        if (mysqli_query($conn, $delete_sql)) {
            // Book deleted successfully
            echo "Book deleted successfully.";
            // You can redirect the user to a different page or display a success message as per your requirement
        } else {
            // Error deleting book
            echo "Error deleting book: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form was not submitted or the delete_book parameter is not set
    header("Location: view_books_admin.php"); // Redirect the user to the view_books_admin.php page
    exit();
}
?>