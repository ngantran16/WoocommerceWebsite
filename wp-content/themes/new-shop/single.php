<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package New-Shop
 */

get_header(); ?>
	

<div class="content-area container">
	<div class="single-index clearfix">
		<?php 
			if(have_posts()):
				while(have_posts()): the_post(); 
						get_template_part( 'template-parts/content', 'single' );
				endwhile;
			endif; 
		?>		
		<?php get_sidebar(); ?>		
	</div>		
</div>
<?php get_footer(); ?>