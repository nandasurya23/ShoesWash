<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header('Location: admin_dashboard.php');
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);

    include 'db.php';

    $query = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('s', $input_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();

            if (password_verify($input_password, $admin['password'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: admin_dashboard.php');
                exit;
            } else {
                $error_message = 'Password salah.';
            }
        } else {
            $error_message = 'Username tidak ditemukan.';
        }

        $stmt->close();
    }

    $conn->close();
}
?>
