<?php
if (defined('ABSPATH') === false) :
    exit;
endif; // Shhh

$choicesType = $this->poll->choices()[0]['content']['type'];

?>

    <div data-tp-choices class="totalpoll-choices totalpoll-choices-<?= $choicesType ?>">
        <?php

        if ($this->poll->choices()[0]['content']['type'] === 'image') { ?>

            <?php
            $per_row = 2;

            foreach ($this->poll->choices() as $choice_index => $choice):
                ?>
                <label data-tp-choice
                       class="totalpoll-choice totalpoll-choice-<?php echo $choice['content']['type']; ?> <?php echo $choice['checked'] ? 'checked' : ''; ?> <?php echo ($choice_index + 1) % $per_row === 0 ? ' last-in-row' : ''; ?>"
                       itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer">
                    <div class="totalpoll-choice-container">
                        <div class="totalpoll-choice-content">
                            <?php
                            include 'shared/image_wo_link.php';
                            ?>

                            <?php
                            if ($choice['content']['type'] !== 'html' && $choice['content']['type'] !== 'other'):
                                include 'shared/label.php';
                            endif;
                            ?>
                            <?php
                            if ($this->current === 'vote' && $choice['content']['type'] !== 'other'):
                                include 'vote/checkbox.php';
                            endif;
                            ?>
                        </div>
                    </div>
                </label>
                <?php
            endforeach;
        } else {

            $per_row = absint($this->option('general', 'other', 'per-row'));
            $per_row = $per_row < 1 ? 1 : $per_row;


            foreach ($this->poll->choices() as $choice_index => $choice):
                ?>
                <?php
                if ($choice_index !== 0 && $choice_index % $per_row === 0):
                    ?>
                    <div class="totalpoll-choice-separator"></div>
                    <?php
                endif;
                ?>
                <label data-tp-choice
                       class="totalpoll-choice totalpoll-choice-<?php echo $choice['content']['type']; ?> <?php echo $choice['checked'] ? 'checked' : ''; ?> <?php echo ($choice_index + 1) % $per_row === 0 ? ' last-in-row' : ''; ?>"
                       itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer">
                    <?php
                    if ($choice['content']['type'] === 'video' || $choice['content']['type'] === 'audio'):
                        include 'shared/embed.php';
                    elseif ($choice['content']['type'] === 'image'):
                        include 'shared/image.php';
                    endif;
                    ?>

                    <div class="totalpoll-choice-container">
                        <?php
                        if ($this->current === 'vote' && $choice['content']['type'] !== 'other'):
                            include 'vote/checkbox.php';
                        endif;
                        ?>
                        <div class="totalpoll-choice-content">
                            <?php
                            if ($choice['content']['type'] !== 'html' && $choice['content']['type'] !== 'other'):
                                include 'shared/label.php';
                            elseif ($choice['content']['type'] === 'html'):
                                echo do_shortcode($choice['content']['html']);
                            elseif ($this->current === 'vote' && $choice['content']['type'] === 'other'):
                                include 'vote/other.php';
                            endif;
                            if ($this->current === 'results'):
                                include 'results/votes.php';
                            endif;
                            ?>
                        </div>
                    </div>
                </label>
                <?php
            endforeach;
        }
        ?>
    </div>
<?php

?>