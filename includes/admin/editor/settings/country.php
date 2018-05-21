<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<div class="totalpoll-tab-content settings-tab-content settings-country" data-tp-tab-content="country">

	<?php do_action( 'totalpoll/actions/admin/editor/settings/country/order-country', $country, $this->poll ); ?>
		<div class="settings-item">
			<div class="settings-field">
				<label>
					<input type="radio" name="totalpoll[settings][country][map]" value="disabled"
						   <?php checked($country["map"], "disabled"); ?>>
					<?php _e('No map enabled', TP_TD); ?>
				</label>
			</div>
		</div>
		<div class="settings-item">
			<div class="settings-field">
				<label for="country_mapsec">
					<input type="radio" name="totalpoll[settings][country][map]" value="mapsec"
						   <?php checked($country["map"], "mapsec"); ?> id="country_mapsec">
					<div class="preview-image">
						<img src="<?=TP_URL . 'assets/images/maps/mapsec.png'?>" width="300px">
					</div>
				</label>
			</div>
		</div>
		<div class="settings-item">
			<div class="settings-field">
				<label for="country_mapthree">
					<input type="radio" name="totalpoll[settings][country][map]" value="mapthree"
						   <?php checked($country["map"], "mapthree"); ?> id="country_mapthree">
					<div class="preview-image">
						<img src="<?=TP_URL . 'assets/images/maps/mapthree.png'?>" width="300px">
					</div>
				</label>
			</div>
		</div>
		<div class="settings-item">
			<div class="settings-field">
				<label for="country_mapnet">
					<input type="radio" name="totalpoll[settings][country][map]" value="mapnet"
						   <?php checked($country["map"], "mapnet"); ?> id="country_mapnet">
					<div class="preview-image">
						<img src="<?=TP_URL . 'assets/images/maps/mapnet.png'?>" width="300px">
					</div>
				</label>
			</div>
		</div>
		<!--
		<div class="settings-item">
			<div class="settings-field">
				<label>
					<input type="radio" name="totalpoll[settings][country][map]" value="geochart"
						   <?php checked($country["map"], "geochart"); ?>>
					<?php _e('Show this map', TP_TD); ?>
				</label>
				<img src="<?=TP_URL . 'assets/images/maps/geochart.png'?>" width="600px">
			</div>
		</div> -->
</div>