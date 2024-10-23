<?php

/**
 * The Load Theme.
 */
add_action('after_setup_theme', 'after_setup_theme_function');
function after_setup_theme_function() {
	add_theme_support( 'menus' );
	add_theme_support( 'html5', array( 'search-form' ) );
	add_theme_support( 'post-thumbnails' ); // To add Custom Thumbnail Sizes
	add_theme_support( 'title-tag' );
};

/**
 * The Head Cleanup - clean up of WordPress head, taken from Bones Theme.
 */
add_action('init', 'init_function');
function init_function() {

	//give editors permissions
	$role_object = get_role( 'editor' );
	// to change menus
	$role_object->add_cap( 'edit_theme_options' );

	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// index link
	remove_action('wp_head', 'index_rel_link'); 
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');
	
	// Remove WordPress version from css
	add_filter('style_loader_src', 'remove_wp_ver_css_js', 9999);
	// Remove WordPress version from scripts
	add_filter('script_loader_src', 'remove_wp_ver_css_js', 9999);

	// Uncomment when need Custom Post Type for a webiste.
	require_once 'post-types/custom-post-type.php';

}

/**
 * Remove WordPress version from RSS.
 */
add_filter('the_generator', function() { 
	return ''; 
});

/**
 * Remove WordPress version from scripts.
 */
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

/**
 * To enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'enqueue_scripts_function');
function enqueue_scripts_function() {

	// Add CSS/JS only in Front-end.
	if (!is_admin()) {
		wp_enqueue_script('jquery');
		// wp_enqueue_style ( 'bootstrapcss', 'https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css' );
		wp_enqueue_style ( 'main', get_stylesheet_directory_uri() . '/css/main.css' );

		// Swiper CSS from CDN
		wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');
    
		// Swiper JS from CDN
		wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), null, true);
	}

    // This also removes some inline CSS variables for colors since 5.9 - global-styles-inline-css
    wp_dequeue_style( 'global-styles' );
    // WooCommerce - you can remove the following if you don't use Woocommerce
    wp_dequeue_style( 'wc-blocks-vendors-style' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'wp-webfonts' );

}

/**
 * Remove Emoji Styles and JS.
 * Default Load by WordPress.
 * Author: ETS I.
 */
remove_action( 'wp_head', 'wp_resource_hints', 2, 99 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script', 7 );

/**
 * Remvoe HTML or P Tag from ACF Pages.
 * Author: ETS I.
 */
function my_acf_wysiwyg_remove_wpautop( $value, $post_id, $field ) {
	remove_filter('acf_the_content', 'wpautop');
    return $value;
}
add_filter('acf/format_value/type=wysiwyg', 'my_acf_wysiwyg_remove_wpautop', 10, 3);

/**
 * Add/Load CSS and JS files in Footer.
 * Author: ETS I.
 */
add_action( 'wp_footer', 'add_js_footer_function' );
function add_js_footer_function() {
	// Load CSS/JS only on Frontend.
	if (!is_admin()) {
		// wp_enqueue_script( 'appear', get_stylesheet_directory_uri() . '/js/appear.js' );
		// wp_enqueue_script( 'bootstrapjs', 'https://cdn.usebootstrap.com/bootstrap/4.1.1/js/bootstrap.min.js' );
		// wp_enqueue_script( 'gmaps', get_stylesheet_directory_uri() . '/js/gmaps.js' );
		// wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/script.js' );

		// wp_enqueue_style ( 'font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_script( 'scriptjs', get_stylesheet_directory_uri() . '/js/script.js' );
	}
}

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    // Start an element (menu item)
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        // Get the default WordPress classes for the <li> element
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        // Add your custom class "nav-item" to the array of classes
        $classes[] = 'nav-item';
        
        // Join the classes into a string with a space delimiter
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        // Start the output for the list item with the class names
        $output .= '<li' . $class_names . '>';
        
        // Determine if this item has children (submenu)
        $has_children = !empty( $args->has_children );
        
        // Define the anchor class (basic class for links)
        $link_class = 'nav-link text-white';
        
        // If the item has children (a submenu), add the 'dropdown-toggle' class
        if ( $has_children ) {
            $link_class .= ' dropdown-toggle';
        }
        
        // Add the link with the item title and appropriate classes
        $output .= '<a href="' . esc_url( $item->url ) . '" class="' . esc_attr( $link_class ) . '">';
        $output .= esc_html( $item->title );
        $output .= '</a>';
    }

    // Start a submenu
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="dropdown-menu">';  // Add the dropdown-menu class for submenus
    }
    
    // Add a flag to determine if an item has children
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        $element->has_children = ! empty( $children_elements[ $element->ID ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}

/**
 * Register WordPress Nav Menus.
 * Author: ETS.
 */
register_nav_menus(
	array(
		'primary-navigation' => __( 'Primary Navigation' ),
	)
); 

/**
 * Add Extra dimmenssion for Image library.
 * Author: ETS.
 */
add_image_size( 'large-thumbnail', 300, 300, true );
add_image_size( 'full-width', 1200, 9999, false );

/**
 * Add Option Page with ACF Plugin.
 * ACF Paid Plugin.
 * Author: ETS.
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

/**
 * register an API key for google maps to work in ACF backend. also add to wp_register_script above.
 * https://developers.google.com/maps/documentation/javascript/get-api-key
 * Author: ACF Plugin.
 */
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
 function my_acf_google_map_api( $api ){
	$api['key'] = '';
	return $api;	
}

/**
 * Allowed SVG file upload to Media Gallery.
 * Author: ETS I.
 */
add_filter('upload_mimes', 'add_file_types_to_uploads');
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}

