<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage tapout
 * @since tapout
 */

get_header(); ?>

<!-- Main Content -->


<div class="tag-title">
	<?php echo get_the_author(); ?>
</div>
	
<?php
if ( have_posts() ) {
	?>
	<div class="feed u-container u-container--large">
		<div class="u-grid u-grid--vertical-margin">
			<?php 
			$count = 0;
			$subscribe_block = ($wp_query->post_count < 3) ? $wp_query->post_count : 3;
			// Load posts loop.
			while ( have_posts() ) {
				++$count;
				the_post();
				get_template_part( 'template-parts/content/content' );
				if ($count == $subscribe_block) { ?>
					<div class="subscribe_form">
					<?php get_template_part( 'template-parts/content/subscribe' ); ?>
					</div>
				<?php }
			}
			?>
		</div>
		<div class="pagination feed__pagination u-hidden-large-down">
			<?php
				the_posts_pagination( array(
					'end_size' 	=> 1,
					'prev_next' => True,
					'prev_text' => '',
					'next_text' => ''
				) ); 
			?>
		</div>
	</div>
	<?php
	// Previous/next page navigation.
	// twentynineteen_the_posts_navigation();

} else {

	// If no content, include the "No posts found" template.
	// get_template_part( 'template-parts/content/content', 'none' );
	
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
	get_template_part( 404 ); exit();

}
?>
	

	


<?php get_footer(); ?>