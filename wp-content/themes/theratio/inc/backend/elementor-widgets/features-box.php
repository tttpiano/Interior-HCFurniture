<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Theratio Features Box
 */
class Theratio_Features_Box extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ifeaturedbox';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Features Box', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-featured-image';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Features Box', 'theratio' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '<span>01.</span> Quality Furniture', 'theratio' ),
				'label_block' => true,
			]
		);

	    $this->add_control(
	       'features_image',
	        [
	            'label' => esc_html__( 'Photo', 'theratio' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
		    ]
	    );

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'features_image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theratio' ),
				'default'	=> [
					'url'	=> '#'
				],
			]
		);
		$this->add_control(
			'heading_size',
			[
				'label' => __( 'Title HTML Tag', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h6',
			]
		);
		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .features-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'bg_box_content',
				'label' => __( 'Background', 'theratio' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .features-content',
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'	=> [
					'title!'   => ''
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-content .features-box-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .features-content .features-box-title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .features-content .features-box-title:before' => 'background: {{VALUE}};',
				],
				'condition'	=> [
					'title!'   => ''
				]
			]
		);
		
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Number Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-content .features-box-title span' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'title!'   => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .features-content .features-box-title',
				'condition'	=> [
					'title!'   => ''
				]
			]
		);
		$this->add_responsive_control(
			'line_width',
			[
				'label' => __( 'Width Line Title Hover', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .features-content .features-box-title:hover:before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Overlay
		$this->add_control(
			'heading_overlay',
			[
				'label' => __( 'Overlay', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-image .overlay' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'overlay_icon',
			[
				'label' => __( 'Icon Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-image i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'overlay_icon_size',
			[
				'label' => __( 'Icon Size', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .features-image i:before' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$title = $settings['title'];
		$this->add_render_attribute( 'heading', 'class', 'features-box-title' );
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['heading_size'], $this->get_render_attribute_string( 'heading' ), $title );
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'features', $settings['link'] );
			$title_html = sprintf( '<%1$s %2$s><a ' .$this->get_render_attribute_string( 'iconbox' ). '>%3$s</a></%1$s>', $settings['heading_size'], $this->get_render_attribute_string( 'heading' ), $title );
		}
		?>

		<div class="ot-features-box">
			<div class="features-image" id="animated-thumbnials">
				<?php if( ! empty( $settings['link']['url'] ) ){ ?><a <?php echo $this->get_render_attribute_string( 'features' ); ?>><?php } ?>
				<?php if( ! empty( $settings['features_image']['url'] ) ){ ?>
					<span class="overlay flex-middle"><i class="ot-flaticon-add"></i></span>
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'features_image_size', 'features_image' ); ?>
				<?php } ?>
				<?php if( ! empty( $settings['link']['url'] ) ){ ?></a><?php } ?>
				
			</div>
			<?php if( $title ){ ?>
			<div class="features-content">
				<?php echo $title_html; ?>
			</div>
			<?php } ?>
	    </div>

	    <?php
	}

}
// After the Theratio_Features_Box class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Features_Box() );