<?php
session_start();
include '../config/koneksi.php';

// SEARCH & FILTER
$search = $_GET['search'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$harga = $_GET['harga'] ?? '';

// QUERY DASAR
$query = "SELECT * FROM produk WHERE 1=1";

// SEARCH
if($search != ''){
    $query .= " AND nama_produk LIKE '%$search%'";
}

// FILTER KATEGORI
if($kategori != ''){
    $query .= " AND kategori = '$kategori'";
}

// FILTER HARGA
if($harga == 'murah'){
    $query .= " AND harga < 50000";
} elseif($harga == 'mahal'){
    $query .= " AND harga >= 50000";
}

$result = mysqli_query($conn, $query);
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Data Produk</title>
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

<?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>

<div id="successPopup" 
     class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 w-80 text-center shadow-xl animate-bounce">
        <i class="fas fa-check-circle text-green-500 text-4xl mb-3"></i>
        <h2 class="text-lg font-bold">Berhasil!</h2>
        <p class="text-gray-500 text-sm mb-4">
            Data produk berhasil disimpan
        </p>

        <button onclick="closePopup()"
            class="bg-green-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-green-600">
            OK
        </button>
    </div>

</div>

<?php endif; ?>

<!-- CONTENT -->
<div class="flex-1 p-8 overflow-y-auto">

<!-- HEADER -->
<div class="flex justify-between items-start mb-8">
    <div>
        <h1 class="text-2xl font-bold uppercase">DATA PRODUK</h1>
        <p class="text-gray-600">Kelola daftar stok dan harga produk Anda</p>
    </div>

    <a href="c_tambah.php"
       class="bg-red-600 text-white px-5 py-3 rounded-xl font-bold flex items-center gap-2">
       <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

<!-- FILTER -->
<form method="GET" class="bg-white p-4 rounded-xl shadow mb-6 flex flex-wrap gap-4">

    <input type="text" name="search" value="<?= $search ?>"
        placeholder="Cari produk..."
        class="px-4 py-2 border rounded-lg w-64">

    <select name="kategori" class="px-4 py-2 border rounded-lg">
        <option value="">Semua Kategori</option>
        <option value="Frozen Food">Frozen Food</option>
        <option value="Olahan Daging">Olahan Daging</option>
        <option value="Dairy Product">Dairy Product</option>
    </select>

    <select name="harga" class="px-4 py-2 border rounded-lg">
        <option value="">Semua Harga</option>
        <option value="murah">Di bawah 50k</option>
        <option value="mahal">Di atas 50k</option>
    </select>

    <button class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cari</button>
</form>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow">
    <div class="overflow-x-auto">
        <table class="min-w-full text-left">
<table class="min-w-[800px] w-full text-left">

<thead class="bg-gray-50">
<tr>
    <th class="p-4">No</th>
    <th class="p-4">Produk</th>
    <th class="p-4">Kategori</th>
    <th class="p-4">Harga</th>
    <th class="p-4">Diskon</th>
    <th class="p-4 text-center">Stok</th>
    <th class="p-4 text-center">Aksi</th>
</tr>
</thead>

<tbody>
<?php while($row = mysqli_fetch_assoc($result)) { 

    // ambil data dengan benar
    $harga_asli = $row['harga'] ?? 0;
    $diskon = $row['diskon'] ?? 0;

    // HITUNG HARGA DISKON
    $harga_diskon = $harga_asli - ($harga_asli * $diskon / 100);
?>
<tr class="border-t hover:bg-gray-50">

<td class="p-4"><?= $no++ ?></td>

<td class="p-4 flex items-center gap-3">
    <img src="../assets/images/<?= $row['gambar'] ?>" 
         onclick="openModal(this.src)"
         class="w-10 h-10 rounded-lg object-cover cursor-pointer hover:scale-110 transition">
         
    <span class="font-semibold"><?= $row['nama_produk'] ?></span>
</td>

<td class="p-4">
    <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs">
        <?= $row['kategori'] ?>
    </span>
</td>

<!-- HARGA + DISKON -->
<td class="p-4 font-bold">
    <?php if($diskon > 0): ?>
        <span class="line-through text-gray-400 text-xs">
            Rp <?= number_format($harga_asli) ?>
        </span><br>
        <span class="text-red-600">
            Rp <?= number_format($harga_diskon) ?>
        </span>
    <?php else: ?>
        Rp <?= number_format($harga_asli) ?>
    <?php endif; ?>
</td>

<!-- KOLOM DISKON -->
<td class="p-4">
    <?php if($diskon > 0): ?>
        <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-bold">
            <?= $diskon ?>%
        </span>
    <?php else: ?>
        <span class="text-gray-400 text-xs">-</span>
    <?php endif; ?>
</td>

<td class="p-4 text-center">
    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
        <?= $row['stok'] ?>
    </span>
</td>

<td class="p-4 text-center">
    <div class="flex justify-center gap-2">

        <a href="c_edit.php?id=<?= $row['id'] ?>"
           class="bg-blue-500 text-white px-3 py-2 rounded">
            <i class="fas fa-edit"></i>
        </a>

        <a href="c_hapus.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Yakin hapus produk ini?')"
           class="bg-red-500 text-white px-3 py-2 rounded">
            <i class="fas fa-trash"></i>
        </a>

    </div>
</td>

</tr>
<?php } ?>
</tbody>

</table>
</div>

</div>
<div id="imageModal" 
     class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50">

    <span onclick="closeModal()" 
          class="absolute top-5 right-8 text-white text-3xl cursor-pointer">&times;</span>

    <img id="modalImg" class="max-w-[90%] max-h-[90%] rounded-xl shadow-lg">
</div>

<script>
function openModal(src){
    document.getElementById("imageModal").classList.remove("hidden");
    document.getElementById("imageModal").classList.add("flex");
    document.getElementById("modalImg").src = src;
}

function closeModal(){
    document.getElementById("imageModal").classList.add("hidden");
}
</script>
<script>
function closePopup(){
    document.getElementById('successPopup').style.display = 'none';

    // hapus parameter biar ga muncul lagi saat refresh
    window.history.replaceState({}, document.title, "produk.php");
}
</script>
</body>
</html>