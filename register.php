<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Register</title>
  </head>
  <body>
    <section class="register">
      <div id="register-page">
        <h2>Register</h2>
        <form action="register_process.php" method="POST">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />

          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />

          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />

          <label for="address">Address</label>
          <textarea id="address" name="address" rows="4" required></textarea>

          <label for="phone">Phone Number</label>
          <input
            type="tel"
            id="phone"
            name="phone"
            pattern="^[0-9]{10,15}$"
            required
          />

          <a href="login.php">Login</a>

          <button type="submit">Register</button>
        </form>
      </div>
    </section>
  </body>
</html>
