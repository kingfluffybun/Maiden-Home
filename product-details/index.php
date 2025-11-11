<?php
session_start();
include "../includes/db.php";
//stay logged in, if nag close sila ng browser or site
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['role'] = $_COOKIE['role'];
}

if (!isset($_GET['product_id'])) {
    echo "<p>No product selected.</p>";
    exit;
}

$product_id = intval($_GET['product_id']);
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Product not found.</p>";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> | Maiden Home</title>
    <link rel="stylesheet" href="../css/scroll.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="product-detail.css">
    <script src="../js/script.js" defer></script>
</head>
    <?php include "../includes/nav-bar.php"; ?>
<body>
    <div class="container">
            <div class="product-container">
                <!--Para siyang navigation starting kung san siya nag simula papunta sa site na to-->
                <div class="breadcrumb"><p>Home > Beds & Mattresses > Beds > <?php echo htmlspecialchars($product['product_name']); ?></div>
                <div class="product-image">
                    <!--Product Main Image-->
                    <div class="main-product">
                        <img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="600">
                    </div>
                    <div class="product-angles">
                        <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img2']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                        <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img3']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                        <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img4']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                        <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img5']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                    </div>
                </div>
            </div>
            <div class="product-detail">
                <!--Name of the Product-->
                <b><?php echo htmlspecialchars($product['product_name']); ?></b>
                <div class="description-content">
                    <!--Product Description-->
                    <p><?php echo htmlspecialchars($product['product_description']); ?></p>
                </div>
                <div class="description-dropdown">
                    <button onclick="toggleDescription(this)">
                        <p>View Full Product Description</p>
                        <span id="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
                        </span>
                    </button>
                </div>
                <hr>
                <!--Product Price-->
                <h2>₱<?php echo number_format($product['price'], 2); ?></h2>
                <hr>
                <!--Color-->
                <div style="display: flex; gap: 8px; flex-direction: column; width: 100%;">
                    <div class="select-container">
                        <p>Select Color:</p>
                        <div class="select">
                            <form>
                                <input type="radio" name="color" id="color1" value="<?php echo htmlspecialchars($product['color1']); ?>">
                                <label for="color1"><?php echo htmlspecialchars($product['color1']); ?></label>

                                <input type="radio" name="color" id="color2" value="<?php echo htmlspecialchars($product['color2']); ?>">
                                <label for="color2"><?php echo htmlspecialchars($product['color2']); ?></label>

                                <input type="radio" name="color" id="color3" value="<?php echo htmlspecialchars($product['color3']); ?>">
                                <label for="color3"><?php echo htmlspecialchars($product['color3']); ?></label>
                            </form>
                        </div>
                    </div>
                    <!--Material-->
                    <div class="select-container">
                        <p>Select Material:</p>
                        <div class="select">
                            <form>
                                <input type="radio" name="material" id="mat1" value="<?php echo htmlspecialchars($product['mat1']); ?>">
                                <label for="mat1"><?php echo htmlspecialchars($product['mat1']); ?></label>

                                <input type="radio" name="material" id="mat2" value="<?php echo htmlspecialchars($product['mat2']); ?>">
                                <label for="mat2"><?php echo htmlspecialchars($product['mat2']); ?></label>

                                <input type="radio" name="material" id="mat3" value="<?php echo htmlspecialchars($product['mat3']); ?>">
                                <label for="mat3"><?php echo htmlspecialchars($product['mat3']); ?></label>
                            </form>
                        </div>
                    </div>
                    <!--Sizes-->
                    <div class="select-container">
                        <p>Select Size:</p>
                        <div class="select">
                            <form>
                                <input type="radio" name="size" id="size1" value="<?php echo htmlspecialchars($product['size1']); ?>">
                                <label for="size1"><?php echo htmlspecialchars($product['size1']); ?></label>

                                <input type="radio" name="size" id="size2" value="<?php echo htmlspecialchars($product['size2']); ?>">
                                <label for="size2"><?php echo htmlspecialchars($product['size2']); ?></label>

                                <input type="radio" name="size" id="size3" value="<?php echo htmlspecialchars($product['size3']); ?>">
                                <label for="size3"><?php echo htmlspecialchars($product['size3']); ?></label>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="shop-guarantee">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <p>Shop with complete confidence, backed by our reliable 10-year warranty. Your order is protected with secure, encrypted payments and includes free shipping to your door.</p>
                </div>
                <div class="shop-actions">
                    <!--Quantity-->
                    <form method="post" class="quantity-container">
                        <button type="submit" name="action"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus-icon lucide-minus"><path d="M5 12h14"/></svg></button>
                        <p>1</p>
                        <button type="submit" name="action"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg></button>
                    </form>
                    <div class="add-to-cart">
                        <button type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                            Add to Cart
                        </button>
                    </div>
                    <button type="button" class="like"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg></button>
                </div>
            </div>
        </div>
    </body>
</html>