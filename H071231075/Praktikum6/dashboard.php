<?php
session_start();

// Memeriksa apakah user sudah login dan bukan admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header('Location: index.php');
    exit;
}

// Mendapatkan data user dari session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome, <?php echo $user['name']; ?>!</h1>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
        <p><strong>Faculty:</strong> <?php echo $user['faculty']; ?></p>
        <p><strong>Batch:</strong> <?php echo $user['batch']; ?></p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
