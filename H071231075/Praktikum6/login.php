<?php
session_start();

$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
        'role' => 'admin',
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
        'role' => 'user',
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
    ],

];

// Mengambil data dari form login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Memeriksa apakah pengguna ada dalam data $users
$loggedInUser = null;
foreach ($users as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password'])) {
        $loggedInUser = $user;
        break;
    }
}

// Jika pengguna ditemukan, set session dan redirect ke dashboard yang sesuai
if ($loggedInUser) {
    $_SESSION['user'] = $loggedInUser;

    setcookie('name','fauzan');

    if ($loggedInUser['role'] === 'admin') {
        header('Location: dashboard_admin.php');
    } else {
        header('Location: dashboard.php');
    }
    exit;
} else {
    header('Location: index.php');
    exit;
}
?>
