<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Image Before After
 */
class Theratio_beforeAfter extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ibeforeafter';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Image Before After', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-image-before-after';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'beforeafter_section',
			[
				'label' => __( 'Image Before After', 'theratio' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image_before',
			[
				'label' => __( 'Image Before', 'theratio' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'image_after',
			[
				'label' => __( 'Image After', 'theratio' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_size',
				'exclude' => [ 
					'1536x1536', 
					'2048x2048', 
					'thumbnail'
				],
				'include' => [],
				'default' => 'full',
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'options_section',
			[
				'label' => __( 'Before After Options', 'theratio' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	
		$this->add_control(
			'before_width',
			[
				'label' 		=> __( 'Image Before Width', 'theratio' ),
				'description' 	=> __( 'Image before width is visible', 'theratio' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'min' 	=> 0.3,
						'max' 	=> 0.9,
						'step' 	=> 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.7,
				],
			]
		);
		$this->add_control(
			'orientation',
			[
				'label' => __( 'Orientation', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' 	=> __( 'Horizontal', 'theratio' ),
					'vertical'      => __( 'Vertical', 'theratio' ),
				]
			]
		);
		$this->add_control(
			'heading_translate',
			[
				'label' => __( 'Translate Text', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'before_text',
			[
				'label' => __( 'Before', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Before', 'theratio' ),
				'placeholder' => __( 'Type your before text here', 'theratio' ),
			]
		);

		$this->add_control(
			'after_text',
			[
				'label' => __( 'After', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'After', 'theratio' ),
				'placeholder' => __( 'Type your after text here', 'theratio' ),
			]
		);
		$this->end_controls_section();

		// Styling.
		$this->start_controls_section(
			'style_tcontent',
			[
				'label' => __( 'General', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color for Text', 'theratio' ),
				'description' 	=> __( 'Set color for before and after text when hover over image.', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_bgcolor',
			[
				'label' => __( 'Background for Text', 'theratio' ),
				'description' 	=> __( 'Set background color for before and after text when hover over image.', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'beforeafter_typography',
				'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
			]
		);
		$this->add_control(
			'heading_mainbox',
			[
				'label' => __( 'Main Box', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'handle_color',
			[
				'label' => __( 'Curtain Handle color', 'theratio' ),
				'description' 	=> __( 'Set color for Curtain Handle when drag and drop.', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-handle' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => 'box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'box-shadow: 0 -3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before' => 'box-shadow: 3px 0 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'box-shadow: -3px 0 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
					'{{WRAPPER}} .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_overlay',
			[
				'label' => __( 'Background Overlay', 'theratio' ),
				'description' 	=> __( 'Set background color overlay when hover over image.', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-overlay:hover' => 'background: {{VALUE}};',
				],
			]
		);		
		$this->add_control(
			'bf_border_radius',
			[
				'label' => __( 'Border Radius', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .twentytwenty-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$before_width = ( !empty( $settings['before_width']['size'] ) ? esc_attr( $settings['before_width']['size'] ) : 0.7);
		$before_text = ( !empty( $settings['before_text'] ) ? esc_attr( $settings['before_text'] ) : 'Before');
		$after_text = ( !empty( $settings['after_text'] ) ? esc_attr( $settings['after_text'] ) : 'After');
		?>
		<div class="image__before-after">
			<div class="twentytwenty-container" data-before="<?php echo $before_text; ?>" data-after="<?php echo $after_text; ?>" data-bsize="<?php echo $before_width; ?>" data-orientation="<?php echo $settings['orientation']; ?>">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image_before' ); ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image_after' ); ?>
			</div>
		</div>		
	    <?php
	}

}
// After the Theratio_beforeAfter class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_beforeAfter() );