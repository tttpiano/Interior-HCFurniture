<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Menu
 */
class Theratio_Menu extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'imenu';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Menu', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Menu', 'theratio' ),
			]
		);

		$menus = $this->get_available_menus();
		$this->add_control(
			'nav_menu',
			[
				'label' => esc_html__( 'Select Menu', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'multiple' => false,
				'options' => $menus,
				'default' => array_keys( $menus )[0],
				'save_default' => true,

			]
		);
		$this->add_control(
			'layout_menu',
			[
				'label' => __( 'Layout', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'theratio' ),
					'vertical' => __( 'Vertical', 'theratio' ),
				],
			]
		);

		$this->end_controls_section();

		/*** Style ***/
		//menu parents
		$this->start_controls_section(
			'style_menu_section',
			[
				'label' => __( 'Menu Parents', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'theratio' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'theratio' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'theratio' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'theratio' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .vertical-main-navigation > ul > li' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'layout_menu' => 'vertical'
				]
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li > a, {{WRAPPER}} .main-navigation ul > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .main-navigation > ul > li > a:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation > ul > li > a, {{WRAPPER}} .vertical-main-navigation > ul > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_hover_color',
			[
				'label' => __( 'Text Hover/Active Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li > a:hover,
					 {{WRAPPER}} .main-navigation ul > li.menu-item-has-children > a:hover:after,
					 {{WRAPPER}} .main-navigation > ul > li.current-menu-item > a, 
					 {{WRAPPER}} .main-navigation > ul > li.current-menu-item > a:after, 
					 {{WRAPPER}} .main-navigation > ul > li.current-menu-ancestor > a,
					 {{WRAPPER}} .main-navigation > ul > li.current-menu-ancestor > a:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .main-navigation > ul > li > a:hover:before,
					 {{WRAPPER}} .main-navigation > ul > li.current-menu-item > a:before,
					 {{WRAPPER}} .main-navigation > ul > li.current-menu-ancestor > a:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation > ul > li > a:hover, {{WRAPPER}} .vertical-main-navigation > ul > li.menu-item-has-children > a:hover:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation > ul > li > a:hover, {{WRAPPER}} .vertical-main-navigation.no-line ul ul li.current-menu-item > a, {{WRAPPER}} .vertical-main-navigation.no-line ul ul li.current-menu-ancestor > a' => 'background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}});',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'selector' => '{{WRAPPER}} .main-navigation ul, {{WRAPPER}} .vertical-main-navigation ul',
			]
		);

		$this->end_controls_section();

		//menu child
		$this->start_controls_section(
			'style_smenu_section',
			[
				'label' => __( 'Dropdown Menus', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'smenu_width',
			[
				'label' => __( 'Width', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul li ul' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .vertical-main-navigation ul li ul' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'smenu_top',
			[
				'label' => __( 'Top', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -10,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul > li:hover > ul' => 'transform: translateY({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .main-navigation ul li ul ul' => 'top: calc(-20px - {{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'layout_menu' => 'horizontal'
				]
			]
		);
		$this->add_control(
			'bg_s_color',
			[
				'label' => __( 'Background Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul' => 'background: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation ul ul' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_s_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul a, {{WRAPPER}} .main-navigation ul ul > li.menu-item-has-children > a:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation ul li li a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'text_s_hover_color',
			[
				'label' => __( 'Text Hover Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-navigation ul ul a:hover, {{WRAPPER}} .main-navigation ul ul li.current-menu-item > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .main-navigation ul ul a:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation ul li li a:hover, {{WRAPPER}} .vertical-main-navigation ul ul li.current-menu-item > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .vertical-main-navigation:not(.no-line) ul li li a:before' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'smenu_typography',
				'selector' => '{{WRAPPER}} .main-navigation ul ul a, {{WRAPPER}} .vertical-main-navigation ul li li a',
			]
		);
		$this->add_control(
			'is_line',
			[
				'label' => __( 'Hover With Line', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theratio' ),
				'label_off' => __( 'Hide', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_menus(){
		$menus = wp_get_nav_menus();
		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
		// $active_mmenu = in_array('ot_mega-menu/ot_mega-menu.php', apply_filters('active_plugins', get_option('active_plugins')));

		if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
		  	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		}
		     
		// multisite 
		if ( is_multisite() ) {
		  	// this plugin is network activated - Mega menu must be network activated 
		  	if ( is_plugin_active_for_network( plugin_basename(__FILE__) ) ) {
		    	$active_mmenu = is_plugin_active_for_network('ot_mega-menu/ot_mega-menu.php') ? true : false; 
		  	// this plugin is locally activated - Mega menu can be network or locally activated 
		  	} else {
		    	$active_mmenu = is_plugin_active( 'ot_mega-menu/ot_mega-menu.php')  ? true : false;   
		  	}
			// this plugin runs on a single site
		} else {
		  	$active_mmenu =  is_plugin_active( 'ot_mega-menu/ot_mega-menu.php') ? true : false;     
		}
		?>
			<?php if( $settings['layout_menu'] == 'vertical' ){ ?>
				<nav class="vertical-main-navigation <?php if(!$settings['is_line']) echo ' no-line'; ?>">			
					<?php
						wp_nav_menu( array(
							'menu' 			 => $settings['nav_menu'],
							'menu_id'        => 'menu-left',
							'container'      => 'ul',
						) );
					?>
				</nav>
			<?php }else{ ?>
		    	<nav id="site-navigation" class="main-navigation <?php if(!$settings['is_line']) echo ' no-line'; ?>">			
					<?php
						wp_nav_menu( array(
							'menu' 			 => $settings['nav_menu'],
							'menu_id'        => 'primary-menu',
							'container'      => 'ul',
							'fallback_cb' 	 => '__return_empty_string',
							'walker'         => $active_mmenu ? new \Ot_Mega_Menu_Walker() : '',
						) );
					?>
				</nav>
		    <?php } ?>
	    <?php
	}

}
// After the Theratio_Menu class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Menu() );