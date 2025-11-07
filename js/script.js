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
      if (wrapper.scrollLeft <= 0) {
        //If at start, scroll to End
        wrapper.scrollTo({ 
          left: wrapper.scrollWidth, 
          behavior: "smooth"
        });
      } else {
        wrapper.scrollBy({ 
          left: -wrapper.clientWidth + 30, // Scroll left by the container's visible width
          behavior: "smooth"
        });
      }
    });

    // Next Button Click
    nextButton.addEventListener("click", () => {
      if (wrapper.scrollLeft >= wrapper.scrollWidth - wrapper.clientWidth - 5) {
        //If at end, scroll to start
        wrapper.scrollTo({ 
          left: 0, 
          behavior: "smooth"
        });
      } else {
        wrapper.scrollBy({ 
          left: wrapper.clientWidth + 30, // Scroll right by the container's visible width
          behavior: "smooth" 
      });
      }
    });
  }
});