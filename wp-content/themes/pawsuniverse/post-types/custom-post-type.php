<?php

// Register Custom Post Type = Team Members
$labels = array(
	'name'                => _x('Team Members', 'Post Type General Name', 'pawsuniverse'),
	'singular_name'       => _x('Team Member', 'Post Type Singular Name', 'pawsuniverse'),
	'menu_name'           => __('Team Members', 'pawsuniverse'),
	'parent_item_colon'   => __('Parent Team:', 'pawsuniverse'),
	'all_items'           => __('All Team Members', 'pawsuniverse'),
	'view_item'           => __('View Team Member', 'pawsuniverse'),
	'add_new_item'        => __('Add New Team Member', 'pawsuniverse'),
	'add_new'             => __('Add New Member', 'pawsuniverse'),
	'edit_item'           => __('Edit Team Member', 'pawsuniverse'),
	'update_item'         => __('Update Team Member', 'pawsuniverse'),
	'search_items'        => __('Search Team Members', 'pawsuniverse'),
	'not_found'           => __('No Team Members found', 'pawsuniverse'),
	'not_found_in_trash'  => __('No Team Members found in Trash', 'pawsuniverse'),
);
$args = array(
	'label'               => __('Team Members', 'pawsuniverse'),
	'description'         => __('Team Members', 'pawsuniverse'),
	'labels'              => $labels,
	'supports'            => array('title', 'excerpt', 'editor', 'thumbnail'),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'menu_position'       => 5,
	'menu_icon'           => 'dashicons-admin-users',
	'rewrite'             => array('slug' => 'team_member'),
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'post',
);
register_post_type('team_members', $args);

// Register Custom Post Type = Specialties.
$specialties_labels = array(
	'name'                => _x('Specialties', 'Post Type General Name', 'pawsuniverse'),
	'singular_name'       => _x('Speciality', 'Post Type Singular Name', 'pawsuniverse'),
	'menu_name'           => __('Specialties', 'pawsuniverse'),
	'parent_item_colon'   => __('Parent Speciality:', 'pawsuniverse'),
	'all_items'           => __('All Specialties', 'pawsuniverse'),
	'view_item'           => __('View Speciality', 'pawsuniverse'),
	'add_new_item'        => __('Add New Speciality', 'pawsuniverse'),
	'add_new'             => __('Add New Speciality', 'pawsuniverse'),
	'edit_item'           => __('Edit Speciality', 'pawsuniverse'),
	'update_item'         => __('Update Speciality', 'pawsuniverse'),
	'search_items'        => __('Search Specialties', 'pawsuniverse'),
	'not_found'           => __('No Specialties found', 'pawsuniverse'),
	'not_found_in_trash'  => __('No Specialties found in Trash', 'pawsuniverse'),
);
$specialties_args = array(
	'label'               => __('Specialties', 'pawsuniverse'),
	'description'         => __('Specialties', 'pawsuniverse'),
	'labels'              => $specialties_labels,
	'supports'            => array('title', 'excerpt', 'thumbnail'),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'menu_position'       => 5,
	'menu_icon'           => 'dashicons-analytics',
	'rewrite'             => array('slug' => 'speciality'),
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'post',
);

$specialties_taxonomy_labels = array(
	'name'              => _x('Specialty Categories', 'taxonomy general name', 'pawsuniverse'),
	'singular_name'     => _x('Specialty Category', 'taxonomy singular name', 'pawsuniverse'),
	'search_items'      => __('Search Specialty Categories', 'pawsuniverse'),
	'all_items'         => __('All Specialty Categories', 'pawsuniverse'),
	'parent_item'       => __('Parent Specialty Category', 'pawsuniverse'),
	'parent_item_colon' => __('Parent Specialty Category:', 'pawsuniverse'),
	'edit_item'         => __('Edit Specialty Category', 'pawsuniverse'),
	'update_item'       => __('Update Specialty Category', 'pawsuniverse'),
	'add_new_item'      => __('Add New Specialty Category', 'pawsuniverse'),
	'new_item_name'     => __('New Specialty Category Name', 'pawsuniverse'),
	'menu_name'         => __('Specialty Categories', 'pawsuniverse'),
);

$args = array(
	'labels'            => $specialties_taxonomy_labels,
	'hierarchical'      => true, // Set to true for category-like behavior, false for tag-like behavior
	'public'            => true,
	'show_ui'           => true,
	'show_admin_column' => true,
	'show_in_nav_menus' => true,
	'show_tagcloud'     => true,
	'rewrite'           => array('slug' => 'specialty-category'),
);

register_post_type('specialties', $specialties_args);
register_taxonomy('specialty_category', array('specialties'), $args);
