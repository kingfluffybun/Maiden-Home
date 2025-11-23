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
    <link rel="stylesheet" href="../admin.css">
    <link rel="stylesheet" href="/Maiden-Home/css/all.css">
    <link rel="stylesheet" href="/Maiden-Home/css/scroll.css">
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
        <div class="side-btn active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package2-icon lucide-package-2"><path d="M12 3v6"/><path d="M16.76 3a2 2 0 0 1 1.8 1.1l2.23 4.479a2 2 0 0 1 .21.891V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9.472a2 2 0 0 1 .211-.894L5.45 4.1A2 2 0 0 1 7.24 3z"/><path d="M3.054 9.013h17.893"/></svg>
            Product List
        </div>
        <a href="../"><div class="side-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-plus-icon lucide-package-plus"><path d="M16 16h6"/><path d="M19 13v6"/><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
            Add Product
        </div></a>
    </div>
    <div class="content">
        <h1 style="margin-bottom: 16px;">Product List</h1>
        
        <div class="info">
            <form method="POST" action="">
                <button type="submit" name="delete-selected" class="del-btn" id="delete-btn" style="display:none" onclick="return confirm('Are you sure you want to delete selected items?')">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        <p>Delete</p>
                    </div>
                </button>
                <table>
                    <tr>
                        <th width="5%">Select</th>
                        <th width="5%">ID</th>
                        <th width="25%">Name</th>
                        <th width="7%">Price</th>
                        <th width="7%">Stocks</th>
                        <th width="15%">Category</th>
                        <th width="20%">Sub-Category</th>
                        <th width="16%">Created At</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' name='selected_products[]' value='".$row['product_id']."'></td>";
                            echo "<td>".$row['product_id']."</td>";
                            echo "<td id='product-name'><a href='/product-details/?product_id={$row['product_id']}'>".htmlspecialchars($row['product_name'])."</a></td>";
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