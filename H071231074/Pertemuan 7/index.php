<?php
session_start();
include './config/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Inisialisasi variabel
$success = "";
$error = "";
$role = $_SESSION['role'];
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Variabel untuk kata kunci pencarian

// Pagination
$perPage = 10;
$queryCount = "SELECT COUNT(*) as total FROM mahasiswa WHERE 
                nama LIKE '%$search%' OR 
                nim LIKE '%$search%' OR 
                prodi LIKE '%$search%' OR 
                fakultas LIKE '%$search%'";
$resultCount = mysqli_query($conn, $queryCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalData = $rowCount['total'];
$totalPages = ceil($totalData / $perPage);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perPage;

// Query untuk mendapatkan data dengan pagination
$queryGet = "SELECT * FROM mahasiswa WHERE 
             nama LIKE '%$search%' OR 
             nim LIKE '%$search%' OR 
             prodi LIKE '%$search%' OR 
             fakultas LIKE '%$search%' 
             ORDER BY id ASC 
             LIMIT $start, $perPage";
$result = mysqli_query($conn, $queryGet);

// Hapus data mahasiswa
if (isset($_GET['action']) && $_GET['action'] == 'delete' && $role == 'admin') {
    $id = $_GET['id'];
    $queryDelete = "DELETE FROM mahasiswa WHERE id='$id'";
    $executeQDelete = mysqli_query($conn, $queryDelete);
    if ($executeQDelete) {
        $success = "Berhasil menghapus data";
    } else {
        $error = "Gagal menghapus data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Menghilangkan garis bawah pada ikon sosial media */
        .social-icon {
            text-decoration: none;
        }

        /* Mengubah warna ikon sosial media saat hover */
        .social-icon:hover {
            color: #f0ad4e; /* Warna hover, bisa disesuaikan */
        }
    </style>
</head>
<body>

    <!-- Navigasi Sidebar -->
    <div class="d-flex">
        <div class="bg-dark p-3 text-white" style="width: 250px; min-height: 100vh;">
            <h4>Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php"><i class="bi bi-table"></i> Data Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="ubah_password.php"><i class="bi bi-key"></i> Ubah Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?action=logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </li>
            </ul>
        </div>

        <!-- Konten Utama -->
        <div class="container my-5">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h2 class="card-title mb-4">Data Mahasiswa</h2>
                    </div>

                    <?php if ($error) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?>

                    <?php if ($success) { ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php } ?>

                    <!-- Form Pencarian Data -->
                    <form action="" method="get" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama, NIM, Program Studi, atau Fakultas..." value="<?php echo $search; ?>">
                            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </form>

                    <!-- Tombol Tambah Data Hanya untuk Admin -->
                    <div class="d-flex justify-content-between mb-3">
                        <?php if ($role == 'admin') { ?>
                            <a href="form.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Data Mahasiswa</a>
                        <?php } ?>
                    </div>

                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Fakultas</th>
                                <?php if ($role == 'admin') { ?>
                                    <th>Aksi</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = $start + 1;
                            while ($data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $data['nim'] . "</td>";
                                echo "<td>" . $data['nama'] . "</td>";
                                echo "<td>" . $data['prodi'] . "</td>";
                                echo "<td>" . $data['fakultas'] . "</td>";

                                // Tombol Edit dan Hapus hanya untuk Admin
                                if ($role == 'admin') {
                                    echo "<td class='text-center'>";
                                    echo "<a href='form.php?action=edit&id=" . $data['id'] . "' class='btn btn-warning btn-sm me-2'><i class='bi bi-pencil'></i> Edit</a>";
                                    echo "<a href='index.php?action=delete&id=" . $data['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='bi bi-trash'></i> Hapus</a>";
                                    echo "</td>";
                                }

                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Navigasi Pagination -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                    <a class="page-link" href="index.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer dengan Tautan Sosial Media -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 mb-3 mb-md-0 text-center text-md-start">
                    <p class="mb-0">© 2024 Muh. Rinaldi Ruslan. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end lh-1">
                    <a href="https://www.instagram.com/rinaldiruslan/" class="text-white me-3 social-icon" target="_blank" aria-label="Instagram">
                        <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                    </a>
                    <a href="https://linkedin.com/in/rinaldiruslan" class="text-white me-3 social-icon" target="_blank" aria-label="LinkedIn">
                        <i class="bi bi-linkedin" style="font-size: 1.5rem;"></i>
                    </a>
                    <a href="https://www.facebook.com/rinaldi.naldi.5220" class="text-white me-3 social-icon" target="_blank" aria-label="Facebook">
                        <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                    </a>
                    <a href="https://github.com/xebec51" class="text-white me-3 social-icon" target="_blank" aria-label="GitHub">
                        <i class="bi bi-github" style="font-size: 1.5rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
