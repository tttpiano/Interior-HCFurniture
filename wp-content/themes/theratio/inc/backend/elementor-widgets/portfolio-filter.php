<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Portfolio Filter
 */
class Theratio_PortfolioGrid extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ipfilter';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Portfolio Grid', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-gallery-grid';
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
				'label' => __( 'General', 'theratio' ),
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
			'filter',
			[
				'label' => __( 'Show Filter', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theratio' ),
				'label_off' => __( 'Hide', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'all_text',
			[
				'label' => __( 'All Text', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'All',
				'condition' => [
					'filter' => 'yes',
				],
			]
		);
		$this->add_control(
			'count',
			[
				'label' => __( 'Show Count', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theratio' ),
				'label_off' => __( 'Hide', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'filter' => 'yes',
				],
			]
		);
		$this->add_control(
			'column',
			[
				'label' => __( 'Columns', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pf_3_cols',
				'options' => [
					'pf_2_cols' => __( '2 Column', 'theratio' ),
					'pf_3_cols'	=> __( '3 Column', 'theratio' ),
					'pf_4_cols' => __( '4 Column', 'theratio' ),
					'pf_5_cols' => __( '5 Column', 'theratio' ),
				],
				'separator' => 'before',
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
				'selectors' => [
					'{{WRAPPER}} .project-item' => 'padding: calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .projects-grid' => 'margin: calc(-{{SIZE}}{{UNIT}}/2);',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'project_num',
			[
				'label' => __( 'Show Number Projects', 'theratio' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '6',
				'separator' => 'before',
			]
		);		
		$this->add_control(
			'load_more',
			[
				'label' => __( 'Load More Button', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Load More',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'loading_more',
			[
				'label' => __( 'Loading Text', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Loading...',
				'condition' => [
					'load_more[value]!' => '',
				]
			]
		);
		$this->add_control(
			'p_more',
			[
				'label' => __( 'Load Number Projects', 'theratio' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '3',
				'condition' => [
					'load_more[value]!' => '',
				]
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
					'style-4' 	=> __( 'Hidden', 'theratio' ),
					'style-5' 	=> __( 'Show Info Overlay', 'theratio' ),
					'style-6' 	=> __( 'Light Box', 'theratio' ),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'popup_thumb',
			[
				'label' => __( 'Popup Gallery', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theratio' ),
				'label_off' => __( 'No', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout' => ['style-3','style-4','style-6'],
				],
			]
		);

		$this->add_control(
			'popup_is_title',
			[
				'label' => __( 'Hover Title', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theratio' ),
				'label_off' => __( 'No', 'theratio' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'layout' => ['style-4'],
					'popup_thumb' => ['yes'],
				],
			]
		);
		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'filter_style_section',
			[
				'label' => __( 'Filter', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'filter' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'filter_align',
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
				'selectors' => [
					'{{WRAPPER}} .project_filters' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'filter_spacing',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .project_filters' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'filter_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .project_filters li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'filter_hcolor',
			[
				'label' => __( 'Border Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .project_filters li a:before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'selector' => '{{WRAPPER}} .project_filters li a',
			]
		);
		$this->add_control(
			'count_color',
			[
				'label' => __( 'Count Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .project_filters li a span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'count' => 'yes',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'count_typography',
				'selector' => '{{WRAPPER}} .project_filters li a span',
				'condition' => [
					'count' => 'yes',
				],
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
					'{{WRAPPER}} .projects-grid.style-4 .projects-thumbnail .overlay' => 'background: {{VALUE}};',
				],
				'condition' => [
					'layout' => ['style-1','style-5', 'style-4', 'style-6'],
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
					'{{WRAPPER}} .projects-box .projects-thumbnail .overlay h5' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .projects-box .portfolio-info h5 a, {{WRAPPER}} .projects-box .projects-thumbnail .overlay h5',
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
		
		/* button */
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Load More Button', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'load_more[value]!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'btn_align',
			[
				'label' => __( 'Alignment', 'theratio' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'theratio' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'theratio' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'theratio' ),
						'icon' => 'fa fa-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .btn-block' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'btn_spacing',
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
					'{{WRAPPER}} .octf-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'theratio' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'theratio' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .octf-btn:hover, {{WRAPPER}} .octf-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="project-filter-wrapper">
			<?php if( 'yes' === $settings['filter'] ) { ?>
	        	<div class="container">
	        		<ul class="project_filters">
	        			<?php if ( $settings['all_text'] != '' ) { ?>
	        			 	<li><a href="#" data-filter="*" class="selected btn-details"><?php echo esc_html( $settings['all_text'] ); if( $settings['count'] ) echo '<span class="filter-count"></span>'; ?></a></li>
	        			<?php } ?>
		                <?php
		                if( $settings['project_cat'] ){
		                    $categories = $settings['project_cat'];
		                    foreach ( $categories as $categorie ) {
		                        $cates    = get_term_by('term_id', $categorie, 'portfolio_cat');
		                        $cat_name = $cates->name;
		                        $cat_slug = $cates->slug;
		                        $cat_id   = 'category-' . $cates->term_id;

		                ?>
		                	<li>
								<a class="btn-details" href='#' data-filter='.<?php echo esc_attr( $cat_id ); ?>'><?php echo esc_html( $cat_name ); if ( $settings['count'] ) { echo '<span class="filter-count"></span>'; } ?></a>
							</li>	                   
		                <?php } } else {
		                    $categories = get_terms( 'portfolio_cat' );
		                    foreach ( $categories as $categorie ) {
		                        $cat_name = $categorie->name;
		                        $cat_slug = $categorie->slug;
		                        $cat_id   = 'category-' . $categorie->term_id;
		                    ?>
		                    <li>
								<a class="btn-details" href='#' data-filter='.<?php echo esc_attr( $cat_id ); ?>'><?php echo esc_html( $cat_name ); if ( $settings['count'] ) { echo '<span class="filter-count"></span>'; } ?></a>
							</li>	                    
		                <?php } } ?>
					</ul>
				</div>
	        <?php } ?>
			<?php 
				$cat_ids = '';
	        	if ( $settings['project_cat'] ) {
	                $args = array(	                    
	                    'post_type' 		=> 'ot_portfolio',
	                    'post_status' 		=> 'publish',
	                    'tax_query' 		=> array(
	                        array(
	                            'taxonomy' 	=> 'portfolio_cat',
	                            'field' 	=> 'term_id',
	                            'terms' 	=> $settings['project_cat'],
	                        ),
	                    ),              
					);
					$cat_ids = implode( ",", $settings['project_cat'] );
	            } else {
	                $args = array(
	                    'post_type' 	=> 'ot_portfolio',
	                    'post_status' 	=> 'publish',
	                );
	            }
	            $the_query = new \WP_Query($args);
				$count = $the_query->found_posts;
	        ?>
	        <div class="projects-grid <?php echo $settings['column'].' '.$settings['layout']; if( $settings['popup_thumb'] ) echo ' img-popup'; if( $settings['popup_is_title'] ) echo ' popup-is-title'; if( $settings['scale_thumb'] ) echo ' img-scale'; if( !$settings['info_width'] ) echo ' w-auto'; if( !$settings['show_cat'] ) echo ' no-cat'; ?>" data-load="<?php echo $settings['p_more']; ?>" data-count="<?php echo $count; ?>">
			<div class="grid-sizer"></div>
	            <?php
	            if( $settings['project_cat'] ){
	                $args = array(	                    
	                    'post_type' 		=> 'ot_portfolio',
	                    'post_status' 		=> 'publish',
	                    'posts_per_page' 	=> $settings['project_num'],
	                    'tax_query' 		=> array(
	                        array(
	                            'taxonomy' 	=> 'portfolio_cat',
	                            'field' 	=> 'term_id',
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
	            while ($wp_query -> have_posts()) : $wp_query -> the_post();
	            
	            get_template_part( 'template-parts/content', 'project' );

	            endwhile; wp_reset_postdata(); ?>
			</div>

			<?php if( $settings['load_more'] && $count >= $settings['project_num'] ) echo '<div class="btn-block"><a href="#" class="btn-loadmore octf-btn" data-category="'.$cat_ids.'" data-loaded="'.$settings['load_more'].'" data-loading="'.$settings['loading_more'].'" data-style="grid">'.$settings['load_more'].'</a></div>'; ?>
	    </div>
										
	    <?php
	}

	protected function select_param_cate_project() {
		$category = get_terms( 'portfolio_cat' );
		$cat = array();
		foreach( $category as $item ) {
		   if( $item ) {
			  $cat[$item->term_id] = $item->name;
		   }
		}
		return $cat;
	}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_PortfolioGrid() );