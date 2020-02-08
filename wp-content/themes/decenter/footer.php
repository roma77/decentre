<?php
/**
 * The template for displaying the footer
 *
 *
 *
 * @package WordPress
 * @subpackage tapout
 * @since tapout
 */

?>

	</div> <!-- end content -->
	<div class="push"></div>
</div> <!-- end wrapper -->
	
<div id="footer">
	<div class="content">
		<div class="logo"></div> 
		<div class="links">
			<?php 
				wp_nav_menu( [ 'menu' => 'Footer menu' ] );
			?>
		</div>	
	</div>
</div>


<?php wp_footer(); ?>

</body>
</html>