<?php
// File: admin/edit.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../koneksi.php';

$error_message = "";
$success_message = "";

// 1. CEK ID DI URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// 2. AMBIL DATA LAMA ITEM
$sql = "SELECT * FROM items WHERE id = ?";
if ($stmt = $koneksi->prepare($sql)) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
    } else {
        die("Item tidak ditemukan.");
    }
    $stmt->close();
} else {
    die("Error DB.");
}

// 3. AMBIL DAFTAR KATEGORI (Untuk Dropdown)
$sql_cat = "SELECT * FROM categories ORDER BY name ASC";
$result_cat = $koneksi->query($sql_cat);

// 4. PROSES FORM EDIT (UPDATE)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item_name = $koneksi->real_escape_string($_POST['item_name']);
    $description = $koneksi->real_escape_string($_POST['description']);
    $category_id = $_POST['category_id'];
    
    // Default: Pakai gambar lama
    $image_to_save = $data['image_file']; 
    $upload_new_image = false;

    // Cek apakah ada file gambar BARU yang diupload
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
        
        $target_dir = "../uploads/";
        $file_extension = strtolower(pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION));
        $unique_image_name = pathinfo($_FILES['image_file']['name'], PATHINFO_FILENAME) . '_' . time() . '.' . $file_extension;
        $target_file = $target_dir . $unique_image_name;
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($file_extension, $allowed_extensions)) {
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
                // Upload sukses, kita akan pakai nama file baru
                $image_to_save = $unique_image_name;
                $upload_new_image = true;
            } else {
                $error_message = "Gagal mengupload gambar baru.";
            }
        } else {
            $error_message = "Format file salah.";
        }
    }

    if (empty($error_message)) {
        // UPDATE QUERY
        $sql_update = "UPDATE items SET item_name=?, description=?, category_id=?, image_file=? WHERE id=?";
        
        if ($stmt = $koneksi->prepare($sql_update)) {
            // Bind param: ssssi
            $stmt->bind_param("ssisi", $item_name, $description, $category_id, $image_to_save, $id);
            
            if ($stmt->execute()) {
                // SUKSES UPDATE
                
                // Hapus gambar lama JIKA ada gambar baru
                if ($upload_new_image && !empty($data['image_file'])) {
                    $old_file = "../uploads/" . $data['image_file'];
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
                
                header("Location: dashboard.php?status=edit_sukses");
                exit;
            } else {
                $error_message = "Gagal update database: " . $stmt->error;
                // Jika gagal DB tapi gambar baru terlanjur upload, hapus gambar baru
                if ($upload_new_image && file_exists($target_file)) unlink($target_file);
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Item</title>
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
            <a href="tambah.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">Tambah Item</a>
            <a href="kategori.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">Kategori</a>
        </nav>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Item</h1>

        <div class="bg-white shadow-md rounded-lg p-6 lg:p-8">
            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4"><?= $error_message ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Item</label>
                    <input type="text" name="item_name" value="<?= htmlspecialchars($data['item_name']) ?>" class="w-full px-3 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="category_id" class="w-full px-3 py-2 border rounded-lg" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php 
                        if($result_cat->num_rows > 0) {
                            while($cat = $result_cat->fetch_assoc()) {
                                // Cek jika ID kategori sama dengan data lama, tambahkan 'selected'
                                $selected = ($cat['id'] == $data['category_id']) ? 'selected' : '';
                                echo '<option value="'.$cat['id'].'" '.$selected.'>'.$cat['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="5" class="w-full px-3 py-2 border rounded-lg"><?= htmlspecialchars($data['description']) ?></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">File Gambar (Biarkan kosong jika tidak ingin mengganti)</label>
                    
                    <div class="mb-2">
                        <img src="../uploads/<?= $data['image_file'] ?>" class="w-32 h-32 object-cover rounded border">
                        <p class="text-xs text-gray-500 mt-1">Gambar saat ini: <?= $data['image_file'] ?></p>
                    </div>

                    <input type="file" name="image_file" class="w-full px-3 py-2 border rounded-lg" accept="image/*">
                </div>

                <div class="flex justify-end space-x-3 border-t pt-4 mt-4">
                    <a href="dashboard.php" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>