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
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .card {
        width: 78%;
        height: 660px;
        background-color: #2e203d;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        overflow-y: auto;
        max-height: 900px;
    }

    .form-container {
        width: 200px;
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
                <h2>Data Lomba</h2>
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
                $data_lomba = "SELECT * FROM tb_lomba";
                $result = mysqli_query($conn, $data_lomba);

                // Periksa apakah terdapat data pada tabel
                if (mysqli_num_rows($result) > 0) {
                    // Tampilkan tabel dengan data lomba
                    echo "<table>";
                    echo "<tr><th>ID Lomba</th><th>NIGN Guru</th><th>Cabang Lomba</th><th>Jenis Lomba</th><th>Tanggal Lomba</th><th>Waktu Lomba</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_lomba'] . "</td>";
                        echo "<td>" . $row['nign_guru'] . "</td>";
                        echo "<td>" . $row['cabang_lomba'] . "</td>";
                        echo "<td>" . $row['jenis_lomba'] . "</td>";
                        echo "<td>" . $row['tgl_lomba'] . "</td>";
                        echo "<td>" . $row['waktu_lomba'] . "</td>";
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
            <div class="card" style="width: 320px;">
                <h2>Edit Data</h2>
                <form action="lomba.php?id=<?php echo $id_admin; ?>" method="POST" class="form-container">
                    <label for="mode">Mode:</label>
                    <select name="mode" id="mode">
                        <option value="tambah">Tambah</option>
                        <option value="update">Update</option>
                        <option value="delete">Delete</option>
                    </select>

                    <label for="id_lomba">ID Lomba:</label>
                    <select name="id_lomba" id="id_lomba">
                        <option>None</option>
                        <?php
                        // Query untuk mendapatkan data dari tabel tb_lomba
                        $data_lomba_dropdown = "SELECT id_lomba FROM tb_lomba";
                        $result_dropdown = mysqli_query($conn, $data_lomba_dropdown);

                        // Periksa apakah terdapat data pada tabel
                        if (mysqli_num_rows($result_dropdown) > 0) {
                            while ($row_dropdown = mysqli_fetch_assoc($result_dropdown)) {
                                echo "<option value='" . $row_dropdown['id_lomba'] . "'>" . $row_dropdown['id_lomba'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="nign_guru">NIGN Guru:</label>
                    <select name="nign_guru" id="nign_guru">
                        <?php
                        // Query to retrieve data from the tb_guru table
                        $data_guru_dropdown = "SELECT nign_guru FROM tb_guru";
                        $result_dropdown = mysqli_query($conn, $data_guru_dropdown);

                        // Check if there is data in the table
                        if (mysqli_num_rows($result_dropdown) > 0) {
                            while ($row_dropdown = mysqli_fetch_assoc($result_dropdown)) {
                                echo "<option value='" . $row_dropdown['nign_guru'] . "'>" . $row_dropdown['nign_guru'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <label for="cabang_lomba">Cabang Lomba:</label>
                    <select name="cabang_lomba" id="cabang_lomba">
                        <option value="Basket">Basket</option>
                        <option value="Futsal">Futsal</option>
                        <option value="Badminton">Badminton</option>
                        <option value="Catur">Catur</option>
                    </select>
                    <label for="jenis_lomba">Jenis Lomba:</label>
                    <select name="jenis_lomba" id="jenis_lomba">
                        <option value="Indoor">Indoor</option>
                        <option value="Outdoor">Outdoor</option>
                    </select>
                    <label for="tgl_lomba">Tanggal Lomba:</label>
                    <input type="date" name="tgl_lomba" id="tgl_lomba">
                    <label for="waktu_lomba">Waktu Lomba:</label>
                    <input type="time" name="waktu_lomba" id="waktu_lomba">
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$connect = mysqli_connect("localhost", "root", "", "db_podium");

if (isset($_POST['submit'])) {
    $mode = $_POST['mode'];
    $id_lomba = $_POST['id_lomba'];
    $nign_guru = $_POST['nign_guru'];
    $cabang_lomba = $_POST['cabang_lomba'];
    $jenis_lomba = $_POST['jenis_lomba'];
    $tgl_lomba = $_POST['tgl_lomba'];
    $waktu_lomba = $_POST['waktu_lomba'];

    // Query sesuai dengan mode
    if ($mode == "tambah") {
        // Query tambah data
        $sql = "INSERT INTO tb_lomba (id_lomba, nign_guru, cabang_lomba, jenis_lomba, tgl_lomba, waktu_lomba) VALUES ('$id_lomba', '$nign_guru', '$cabang_lomba', '$jenis_lomba', '$tgl_lomba', '$waktu_lomba')";
    } elseif ($mode == "update") {
        // Query update data
        $sql = "UPDATE tb_lomba SET id_lomba='$id_lomba', nign_guru='$nign_guru', cabang_lomba='$cabang_lomba', jenis_lomba='$jenis_lomba', tgl_lomba='$tgl_lomba', waktu_lomba='$waktu_lomba' WHERE id_lomba='$id_lomba'";
    } elseif ($mode == "delete") {
        // Query hapus data
        $sql = "DELETE FROM tb_lomba WHERE id_lomba='$id_lomba'";
    } else {
        // Mode tidak valid, berikan pesan error
        echo "Mode tidak valid";
        exit;
    }

    // Eksekusi query
    if ($connect->query($sql) === TRUE) {
        echo "Data berhasil di" . ($mode == "tambah" ? "tambahkan" : ($mode == "update" ? "update" : "hapus"));
    } else {
        echo "Terjadi kesalahan: " . $connect->error;
    }
}

mysqli_close($connect);
?>