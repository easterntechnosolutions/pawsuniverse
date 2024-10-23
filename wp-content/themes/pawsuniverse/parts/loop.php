<?php
global $post;
$post_slug = $post->post_name;
if (have_posts()) {
	$count = 1;
	while (have_posts()) : the_post();
		if( have_rows('content_blocks') ) {
			while( have_rows('content_blocks') ): the_row(); ?>
				<section id="content_block_<?php echo $count; ?>" class="content_blocks_lists content_block_<?php echo $count; ?>">
					<?php
						$full_width_section = get_sub_field('full_width_section');
						if( !$full_width_section ) {
							echo '<div class="container">';
						}
							echo $sub_content_block = get_sub_field('content_block');
						if( !$full_width_section ) {
							echo '</div>';
						}
					?>
				</section><?php
				$count++;
			endwhile;
		} else { ?>
			<div class="page_contents_section content_blocks_lists paws-<?php echo $post_slug; ?>-section">
				<div class="container"><?php
					the_content(); ?>
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
