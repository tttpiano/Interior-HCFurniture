<?php 
if(!function_exists('theratio_color_scheme')){
    function theratio_color_scheme(){
        $color_scheme = '';

        if( theratio_get_option('main_color') != '#9f9e9e' ){
            $color_scheme = 
            '
            /*background color*/
            .octf-swiper-button-next, .octf-swiper-button-prev,
            #back-to-top,
            .bg-primary{ background: '.theratio_get_option('main_color').'; }

            /*color*/
            blockquote cite,
            .text-primary,
            .octf-swiper-button-next:not(.swiper-button-disabled):hover, .octf-swiper-button-prev:not(.swiper-button-disabled):hover,
            a:hover, a:focus, a:active,
            .post-box .entry-meta > span a,
            .post-box .quote-box .quote-text span,
            .post-nav span:not(.title-link),
            .comments-area .comment-item .comment-meta .comment-time,
            .comment-respond .comment-reply-title small a:hover,
            .widget-area .widget ul:not(.recent-news) > li .posts-count,
            .widget .recent-news .post-on,
            .ot-heading > span,
            .blog-grid.v-dark .post-box .entry-meta > span:before, .blog-slider.v-dark .post-box .entry-meta > span:before, .dark-scheme .post-box .entry-meta > span:before,
            .team-wrap h4 a:hover,
            .team-wrap .team-social a:hover,
            .projects-grid .projects-box .portfolio-info .portfolio-cates,
            .projects-grid .projects-box .portfolio-info .portfolio-cates a{ color: '.theratio_get_option('main_color').'; }

			';
        }

        if( !empty( $color_scheme ) ){
			echo '<style type="text/css">'.$color_scheme.'</style>';
		}
    }
}
add_action('wp_head', 'theratio_color_scheme');

//Change Typography For Theme
if(!function_exists('theratio_change_typo')){
      function theratio_change_typo(){
            $second_font = theratio_get_option( 'second_font', [] );
            $third_font = theratio_get_option( 'third_font', [] );
            $data_font = array();
            if ( !empty( $second_font['font-family'] ) && $second_font['font-family'] != 'Titillium Web' ) {
                $data_font[] = 
                'h1, h2, h3, h4, h5, h6,
                blockquote,
                .number-stroke,
                .btn-details,
                .slogan-vertical p,
                .octf-btn,
                .main-navigation ul,
                .vertical-main-navigation ul,
                .mobile_nav .mobile_mainmenu,
                .page-header,
                .post-box .post-cat a,
                .post-box .link-box a,
                .post-box .quote-box .quote-text,
                .page-pagination li a, .page-pagination li span,
                .blog-post .tagcloud a,
                .blog-post .share-post a,
                .drop-cap, .elementor-drop-cap,
                .widget .tagcloud a,
                .widget-area,
                .video-popup span,
                .ot-counter,
                .ot-countdown li span,
                .ot-testimonials .testi-item .ttext:before,
                .ot-accordions .acc-item .acc-toggle,
                .ot-tabs .tab-link,
                .ot-progress,
                .circle-progress .inner-bar > span,
                .member-info,
                div.elementor-widget-heading .elementor-heading-title,
                .cart-contents .count,
                .list-menu-item-wrapper,
                .error-404 .white-btn,
                .woocommerce ul.products li.product .added_to_cart, 
                .woocommerce-page ul.products li.product .added_to_cart,
                .woocommerce span.onsale,
                .product_meta > span,
                .woocommerce .quantity .qty,
                .woocommerce div.product .woocommerce-tabs ul.tabs li a,
                .woocommerce table.shop_table,
                .cart_totals h2,
                #add_payment_method .cart-collaterals .cart_totals table td, 
                #add_payment_method .cart-collaterals .cart_totals table th,
                .woocommerce-cart .cart-collaterals .cart_totals table td, 
                .woocommerce-cart .cart-collaterals .cart_totals table th,
                .woocommerce-checkout .cart-collaterals .cart_totals table td, 
                .woocommerce-checkout .cart-collaterals .cart_totals table th,
                .woocommerce ul.product_list_widget li a:not(.remove),
                .woocommerce .widget_shopping_cart .cart_list .quantity,
                .woocommerce .widget_shopping_cart .total strong,
                .woocommerce.widget_shopping_cart .total strong,
                .woocommerce .woocommerce-widget-layered-nav-list,
                .woocommerce .widget_price_filter .price_slider_amount,
                .woocommerce #respond input#submit.disabled, 
                .woocommerce #respond input#submit:disabled,
                .woocommerce #respond input#submit:disabled[disabled], 
                .woocommerce a.button.disabled,
                .woocommerce a.button:disabled, 
                .woocommerce a.button:disabled[disabled], 
                .woocommerce button.button.disabled,
                .woocommerce button.button:disabled, 
                .woocommerce button.button:disabled[disabled],
                .woocommerce input.button.disabled, 
                .woocommerce input.button:disabled, 
                .woocommerce input.button:disabled[disabled],
                .woocommerce #respond input#submit, 
                .woocommerce a.button,
                .woocommerce button.button, 
                .woocommerce input.button,
                .woocommerce #respond input#submit.alt, 
                .woocommerce a.button.alt,
                .woocommerce button.button.alt, 
                .woocommerce input.button.alt{ font-family: '.sprintf( $second_font['font-family'] ).';}
                ';
            }

            if ( !empty( $third_font['font-family'] ) && $third_font['font-family'] != 'Josefin Sans' ) {
                $data_font[] = 
                'blockquote cite,
                .page-header .breadcrumbs li:before,
                .post-box .entry-meta,
                .post-box .quote-box .quote-text span,
                .post-nav span:not(.title-link),
                .comments-area .comment-item .comment-meta .comment-time,
                .widget-area .widget ul:not(.recent-news) > li .count,
                .widget .recent-news .post-on,
                .ot-heading > span,
                .ot-counter span,
                .team-wrap .m_extra,
                .projects-grid .projects-box .portfolio-info .portfolio-cates,
                .woocommerce .woocommerce-Price-amount{ font-family: '.sprintf( $third_font['font-family'] ).';}
                ';
            }

            if( !empty( $data_font ) ){
                echo '<style type="text/css">'.implode( ' ', $data_font ).'</style>';
            }
      }
}
add_action('wp_head', 'theratio_change_typo');