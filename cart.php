<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | Maiden Home</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="css/nav-bar.css">
</head>
<body>
    <?php include("./includes/nav-bar.php") ?>

    <div class="cart-container">
        <div class="cart-left">
            <h2 class="cart-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                Your Cart
            </h2>
            <hr>

            <div class="cart-item">
                <div class="product-box"></div>
                <div class="item-info">
                    <p class="product-name">Wooden Chair</p>
                    <p class="product-detail">Color: Brown | Material: Oak | Size: Standard</p>
                    <p class="product-price">₱3,500</p>
                    <div class="quantity">
                        <button class="minus-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                        </button>
                        <p>1</p>
                        <button class="plus-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        </button>
                    </div>
                </div>
                <div class="item-actions">
                    <button class="remove-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        <span>Remove</span>
                    </button>
                    <button class="favourite-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
                        <span>Favourites</span>
                    </button>
                </div>
            </div>

            <div class="cart-item">
                <div class="product-box"></div>
                <div class="item-info">
                    <p class="product-name">Leather Sofa</p>
                    <p class="product-detail">Color: Black | Material: Leather | Seats: 3</p>
                    <p class="product-price">₱15,200</p>
                    <div class="quantity">
                        <button class="minus-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                        </button>
                        <p>2</p>
                        <button class="plus-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        </button>
                    </div>
                </div>
                <div class="item-actions">
                    <button class="remove-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        <span>Remove</span>
                    </button>
                    <button class="favourite-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
                        <span>Favourites</span>
                    </button>
                </div>
            </div>

            <div class="cart-item">
                <div class="product-box"></div>
                <div class="item-info">
                    <p class="product-name">Dining Table</p>
                    <p class="product-detail">Color: White | Material: Wood | Seats: 6</p>
                    <p class="product-price">₱8,750</p>
                    <div class="quantity">
                        <button class="minus-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                        </button>
                        <p>1</p>
                        <button class="plus-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        </button>
                    </div>
                </div>
                <div class="item-actions">
                    <button class="remove-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        <span>Remove</span>
                    </button>
                    <button class="favourite-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
                        <span>Favourites</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="cart-right">
            <h2 class="cart-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 11-1 9"/><path d="m19 11-4-7"/><path d="M2 11h20"/><path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4"/><path d="M4.5 15.5h15"/><path d="m5 11 4-7"/><path d="m9 11 1 9"/></svg>
                Order Summary
            </h2>
            <hr>
            <div class="summary-items-count">
                <p>Items: 4</p>
            </div>
            <div class="summary-row">
                <p>Subtotal</p>
                <p class="black-price">₱27,450</p>
            </div>
            <div class="summary-row">
                <p>Shipping</p>
                <p class="black-price">Free</p>
            </div>
            <hr>
            <div class="summary-row total">
                <p>Total</p>
                <p class="black-price">₱27,450</p>
            </div>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>
</body>
</html>
