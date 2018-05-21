<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<div class="totalpoll-tab-content settings-tab-content settings-charts active" data-tp-tab-content="charts">
	<div class="settings-item two-columns">
		<div class="settings-field">
			<label for="chart_2">
				<input type="radio" name="totalpoll[settings][charts][order]" value="2" id="chart_2"
					   <?php checked($charts['order'], '2' ); ?>>
				<div class="preview-image">
					<img src="<?=TP_URL . 'assets/images/charts/pie.png'?>" width="200px">
				</div>
			</label>
		</div>
	</div>
	<div class="settings-item two-columns">
		<div class="settings-field">
			<label for="chart_3">
				<input type="radio" name="totalpoll[settings][charts][order]" value="3" id="chart_3"
					   <?php checked($charts['order'], '3' ); ?>>
				<div class="preview-image">
					<img src="<?=TP_URL . 'assets/images/charts/doughnut.png'?>" width="200px">
				</div>
			</label>
		</div>
	</div>
	<div class="settings-item two-columns">
		<div class="settings-field">
			<label for="chart_1">
				<input type="radio" name="totalpoll[settings][charts][order]" value="1" id="chart_1"
					   <?php checked($charts['order'], '1' ); ?>>
				<div class="preview-image">
					<img src="<?=TP_URL . 'assets/images/charts/bar.png'?>" width="200px">
				</div>
			</label>
		</div>
	</div>
	<div class="settings-item two-columns">
		<div class="settings-field">
			<label for="chart_6">
				<input type="radio" name="totalpoll[settings][charts][order]" value="6" id="chart_6"
				   <?php checked($charts['order'], '6' ); ?>>
				<div class="preview-image">
					<img src="<?=TP_URL . 'assets/images/charts/polar.png'?>" width="200px">
				</div>
			</label>
		</div>
	</div>
	<div class="settings-item two-columns">
		<div class="settings-field">
			<div class="settings-field">
				<label for="chart_4">
					<input type="radio" name="totalpoll[settings][charts][order]" value="4" id="chart_4"
					   <?php checked($charts['order'], '4' ); ?>>
				  	<div class="preview-image">
						<img src="<?=TP_URL . 'assets/images/charts/line.png'?>" width="200px">
					</div>
				</label>
			</div>
		</div>
	</div>
	<?php do_action( 'totalpoll/actions/admin/editor/settings/charts/order-charts', $charts, $this->poll ); ?>

</div>