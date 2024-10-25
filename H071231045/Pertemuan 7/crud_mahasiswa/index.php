<?php
include 'db.php';
session_start();

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];

// Tambah data mahasiswa untuk admin
$duplicate_error = "";
if ($role == 'admin' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Cek apakah data yang sama persis sudah ada
    $check_duplicate = $conn->prepare("SELECT * FROM mahasiswa WHERE nama = ? AND nim = ? AND prodi = ?");
    $check_duplicate->bind_param('sss', $nama, $nim, $prodi);
    $check_duplicate->execute();
    $result = $check_duplicate->get_result();

    if ($result->num_rows > 0) {
        // Jika ada duplikasi, tampilkan pesan error
        $duplicate_error = "Data Sudah Ada, Anda Tidak Bisa Menginput Data Yang Sama!";
    } else {
        $query = $conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)");
        $query->bind_param('sss', $nama, $nim, $prodi);
        $query->execute();
    }
}

// Edit data mahasiswa untuk admin
if ($role == 'admin' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Update data mahasiswa
    $update_query = $conn->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id = ?");
    $update_query->bind_param('sssi', $nama, $nim, $prodi, $id);
    $update_query->execute();
    header("Location:index.php");
}

// Hapus data mahasiswa untuk admin
if ($role == 'admin' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM mahasiswa WHERE id = $id");
}

// Pencarian data mahasiswa
$search_query = "";
if (isset($_GET['search'])) {
    $search_term = $_GET['search_term'];
    $search_query = " WHERE nama LIKE ? OR nim LIKE ? OR prodi LIKE ?";
}

// Tampilkan data mahasiswa
$result = $conn->prepare("SELECT * FROM mahasiswa" . $search_query);
if ($search_query) {
    $like_term = "%$search_term%";
    $result->bind_param('sss', $like_term, $like_term, $like_term);
}
$result->execute();
$result = $result->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Data Mahasiswa</h2>

        <!-- Tampilkan pesan error jika ada duplikasi -->
        <?php if ($duplicate_error != "") { ?>
            <p class="error"><?= $duplicate_error; ?></p>
        <?php } ?>

        <!-- Form Input hanya untuk Admin -->
        <?php if ($role == 'admin') { ?>
            <form method="POST" action="">
                <label>Nama:</label>
                <input type="text" name="nama" required>
                <label>NIM:</label>
                <input type="text" name="nim" required>
                <label>Program Studi:</label>
                <input type="text" name="prodi" required>
                <button type="submit" name="tambah">Tambah Data</button>
            </form>
        <?php } ?>

        <!-- Form Pencarian -->
        <form method="GET" action="" style="margin-top: 20px;">
            <label>Cari Mahasiswa:</label>
            <input value = "<?= $_GET ["search_term"] ?? '' ?>"type="text" name="search_term" placeholder="Masukkan nama, NIM, atau prodi" required>
            <button type="submit" name="search">Cari</button>
        </form>

        <!-- Tabel Data Mahasiswa -->
        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <?php if ($role == 'admin') { ?>
                    <th>Aksi</th>
                <?php } ?>
            </tr>
            <?php if ($result->num_rows > 0) { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['nim']; ?></td>
                        <td><?= $row['prodi']; ?></td>
                        <?php if ($role == 'admin') { ?>
                            <td>
                                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                                <a> || </a>
                                <a href="?edit=<?= $row['id']; ?>">Edit</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <!-- Pesan jika data tidak ditemukan -->
                <tr>
                    <td colspan="4" style="text-align: center;">Data tidak ditemukan.</td>
                </tr>
            <?php } ?>
        </table>

        <!-- Form Edit hanya untuk Admin -->
        <?php if ($role == 'admin' && isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
            $edit_query->bind_param('i', $edit_id);
            $edit_query->execute();
            $edit_result = $edit_query->get_result();
            $edit_row = $edit_result->fetch_assoc();
            ?>
            <h3>Edit Data Mahasiswa</h3>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $edit_row['id']; ?>">
                <label>Nama:</label>
                <input type="text" name="nama" value="<?= $edit_row['nama']; ?>" required>
                <label>NIM:</label>
                <input type="text" name="nim" value="<?= $edit_row['nim']; ?>" required>
                <label>Program Studi:</label>
                <input type="text" name="prodi" value="<?= $edit_row['prodi']; ?>" required>
                <button type="submit" name="edit">Update Data</button>
            </form>
        <?php } ?>

        <!-- Tombol Logout -->
        <div class="logout">
            <a href="?logout=true">Logout</a>
        </div>
    </div>
</body>
</html>
