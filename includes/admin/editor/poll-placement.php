<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif;
?>
<div class="question-wrapper">
	<h2 class="totalpoll-h2"><?php _e( 'Poll Placement', TP_TD ); ?></h2>
	<?
	$helpers = Totalpoll::instance( 'helpers' );

	$limitations = $helpers->parse_args(
		$this->poll->settings( 'limitations' ),
		$this->defaults['limitations']
	);

	$terms = get_the_terms( $this->poll->id(), 'poll_category' );
	$thiscat = '';
	if ( class_exists('WPSEO_Primary_Term') )
	{
		// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		$wpseo_primary_term = new WPSEO_Primary_Term( 'poll_category', $this->poll->id() );
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		$term = get_term( $wpseo_primary_term );
		if (is_wp_error($term)) {
			// Default to first category (not Yoast) if an error is returned
			if (isset($terms) && count($terms)>0 && is_array($terms)){
				$thiscat = $terms[0]->name;
				$category_link = get_category_link( $terms[0]->term_id );
			}
		} else {
			// Yoast Primary category
			$thiscat = $term->name;
			$category_link = get_category_link( $term->term_id );
		}
	}else{
		if (isset($terms) && count($terms)>0){
			$term = array_shift( $terms );
			$thiscat= $term->name;
		}
	}
	?>
	<div class="totalpoll-containable">
		<div class="totalpoll-containable-content">
			<div class="field-wrapper">
				<label>
					<input type="checkbox" name="totalpoll[settings][limitations][allcategory][enabled]" <?php checked(empty($limitations['allcategory']['enabled']), false); ?>>
					<?php _e( 'Featured poll', TP_TD ); ?>
				</label>
			</div>
			<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/allcategory', $limitations, $this->poll ); ?>
			<? if ($thiscat): ?>
				<div class="field-wrapper">
					<label>
						<input type="checkbox" name="totalpoll[settings][limitations][thiscategory][enabled]" <?php checked( empty( $limitations['thiscategory']['enabled'] ), false ); ?>>
						<?php _e( 'Featured only in category - ', TP_TD );
						echo $thiscat;
						?>
					</label>
				</div>
			<? endif; ?>
			<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/thiscategory', $limitations, $this->poll ); ?>
		</div>
	</div>
</div>