function imageGallery() {
    return {
        currentSlideIndex: 0,
        currentThumbIndex: 0,
        visibleThumbs: 5,
        galleryId: '',

        changeSlide(direction) {
            const gallery = document.getElementById(this.galleryId);
            const slides = gallery.querySelectorAll('.slide');
            this.currentSlideIndex = (this.currentSlideIndex + direction + slides.length) % slides.length;
            this.showSlide(this.currentSlideIndex);
        },

        showSlide(index) {
            const gallery = document.getElementById(this.galleryId);
            const slides = gallery.querySelectorAll('.slide');
            const thumbnails = gallery.querySelectorAll('.thumbnail-button');
            const slideAlert = gallery.querySelector('.gallery-alert');
            const figSlide = gallery.querySelectorAll('.fig-slide')

            figSlide.length > 0 && figSlide.forEach((slide, i) => {
                slide.style.display = i === index ? 'flex' : 'none';
                slide.setAttribute('aria-hidden', i !== index);
            });

            slides.forEach((slide, i) => {
                slide.style.display = i === index ? 'flex' : 'none';
                slide.setAttribute('aria-hidden', i !== index);
                if (i === index) {
                    const msg = slide.getAttribute('alt');
                    slideAlert.innerHTML = `Now showing image with ${msg}`;
                }
            });
            thumbnails.forEach((thumbnail, i) => {
                thumbnail.classList.toggle('active', i === index);
            });
        },

        showThumbnails() {
            const gallery = document.getElementById(this.galleryId);
            const thumbnails = gallery.querySelectorAll('.thumbnail-button');
            thumbnails.forEach((thumbnail, i) => {
                thumbnail.style.display = (i >= this.currentThumbIndex && i < this.currentThumbIndex + this.visibleThumbs) ? 'block' : 'none';
            });
        },

        moveThumb(direction) {
            const gallery = document.getElementById(this.galleryId);
            const totalThumbs = gallery.querySelectorAll('.thumbnail-button').length;
            const newSlideIndex = this.currentSlideIndex + direction;

            if (newSlideIndex >= 0 && newSlideIndex < totalThumbs) {
                this.currentSlideIndex = newSlideIndex;
                this.showSlide(this.currentSlideIndex);
                if (this.currentSlideIndex >= this.currentThumbIndex + this.visibleThumbs) {
                    this.currentThumbIndex++;
                } else if (this.currentSlideIndex < this.currentThumbIndex) {
                    this.currentThumbIndex--;
                }
                this.showThumbnails();
            }
        },

        init(exampleId) {
            this.galleryId = exampleId;
            this.currentSlideIndex = 0;
            this.currentThumbIndex = 0;
            this.showSlide(this.currentSlideIndex);
            this.showThumbnails();

            const gallery = document.getElementById(this.galleryId);
            const thumbnailButtons = gallery.querySelectorAll('.thumbnail-button');
            thumbnailButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    const index = event.currentTarget.getAttribute('data-index');
                    this.currentSlideIndex = parseInt(index);
                    this.showSlide(this.currentSlideIndex);
                });
            });

            const prevBtn = document.querySelector(`[data-gallery="${this.galleryId}"] .thumb-nav-button:first-child`);
            const nextBtn = document.querySelector(`[data-gallery="${this.galleryId}"] .thumb-nav-button:last-child`);

            if (prevBtn) prevBtn.addEventListener('click', () => this.moveThumb(-1));
            if (nextBtn) nextBtn.addEventListener('click', () => this.moveThumb(1));
        }
    };
}

export default imageGallery;