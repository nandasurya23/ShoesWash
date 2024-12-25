<?php
$admin_name = 'admin';
$password = 'admin';
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

$conn = new mysqli("localhost", "root", "", "shoes");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "INSERT INTO admins (nama_admin, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $admin_name, $hashed_password);
$stmt->execute();

echo "Admin added successfully!";

$conn->close();
