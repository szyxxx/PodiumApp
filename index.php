<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Podium - Kelompok 6 UI</title>
    <link rel="stylesheet" href="icons/fontawesome/css/all.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&italic&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&italic&display=swap');

    .content {
        position: absolute;
        top: 0;
        left: 0px;
        right: 0;
        bottom: 0;
        /* main color 1b1225*/
        background-image: url('icons/vectorflat/blob-scene-haikei.svg');
        background-size: cover;
        display: flex;
        color: white;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }

    .content h1 {
        font-weight: 700;
        font-style: bold;
    }

    .content p {
        margin-top: -20px;
        font-weight: 200;
        font-style: italic;
    }

    .card {
        width: 300px;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        margin-top: 20px;
    }

    .card h2 {
        color: #29183b;
        font-size: 30px;
        margin-bottom: 35px;
        text-align: center;
    }

    .card input {
        width: 80%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .card button {
        background-color: #29183b;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .card button:hover {
        background-color: #1b0f29;
    }
    </style>
</head>

<body>
    <div class="content">
        <h1>Welcome to Podium</h1>
        <p>"Your Sports Event Management"</p>
        <div class="card">
            <h2>Login to<br>Explore</h2>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
$connect = mysqli_connect("localhost","root","","db_podium");
if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password']; 
  $siswa = mysqli_query($connect,"SELECT * FROM tb_siswa WHERE nama_siswa = '$username' AND nisn_siswa = '$password'");
  $guru = mysqli_query($connect,"SELECT * FROM tb_guru WHERE nama_guru = '$username' AND nign_guru = '$password'");
  $admin = mysqli_query($connect,"SELECT * FROM tb_admin WHERE id_admin = '$username' AND pass_admin = '$password'");
  if(mysqli_num_rows($siswa) === 1){
    $row=mysqli_fetch_assoc($siswa);
    if($row['nama_siswa'] === $username && $row['nisn_siswa'] === $password){
      header("Location: siswa/dashboard-siswa.php?id={$row['nisn_siswa']}");
      exit;
    }
  }
  if(mysqli_num_rows($guru) === 1){
    $row=mysqli_fetch_assoc($guru);
    if($row['nama_guru'] === $username && $row['nign_guru'] === $password){
      header("Location: guru/dashboard-guru.php?id={$row['nign_guru']}");
      exit;
    }
  }
  if(mysqli_num_rows($admin) === 1){
    $row=mysqli_fetch_assoc($admin);
    if($row['id_admin'] === $username && $row['pass_admin'] === $password){
      header("Location: admin/dashboard-admin.php?id={$row['id_admin']}");
      exit;
    }
  }
}
?>