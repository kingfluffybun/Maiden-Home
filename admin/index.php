<?php
session_start();
include "../includes/db.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../");
    exit();
}

if (isset($_POST['finish'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $category_id = $_POST['category_id'];
    $sub_id = $_POST['sub_id'];
    $product_description = $_POST['product_description'];
    $size1 = $_POST['size1'];
    $size2 = $_POST['size2'];
    $size3 = $_POST['size3'];
    $mat1 = $_POST['mat1'];
    $mat2 = $_POST['mat2'];
    $mat3 = $_POST['mat3'];
    $color1 = $_POST['color1'];
    $color2 = $_POST['color2'];
    $color3 = $_POST['color3'];
    $category_name = $_POST['category_name'];
    $sub_name = $_POST['sub_name'];

    function uploadFile($fileInputName) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === 0) {
            $img_name = $img_name = preg_replace("/[^a-zA-Z0-9\.\-_]/", "_", $_FILES[$fileInputName]['name']);
            $tmp_name = $_FILES[$fileInputName]['tmp_name'];
            $target_dir = "../assets/PRODUCTS/";
            $target_file = $target_dir . basename($img_name);

            if (move_uploaded_file($tmp_name, $target_file)) {
                return $img_name;
            } else {
                echo "Error uploading $fileInputName.";
                return '';
            }
        } else {
            echo "No file selected for $fileInputName.";
            return '';
        }
    }

    $product_img = uploadFile('product_img');
    $product_img2 = uploadFile('product_img2');
    $product_img3 = uploadFile('product_img3');
    $product_img4 = uploadFile('product_img4');
    $product_img5 = uploadFile('product_img5');
    $product_img_hover = uploadFile('product_img_hover');
    $color1_img = uploadFile('color1_img');
    $color2_img = uploadFile('color2_img');
    $color3_img = uploadFile('color3_img');

    $stmt = $conn->prepare("INSERT INTO products (
        product_name, price, stocks,
        product_img, product_img2, product_img3, product_img4, product_img5,
        product_img_hover, product_description, category_id, category_name, sub_id, sub_name,
        size1, size2, size3, mat1, mat2, mat3,
        color1, color2, color3, color1_img, color2_img, color3_img
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sdisssssssisssssssssssssss",
        $product_name, $price, $stocks,
        $product_img, $product_img2, $product_img3, $product_img4, $product_img5,
        $product_img_hover, $product_description, $category_id, $category_name, $sub_id,  $sub_name,
        $size1, $size2, $size3, $mat1, $mat2, $mat3,
        $color1, $color2, $color3,
        $color1_img, $color2_img, $color3_img
    );

    if ($stmt->execute()) {
        header("Location: ./");
            echo "Product added successfully!";
            exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="/css/scroll.css">  
</head>
<body>

<div class="admin-wrapper">
    <div class="sidebar">
        <a href="/Maiden-Home/" style="text-decoration: none;" id="home-link">
            <div class="logo">
                <img src="\Maiden-Home\assets\Logo.png">
                <h1 style="color: #d47b33; font-size: 24;">MAIDEN HOME</h1>
            </div>
        </a>
        <br>
        <div class="side-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
            Customers
        </div>
        <div class="side-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag-icon lucide-shopping-bag"><path d="M16 10a4 4 0 0 1-8 0"/><path d="M3.103 6.034h17.794"/><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"/></svg>
            Orders
        </div>
        <a href="product-list/"><div class="side-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package2-icon lucide-package-2"><path d="M12 3v6"/><path d="M16.76 3a2 2 0 0 1 1.8 1.1l2.23 4.479a2 2 0 0 1 .21.891V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9.472a2 2 0 0 1 .211-.894L5.45 4.1A2 2 0 0 1 7.24 3z"/><path d="M3.054 9.013h17.893"/></svg>
            Product List
        </div></a>
        <div class="side-btn active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-plus-icon lucide-package-plus"><path d="M16 16h6"/><path d="M19 13v6"/><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
            Add Product
        </div>
    </div>
    <div class="top-header"></div>
    <div class="content">
        <h1 style="margin-bottom: 16px;">Add Product</h1>
        <div class="steps">
            <div class="step active">Product Information</div>
            <div class="step">Product Images</div>
            <div class="step">Product Options</div>
            <div class="step">Confirmation</div>
        </div>

        <form id="addProductForm" method="POST" enctype="multipart/form-data">

            <div class="page active" id="page1">
                <div class="form-area">

                    <div class="input-group">
                        <label>Product Name</label>
                        <input type="text" name="product_name" placeholder="Enter product name" required>
                    </div>

                    <div class="input-row">
                        <div class="input-group half">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="₱" required>
                        </div>
                        <div class="input-group half">
                            <label>Stock</label>
                            <input type="number" name="stocks" placeholder="0" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Product Description</label>
                        <textarea name="product_description" placeholder="Enter product description" required></textarea>
                    </div>

                    <div class="input-row">
                        <div class="input-group half">
                            <label>Category ID</label>
                            <select name="category_id" required>
                                <option value="" disabled selected></option>
                                <option value="1">1 - Storage & Organization</option>
                                <option value="2">2- Beds & Mattresses</option>
                                <option value="3">3 - Table & Chairs</option>
                                <option value="4">4 - Sofas & Armchair</option>
                                <option value="5">5 - Home Decorations</option>
                                <option value="6">6 - Light Fixtures</option>
                                <option value="7">7 - Office Furniture</option>
                                <option value="8">8 - Outdoor Furniture</option>
                            </select>
                        </div>
                        <div class="input-group half">
                            <label>Sub-Category ID</label>
                            <select name="sub_id" required>
                                <option value="" disabled selected></option>
                                <option value="1">1 - Bookcases & Shelving Units</option>
                                <option value="2">2 - Chests of drawers & drawer units</option>
                                <option value="3">3 - Cabinets & Cupboards</option>
                                <option value="4">4 - TV & media furniture</option>
                                <option value="5">5 - Wardrobes & Closet Systems</option>
                                <option value="6">6 - Beds</option>
                                <option value="7">7 - Beddings and Pillows</option>
                                <option value="8">8 - Mattresses</option>
                                <option value="9">9 - Under bed storage</option>
                                <option value="10">10 - Headboards</option>
                                <option value="11">11 - Dining Tables</option>
                                <option value="12">12 - Dining Chairs & Benches</option>
                                <option value="13">13 - Coffee & End Tables</option>
                                <option value="14">14 - Bar & Counter Stools</option>
                                <option value="15">15 - Specialty Seating</option>
                                <option value="16">16 - Sofas & Couches</option>
                                <option value="17">17 - Armchairs</option>
                                <option value="18">18 - Sofabeds</option>
                                <option value="19">19 - Ottomans, footstools & pouffes</option>
                                <option value="20">20 - Coushions</option>
                                <option value="21">21 - Wall Décor & Mirrors</option>
                                <option value="22">22 - Vases, Planters & Greenery</option>
                                <option value="23">23 - Decorative Accents</option>
                                <option value="24">24 - Rugs & Floor Coverings</option>
                                <option value="25">25 - Seasonal</option>
                                <option value="26">26 - Ceiling Lights & Pendants</option>
                                <option value="27">27 - Floor Lamps</option>
                                <option value="28">28 - Table & Desk Lamps</option>
                                <option value="29">29 - Wall & Vanity Lights</option>
                                <option value="30">30 - Outdoor Lighting</option>
                                <option value="31">31 - Desks & Work Surfaces</option>
                                <option value="32">32 - Office & Task Chairs</option>
                                <option value="33">33 - Home Office Sets</option>
                                <option value="34">34 - Gaming Furniture</option>
                                <option value="35">35 - Filing & Office Storage</option>
                                <option value="36">36 - Outdoor Lounge & Seating</option>
                                <option value="37">37 - Outdoor Dining & Bar Sets</option>
                                <option value="38">38 - Umbrellas, Pergolas & Shade</option>
                                <option value="39">39 - Outdoor Storage</option>
                                <option value="40">40 - Outdoor Décor & Accents</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-group half">
                            <label>Category Name</label>
                            <select name="category_name" required>
                                <option value="" disabled selected></option>
                                <option value="Storage & Organization">Storage & Organization</option>
                                <option value="Beds & Mattresses">Beds & Mattresses</option>
                                <option value="Table & Chairs">Table & Chairs</option>
                                <option value="Sofas & Armchair">Sofas & Armchair</option>
                                <option value="Home Decorations">Home Decorations</option>
                                <option value="Light Fixtures">Light Fixtures</option>
                                <option value="Office Furniture">Office Furniture</option>
                                <option value="Outdoor Furniture">Outdoor Furniture</option>
                            </select>
                        </div>
                        <div class="input-group half">
                            <label>Sub-Category Name</label>
                            <select name="sub_name" required>
                                <option value="" disabled selected></option>
                                <option value="Bookcases & Shelving Units">Bookcases & Shelving Units</option>
                                <option value="Chests of drawers & drawer units">Chests of drawers & drawer units</option>
                                <option value="Cabinets & Cupboards">Cabinets & Cupboards</option>
                                <option value="TV & media furniture">TV & media furniture</option>
                                <option value="Wardrobes & Closet Systems">Wardrobes & Closet Systems</option>
                                <option value="Beds">Beds</option>
                                <option value="Beddings and Pillows">Beddings and Pillows</option>
                                <option value="Mattresses">Mattresses</option>
                                <option value="Under bed storage">Under bed storage</option>
                                <option value="Headboards">Headboards</option>
                                <option value="Dining Tables">Dining Tables</option>
                                <option value="Dining Chairs & Benches">Dining Chairs & Benches</option>
                                <option value="Coffee & End Tables">Coffee & End Tables</option>
                                <option value="Bar & Counter Stools">Bar & Counter Stools</option>
                                <option value="Specialty Seating">Specialty Seating</option>
                                <option value="Sofas & Couches">Sofas & Couches</option>
                                <option value="Armchairs">Armchairs</option>
                                <option value="Sofabeds">Sofabeds</option>
                                <option value="Ottomans, footstools & pouffes">Ottomans, footstools & pouffes</option>
                                <option value="Coushions">Coushions</option>
                                <option value="Wall Décor & Mirrors">Wall Décor & Mirrors</option>
                                <option value="Vases, Planters & Greenery">Vases, Planters & Greenery</option>
                                <option value="Decorative Accents">Decorative Accents</option>
                                <option value="Rugs & Floor Coverings">Rugs & Floor Coverings</option>
                                <option value="Seasonal">Seasonal</option>
                                <option value="Ceiling Lights & Pendants">Ceiling Lights & Pendants</option>
                                <option value="Floor Lamps">Floor Lamps</option>
                                <option value="Table & Desk Lamps">Table & Desk Lamps</option>
                                <option value="Wall & Vanity Lights">Wall & Vanity Lights</option>
                                <option value="Outdoor Lighting">Outdoor Lighting</option>
                                <option value="Desks & Work Surfaces">Desks & Work Surfaces</option>
                                <option value="Office & Task Chairs">Office & Task Chairs</option>
                                <option value="Home Office Sets">Home Office Sets</option>
                                <option value="Gaming Furniture">Gaming Furniture</option>
                                <option value="Filing & Office Storage">Filing & Office Storage</option>
                                <option value="Outdoor Lounge & Seating">Outdoor Lounge & Seating</option>
                                <option value="Outdoor Dining & Bar Sets">Outdoor Dining & Bar Sets</option>
                                <option value="Umbrellas, Pergolas & Shade">Umbrellas, Pergolas & Shade</option>
                                <option value="Outdoor Storage">Outdoor Storage</option>
                                <option value="Outdoor Décor & Accents">Outdoor Décor & Accents</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page" id="page2">
                <div class="form-area">

                    <div class="input-group">
                        <label>Main Product Image</label>
                        <input type="file" name="product_img" required>
                    </div>

                    <div class="input-group">
                        <label>Hover Image</label>
                        <input type="file" name="product_img_hover" required>
                    </div>

                    <div class="input-row">
                        <div class="input-group half">
                            <label>Angle 1</label>
                            <input type="file" name="product_img2">
                        </div>
                        <div class="input-group half">
                            <label>Angle 2</label>
                            <input type="file" name="product_img3">
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group half">
                            <label>Angle 3</label>
                            <input type="file" name="product_img4">
                        </div>
                        <div class="input-group half">
                            <label>Angle 4</label>
                            <input type="file" name="product_img5">
                        </div>
                    </div>

                </div>
            </div>

            <div class="page" id="page3">
                <div class="form-area">

                    <h3 style="margin-bottom: 8px;">Sizes</h3>
                    <div class="input-row">
                        <input type="text" class="half" name="size1" placeholder="Size 1">
                        <input type="text" class="half" name="size2" placeholder="Size 2">
                        <input type="text" class="half" name="size3" placeholder="Size 3">
                    </div>
                    <br>
                    <h3 style="margin-bottom: 8px;">Materials</h3>
                    <div class="input-row">
                        <input type="text" class="half" name="mat1" placeholder="Material 1">
                        <input type="text" class="half" name="mat2" placeholder="Material 2">
                        <input type="text" class="half" name="mat3" placeholder="Material 3">
                    </div>
                    <br>
                    <h3 style="margin-bottom: 8px;">Colors</h3>
                    <div class="input-row">
                        <div class="input-group half">
                            <label>Color Name 1</label>
                            <input type="text" name="color1" placeholder="Color name">
                            <br>
                            <label>Color Image 1</label>
                            <input type="file" name="color1_img">
                        </div>
                        <div class="input-group half">
                            <label>Color Name 2</label>
                            <input type="text" name="color2" placeholder="Color name">
                            <br>
                            <label>Color Image 2</label>
                            <input type="file" name="color2_img">
                        </div>
                        <div class="input-group half">
                            <label>Color Name 3</label>
                            <input type="text" name="color3" placeholder="Color name">
                            <br>
                            <label>Color Image 3</label>
                            <input type="file" name="color3_img">
                        </div>
                    </div>

                </div>
            </div>

            <div class="page" id="page4">
                <h2>Review Before Confirm</h2>
                <br>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
                    <div class="review-card">
                        <h3>Basic Information</h3>
                        <p><strong>Name:</strong> <span id="review_name"></span></p>
                        <p><strong>Price:</strong> ₱<span id="review_price"></span></p>
                        <p><strong>Stocks:</strong> <span id="review_stocks"></span></p>
                        <p><strong>Category:</strong> <span id="review_category"></span></p>
                        <p><strong>Sub-Category:</strong> <span id="review_sub"></span></p>
                        <p><strong>Description:</strong> <span id="review_desc"></span></p>
                    </div>

                    <div class="review-card">
                        <h3>Sizes</h3>
                        <ul>
                            <li id="review_size1"></li>
                            <li id="review_size2"></li>
                            <li id="review_size3"></li>
                        </ul>

                        <h3>Materials</h3>
                        <ul>
                            <li id="review_mat1"></li>
                            <li id="review_mat2"></li>
                            <li id="review_mat3"></li>
                        </ul>
                    </div>
                </div>
                
                <div class="review-card">
                    <h3>Product Images</h3>
                    <div class="img-preview-wrapper">
                        <div class="image-card">
                            <img id="prev_main" class="preview-img">
                            <p>Main Product Image</p>
                        </div>
                        <div class="image-card">
                            <img id="prev_hover" class="preview-img">
                            <p>Hover Image</p>
                        </div>
                        <div class="image-card">
                            <img id="prev_img2" class="preview-img">
                            <p>Angle 1</p>
                        </div>
                        <div class="image-card">
                            <img id="prev_img3" class="preview-img">
                            <p>Angle 2</p>
                        </div>
                        <div class="image-card">
                            <img id="prev_img4" class="preview-img">
                            <p>Angle 3</p>
                        </div>
                        <div class="image-card">
                            <img id="prev_img5" class="preview-img">
                            <p>Angle 4</p>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <h3>Color Variants</h3>
                    <div class="img-preview-wrapper">
                        <div class="color-card">
                            <img id="prev_color1" class="preview-img">
                            <p id="review_color1"></p>
                        </div>
                        <div class="color-card">
                            <img id="prev_color2" class="preview-img">
                            <p id="review_color2"></p>
                        </div>
                        <div class="color-card">
                            <img id="prev_color3" class="preview-img">
                            <p id="review_color3"></p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="nav-buttons">
            <button type="button" class="back-btn" id="backBtn">Back</button>
            <button type="button" class="next-btn" id="nextBtn">Next</button>
            <button type="submit" name="finish" class="next-btn" id="subBtn">Confirm & Add Product</button>
        </div>
    </div>
</div>

<script src="script.js"></script>

</body>
</html>
