<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../koneksi.php';

$message = "";
$is_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $koneksi->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Validasi sederhana (pastikan tidak kosong)
    if (empty($username) || empty($password)) {
        $message = "Username dan password tidak boleh kosong.";
        $is_success = false;
    } else {
        // 4. Hash password
        // Ini adalah langkah keamanan yang WAJIB
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
        
        if ($stmt = $koneksi->prepare($sql)) {
            // Bind parameter (s = string)
            $stmt->bind_param("ss", $username, $password_hash);
            
            // Eksekusi statement
            if ($stmt->execute()) {
                // Registrasi berhasil
                $message = "Akun admin '{$username}' berhasil dibuat. Anda sekarang bisa login.";
                $is_success = true;
            } else {
                // Cek jika error-nya adalah "duplicate entry"
                if ($koneksi->errno == 1062) {
                    $message = "Registrasi gagal: Username '{$username}' sudah digunakan.";
                } else {
                    $message = "Registrasi gagal: Terjadi kesalahan database. " . $stmt->error;
                }
                $is_success = false;
            }
            
            // Tutup statement
            $stmt->close();
        } else {
            // Query gagal
            $message = "Terjadi kesalahan pada server. Silakan coba lagi.";
            $is_success = false;
        }
    }
    
    // Tutup koneksi
    $koneksi->close();
}
// ===== AKHIR BAGIAN LOGIKA PHP =====
?>

<!-- ===== BAGIAN TAMPILAN HTML ===== -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Buat Akun Admin</h2>        
        <!-- Formulir Registrasi -->
        <form action="register.php" method="POST">
            
            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username Baru</label>
                <input type="text" name="username" id="username" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            
            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</dabel>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            
            <!-- Menampilkan Pesan (Sukses atau Error) -->
            <?php if (!empty($message)): ?>
                <div class="<?php echo $is_success ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'; ?> px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($message); ?></span>
                </div>
            <?php endif; ?>
            
            <!-- Tombol Submit -->
            <div>
                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Register Akun Admin
                </button>
            </div>
            
            <!-- Link kembali ke Login -->
            <?php if ($is_success): ?>
            <div class="text-center mt-4">
                <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500">
                    Klik di sini untuk Login
                </a>
            </div>
            <?php endif; ?>

        </form>
        <!-- Akhir Formulir -->
        
    </div>

</body>
</html>