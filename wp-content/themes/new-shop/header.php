<?php
/**
 * Header template
 * Displays all of the head element
 * @package New-Shop
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open() ): ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>

<?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>>

	<?php 
		//Wrap open
		//inc/template-tags.php
		//function new_shop_wrap_open		
		do_action( 'new_shop_wrapopen' );

		//topbar
		//inc/template-tags.php
		//function new_shop_topbar_settings
		do_action( 'new_shop_topbar' );

		//Logo & Navigational
		//inc/template-tags.php
		//function new_shop_logo_settings
		//function new_shop_menu_settings
		//function new_shop_second_menu_settings
		do_action( 'new_shop_header' );

		//Wrap close
		//inc/template-tags.php
		//function new_shop_wrap_close
		do_action( 'new_shop_wrapclose' );
	?>