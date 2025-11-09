<?php
session_start();
//stay logged in, if nag close sila ng browser or site
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_email'] = $_COOKIE['user_email'];
    $_SESSION['role'] = $_COOKIE['role'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Name</title>
        <link rel="stylesheet" href="../css/scroll.css">
        <link rel="stylesheet" href="../css/nav-bar.css">
        <link rel="stylesheet" href="product-detail.css">
        <script src="../js/script.js" defer></script>
    </head>
    <?php include "../includes/nav-bar.php" ?>
    <body>
        <div class="container">
            <div class="product-container">
                <!--Para siyang navigation starting kung san siya nag simula papunta sa site na to-->
                <div class="breadcrumb"><p>Home > Beds & Mattresses > Beds > Minimalist Bed Frame</p></div>
                <div class="product-image">
                    <!--Product Main Image-->
                    <div class="main-product"></div>
                    <div class="product-angles">
                        <div><!--angle 1--></div>
                        <div><!--angle 2--></div>
                        <div><!--angle 3--></div>
                        <div><!--angle 4--></div>
                    </div>
                </div>
            </div>
            <div class="product-detail">
                <!--Product Name-->
                <b>Minimalist Bed Frame</b>
                <div class="description-content">
                    <!--Product Description-->
                    <p>Discover the beauty of simplicity with our minimalist bed frame, designed to be the quiet, grounding element in your bedroom. Its sleek, geometric form and low-profile design create an open, airy feel, making your room feel larger and more tranquil. Crafted from [Material], this frame features a solid slatted platform base that provides reliable support for your mattress without the need for a box spring. By focusing on essential form and function, this bed frame is the perfect foundation for an intentional, uncluttered, and peaceful living space.</p>
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
                <h2>₱9,999</h2>
                <hr>
                <div class="select-color">
                    <p>Select Color:</p>
                    <div class="color">
                        <input type="checkbox">
                        <input type="checkbox">
                        <input type="checkbox">
                    </div>
                </div>
                <div class="shop-guarantee">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                    <p>Shop with complete confidence, backed by our reliable 10-year warranty. Your order is protected with secure, encrypted payments and includes free shipping to your door.</p>
                </div>
                <div class="shop-actions">
                    <div class="quantity-container">
                        <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus-icon lucide-minus"><path d="M5 12h14"/></svg></button>
                        <p>1</p>
                        <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg></button>
                    </div>
                    <div class="add-to-cart">
                        <button type="button">Add to Cart</button>
                    </div>
                    <button type="button" class="like"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg></button>
                </div>
            </div>
        </div>
    </body>
</html>