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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="books.css"> <!-- Your custom CSS file -->

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
            <h1 style="font-family: 'Source Code Pro', monospace; font-weight: 400; display: inline-block; vertical-align: middle; padding-bottom:30px">
                Library Management System</h1>
            <nav style="padding-left: 100px;" class="ml-auto">
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
                    // Perform any logout logic here
                    // For example, you can use JavaScript to redirect to logout.php
                    window.location.href = "logout.php";
                }
            </script>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <h2 class="mb-4">Books</h2>
            <form class="mb-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for books..." name="query">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <?php


                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {

                    require_once "database.php";

                    $search_query = $_GET['query'];

                    $sql = "SELECT * FROM book_info WHERE Name LIKE '%$search_query%' OR Author LIKE '%$search_query%' OR ISBN LIKE '%$search_query%'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='col-md-4 mb-4'>";
                            echo "<div class='card h-100 custom-card'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . $row['Name'] . "</h5>";
                            echo "<p class='card-text'>Author: " . $row['Author'] . "</p>";
                            echo "<p class='card-text'>ISBN: " . $row['ISBN'] . "</p>";
                            echo "<form action='issue_book.php' method='POST'>";
                            echo "<input type='hidden' name='book_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' name='issue_book' class='btn btn-primary'>Issue Book</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='col-md-12'>";
                        echo "<div class='alert alert-warning'>No books found matching your search query.</div>";
                        echo "</div>";
                    }
                }
                ?>

            </div>
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