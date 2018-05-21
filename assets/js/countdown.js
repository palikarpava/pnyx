jQuery(document).ready(function ($) {
    var now = new Date();
    now.setTime(now.getTime() + 86400000);
    var endDate = new Date(jQuery('.totalpoll-poll-container input.enddate').val());
    var currentDate = Date.now();
    if (currentDate > endDate) {
        $('.timecounter').hide();
    }
});

(function ($) {

    function Countstrange($elem) {
        var newdate = new Date($elem.parents('.totalpoll-poll-container').find('input.enddate').val());

        $('.your-clock', $elem).FlipClock(newdate, {
            clockFace: 'DailyCounter',
            countdown: true
        });
    }

    function Countmicro($elem) {
        var theday = 10;
        var themonth = 15;
        var theyear = 2017;

        var ringer = {
            countdown_to: theday + "/" + themonth + "/" + theyear,
            rings: {
                'DAYS': {
                    s: 86400000, // mseconds in a day,
                    max: 365
                },
                'HOURS': {
                    s: 3600000, // mseconds per hour,
                    max: 24
                },
                'MINUTES': {
                    s: 60000, // mseconds per minute
                    max: 60
                },
                'SECONDS': {
                    s: 1000,
                    max: 60
                },
                'MICROSEC': {
                    s: 10,
                    max: 100
                }
            },
            r_count: 5,
            r_spacing: 10, // px
            r_size: 50, // px
            r_thickness: 5, // px
            update_interval: 11, // ms


            init: function () {
                $r = ringer;
                $r.cvs = document.createElement('canvas');
                if ($(document).width() < 376){
                    $r.r_size = 45;
                    $r.r_spacing = 5;
                }

                $r.size = {
                    w: ($r.r_size + $r.r_thickness) * $r.r_count + ($r.r_spacing * ($r.r_count - 1)),
                    h: ($r.r_size + $r.r_thickness)
                };
                $r.cvs.setAttribute('width', $r.size.w);
                $r.cvs.setAttribute('height', $r.size.h);
                $r.ctx = $r.cvs.getContext('2d');
                $(".countdownwrap", $elem).append($r.cvs);
                $r.cvs = $($r.cvs);
                $r.ctx.textAlign = 'center';
                $r.actual_size = $r.r_size + $r.r_thickness;
                //  $r.countdown_to_time = new Date($r.countdown_to).getTime();

                $r.countdown_to_time = new Date($elem.parents('.totalpoll-poll-container').find('input.enddate').val());
                $r.cvs.css({ width: $r.size.w + "px", height: $r.size.h + "px" });
                $r.go();
            },
            ctx: null,
            go: function () {
                var idx = 0;

                $r.time = (new Date().getTime()) - $r.countdown_to_time;


                for (var r_key in $r.rings) $r.unit(idx++, r_key, $r.rings[r_key]);

                setTimeout($r.go, $r.update_interval);
            },
            unit: function (idx, label, ring) {
                var x, y, value, ring_secs = ring.s;
                value = parseFloat($r.time / ring_secs);
                $r.time -= Math.round(parseInt(value)) * ring_secs;
                value = Math.abs(value);

                x = ($r.r_size * .5 + $r.r_thickness * .5);
                x += +(idx * ($r.r_size + $r.r_spacing + $r.r_thickness));
                y = $r.r_size * .5;
                y += $r.r_thickness * .5;


                // calculate arc end angle
                var degrees = 360 - (value / ring.max) * 360.0;
                var endAngle = degrees * (Math.PI / 180);

                $r.ctx.save();

                $r.ctx.translate(x, y);
                $r.ctx.clearRect($r.actual_size * -0.5, $r.actual_size * -0.5, $r.actual_size, $r.actual_size);

                // first circle
                $r.ctx.strokeStyle = "rgba(128,128,128,0.2)";
                $r.ctx.beginPath();
                $r.ctx.arc(0, 0, $r.r_size / 2, 0, 2 * Math.PI, 2);
                $r.ctx.lineWidth = $r.r_thickness;
                $r.ctx.stroke();

                // second circle
                $r.ctx.strokeStyle = "rgba(253, 128, 1, 0.9)";
                $r.ctx.beginPath();
                $r.ctx.arc(0, 0, $r.r_size / 2, 0, endAngle, 1);
                $r.ctx.lineWidth = $r.r_thickness;
                $r.ctx.stroke();

                // label
                $r.ctx.fillStyle = "#000000";

                $r.ctx.font = '10px Helvetica';
                $r.ctx.fillText(label, 0, 13);
                //$r.ctx.fillText(label, 0, 23);

                $r.ctx.font = 'bold 16px Helvetica';
                $r.ctx.fillText(Math.floor(value), 0, 0);

                $r.ctx.restore();
            }
        };

        ringer.init();
    }

    function Countflip($elem) {
        function format(v) {
            return v.toString().length === 1 ? '0' + v : v;
        }

        var now = new Date();

        var currentDate = Date.now();
        now.setTime(now.getTime() + 86400000);
        var endDate = new Date($elem.parents('.totalpoll-poll-container').find('input.enddate').val());
        var $days = $('.days', $elem);
        var $hours = $('.hours', $elem);
        var $mins = $('.minutes', $elem);
        var $secs = $('.seconds', $elem);

        setInterval(function () {

            currentDate = Date.now();
            if (currentDate < endDate) {

                var time = endDate - currentDate;

                var seconds = Math.floor(time / 1000 % 60);
                var minutes = Math.floor(time / 60000 % 60);
                var hours = Math.floor(time / 3600000 % 24);
                var days = Math.floor(time / 86400000);

                $secs.text(format(seconds));
                $mins.text(format(minutes));
                $hours.text(format(hours));
                $days.text(days);
            }
        }, 100);
    }

    function Qfclock($elem) {

        var now = new Date();

        var currentDate = Date.now();
        now.setTime(now.getTime() + 86400000);
        var endDate = new Date($elem.parents('.totalpoll-poll-container').find('input.enddate').val());

        var $days = $('.days', $elem);
        var $hours = $('.hours', $elem);
        var $mins = $('.minutes', $elem);
        var $secs = $('.seconds', $elem);

        setInterval(function () {

            currentDate = Date.now();
            if (currentDate < endDate) {

                var time = endDate - currentDate;

                var seconds = Math.floor(time / 1000 % 60);
                var minutes = Math.floor(time / 60000 % 60);
                var hours = Math.floor(time / 3600000 % 24);
                var days = Math.floor(time / 86400000);

                $secs.text(('0' + seconds).slice(-2));
                $mins.text(('0' + minutes).slice(-2));
                $hours.text(('0' + hours).slice(-2));

                $days.text(days);
            }
        }, 100);
    }

    $.fn.countflip = function () {
        $(this).each(function () {
            new Countflip($(this));
        });
    };

    $.fn.countmicro = function () {
        $(this).each(function () {
            new Countmicro($(this));
        });
    };

    $.fn.countstrange = function () {
        $(this).each(function () {
            new Countstrange($(this));
        });
    };

    $.fn.qfclock = function () {
        $(this).each(function () {
            new Qfclock($(this));
        });
    };

}(jQuery));

