<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    header style="display: flex;">
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
        <button type="button" class="btn btn-primary" onclick="window.location.href='inventory.php'">
            Inventory <span class="badge badge-light">4</span>
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

</body>

</html>