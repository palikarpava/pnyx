<!--$parameters variable coming through getTemplatePart method-->
<? $featuredPoll = get_post($parameters['featured_poll_id']); ?>

<!--rewrite global post here, because sharify lib is written by retard and takes only global parameters for share buttons-->
<? global $post; 
$post = $featuredPoll;
$poll = TotalPoll::poll($featuredPoll->ID); ?>
<div class="featured-poll_block">
    <div class="featured-poll_block__inner">
        <div class="featured-poll__image">
            <a href="<?= get_post_permalink($featuredPoll->ID) ?>">
                <? if ($poll->is_video_question()): ?>
                    <div class="video_thumbnail">
                        <img src="<?=$poll->poll_thumbnail() ?>">
                    </div>
                <? else: ?>
                    <img src="<?= $poll->poll_thumbnail(); ?>" alt="">
                <? endif; ?>
            </a>
        </div>
        <div class="featured-poll__description">
            <? $taxonomies = get_the_terms($featuredPoll->ID, 'poll_category'); ?>
            <? $taxonomy = empty($taxonomies) ? null : array_pop($taxonomies); ?>
            <? $imageUrl = $taxonomy ? get_option('z_taxonomy_image' . $taxonomy->term_id) : null; ?>

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
                            <?= $taxonomy ? $taxonomy->name : null ?>
                        </h3>
                    <? endif; ?>

                    <p class="featured-poll__subtitle">
                        <a href="<?= get_post_permalink($featuredPoll->ID) ?>">
                            <?= get_post_meta(($featuredPoll->ID), 'question', true); ?>
                        </a>
                    </p>
                </div>
            </div>

            <div class="featured-poll__footer clearfix">
                <time class="featured-poll__date">
                    <?= date('M j, Y', strtotime($featuredPoll->post_date)) ?>
                </time>

                <? if (function_exists('sharify_display_button_buttons')): ?>
                    <?= sharify_display_button_buttons(); ?>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>
