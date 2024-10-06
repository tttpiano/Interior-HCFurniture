<?php

// Load the theme's custom Widgets so that they appear in the Elementor element panel.
add_action( 'elementor/widgets/register', 'theratio_register_elementor_widgets' );
function theratio_register_elementor_widgets() {
    // We check if the Elementor plugin has been installed / activated.
    if ( defined( 'ELEMENTOR_PATH' ) && class_exists('Elementor\Widget_Base') ) {
        // Include Elementor Widget files here.
        
        // Remove this 2 require_once line below after completed the theme.
        require_once( get_template_directory() . '/inc/backend/elementor-widgets/widgets.php' );
        require_once( get_template_directory() . '/inc/backend/header-widgets/widgets.php' );
    }
}

// Add a custom 'category_theratio' category for to the Elementor element panel so that our theme's widgets have their own category.
add_action( 'elementor/init', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_theratio',
        [
            'title' => __( 'Theratio', 'theratio' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        1 // position
    );
    \Elementor\Plugin::$instance->elements_manager->add_category( 
        'category_theratio_header',
        [
            'title' => __( 'Theratio Header', 'theratio' ),
            'icon' => 'fa fa-plug', //default icon
        ],
        2 // position
    );
});

// Post types with Elementor
function theratio_add_cpt_support() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'ot_portfolio', 'ot_header_builders', 'ot_footer_builders' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    //if it DOES exist, but portfolio is NOT defined
    else {
        $ot_portfolio       = in_array( 'ot_portfolio', $cpt_support );
        $ot_header_builders = in_array( 'ot_header_builders', $cpt_support );
        $ot_footer_builders = in_array( 'ot_footer_builders', $cpt_support );
        if( !$ot_portfolio ){
            $cpt_support[] = 'ot_portfolio'; //append to array
        }
        if( !$ot_header_builders ){
            $cpt_support[] = 'ot_header_builders'; //append to array
        }
        if( !$ot_footer_builders ){
            $cpt_support[] = 'ot_footer_builders'; //append to array
        }
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    //otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'elementor/init', 'theratio_add_cpt_support' );

// Upload SVG for Elementor
function theratio_unfiltered_files_upload() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_unfiltered_files_upload' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = '1'; //create string value default to enable upload svg
        update_option( 'elementor_unfiltered_files_upload', $cpt_support ); //write it to the database
    }
}
add_action( 'elementor/init', 'theratio_unfiltered_files_upload' );

