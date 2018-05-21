<div class="categories_block">
    <div class="categories_block__inner">
        <? foreach ($parameters['terms'] as $term): ?>
            <a href="<?= get_term_link($term) ?>" class="categories_block__item"
               style="background-color:<?= $term->description ?>">
               <? if (get_option('z_taxonomy_image' . $term->term_id)):?>
                	<img class="categories_block__item_image" src="<?= get_option('z_taxonomy_image' . $term->term_id); ?>">
            	<? endif; ?>
                <?= $term->name ?>
            </a>
        <? endforeach; ?>
    </div>
</div>