/**
 * set gallery link default to media file instead of attachment page
 * Author: ETS.
 */
add_filter( 'media_view_settings', function ( $settings ) {
    $settings['galleryDefaults']['link'] = 'file';
	//$settings['galleryDefaults']['columns'] = '5';
    return $settings;
});

/**
 * remove some sections of admin
 * Author: ETS.
 */
add_action('admin_menu', 'remove_admin_menu_function');
function remove_admin_menu_function() { 
	//lower than admin
	if(!current_user_can('activate_plugins')) {
		remove_menu_page('tools.php');
	}

	// Remove Posts Menu from admin - comment this line if no need of posts.
	// remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}

/**
 * make yoast appear at bottom of edit screens
 * Author: ETS.
 */
add_filter( 'wpseo_metabox_prio', function() {
	return 'low';
});

/**
 * HELPER FUNCTION
 * Author: ETS.
 */
if(!function_exists('is_blog')){
	// is_blog();
	// @link https://gist.github.com/wesbos/1189639
	function is_blog() {
	    global $post;
	    //Post type must be 'post'.
	    $post_type = get_post_type($post);
	    //Check all blog-related conditional tags, as well as the current post type, 
	    //to determine if we're viewing a blog page.
	    return (
	        ( is_home() || is_archive() || is_single() )
	        && ($post_type == 'post')
	    ) ? true : false ;

	}
}

/**
 * Register Widgets.
 * Author: ETS.
 */
add_action('widgets_init','flexibond_widgets_init');
function flexibond_widgets_init() {
	register_sidebar(array(	
		'name'          => esc_html__('Page Sidebar', 'flexibond'),
		'id'            => 'page-sidebar',
		'description'   => esc_html__('Page Sidebar', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget page_sidebar %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 1 Widget Area', 'flexibond'),
		'id'            => 'footer-1',
		'description'   => esc_html__('Footer 1', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget text text-justify">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 2 Widget Area', 'flexibond'),
		'id'            => 'footer-2',
		'description'   => esc_html__('Footer 2', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget links">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 3 Widget Area', 'flexibond'),
		'id'            => 'footer-3',
		'description'   => esc_html__('Footer 3', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget links">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Footer 4 Widget Area', 'flexibond'),
		'id'            => 'footer-4',
		'description'   => esc_html__('Footer 4', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget links">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
	register_sidebar(array(	
		'name'          => esc_html__('Copyrights Widget Area', 'flexibond'),
		'id'            => 'copyrights',
		'description'   => esc_html__('Copyrights Widget', 'flexibond'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}

/**
 * Breadcrumb.
 * Author: ETS.
 */
function ah_breadcrumb() {

	// Check if is front/home page, return
	if ( is_front_page() ) {
		return;
	}

	// Define
	global $post;
	$custom_taxonomy  = ''; // If you have custom taxonomy place it here
  
	$defaults = array(
	  'seperator'   =>  '',
	  'id'          =>  'ah-breadcrumb',
	  'classes'     =>  'ah-breadcrumb',
	  'home_title'  =>  esc_html__( 'Home', '' )
	);
  
	$sep  = '';
  
	// Start the breadcrumb with a link to your homepage
	echo '<ul id="'. esc_attr( $defaults['id'] ) .'" class="'. esc_attr( $defaults['classes'] ) .'">';
  
	// Creating home link
	echo '<li class="item"><a href="'. get_home_url() .'">'. esc_html( $defaults['home_title'] ) .'</a></li>' . $sep;
  
	if ( is_single() ) {

	  // Get posts type
	  $post_type = get_post_type();
  
	  // If post type is not post
	  if( $post_type != 'post' ) {

		$post_type_object   = get_post_type_object( $post_type );
		$post_type_link     = get_post_type_archive_link( $post_type );
  
		echo '<li class="item item-cat"><a href="'. $post_type_link .'">'. $post_type_object->labels->name .'</a></li>'. $sep;
  
	  }
  
	  // Get categories
	  $category = get_the_category( $post->ID );
  
	  // If category not empty
	  if( !empty( $category ) ) {
  
		// Arrange category parent to child
		$category_values      = array_values( $category );
		$get_last_category    = end( $category_values );
		// $get_last_category    = $category[count($category) - 1];
		$get_parent_category  = rtrim( get_category_parents( $get_last_category->term_id, true, ',' ), ',' );
		$cat_parent           = explode( ',', $get_parent_category );
  
		// Store category in $display_category
		$display_category = '';
		foreach( $cat_parent as $p ) {
			$display_category .=  '<li class="item item-cat">'. $p .'</li>' . $sep;
		}
  
	  }
  
	  // If it's a custom post type within a custom taxonomy
	  $taxonomy_exists = taxonomy_exists( $custom_taxonomy );
  
	  if( empty( $get_last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {
  
		$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
		$cat_id         = $taxonomy_terms[0]->term_id;
		$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
		$cat_name       = $taxonomy_terms[0]->name;
  
	  }
  
	  // Check if the post is in a category
	  if( !empty( $get_last_category ) ) {
  
		echo $display_category;
		echo '<li class="item item-current">'. get_the_title() .'</li>';
  
	  } else if( !empty( $cat_id ) ) {
  
		echo '<li class="item item-cat"><a href="'. $cat_link .'">'. $cat_name .'</a></li>' . $sep;
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  } else {
  
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  }
  
	} else if( is_archive() ) {
  
	  if( is_tax() ) {
		// Get posts type
		$post_type = get_post_type();
  
		// If post type is not post
		if( $post_type != 'post' ) {
  
		  $post_type_object   = get_post_type_object( $post_type );
		  $post_type_link     = get_post_type_archive_link( $post_type );
  
		  echo '<li class="item item-cat item-custom-post-type-' . $post_type . '"><a href="' . $post_type_link . '">' . $post_type_object->labels->name . '</a></li>' . $sep;
  
		}
  
		$custom_tax_name = get_queried_object()->name;
		echo '<li class="item item-current">'. $custom_tax_name .'</li>';
  
	  } else if ( is_category() ) {
  
		$parent = get_queried_object()->category_parent;
  
		if ( $parent !== 0 ) {
  
		  $parent_category = get_category( $parent );
		  $category_link   = get_category_link( $parent );
  
		  echo '<li class="item"><a href="'. esc_url( $category_link ) .'">'. $parent_category->name .'</a></li>' . $sep;
  
		}
  
		echo '<li class="item item-current">'. single_cat_title( '', false ) .'</li>';
  
	  } else if ( is_tag() ) {
  
		// Get tag information
		$term_id        = get_query_var('tag_id');
		$taxonomy       = 'post_tag';
		$args           = 'include=' . $term_id;
		$terms          = get_terms( $taxonomy, $args );
		$get_term_name  = $terms[0]->name;
  
		// Display the tag name
		echo '<li class="item-current item">'. $get_term_name .'</li>';
  
	  } else if( is_day() ) {
  
		// Day archive
  
		// Year link
		echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . '</a></li>' . $sep;
  
		// Month link
		echo '<li class="item-month item"><a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('F') .'</a></li>' . $sep;
  
		// Day display
		echo '<li class="item-current item">'. get_the_time('jS') .' '. get_the_time('F'). '</li>';
  
	  } else if( is_month() ) {
  
		// Month archive
  
		// Year link
		echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . '</a></li>' . $sep;
  
		// Month Display
		echo '<li class="item-month item-current item">'. get_the_time('F') .'</li>';
  
	  } else if ( is_year() ) {
  
		// Year Display
		echo '<li class="item-year item-current item">'. get_the_time('Y') .'</li>';
  
	  } else if ( is_author() ) {
  
		// Auhor archive
  
		// Get the author information
		global $author;
		$userdata = get_userdata( $author );
  
		// Display author name
		echo '<li class="item-current item">'. 'Author: '. $userdata->display_name . '</li>';
  
	  } else {
  
		echo '<li class="item item-current">'. post_type_archive_title() .'</li>';
  
	  }
  
	} else if ( is_page() ) {
  
	  // Standard page
	  if( $post->post_parent ) {
  
		// If child page, get parents
		$anc = get_post_ancestors( $post->ID );
  
		// Get parents in the right order
		$anc = array_reverse( $anc );
  
		// Parent page loop
		if ( !isset( $parents ) ) $parents = null;
		foreach ( $anc as $ancestor ) {
  
		  $parents .= '<li class="item-parent item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>' . $sep;
  
		}
  
		// Display parent pages
		echo $parents;
  
		// Current page
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  } else {
  
		// Just display current page if not parents
		echo '<li class="item-current item">'. get_the_title() .'</li>';
  
	  }

	} else if ( is_search() ) {
  
	  // Search results page
	  echo '<li class="item-current item">Search results for: '. get_search_query() .'</li>';
  
	} else if ( is_404() ) {

	  // 404 page
	  echo '<li class="item-current item">' . 'Error 404' . '</li>';
  
	}

	// End breadcrumb
	echo '</ul>';
  
}

/**
 * Animated Number Shortcode
 * Usage: [animated_number target="50000" duration="3000"]
 * designed by ETS I
 */
add_shortcode('animated_number', 'animated_number_shortcode');
function animated_number_shortcode($atts) {
    $atts = shortcode_atts(array(
        'target' => 50000,
        'duration' => 3000,
    ), $atts);

    $unique_id = 'animatedNumber_' . uniqid();

    $formatted_target = number_format($atts['target']);

    $output = '<span id="' . $unique_id . '">0</span>';
    $output .= '<script>
        jQuery(document).ready(function($) {
            const targetNumber = ' . esc_js($atts['target']) . ';
            const duration = ' . esc_js($atts['duration']) . ';

            $({ count: 0 }).animate({ count: targetNumber }, {
                duration: duration,
                easing: "swing",
                step: function(now) {
                    $("#' . $unique_id . '").text(numberWithCommas(Math.floor(now)));
                },
                complete: function() {
                    $("#' . $unique_id . '").text("' . $formatted_target . '");
                }
            });

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        });
    </script>';

    return $output;
}

/**
 * Post  social_media_iconsShortcode
 * Usage: [social_media_icons]
 * designed by ETS I
 */
add_shortcode('social_media_icons', 'paws_social_media_icons_shortcode_function');
function paws_social_media_icons_shortcode_function( $atts ) {
    ob_start(); ?>
	<div class="followus_text">Follow us</div>
	<div id="footer-social-icons" class="footer-social-icons" style="margin-left: 5px;"><?php
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
	<?php
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Product Grid Shortcode
 * woocommerce: columns and posts per page
 * default: 4 columns and 4 products
 * Usage: [paws_product_grid columns="4" products="4"]
 * designed by ETS I
 */
add_shortcode('paws_product_grid', 'custom_product_grid_shortcode_function');
function custom_product_grid_shortcode_function($atts) {
    $atts = shortcode_atts(array(
        'columns'  => 4,
        'products' => 8
    ), $atts);
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $atts['products']
    );
    $products = new WP_Query($args);

    ob_start();
    if ($products->have_posts()) :
        echo '<div class="paws-product-grid">';
			while ($products->have_posts()) : $products->the_post();
				global $product;
				$paws_page_title     = get_the_title();
				$paws_page_permalink = get_the_permalink(); ?>
				<div class="product-item">
					<?php if (has_post_thumbnail()) : ?>
						<div class="product-image">
							<?php the_post_thumbnail('woocommerce_thumbnail'); ?>
						</div>
					<?php endif; ?>
					<div class="product-details">
						<h3 class="product-title">
							<a title="<?php echo $paws_page_title; ?>" alt="<?php echo $paws_page_title; ?>" href="<?php echo $paws_page_permalink; ?>" class="product-title-url">
							    <?php echo $paws_page_title; ?>
						    </a>
						</h3>
						<div class="product-price">
						    <?php echo $product->get_price_html(); ?>
					    </div>
					</div>
					<div class="product-description text-left">
					    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
				    </div>
					<a href="<?php echo $paws_page_permalink; ?>" class="view-details">View Details →</a>
				</div>
				<?php
			endwhile;
        echo '</div>';
    endif;
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Post  Featured Shortcode
 * woocommerce: columns and posts per page
 * default: 4 columns and 4 products
 * Usage: [paws_featured_post columns="4" products="4"]
 * designed by ETS I
 */
add_shortcode('paws_featured_post', 'paws_featured_post_shortcode_function');
function paws_featured_post_shortcode_function($atts) {
    $atts = shortcode_atts(array(
        'columns'  => 1,
        'posts' => 1,
		'post__in' => '',
    ), $atts);
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 1,
		'category__in'   => 37,
		'order'			 => 'ASC'
    );
    $products = new WP_Query($args);

    ob_start();
    if ($products->have_posts()) :
        echo '<div class="paws-posts-grid">';
			while ($products->have_posts()) : $products->the_post();
				global $post;
				$paws_page_title     = get_the_title();
				$paws_page_permalink = get_the_permalink(); ?>

				<div class="card">
					<?php if (has_post_thumbnail()) : ?>
						<div class="product-image">
							<?php the_post_thumbnail('full'); ?>
						</div>
					<?php endif; ?>
                    <div class="card-content">
						<div class="date">
							<span class="date-icon">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/uil_schedule.svg" width="18" height="18" alt="date" class="img-fluid">
							</span>
							<span><?php echo get_the_date(); ?></span>
						</div>
                        <div class="title">
							<a href="<?php echo $paws_page_permalink; ?>" class="view-details" title="<?php echo $paws_page_title; ?>" alt="<?php echo $paws_page_title; ?>">
								<?php echo $paws_page_title; ?>
							</a>
						</div>
                        <div class="description"><?php echo the_excerpt(); ?></div>
                    </div>
                </div>

				<?php
			endwhile;
        echo '</div>';
    endif;
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Post  Featured Shortcode
 * woocommerce: columns and posts per page
 * default: 4 columns and 4 products
 * Usage: [paws_featured_post columns="4" products="4"]
 * designed by ETS I
 */
add_shortcode('paws_featured_three_post', 'paws_featured_three_post_shortcode_function');
function paws_featured_three_post_shortcode_function($atts) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
		'category__in'   => 37,
		'order'			 => 'DESC'
    );
    $products = new WP_Query($args);

    ob_start();
    if ($products->have_posts()) :
        echo '<div class="paws-posts-grid">';
			while ($products->have_posts()) : $products->the_post();
				global $post;
				$paws_page_title     = get_the_title();
				$paws_page_permalink = get_the_permalink(); ?>
				<div class="card">
					<?php if (has_post_thumbnail()) : ?>
						<div class="product-image">
							<?php the_post_thumbnail('full'); ?>
						</div>
					<?php endif; ?>
                    <div class="card-content">
						<div class="date">
							<span class="date-icon">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/uil_schedule_blue.svg" width="18" height="18" alt="date" class="img-fluid">
							</span>
							<span><?php echo get_the_date(); ?></span>
						</div>
						<a href="<?php echo $paws_page_permalink; ?>" class="view-details" title="<?php echo $paws_page_title; ?>" alt="<?php echo $paws_page_title; ?>">
							<?php echo $paws_page_title; ?>
						</a>
                        <?php echo the_excerpt(); ?>
                    </div>
                </div>

				<?php
			endwhile;
        echo '</div>';
    endif;
    wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Post  Team Members Shortcode
 * woocommerce: 3 columns and 9 posts per page
 * default: 4 columns and All Team Members
 * Usage: [paws_teams]
 * designed by ETS I
 */
add_shortcode('paws_teams', 'paws_team_memers_grid_shortcode_function');
function paws_team_memers_grid_shortcode_function($atts) {
	ob_start(); ?>
	<div class="paws-teams-memebers-section" id="paws-teams-memebers-section">
		<div class="container">
			<div class="row">
				<div class="col-12 mission-vission-section">
					<h3>Our Team</h3>
				</div>
			</div>
			<div class="row mb-5"><?php
				$args = array(
					'post_type'      => 'team_members',
					'posts_per_page' => -1,
					'orderby'        => 'title',
					'order'          => 'ASC',
					'post_status'    => 'publish'
				);
				$team_query = new WP_Query( $args );
				if ( $team_query->have_posts() ) :
					while ( $team_query->have_posts() ) : $team_query->the_post();
					    global $post;
        				$paws_page_title     = get_the_title();
        				$paws_page_permalink = get_the_permalink(); ?>
						<div class="col-12 col-md-12 col-lg-3 col-xl-3 team-member">
							<div class="team-member-card">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="team-member-image">
										<a href="<?php echo $paws_page_permalink; ?>" class="view-details" title="<?php echo $paws_page_title; ?>" alt="<?php echo $paws_page_title; ?>">
											<?php the_post_thumbnail( 'full' ); ?>
										</a>
									</div>
								<?php endif; ?>
								<h4>
								<a href="<?php echo $paws_page_permalink; ?>" class="view-details" title="<?php echo $paws_page_title; ?>" alt="<?php echo $paws_page_title; ?>">
									<?php echo $paws_page_title; ?>
								</a>
								</h4>
								<?php the_excerpt(); ?>
							</div>
						</div>
					<?php endwhile;
					wp_reset_postdata();
				endif; ?>
			</div>
		</div>
	</div><?php
	wp_reset_postdata();
    return ob_get_clean();
}

/**
 * Shortcode  specialties Grid Shortcode
  * default: 4 columns and N specialties
 * Usage: [specialties]
 * designed by ETS I
 */add_shortcode('specialties_list', 'all_specialties_shortcode_function');
function all_specialties_shortcode_function($atts) {
    $args = array(
		'post_type'      => 'specialties',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'paged'          => $paged,
		'order'          => 'ASC',
	);
    $query = new WP_Query($args);

    ob_start(); ?>
        <div class="container" style="position: relative;">
            <div class="veterinary-swiper-container swiper-container">
                <div class="swiper-wrapper"><?php
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            global $post;
                            $query->the_post();
            				$paws_page_title     = get_the_title();
            				$paws_page_permalink = get_the_permalink();
                			$specialties_icon    = get_field('specialties_icon');
                            $image_url           = $specialties_icon['url']; ?>
                            <div class="swiper-slide">
                                <div class="service-card">
                                    <?php if ($specialties_icon) : ?>
                                        <img width="149" height="149" class="img-fluid" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                    <h3 class="card-title">
            							<a href="<?php echo $paws_page_permalink; ?>" class="view-details" title="<?php echo $paws_page_title; ?>" alt="<?php echo $paws_page_title; ?>">
            								<?php echo $paws_page_title; ?>
            							</a>
            						</h3>
                                    <?php the_excerpt(); ?>
                                </div>
                            </div><?php
                        }
                    } else { ?>
                		<div class="no-content-found-section" id="no-content-found-section">
                			<div class="container">
                				<div class="row mt-3 mb-3">
                					<div class="col-12">
                						<h3>No specialties founds.</h3>
                					</div>
                
                				</div>
                			</div>
                		</div><?php
                	} ?>
                </div>
            </div>
                <div id="paws_swiper_slider_arrows" class="paws_swiper_slider_arrows">
                    <div class="swiper-button-next veterinary-swiper-button-next">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/slider-arrow.webp" width="70" height="71" alt="next" class="img-fluid">
                    </div>
                    <div class="swiper-button-prev veterinary-swiper-button-prev">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/slider-arrow.webp" width="70" height="71" alt="prev" class="img-fluid">
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
        </div><?php
    // Reset post data
    wp_reset_postdata();

    // Return the buffered content
    return ob_get_clean();
}

/**
 * Shortcode  specialties Grid Shortcode
  * default: 4 columns and 4 products
 * Usage: [specialties category="essential-care"]
 * designed by ETS I
 */add_shortcode('specialties', 'specialties_shortcode');
function specialties_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'category' => '',
        ),
        $atts,
        'specialties'
    );
	$term = get_term_by('slug', $atts['category'], 'specialty_category');
    $category_name = $term ? $term->name : '';

	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'      => 'specialties',
        'posts_per_page' => -1,
		'post_status'    => 'publish',
		'paged'          => $paged,
		'order'          => 'ASC',
        'tax_query'      => array(
								array(
									'taxonomy' => 'specialty_category',
									'field'    => 'slug',
									'terms'    => $atts['category'],
								),
        				),
    );
    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        echo '<div id="veterinary-section-'.$atts['category'].'" class="specialties-section veterinary-section veterinary-section-'.$atts['category'].'"><div class="container">';

		echo '<h3 class="text-danger specialties_tax_name">' . esc_html($category_name) . '</h3>';
		echo '<div class="row">';
            while ($query->have_posts()) {
                $query->the_post();
                global $post;
                $paws_page_title     = get_the_title();
				$paws_page_permalink = get_the_permalink();
    			$specialties_icon    = get_field('specialties_icon');
                $image_url           = $specialties_icon['url']; ?>
    			<div class="col-12 col-md-6 col-lg-3 col-xl-3">
                    <div class="service-card">
    					<?php if ($specialties_icon) : ?>
                            <img class="img-fluid" src="<?php echo esc_url($image_url); ?>" alt="<?php echo $paws_page_title; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h3 class="card-title">
    							<a href="<?php echo $paws_page_permalink; ?>" class="view-details" title="<?php echo $paws_page_title; ?>" alt="<?php echo $paws_page_title; ?>">
    								<?php echo $paws_page_title; ?>
    							</a>
    						</h3>
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
                <?php
            }

        echo '</div></div></div>';
    } else { ?>
        <div class="no-content-found-section" id="no-content-found-section">
			<div class="container">
				<div class="row mt-3 mb-3">
					<div class="col-12">
						<h3>No specialties found in this category.</h3>
					</div>

				</div>
			</div>
		</div><?php
    }

    // Reset post data
    wp_reset_postdata();

    // Return the buffered content
    return ob_get_clean();
}
