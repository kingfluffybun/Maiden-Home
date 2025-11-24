let current = 0;
let pages = document.querySelectorAll(".page");
let steps = document.querySelectorAll(".step");

function showPage(i){
    pages.forEach(p => p.classList.remove("active"));
    //steps.forEach(s => s.classList.remove("active"));

    pages[i].classList.add("active");
    //steps[i].classList.add("active");

    steps.forEach((s, index) => {
        if (index <= i) {
            s.classList.add("active"); 
        } else {
            s.classList.remove("active");
        }
    });

    if(pages[i].id === "page4") {
        updateReview();
    }

    

    const nextBtn = document.getElementById("nextBtn");
    if(i === pages.length - 1){
        nextBtn.style.display = "none";
        subBtn.style.display = "inline-block";
    } else {
        nextBtn.style.display = "inline-block";
        subBtn.style.display = "none";
    }

    const backBtn = document.getElementById("backBtn");
    if(i === 0){
        backBtn.style.display = "none";
    } else {
        backBtn.style.display = "inline-block";
    }
}

// d dapat 'to napipindot -clarence
/*steps.forEach((step, index) => {
    step.addEventListener("click", () => {
        current = index;
        showPage(current);
        updateReview();
    });
});
*/

document.getElementById("nextBtn").onclick = function(){
    if(current < pages.length-1){ current++; showPage(current); 
        if(pages[current].id === "page4") {
            updateReview();
        }
    }
}

document.getElementById("backBtn").onclick = function(){
    if(current > 0){ current--; showPage(current); }
}

showPage(0);

function updateReview() {
    document.getElementById("review_name").textContent =
        document.querySelector("input[name='product_name']").value;

    document.getElementById("review_price").textContent =
        document.querySelector("input[name='price']").value;

    document.getElementById("review_stocks").textContent =
        document.querySelector("input[name='stocks']").value;

    document.getElementById("review_category").textContent =
        document.querySelector("select[name='category_id']").selectedOptions[0].textContent;

    document.getElementById("review_sub").textContent =
        document.querySelector("select[name='sub_id']").selectedOptions[0].textContent;

    document.getElementById("review_desc").textContent =
        document.querySelector("textarea[name='product_description']").value;

    function preview(inputName, imgId) {
        let file = document.querySelector(`input[name='${inputName}']`).files[0];
        if (file) {
            document.getElementById(imgId).src = URL.createObjectURL(file);
        }
    }

    preview("product_img", "prev_main");
    preview("product_img_hover", "prev_hover");
    preview("product_img2", "prev_img2");
    preview("product_img3", "prev_img3");
    preview("product_img4", "prev_img4");
    preview("product_img5", "prev_img5");

    document.getElementById("review_size1").textContent =
        document.querySelector("input[name='size1']").value;
    document.getElementById("review_size2").textContent =
        document.querySelector("input[name='size2']").value;
    document.getElementById("review_size3").textContent =
        document.querySelector("input[name='size3']").value;

    document.getElementById("review_mat1").textContent =
        document.querySelector("input[name='mat1']").value;
    document.getElementById("review_mat2").textContent =
        document.querySelector("input[name='mat2']").value;
    document.getElementById("review_mat3").textContent =
        document.querySelector("input[name='mat3']").value;


    preview("color1_img", "prev_color1");
    preview("color2_img", "prev_color2");
    preview("color3_img", "prev_color3");

    document.getElementById("review_color1").textContent =
        document.querySelector("input[name='color1']").value;

    document.getElementById("review_color2").textContent =
        document.querySelector("input[name='color2']").value;

    document.getElementById("review_color3").textContent =
        document.querySelector("input[name='color3']").value;
}