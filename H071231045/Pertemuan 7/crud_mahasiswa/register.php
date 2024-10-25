<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Cek apakah username sudah ada
    $checkQuery = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkQuery->bind_param('s', $username);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        // Masukkan pengguna baru ke database
        $query = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $query->bind_param('sss', $username, $password, $role);
        if ($query->execute()) {
            header('Location: login.php');
            exit;
        } else {
            $error = "Pendaftaran gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <label>Role:</label>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="mahasiswa">Mahasiswa</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <?php if (isset($error)) { echo '<p class="error">'.$error.'</p>'; } ?>
        <p>Sudah punya akun? <a href="login.php">Kembali</a></p>
    </div>
</body>
</html>
