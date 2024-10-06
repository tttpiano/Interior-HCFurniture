<?php

require_once( get_template_directory() . '/inc/backend/header-widgets/logo.php' );
require_once( get_template_directory() . '/inc/backend/header-widgets/menu.php' );
require_once( get_template_directory() . '/inc/backend/header-widgets/search.php' );
require_once( get_template_directory() . '/inc/backend/header-widgets/side-panel.php' );
require_once( get_template_directory() . '/inc/backend/header-widgets/menu-mobile.php' );
if ( in_array('ot_mega-menu/ot_mega-menu.php', apply_filters('active_plugins', get_option('active_plugins'))) ){
	require_once( get_template_directory() . '/inc/backend/header-widgets/list-menu-item.php' );
}
if ( class_exists( 'woocommerce' ) ) {
    require_once( get_template_directory() . '/inc/backend/header-widgets/cart.php' );
}