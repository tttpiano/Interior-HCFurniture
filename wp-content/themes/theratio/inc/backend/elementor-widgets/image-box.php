<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Theratio Image Category
 */
class Theratio_Image_Box extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'imagecategory';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Image Box', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-image-rollover';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image Box', 'theratio' ),
			]
		);

		$this->add_control(
	       'icon_image',
	        [
	            'label' => esc_html__( 'Photo', 'theratio' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
			  	],
		    ]
	    );
	    $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'icon_image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);
	   
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Office Spaces', 'theratio' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'number',
			[
				'label' => 'Number',
				'type' => Controls_Manager::TEXT,
				'default' => __( '01', 'theratio' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theratio' ),
				'default'	=> []
			]
		);

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'style_color_content',
			[
				'label' => __( 'Color Content', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_color_content' );
		$this->start_controls_tab(
			'tab_color_normal',
			[
				'label' => __( 'Normal', 'theratio' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cate-lines h2' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Number', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cate-lines .number-stroke' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'line_color',
			[
				'label' => __( 'Line', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cate-lines:before, {{WRAPPER}} .cate-lines:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_color_hover',
			[
				'label' => __( 'Hover', 'theratio' ),
			]
		);

		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cate-lines:hover h2' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'number_hcolor',
			[
				'label' => __( 'Number', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cate-lines:hover .number-stroke' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'line_hcolor',
			[
				'label' => __( 'Line', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cate-lines:hover:before, {{WRAPPER}} .cate-lines:hover:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'style_typo_content',
			[
				'label' => __( 'Typography', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .cate-lines h2',
			]
		);

		//Number
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .cate-lines .number-stroke',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}
		$link_attributes = $this->get_render_attribute_string( 'link' );
		?>
		<div class="cate-lines">
			<div class="cate-item">
				<?php if( ! empty( $settings['link']['url'] ) ){ ?><a <?php echo $link_attributes; ?>><?php } ?>
				<?php if( $settings['icon_image']['url'] ) { echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'icon_image_size', 'icon_image' ); } ?>
				<?php if( ! empty( $settings['link']['url'] ) ){ ?></a><?php } ?>
		        <div class="cate-item_content">
			        <?php if( ! empty( $settings['link']['url'] ) ){ ?><a <?php echo $link_attributes; ?>><?php } ?>
			        	<h2><?php echo $settings['title']; ?><span class="number-stroke"><?php echo $settings['number']; ?></span></h2>
			        <?php if( ! empty( $settings['link']['url'] ) ){ ?></a><?php } ?>
				</div>
			</div>
	    </div>
	    <?php
	}

}
// After the Theratio_Image_Box class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Image_Box() );