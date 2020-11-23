<div class="logo">
  	<?php if ( has_custom_logo() ) : ?>
		<div class="site-logo"><?php the_custom_logo(); ?></div>
	<?php endif; ?>
	<?php $blog_info = get_bloginfo( 'name' ); ?>
	  	<?php if ( ! empty( $blog_info ) ) : ?>
		    <?php if ( is_front_page() && is_home() ) : ?>
		    	<?php if( get_theme_mod('vw_newspaper_logo_title_hide_show',true) != ''){ ?>
		      		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		      	<?php } ?>
		    <?php else : ?>
		    	<?php if( get_theme_mod('vw_newspaper_logo_title_hide_show',true) != ''){ ?>
		      		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		      	<?php } ?>
		    <?php endif; ?>
	  	<?php endif; ?>
		<?php
		    $description = get_bloginfo( 'description', 'display' );
		    if ( $description || is_customize_preview() ) :
	  	?>
	  	<?php if( get_theme_mod('vw_newspaper_tagline_hide_show',true) != ''){ ?>
			<p class="site-description">
				<?php echo $description; ?>
			</p>
		<?php } ?>
	<?php endif; ?>
</div>