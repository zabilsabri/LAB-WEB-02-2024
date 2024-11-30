<?php
session_start();
include './config/config.php';

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Inisialisasi variabel
$error = "";
$success = "";
$nama = "";
$nim = "";
$prodi = "";
$fakultas = "";
$executeQInsert = false;

$action = isset($_GET['action']) ? $_GET['action'] : 'tambah';

// Jika mode edit, ambil data dari database berdasarkan ID
if ($action == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $queryGet = "SELECT * FROM mahasiswa WHERE id = ?";
    $stmtGet = mysqli_prepare($conn, $queryGet);
    mysqli_stmt_bind_param($stmtGet, "i", $id);
    mysqli_stmt_execute($stmtGet);
    $result = mysqli_stmt_get_result($stmtGet);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $nama = $data['nama'];
        $nim = $data['nim'];
        $prodi = $data['prodi'];
        $fakultas = $data['fakultas'];
    } else {
        $error = "Data tidak ditemukan!";
    }
    mysqli_stmt_close($stmtGet);
}

// Jika form disubmit
if (isset($_POST['save'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $fakultas = $_POST['fakultas'];

    // Validasi input
    if ($nama && $nim && $prodi && $fakultas) {
        $queryCheckNIM = "SELECT * FROM mahasiswa WHERE nim = ?";
        $stmtCheckNIM = mysqli_prepare($conn, $queryCheckNIM);
        mysqli_stmt_bind_param($stmtCheckNIM, "s", $nim);
        mysqli_stmt_execute($stmtCheckNIM);
        $resultCheckNIM = mysqli_stmt_get_result($stmtCheckNIM);

        if (mysqli_num_rows($resultCheckNIM) > 0 && $action != 'edit') {
            $error = "NIM $nim sudah terdaftar! Gunakan NIM yang baru!";
        } else {
            if ($action == 'edit' && isset($id)) {
                $queryUpdate = "UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ?, fakultas = ? WHERE id = ?";
                $stmtUpdate = mysqli_prepare($conn, $queryUpdate);
                mysqli_stmt_bind_param($stmtUpdate, "ssssi", $nama, $nim, $prodi, $fakultas, $id);
                $executeQUpdate = mysqli_stmt_execute($stmtUpdate);

                if ($executeQUpdate) {
                    $success = "Data berhasil diperbarui!";
                    header("Location: index.php?success=$success");
                    exit();
                } else {
                    $error = "Data gagal diperbarui!";
                }
                mysqli_stmt_close($stmtUpdate);
            } else {
                $queryInsert = "INSERT INTO mahasiswa (nama, nim, prodi, fakultas) VALUES (?, ?, ?, ?)";
                $stmtInsert = mysqli_prepare($conn, $queryInsert);
                mysqli_stmt_bind_param($stmtInsert, "ssss", $nama, $nim, $prodi, $fakultas);
                $executeQInsert = mysqli_stmt_execute($stmtInsert);

                // Jika data mahasiswa berhasil ditambahkan, buat akun otomatis
                if ($executeQInsert) {
                    $username = $nim;
                    $initialPassword = password_hash('000000', PASSWORD_DEFAULT);
                    $role = 'mahasiswa';

                    $queryCreateUser = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
                    $stmtCreateUser = mysqli_prepare($conn, $queryCreateUser);
                    mysqli_stmt_bind_param($stmtCreateUser, "sss", $username, $initialPassword, $role);
                    mysqli_stmt_execute($stmtCreateUser);
                    mysqli_stmt_close($stmtCreateUser);

                    $success = "Data mahasiswa berhasil ditambahkan!";
                    header("Location: index.php?success=$success");
                    exit();
                } else {
                    $error = "Data gagal ditambahkan!";
                }
                mysqli_stmt_close($stmtInsert);
            }
        }
        mysqli_stmt_close($stmtCheckNIM);
    } else {
        $error = "Semua field harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4"><?php echo $action == 'edit' ? 'Edit' : 'Tambah'; ?> Data Mahasiswa</h3>

                        <?php if ($error) { ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>

                        <form action="" method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim; ?>" required>
                                <div class="invalid-feedback">
                                    NIM harus diisi!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
                                <div class="invalid-feedback">
                                    Nama harus diisi!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="prodi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control" id="prodi" name="prodi" value="<?php echo $prodi; ?>" required>
                                <div class="invalid-feedback">
                                    Program Studi harus diisi!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="fakultas" class="form-label">Fakultas</label>
                                <input type="text" class="form-control" id="fakultas" name="fakultas" value="<?php echo $fakultas; ?>" required>
                                <div class="invalid-feedback">
                                    Fakultas harus diisi!
                                </div>
                            </div>
                            <button type="submit" name="save" class="btn btn-primary w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk validasi form
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
