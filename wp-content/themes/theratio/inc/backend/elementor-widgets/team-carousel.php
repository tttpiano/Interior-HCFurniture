<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team Carousel
 */
class Theratio_Team_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'imembercarousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Team Carousel', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-person';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		/**TAB_CONTENT**/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Member Team Carousel', 'theratio' ),
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
	       'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'theratio' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
		    ]
		);

	    $repeater->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'theratio' ),
	          	'type'  => Controls_Manager::TEXT,
	          	'default' => esc_html__( 'Olivia Peterson', 'theratio' ),
	    	]
	    );

	    $repeater->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'theratio' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( '[ Interior Designer ]', 'theratio' ),
	    	]
	    );

	    $repeater->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'theratio' ),
			]
		);

		$repeater->add_control(
			'socials',
			[
				'label' => __( 'Socials', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theratio' ),
				'label_off' => __( 'Hide', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);

	    $repeater->add_control(
		    'social1',
	      	[
	          	'label' => esc_html__( 'Icon Social 1', 'theratio' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-twitter',
					'library' => 'fa-brand',
				],
				'condition' => [
					'socials' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social1_link',
			[
				'label' => __( 'Link Social 1', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://twitter.com/', 'theratio' ),
				'condition' => [
					'socials' => 'yes',
				],
			]
		);

		$repeater->add_control(
		    'social2',
	      	[
	          	'label' => esc_html__( 'Icon Social 2', 'theratio' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-facebook-f',
					'library' => 'fa-brand',
				],
				'separator' => 'before',
				'condition' => [
					'socials' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social2_link',
			[
				'label' => __( 'Link Social 2', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://facebook.com/', 'theratio' ),
				'condition' => [
					'socials' => 'yes',
				],
			]
		);

		$repeater->add_control(
		    'social3',
	      	[
	          	'label' => esc_html__( 'Icon Social 3', 'theratio' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-pinterest-p',
					'library' => 'fa-brand',
				],
				'separator' => 'before',
				'condition' => [
					'socials' => 'yes',
				],
	    	]
	    );
	    $repeater->add_control(
			'social3_link',
			[
				'label' => __( 'Link Social 3', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://pinterest.com/', 'theratio' ),
				'condition' => [
					'socials' => 'yes',
				],
			]
		);

		$this->add_control(
		    'members',
		    [
		        'label'       => esc_html__( 'Team', 'theratio' ),
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'prevent_empty' => false,
		        'default'     => [],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{member_name}}}',
		    ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'member_image_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
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
				'default' => 'dots',
				'options' => [
					'both' => __( 'Arrows and Dots', 'theratio' ),
					'arrows' => __( 'Arrows', 'theratio' ),
					'dots' => __( 'Dots', 'theratio' ),
					'none' => __( 'None', 'theratio' ),
				],
			]
		);

		$this->end_controls_section();

		/**TAB_STYLE**/
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Infomation', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'team_spacing',
			[
				'label' => __( 'Team Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);
		$this->add_control(
			'overlay_bg',
			[
				'label'     => esc_html__( 'Overlay', 'theratio' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-wrap .team-info' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'theratio' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social > span:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'theratio' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social > span' => 'color: {{VALUE}};',
				],
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
				'label' => esc_html__( 'Spacing', 'theratio' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-wrap h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'theratio' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-wrap h4, {{WRAPPER}} .team-wrap h4 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label'     => esc_html__( 'Hover', 'theratio' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-wrap h4 a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!'  => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'title_typography',
					'label'    => esc_html__( 'Typography', 'theratio' ),
					'selector' => '{{WRAPPER}} .team-wrap h4',
				]
		);

		//Extra
		$this->add_control(
			'heading_job',
			[
				'label' => __( 'Extra/Job', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'job_space',
			[
				'label' => esc_html__( 'Spacing', 'theratio' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-wrap .m_extra span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_color',
			[
				'label'     => esc_html__( 'Color', 'theratio' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-wrap .m_extra span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'job_typography',
					'label'    => esc_html__( 'Typography', 'theratio' ),
					'selector' => '{{WRAPPER}} .team-wrap .m_extra span',
				]
		);

		$this->end_controls_section();

		//Socials
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Socials', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_social_size',
			[
				'label' => esc_html__( 'Font Size', 'theratio' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_social_space',
			[
				'label' => esc_html__( 'Spacing', 'theratio' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_social_color',
			[
				'label'     => esc_html__( 'Color', 'theratio' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'theratio' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .team-social a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		//Dots
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
		$dots      = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$arrows    = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$showDesktop   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$showTablet    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showDesktop;
		$showMobile    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showTablet;

		$scrollDesktop   = !empty( $settings['tscroll'] ) ? $settings['tscroll'] : 1;
		$scrollTablet    = !empty( $settings['tscroll_tablet'] ) ? $settings['tscroll_tablet'] : $scrollDesktop;
		$scrollMobile    = !empty( $settings['tscroll_mobile'] ) ? $settings['tscroll_mobile'] : $scrollTablet;

		$gapDesktop      = isset( $settings['team_spacing']['size'] ) && is_numeric( $settings['team_spacing']['size'] ) ? $settings['team_spacing']['size'] : 30;
		
		$owl_options = [
			'slides_show_desktop'  		 => absint( $showDesktop ),
			'slides_show_tablet'  		 => absint( $showTablet ),
			'slides_show_mobile'   		 => absint( $showMobile ),
			'slides_scroll_desktop'  	 => absint( $scrollDesktop ),
			'slides_scroll_tablet'  	 => absint( $scrollTablet ),
			'slides_scroll_mobile'   	 => absint( $scrollMobile ),
			'margin_desktop'   	   		 => absint( $gapDesktop ),
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
		];

		$this->add_render_attribute(
			'slides', [
				'class'               => ['team-slider swiper swiper-container'],
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);
		?>

		<div <?php echo $this->get_render_attribute_string( 'slides' ); ?> <?php if( is_rtl() ){ echo'dir="rtl"'; }?> >
			<div class="swiper-wrapper">
				<?php foreach ( $settings['members'] as $key => $mem ) : 
					$image_url = Group_Control_Image_Size::get_attachment_image_src( $mem['member_image']['id'], 'member_image_size', $settings );
            		$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $mem['member_name'] ) . '">';

            		$link_detail = '';
		            if ( ! empty( $mem['link']['url'] ) ) {
						$this->add_render_attribute( 'm_link' . $key, 'href', $mem['link']['url'] );

						if ( $mem['link']['is_external'] ) {
							$this->add_render_attribute( 'm_link' . $key, 'target', '_blank' );
						}

						if ( $mem['link']['nofollow'] ) {
							$this->add_render_attribute( 'm_link' . $key, 'rel', 'nofollow' );
						}
						$link_detail = '<a '.$this->get_render_attribute_string('m_link' . $key).'>';
					}
				?>

				<div class="swiper-slide">
					<div class="team-wrap">
						<?php if( $image_url ) { ?>
						<div class="team-thumb">
							<?php if ( $link_detail ) echo $link_detail . $image_html . '</a>';else echo $image_html; ?> 
						</div>
						<?php } ?>
						<div class="team-text-overlay">
							<div class="team-info dtable">
								<?php if ( $mem['member_name'] ){ ?>
								<div class="dcell">
									<h4 class="m_name"><?php if ( $link_detail ) echo $link_detail . $mem['member_name'] . '</a>'; else echo $mem['member_name']; ?></h4>
									<?php if ( $mem['socials'] ) : ?>
				                    <div class="team-social flex-middle">
				                    	<span class="ot-flaticon-add"></span>
				                       	<a <?php if($mem['social1_link']['is_external'])
				                        { echo 'target="_blank"'; }else{ echo 'rel="nofollow"';}?> 
				                                href="<?php echo $mem['social1_link']['url'];?>" style="transition-delay: 0ms">
				                             <i class="fab <?php echo esc_attr( $mem['social1']['value']); ?>"></i>
				                        </a>
				                        <?php if ( ! empty( $mem['social2'] ) ) : ?>
				                        <a <?php if($mem['social2_link']['is_external'])
				                        { echo 'target="_blank"'; }else{ echo 'rel="nofollow"';}?> 
				                                href="<?php echo $mem['social2_link']['url'];?>" style="transition-delay: 100ms">
				                             <i class="fab <?php echo esc_attr( $mem['social2']['value']); ?>"></i>
				                        </a>
				                        <?php endif; ?>
				                        <?php if ( ! empty( $mem['social3'] ) ) : ?>
				                        <a <?php if($mem['social3_link']['is_external'])
				                        { echo 'target="_blank"'; }else{ echo 'rel="nofollow"';}?> 
				                                href="<?php echo $mem['social3_link']['url'];?>" style="transition-delay: 200ms">
				                             <i class="fab <?php echo esc_attr( $mem['social3']['value']); ?>"></i>
				                        </a>
				                        <?php endif; ?>
				                    </div>  
					                <?php endif; ?>
								</div>
								<?php } ?>
								<div class="m_extra">
									<?php if ( $mem['member_extra'] ){ ?><span><?php echo $mem['member_extra']; ?></span><?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
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

}
// After the Theratio_Team_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Team_Carousel() );