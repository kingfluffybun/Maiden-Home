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
    <section class="search-section">
        <div>
            <div class="sort-buttons">
                <?php if (isset($_SESSION['role']) && strtolower($_SESSION['role']) == 'admin'): ?>
                    <a href="../product-input.php"><button>Add Product</button></a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section class='grid'>
        <section class="sort-bar">
            <div class="sort-area">
                <div class="sort-buttons">
                    <h2>Sort By:</h2>
                    <select style="margin-left: 16px;">
                        <option>Featured Products</option>
                        <option>Latest</option>
                        <option>Best Selling</option>
                        <option>Price</option>
                    </select>
                    <h2>Categories</h2>
                    <ul style="padding-left: 16px;">
                        <li><a>Storage & Organization</a></li>
                        <li><a>Beds & Mattresses</a></li>
                        <li><a>Table & Chairs</a></li>
                        <li><a>Sofas & Armchair</a></li>
                        <li><a>Home Decorations</a></li>
                        <li><a>Light Fixtures</a></li>
                        <li><a>Office Decorations</a></li>
                        <li><a>Outdoors Decorations</a></li>
                    </ul>
                    <h2>Subcategories</h2>
                    <!--<ul style="padding-left: 16px;">
                        <li><a>Bookcases & Shelving Units</a></li>
                        <li><a>Chests of drawers & drawer units</a></li>
                        <li><a>Cabinets & Cupboards</a></li>
                        <li><a>TV & media furniture</a></li>
                        <li><a>Wardrobes & Closet Systems</a></li>
                        <li><a>Beds</a></li>
                        <li><a>Beddings and Pillows</a></li>
                        <li><a>Mattresses</a></li>
                        <li><a>Under bed storage</a></li>
                        <li><a>Headboards</a></li>
                        <li><a>Dining Tables</a></li>
                        <li><a>Dining Chairs & Benches</a></li>
                        <li><a>Coffee & End Tables</a></li>
                        <li><a>Bar & Counter Stools</a></li>
                        <li><a>Specialty Seating</a></li>
                        <li><a>Sofas & Couches</a></li>
                        <li><a>Armchairs</a></li>
                        <li><a>Sofabeds</a></li>
                        <li><a>Ottomans, footstools & pouffes</a></li>
                        <li><a>Cushions</a></li>
                        <li><a>Wall Décor & Mirrors</a></li>
                        <li><a>Vases, Planters & Greenery</a></li>
                        <li><a>Decorative Accents</a></li>
                        <li><a>Rugs & Floor Coverings</a></li>
                        <li><a>Seasonal</a></li>
                        <li><a>Ceiling Lights & Pendants</a></li>
                        <li><a>Floor Lamps</a></li>
                        <li><a>Table & Desk Lamps</a></li>
                        <li><a>Wall & Vanity Lights</a></li>
                        <li><a>Outdoor Lighting</a></li>
                        <li><a>Desks & Work Surfaces</a></li>
                        <li><a>Office & Task Chairs</a></li>
                        <li><a>Home Office Sets</a></li>
                        <li><a>Gaming Furniture</a></li>
                        <li><a>Filing & Office Storage</a></li>
                        <li><a>Outdoor Lounge & Seating</a></li>
                        <li><a>Outdoor Dining & Bar Sets</a></li>
                        <li><a>Umbrellas, Pergolas & Shade</a></li>
                        <li><a>Outdoor Storage</a></li>
                        <li><a>Outdoor Décor & Accents</a></li>
                    </ul>-->
                </div>
            </div>
        </section>

        <section class="product-grid">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card">
                <div class="img-container">
                    <a href="../product-details/?product_id=<?= $row['product_id']; ?>">
                    <img src="../assets/PRODUCTS/<?= $row['product_img']; ?>" class="default-img">
                    <img src="../assets/PRODUCTS/<?= $row['product_img_hover']; ?>" class="hover-img">
                    </a>
                    <button class="add-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg></button>
                </div>
                <div class="product-info">
                    <p><?= htmlspecialchars($row['product_name']); ?></p>
                    <b>₱<?= number_format($row['price'], 2); ?></b>
                </div>
            </div>
            <?php endwhile; ?>
        </section>
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