<?php 
session_start();
include "../includes/db.php";

    if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['user_email'] = $_COOKIE['user_email'];
    }
    
    $sql = "SELECT p.*, c.category_name 
        FROM products p
        JOIN category c ON p.category_id = c.category_id";

    $result = mysqli_query($conn, $sql);

?>

<html>

<head>
    <title>Products | Maiden Home</title>
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="../css/scroll.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <script src="../js/script.js"></script>
</head>
<?php include "../includes/nav-bar.php" ?>

<body>
    <section class="category-banner">
        <img src="/Maiden-Home/assets/PRODUCTS/BANNER.jpg" alt="Banner">
    </section>
    <section class="sort-bar">
        <div class="sort-area">
            <p>Sort By:</p>
            <div class="sort-buttons">
                <button class="active">Featured</button>
                <button>Latest</button>
                <button>Best Selling</button>
                <a href="product.php?sort=high"><button>Price: High to Low</button></a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="../product-input.php"><button>Add Product</button></a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="product-grid">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/<?= $row['product_img']; ?>" class="default-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3><?= htmlspecialchars($row['product_name']); ?></h3>
            <p>₱<?= $row['price']; ?></p>
        </div>
        <?php endwhile; ?>
    </section>

    <section class="pagination">
        <button class="prev">&lt;</button>
        <div class="page-numbers">
            <span class="active">1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>5</span>
        </div>
        <button class="next">&gt;</button>
    </section>
</body>
</html>