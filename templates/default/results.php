<?
if (defined('ABSPATH') === false) :
    exit;
endif;
?>

<? global $post;
$is_poll_page = $post->post_type == 'poll';
?>
<? $post = get_post($this->poll->id()); ?>

<? $taxonomies = get_the_terms($post, 'poll_category'); ?>
<? $taxonomy = empty($taxonomies) ? null : array_pop($taxonomies); ?>

<? $imageUrl = $taxonomy ? get_option('z_taxonomy_image' . $taxonomy->term_id) : null; ?>
<div class="featured-poll_block featured-poll_block-vote">
    <div class="featured-poll_block__inner">
        <div class="featured-poll__header">
            <? if ($taxonomy): ?>
                <div class="featured-poll__category-image">
                    <a href="<?= get_term_link($taxonomy) ?>" class="featured-poll__category-link">
                        <img src="<?= $imageUrl ?>">
                    </a>
                </div>
            <? endif; ?>

            <div class="featured-poll__col">
                <h3 class="featured-poll__title">
                    <?= $taxonomy ? $taxonomy->name : '' ?>
                </h3>

                <p class="featured-poll__subtitle">
                    <?= get_post_meta(($post->ID), 'question', true); ?>
                </p>
            </div>
        </div>
        <div class="featured-poll__footer clearfix">
            <time class="featured-poll__date">
                <?= date('M j, Y', strtotime($post->post_date)) ?>
            </time>

            <? if (function_exists('sharify_display_button_buttons')): ?>
                <?= sharify_display_button_buttons(); ?>
            <? endif; ?>
        </div>
        <? 
        $limitations = $this->poll->settings( 'limitations' );
        $now = time();

        if(isset($limitations['date']['enabled']) && $limitations['date']['enabled'] == 'on' && isset($limitations['date']['end'])
            && $limitations['date']['end'] > $now) :

            if ($this->poll->settings('limitations')['counttype'] == 'countflip') : ?>
                <div class="countflip timecounter">
                    <div class="countdowninside">
                        <div class="days-container">
                            <div class="days"></div>
                            <span>days</span>
                        </div>
                        <div class="hours-container">
                            <div class="hours"></div>
                            <span>hours</span>
                        </div>
                        <div class="minutes-container">
                            <div class="minutes"></div>
                            <span>minutes</span>
                        </div>
                        <div class="seconds-container">
                            <div class="seconds"></div>
                            <span>seconds</span>
                        </div>
                    </div>
                </div>
            <? elseif ($this->poll->settings('limitations')['counttype'] == 'countmicro') : ?>
                <div class="countmicro timecounter">
                    <div class="countdownwrap"></div>
                </div>
            <? elseif ($this->poll->settings('limitations')['counttype'] == 'countstrange') : ?>
                <div class="countstrange timecounter">
                    <div class="your-clock"></div>
                </div>
                <div class="clear"></div>
            <? elseif ($this->poll->settings('limitations')['counttype'] == 'countblock') : ?>
                <div class="countblock timecounter">
                    <div class="qfClockWrapper">
                        <div class="qfClock">
                            <div>
                                <span class="days"></span>
                                <div class="smalltext">DAYS</div>
                            </div>
                            <div>
                                <span class="hours"></span>
                                <div class="smalltext">HOURS</div>
                            </div>
                            <div>
                                <span class="minutes"></span>
                                <div class="smalltext">MINS</div>
                            </div>
                            <div>
                                <span class="seconds"></span>
                                <div class="smalltext">SECS</div>
                            </div>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        <? endif; ?>

        <div class="featured-poll__description">
            <?
            $chosen = $this->poll->choices();

            $by_date = get_post_meta($this->poll->id(), 'votes_per_date', true);
            if(!$by_date){
                $by_date = [];
            }
            ?>
            <? if (!empty($chosen)): ?>

                <?
                $colors = [
                    'rgba(255, 99, 132,0.2)',
                    'rgba(54, 162, 235,0.2)',
                    'rgba(255, 206, 86,0.2)',
                    'rgba(75, 192, 192,0.2)',
                    'rgba(153, 102, 255,0.2)',
                    'rgba(255, 159, 64,0.2)',
                    'rgba(139, 195, 74,0.2)',
                    'rgba(255, 87, 34,0.2)',
                    'rgba(255, 235, 59,0.2)',
                    'rgba(0, 150, 136,0.2)',
                    'rgba(156, 39, 176,0.2)',
                    'rgba(96, 125, 139,0.2)'
                ];

                $types = [
                    '2' => 'pie',
                    '3' => 'doughnut',
                    '4' => 'line',
                    '1' => 'bar',
                    '6' => 'polarArea'
                ];

                $chart_mode = $types[$this->poll->settings('charts')['order']];
                ?>

                <div class="featured-poll_results">
                    <div class="featured-poll_results__title">
                        Poll results:
                    </div>
                    <div class="featured-poll_results__wrapper">
                        <div class="featured-poll_results_chart">
                            <canvas id="myChart"></canvas>
                            <div id="chart-legend" class="chart_legend"></div>
                            <script>

                                function getTotalVotes(dataset){
                                    var total = 0;
                                    for(var i = 0; i < dataset['data'].length; i++){
                                        total += dataset['data'][i];
                                    }
                                    return total;
                                }
                                <? $values = array_map(function ($item) {
                                    return $item['votes'];
                                }, $chosen);?>
                                jQuery(function () {
                                    var myChart = new Chart(document.getElementById("myChart").getContext('2d'), {
                                        type: '<?=$chart_mode?>',
                                        data: {
                                            <? if($chart_mode == 'line'): ?>
                                            labels: [
                                                <? foreach($by_date as $date => $value): ?>
                                                    new Date("<?=date('c', strtotime($date))?>"),
                                                <? endforeach; ?>
                                            ],
                                            datasets: [
                                                <? foreach($chosen as $i => $item): ?>
                                                {
                                                    label: "<?=$item['content']['label']?>",
                                                    backgroundColor: "<?=$colors[$i % count($chosen)]?>",
                                                    borderColor: "<?=$colors[$i % count($chosen)]?>",
                                                    fill: false,
                                                    data: [
                                                        <? foreach($by_date as $date => $value): ?>
                                                        <?=isset($value[$i]) ? $value[$i] : 0?>,
                                                        <? endforeach; ?>
                                                    ],
                                                },
                                                <? endforeach; ?>
                                            ]
                                            <? else: ?>
                                            labels: [<?php echo implode(',', array_map(function ($item) {
                                                return '"' . $item['content']['label'] . '"';
                                            }, $chosen));?>],
                                            datasets: [{
                                                label: "Votes",
                                                data: [<? echo implode(',', $values);?>],
                                                backgroundColor: [
                                                    <?php for ($i = 0; $i < count($chosen); $i++) echo "'" . $colors[$i % count($chosen)] . "',"; ?>
                                                ],
                                                borderColor: [
                                                    <?php for ($i = 0; $i < count($chosen); $i++) echo "'" . $colors[$i % count($chosen)] . "',"; ?>
                                                ],
                                                borderWidth: 1
                                            }]
                                            <? endif; ?>
                                        },
                                        options: {
                                            layout: {
                                                padding: {
                                                                left: 0,
                                                                right: 0,
                                                                top: 8,
                                                                bottom: 0
                                                            }
                                            },
                                            <? if($chart_mode != 'line'): ?>
                                            tooltips: {
                                              callbacks: {
                                                title: function(tooltipItem, data) {
                                                  return '';
                                                },
                                                label: function(tooltipItem, data) {
                                                    var dataset = data['datasets'][0];
                                                    var total = getTotalVotes(dataset);
                                                  var percent = Math.round((dataset['data'][tooltipItem['index']] / total) * 100);
                                                  return dataset['data'][tooltipItem['index']] + ' of ' + total + ' (' + percent + '%)';
                                                }
                                              }
                                            },
                                            <? else: ?>
                                            tooltips: {
                                              callbacks: {
                                                label: function(tooltipItem, data) {
                                                    var dataset = data['datasets'][tooltipItem['datasetIndex']];
                                                    var total = 0;
                                                    for(var i = 0; i < data['datasets'].length; i++){
                                                        total += data['datasets'][i]['data'][tooltipItem['index']];
                                                    }
                                                  
                                                  var percent = Math.round((dataset['data'][tooltipItem['index']] / total) * 100);
                                                  return dataset['data'][tooltipItem['index']] + ' of ' + total + ' (' + percent + '%)';
                                                }
                                              }
                                            },
                                            <? endif; ?>
                                            legend:{
                                                display: false
                                            },
                                            legendCallback: function(chart) {
                                                <? if($chart_mode == 'line'): ?>
                                                    var text = [];
                                                    text.push('<ul>');
                                                    for (var i=0; i<chart.data.datasets.length; i++) {
                                                      text.push('<li>');
                                                      text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '"></span>' + chart.data.datasets[i].label);
                                                      text.push('</li>');
                                                    }
                                                    text.push('</ul>');
                                                <? else: ?>
                                                    var text = [];
                                                    text.push('<ul>');
                                                    var dataset = chart.data.datasets[0];
                                                    var total = getTotalVotes(dataset);
                                                    for (var i=0; i<dataset.borderColor.length; i++) {
                                                      text.push('<li>');
                                                      text.push('<span style="background-color:' + dataset.borderColor[i] + '"></span><b>' + 
                                                        + dataset['data'][i] + ''
                                                        + ' of ' + total
                                                        + ' (' + Math.round((dataset['data'][i] / total) * 100) + '%)</b>. ' + chart.data.labels[i]);
                                                      text.push('</li>');
                                                    }
                                                    text.push('</ul>');
                                                <? endif; ?>
                                                return text.join("");
                                              },
                                        <? if($chart_mode == '1polarArea'): ?>
                                            scale: {
                                                ticks: {
                                                    beginAtZero: true,
                                                    min: 0,
                                                    callback: function(value, index, values) {
                                                        if (Math.floor(value) === value) {
                                                            return value;
                                                        }
                                                        return '';
                                                    }
                                                }
                                            }
                                        <? endif; ?>
                                        <? if($chart_mode == 'line' || $chart_mode == 'bar'): ?>
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        min:0,
                                                        beginAtZero: true,
                                                        callback: function(value, index, values) {
                                                            if (Math.floor(value) === value) {
                                                                return value;
                                                            }
                                                        }
                                                    }
                                                }],
                                                <? if($chart_mode == 'line'): ?>
                                                xAxes: [{
                                                    type: 'time',
                                                    time: {
                                                        unit: 'day',
                                                        format: 'll',
                                                        round: 'day',
                                                        tooltipFormat: 'll',
                                                        displayFormats:{
                                                            hour: 'll',
                                                        }
                                                    }
                                                }],
                                                <? endif; ?>
                                                <? if($chart_mode == 'bar'): ?>
                                                xAxes: [{
                                                    display: false,
                                                }],
                                                <? endif; ?>
                                            }
                                        <? endif; ?>
                                        }
                                    });
                                    document.getElementById('chart-legend').innerHTML = myChart.generateLegend();
                                });
                            </script>
                        </div>

                        <? 
                        $country = $this->poll->settings('country');
                        $id = $this->poll->id();

                        if (isset($country) && isset($country["map"]) && $country["map"] != "disabled") : ?>
                            <div class="featured-poll_results_map">
                                <? if ($country["map"] == 'mapsec'): ?>
                                    <?= $this->poll->mapsec($id); ?>
                                <? endif; ?>

                                <? if ($country["map"] == 'mapthree'): ?>
                                    <?= $this->poll->mapthree($id); ?>
                                <? endif; ?>

                                <? if ($country["map"] == 'mapnet'): ?>
                                    <?= $this->poll->mapnet($id); ?>
                                <? endif; ?>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            <? endif; ?>

            <? if ($this->poll->settings('screens', 'after_vote', 'enabled')): ?>
                <div class="featured-poll__text">
                    <?= $this->poll->settings('screens', 'after_vote', 'content'); ?>
                </div>
            <? endif; ?>
            <? if ($this->poll->request() != null) : ?>
                <? $myQuestions = $this->poll->choices(); ?>
                <? $choosen = $this->poll->request()->choices()[0]; ?>
                <? foreach ($myQuestions as $key => $value) :
                    if ($value['index'] == $choosen) : ?>
                        <? if (!empty($value['content']['message'])
                                || !empty($value['content']['message_url'])): ?>
                            <div class="featured-poll__text based-on-answer-result">
                                <?= ($value['content']['message']) ? $value['content']['message'] : ' ' ?>
                                <? if ($value['content']['message_url']): ?>
                                    <a href="<?= $value['content']['message_url'] ?>">To learn more, click here</a>
                                <? endif; ?>
                            </div>
                        <? endif; ?>
                    <? endif; ?>
                <? endforeach; ?>
            <? endif; ?>

            <? $previous = get_previous_post(true, '', 'poll_category') ?>
            <? $next = get_next_post(true, '', 'poll_category') ?>

            <? if (!empty($next) || !empty($previous)): ?>
                <div class="featured-poll__nav-buttons clearfix">
                    <? if (!empty($previous)): ?>
                        <a href="<?= get_permalink($previous->ID) ?>" class="featured-poll__nav-button prev">
                            Previous poll
                        </a>
                    <? endif; ?>
                    <? if (!empty($next)): ?>
                        <a href="<?= get_permalink($next->ID) ?>" class="featured-poll__nav-button next">
                            Next poll
                        </a>
                    <? endif; ?>
                </div>
            <? endif; ?>
        </div>
    </div>
<script>
    jQuery('.countflip').countflip();
    jQuery('.countmicro').countmicro();
    jQuery('.countstrange').countstrange();
    jQuery('.qfClock').qfclock();
</script>

<? if ($is_poll_page == false): comments_template(); endif; ?>
</div>