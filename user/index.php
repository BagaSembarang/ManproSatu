<?php
// Mengubungkan ke database
require_once '../koneksi.php';

// 1. Ambil semua data kategori untuk Navbar
$sql_cat = "SELECT * FROM categories ORDER BY name ASC";
$result_cat = $koneksi->query($sql_cat);
$categories = [];
if ($result_cat) {
    while ($row = $result_cat->fetch_assoc()) {
        $categories[] = $row;
    }
}

// 2. Cek apakah user memilih kategori tertentu dari URL (contoh: ?kategori_id=1)
$selected_cat_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Pameran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* CSS Tambahan: Menyembunyikan scrollbar tapi tetap bisa di-scroll (swipe) */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-800">ManproKatalog</h1>
            </div>

            <div class="flex space-x-3 overflow-x-auto pb-2 no-scrollbar">
                
                <a href="index.php" 
                   class="px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap border transition
                   <?php echo ($selected_cat_id === null) 
                        ? 'bg-blue-600 text-white border-blue-600' 
                        : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50'; ?>">
                    Semua
                </a>

                <?php foreach ($categories as $cat): ?>
                    <a href="index.php?kategori_id=<?php echo $cat['id']; ?>" 
                       class="px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap border transition
                       <?php echo ($selected_cat_id == $cat['id']) 
                            ? 'bg-blue-600 text-white border-blue-600' 
                            : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-50'; ?>">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </a>
                <?php endforeach; ?>
                
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8 flex-grow">

        <?php
        // FUNGSI BANTUAN UNTUK MENAMPILKAN CARD ITEM
        // Agar tidak menulis ulang kode HTML card berkali-kali
        function renderItemCard($item) {
            $imagePath = "../uploads/" . htmlspecialchars($item['image_file']); 
            ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="h-48 w-full bg-gray-200">
                    <img src="<?php echo $imagePath; ?>" 
                         alt="<?php echo htmlspecialchars($item['item_name']); ?>" 
                         class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-800 mb-1 truncate"><?php echo htmlspecialchars($item['item_name']); ?></h3>
                    <p class="text-gray-600 text-sm line-clamp-2">
                        <?php echo htmlspecialchars($item['description']); ?>
                    </p>
                </div>
            </div>
            <?php
        }

        // LOGIKA TAMPILAN
        if ($selected_cat_id) {
            // ============================================================
            // KASUS 1: USER MEMILIH KATEGORI TERTENTU (Tampilkan Grid Saja)
            // ============================================================
            
            // Query item berdasarkan kategori_id
            $stmt = $koneksi->prepare("SELECT * FROM items WHERE category_id = ? ORDER BY id DESC");
            $stmt->bind_param("i", $selected_cat_id);
            $stmt->execute();
            $result_items = $stmt->get_result();

            // Ambil nama kategori untuk judul
            $current_cat_name = "Kategori";
            foreach($categories as $c) {
                if($c['id'] == $selected_cat_id) $current_cat_name = $c['name'];
            }

            echo "<h2 class='text-2xl font-bold text-gray-800 mb-6'>$current_cat_name</h2>";

            if ($result_items->num_rows > 0) {
                echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">';
                while ($row = $result_items->fetch_assoc()) {
                    renderItemCard($row);
                }
                echo '</div>';
            } else {
                echo '<p class="text-gray-500">Belum ada item di kategori ini.</p>';
            }
            $stmt->close();

        } else {
            // ============================================================
            // KASUS 2: USER MEMILIH "SEMUA" (Kelompokkan per Kategori)
            // ============================================================

            // Loop setiap kategori yang ada untuk membuat section terpisah
            $has_content = false;

            foreach ($categories as $cat) {
                $cat_id = $cat['id'];
                $cat_name = $cat['name'];

                // Ambil item hanya untuk kategori ini
                $sql_group = "SELECT * FROM items WHERE category_id = $cat_id ORDER BY id DESC";
                $res_group = $koneksi->query($sql_group);

                // Jika kategori ini punya item, tampilkan section-nya
                if ($res_group->num_rows > 0) {
                    $has_content = true;
                    echo "<div class='mb-10'>"; // Jarak antar kategori
                    
                    // Header Kategori dengan Link "Lihat"
                    echo "<div class='flex justify-between items-center mb-4 pb-2 border-b border-gray-200'>";
                    echo "<h2 class='text-xl font-bold text-gray-800'>" . htmlspecialchars($cat_name) . "</h2>";
                    echo "<a href='index.php?kategori_id=$cat_id' class='text-sm text-blue-600 hover:text-blue-800 font-medium'>Lihat $cat_name &rarr;</a>";
                    echo "</div>";

                    // Grid Item
                    echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">';
                    while ($row = $res_group->fetch_assoc()) {
                        renderItemCard($row);
                    }
                    echo '</div>';
                    echo "</div>";
                }
            }

            // (Opsional) Tampilkan item yang tidak punya kategori (Uncategorized)
            $sql_uncat = "SELECT * FROM items WHERE category_id IS NULL OR category_id = 0 ORDER BY id DESC";
            $res_uncat = $koneksi->query($sql_uncat);

            if ($res_uncat->num_rows > 0) {
                $has_content = true;
                echo "<div class='mb-10'>";
                echo "<h2 class='text-xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200'>Lainnya</h2>";
                echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">';
                while ($row = $res_uncat->fetch_assoc()) {
                    renderItemCard($row);
                }
                echo '</div></div>';
            }

            if (!$has_content) {
                echo '<div class="text-center py-10 text-gray-500">Belum ada item pameran yang diunggah.</div>';
            }
        }
        ?>

    </main>
    
    <footer class="bg-gray-800 text-white py-6 text-center mt-auto">
        <p>&copy; <?php echo date("Y"); ?> ManproKatalog. All rights reserved.</p>
    </footer>

</body>
</html>