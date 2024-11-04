<?php 
include 'config/conn.php';

$success = "";
$error = "";

if(isset($_GET['success'])) {
    $success = $_GET['success'];
}

if (isset($_GET['error'])) {
    $error = $_GET['error'];
}

$action = "";
$id = "";
$nama = "";
$nim = "";
$programStudi = "";

if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $queryEdit = "SELECT * FROM student WHERE id=?";
    $stmtEdit = $conn->prepare($queryEdit);
    $stmtEdit->bind_param("i", $id);
    $stmtEdit->execute();
    $resultEdit = $stmtEdit->get_result();
    $data = $resultEdit->fetch_assoc();
    
    if ($data) {
        $nim = $data['nim'];
        $nama = $data['nama'];
        $programStudi = $data['prodi'];
    }
    $stmtEdit->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $programStudi = $_POST['programStudi'];

    if ($id) {
        $queryCheckNim = "SELECT * FROM student WHERE nim = ?";
        $stmtCheckNim = $conn->prepare($queryCheckNim);
        $stmtCheckNim->bind_param("s", $nim);
        $stmtCheckNim->execute();
        $resultCheckNim = $stmtCheckNim->get_result();

        if ($resultCheckNim->num_rows > 0) {
            $error = "Gagal menambahkan data, NIM sudah ada.";
        } else {
            $queryUpdate = "UPDATE student SET nim=?, nama=?, prodi=? WHERE id=?";
            $stmtUpdate = $conn->prepare($queryUpdate);
            $stmtUpdate->bind_param("sssi", $nim, $nama, $programStudi, $id);
            if ($stmtUpdate->execute()) {
                header("Location: dashboard.php?success=Data berhasil diupdate");
                exit();
            } else {
                $error = "Gagal mengupdate data";
            }
            $stmtUpdate->close();
        }
        $stmtCheckNim->close();
    } else {
        $queryCheckNim = "SELECT * FROM student WHERE nim = ?";
        $stmtCheckNim = $conn->prepare($queryCheckNim);
        $stmtCheckNim->bind_param("s", $nim);
        $stmtCheckNim->execute();
        $resultCheckNim = $stmtCheckNim->get_result();
        
        if ($resultCheckNim->num_rows > 0) {
            $error = "Gagal menambahkan data, NIM sudah ada.";
        } else {
            $queryInsert = "INSERT INTO student (nim, nama, prodi) VALUES (?, ?, ?)";
            $stmtInsert = $conn->prepare($queryInsert);
            $stmtInsert->bind_param("sss", $nim, $nama, $programStudi);
            
            if ($stmtInsert->execute()) {
                header("Location: dashboard.php?success=Data berhasil ditambahkan");
                exit();
            } else {
                $error = "Gagal menambahkan data";
            }
            $stmtInsert->close();
        }
        $stmtCheckNim->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.6.3/dist/flowbite.min.css" />
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    body {
        background-image: url("https://i.pinimg.com/564x/d9/94/40/d994408de42ff730ee26a4aa861ba6d2.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<body class="bg-gray-100">
    <div class="w-full max-w-3xl mx-auto p-6 mt-10 bg-white rounded-lg shadow-md border border-gray-200">
        <?php if ($error) { ?>
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <?php echo $error ?>
            </div>
        <?php } ?>

        <?php if ($success) { ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                <?php echo $success ?>
            </div>
        <?php } ?>

        <h2 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Student</h2>
        <form method="POST">
            <div class="mb-6">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($nama) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" required>
            </div>

            <div class="mb-6">
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                <input type="text" name="nim" id="nim" value="<?= htmlspecialchars($nim) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" required>
            </div>

            <div class="mb-6">
                <label for="programStudi" class="block text-sm font-medium text-gray-700 mb-2">Program Study</label>
                <input type="text" name="programStudi" id="programStudi" value="<?= htmlspecialchars($programStudi) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" required>
            </div>

            <div class="flex justify-end gap-4">
                <a href="dashboard.php" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">Back</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">Save</button>
            </div>
        </form>
    </div>

</body>
</html>