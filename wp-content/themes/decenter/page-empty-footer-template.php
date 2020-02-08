<?php
/**
 * Template Name: Empty footer
 */

get_header('empty');
?>

	<div class="info-container__body">
		

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'empty' );
				
				// get_template_part( 'template-parts/content/related_posts' );
				
			endwhile; // End of the loop.
			?>

		
	</div><!-- #primary -->

<?php
get_footer('empty');
