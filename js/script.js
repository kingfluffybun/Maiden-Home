const chevronDown = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>';
const chevronRight = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>`;

function toggleUser() {
    const userOverlay = document.querySelector('.dropdown-content');
    userOverlay.classList.toggle('is-shown');
}

document.addEventListener("DOMContentLoaded", () => {
    const carousels = document.querySelectorAll(".shop-by"); 
    carousels.forEach(carousel => {
        const wrapper = carousel.querySelector(".category-wrapper");
        const prevButton = carousel.querySelector(".prev-button");
        const nextButton = carousel.querySelector(".next-button");

        if (wrapper && prevButton && nextButton) {
            // Previous Button Click
            prevButton.addEventListener("click", () => {
                if (wrapper.scrollLeft <= 0) {
                    // If at start, scroll to End
                    wrapper.scrollTo({ 
                        left: wrapper.scrollWidth, 
                        behavior: "smooth"
                    });
                } else {
                    wrapper.scrollBy({ 
                        left: -wrapper.clientWidth + 30, 
                        behavior: "smooth"
                    });
                }
            });
            // Next Button Click
            nextButton.addEventListener("click", () => {
                if (wrapper.scrollLeft >= wrapper.scrollWidth - wrapper.clientWidth - 5) {
                    // If at end, scroll to start
                    wrapper.scrollTo({ 
                        left: 0, 
                        behavior: "smooth" 
                    });
                } else {
                    wrapper.scrollBy({ 
                        left: wrapper.clientWidth + 30, 
                        behavior: "smooth" 
                    });
                }
            });
        }
    });
});

function toggleDescription() {
    const svgContainer = document.querySelector('#dropdown');
    const description = document.querySelector('.description-content');
    description.classList.toggle('is-clicked');
    if (description.classList.contains('is-clicked')) {
        svgContainer.innerHTML = chevronRight;
    } else {
        svgContainer.innerHTML = chevronDown;
    }
}