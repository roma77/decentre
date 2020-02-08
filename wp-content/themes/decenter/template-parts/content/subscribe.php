<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Decenter
 * @since 1.0.0
 */

if (is_user_logged_in()) {
	$cur_user_id = get_current_user_id();
} else {
	$cur_user_id = '';
}

?>

<div id="subscribe">
	<div class="subscribe mail">
		<div class="title">Хочу получать новости на почту!</div>
		<form method="post" class="subscribe-form">
			<div><input placeholder="Ваш e-mail..." class="subscribe-input" data-user-id="<?php echo $cur_user_id; ?>" name="EMAIL" type="email"></div>
			<?php wp_nonce_field( 'subscribe' ); ?>
			<div aria-hidden="true" style="position: absolute; left: -5000px;">
			</div>
			<input name="load_post" type="button" class="submit-subscribe" value="Подписаться" />
			
		</form>
	</div>
	<div class="separator"></div>
	<div class="subscribe tg">
		<div class="title">Хочу получать новости в TELEGRAM!</div> 
		<a href="tg://resolve?domain=DeCenter">
			<img src="<?php echo get_template_directory_uri(); ?>/img/t-logo.svg">
			Подписаться на наш канал
		</a>
	</div>
	<div class="subscribe-message"></div>
</div>

