(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(document).ready(function () {
        var faded = false;
        if (foosocial_settings.slidein != 'slidein') {
            $('body').append('<div id="foosocial-div-space" style="height: 50px"></div>');
            $('#foosocial-div').fadeIn('slow');
        }
        $(document).scroll(function () {
            if (foosocial_settings.slidein != 'slidein') {
                return;
            }
            var y = $(this).scrollTop();
            if (y > 200 && !faded) {
                faded = true;
                $('body').append('<div id="foosocial-div-space" style="height: 50px"></div>');
                $('#foosocial-div').fadeIn('slow');
            }
        });

        $(".foosocial-button").click(function (e) {
            e.preventDefault();
            var w = 600;
            var h = 400;
            var title = 'Share';
            var href = $(this).attr('href');
            if (typeof(href) != 'undefined') {
                var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
                var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

                var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

                var left = ((width / 2) - (w / 2)) + dualScreenLeft;
                var top = ((height / 2) - (h / 2)) + dualScreenTop;
                var newWindow = window.open(href, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                //window.open(href, "tweet", "height=300,width=550,resizable=1",'Share',windowFeatures);
            }

        });

    });

})(jQuery);
