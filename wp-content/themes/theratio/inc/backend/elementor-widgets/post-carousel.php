<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: News Slider
 */
class Theratio_Post_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ipost_carousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Post Carousel', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-posts-carousel';
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
				'label' => __( 'Post Carousel', 'theratio' ),
			]
		);

		$this->add_control(
			'post_cat',
			[
				'label' => __( 'Select Categories', 'theratio' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_post(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'theratio' ),
			]
		);

		$this->add_control(
			'number_show',
			[
				'label' => __( 'Show Number Posts', 'theratio' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '9',
			]
		);
		$this->add_control(
			'exc',
			[
				'label' => esc_html__( 'Number Excerpt Length', 'theratio' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '15',
			]
		);
		$this->add_control(
			'version_style',
			[
				'label' => __( 'Style', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'v-light',
				'options' => [
					'v-light' => __( 'Light', 'theratio' ),
					'v-dark' => __( 'Dark', 'theratio' ),
				]
			]
		);

		$this->add_control(
			'post_thumbnail',
			[
				'label' => __( 'Image Size', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'theratio-grid-post-thumbnail',
				'options' => [					
					'theratio-grid-post-thumbnail' => __( 'Default', 'theratio' ),
					'medium_large' => __( 'Medimum Large 768x0', 'theratio' ),
					'large' => __( 'Large 1024x1024', 'theratio' ),
					'full' => __( 'Full', 'theratio' ),
				],
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

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );
		
		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides to Show', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'theratio' ),
				] + $slides_show,
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
				'default' => 'dots',
				'options' => [
					'both' => __( 'Arrows and Dots', 'theratio' ),
					'arrows' => __( 'Arrows', 'theratio' ),
					'dots' => __( 'Dots', 'theratio' ),
					'none' => __( 'None', 'theratio' ),
				],
			]
		);

		$this->add_responsive_control(
			'post_spacing',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [],
			]
		);

		$this->end_controls_section();

		/*Style*/
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'General', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'info_padd',
			[
				'label' => __( 'Padding', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .post-box .post-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_feature_spacing',
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
					'{{WRAPPER}} .post-box .post-inner .entry-media' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'info_bg',
			[
				'label' => __( 'Backgroung Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .post-inner' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'info_border',
			[
				'label' => __( 'Border Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .post-inner' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		//Content Style
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'heading_meta',
			[
				'label' => __( 'Entry Meta', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'entry_meta_spacing',
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
					'{{WRAPPER}} .post-box .inner-post .entry-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'entry_meta_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .inner-post .entry-meta a, {{WRAPPER}} .post-box .inner-post .entry-meta > span:not(:first-child):before' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'entry_meta_color_hover',
			[
				'label' => __( 'Color Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .inner-post .entry-meta a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'entry_meta_typography',
				'selector' => '{{WRAPPER}} .post-box .inner-post .entry-meta'
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
					'{{WRAPPER}} .post-box .inner-post h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .post-box .inner-post h5 a' => 'color: {{VALUE}}; background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}});',
				]
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .inner-post h5 a:hover' => 'color: {{VALUE}}; background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}});',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-box .inner-post h5',
			]
		);

		$this->add_control(
			'heading_exc',
			[
				'label' => __( 'Excerpt', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'exc!' => [ 0,''],
				]
			]
		);
		$this->add_control(
			'exc_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .post-inner .the-excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'exc!' => [ 0,''],
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exc_typography',
				'selector' => '{{WRAPPER}} .post-box .post-inner .the-excerpt',
				'condition' => [
					'exc!' => [ 0,''],
				]
			]
		);

		$this->end_controls_section();

		// Dots.
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet:before' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .octf-swiper-pagination .swiper-pagination-bullet-active:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'arrows_section',
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
		$dots      = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$arrows    = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$showDesktop   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$showTablet    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showDesktop;
		$showMobile    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showTablet;

		$scrollDesktop   = !empty( $settings['tscroll'] ) ? $settings['tscroll'] : 1;
		$scrollTablet    = !empty( $settings['tscroll_tablet'] ) ? $settings['tscroll_tablet'] : $scrollDesktop;
		$scrollMobile    = !empty( $settings['tscroll_mobile'] ) ? $settings['tscroll_mobile'] : $scrollTablet;

		$gapDesktop      = isset( $settings['slider_spacing']['size'] ) && is_numeric( $settings['slider_spacing']['size'] ) ? $settings['slider_spacing']['size'] : 30;
		$gapTablet  = isset( $settings['slider_spacing_tablet']['size'] ) && is_numeric( $settings['slider_spacing_tablet']['size'] ) ? $settings['slider_spacing_tablet']['size'] : $gapDesktop;
		$gapMobile  = isset( $settings['slider_spacing_mobile']['size'] ) && is_numeric( $settings['slider_spacing_mobile']['size'] ) ? $settings['slider_spacing_mobile']['size'] : $gapTablet;
		
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
				'class'               => ['blog-slider', 'swiper swiper-container', $settings['version_style']],
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);
		?>

		<div <?php echo $this->get_render_attribute_string( 'slides' ); ?> <?php if( is_rtl() ){ echo'dir="rtl"'; }?> >
			<div class="swiper-wrapper">
	        <?php
	        	$number_show = (!empty($settings['number_show']) ? $settings['number_show'] : 9);

	        	if( $settings['post_cat'] ){
	                $args = array(
			            'post_type' => 'post',
			            'post_status' => 'publish',
			            'posts_per_page' => $number_show,
			            'tax_query' => array(
					        array(
					            'taxonomy' => 'category',
					            'field'    => 'slug',
					            'terms'    => $settings['post_cat']
					        ),
					    ),
			        );
	            }else{
	                $args = array(
	                    'post_type' => 'post',
			            'post_status' => 'publish',
			            'posts_per_page' => $number_show,
	                );
	            }

		        $blogpost = new \WP_Query($args);
		        if ( $blogpost->have_posts() ) : while( $blogpost->have_posts() ) : $blogpost->the_post(); ?> 
		        	<div class="swiper-slide">
						<article id="post-<?php the_ID(); ?>" <?php post_class('post-box'); ?>>
							<div class="post-inner">
							    <?php if ( has_post_thumbnail() ) { ?>
									<div class="entry-media post-cat-abs">
							            <a href="<?php the_permalink(); ?>">
							                <?php the_post_thumbnail( $settings['post_thumbnail'] ); ?>
							            </a>
							            <?php theratio_posted_in(); ?>
							        </div>					       
							    <?php }else{ ?>
							    	<div class="entry-media">
							        	<?php theratio_posted_in(); ?>
							        </div>
							    <?php } ?>
							    <div class="inner-post">
									<div class="entry-header">
										<?php if ( 'post' === get_post_type() ) : if( theratio_get_option( 'post_entry_meta' ) ) { ?>
										<div class="entry-meta">
											<?php theratio_post_meta(); ?>
										</div><!-- .entry-meta -->
										<?php } endif; ?>

										<?php the_title( '<h5 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
									</div><!-- .entry-header -->
									<div class="the-excerpt">
							            <?php echo theratio_excerpt($settings['exc']); ?>
							        </div><!-- .entry-content -->
								</div>
							</div>
						</article>
					</div>

		        <?php endwhile; wp_reset_postdata(); endif; ?>
		    </div>
		   	<?php if ( $dots ) { ?>
			<!-- Add Dots -->
			<div class="octf-swiper-pagination"></div>
			<?php } ?>
			<?php if ( $arrows  ) { ?>
			<!-- Add Arrows -->
			<div class="octf-swiper-button-next"><i class="ot-flaticon-right-arrow"></i></div>
			<div class="octf-swiper-button-prev"><i class="ot-flaticon-left-arrow"></i></div>
			<?php } ?>
	    </div>
		<?php
	}

	protected function select_param_cate_post() {
		$args = array( 'orderby=name&order=ASC&hide_empty=0' );
		$terms = get_terms( 'category', $args );
		$cat = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){		    
		    foreach ( $terms as $term ) {
		        $cat[$term->slug] = $term->name;
		    }
		}
	  	return $cat;
	}
}
// After the Theratio_Post_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Post_Carousel() );