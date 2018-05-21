<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif;
?>
<div class="settings-wrapper">
	<h2 class="totalpoll-h2"><?php _e( 'Results', TP_TD ); ?></h2>
	<?
	$helpers = Totalpoll::instance( 'helpers' );

	$country = $helpers->parse_args(
		$this->poll->settings( 'country' ),
		isset($this->defaults['country']) ? $this->defaults['country'] : null
 	);
	$charts = $helpers->parse_args(
		$this->poll->settings( 'charts' ),
		isset($this->defaults['charts']) ? $this->defaults['charts'] : null
	);

	$limitations = $helpers->parse_args(
		$this->poll->settings( 'limitations' ),
		$this->defaults['limitations']
	);

	$results = $helpers->parse_args(
		$this->poll->settings( 'results' ),
		$this->defaults['results']
	);

	?>
	<div class="totalpoll-containable">
		<div class="totalpoll-containable-content" data-tp-toggleables>
			<div class="field-wrapper">
				<label for="general-follow-up-question"><?php _e( 'Common Follow Up question', TP_TD ); ?></label>
				<div class="field-row">
					<input
						id="general-follow-up-question"
						class="widefat"
						type="text"
						placeholder="<?php _e('Enter Follow Up question for the user regardless the choice he made here...', TP_TD); ?>"
						name="totalpoll[settings][results][order][follow_up_question]"
						value="<?php echo isset($results['order']['follow_up_question']) ? $results['order']['follow_up_question'] : ''; ?>">
				</div>
			</div>
			<?php do_action( 'totalpoll/actions/admin/editor/settings/results/follow-up-question', $results, $this->poll ); ?>
			<div class="field-wrapper">
				<label>
	                <input type="checkbox" name="totalpoll[settings][results][order][request_email]" <?php checked( empty( $results['order']['request_email'] ), false ); ?>>
	                <?php _e( 'Request e-mail address', TP_TD ); ?>
	            </label>
			</div>
			<?php do_action( 'totalpoll/actions/admin/editor/settings/results/request-email', $results, $this->poll ); ?>
		</div>
	</div>
	<br>
	<div class="totalpoll-tabs-container settings-container" data-tp-tabs>
		<div class="totalpoll-tabs settings-tabs">
			<?php
			$tabs = apply_filters( 'totalpoll/filters/admin/editor/tabs/results',
				array(
					array(
						'slug' => 'charts',
						'name' => __( 'Charts', TP_TD ),
						'icon' => 'fa-chart-pie',
					),
					array(
						'slug' => 'country',
						'name' => __( 'Maps', TP_TD ),
						'icon' => 'fa-map',
					),
					array(
						'slug' => 'countdown',
						'name' => __( 'Countdown', TP_TD ),
						'icon' => 'fa-clock',
					),
					array(
						'slug' => 'follow-up-responses',
						'name' => __( 'Follow Up Responses', TP_TD ),
						'icon' => 'fa-reply',
					),
				),
				$this->poll
			);

			foreach ( $tabs as $tab_index => $tab ):
				?>
				<a href="#" class="<?php echo $tab_index === 0 ? 'active' : ''; ?>" data-tp-tab="<?php echo esc_attr( $tab['slug'] ); ?>"><i class="fas <?php echo esc_attr( $tab['icon'] ); ?>"></i> <?php echo $tab['name']; ?></a>
				<?php
			endforeach;
			?>
		</div>
		<div class="totalpoll-tabs-content settings-tabs-content" data-tp-toggleables>
			<?php
			foreach ( $tabs as $tab ):
				if ( file_exists( TP_PATH . "includes/admin/editor/settings/{$tab['slug']}.php" ) ):
					include "settings/{$tab['slug']}.php";
				else:
					do_action( "totalpoll/actions/admin/editor/tabs/content/settings/{$tab['slug']}", $this->poll );
				endif;
			endforeach;
			?>
		</div>
	</div>
</div>