// Header post type
add_action( 'init', 'theratio_create_header_builder' ); 
function theratio_create_header_builder() {
    register_post_type( 'ot_header_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Header Builders', 'theratio' ),
                'singular_name'     => esc_html__( 'Header Builder', 'theratio' ),
                'add_new'           => esc_html__( 'Add New', 'theratio' ),
                'add_new_item'      => esc_html__( 'Add New Header Builder', 'theratio' ),
                'edit'              => esc_html__( 'Edit', 'theratio' ),
                'edit_item'         => esc_html__( 'Edit Header Builder', 'theratio' ),
                'new_item'          => esc_html__( 'New Header Builder', 'theratio' ),
                'view'              => esc_html__( 'View', 'theratio' ),
                'view_item'         => esc_html__( 'View Header Builder', 'theratio' ),
                'search_items'      => esc_html__( 'Search Header Builders', 'theratio' ),
                'not_found'         => esc_html__( 'No Header Builders found', 'theratio' ),
                'not_found_in_trash'=> esc_html__( 'No Header Builders found in Trash', 'theratio' ),
                'parent'            => esc_html__( 'Parent Header Builder', 'theratio' )
            ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'has_archive'           => false,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

// Footer post type
add_action( 'init', 'theratio_create_footer_builder' ); 
function theratio_create_footer_builder() {
    register_post_type( 'ot_footer_builders',
        array(
            'labels' => array(
                'name'              => esc_html__( 'Footer Builders', 'theratio' ),
                'singular_name'     => esc_html__( 'Footer Builder', 'theratio' ),
                'add_new'           => esc_html__( 'Add New', 'theratio' ),
                'add_new_item'      => esc_html__( 'Add New Footer Builder', 'theratio' ),
                'edit'              => esc_html__( 'Edit', 'theratio' ),
                'edit_item'         => esc_html__( 'Edit Footer Builder', 'theratio' ),
                'new_item'          => esc_html__( 'New Footer Builder', 'theratio' ),
                'view'              => esc_html__( 'View', 'theratio' ),
                'view_item'         => esc_html__( 'View Footer Builder', 'theratio' ),
                'search_items'      => esc_html__( 'Search Footer Builders', 'theratio' ),
                'not_found'         => esc_html__( 'No Footer Builders found', 'theratio' ),
                'not_found_in_trash'=> esc_html__( 'No Footer Builders found in Trash', 'theratio' ),
                'parent'            => esc_html__( 'Parent Footer Builder', 'theratio' )
            ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'menu_position'         => 60,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'             => 'dashicons-editor-kitchensink',
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'has_archive'           => false,
            'query_var'             => true,
            'can_export'            => true,
            'capability_type'       => 'post'
        )
    );
}

/*Fix Elementor Pro*/
function theratio_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'theratio_register_elementor_locations' );

/*** add options to sections ***/
add_action('elementor/element/section/section_structure/after_section_end', function( $section, $args ) {

    /* header options */
    $section->start_controls_section(
        'section_custom_class',
        [
            'label' => __( 'For Header', 'theratio' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $section->add_control(
        'sticky_class',
        [
            'label'        => __( 'Sticky On/Off', 'theratio' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'is-fixed',
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'sticky_background',
        [
            'label'     => __( 'Background Scroll', 'theratio' ),
            'type'      => Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}.elementor-section.is-stuck' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );
    $section->add_responsive_control(
        'offset_space',
        [
            'label' => __( 'Offset', 'theratio' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}.is-stuck' => 'top: {{SIZE}}{{UNIT}};',
                '.admin-bar {{WRAPPER}}.is-stuck' => 'top: calc({{SIZE}}{{UNIT}} + 32px);',
            ],
            'condition' => [
                'sticky_class' => 'is-fixed',
            ],
        ]
    );

    $section->end_controls_section();

}, 10, 2 );

add_action('elementor/element/section/section_typo/after_section_end', function( $section, $args ) {

    /*Grid Lines*/
    $section->start_controls_section(
        'section_custom_lines',
        [
            'label' => __( 'Grid Lines', 'theratio' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $section->start_controls_tabs( 'custom_line_vertical' );
    $section->start_controls_tab(
        'line_vertical',
        [
            'label' => __( 'Grid Lines Vertical', 'theratio' ),
        ]
    );

    $section->add_control(
        'vlines_class',
        [
            'label'        => __( 'On/Off', 'theratio' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'has-lines-vertical',
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'vnumber_line',
        [
            'label' => __( 'Number Line', 'theratio' ),
            'type' => Elementor\Controls_Manager::SELECT,
            'default' => 'no-lines-vertical-center',
            'options' => [
                'no-lines-vertical-center' => __( '2 Lines', 'theratio' ),
                'has-lines-vertical-center' => __( '3 Lines', 'theratio' ),
            ],
            'condition' => [
                'vlines_class' => 'has-lines-vertical',
            ],
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'vzindex',
        [
            'label' => __( 'Z-Index', 'elementor' ),
            'type' => Elementor\Controls_Manager::NUMBER,
            'min' => 0,
            'selectors' => [
                '{{WRAPPER}} .grid-lines-vertical' => 'z-index: {{VALUE}};',
            ],
            'condition' => [
                'vlines_class' => 'has-lines-vertical',
            ],
        ]
    );
    $section->add_control(
        'vheading_line1',
        [
            'label' => __( 'Line Left', 'theratio' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'vlines_class' => 'has-lines-vertical',
            ],
        ]
    );
    $section->add_control(
        'vline1_color',
        [
            'label'        => __( 'Color', 'theratio' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-left' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'vlines_class' => 'has-lines-vertical',
            ],
        ]
    );

    $section->add_control(
        'vheading_line2',
        [
            'label' => __( 'Line Center', 'theratio' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'vlines_class' => 'has-lines-vertical',
                'vnumber_line' => 'has-lines-vertical-center'
            ],
        ]
    );
    $section->add_control(
        'vline2_color',
        [
            'label'        => __( 'Color', 'theratio' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-center' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'vlines_class' => 'has-lines-vertical',
                'vnumber_line' => 'has-lines-vertical-center'
            ],
        ]
    );

    $section->add_control(
        'vheading_line3',
        [
            'label' => __( 'Line Right', 'theratio' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'vlines_class' => 'has-lines-vertical',
            ],
        ]
    );
    $section->add_control(
        'vline3_color',
        [
            'label'        => __( 'Color', 'theratio' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-right' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'vlines_class' => 'has-lines-vertical',
            ],
        ]
    );
    $section->end_controls_tab();

    $section->start_controls_tab(
        'line_horizontal',
        [
            'label' => __( 'Grid Lines Horizontal', 'theratio' ),
        ]
    );
    $section->add_control(
        'hlines_class',
        [
            'label'        => __( 'On/Off', 'theratio' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'has-lines-horizontal',
            'prefix_class' => '',
        ]
    );
    $section->add_control(
        'hnumber_line',
        [
            'label' => __( 'Number Line', 'theratio' ),
            'type' => Elementor\Controls_Manager::SELECT,
            'default' => 'both',
            'options' => [
                'both' => __( 'Top & Bottom', 'theratio' ),
                'top' => __( 'Line Top', 'theratio' ),
                'bottom' => __( 'Line Bottom', 'theratio' ),
            ],
            'condition' => [
                'hlines_class' => 'has-lines-horizontal',
            ],
            'prefix_class' => 'has-lines-horizontal-',
        ]
    );
     $section->add_control(
        'hzindex',
        [
            'label' => __( 'Z-Index', 'elementor' ),
            'type' => Elementor\Controls_Manager::NUMBER,
            'min' => 0,
            'selectors' => [
                '{{WRAPPER}} .grid-lines-horizontal' => 'z-index: {{VALUE}};',
            ],
            'condition' => [
                'hlines_class' => 'has-lines-horizontal',
            ],
        ]
    );
    $section->add_control(
        'hheading_line1',
        [
            'label' => __( 'Line Top', 'theratio' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'hlines_class' => 'has-lines-horizontal',
                'hnumber_line' => ['both', 'top']
            ],
        ]
    );
    $section->add_control(
        'hline1_color',
        [
            'label'        => __( 'Color', 'theratio' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-top' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'hlines_class' => 'has-lines-horizontal',
                'hnumber_line' => ['both', 'top']
            ],
        ]
    );

    $section->add_control(
        'hheading_line2',
        [
            'label' => __( 'Line Bottom', 'theratio' ),
            'type' => Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'hlines_class' => 'has-lines-horizontal',
                'hnumber_line' => ['both', 'bottom']
            ],
        ]
    );
    $section->add_control(
        'hline2_color',
        [
            'label'        => __( 'Color', 'theratio' ),
            'type'         => Elementor\Controls_Manager::COLOR,
            'default'      => '',
            'selectors'    => [
                '{{WRAPPER}} .line-bottom' => 'background-color: {{VALUE}};',
            ],
           'condition' => [
                'hlines_class' => 'has-lines-horizontal',
                'hnumber_line' => ['both', 'bottom']
            ],
        ]
    );

    $section->end_controls_tab();
    $section->end_controls_tabs();

    $section->end_controls_section();

}, 10, 2 );

/*** add options to columns ***/
require get_template_directory() . '/inc/backend/column.php';