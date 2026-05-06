<?php
session_start();
include '../config/koneksi.php';

// proteksi
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

// ambil id
$id = $_GET['id'];

// ambil data produk (buat dapetin nama gambar)
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$id"));

if($data){

    $gambar = $data['gambar'];

    // hapus file gambar kalau ada
    if($gambar != "" && file_exists("../assets/images/" . $gambar)){
        unlink("../assets/images/" . $gambar);
    }

    // hapus dari database
    mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
}

// balik ke halaman produk
header("Location: produk.php");
exit;
?>