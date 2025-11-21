<?php
// File: admin/kategori.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../koneksi.php';

$message = "";

// === LOGIKA TAMBAH KATEGORI ===
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $koneksi->real_escape_string($_POST['category_name']);

    if (!empty($category_name)) {
        $sql = "INSERT INTO categories (name) VALUES (?)";
        if ($stmt = $koneksi->prepare($sql)) {
            $stmt->bind_param("s", $category_name);
            if ($stmt->execute()) {
                $message = "Kategori berhasil ditambahkan!";
            } else {
                $message = "Gagal menambah kategori. Mungkin nama sudah ada.";
            }
            $stmt->close();
        }
    }
}

// === AMBIL DATA KATEGORI ===
$sql_cat = "SELECT * FROM categories ORDER BY id DESC";
$result_cat = $koneksi->query($sql_cat);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori</title>
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
            <a href="kategori.php" class="flex items-center px-4 py-2 rounded-lg bg-gray-900 text-white">Kategori</a>
        </nav>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Kelola Kategori</h1>

        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-xl font-semibold mb-4">Tambah Kategori Baru</h2>
            <?php if ($message): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= $message ?></div>
            <?php endif; ?>
            
            <form method="POST" class="flex gap-4">
                <input type="text" name="category_name" placeholder="Nama Kategori (misal: Elektronik)" class="flex-1 px-4 py-2 border rounded-lg" required>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kategori</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php while($row = $result_cat->fetch_assoc()): ?>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900"><?= $row['id'] ?></td>
                        <td class="px-6 py-4 text-sm text-gray-700"><?= htmlspecialchars($row['name']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>