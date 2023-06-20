<?php
include("navbar.php");

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
$query = "SELECT nama_siswa FROM tb_siswa WHERE nisn_siswa = '$id_siswa'";

// Eksekusi query
$result = $mysqli->query($query);

// Periksa hasil query
if ($result) {
    $row = $result->fetch_assoc();
    $nama_siswa = $row['nama_siswa'];
} else {
    echo "Error: " . $mysqli->error;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Podium - Siswa</title>
    <link rel="stylesheet" href="../icons/fontawesome/css/all.css">
    <style>
    /* CSS untuk content */
    /* CSS untuk content */
    /* CSS untuk content */
    .container {
        color: Black;
        margin-left: 60px;
        margin-right: 60px;
        margin-top: 60px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .card {
        width: 78%;
        margin-top: -40px;
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
        width: 100%;
    }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="content">

        <h2 style="color: white; margin-left: 60px; margin-right: 60px; margin-top: 60px;">Hai,
            <?php echo $nama_siswa; ?>!</h2>
        <div class="container">
            <div class="card">
                <h2>Data Lomba</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Cabang Lomba</th>
                            <th>Jenis Lomba</th>
                            <th>Tanggal Lomba</th>
                            <th>Waktu Lomba</th>
                            <th>Status</th>
                            <th>Hasil</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Query untuk mengambil data lomba
                    $lombaQuery = "SELECT id_lomba, cabang_lomba, jenis_lomba, tgl_lomba, waktu_lomba FROM tb_lomba";
                    $lombaResult = $mysqli->query($lombaQuery);

                    if ($lombaResult && $lombaResult->num_rows > 0) {
                        while ($row = $lombaResult->fetch_assoc()) {
                            $id_lomba = $row['id_lomba'];
                            $cabang_lomba = $row['cabang_lomba'];
                            $jenis_lomba = $row['jenis_lomba'];
                            $tgl_lomba = $row['tgl_lomba'];
                            $waktu_lomba = $row['waktu_lomba'];

                            echo "<tr>";
                            echo "<td>$cabang_lomba</td>";
                            echo "<td>$jenis_lomba</td>";
                            echo "<td>$tgl_lomba</td>";
                            echo "<td>$waktu_lomba</td>";

                            // Query untuk mengambil data status_peserta dan hasil_lomba
                            $pesertaQuery = "SELECT status_peserta, hasil_lomba FROM tb_peserta WHERE nisn_siswa = '$id_siswa' AND id_lomba = '$id_lomba' AND status_peserta IS NOT NULL";
                            $pesertaResult = $mysqli->query($pesertaQuery);

                            // ...
                            if ($pesertaResult && $pesertaResult->num_rows > 0) {
                                while ($row = $pesertaResult->fetch_assoc()) {
                                    $status_peserta = $row['status_peserta'];
                                    $hasil_peserta = $row['hasil_lomba'];
                                    echo "<td>$status_peserta</td>";
                                    echo "<td>$hasil_peserta</td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                }
                            } else {
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>";
                                echo "<form method='POST' action=''>";
                                echo "<input type='hidden' name='id_lomba' value='$id_lomba'>";
                                echo "<button type='submit' name='daftar'>Daftar</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "<td></td>";
                            }
                            // ...


                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data lomba</td></tr>";
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

<?php
// Cek apakah form daftar telah disubmit
if (isset($_POST['daftar'])) {
    // Retrieve the selected lomba ID from the form
    $id_lomba = $_POST['id_lomba'];

    // Query untuk memeriksa apakah data peserta sudah ada
    $checkQuery = "SELECT * FROM tb_peserta WHERE nisn_siswa = '$id_siswa' AND id_lomba = '$id_lomba'";
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        echo "Anda sudah mendaftar pada lomba ini.";
    } else {
        // Query untuk melakukan insert data peserta
        $insertQuery = "INSERT INTO tb_peserta (nisn_siswa, id_lomba, status_peserta, hasil_lomba) VALUES ('$id_siswa', '$id_lomba', 'Pending','-')";
        $insertResult = $mysqli->query($insertQuery);

        if ($insertResult) {
            echo "Berhasil mendaftar pada lomba ini.";
        } else {
            echo "Gagal mendaftar pada lomba ini.";
        }
    }
}
$mysqli->close();
?>
