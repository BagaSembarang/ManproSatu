<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Mockup</title>
    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Anda bisa menambahkan sedikit CSS kustom di sini jika perlu */
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
                <!-- Link Halaman (di Minggu 1, link # saja) -->
                <a href="admin_dashboard.html" class="flex items-center px-4 py-2 rounded-lg bg-gray-900 text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <!-- DIUBAH: Link ini sekarang mengarah ke tambah.php -->
                <a href="tambah.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700">
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
            <!-- Header Konten -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Item Koleksi</h1>
                <!-- DIUBAH: Tombol ini sekarang mengarah ke tambah.php -->
                <a href="tambah.php" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700">
                    + Tambah Item Baru
                </a>
            </div>

            <!-- Tabel Data (Hardcode untuk Minggu 1) -->
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
                        <!-- Data Palsu Baris 1 -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Buku Laskar Pelangi</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">Kisah inspiratif dari Belitung...</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">laskar.jpg</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                        
                        <!-- Data Palsu Baris 2 -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Gundam RX-78-2</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">Model kit Master Grade...</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">gundam.jpg</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>

                        <!-- Data Palsu Baris 3 -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Kaset Vinyl Pink Floyd</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">Album Dark Side of the Moon...</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">vinyl.png</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                        
                        <!-- Anda bisa tambahkan lebih banyak data palsu di sini -->

                    </tbody>
                </table>
            </div>
            <!-- Akhir Tabel Data -->

        </main>
    </div>

</body>
</html>