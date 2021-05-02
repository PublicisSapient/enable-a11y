const EnableCarousel = function (container) {
  let glider;
  this.container = container;

  this.init = function () {
    // initializes Glider. We ensure that the carousel
    // is set to not have any animations by default.
    glider = new Glider(this.container, {
      slidesToShow: 1,
      dots: "#dots",
      duration: 0,
      arrows: {
        prev: ".glider-prev",
        next: ".glider-next",
      },
      draggable: true,
      scrollLock: true
    });

    // when keyboard focus is applied to a slide's CTA.
    this.container.addEventListener("focus", this.focusCTAHandler, true);

    // When the mouse is clicked, we will allow animations.
    document.body.addEventListener("mousedown", this.clickHandler, true);

    // When a keyboard is used and the key released is the TAB key,
    // we turn the animations off. 
    document.body.addEventListener("keyup", this.keyUpHandler, true);
  };

  this.focusCTAHandler = (e) => {
    // When keyboard focus is applied to a CTA in a slide,
    // we make the carousel display that slide.
    const { target } = e;
    this.slideToTarget(target);
  };

  this.slideToTarget = function (target) {
    // Figures out what slide the target element is in.
    // The carousel then displays that slide.
    const slide = target.closest(".enable-carousel__slide");

    if (slide) {
      const slideParent = slide.parentNode;
      const slideIndex = Array.prototype.indexOf.call(
        slideParent.children,
        slide
      );

      glider.scrollItem(slideIndex);
    }
  };

  this.clickHandler = (e) => {
    // this is a mouse user, so let's make the carousel animated.
    glider.setOption({
      duration: 0.5,
    });
  };

  this.keyUpHandler = (e) => {
    const { key } = e;

    if (key === "Tab") {
      // this is a keyboard user, so remove the carousel animation.
      glider.setOption({
        duration: 0,
      });
    }
  };

  this.init();
}


const a = new EnableCarousel(document.querySelector(".glider"));
