<?php
/**
 * Template part for displaying pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package New-Shop
 */

?>

<div class="single-entry col-md-9">
	<div class="index-title-contents">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="single-content">
		<?php 
			//Display the post content.
			the_content();

			//Displays page-links for paginated posts i.e. includes the <!--nextpage-->
			wp_link_pages();
		?>
	</div>
	<?php
		//Load the comment template
		comments_template();
	?>
</div>