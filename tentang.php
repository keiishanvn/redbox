<?php
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tentang Kami - Redbox Frozen</title>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

body{
    font-family: 'Poppins', sans-serif;
    overscroll-behavior-y: none;
}
</style>
</head>


<!-- NAVBAR -->
<nav class="bg-[#C81010] text-white shadow-lg">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

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
        <div class="flex items-center gap-6 text-sm font-semibold">

            <a href="index.php" class="text-white/80 hover:text-white transition">Katalog</a>

<a href="tentang.php" class="text-white border-b-2 border-white pb-1">Tentang Kami</a>
</div>
            </a>
        </nav>
        </div>
    </div>
</header> 

<!-- HERO -->
<section class="relative overflow-hidden">

    <div class="bg-white text-black">

        <div class="max-w-7xl mx-auto px-6 py-20 grid lg:grid-cols-2 gap-10 items-center">

            <!-- TEXT -->
            <div>

                <p class="uppercase tracking-[4px] text-[#C81010] text-sm mb-4 font-bold">
                    Tentang Redbox
                </p>

                <h1 class="text-5xl font-extrabold leading-tight mb-6 text-black">
                    Frozen Food Berkualitas
                    Untuk Keluarga Modern
                </h1>

                <p class="text-gray-600 leading-relaxed mb-8">
                    Redbox Frozen hadir untuk menyediakan produk frozen food
                    berkualitas tinggi dengan penyimpanan suhu yang terjaga,
                    higienis, dan siap memenuhi kebutuhan harian Anda.
                </p>

                <div class="flex gap-4">

                    <a href="index.php"
                       class="bg-[#C81010] text-white px-6 py-3 rounded-xl font-bold hover:bg-red-700 hover:scale-105 transition">
                        Lihat Produk
                    </a>

                    <a href="#visi"
                        class="border border-[#C81010] text-[#C81010] px-6 py-3 rounded-xl font-bold hover:bg-[#C81010] hover:text-white transition">
                        Pelajari Lebih
                    </a>

                </div>

            </div>

            <!-- IMAGE -->
            <div class="relative">

                <img src="assets/images/banner.jpg"
                     class="rounded-3xl shadow-2xl object-cover h-[450px] w-full">

                <div class="absolute -bottom-6 -left-6 bg-white text-black p-5 rounded-2xl shadow-xl">
                    <h2 class="text-3xl font-extrabold text-[#C81010]">
                        100+
                    </h2>

                    <p class="text-sm text-gray-500">
                        Produk Tersedia
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

<!-- VISI MISI -->
<section id="visi" class="bg-[#C81010] py-20">
    <div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-14">

        <h2 class="text-4xl font-extrabold mb-4 text-white">
            Visi & Misi
        </h2>

        <p class="text-red-100">
            Komitmen kami dalam menghadirkan produk terbaik
        </p>

    </div>

    <div class="grid md:grid-cols-2 gap-8">

        <!-- VISI -->
        <div class="bg-white rounded-3xl p-10 shadow-sm hover:shadow-xl hover:-translate-y-2 transition">

            <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-eye text-2xl text-[#C81010]"></i>
            </div>

            <h3 class="text-xl font-bold mb-3 text-gray-800">
                Visi
            </h3>

            <p class="text-gray-600 leading-relaxed">
                Menjadi penyedia frozen food terpercaya dengan kualitas terbaik,
                distribusi modern, dan sistem monitoring suhu yang inovatif.
            </p>

        </div>

        <!-- MISI -->
        <div class="bg-white rounded-3xl p-10 shadow-sm hover:shadow-xl hover:-translate-y-2 transition">

            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-bullseye text-2xl text-blue-600"></i>
            </div>

            <h3 class="text-xl font-bold mb-3 text-gray-800">
                Misi
            </h3>

            <ul class="space-y-3 text-gray-600">

                <li>
                    • Menyediakan produk berkualitas tinggi
                </li>

                <li>
                    • Menjaga suhu penyimpanan tetap stabil
                </li>

                <li>
                    • Memberikan pelayanan cepat dan aman
                </li>

                <li>
                    • Mengembangkan teknologi distribusi modern
                </li>

            </ul>
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN -->
<section class="bg-[#FBFDFF] py-20">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">

            <h2 class="text-4xl font-extrabold mb-4 text-gray-800">
                Kenapa Memilih Redbox?
            </h2>

            <p class="text-gray-500">
                Kami menjaga kualitas dari freezer hingga sampai ke pelanggan
            </p>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

            <!-- CARD -->
            <div class="bg-gray-50 p-8 rounded-3xl hover:shadow-xl hover:-translate-y-2 transition">

                <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-temperature-low text-2xl text-[#C81010]"></i>
                </div>

                <h3 class="text-xl font-bold mb-3 text-gray-800">
                    Monitoring Suhu
                </h3>

                <p class="text-gray-600">
                    Sistem monitoring freezer real-time untuk menjaga kualitas produk.
                </p>

            </div>

            <!-- CARD -->
            <div class="bg-gray-50 p-8 rounded-3xl hover:shadow-xl hover:-translate-y-2 transition">

                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-box-open text-2xl text-green-600"></i>
                </div>

                <h3 class="text-xl font-bold mb-3 text-gray-800">
                    Produk Berkualitas
                </h3>

                <p class="text-gray-600">
                    Semua produk dipilih dengan standar kualitas dan higienitas tinggi.
                </p>

            </div>

            <!-- CARD -->
            <div class="bg-gray-50 p-8 rounded-3xl hover:shadow-xl hover:-translate-y-2 transition">

                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-truck text-2xl text-blue-600"></i>
                </div>

                <h3 class="text-xl font-bold mb-3 text-gray-800">
                    Distribusi Cepat
                </h3>

                <p class="text-gray-600">
                    Pengiriman aman dan cepat dengan sistem distribusi modern.
                </p>

            </div>

        </div>

    </div>

</section>

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