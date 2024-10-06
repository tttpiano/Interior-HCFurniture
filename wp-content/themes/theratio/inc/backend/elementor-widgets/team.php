<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team
 */
class Theratio_Team extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'imember';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Team', 'theratio' );
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
				'label' => esc_html__( 'Member Team', 'theratio' ),
			]
		);

		$this->add_control(
	       'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'theratio' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
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

	    $this->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'theratio' ),
	          	'type'  => Controls_Manager::TEXT,
	          	'default' => esc_html__( 'Olivia Peterson', 'theratio' ),
	    	]
	    );

	    $this->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'theratio' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( '[ Interior Designer ]', 'theratio' ),
	    	]
	    );

		$repeater = new Repeater();
		$repeater->add_control(
	      	'title',
		    [
		        'label'   => esc_html__( 'Name', 'theratio' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => esc_html__( 'Social', 'theratio' ),
		    ]
	    );

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__( 'Icon', 'theratio' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-twitter',
					'library' => 'fa-brand',
				],
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label' => esc_html__( 'Link', 'theratio' ),
                'type'  => Controls_Manager::URL,
                'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://', 'theratio' ),
				'default' => [
					'url' => 'https://', 
				],
            ]
        );

        $repeater->add_control(
			'social_bg',
			[
				'label'     => esc_html__( 'Background', 'theratio' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bg-social' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
		    'social_share',
		    [
		        'label'       => esc_html__( 'Socials', 'theratio' ),
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => true,
		        'prevent_empty' => false,
		        'default'     => [
		            [
		             	'title'       => esc_html__( 'Twitter', 'theratio' ),
		                'social_link' => esc_html__( 'https://www.twitter.com/', 'theratio' ),
		                'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brand',
						],
		 
		            ],
		            [
		             	'title'       => esc_html__( 'Facebook', 'theratio' ),
		                'social_link' => esc_html__( 'https://www.facebook.com/', 'theratio' ),
		                'social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brand',
						],
		 
		            ],
		            [
		             	'title'       => esc_html__( 'Pinterest', 'theratio' ),
		                'social_link' => esc_html__( 'https://www.pinterest.com/', 'theratio' ),
		                'social_icon' => [
							'value' => 'fab fa-pinterest-p',
							'library' => 'fa-brand',
						],

		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'theratio' ),
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
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'm_link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'm_link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'm_link', 'rel', 'nofollow' );
			}
		}

		?>

		<div class="team-wrap">
			<?php if( $settings['member_image']['url'] ) { ?>
			<div class="team-thumb">
				<?php if ( ! empty( $settings['link']['url'] ) ) echo '<a ' .$this->get_render_attribute_string( 'm_link' ). '>' ?> 
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'member_image_size', 'member_image' );?>
				<?php if ( ! empty( $settings['link']['url'] ) ) echo '</a>' ?> 
			</div>
			<?php } ?>
			<div class="team-text-overlay">
				<div class="team-info dtable">
					<div class="dcell">
						<h4 class="m_name"><?php if ( ! empty( $settings['link']['url'] ) ) echo '<a ' .$this->get_render_attribute_string( 'm_link' ). '>' . $settings['member_name'] . '</a>'; else echo $settings['member_name']; ?></h4>
						<?php if ( ! empty( $settings['social_share'] ) ) : ?>
						<div class="team-social flex-middle">
							<span class="ot-flaticon-add"></span>
							<?php foreach ( $settings['social_share'] as $key => $social ) : ?>
		                        <?php if ( ! empty( $social['social_link'] ) ) : ?>
		                            <a <?php if($social['social_link']['is_external'])
		                            { echo 'target="_blank"'; }else{ echo 'rel="nofollow"';}?> 
		                                    href="<?php echo $social['social_link']['url'];?>" class="<?php echo strtolower($social['title']);?>" style="transition-delay: <?php echo ($key*100).'ms';?>">
		                                 <i class="fab <?php echo esc_attr( $social['social_icon']['value']); ?>"></i>
		                            </a>
		                        <?php endif; ?>
		                    <?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>
					<div class="m_extra">
						<span><?php echo $settings['member_extra']; ?></span>
					</div>
				</div>
			</div>
		</div>
	        
	    <?php
	}

}
// After the Theratio_Team class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Team() );