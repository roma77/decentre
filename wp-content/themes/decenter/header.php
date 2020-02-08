<?php
/**
 * The template for displaying the header
 *
 *
 *
 * @package WordPress
 * @subpackage tapout
 * @since tapout
 */

?>
<!DOCTYPE html>
<html lang="en">
<meta <?php bloginfo('charset'); ?>>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="<?php if (is_single()) {
    single_post_title('', true);
} else {
    bloginfo('name');
    echo " - ";
    bloginfo('description');
}
?>">
<meta name="author" content="">
<title><?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?></title>

<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png" type="image/x-icon">
    <?php wp_head(); ?>
</head>
<body>

<!-- Page Header -->
<div class="wrapper">
	<div class="content">
		<div>
		<div class="header">
			
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><div class="logo"></div></a> 
			<div class="right">
				<div class="language">
					<?php wp_nav_menu( [ 'menu' => 'Language Switcher' ] ); ?>
				</div> 
			<div class="light"></div>
			</div>
		</div>
		</div>
		
		