<?php
session_start();
include 'config/conn.php';

echo '<script src="js/sweetalert2.min.js"></script>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['msg'] = "Password salah!";
            $_SESSION['icon'] = "error";
            header('Location: login.php');
            exit;
        }
    } else {
        $_SESSION['msg'] = "Pengguna tidak ditemukan!";
        $_SESSION['icon'] = "error";
        header('Location: login.php');
        exit;
    }

    $stmt->close();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<style>
    body {
        background-image: url("https://i.pinimg.com/564x/d9/94/40/d994408de42ff730ee26a4aa861ba6d2.jpg");
        background-size: cover;
        background-position: center;
        height: 100%;
    }
    .col-6 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 1rem 0 0 1rem;
    }
</style>
<body style="height: 100vh;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-10 col-lg-8 col-xl-9">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row">
                        <div class="col-6">
                            <img src="https://i.pinimg.com/736x/5e/e2/64/5ee2647c2c50a098ed47a1335ca23172.jpg" alt="image">
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <div class="card-body p-4 text-center login-form">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="mb-5">Please enter your login and password!</p>
                                <form action="" method="POST">
                                    <div class="form-label-group outline">
                                        <input type="text" name="email" class="form-control" placeholder="Username or Email" required>
                                        <span><label>Username or Email</label></span>
                                    </div>
                                    <div class="form-label-group outline">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        <span><label>Password</label></span>
                                    </div>
                                    <button class="btn btn-outline-primary btn-md px-4 m-3" type="submit">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                                    </button>
                                </form>
                                <p class="mb-0">Don't have an account? 
                                    <a href="registration.php" class="fw-bold">Register</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert script untuk menampilkan pesan error -->
    <script src="js/sweetalert2.min.js"></script>
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
</body>
</html>