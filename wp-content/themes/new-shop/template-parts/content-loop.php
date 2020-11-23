<?php
/**
 * Template part for index and archive loop
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package New-Shop
 */

?>

<div class="single-index-content col-md-9">
	<main id="main" class="main-area" role="main">
		<?php /* Start the Loop */ ?>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class('single-index'); ?>>
					<div class="index-single-post">
					
						<?php 
							//Incex post meta
							do_action( 'new_shop_index_postmeta' );
						?>
					</div>
				</article>
			<?php endwhile;	?>
		<?php endif; ?>		
		<?php 
			//Pagination
			//template-hooks.php L168 to L177
			do_action( 'new_shop_index_pagination' );
		?>
	</main>
</div>