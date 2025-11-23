<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="admin-wrapper">

    <div class="sidebar">
        <div class="side-btn">Users</div>
        <div class="side-btn">Orders</div>
        <div class="side-btn">Product List</div>
        <div class="side-btn active">Add Products</div>
    </div>

    <div class="content">

        <div class="top-header"></div>

        <div class="steps">
            <div class="step active">Product Information</div>
            <div class="step">Product Images</div>
            <div class="step">Product Options</div>
            <div class="step">Confirmation</div>
        </div>

        <form id="addProductForm">

            <div class="page active" id="page1">
                <div class="form-area">

                    <div class="input-group">
                        <label>Product Name</label>
                        <input type="text" name="product_name" placeholder="Enter product name">
                    </div>

                    <div class="input-row">
                        <div class="input-group half">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="₱">
                        </div>
                        <div class="input-group half">
                            <label>Stock</label>
                            <input type="number" name="stock" placeholder="0">
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Product Description</label>
                        <textarea name="description" placeholder="Enter product description"></textarea>
                    </div>

                    <div class="input-row">
                        <div class="input-group half">
                            <label>Category</label>
                            <input type="text" name="category" placeholder="Category">
                        </div>
                        <div class="input-group half">
                            <label>Sub-Category</label>
                            <input type="text" name="subcategory" placeholder="Sub-Category">
                        </div>
                    </div>

                </div>
            </div>

            <div class="page" id="page2">
                <div class="form-area">

                    <div class="input-group">
                        <label>Main Product Image</label>
                        <input type="file" name="main_img">
                    </div>

                    <div class="input-group">
                        <label>Hover Image</label>
                        <input type="file" name="hover_img">
                    </div>

                    <div class="input-row">
                        <div class="input-group half">
                            <label>Angle 1</label>
                            <input type="file" name="angle1">
                        </div>
                        <div class="input-group half">
                            <label>Angle 2</label>
                            <input type="file" name="angle2">
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group half">
                            <label>Angle 3</label>
                            <input type="file" name="angle3">
                        </div>
                        <div class="input-group half">
                            <label>Angle 4</label>
                            <input type="file" name="angle4">
                        </div>
                    </div>

                </div>
            </div>

            <div class="page" id="page3">
                <div class="form-area">

                    <h3>Sizes</h3>
                    <div class="input-row">
                        <input type="text" class="half" name="size1" placeholder="Size 1">
                        <input type="text" class="half" name="size2" placeholder="Size 2">
                        <input type="text" class="half" name="size3" placeholder="Size 3">
                    </div>

                    <h3>Materials</h3>
                    <div class="input-row">
                        <input type="text" class="half" name="mat1" placeholder="Material 1">
                        <input type="text" class="half" name="mat2" placeholder="Material 2">
                        <input type="text" class="half" name="mat3" placeholder="Material 3">
                    </div>

                    <h3>Colors</h3>
                    <div class="input-row">
                        <div class="input-group half">
                            <label>Color Name 1</label>
                            <input type="text" name="color_name1" placeholder="Color name">
                            <label>Color Image 1</label>
                            <input type="file" name="color_img1">
                        </div>
                        <div class="input-group half">
                            <label>Color Name 2</label>
                            <input type="text" name="color_name2" placeholder="Color name">
                            <label>Color Image 2</label>
                            <input type="file" name="color_img2">
                        </div>
                        <div class="input-group half">
                            <label>Color Name 3</label>
                            <input type="text" name="color_name3" placeholder="Color name">
                            <label>Color Image 3</label>
                            <input type="file" name="color_img3">
                        </div>
                    </div>

                </div>
            </div>

            <div class="page" id="page4">
                <h2>Review Before Confirm</h2>
            </div>
         

            <div class="nav-buttons">
                <button type="button" class="back-btn" id="backBtn">Back</button>
                <button type="button" class="next-btn" id="nextBtn">Next</button>
            </div>
        </form>

    </div>
</div>

<script>
let current = 0;
let pages = document.querySelectorAll(".page");
let steps = document.querySelectorAll(".step");

function showPage(i){
    pages.forEach(function(p){ p.classList.remove("active"); });
    steps.forEach(function(s){ s.classList.remove("active"); });
    pages[i].classList.add("active");
    steps[i].classList.add("active");
}

document.getElementById("nextBtn").onclick = function(){
    if(current < pages.length-1){ current++; showPage(current); }
}

document.getElementById("backBtn").onclick = function(){
    if(current > 0){ current--; showPage(current); }
}

showPage(0);
</script>

</body>
</html>
