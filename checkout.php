<html>
<head>
  <title>Checkout | Maiden Home</title>
  <link rel="stylesheet" href="./css/nav-bar.css">
  <link rel="stylesheet" href="checkout.css" />
</head>
<body>
  <?php include("./includes/nav-bar.php"); ?>

  <div class="checkout-wrapper">
    <div class="checkout-left">
      <h1>Checkout</h1>
      <h3>Contact Information</h3>
      <form class="checkout-form">
        <div class="form-row">
          <div class="input-container">
            <input type="text" id="fname" placeholder=" " required>
            <label for="fname">First Name</label>
          </div>
          <div class="input-container">
            <input type="text" id="lname" placeholder=" " required>
            <label for="lname">Last Name</label>
          </div>
        </div>
        <div class="form-row">
          <div class="input-container">
            <input type="text" id="phone" placeholder=" " required>
            <label for="phone">Phone Number</label>
          </div>
          <div class="input-container">
            <input type="email" id="email" placeholder=" " required>
            <label for="email">Email</label>
          </div>
        </div>
        <h3>Shipping Address</h3>
        <div class="form-row">
          <div class="input-container">
            <input type="text" id="address" placeholder=" " required>
            <label for="address">Street Name, Building, House No.</label>
          </div>
        </div>
        <div class="form-row wide">
          <div class="input-container">
            <input type="text" id="region" placeholder=" " required>
            <label for="region">Region</label>
          </div>
          <div class="input-container">
            <input type="text" id="province" placeholder=" " required>
            <label for="province">Province</label>
          </div>
          <div class="input-container">
            <input type="text" id="city" placeholder=" " required>
            <label for="city">City</label>
          </div>
          <div class="input-container">
            <input type="text" id="barangay" placeholder=" " required>
            <label for="barangay">Barangay</label>
          </div>
        </div>
      </form>

      <h3>Payment Method</h3>
      <div class="payment-methods">
        <div class="payment-option selected" id="card">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg><span>Card</span>
        </div>
        <div class="payment-option" id="ewallet">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"/><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"/></svg><span>E-Wallet</span>
        </div>
        <div class="payment-option" id="cod">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"/><path d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/><path d="m2 16 6 6"/><circle cx="16" cy="9" r="2.9"/><circle cx="6" cy="5" r="3"/></svg><span>Cash on Delivery</span>
        </div>
      </div>
    </div>

    <div class="checkout-right">
      <h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 11-1 9"/><path d="m19 11-4-7"/><path d="M2 11h20"/><path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4"/><path d="M4.5 15.5h15"/><path d="m5 11 4-7"/><path d="m9 11 1 9"/></svg> Order Summary
      </h2>

      <div class="cart-item">
        <div class="item-image"></div>
        <div class="item-details">
          <div class="item-details-header">
            <h4>1x Mattress</h4>
            <span class="price">₱9,500.00</span>
          </div>
          <p>Color: Brown</p>
          <p>Material: Almond wood and Aluminum Metal</p>
          <p>Size: 1000 cm x 600 cm</p>
        </div>
      </div>

      <div class="cart-item">
        <div class="item-image"></div>
        <div class="item-details">
          <div class="item-details-header">
            <h4>1x Lamp</h4>
            <span class="price">₱3,000.00</span>
          </div>
          <p>Color: Beige</p>
          <p>Material: Aluminum Metal</p>
          <p>Size: 70 cm x 30 cm</p>
        </div>
      </div>

      <div class="summary-row">
        <span>Subtotal:</span>
        <span>₱12,500.00</span>
      </div>
      <div class="summary-row">
        <span>Shipping Fee:</span>
        <span>Free</span>
      </div>

      <hr class="before-total">
      
      <div class="summary-row total">
        <span>Total:</span>
        <span>₱12,500.00</span>
      </div>

      <button class="checkout-btn">Place Order</button>
    </div>
  </div>
</body>
</html>
