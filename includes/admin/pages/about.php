<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh

$texts = array(

	array(
		'icon'       => 'fa-smile',
		'heading'     => __( 'User Friendly Approach', TP_TD ),
		'description' => __( 'Our intuitive interface will not slow you down. Create entire page dedicated to polls and make them part of your articles. Easy, fast, stunning. ', TP_TD ),
	),
	array(
		'icon'       => 'fa-piggy-bank',
		'heading'     => __( 'Promote Sales', TP_TD ),
		'description' => __( 'Do you need to display a customized offer and call for action?  With our customization settings, you can have it all.', TP_TD ),
	),
	array(
		'icon'       => 'fa-gem',
		'heading'     => __( 'Generate Leads', TP_TD ),
		'description' => __( 'Do you need new leads and boost your conversion?  Gather additional information from voters utilizing custom field types.', TP_TD ),
	),
	array(
		'icon'       => 'fa-whmcs',
		'heading'     => __( 'Analyze, Optimize, Improve', TP_TD ),
		'description' => __( 'Analyze the conversion rates with using dashboard and optimize to improve results.', TP_TD ),
	),
	array(
		'icon'       =>  'fa-wrench',
		'heading'     => __( 'Customization', TP_TD ),
		'description' => __( 'Use our white template to add your branding, with basic knowledge of CSS and HTML you can elevate the look to the perfection of your web look. Don’t know how? Contact us to get a quote for customization of your web.', TP_TD ),
	),
	array(
		'icon'       => 'fa-mobile-alt',
		'heading'     => __( 'Mobile-First Approach', TP_TD ),
		'description' => __( 'Pnyx uses mobile-first approach, that means that your polls will look right  on a laptop, tablet or a smartphone.', TP_TD ),
	),
	array(
		'icon'       => 'fa-searchengin',
		'heading'     => __( 'SEO Friendly', TP_TD ),
		'description' => __( 'Thus, Pnyx’s polls search-engine friendly to elevate your website traffic and get visible on the world web arena.', TP_TD ),
	),
	array(
		'icon'       => 'fa-stopwatch',
		'heading'     => __( 'Voting limitations', TP_TD ),
		'description' => __( 'Pnyx has multiple ways to define the poll style: poll date period or ongoing, reviewing results for registered or unregistered users, voting with verification or without.', TP_TD ),
	),
	array(
		'icon'       => 'fa-paint-brush',
		'heading'     => __( 'Poll Visualization', TP_TD ),
		'description' => __( 'Dress up your polls  with Text, Image, Video or even HTML. Select graphs, world maps and countdown clocks for the representation of the results.', TP_TD ),
	),
	array(
		'icon'       => 'fa-map-signs',
		'heading'     => __( 'Validation Process', TP_TD ),
		'description' => __( 'Poll Log will help you identify cheating attempts and protection features will ensure your polls has legitimate data to rely on.', TP_TD ),
	),
	array(
		'icon'       => 'fa-random',
		'heading'     => __( 'Integration', TP_TD ),
		'description' => __( 'Pnyx embeds your polls using a short code, widget or even a direct link.', TP_TD ),
	),
	array(
		'icon'       => 'fa-life-ring',
		'heading'     => __( 'Support', TP_TD ),
		'description' => __( 'We listen. Don’t be shy, let us know how can we improve our product. ', TP_TD ),
	),

);

$credits = array(
	array(
		'url'      => '#',
		'name'     => 'Pnyx Team',
		'position' => 'Develops Pnyx',
	),
	array(
		'url'      => 'https://totalpoll.com',
		'name'     => 'TotalPoll Team',
		'position' => 'Develops TotalPoll plugin which is extended by Pnyx',
	),
	array(
		'url'      => 'http://iconmonstr.com',
		'name'     => 'Iconmonstr',
		'position' => 'Icons',
	),
	array(
		'url'      => 'https://pixelbuddha.net/ballicons2/',
		'name'     => 'Ballicons',
		'position' => 'Icons',
	),
	array(
		'url'      => 'http://xdsoft.net/jqplugins/datetimepicker/',
		'name'     => 'DateTime Picker',
		'position' => 'jQuery Plugin',
	),
	array(
		'url'      => 'http://fontawesome.com/',
		'name'     => 'Font Awesome',
		'position' => 'Icons',
	),
);

?>

<div class="wrap about-wrap" id="totalpoll-about">
	<h1><?php _e( 'Welcome to', TP_TD ); ?> Pnyx</h1>

	<div class="about-text"><p><?php _e( 'Thank you for using Pnyx!', TP_TD ); ?></p>
	<p><?php _e( 'Our goal is to continuously improve and expand our product. Here quick overview of what we offer for you today.', TP_TD ); ?></p>
	</div>

	<h2 class="nav-tab-wrapper">
		<span class="nav-tab nav-tab-active"><?php _e( 'What’s New', TP_TD ); ?></span>
	</h2>
	<div class="features boxes">
		<div class="boxes-row">
			<?php foreach ( $texts as $index => $feature ): ?>
			<?php if ( $index !== 0 && $index % 2 === 0 ): ?>
		</div>
		<div class="boxes-row">
			<?php endif; ?>
			<div class="boxes-cell">
				<div class="clearfix">
					<div class="about-sec-icon"><i class="fas fa-2x fa-fw <?php echo esc_attr( $feature['icon'] ); ?>"></i></div>

					<h3><?php echo $feature['heading']; ?></h3>

					<p><?php echo $feature['description']; ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<h2 class="nav-tab-wrapper">
		<span class="nav-tab nav-tab-active"><?php _e( 'Credits', TP_TD ); ?></span>
	</h2>

	<br>

	<div class="credits boxes">
		<div class="boxes-row">
			<?php foreach ( $credits as $index => $credit ): ?>
			<?php if ( $index !== 0 && $index % 2 === 0 ): ?>
		</div>
		<div class="boxes-row">
			<?php endif; ?>
			<div class="boxes-cell">
				<h4>
					<a class="web" href="<?php echo esc_attr( $credit['url'] ); ?>" target="_blank">
						<?php echo $credit['name']; ?>
					</a>
				</h4>
				<span class="title"><?php echo $credit['position']; ?></span>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="return-to-dashboard">
		<a href="<?php admin_url( 'edit.php?post_type=poll' ) ?>"><?php _e( 'Go to Polls', TP_TD ); ?></a>
	</div>

</div>