<?php
session_start();
$username = $_SESSION['username'] ?? '';

if ($username) {
    echo "Username yang sedang login adalah $username";
    $btn_login = "<a href='logout.php' onclik='return confirm(\"Yakin Logout?\")'>Logout</a>";
} else {
    $btn_login = "<a href='login.php'>Login</a>";
}

include 'conn.php';


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muhammad Ashif | 222303009</title>
    <?php include 'style.php'; ?>
</head>

<body>
    <h1>Bazzpack Official Store | 
      <?=$btn_login ?>
      <h1>Selamat datang di halaman saya!</h1>
    </h1>
    <header>
        <p>Tas Keren Bandung</p>
</header>

    <?php include 'tampil_barang.php'; ?>
</body>

</html>