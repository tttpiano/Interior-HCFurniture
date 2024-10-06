<?php
if( theratio_get_option('preload') != false ){

    function theratio_body_classes( $classes ) {
        $classes[] = 'royal_preloader';
        return $classes;        
    }
    add_filter( 'body_class', 'theratio_body_classes' );

    if ( ! function_exists( 'theratio_add_preloader_body_open' ) ) {
        function theratio_add_preloader_body_open() {

            echo '<div id="royal_preloader" data-mode="'.theratio_get_option('preload_mode').'"
            data-width="'.theratio_get_option('preload_logo_width').'"
            data-height="'.theratio_get_option('preload_logo_height').'"
            data-color="'.theratio_get_option('preload_txtcolor').'"
            data-bgcolor="'.theratio_get_option('preload_bgcolor').'"
            data-url="'.theratio_get_option('preload_logo').'"
            data-text="'.theratio_get_option('preload_text').'"></div>';
        }
    }
    add_action( 'wp_body_open', 'theratio_add_preloader_body_open' );

    function theratio_preload_scripts() {
        wp_enqueue_style('theratio-preload', get_template_directory_uri().'/css/royal-preload.css');
    }
    add_action( 'wp_enqueue_scripts', 'theratio_preload_scripts' );

}