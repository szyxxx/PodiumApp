<?php
    include("navbar.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Lomba</title>
    <link rel="stylesheet" href="../icons/fontawesome/css/all.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&italic&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&italic&display=swap');

    .container {
        color: white;
        margin-left: 30px;
        margin-right: 30px;
        margin-top: 70px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .card {
        width: 100%;
        height: 580px;
        background-color: #2e203d;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow-y: auto;
        max-height: 900px;
    }

    .form-container {
        display: flex;
        flex-direction: column;
    }

    .form-container label {
        margin-bottom: 10px;
    }

    .form-container select,
    .form-container input[type="date"],
    .form-container input[type="time"] {
        margin-bottom: 20px;
    }

    .form-container input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        border-top: 1px solid #ddd;
    }
    </style>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="card">
                <h2>Data Peserta</h2>
                <?php
                // Koneksi ke database
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "db_podium";
                $conn = mysqli_connect($host, $username, $password, $database);

                // Periksa apakah terdapat error saat koneksi
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }

                // Query untuk mendapatkan data dari tabel tb_lomba
                $data_peserta = "SELECT * FROM tb_peserta";
                $result = mysqli_query($conn, $data_peserta);

                // Periksa apakah terdapat data pada tabel
                if (mysqli_num_rows($result) > 0) {
                    // Tampilkan tabel dengan data peserta
                    echo "<table>";
                    echo "<tr><th>ID Peserta</th><th>NISN Siswa</th><th>ID_Lomba</th><th>Status Peserta</th><th>Hasil Lomba</th><th>Action</th><th></th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['id_peserta']."</td>";
                        echo "<td>".$row['nisn_siswa']."</td>";
                        echo "<td>".$row['id_lomba']."</td>";
                        echo "<td>".$row['status_peserta']."</td>";
                        echo "<td>".$row['hasil_lomba']."</td>";
                        echo "<td>"; 
                        // Tambahkan kondisi untuk menampilkan tombol Approved jika status_peserta adalah 'Pending'
                        if ($row['status_peserta'] == 'Pending') {
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' name='peserta_id' value='".$row['id_peserta']."'>";
                            echo "<input type='submit' name='approve' value='Approved'>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "<td>"; 
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    // Tampilkan pesan jika tidak ada data lomba
                    echo "<p>Belum ada lomba yang ditambahkan.</p>";
                }

                // Tutup koneksi ke database
                ?>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (isset($_POST['approve'])) {
    $peserta_id = $_POST['peserta_id'];

    // Update status_peserta menjadi 'Terdaftar'
    $update_query = "UPDATE tb_peserta SET status_peserta = 'Terdaftar' WHERE id_peserta = '$peserta_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "Status peserta berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui status peserta.";
    }
}
mysqli_close($conn);
?>