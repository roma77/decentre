<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage 
 * @since 1.0.0
 */

get_header();
?>
	<div id="search-results">
		<div class="search-title">
		<?php 
		_e('[:ru]Найдено[:en]Found[:zh]找到[:]');
		echo ' <b>' . $wp_query->post_count . '</b> '; 
		_e('[:ru]результатов по вашему запросу[:en]results for your request[:zh]符合您要求的结果[:]');
		echo ' <b>' . htmlspecialchars(strip_tags($_GET["s"])) . '</b>'; 
		?>
		</div>
		<?php echo do_shortcode('[search]'); ?>
	</div>
		<?php if ( have_posts() ) : ?>
			<div class="feed u-container u-container--large">
				<div class="u-grid u-grid--vertical-margin">
					<?php 
					$count = 0;
					$subscribe_block = ($wp_query->post_count < 3) ? $wp_query->post_count : 3;
					// Start the Loop.
					while ( have_posts() ) :
						++$count;
					the_post();
					get_template_part( 'template-parts/content/content' );
					if ($count == $subscribe_block) { ?>
						<div class="subscribe_form">
						<?php get_template_part( 'template-parts/content/subscribe' ); ?>
						</div>
					<?php }

					// End the loop.
					endwhile;
					
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
				
		
			
			<?php

			// If no content, include the "No posts found" template.
			else : ?>
				<div class="feed__no-posts">
					<?php _e('[:ru]Нет постов[:en]No posts[:zh]沒有文章[:]'); ?>
				</div>
			<?php
			endif;
			?>
			</div>

<?php












get_footer();
