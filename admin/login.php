<?php
session_start();
include '../config/koneksi.php';

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user'");
    $data = mysqli_fetch_assoc($query);

    if(password_verify($pass, $data['password'])){
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
    } else {
        echo "Login gagal!";
    }
}
?>