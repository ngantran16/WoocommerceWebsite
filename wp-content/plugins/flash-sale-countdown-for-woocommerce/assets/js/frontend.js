(function ($) {
	"use strict";

	$(document).ready(function () {
		flashSaleCountdown_frontend.ready();
	});

	$(window).load(function () {
		flashSaleCountdown_frontend.load();
	});

	var flashSaleCountdown_frontend = window.$flashSaleCountdown_frontend = {

		/**
		 * Call functions when document ready
		 */
		ready: function () {
            this.simple_countdown();
		},

		/**
		 * Call functions when window load.
		 */
		load: function () {

		},

		// CUSTOM FUNCTION IN BELOW
        simple_countdown: function() {

            $('.flash-sale-countdown').each(function(index, item) {
                var $this = $(this);
                var date = $this.data('date');
                var countDownDate = new Date(date).getTime();
                // Update the count down every 1 second
                var x = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;
    
                    // Time calculations for days, hours, minutes and seconds
                    var days = flashSaleCountdown_frontend.numberFormat(Math.floor(distance / (1000 * 60 * 60 * 24)));
                    var hours = flashSaleCountdown_frontend.numberFormat(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                    var minutes = flashSaleCountdown_frontend.numberFormat(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
                    var seconds = flashSaleCountdown_frontend.numberFormat(Math.floor((distance % (1000 * 60)) / 1000));

                    var htmlDisplay = '';
                    if (days != '00') {
                        var labelDay = days > 1 ? flashSaleCountdown.days : flashSaleCountdown.day;
                        htmlDisplay += '<span class="days">' + days + " " + labelDay + "</span>";
                    }
                    htmlDisplay += '<span class="hours">' + hours + "</span>";
                    htmlDisplay += '<span class="minutes">' + minutes + "</span>";
                    htmlDisplay += '<span class="seconds">' + seconds + "</span>";
    
                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                    }
                    $this.find('.countdown--counter').html(htmlDisplay);
                }, 1000);
            });
        },

        numberFormat: function(number){
            return number > 9 ? "" + number: "0" + number;
        }

	};

})(jQuery);