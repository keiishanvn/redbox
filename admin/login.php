<?php
session_start();
include '../config/koneksi.php';

// kalau sudah login, langsung ke dashboard
if(isset($_SESSION['login'])){
    header("Location: dashboard.php");
    exit;
}

$error = "";

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user'");

    if(mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_assoc($query);

        if(password_verify($pass, $data['password'])){
            $_SESSION['login'] = true;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Redbox Frozen</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-gray-h-screen flex flex-col items-center justify-center p-4">

<!-- HEADER -->
<div class="flex items-center gap-4 mb-12">
    <div class="flex flex-col items-end border-r-2 border-gray-300 pr-4">
        <span class="text-[#C81010] font-extrabold text-xl">REDBOX FROZEN</span>
        <span class="text-black font-bold text-sm">Pangeran Sogiri</span>
    </div>
    <h1 class="text-2xl font-extrabold">LOGIN ADMIN</h1>
</div>

<div class="max-w-5xl w-full flex flex-col md:flex-row items-center gap-16">

    <!-- LEFT -->
    <div class="w-full md:w-1/2 flex flex-col items-center text-center">
        <div class="w-80 h-80 bg-gray-300 rounded-2xl mb-6"></div>
        <p class="text-xl font-bold text-gray-900 max-w-xs">
            Kelola produk, harga, dan monitoring suhu freezer Anda
        </p>
    </div>

    <!-- RIGHT -->
    <div class="w-full md:w-[450px]">
        <div class="bg-white border-2 border-gray-200 rounded-xl p-8 shadow-lg">

            <!-- ERROR MESSAGE -->
            <?php if($error != ""){ ?>
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded-lg text-sm font-bold">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form action="" method="POST" class="space-y-6">

                <!-- USERNAME -->
                <div>
                    <label class="block font-bold mb-2">Username</label>
                    <input type="text" name="username" required
                        placeholder="Masukkan Username"
                        class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:border-blue-500">
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="block font-bold mb-2">Password</label>
                    <input type="password" name="password" required
                        placeholder="Masukkan Password"
                        class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:border-blue-500">
                </div>

                <!-- BUTTON -->
                <button type="submit" name="login"
                    class="w-full bg-[#C81010] text-white font-bold py-3 rounded-lg hover:bg-red-700 transition">
                    Masuk
                </button>

                <div class="text-center mt-4">
                    <p class="text-sm font-bold text-gray-800">
                        Belum punya akun? Konfirmasi dengan pengelola
                    </p>
                </div>

            </form>
        </div>
    </div>

</div>

</body>
</html>