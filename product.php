<?php
session_start();
include("./db.php");

    if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['user_email'] = $_COOKIE['user_email'];
    }

    $sql = "SELECT p.*, c.category_name 
        FROM products p
        JOIN category c ON p.category_id = c.category_id";

    if (isset($_GET['sort']) && $_GET['sort'] == 'high') {
        $sql = "SELECT * FROM products ORDER BY price DESC";
    } else {
        $sql = "SELECT * FROM products";
    }

    $result = mysqli_query($conn, $sql);

?>

<html>
<head>
    <title>Products | Maiden Home</title>
    <link rel="stylesheet" href="product.css">
</head>
<body>
    <nav>
        <h1>LOGO</h1>
        <div class="nav-options">
            <a href="login.php"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20v-1a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1"/></svg></a>
            <a><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 9.5a5.5 5.5 0 0 1 9.6-3.7.6.6 0 0 0 .8 0A5.5 5.5 0 0 1 22 9.5c0 2.3-1.5 4-3 5.5l-5.5 5.3a2 2 0 0 1-3 0L5 15C3.5 13.5 2 11.8 2 9.5"/></svg></a>
            <a><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2 2h2l2.6 12.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 1.9-1.6l1.6-7.4H5.1"/></svg></a>
        </div>
    </nav>

    <section class="category-banner">
        <img src="assets/PRODUCTS/BANNER.jpg" alt="Banner">
    </section>

    <section class="sort-bar">
        <div class="sort-area">
            <p>Sort By:</p>
            <div class="sort-buttons">
                <button class="active">Featured</button>
                <button>Latest</button>
                <button>Best Selling</button>
                <a href="product.php?sort=high"><button>Price: High to Low</button></a>
            </div>
        </div>
    </section>

    <section class="product-grid">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/<?= $row['product_image']; ?>" class="default-img">
                <img src="assets/PRODUCTS/<?= $row['product_image_hover']; ?>" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3><?= htmlspecialchars($row['product_name']); ?></h3>
            <p>₱<?= $row['price']; ?></p>
        </div>
        <?php endwhile; ?>

        

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 3</h3>
            <p>₱4,150</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 4</h3>
            <p>₱3,450</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 5</h3>
            <p>₱2,999</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 6</h3>
            <p>₱3,199</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 7</h3>
            <p>₱5,399</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 8</h3>
            <p>₱4,899</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 9</h3>
            <p>₱6,000</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 10</h3>
            <p>₱3,450</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 11</h3>
            <p>₱3,850</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 12</h3>
            <p>₱2,850</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 13</h3>
            <p>₱2,999</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 14</h3>
            <p>₱6,149</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 15</h3>
            <p>₱3,250</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 16</h3>
            <p>₱5,750</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 17</h3>
            <p>₱4,650</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 18</h3>
            <p>₱3,999</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 19</h3>
            <p>₱2,999</p>
        </div>

        <div class="product-card">
            <div class="img-container">
                <img src="assets/PRODUCTS/CHAIR.jpg" class="default-img">
                <img src="assets/PRODUCTS/CHAIR2.jpg" class="hover-img">
                <button class="add-btn"><img src="assets/PRODUCTS/ADDICON.png"></button>
            </div>
            <h3>Chair 20</h3>
            <p>₱6,499</p>
        </div>

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
