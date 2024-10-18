<?php
session_start();

// Ambil data user dari session
if (isset($_SESSION['users'])) {
    $users = $_SESSION['users'];
} else {
    header("Location: register.php");
    exit;
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];
    $error = "";

    foreach ($users as $user) {
        if (($user['email'] === $email_or_username || $user['username'] === $email_or_username) 
            && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = "Email atau kata sandi salah!";
}
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
      <div class="col-md-4">
        <div class="card p-4 shadow-sm">
          <h1 class="text-center mb-4">Masuk</h1>
          <form method="POST" action="">
            <div class="mb-3">
              <label for="email_or_username" class="form-label">Email atau Username</label>
              <input type="text" class="form-control" id="email_or_username" name="email_or_username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Kata Sandi</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php endif; ?>
          </form>
          <div class="mt-3 text-center">
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
