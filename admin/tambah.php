<?php
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    mysqli_query($conn, "INSERT INTO produk VALUES(NULL, '$nama', '$harga', ...)");
}
?>