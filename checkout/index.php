<?php 
session_start();
include "../includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php"); 
    exit;
}

$user_id = $_SESSION['user_id'];
$conn_status = $conn;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['add_name'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $payment_method = 'cod'; 

    if ($conn_status->connect_error) {
        die("Connection failed: " . $conn_status->connect_error);
    }
    try {
        $sql_address = "INSERT INTO address (user_id, user_firstname, user_lastname, phone_number, add_name, region, province, city, barangay) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_address = $conn_status->prepare($sql_address);
        $stmt_address->bind_param("issssssss", $user_id, $fname, $lname, $phone, $address, $region, $province, $city, $barangay);
        
        if (!$stmt_address->execute()) {
            throw new Exception("Address Insertion Error: " . $stmt_address->error);
        }
        $address_id = $conn_status->insert_id;
        $stmt_address->close();

        $sql_cart_items = "SELECT c.product_id, c.quantity, p.price, c.color, c.material, c.sizes
                            FROM addtocart c
                            JOIN products p ON c.product_id = p.product_id
                            WHERE c.user_id = ?";
        $stmt_cart = $conn_status->prepare($sql_cart_items);
        $stmt_cart->bind_param("i", $user_id);
        $stmt_cart->execute();
        $cart_result = $stmt_cart->get_result();
        $cart_items_for_order = [];
        while ($row = $cart_result->fetch_assoc()) {
            $cart_items_for_order[] = $row;
        }
        $stmt_cart->close();
        if (empty($cart_items_for_order)) {
            throw new Exception("Your cart is empty. Cannot place an order.");
        }

        $sql_order = "INSERT INTO `order` (user_id, product_id, address_id, total_order, payment, payment_status, order_status, color, material, sizes) 
                    VALUES (?, ?, ?, ?, ?, 'pending', 'order placed', ?, ?, ?)"; 
        $stmt_order = $conn_status->prepare($sql_order);
        
        foreach ($cart_items_for_order as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $color = $item['color'];
            $material = $item['material'];
            $sizes = $item['sizes'];
            $item_total = $price * $quantity;
            $stmt_order->bind_param("iiiissss", $user_id, $product_id, $address_id, $item_total, $payment_method, $color, $material, $sizes);
            if (!$stmt_order->execute()) {
                throw new Exception("Order Item Insertion Error: " . $stmt_order->error);
            }
        }
        $stmt_order->close(); 
        $sql_clear_cart = "DELETE FROM addtocart WHERE user_id = ?";
        $stmt_clear_cart = $conn_status->prepare($sql_clear_cart);
        $stmt_clear_cart->bind_param("i", $user_id);
        
        if (!$stmt_clear_cart->execute()) {
            throw new Exception("Cart Clearing Error: " . $stmt_clear_cart->error);
        }
        $stmt_clear_cart->close();
        header("Location: ../cart");
        exit;
    } catch (Exception $e) {
        echo "Error placing order: " . $e->getMessage();
    }
}
$sql2 = "SELECT c.cart_id, c.quantity, c.color, c.material, c.sizes, p.product_name, p.price, p.product_img, p.product_id
        FROM addtocart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = ?";
$stmt = $conn_status->prepare($sql2);
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
$stmt->close();
?>
<html>
    <head>
        <title>Checkout | Maiden Home</title>
        <link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="../css/nav-bar.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/scroll.css">
        <link rel="stylesheet" href="checkout.css" />

        <style>
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }
            input[type=number] {
            -moz-appearance: textfield;
            }
        </style>
    </head>
    <body>
        
        <?php include("../includes/nav-bar.php"); ?>
        <div class="checkout-wrapper">
            <div class="checkout-left">
                <h1>Checkout</h1>
                <div class="process-step-container">
                    <div class="process-step-active">Information</div>
                    <div class="process-step">Payment Method</div>
                    <div class="process-step">Confirmation</div>
                </div>
                <h3>Contact Information</h3>
                <form class="checkout-form" method="POST">
                    <div class="form-row">
                        <div class="input-container">
                            <input type="text" id="fname" name="fname" placeholder=" " required>
                            <label for="fname">First Name</label>
                        </div>
                        <div class="input-container">
                            <input type="text" id="lname" name="lname" placeholder=" " required>
                            <label for="lname">Last Name</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-container">
                            <input type="number" id="phone" name="phone" placeholder=" " required maxlength="11">
                            <label for="phone">Phone Number</label>
                        </div>
                        <div class="input-container">
                            <input type="email" id="email" name="email" placeholder=" " required>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <h3>Shipping Address</h3>
                    <div class="form-row">
                        <div class="input-container">
                            <input type="text" id="add_name" name="add_name" placeholder=" " required>
                            <label for="add_name">Street Name, Building, House No.</label>
                        </div>
                    </div>
                    <div class="form-row wide">
                        <div class="input-container">
                            <select id="region" name="region" required>
                                <option value="">Select Region</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <select id="province" name="province" required>
                                <option value="">Select Province</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row wide">
                        <div class="input-container">
                            <select id="city" name="city" required>
                                <option value="">Select City/Municipality</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <select id="barangay" name="barangay" required>
                                <option value="">Select Barangay</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="place_order" class="checkout-btn">Proceed to Payment Method</button>
                </form>
                </div>
            
            <div class="checkout-right">
                <h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="m15 11-1 9" /> <path d="m19 11-4-7" /> <path d="M2 11h20" /> <path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4" /> <path d="M4.5 15.5h15" /> <path d="m5 11 4-7" /> <path d="m9 11 1 9" /> </svg>
                    Order Summary
                </h2>
                <?php if (empty($cart_items)): ?>
                <p>Your cart is empty.</p>
                <?php else: ?>
                <div class="cart-container">
                    <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item">
                        <div class="item-image"><img src="../assets/PRODUCTS/<?php echo htmlspecialchars($item['product_img']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" width="100"></div>
                        <div class="item-details">
                            <div class="item-details-header">
                                <h4>
                                    <?php echo $item['quantity']; ?>x
                                    <?php echo htmlspecialchars($item['product_name']); ?>
                                </h4>
                                <span class="price">₱
                                    <?php echo number_format($item['price'], 2); ?>
                                </span>
                            </div>
                            <p><span style="font-weight: 500;">Color:</span>
                                <?php echo htmlspecialchars($item['color']); ?>
                            </p>
                            <p><span style="font-weight: 500;">Material:</span>
                                <?php echo htmlspecialchars($item['material']); ?>
                            </p>
                            <p><span style="font-weight: 500;">Size:</span>
                                <?php echo htmlspecialchars($item['sizes']); ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div style="display: flex; flex-direction: column; gap: 12px; margin: 20px 0;">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>₱
                            <?php echo number_format($total, 2); ?>
                        </span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping Fee:</span>
                        <span>Free</span>
                    </div>
                    <hr style="margin: 0 20px; background-color: #e6e6e6;">
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>₱
                            <?php echo number_format($total, 2); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../includes/footer.php" ?>
        <script src="check.js"></script>
    </body>
</html>