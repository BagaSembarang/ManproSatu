<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    header("Location:dashboard.php"); // Arahkan ke dashboard
    exit;
}

require_once '../koneksi.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $koneksi->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM admins WHERE username = ?";
    
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("s", $username);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $admin = $result->fetch_assoc();
            
            if (password_verify($password, $admin['password'])) {
                
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $username;
        
                header("Location: ../admin_dashboard.html");
                exit;
                
            } else {
                $error_message = "Username atau password salah.";
            }
        } else {
            $error_message = "Username atau password salah.";
        }
        
        $stmt->close();
    } else {
        $error_message = "Terjadi kesalahan pada server. Silakan coba lagi.";
    }
    
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Admin Panel Login</h2>
      
        <form action="login.php" method="POST">
            
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" id="username" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            
            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
                </div>
            <?php endif; ?>
            
            <!-- Tombol Submit -->
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Login
                </button>
            </div>
            
        </form>
        <!-- Akhir Formulir -->
        
    </div>

</body>
</html>