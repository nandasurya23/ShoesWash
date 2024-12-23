<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Ambil nama admin dari session
$admin_username = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="admin-dashboard">
        <h2>Welcome, Admin <?= htmlspecialchars($admin_username) ?></h2>
        <p>You are logged in as an admin.</p>
        
        <div class="admin-actions">
            <a href="admin_profile.php"><button>View Admin Profile</button></a>
            <a href="user_management.php"><button>User Management</button></a>
            <a href="logout.php"><button>Logout</button></a>
        </div>
    </div>
</body>
</html>
