<?php
$host = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_podium";

$mysqli = new mysqli($host, $username, $password, $dbname);
$rankpeserta = "SELECT id_peserta, COUNT(*) AS ranking FROM tb_hasil WHERE hasil_lomba = 'Menang' GROUP BY id_Peserta ORDER BY COUNT(*) DESC";
$rankpesertaresult = $mysqli->query($rankpeserta);
echo "<h2>Leaderboard</h2>";
if ($rankpesertaresult && $rankpesertaresult->num_rows > 0) {
    $ranking = 1;
    while ($row = $rankpesertaresult->fetch_assoc()) {
        $id_peserta = $row['id_peserta'];

        // Check hasil_lomba in tb_hasil table
        $hasilLombaQuery = "SELECT hasil_lomba FROM tb_hasil WHERE id_peserta = $id_peserta";
        $hasilLombaResult = $mysqli->query($hasilLombaQuery);

        if ($hasilLombaResult && $hasilLombaResult->num_rows > 0) {
            $hasilLombaRow = $hasilLombaResult->fetch_assoc();
            $hasil_lomba = $hasilLombaRow['hasil_lomba'];

            $rankhasil = "SELECT id_peserta,nisn_siswa FROM tb_peserta WHERE id_peserta = $id_peserta";
            $rankhasilresult = $mysqli->query($rankhasil);

            if ($rankhasilresult && $rankhasilresult->num_rows > 0) {
                $nisn_siswarow = $rankhasilresult->fetch_assoc();
                $nisn_siswa = $nisn_siswarow['nisn_siswa'];

                $namasiswaquery = "SELECT nama_siswa FROM tb_siswa WHERE nisn_siswa = $nisn_siswa";
                $namasiswaresult = $mysqli->query($namasiswaquery);
                $namasiswarow = $namasiswaresult->fetch_assoc();
                $nama_siswa = $namasiswarow['nama_siswa'];

                // Update hasil_lomba in tb_peserta table
                $updateRankingQuery =  "UPDATE tb_peserta SET hasil_lomba = '$hasil_lomba' WHERE id_peserta = $id_peserta";
                $updateRankingResult = $mysqli->query($updateRankingQuery);

                echo "<p>#$ranking - $nama_siswa</p>";
            }
        } else {
            echo "Gagal mendapatkan hasil_lomba dari tb_hasil.";
        }
        $ranking++;
    }
} else {
    echo "<p style='margin-top: 200px;'>Belum ada pemenang ditemukan</p>";
}
?>
