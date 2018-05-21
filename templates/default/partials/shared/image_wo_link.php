<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
$supports_full = $choice['content']['image']['url'] != $choice['content']['thumbnail']['url'] ? ' totalpoll-supports-full' : '';
?>
<div class="totalpoll-choice-image<?php echo $supports_full; ?>" itemscope itemtype="http://schema.org/ImageObject">
		<img src="<?php echo esc_attr( empty( $choice['content']['thumbnail']['url'] ) ? $choice['content']['image']['url'] : $choice['content']['thumbnail']['url'] ); ?>" itemprop="contentUrl">
</div>