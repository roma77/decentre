<?php
/**
 * Template Name: 404 Page
 */
get_header(); ?>
<!-- Main Content -->
<div id="page-404">
<?php
	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content', 'none' );

?>
</div>
<?php get_footer(); ?>