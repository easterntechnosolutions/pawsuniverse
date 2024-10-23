<?php   

get_header();

global $post;
if (get_field('page_title_section', $post->ID)) {
	$feaured_image_array = get_field('background_image', $post->ID);
	if ( empty( $feaured_image_array )) {
		$feaured_image = get_stylesheet_directory_uri() . "/images/Essential-Care.webp";
	} else {
		$feaured_image = $feaured_image_array['url'];
	}
} else {
	$feaured_image = get_stylesheet_directory_uri() . "/images/Essential-Care.webp";
}

$left_red_title = get_field('left_red_title', $post->ID);
if ( $left_red_title ) {
	$left_red_title = $left_red_title;
} else {
	$left_red_title = get_the_title();
}

$left_sub_title = get_field('left_sub_title', $post->ID);
if ( !$left_sub_title ) {
	$left_sub_title = '';
}

$hero_section_right_sub_title = get_field('hero_section_right_sub_title', $post->ID);
if (!$hero_section_right_sub_title) {
	$hero_section_right_sub_title = '';
}

$taxonomy = 'specialty_category';
$terms = get_the_terms($post->ID, $taxonomy);

$hero_section_left_title = get_field('hero_section_left_title', $post->ID);
if ( $hero_section_left_title ) {
	$hero_section_left_title = $hero_section_left_title;
} else {
	if ($terms && !is_wp_error($terms)) {
		$hero_section_left_title = $terms[0]->name;
	} else {
		$hero_section_left_title = 'No Category Found.';
	}
}
?>

<section id="hero-section" class="hero-section" style='background-image:url("<?php echo $feaured_image; ?>")'>
	<div class="hero-inner-section">
		<div class="hero-wrapper">
			<header class="hero-header">
				<h2 class="hero-title"><?php echo $left_red_title; ?></h2>
				<h3 class="hero-subtitle"><?php echo $hero_section_right_sub_title; ?></h3>
			</header>
		</div>
	</div>
</section>

	<div class="single-speciality-section" id="single-speciality-section">
		<div class="container">
			<div class="row">
				<?php if (have_posts()) { ?>
					<div class="post-item single-speciality-left-section col-12 col-md-12 col-lg-6 col-xl-6">
						<!-- <div class="specialities_title_leg_section">
							<img src="<?php //echo get_stylesheet_directory_uri() ?>/images/paw-legs.svg" width="50" height="50" alt="Paw" class="img-fluid paws-leg leg-one">
							<img src="<?php //echo get_stylesheet_directory_uri() ?>/images/paw-legs.svg" width="50" height="50" alt="Paw" class="img-fluid paws-leg leg-two">
							<h1 class="specialities_page_title"><?php //echo $left_red_title; ?></h1>
						</div>
						<div class="specialities_left_subtitle"><?php //echo $left_sub_title; ?></div> -->
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="team-member-image">
								<?php the_post_thumbnail( 'full' ); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="post-item single-speciality-right-section col-12 col-md-12 col-lg-6 col-xl-6">
						<?php
							the_content();
							/*$count = 1;
							if( have_rows('content_blocks', $post->ID) ) {
								while( have_rows('content_blocks', $post->ID) ): the_row(); ?>
									<section id="content_block_<?php echo $count; ?>" class="content_specialist_lists content_block_<?php echo $count; ?>">
										<?php
											echo $sub_content_block = get_sub_field('content_block');
										?>
									</section><?php
									$count++;
								endwhile;
								the_content();
							} else { ?>
								<div class="no-content-found-section" id="no-content-found-section">
									<div class="container">
										<div class="row mt-3 mb-3">
											<div class="col-12">
												<h5>No Contents Found.</h5>
											</div>
										</div>
									</div>
								</div><?php
							} */
						?>
					</div>
				<?php } else { ?>
					<div class="no-content-found-section" id="no-content-found-section">
						<div class="container">
							<div class="row mt-3 mb-3">
								<div class="col-12">
									<h3>No Contents Found.</h3>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>