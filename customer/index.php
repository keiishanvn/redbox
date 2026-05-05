<?php include '../config/koneksi.php'; ?>

<?php
$result = mysqli_query($conn, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<h1 class="text-3xl font-bold text-center my-6">Frozen Food Store</h1>

<div class="grid grid-cols-3 gap-6 px-10">
<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="bg-white p-4 rounded-xl shadow">
        <img src="../assets/images/<?php echo $row['gambar']; ?>" class="h-40 w-full object-cover">
        <h2 class="text-xl font-semibold"><?php echo $row['nama_produk']; ?></h2>
        <p>Rp <?php echo $row['harga']; ?></p>
        <p>Stok: <?php echo $row['stok']; ?></p>
        <p class="text-sm text-gray-500"><?php echo $row['deskripsi']; ?></p>
    </div>
<?php } ?>
</div>

</body>
</html>