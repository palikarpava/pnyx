<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif;
?>
<div class="question-wrapper">
	<h2 class="totalpoll-h2"><?php _e( 'Visual transition', TP_TD ); ?></h2>
	<div class="totalpoll-containable">
		<div class="totalpoll-containable-content">
			<div class="field-wrapper">
				<label class="settings-field-label" for="totalpoll-settings-design-transition"><?php _e( 'Transition after vote submit', TP_TD ); ?></label>
				<div class="field-row">
					<select id="totalpoll-settings-design-transition" name="totalpoll[settings][design][transition][type]" class="settings-field-select widefat">
						<option value="none" <?php selected( $design['transition']['type'], 'none' ); ?>>None</option>
						<option value="fade" <?php selected( $design['transition']['type'], 'fade' ); ?>>Fade</option>
						<option value="slide" <?php selected( $design['transition']['type'], 'slide' ); ?>>Slide</option>
					</select>
				</div>
			</div>
			<?php do_action( 'totalpoll/actions/admin/editor/settings/design/transition', $design, $this->poll ); ?>
			<div class="field-wrapper">
				<label>
					<input type="checkbox" name="totalpoll[settings][design][scroll][enabled]" value="1" <?php checked( empty( $design['scroll']['enabled'] ), false ); ?>>
					<?php _e( 'Scroll up after vote submit', TP_TD ); ?>
				</label>
			</div>
			<?php do_action( 'totalpoll/actions/admin/editor/settings/design/scroll', $design, $this->poll ); ?>
		</div>
	</div>
</div>