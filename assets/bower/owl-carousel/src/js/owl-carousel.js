// OwlCarousel
/// <reference types="jquery"/>
/// <reference types="owlcarousel"/>

(function ($) {
    "use strict";
    const TAG = 'OwlCarousel'
    const SELECTOR = '.owl-carousel'

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
    */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    class OwlCarousel {

        /** @type {JQuery<Element>} */
        element;

        constructor(element) {
            timeOut(500, () => {
                const $owl = $(element);
                const options = $owl.data('options') ?? {};

                /** @type {import("owlcarousel")} */
                const $owlCarousel = $owl.owlCarousel(options)
                console.log($owlCarousel.data())
            })
        }

        static validate() {
            return $(SELECTOR).length > 0;
        }

        static instance() {
            if (OwlCarousel.validate()) {
                $('body').find(SELECTOR).each((i, element) => {
                    new OwlCarousel(element)
                })
            }
        }
    }
    timeOut(500, () => {
        OwlCarousel.instance();
    })

})(jQuery);
