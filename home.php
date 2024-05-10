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
        @import url('https://fonts.googleapis.com/css2?family=Teachers:ital,wght@0,400..800;1,400..800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap');
    </style>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="  font-family:Teachers,sans-serif;font-style: normal;">
    <header style="display: flex;">
        <div>
            <span style="font-size: 50px;padding:20px" class="material-symbols-outlined">local_library</span>
            <h1
                style="font-family: 'Source Code Pro', monospace; font-weight: 400; display: inline-block; vertical-align: middle; padding-bottom:30px">
                Library Management System</h1>
            <nav style="padding-left: 100px;" class="ml-auto">
                <ul class="list-inline text-light">
                    <li class="list-inline-item"><a class="text-light" href="admin.php">Home</a></li>
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

                // Logout on backspace press
                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Backspace') {
                        logout();
                    }
                });
            </script>

        </div>
    </header>
    <section class="container">
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Issue a Book</h3>
                        <p class="card-text">Select and issue books from your collection to users.</p>
                        <a href="issuebook.php?query=" class="btn btn-primary">Issue Book</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Return a Book</h3>
                        <p class="card-text">Manage book returns and update your inventory.</p>
                        <a href="returnbook.php" class="btn btn-info">Return Book</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


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