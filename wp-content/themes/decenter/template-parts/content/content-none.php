<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Decenter
 * @since 1.0.0
 */

?>

<div class="post-body u-container">
    <div class="title"><?php /* echo qtranxf_use(qtranxf_getLanguage(),'[:ru]Ошибка 404[:en]Error 404[:zh]错误404[:]'); */ ?>
	<?php _e('[:ru]Ошибка 404[:en]Error 404[:zh]错误404[:]'); ?>
	
	</div>
    <div class="description">
		<?php _e('[:ru]К сожалению, здесь ничего нет. Проверьте правильность адреса или просто перейдите на главную страницу сайта.[:en]There is nothing here. Check the address or just go to the main page of the site.[:zh]这里什么都没有。检查地址或仅转到网站的主页。[:]'); ?>
		</div>
    <div class="link"><a href="<?php echo get_home_url(); ?>"><?php _e('[:ru]Перейти на главную[:en]Go to Home page[:zh]回家[:]'); ?></a></div>
    <hr class="feed__hr">
    <div class="latest-title">
        <h1><?php _e('[:ru]Последние материалы[:en]Latest Content[:zh]最新内容[:]'); ?></h1>
    </div>
    <section class="post__feed-section">
        <div class="feed u-container u-container--large">
            <div class="u-grid u-grid--vertical-margin">
				<?php
					$query_404 = new WP_Query( array ( 'category__in' => $category_ids,
													'post_status' => 'publish',
													'posts_per_page' => 3,
													)); 
					while( $query_404->have_posts() ){
						
						$query_404->the_post();
						get_template_part( 'template-parts/content/content' );			
					}
					wp_reset_postdata();
				?>
            </div>
            <!---->
        </div>
    </section>
</div>
