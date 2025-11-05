<?php

require_once '../koneksi.php';

$sql = "SELECT * FROM items ORDER BY id DESC";

$result = $koneksi->query($sql);

// Cek jika query gagal
if (!$result) {
    die("Query Error: " . $koneksi->error);
}

// ===== AKHIR BAGIAN LOGIKA PHP =====
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Item</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        <?php
                        // 5. Looping data dari database
                        if ($result->num_rows > 0) {
                            // Ambil setiap baris data sebagai array asosiatif
                            while($row = $result->fetch_assoc()) {
                        ?>
                                <!-- Baris Data (dibuat oleh PHP) -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($row['id']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?php echo htmlspecialchars($row['item_name']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="<?php echo htmlspecialchars($row['description']); ?>">
                                        <?php echo htmlspecialchars($row['description']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <img src="../uploads/<?php echo htmlspecialchars($row['image_file']); ?>" 
                                            alt="<?php echo htmlspecialchars($row['item_name']); ?>" 
                                            class="w-16 h-16 object-cover rounded shadow-sm">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <!-- LINK AKSI DINAMIS -->
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <!-- Tambahkan konfirmasi JS sederhana untuk Hapus -->
                                        <a href="hapus.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            } // Akhir dari while loop
                        } else {
                            // Jika tidak ada data sama sekali
                        ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada data. Silakan <a href="tambah.php" class="text-blue-600 hover:underline">Tambah Item Baru</a>.
                                </td>
                            </tr>
                        <?php
                        } // Akhir dari if
                        
                        // 6. Tutup koneksi database
                        $koneksi->close();
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <!-- Akhir Tabel Data -->

        </main>
    </div>

</body>
</html>