<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: profile.php');
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Ambil data dari form
$new_username = $_POST['username'];
$new_email = $_POST['email'];
$new_address = $_POST['address'];
$new_phone = $_POST['phone'];

// Koneksi database
$servername = "localhost";  // Ganti dengan server Anda jika perlu
$username = "root";         // Ganti dengan username database Anda
$password = "";             // Ganti dengan password database Anda
$dbname = "shoes";  // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update database
$user_id = $_SESSION['user_id'];
$query = "UPDATE users SET username = ?, email = ?, address = ?, phone = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssssi', $new_username, $new_email, $new_address, $new_phone, $user_id);

if ($stmt->execute()) {
    // Update session
    $_SESSION['username'] = $new_username;
    $_SESSION['email'] = $new_email;
    $_SESSION['address'] = $new_address;
    $_SESSION['phone'] = $new_phone;

    // Redirect ke detail profil
    header('Location: profile_detail.php');
    exit;
} else {
    echo "Gagal memperbarui profil.";
}

// Menutup koneksi
$conn->close();
?>
