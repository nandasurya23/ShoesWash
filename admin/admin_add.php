<?php
include 'db.php'; // Pastikan Anda sudah menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data admin ke database
    $query = "INSERT INTO admins (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param('ss', $username, $hashed_password);

        if ($stmt->execute()) {
            // Berhasil, arahkan ke halaman login admin
            header('Location: admin_login.php');
            exit;
        } else {
            echo "Gagal menambahkan admin.";
        }

        $stmt->close();
    } else {
        echo "Terjadi kesalahan pada server.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add Admin</title>
</head>
<body>
    <div class="add-admin-container">
        <h2>Add New Admin</h2>
        <form action="admin_add.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Add Admin</button>
        </form>
    </div>
</body>
</html>
