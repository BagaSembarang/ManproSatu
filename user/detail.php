<?php
// Include koneksi database
require_once '../koneksi.php';

// Periksa apakah parameter ID ada
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

// Query untuk mengambil detail koleksi berdasarkan ID
$query = "SELECT i.*, c.name as category_name 
          FROM items i 
          LEFT JOIN categories c ON i.category_id = c.id 
          WHERE i.id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Jika data tidak ditemukan, redirect ke halaman utama
if (mysqli_num_rows($result) === 0) {
    header('Location: index.php');
    exit();
}

$item = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pameran</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">Galeri Pameran</div>
                <nav>
                    <a href="index.php" class="btn">Kembali ke Galeri</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Detail Content -->
    <div class="detail-container">
        <div class="detail-image-container">
            <img src="../uploads/<?php echo htmlspecialchars($item['image_file']); ?>" 
                 alt="<?php echo htmlspecialchars($item['item_name']); ?>" 
                 class="detail-image" 
                 onerror="this.src='../uploads/default.jpg'"
                 loading="lazy">
        </div>
        <div class="detail-content">
            <h1 class="detail-title"><?php echo htmlspecialchars($item['item_name']); ?></h1>
            <div class="detail-meta">
                <!-- <span class="meta-item">
                    <i class="fas fa-tag"></i> 
                    <span><?php echo htmlspecialchars($item['category_name']); ?></span>
                </span> -->
                <span class="meta-separator">•</span>
                <span class="meta-item">
                    <i class="fas fa-calendar-alt"></i> 
                    <span><?php echo date('d F Y', strtotime($item['created_at'])); ?></span>
                </span>
            </div>
            <div class="detail-description">
                <?php echo nl2br(htmlspecialchars($item['description'])); ?>
            </div>
            <div class="detail-actions">
                <a href="index.php" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Galeri
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Galeri Pameran. Semua Hak Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
