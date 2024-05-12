<?php
// Start the session
session_start();

// Check if the session variable "admin" is not set
if (!isset($_SESSION["admin"])) {
    // Redirect to a.html
    header("Location: a.html");
    exit(); // Make sure to exit after redirection
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
        /* Custom CSS */
        .user-item {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .username {
            width: 90%;
        }

        .delete-btn-container {
            margin-left: auto;
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
                    <li class="list-inline-item"><a class="text-light" href="view_books_admin.php?query=">Books</a></li>
                </ul>
            </nav>
        </div>
        <div style="margin-left: auto; margin-top: auto;margin-bottom: auto;margin-right: 5px;">

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

    <div class="container">
        <h1 class="mt-4 mb-4">Users List</h1>
        <ul class="list-group">
            <?php
            // Start the session
            
            // Include the database connection file
            require_once "database.php";

            // Check if the delete request is sent
            if (isset($_POST["delete_user"])) {
                // Get the user ID from the POST request
                $userId = $_POST["user_id"];

                // Check if the user has any book issued (book_id value is not 0)
                $checkBookQuery = "SELECT book_id FROM user_info WHERE id = $userId";
                $checkBookResult = mysqli_query($conn, $checkBookQuery);

                if ($checkBookResult && mysqli_num_rows($checkBookResult) > 0) {
                    $bookRow = mysqli_fetch_assoc($checkBookResult);
                    $bookId = $bookRow['book_id'];

                    // If the user has a book issued, display a message
                    if ($bookId != 0) {
                        echo "<div class='alert alert-danger'>Cannot delete user. The user has a book issued.</div>";
                    } else {
                        // If the user doesn't have any book issued, proceed with deletion
                        $deleteQuery = "DELETE FROM user_info WHERE id = $userId";
                        $deleteResult = mysqli_query($conn, $deleteQuery);

                        if ($deleteResult) {
                            echo "<div class='alert alert-success'>User deleted successfully.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Error deleting user.</div>";
                        }
                    }
                }
            }

            // Retrieve user information from the database
            $sql = "SELECT id, full_name, email FROM user_info";
            $result = mysqli_query($conn, $sql);

            // Check if there are users in the database
            if (mysqli_num_rows($result) > 0) {
                $counter = 1; // Initialize counter
                echo "<table class='table'>";
                echo "<thead>
            <tr>
                <th>Row No.</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
          </thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $userId = $row['id'];
                    $username = $row['full_name'];
                    $email = $row['email']; // Fetch email from the database
                    echo "<tr>
                <td>$counter</td> <!-- Display row number -->
                <td>$username</td>
                <td>$email</td>
                <td>
                    <form method='post'>
                        <input type='hidden' name='user_id' value='$userId'>
                        <button type='submit' name='delete_user' class='btn btn-danger'>Delete</button>
                    </form>
                </td>
              </tr>";
                    $counter++; // Increment counter
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<li class='list-group-item'>No users found</li>";
            }

            // Close connection
            mysqli_close($conn);
            ?>

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