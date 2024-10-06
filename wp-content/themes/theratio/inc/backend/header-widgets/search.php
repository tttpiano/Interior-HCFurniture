<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Search
 */
class Theratio_Search extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'isearch';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Search Button', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-search';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio_header' ];
	}

	protected function register_controls() {
		
		/*** Style ***/
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .toggle_search i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .toggle_search i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// $this->start_controls_section(
		// 	'style_form_section',
		// 	[
		// 		'label' => __( 'Form', 'theratio' ),
		// 		'tab'   => Controls_Manager::TAB_STYLE,
		// 	]
		// );
		// $this->add_control(
		// 	'bg_form_color',
		// 	[
		// 		'label' => __( 'Background Color', 'theratio' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => '',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .h-search-form-inner' => 'background: {{VALUE}};',
		// 		]
		// 	]
		// );
		// $this->add_control(
		// 	'text_form_color',
		// 	[
		// 		'label' => __( 'Text Color', 'theratio' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => '',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .h-search-form-inner input, {{WRAPPER}} .h-search-form-inner button, {{WRAPPER}} .h-search-form-inner ::placeholder' => 'color: {{VALUE}};',
		// 		]
		// 	]
		// );
		// $this->add_control(
		// 	'border_input_color',
		// 	[
		// 		'label' => __( 'Border Input Color', 'theratio' ),
		// 		'type' => Controls_Manager::COLOR,
		// 		'default' => '',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .h-search-form-inner input' => 'border-color: {{VALUE}};',
		// 		]
		// 	]
		// );
		// $this->add_responsive_control(
		// 	'form_width',
		// 	[
		// 		'label' => __( 'Width', 'theratio' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 200,
		// 				'max' => 500,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .h-search-form-field' => 'width: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );
		// $this->add_responsive_control(
		// 	'form_top',
		// 	[
		// 		'label' => __( 'Top', 'theratio' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => -10,
		// 				'max' => 10,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .h-search-form-field' => 'top: calc(100% + {{SIZE}}{{UNIT}});',
		// 		],
		// 	]
		// );

		// $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			
	    	<div class="octf-search octf-cta-header">
				<div class="toggle_search octf-cta-icons">
					<i class="ot-flaticon-search"></i>
				</div>
				<!-- Form Search on Header -->
				<div class="h-search-form-field">
					<div class="h-search-form-inner">
						<?php get_search_form(); ?>
					</div>									
				</div>
			</div>
		    
	    <?php
	}

}
// After the Theratio_Search class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Search() );