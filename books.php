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
                session_start();
                if (!isset($_SESSION['user'])) {
                    header("Location: a.html");
                    exit;
                }

                require_once "database.php";
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['query'])) {

                    $search_query = $_GET['query'];

                    $sql = "SELECT * FROM book_info WHERE Name LIKE '%$search_query%' OR Author LIKE '%$search_query%' OR ISBN LIKE '%$search_query%'";
                } else {
                    $sql = "SELECT * FROM book_info";
                }

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='col-md-4 mb-4'>";
                            echo "<div class='card h-100 custom-card'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . $row['Name'] . "</h5>";
                            echo "<p class='card-text'>Author: " . $row['Author'] . "</p>";
                            echo "<p class='card-text'>ISBN: " . $row['ISBN'] . "</p>";
                            // Button to trigger the modal
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#bookModal" . $row['id'] . "'>View Details</button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";

                            // Modal for each book
                            echo "<div class='modal fade' id='bookModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='bookModalLabel' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='bookModalLabel'>" . $row['Name'] . "</h5>";
                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            // Fetch and display additional details of the book here
                            echo "<p>No. of Copies left : " . $row['copies'] . "</p>";
                            // Add more details as needed
                            echo "</div>";
                            echo "<div class='modal-footer'>";
                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='col-md-12'>";
                        echo "<div class='alert alert-warning'>No books found in the database.</div>";
                        echo "</div>";
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                mysqli_close($conn);
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