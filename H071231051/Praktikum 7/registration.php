<?php
session_start();
include "./config/conn.php";
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $role = 'student';

    $sql_check = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $_SESSION['msg'] = "Username atau email sudah terdaftar!";
        $_SESSION['icon'] = "error";
    } else {
        $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $password, $email, $role);

        if ($stmt->execute()) {
            $_SESSION['msg'] = "Registrasi berhasil!";
            $_SESSION['icon'] = "success";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['msg'] = "Error: " . $stmt->error;
            $_SESSION['icon'] = "error";
        }
        $stmt->close();
    }
    $stmt_check->close();
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Registrasi | Users</title>
</head>
<style>
    body{
        background-image: url("https://i.pinimg.com/564x/d9/94/40/d994408de42ff730ee26a4aa861ba6d2.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
<body>
    <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <h2 class="fw-bold mb-2 text-uppercase">Registrasi</h2>
                        <p class="text-xl mb-5">Silakan masukkan username, email, dan password Anda!</p>
                        
                        <form method="POST" action="">
                            <div class="form-label-group mb-4">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-label-group mb-4">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-label-group mb-4">
                                <input type="password" name="password" class="form-control toggle-password" placeholder="Password" minlength="8" required>
                            </div>
                            <div>
                                <input type="checkbox" class="toggle" onclick="togglePasswordVisibility()">
                                <label>show the Password</label>
                            </div>
                            
                            <button name="btnRegister" class="btn btn-outline-primary btn-md px-4 mt-3" type="submit">Daftar</button>
                        </form>

                        <p class="mb-0 mt-4">Sudah punya akun?
                            <a href="login.php" class="text-xl fw-bold">Masuk</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.querySelector('.toggle-password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
    <?php if (isset($_SESSION['msg']) && isset($_SESSION['icon'])): ?>
        <script>
            Swal.fire({
                title: "<?php echo $_SESSION['msg']; ?>",
                icon: "<?php echo $_SESSION['icon']; ?>",
            });
        </script>
        <?php 
        unset($_SESSION['msg']);
        unset($_SESSION['icon']);
        ?>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
