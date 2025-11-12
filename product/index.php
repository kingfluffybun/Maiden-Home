<?php 
session_start();
include "../includes/db.php";

// Keep session active from cookie
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['role'] = $_COOKIE['role'];
}

// Pagination
$limit = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Filters
$where = "";
$filterName = "All Products";

if (isset($_GET['category_id'])) {
    $category_id = (int)$_GET['category_id'];
    $where = "WHERE p.category_id = $category_id";

    $cat_query = mysqli_query($conn, "SELECT category_name FROM category WHERE category_id = $category_id");
    $cat_row = mysqli_fetch_assoc($cat_query);
    $filterName = $cat_row ? $cat_row['category_name'] : "Category";
} elseif (isset($_GET['sub_id'])) {
    $sub_id = (int)$_GET['sub_id'];
    $where = "WHERE p.sub_id = $sub_id";

    $sub_query = mysqli_query($conn, "SELECT sub_name FROM sub_category WHERE sub_id = $sub_id");
    $sub_row = mysqli_fetch_assoc($sub_query);
    $filterName = $sub_row ? $sub_row['sub_name'] : "Subcategory";
}

$order_by = "p.product_id ASC"; // default
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'featured': $order_by = "p.product_name DESC"; break;
        case 'latest': $order_by = "p.product_id DESC"; break;
        case 'popular': $order_by = "p.product_id ASC"; break;
        case 'price_desc': $order_by = "p.price DESC"; break;
        case 'price_asc': $order_by = "p.price ASC"; break;
    }
}

// Total products
$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM products p $where");
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];
$total_page = ceil($total / $limit);

// Main query
$sql = "SELECT p.*, c.category_name, s.sub_name 
        FROM products p
        JOIN category c ON p.category_id = c.category_id
        JOIN sub_category s ON p.sub_id = s.sub_id
        $where
        ORDER BY $order_by
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

<html>
<head>
    <title>Products | Maiden Home</title>
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="../css/scroll.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="../js/script.js"></script>
</head>

<?php include "../includes/nav-bar.php" ?>

<body>
    <section class="category-banner">
        <img src="../assets/Banner.png" alt="Banner">
    </section>
    <section class="search-section">
        <div class="search-container">
            <form class="search-products">
                <input type="search" placeholder="Search">
            </form>
        </div>
    </section>
    <section class='grid'>
        <section class="filter">
            <div class="filter-area">
                <div class="filter-buttons">
                    <b>Filters</b>
                    <hr>
                    <b>Categories</b>
                    <ul style="padding-left: 16px;">
                        <?php
                        $activeCategory = null;
                        if (isset($_GET['category_id'])) {
                            $activeCategory = (int)$_GET['category_id'];
                        } elseif (isset($_GET['sub_id'])) {
                            $sub_id = (int)$_GET['sub_id'];
                            $cat_query = mysqli_query($conn, "SELECT category_id FROM sub_category WHERE sub_id = $sub_id");
                            $cat_row = mysqli_fetch_assoc($cat_query);
                            $activeCategory = $cat_row ? $cat_row['category_id'] : null;
                        }

                        echo '<li><a class="'.(is_null($activeCategory) ? 'active-category' : 'category-link').'" href="../product">All Products</a></li>';

                        $cat_result = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id ASC");
                        while ($cat = mysqli_fetch_assoc($cat_result)) {
                            $active = ($cat['category_id'] == $activeCategory) ? 'class="active-category"' : 'class="category-link"';
                            echo '<li><a '.$active.' href="?category_id=' . $cat['category_id'] . '">' . htmlspecialchars($cat['category_name']) . '</a></li>';
                        }
                        ?>  
                    </ul>
                    <hr>
                    <b>Subcategories</b>
                    <ul style="padding-left: 16px;">
                        <?php
                        if ($activeCategory) {
                            $sub_result = mysqli_query($conn, "SELECT * FROM sub_category WHERE category_id = $activeCategory ORDER BY sub_id ASC");
                        } else {
                            $sub_result = mysqli_query($conn, "SELECT * FROM sub_category ORDER BY sub_id ASC");
                        }
                        $activeSub = isset($_GET['sub_id']) ? $_GET['sub_id'] : null;
                        while ($sub = mysqli_fetch_assoc($sub_result)) {
                            $active = ($sub['sub_id'] == $activeSub) ? 'class="active-category"' : 'class="category-link"';
                            echo '<li><a '.$active.' href="?sub_id=' . $sub['sub_id'] . '">' . htmlspecialchars($sub['sub_name']) . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <section class="product-grid">
            <section class="sort-section">
                <?php
                    $base_url = "?";
                    if (isset($_GET['category_id'])) $base_url .= "category_id=" . (int)$_GET['category_id'] . "&";
                    if (isset($_GET['sub_id'])) $base_url .= "sub_id=" . (int)$_GET['sub_id'] . "&";
                ?>
                <select class="sort-by" onchange="location = this.value;">
                    <option value="">Sort By</option>
                    <option value="<?= $base_url ?>sort=featured">Featured</option>
                    <option value="<?= $base_url ?>sort=latest">Latest</option>
                    <option value="<?= $base_url ?>sort=popular">Most Popular</option>
                    <option value="<?= $base_url ?>sort=price_desc">Price, High to Low</option>
                    <option value="<?= $base_url ?>sort=price_asc">Price, Low to High</option>
                </select>
            </section>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="product-card">
                        <div class="img-container">
                            <a href="../product-details/?product_id=<?= $row['product_id']; ?>">
                                <img src="../assets/PRODUCTS/<?= htmlspecialchars($row['product_img']); ?>" class="default-img">
                                <img src="../assets/PRODUCTS/<?= htmlspecialchars($row['product_img_hover']); ?>" class="hover-img">
                            </a>
                            <button class="add-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                                    viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" 
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="8" cy="21" r="1"/>
                                    <circle cx="19" cy="21" r="1"/>
                                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                                </svg>
                            </button>
                        </div>
                        <div class="product-info">
                            <p><?= htmlspecialchars($row['product_name']); ?></p>
                            <b>₱<?= number_format($row['price'], 2); ?></b>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products found in this category.</p>
            <?php endif; ?>
        </section>
    </section>
    <section class="pagination">
        <?php if($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&<?= http_build_query($_GET) ?>"><button class="prev">Prev</button></a>
        <?php else: ?>
            <button class="prev" disabled>Prev</button>
        <?php endif; ?>
        <div class="page-numbers">
            <?php for($i = 1; $i <= $total_page; $i++): ?>
                <a href="?page=<?= $i ?>&<?= http_build_query($_GET) ?>">
                    <button class="page-number <?= $i == $page ? 'active' : '' ?>"><?= $i ?></button>
                </a>
            <?php endfor; ?>
        </div>
        <?php if($page < $total_page): ?>
            <a href="?page=<?= $page + 1 ?>&<?= http_build_query($_GET) ?>"><button class="next">Next</button></a>
        <?php else: ?>
            <button class="next" disabled>Next</button>
        <?php endif; ?>
    </section>
    <?php include "../includes/footer.php" ?>
</body>
</html>
