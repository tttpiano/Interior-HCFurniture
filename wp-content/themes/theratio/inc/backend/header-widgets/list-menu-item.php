<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team
 */
class Theratio_List_Menu_Item extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'list_menu_item';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio List Menu', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'List Menu', 'theratio' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __( 'Text', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'List Menu Item', 'theratio' ),
				'default' => __( 'List Menu Item', 'theratio' ),
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'theratio' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'theratio' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'placeholder' => __( 'https://your-link.com', 'theratio' ),
			]
		);

		$this->add_control(
			'menu_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __( 'List Menu Item #1', 'theratio' ),
						'link' => [
							'url' => '#'
						]
					],
					[
						'text' => __( 'List Menu Item #2', 'theratio' ),
						'link' => [
							'url' => '#'
						]
					],
					[
						'text' => __( 'List Menu Item #3', 'theratio' ),
						'link' => [
							'url' => '#'
						]
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_menu_list',
			[
				'label' => __( 'List', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'Space Between', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-menu-item-wrapper ul li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list_menu_align',
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
				'selectors'	=> [
					'{{WRAPPER}} .list-menu-item-wrapper ul ' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-menu-item-wrapper ul li i, {{WRAPPER}} .list-menu-item-wrapper ul li svg' => 'margin-right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .list-menu-item-wrapper ul li i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-menu-item-wrapper ul li svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .list-menu-item-wrapper ul li a:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-menu-item-wrapper ul li a:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-menu-item-wrapper ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .list-menu-item-wrapper ul li svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => __( 'Text', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .list-menu-item-wrapper ul li, {{WRAPPER}} .list-menu-item-wrapper ul li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .list-menu-item-wrapper ul li a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-menu-item-wrapper ul li a:hover:before' => 'background: {{VALUE}};',
				],
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .list-menu-item-wrapper ul li',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		?>
	        <div class="list-menu-item-wrapper">
	        	<ul class="unstyle <?php if(!$settings['is_line']) echo ' no-line'; ?>">
	        		<?php foreach ( $settings['menu_list'] as $key => $item ) : ?>
	        			<li>
	        				<?php
								if ( ! empty( $item['link']['url'] ) ) {
									$link_key = 'link_' . $key;

									$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

									if ( $item['link']['is_external'] ) {
										$this->add_render_attribute( $link_key, 'target', '_blank' );
									}

									if ( $item['link']['nofollow'] ) {
										$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
									}

									echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
								}
								Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
							?>
							<span><?php echo $item['text']; ?></span>
							<?php if ( ! empty( $item['link']['url'] ) ) : ?>
								</a>
							<?php endif; ?>
	        			</li>
	        		<?php endforeach ?>
	        	</ul>
	        </div>
	    <?php
	}

}
// After the Theratio_List_Menu_Item class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_List_Menu_Item() );