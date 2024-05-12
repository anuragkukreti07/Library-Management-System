<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: a.html");
    exit;
}
?>

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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="font-family:Teachers,sans-serif;font-style: normal;">
    <header style="display: flex;">
        <div>
            <span style="font-size: 50px;padding:20px" class="material-symbols-outlined">local_library</span>
            <h1
                style="font-family: 'Source Code Pro', monospace; font-weight: 400; display: inline-block; vertical-align: middle; padding-bottom:30px">
                Library Management System</h1>
            <nav style="font-family: 'Source Code Pro', monospace; font-weight: 400;padding-left: 100px;"
                class="ml-auto">
                <ul class="list-inline text-light">
                    <li class="list-inline-item"><a class="text-light" href="home.php">Home</a></li>
                    <li class="list-inline-item"><a class="text-light" href="books.php">Books</a></li>
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
                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Backspace') {
                        logout();
                    }
                });
            </script>
        </div>
    </header>

    <main class="py-5">
        <div class="container">

            <?php
            require_once "database.php";

            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];

                $query = "SELECT id FROM user_info WHERE email = '$email'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['id'];
                    $books_query = "SELECT book_id, issue_date FROM user_info WHERE id = $user_id";
                    $books_result = mysqli_query($conn, $books_query);

                    if ($books_result && mysqli_num_rows($books_result) > 0) {
                        while ($book_row = mysqli_fetch_assoc($books_result)) {
                            $book_id = $book_row['book_id'];
                            $issue_date = $book_row['issue_date'];
                            if ($book_id != 0) {
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
                                    // Modified button to trigger modal
                                    echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#bookModal" . $book_info['id'] . "'>View Details</button>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";

                                    // Modal for each book
                                    echo "<div class='modal fade' id='bookModal" . $book_info['id'] . "' tabindex='-1' role='dialog' aria-labelledby='bookModalLabel' aria-hidden='true'>";
                                    echo "<div class='modal-dialog' role='document'>";
                                    echo "<div class='modal-content'>";
                                    echo "<div class='modal-header'>";
                                    echo "<h5 class='modal-title' id='bookModalLabel'>" . $book_info['Name'] . "</h5>";
                                    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                                    echo "<span aria-hidden='true'>&times;</span>";
                                    echo "</button>";
                                    echo "</div>";
                                    echo "<div class='modal-body'>";
                                    // Display additional details here
                                    echo "<p>Issued On: " . date('F j, Y', strtotime($issue_date)) . "</p>";
                                    // Add more details as needed
                                    echo "</div>";
                                    echo "<div class='modal-footer'>";
                                    echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                        }
                    } else {
                        echo "<div>No books issued to you.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>User not found.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>User email not set in session.</div>";
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