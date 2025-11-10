<?php
session_start();
include "./includes/db.php";

if (isset($_POST['finish'])) {

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $category_id = $_POST['category_id'];
    $sub_id = $_POST['sub_id'];
    $product_description = $_POST['product_description'];

    function uploadFile($fileInputName) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === 0) {
            $img_name = $img_name = preg_replace("/[^a-zA-Z0-9\.\-_]/", "_", $_FILES[$fileInputName]['name']);
            $tmp_name = $_FILES[$fileInputName]['tmp_name'];
<<<<<<< HEAD
            $target_dir = "../assets/PRODUCTS/";
=======
            $target_dir = "./assets/PRODUCTS/";
>>>>>>> 0e24dab2975596f08310c4916b3455dbf13d540a
            $target_file = $target_dir . basename($img_name);

            if (move_uploaded_file($tmp_name, $target_file)) {
                return $img_name;
            } else {
                echo "Error uploading $fileInputName.";
                exit;
            }
        } else {
            echo "No file selected for $fileInputName.";
            exit;
        }
    }

    $product_img = uploadFile('product_img');
    $product_img2 = uploadFile('product_img2');
    $product_img3 = uploadFile('product_img3');
    $product_img4 = uploadFile('product_img4');
    $product_img5 = uploadFile('product_img5');
    $product_img_hover = uploadFile('product_img_hover');

    $stmt = $conn->prepare("INSERT INTO products (
            product_name, price, stocks, 
            product_img, product_img2, product_img3, product_img4, product_img5, 
            product_img_hover, product_description, category_id, sub_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdisssssssis", 
        $product_name, $price, $stocks,
        $product_img, $product_img2, $product_img3, $product_img4, $product_img5,
        $product_img_hover, $product_description, $category_id, $sub_id);

    if ($stmt->execute()) {
        header("Location: ./product");
            echo "Product added successfully!";
            exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Input</title>
    <style>
        ::-webkit-scrollbar {
            width: 13px;
        }

        ::-webkit-scrollbar-track {
            background: rgb(241 175 123);
            border-radius: 10px;
            margin: 0;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background:  rgb(233, 106, 2);
            border: 2px solid transparent;
            background-clip: padding-box;
            cursor: pointer;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(214, 97, 2);
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        ::-webkit-scrollbar-button:decrement {
            cursor: pointer;
            background-size: 20px;
            height: 15px;
            border: none;
            background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23d47b33' stroke-width='4.5' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-chevron-up-icon lucide-chevron-up'><path d='m18 15-6-6-6 6'/></svg>") no-repeat center;
        }

        ::-webkit-scrollbar-button:increment {
            cursor: pointer;
            background-size: 20px;
            height: 15px;
            border: none;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%23d47b33" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>') no-repeat center;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }

        .columns-container {
            display: flex;
            gap: 20px;
        }
        .column {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            display: flex;
            flex-direction: column;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            margin-top: 5px;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        input[type="submit"] {
            background-color: #d47b33;
            color: white;
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #c76b20ff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Product Input</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="columns-container">
                <div class="column">
                    <label>Product Name <input type="text" name="product_name" required></label>
                    <label>Price <input type="number" name="price" required></label>
                    <label>Stock <input type="number" name="stocks" required></label>
                    <label>Product Image <input type="file" name="product_img" required></label>
                    <label>Product Image Hover <input type="file" name="product_img_hover" required></label>
                    <label>Product Angle 1 <input type="file" name="product_img2" required></label>
                </div>
                <div class="column">
                    <label>Product Angle 2 <input type="file" name="product_img3" required></label>
                    <label>Product Angle 3 <input type="file" name="product_img4" required></label>
                    <label>Product Angle 4 <input type="file" name="product_img5" required></label>
                    <label>Product Description <textarea name="product_description" placeholder="Product Description" required></textarea></label>
                    <label>
                        Category
                        <select name="category_id" required>
                            <option value="" disabled selected>Select Category</option>
                            <option value="1">Storage & Organization</option>
                            <option value="2">Beds & Mattresses</option>
                            <option value="3">Table & Chairs</option>
                            <option value="4">Sofas & Armchair</option>
                            <option value="5">Home Decorations</option>
                            <option value="6">Light Fixtures</option>
                            <option value="7">Office Furniture</option>
                            <option value="8">Outdoor Furniture</option>
                        </select>
                    </label>
                    <label>
                        Sub-Category
                        <select name="sub_id" required>
                            <option value="" disabled selected>Select Sub-Category</option>
                            <option value="1">Bookcases & Shelving Units</option>
                            <option value="2">Chests of drawers & drawer units</option>
                            <option value="3">Cabinets & Cupboards</option>
                            <option value="4">TV & media furniture</option>
                            <option value="5">Wardrobes & Closet Systems</option>
                            <option value="6">Beds</option>
                            <option value="7">Beddings and Pillows</option>
                            <option value="8">Mattresses</option>
                            <option value="9">Under bed storage</option>
                            <option value="10">Headboards</option>
                            <option value="11">Dining Tables</option>
                            <option value="12">Dining Chairs & Benches</option>
                            <option value="13">Coffee & End Tables</option>
                            <option value="14">Bar & Counter Stools</option>
                            <option value="15">Specialty Seating</option>
                            <option value="16">Sofas & Couches</option>
                            <option value="17">Armchairs</option>
                            <option value="18">Sofabeds</option>
                            <option value="19">Ottomans, footstools & pouffes</option>
                            <option value="20">Coushions</option>
                            <option value="21">Wall Décor & Mirrors</option>
                            <option value="22">Vases, Planters & Greenery</option>
                            <option value="23">Decorative Accents</option>
                            <option value="24">Rugs & Floor Coverings</option>
                            <option value="25">Seasonal</option>
                            <option value="26">Ceiling Lights & Pendants</option>
                            <option value="27">Floor Lamps</option>
                            <option value="28">Table & Desk Lamps</option>
                            <option value="29">Wall & Vanity Lights</option>
                            <option value="30">Outdoor Lighting</option>
                            <option value="31">Desks & Work Surfaces</option>
                            <option value="32">Office & Task Chairs</option>
                            <option value="33">Home Office Sets</option>
                            <option value="34">Gaming Furniture</option>
                            <option value="35">Filing & Office Storage</option>
                            <option value="36">Outdoor Lounge & Seating</option>
                            <option value="37">Outdoor Dining & Bar Sets</option>
                            <option value="38">Umbrellas, Pergolas & Shade</option>
                            <option value="39">Outdoor Storage</option>
                            <option value="40">Outdoor Décor & Accents</option>
                        </select>
                    </label>
                </div>
            </div>
            <input type="submit" name="finish" value="Publish">
        </form>
    </div>
</body>
</html>
