<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Decenter
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h6 class="article__comment-list-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: Post title. */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'twentyseventeen' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: Number of comments, 2: Post title. */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'twentyseventeen'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h6>

		<div class="comment-list">
			<?php
				wp_list_comments(
					array(
						'avatar_size' => 100,
						'style'       => 'div',
						'short_ping'  => true,
						'login_text'  => '',
						/* 'reply_text'  => twentyseventeen_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'twentyseventeen' ),*/
					)
				);
			?>
		</div>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => /* twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . */ '<span class="screen-reader-text">' . __( 'Previous', 'twentyseventeen' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'twentyseventeen' ) . '</span>' /* . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) )*/ ,
			)
		);

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyseventeen' ); ?></p>
		<?php
	endif;
	?>
	<div class="comment__controls">
		<div class="comment__controls-inner">
		<?php
		if (is_user_logged_in() || have_comments()) {
			$title_reply = __('[:ru]Добавить комментарий[:en]Add Comments[:zh]添加评论[:]');
		} else {
			$title_reply = '0 ' . __('[:ru]комментариев[:en]Comments[:zh]评论[:]');
		}

		comment_form(array(
			'title_reply' => $title_reply,
			'comment_field' => '<p class="comment-form-comment"><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
		));
		?>
		</div>
	</div>
	
	

</div><!-- #comments -->
