<?php 
include "../../includes/db.php";

$limit = 20;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page -1) * $limit;

$total_result = $conn->query("SELECT COUNT(*) AS total FROM products");
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);

$query = "SELECT * FROM products ORDER BY product_id ASC LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

if(isset($_POST['delete-selected']) && isset($_POST['selected_products'])) {
    $ids = $_POST['selected_products'];
    $ids_list = implode(',', array_map('intval', $ids));

    $select_images = $conn->query("SELECT product_img, product_img_hover, product_img2, product_img3, product_img4, product_img5, color1_img, color2_img, color3_img FROM products WHERE product_id IN ($ids_list)");

    while($row = $select_images->fetch_assoc()) {
        $images = [
            $row['product_img'], $row['product_img_hover'], $row['product_img2'],
            $row['product_img3'], $row['product_img4'], $row['product_img5'],
            $row['color1_img'], $row['color2_img'], $row['color3_img']
        ];
        foreach($images as $img) {
            if(!empty($img)) {
                $file_path = "../../assets/PRODUCTS/" . $img;
                if(file_exists($file_path)) {
                    if(unlink($file_path)) {
                        echo "Deleted image: " . $file_path . "<br>";
                    } else {   
                        echo "Error deleting image: " . $file_path . "<br>";
                    };
                }
            }
        }
    }

    $delete_query = "DELETE FROM products WHERE product_id IN ($ids_list)";
    if($conn->query($delete_query)) {
        echo "<script>alert('Selected products deleted successfully.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error deleting products.');</script>";
    }
}
?>

<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-wrapper">

    <div class="sidebar">
        <div class="side-btn">Users</div>
        <div class="side-btn">Orders</div>
        <div class="side-btn active">Product List</div>
        <div class="side-btn"><a href="../">Add Products</a></div>
    </div>

    <div class="content">

        <div class="top-header"></div>

        <h1>All Products</h1><br>
        
        <div class="info">
            <form method="POST" action="">
                <button type="submit" name="delete-selected" class="del-btn" id="delete-btn" style="display:none;" onclick="return confirm('Are you sure you want to delete selected items?')">Delete</button>
                <table>
                    <tr>
                        <th>Select</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stocks</th>
                        <th>Category</th>
                        <th>Sub-Category</th>
                        <th>Created At</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' name='selected_products[]' value='".$row['product_id']."'></td>";
                            echo "<td>".$row['product_id']."</td>";
                            echo "<td>".htmlspecialchars($row['product_name'])."</td>";
                            echo "<td>₱".number_format($row['price'],2)."</td>";
                            echo "<td>".$row['stocks']."</td>";
                            echo "<td>".$row['category_name']."</td>";
                            echo "<td>".$row['sub_name']."</td>";
                            echo "<td>".$row['created_at']."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='18'>No products found.</td></tr>";
                    }
                    ?>
                </table>
            </form>
        </div>
        <div class="pagination">
            <?php if($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="back-btn">&laquo; Prev</a>
            <?php endif; ?>
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php if($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="next-btn">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
const checkboxes = document.querySelectorAll("input[name='selected_products[]']");
const deleteBtn = document.getElementById("delete-btn");

checkboxes.forEach(cb => {
    cb.addEventListener('change', () => {
        const anyChecked = Array.from(checkboxes).some(chk => chk.checked);
        deleteBtn.style.display = anyChecked ? 'inline-block' : 'none';
    });
});
</script>


</body>
</html>