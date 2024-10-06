<?php

/**
 * Class WPML_OT_Client_Carousel
 */
class WPML_OT_Client_Carousel extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'image_carousel';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'title', 'image_link' => array( 'url' ) );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'title':
				return esc_html__( 'Title', 'theratio' );

			case 'url':
				return esc_html__( 'Image: Link URL', 'theratio' );

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
				return 'LINE';

			case 'url':
				return 'LINK';

			default:
				return '';
		}
	}

}
