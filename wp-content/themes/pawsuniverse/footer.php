
		<?php wp_footer();
		$globalFooter_full_width_image    = get_field( 'full_width_image', 'options' );
		$globalFooter_enquiry_number      = get_field( 'enquiry_number', 'options' );
		$globalFooter_LogoSection         = get_field( 'footer_logo', 'options' ); 
		$globalFooter_location            = get_field( 'location', 'options' ); 
		$globalFooter_email_address       = get_field( 'email_address', 'options' ); 
		$globalFooter_copyright_section   = get_field( 'copyright_section', 'options' ); 
		$globalFooter_social_media_icons  = get_field( 'social_media_icons', 'options' ); ?>

		<!-- Footer Section -->
		<footer class="footer global-footer">

			<section id="footer_fullwidth_image" class="footer_fullwidth_image">
				<img src="<?php echo $globalFooter_full_width_image['url']; ?>" width="1920" height="422" alt="Paws Universe" class="img-fluid">
			</section>

			<section class="bg-white text-white text-center before_footer_section">
				<div class="container-fluid">
					<div class="row text-center text-md-start">
						<!-- Logo and Social Icon Section -->
						<div class="col-md-3 mb-4 footer-logo">
							<img src="<?php echo $globalFooter_LogoSection['url']; ?>" width="355" height="111" alt="Paws Universe Logo" class="img-fluid">
							<p>The Ideal Pet Hospital Combining Advanced Veterinary Medicine with Personalized Care to Ensure Your Pet’s Optimal Health.</p>
							<div id="footer-social-icons" class="footer-social-icons"><?php
								if( have_rows('social_media_icons', 'options' ) ) {
									while( have_rows('social_media_icons', 'options' ) ) : the_row();
										$social_media_image = get_sub_field('social_media_image', 'options' );
										$social_media_url   = get_sub_field('social_media_url', 'options' ); ?>
										<a target="_blank" alt="<?php echo $social_media_url; ?>" href="<?php echo $social_media_url; ?>">
											<img src="<?php echo $social_media_image['url']; ?>" width="40.50" height="40.50" alt="<?php echo $social_media_url; ?>" class="img-fluid">
										</a><?php
									endwhile;
								} ?>
							</div>
						</div>

						<!-- Explore, Pet Care, Expert Care Menus -->
						<div class="col-md-3 col-lg-3 col-xl-3">
							<div class="row">
								<!-- Explore Menu -->
								<div class="col-md-3 mb-3 explore_navigation_section">
									<h6>Explore</h6>
									<?php
										wp_nav_menu( array(
											'menu'            => '4',
											'container'       => 'ul',
											'menu_class'      => 'list-unstyled',
											'menu_id'         => 'list-unstyled-4',
											'depth'           => 2,
										) );
									?>
								</div>

								<!-- Pet Care Menu -->
								<div class="col-md-4 mb-4 pet_care_navigation_section">
									<h6>Pet Care</h6>
									<?php
										wp_nav_menu( array(
											'menu'            => '5',
											'container'       => 'ul',
											'menu_class'      => 'list-unstyled',
											'menu_id'         => 'list-unstyled-5',
											'depth'           => 2,
										) );
									?>
								</div>

								<!-- Expert Care Menu -->
								<div class="col-md-5 mb-5 expert_care_navigation_section">
									<h6>Expert Care</h6>
									<?php
										wp_nav_menu( array(
											'menu'            => '6',
											'container'       => 'ul',
											'menu_class'      => 'list-unstyled',
											'menu_id'         => 'list-unstyled-6',
											'depth'           => 2,
										) );
									?>
								</div>
							</div>
						</div>
					
						<!-- Specialties Menu -->
						<div class="col-md-4 mb-4 no_navigation_section">
							<div class="row">
								<!-- Specialties Menu -->
								<div class="col-md-6 mb-4 specialties_navigation_section">
									<h6>Specialties</h6>
									<?php
										wp_nav_menu( array(
											'menu'            => '7',
											'container'       => 'ul',
											'menu_class'      => 'list-unstyled',
											'menu_id'         => 'list-unstyled-7',
											'depth'           => 2,
										) );
									?>
								</div>
								<!-- Additional Specialties Menu -->
								<div class="col-md-6 mb-4 no_specialties_navigation_section">
									<h6 style="color: transparent !important;">Specialties</h6>
									<?php
										wp_nav_menu( array(
											'menu'            => '8',
											'container'       => 'ul',
											'menu_class'      => 'list-unstyled',
											'menu_id'         => 'list-unstyled-8',
											'depth'           => 2,
										) );
									?>
								</div>
							</div>
						</div>

						<!-- Get In Touch Section -->
						<div class="col-md-2 mb-4">
							<h6>Get In Touch</h6>
							<ul class="contact-info list-unstyled">
								<li>
									<img src="<?php echo get_stylesheet_directory_uri() ?>/images/line_phone_call.svg" width="26" height="26" alt="Paws Universe" class="img-fluid">
									<a href="tel:<?php echo $globalFooter_enquiry_number; ?>" alt="call to : ><?php echo $globalFooter_enquiry_number; ?>"><?php echo $globalFooter_enquiry_number; ?></a>
								</li>
								<li>
									<img src="<?php echo get_stylesheet_directory_uri() ?>/images/map_icon.svg" width="26" height="26" alt="Paws Universe" class="img-fluid">
									<?php echo $globalFooter_location; ?>
								</li>
								<li>
									<img src="<?php echo get_stylesheet_directory_uri() ?>/images/email-icon.svg" width="26" height="26" alt="Email to : <?php echo $globalFooter_email_address; ?>" class="img-fluid">
									<a href="mailto:<?php echo $globalFooter_email_address; ?>"><?php echo $globalFooter_email_address; ?></a>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</section>

			<section class="bg-danger text-white text-center py-2 copyright_section">
				<div class="container-fluid">
					<p style="margin-bottom: 0;"><?php echo $globalFooter_copyright_section; ?></p>
				</div>
			</section>

		</footer>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>