<?php
require_once 'config.php';
require_login();

$current_user = $_SESSION['user'];
$is_admin = is_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f7f6;
            color: #333;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 32px;
            color: #0056b3;
        }
        .welcome {
            font-size: 28px;
            margin-bottom: 10px;
            color: #007bff;
        }
        .user-info {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .logout {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .logout:hover {
            background-color: #c82333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        @media (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            th, td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            th::before, td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <h1>Dashboard <?php echo $is_admin ? 'Admin' : 'User'; ?></h1>

    <div class="welcome">Welcome, <?php echo htmlspecialchars($current_user['name']); ?>!</div>

    <div class="user-info">
        <p><strong>Email:</strong> <?php echo htmlspecialchars($current_user['email']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($current_user['username']); ?></p>
        <?php if (!$is_admin): ?>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($current_user['gender']); ?></p>
            <p><strong>Faculty:</strong> <?php echo htmlspecialchars($current_user['faculty']); ?></p>
            <p><strong>Batch:</strong> <?php echo htmlspecialchars($current_user['batch']); ?></p>
        <?php endif; ?>
    </div>

    <?php if ($is_admin): ?>
        <h2>All Users</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Faculty</th>
                <th>Batch</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <?php if ($user['username'] !== 'adminxxx'): ?>
                    <tr>
                        <td data-label="Name"><?php echo htmlspecialchars($user['name']); ?></td>
                        <td data-label="Email"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td data-label="Username"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td data-label="Gender"><?php echo htmlspecialchars($user['gender']); ?></td>
                        <td data-label="Faculty"><?php echo htmlspecialchars($user['faculty']); ?></td>
                        <td data-label="Batch"><?php echo htmlspecialchars($user['batch']); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <a href="logout.php" class="logout">Logout</a>
</body>
</html>
