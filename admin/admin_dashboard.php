<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="dashboard-container">
        <h1 class="dashboard-title">Admin Dashboard</h1>

        <?php
        // Simulating an admin login session (this would typically be handled by a session)
        session_start();

        // Check if admin is logged in (for demonstration purposes, assuming $_SESSION['admin'] is set)
        if (!isset($_SESSION['admin'])) {
            echo "<p>You must be logged in to access this page.</p>";
            echo "<a href='admin_login.php'>Go to Admin Login</a>";
            exit; // Stop the rest of the script from executing if not logged in
        }

        // Display welcome message
        echo "<p>Welcome, Admin!</p>";

        // Logout functionality
        if (isset($_GET['logout'])) {
            session_destroy(); // Destroy the session to log out
            header("Location: admin_login.php"); // Redirect to the login page after logging out
            exit;
        }

        // Koneksi ke database
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "shoes"; // Ganti dengan nama database Anda

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if delete is requested
        if (isset($_GET['delete_id']) && isset($_GET['table'])) {
            $id = $_GET['delete_id'];
            $table = $_GET['table'];

            // Sanitize the input to avoid SQL injection
            $id = $conn->real_escape_string($id);
            $table = $conn->real_escape_string($table);

            // Validate table name to avoid issues
            $validTables = ['users', 'service', 'pembayaran', 'transaksi'];
            if (in_array($table, $validTables)) {
                // Set the correct ID column based on the table
                switch ($table) {
                    case 'service':
                        $idColumn = 'id_service';
                        break;
                    case 'pembayaran':
                        $idColumn = 'id_pembayaran';
                        break;
                    case 'transaksi':
                        $idColumn = 'id_transaksi';
                        break;
                    default:
                        $idColumn = 'id'; // Default column for other tables like 'users'
                }

                // Execute delete query based on the correct column
                $sql = "DELETE FROM $table WHERE $idColumn = '$id'";
                if ($conn->query($sql) === TRUE) {
                    echo "<p>Record deleted successfully.</p>";
                } else {
                    echo "<p>Error deleting record: " . $conn->error . "</p>";
                }
            }
        }

        // Fungsi untuk menampilkan tabel
        function displayTable($conn, $tableName)
        {
            echo "<h2 class='dashboard-table-title'>Table: $tableName</h2>";
            $result = $conn->query("SELECT * FROM $tableName");

            if ($result->num_rows > 0) {
                echo "<table class='dashboard-table'><tr>";
                // Menampilkan header tabel
                while ($fieldInfo = $result->fetch_field()) {
                    echo "<th>{$fieldInfo->name}</th>";
                }
                echo "<th>Actions</th>"; // Add Actions column for delete button
                echo "</tr>";

                // Menampilkan data tabel
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<td>$value</td>";
                    }

                    // Determine the correct ID column for each table
                    $rowId = $row['id']; // Default ID (for 'users' or other generic tables)
                    switch ($tableName) {
                        case 'service':
                            $rowId = $row['id_service'];
                            break;
                        case 'pembayaran':
                            $rowId = $row['id_pembayaran'];
                            break;
                        case 'transaksi':
                            $rowId = $row['id_transaksi'];
                            break;
                    }

                    // Add a delete button for each row
                    echo "<td><a href='?delete_id=$rowId&table=$tableName' class='delete-button'>Delete</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data found in $tableName table.</p>";
            }
        }

        // Menampilkan tabel yang relevan
        $tables = ['users', 'service', 'pembayaran', 'transaksi'];
        foreach ($tables as $table) {
            displayTable($conn, $table);
        }

        $conn->close();
        ?>

        <!-- Logout Button -->
        <a href="?logout=true" class="logout-button">Logout</a>
    </div>
</body>

</html>