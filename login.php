<?php
session_start();
if (isset($_POST['btn_login'])) {
echo 'Processing Login...<hr>';
if ($_POST['username'] == 'bazzpack' && $_POST['password'] == 'bazzpack1') {
    echo 'Login Berhasil<hr>';

    // set session
    $_SESSION['username'] = 'Admin Bazzpack';

    echo "<script>location.replace('index.php')</script>";
} else {
    echo 'Login Gagal<hr>';

 }
}



?>

<form action="" method="post">
    <input required minlength=3 maxlength=20 type="text" name="username" placeholder="Username">
    <input required minlength=3 maxlength=20 type="password" name="password" placeholder="Password">
<button name=btn_login>Login</button>
</form>