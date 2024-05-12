<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Library Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="books.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Teachers:ital,wght@0,400..800;1,400..800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="  font-family:Teachers,sans-serif;font-style: normal;">
    <header style="display: flex;">
        <div>
            <span style="font-size: 50px;padding:20px" class="material-symbols-outlined">local_library</span>
            <h1 style=" display: inline-block; vertical-align: middle; padding-bottom:30px">
                Library Management System</h1>
            <nav style="font-family: 'Source Code Pro', monospace; font-weight: 400;padding-left: 100px;" class="ml-auto">
                <ul class="list-inline text-light">
                    <li class="list-inline-item"><a class="text-light" href="admin.php">Home</a></li>
                    <li class="list-inline-item"><a class="text-light" href="view_books_admin.php">Books</a></li>
                </ul>
            </nav>
        </div>
        <div style="margin-left: auto; margin-top: auto;margin-bottom: auto;margin-right: 5px;">
            <button type="button" class="btn btn-primary" onclick="window.location.href='inventory.php'">
                Inventory <span class="badge badge-light"></span>
            </button>

            <button type="button" id="logout-btn" class="btn btn-light" onclick="logout()">Logout</button>

            <script>
                function logout() {
                    window.location.href = "logout.php";
                }
            </script>
        </div>
    </header>
    <main class="py-5">
        <div class="container">
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
                        echo "<div class='alert alert-success'>Book deleted successfully.</div>";
                        echo "<a href='view_books_admin.php?query=' class='btn btn-primary'>Return</a>";
                        // You can redirect the user to a different page or display a success message as per your requirement
                    } else {
                        // Error deleting book
                        echo "<div class='alert alert-danger'>Error deleting book: " . mysqli_error($conn) . "</div>";
                        echo "<a href='view_books_admin.php?query=' class='btn btn-primary'>Return</a>";
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
        </div>
    </main>
    <footer class="bg-dark text-light py-3">
        <div class="container">
            <p>&copy; 2024 Library Management System</p>
        </div>
    </footer>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>