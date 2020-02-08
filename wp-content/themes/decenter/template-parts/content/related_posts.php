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
<?php 

$categories = get_the_category();
$category_ids = [];
if($categories){
	foreach($categories as $category) {
		$category_ids[] = $category->term_id;
	}
}
?>
<section class="post__feed-section">
    <div class="feed u-container u-container--large">
        <div class="u-grid u-grid--vertical-margin">
		<?php
			$count_related_post = 0;
			$query1 = new WP_Query( array ( 'category__in' => $category_ids,
											'post_status' => 'publish',
											'posts_per_page' => 6,
											)); 
			while( $query1->have_posts() ){
				++$count_related_post;
				$query1->the_post();
				get_template_part( 'template-parts/content/content' );			
				if ($count_related_post == 3) { ?>
					<div class="subscribe_form">
					<?php get_template_part( 'template-parts/content/subscribe' ); ?>
					</div>
				<?php }
			}
			wp_reset_postdata();
		?>
		</div>
    </div>
</section>

