'use strict'

import config from './test-config.js';
import testHelpers from './test-helpers.js';


describe('Carousel Tests', () => {
  beforeAll(async () => {
  });


  // Test #1
  it('Test carousel type #1 (list of links)', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/carousel.php`);

    
    // wait until all content loads
    await page.waitForSelector('#example1');

    const numSlidesInCarousel = Array.from(await page.$$('#example1 .enable-carousel__slide')).length;
    expect(numSlidesInCarousel).toBeGreaterThan(0);

    // First detect if the first focused element is the skip link.
    domInfo = await page.evaluate(() => {
      const firstSkipLink = document.querySelector('#beginning-of-component-1');
      firstSkipLink.focus();
      return {
        isSkipLinkFocused: (document.activeElement === firstSkipLink)
      }
    });

    expect(domInfo.isSkipLinkFocused).toBe(true);

    // After each press of the TAB key from this point on, focus
    // should go to the sole interactive element in each of the slides.
    // This test assumes one CTA per slide.  If we change this, this
    // test will break.
    for (let i=0; i <numSlidesInCarousel; i++) {

      page.keyboard.press('Tab');
      // We pause to ensure any action due to the keypress has started
      await testHelpers.fastPause();
      // We wait for the carousel animations to have completed
      await page.waitForSelector('.glider-slide.active.visible');

      // This test checks to ensure that we have tabbed into a new slide. 
      domInfo = await page.evaluate((i) => {
        const { activeElement } = document;
        const $container = document.querySelector('#example1');
        const $slides = $container.querySelectorAll('.enable-carousel__slide');
        const $currentSlide = $slides[i];
        const $parentOfActiveElement = activeElement.closest('.enable-carousel__slide');
        const isActiveElementInCurrentSlide = 
          ($parentOfActiveElement === $currentSlide);
        

        return {
          isActiveElementInCurrentSlide,
          $currentSlide: $currentSlide.outerHTML,
          activeElement: activeElement.outerHTML
        }

      }, i);
      if (!domInfo.isActiveElementInCurrentSlide) {
        console.log(`Focus is wrong:
          $currentSlide: ${domInfo.$currentSlide} 
          activeElement: ${domInfo.activeElement}
        `);
      }
      expect(domInfo.isActiveElementInCurrentSlide).toBe(true);

      // We pause to ensure the animation to the next slide has time to
      // stop (if there is one)

      // We now check to see if the newly shown slide is fully in view.
      // We check this to ensure the slide is not cut off by the carousel
      // container.  Many carousels fail to do this, and the Enable carousel
      // ensures this happens, so we test for it.
      domInfo = await page.evaluate((i, numSlidesInCarousel) => {
        const { activeElement } = document;
        const $container = document.querySelector('#example1');
        const $slides = $container.querySelectorAll('.enable-carousel__slide');
        const $currentSlide = $slides[i];
        const $previousSlide = (i !== 0) ? $slides[i-1] : $slides[$slides.length - 1];
        const $nextSlide = (i < numSlidesInCarousel - 1) ? $slides[i+1] : $slides[0];

        const isCurrentSlideActive = 
          $currentSlide.classList.contains('active') && 
          $currentSlide.classList.contains('visible');

        let currentSlideRect = $currentSlide.getBoundingClientRect();
        let containerRect = $container.getBoundingClientRect();
        let previousSlideRect = $previousSlide.getBoundingClientRect();
        let nextSlideRect = $nextSlide.getBoundingClientRect();

        // We are cloning these objects so they can be used outside 
        // the page.evaluate() function, since the rect properties 
        // returned by .getBoundingClientRect() will not be seen
        // outside the function.
        currentSlideRect = JSON.parse(JSON.stringify(currentSlideRect));
        containerRect = JSON.parse(JSON.stringify(containerRect));
        previousSlideRect = JSON.parse(JSON.stringify(previousSlideRect));
        nextSlideRect = JSON.parse(JSON.stringify(nextSlideRect));

        const isCurrentSlideInView = 
          containerRect.x <= currentSlideRect.x && currentSlideRect.right <= containerRect.right;

        const isPrevSlideOutOfView = 
          containerRect.x > previousSlideRect.x || previousSlideRect.right > containerRect.right;

        const isNextSlideOutOfView = 
          containerRect.x > nextSlideRect.x || nextSlideRect.right > containerRect.right;
        
        return {
          isCurrentSlideActive,
          containerRect,
          currentSlideRect,
          previousSlideRect,
          nextSlideRect,
          isCurrentSlideInView,
          isPrevSlideOutOfView,
          isNextSlideOutOfView
        };
      }, i, numSlidesInCarousel);
      //const {x, y, bottom, right, width, height} = domInfo.containerRect;

      // Make sure the current slide is active
      expect(domInfo.isCurrentSlideActive).toBe(true);

      // Make sure the current slide is fully inside the containers viewing
      // area (i.e. not half in our out).
      expect(domInfo.isCurrentSlideInView).toBe(true);

      // Make sure previous and next slides are out of view
      expect(domInfo.isPrevSlideOutOfView).toBe(true);
      expect(domInfo.isNextSlideOutOfView).toBe(true);

      // If the above fails, you may want to uncomment the item
      // below to debug what is going on here.
      // console.log('rects', domInfo.containerRect, domInfo.currentSlideRect, domInfo.previousSlideRect, domInfo.nextSlideRect);
    }



    // Now let's ensure the last skip link is last Tab stop.
    page.keyboard.press('Tab');
    // We pause to ensure any action due to the keypress has started
    await testHelpers.fastPause();
    // We wait for the carousel animations to have completed
    await page.waitForSelector('.glider-slide.active.visible');
    domInfo = await page.evaluate(() => {
      const lastSkipLink = document.querySelector('#end-of-component-1');
      return {
        isSkipLinkFocused: (document.activeElement === lastSkipLink)
      }
    });
    expect(domInfo.isSkipLinkFocused).toBe(true);

    
  });

  /*
  it('Test carousel type #2 (list of content)', async () => {
    let domInfo;

    await page.goto(`${config.BASE_URL}/carousel.php`);

    
    // wait until all content loads
    await page.waitForSelector('#example2');

    const slidesInCarousel = Array.from(await page.$$('#example2 .enable-carousel__slide'))
    const numSlidesInCarousel = slidesInCarousel.length;
    expect(numSlidesInCarousel).toBeGreaterThan(0);

    // Let's set focus on the first slide.
    domInfo = await page.evaluate(() => {
      const $firstSlide = document.querySelector('#example2 .enable-carousel__slide');
      $firstSlide.focus();
      return {
        isFirstSlideFocused: (document.activeElement === $firstSlide)
      }
    });
    expect(domInfo.isFirstSlideFocused).toBe(true);

    // Now, let's TAB backwards to see if we get to the previous tab,
    // and check if it is disabled and that there are instructions.
    await page.keyboard.down('Shift');
    await page.keyboard.press('Tab');
    await page.keyboard.press('Tab');
    await page.keyboard.up('Shift');

    domInfo = await page.evaluate(() => {
      const { activeElement } = document;
      const $prevButton = document.querySelector('#example2 .glider-prev');
      const isDisabled = ($prevButton.getAttribute('aria-disabled') === 'true');
      const ariaDescribedby = $prevButton.getAttribute('aria-describedby');
      const $instructions = ariaDescribedby ? document.getElementById(ariaDescribedby) : null;
      const hasInstructions = ariaDescribedby && $instructions && $instructions.innerHTML.trim() !== '';

      return {
        isPrevButtonFocused: (activeElement === $prevButton),
        isDisabled,
        hasInstructions,
        activeElement: activeElement.outerHTML
      }
    });
    if (!domInfo.isPrevButtonFocused) {
      console.log('focused element:', domInfo.activeElement);
    }

    expect(domInfo.isPrevButtonFocused).toBe(true);
    expect(domInfo.isDisabled).toBe(true);
    expect(domInfo.hasInstructions).toBe(true);

    // Now, cycle through each of the carousel panels using the
    // next button and ensure that when pressed, focus goes to 
    // the newly visible panel.
    for (let i=1; i<numSlidesInCarousel; i++) {

      // Test to see if we tab into the "Next" button.
      await page.keyboard.press('Tab');

      // put in an extra tab press if the first slide
      if ( i === 1 ) {
        await testHelpers.pauseFor(100);
        await page.keyboard.press('Tab');
      }

      domInfo = await page.evaluate((i) => {
        const { activeElement } = document;
        const $nextButton = document.querySelector('#example2 .glider-next');

        return {
          isFocusOnNextButton: (activeElement === $nextButton),
          activeElement: activeElement.outerHTML,
        }

      }, i);
      if (!domInfo.isFocusOnNextButton) {
        console.log('activeElement', i, domInfo.activeElement);
      }
      expect(domInfo.isFocusOnNextButton).toBe(true);
      
      // Now, let's press the space key and see if focus goes to the newly visible panel
      // Test to see if we tab into the "Next" button.
      await page.keyboard.press('Space');
      await testHelpers.pauseFor(100);


      domInfo = await page.evaluate((i) => {
        
        const { activeElement } = document;
        const $slides = document.querySelectorAll('#example2 .enable-carousel__slide');
        const $currentSlide = $slides[i];

        return {
          isFocusInVisiblePanel: (activeElement === $currentSlide || activeElement.closest('.enable-carousel__slide') === $currentSlide),
          $currentSlide: $currentSlide.outerHTML,
          activeElement: activeElement.outerHTML,
        }

      }, i);
      if (!domInfo.isFocusInVisiblePanel) {
        console.log(`Focus is wrong:
          $currentSlide: ${domInfo.$currentSlide} 
          activeElement: ${domInfo.activeElement}
        `);
      }
      expect(domInfo.isFocusInVisiblePanel).toBe(true);
    }

    // Now, test that next tab stop goes to the "next" button and it is disabled.
    await page.keyboard.press('Tab');

    domInfo = await page.evaluate(() => {
      const { activeElement } = document;
      const $nextButton = document.querySelector('#example2 .glider-next');
      const isDisabled = ($nextButton.getAttribute('aria-disabled') === 'true');

      return {
        isFocusOnNextButton: (activeElement === $nextButton),
        isDisabled
      }

    });
    expect(domInfo.isFocusOnNextButton).toBe(true);
    expect(domInfo.isDisabled).toBe(true);

    // Finally, let's test tabbing backwards tp previous button continuously
    // and pressing it to see if that works as expected.
    for (let i=numSlidesInCarousel - 2; i>=0; i--) {

      // Test to see if we tab backwards into the "Previous" button.
      await page.keyboard.down('Shift');
      await page.keyboard.press('Tab');
      await page.keyboard.up('Shift');

      domInfo = await page.evaluate((i) => {
        const { activeElement } = document;
        const $prevButton = document.querySelector('#example2 .glider-prev');

        return {
          isFocusOnPrevButton: (activeElement === $prevButton)
        }

      }, i);
      expect(domInfo.isFocusOnPrevButton).toBe(true);
      
      // Now, let's press the space key and see if focus goes to the newly visible panel
      // Test to see if we tab into the "Next" button.
      await page.keyboard.press('Space');
      await testHelpers.pauseFor(100);


      domInfo = await page.evaluate((i) => {
        
        const { activeElement } = document;
        const $slides = document.querySelectorAll('#example2 .enable-carousel__slide');
        const $currentSlide = $slides[i];

        return {
          isFocusInVisiblePanel: (activeElement === $currentSlide || activeElement.closest('.enable-carousel__slide') === $currentSlide),
          $currentSlide: $currentSlide.outerHTML,
          activeElement: activeElement.outerHTML
        }

      }, i);
      if (!domInfo.isFocusInVisiblePanel) {
        console.log(`Focus is wrong:
          $currentSlide: ${domInfo.$currentSlide} 
          activeElement: ${domInfo.activeElement}
        `);
      }
      expect(domInfo.isFocusInVisiblePanel).toBe(true);
    }


    // Test to see if we tab once more the "Previous" button.
    await page.keyboard.down('Shift');
    await page.keyboard.press('Tab');
    await page.keyboard.up('Shift');


    domInfo = await page.evaluate(() => {
      const { activeElement } = document;
      const $prevButton = document.querySelector('#example2 .glider-prev');
      const isDisabled = ($prevButton.getAttribute('aria-disabled') === 'true');

      return {
        isFocusOnPrevButton: (activeElement === $prevButton),
        isDisabled
      }

    });
    expect(domInfo.isFocusOnPrevButton).toBe(true);
    expect(domInfo.isDisabled).toBe(true);
  });
  */
});
