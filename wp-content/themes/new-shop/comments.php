<?php 
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package new-shop
 */
?>

<?php
/*
 * If the comment is loaded directly, die.
 */	
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ('Please do not load this page directly. Thanks!');	
	}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */	
if (post_password_required()) :?>
	<p><?php __('You have to enter post password to view comments', 'new-shop'); ?>
		<?php return; ?>
	</p>
<?php endif;

/*
 * Show comment section if comment is enabled
 */	
if(have_comments()) : ?>
	<div id="comments" class="comments clearfix">
		<h3 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'new-shop' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'new-shop'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h3>
		<?php 
			/*
			 * Show comments and replies
			 * function new_shop_comment is from functions.php
			 */	
		?>
		<ol class="comment-section">
			<?php wp_list_comments('callback=new_shop_comment'); ?>
		</ol>
	</div><!-- Comments -->
	
	<?php 
		/*
		 * Show comments navigational links
		 * if comment page count is more than 1
		 */	
	?>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div class="cmnt-nav clearfix">
			<?php previous_comments_link( __( '&larr; Older Comments', 'new-shop' ) ); ?>
			<?php next_comments_link( __( 'Newer Comments &rarr;', 'new-shop' ) ); ?>
		</div><!-- cmnt-nav -->
	<?php endif;?>
<?php 
/*
* Show comments close message 
*/
elseif (!comments_open() and !is_page()) :?>
	<p><?php echo __('Comments are closed', 'new-shop'); ?></p>
<?php endif;

/*
 * Show comment input section
 */
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$comments_args = array(		
        // change the title of send button 
        'label_submit'=> esc_html__('Submit comment', 'new-shop'),
        // change the title of the reply section
        'title_reply'=>'<div class="wi-title clearfix"><div class="w-title">'.__('Want to say something? Post a comment', 'new-shop').'</div><div class="title-bg"></div></div>',		
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' =>
			  '<div class="comment-box"><div class="row">' . 
			  '<p class="comment-form-author col-md-4 col-sm-4">' .
			  '<label for="author">' . __( 'Name', 'new-shop' ) . 
			  ( $req ? '<span class="required">*</span>' : '' ) .'</label> ' .
			  '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			  '" size="30"' . $aria_req . ' /></p>',
			'email' =>
			  '<p class="comment-form-email col-md-4 col-sm-4"><label for="email">' . __( 'Email', 'new-shop' ) . 
			  ( $req ? '<span class="required">*</span>' : '' ) .'</label> ' .
			  '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			  '" size="30"' . $aria_req . ' /></p>',
			'url' =>
			  '<p class="comment-form-url col-md-4 col-sm-4"><label for="url">' .
			  __( 'Website', 'new-shop' ) . '</label>' .
			  '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			  '" size="30" /></p>'.
			  '</div></div>',
			)
		),
	  'comment_field' =>  '<div class="comment-textbox row">'.'<p class="comment-form-comment col-md-12"><label for="comment">' . _x( 'Comment', 'noun', 'new-shop' ) .
		'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></p>'.'</div>',
);
comment_form($comments_args); ?>