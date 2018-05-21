(function ($, global) {

    window.loaded = true;

    var CountDown = {
        init: function () {
            var $countdown = $('.js-countdown');
            var hours, minutes, seconds;
            var html = '';

            if ($countdown.length && $countdown.data('countdown')) {
                var date = new Date();
                date.setTime($countdown.data('countdown') * 1000);
                $countdown.countdown(date)
                    .on('update.countdown', function (e) {
                        hours = CountDown.pad(e.offset.hours + e.offset.days * 24, 3);
                        minutes = CountDown.pad(e.offset.minutes, 2);
                        seconds = CountDown.pad(e.offset.seconds, 2);

                        html = '<div class="featured-poll__countdown_number">' + hours.toString().split('').join('</div><div class="featured-poll__countdown_number">') + '</div>';
                        html += '<div class="featured-poll_countdown_delimiter">:</div>';
                        html += '<div class="featured-poll__countdown_number">' + minutes.toString().split('').join('</div><div class="featured-poll__countdown_number">') + '</div>';
                        html += '<div class="featured-poll_countdown_delimiter">:</div>';
                        html += '<div class="featured-poll__countdown_number">' + seconds.toString().split('').join('</div><div class="featured-poll__countdown_number">') + '</div>';

                        $countdown.empty().html(html);
                    }).countdown('start');
            }
        },

        pad: function (n, width, z) {
            z = z || '0';
            n = n + '';
            return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
        }
    };

    var Video = {
        button: function ($container) {
            var $button = $('.video_thumbnail', $container);
            var $frameWrapper = $(".js-video-frame-wrapper", $container);

            $button.on('click', function () {
                var videoSrc = $frameWrapper.find('iframe')[0].src;
                $frameWrapper.find('iframe').attr('width', $button.width());
                $frameWrapper.find('iframe').attr('height', $button.height());
                $frameWrapper.find('iframe')[0].src += (videoSrc.indexOf('?') === -1 ? '?' : '&') + "autoplay=1";

                setTimeout(function() {
                $button.hide();
                    $frameWrapper.show();
                }, 100);
            });
        },
        init: function () {
            var that = this;
            $('.js-video-container').each(function () {
                that.button($(this));
            });
        }
    }

    $(function () {
        Video.init();
    });

    global.CountDown = CountDown;

})(jQuery, window);