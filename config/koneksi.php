<?php
$conn = mysqli_connect("localhost", "root", "", "redbox");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>