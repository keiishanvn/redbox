<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

// dummy data (nanti ganti dari database / API Arduino)
$suhu = rand(-5, 10);

// LOGIC STATUS
if($suhu <= 0){
    $status = "AMAN";
    $warna = "green";
} elseif($suhu <= 5){
    $status = "WASPADA";
    $warna = "yellow";
} else {
    $status = "BAHAYA";
    $warna = "red";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Monitoring Suhu</title>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<div class="flex-1 p-8 overflow-y-auto">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold uppercase">Monitoring Suhu Freezer</h1>
        <p class="text-gray-600">Pantau suhu secara real-time dan stabilitas freezer</p>
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

<!-- TOP CARDS -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">

    <!-- SUHU -->
    <div class="bg-white p-6 rounded-2xl border shadow-sm flex items-center gap-4
        transition-all duration-300 hover:-translate-y-2 hover:scale-[1.02] hover:shadow-xl">
        <div>
            <p class="text-gray-500 text-sm">Suhu Saat Ini</p>
            <h2 class="text-2xl font-bold text-blue-600" id="currentTemp">- °C</h2>
        </div>
    </div>

    <!-- STATUS -->
    <div class="bg-white p-6 rounded-2xl shadow transition-all duration-300 hover:-translate-y-2 hover:scale-[1.02] hover:shadow-xl">
        <p class="text-gray-500 text-sm">Status</p>
        <h2 class="text-xl font-bold text-green-600" id="status">Normal</h2>
    </div>

    <!-- MIN -->
    <div class="bg-white p-6 rounded-2xl shadow transition-all duration-300 hover:-translate-y-2 hover:scale-[1.02] hover:shadow-xl">
        <p class="text-gray-500 text-sm">Suhu Terendah</p>
        <h2 class="text-xl font-bold" id="minTemp">- °C</h2>
    </div>

    <!-- MAX -->
    <div class="bg-white p-6 rounded-2xl shadow transition-all duration-300 hover:-translate-y-2 hover:scale-[1.02] hover:shadow-xl">
        <p class="text-gray-500 text-sm">Suhu Tertinggi</p>
        <h2 class="text-xl font-bold" id="maxTemp">- °C</h2>
    </div>

    <!-- AVG -->
    <div class="bg-white p-6 rounded-2xl shadow transition-all duration-300 hover:-translate-y-2 hover:scale-[1.02] hover:shadow-xl">
        <p class="text-gray-500 text-sm">Rerata Suhu</p>
        <h2 class="text-xl font-bold" id="avgTemp">- °C</h2>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- GRAFIK (ambil 2 kolom) -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow">
        <h2 class="font-bold mb-4">Grafik Suhu (Realtime)</h2>
        <canvas id="chartSuhu" height="100"></canvas>
    </div>

    <!-- STATUS SISTEM -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col">
        <h3 class="text-lg font-bold mb-4 border-b pb-2">Status Sistem</h3>

        <div class="space-y-4 flex-1">

            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="font-bold text-sm">Mode</span>
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                    Arduino
                </span>
            </div>

            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="font-bold text-sm">Koneksi</span>
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                    Connected
                </span>
            </div>

            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="font-bold text-sm">Sumber Data</span>
                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full">
                    Serial COM3
                </span>
            </div>

            <div class="flex justify-between items-center py-2">
                <span class="font-bold text-sm">Update Terakhir</span>
                <span class="text-sm font-bold" id="lastUpdate">-</span>
            </div>
        </div>
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

<script>
const ctx = document.getElementById('chartSuhu');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['08:00','09:00','10:00','11:00','12:00'],
        datasets: [{
            label: 'Suhu (°C)',
            data: [-2, -1, 0, 2, 4],
            borderWidth: 2,
            tension: 0.4
        }]
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let suhuData = [];
let labelData = [];

const ctx = document.getElementById('chartSuhu').getContext('2d');

const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labelData,
        datasets: [{
            label: 'Suhu °C',
            data: suhuData,
            tension: 0.4,
            borderWidth: 2,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                min: -25,
                max: 10
            }
        }
    }
});

</body>
</html>