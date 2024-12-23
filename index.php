<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$username = $isLoggedIn ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/9ce13b6081.js"
      crossorigin="anonymous"
    ></script>
    <title>ShoeCare Pro</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav>
      <h1 class="logo">ShoeCare Pro</h1>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
      <!-- Tampilkan ikon user -->
      <div class="user-info">
        <a href="<?= $isLoggedIn ? 'profile.php' : 'login.php' ?>">
          <i class="fa-solid fa-user"></i>
        </a>
      </div>
    </nav>

    <!-- Main Page Content -->
    <section class="hero">
      <img src="img/hero.png" alt="" class="hero-bg" />
      <div class="main-page">
        <h1 class="hero-header">Welcome to ShoeCare Pro</h1>
        <p class="hero-text">
          Your trusted partner in keeping your shoes clean and fresh. We provide
          professional shoe cleaning services for all types of shoes, ensuring
          they look as good as new.
        </p>

        <!-- Tampilkan tombol hanya jika user belum login -->
        <?php if (!$isLoggedIn): ?>
          <div class="btn-hero">
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
          </div>
        <?php endif; ?>
      </div>
    </section>
        <!-- OUR SERVICE -->
        <section class="service">
      <h1>OUR PRICELIST</h1>
      <div class="container">
        <div class="container-price">
          <div class="price">
            CLEANING DETAILS
            <p>20k - 60k</p>
          </div>
          <div class="detail-service">
            <i class="fa-solid fa-check"></i>
            <p>Easy Peasy Clean</p>
          </div>
          <div class="detail-service">
            <i class="fa-solid fa-check"></i>
            <p>Easy Clean</p>
          </div>
          <div class="detail-service">
            <i class="fa-solid fa-check"></i>
            <p>Medium Clean</p>
          </div>
          <div class="detail-service">
            <i class="fa-solid fa-check"></i>
            <p>Hard Clean</p>
          </div>
          <div class="rate">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
          </div>
        </div>
      </div>
    </section>
    <!-- ABOUT -->
    <section class="container-about">
      <h1>ABOUT</h1>
      <div class="about">
        <!-- <img src="/img/bg12.png" alt="" /> -->
        <h3>
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora
          cupiditate unde iste! Neque, sequi, dolore sapiente soluta, illum et
          nesciunt dolorem nam officia reprehenderit minima beatae ipsum
          voluptates id accusantium.
        </h3>
      </div>
    </section>
  </body>
</html>
