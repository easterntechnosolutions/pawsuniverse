<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>

    <title>Mega Menu in Navigation</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> -->

</head>

<body <?php body_class('paws_body'); ?>>

	<?php
		$globalHeader_LogoSection    = get_field( 'logo', 'options' );
		$globalHeader_enquiry_number = get_field( 'enquiry_number', 'options' );
		$globalHeader_location       = get_field( 'location', 'options' );
	?>
	<!-- Header Section -->
	<header id="global_header_section" class="global_header_section">

		<!-- Top Header Section -->
		<div id="global_header_top_section" class="global_header_top_section">
			<div class="container-fluid py-2 bg-white">
				<div class="row align-items-center">
					<!-- Left Section: Contact Numbers -->
					<div class="col-md-4 text-md-start text-center global_header_left_section">
						<div class="info-container">
							<div class="info-block">
								<div class="icon">
									<img src="<?php echo get_stylesheet_directory_uri() ?>/images/line_phone_call.svg" width="40" height="40" alt="Calls" class="img-fluid">
								</div>
								<div class="text">
									<p>Enquiry</p>
									<a href="tel:+917837157157" alt="+91-7837157157" title="+91-7837157157">+91-7837157157</a>
								</div>
							</div>
							<div class="divider"></div>
							<div class="info-block">
								<div class="icon">
									<img src="<?php echo get_stylesheet_directory_uri() ?>/images/map_icon.svg" width="40" height="40" alt="Calls" class="img-fluid">
								</div>
								<div class="text">
									<p>Location</p>
									<a href="#" alt="123 Street, Ahmadabad" title="123 Street, Ahmadabad">123 Street, Ahmadabad</a>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Center Section: Logo -->
					<div class="col-md-4 text-center header_center_logo_section">
						<a id="Paws_Universe_Logo" class="Paws_Universe_Logo" title="Paws Universe Logo" href="<?php echo site_url('/'); ?>">
							<img src="<?php echo $globalHeader_LogoSection['url']; ?>" width="261" height="82" title="Paws Universe Logo"alt="Paws Universe Logo" class="img-fluid">
						</a>
					</div>
					
					<!-- Right Section: Emergency Button and Icons -->
					<div class="col-md-4 text-md-end text-center global_header_right_section">
						<a title="Emergency" alt="Emergency" href="#" class="btn btn-danger me-3 emergency_btn">
							<img src="<?php echo get_stylesheet_directory_uri() ?>/images/emegency_call.svg" width="20" height="20" title="Emergency" alt="Emergency" class="img-fluid"> Emergency
						</a>
						<div id="user_dashboard_icons" class="user_dashboard_icons">
							<a href="#" class="fa_icons">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon_moon_cart.svg" width="25" height="25" alt="Calls" class="img-fluid">
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
							</a>
							<a href="#" class="fa_icons">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon_moon_heart.svg" width="25" height="25" alt="Calls" class="img-fluid">
							</a>
							<a href="#" class="fa_icons">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon_moon_profile.svg" width="25" height="25" alt="Calls" class="img-fluid">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Navigation Section with Mega Menu -->
		<div id="global_header_navigation_section" class="global_header_navigation_section">
			<div class="container-fluid bg-danger">
				<nav class="navbar navbar-expand-md navbar-dark">
					<div class="container-fluid text-center justify-content-center">
						<?php
							wp_nav_menu( array(
								'theme_location'  => 'primary-navigation',
								'menu'            => '2',
								'container'       => 'div',
								'container_class' => 'collapse navbar-collapse',
								'menu_class'      => 'navbar-nav mx-auto',
								'menu_id'         => 'global_navigation_section',
								'depth'           => 4,
								'fallback_cb'     => false,
								'add_li_class'    => 'nav-item',
								'link_class'      => 'nav-link text-white',
							) );
						?>
					</div>
				</nav>
			</div>
		</div>

	</header>
