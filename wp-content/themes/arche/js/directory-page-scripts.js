/*jslint browser: true, devel: true, indent: 4, unparam: true */
/*global jQuery */

(function ($, window, document) {

    'use strict';

    var cd = {
        previousLoctions: false,
        initLocationFilter: function () {

            $('#m-locations-radio input:radio').on('ifClicked', function (event) {
                var $this = $(this);
                if (cd.previousLoctions && $this.val() === cd.previousLoctions) {
                    $this.iCheck('uncheck');
                    cd.previousLoctions = false;
                } else {
                    cd.previousLoctions = $this.val();
                }
            });
        }
    };

    $(document).ready(function () {
        cd.initLocationFilter();
    });

}(jQuery, window, document));