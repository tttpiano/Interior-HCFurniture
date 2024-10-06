<?php

/**
 * Class WPML_OT_Testimonial_Carousel2
 */
class WPML_OT_Testimonial_Carousel2 extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'testi_slider';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'tcontent', 'title', 'tjob' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			
			case 'tcontent':
				return esc_html__( 'Content', 'theratio' );

			case 'title':
				return esc_html__( 'Title', 'theratio' );

			case 'tjob':
				return esc_html__( 'Job', 'theratio' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			
			case 'title':
			case 'tjob':
				return 'LINE';

			case 'tcontent':
				return 'AREA';

			default:
				return '';
		}
	}

}
