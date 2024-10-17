<?php
if (have_posts()) {
	$count = 1;
	while (have_posts()) : the_post();
		if( have_rows('content_blocks') ) {
			while( have_rows('content_blocks') ): the_row(); ?>
				<section id="content_block_<?php echo $count; ?>" class="content_blocks_lists content_block_<?php echo $count; ?>">
					<?php
						echo $sub_content_block = get_sub_field('content_block');
					?>
				</section><?php
				$count++;
			endwhile;
		} else { ?>
			<div class="page_contents_section about-section">
				<div class="auto-container"><?php
					if( '' !== get_post()->post_content ) {
						the_content();
					} else { ?>
						<div class="no-content-found-section" id="no-content-found-section">
							<div class="container">
								<div class="row mt-5 mb-5">
									<div class="col-12">
										<h3>No Contents Founds.</h3>
									</div>
					
								</div>
							</div>
						</div><?php
					} ?>
				</div>
			</div><?php
		}
	endwhile;
} else { ?>
	<div class="no-content-found-section" id="no-content-found-section">
		<div class="container">
			<div class="row mt-3 mb-3">
				<div class="col-12">
					<h3>No Contents Found.</h3>
				</div>

			</div>
		</div>
	</div><?php
} ?>
