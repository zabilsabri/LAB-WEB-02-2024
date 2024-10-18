<?php
session_start();

// Data pengguna admin
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('caca123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'khalika@gmail.com',
        'username' => 'khalika',
        'name' => 'Khalika Tsabitah Malik',
        'password' => password_hash('caca', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2023',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2002',
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
    ],
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_email_or_username = $_POST['email_or_username'];
    $input_password = $_POST['password'];

    foreach ($users as $user) {
        if (($user['email'] === $input_email_or_username || $user['username'] === $input_email_or_username) 
        && password_verify($input_password, $user['password'])) {
            $_SESSION['user'] = $user;
            if ($user['name'] === 'Admin') {
                $_SESSION['users'] = $users;
            }
            header('Location: dashboard.php');
            exit;
        }
    }
    $error = 'Invalid login credentials';
}

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="login-container">
        <div class="form-container">
            <h1>Log In to <br> Your Account</h1>
            <form method="POST">
                <label for="email_or_username">Email or Username</label><br>
                <input type="text" name="email_or_username" id="email_or_username" required><br>

                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" required><br><br>

                <button type="submit" name="login">Log In</button>
            </form>
            <?php if ($error != ''): ?>
                <div><?php echo $error; ?></div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>