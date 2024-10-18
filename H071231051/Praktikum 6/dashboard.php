<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: halamanLogin.php");
    exit;
}

$user = $_SESSION['user'];

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: halamanLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image : url('https://i.pinimg.com/originals/2a/5a/6f/2a5a6fd59691cb4b648fcac877e1469e.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: rgba(148, 194, 218, 0.5);
            background-blend-mode: soft-light;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .container {
            height: 500px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top" style="background-color: #94c2da;">
        <div class="container-fluid">
            <?php if ($user['username'] === 'adminxxx'): ?>
            <a class=" navbar-brand text-light fw-bold">
                <?php echo "Welcome, Admin!"; ?>
            </a>
            <?php else: ?>
            <a class="navbar-brand text-light fw-bold">
                <?php echo "Welcome, " . $user['name'] . "!"; ?>
            </a>
            <?php endif; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <form action="dashboard.php?logout=true" method="post">
                    <button name="btnLogin" class="btn btn-outline-light btn-md" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</button>
                    </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container p-4 mt-5">
        <?php if ($user['username'] === 'adminxxx'): ?>
            <div class="card mb-3 mt-4">
                <div class="card-header text-white" style="background-color: #94c2da;">
                    Data Admin
                </div>
                <div class="card-body mt-3 p-0">
                    <ul>
                        <li>Email: <?= $user['email']; ?></li>
                        <li>Username: <?= $user['username']; ?></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-white" style="background-color: #94c2da;">
                    All Users
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Username</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Faculty</th>
                                <th scope="col">Batch</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['users'] as $users): ?>
                                <?php if ($users['username'] !== 'adminxxx'): ?>
                                    <tr>
                                        <td><?= $users['name']; ?></td>
                                        <td><?= $users['email']; ?></td>
                                        <td><?= $users['username']; ?></td>
                                        <td><?= $users['gender'] ?? '-'; ?></td>
                                        <td><?= $users['faculty'] ?? '-'; ?></td>
                                        <td><?= $users['batch'] ?? '-'; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        
        <?php else: ?>
            <table class="table mt-5 ">
                    <tr>
                        <th>Name</th>
                        <td><?= $user['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $user['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td><?= $user['username']; ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?= $user['gender'] ?? '-'; ?></td>
                    </tr>
                    <tr>
                        <th>Faculty</th>
                        <td><?= $user['faculty'] ?? '-'; ?></td>
                    </tr>
                    <tr>
                        <th>Batch</th>
                        <td><?= $user['batch'] ?? '-'; ?></td>
                    </tr>
            </table>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
