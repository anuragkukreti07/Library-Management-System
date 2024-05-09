<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Library Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="books.css">
    <style>
        .custom-card {
            background-color: #e9ecef;
        }
    </style>
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
            <button type="button" id="logout-btn" class="btn btn-light" onclick="logout()">Logout</button>

            <script>
                function logout() {
                    window.location.href = "logout.php";
                }
            </script>

        </div>
    </header>

    <div class="container mt-5">
        <h2>Add New Book</h2>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $author = $_POST["author"];
            $isbn = $_POST["isbn"];

            $errors = array();

            if (empty($name) || empty($author) || empty($isbn)) {
                array_push($errors, "All fields are required");
            }

            require_once "database.php";

            $sql = "SELECT * FROM book_info WHERE ISBN = ?";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $isbn);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    array_push($errors, "ISBN already exists");
                }
                mysqli_stmt_close($stmt);
            }

            if (empty($errors)) {
                $sql = "INSERT INTO book_info (Author, Name, ISBN) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $author, $name, $isbn);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<div class='alert alert-success'>Book added successfully</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error inserting book</div>";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "<div class='alert alert-danger'>Error preparing statement</div>";
                }
            } else {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
        }
        ?>

        <form action="admin.php" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="name">
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" placeholder="Enter author" name="author">
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" placeholder="Enter ISBN" name="isbn">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Add Book</button>
        </form>
    </div>

    <div class="container mt-5">
        <h2>Book List</h2>
        <ul class="list-group">

        </ul>
    </div>

    <footer class="bg-dark text-light py-3">
        <div class="container">
            <p>&copy; 2024 Library Management System</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>