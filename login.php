<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <section class="register">
      <div id="login-page">
        <h2>Login</h2>
        <form action="login_process.php" method="POST">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />

          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />

          <a href="register.php">Register</a>

          <button type="submit">Login</button>
        </form>
      </div>
    </section>
  </body>
</html>
