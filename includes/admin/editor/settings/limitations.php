<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<div class="totalpoll-tab-content settings-tab-content settings-limitations active" data-tp-tab-content="limitations">

	<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/before', $limitations, $this->poll ); //echo '$limitations-' ;var_dump($limitations); ?>
	<div class="settings-item">

		<div class="settings-field">
			<label>
				<input type="checkbox" name="totalpoll[settings][limitations][cookies][enabled]" <?php checked( empty( $limitations['cookies']['enabled'] ), false ); ?>>
				<?php _e( 'Block re-vote by Cookies', TP_TD ); ?>
			</label>

			&nbsp;&mdash;&nbsp;
			<a href="#" data-tp-toggle="limitations-cookies-advanced"><?php _e( 'Advanced', TP_TD ); ?></a>
		</div>

		<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/block-by-cookies', $limitations, $this->poll ); ?>

	</div>

	<div class="settings-item-advanced" data-tp-toggleable="limitations-cookies-advanced">

		<div class="settings-field">
			<label class="settings-field-label" for="totalpoll-settings-limitations-cookies-timeout">
				<?php _e( 'Cookies timeout (minutes)', TP_TD ); ?>
				<span class="feature-details" title="<?php esc_attr_e( "The minimum required time to clear the cookies from the voter's browser.", TP_TD ); ?>">?</span>
			</label>
			<input id="totalpoll-settings-limitations-cookies-timeout" type="number" name="totalpoll[settings][limitations][cookies][timeout]" min="0" step="1" class="settings-field-input widefat" value="<?php echo esc_attr( absint( $limitations['cookies']['timeout'] ) ); ?>">
		</div>

		<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/block-by-cookies-advanced', $limitations, $this->poll ); ?>

	</div>

	<div class="settings-item">

		<div class="settings-field">
			<label>
				<input type="checkbox" name="totalpoll[settings][limitations][ip][enabled]" <?php checked( empty( $limitations['ip']['enabled'] ), false ); ?>>
				<?php _e( 'Block re-vote by IP', TP_TD ); ?>
			</label>

			&nbsp;&mdash;&nbsp;
			<a href="#" data-tp-toggle="limitations-ip-advanced"><?php _e( 'Advanced', TP_TD ); ?></a>
		</div>

		<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/block-by-ip', $limitations, $this->poll ); ?>

	</div>

	<div class="settings-item-advanced" data-tp-toggleable="limitations-ip-advanced">

		<div class="settings-field">
			<label class="settings-field-label" for="totalpoll-settings-limitations-ip-timeout">
				<?php _e( 'IP timeout (minutes)', TP_TD ); ?>
				<span class="feature-details" title="<?php esc_attr_e( 'The minimum required time to clear the IP from the database.', TP_TD ); ?>">?</span>
			</label>
			<input id="totalpoll-settings-limitations-ip-timeout" type="number" name="totalpoll[settings][limitations][ip][timeout]" min="0" step="1" class="settings-field-input widefat" value="<?php echo esc_attr( absint( $limitations['ip']['timeout'] ) ); ?>">
		</div>

		<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/block-by-ip-advanced', $limitations, $this->poll ); ?>

	</div>

	<div class="settings-item">
		<input type="hidden" name="totalpoll[settings][limitations][unique_id]" value="<?php echo esc_attr( $limitations['unique_id'] ); ?>">

		<div class="settings-field">
			<label>
				<input type="checkbox" name="totalpoll[settings][limitations][unique_id]" value="<?php echo esc_attr( current_time( 'timestamp' ) ); ?>">
				<?php _e( 'Regenerate poll unique ID', TP_TD ); ?>
				&nbsp;&mdash;&nbsp;
				<?php _e( 'Current:', TP_TD ); ?> <?php echo $limitations['unique_id']; ?>
				<span class="feature-details" title="<?php esc_attr_e( 'Useful when you want to reset voting.', TP_TD ); ?>">?</span>
			</label>
		</div>

		<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/regenerate-unique-id', $limitations, $this->poll ); ?>

	</div>

	<?php do_action( 'totalpoll/actions/admin/editor/settings/limitations/after', $limitations, $this->poll ); ?>

</div>