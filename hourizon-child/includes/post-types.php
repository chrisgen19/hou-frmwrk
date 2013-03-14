<?php

/*-------------------------------------------------------------------------------------

TABLE OF CONTENTS

- Custom Post Type - Slides (Business Slider)

-------------------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Slides (Business Slider) */
/*-----------------------------------------------------------------------------------*/

if ( !function_exists('woo_add_slides') ) {
	function woo_add_slides() {
	
		global $woo_options;
		
		if ( isset( $woo_options['woo_biz_slides_disable'] ) && ( $woo_options['woo_biz_slides_disable'] == 'true' ) ) { return; }
	
		// "Slides" Custom Post Type
		$labels = array(
			'name' => _x( 'Slides', 'post type general name', 'woothemes' ),
			'singular_name' => _x( 'Slide', 'post type singular name', 'woothemes' ),
			'add_new' => _x( 'Add New', 'slide', 'woothemes' ),
			'add_new_item' => __( 'Add New Slide', 'woothemes' ),
			'edit_item' => __( 'Edit Slide', 'woothemes' ),
			'new_item' => __( 'New Slide', 'woothemes' ),
			'view_item' => __( 'View Slide', 'woothemes' ),
			'search_items' => __( 'Search Slides', 'woothemes' ),
			'not_found' =>  __( 'No slides found', 'woothemes' ),
			'not_found_in_trash' => __( 'No slides found in Trash', 'woothemes' ), 
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => false,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => get_template_directory_uri() .'/includes/images/slides.png',
			'menu_position' => null, 
			'taxonomies' => array( 'slide-page' ), 
			'supports' => array( 'title','editor','thumbnail' )
		);
		
		register_post_type( 'slide', $args );
		
		// "Slide Pages" Custom Taxonomy
		$labels = array(
			'name' => _x( 'Slide Pages', 'taxonomy general name', 'woothemes' ),
			'singular_name' => _x( 'Slide Pages', 'taxonomy singular name', 'woothemes' ),
			'search_items' =>  __( 'Search Slide Pages', 'woothemes' ),
			'all_items' => __( 'All Slide Pages', 'woothemes' ),
			'parent_item' => __( 'Parent Slide Page', 'woothemes' ),
			'parent_item_colon' => __( 'Parent Slide Page:', 'woothemes' ),
			'edit_item' => __( 'Edit Slide Page', 'woothemes' ), 
			'update_item' => __( 'Update Slide Page', 'woothemes' ),
			'add_new_item' => __( 'Add New Slide Page', 'woothemes' ),
			'new_item_name' => __( 'New Slide Page Name', 'woothemes' ),
			'menu_name' => __( 'Slide Pages', 'woothemes' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'slide-page' )
		);
		
		register_taxonomy( 'slide-page', array( 'slide' ), $args );
	}
	
	add_action( 'init', 'woo_add_slides' );
}


