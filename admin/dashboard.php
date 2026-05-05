<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

// Total produk (DINAMIS)
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 flex h-screen overflow-hidden">

<!-- Sidebar -->
<div class="w-20 bg-[#C81010] flex flex-col items-center py-6 h-screen relative z-10 justify-between">
    <div class="flex flex-col items-center w-full gap-6">
    <!-- Profile Icon -->
     <a href="pengaturan.php" 
        class="bg-white w-12 h-12 rounded-full flex items-center justify-center mb-4 shadow-md">
        <i class="fas fa-user text-black text-xl"></i>
</a>
    
    <div class="flex flex-col gap-4 items-center w-full">
        <!-- Dashboard -->
        <div class="relative group flex items-center justify-center w-full">
            <a href="dashboard.php"
                class="w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center hover:bg-gray-100 transition">
                <i class="fas fa-th-large text-gray-700 text-lg"></i>
            </a>
            <!-- Tooltip Label -->
            <span class="absolute left-16 ml-2 px-3 py-1 bg-black text-white text-xs rounded-md 
                         invisible opacity-0 group-hover:visible group-hover:opacity-100 
                         transition-all duration-300 whitespace-nowrap shadow-xl z-50">
                Dashboard
            </span>
        </div>

        <!-- Data Produk -->
        <div class="relative group flex items-center justify-center w-full">
            <a href="produk.php" 
            class="w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center hover:bg-gray-100 transition-all duration-200 active:scale-90">
                <i class="fas fa-shopping-bag text-gray-700 text-lg"></i>
</a>
            <span class="absolute left-16 ml-2 px-3 py-1 bg-black text-white text-xs rounded-md 
                         invisible opacity-0 group-hover:visible group-hover:opacity-100 
                         transition-all duration-300 whitespace-nowrap shadow-xl z-50">
                Data Produk
            </span>
        </div>

        <!-- Monitoring Suhu -->
        <div class="relative group flex items-center justify-center w-full">
        <a href="monitoring.php"     
        class="w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center hover:bg-gray-100 transition-all duration-200 active:scale-90">
                <i class="fas fa-thermometer-half text-gray-700 text-lg"></i>
</a>
            <span class="absolute left-16 ml-2 px-3 py-1 bg-black text-white text-xs rounded-md 
                         invisible opacity-0 group-hover:visible group-hover:opacity-100 
                         transition-all duration-300 whitespace-nowrap shadow-xl z-50">
                Monitoring Suhu
            </span>
        </div>

        <!-- Distribusi -->
        <div class="relative group flex items-center justify-center w-full">
        <a href="distribusi.php"     
        class="w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center hover:bg-gray-100 transition-all duration-200 active:scale-90">
                <i class="fas fa-truck text-gray-700 text-lg"></i>
</a>
            <span class="absolute left-16 ml-2 px-3 py-1 bg-black text-white text-xs rounded-md 
                         invisible opacity-0 group-hover:visible group-hover:opacity-100 
                         transition-all duration-300 whitespace-nowrap shadow-xl z-50">
                Distribusi
            </span>
        </div>

        <!-- Pengaturan -->
        <div class="relative group flex items-center justify-center w-full">
        <a href="pengaturan.php"     
        class="w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center hover:bg-gray-100 transition-all duration-200 active:scale-90">
                <i class="fas fa-cog text-gray-700 text-lg"></i>
</a>
            <span class="absolute left-16 ml-2 px-3 py-1 bg-black text-white text-xs rounded-md 
                         invisible opacity-0 group-hover:visible group-hover:opacity-100 
                         transition-all duration-300 whitespace-nowrap shadow-xl z-50">
                Pengaturan
            </span>
        </div>
    </div>
