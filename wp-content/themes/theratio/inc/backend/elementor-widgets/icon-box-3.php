<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Icon Box 1
 */
class Theratio_IconBox3 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iiconbox3';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Icon Box 3', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-icon-box';
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
				'label' => __( 'Icon Box', 'theratio' ),
			]
		);

		$this->add_control(
			'box_style',
			[
				'label' 	=> __( 'Box Style', 'theratio' ),
				'type'  	=> Controls_Manager::SELECT,
				'default' 	=> 'icon-left',
				'options' 	=> [
					'icon-left'  => __( 'Icon Left', 'theratio' ),
					'icon-right'  => __( 'Icon Right', 'theratio' ),
				]
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __( 'Icon Type', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'class',
				'options' => [
					'font' 	=> __( 'Font Icon', 'theratio' ),
					'image' => __( 'Image Icon', 'theratio' ),
					'class' => __( 'Custom Icon', 'theratio' ),
				]
			]
		);
		$this->add_control(
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
				'condition' => [
					'icon_type' => 'font',
				]
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
			  	'condition' => [
					'icon_type' => 'image',
				]
		    ]
	    );
	    $this->add_control(
			'icon_class',
			[
				'label' => __( 'Custom Class', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'ot-flaticon-diamond', 'theratio' ),
				'condition' => [
					'icon_type' => 'class',
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Professionalism', 'theratio' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'des',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Certified high-class specialists.', 'theratio' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theratio' ),
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
				'default' => 'h5',
			]
		);

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'style_box_section',
			[
				'label' => __( 'Box', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_box_padding',
			[
				'label' => __( 'Padding Box', 'theratio' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => '',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'show_label' => false,
			]
		);

		$this->start_controls_tabs( 'tabs_box_bg_style' );
		$this->start_controls_tab(
			'tab_bg_box_normal',
			[
				'label' => __( 'Normal', 'theratio' ),
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label' => __( 'Background Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .icon-box--bg-color',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_bg_box_hover',
			[
				'label' => __( 'Hover', 'theratio' ),
			]
		);

		$this->add_control(
			'box_bg_color_hover',
			[
				'label' => __( 'Background Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_hover_icon_color',
			[
				'label' => __( 'Icon', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover i, {{WRAPPER}} .icon-box:hover span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-box:hover svg' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'icon_type' => ['font','class']
				]
			]
		);

		$this->add_control(
			'box_hover_title_color',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover h5, {{WRAPPER}} .icon-box:hover h5 a' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'title!'  => '', 
				]
			]
		);

		$this->add_control(
			'box_hover_des_color',
			[
				'label' => __( 'Description', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box:hover p' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'des!'  => '', 
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'selector' => '{{WRAPPER}} .icon-box--bg-color:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-main i, {{WRAPPER}} .icon-main span:before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-main svg' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'icon_type' => ['font','class']
				]
			]
		);
		$this->add_responsive_control(
			'icon_space_left',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 350,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box--bg-color.icon-box--icon-left .content-box' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_style' => 'icon-left'
				]
			]
		);
		$this->add_responsive_control(
			'icon_space_right',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 350,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box--bg-color.icon-box--icon-right .content-box' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'box_style' => 'icon-right'
				]
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-main i, {{WRAPPER}} .icon-main span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-main svg' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'icon_type' => ['font','class']
				]
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
				'condition'	=> [
					'title!'  => '', 
				]
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
					'{{WRAPPER}} .icon-box .icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> [
					'title!'  => '', 
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box .icon-box-title, {{WRAPPER}} .icon-box .icon-box-title a' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'title!'  => '', 
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .icon-box .icon-box-title',
				'condition'	=> [
					'title!'  => '', 
				]
			]
		);

		//Description
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Description', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'	=> [
					'des!'  => '', 
				]
			]
		);
		$this->add_control(
			'des_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box p' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'des!'  => '', 
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .icon-box p',
				'condition'	=> [
					'des!'  => '', 
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'heading', 'class', 'icon-box-title' );
		$title = $settings['title'];
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['heading_size'], $this->get_render_attribute_string( 'heading' ), $title );		
		$link_box = '';
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'linkbox', $settings['link'] );
			$this->add_render_attribute( 'linkbox', 'class', 'link_overlay' );
			$link_box = '<a '. $this->get_render_attribute_string( 'linkbox' ).'></a>';
		}
		if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = 'fa fa-star';
		}

		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
		}

		$migrated = isset( $settings['__fa4_migrated']['icon_font'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		?>
		<div class="icon-box icon-box--bg-color icon-box--<?php echo $settings['box_style'] ?>">
			<div class="icon-main">
		        <?php if ( $settings['icon_type'] == 'font' ) { ?>
		        	<?php if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
					<?php endif; ?>
		        <?php } ?>
			    
			    <?php if ( $settings['icon_type'] == 'image' ) { echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'icon_image' ); } ?>
		        <?php if( $settings['icon_type'] == 'class' ) { ?><span class="<?php echo esc_attr( $settings['icon_class'] ); ?>"></span><?php } ?>
	        </div>
	        <div class="content-box">
	        	<?php if( $title ) { echo $title_html; } ?>
		        <p><?php echo $settings['des']; ?></p>
			</div>
			<?php if( $link_box ) echo $link_box; ?>
	    </div>
	    <?php
	}

}
// After the Theratio_IconBox3 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_IconBox3() );