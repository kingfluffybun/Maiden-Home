<?php 
session_start();
include "../includes/db.php";

    if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['user_email'] = $_COOKIE['user_email'];
        $_SESSION['role'] = $_COOKIE['role'];
    }

    $limit = 20;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $limit;

    $total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
    $total_row = mysqli_fetch_assoc($total_result);
    $total = $total_row['total'];
    $total_page = ceil($total / $limit);
    
    $sql = "SELECT p.*, c.category_name 
        FROM products p
        JOIN category c ON p.category_id = c.category_id
        LIMIT $limit OFFSET $offset";
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
        <img src="../assets/PRODUCTS/BANNER.jpg" alt="Banner">
    </section>
    <section class="sort-bar">
        <div class="sort-area">
            <p>Sort By:</p>
            <div class="sort-buttons">
                <button class="active">Featured</button>
                <button>Latest</button>
                <button>Best Selling</button>
                <a href="product.php?sort=high"><button>Price: High to Low</button></a>
                <?php if (isset($_SESSION['role']) && strtolower($_SESSION['role']) == 'admin'): ?>
                    <a href="../product-input.php"><button>Add Product</button></a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="product-grid">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="product-card">
            <div class="img-container">
                <img src="../assets/PRODUCTS/<?= $row['product_img']; ?>" class="default-img">
                <img src="../assets/PRODUCTS/<?= $row['product_img_hover']; ?>" class="hover-img">
                <button class="add-btn"><img src="../assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3><?= htmlspecialchars($row['product_name']); ?></h3>
            <p>₱<?= $row['price']; ?></p>
        </div>
        <?php endwhile; ?>
    </section>

    <section class="pagination">
        <?php if($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>"><button class="prev">&lt;</button></a>
        <?php else: ?>
            <button class="prev" disabled>&lt;</button>
        <?php endif; ?>
        <div class="page-numbers">
            <?php for($i = 1; $i <= $total_page; $i++): ?>
                <a href="?page=<?= $i ?>"><button class="page-number <?= $i == $page ? 'active' : '' ?>"><?= $i ?></button></a>
            <?php endfor; ?>
        </div>
        <?php if($page < $total_page): ?>
            <a href="?page=<?= $page + 1 ?>"><button class="next">&gt;</button></a>
        <?php else: ?>
            <button class="next" disabled>&gt;</button>
        <?php endif; ?>
    </section>
</body>
</html>