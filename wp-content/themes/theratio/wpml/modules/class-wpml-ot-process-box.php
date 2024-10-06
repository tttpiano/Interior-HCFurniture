<?php

/**
 * Class WPML_OT_Process_Box
 */
class WPML_OT_Process_Box extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'ot_process';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'number_box', 'title', 'des' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'number_box':
				return esc_html__( 'Number', 'theratio' );

			case 'title':
				return esc_html__( 'Title', 'theratio' );

			case 'des':
				return esc_html__( 'Accordion Content', 'theratio' );

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
			case 'number_box':
				return 'LINE';

			case 'des':
				return 'AREA';

			default:
				return '';
		}
	}

}
