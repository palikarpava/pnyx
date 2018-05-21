<div class="field-wrapper field-splitter">
	<label for="<?php echo $choice_id; ?>-message"><?php _e( 'Value Proposition message', TP_TD ); ?></label>
	<input
		id="<?php echo $choice_id; ?>-message"
		class="widefat text-field"
		type="text"
		placeholder="<?php _e('Enter your Value Proposition for the user here...', TP_TD); ?>"
		name="totalpoll[choices][<?php echo $choice_index; ?>][content][message]"
		data-rename="totalpoll[choices][{{new-index}}][content][message]"
		value="<?php echo isset($choice['content']['message']) ? $choice['content']['message'] : ''; ?>"
		data-tp-containable-field="<?php echo $choice_id; ?>"
		data-tp-containable-preview-field>
</div>
<div class="field-wrapper">
	<label for="<?php echo $choice_id; ?>-url"><?php _e( 'URL link to your Value Proposition', TP_TD ); ?></label>
	<input
		id="<?php echo $choice_id; ?>-url"
		class="widefat message-url-field"
		type="text"
		placeholder="<?php _e('Enter URL to your Value Proposition here...', TP_TD); ?>"
		name="totalpoll[choices][<?php echo $choice_index; ?>][content][message_url]"
		data-rename="totalpoll[choices][{{new-index}}][content][message_url]"
		value="<?php echo isset($choice['content']['message']) ? $choice['content']['message_url'] : ''; ?>"
		data-tp-containable-field="<?php echo $choice_id; ?>"
		data-tp-containable-preview-field>
</div>