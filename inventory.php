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

<body>
    <header style="display: flex;">
        <div>
            <span style="font-size: 50px;padding:20px" class="material-symbols-outlined">local_library</span>
            <h1
                style="font-family: 'Source Code Pro', monospace; font-weight: 400; display: inline-block; vertical-align: middle; padding-bottom:30px">
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
            <button type="button" class="btn btn-primary" onclick="window.location.href='inventory.php'">
                Inventory <span class="badge badge-light"></span>
            </button>

            <button type="button" id="logout-btn" class="btn btn-light" href="logout.php">Logout</button>

        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <h2 class="mb-4">Inventory</h2>
            <form class="mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for books...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Search</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <!-- Example book tiles -->

                <div class="col-md-4 mb-4">
                    <div class="card h-100 custom-card">
                        <div class="card-body">
                            <h5 class="card-title">Book Title 1</h5>
                            <p class="card-text">Author: Author Name 3</p>
                            <p class="card-text">ISBN: 1357924680</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                            <a href="#" class="btn btn-secondary">Return</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 custom-card">
                        <div class="card-body">
                            <h5 class="card-title">Book Title 1</h5>
                            <p class="card-text">Author: Author Name 3</p>
                            <p class="card-text">ISBN: 1357924680</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                            <a href="#" class="btn btn-secondary">Return</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 custom-card">
                        <div class="card-body">
                            <h5 class="card-title">Book Title 1</h5>
                            <p class="card-text">Author: Author Name 3</p>
                            <p class="card-text">ISBN: 1357924680</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                            <a href="#" class="btn btn-secondary">Return</a>

                        </div>
                    </div>
                </div>

                <!-- Repeat for each book -->
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