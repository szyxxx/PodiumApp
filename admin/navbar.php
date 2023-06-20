<?php
$id_admin = $_GET['id'];
?>

<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: radial-gradient(circle, transparent 50%, #1b1225 20%, #1b1225 80%, transparent 80%, transparent) 0% 0% / 38px 38px, radial-gradient(circle, transparent 20%, #1b1225 20%, #1b1225 80%, transparent 80%, transparent) 19px 19px / 38px 38px, linear-gradient(#1c1326 3.5px, transparent 10px) 0px -1.75px / 19px 19px, linear-gradient(90deg, #1c1326 3.5px, #1b1225 3.5px) -1.75px 0px / 19px 19px #1b1225;
        background-size: 38px 38px, 38px 38px, 19px 19px, 19px 19px;
        background-color: #1b1225;
    }

    /* CSS untuk navbar */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background: radial-gradient(at bottom right, #d1cdd4 0, #d1cdd4 25px, rgba(209, 205, 212, 0.2) 25px, rgba(209, 205,
                    212, 0.2) 50px, rgba(209, 205, 212, 0.75) 50px, rgba(209, 205, 212, 0.75) 75px, rgba(209, 205, 212, 0.25) 75px,
                rgba(209, 205, 212, 0.25) 100px, rgba(209, 205, 212, 0.3) 100px, rgba(209, 205, 212, 0.3) 125px, rgba(209, 205, 212,
                    0.75) 125px, rgba(209, 205, 212, 0.75) 150px, rgba(209, 205, 212, 0.2) 150px, rgba(209, 205, 212, 0.2) 175px,
                transparent 175px, transparent 200px), radial-gradient(at top left, transparent 0, transparent 25px, rgba(209, 205,
                    212, 0.2) 25px, rgba(209, 205, 212, 0.2) 50px, rgba(209, 205, 212, 0.75) 50px, rgba(209, 205, 212, 0.75) 75px,
                rgba(209, 205, 212, 0.3) 75px, rgba(209, 205, 212, 0.3) 100px, rgba(209, 205, 212, 0.25) 100px, rgba(209, 205, 212,
                    0.25) 125px, rgba(209, 205, 212, 0.75) 125px, rgba(209, 205, 212, 0.75) 150px, rgba(209, 205, 212, 0.2) 150px,
                rgba(209, 205, 212, 0.2) 175px, #d1cdd4 175px, #d1cdd4 200px, transparent 200px, transparent 500px);
        background-blend-mode: multiply;
        background-size: 200px 200px, 200px 200px;
        background-color: #1b1225;
        color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand {
        margin-left: 50px;
        display: flex;
        align-items: center;
        flex: 1;
        justify-content: left;
    }

    .navbar-brand a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: white;
    }

    .navbar-brand img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
        filter: invert(1);
    }

    .navbar-brand span {
        font-size: 18px;
        font-weight: bold;
    }

    .navbar-right {
        margin-right: 80px;
        display: flex;
        align-items: center;
    }

    .logout-btn {
        margin-left: 50px;
        background-color: white;
        color: #1b1225;
        border: none;
        border-radius: 8px;
        width: 80px;
        height: 30px;
        text-align: center;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        display: flex;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <nav>
        <div class="navbar-brand">
            <a href="dashboard-admin.php?id=<?php echo $id_admin; ?>">
                <!-- Tambahkan link ke halaman dashboard_admin.php di sini -->
                <img src="../icons/sports/Podium.png" alt="Logo Brand">
                <span>Podium</span>
            </a>
        </div>
        <div class="navbar-right">
            <a href="../index.php" class="logout-btn">Logout</a>
        </div>
    </nav>
</body>

</html>

