<?php
$host = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_podium";

$mysqli = new mysqli($host, $username, $password, $dbname);
$peserta = "SELECT id_lomba, id_peserta FROM tb_peserta WHERE status_peserta='Terdaftar'";
$cekpeserta = $mysqli->query($peserta);

if ($cekpeserta && $cekpeserta->num_rows > 0) {
    while ($row = $cekpeserta->fetch_assoc()) {
        $id_peserta = $row['id_peserta'];
        $id_lomba = $row['id_lomba'];
        $hasil = "SELECT id_lomba FROM tb_hasil WHERE id_lomba = '$id_lomba'";
        $cekhasil = $mysqli->query($hasil);

        if($cekhasil && $cekhasil->num_rows == 0){
            $insertQuery = "INSERT INTO tb_hasil (id_lomba, id_Peserta,hasil_kehadiran,hasil_lomba) VALUES ('$id_lomba', '$id_peserta','','')";
            $insertResult = $mysqli->query($insertQuery);
        }
    }
}
?>