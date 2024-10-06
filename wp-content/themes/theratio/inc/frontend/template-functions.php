<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Theratio
 */


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function theratio_hbody_classes( $classes ) {
	// Add a class if there is a custom header.
	if( theratio_get_option('header_position') == 'header_left' ){
		$classes[] = 'header-vertical';
	}else{
		$classes[] = 'header-horizontal';
	}
	if( theratio_get_option('dark_light') != false ){
		$classes[] = 'dark-scheme';
	}
	return $classes;
}
add_filter( 'body_class', 'theratio_hbody_classes' );

/**
 *  Add specific CSS class to header
 */
function theratio_header_class() {

	$header_classes = '';

	if ( theratio_get_option('header_fixed') != false ){
		$header_classes = 'header-transparent';
	}else{
		$header_classes = 'header-static';
	}
	if ( function_exists('rwmb_meta') ) {
		if( rwmb_meta('is_trans') == 'yes'){
			$header_classes = 'header-transparent';
		}elseif( rwmb_meta('is_trans') == 'no'){
			$header_classes = 'header-static';
		}
	}
	

    echo $header_classes;
}

/* Portfolio Column */
if ( ! function_exists( 'theratio_portfolio_option_class' ) ) :
	function theratio_portfolio_option_class() {

		$portfolio_option_class = array();

		if( theratio_get_option('portfolio_column') == "2cl" ){
			$portfolio_option_class[] = 'pf_2_cols';
		}elseif( theratio_get_option('portfolio_column') == "4cl" ) {
			$portfolio_option_class[] = 'pf_4_cols';
		}elseif( theratio_get_option('portfolio_column') == "5cl" ) {
			$portfolio_option_class[] = 'pf_5_cols';
		}else{
			$portfolio_option_class[] = '';
		}

		if( theratio_get_option('portfolio_style') == "style2" ) {
			$portfolio_option_class[] = 'style-2';
		}elseif( theratio_get_option('portfolio_style') == "style3" ) {
			$portfolio_option_class[] = 'style-3';
		}else{
			$portfolio_option_class[] = 'style-1';
		}

	    // return the $classes array
	    echo implode( ' ', $portfolio_option_class );
	}
endif;

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function theratio_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'theratio_pingback_header' );

//Get layout post & page.
if ( ! function_exists( 'theratio_get_layout' ) ) :
	function theratio_get_layout() {
		// Get layout.
		if ( is_page() && !is_home() && function_exists( 'rwmb_meta' ) ) {
			$page_layout = rwmb_meta( 'page_layout' );
		} elseif ( is_single() ) {
			$page_layout = theratio_get_option( 'single_post_layout' );
		} else {
			$page_layout = theratio_get_option( 'blog_layout' );
		}

		return $page_layout;
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'theratio_content_columns' ) ) :
	function theratio_content_columns() {

		$blog_content_width = array();

		// Check if layout is one column.
		if ( 'content-sidebar' === theratio_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
		}elseif ('sidebar-content' === theratio_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right';
		}else{
			$blog_content_width[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
		}

		// return the $classes array
    	echo implode( ' ', $blog_content_width );
	}
endif;

/* Select blog style */
if ( ! function_exists( 'theratio_blog_style' ) ) :
	function theratio_blog_style() {

		$blog_style = array();

		// Check if layout is one column.
		if ( theratio_get_option( 'blog_style' ) === 'grid' ) {
			$blog_style[] = 'blog-grid';
			$blog_style[] = theratio_get_option( 'blog_columns' );
		} else {
			$blog_style[] = 'blog-list';
		}

		// return the $classes array
    	echo implode( ' ', $blog_style );
	}
endif;

/**
 * Change Posts Per Page for Portfolio Archive.
 * 
 * @param object $query data
 *
 */
function theratio_change_portfolio_posts_per_page( $query ) {
	$portfolio_ppp = ( !empty( theratio_get_option('portfolio_posts_per_page') ) ? theratio_get_option('portfolio_posts_per_page') : '6');

	if ( !is_singular() && !is_admin() ) {		
	    if ( $query->is_post_type_archive( 'ot_portfolio' ) || $query->is_tax('portfolio_cat') && ! is_admin() && $query->is_main_query() ) {
	        $query->set( 'posts_per_page', $portfolio_ppp );
	    }
	}
    return $query;
}
add_filter( 'pre_get_posts', 'theratio_change_portfolio_posts_per_page' );

/**
 * Load More Ajax Portfolio
 */
add_action( 'wp_enqueue_scripts', 'theratio_script_and_styles', 1 );
function theratio_script_and_styles() {
	global $wp_query;

	// register our main script but do not enqueue it yet
	wp_register_script( 'theratio_scripts', get_template_directory_uri() . '/js/myloadmore.js', array('jquery'), time() );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'theratio_scripts', 'theratio_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
	) );

 	wp_enqueue_script( 'theratio_scripts' );
}

add_action('wp_ajax_loadmore', 'theratio_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'theratio_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

function theratio_loadmore_ajax_handler() {
	$offset  = ( isset($_POST['offset']) ) ? $_POST['offset'] : 0;
	$cat     = ( isset($_POST['cat']) ) ? $_POST['cat'] : 0;
	$ppp     = ( isset($_POST['ppp']) ) ? $_POST['ppp'] : 3;
	$style   = ( isset($_POST['style']) ) ? $_POST['style'] : 'grid';
	if ( $_POST['cat'] != '' ) {
		$args = array(
			'post_type' 	 => 'ot_portfolio',
			'posts_per_page' => $ppp,
			'offset'         => $offset,
			'post_status' 		=> 'publish',
			'tax_query' 	 => array(
				array(
					'taxonomy' 	=> 'portfolio_cat',
					'field' 	=> 'term_id',
					'terms' 	=> explode(",",$cat),
				),
			), 
		);
	} else {
		$args = array(
			'post_type' 	 => 'ot_portfolio',
			'posts_per_page' => $ppp,
			'offset'         => $offset,
			'post_status' 		=> 'publish',
		);
	}

	$wp_query = new \WP_Query($args);
		while ( $wp_query -> have_posts() ) : $wp_query -> the_post();
			if ( $style == 'grid' ) {
				get_template_part( 'template-parts/content', 'project' );
			} else {
				get_template_part( 'template-parts/content', 'project2' );
			}
		endwhile; 

	die;
}

/**
 * Back-To-Top on Footer
 */
if( !function_exists('theratio_custom_back_to_top') ) {
    function theratio_custom_back_to_top() {     
	    if( theratio_get_option('backtotop') != false ){
	    	echo '<a id="back-to-top" href="#" class="show"><i class="ot-flaticon-left-arrow"></i></a>';
	    }
    }
}
add_action('wp_footer', 'theratio_custom_back_to_top');


/**
 * Google Analytics
 */
if ( ! function_exists( 'theratio_hook_javascript' ) ) {
	function theratio_hook_javascript() {
		if ( theratio_get_option('js_code') != '' ) {	    	    	
	        echo theratio_get_option('js_code'); 	        	    
	    }
	}
}
add_action('wp_head', 'theratio_hook_javascript');

// [oceanthemes_date time_custom="F j, Y"]
function oceanthemes_date_func( $atts ) {
    $date_format = shortcode_atts( array(
        'time_custom' => 'Y',        
    ), $atts );

    $dt = new DateTime("now");
    $gmt_timestamp = $dt->format("{$date_format['time_custom']}");

    return $gmt_timestamp;
}
add_shortcode( 'oceanthemes_date', 'oceanthemes_date_func' );