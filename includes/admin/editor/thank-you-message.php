<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif;
?>
<div class="question-wrapper">
	<h2 class="totalpoll-h2"><?php _e( 'Thank You Message', TP_TD ); ?></h2>
	<?
	$helpers = Totalpoll::instance( 'helpers' );

	$screens = $helpers->parse_args(
		$this->poll->settings( 'screens' ),
		$this->defaults['screens']
	);
	?>
	<div class="totalpoll-containable">
		<div class="totalpoll-containable-content" data-tp-toggleables>
			<div class="field-wrapper">
				<label>
					<input type="checkbox" name="totalpoll[settings][screens][after_vote][enabled]" data-tp-toggle="screens-after-vote-advanced" <?php checked( empty( $screens['after_vote']['enabled'] ), false ); ?>>
					<?php _e( 'Display "Thank You Message" after voting', TP_TD ); ?>
				</label>

				<div class="<?php echo empty( $screens['after_vote']['enabled'] ) ? '' : 'active'; ?>" data-tp-toggleable="screens-after-vote-advanced">
					<?php wp_editor( empty( $screens['after_vote']['content'] ) ? 'Thank You for your opinion!' : $screens['after_vote']['content'], 
						'afterVoteScreen', array( 'textarea_name' => 'totalpoll[settings][screens][after_vote][content]', 'textarea_rows' => 3 ) ); ?>

					<?php do_action( 'totalpoll/actions/admin/editor/settings/screens/after-voting-advanced', $screens, $this->poll ); ?>
				</div>
			</div>
		</div>
	</div>
</div>