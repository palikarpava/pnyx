<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh

?>
<div id="totalpoll-support" class="wrap totalpoll-page">
	<div class="totalpoll-page-container">

		<h1 class="totalpoll-page-title"><i class="fas fa-question"></i> <?php _e( 'Support Center', TP_TD ); ?></h1>

		<div class="links-cards clearfix">
			<a href="http://pnyx.online/faq/" target="_blank" class="link-card">
				<p><?php _e( 'Have a question? Read the FAQs.', TP_TD ); ?></p>
			</a>
			<a href="http://pnyx.online/support/" target="_blank" class="link-card">
				<p><?php _e( 'Open a support ticket.', TP_TD ); ?></p>
			</a>
		</div>

		<br>
		<p><?php _e( 'Please attach the following information when you open a new ticket.', TP_TD ); ?></p>
		<pre><?php echo esc_textarea( $this->get_system_details() ); ?></pre>

		<button onclick="downloadDebug()" target="_blank" class="button button-primary button-large widefat"><?php _e( 'Download', TP_TD ); ?></button>

		<script type="text/javascript">
			function downloadDebug() {
				var link = document.createElement('a');
				link.download = 'debug.txt';
				link.href = 'data:,' + encodeURIComponent(jQuery('pre').html());
				link.click();
			}
		</script>

	</div>
</div>