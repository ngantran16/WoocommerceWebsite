<?php
/**
 * Footer template
 *
 * @package New-Shop
 */
?>

<div class="footer container-fluid">
	<div class="container footer-content">
			<div class="row">
				<div class="footer-copyright">
					<p><?php echo esc_html__( 'Copyright  &copy; ', 'new-shop' ). date_i18n(__('Y','new-shop')); ?><a href="<?php echo esc_url( home_url() ); ?>">  <?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></p> 
				</div>
				<div class="footer-credit">
					<p><?php echo esc_html__( 'powered by  ', 'new-shop' )?><a href="http://www.wordpress.org" target="_blank" rel="nofollow"><?php echo esc_html__( 'WordPress', 'new-shop' )?></a></p>
				</div>
			</div>
		</div>
</div>
<?php wp_footer(); ?>
</body><!-- body -->
</html><!-- html -->