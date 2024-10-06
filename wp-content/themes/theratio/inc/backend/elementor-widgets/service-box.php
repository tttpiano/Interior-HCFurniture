<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Service Box 
 */
class Theratio_Service_Box extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'theratio-service-box';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Service Box', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-image-box';
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
				'label' => __( 'Content', 'theratio' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'theratio' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
					'justify' => [
						'title' => __( 'Justified', 'theratio' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'theratio' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title & Description', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Interior Design', 'theratio' ),
				'placeholder' => __( 'Enter your title', 'theratio' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Original design project of high quality raises profit – this is proved practice customers.', 'theratio' ),
				'placeholder' => __( 'Enter your description', 'theratio' ),
				'show_label' => false,
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
				'default' => 'h4',
			]
		);
		$this->end_controls_section();

		// Button Service box
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button', 'theratio' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theratio' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Text', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'theratio' ),
				'condition' => [
					'link[url]!' => '',
				]
			]
		);

		$this->add_control(
            'link_title',
            [
                'label' => __('Link Title ?', 'theratio'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'theratio'),
                'label_off' => __('No', 'theratio'),
                'return_value' => 'yes',
                'default' => '',
                'condition' 	=> [
                	'title!' 	=> ''
                ]
            ]
        );

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'section_style_content',
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
					'{{WRAPPER}} .info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'Overlay Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .image-box .overlay' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .img-lgpopup i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'label' => __( 'Icon Background', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .img-lgpopup i' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-box .service-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-box .service-box-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .service-box .service-box-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-box .service-box-title a:hover' => 'color: {{VALUE}};',
				],
				'condition'	 => [
					'link_title' 	=> 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .service-box .service-box-title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'desc_bottom_space',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-box p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-box p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .service-box p',
			]
		);

		$this->end_controls_section();

		//Button Link
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'link[url]!' => '',
					'btn_text!'	 => '',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_btn_typography',
				'selector' => '{{WRAPPER}} .btn-details',
			]
		);

		$this->start_controls_tabs( 'tabs_link_btn_style' );

		$this->start_controls_tab(
			'tab_link_btn_normal',
			[
				'label' => __( 'Normal', 'theratio' ),
			]
		);

		$this->add_control(
			'link_btn_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn-details' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_btn_border_color',
			[
				'label' => __( 'Border Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn-details:before' => 'background: {{VALUE}}; border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_link_btn_hover',
			[
				'label' => __( 'Hover', 'theratio' ),
			]
		);

		$this->add_control(
			'link_btn_hover_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn-details:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_btn_border_color_hover',
			[
				'label' => __( 'Border Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn-details:hover:before' => 'background: {{VALUE}}; border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'heading', 'class', 'service-box-title' );
		$title = $settings['title'];
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['heading_size'], $this->get_render_attribute_string( 'heading' ), $title );

		$has_img = ! empty( $settings['image']['url'] );
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
			
			if( !empty( $settings['link_title'] ) ){
				$title_html = sprintf( '<%1$s %2$s><a ' .$this->get_render_attribute_string( 'link' ). '>%3$s</a></%1$s>', $settings['heading_size'], $this->get_render_attribute_string( 'heading' ), $title );
			}
		}
		$link_attributes = $this->get_render_attribute_string( 'link' );

		?>
		<div class="service-box">
	        <div class="box-content">
	       		<?php if ( $has_img ) : ?>
	       		<div class="image-box img-lgpopup">
	       			<div data-src="<?php echo $settings['image']['url']; ?>"><?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_size', 'image' ); ?>
	       				<span class="overlay"><i class="ot-flaticon-add"></i></span>
	       			</div>
				</div>
				<?php endif; ?>
				<div class="info-box">
					<?php if( $title ) { echo $title_html; } ?>
					<p><?php echo $settings['description']; ?></p>
					<?php if( $settings['btn_text'] && $settings['link'] ) : ?>
						<a class="btn-details" <?php echo $link_attributes; ?>><?php echo $settings['btn_text']; ?></a>
					<?php endif; ?>
				</div>
			</div>
	    </div>
	    <?php
	}

}
// After the Theratio_Service_Box class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Service_Box() );