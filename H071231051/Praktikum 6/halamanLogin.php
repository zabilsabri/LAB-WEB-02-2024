<?php
session_start();
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ]
];

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST['email_username'];
    $password = $_POST['password'];
    foreach ($users as $user) {
        if (($user['email'] === $input || $user['username'] === $input) && password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['users'] = $users;
            setcookie('nama',$user['username']);
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = "Email/Username atau password salah!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #94c2da;
            font-family: Georgia, 'Times New Roman', Times, serif;
            height: 100vh;
        }

        .container {
            min-height: 100vh;
        }

        .col-6:first-child {
            background-image: url('https://i.pinimg.com/control/564x/8a/b8/47/8ab847f3c1b2e755ed4229b009421c97.jpg');
            background-size: cover;
            background-position: center;
            border-radius : 20px 0 0 20px;
        }

    </style>
</head>
<body>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="card card-box" style="border-radius: 1rem; width: 100%; max-width: 700px;">
                <div class="card-body m-0 p-0 text-center">
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6 p-5">
                            <h4 class="d-flex justify-content-center align-items-center mb-5">Welcome in Login Page</h4> 
                            <?php if ($error): ?>
                                <p class="error text-danger"><?= $error ?></p>
                            <?php endif; ?>
                            <form method="POST" action="">
                                <input class="form-control border border-secondary mb-3" type="text" placeholder="input your email/username" name="email_username" id="email_username" aria-label="default input example" required>
                                <input class="form-control border border-secondary mb-5" type="password" placeholder="input your password" name="password" id="password" aria-label="default input example" required>
                                <button name="btnLogin" class="btn btn-outline-primary btn-md" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
