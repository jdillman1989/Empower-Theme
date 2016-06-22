<?php

function theme_setup() {

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Menus
	register_nav_menus( array(
		'social' => 'Social Menu'
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'theme_setup' );
	
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Register taxonomies for Directory Listings and Events
function theme_taxonomies() {
    register_taxonomy(  
        'product_categories',  //The slug of the taxonomy
        'product', //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Product Categories',  //Display name
            'query_var' => true
        )  
    );
}  
add_action( 'init', 'theme_taxonomies');

// Enqueue scripts and styles.
function theme_scripts() {

	// Load our main stylesheet.
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/css/application.css', array(), null );

	// Load theme js
	wp_register_script( 'main-script', get_template_directory_uri() . '/js/min/base.js', array( 'jquery'), null, true );

    wp_enqueue_script( 'main-script' );
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

function epw_remove_submenu() {

    // remove_submenu_page( 'themes.php', 'nav-menus.php' );
    remove_submenu_page( 'themes.php', 'customize.php' );
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_menu_page( 'edit.php' );
}

add_action( 'admin_menu', 'epw_remove_submenu', 999 );

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Empower Theme Settings',
        'menu_title'    => 'Empower Theme Settings',
        'menu_slug'     => 'empower-theme-settings'
    ));
}

foreach (glob( get_stylesheet_directory() ."/cpt/*.php") as $post_type){
    include_once( $post_type );
}
