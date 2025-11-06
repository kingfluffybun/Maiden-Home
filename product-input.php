<?php
session_start();
include("./db.php");

if (isset($_POST['finish'])) {

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];
    $product_img = $_POST['product_img'];
    $product_overview = $_POST['product_overview'];
    $category_id = $_POST['category_id'];
    $sub_id = $_POST['sub_id'];
    $product_description = $_POST['product_description'];

    function uploadFile($fileInputName) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === 0) {
            $img_name = $_FILES[$fileInputName]['name'];
            $tmp_name = $_FILES[$fileInputName]['tmp_name'];
            $target_dir = "assets/PRODUCTS/";
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

    $stmt = $conn->prepare("INSERT INTO products (product_name, price, stocks, product_img, product_overview, category_id, sub_id, product_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $product_name, $price, $stocks, $product_img, $product_overview, $category_id, $sub_id, $product_description);

    if ($stmt->execute()) {
        header("Location: product.php");
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
            width: 450px;
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
            <label>
                Product Name
                <input type="text" name="product_name" placeholder="Product Name" required>
            </label>

            <label>
                Price
                <input type="number" name="price" placeholder="Price" min="0" step="0.01" required>
            </label>

            <label>
                Stock
                <input type="number" name="stocks" placeholder="Stock" min="0" step="1" required>
            </label>

            <label>
                Product Image
                <input type="file" name="product_img" required>
            </label>

            <label>
                Product Overview
                <input type="text" name="product_overview" placeholder="Product Overview" required>
            </label>

            <label>
                Product Description
                <textarea name="product_description" placeholder="Product Description" required></textarea>
            </label>

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
                </select>
            </label>

            <input type="submit" name="finish" value="Publish">
        </form>
    </div>
</body>
</html>
