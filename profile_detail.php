<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Ambil data pengguna dari session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];
$phone = $_SESSION['phone'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/9ce13b6081.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <title>Profile Details</title>
</head>
<body>

  <!-- Profile Details Section -->
  <div class="profile-page">
    <div class="profile-container">
      <h2>Profile Details</h2>

      <!-- User Information -->
      <div class="profile-info">
        <p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($address) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
      </div>

      <!-- Button to Update Profile -->
      <div class="edit-profile">
        <a href="profile.php?update=1">
          <button>Update Profile</button>
        </a>
      </div>

      <!-- Button to go back to Index -->
      <div class="back-to-home">
        <a href="index.php">
          <button>Back to Home</button>
        </a>
      </div>

      <!-- Button to Logout -->
      <div class="logout-button">
        <a href="logout.php">
          <button>Logout</button>
        </a>
      </div>
    </div>
  </div>

</body>
</html>
