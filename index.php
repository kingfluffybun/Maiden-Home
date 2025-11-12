<?php
session_start();
    if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['user_email'] = $_COOKIE['user_email'];
        $_SESSION['role'] = $_COOKIE['role'];
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Maiden Home</title>
        <link rel="stylesheet" href="homepage.css" />
        <link rel="stylesheet" href="css/scroll.css">
        <link rel="stylesheet" href="css/nav-bar.css">
        <link rel="stylesheet" href="css/footer.css">
        <script src="js/script.js"></script>
    </head>
    <body>
        <?php include "./includes/nav-bar.php" ?>
        <div style="padding: 2vh 2vw;">
            <section class="hero-banner">
                <img src="assets/hero-banner.png" alt="">
                <div class="hero-text">
                    <h1>Made in Home. <span style="color: #d47b33;">Made for You.</span></h1>
                    <p>
                        Discover furniture born from craftsmanship and comfort, designed to
                        make every moment feel at home.
                    </p>
                    <div class="action">
                        <a href="./product" id="shop-now">Shop Now</a>
                        <a id="read-more">Read More</a>
                    </div>
                </div>
            </section>
            <section class="description">
                <div class="description-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck-icon lucide-truck">
                        <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                        <path d="M15 18H9" />
                        <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                        <circle cx="17" cy="18" r="2" />
                        <circle cx="7" cy="18" r="2" />
                    </svg>
                    <div class="description-text">
                        <h2>Free Shipping</h2>
                        <p>Enjoy free and fast delivery on all orders</p>
                    </div>
                </div>
                <div class="description-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rotate-ccw-icon lucide-rotate-ccw">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                        <path d="M3 3v5h5" />
                    </svg>
                    <div class="description-text">
                        <h2>Easy Return</h2>
                        <p>Hassle-free returns within a few days</p>
                    </div>
                </div>
                <div class="description-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hand-coins-icon lucide-hand-coins">
                        <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                        <path d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                        <path d="m2 16 6 6" />
                        <circle cx="16" cy="9" r="2.9" />
                        <circle cx="6" cy="5" r="3" />
                    </svg>
                    <div class="description-text">
                        <h2>100% Money Back</h2>
                        <p>Full refund guaranteed if you're not satisfied</p>
                    </div>
                </div>
                <div class="description-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#d47b33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle-question-mark-icon lucide-message-circle-question-mark">
                        <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                        <path d="M12 17h.01" />
                    </svg>
                    <div class="description-text">
                        <h2>Customer Support</h2>
                        <p>We're here to help 24/7 with any questions</p>
                    </div>
                </div>
            </section>
        </div>
        <section class="shop-now-section">
            <img src="./assets/Rooms/living room.png" style="object-fit: cover; width: 100%;" alt="">
            <div>
                <h2>Furniture That Feels Like Home</h2>
                <p>Find the pieces that truly feel like home, designed to be the foundation for every moment. Explore our collection of handcrafted bed frames, iconic deep-seated sofas, and tailored accent chairs. It's the perfect blend of lasting aesthetic and deep comfort—timeless, personal, and made just for you.</p>
                <a href="./product/"><p>Shop Now</p></a>
            </div>
        </section>
        <div class="container">
            <section class="shop-by">
                <div class="shop-by-header">
                    <h2>Shop by Category</h2>
                    <div class="shop-by-nav">
                        <button type="button" class="prev-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-left-icon lucide-move-left">
                                <path d="M6 8L2 12L6 16" />
                                <path d="M2 12H22" />
                            </svg>
                        </button>
                        <button type="button" class="next-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right">
                                <path d="M18 8L22 12L18 16" />
                                <path d="M2 12H22" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div style="width: 100%; overflow:hidden;">
                    <ul class="category-wrapper" style="list-style-type: none;">
                        <li class="category">
                            <a href="./product/?category_id=1">
                                <img src="assets/Categories/Storage & Organization.png" alt="">
                                <h3>Storage & Organization</h3>
                            </a>
                        </li>
                        <li class="category">
                            <a href="./product/?category_id=2">
                                <img src="assets/Categories/Beds & Mattresses.png" alt="">
                                <h3>Beds & Mattresses</h3>
                            </a>
                        </li>
                        <li class="category">
                            <a href="./product/?category_id=3">
                                <img src="assets/Categories/Tables & Chairs.png" alt="">
                                <h3>Tables & Chairs</h3>
                            </a>
                        </li>
                        <li class="category">
                            <a href="./product/?category_id=4">
                                <img src="assets/Categories/Sofas & Armchair.png" alt="">
                                <h3>Sofas & Armchair</h3>
                            </a>
                        </li>
                        <li class="category">
                            <a href="./product/?category_id=5">
                                <img src="assets/Categories/Home Decorations.png" alt="">
                                <h3>Home Decorations</h3>
                            </a>
                        </li>
                        <li class="category">
                            <a href="./product/?category_id=6">
                                <img src="assets/Categories/Light Fixtures.png" alt="">
                                <h3>Light Fixtures</h3>
                            </a>
                        </li>
                        <li class="category">
                            <a href="./product/?category_id=7">
                                <img src="assets/Categories/Office Furniture.png" alt="">
                                <h3>Office Furniture</h3>
                            </a>
                        </li>
                        <li class="category">
                            <a href="./product/?category_id=8">
                                <img src="assets/Categories/Outdoors Furniture.png" alt="">
                                <h3>Outdoor Furniture</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <section class="shop-now-section">
            <div>
                <h2>Furniture That Feels Like Home</h2>
                <p>Find the pieces that truly feel like home, designed to be the foundation for every moment. Explore our collection of handcrafted bed frames, iconic deep-seated sofas, and tailored accent chairs. It's the perfect blend of lasting aesthetic and deep comfort—timeless, personal, and made just for you.</p>
                <a href="./product/"><p>Shop Now</p></a>
            </div>
            <img src="./assets/Rooms/bedroom.png" style="object-fit: cover; width: 100%;" alt="">
        </section>
        <div class="container">
            <section class="shop-by">
                <div class="shop-by-header">
                    <h2>Featured Products</h2>
                    <div class="shop-by-nav">
                        <a href="./product/">View All</a>
                        <button type="button" class="prev-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-left-icon lucide-move-left">
                                <path d="M6 8L2 12L6 16" />
                                <path d="M2 12H22" />
                            </svg>
                        </button>
                        <button type="button" class="next-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right">
                                <path d="M18 8L22 12L18 16" />
                                <path d="M2 12H22" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div style="width: 100%; overflow:hidden;">
                    <ul class="category-wrapper" style="list-style-type: none;">
                        <li class="product">
                            <a href="./product-details/?product_id=1">
                                <img src="assets/Products/Farrow_Large_Bookcase.png" alt="" class="default-img">
                                <img src="assets/Products/Farrow_Large_Bookcase_Hover.png" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Farrow Large Bookcase</p>
                                <b>₱8,120.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=19">
                                <img src="assets/Products/Farrow-White-Low-Bookcase.jpg" alt="" class="default-img">
                                <img src="assets/Products/Farrow-Low-Bookcase-White-Hover.jpg" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Farrow Low Bookcase</p>
                                <b>₱16,290.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=2">
                                <img src="assets/Products/Colette_4_Over_6_Chest_Of_Drawers.png" alt="" class="default-img">
                                <img src="assets/Products/Colette_4_Over_6_Chest_Of_Drawers_Hover.png" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Colette 4 Over 6 Chest Of Drawers</p>
                                <b>₱41,114.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=10">
                                <img src="assets/Products/Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere.jpg" alt="" class="default-img">
                                <img src="assets/Products/Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere-Hover.jpg" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Huxley Triple Wardrobe with Open Shelves</p>
                                <b>₱29,350.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=14">
                                <img src="assets/Products/Henshaw-3-Drawer-Chest-White.jpg" alt="" class="default-img">
                                <img src="assets/Products/Henshaw-3-Drawer-Chest-White-Hover.jpg" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Henshaw 3 Drawer Chest</p>
                                <b>₱17,415.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=9">
                                <img src="assets/Products/Stratford_Memory_Coil_Quilted_Mattress.png" alt="" class="default-img">
                                <img src="assets/Products/Stratford_Memory_Coil_Quilted_Mattress_Hover.png" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Stratford Memory Coil Quilted Mattress</p>
                                <b>₱14,021.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=18"> 
                                <img src="assets/Products/Mendez_Faux_Leather_Bar_Stool.png" alt="" class="default-img">
                                <img src="assets/Products/Mendez_Faux_Leather_Bar_Stool_Hover.png" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Mendez Faux Leather Bar Stool</p>
                                <b>₱5,810.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=16">
                                <img src="assets/Products/Milo_Mango___Marble_Fluted_Side_Table_with_Door.png" alt="" class="default-img">
                                <img src="assets/Products/Milo_Mango___Marble_Fluted_Side_Table_with_Door_Hover.png".jpg" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Milo Mango & Marble Fluted Side Table with Door</p>
                                <b>₱12,784.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=27">
                                <img src="assets/Products/Bletchley_Jumbo_Cord_Swivel_Chair.png" alt="" class="default-img">
                                <img src="assets/Products/Bletchley_Jumbo_Cord_Swivel_Chair_Hover.png" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Bletchley Jumbo Cord Swivel Chair</p>
                                <b>₱40,639.00</b>
                            </div>
                        </li>                   
                        <li class="product">
                            <a href="./product-details/?product_id=39">
                                <img src="assets/Products/Justin-Charcoal-4Seater-Sofa.jpg" alt="" class="default-img">
                                <img src="assets/Products/Justin-Charcoal-4Seater-Sofa-Hover.jpg" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Justin 4 Seater Sofa</p>
                                <b>₱49,360.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=20">
                                <img src="assets/Products/Alfie-4-Seater-Sofa-Charcoal.jpg" alt="" class="default-img">
                                <img src="assets/Products/Alfie-4-Seater-Sofa-Charcoal-Hover.jpg" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Alfie 4 Seater Sofa</p>
                                <b>₱50,350.00</b>
                            </div>
                        </li>
                        <li class="product">
                            <a href="./product-details/?product_id=40">
                                <img src="assets/Products/Birchley-Soft-Chenille-4-Seater-Sofa-Ice.jpg" alt="" class="default-img">
                                <img src="assets/Products/Birchley-Soft-Chenille-4-Seater-Sofa-Ice-Hover.jpg" alt="" class="hover-img">
                            </a>
                            <div style="padding-top: 16px;">
                                <p>Birchley 4 Seater Sofa</p>
                                <b>₱72,055.00</b>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </body>
    <?php include "./includes/footer.php" ?>
</html>