<?php
if (defined('ABSPATH') === false) :
    exit;
endif; // Shhh
?>

<? global $post; ?>
<? if (!$post) $post = get_post($this->poll->id()); ?>
<? $taxonomies = get_the_terms($post, 'poll_category'); ?>
<? $taxonomy = empty($taxonomies) ? null : array_pop($taxonomies); ?>

<? $pollObj = TotalPoll::poll($post->ID); ?>
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
                <? if ($taxonomy): ?>
                    <h3 class="featured-poll__title">
                        <?= $taxonomy->name ?>
                    </h3>
                <? endif; ?>

                <p class="featured-poll__subtitle">
                    <?= $pollObj->question(); ?>
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
        <? if ($this->poll->settings('design', 'template', 'display_image') === 'on'): ?>
            <div class="featured-poll__image">
                <? if ($pollObj->is_video_question()): ?>
                    <div class="js-video-container">
                        <div class="video_thumbnail">
                            <img src="<?= $pollObj->poll_thumbnail(); ?>">
                        </div>
                        <div class="video js-video-frame-wrapper" style="display: none">
                            <?= wp_oembed_get($pollObj->video_question()["url"], array('width' => 900)) ?>
                        </div>
                    </div>
                <? else: ?>
                    <img src="<?= $pollObj->poll_thumbnail(); ?>" alt="">
                <? endif; ?>
            </div>
        <? endif; ?>
        <div class="featured-poll__description">
            <?php include 'partials/shared/errors.php'; ?>
            <?php include 'partials/choices.php'; ?>
            <?php include 'partials/shared/fields.php'; ?>

            <div class="totalpoll-buttons">
                <?php echo implode('', $this->buttons()); ?>
            </div>
        </div>
    </div>
</div>
