<?php
global $post;
if (get_field('page_title_section', $post->ID)) {
	$feaured_image_array = get_field('background_image', $post->ID);
	$feaured_image = $feaured_image_array['url'];
} else {
	$feaured_image = get_stylesheet_directory_uri() . "/images/Essential-Care.webp";
}

$page_title = get_field('custom_page_title', $post->ID);
if (!$page_title) {
	$page_title = get_the_title();
}

$page_sub_title = get_field('custom_page_sub_title', $post->ID);
if (!$page_sub_title) {
	$page_sub_title = '';
}

?>

<section id="hero-section" class="hero-section" style='background-image:url("<?php echo $feaured_image; ?>")'>
	<div class="hero-inner-section">
		<div class="hero-wrapper">
			<header class="hero-header">
				<h1 class="hero-title"><?php echo $page_title; ?></h1>
				<h2 class="hero-subtitle"><?php echo $page_sub_title; ?></h2>
			</header>
		</div>
	</div>
</section>