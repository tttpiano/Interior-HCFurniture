<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Pricing Table
 */
class Theratio_Pricing_Table extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ipricingtable';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Pricing Table', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-price-table';
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
				'label' => __( 'Pricing Table', 'theratio' ),
			]
		);

		$this->add_control(
			'is_featured',
			[
				'label' => __( 'Pricing Table Featured', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theratio' ),
				'label_off' => __( 'No', 'theratio' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Standard', 'theratio' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'theratio' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '<sup>$</sup> 29', 'theratio' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'price_for',
			[
				'label' => __( 'Text Under Price', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'per m2', 'theratio' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'details',
			[
				'label' => 'Details',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '<ul><li class="active">Structure of a project</li><li class="active">Measurement of the room</li><li>3D-Visualization of premises</li></ul>', 'theratio' ),
			]
		);

		$this->add_control(
			'label_link',
			[
				'label' => 'Button',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Choose Plane', 'theratio' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theratio' )
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'style_table_section',
			[
				'label' => __( 'Table', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .inner-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'layerbehind_color',
			[
				'label' => __( 'Layer Behind Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .layer-behind' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .inner-table',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ibox_bg',
				'label' => __( 'Background', 'theratio' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .inner-table',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ibox_box_shadow',
				'selector' => '{{WRAPPER}} .inner-table',
				'separator' => 'before',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-table' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'Background', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-table' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title-table',
			]
		);

		//Price
		$this->add_control(
			'heading_price',
			[
				'label' => __( 'Price', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'price_space',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'price_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table h2' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .ot-pricing-table h2',
			]
		);

		//Under Price
		$this->add_control(
			'heading_price_for',
			[
				'label' => __( 'Under Price', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'price_for_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .inner-table > p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .inner-table > p:before' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_for_typography',
				'selector' => '{{WRAPPER}} .inner-table > p',
			]
		);

		//Details
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Details', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'des_padding',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table .details' => 'padding: {{SIZE}}{{UNIT}} 0;',
				],
			]
		);
		$this->add_control(
			'des_border_color',
			[
				'label' => __( 'Line Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table .details' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'des_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table .details ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'des_active_color',
			[
				'label' => __( 'Active Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table .details ul li.active' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .ot-pricing-table .details',
			]
		);
		$this->add_control(
			'icon_list',
			[
				'label' => __( 'Icon List', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theratio' ),
				'label_off' => __( 'No', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);	

		//Button
		$this->add_control(
			'heading_btn',
			[
				'label' => __( 'Button', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .ot-pricing-table .octf-btn',
			]
		);

		$this->start_controls_tabs( 'tabs_btn_style' );
		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => __( 'Normal', 'theratio' ),
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label' => __( 'Background Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table .octf-btn' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table .octf-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => __( 'Hover', 'theratio' ),
			]
		);
		$this->add_control(
			'hover_btn_bg_color',
			[
				'label' => __( 'Background Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table .octf-btn:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_btn_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-pricing-table .octf-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}
		$this->add_render_attribute( 'button', 'class', 'octf-btn' );

		?>

		<div class="ot-pricing-table <?php if( $settings['is_featured'] ) echo 'is-featured' ?>">
			<div class="layer-behind"></div>
			<div class="inner-table">
				<?php if( $settings['title'] ){ ?><h6 class="title-table"><?php echo esc_html( $settings['title'] ); ?></h6><?php } ?>
				<?php if( $settings['price'] ){ ?><h2><?php echo $settings['price']; ?></h2><?php } ?>
				<?php if( $settings['price_for'] ){ ?><p><?php echo esc_html( $settings['price_for'] ); ?></p><?php } ?>
				<div class="details <?php if( !$settings['icon_list'] ) echo 'no-icon'; ?>"><?php echo $settings['details']; ?></div>
				<?php if( $settings['label_link'] ){ ?><a <?php echo $this->get_render_attribute_string( 'button' ); ?>><?php echo esc_html( $settings['label_link'] ); ?></a><?php } ?>
			</div>
		</div>

	    <?php
	}

}
// After the Theratio_Pricing_Table class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Pricing_Table() );