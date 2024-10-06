<?php

/**
 * Class WPML_OT_Team_Carousel
 */
class WPML_OT_Team_Carousel extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'members';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'member_name', 'member_extra', 'link' => array( 'url' ) );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			
			case 'member_name':
				return esc_html__( 'Name', 'theratio' );

			case 'member_extra':
				return esc_html__( 'Extra/Job', 'theratio' );

			case 'url':
				return esc_html__( 'Link', 'theratio' );

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
			
			case 'url':
			case 'member_name':
				return 'LINE';

			case 'member_extra':
				return 'AREA';

			default:
				return '';
		}
	}

}