</div>

        <!-- Logout -->
        <div class="w-full flex justify-center pb-4">
        <div class="relative group flex items-center justify-center w-full">
            <a href="logout.php" 
               class="w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center hover:bg-red-50 transition-all duration-200 active:scale-90 group">
                <i class="fas fa-sign-out-alt text-red-600 text-lg"></i>
            </a>
            <!-- Tooltip Label -->
            <span class="absolute left-16 ml-2 px-3 py-1 bg-black text-white text-xs rounded-md 
                         invisible opacity-0 group-hover:visible group-hover:opacity-100 
                         transition-all duration-300 whitespace-nowrap shadow-xl z-50">
                Logout
            </span>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="flex-1 p-8 overflow-y-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-2xl font-bold uppercase">Dashboard Admin</h1>
            <p class="text-gray-600">Kelola dan pantau kondisi toko anda</p>
        </div>

        <!-- REALTIME DATE -->
           <div class="flex items-center gap-4 text-sm font-semibold text-gray-700">
                <div class="flex items-center gap-2">
                    <i class="far fa-calendar"></i>
                    <div id="date"></div>
                </div>
                <div class="h-6 w-px bg-gray-400"></div>
                <div id="clock"></div>
            </div>
        </div>

    <!-- TOP CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <!-- Suhu -->
        <div class="bg-white p-6 rounded-xl border flex items-center gap-6 shadow-sm hover:-translate-y-2 transition">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center">
                <i class="fas fa-thermometer-half text-blue-500 text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-semibold">Suhu Freezer saat ini</p>
                <h2 class="text-3xl font-bold">-20 °C</h2>
                <span class="px-3 py-1 bg-green-100 text-green-600 text-xs font-bold rounded-full">Normal</span>
            </div>
        </div>

        <!-- TOTAL PRODUK (FIX DINAMIS) -->
        <div class="bg-white p-6 rounded-xl border flex items-center gap-6 shadow-sm hover:-translate-y-2 transition">
            <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center">
                <i class="fas fa-box text-green-600 text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-semibold">Total Produk</p>
                <h2 class="text-3xl font-bold"><?php echo $total['total']; ?></h2>
                <p class="text-xs font-bold text-gray-600">Produk</p>
            </div>
        </div>

        <!-- PROMO (DINAMIS JUGA) -->
        <div class="bg-white p-6 rounded-xl border flex items-center gap-6 shadow-sm hover:-translate-y-2 transition">
            <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center">
                <i class="fas fa-shopping-basket text-orange-400 text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-semibold">Produk Promo</p>
                <h2 class="text-3xl font-bold"><?php echo $total['total']; ?></h2>
                <p class="text-xs font-bold text-gray-600">Produk</p>
            </div>
        </div>
    </div>

    <!-- RERATA -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl border flex items-center gap-6 shadow-sm hover:-translate-y-2 transition">
            <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center">
                <i class="fas fa-thermometer-half text-purple-500 text-2xl"></i>
            </div>
            <div>
                <p class="text-sm font-semibold">Rerata Suhu Freezer</p>
                <h2 class="text-3xl font-bold">-19 °C</h2>
                <span class="px-3 py-1 bg-green-100 text-green-600 text-xs font-bold rounded-full">Normal</span>
            </div>
        </div>
    </div>

         <!-- Chart -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Grafik Suhu -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="text-lg font-bold mb-4">Grafik Suhu (Real-Time)</h3>
                <div class="w-full h-64 bg-gray-400 rounded-lg flex items-center justify-center">
                    <!-- Placeholder for Chart -->
                    <span class="text-gray-200 font-semibold italic">Area Grafik</span>
                </div>
            </div>

            <!-- Status Sistem -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Status Sistem</h3>
                <div class="space-y-4 flex-1">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-bold text-sm">Mode</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Arduino</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-bold text-sm">Koneksi</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Connected</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="font-bold text-sm">Sumber Data</span>
                        <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full">Serial COM3</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="font-bold text-sm">Update Terakhir</span>
                        <span class="text-sm font-bold">15:56:32</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="mt-6 bg-white border border-gray-200 p-3 rounded-lg flex items-center gap-3 shadow-sm">
            <div class="bg-black text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">
                <i class="fas fa-info"></i>
            </div>
            <p class="text-sm font-bold">Sistem berjalan normal. Data suhu diperbarui setiap 5 menit.</p>
        </div>
    </div>

<!-- SCRIPT REALTIME -->
<script>
function updateTime(){
    const now = new Date();
    document.getElementById("clock").innerHTML = now.toLocaleTimeString();
    document.getElementById("date").innerHTML = now.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });
}
setInterval(updateTime, 1000);
updateTime();
</script>

</body>
</html>