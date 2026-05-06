<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

if(isset($_POST['submit'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $diskon = $_POST['diskon'] ?? 0;
    $stok = $_POST['stok'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

$folder = __DIR__ . "/../assets/images/";

// buat folder kalau belum ada
if(!is_dir($folder)){
    mkdir($folder, 0777, true);
}

$ext = pathinfo($gambar, PATHINFO_EXTENSION);
$namaBaru = time() . '.' . $ext;

$tujuan = $folder . $namaBaru;

if(move_uploaded_file($tmp, $tujuan)){
    
    mysqli_query($conn, "INSERT INTO produk 
        (nama_produk, kategori, harga, stok, diskon, deskripsi, gambar)
        VALUES ('$nama', '$kategori', '$harga', '$stok', $diskon, '$deskripsi', '$namaBaru')");

    header("Location: produk.php");
    exit;

} else {
    echo "Upload gagal. Path: " . $tujuan;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - Redbox Frozen</title>
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

<!-- Main Content -->
<div class="flex-1 p-8 overflow-y-auto">
    
    <!-- Header Page -->
    <div class="mb-8">
        <a href="produk.php" class="text-sm font-bold text-[#C81010] hover:underline mb-2 inline-block">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Data Produk
        </a>
        <h1 class="text-3xl font-extrabold text-black tracking-tight uppercase">Tambah Produk Baru</h1>
        <p class="text-gray-500">Lengkapi detail informasi produk frozen food Anda di bawah ini.</p>
    </div>

    <!-- Page Content (Gaya Full Page) -->
    <form method="POST" enctype="multipart/form-data" class="space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Kolom Kiri: Info Utama -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
                    <h2 class="text-lg font-bold mb-6 border-b pb-4">INFORMASI UTAMA</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NAMA PRODUK</label>
                            <input type="text" name="nama" required placeholder="Masukkan nama produk..." 
                                   class="w-full border border-gray-200 p-3.5 rounded-xl outline-none focus:ring-2 focus:ring-[#C81010]/20 focus:border-[#C81010] transition-all">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">KATEGORI</label>
                                <select name="kategori" class="w-full border border-gray-200 p-3.5 rounded-xl outline-none focus:ring-2 focus:ring-[#C81010]/20">
                                    <option value="Frozen Food">Frozen Food</option>
                                    <option value="Olahan Daging">Olahan Daging</option>
                                    <option value="Dairy Product">Dairy Product</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">HARGA SATUAN (RP)</label>
                                <input type="number" name="harga" required placeholder="0" 
                                       class="w-full border border-gray-200 p-3.5 rounded-xl outline-none focus:ring-2 focus:ring-[#C81010]/20">
                            </div>
</div>

                                <div>
    <label>DISKON (%)</label>
    <input type="number" name="diskon" value="0" min="0" max="100"
           class="w-full border p-3.5 rounded-xl">
</div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">DESKRIPSI PRODUK</label>
                            <textarea name="deskripsi" rows="5" placeholder="Jelaskan detail produk, berat, atau keunggulan..." 
                                      class="w-full border border-gray-200 p-3.5 rounded-xl outline-none focus:ring-2 focus:ring-[#C81010]/20 resize-none"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Media & Stok -->
            <div class="space-y-6">
                <!-- Stok Card -->
                <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
                    <h2 class="text-lg font-bold mb-4">MANAJEMEN STOK</h2>
                    <label class="block text-sm font-bold text-gray-700 mb-2">JUMLAH STOK AWAL</label>
                    <input type="number" name="stok" required placeholder="0" 
                           class="w-full border border-gray-200 p-3.5 rounded-xl outline-none focus:ring-2 focus:ring-[#C81010]/20">
                </div>

                <!-- Gambar Card -->
                <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
                    <h2 class="text-lg font-bold mb-4">MEDIA PRODUK</h2>
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-[#C81010] transition-all group">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 mb-3 group-hover:text-[#C81010]"></i>
                        <input type="file" name="gambar" required class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-[#C81010] hover:file:bg-red-100">
                        <p class="text-[10px] text-gray-400 mt-2">Format: JPG, PNG (Max 2MB)</p>
                    </div>
                </div>

                <!-- Action Buttons -->
<div class="flex gap-4">

    <!-- SIMPAN -->
    <button type="submit" name="submit" 
        class="w-1/2 bg-[#C81010] text-white py-4 rounded-2xl font-extrabold shadow-lg shadow-red-200 hover:bg-red-700 transition-all active:scale-95 flex items-center justify-center gap-3">
        <i class="fas fa-save"></i> Simpan Produk
    </button>

    <!-- BATAL -->
<button type="button" onclick="openModal()"
    class="w-1/2 text-center bg-gray-200 text-gray-700 py-4 rounded-2xl font-bold hover:bg-gray-300 transition-all active:scale-95">
    Batal
</button>

</div>
        </div>
    </form>
</div>
<div id="confirmModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 w-80 text-center shadow-xl">
        <h2 class="text-lg font-bold mb-2">Yakin mau batal?</h2>
        <p class="text-gray-500 text-sm mb-6">
            Semua perubahan yang kamu isi akan hilang.
        </p>

        <div class="flex gap-3">
            <button onclick="closeModal()"
                class="w-1/2 bg-gray-200 py-2 rounded-xl font-bold hover:bg-gray-300">
                Tidak
            </button>

            <a href="produk.php"
                class="w-1/2 bg-red-600 text-white py-2 rounded-xl font-bold hover:bg-red-700 text-center">
                Ya, Batal
            </a>
        </div>
    </div>

</div>
<script>
function openModal(){
    document.getElementById('confirmModal').classList.remove('hidden');
    document.getElementById('confirmModal').classList.add('flex');
}

function closeModal(){
    document.getElementById('confirmModal').classList.add('hidden');
    document.getElementById('confirmModal').classList.remove('flex');
}
</script>
</body>
</html>