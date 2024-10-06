<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Projects Carousel
 */
class Theratio_Portfolio_Slider extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'irprojects';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Portfolio Carousel', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-slider-push';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Projects', 'theratio' ),
			]
		);
		$this->add_control(
			'project_cat',
			[
				'label' => __( 'Select Categories', 'theratio' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_project(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'theratio' ),
			]
		);
		$this->add_control(
			'project_num',
			[
				'label' => __( 'Show Number Projects', 'theratio' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '9',
			]
		);	
		$this->add_control(
			'heading_slider',
			[
				'label' => __( 'Slider', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slides_show = range( 1, 6 );
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
			'scroll',
			[
				'label' => __( 'Slides to Scroll', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'theratio' ),
				] + $slides_show,
				'default' => ''
			]
		);
		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'both' => __( 'Arrows and Dots', 'theratio' ),
					'arrows' => __( 'Arrows', 'theratio' ),
					'dots' => __( 'Dots', 'theratio' ),
					'none' => __( 'None', 'theratio' ),
				],
			]
		);
		$this->add_responsive_control(
			'w_gaps',
			[
				'label' => __( 'Gap Width', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Info Box Style', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  	=> __( 'Background Overlay', 'theratio' ),
					'style-2' 	=> __( 'Background Solid', 'theratio' ),
					'style-3' 	=> __( 'Under Image', 'theratio' ),
					'style-5' 	=> __( 'Show Info Overlay', 'theratio' ),
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'overlay_style_section',
			[
				'label' => __( 'Project Items', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_general',
			[
				'label' => __( 'General', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'overlay_align',
			[
				'label' => __( 'Alignment Info', 'theratio' ),
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
				],				
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info .portfolio-info-inner' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'info_width',
			[
				'label' => __( 'Info Width?', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' 	=> __( '100%', 'theratio' ),
				'label_off' => __( 'Auto', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition'  => [
					'layout' => 'style-2',
				]
			]
		);
		$this->add_control(
			'overlay_background',
			[
				'label' => __( 'Background Overlay', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1','style-5'],
				]
			]
		);
		$this->add_control(
			'info_background',
			[
				'label' => __( 'Background Info', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .style-2 .portfolio-info-inner' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'style-2',
				]
			]
		);
		$this->add_responsive_control(
			'info_padding',
			[
				'label' => 'Padding Info',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .style-2 .portfolio-info-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'style-2',
				],
			]
		);
		$this->add_control(
			'scale_thumb',
			[
				'label' => __( 'Animation Image Hover', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theratio' ),
				'label_off' => __( 'No', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		/* title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_spacing',
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
					'{{WRAPPER}} .projects-box .portfolio-info h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .projects-box .portfolio-info h5 a' => 'color: {{VALUE}}; background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}});',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .projects-box .portfolio-info h5 a',
			]
		);

		/* category */
		$this->add_control(
			'heading_overlay',
			[
				'label' => __( 'Category', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_cat',
			[
				'label' => __( 'Show Category', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theratio' ),
				'label_off' => __( 'Hide', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_cat' => 'yes',
				]
			]
		);
		$this->add_control(
			'cat_hover_color',
			[
				'label' => __( 'Hover Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_cat' => 'yes',
					'layout!'   => 'style-5'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'selector' => '{{WRAPPER}} .projects-box .portfolio-info .portfolio-cates a, {{WRAPPER}} .projects-box .portfolio-info .portfolio-cates span',
				'condition' => [
					'show_cat' => 'yes',
				]
			]
		);
		$this->end_controls_section();	

		// Dots.
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Dots', 'theratio' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
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
					'{{WRAPPER}} .octf-swiper-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dots_bgcolor',
            [
                'label' => __( 'Color', 'theratio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet:before' => 'background: {{VALUE}};',
				],
            ]
        );

        $this->add_control(
            'dots_active_bgcolor',
            [
                'label' => __( 'Color Active', 'theratio' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet-active:before' => 'background: {{VALUE}};',
				],
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
			'arrow_bg_color',
			[
				'label' => __( 'Background', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-button-next, {{WRAPPER}} .octf-swiper-button-prev' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .octf-swiper-button-next, {{WRAPPER}} .octf-swiper-button-prev' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bg_hcolor',
			[
				'label' => __( 'Background Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-button-next:not(.swiper-button-disabled):hover, {{WRAPPER}} .octf-swiper-button-prev:not(.swiper-button-disabled):hover' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .octf-swiper-button-next:not(.swiper-button-disabled):hover, {{WRAPPER}} .octf-swiper-button-prev:not(.swiper-button-disabled):hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$showpost = (!empty($settings['project_num']) ? $settings['project_num'] : 9 );
		$dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$showDesktop   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$showTablet    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showDesktop;
		$showMobile    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showTablet;

		$scrollDesktop   = !empty( $settings['scroll'] ) ? $settings['scroll'] : 1;
		$scrollTablet    = !empty( $settings['scroll_tablet'] ) ? $settings['scroll_tablet'] : $scrollDesktop;
		$scrollMobile    = !empty( $settings['scroll_mobile'] ) ? $settings['scroll_mobile'] : $scrollTablet;

		$gapDesktop      = isset( $settings['w_gaps']['size'] ) && is_numeric( $settings['w_gaps']['size'] ) ? $settings['w_gaps']['size'] : 30;
		$gapTablet  = isset( $settings['w_gaps_tablet']['size'] ) && is_numeric( $settings['w_gaps_tablet']['size'] ) ? $settings['w_gaps_tablet']['size'] : $gapDesktop;
		$gapMobile  = isset( $settings['w_gaps_mobile']['size'] ) && is_numeric( $settings['w_gaps_mobile']['size'] ) ? $settings['w_gaps_mobile']['size'] : $gapTablet;
		
		$owl_options = [
			'slides_show_desktop'  		 => absint( $showDesktop ),
			'slides_show_tablet'  		 => absint( $showTablet ),
			'slides_show_mobile'   		 => absint( $showMobile ),
			'slides_scroll_desktop'  	 => absint( $scrollDesktop ),
			'slides_scroll_tablet'  	 => absint( $scrollTablet ),
			'slides_scroll_mobile'   	 => absint( $scrollMobile ),
			'margin_desktop'   	   		 => absint( $gapDesktop ),
			'margin_tablet'   	   		 => absint( $gapTablet ),
			'margin_mobile'  		 	 => absint( $gapMobile ),
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
		];

		$this->add_render_attribute(
			'slides', [
				'class'               => [
					'project-slider projects-grid', 
					'swiper swiper-container', 
					$settings['layout'],
					$settings['scale_thumb'] ? 'img-scale' : '',
					!$settings['show_cat'] ? 'no-cat' : ''
				],
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);
		?>

		<div <?php echo $this->get_render_attribute_string( 'slides' ); ?> <?php if( is_rtl() ){ echo'dir="rtl"'; }?> >
			<div class="swiper-wrapper">
				<?php 
					if( $settings['project_cat'] ){
		                $args = array(	                    
		                    'post_type' 		=> 'ot_portfolio',
		                    'post_status' 		=> 'publish',
		                    'posts_per_page' 	=> $settings['project_num'],
		                    'tax_query' 		=> array(
		                        array(
		                            'taxonomy' 	=> 'portfolio_cat',
		                            'field' 	=> 'slug',
		                            'terms' 	=> $settings['project_cat'],
		                        ),
		                    ),              
		                );
		            }else{
		                $args = array(
		                    'post_type' 		=> 'ot_portfolio',
		                    'post_status' 		=> 'publish',
		                    'posts_per_page' 	=> $settings['project_num'],
		                );
		            }			
					$wp_query = new \WP_Query($args);					
					while ( $wp_query -> have_posts() ) : $wp_query -> the_post(); 

						get_template_part( 'template-parts/content', 'project3' );

					endwhile; wp_reset_postdata(); 
				?>
			</div>
			<?php if( $arrows  ){ ?>
			<!-- Add Arrows -->
			<div class="octf-swiper-button-next"><i class="ot-flaticon-right-arrow"></i></div>
			<div class="octf-swiper-button-prev"><i class="ot-flaticon-left-arrow"></i></div>
			<?php } ?>
			<?php if( $dots ){ ?>
			<!-- Add Dots -->
			<div class="octf-swiper-pagination"></div>
			<?php } ?>
	    </div>
	    <?php
	}

	protected function select_param_cate_project() {
	  	$category = get_terms( 'portfolio_cat' );
	  	$cat = array();
	  	foreach( $category as $item ) {
	     	if( $item ) {
	        	$cat[$item->slug] = $item->name;
	     	}
	  	}
	  	return $cat;
	}
}
// After the Theratio_Portfolio_Slider class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Portfolio_Slider() );