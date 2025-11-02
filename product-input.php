<?php
session_start();
include("./db.php");

if (isset($_POST['finish'])) {

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category_id'];
    $stock = $_POST['stock'];

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

    $product_image = uploadFile('product_image');
    $product_image_hover = uploadFile('product_image_hover');

    $stmt = $conn->prepare("INSERT INTO products (product_name, price, product_description, product_image, product_image_hover, stock, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsssii", $product_name, $price, $product_description, $product_image, $product_image_hover, $stock, $category_id);

    if ($stmt->execute()) {
        echo "Product added successfully!";
            header("Location: product.php");
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
                <input type="text" name="product_name" placeholder="Product Name" maxlength="100" required pattern="[A-Za-z0-9\- ]+" title="Only letters, numbers, spaces, or dash">
            </label>

            <label>
                Price
                <input type="number" name="price" placeholder="Price" min="0" step="0.01" required>
            </label>

            <label>
                Product Image
                <input type="file" name="product_image" required>
            </label>

            <label>
                Product Image Hover
                <input type="file" name="product_image_hover" required>
            </label>

            <label>
                Product Description
                <textarea name="product_description" placeholder="Product Description" required></textarea>
            </label>

            <label>
                Category
                <select name="category_id" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="1">Beds & Mattresses</option>
                    <option value="2">Storage & Organization</option>
                    <option value="3">Kitchen Appliances</option>
                    <option value="4">Table & Chairs</option>
                </select>
            </label>

            <label>
                Stock
                <input type="number" name="stock" placeholder="Stock" min="0" step="1" required>
            </label>

            <input type="submit" name="finish" value="Publish">
        </form>
    </div>
</body>
</html>
