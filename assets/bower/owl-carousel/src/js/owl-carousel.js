// OwlCarousel
(function ($) {
    "use strict";
    const TAG = 'OwlCarousel'
    const SELECTOR = '.back-to-top-widget #back-to-top'

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
    */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    class OwlCarousel {

        /** @type {JQuery<Element>} */
        element;

        constructor() {
            // console.log($.fn)
            timeOut(1000, () => {
                const carousel = $('.owl-carousel').owlCarousel({
                    center: false,
                    items: 2,
                    loop: true,
                    margin: 0,
                    nav: false,
                    dots: true,
                    autoplay: true,
                    // autoplayTimeout: 6000,
                    // autoplaySpeed: 6000,
                    // autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        }
                    }
                })
                // console.log(carousel);
            })
        }


        static validate() {
            return $(SELECTOR).length > 0;
        }

        static instance() {
            new OwlCarousel()
            if (OwlCarousel.validate()) {
            }
        }
    }
    OwlCarousel.instance();

})(jQuery);
