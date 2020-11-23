<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_newspaper_first_color = get_theme_mod('vw_newspaper_first_color');

	$vw_newspaper_custom_css = '';

	if($vw_newspaper_first_color != false){
		$vw_newspaper_custom_css .='.head-title, input[type="submit"], .scrollup i, .footer .custom-social-icons i, nav.woocommerce-MyAccount-navigation ul li, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce span.onsale, .sidebar input[type="submit"], .sidebar h3, .sidebar .custom-social-icons i, .date-monthwrap, .hvr-sweep-to-right:before, .footer .tagcloud a:hover, .sidebar .tagcloud a, .pagination span, .pagination a, #comments a.comment-reply-link, .sidebar .woocommerce-product-search button, .sidebar .widget_price_filter .ui-slider .ui-slider-range, .sidebar .widget_price_filter .ui-slider .ui-slider-handle, .footer .widget_price_filter .ui-slider .ui-slider-range, .footer .widget_price_filter .ui-slider .ui-slider-handle, .footer .woocommerce-product-search button, .footer a.custom_read_more, .sidebar a.custom_read_more:hover, .nav-previous a, .nav-next a, .woocommerce nav.woocommerce-pagination ul li a{';
			$vw_newspaper_custom_css .='background-color: '.esc_html($vw_newspaper_first_color).';';
		$vw_newspaper_custom_css .='}';
	}
	if($vw_newspaper_first_color != false){
		$vw_newspaper_custom_css .='#comments input[type="submit"].submit, .sidebar ul li::before, .sidebar ul.cart_list li::before, .sidebar ul.product_list_widget li::before{';
			$vw_newspaper_custom_css .='background-color: '.esc_html($vw_newspaper_first_color).'!important;';
		$vw_newspaper_custom_css .='}';
	}
	if($vw_newspaper_first_color != false){
		$vw_newspaper_custom_css .='a, .search-box i, .footer h3, .metabox span i, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .footer li a:hover, .main-navigation a:hover, .main-navigation ul.sub-menu a:hover, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, .toggle-nav i{';
			$vw_newspaper_custom_css .='color: '.esc_html($vw_newspaper_first_color).';';
		$vw_newspaper_custom_css .='}';
	}
	if($vw_newspaper_first_color != false){
		$vw_newspaper_custom_css .='{';
			$vw_newspaper_custom_css .='border-color: '.esc_html($vw_newspaper_first_color).'!important;';
		$vw_newspaper_custom_css .='}';
	}
	if($vw_newspaper_first_color != false){
		$vw_newspaper_custom_css .='nav.woocommerce-MyAccount-navigation ul li:before{';
			$vw_newspaper_custom_css .='border-left-color: '.esc_html($vw_newspaper_first_color).';';
		$vw_newspaper_custom_css .='}';
	}
	if($vw_newspaper_first_color != false){
		$vw_newspaper_custom_css .='.main-navigation ul ul{';
			$vw_newspaper_custom_css .='border-top-color: '.esc_html($vw_newspaper_first_color).';';
		$vw_newspaper_custom_css .='}';
	}
	if($vw_newspaper_first_color != false){
		$vw_newspaper_custom_css .='.main-navigation ul ul{';
			$vw_newspaper_custom_css .='border-bottom-color: '.esc_html($vw_newspaper_first_color).';';
		$vw_newspaper_custom_css .='}';
	}

	/*---------------------------Second highlight color-------------------*/

    $vw_newspaper_second_color = get_theme_mod('vw_newspaper_second_color');

	$vw_newspaper_third_color = get_theme_mod('vw_newspaper_third_color');

	if($vw_newspaper_second_color != false || $vw_newspaper_third_color != false){
		$vw_newspaper_custom_css .='.home-page-header, .footer-2{
		background: linear-gradient(to right, '.esc_html($vw_newspaper_second_color).', '.esc_html($vw_newspaper_third_color).');
		}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_newspaper_theme_lay = get_theme_mod( 'vw_newspaper_width_option','Full Width');
    if($vw_newspaper_theme_lay == 'Boxed'){
		$vw_newspaper_custom_css .='body{';
			$vw_newspaper_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_newspaper_custom_css .='}';
	}else if($vw_newspaper_theme_lay == 'Wide Width'){
		$vw_newspaper_custom_css .='body{';
			$vw_newspaper_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_newspaper_custom_css .='}';
	}else if($vw_newspaper_theme_lay == 'Full Width'){
		$vw_newspaper_custom_css .='body{';
			$vw_newspaper_custom_css .='max-width: 100%;';
		$vw_newspaper_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_newspaper_theme_lay = get_theme_mod( 'vw_newspaper_blog_layout_option','Default');
    if($vw_newspaper_theme_lay == 'Default'){
		$vw_newspaper_custom_css .='.service-box{';
			$vw_newspaper_custom_css .='';
		$vw_newspaper_custom_css .='}';
		$vw_newspaper_custom_css .='.post-main-box h2{';
			$vw_newspaper_custom_css .='padding:10px 0;';
		$vw_newspaper_custom_css .='}';
		$vw_newspaper_custom_css .='.new-text p{';
			$vw_newspaper_custom_css .='margin-top:10px;';
		$vw_newspaper_custom_css .='}';
		$vw_newspaper_custom_css .='.blogbutton-small{';
			$vw_newspaper_custom_css .='margin: 0; display: inline-block;';
		$vw_newspaper_custom_css .='}';
	}else if($vw_newspaper_theme_lay == 'Center'){
		$vw_newspaper_custom_css .='.service-box, .post-main-box h2, .new-text p, .metabox, .content-bttn, .related-post h3.section-title{';
			$vw_newspaper_custom_css .='text-align:center;';
		$vw_newspaper_custom_css .='}';
		$vw_newspaper_custom_css .='.service-box{';
			$vw_newspaper_custom_css .='border: 1px dashed #ccc; padding: 15px; margin-bottom: 5%;';
		$vw_newspaper_custom_css .='}';
		$vw_newspaper_custom_css .='.metabox{';
			$vw_newspaper_custom_css .='background: #eeeeee; padding: 10px; margin-bottom: 15px;';
		$vw_newspaper_custom_css .='}';
		$vw_newspaper_custom_css .='.blogbutton-small{';
			$vw_newspaper_custom_css .='margin: 0; display: inline-block;';
		$vw_newspaper_custom_css .='}';
	}else if($vw_newspaper_theme_lay == 'Left'){
		$vw_newspaper_custom_css .='.service-box, .post-main-box h2, .new-text p, .content-bttn{';
			$vw_newspaper_custom_css .='text-align:Left;';
		$vw_newspaper_custom_css .='}';
		$vw_newspaper_custom_css .='.service-box{';
			$vw_newspaper_custom_css .='border: 1px dashed #ccc; padding: 15px; margin-bottom: 5%;';
		$vw_newspaper_custom_css .='}';
		$vw_newspaper_custom_css .='.metabox{';
			$vw_newspaper_custom_css .='background: #eeeeee; padding: 10px; margin-bottom: 15px;';
		$vw_newspaper_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$vw_newspaper_resp_stickyheader = get_theme_mod( 'vw_newspaper_stickyheader_hide_show',false);
    if($vw_newspaper_resp_stickyheader == true){
    	$vw_newspaper_custom_css .='@media screen and (max-width:575px) {';
		$vw_newspaper_custom_css .='.header-fixed{';
			$vw_newspaper_custom_css .='display:block;';
		$vw_newspaper_custom_css .='} }';
	}else if($vw_newspaper_resp_stickyheader == false){
		$vw_newspaper_custom_css .='@media screen and (max-width:575px) {';
		$vw_newspaper_custom_css .='.header-fixed{';
			$vw_newspaper_custom_css .='display:none;';
		$vw_newspaper_custom_css .='} }';
	}

	$vw_newspaper_resp_metabox = get_theme_mod( 'vw_newspaper_metabox_hide_show',true);
    if($vw_newspaper_resp_metabox == true){
    	$vw_newspaper_custom_css .='@media screen and (max-width:575px) {';
		$vw_newspaper_custom_css .='.date-monthwrap, .metabox{';
			$vw_newspaper_custom_css .='display:block;';
		$vw_newspaper_custom_css .='} }';
	}else if($vw_newspaper_resp_metabox == false){
		$vw_newspaper_custom_css .='@media screen and (max-width:575px) {';
		$vw_newspaper_custom_css .='.date-monthwrap, .metabox{';
			$vw_newspaper_custom_css .='display:none;';
		$vw_newspaper_custom_css .='} }';
	}

	$vw_newspaper_resp_sidebar = get_theme_mod( 'vw_newspaper_sidebar_hide_show',true);
    if($vw_newspaper_resp_sidebar == true){
    	$vw_newspaper_custom_css .='@media screen and (max-width:575px) {';
		$vw_newspaper_custom_css .='.sidebar{';
			$vw_newspaper_custom_css .='display:block;';
		$vw_newspaper_custom_css .='} }';
	}else if($vw_newspaper_resp_sidebar == false){
		$vw_newspaper_custom_css .='@media screen and (max-width:575px) {';
		$vw_newspaper_custom_css .='.sidebar{';
			$vw_newspaper_custom_css .='display:none;';
		$vw_newspaper_custom_css .='} }';
	}

	$vw_newspaper_resp_scroll_top = get_theme_mod( 'vw_newspaper_resp_scroll_top_hide_show',true);
    if($vw_newspaper_resp_scroll_top == true){
    	$vw_newspaper_custom_css .='@media screen and (max-width:575px) {';
		$vw_newspaper_custom_css .='.scrollup i{';
			$vw_newspaper_custom_css .='display:block;';
		$vw_newspaper_custom_css .='} }';
	}else if($vw_newspaper_resp_scroll_top == false){
		$vw_newspaper_custom_css .='@media screen and (max-width:575px) {';
		$vw_newspaper_custom_css .='.scrollup i{';
			$vw_newspaper_custom_css .='display:none !important;';
		$vw_newspaper_custom_css .='} }';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$vw_newspaper_sticky_header_padding = get_theme_mod('vw_newspaper_sticky_header_padding');
	if($vw_newspaper_sticky_header_padding != false){
		$vw_newspaper_custom_css .='.header-fixed{';
			$vw_newspaper_custom_css .='padding: '.esc_html($vw_newspaper_sticky_header_padding).';';
		$vw_newspaper_custom_css .='}';
	}

	/*------------------ Search Settings -----------------*/
	
	$vw_newspaper_search_font_size = get_theme_mod('vw_newspaper_search_font_size');
	if($vw_newspaper_search_font_size != false){
		$vw_newspaper_custom_css .='.search-box i{';
			$vw_newspaper_custom_css .='font-size: '.esc_html($vw_newspaper_search_font_size).';';
		$vw_newspaper_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_newspaper_button_padding_top_bottom = get_theme_mod('vw_newspaper_button_padding_top_bottom');
	$vw_newspaper_button_padding_left_right = get_theme_mod('vw_newspaper_button_padding_left_right');
	if($vw_newspaper_button_padding_top_bottom != false || $vw_newspaper_button_padding_left_right != false){
		$vw_newspaper_custom_css .='.blogbutton-small{';
			$vw_newspaper_custom_css .='padding-top: '.esc_html($vw_newspaper_button_padding_top_bottom).'; padding-bottom: '.esc_html($vw_newspaper_button_padding_top_bottom).';padding-left: '.esc_html($vw_newspaper_button_padding_left_right).';padding-right: '.esc_html($vw_newspaper_button_padding_left_right).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_button_border_radius = get_theme_mod('vw_newspaper_button_border_radius');
	if($vw_newspaper_button_border_radius != false){
		$vw_newspaper_custom_css .='.blogbutton-small,.hvr-sweep-to-right:before{';
			$vw_newspaper_custom_css .='border-radius: '.esc_html($vw_newspaper_button_border_radius).'px;';
		$vw_newspaper_custom_css .='}';
	}

	$show_header = get_theme_mod( 'vw_newspaper_button_border', false);
	if($show_header == true){
		$vw_newspaper_custom_css .='.blogbutton-small{';
			$vw_newspaper_custom_css .='border:1px solid #000;';
		$vw_newspaper_custom_css .='}';
	}

	/*------------- Single Blog Page------------------*/

	$vw_newspaper_single_blog_post_navigation_show_hide = get_theme_mod('vw_newspaper_single_blog_post_navigation_show_hide',true);
	if($vw_newspaper_single_blog_post_navigation_show_hide != true){
		$vw_newspaper_custom_css .='.post-navigation{';
			$vw_newspaper_custom_css .='display: none;';
		$vw_newspaper_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_newspaper_copyright_alingment = get_theme_mod('vw_newspaper_copyright_alingment');
	if($vw_newspaper_copyright_alingment != false){
		$vw_newspaper_custom_css .='.copyright p{';
			$vw_newspaper_custom_css .='text-align: '.esc_html($vw_newspaper_copyright_alingment).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_copyright_padding_top_bottom = get_theme_mod('vw_newspaper_copyright_padding_top_bottom');
	if($vw_newspaper_copyright_padding_top_bottom != false){
		$vw_newspaper_custom_css .='#footer-2{';
			$vw_newspaper_custom_css .='padding-top: '.esc_html($vw_newspaper_copyright_padding_top_bottom).'; padding-bottom: '.esc_html($vw_newspaper_copyright_padding_top_bottom).';';
		$vw_newspaper_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_newspaper_scroll_to_top_font_size = get_theme_mod('vw_newspaper_scroll_to_top_font_size');
	if($vw_newspaper_scroll_to_top_font_size != false){
		$vw_newspaper_custom_css .='.scrollup i{';
			$vw_newspaper_custom_css .='font-size: '.esc_html($vw_newspaper_scroll_to_top_font_size).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_scroll_to_top_padding = get_theme_mod('vw_newspaper_scroll_to_top_padding');
	$vw_newspaper_scroll_to_top_padding = get_theme_mod('vw_newspaper_scroll_to_top_padding');
	if($vw_newspaper_scroll_to_top_padding != false){
		$vw_newspaper_custom_css .='.scrollup i{';
			$vw_newspaper_custom_css .='padding-top: '.esc_html($vw_newspaper_scroll_to_top_padding).';padding-bottom: '.esc_html($vw_newspaper_scroll_to_top_padding).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_scroll_to_top_width = get_theme_mod('vw_newspaper_scroll_to_top_width');
	if($vw_newspaper_scroll_to_top_width != false){
		$vw_newspaper_custom_css .='.scrollup i{';
			$vw_newspaper_custom_css .='width: '.esc_html($vw_newspaper_scroll_to_top_width).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_scroll_to_top_height = get_theme_mod('vw_newspaper_scroll_to_top_height');
	if($vw_newspaper_scroll_to_top_height != false){
		$vw_newspaper_custom_css .='.scrollup i{';
			$vw_newspaper_custom_css .='height: '.esc_html($vw_newspaper_scroll_to_top_height).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_scroll_to_top_border_radius = get_theme_mod('vw_newspaper_scroll_to_top_border_radius');
	if($vw_newspaper_scroll_to_top_border_radius != false){
		$vw_newspaper_custom_css .='.scrollup i{';
			$vw_newspaper_custom_css .='border-radius: '.esc_html($vw_newspaper_scroll_to_top_border_radius).'px;';
		$vw_newspaper_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_newspaper_social_icon_font_size = get_theme_mod('vw_newspaper_social_icon_font_size');
	if($vw_newspaper_social_icon_font_size != false){
		$vw_newspaper_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i, .footer-2 .custom-social-icons i{';
			$vw_newspaper_custom_css .='font-size: '.esc_html($vw_newspaper_social_icon_font_size).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_social_icon_padding = get_theme_mod('vw_newspaper_social_icon_padding');
	if($vw_newspaper_social_icon_padding != false){
		$vw_newspaper_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_newspaper_custom_css .='padding: '.esc_html($vw_newspaper_social_icon_padding).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_social_icon_width = get_theme_mod('vw_newspaper_social_icon_width');
	if($vw_newspaper_social_icon_width != false){
		$vw_newspaper_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_newspaper_custom_css .='width: '.esc_html($vw_newspaper_social_icon_width).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_social_icon_height = get_theme_mod('vw_newspaper_social_icon_height');
	if($vw_newspaper_social_icon_height != false){
		$vw_newspaper_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_newspaper_custom_css .='height: '.esc_html($vw_newspaper_social_icon_height).';';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_social_icon_border_radius = get_theme_mod('vw_newspaper_social_icon_border_radius');
	if($vw_newspaper_social_icon_border_radius != false){
		$vw_newspaper_custom_css .='.sidebar .custom-social-icons i, .footer .custom-social-icons i{';
			$vw_newspaper_custom_css .='border-radius: '.esc_html($vw_newspaper_social_icon_border_radius).'px;';
		$vw_newspaper_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_newspaper_products_padding_top_bottom = get_theme_mod('vw_newspaper_products_padding_top_bottom');
	if($vw_newspaper_products_padding_top_bottom != false){
		$vw_newspaper_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_newspaper_custom_css .='padding-top: '.esc_html($vw_newspaper_products_padding_top_bottom).'!important; padding-bottom: '.esc_html($vw_newspaper_products_padding_top_bottom).'!important;';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_products_padding_left_right = get_theme_mod('vw_newspaper_products_padding_left_right');
	if($vw_newspaper_products_padding_left_right != false){
		$vw_newspaper_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_newspaper_custom_css .='padding-left: '.esc_html($vw_newspaper_products_padding_left_right).'!important; padding-right: '.esc_html($vw_newspaper_products_padding_left_right).'!important;';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_products_box_shadow = get_theme_mod('vw_newspaper_products_box_shadow');
	if($vw_newspaper_products_box_shadow != false){
		$vw_newspaper_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$vw_newspaper_custom_css .='box-shadow: '.esc_html($vw_newspaper_products_box_shadow).'px '.esc_html($vw_newspaper_products_box_shadow).'px '.esc_html($vw_newspaper_products_box_shadow).'px #ddd;';
		$vw_newspaper_custom_css .='}';
	}

	$vw_newspaper_products_border_radius = get_theme_mod('vw_newspaper_products_border_radius');
	if($vw_newspaper_products_border_radius != false){
		$vw_newspaper_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_newspaper_custom_css .='border-radius: '.esc_html($vw_newspaper_products_border_radius).'px;';
		$vw_newspaper_custom_css .='}';
	}

