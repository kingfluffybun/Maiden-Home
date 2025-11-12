
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.querySelector('.main-product img');
    const thumbnails = document.querySelectorAll('.product-angles img');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const newSrc = this.getAttribute('src');
            mainImage.setAttribute('src', newSrc);
            this.classList.toggle('img-clicked')
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const prevButton = document.querySelector('.prev-btn');
    const nextButton = document.querySelector('.next-btn');
    const imgWrapper = document.querySelector('.product-angles');

    prevButton.addEventListener("click", function() {
        if (imgWrapper.scrollLeft <= 0) {
            imgWrapper.scrollTo({ 
                left: imgWrapper.scrollWidth
            });
        } else {
            imgWrapper.scrollBy({ 
                left: -imgWrapper.clientWidth
            });
        }
    });

    nextButton.addEventListener("click", function() {
        if (imgWrapper.scrollLeft >= imgWrapper.scrollWidth - imgWrapper.clientWidth - 5) {
            imgWrapper.scrollTo({ 
                left: 0, 
            });
        } else {
            imgWrapper.scrollBy({ 
                left: imgWrapper.clientWidth
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', function(){
    const mainImage = document.querySelector('.main-product img');
    const colorRadios = document.querySelectorAll('input[name="color"]')

    colorRadios.forEach(radio => {
        radio.addEventListener('change', function(){
            const newImageSrc = this.getAttribute('data-img-src')
            mainImage.src = newImageSrc;
        })
    })
})
