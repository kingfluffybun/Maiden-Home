    const chevronDown = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>';
const chevronRight = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>`;

function toggleUser() {
    const userOverlay = document.querySelector('.dropdown-content')
    userOverlay.classList.toggle('is-shown')
}

document.addEventListener("DOMContentLoaded", () => {
  const wrapper = document.querySelector(".category-wrapper");
  const prevButton = document.querySelector(".prev-button");
  const nextButton = document.querySelector(".next-button");

  if (wrapper && prevButton && nextButton) {
    // Previous Button Click
    prevButton.addEventListener("click", () => {
      wrapper.scrollBy({ 
        left: -wrapper.clientWidth + 30, // Scroll left by the container's visible width
        behavior: "smooth" 
      });
    });

    // Next Button Click
    nextButton.addEventListener("click", () => {
      wrapper.scrollBy({ 
        left: wrapper.clientWidth + 30, // Scroll right by the container's visible width
        behavior: "smooth" 
      });
    });
  }
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