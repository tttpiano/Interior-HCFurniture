<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: News Slider
 */
class Theratio_Post_Grid extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ipost_grid';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Post Grid', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-posts-grid';
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
				'label' => __( 'Content', 'theratio' ),
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

		// $this->add_control(
		// 	'list_authors',
		// 	[
		// 		'label' => __( 'Select Authors', 'theratio' ),
		// 		'type' => Controls_Manager::SELECT2,
		// 		'options' => $this->select_list_authors(),
		// 		'multiple' => true,
		// 		'label_block' => true,
		// 		'placeholder' => __( 'All Author', 'theratio' ),
		// 	]
		// );

		$this->add_control(
			'number_show',
			[
				'label' => __( 'Show Posts Per Page', 'theratio' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '9',
			]
		);	
		$this->add_control(
			'column',
			[
				'label' => __( 'Grid Column', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [					
					'2' => __( '2 Column', 'theratio' ),
					'3' => __( '3 Column', 'theratio' ),
					'4' => __( '4 Column', 'theratio' ),
				],
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
            'show_cate',
            [
                'label' => __('Show Category', 'theratio'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'theratio'),
                'label_off' => __('Hidden', 'theratio'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'display_meta',
            [
                'label' => __('Show Entry Meta(Author/Date)', 'theratio'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'theratio'),
                'label_off' => __('Hidden', 'theratio'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination', 'theratio'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'theratio'),
                'label_off' => __('Hidden', 'theratio'),
                'return_value' => 'yes',
                'default' => 'no',
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
		$this->end_controls_section();

		/*Style*/
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Inner post', 'theratio' ),
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

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-box .post-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .post-box .post-inner',
			]
		);

		$this->end_controls_section();

		//Entry Meta
		$this->start_controls_section(
			'entry_meta_section',
			[
				'label' => __( 'Entry Meta', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_meta' => 'yes',
				]
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

		$this->end_controls_section();

		//Title
		$this->start_controls_section(
			'title_section',
			[
				'label' => __( 'Title', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE
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
					'{{WRAPPER}} .post-box .inner-post h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .post-box .inner-post h4 a' => 'color: {{VALUE}}; background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}});',
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
					'{{WRAPPER}} .post-box .inner-post h4 a:hover' => 'color: {{VALUE}}; background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}});',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-box .inner-post h4',
			]
		);

		$this->end_controls_section();

		//Excerpt
		$this->start_controls_section(
			'excerpt_section',
			[
				'label' => __( 'Excerpt', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'exc!' => [ 0,''],
				]
			]
		);
		$this->add_responsive_control(
			'exc_spacing',
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
					'{{WRAPPER}} .post-box .post-inner .the-excerpt' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exc_typography',
				'selector' => '{{WRAPPER}} .post-box .post-inner .the-excerpt'
			]
		);

		$this->end_controls_section();

		//Pagination
		$this->start_controls_section(
			'pagination_section',
			[
				'label' => __( 'Pagination', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'pagination_spacing',
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
					'{{WRAPPER}} .page-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'pagination_align',
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
				'selectors' => [
					'{{WRAPPER}} .page-pagination' => 'text-align: {{VALUE}};',
				],
				'default' => '',				
			]
		);
		$this->add_control(
			'pagination_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-pagination li a, {{WRAPPER}} .page-pagination li span' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'pagination_color_active',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .page-pagination li span, {{WRAPPER}} .page-pagination li a:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();

		$number_show = (!empty($settings['number_show']) ? $settings['number_show'] : 9);
    	$exc = (!empty($settings['exc']) ? $settings['exc'] : 15);

    	if ( get_query_var('paged') ) {
		    $paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
		    $paged = get_query_var('page');
		} else {
		    $paged = 1;
		}

    	if( $settings['post_cat'] ){
            $args = array(
            	'paged' => $paged,
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
			    // 'author__in' => $settings['list_authors']
	        );
        }else{
            $args = array(
            	'paged' => $paged,
                'post_type' => 'post',
	            'post_status' => 'publish',
	            'posts_per_page' => $number_show,
	            // 'author__in' => $settings['list_authors']
            );
        }

        $the_query = new \WP_Query($args);
        if( $the_query->have_posts() ) :
		?>
		<div class="blog-grid <?php if ( $settings['column'] === '3' ){echo 'pf_3_cols ';}elseif($settings['column'] === '4'){echo 'pf_4_cols ';}else{echo 'pf_2_cols ';} echo $settings['version_style']; ?>">
        	<?php
	        	while( $the_query->have_posts() ) : $the_query->the_post();

		            /*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );
				
					
		        endwhile; wp_reset_postdata(); 
	        ?>
	    </div>
	    <?php 
		    if ( 'yes' === $settings['show_pagination'] ) {
		    	if ( get_query_var('paged') ) {
		            $paged = get_query_var('paged');
		        } elseif ( get_query_var('page') ) { // 'page' is used instead of 'paged' on Static Front Page
		            $paged = get_query_var('page');
		        } else {
		            $paged = 1;
		        }
		        $pagination = array(
		            'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		            'format' 	=> '?paged=%#%',
		            'current' 	=> max( 1, $paged ),
		            'total' 	=> $the_query->max_num_pages,                      
		            'prev_text' => '<i class="ot-flaticon-left-arrow"></i>',
		            'next_text' => '<i class="ot-flaticon-right-arrow"></i>',       
		            'type'      => 'list',
		            'end_size'  => 3,
		            'mid_size'  => 3
		        );
		        $return =  paginate_links( $pagination );
		        echo str_replace( "<ul class='page-numbers'>", '<ul class="page-pagination none-style">', $return );
		    }
		?>
	    <?php endif; ?>

		<?php
	}

	protected function select_list_authors() {
		$args = array( 'orderby=display_name' );
		$list_users = get_users( $args );
		$data_user = array();
		if ( ! empty( $list_users ) ){
		    foreach ( $list_users as $user ) {
		        $data_user[$user->ID] = $user->data->user_nicename;
		    }
		}
	  	return $data_user;
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
// After the Theratio_Post_Grid class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Post_Grid() );