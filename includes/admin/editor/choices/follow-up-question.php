<div class="field-wrapper field-splitter">
	<label for="<?php echo $choice_id; ?>-follow-up-question"><?php _e( 'Follow Up question', TP_TD ); ?></label>
	<input
		id="<?php echo $choice_id; ?>-follow-up-question"
		class="widefat text-field"
		type="text"
		placeholder="<?php _e('Enter Follow Up question for the user here...', TP_TD); ?>"
		name="totalpoll[choices][<?php echo $choice_index; ?>][content][follow-up-question]"
		data-rename="totalpoll[choices][{{new-index}}][content][follow-up-question]"
		value="<?php echo isset($choice['content']['follow-up-question']) ? $choice['content']['follow-up-question'] : ''; ?>"
		data-tp-containable-field="<?php echo $choice_id; ?>"
		data-tp-containable-preview-field>
</div>