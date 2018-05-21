<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh

	$helpers = Totalpoll::instance( 'helpers' );

	$design           = $helpers->parse_args( $this->poll->settings( 'design' ), $this->defaults['design'] );
	$design['preset'] = $helpers->parse_args(
		$design['preset'],
		get_option( '_tp_options_template_defaults_' . $this->poll->settings( 'design', 'template', 'name' ), array() )
	);

?>

<div class="containables-container" data-tp-container data-tp-choices>
	<h2 class="totalpoll-h2"><?php _e( 'Choices', TP_TD ); ?></h2>
	<?php
		if ($this->poll->settings('design', 'template', 'display_image') === 'on') {
		    $display_image_checked = true;
		} elseif (!($this->poll->settings('design', 'template', 'display_image')) && isset($design['template']['display_image']) && $design['template']['display_image'] == true) {
		    $display_image_checked = true;
		} else {
		    $display_image_checked = false;
		}

	?>
	<div class="totalpoll-containable">
		<div class="totalpoll-containable-content" data-tp-toggleables>
			<div class="field-wrapper">
				<label>
	                <input type="checkbox" name="totalpoll[settings][design][template][display_image]"  <?= $display_image_checked ? 'checked' : '' ?>>
	                <?php _e( 'Display featured image along with the choices', TP_TD ); ?>
	            </label>
			</div>
			<?php do_action( 'totalpoll/actions/admin/editor/settings/design/display-featured-image', $design, $this->poll ); ?>
		</div>
	</div>

	<?php
	$from_wpml     = ! empty( $GLOBALS['sitepress'] ) && $GLOBALS['sitepress']->get_element_trid( $this->poll->id(), 'post_poll' );
	$from_polylang = ! empty( $_REQUEST['from_post'] ) || ( ! empty( $GLOBALS['polylang'] ) && count( pll_get_post_translations( $this->poll->id() ) ) > 1 );

	if ( $from_wpml || $from_polylang ): ?>
		<p class="update-nag"><?php _e( 'TotalPoll will synchronize votes between translations automatically. Therefore, choices must be in the exact order across all translations.', TP_TD ); ?></p>
	<?php endif; ?>
	<ul class="containables-types clearfix">
		<li>
			<button class="button" type="button" data-tp-containables-insert value="choices-text"><i class="fas fa-fw fa-pencil-alt"></i> <?php _e( 'Text', TP_TD ); ?></button>
		</li>
		<li>
			<button class="button" type="button" data-tp-containables-insert value="choices-image"><i class="fas fa-fw fa-image"></i> <?php _e( 'Image', TP_TD ); ?></button>
		</li>
		<?php do_action( 'totalpoll/actions/admin/editor/choices/types', $this->poll ); ?>
	</ul>
	<div class="totalpoll-hide" data-tp-bulk-container>
		<textarea data-tp-insert-bulk-choices rows="10" class="widefat" placeholder="<?php esc_attr_e( "One choice per line.\nRed\nGreen\nBlue", TP_TD ); ?>"></textarea>
		<button data-tp-insert-bulk-import type="button" class="button button-large button-primary widefat"><?php _e( 'Import' ); ?></button>
	</div>

	<ul class="containables" data-tp-containables data-tp-sortable data-toggle-on-insert="true">
		<?php
		foreach ( $this->poll->choices( false, false ) as $choice_index => $choice ):
			$choice_id      = str_replace( '.', '', microtime( true ) );
			$choice_visible = isset( $choice['content']['visible'] ) ? (bool) $choice['content']['visible'] : false;
			if ( file_exists( TP_PATH . "includes/admin/editor/choices/{$choice['content']['type']}.php" ) ):
				include "choices/{$choice['content']['type']}.php";
			else:
				do_action( "totalpoll/actions/admin/editor/choices/item/{$choice['content']['type']}", $choice_index, $choice_id, $choice_visible, $choice, $this->poll );
			endif;
		endforeach;
		?>
		<?php do_action( 'totalpoll/actions/admin/editor/choices/items', $this->poll ); ?>
	</ul>

</div>