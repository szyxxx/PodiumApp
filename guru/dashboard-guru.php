<?php
include("navbar.php");
include("cek-peserta.php");

// Koneksi ke database
$host = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_podium";

$mysqli = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Query untuk mengambil data admin berdasarkan id_admin
$query = "SELECT nama_guru FROM tb_guru WHERE nign_guru = '$id_guru'";

// Eksekusi query
$result = $mysqli->query($query);

// Periksa hasil query
if ($result) {
    $row = $result->fetch_assoc();
    $nama_guru = $row['nama_guru'];
} else {
    echo "Error: " . $mysqli->error;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Podium - Guru</title>
    <link rel="stylesheet" href="../icons/fontawesome/css/all.css">
    <style>
    /* CSS untuk content */
    .container {
        color: Black;
        margin-left: 60px;
        margin-right: 60px;
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .card {
        width: 78%;
        margin-top: -30px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow-y: auto;
        max-height: 900px;
        background-color: #2e203d;
        color: white;
        height: 530px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    select {
        padding: 6px;
        border-radius: 4px;
        width: 60%;
    }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="content">

        <h2 style="color: white; margin-left: 60px; margin-right: 60px; margin-top: 55px;">Hai,
            <?php echo $nama_guru; ?>!</h2>
        <div class="container">
            <div class="card">
                <h2>Data Lomba</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Hasil</th>
                            <th>ID Lomba</th>
                            <th>ID Peserta</th>
                            <th>Kehadiran</th>
                            <th>Hasil Lomba</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Query untuk mengambil data lomba
                            $hasilQuery = "SELECT id_hasil, id_lomba, id_peserta, hasil_kehadiran, hasil_lomba FROM tb_hasil";
                            $hasilResult = $mysqli->query($hasilQuery);

                            if ($hasilResult && $hasilResult->num_rows > 0) {
                                while ($row = $hasilResult->fetch_assoc()) {
                                    $id_hasil = $row['id_hasil'];
                                    $id_lomba = $row['id_lomba'];
                                    $id_peserta = $row['id_peserta'];
                                    $hasil_kehadiran = $row['hasil_kehadiran'];
                                    $hasil_lomba = $row['hasil_lomba'];

                                    echo "<tr>";
                                    echo "<td>" . $row['id_hasil'] . "</td>";
                                    echo "<td>" . $row['id_lomba'] . "</td>";
                                    echo "<td>" . $row['id_peserta'] . "</td>";
                                    echo "<td>";
                                    echo "<form method='POST' action='dashboard-guru.php?id=$id_guru'>";
                                    echo "<select name='kehadiran'>";
                                    echo "<option value='Hadir'" . ($hasil_kehadiran == 'Hadir' ? " selected" : "") . ">Hadir</option>";
                                    echo "<option value='Tidak Hadir'" . ($hasil_kehadiran == 'Tidak Hadir' ? " selected" : "") . ">Tidak Hadir</option>";
                                    echo "</select>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<select name='hasil_lomba'>";
                                    echo "<option value='Menang'" . ($hasil_lomba == 'Menang' ? " selected" : "") . ">Menang</option>";
                                    echo "<option value='Kalah'" . ($hasil_lomba == 'Kalah' ? " selected" : "") . ">Kalah</option>";
                                    echo "</select>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<button type='submit' name='submit' value=''>Submit</button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "</td>";
                                    echo "</tr>";

                                    // Handle submit form
                                }
                                if (isset($_POST['submit'])) {
                                    $kehadiran = $_POST['kehadiran'];
                                    $hasil_lomba = $_POST['hasil_lomba'];

                                    // Update data
                                    $updateQuery = "UPDATE tb_hasil SET hasil_kehadiran = '$kehadiran', hasil_lomba = '$hasil_lomba' WHERE id_hasil = $id_hasil";
                                    $updateResult = $mysqli->query($updateQuery);

                                    if ($updateResult) {
                                        // Data berhasil diperbarui
                                        echo "Data berhasil diperbarui";
                                    } else {
                                        // Terjadi kesalahan saat memperbarui data
                                        echo "Terjadi kesalahan saat memperbarui data";
                                    }
                                }
                            } else {
                                echo "<tr><td colspan='7'>Belum ada data</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card" style="width: 300px;">
                <?php
                include("../cek-ranking.php");
                ?>
            </div>
        </div>
    </div>
</body>

</html>