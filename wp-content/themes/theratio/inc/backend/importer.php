<?php
/**
 * Hooks for importer
 *
 * @package Theratio
 */


/**
 * Importer the demo content
 *
 * @since  1.0
 *
 */
function theratio_importer() {
	return array(
		array(
			'name'       => 'Main Home',
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 1',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Interior Design',
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home2.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 2',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Studio Home',
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home3.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 3',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Architecture Agency',
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home4.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home 4',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Design Company',
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home5.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 5',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Video',
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home7.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 7',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home Full Screen',
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home-full-screen.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home Full Screen',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home One Page',
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home-onepage.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			'sliders'    => get_template_directory_uri().'/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'One Page',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Side Navigation',
			'preview'    => get_template_directory_uri().'/inc/backend/data/sidenav/home6.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/sidenav/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/sidenav/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/sidenav/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
	);
}

add_filter( 'soo_demo_packages', 'theratio_importer', 30 );