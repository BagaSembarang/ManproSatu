<?php

require_once '../koneksi.php';

$sql = "SELECT items.*, categories.name AS category_name 
        FROM items 
        LEFT JOIN categories ON items.category_id = categories.id 
        ORDER BY items.id DESC";

$result = $koneksi->query($sql);

if (!$result) {
    die("Query Error: " . $koneksi->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JUDUL BERUBAH -->
    <title>Admin Dashboard - Fungsional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- ===== Sidebar (Menu Navigasi) ===== -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-5 border-b border-gray-700">
                <h2 class="text-2xl font-semibold">Admin Panel</h2>
                <p class="text-sm text-gray-400">Katalog Kontrol</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <!-- LINK DIPERBAIKI (semua di folder admin/) -->
                <a href="dashboard.php" class="flex items-center px-4 py-2 rounded-lg bg-gray-900 text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="tambah.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tambah Item Baru
                </a>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <!-- LINK LOGOUT DIPERBAIKI (KEMBALI KE #) -->
                <a href="#" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </a>
            </div>
        </aside>

        <!-- ===== Konten Utama (Area Kerja) ===== -->
        <main class="flex-1 p-8 overflow-y-auto">
            <!-- Header Konten -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Item Koleksi</h1>
                <!-- LINK TAMBAH DIPERBAIKI -->
                <a href="tambah.php" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700">
                    + Tambah Item Baru
                </a>
            </div>

            <!-- ===== Tabel Data (DINAMIS DARI DATABASE) ===== -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Item</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900"><?= $row['id'] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-bold"><?= htmlspecialchars($row['item_name']) ?></td>
                                
                                <td class="px-6 py-4 text-sm text-blue-600">
                                    <?= $row['category_name'] ? htmlspecialchars($row['category_name']) : '<span class="text-gray-400 italic">Tanpa Kategori</span>' ?>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate"><?= htmlspecialchars($row['description']) ?></td>
                                <td class="px-6 py-4">
                                    <img src="../uploads/<?= htmlspecialchars($row['image_file']) ?>" class="w-16 h-16 object-cover rounded shadow-sm">
                                </td>
                                <td class="px-6 py-4 space-x-2 text-sm">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <a href="hapus.php?id=<?= $row['id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin?');">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center py-4">Belum ada data.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Akhir Tabel Data -->

        </main>
    </div>

</body>
</html>