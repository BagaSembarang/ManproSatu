<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../koneksi.php';

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item_name = $koneksi->real_escape_string($_POST['item_name']);
    $description = $koneksi->real_escape_string($_POST['description']);
    
    $admin_id = 1; 

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
        
        $target_dir = "../uploads/";
        
        $file_extension = strtolower(pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION));
        $unique_image_name = pathinfo($_FILES['image_file']['name'], PATHINFO_FILENAME) . '_' . time() . '.' . $file_extension;
        $target_file = $target_dir . $unique_image_name;

        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($file_extension, $allowed_extensions)) {
            
            // ===================================================================
            // PINDAHKAN FILE DULU (Langkah 1)
            // ===================================================================
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
                
                // File sekarang ada di folder /uploads
                
                // ===================================================================
                // COBA SIMPAN KE DB (Langkah 2)
                // ===================================================================
                $sql = "INSERT INTO items (item_name, description, image_file, admin_id) 
                        VALUES (?, ?, ?, ?)";
                
                if ($stmt = $koneksi->prepare($sql)) {
                    $stmt->bind_param("sssi", $item_name, $description, $unique_image_name, $admin_id);
                    
                    if ($stmt->execute()) {
                        // SEMUA SUKSES (Langkah 1 dan 2 berhasil)
                        header("Location: dashboard.php?status=tambah_sukses");
                        exit;
                    } else {
                        // GAGAL DI LANGKAH 2 (DB Error)
                        $error_message = "Gagal menyimpan data ke database: " . $stmt->error;

                        // PERBAIKAN: BATALKAN Langkah 1 (Hapus file)
                        if (file_exists($target_file)) {
                            unlink($target_file);
                        }
                    }
                    
                    $stmt->close();
                } else {
                    // GAGAL DI LANGKAH 2 (Query Prepare Error)
                    $error_message = "Gagal mempersiapkan query: " . $koneksi->error;
                    
                    // PERBAIKAN: BATALKAN Langkah 1 (Hapus file)
                    if (file_exists($target_file)) {
                        unlink($target_file);
                    }
                }

            } else {
                // GAGAL DI LANGKAH 1 (Upload Error)
                $error_message = "Maaf, terjadi kesalahan saat meng-upload file gambar.";
            }
        } else {
            // GAGAL KARENA EKSTENSI
            $error_message = "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan.";
        }
    } else {
        // GAGAL KARENA TIDAK ADA FILE
        $error_message = "Silakan pilih file gambar untuk di-upload.";
    }
    
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Item</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-5 border-b border-gray-700">
                <h2 class="text-2xl font-semibold">Admin Panel</h2>
                <p class="text-sm text-gray-400">Katalog Kontrol</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="dashboard.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="tambah.php" class="flex items-center px-4 py-2 rounded-lg bg-gray-900 text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tambah Item Baru
                </a>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </a>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Item Baru</h1>

            <div class="bg-white shadow-md rounded-lg p-6 lg:p-8">
                
                <?php if (!empty($error_message)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                        <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
                    </div>
                <?php endif; ?>

                <form action="tambah.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="mb-4">
                        <label for="item_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Item</label>
                        <input type="text" name="item_name" id="item_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Buku Laskar Pelangi" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis deskripsi singkat item..."></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="image_file" class="block text-sm font-medium text-gray-700 mb-1">File Gambar</label>
                        <input type="file" name="image_file" id="image_file" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" accept="image/png, image/jpeg, image/gif" required>
                        <p class="text-xs text-gray-500 mt-2">Hanya file .jpg, .jpeg, .png, .gif yang diizinkan.</p>
                    </div>

                    <div class="flex justify-end space-x-3 border-t pt-4 mt-4">
                        <a href="dashboard.php" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                            Simpan Item
                        </button>
                    </div>

                </form>
            </div>

        </main>
    </div>

</body>
</html>