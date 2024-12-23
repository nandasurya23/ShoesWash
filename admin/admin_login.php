<?php
session_start();

// Cek apakah admin sudah login
if (isset($_SESSION['admin_id'])) {
    header('Location: admin_dashboard.php');
    exit;
}

// Pesan error jika login gagal
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil input dari form login
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Koneksi database
    include 'db.php'; // Pastikan Anda sudah menghubungkan ke database

    // Pastikan koneksi berhasil
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk mengambil data admin dari database
    $query = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param('s', $input_username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika admin ditemukan
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($input_password, $admin['password'])) {
            // Set session untuk admin
            $_SESSION['admin_id'] = $admin['username'];
            header('Location: admin_dashboard.php');
            exit;
        } else {
            $error_message = 'Username atau password salah.';
        }
    } else {
        $error_message = 'Username atau password salah.';
    }

    $stmt->close();
    $conn->close();
}
?>

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
        <h2>Admin Login</h2>
        <?php if ($error_message): ?>
            <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        <form action="admin_login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
