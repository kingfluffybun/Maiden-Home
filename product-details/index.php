<?php
session_start();
include "../includes/db.php";

if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['role'] = $_COOKIE['role'];
}

$product_id = intval($_GET['product_id'] ?? $_POST['product_id'] ?? 0);
if ($product_id <= 0) {
    echo "<p>No product selected.</p>";
    exit;
}

$current_product_id = $_GET['product_id'] ?? null;

if (!isset($_SESSION['counter']) || !isset($_SESSION['product_id']) || $_SESSION['product_id'] != $current_product_id) {
    $_SESSION['counter'] = 1;
    $_SESSION['product_id'] = $current_product_id;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if (isset($_POST['product_id']) && $_POST['product_id'] == $current_product_id) {

        if ($_POST['action'] === 'add') {
            $_SESSION['counter']++;
        } elseif ($_POST['action'] === 'subtract') {
            $_SESSION['counter']--;
            if ($_SESSION['counter'] < 1) {
                $_SESSION['counter'] = 1;
            }
        }
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

$quantity = intval($_SESSION['counter'] ?? 1);
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Product not found.</p>";
    exit;
}

$product = $result->fetch_assoc();
$color    = $_POST['color']    ?? $product['color1'];
$material = $_POST['material'] ?? $product['mat1'];
$sizes    = $_POST['size']     ?? $product['size1'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {

    if (empty($_SESSION['user_id'])) {
        header("Location: ../login");
        exit;
    }

    $stmt_check = $conn->prepare("SELECT stocks FROM products WHERE product_id = ?");
    $stmt_check->bind_param("i", $product_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if (!$result_check || $result_check->num_rows === 0) {
        die("Error: Product not found.");
    }

    $products = $result_check->fetch_assoc();
    $stock = (int)$products['stocks'];
    $stmt_check->close();

    $user_identifier = $_SESSION['user_id'];
    $stmt_get_id = $conn->prepare("SELECT user_id FROM user WHERE user_id = ?");
    $stmt_get_id->bind_param("s", $user_identifier);
    $stmt_get_id->execute();
    $result_id = $stmt_get_id->get_result();
    $row = $result_id->fetch_assoc();
    $user_id = (int)$row['user_id'];
    $stmt_get_id->close();
    $stmt_cart = $conn->prepare("SELECT cart_id, quantity 
        FROM addtocart 
        WHERE user_id = ? 
          AND product_id = ? 
          AND color = ? 
          AND material = ? 
          AND sizes = ?");
    $stmt_cart->bind_param("iisss", $user_id, $product_id, $color, $material, $sizes);
    $stmt_cart->execute();
    $result_cart = $stmt_cart->get_result();

    if ($result_cart->num_rows > 0) {
        $row_cart = $result_cart->fetch_assoc();
        $cart_id = $row_cart['cart_id'];
        $existing_quantity = (int)($row_cart['quantity'] ?? 0);
        $new_quantity = $existing_quantity + $quantity;
        if ($new_quantity > $stock) die("Error: Quantity exceeds stock.");
        $stmt_update = $conn->prepare("UPDATE addtocart SET quantity = ? WHERE cart_id = ?");
        $stmt_update->bind_param("ii", $new_quantity, $cart_id);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        if ($quantity > $stock) die("Error: Quantity exceeds stock.");
        $stmt_insert = $conn->prepare("INSERT INTO addtocart (user_id, product_id, quantity, color, material, sizes)
            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("iissss", $user_id, $product_id, $quantity, $color, $material, $sizes);
        $stmt_insert->execute();
        $stmt_insert->close();
    }
    $stmt_cart->close();
}
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
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/all.css">
    <script src="../js/script.js"></script>
    <script src="script.js"></script>

</head>
    <?php include "../includes/nav-bar.php"; ?>
<body>
     <div class="container">
            <div class="product-container">
                <!--Para siyang navigation starting kung san siya nag simula papunta sa site na to-->
                <div class="breadcrumb">
                    <a href="../">Home</a>
                    <p> > </p>
                    <a href="../product/?category_id=<?php echo htmlspecialchars($product['category_id'])?>"><?php echo htmlspecialchars($product['category_name']); ?></a>
                    <p> > </p>
                    <a href="../product/?sub_id=<?php echo htmlspecialchars($product['sub_id'])?>"><?php echo htmlspecialchars($product['sub_name']); ?></a>
                    <p> > </p>
                    <p><?php echo htmlspecialchars($product['product_name']); ?></p>
                </div>
                <div class="product-image">
                    <!--Product Main Image-->
                    <div class="main-product">
                        <img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="600">
                    </div>
                    <div class="product-imgs-container">
                        <div class="prev-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                        </div>
                        <div class="product-angles">
                            <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img_hover']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                            <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                            <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img2']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                            <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img3']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                            <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img4']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                            <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['product_img5']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                            <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['color1_img']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div> 
                            <?php if (!empty($product['color2'])): ?>
                                <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['color2_img']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                            <?php endif ?>
                            <?php if (!empty($product['color3'])): ?>
                                <div><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['color3_img']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" width="100"></div>
                            <?php endif ?>
                        </div>
                        <div class="next-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                        </div>
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
                <div>
                    <form method="post" style="display: flex; gap: 8px; flex-direction: column; width: 100%;">
                    <div class="select-container">
                        <p>Select Color:</p>
                        <div class="select">
                            <?php if (!empty($product['color1']) || !empty($product['color2']) || !empty($product['color3'])): ?>
                            <?php if (!empty($product['color1'])): ?>
                                <input type="radio" name="color" id="color1" value="<?php echo htmlspecialchars($product['color1']); ?>" data-img-src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['color1_img']); ?>">
                                <label for="color1"><?php echo htmlspecialchars($product['color1']); ?></label>
                            <?php endif; ?>

                            <?php if (!empty($product['color2'])): ?>
                                <input type="radio" name="color" id="color2" value="<?php echo htmlspecialchars($product['color2']); ?>" data-img-src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['color2_img']); ?>">
                                <label for="color2"><?php echo htmlspecialchars($product['color2']); ?></label>
                            <?php endif; ?>

                            <?php if (!empty($product['color3'])): ?>
                                <input type="radio" name="color" id="color3" value="<?php echo htmlspecialchars($product['color3']); ?>" data-img-src="../assets/PRODUCTS/<?php echo htmlspecialchars($product['color3_img']); ?>">
                                <label for="color3"><?php echo htmlspecialchars($product['color3']); ?></label>
                            <?php endif; ?>
                            <?php else: ?>
                            <p style="color: gray;">No size options available for this product.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--Material-->
                    <div class="select-container">
                        <p>Select Material:</p>
                        <div class="select">
                            <?php if (!empty($product['mat1']) || !empty($product['mat2']) || !empty($product['mat3'])): ?>
                            <?php if (!empty($product['size1'])): ?>
                                <input type="radio" name="material" id="mat1" value="<?php echo htmlspecialchars($product['mat1']); ?>">
                                <label for="mat1"><?php echo htmlspecialchars($product['mat1']); ?></label>
                            <?php endif; ?>

                            <?php if (!empty($product['mat2'])): ?>
                            <input type="radio" name="material" id="mat2" value="<?php echo htmlspecialchars($product['mat2']); ?>">
                            <label for="mat2"><?php echo htmlspecialchars($product['mat2']); ?></label>
                            <?php endif; ?>

                            <?php if (!empty($product['mat3'])): ?>
                            <input type="radio" name="material" id="mat3" value="<?php echo htmlspecialchars($product['mat3']); ?>">
                            <label for="mat3"><?php echo htmlspecialchars($product['mat3']); ?></label>
                            <?php endif; ?>
                            <?php else: ?>
                            <p style="color: gray;">No size options available for this product.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--Sizes-->
                    <div class="select-container">
                        <p>Select Size:</p>
                        <div class="select">
                            <?php if (!empty($product['size1']) || !empty($product['size2']) || !empty($product['size3'])): ?>
                            <?php if (!empty($product['size1'])): ?>
                                <input type="radio" name="size" id="size1" value="<?php echo htmlspecialchars($product['size1']); ?>">
                                <label for="size1"><?php echo htmlspecialchars($product['size1']); ?></label>
                            <?php endif; ?>

                            <?php if (!empty($product['size2'])): ?>
                            <input type="radio" name="size" id="size2" value="<?php echo htmlspecialchars($product['size2']); ?>">
                            <label for="size2"><?php echo htmlspecialchars($product['size2']); ?></label>
                            <?php endif; ?>

                            <?php if (!empty($product['size3'])): ?>
                            <input type="radio" name="size" id="size3" value="<?php echo htmlspecialchars($product['size3']); ?>">
                            <label for="size3"><?php echo htmlspecialchars($product['size3']); ?></label>
                            <?php endif; ?>
                            <?php else: ?>
                            <p style="color: gray;">No size options available for this product.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="shop-guarantee">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <p>Shop with complete confidence, backed by our reliable 10-year warranty. Your order is protected with secure, encrypted payments and includes free shipping to your door.</p>
                    </div>
                </div>
                <div class="shop-actions">
                    <!--Quantity-->
                    <div class="quantity-container">
                        <button type="submit" name="action" value = 'subtract'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus-icon lucide-minus"><path d="M5 12h14"/></svg></button>
                        <p><?php echo $_SESSION['counter']; ?></p>
                        <button type="submit" name="action" value = 'add'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg></button>
                    </div>
                    <div class="add-to-cart">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <button type="submit" name="add_to_cart">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                            Add to Cart
                        </button>
                    </div>
                    <button type="button" class="like"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include "../includes/footer.php" ?>
    </body>
</html>