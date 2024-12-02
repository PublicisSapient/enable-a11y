const imageGallery = new function() {
    let currentSlideIndex = 0;
    
    this.changeSlide = function(direction) {
        const slides = document.querySelectorAll('.slide');
        currentSlideIndex = (currentSlideIndex + direction + slides.length) % slides.length;
        this.showSlide(currentSlideIndex);
    }

    this.showSlide = function(index) {
        const slides = document.querySelectorAll('.slide');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const slideAlert = document.querySelector('.gallery-alert');
       
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? 'block' : 'none';
            slide.style.opacity = i === index ? '1' : '0';
            slide.setAttribute('aria-hidden', i !== index);
            if(i === index) {
                const msg = slide.getAttribute('alt');
                slideAlert.innerHTML = `<p>Now showing image with ${msg} </p>`
            }
        });
        thumbnails.forEach((thumbnail, i) => {
            thumbnail.classList.toggle('active', i === index);
        });
    }
    this.init = function() {
        this.showSlide(currentSlideIndex);
        const thumbnailButtons = document.querySelectorAll('.thumbnail-button');
        thumbnailButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const index = event.currentTarget.getAttribute('data-index');
                currentSlideIndex = parseInt(index);
                this.showSlide(currentSlideIndex);
            })
        });
        document.getElementById('prevBtn').addEventListener('click', () => this.changeSlide(-1));
        document.getElementById('nextBtn').addEventListener('click', () => this.changeSlide(1));
    };

   
}

export default imageGallery;