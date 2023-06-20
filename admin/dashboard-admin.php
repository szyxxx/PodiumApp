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
$query = "SELECT nama_admin FROM tb_admin WHERE id_admin = '$id_admin'";

// Eksekusi query
$result = $mysqli->query($query);

// Periksa hasil query
if ($result) {
    $row = $result->fetch_assoc();
    $nama_admin = $row['nama_admin'];
} else {
    echo "Error: " . $mysqli->error;
}

// Tutup koneksi
$mysqli->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Podium - Admin</title>
    <link rel="stylesheet" href="../icons/fontawesome/css/all.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&italic&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&italic&display=swap');
    /* CSS untuk content */
    .content {
        text-align: center;
        margin-left: 50px;
        padding-top: 200px;
    }

    .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 20px;
        margin-left: -10px;
    }

    .card {
        width: 200px;
        height: 90px;
        background-color: #f0f0f0;
        margin: 10px;
        padding: 7px;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .card:hover {
        transition: 200ms linear;
        background-color: #58456e;
    }

    .card:hover a {
        color: white;
    }

    .card a {
        text-decoration: none;
        color: #333;
        text-align: center;
    }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="content">
        <h2 style="color: white;">Hai, <?php echo $nama_admin; ?>!</h2>
        <div class="card-container">
            <div class="card">
                <a href="peserta.php?id=<?php echo $id_admin;?>">
                    <h3>Data Peserta</h3>
                    <!-- Tambahkan ikon atau gambar sesuai kebutuhan -->
                </a>
            </div>
            <div class="card">
                <a href="lomba.php?id=<?php echo $id_admin;?>">
                    <h3>Data Lomba</h3>
                    <!-- Tambahkan ikon atau gambar sesuai kebutuhan -->
                </a>
            </div>
        </div>
    </div>
</body>

</html>
