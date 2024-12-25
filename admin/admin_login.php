<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Login</title>
</head>

<body>
    <div class="login-container">
        <h1>Admin Login</h1>

        <?php
        session_start();
        $error = "";

        // Koneksi ke database
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "shoes"; // Ganti dengan nama database Anda

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Proses login
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Hashing password for secure comparison
            $query = "SELECT * FROM admins WHERE nama_admin = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);  // Bind only username
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                // Verify password using password_hash() and password_verify()
                if (password_verify($password, $row['password'])) {
                    $_SESSION['admin'] = $username;
                    header("Location: admin_dashboard.php"); // Ganti dengan halaman admin Anda
                    exit;
                } else {
                    $error = "Invalid username or password!";
                }
            } else {
                $error = "Invalid username or password!";
            }
        }

        $conn->close();
        ?>

        <?php if ($error): ?>
            <div class="error"> <?php echo $error; ?> </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>
