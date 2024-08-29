'use strict'

/*******************************************************************************
 * enable-thumbnail-carousel.js - Accessible shim over the Glider carousel
 * 
 * Written by Zoltan Hawryluk <zoltan.dulac@gmail.com>
 * Part of the Enable accessible component library.
 * Version 1.0 released December 27, 2021
 *
 * More information about this script available at:
 * https://www.useragentman.com/enable/carousel.php
 * 
 * Released under the MIT License.
 ******************************************************************************/

import '../../enable-node-libs/@splidejs/splide/dist/js/splide.min.js';

const EnableThumbnailCarousel = function () {
  const defaultOptions = {
    pagination: false,
  }
  const main = new Splide('#main-carousel', {
    ...defaultOptions,
    type: 'fade',
    arrows: false,
    lazyLoading: 'sequential',
  });

  const thumbnails = new Splide('#thumbnail-carousel', {
    ...defaultOptions,
    fixedWidth: 150,
    gap: 10,
    isNavigation: true,
    focus: 'center',
    breakpoints: {
      '768': {
        fixedWidth: 125,
      }
    }
  });

  // sync the thumbnails slider as a target of main slider.
  main.sync(thumbnails);
  main.mount();
  thumbnails.mount()
}

export default EnableThumbnailCarousel;
