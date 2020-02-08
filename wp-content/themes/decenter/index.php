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

<?php
global $wpdb;
$btc_curs_now = $wpdb->get_var($wpdb->prepare(
	"SELECT BTC FROM wp_curs WHERE date = %s", date('Y-m-d')
));
$btc_curs_yesterday = $wpdb->get_var($wpdb->prepare(
	"SELECT BTC FROM wp_curs WHERE date = %s", date("Y-m-d", strtotime("-1 DAY"))
));
$btc_percent =  round(($btc_curs_now - $btc_curs_yesterday)/$btc_curs_now * 100, 2);
if ( $btc_percent > 0 ) {
	$corner = 'up';
} elseif ( $btc_percent < 0) {
	$corner = 'down';
} else {
	$corner = '';
}
?>
<!-- Main Content -->

<div class="index">
	<div class="line"></div> 
	<div class="items">
		<div class="item">
			<div class="title">BTC</div> 
			<div class="change <?php echo $corner; ?>">
			<?php echo $btc_percent; ?>%
			</div> 
			<div class="price"><span>$</span><?php echo (number_format(round($btc_curs_now, 0), 0, '', ' ')); ?></div>
		</div> 
		<div class="item">
			<div class="title">ETH</div> 
			<div class="change  down ">
			-0.58%
			</div> 
			<div class="price"><span>$</span>190</div>
		</div> 
		<div class="item">
			<div class="title">BIP</div> 
			<div class="change  up ">
			3.11%
			</div> 
			<div class="price"><span>$</span>0.0298</div>
		</div> 
		<div class="item">
			<div class="title">$DCI</div> 
			<div class="change  up ">
			1.20%
			</div> 
			<div class="price">
			<a href="https://index.decenter.org"><span>$</span>10 476</a>
			</div>
		</div>
	</div> 
	<div class="line"></div>
</div>



<div class="categories">
	<div class="categories-select">
	<?php
	if (qtranxf_getLanguage() == 'zh') {
		wp_nav_menu( array(
			'menu' => 'Top menu Chinese',
			'walker'         => new SelectBox_Menu_Walker(),
			'items_wrap'     => '<div class="mobile-menu"><form><select onchange="if (this.value) window.location.href=this.value">%3$s</select></form></div>',
		) );
	} else {
		wp_nav_menu( array(
			'menu' => 'Top menu',
			'walker'         => new SelectBox_Menu_Walker(),
			'items_wrap'     => '<div class="mobile-menu"><form><select onchange="if (this.value) window.location.href=this.value">%3$s</select></form></div>',
		) );
	}
	?>
	</div> 
	<div class="links">
		<?php 
		if (qtranxf_getLanguage() == 'zh') {
			wp_nav_menu('menu=Top menu Chinese'); 
		} else {
			wp_nav_menu('menu=Top menu'); 
		}
		
		
		?>
	</div>		
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