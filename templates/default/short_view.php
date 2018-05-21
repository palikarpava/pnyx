<div class="half-poll_block">
    <div class="half-poll_block__inner">
        <? foreach ($parameters['polls'] as $poll): ?>
            <!--rewrite global post here, because sharify lib is written by retard and takes only global parameters for share buttons-->
            <? global $post;
            $post = $poll;
            $pollObj = TotalPoll::poll($poll->ID); ?>

            <div class="half-poll__item">
                <? $taxonomies = get_the_terms($poll->ID, 'poll_category'); ?>
                <? if (!empty($taxonomies)) $taxonomy = array_pop($taxonomies); ?>

                <div class="half-poll__item_image">
                    <a href="<?= get_post_permalink($poll->ID) ?>">
                        <? if ($pollObj->is_video_question()): ?>
                            <div class="video_thumbnail">
                                <img src="<?=$pollObj->poll_thumbnail() ?>">
                            </div>
                        <? else: ?>
                            <img src="<?= $pollObj->poll_thumbnail(); ?>" alt="">
                        <? endif; ?>
                    </a>
                </div>

                <? $imageUrl = $taxonomy ? get_option('z_taxonomy_image' . $taxonomy->term_id) : null; ?>
                <div class="half-poll__header">
                    <? if ($taxonomy): ?>
                    <div class="half-poll__category-image">
                        <a href="<?= get_term_link($taxonomy) ?>" class="half-poll__category-link">
                            <img src="<?= $imageUrl ?>">
                        </a>
                    </div>
                    <? endif; ?>

                    <div class="half-poll__col">
                        <h4 class="half-poll__title">
                            <a href="<?= get_post_permalink($poll->ID) ?>">
                                <?= get_post_meta(($poll->ID), 'question', true); ?>
                            </a>
                        </h4>
                    </div>
                </div>

                <div class="half-poll__footer clearfix">
                    <time class="half-poll__date">
                        <?= date('M j, Y', strtotime($poll->post_date)) ?>
                    </time>

                    <? if (function_exists('sharify_display_button_buttons')): ?>
                        <?= sharify_display_button_buttons(); ?>
                    <? endif; ?>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>