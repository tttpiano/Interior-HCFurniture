<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Theratio Process
 */
class Theratio_Process extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iprocessbox';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Process Box', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-number-field';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Process', 'theratio' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon_font',
			[
				'label' => __( 'Icon', 'theratio' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

	    $repeater->add_control(
			'number_box',
			[
				'label' => __( 'Box Number', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '01', 'theratio' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Creating a Concept', 'theratio' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'des',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Original design project of high quality raises profit – this is proved in practice by many of our customers. A professional approach will avoid of many common mistakes, minimize the cost of decoration materials and choose the best way to implement your ideas or direct your "runaway" thoughts to one course, forming an integral representation of the idea.', 'theratio' ),
			]
		);
		$this->add_control(
			'ot_process',
			[
				'label' => __( 'Process Items', 'theratio' ),
				'type' => Controls_Manager::REPEATER,
				'show_label'  => true,
				'prevent_empty' => false,
				'default' => [
					[
						'number_box' => __( '01', 'theratio' ),
						'icon_font' => [
							'value' => 'fas fa-star',
							'library' => 'fa-solid',
						],
						'title' => __( 'Creating a Concept', 'theratio' ),
						'tab_content' => __( 'Original design project of high quality raises profit – this is proved in practice by many of our customers. A professional approach will avoid of many common mistakes, minimize the cost of decoration materials and choose the best way to implement your ideas or direct your "runaway" thoughts to one course, forming an integral representation of the idea.', 'theratio' ),
					],
					[
						'number_box' => __( '02', 'theratio' ),
						'icon_font' => [
							'value' => 'fas fa-star',
							'library' => 'fa-solid',
						],
						'title' => __( 'Budget Planning', 'theratio' ),
						'tab_content' => __( 'Original design project of high quality raises profit – this is proved in practice by many of our customers. A professional approach will avoid of many common mistakes, minimize the cost of decoration materials and choose the best way to implement your ideas or direct your "runaway" thoughts to one course, forming an integral representation of the idea.', 'theratio' ),
					],
				],
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{title}}}',
			]
		);
		$this->add_control(
			'display_is_tab',
			[
				'label'   => esc_html__( 'Display is tab', 'theratio' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
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

		//Icon
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'theratio' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .process_nav li .icon-main' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .process_nav li .icon-main i, {{WRAPPER}} .process_nav li .icon-main i:before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .process_nav li .icon-main svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'theratio' ),
			]
		);
		$this->add_control(
			'icon_bgcolor',
			[
				'label' => __( 'Background', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .process_nav li .icon-main' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .process_nav li .icon-main' => 'color: {{VALUE}};',
					'{{WRAPPER}} .process_nav li .icon-main svg' => 'fill: {{VALUE}};'
				]
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover/Active', 'theratio' ),
			]
		);
		$this->add_control(
			'icon_hbgcolor',
			[
				'label' => __( 'Background', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .process_nav li:hover .icon-main, {{WRAPPER}} .process_nav li.current .icon-main' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hcolor',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .process_nav li:hover .icon-main, {{WRAPPER}} .process_nav li.current .icon-main' => 'color: {{VALUE}};',
					'{{WRAPPER}} .process_nav li:hover .icon-main svg, {{WRAPPER}} .process_nav li.current .icon-main svg' => 'fill: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		// Number
		$this->add_control(
			'heading_number',
			[
				'label' => __( 'Number', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .process_nav li .number-stroke' => '-webkit-text-stroke-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .process_nav li .number-stroke',
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
		$this->add_responsive_control(
			'title_space',
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
					'{{WRAPPER}} .process_nav h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .process_nav h5' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .process_nav h5',
			]
		);

		//Description
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Description', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'des_padding',
			[
				'label' => __( 'Padding Box', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .process-des-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .process-des-item' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .process-des-item',
			]
		);

		// Line
		$this->add_control(
			'heading_line',
			[
				'label' => __( 'Line', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'	=> [
					'display_is_tab' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'line_width',
			[
				'label' => __( 'Height', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .process_nav' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .process_nav li:after' => 'height: {{SIZE}}{{UNIT}}; bottom: -{{SIZE}}{{UNIT}}',
				],
				'condition'	=> [
					'display_is_tab' => 'yes'
				]
			]
		);
		$this->add_control(
			'line_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .process_nav' => 'border-color: {{VALUE}};',
				],
				'condition'	=> [
					'display_is_tab' => 'yes'
				]
			]
		);
		$this->add_control(
			'line_hcolor',
			[
				'label' => __( 'Active', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .process_nav li:after' => 'background: {{VALUE}};',
				],
				'condition'	=> [
					'display_is_tab' => 'yes'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="ot-process" <?php if($settings['display_is_tab']){ echo 'data-tab="true"'; } ?>>
			<?php if( $settings['display_is_tab'] ){ ?>
				<?php if ( $settings['ot_process'] ) : ?>
				<ul class="process_nav unstyle">
					<?php 
						foreach ( $settings['ot_process'] as $tabs ) { 
			        	if ( empty( $tabs['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
							// add old default
							$tabs['icon'] = 'fa fa-star';
						}

						if ( ! empty( $tabs['icon'] ) ) {
							$this->add_render_attribute( 'icon', 'class', $tabs['icon'] );
							$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
						}

						$migrated = isset( $tabs['__fa4_migrated']['icon_font'] );
						$is_new = empty( $tabs['icon'] ) && Icons_Manager::is_migration_allowed();	
					?>
					<li>
						<div class="icon-main">
							<span class="dcell">
								<?php if ( $is_new || $migrated ) :
									Icons_Manager::render_icon( $tabs['icon_font'], [ 'aria-hidden' => 'true' ] );
								else : ?>
									<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
								<?php endif; ?>
							</span>
							<span class="number-stroke"><?php echo $tabs['number_box']; ?></span>
						</div>
						<h5><?php echo $tabs['title']; ?></h5>
					</li>
					<?php } ?>
				</ul>
				<div class="process-des">
				<?php foreach ( $settings['ot_process'] as $tabs ) { ?>
				<div class="process-des-item"><?php echo $tabs['des']; ?></div>
				<?php } endif; ?>
				</div>
			<?php }else{ ?>
				<ul class="process_nav unstyle">
					<?php 
					foreach ( $settings['ot_process'] as $tabs ) { 
					if ( empty( $tabs['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
						// add old default
						$tabs['icon'] = 'fa fa-star';
					}

					if ( ! empty( $tabs['icon'] ) ) {
						$this->add_render_attribute( 'icon', 'class', $tabs['icon'] );
						$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
					}

					$migrated = isset( $tabs['__fa4_migrated']['icon_font'] );
					$is_new = empty( $tabs['icon'] ) && Icons_Manager::is_migration_allowed();

					?>
					<li>
						<div class="icon-main">
							<span class="dcell">
								<?php if ( $is_new || $migrated ) :
									Icons_Manager::render_icon( $tabs['icon_font'], [ 'aria-hidden' => 'true' ] );
								else : ?>
									<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
								<?php endif; ?>
							</span>
							<span class="number-stroke"><?php echo $tabs['number_box']; ?></span>
						</div>
						<h5><?php echo $tabs['title']; ?></h5>
						<div class="process-des">
							<p class="process-des-item"><?php echo $tabs['des']; ?></p>
						</div>
					</li>
					<?php } ?>
				</ul>
			<?php } ?>
	    </div>

	    <?php
	}

}
// After the Theratio_Process class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Process() );