/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Portfolio Item (Portfolio Component) */
/*-----------------------------------------------------------------------------------*/
/*
if ( ! function_exists( 'woo_add_portfolio' ) ) {
	function woo_add_portfolio() {
	
		global $woo_options;
	
		// Sanity check.
		if (
			( isset( $woo_options['woo_portfolio_disable'] ) && $woo_options['woo_portfolio_disable'] == 'true' )
		   ) { return; }
	
		// "Portfolio Item" Custom Post Type
		$labels = array(
			'name' => _x( 'Portfolio', 'post type general name', 'woothemes' ),
			'singular_name' => _x( 'Portfolio Item', 'post type singular name', 'woothemes' ),
			'add_new' => _x( 'Add New', 'slide', 'woothemes' ),
			'add_new_item' => __( 'Add New Portfolio Item', 'woothemes' ),
			'edit_item' => __( 'Edit Portfolio Item', 'woothemes' ),
			'new_item' => __( 'New Portfolio Item', 'woothemes' ),
			'view_item' => __( 'View Portfolio Item', 'woothemes' ),
			'search_items' => __( 'Search Portfolio Items', 'woothemes' ),
			'not_found' =>  __( 'No portfolio items found', 'woothemes' ),
			'not_found_in_trash' => __( 'No portfolio items found in Trash', 'woothemes' ), 
			'parent_item_colon' => ''
		);
		
		$portfolioitems_rewrite = get_option( 'woo_portfolioitems_rewrite' );
 		if( empty( $portfolioitems_rewrite ) ) { $portfolioitems_rewrite = 'portfolio-items'; }
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => $portfolioitems_rewrite ),
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => get_template_directory_uri() .'/includes/images/portfolio.png',
			'menu_position' => null, 
			'has_archive' => true, 
			'taxonomies' => array( 'portfolio-gallery' ), 
			'supports' => array( 'title','editor','thumbnail' )
		);
		
		if ( isset( $woo_options['woo_portfolio_excludesearch'] ) && ( $woo_options['woo_portfolio_excludesearch'] == 'true' ) ) {
			$args['exclude_from_search'] = true;
		}
		
		register_post_type( 'portfolio', $args );
		
		// "Portfolio Galleries" Custom Taxonomy
		$labels = array(
			'name' => _x( 'Portfolio Galleries', 'taxonomy general name', 'woothemes' ),
			'singular_name' => _x( 'Portfolio Gallery', 'taxonomy singular name','woothemes' ),
			'search_items' =>  __( 'Search Portfolio Galleries', 'woothemes' ),
			'all_items' => __( 'All Portfolio Galleries', 'woothemes' ),
			'parent_item' => __( 'Parent Portfolio Gallery', 'woothemes' ),
			'parent_item_colon' => __( 'Parent Portfolio Gallery:', 'woothemes' ),
			'edit_item' => __( 'Edit Portfolio Gallery', 'woothemes' ), 
			'update_item' => __( 'Update Portfolio Gallery', 'woothemes' ),
			'add_new_item' => __( 'Add New Portfolio Gallery', 'woothemes' ),
			'new_item_name' => __( 'New Portfolio Gallery Name', 'woothemes' ),
			'menu_name' => __( 'Portfolio Galleries', 'woothemes' )
		); 	
		
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'portfolio-gallery' )
		);
		
		register_taxonomy( 'portfolio-gallery', array( 'portfolio' ), $args );
	}
	
	add_action( 'init', 'woo_add_portfolio' );
}
*/

/*-----------------------------------------------------------------------------------*/
/* Custom Post Type - Feedback (Feedback Component) */
/*-----------------------------------------------------------------------------------*/
/*
if ( ! function_exists( 'woo_add_feedback' ) ) {
	function woo_add_feedback() {
		global $woo_options;
		
		if ( ( isset( $woo_options['woo_feedback_disable'] ) && $woo_options['woo_feedback_disable'] == 'true' ) ) { return; }
		
		$labels = array(
			'name' => _x( 'Feedback', 'post type general name', 'woothemes' ),
			'singular_name' => _x( 'Feedback Item', 'post type singular name', 'woothemes' ),
			'add_new' => _x( 'Add New', 'slide', 'woothemes' ),
			'add_new_item' => __( 'Add New Feedback Item', 'woothemes' ),
			'edit_item' => __( 'Edit Feedback Item', 'woothemes' ),
			'new_item' => __( 'New Feedback Item', 'woothemes' ),
			'view_item' => __( 'View Feedback Item', 'woothemes' ),
			'search_items' => __( 'Search Feedback Items', 'woothemes' ),
			'not_found' =>  __( 'No Feedback Items found', 'woothemes' ),
			'not_found_in_trash' => __( 'No Feedback Items found in Trash', 'woothemes' ), 
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true, 
			'_builtin' => false,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => get_template_directory_uri() .'/includes/images/feedback.png',
			'menu_position' => null,
			'supports' => array( 'title', 'editor' ),
		);
		
		register_post_type( 'feedback', $args );

	} // End woo_add_feedback()
}

add_action( 'init', 'woo_add_feedback', 10 );

*/
?>