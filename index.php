<?php
include 'config/koneksi.php';

$search = isset($_GET['search']) 
    ? mysqli_real_escape_string($conn, $_GET['search']) 
    : '';

$kategori = isset($_GET['kategori']) 
    ? mysqli_real_escape_string($conn, $_GET['kategori']) 
    : '';

$query_str = "SELECT * FROM produk WHERE 1=1";

if($search != ''){
    $query_str .= " AND nama_produk LIKE '%$search%'";
}

if($kategori != ''){
    $query_str .= " AND kategori = '$kategori'";
}

$query_str .= " ORDER BY id DESC";

$query = mysqli_query($conn, $query_str);

$kategori_query = mysqli_query($conn, 
    "SELECT DISTINCT kategori FROM produk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Redbox Frozen</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

body{
    font-family: 'Poppins', sans-serif;
    overscroll-behavior-y: none;
}
</style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

<!-- NAVBAR -->
<header class="bg-[#C81010] text-white shadow-lg sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col md:flex-row justify-between items-center gap-4">

        <!-- LOGO -->
<div class="text-center md:text-left">
    <h1 class="text-3xl font-extrabold tracking-tight uppercase">
        Redbox Frozen
    </h1>

    <p class="text-red-100 text-sm">
        Pangeran Sogiri
    </p>
</div>

        <!-- MENU -->
        <nav class="flex items-center gap-8 text-sm font-semibold">

            <a href="index.php"
               class="border-b-2 border-white pb-1">
                Katalog
            </a>

            <a href="tentang.php"
               class="hover:text-red-200 transition">
                Tentang Kami
            </a>

            </a>

        </nav>

    </div>

</header>

<!-- FILTER -->
<section class="max-w-7xl mx-auto w-full px-6 py-8">

    <form method="GET"
          class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col md:flex-row gap-4">

        <!-- SEARCH -->
        <div class="flex-1 relative">

            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

            <input type="text"
                   name="search"
                   value="<?= htmlspecialchars($search) ?>"
                   placeholder="Cari produk frozen food..."
                   class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-100 focus:ring-2 focus:ring-red-500 outline-none">

        </div>

        <!-- KATEGORI -->
        <select name="kategori"
                onchange="this.form.submit()"
                class="px-4 py-3 rounded-xl bg-gray-100 outline-none focus:ring-2 focus:ring-red-500">

            <option value="">Semua Kategori</option>

            <?php while($cat = mysqli_fetch_assoc($kategori_query)) : ?>

                <option value="<?= $cat['kategori'] ?>"
                    <?= $kategori == $cat['kategori'] ? 'selected' : '' ?>>

                    <?= $cat['kategori'] ?>

                </option>

            <?php endwhile; ?>

        </select>

        <!-- BUTTON -->
        <button class="bg-[#C81010] text-white px-6 py-3 rounded-xl font-bold hover:bg-red-700 transition">
            Cari
        </button>

        <?php if($search != '' || $kategori != '') : ?>

            <a href="index.php"
               class="bg-gray-200 px-6 py-3 rounded-xl font-bold text-center hover:bg-gray-300 transition">

                Reset

            </a>

        <?php endif; ?>

    </form>

</section>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto w-full px-6 pb-14 flex-1">

    <!-- TITLE -->
    <div class="mb-10">

        <h2 class="text-3xl font-bold mb-2">
            Daftar Produk
        </h2>

        <p class="text-gray-500">
            Menampilkan <?= mysqli_num_rows($query) ?> produk tersedia
        </p>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

<?php if(mysqli_num_rows($query) > 0) : ?>

<?php while($row = mysqli_fetch_assoc($query)) :

$harga = $row['harga'];
$diskon = $row['diskon'];

$harga_diskon = $harga - ($harga * $diskon / 100);

?>

        <!-- CARD -->
        <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">

            <!-- IMAGE -->
            <div class="relative overflow-hidden">

                <?php if($diskon > 0) : ?>

                    <div class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full z-10 shadow-lg">
                        -<?= $diskon ?>%
                    </div>

                <?php endif; ?>

                <img src="assets/images/<?= $row['gambar'] ?>"
                     class="w-full h-60 object-cover group-hover:scale-110 transition duration-700">

            </div>

            <!-- CONTENT -->
            <div class="p-6">

                <!-- KATEGORI -->
                <p class="text-[10px] uppercase tracking-widest text-red-500 font-bold mb-2">
                    <?= $row['kategori'] ?>
                </p>

                <!-- NAMA -->
                <h3 class="font-bold text-lg mb-4 line-clamp-1">
                    <?= $row['nama_produk'] ?>
                </h3>

                <!-- STOK -->
                <div class="mb-3">
                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                        Stok: <?= $row['stok'] ?>
                    </span>
                </div>

                <!-- HARGA -->
                <?php if($diskon > 0) : ?>

                    <div>

                        <p class="text-gray-400 line-through text-sm">
                            Rp <?= number_format($harga) ?>
                        </p>

                        <h2 class="text-2xl font-extrabold text-red-600">
                            Rp <?= number_format($harga_diskon) ?>
                        </h2>

                    </div>

                <?php else : ?>

                    <h2 class="text-2xl font-extrabold text-gray-800">
                        Rp <?= number_format($harga) ?>
                    </h2>

                <?php endif; ?>

            </div>

        </div>

<?php endwhile; ?>

<?php else : ?>

        <!-- EMPTY -->
        <div class="col-span-full py-20 text-center">

            <i class="fas fa-box-open text-6xl text-gray-300 mb-6"></i>

            <h3 class="text-2xl font-bold text-gray-400 mb-2">
                Produk tidak ditemukan
            </h3>

            <p class="text-gray-400">
                Coba gunakan keyword atau kategori lain
            </p>

        </div>

<?php endif; ?>

    </div>

</main>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white mt-auto">

    <div class="max-w-7xl mx-auto px-6 py-14">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            <!-- BRAND -->
            <div>

                <h2 class="text-2xl font-extrabold mb-4">
                    REDBOX FROZEN
                </h2>

                <p class="text-gray-400 text-sm leading-relaxed">
                    Menyediakan frozen food berkualitas tinggi dengan penyimpanan higienis dan harga terbaik.
                </p>
                <h3 class="font-bold mb-2 uppercase text-sm tracking-widest">
                    <br> Alamat
                </h3>

                <p class="text-gray-400 text-sm leading-relaxed">
                    Jl. Pangeran Sogiri, RT.01/RW.08, Ciluar, Kec. Bogor Utara, Kota Bogor, Jawa Barat 16154
                </p>

            </div>

            <!-- MENU -->
            <div>

                <h3 class="font-bold mb-4 uppercase text-sm tracking-widest">
                    Menu
                </h3>

                <div class="space-y-3 text-sm text-gray-400">

                    <a href="index.php" class="block hover:text-white transition">
                        Katalog Produk
                    </a>

                    <a href="tentang.php" class="block hover:text-white transition">
                        Tentang Kami
                    </a>

                </div>

            </div>

            <!-- KONTAK -->
            <div>

                <h3 class="font-bold mb-4 uppercase text-sm tracking-widest">
                    Kontak
                </h3>

                <div class="space-y-3 text-sm text-gray-400">

                    <p>
                        <i class="fab fa-whatsapp mr-2"></i>
                        +62 812-3456-xxxx
                    </p>

                    <p>
                        <i class="far fa-envelope mr-2"></i>
                        hello@redboxfrozen.com
                    </p>

                </div>

            </div>

        </div>

        <!-- COPYRIGHT -->
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-xs">

            © 2026 Redbox Frozen Food. All Rights Reserved.

        </div>

    </div>

</footer>

</body>
</html>