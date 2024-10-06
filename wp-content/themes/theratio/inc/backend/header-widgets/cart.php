<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Cart
 */
class Theratio_Cart extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'icart';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Cart Button', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-cart';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio_header' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Icon', 'theratio' ),
			]
		);		

		$this->add_control(
			'icon_type',
			[
				'label' => __( 'Icon Type', 'theratio' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'class',
				'options' => [					
					'class' => __( 'Custom Icon', 'theratio' ),
					'text' 	=> __( 'Text Icon', 'theratio' ),
				]
			]
		);		
	    $this->add_control(
			'icon_class',
			[
				'label' => __( 'Icon Class', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'ot-flaticon-shopping-bag', 'theratio' ),
				'condition' => [
					'icon_type' => 'class',
				]
			]
		);		
		$this->add_control(
			'icon_text',
			[
				'label' => __( 'Cart Text', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Cart', 'theratio' ),
				'condition' => [
					'icon_type' => 'text',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-cart i, {{WRAPPER}} .octf-cart .cart__icon' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-cart i:before, {{WRAPPER}} .octf-cart .cart__icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'margin-right',
			[
				'label' => __( 'Margin Right', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .octf-cart .cart__icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'position_count!' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_count_section',
			[
				'label' => __( 'Count', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'position_count',
			[
				'label' => __( 'Positioning', 'theratio' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Absolute', 'theratio' ),
				'label_off' => __( 'Static', 'theratio' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'position',
			[
				'label' => __( 'Position', 'theratio' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'allowed_dimensions' => [ 'bottom', 'left' ],				
				'selectors' => [
					'{{WRAPPER}} .octf-cart .count__absolute .count' => 'bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'position_count' => 'yes',
				]
			]
		);
		$this->add_control(
			'bg_count',
			[
				'label' => __( 'Count Background', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-cart .count' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'count_color',
			[
				'label' => __( 'Count Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-cart .count' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();		
		
	}

	public static function theratio_render_menu_cart() {		
		$widget_cart_is_hidden = apply_filters( 'woocommerce_widget_cart_is_hidden', false );

		?>				
			<?php if ( ! $widget_cart_is_hidden ) : ?>
				<?php if ( !is_cart() && !is_checkout() ) { ?>
				<div class="site-header-cart">
					<?php the_widget( 'WC_Widget_Cart', array( 'title' => '' ) ); ?>
				</div>	
				<?php } ?>
			<?php endif; ?>			
		
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$icon_class = ( !empty( $settings['icon_class'] ) ? $settings['icon_class'] : 'ot-flaticon-shopping-bag' );
		$icon_text = ( !empty( $settings['icon_text'] ) ? $settings['icon_text'] : 'Cart' );		
		if ( null === WC()->cart ) {
			return;
		}
		$product_count = sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() );
		$cart_url = esc_url( wc_get_cart_url() );
		?>
		<div class="octf-cart octf-cta-header">
			<a class="cart-contents <?php if ( 'yes' === $settings['position_count'] ) { echo 'count__absolute';} ?>" href="<?php echo $cart_url; ?>" title="<?php esc_attr_e( 'View your shopping cart', 'theratio' ); ?>">
			<span class="cart__icon">
			<?php if ( $settings['icon_type'] == 'class' ) { echo '<i class="' . $icon_class . '"></i>'; } else { echo $icon_text; } ?>	
			</span>	
			<span class="count octf_load_change_cart_count"><?php echo $product_count; ?></span>
			</a>
			<?php self::theratio_render_menu_cart(); ?>
		</div>	
		<?php		
	}

}
// After the Theratio_Cart class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Theratio_Cart() );