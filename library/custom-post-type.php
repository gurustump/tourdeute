<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// Person custom post type
function person_custom_type() { 
	// creating (registering) the custom type 
	register_post_type( 'person', // (http://codex.wordpress.org/Function_Reference/register_post_type)
		array( 'labels' => array(
			'name' => __( 'People', 'bonestheme' ), 
			'singular_name' => __( 'Person', 'bonestheme' ), 
			'all_items' => __( 'All People', 'bonestheme' ),
			'add_new' => __( 'Add New', 'bonestheme' ),
			'add_new_item' => __( 'Add New Person', 'bonestheme' ),
			'edit' => __( 'Edit', 'bonestheme' ),
			'edit_item' => __( 'Edit Person', 'bonestheme' ),
			'new_item' => __( 'New Person', 'bonestheme' ),
			'view_item' => __( 'View Person', 'bonestheme' ),
			'search_items' => __( 'Search People', 'bonestheme' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ),
			'parent_item_colon' => ''
			),
			'description' => __( 'For listing people on the website', 'bonestheme' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-universal-access',
			'rewrite'	=> array( 'slug' => 'people', 'with_front' => false ),
			//'has_archive' => 'show',
			'has_archive' => false,
			'hierarchical' => false,
			'capability_type' => 'post',
			// the next one is important, it tells what's enabled in the post editor 
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) // end of options 
	); // end of register post type 
	
}
// adding the function to the Wordpress init
add_action( 'init', 'person_custom_type');


// Video custom post type
function video_custom_type() { 
	// creating (registering) the custom type 
	register_post_type( 'video', // (http://codex.wordpress.org/Function_Reference/register_post_type)
		array( 'labels' => array(
			'name' => __( 'Videos', 'bonestheme' ), 
			'singular_name' => __( 'Video', 'bonestheme' ), 
			'all_items' => __( 'All Videos', 'bonestheme' ),
			'add_new' => __( 'Add New', 'bonestheme' ),
			'add_new_item' => __( 'Add New Video', 'bonestheme' ),
			'edit' => __( 'Edit', 'bonestheme' ),
			'edit_item' => __( 'Edit Video', 'bonestheme' ),
			'new_item' => __( 'New Video', 'bonestheme' ),
			'view_item' => __( 'View Video', 'bonestheme' ),
			'search_items' => __( 'Search Videos', 'bonestheme' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ),
			'parent_item_colon' => ''
			),
			'description' => __( 'For videos that appear on the video page', 'bonestheme' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 7,
			'menu_icon' => 'dashicons-media-video',
			'rewrite'	=> array( 'slug' => 'video', 'with_front' => false ),
			//'has_archive' => 'show',
			'has_archive' => false,
			'hierarchical' => false,
			'capability_type' => 'post',
			// the next one is important, it tells what's enabled in the post editor 
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) // end of options 
	); // end of register post type 
	
}
// adding the function to the Wordpress init
add_action( 'init', 'video_custom_type');


// Project custom post type
function project_custom_type() { 
	// creating (registering) the custom type 
	register_post_type( 'project', // (http://codex.wordpress.org/Function_Reference/register_post_type)
		array( 'labels' => array(
			'name' => __( 'Projects', 'bonestheme' ), 
			'singular_name' => __( 'Project', 'bonestheme' ), 
			'all_items' => __( 'All Projects', 'bonestheme' ),
			'add_new' => __( 'Add New', 'bonestheme' ),
			'add_new_item' => __( 'Add New Project', 'bonestheme' ),
			'edit' => __( 'Edit', 'bonestheme' ),
			'edit_item' => __( 'Edit Project', 'bonestheme' ),
			'new_item' => __( 'New Project', 'bonestheme' ),
			'view_item' => __( 'View Project', 'bonestheme' ),
			'search_items' => __( 'Search Projects', 'bonestheme' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ),
			'parent_item_colon' => ''
			),
			'description' => __( 'For projects on the projects page', 'bonestheme' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 7,
			'menu_icon' => 'dashicons-hammer',
			'rewrite'	=> array( 'slug' => 'projects', 'with_front' => false ),
			//'has_archive' => 'show',
			'has_archive' => false,
			'hierarchical' => false,
			'capability_type' => 'post',
			// the next one is important, it tells what's enabled in the post editor 
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) // end of options 
	); // end of register post type 
	
}
// adding the function to the Wordpress init
add_action( 'init', 'project_custom_type');


// Resource custom post type
function resource_custom_type() { 
	// creating (registering) the custom type 
	register_post_type( 'resource', // (http://codex.wordpress.org/Function_Reference/register_post_type)
		array( 'labels' => array(
			'name' => __( 'Resources', 'bonestheme' ), 
			'singular_name' => __( 'Resource', 'bonestheme' ), 
			'all_items' => __( 'All Resources', 'bonestheme' ),
			'add_new' => __( 'Add New', 'bonestheme' ),
			'add_new_item' => __( 'Add New Resource', 'bonestheme' ),
			'edit' => __( 'Edit', 'bonestheme' ),
			'edit_item' => __( 'Edit Resource', 'bonestheme' ),
			'new_item' => __( 'New Resource', 'bonestheme' ),
			'view_item' => __( 'View Resource', 'bonestheme' ),
			'search_items' => __( 'Search Resources', 'bonestheme' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ),
			'parent_item_colon' => ''
			),
			'description' => __( 'For resources on the resources page', 'bonestheme' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 7,
			'menu_icon' => 'dashicons-media-default',
			'rewrite'	=> array( 'slug' => 'resources', 'with_front' => false ),
			//'has_archive' => 'show',
			'has_archive' => false,
			'hierarchical' => false,
			'capability_type' => 'post',
			// the next one is important, it tells what's enabled in the post editor 
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) // end of options 
	); // end of register post type 
	
}
// adding the function to the Wordpress init
add_action( 'init', 'resource_custom_type');
	

?>
