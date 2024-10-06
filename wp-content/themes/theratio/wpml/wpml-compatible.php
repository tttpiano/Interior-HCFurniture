<?php 
 
/**
 * OT Widgets being translated:
 */

class WPML_OT_Elements_Compatibility {

  private static $_instance = null;

  public static function instance() {

    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  private function __construct() {
    
    if ( ! self::is_wpml_active() ) {
      return;
    }

    // Load Elementor files.
    add_action( 'elementor/init', array( $this, 'wpml_compatible_init' ) );

  }

  public function wpml_compatible_init() {

    $this->includes();

    add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_ot_widgets' ] );
  }

  /**
   * Is WPML Active
   *
   * Check if WPML Multilingual CMS and WPML String Translation active
   *
   * @access private
   *
   * @return boolean is WPML String Translation
   */
  public static function is_wpml_active() {

    include_once ABSPATH . 'wp-admin/includes/plugin.php';

    $wpml = is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' );

    $wpml_trans = is_plugin_active( 'wpml-string-translation/plugin.php' );

    return $wpml && $wpml_trans;

  }

  /**
   *
   * Includes
   *
   * Integrations class for widgets with complex controls.
   */
  public function includes() {

    include_once 'modules/class-wpml-ot-accordion.php';
    include_once 'modules/class-wpml-ot-client-carousel.php';
    include_once 'modules/class-wpml-ot-process-box.php';
    include_once 'modules/class-wpml-ot-tabs.php';
    include_once 'modules/class-wpml-ot-team-carousel.php';
    include_once 'modules/class-wpml-ot-testimonial-carousel2.php';
    include_once 'modules/class-wpml-ot-testimonial-carousel.php';

  }
  
  public function wpml_ot_widgets($widgets){

    $widgets = $this->ot_heading($widgets);
    $widgets = $this->ot_accordions($widgets);
    $widgets = $this->ot_before_after($widgets);
    $widgets = $this->ot_button($widgets);
    $widgets = $this->ot_client_carousel($widgets);
    $widgets = $this->ot_contact_info($widgets);
    $widgets = $this->ot_countdown($widgets);
    $widgets = $this->ot_counter($widgets);
    $widgets = $this->ot_features_box($widgets);
    $widgets = $this->ot_flip_box($widgets);
    $widgets = $this->ot_icon_box1($widgets);
    $widgets = $this->ot_icon_box2($widgets);
    $widgets = $this->ot_icon_box3($widgets);
    $widgets = $this->ot_image_box($widgets);
    $widgets = $this->ot_message_box($widgets);
    $widgets = $this->ot_portfolio_metro($widgets);
    $widgets = $this->ot_portfolio_grid($widgets);
    $widgets = $this->ot_pricing_table($widgets);
    $widgets = $this->ot_process_box($widgets);
    $widgets = $this->ot_progress($widgets);
    $widgets = $this->ot_service_box($widgets);
    $widgets = $this->ot_tabs($widgets);
    $widgets = $this->ot_team_carousel($widgets);
    $widgets = $this->ot_team($widgets);
    $widgets = $this->ot_testimonial_carousel2($widgets);
    $widgets = $this->ot_testimonial_carousel($widgets);
    $widgets = $this->ot_video_button($widgets);
    return $widgets;
  }

  /**
   * Widgets to translate.
   *
   * @access public
   *
   * @param array $widgets Widget array.
   *
   */

  private function ot_accordions($widgets){
    $widgets[ 'iaccordions' ] = [
      'conditions'    => ['widgetType' => 'iaccordions'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Accordion',
    ];
    return $widgets;
  }

  private function ot_before_after($widgets){
    $widgets[ 'ibeforeafter' ] = [
      'conditions'    => ['widgetType' => 'ibeforeafter'],
      'fields'        => [
        [
          'field' => 'before_text',
          'type'  => __( 'Before', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'after_text',
          'type'  => __( 'After', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_button($widgets){
    $widgets[ 'ibutton' ] = [
      'conditions'    => ['widgetType' => 'ibutton'],
      'fields'        => [
        [
          'field' => 'text',
          'type'  => __( 'Click here', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Button: Link URL', 'theratio' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function ot_client_carousel($widgets){
    $widgets[ 'theratio-image-carousel' ] = [
      'conditions'    => ['widgetType' => 'theratio-image-carousel'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Client_Carousel',
    ];
    return $widgets;
  }

  private function ot_contact_info($widgets){
    $widgets[ 'icontact_info' ] = [
      'conditions'    => ['widgetType' => 'icontact_info'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'des',
          'type'  => __( 'Infomation', 'theratio' ),
          'editor_type'   => 'AREA'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_countdown($widgets){
    $widgets[ 'icountdown' ] = [
      'conditions'    => ['widgetType' => 'icountdown'],
      'fields'        => [
        [
          'field' => 'day',
          'type'  => __( 'Day', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'hour',
          'type'  => __( 'Hour', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'min',
          'type'  => __( 'Minute', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'second',
          'type'  => __( 'Second', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'days',
          'type'  => __( 'Days', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'hours',
          'type'  => __( 'Hours', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'mins',
          'type'  => __( 'Minutes', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'seconds',
          'type'  => __( 'Seconds', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_counter($widgets){
    $widgets[ 'icounter' ] = [
      'conditions'    => ['widgetType' => 'icounter'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'before_number',
          'type'  => __( 'Before Number', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'number',
          'type'  => __( 'Number', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'after_number',
          'type'  => __( 'After Number', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_features_box($widgets){
    $widgets[ 'ifeaturedbox' ] = [
      'conditions'    => ['widgetType' => 'ifeaturedbox'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Features Box: Link URL', 'theratio' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function ot_flip_box($widgets){
    $widgets[ 'iflip_box' ] = [
      'conditions'    => ['widgetType' => 'iflip_box'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'des',
          'type'        => __( 'Description', 'theratio' ),
          'editor_type' => 'AREA'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_heading($widgets){
    $widgets[ 'iheading' ] = [
      'conditions'    => ['widgetType' => 'iheading'],
      'fields'        => [
        [
          'field' => 'sub',
          'type'  => __( 'Sub heading', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'title',
          'type'  => __( 'Heading', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_icon_box1($widgets){
    $widgets[ 'iiconbox1' ] = [
      'conditions'    => ['widgetType' => 'iiconbox1'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'des',
          'type'        => __( 'Description', 'theratio' ),
          'editor_type' => 'AREA'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Icon Box Link', 'theratio' ),
          'editor_type' => 'LINK'
        ),
        [
          'field'       => 'btn_text',
          'type'        => __( 'Button Text', 'theratio' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_icon_box2($widgets){
    $widgets[ 'iiconbox2' ] = [
      'conditions'    => ['widgetType' => 'iiconbox2'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'des',
          'type'        => __( 'Description', 'theratio' ),
          'editor_type' => 'AREA'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Icon Box Link', 'theratio' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function ot_icon_box3($widgets){
    $widgets[ 'iiconbox3' ] = [
      'conditions'    => ['widgetType' => 'iiconbox3'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'des',
          'type'        => __( 'Description', 'theratio' ),
          'editor_type' => 'AREA'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Icon Box Link', 'theratio' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function ot_image_box($widgets){
    $widgets[ 'imagecategory' ] = [
      'conditions'    => ['widgetType' => 'imagecategory'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'number',
          'type'        => __( 'Number', 'theratio' ),
          'editor_type' => 'LINE'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Link', 'theratio' ),
          'editor_type' => 'LINK'
        ),
      ]
    ];
    return $widgets;
  }

  private function ot_message_box($widgets){
    $widgets[ 'imessagebox' ] = [
      'conditions'    => ['widgetType' => 'imessagebox'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'des',
          'type'        => __( 'Description', 'theratio' ),
          'editor_type' => 'AREA'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_portfolio_metro($widgets){
    $widgets[ 'ipfilter_metro' ] = [
      'conditions'    => ['widgetType' => 'ipfilter_metro'],
      'fields'        => [
        [
          'field' => 'all_text',
          'type'  => __( 'All Text', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'load_more',
          'type'        => __( 'Load More Button', 'theratio' ),
          'editor_type' => 'LINE'
        ],
        [
          'field'       => 'loading_more',
          'type'        => __( 'Loading Text', 'theratio' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_portfolio_grid($widgets){
    $widgets[ 'ipfilter' ] = [
      'conditions'    => ['widgetType' => 'ipfilter'],
      'fields'        => [
        [
          'field' => 'all_text',
          'type'  => __( 'All Text', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'load_more',
          'type'        => __( 'Load More Button', 'theratio' ),
          'editor_type' => 'LINE'
        ],
        [
          'field'       => 'loading_more',
          'type'        => __( 'Loading Text', 'theratio' ),
          'editor_type' => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_pricing_table($widgets){
    $widgets[ 'ipricingtable' ] = [
      'conditions'    => ['widgetType' => 'ipricingtable'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'price',
          'type'  => __( 'Price', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field' => 'price_for',
          'type'  => __( 'Text Under Price', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'details',
          'type'        => __( 'Details', 'theratio' ),
          'editor_type' => 'AREA'
        ],
        [
          'field'       => 'label_link',
          'type'        => __( 'Button', 'theratio' ),
          'editor_type' => 'LINE'
        ],
        'link'          => array(
          'field'       => 'url',
          'type'        => __( 'Link Pricing Table:', 'theratio' ),
          'editor_type' => 'LINE'
        )
      ]
    ];
    return $widgets;
  }

  private function ot_process_box($widgets){
    $widgets[ 'iprocessbox' ] = [
      'conditions'    => ['widgetType' => 'iprocessbox'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Process_Box',
    ];
    return $widgets;
  }

  private function ot_progress($widgets){
    $widgets[ 'iprogress' ] = [
      'conditions'    => ['widgetType' => 'iprogress'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_service_box($widgets){
    $widgets[ 'theratio-service-box' ] = [
      'conditions'    => ['widgetType' => 'theratio-service-box'],
      'fields'        => [
        [
          'field' => 'title',
          'type'  => __( 'Title', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'description',
          'type'        => __( 'Description', 'theratio' ),
          'editor_type' => 'AREA'
        ],
        'link' => array(
          'field'       => 'url',
          'type'        => __( 'Button: Link URL', 'theratio' ),
          'editor_type' => 'LINK'
        ),
        [
          'field' => 'btn_text',
          'type'  => __( 'Button Text', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
      ]
    ];
    return $widgets;
  }

  private function ot_tabs($widgets){
    $widgets[ 'itabs' ] = [
      'conditions'    => ['widgetType' => 'itabs'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Tabs',
    ];
    return $widgets;
  }

  private function ot_team_carousel($widgets){
    $widgets[ 'imembercarousel' ] = [
      'conditions'    => ['widgetType' => 'imembercarousel'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Team_Carousel',
    ];
    return $widgets;
  }

  private function ot_team($widgets){
    $widgets[ 'imember' ] = [
      'conditions'    => ['widgetType' => 'imember'],
      'fields'        => [
        [
          'field' => 'member_name',
          'type'  => __( 'Name', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'member_extra',
          'type'        => __( 'Extra/Job', 'theratio' ),
          'editor_type' => 'AREA'
        ],
        'link'          => array(
          'field'       => 'url',
          'type'        => __( 'Link', 'theratio' ),
          'editor_type' => 'LINE'
        )
      ]
    ];
    return $widgets;
  }

  private function ot_testimonial_carousel2($widgets){
    $widgets[ 'itestimonials2' ] = [
      'conditions'    => ['widgetType' => 'itestimonials2'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Testimonial_Carousel2',
    ];
    return $widgets;
  }

  private function ot_testimonial_carousel($widgets){
    $widgets[ 'itestimonials' ] = [
      'conditions'    => ['widgetType' => 'itestimonials'],
      'fields'            => array(),
      'integration-class' => 'WPML_OT_Testimonial_Carousel',
    ];
    return $widgets;
  }

  private function ot_video_button($widgets){
    $widgets[ 'ivideopopup' ] = [
      'conditions'    => ['widgetType' => 'ivideopopup'],
      'fields'        => [
        [
          'field' => 'vlink',
          'type'  => __( 'Video Link', 'theratio' ),
          'editor_type'   => 'LINE'
        ],
        [
          'field'       => 'caption',
          'type'        => __( 'Caption', 'theratio' ),
          'editor_type' => 'AREA'
        ],
      ]
    ];
    return $widgets;
  }
}

WPML_OT_Elements_Compatibility::instance();
