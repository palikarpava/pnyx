<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<div class="settings-wrapper">
	<h2 class="totalpoll-h2"><?php _e( 'Settings', TP_TD ); ?></h2>

	<?php

	$helpers = Totalpoll::instance( 'helpers' );

	$choices = $helpers->parse_args(
		$this->poll->settings( 'choices' ),
		$this->defaults['choices']
	);

	$fields = $this->poll->settings( 'fields' );

	$logs = $helpers->parse_args(
		$this->poll->settings( 'logs' ),
		$this->defaults['logs']
	);
	?>

	<div class="totalpoll-tabs-container settings-container" data-tp-tabs>
		<div class="totalpoll-tabs settings-tabs">
			<?php
			$tabs = apply_filters( 'totalpoll/filters/admin/editor/tabs/settings',
				array(
					array(
						'slug' => 'limitations',
						'name' => __( 'Limitations', TP_TD ),
						'icon' => 'dashicons dashicons-admin-network',
					),
					array(
						'slug' => 'choices',
						'name' => __( 'Choices', TP_TD ),
						'icon' => 'dashicons dashicons-menu',
					),
					array(
						'slug' => 'design',
						'name' => __( 'Design', TP_TD ),
						'icon' => 'dashicons dashicons-admin-appearance',
					),
					array(
						'slug' => 'logs',
						'name' => __( 'Logs', TP_TD ),
						'icon' => 'dashicons dashicons-tag',
					)
				),
				$this->poll
			);

			foreach ( $tabs as $tab_index => $tab ):
				?>
				<a href="#" class="<?php echo $tab_index === 0 ? 'active' : ''; ?>" data-tp-tab="<?php echo esc_attr( $tab['slug'] ); ?>"><span class="<?php echo esc_attr( $tab['icon'] ); ?>"></span><?php echo $tab['name']; ?></a>
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