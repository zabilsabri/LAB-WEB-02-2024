<?php
session_start();
include './config/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];

// Ambil data statistik dari database
$queryTotalMahasiswa = "SELECT COUNT(*) as total FROM mahasiswa";
$resultTotalMahasiswa = mysqli_query($conn, $queryTotalMahasiswa);
$totalMahasiswa = mysqli_fetch_assoc($resultTotalMahasiswa)['total'];

$queryProdiStat = "SELECT prodi, COUNT(*) as total FROM mahasiswa GROUP BY prodi";
$resultProdiStat = mysqli_query($conn, $queryProdiStat);

$prodiLabels = [];
$prodiCounts = [];

while ($row = mysqli_fetch_assoc($resultProdiStat)) {
    $prodiLabels[] = $row['prodi'];
    $prodiCounts[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="card shadow-lg mb-4">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Dashboard</h2>

                <!-- Data Statistik -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Mahasiswa</h5>
                                <p class="card-text fs-3"><?php echo $totalMahasiswa; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <canvas id="prodiChart"></canvas>
                    </div>
                </div>

                <!-- Tabel Mahasiswa per Program Studi -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Mahasiswa per Program Studi</h5>
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Program Studi</th>
                                    <th>Jumlah Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Reset pointer result set untuk tabel
                                mysqli_data_seek($resultProdiStat, 0);
                                while ($row = mysqli_fetch_assoc($resultProdiStat)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['prodi'] . "</td>";
                                    echo "<td>" . $row['total'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Kembali ke Dashboard -->
                <a href="index.php" class="btn btn-secondary mt-4"><i class="bi bi-arrow-left-circle"></i> Kembali ke Data Mahasiswa</a>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Chart.js
        const ctx = document.getElementById('prodiChart').getContext('2d');
        const prodiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($prodiLabels); ?>,
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: <?php echo json_encode($prodiCounts); ?>, // Label sumbu x
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
