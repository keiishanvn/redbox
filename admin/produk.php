<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include '../config/koneksi.php';

// === SEARCH & FILTER ===
$search = isset($_GET['search']) ? $_GET['search'] : '';
$stok   = isset($_GET['stok']) ? $_GET['stok'] : '';
$harga  = isset($_GET['harga']) ? $_GET['harga'] : '';

$sql = "SELECT * FROM produk WHERE 1=1";

if($search != ''){
    $sql .= " AND nama_produk LIKE '%$search%'";
}

if($stok == 'banyak'){
    $sql .= " AND stok > 10";
} elseif($stok == 'sedikit'){
    $sql .= " AND stok BETWEEN 1 AND 10";
} elseif($stok == 'habis'){
    $sql .= " AND stok = 0";
}

if($harga == 'murah'){
    $sql .= " AND harga < 50000";
} elseif($harga == 'mahal'){
    $sql .= " AND harga >= 50000";
}

$sql .= " ORDER BY id DESC";

$query = mysqli_query($conn, $sql);
$total = mysqli_num_rows($query);
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Data Produk</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex">

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
<div class="flex-1 p-8">

<h1 class="text-2xl font-bold mb-4">Data Produk</h1>

<!-- SEARCH + FILTER -->
<form method="GET" class="mb-6 flex flex-wrap gap-3">

<input type="text" name="search" placeholder="Cari produk..."
value="<?php echo $search; ?>"
class="px-4 py-2 border rounded-lg">

<select name="stok" class="px-4 py-2 border rounded-lg">
<option value="">Semua Stok</option>
<option value="banyak" <?php if($stok=='banyak') echo 'selected'; ?>>Banyak</option>
<option value="sedikit" <?php if($stok=='sedikit') echo 'selected'; ?>>Sedikit</option>
<option value="habis" <?php if($stok=='habis') echo 'selected'; ?>>Habis</option>
</select>

<select name="harga" class="px-4 py-2 border rounded-lg">
<option value="">Semua Harga</option>
<option value="murah" <?php if($harga=='murah') echo 'selected'; ?>>< 50rb</option>
<option value="mahal" <?php if($harga=='mahal') echo 'selected'; ?>>≥ 50rb</option>
</select>

<button class="bg-black text-white px-4 py-2 rounded-lg">Cari</button>

<a href="produk.php" class="bg-gray-200 px-4 py-2 rounded-lg">Reset</a>

<a href="c_tambah.php" class="bg-red-500 text-white px-4 py-2 rounded-lg">
+ Tambah
</a>

</form>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow overflow-hidden">
<table class="w-full">

<thead class="bg-gray-100">
<tr>
<th class="p-3">No</th>
<th class="p-3">Produk</th>
<th class="p-3">Harga</th>
<th class="p-3">Stok</th>
<th class="p-3 text-center">Aksi</th>
</tr>
</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($query)) { ?>

<tr class="border-t hover:bg-gray-50">

<td class="p-3"><?php echo $no++; ?></td>

<td class="p-3 flex items-center gap-3">
<img src="../assets/images/<?php echo $row['gambar']; ?>" 
class="w-10 h-10 rounded object-cover">
<?php echo $row['nama_produk']; ?>
</td>

<td class="p-3 font-bold">
Rp <?php echo number_format($row['harga'],0,',','.'); ?>
</td>

<td class="p-3 text-center">
<?php 
if($row['stok'] > 10){
    $warna = "bg-green-100 text-green-700";
} elseif($row['stok'] > 5){
    $warna = "bg-orange-100 text-orange-700";
} else {
    $warna = "bg-red-100 text-red-700";
}
?>
<span class="px-3 py-1 rounded-full text-xs font-bold <?php echo $warna; ?>">
<?php echo $row['stok']; ?>
</span>
</td>

<td class="p-3">
<div class="flex justify-center gap-2">

<a href="edit.php?id=<?php echo $row['id']; ?>"
class="bg-blue-500 text-white px-2 py-1 rounded">
Edit
</a>

<a href="hapus.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Yakin hapus?')"
class="bg-red-500 text-white px-2 py-1 rounded">
Hapus
</a>

</div>
</td>

</tr>

<?php } ?>

</tbody>

</table>

<!-- FOOTER -->
<div class="p-4 text-sm text-gray-500">
Total: <?php echo $total; ?> produk
</div>

</div>

</div>

<!-- AUTO REFRESH -->
<script>
setTimeout(() => {
    location.reload();
}, 15000);
</script>

</body>
</html>