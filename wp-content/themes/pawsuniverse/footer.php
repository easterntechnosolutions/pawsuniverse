			<section class="subscribe-section cust-css-sub" style="background-image:url(images/background/3.webp);">
				<div class="auto-container">
					<div class="row clearfix">
						<!--Column-->
						<div class="column col-md-7 col-md-12 col-xs-12">
							<div class="subscribe-form subscribe-cust-css-resp">
								<h2>Subscribe to our Newsletter</h2>
							</div>
						</div>
						<!--Column-->
						<div class="column col-md-5 col-md-12 col-xs-12">
							
							<!--Subscribe form-->
							<div class="subscribe-form subscribe-cust-css-resp">
								<form id="subscribe-form" role="form" method="post" action="" novalidate="novalidate">
									<div class="form-group">
										<input type="email" name="subemail" value="" placeholder="Your email..." required="">
										<button type="submit" class="theme-btn">Send</button>
										<label id="label-text" style="display:none; color:#fff;">Thank you for subscribing</label>
									<div data-lastpass-icon-root="" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div></div>
									<div class="form-group">
										<label id="label-text" style="display:none; color:#fff;">Thank you for subscribing</label>
									</div>
								</form>
							</div>
							
						</div>
					</div>
				</div>
			</section>
			<!-- Main Footer -->
			<footer class="main-footer">
				<div class="auto-container">
					<div class="widgets-section">
						<div class="row clearfix">
							<div class="big-column col-md-6 col-sm-12 col-xs-12">
								<div class="row clearfix">
									<div class="footer-column col-md-7 col-sm-6 col-xs-12">
										<div class="footer-widget logo-widget">
											<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
												<?php dynamic_sidebar('footer-1'); ?>
											<?php } ?>
										</div>
									</div>
									<div class="footer-column col-md-5 col-sm-6 col-xs-12">
										<div class="footer-widget links-widget">
											<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
												<?php dynamic_sidebar('footer-2'); ?>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<div class="big-column col-md-6 col-sm-12 col-xs-12">
								<div class="row clearfix">
									<div class="footer-column col-md-7 col-sm-6 col-xs-12">
										<div class="footer-widget links-widget">
											<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
												<?php dynamic_sidebar('footer-3'); ?>
											<?php } ?>
										</div>
									</div>
									<div class="footer-column col-md-5 col-sm-6 col-xs-12">
										<div class="footer-widget contact-widget">
											<?php if ( is_active_sidebar( 'footer-4' ) ) { ?>
												<?php dynamic_sidebar('footer-4'); ?>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- auto-container -->
				<div class="copyrights_section footer-bottom">
					<div class="auto-container">
						<?php if ( is_active_sidebar( 'copyrights' ) ) { ?>
							<?php dynamic_sidebar('copyrights'); ?>
						<?php } else { ?>
							Copyrights &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> All Rights Reserved. | Powered by : <a href="https://easternts.com.au/" title="Eastern Techno Solutions" target="_blank"> Eastern Techno Solutions</a><?php
						} ?>
					</div>
				</div>
			</footer>
			<!--Scroll to top-->
			<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
			<?php wp_footer(); ?>
		</div><!-- page-wrapper -->
	</body>
</html>