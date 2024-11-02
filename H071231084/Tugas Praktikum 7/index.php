<?php
session_start();
include 'config.php';

// Logout action
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logout handling
if (isset($_POST['logout'])) {
    session_destroy(); // Hancurkan sesi
    header("Location: login.php"); // Arahkan ke halaman login setelah logout
    $conn->close();
    exit();
}

// Add student data
if (isset($_POST['add'])) {
    if ($_SESSION['role'] == 'admin') {
        $name = ucwords($_POST['name']);
        $nim =ucwords($_POST['nim']);
        $studyProgram = ucwords($_POST['studyProgram']);

        $query = "INSERT INTO students (name, nim, studyProgram) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $nim, $studyProgram);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student data successfully added";
        } else {
            $_SESSION['message'] = "Failed to add student data";
        }
        header("Location: index.php");
        exit();
    }
}

// Update student data
if (isset($_POST['update'])) {
    if ($_SESSION['role'] == 'admin') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $nim = $_POST['nim'];
        $studyProgram = $_POST['studyProgram'];

        $query = "UPDATE students SET name=?, nim=?, studyProgram=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $name, $nim, $studyProgram, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student data successfully updated";
        } else {
            $_SESSION['message'] = "Failed to update student data";
        }
        header("Location: index.php");
        exit();
    }
}

// Delete student data
if (isset($_GET['delete'])) {
    if ($_SESSION['role'] == 'admin') {
        $id = $_GET['delete'];

        $query = "DELETE FROM students WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student data successfully deleted";
        } else {
            $_SESSION['message'] = "Failed to delete student data";
        }
        header("Location: index.php");
        exit();
    }
}

$searchTerm = '';
$searchQuery = '';
$isSearching = false;

if (isset($_POST['search'])) {
    $isSearching = true;
    $searchTerm = $_POST['searchStudent'];
    $searchQuery = " WHERE name LIKE ? OR nim LIKE ? OR studyProgram LIKE ?";
    $searchLike = "%" . $searchTerm . "%";
}

// Ambil data siswa dengan kondisi pencarian jika ada
$query = "SELECT * FROM students" . $searchQuery . " ORDER BY id ASC";
$stmt = $conn->prepare($query);

if ($searchQuery) {
    $stmt->bind_param("sss", $searchLike, $searchLike, $searchLike);
}

$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error: " . $conn->error);
}

$studentToEdit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM students WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $studentToEdit = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css"> <!-- Pastikan CSS Anda ada di sini -->
</head>

<body>
    <div class="header">
        <?php if ($_SESSION['role'] == 'admin'): ?>
            <div>
                <h1>Hello, Admin!</h1> <br>
                <form method="POST" action="">
                    <button type="submit" name="logout" class="button-logout"><i class="fas fa-sign-out-alt me-2"></i>Log Out</button>
                </form>
            </div>
            <div>
                <img src="assets/admin.png" alt="admin">
            </div>
        <?php else: ?>
            <div>
                <h1>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1> <br>
                <form method="POST" action="">
                    <button type="submit" name="logout" class="button-logout"><i class="fas fa-sign-out-alt me-2"></i>Log Out</button>
                </form>
            </div>
            <div>
                <img src="assets/user.png" alt="user">
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-primary alert-dismissible fade show no-print message" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        

    <?php if ($_SESSION['role'] == 'admin'): ?>
        <div class="add-form-container">
            <h3><i class="fas fa-user-plus me-2"></i>Add Student Data</h3>
            <form method="POST">
                <label>
                    <i class="fas fa-user me-1"></i> Name <br>
                    <input type="text" name="name" required placeholder="Enter Name">
                </label>
                <label>
                    <i class="fas fa-id-card me-1"></i>NIM <br>
                    <input type="text" name="nim" required placeholder="Enter NIM">
                </label>
                <label>
                    <i class="fas fa-graduation-cap me-1"></i>Study Program <br>
                    <input type="text" name="studyProgram" required placeholder="Enter Study Program">
                </label>
                <button type="submit" name="add" class="button-add">
                    <i class="fas fa-plus"></i> Add
                </button>
            </form>
        </div>
    <?php endif; ?>

    <div id="userProfileList" class="user-profile-list">
        <div class="search-container">
            <h3><i class="fas fa-users"></i> Student Data List</h3>
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="searchStudent" required placeholder="Enter Name/NIM/Study Program"
                           id="inputField" value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <span class="input-group-text" onclick="clearInput()" style="cursor: pointer;">&times;</span>
                </div>
                <button type="submit" name="search">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>
        <div class="table-container">
    <table class="table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>NIM</th>
                <th>Study Program</th>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $dataFound = false;
            $modalData = [];

            while ($row = $result->fetch_assoc()) {
                $dataFound = true; 
                $modalData[] = $row; 

                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['nim']) ?></td>
                    <td><?= htmlspecialchars($row['studyProgram']) ?></td>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger"
                               onclick="return confirm('Are you sure you want to delete this data?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php
            }

            if (!$dataFound) echo '<tr><td colspan="5" class="text-center">No results found for your search</td></tr>';
            ?>
        </tbody>
    </table>
</div>

<?php if ($_SESSION['role'] == 'admin'): ?>
    <?php foreach ($modalData as $row): ?>
        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Student Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim" value="<?= htmlspecialchars($row['nim']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="studyProgram" class="form-label">Study Program</label>
                                <input type="text" class="form-control" name="studyProgram" value="<?= htmlspecialchars($row['studyProgram']) ?>" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function clearInput() {
            document.getElementById("inputField").value = ""; 
            document.forms[0].submit();
        }

        window.onload = function() {
            <?php if ($isSearching): ?>
                // Jika pencarian telah dilakukan, scroll ke elemen
                document.getElementById('userProfileList').scrollIntoView();
            <?php endif; ?>
        };
    </script>
</body>

</html>