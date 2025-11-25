<?php
session_start();
include "../includes/db.php";

if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
    header("Location: ../login");
    exit;
}

$user_id = $_SESSION['user_id'];

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
    
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

$sql = "SELECT c.cart_id, c.quantity, c.color, c.material, c.sizes, p.product_name, p.price, p.product_img
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
            <div class="order-card-container">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #ccc; padding-bottom: 12px;">
                    <p><strong>Order ID:</strong> 1001</p>
                    <p><strong>Payment:</strong> Card </p>
                    <p><strong>Payment Status:</strong> Paid</p>
                    <p><strong>Order Status:</strong> Shipped</p>
                    <p><strong>Order Date:</strong> 2025-11-25</p>
                </div>
                <div class="order-card">
                    <div class="order-item">
                        <div class="item-img">
                        <img src="/Maiden-Home/assets/Products/Soft-Boucle-Corner-Sofabed-Angle-1.jpeg" alt="Product Image" width="100">
                        </div>
                        <div class="item-details">
                            <div class="item-details-header">
                                <p>Soft-Boucle-Corner-Sofabed</p>
                                <p class="price">₱68,149.00</p>
                            </div>
                            <div class="product-detail">
                                <p><span style="font-weight: 500;">Color:</span> Natural</p> 
                                <p><span style="font-weight: 500;">Material:</span> Soft Boucle</p>  
                                <p><span style="font-weight: 500;">Size:</span> 91.5x247x121</p>
                            </div>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="item-img">
                        <img src="/Maiden-Home/assets/Products/Soft-Boucle-Corner-Sofabed-Angle-1.jpeg" alt="Product Image" width="100">
                        </div>
                        <div class="item-details">
                            <div class="item-details-header">
                                <p>Soft-Boucle-Corner-Sofabed</p>
                                <p class="price">₱68,149.00</p>
                            </div>
                            <div class="product-detail">
                                <p><span style="font-weight: 500;">Color:</span> Natural</p> 
                                <p><span style="font-weight: 500;">Material:</span> Soft Boucle</p>  
                                <p><span style="font-weight: 500;">Size:</span> 91.5x247x121</p>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>

        <div class="order-track">track</div>
        <div class="personal-details">details</div>
    </div>

    <?php include "../includes/footer.php" ?>
</body>
</html>
