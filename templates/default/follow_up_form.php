<?php
if (defined('ABSPATH') === false) :
    exit;
endif; // Shhh
?>

<? $poll = get_post($this->poll->id()); ?>

<? $taxonomies = get_the_terms($poll, 'poll_category'); ?>
<? $taxonomy = array_pop($taxonomies); ?>
<? $imageUrl = get_option('z_taxonomy_image' . $taxonomy->term_id); ?>
<? $followUpQuestion = $this->poll->follow_up(); ?>

<?

$form_data = array();
if ($this->poll->request()){
    $form_data = $this->poll->request()->follow_up;
}
?>

<? foreach ( $followUpQuestion->errors() as $error ): ?>
    <div data-tp-errors class="totalpoll-error-message">
        <p><?php echo $error; ?></p>
    </div>
<?php endforeach; ?>

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
                    <?= $this->poll->question() ?>
                </p>
            </div>
        </div>
        <div class="featured-poll__footer clearfix">
            <time class="featured-poll__date">
                <?= date('M j, Y', strtotime($poll->post_date)) ?>
            </time>

            <? if (function_exists('sharify_display_button_buttons')): ?>
                <?= sharify_display_button_buttons(); ?>
            <? endif; ?>
        </div>
        <div class="featured-poll__form js-email-form">
            <div class="featured-poll__form_title js-email-title">
                Follow Up Question :
            </div>
            <? if (!$followUpQuestion->is_follow_up_question_addressed()): ?>
                <div class="featured-poll__form_subtitle">
                    Please, answer the following question before viewing the results:
                </div>
                <div class="form-row">
                    <label for="response">
                        <?=$followUpQuestion->get_follow_up_question()?> <span class="required">*</span>
                    </label>
                    <input type="text" placeholder="Your answer" name="totalpoll[follow_up][answer]" value="<?=isset($form_data["answer"]) ? $form_data["answer"] : ''?>">
                </div>
            <? elseif (!$followUpQuestion->is_email_provided()): ?>
                <div class="featured-poll__form_subtitle">
                    Please, submit your email before viewing the results:
                </div>
            <? endif; ?>
            <? if (!$followUpQuestion->is_email_provided()): ?>
                <div class="form-row">
                    <label for="email">
                        Your E-mail <span class="required">*</span>
                    </label>
                    <input type="text" name="totalpoll[follow_up][email]"  value="<?=isset($form_data["email"]) ? $form_data["email"] : ''?>">
                </div>
                <div class="form-row checkbox-row">
                    <label for="agreement">
                        <input id="agreement" type="checkbox" name="totalpoll[follow_up][agreement]" <?=isset($form_data["agreement"]) ? 'checked' : ''?> value="on">
                        I approve receiving emails. We do not share your information with anyone else.
                    </label>
                </div>
        <? endif; ?>
            <div class="form-row totalpoll-buttons">
                <?php echo implode('', $this->buttons()); ?>
            </div>
    </div>
</div>
