<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" />
    <script
        src="https://kit.fontawesome.com/9ce13b6081.js"
        crossorigin="anonymous"></script>
    <title>Contact</title>
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

    <!-- Main Content -->
    <div class="content-contact">
        <h2>Contact Us</h2>
        <form class="contact-form" action="#" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
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