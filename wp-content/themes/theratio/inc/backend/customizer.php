<?php
/**
 * Theme customizer
 *
 * @package Theratio
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Theratio_Customize {
	/**
	 * Customize settings
	 *
	 * @var array
	 */
	protected $config = array();

	/**
	 * The class constructor
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		$this->config = $config;

		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		$this->register();
	}

	/**
	 * Register settings
	 */
	public function register() {

		/**
		 * Add the theme configuration
		 */
		if ( ! empty( $this->config['theme'] ) ) {
			Kirki::add_config(
				$this->config['theme'], array(
					'capability'  => 'edit_theme_options',
					'option_type' => 'theme_mod',
				)
			);
		}

		/**
		 * Add panels
		 */
		if ( ! empty( $this->config['panels'] ) ) {
			foreach ( $this->config['panels'] as $panel => $settings ) {
				Kirki::add_panel( $panel, $settings );
			}
		}

		/**
		 * Add sections
		 */
		if ( ! empty( $this->config['sections'] ) ) {
			foreach ( $this->config['sections'] as $section => $settings ) {
				Kirki::add_section( $section, $settings );
			}
		}

		/**
		 * Add fields
		 */
		if ( ! empty( $this->config['theme'] ) && ! empty( $this->config['fields'] ) ) {
			foreach ( $this->config['fields'] as $name => $settings ) {
				if ( ! isset( $settings['settings'] ) ) {
					$settings['settings'] = $name;
				}

				Kirki::add_field( $this->config['theme'], $settings );
			}
		}
	}

	/**
	 * Get config ID
	 *
	 * @return string
	 */
	public function get_theme() {
		return $this->config['theme'];
	}

	/**
	 * Get customize setting value
	 *
	 * @param string $name
	 *
	 * @return bool|string
	 */
	public function get_option( $name ) {

		$default = $this->get_option_default( $name );

		return get_theme_mod( $name, $default );
	}

	/**
	 * Get default option values
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	public function get_option_default( $name ) {
		if ( ! isset( $this->config['fields'][ $name ] ) ) {
			return false;
		}

		return isset( $this->config['fields'][ $name ]['default'] ) ? $this->config['fields'][ $name ]['default'] : false;
	}
}

/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function theratio_get_option( $name ) {
	global $theratio_customize;

	$value = false;

	if ( class_exists( 'Kirki' ) ) {
		$value = Kirki::get_option( 'theratio', $name );
	} elseif ( ! empty( $theratio_customize ) ) {
		$value = $theratio_customize->get_option( $name );
	}

	return apply_filters( 'theratio_get_option', $value, $name );
}

/**
 * Get default option values
 *
 * @param $name
 *
 * @return mixed
 */
function theratio_get_option_default( $name ) {
	global $theratio_customize;

	if ( empty( $theratio_customize ) ) {
		return false;
	}

	return $theratio_customize->get_option_default( $name );
}

/**
 * Move some default sections to `general` panel that registered by theme
 *
 * @param object $wp_customize
 */
function theratio_customize_modify( $wp_customize ) {
	$wp_customize->get_section( 'title_tagline' )->panel     = 'general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'general';
}

add_action( 'customize_register', 'theratio_customize_modify' );


/**
 * Get customize settings
 *
 * Priority (Order) WordPress Live Customizer default: 
 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @return array
 */
