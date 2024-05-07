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
        /* Custom CSS to override Bootstrap */
        .custom-card {
            background-color: #e9ecef;
            /* Grey background color */
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header style="display: flex;">
        <div>
            <span style="font-size: 50px;padding:20px" class="material-symbols-outlined">local_library</span>
            <h1 style="font-family: 'Source Code Pro', monospace; font-weight: 400; display: inline-block; vertical-align: middle; padding-bottom:30px">
                Library Management System</h1>
            <nav style="padding-left: 100px;" class="ml-auto">
                <ul class="list-inline text-light">
                    <li class="list-inline-item"><a class="text-light" href="home.php">Home</a></li>
                    <li class="list-inline-item"><a class="text-light" href="books.php">Books</a></li>
                    <li class="list-inline-item"><a class="text-light" href="members.php">Members</a></li>
                    <li class="list-inline-item"><a class="text-light" href="transactions.php">Transactions</a></li>
                    <li class="list-inline-item"><a class="text-light" href="reports.php">Reports</a></li>
                    <li class="list-inline-item"><a class="text-light" href="settings.php">Settings</a></li>
                </ul>
            </nav>
        </div>

        <div style="margin-left: auto; margin-top: auto;margin-bottom: auto;margin-right: 5px;">
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
    <!-- Page Content -->
    <div class="container mt-5">
        <h2>Add New Book</h2>
        <form>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" class="form-control" id="author" placeholder="Enter author" name="author">
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" placeholder="Enter ISBN" name="isbn">
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>

    <div class="container mt-5">
        <h2>Book List</h2>
        <ul class="list-group">
            <!-- Example book item -->
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Book Title
                <span class="badge badge-danger badge-pill">Delete</span>
            </li>
            <!-- Add more book items dynamically using PHP or JavaScript -->
        </ul>
    </div>




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