<?php
session_start();
include "../includes/db.php";

$user_id = $_SESSION['user_id'] ?? 1;
if (isset($_POST['action'])) {
    $cart_id = intval($_POST['cart_id']);
    if ($_POST['action'] === 'increase') {
        $stmt = $conn->prepare("UPDATE addtocart SET quantity = quantity + 1 WHERE cart_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $cart_id, $user_id);
        $stmt->execute();
    } elseif ($_POST['action'] === 'decrease') {
        $stmt = $conn->prepare("UPDATE addtocart SET quantity = GREATEST(quantity - 1, 1) WHERE cart_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $cart_id, $user_id);
        $stmt->execute();
    } elseif ($_POST['action'] === 'remove') {
        $stmt = $conn->prepare("DELETE FROM addtocart WHERE cart_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $cart_id, $user_id);
        $stmt->execute();
    }
}

$sql = "SELECT c.cart_id, c.quantity, p.product_name, p.price, p.product_img, p.color, p.material, p.size
        FROM addtocart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$cart_items = [];
$subtotal = 0;

while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row;
    $subtotal += $row['price'] * $row['quantity'];
}
$total = $subtotal;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | Maiden Home</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <script src="../js/script.js"></script>
</head>
<body>
     <?php include "../includes/nav-bar.php" ?>
    <div class="cart-container">
        <div class="cart-left">
            <h1 class="cart-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                Your Cart
            </h1>
            <hr>
            <?php if (empty($cart_items)): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item">
                        <div class="product-box">
<<<<<<< HEAD
                            <img src="../assets/PRODUCTS/<?php echo htmlspecialchars($item['product_img']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" width="100">
=======
                            <img src="../assets/PRODUCTS/<?php echo htmlspecialchars($item['product_img']); ?>">
>>>>>>> 0e24dab2975596f08310c4916b3455dbf13d540a
                        </div>
                        <div class="item-info">
                            <div class="name-price">
                                <p class="product-name"><?php echo htmlspecialchars($item['product_name']); ?></p>
                                <p class="product-price">₱<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                            <div class="product-detail">
                                <p><span style="font-weight: 500;">Color:</span> <?php echo htmlspecialchars($item['color']); ?></p> 
                                <p><span style="font-weight: 500;">Material:</span> <?php echo htmlspecialchars($item['material']); ?></p>  
                                <p><span style="font-weight: 500;">Size:</span> <?php echo htmlspecialchars($item['size']); ?></p>
                            </div>
                            <div class="options">
                                <form method="post" class="quantity">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                    <button type="submit" name="action" value="decrease" class="minus-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                                    </button>
                                    <p><?php echo $item['quantity']; ?></p>
                                    <button type="submit" name="action" value="increase" class="plus-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                    </button>
                                </form>
                                <div class="item-actions">
                                    <form method="post">
                                        <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                        <button type="submit" name="action" value="favourite" class="favourite-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
                                            <span>Add to Favorites</span>
                                        </button>
                                        <button type="submit" name="action" value="remove" class="remove-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            <span>Remove</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="cart-right">
            <h2 class="cart-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-basket-icon lucide-shopping-basket"><path d="m15 11-1 9"/><path d="m19 11-4-7"/><path d="M2 11h20"/><path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4"/><path d="M4.5 15.5h15"/><path d="m5 11 4-7"/><path d="m9 11 1 9"/></svg>
                Order Summary
            </h2>
            <div class="summary-row">
                <p>Subtotal (<?php echo count($cart_items); ?> items)</p>
                <b>₱<?php echo number_format($subtotal, 2); ?></b>
            </div>
            <div class="summary-row">
                <p>Shipping Fee</p>
                <b>Free</b>
            </div>
            <hr>
            <div class="summary-row">
                <p>Total</p>
                <h2>₱<?php echo number_format($total, 2); ?></h2>
            </div>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>
</body>
</html>