function theratio_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'theratio',
	);

	$panels = array(
		'general'     	  => array(
			'priority' 	  => 5,
			'title'    	  => esc_html__( 'General', 'theratio' ),
		),
        'blog'        	  => array(
			'title'       => esc_html__( 'Blog', 'theratio' ),
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
		),
		'portfolio'           => array(
			'title'       => esc_html__( 'Portfolio', 'theratio' ),
			'priority'    => 10,
			'capability'  => 'edit_theme_options',			
		),
	);

	$sections = array(
		'main_header'     => array(
            'title'       => esc_html__( 'Header', 'theratio' ),
            'description' => '',
            'priority'    => 8,
            'capability'  => 'edit_theme_options',
        ),
		'page_header'     => array(
            'title'       => esc_html__( 'Page Header', 'theratio' ),
            'description' => '',
            'priority'    => 9,
            'capability'  => 'edit_theme_options',
		),
		'footer'          => array(
			'title'       => esc_html__( 'Footer', 'theratio' ),
			'priority'    => 9,
			'capability'  => 'edit_theme_options',
		),
		'blog_page'       => array(
			'title'       => esc_html__( 'Blog Page', 'theratio' ),
			'description' => '',
			'priority'    => 9,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
        'single_post'     => array(
			'title'       => esc_html__( 'Single Post', 'theratio' ),
			'description' => '',
			'priority'    => 9,
			'capability'  => 'edit_theme_options',
			'panel'       => 'blog',
		),
		'portfolio_page'  => array(
			'title'       => esc_html__( 'Archive Page', 'theratio' ),
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'portfolio',			
		),
		'portfolio_post'  => array(
			'title'       => esc_html__( 'Single Page', 'theratio' ),
			'priority'    => 10,
			'capability'  => 'edit_theme_options',
			'panel'       => 'portfolio',			
		),
		'error_404'       => array(
            'title'       => esc_html__( '404', 'theratio' ),
            'description' => '',
            'priority'    => 11,
            'capability'  => 'edit_theme_options',
        ),
		'typography'           => array(
            'title'       => esc_html__( 'Typography', 'theratio' ),
            'description' => '',
            'priority'    => 15,
            'capability'  => 'edit_theme_options',
        ),
        'preload_section'     => array(
			'title'       => esc_attr__( 'Preloader', 'theratio' ),
			'description' => '',
			'priority'    => 22,
			'capability'  => 'edit_theme_options',
		),
		'color_scheme'   => array(
			'title'      => esc_html__( 'Color Scheme', 'theratio' ),
			'priority'   => 200,
			'capability' => 'edit_theme_options',
		),
		'script_code'   => array(
			'title'      => esc_html__( 'Google Analytics(Script Code)', 'theratio' ),
			'priority'   => 210,
			'capability' => 'edit_theme_options',
		),
	);

	$fields = array(
		/* header settings */
		'header_position'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Position', 'theratio' ), 
	 		'description' => esc_attr__( 'Choose the header position on desktop.', 'theratio' ), 
	 		'section'     => 'main_header', 
	 		'default'     => 'header_top', 
	 		'priority'    => 1,
	 		'choices'     => array(
				'header_top' => esc_attr__( 'Header Top', 'theratio' ),
				'header_left' => esc_attr__( 'Header Left', 'theratio' ),
			),
		),
		'width_lheader'   => array(
            'type'     => 'number',
            'label'    => esc_html__( 'Header Width', 'theratio' ), 
            'section'  => 'main_header',
            'priority' => 2,
            'default'  => 340,
            'output'    => array(
                array(
                    'element'  => '.site-header-vertical',
                    'property' => 'width',
                    'units'	   => 'px',
                    'media_query' => '@media (min-width: 1025px)',
                ),
                array(
                    'element'  => '.header-vertical:not(.rtl) .site-content, .header-vertical:not(.rtl) .site-footer',
                    'property' => 'margin-left',
                    'units'	   => 'px',
                    'media_query' => '@media (min-width: 1025px)',
                ),
                array(
                    'element'  => '.header-vertical.rtl .site-content, .header-vertical.rtl .site-footer',
                    'property' => 'margin-right',
                    'units'	   => 'px',
                    'media_query' => '@media (min-width: 1025px)',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'header_position',
                    'operator' => '==',
                    'value'    => 'header_left',
                ),
            ),
        ),
		'header_layout'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Desktop', 'theratio' ), 
	 		'description' => esc_attr__( 'Choose the header on desktop.', 'theratio' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 3,
	 		'placeholder' => esc_attr__( 'Select a header', 'theratio' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'header_fixed'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Header Transparent?', 'theratio' ),
	 		'description' => esc_attr__( 'Enable when your header is transparent.', 'theratio' ), 
            'section'     => 'main_header',
			'default'     => '1',
			'priority'    => 4,
			'active_callback' => array(
                array(
                    'setting'  => 'header_position',
                    'operator' => '==',
                    'value'    => 'header_top',
                ),
            ),
        ),
        'header_mobile'   => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Header Mobile', 'theratio' ), 
	 		'description' => esc_attr__( 'Choose the header on mobile.', 'theratio' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 5,
	 		'placeholder' => esc_attr__( 'Select a header', 'theratio' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
        ),
        'is_sidepanel'    => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Side Panel for all site?', 'theratio' ),
			'section'     => 'main_header',
			'default'     => '1',
			'priority'    => 6,
        ), 
        'sidepanel_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Side Panel', 'theratio' ), 
	 		'description' => esc_attr__( 'Choose the side panel on header.', 'theratio' ), 
	 		'section'     => 'main_header', 
	 		'default'     => '', 
	 		'priority'    => 6,
	 		'placeholder' => esc_attr__( 'Select a panel', 'theratio' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_header_builders', 'posts_per_page' => -1 ) ) : array(),
	 		'active_callback' => array(
                array(
                    'setting'  => 'header_position',
                    'operator' => '==',
                    'value'    => 'header_top',
                ),
                array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
            ),
		),
		'panel_left'     => array(
            'type'        => 'toggle',
			'label'       => esc_html__( 'Side Panel On Left', 'theratio' ),
            'section'     => 'main_header',
			'default'     => '0',
			'priority'    => 7,
			'active_callback' => array(
                array(
                    'setting'  => 'header_position',
                    'operator' => '==',
                    'value'    => 'header_top',
                ),
                array(
					'setting'  => 'is_sidepanel',
					'operator' => '!=',
					'value'    => '',
				),
                array(
					'setting'  => 'sidepanel_layout',
					'operator' => '!=',
					'value'    => '',
				),
            ),
		),
		/*page header */
        'pheader_switch'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Page Header On/Off', 'theratio' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
        ),
        'breadcrumbs'     => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Breadcrumbs On/Off', 'theratio' ),
            'section'     => 'page_header',
            'default'     => 1,
            'priority'    => 10,
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_align'    => array(
            'type'     => 'radio',
            'label'    => esc_html__( 'Text Align', 'theratio' ),
            'section'  => 'page_header',
            'default'  => 'text-center',
            'priority' => 10,
            'choices'     => array(
                'text-center'   => esc_html__( 'Center', 'theratio' ),
                'text-left'     => esc_html__( 'Left', 'theratio' ),
                'text-right'    => esc_html__( 'Right', 'theratio' ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_img'  => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Background Image', 'theratio' ),
            'section'  => 'page_header',
            'default'  => get_template_directory_uri() . '/images/bg-pheader.jpg',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-image'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'theratio' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-header',
                    'property' => 'background-color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'ptitle_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'theratio' ),
            'section'  => 'page_header',
            'default'  => '',
            'priority' => 10,
            'output'    => array(
                array(
                    'element'  => '.page-title, .page-header, .page-header .breadcrumbs li a, .page-header .breadcrumbs li:before',
                    'property' => 'color'
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'pheader_height'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Page Header Height', 'theratio' ),
            'section'  => 'page_header',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'theratio' ),
                'tablet'  => esc_attr__( 'Tablet', 'theratio' ),
                'mobile'  => esc_attr__( 'Mobile', 'theratio' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header',
                    'property'    => 'height',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header',
                    'property'    => 'height',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header',
                    'property'    => 'height',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),
        'head_size'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Page Title Size', 'theratio' ),
            'section'  => 'page_header',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'theratio' ),
                'tablet'  => esc_attr__( 'Tablet', 'theratio' ),
                'mobile'  => esc_attr__( 'Mobile', 'theratio' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '.page-header .page-title',
                    'property'    => 'font-size',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
		),
		'pheader_htmltag'    => array(
            'type'     => 'select',
            'label'    => esc_html__( 'Page Title HTML Tag', 'theratio' ),
            'section'  => 'page_header',
            'default'     => 'h1',
            'priority' => 10,            
			'placeholder' => esc_html__( 'Choose an html tag', 'theratio' ),
			'choices'     => array(
				'h1' => esc_html__( 'H1', 'theratio' ),
				'h2' => esc_html__( 'H2', 'theratio' ),
				'h3' => esc_html__( 'H3', 'theratio' ),
				'h4' => esc_html__( 'H4', 'theratio' ),
				'h5' => esc_html__( 'H5', 'theratio' ),
				'h6' => esc_html__( 'H6', 'theratio' ),
				'span' => esc_html__( 'SPAN', 'theratio' ),
				'p' => esc_html__( 'P', 'theratio' ),
				'div' => esc_html__( 'DIV', 'theratio' ),				
			),
            'active_callback' => array(
                array(
                    'setting'  => 'pheader_switch',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

		/* footer settings */
		'footer_layout'     => array(
			'type'        => 'select',  
	 		'label'       => esc_attr__( 'Select Footer', 'theratio' ), 
	 		'description' => esc_attr__( 'Choose a footer for all site here.', 'theratio' ), 
	 		'section'     => 'footer', 
	 		'default'     => '', 
	 		'priority'    => 1,
	 		'placeholder' => esc_attr__( 'Select a footer', 'theratio' ), 
	 		'choices'     => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_posts( array( 'post_type' => 'ot_footer_builders', 'posts_per_page' => -1 ) ) : array(),
		),
		'backtotop_separator'     => array(
			'type'        => 'custom',
			'label'       => '',
			'section'     => 'footer',
			'default'     => '<hr>',
			'priority'    => 2,
		),
		'backtotop'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Back To Top On/Off?', 'theratio' ),
            'section'     => 'footer',
            'default'     => 1,
            'priority'    => 3,
        ),
        'bg_backtotop'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'theratio' ),
            'section'  => 'footer',
            'priority' => 4,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '#back-to-top',
                    'property' => 'background',
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'color_backtotop' => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Color', 'theratio' ),
            'section'  => 'footer',
            'priority' => 5,
            'default'     => '',
            'output'    => array(
                array(
                    'element'  => '#back-to-top > i:before',
                    'property' => 'color',
                )
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
        ),
        'spacing_backtotop' => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Spacing', 'theratio' ),
            'section'  => 'footer',
            'priority' => 6,
            'default'     => array(
				'bottom'  => '',
				'right' => '',
			),
			'choices'     => array(
				'labels' => array(
					'bottom'  => esc_html__( 'Bottom (Ex: 20px)', 'theratio' ),
					'right'   => esc_html__( 'Right (Ex: 20px)', 'theratio' ),
				),
			),
            'output'    => array(
                array(
                    'choice'      => 'bottom',
                    'element'     => '#back-to-top.show',
                    'property'    => 'bottom',
                ),
                array(
                    'choice'      => 'right',
                    'element'     => '#back-to-top.show',
                    'property'    => 'right',
                ),
            ),
            'active_callback' => array(
				array(
					'setting'  => 'backtotop',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		/* blog settings */
		'blog_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Blog Layout', 'theratio' ),
			'section'     => 'blog_page',
			'default'     => 'content-sidebar',
			'priority'    => 7,
			'description' => esc_html__( 'Select default sidebar for the blog page.', 'theratio' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),	
		'blog_style'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Blog Style', 'theratio' ),
			'section'     => 'blog_page',
			'default'     => 'list',
			'priority'    => 8,
			'description' => esc_html__( 'Select style default for the blog page.', 'theratio' ),
			'choices'     => array(
				'list' => esc_attr__( 'Blog List', 'theratio' ),
				'grid' => esc_attr__( 'Blog Grid', 'theratio' ),
			),
		),
		'blog_columns'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Blog Columns', 'theratio' ),
			'section'     => 'blog_page',
			'default'     => 'pf_2_cols',
			'priority'    => 8,
			'description' => esc_html__( 'Select columns default for the blog page.', 'theratio' ),
			'choices'     => array(
				'pf_2_cols' => esc_attr__( '2 Columns', 'theratio' ),
				'pf_3_cols' => esc_attr__( '3 Columns', 'theratio' ),
				'pf_4_cols' => esc_attr__( '4 Columns', 'theratio' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'blog_style',
					'operator' => '==',
					'value'    => 'grid',
				),
			),
		),
		'post_entry_meta'              => array(
            'type'     => 'multicheck',
            'label'    => esc_html__( 'Entry Meta', 'theratio' ),
            'section'  => 'blog_page',
            'default'  => array( 'author', 'date', 'comm' ),
            'choices'  => array(
                'author'  => esc_html__( 'Author', 'theratio' ),
                'date'    => esc_html__( 'Date', 'theratio' ),
                'comm'     => esc_html__( 'Comments', 'theratio' ),
            ),
            'priority' => 9,
        ),
        'blog_read_more'      => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Details Button', 'theratio' ),
			'section'         => 'blog_page',
			'default'         => esc_html__( 'READ MORE', 'theratio' ),
			'priority'        => 10,
		),
        /* single blog */
        'single_post_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Layout', 'theratio' ),
            'section'     => 'single_post',
            'default'     => 'content-sidebar',
            'priority'    => 10,
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'ptitle_post'               => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Page Title', 'theratio' ),
			'section'         => 'single_post',
			'default'         => esc_html__( 'Blog Single', 'theratio' ),
			'priority'        => 10,
		),
        'single_separator1'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Social Share', 'theratio' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'post_socials'              => array(
            'type'     => 'multicheck',
            'section'  => 'single_post',
            'default'  => array( 'twitter', 'facebook', 'pinterest', 'linkedin' ),
            'choices'  => array(
                'twit'  	=> esc_html__( 'Twitter', 'theratio' ),
                'face'    	=> esc_html__( 'Facebook', 'theratio' ),
                'pint'     	=> esc_html__( 'Pinterest', 'theratio' ),
                'link'     	=> esc_html__( 'Linkedin', 'theratio' ),
                'google'  	=> esc_html__( 'Google Plus', 'theratio' ),
                'tumblr'    => esc_html__( 'Tumblr', 'theratio' ),
                'reddit'    => esc_html__( 'Reddit', 'theratio' ),
                'vk'     	=> esc_html__( 'VK', 'theratio' ),
            ),
            'priority' => 10,
        ),
        'single_separator2'     => array(
			'type'        => 'custom',
			'label'       => esc_html__( 'Entry Footer', 'theratio' ),
			'section'     => 'single_post',
			'default'     => '<hr>',
			'priority'    => 10,
		),
        'author_box'      => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Author Info Box', 'theratio' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'post_nav'     	  => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Post Navigation', 'theratio' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		'related_post'    => array(
			'type'        => 'checkbox',
			'label'       => esc_attr__( 'Related Posts', 'theratio' ),
			'section'     => 'single_post',
			'default'     => true,
			'priority'    => 10,
		),
		/* project settings */
		'portfolio_archive'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Archive', 'theratio' ),
			'section'     => 'portfolio_page',
			'default'     => 'archive_default',
			'priority'    => 1,
			'description' => esc_html__( 'Select page default for the portfolio archive page.', 'theratio' ),
			'choices'     => array(
				'archive_default' => esc_attr__( 'Archive page default', 'theratio' ),
				'archive_custom' => esc_attr__( 'Archive page custom', 'theratio' ),
			),
		),
		'archive_page_custom'     => array(
			'type'        => 'dropdown-pages',  
	 		'label'       => esc_attr__( 'Select Page', 'theratio' ), 
	 		'description' => esc_attr__( 'Choose a custom page for archive portfolio page.', 'theratio' ), 
	 		'section'     => 'portfolio_page', 
	 		'default'     => '', 
	 		'priority'    => 2,	 		
	 		'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_custom',
				),
			),
		),
		'portfolio_column'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Columns', 'theratio' ),
			'section'     => 'portfolio_page',
			'default'     => '3cl',
			'priority'    => 3,
			'description' => esc_html__( 'Select default column for the portfolio page.', 'theratio' ),
			'choices'     => array(
				'2cl' => esc_attr__( '2 Column', 'theratio' ),
				'3cl' => esc_attr__( '3 Column', 'theratio' ),
				'4cl' => esc_attr__( '4 Column', 'theratio' ),
				'5cl' => esc_attr__( '5 Column', 'theratio' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'portfolio_style'           => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Hover Style', 'theratio' ),
			'section'     => 'portfolio_page',
			'default'     => 'style1',
			'priority'    => 4,
			'description' => esc_html__( 'Select default style for the portfolio page.', 'theratio' ),
			'choices'     => array(
				'style1' => esc_attr__( 'Background Overlay', 'theratio' ),
				'style2' => esc_attr__( 'Background Solid', 'theratio' ),
				'style3' => esc_attr__( 'Under Image', 'theratio' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'portfolio_posts_per_page' => array(
			'type'        => 'number',
			'section'     => 'portfolio_page',
			'priority'    => 5,
			'label'       => esc_html__( 'Posts per page', 'theratio' ),			
			'description' => esc_html__( 'Change Posts Per Page for Portfolio Archive, Taxonomy.', 'theratio' ),
			'default'     => '',
			'active_callback' => array(
				array(
					'setting'  => 'portfolio_archive',
					'operator' => '==',
					'value'    => 'archive_default',
				),
			),
		),
		'pf_nav'     	  => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Projects Navigation On/Off', 'theratio' ),
			'section'     => 'portfolio_post',
			'default'     => 1,
			'priority'    => 7,
		),
		'pf_related_switch'     => array(
			'type'        => 'toggle',
			'label'       => esc_attr__( 'Related Projects On/Off', 'theratio' ),
			'section'     => 'portfolio_post',
			'default'     => 1,
			'priority'    => 7,
		),
		'pf_related_text'      => array(
			'type'            => 'text',
			'label'           => esc_html__( 'Related Projects Heading', 'theratio' ),
			'section'         => 'portfolio_post',
			'default'         => esc_html__( 'Related Projects', 'theratio' ),
			'priority'        => 7,
			'active_callback' => array(
				array(
					'setting'  => 'pf_related_switch',
					'operator' => '==',
					'value'    => 1,
				),
			),
		),
		/* 404 */
		'page_404'   	  => array(
			'type'        => 'dropdown-pages',  
	 		'label'       => esc_attr__( 'Select Page', 'theratio' ), 
	 		'description' => esc_attr__( 'Choose a custom page for page 404.', 'theratio' ), 
	 		'section'     => 'error_404', 
	 		'placeholder' => esc_attr__( 'Select a panel', 'theratio' ),
	 		'default'     => '', 
			'priority'    => 3,
		),
		// Typography
        'body_typo'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font 1', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
                'color'			 => '#555555'
            ),
            'output'      => array(
                array(
                    'element' => 'body, .elementor-element .elementor-widget-text-editor, .elementor-element .elementor-widget-icon-list .elementor-icon-list-item',
                ),
            ),
        ),
        'second_font'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font 2', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'  	 => '',
            ),
        ),
        'third_font'    => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Body Font 3', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'  	 => '',
            ),
        ),
        'heading1_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 1', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
                'color'			 => '#1a1a1a'
            ),
            'output'      => array(
                array(
                    'element' => 'h1, .elementor-widget.elementor-widget-heading h1.elementor-heading-title',
                ),
            ),
        ),
        'heading2_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 2', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
                'color'			 => '#1a1a1a'
            ),
            'output'      => array(
                array(
                    'element' => 'h2, .elementor-widget.elementor-widget-heading h2.elementor-heading-title',
                ),
            ),
        ),
        'heading3_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 3', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
                'color'			 => '#1a1a1a'
            ),
            'output'      => array(
                array(
                    'element' => 'h3, .elementor-widget.elementor-widget-heading h3.elementor-heading-title',
                ),
            ),
        ),
        'heading4_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 4', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
                'color'			 => '#1a1a1a'
            ),
            'output'      => array(
                array(
                    'element' => 'h4, .elementor-widget.elementor-widget-heading h4.elementor-heading-title',
                ),
            ),
        ),
        'heading5_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 5', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
                'color'			 => '#1a1a1a'
            ),
            'output'      => array(
                array(
                    'element' => 'h5, .elementor-widget.elementor-widget-heading h5.elementor-heading-title',
                ),
            ),
        ),
        'heading6_typo'                           => array(
            'type'     => 'typography',
            'label'    => esc_html__( 'Heading 6', 'theratio' ),
            'section'  => 'typography',
            'priority' => 10,
            'default'  => array(
                'font-family'    => '',
                'variant'        => '',
                'font-size'      => '',
                'line-height'    => '',
                'letter-spacing' => '',
                'text-transform' => '',
                'color'			 => '#1a1a1a'
            ),
            'output'      => array(
                array(
                    'element' => 'h6, .elementor-widget.elementor-widget-heading h6.elementor-heading-title',
                ),
            ),
        ),
        // Preloader Setting
        'preload'     => array(
            'type'        => 'toggle',
            'label'       => esc_attr__( 'Preloader', 'theratio' ),
            'section'     => 'preload_section',
            'default'     => '1',
            'priority'    => 10,
        ),
        'preload_mode'    => array(
			'type'        => 'select',			
			'label'       => esc_html__( 'Preload Mode', 'theratio' ),
			'section'     => 'preload_section',
			'default'     => 'progress',
			'placeholder' => esc_html__( 'Select an option...', 'theratio' ),
			'priority'    => 10,
			'multiple'    => 1,
			'choices'     => array(
				'progress' 		=> esc_html__( 'Progress Mode', 'theratio' ),
				'logo' 			=> esc_html__( 'Logo Mode', 'theratio' ),
				'scale_text' 	=> esc_html__( 'Scale Text Mode', 'theratio' ),
			),
			'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
		),
		'preload_text'    => array(
			'type'     => 'text',
			'label'    => esc_html__( 'Preload Text', 'theratio' ),
			'section'  => 'preload_section',
			'default'  => esc_html__( 'Theratio - Architecture & Interior Design', 'theratio' ),
			'priority' => 10,
			'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'preload_mode',
                    'operator' => '==',
                    'value'    => 'scale_text',
                ),
            ),
		),
		'preload_text_size'  => array(
            'type'     => 'dimensions',
            'label'    => esc_html__( 'Preload Text Size', 'theratio' ),
            'section'  => 'preload_section',
            'transport' => 'auto',
            'priority' => 10,
            'choices'   => array(
                'desktop' => esc_attr__( 'Desktop', 'theratio' ),
                'tablet'  => esc_attr__( 'Tablet', 'theratio' ),
                'mobile'  => esc_attr__( 'Mobile', 'theratio' ),
            ),
            'output'   => array(
                array(
                    'choice'      => 'mobile',
                    'element'     => '#royal_preloader.royal_preloader_scale_text .royal_preloader_loader',
                    'property'    => 'font-size',
                    'media_query' => '@media (max-width: 767px)',
                ),
                array(
                    'choice'      => 'tablet',
                    'element'     => '#royal_preloader.royal_preloader_scale_text .royal_preloader_loader',
                    'property'    => 'font-size',
                    'media_query' => '@media (min-width: 768px) and (max-width: 1024px)',
                ),
                array(
                    'choice'      => 'desktop',
                    'element'     => '#royal_preloader.royal_preloader_scale_text .royal_preloader_loader',
                    'property'    => 'font-size',
                    'media_query' => '@media (min-width: 1024px)',
                ),
            ),
            'default' => array(
                'desktop' => '',
                'tablet'  => '',
                'mobile'  => '',
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'preload_mode',
                    'operator' => '==',
                    'value'    => 'scale_text',
                ),
            ),
        ),
		'preload_logo'    => array(
            'type'     => 'image',
            'label'    => esc_html__( 'Logo Preload', 'theratio' ),
            'section'  => 'preload_section',
            'default'  => trailingslashit( get_template_directory_uri() ) . 'images/logo-dark.svg',
            'priority' => 11,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'preload_mode',
                    'operator' => '==',
                    'value'    => 'logo',
                ),
            ),
        ),
        'preload_logo_width'     => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Width', 'theratio' ),
            'section'  => 'preload_section',
            'default'  => 155,
            'priority' => 12,
            'choices'   => array(
                'min'  => 0,
                'max'  => 400,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'preload_mode',
                    'operator' => '==',
                    'value'    => 'logo',
                ),
            ),
        ),
        'preload_logo_height'    => array(
            'type'     => 'slider',
            'label'    => esc_html__( 'Logo Height', 'theratio' ),
            'section'  => 'preload_section',
            'default'  => 48,
            'priority' => 13,
            'choices'   => array(
                'min'  => 0,
                'max'  => 200,
                'step' => 1,
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'preload_mode',
                    'operator' => '==',
                    'value'    => 'logo',
                ),
            ),
        ),
        'preload_txtcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Text Color', 'theratio' ),
            'section'  => 'preload_section',
            'default'  => '#222',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'preload_mode',
                    'operator' => '!==',
                    'value'    => 'progress',
                ),
            ),
        ),
        'preload_bgcolor'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Color', 'theratio' ),
            'section'  => 'preload_section',
            'default'  => '#1a1a1a',
            'priority' => 14,
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
            'output'      => array(
                array(
                    'element' => 'body.royal_preloader',
                ),
            ),
        ),
        'preload_progress_color'    => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Progress Bar Color', 'theratio' ),
            'section'  => 'preload_section',
            'priority' => 15,
            'output'      => array(
                array(
                    'element' => '#royal_preloader.royal_preloader_progress .royal_preloader_meter',
                    'property' => 'background-color',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
                array(
                    'setting'  => 'preload_mode',
                    'operator' => '==',
                    'value'    => 'progress',
                ),
            ),
        ),
        'preload_typo' => array(
            'type'        => 'typography',
            'label'       => esc_attr__( 'Percent Number Font / Scale Text', 'theratio' ),
            'section'     => 'preload_section',
            'default'     => array(
                'font-family'    => 'Josefin Sans',
                'variant'        => 'regular',
                'font-size'      => '20px',
                'line-height'    => '40px',
                'letter-spacing' => '0',
                'subsets'        => array( 'latin-ext' ),                
                'color'          => '#9f9e9e',
            ),
            'priority'    => 16,
            'output'      => array(
                array(
                    'element' => '#royal_preloader.royal_preloader_progress .royal_preloader_percentage, #royal_preloader.royal_preloader_logo .royal_preloader_percentage, #royal_preloader.royal_preloader_scale_text .royal_preloader_loader',
                ),
            ),
            'active_callback' => array(
                array(
                    'setting'  => 'preload',
                    'operator' => '==',
                    'value'    => 1,
                ),
            ),
        ),

		/*color scheme*/
		'dark_light'  => array(
            'type'        => 'toggle',
            'label'       => esc_html__( 'Version Dark', 'theratio' ),
            'section'     => 'color_scheme',
            'default'     => '',
            'priority'    => 3,
        ),
        'bg_body'      => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Background Body', 'theratio' ),
            'section'  => 'color_scheme',
            'default'  => '',
            'priority' => 10,
            'output'   => array(
                array(
                    'element'  => 'body, .site-content',
                    'property' => 'background-color',
                ),
            ),
        ),
        'main_color'   => array(
            'type'     => 'color',
            'label'    => esc_html__( 'Primary Color', 'theratio' ),
            'section'  => 'color_scheme',
            'default'  => '#9f9e9e',
            'priority' => 10,
        ),
        /*google atlantic*/
        'js_code'  => array(
            'type'        => 'code',
            'label'       => esc_html__( 'Code', 'theratio' ),
            'section'     => 'script_code',
            'choices'     => [
				'language' => 'js',
			],
            'priority'    => 3,
        ),
	);
	$settings['panels']   = apply_filters( 'theratio_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'theratio_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'theratio_customize_fields', $fields );

	return $settings;
}

$theratio_customize = new Theratio_Customize( theratio_customize_settings() );