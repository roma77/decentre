<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Decenter
 * @since 1.0.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'single' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) { ?>
					<div class="comments">
						<div class="content">
							<?php comments_template(); ?>
						</div>
					</div>
				<?php }
				
				get_template_part( 'template-parts/content/related_posts' );
				
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
