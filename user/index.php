<?php
// Include koneksi database
require_once '../koneksi.php';

// Query untuk mengambil data koleksi
$query = "SELECT i.*, c.name as category_name 
          FROM items i 
          LEFT JOIN categories c ON i.category_id = c.id 
          ORDER BY i.id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Pameran</title>
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
                    <a href="../admin/dashboard.php" class="btn">Admin Login</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <h1 style="margin: 2rem 0; color: #2c3e50;">Koleksi Pameran</h1>
        
        <!-- Gallery Grid -->
        <div class="gallery">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="gallery-item">
                <img src="../admin/uploads/<?php echo htmlspecialchars($row['image_file']); ?>" alt="<?php echo htmlspecialchars($row['image_file']); ?>" onerror="this.src='../admin/uploads/default.jpg'">
                <div class="gallery-item-info">
                    <h3 class="gallery-item-title"><?php echo htmlspecialchars($row['item_name']); ?></h3>
                    <p class="gallery-item-desc">
                        <strong>Kategori:</strong> <?php echo htmlspecialchars($row['category_name']); ?><br>
                        <?php echo substr(htmlspecialchars($row['description']), 0, 100); ?>...
                    </p>
                    <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn">Lihat Detail</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Galeri Pameran. Semua Hak Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
