<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<div class="totalpoll-tab-content settings-tab-content settings-countdown" data-tp-tab-content="countdown">
	<div class="settings-item">

		<div class="settings-field">
			<label>
				<input type="checkbox" name="totalpoll[settings][limitations][date][enabled]" data-tp-toggle="limitations-date-advanced" <?php checked( empty( $limitations['date']['enabled'] ), false ); ?>>
				<?php _e( 'Limit by date', TP_TD ); ?>
			</label>
		</div>

		<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/limited-by-date', $limitations, $this->poll ); ?>

	</div>

	<div class="settings-item-advanced <?php echo empty( $limitations['date']['enabled'] ) ? '' : 'active'; ?>" data-tp-toggleable="limitations-date-advanced">
		<div class="settings-field">
			<label class="settings-field-label">
				<?php _e( 'End date', TP_TD ); ?>
				<span class="totalpoll-feature-details" title="<?php esc_attr_e( 'The date users won\'t be able to vote.', TP_TD ); ?>">?</span>
			</label>
			<input type="text" data-tp-field-date name="totalpoll[settings][limitations][date][end]" min="0" step="1" class="settings-field-input widefat enddatein" value="<?php echo empty( $limitations['date']['end'] ) ? '' : esc_attr( date( 'm/d/Y H:i', (int) $limitations['date']['end'] ) ); ?>">
		</div>

		<div class="settings-item">
			<div class="settings-field">
				<label for="countdown_countflip">
					<input type="radio" name="totalpoll[settings][limitations][counttype]" value="countflip" id="countdown_countflip"
						   <?php checked($limitations['counttype'], 'countflip' ); ?>>
					<div class="preview-image">
						<img src="<?=TP_URL . 'assets/images/countdown/flip.png'?>" width="300px">
					</div>
				</label>
			</div>
		</div>
		<div class="settings-item">
			<div class="settings-field">
				<label for="countdown_countmicro">
					<input type="radio" name="totalpoll[settings][limitations][counttype]" value="countmicro" id="countdown_countmicro"
						   <?php checked($limitations['counttype'], 'countmicro' ); ?>>
					<div class="preview-image">
						<img src="<?=TP_URL . 'assets/images/countdown/micro.png'?>" width="300px">
					</div>
				</label>
			</div>
		</div>
		<div class="settings-item">
			<div class="settings-field">
				<label for="countdown_countstrange">
					<input type="radio" name="totalpoll[settings][limitations][counttype]" value="countstrange" id="countdown_countstrange"
						   <?php checked($limitations['counttype'], 'countstrange' ); ?>>
					<div class="preview-image">
						<img src="<?=TP_URL . 'assets/images/countdown/strange.png'?>" width="300px">
					</div>
				</label>
			</div>
		</div>
		<div class="settings-item">
			<div class="settings-field">
				<label for="countdown_countblock">
					<input type="radio" name="totalpoll[settings][limitations][counttype]" value="countblock" id="countdown_countblock"
						   <?php checked($limitations['counttype'], 'countblock' ); ?>>
					<div class="preview-image">
						<img src="<?=TP_URL . 'assets/images/countdown/qfclock.png'?>" width="300px">
					</div>
				</label>
			</div>
		</div>
		
		<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/limited-by-date-advanced', $limitations, $this->poll ); ?>

	</div>
	<?php do_action( 'totalpoll/actions/admin/editor/settings/charts/order-charts', $charts, $this->poll ); ?>

</div>