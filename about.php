<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="styles.css" />
    <script
        src="https://kit.fontawesome.com/9ce13b6081.js"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar -->
    <nav>
        <h1 class="logo">ShoeCare Pro</h1>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="transaksi.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="user-info">
            <a href="<?= $isLoggedIn ? 'profile.php' : 'login.php' ?>">
                <i class="fa-solid fa-user"></i>
            </a>
        </div>
    </nav>

    <!-- About Section -->
    <div class="about-section">
        <h1 style="margin-top: 80px;">About ShoeCare Pro</h1>
        <p>Your trusted partner in shoe cleaning and care!</p>
    </div>
    <div class="content">
        <h2>Who We Are</h2>
        <p>
            At <strong>ShoeCare Pro</strong>, we specialize in bringing your favorite footwear back to life. From sneakers to formal shoes, we handle every pair with the utmost care and professionalism.
        </p>
        <h3>Why Choose Us?</h3>
        <ul>
            <li>Experienced team with a passion for shoes</li>
            <li>Modern cleaning techniques and eco-friendly materials</li>
            <li>Affordable and transparent pricing</li>
        </ul>
        <p>Trust us to make your shoes shine again!</p>

    </div>

    <!-- Footer -->
    <footer style="position: fixed;">
        <div class="footer-content">
            <div class="footer-left">
                <h2>ShoeCare Pro</h2>
                <p>&copy; 2024 ShoeCare Pro. All rights reserved.</p>
            </div>
            <div class="footer-middle">
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="transaksi.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-right">
                <h3>Follow Us</h3>
                <div class="social-media-icons">
                    <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>