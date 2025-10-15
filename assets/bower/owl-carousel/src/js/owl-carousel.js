// OwlCarousel
(function ($) {
    "use strict";
    const TAG = 'Owl Carousel'
    const SELECTOR = '.owl-carousel'

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
    */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    class OwlCarousel {

        /** @type {JQuery<Element>} */
        $element;

        /**
         * 
         * @param {Element} element
         */
        constructor(element) {
            this.$element = $(element);
            const options = this.$element.data('options') ?? {};
            this.#addAriaLabel();

            if (Object.keys(options).length === 0) {
                return;
            }

            /** @type {import("owlcarousel")} */
            const $owlCarousel = this.$element.owlCarousel(options)
        }


        /**
         * 
         * @returns {void}
         */
        #addAriaLabel() {
            this.$element
                .on('initialize.owl.carousel', (event) => {

                    timeOut(1000, () => {
                        const $prev = this.$element.find('.owl-prev[type="button"]')
                        const $next = this.$element.find('.owl-next[type="button"]')
                        if ($prev.length === 1 && $next.length === 1) {
                            $prev.attr({ 'aria-label': 'Previous slide' });
                            $next.attr({ 'aria-label': 'Next slide' });
                        }

                        const $owlDot = $('.owl-dot');
                        if ($owlDot.length > 0) {
                            $owlDot
                                .each(function (index) {
                                    $(this).attr('aria-label', 'Navigate to Slide ' + (index + 1));
                                });
                        }
                    })

                })
        }

        /** 
         * @returns {boolean}
         */
        static validate() {

            return typeof $ === 'function' &&
                typeof $.fn?.owlCarousel === 'function' &&
                $(SELECTOR).length > 0;
        }

        /** 
         * @returns {void}
         */
        static instance() {
            if (OwlCarousel.validate()) {
                $('body')
                    .find(SELECTOR)
                    .each((i, element) => {
                        new OwlCarousel(element)
                    })
            }
        }
    }

    timeOut(500, () => {
        OwlCarousel.instance();
    })

})(jQuery);
