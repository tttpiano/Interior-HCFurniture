<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Testimonial Slider 3
 */
class Theratio_Testimonials_3 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'itestimonials3';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Testimonial Slider 3', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonials', 'theratio' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'tcontent',
			[
				'label' => __( 'Content', 'theratio' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => '"You will never fake the feeling of being in such a place. The live minimalism base on the natural materials and alive unprocessed textures — true, authentic, close to nature. It has memory and appreciates to the culture, roots, archetypes."',
			]
		);

		$repeater->add_control(
			'timage',
			[
				'label' => __( 'Avatar', 'theratio' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Name', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Pablo Gusterio',
			]
		);

		$repeater->add_control(
			'tjob',
			[
				'label' => __( 'Job', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Client of Company',
			]
		);

		$this->add_control(
		    'testi_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'prevent_empty' => false,
		        'default'     => [
		            [
		             	'tcontent' => __( '"You will never fake the feeling of being in such a place. The live minimalism base on the natural materials & alive unprocessed."', 'theratio' ),
						'tname'	  => 'Anna Paulina',
						'timage'  => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'tjob'	  => 'Client of Company'
		            ],
		            [
		             	'tcontent' => __( '"You will never fake the feeling of being in such a place. The live minimalism base on the natural materials & alive unprocessed."', 'theratio' ),
						'tname'	  => 'Anna Paulina',
						'timage'  => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'tjob'	  => 'Client of Company'
		            ],
		            [
		             	'tcontent' => __( '"You will never fake the feeling of being in such a place. The live minimalism base on the natural materials & alive unprocessed."', 'theratio' ),
						'tname'	  => 'Anna Paulina',
						'timage'  => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'tjob'	  => 'Client of Company'
		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'timage_image_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'default' => 'thumbnail',
			]
		);
		$this->add_control(
			'version_style',
			[
				'label' => __( 'Style', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'v-dark',
				'options' => [
					'v-dark'  => __( 'Dark', 'theratio' ),
					'v-light' => __( 'Light', 'theratio' ),					
				]
			]
		);

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides to Show', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'theratio' ),
				] + $slides_show,
				'default' => ''
			]
		);
		$this->add_responsive_control(
			'tscroll',
			[
				'label' => __( 'Slides to Scroll', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'theratio' ),
				] + $slides_show,
			]
		);
		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both' => __( 'Arrows and Dots', 'theratio' ),
					'arrows' => __( 'Arrows', 'theratio' ),
					'dots' => __( 'Dots', 'theratio' ),
					'none' => __( 'None', 'theratio' ),
				],
			]
		);
		$this->add_control(
			'slide_effect',
			[
				'label' => __( 'Effect', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'theratio' ),
					'fade'  => __( 'Fade', 'theratio' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				]
			]
		);

		$this->add_responsive_control(
			'text_align',
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
					]
				],
				'prefix_class' => 'theratio%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
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
			'heading_cbox',
			[
				'label' => __( 'Content Box', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'spacing_tcontent',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 .testi__content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'tcontent_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 .testi__content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials-2 .testi__content',
			]
		);

		$this->add_responsive_control(
			'tcontent_padding',
			[
				'label' => __( 'Padding', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 .testi__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Image.
		$this->start_controls_section(
			'style_timage',
			[
				'label' => __( 'Avatars', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'spacing_img',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 .testi__thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => __( 'Max-Width', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 .testi__thumb img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 .testi__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Name.
		$this->start_controls_section(
			'style_tname',
			[
				'label' => __( 'Name', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials-2 h5',
			]
		);

		$this->end_controls_section();

		// Job.
		$this->start_controls_section(
			'style_tjob',
			[
				'label' => __( 'Job', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 .testi__info span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials-2 .testi__info span',
			]
		);		

		$this->end_controls_section();

		// Arrow.
		$this->start_controls_section(
			'style_nav',
			[
				'label' => __( 'Arrow', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				]
			]
		);
		$this->add_control(
			'nav_icon_font',
			[
				'label' => __( 'Nav Icon', 'theratio' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'far fa-arrow-alt-circle-left',
					'library' => 'fa-regular',
				]
			]
		);
		$this->add_responsive_control(
			'spacing_nav',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials-2 .testi-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'style_arrow_tabs'
		);

		$this->start_controls_tab(
			'style_normal_arrow_tab',
			[
				'label' => __( 'Normal', 'theratio' ),
			]
		);

		$this->add_control(
			'arrow_bg_color',
			[
				'label' => __( 'Background Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-button-next span, {{WRAPPER}} .octf-swiper-button-prev span' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_border_color',
			[
				'label' => __( 'Border Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-button-next span, {{WRAPPER}} .octf-swiper-button-prev span' => 'border-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-button-next span svg, {{WRAPPER}} .octf-swiper-button-prev span svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .octf-swiper-button-next span i, {{WRAPPER}} .octf-swiper-button-prev span i' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_arrow_tab',
			[
				'label' => __( 'Hover', 'theratio' ),
			]
		);
		$this->add_control(
			'arrow_bg_hcolor',
			[
				'label' => __( 'Background Color Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-button-next:not(.swiper-button-disabled) span:hover, {{WRAPPER}} .octf-swiper-button-prev:not(.swiper-button-disabled) span:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_border_hcolor',
			[
				'label' => __( 'Border Color Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-button-next:not(.swiper-button-disabled) span:hover, {{WRAPPER}} .octf-swiper-button-prev:not(.swiper-button-disabled) span:hover' => 'border-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Color Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-button-next:not(.swiper-button-disabled) span:hover svg, {{WRAPPER}} .octf-swiper-button-prev:not(.swiper-button-disabled) span:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .octf-swiper-button-next:not(.swiper-button-disabled) span:hover i, {{WRAPPER}} .octf-swiper-button-prev:not(.swiper-button-disabled) span:hover i' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		$this->start_controls_section(
			'style_dots',
			[
				'label' => __( 'Dots', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);
		
		$this->add_control(
			'dots_bgcolor',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [					
					'{{WRAPPER}} .octf-swiper-pagination-2 .swiper-pagination-bullet' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'dots_active_bgcolor',
			[
				'label' => __( 'Color Active', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-pagination-2 .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = 'far fa-arrow-alt-circle-left';
		}

		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
		}

		$migrated = isset( $settings['__fa4_migrated']['nav_icon_font'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		$showDesktop   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 1;
		$showTablet    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showDesktop;
		$showMobile    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showTablet;

		$scrollDesktop   = !empty( $settings['tscroll'] ) ? $settings['tscroll'] : 1;
		$scrollTablet    = !empty( $settings['tscroll_tablet'] ) ? $settings['tscroll_tablet'] : $scrollDesktop;
		$scrollMobile    = !empty( $settings['tscroll_mobile'] ) ? $settings['tscroll_mobile'] : $scrollTablet;
		
		$owl_options = [
			'slides_show_desktop'  		 => absint( $showDesktop ),
			'slides_show_tablet'  		 => absint( $showTablet ),
			'slides_show_mobile'   		 => absint( $showMobile ),
			'slides_scroll_desktop'  	 => absint( $scrollDesktop ),
			'slides_scroll_tablet'  	 => absint( $scrollTablet ),
			'slides_scroll_mobile'   	 => absint( $scrollMobile ),
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
		];
		$this->add_render_attribute(
			'slides', [
				'class'               => [
					'testimonial-inner ot-testimonials-slider-s3 swiper swiper-container', 
					$arrows ? 'arrow-bot' : ''
				],
				'data-slider_options' => wp_json_encode( $owl_options ),
				'data-effect' => $settings['slide_effect'],
			]
		);
		?>

		<div class="ot-testimonials-2 slider__style-nav-2 <?php echo $settings['version_style']; ?>">						
			
			<div <?php echo $this->get_render_attribute_string( 'slides' ); ?> <?php if( is_rtl() ){ echo'dir="rtl"'; }?> >
				<div class="swiper-wrapper">
				<?php if ( ! empty( $settings['testi_slider'] ) ) : foreach ( $settings['testi_slider'] as $testi ) : ?>
					<div class="swiper-slide">
						<div class="testi-item">
					        <div class="testi__content">
					        	<?php echo $testi['tcontent']; ?>
					        </div>
					        <div class="t-head">
					        	<?php if ( $testi['timage']['id'] != '' ){ ?>
					        	<div class="testi__thumb">
					        		<?php $image_url = Group_Control_Image_Size::get_attachment_image_src( $testi['timage']['id'], 'timage_image_size', $settings ); ?>
					        		<?php echo '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $testi['title'] ) . '">'; ?>
					        	</div>
					        	<?php } ?>
					        	<div class="testi__info">
					        		<h5><?php echo $testi['title']; ?> <?php if ( $testi['tjob'] ) { ?><span><?php echo $testi['tjob']; ?></span><?php } ?></h5>					        		
					        	</div>
				        	</div>
			        	</div>
					</div>
				<?php endforeach; endif; ?>
				</div>

				<?php if( $arrows ){ ?>
				<!-- Add Arrows -->
				<div class="octf-swiper-button-next">
					<span>
						<?php if ( $is_new || $migrated ) :
							Icons_Manager::render_icon( $settings['nav_icon_font'], [ 'aria-hidden' => 'true' ] );
						else : ?>
							<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
						<?php endif; ?>
					</span>
				</div>
				<div class="octf-swiper-button-prev">
					<span>
						<?php if ( $is_new || $migrated ) :
							Icons_Manager::render_icon( $settings['nav_icon_font'], [ 'aria-hidden' => 'true' ] );
						else : ?>
							<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
						<?php endif; ?>
					</span>
				</div>
				<?php } ?>
				<?php if( $dots ){ ?>
				<!-- Add Dots -->
				<div class="octf-swiper-pagination-2"></div>
				<?php } ?>
			</div>				
	    </div>

	    <?php
	}

}
// After the Theratio_Testimonials_3 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Testimonials_3() );