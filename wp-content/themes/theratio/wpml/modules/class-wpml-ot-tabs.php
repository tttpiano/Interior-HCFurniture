<?php

/**
 * Class WPML_OT_Tabs
 */
class WPML_OT_Tabs extends WPML_Elementor_Module_With_Items  {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'ot_tabs';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'tab_title', 'tab_content' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			
			case 'tab_title':
				return esc_html__( 'Title', 'theratio' );

			case 'tab_content':
				return esc_html__( 'Tab Content', 'theratio' );

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
			
			case 'tab_title':
				return 'LINE';

			case 'tab_content':
				return 'VISUAL';

			default:
				return '';
		}
	}

}
