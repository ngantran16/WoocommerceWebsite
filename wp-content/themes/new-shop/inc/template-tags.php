<?php
/**
* Template hooks
* @package new-shop
*/

//Header wrap open
if ( ! function_exists( 'new_shop_wrap_open' ) ) {
	function new_shop_wrap_open() {
		?>
		<header id="site-head" class="site-head" role="banner">
		<?php 
	}
}

//Header wrap close
if ( ! function_exists( 'new_shop_wrap_close' ) ) {
	function new_shop_wrap_close() {
		?>
		</header>
		<?php 
	}
}


//Top Bar
if ( ! function_exists( 'new_shop_topbar_settings' ) ) {
	function new_shop_topbar_settings() {
		?>
		<div class="top-bar container-fluid">
			<div class="container clearfix">
				<div class="row">
					<div class="top-left col-md-6">
						<?php wp_nav_menu( array('theme_location' => 'pagenav','fallback_cb' => 'false','menu_id' => 'top-menu','menu_class' => 'top-menu','items_wrap' => '<ul id="top-menu" class="%2$s">%3$s</ul>') ); ?>
					</div>
				</div>
			</div>			
		</div>
		<?php 
	}
}


if ( ! function_exists( 'new_shop_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 * Does nothing if the custom logo is not available.
 */
function new_shop_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


/* -- Logo */
if ( ! function_exists( 'new_shop_logo_settings' ) ) {
	function new_shop_logo_settings() {
		?>
<div id="site-logo" class="logo-area container">
			<div class="row">
				<div class="logo col-md-4">
					<?php new_shop_custom_logo(); 
					if ( is_front_page() && is_home() ) : ?>		
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
					</div>
					<div class="header-search clearfix col-md-6">
						<?php do_action( 'new_shop_product_search' ); ?>
					</div>
					<div class="header-cart-button col-md-2">
						<?php do_action( 'new_shop_theme_header_top' ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

/* -- Navigation menu */
if ( ! function_exists( 'new_shop_menu_settings' ) ) {
	function new_shop_menu_settings() {
		?>
<nav id="header-navigation" class="main-navigation container-fluid">
			<div class="main-navigation-content container">
				<?php wp_nav_menu( array('theme_location' => 'catnav','menu_id' => 'menu','menu_class' => 'navi','fallback_cb' => 'false','items_wrap' => '<ul id="menu" class="%2$s">%3$s</ul>') ); ?>
			</div>
		</nav>
		<?php
	}
}

if ( ! function_exists( 'new_shop_second_menu_settings' ) ) {
	function new_shop_second_menu_settings() {
		?>
<nav id="header-secondary-navigation" class="secondary-navigation container-fluid">
			<div class="secondary-navigation-content container">
			<p><?php _e('Quick Links', 'new-shop'); ?></p>
			<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
			<?php wp_nav_menu( array('theme_location' => 'secondnav','menu_id' => 'second-menu','depth' => 0,'fallback_cb' => 'false','menu_class' => 'second-navi','items_wrap' => '<ul id="secondary-navigation-links" class="%2$s">%3$s</ul>') ); ?>
			</div>
		</nav>
		<?php
	}
}

/* -- post meta for single post and single page */
if ( ! function_exists( 'new_shop_post_meta' ) ) {
	function new_shop_post_meta() {
		?>
		<div class="index-single-post-content clearfix">
			<div class="index-title-content">
				<h1><?php the_title(); ?></h1>
				<aside class="index-meta clearfix">										
					<div class="index-date-meta clearfix">
						<span><i class="fa fa-pencil" aria-hidden="true"></i><p><?php the_author_posts_link(); ?></p><i class="fa fa-calendar"></i><p><?php the_time( get_option( 'date_format' ) ); ?></p><i class="fa fa-comments-o" aria-hidden="true"></i><p><?php comments_popup_link( __( 'post a comment', 'new-shop' ), __( '1 Comment', 'new-shop' ), __( '% Comments', 'new-shop' ),'', __( 'Comments Off', 'new-shop' ));?></p></span>
					</div>
				</aside>
			</div>
		</div>
	<?php 
	}
}

/* -- previous / next post navigation for single post and single page */
if ( ! function_exists( 'new_shop_post_navigation' ) ) {
	function new_shop_post_navigation() {
		?>
	<div class="single-postnav clearfix">
		<hr>
			<div class="row clearfix">	
				<div class="next-post col-md-6 col-sm-6 col-xs-6"><?php next_post_link( '<i class="fa fa-chevron-circle-left"></i> %link'); ?></div>
				<div class="previous-post col-md-6 col-sm-6 col-xs-6"><?php previous_post_link( '%link <i class="fa fa-chevron-circle-right"></i>'); ?></div>
			</div>
		<hr>
	</div>
	<?php 
	}
}

/* -- post meta for index and archive lists */
if ( ! function_exists( 'new_shop_index_post_meta' ) ) {
	function new_shop_index_post_meta() {
		?>
		<div class="index-single-post-content clearfix">
			<?php if ( has_post_thumbnail() ) the_post_thumbnail('new-shop-index');?><!-- thumbnail picture -->
			<div class="index-title-content">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<aside class="index-meta clearfix">										
					<div class="index-date-meta clearfix">
						<span><i class="fa fa-pencil" aria-hidden="true"></i><p><?php the_author_posts_link(); ?></p><i class="fa fa-calendar"></i><p><?php the_time( get_option( 'date_format' ) ); ?></p><i class="fa fa-comments-o" aria-hidden="true"></i><p><?php comments_popup_link( __( 'post a comment', 'new-shop' ), __( '1 Comment', 'new-shop' ), __( '% Comments', 'new-shop' ),'', __( 'Comments Off', 'new-shop' ));?></p></span>
					</div>
				</aside>
				<?php the_excerpt(); ?>
			</div>
			<div class="index-content-readmore">
				<a href="<?php the_permalink(); ?>"><?php _e('Read More', 'new-shop'); ?></a>
			</div>
		</div>
	<hr>
	<?php 
	}
}

/* -- pagination for index & archives */
if ( ! function_exists( 'new_shop_index_pagination' ) ) {
	function new_shop_index_pagination() {
		?>
		<div class="index-pagination">
			<?php echo the_posts_pagination(); ?>
		</div>
		<?php 
	}
}

add_action( 'new_shop_wrapopen', 'new_shop_wrap_open', 0 );
add_action( 'new_shop_wrapclose', 'new_shop_wrap_close', 0 );
add_action( 'new_shop_topbar', 'new_shop_topbar_settings', 0 );
add_action( 'new_shop_header', 'new_shop_logo_settings', 10 );
add_action( 'new_shop_header', 'new_shop_menu_settings', 20 );
add_action( 'new_shop_header', 'new_shop_second_menu_settings', 30 );
add_action( 'new_shop_postmeta', 'new_shop_post_meta', 0 ); // Post meta *L107 to L128*
add_action( 'new_shop_postnavigation', 'new_shop_post_navigation', 0 ); // Post navigation *L130 to L142*
add_action( 'new_shop_index_postmeta', 'new_shop_index_post_meta', 0 ); // Post meta *L146 to L166*
add_action( 'new_shop_index_pagination', 'new_shop_index_pagination', 0 ); // Post meta *L168 to L177*