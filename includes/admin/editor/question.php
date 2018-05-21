<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<div class="question-wrapper">
	<h2 class="totalpoll-h2"><?php _e( 'Question', TP_TD ); ?></h2>
	<?php wp_editor( $this->poll->question(), 'wpeditor', array(
		'textarea_rows' => 3,
		'editor_class'  => 'widefat',
		'textarea_name' => 'totalpoll[question]',
		'quicktags' => false) ); ?>
	<?php $vq=$this->poll->video_question(); ?>
	<div class="totalpoll-containable">
		<div class="totalpoll-containable-content">
			<div class="field-wrapper">
				<label for="videoquestion-url"><?php _e( 'Youtube video URL', TP_TD ); ?></label>

				<div class="field-row">
						<input
							id="videoquestion-url"
							class="widefat text-field"
							type="text"
							placeholder="<?php _e( 'Enter your youtube video URL', TP_TD ); ?>"
							name="totalpoll[videoquestion][url]"
							value="<?php echo isset( $vq['url'] ) ? $vq['url'] : ''; ?>"
							data-tp-containable-field="videoquestion"
							data-tp-extractor="#videoquestion-thumbnail"
							>
				</div>
			</div>
			<div class="field-wrapper">
				<div class="field-row">
					<div class="field-column">
						<label for="videoquestion-thumbnail"><?php _e( 'Video thumbnail URL', TP_TD ); ?></label>
						<input
							id="videoquestion-thumbnail"
							class="widefat text-field"
							type="text"
							placeholder="<?php _e( 'Enter your video thumbnail URL', TP_TD ); ?>"
							name="totalpoll[videoquestion][thumbnail]"
							value="<?php echo isset($vq['thumbnail'] ) ? $vq['thumbnail'] : ''; ?>"
							data-tp-containable-field="videoquestion"
							>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>