<?php
session_start();

// Cek apakah ada data users dalam session
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit;
}

$users = $_SESSION['users']; // Mengambil data users

// Logout logic
if (isset($_GET['logout'])) {
    unset($_SESSION['user']); 
    header("Location: login.php"); 
    exit;
}

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user']; // Mengambil data user yang login
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard Pengguna</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php?logout=true">Keluar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Selamat datang, <?php echo htmlspecialchars($user['name']); ?></h1>
          <?php if ($user['username'] == 'adminxxx'): ?>
            <h2 class="mt-4">Semua Pengguna</h2>
            <div class="row">
              <?php foreach ($users as $user_data): ?>
                <div class="col-md-4 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo htmlspecialchars($user_data['name']); ?></h5>
                      <p class="card-text">Email: <?php echo htmlspecialchars($user_data['email']); ?></p>
                      <p class="card-text">Username: <?php echo htmlspecialchars($user_data['username']); ?></p>
                      <p class="card-text">Jenis Kelamin: <?php echo htmlspecialchars($user_data['gender'] ?? '-'); ?></p>
                      <p class="card-text">Fakultas: <?php echo htmlspecialchars($user_data['faculty'] ?? '-'); ?></p>
                      <p class="card-text">Angkatan: <?php echo htmlspecialchars($user_data['batch'] ?? '-'); ?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <h2 class="mt-4">Data Anda</h2>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($user['name']); ?></h5>
                <p class="card-text">Email: <?php echo htmlspecialchars($user['email']); ?></p>
                <p class="card-text">Username: <?php echo htmlspecialchars($user['username']); ?></p>
                <p class="card-text">Jenis Kelamin: <?php echo htmlspecialchars($user['gender'] ?? '-'); ?></p>
                <p class="card-text">Fakultas: <?php echo htmlspecialchars($user['faculty'] ?? '-'); ?></p>
                <p class="card-text">Angkatan: <?php echo htmlspecialchars($user['batch'] ?? '-'); ?></p>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
