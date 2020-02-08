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

?>



<div itemscope="itemscope" itemtype="http://schema.org/Article" class="feed__item u-cell u-cell--medium--1-3">
	<a href="<?php echo get_permalink(); ?>">
		<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
	</a> 
	<a href="<?php echo esc_url( get_permalink()); ?>" itemprop="name" class="feed__title"><?php echo get_the_title(); ?></a>
	<hr class="feed__hr u-hidden-small-up">
</div>

<!-- #post-<?php the_ID(); ?> -->
