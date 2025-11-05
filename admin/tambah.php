<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Item</title>
    <!-- Memuat Tailwind CSS -->
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
                <!-- Link Dashboard (Tidak Aktif) -->
                <a href="dashboard.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <!-- Link Tambah Item (Aktif) -->
                <a href="#" class="flex items-center px-4 py-2 rounded-lg bg-gray-900 text-white">
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

        <!-- ===== Konten Utama (Area Kerja) ===== -->
        <main class="flex-1 p-8 overflow-y-auto">
            
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Item Baru</h1>

            <!-- Formulir Tambah Item -->
            <div class="bg-white shadow-md rounded-lg p-6 lg:p-8">
                
                <!-- action="#" berarti form belum berfungsi (sesuai tugas Minggu 1) -->
                <form action="#" method="POST">
                    
                    <!-- Nama Item -->
                    <div class="mb-4">
                        <label for="item_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Item</label>
                        <input type="text" name="item_name" id="item_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Buku Laskar Pelangi">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis deskripsi singkat item..."></textarea>
                    </div>

                    <!-- Nama File Gambar -->
                    <div class="mb-6">
                        <label for="image_file" class="block text-sm font-medium text-gray-700 mb-1">Nama File Gambar</label>
                        <input type="text" name="image_file" id="image_file" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: laskar.jpg">
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-3 border-t pt-4 mt-4">
                        <!-- Tombol Batal kembali ke dashboard -->
                        <a href="dashboard.php" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-300">
                            Batal
                        </a>
                        <!-- Tombol Simpan (belum berfungsi) -->
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                            Simpan Item
                        </button>
                    </div>

                </form>
            </div>
            <!-- Akhir Formulir -->

        </main>
    </div>

</body>
</html>