<?php
// File: admin/tambah.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../koneksi.php';

// --- AMBIL DAFTAR KATEGORI UNTUK DROPDOWN ---
$sql_cat = "SELECT * FROM categories ORDER BY name ASC";
$result_cat = $koneksi->query($sql_cat);
// --------------------------------------------

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item_name = $koneksi->real_escape_string($_POST['item_name']);
    $description = $koneksi->real_escape_string($_POST['description']);
    
    // Ambil category_id dari form
    $category_id = $_POST['category_id']; // Ini ID kategori yang dipilih
    
    $admin_id = 1; 

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
        $target_dir = "../uploads/";
        $file_extension = strtolower(pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION));
        $unique_image_name = pathinfo($_FILES['image_file']['name'], PATHINFO_FILENAME) . '_' . time() . '.' . $file_extension;
        $target_file = $target_dir . $unique_image_name;
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($file_extension, $allowed_extensions)) {
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
                
                // UPDATE QUERY: Tambahkan kolom category_id
                $sql = "INSERT INTO items (item_name, description, image_file, admin_id, category_id) 
                        VALUES (?, ?, ?, ?, ?)";
                
                if ($stmt = $koneksi->prepare($sql)) {
                    // Bind param: sssii (string, string, string, integer, integer)
                    $stmt->bind_param("sssii", $item_name, $description, $unique_image_name, $admin_id, $category_id);
                    
                    if ($stmt->execute()) {
                        header("Location: dashboard.php?status=tambah_sukses");
                        exit;
                    } else {
                        $error_message = "DB Error: " . $stmt->error;
                        if (file_exists($target_file)) unlink($target_file);
                    }
                    $stmt->close();
                } else {
                    $error_message = "Query Error: " . $koneksi->error;
                    if (file_exists($target_file)) unlink($target_file);
                }
            } else {
                $error_message = "Upload Gagal.";
            }
        } else {
            $error_message = "Format file salah.";
        }
    } else {
        $error_message = "Pilih gambar.";
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
</head>
<body class="bg-gray-100">

<div class="flex h-screen">
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-5 border-b border-gray-700">
            <h2 class="text-2xl font-semibold">Admin Panel</h2>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="dashboard.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">Dashboard</a>
            <a href="tambah.php" class="flex items-center px-4 py-2 rounded-lg bg-gray-900 text-white">Tambah Item</a>
            <a href="kategori.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">Kategori</a>
        </nav>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Item Baru</h1>

        <div class="bg-white shadow-md rounded-lg p-6 lg:p-8">
            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4"><?= $error_message ?></div>
            <?php endif; ?>

            <form action="tambah.php" method="POST" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Item</label>
                    <input type="text" name="item_name" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category_id" class="w-full px-3 py-2 border rounded-lg" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php 
                        // Reset pointer result jika perlu atau loop langsung
                        if($result_cat->num_rows > 0) {
                            while($cat = $result_cat->fetch_assoc()) {
                                echo '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="5" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">File Gambar</label>
                    <input type="file" name="image_file" class="w-full px-3 py-2 border rounded-lg" accept="image/*" required>
                </div>

                <div class="flex justify-end space-x-3 border-t pt-4 mt-4">
                    <a href="dashboard.php" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Item</button>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>