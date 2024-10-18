<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = $_POST['gender'];
    $faculty = $_POST['faculty'];
    $batch = $_POST['batch'];

    $new_user = [
        'name' => $name,
        'email' => $email,
        'username' => $username,
        'password' => $password,
        'gender' => $gender,
        'faculty' => $faculty,
        'batch' => $batch,
    ];


    $_SESSION['users'][] = $new_user; // Tambahkan user baru ke session

    // Redirect ke login page setelah register
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
      <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
          <div class="card p-4 shadow-sm">
            <h1 class="text-center mb-4">Daftar</h1>
            <form method="POST" action="">
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="gender" name="gender">
                  <option value="Male">Laki-laki</option>
                  <option value="Female">Perempuan</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="faculty" class="form-label">Fakultas</label>
                <input type="text" class="form-control" id="faculty" name="faculty" required>
              </div>
              <div class="mb-3">
                <label for="batch" class="form-label">Angkatan</label>
                <input type="text" class="form-control" id="batch" name="batch" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
            <div class="mt-3 text-center">
              <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
