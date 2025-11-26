<?php   
session_start();
include "../includes/db.php";

if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
    header("Location: ../login");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT c.order_id, c.quantity, c.color, c.material, c.sizes, p.product_name, c.total_price, p.product_img, c.payment, c.payment_status, c.order_status
        FROM `order` c
        JOIN address_table a ON c.address_id = a.address_id
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
    $subtotal += $row['total_price'] * $row['quantity'];
}
$total = $subtotal;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders | Maiden Home</title>
    <link rel="stylesheet" href="order.css">
    <link rel="stylesheet" href="../css/nav-bar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/scroll.css">
    <link rel="stylesheet" href="../css/all.css">
</head>
<body>
    <?php include "../includes/nav-bar.php" ?>

    <div class="order-container">
        <div class="order-content">
            <h1 style="margin-bottom: 24px;">Your Orders</h1>
            <?php foreach ($cart_items as $item): ?>
            <div class="order-card-container">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc; padding-bottom: 12px;">
                    <p><strong>Order ID:</strong> <?php echo htmlspecialchars($item['order_id']); ?></p>
                    <p><strong>Payment:</strong> <?php echo htmlspecialchars($item['payment']); ?> </p>
                    <p><strong>Payment Status:</strong> <?php echo htmlspecialchars($item['payment_status']); ?> </p>
                    <p><strong>Order Status:</strong> <?php echo htmlspecialchars($item['order_status']); ?> </p>
                    <p><strong>Delivery Date:</strong> In 3 Days </p>
                </div>
                <div class="order-card">
                    <div class="order-item">
                        <div class="item-img">
                        <img src="/Maiden-Home/assets/Products/<?php echo htmlspecialchars($item['product_img']); ?>" alt="Product Image" width="100">
                        </div>
                        <div class="item-details">
                            <div class="item-details-header">
                                <p>Soft-Boucle-Corner-Sofabed</p>
                                <p class="price">₱<?php echo htmlspecialchars($item['total_price']); ?> </p>
                            </div>
                            <div class="product-detail">
                                <p><span style="font-weight: 500;">Color:</span> <?php echo htmlspecialchars($item['color']); ?>l</p> 
                                <p><span style="font-weight: 500;">Material:</span> <?php echo htmlspecialchars($item['material']); ?></p>  
                                <p><span style="font-weight: 500;">Size:</span> <?php echo htmlspecialchars($item['sizes']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="total">
                        <p>Total Items: <?php echo htmlspecialchars($item['quantity']); ?> Total: ₱<?php echo htmlspecialchars($item['total_price']); ?> </p>
                    </div>    
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include "../includes/footer.php" ?>
</body>
</html>
