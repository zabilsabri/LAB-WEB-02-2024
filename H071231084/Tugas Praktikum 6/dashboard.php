<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

if ($_SESSION['user']['name'] === 'Admin') {
    $users = $_SESSION['users'];
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <?php if ($user['name'] != 'Admin'): ?>
        <div class="user-container">
            <div>
                <h1>Hello,</h1>
                <h1><?php echo explode(' ', $user['name'])[0]; ?>!</h1>
                <div class="profile">
                    <div class="profile-title">
                        <p>Full Name: </p>
                        <p>Email: </p>
                        <p>Username: </p>
                        <p>Gender: </p>
                        <p>Faculty: </p>
                        <p>Batch:</p>
                    </div>
                    <div>
                        <p><?php echo $user['name']; ?></p>
                        <p><?php echo $user['email']; ?></p>
                        <p><?php echo $user['username']; ?></p>
                        <p><?php echo $user['gender']; ?></p>
                        <p><?php echo $user['faculty']; ?></p>
                        <p><?php echo $user['batch']; ?></p>
                    </div>
                </div>
                <br>
                <a href="?logout=true" class="button-logout">Log Out</a>
            </div>
            <div>
                <img src="assets/user.png" alt="user">
            </div>
        </div>
    <?php else: ?>
        <div class="admin-header">
            <div>
                <h1>Welcome, <?php echo $user['name']; ?>!</h1> <br>
                <a href="?logout=true" class="button-logout">Log Out</a>
            </div>
            <div>
                <img src="assets/admin.png" alt="admin">
            </div>
        </div>
        <div class="user-profile-list">
            <h3>User's Profile List</h3>
            <div class="table-container">
                <table class="table-striped">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Faculty</th>
                        <th>Batch</th>
                    </tr>
                    <?php foreach ($users as $usr): ?>
                        <?php if ($usr['name'] != 'Admin'): ?>
                            <tr>
                                <td><?php echo $usr['name']; ?></td>
                                <td><?php echo $usr['email']; ?></td>
                                <td><?php echo $usr['username']; ?></td>
                                <td><?php echo $usr['gender']; ?></td>
                                <td><?php echo $usr['faculty']; ?></td>
                                <td><?php echo $usr['batch']; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    <?php endif; ?>
    </div>
</body>
</html>