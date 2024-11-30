<?php
include "config/conn.php";
session_start(); 

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$success = "";
$error = "";

$role = $_SESSION['role'] ?? 'Student'; 
$username = $_SESSION['username'] ?? 'Guest';
$email = $_SESSION['email'] ?? 'Not Available';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; 
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$queryTotalRows = "SELECT COUNT(*) as total FROM student WHERE nama LIKE '%$search%'";
$resultTotalRows = mysqli_query($conn, $queryTotalRows);
$row = mysqli_fetch_assoc($resultTotalRows);
$totalRows = $row['total'];

$totalPages = ceil($totalRows / $limit);

$queryGetAll = "SELECT * FROM student WHERE nama LIKE '%$search%' ORDER BY id ASC LIMIT $limit OFFSET $offset";
$executeQGetAll = mysqli_query($conn, $queryGetAll);

if ($role == 'admin' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $queryDelete = "DELETE FROM student WHERE id='$id'";
    $executeQDelete = mysqli_query($conn, $queryDelete);
    if ($executeQDelete) {
        header("Location: dashboard.php?success=Data berhasil dihapus");
        exit();
    } else {
        header("Location: dashboard.php?error=Gagal menghapus data");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand">
                <?= "Hi, " . $username . "!"; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-outline-light">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 pt-5 mb-5">
        <?php if ($error) { ?>
            <div class="alert alert-danger mt-3"><?= $error; ?></div>
        <?php } ?>

        <?php if ($success) { ?>
            <div class="alert alert-success mt-3"><?= $success; ?></div>
        <?php } ?>

        <div class="card mt-1">
            <div class="card-header bg-dark text-white">Data Mahasiswa</div>
            <div class="card-body" >
                <div class="d-flex align-items-center mb-1">
                    <form class="d-flex flex-grow-1" method="GET" action="dashboard.php">
                        <input type="text" name="search" class="form-control w-100 me-2" placeholder="Cari Nama Mahasiswa" value="<?= htmlspecialchars($search); ?>">
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </form>

                    <?php if ($role == 'admin') { ?>
                        <a href="index.php" class="btn btn-outline-success ms-1">Add</a>
                    <?php } ?>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Program Studi</th>
                            <?php if ($role == 'admin') { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $number = $offset + 1;
                        while ($data = mysqli_fetch_array($executeQGetAll)) {
                            $id = $data['id'];
                        ?>
                            <tr>
                                <td><?= $number++ ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['nim'] ?></td>
                                <td><?= $data['prodi'] ?></td>
                                <?php if ($role == 'admin') { ?>
                                    <td>
                                        <a href="index.php?action=edit&id=<?= $id ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="dashboard.php?action=delete&id=<?= $id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1) { ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Sebelumnya</a></li>
                        <?php } ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                            <li class="page-item <?php if ($i == $page) echo 'active' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php } ?>

                        <?php if ($page < $totalPages) { ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Berikutnya</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
