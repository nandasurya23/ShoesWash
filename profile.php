<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Data pengguna dari session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];
$phone = $_SESSION['phone'];

// Status mode (hanya bisa update saat tombol "Update Profile" ditekan)
$updateMode = isset($_GET['update']) ? true : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/9ce13b6081.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <title>User Profile</title>
</head>
<body>
  <!-- Profile Page -->
  <div class="profile-page">
    <div class="profile-container">
      <h2>User Profile</h2>

      <!-- Detail profil -->
      <div class="profile-info">
        <p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($address) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
      </div>

      <!-- Tombol Update -->
      <?php if (!$updateMode): ?>
        <div class="edit-profile">
          <a href="profile.php?update=1">
            <button class="update-btn">Update Profile</button>
          </a>
        </div>
      <?php endif; ?>

      <div class="back-to-home">
        <a href="index.php">
          <button>Back to Home</button>
        </a>
      </div>

      <!-- Form Update -->
      <?php if ($updateMode): ?>
        <form id="profile-form" action="profile_process.php" method="POST" class="update-profile-form">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>" required>
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required>
          </div>

          <div class="form-group">
            <label for="address">Address:</label>
            <textarea name="address" id="address" required><?= htmlspecialchars($address) ?></textarea>
          </div>

          <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" id="phone" pattern="^[0-9]{10,15}$" value="<?= htmlspecialchars($phone) ?>" required>
          </div>

          <div class="update-profile-buttons">
            <button type="submit">Save</button>
            <a href="profile.php">
              <button type="button">Cancel</button>
            </a>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
