// google-maps.js

(function ($) {
    "use strict";
    const TAG = 'GoogleMaps'
    const SELECTOR = '#google-maps'

    /**
     * @param {CallableFunction} callback
     * @param {number} ms
     * @return {Promise<void>}
    */
    const timeOut = (ms, callback) => new Promise(resolve => setTimeout(resolve, ms)).then(callback);

    const EVENTS = {
        BOUNDS_CHANGED: "bounds_changed",
        CENTER_CHANGED: "center_changed",
        CLICK: "click",
        CONTEXTMENU: "contextmenu",
        DBLCLICK: "dblclick",
        DRAG: "drag",
        DRAGEND: "dragend",
        DRAGSTART: "dragstart",
        HEADING_CHANGED: "heading_changed",
        IDLE: "idle",
        MAPTYPEID_CHANGED: "maptypeid_changed",
        MOUSEMOVE: "mousemove",
        MOUSEOUT: "mouseout",
        MOUSEOVER: "mouseover",
        PROJECTION_CHANGED: "projection_changed",
        RESIZE: "resize",
        RIGHTCLICK: "rightclick",
        TILESLOADED: "tilesloaded",
        TILT_CHANGED: "tilt_changed",
        ZOOM_CHANGED: "zoom_changed"
    }

    class Util {

        static hasKey(obj, keys) {

            if (typeof obj !== 'object') {
                return false;
            }

            const items = [];
            keys.map(t => {
                items.push(Object.keys(obj).includes(t))
            })
            return items && !items.includes(false)
        }
    }

    class Marker extends google.maps.Marker {

        /**
         * 
         * @param {google.maps.Map} map
         */
        constructor(map, markerOption) {
            super($.extend(markerOption, {
                map: map,
                position: map.getCenter().toJSON(),
                icon: {
                    url: markerOption.icon,
                    scaledSize: new google.maps.Size(50, 50)
                },
            }))
        }
    }

    class LatLng {
        lat
        lng

        /**
         * 
         * @param {string|number} lat
         * @param {string|number} lng
         */
        constructor(lat, lng) {
            this.lat = lat
            this.lng = lng
        }

        toJson() {
            return { lat: this.lat, lng: this.lng }
        }
    }


    class InfoWindow extends google.maps.InfoWindow {

        /**
         * 
         * @param {google.maps.Map} map
         */
        constructor(map, infoWindow) {
            super($.extend(infoWindow, {
                map: map,
            }))
        }
    }

    class GoogleMaps {

        /** @type {JQuery<Element>} */
        $element;

        /**
         * 
         * @param {Element} element
         */
        constructor(element) {
            this.$element = $(element)
            const options = $(element).data('options') ?? {};

            if (!Util.hasKey(options, ['lat', 'lng'])) {
                return;
            }

            let markerOption = Util.hasKey(options, ['marker']) ? options.marker : {};
            let infoWindow = Util.hasKey(options, ['infoWindow']) ? options.infoWindow : {};

            const latlng = new LatLng(options.lat, options.lng)
            // console.log(options);

            const map = new google.maps.Map(element, {
                center: latlng.toJson(),
                zoom: 17,
            });

            const infowindow = new InfoWindow(map, infoWindow);
            const marker = new Marker(map, markerOption);
            timeOut(1000, () => {
                infowindow.open(null, marker)
            })

        }

        static validate() {
            return typeof $ === 'function' &&
                $(SELECTOR).length > 0 &&
                typeof window === 'object' &&
                typeof window['google'] === 'object';
        }

        static instance() {
            if (GoogleMaps.validate()) {
                new GoogleMaps($(SELECTOR).get(0))
            }
        }
    }

    timeOut(500, () => {
        GoogleMaps.instance();
    })

})(jQuery);
