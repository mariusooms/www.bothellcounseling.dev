/*!
 * jQuery Counselor-Grid plugin
 * Original author: @thuijssoon
 */

/*jslint browser: true, unparam: true */
/*global jQuery */

(function ($, window, document, undefined) {
    'use strict';

    var pluginName = "counselorGrid",
        defaults = {
            randomize: true,
            interval: 3000,
            afterTouchInterval: 5000,
            transitionSpeed: 1500,
            opacity: 0.4,
            autoPlay: true
        };

    function Plugin(element, options) {
        this.element = $(element);

        this.options = $.extend({}, defaults, options);

        this.defaults = defaults;
        this.pluginName = pluginName;

        this.init();
    }

    Plugin.prototype = {

        init: function () {
            var i,
                self = this,
                bindMethod = $.isFunction(jQuery().hoverIntent) ? 'hoverIntent' : 'hover';
                // isTouch = (window.ontouchstart !== 'undefined') || (navigator.msMaxTouchPoints > 0);

            this.timeout = null;
            this.counselors = this.element.find('ul.counselor-grid-images>li');
            this.counselors.find('a>img').css('opacity', this.options.opacity);

            this.index = -1;
            this.randomArray = [];
            for (i = this.counselors.length - 1; i >= 0; i = i - 1) {
                this.randomArray[i] = i;
            }

            this.namePlaceholder = this.element.find('.counselor-grid-info .counselor-grid-name');
            this.servicesPlaceholder = this.element.find('.counselor-grid-info .counselor-grid-services');
            this.counselorInfo = this.element.find('.counselor-grid-info');

            this.randomizeArray();

            this.highlightRandom();

            // Detect touch devices
            // typeof(document.documentElement.ontouchstart) != "undefined"
            // if (isTouch) {

            //     this.counselors.on("touchstart", function (e) {
            //         var newCounselor = $(this),
            //             newIndex = self.counselors.index(newCounselor),
            //             currnetCounselor = self.counselors.eq(self.randomArray[self.index]);

            //         clearTimeout(self.timeout);

            //         if (newCounselor.hasClass('counselor-grid-hover')) {
            //             return true;
            //         }

            //         self.transitionHighlight(currnetCounselor, newCounselor);

            //         self.index = self.randomArray.indexOf(newIndex);

            //         if (self.options.autoPlay) {
            //             self.timeout = setTimeout(function () {
            //                 self.highlightRandom();
            //             }, self.options.afterTouchInterval);
            //         }

            //         e.preventDefault();
            //         return false;

            //     });

            // }
            this.counselors[bindMethod](
                function () {
                    var newCounselor = $(this),
                        newIndex = self.counselors.index(newCounselor),
                        currnetCounselor = self.counselors.eq(self.randomArray[self.index]);

                    clearTimeout(self.timeout);

                    self.transitionHighlight(currnetCounselor, newCounselor);

                    self.index = self.randomArray.indexOf(newIndex);
                },
                function () {
                    if (self.options.autoPlay) {
                        self.timeout = setTimeout(function () {
                            self.highlightRandom();
                        }, self.options.interval);
                    }
                }
            );

            this.counselorInfo[bindMethod](
                function () {
                    clearTimeout(self.timeout);
                },
                function () {
                    if (self.options.autoPlay) {
                        self.timeout = setTimeout(function () {
                            self.highlightRandom();
                        }, self.options.interval);
                    }
                }
            );

        },

        randomizeArray: function () {
            if (this.options.randomize) {
                this.randomArray.sort(function () {
                    return 0.5 - Math.random();
                });
            }
        },

        highlightRandom: function () {
            var self = this,
                currnetCounselor = this.counselors.eq(this.randomArray[this.index]),
                newCounselor = null;

            // We have shown all counselors so regenerate random array
            if (this.index >= this.counselors.length - 1) {
                this.index = -1;
                this.randomizeArray();
            }

            this.index += 1;

            newCounselor = this.counselors.eq(this.randomArray[this.index]);

            this.transitionHighlight(currnetCounselor, newCounselor);

            if (self.options.autoPlay) {
                this.timeout = setTimeout(function () {
                    self.highlightRandom();
                }, this.options.interval);
            }
        },

        transitionHighlight: function (currnetCounselor, nextCounselor) {
            var self = this,
                profileURL = '<a href="' + nextCounselor.find('>a').attr('href') + '">' + nextCounselor.find('.counselor-grid-name').html() + '</a>';

            // Unhighlight current counselor
            if (currnetCounselor.length) {
                currnetCounselor.find('a>img').stop().fadeTo(this.options.transitionSpeed, self.options.opacity);
            }

            // Construct profile url and show info
            this.namePlaceholder.css('opacity', 0).html(profileURL).fadeTo(this.options.transitionSpeed, 1);

            // Fade in the new services
            this.servicesPlaceholder.css('opacity', 0).html(nextCounselor.find('.counselor-grid-services').html()).fadeTo(this.options.transitionSpeed, 1);

            // Highlight counselor image
            nextCounselor.find('a>img').stop().fadeTo(this.options.transitionSpeed, 1);

            // Add class to indicate counselor is highlighted for touch events
            self.counselors.removeClass('counselor-grid-hover');
            nextCounselor.addClass('counselor-grid-hover');

        }

    };

    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                    new Plugin(this, options));
            }
        });
    };

}(jQuery, window, document));