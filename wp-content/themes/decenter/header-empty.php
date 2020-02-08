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
<div class="info-container">
	<div class="info-container__header">
		<div class="left-element"></div>
		<div class="right-element"></div>
		<div class="lang-block language">
			<?php wp_nav_menu( [ 'menu' => 'Language Switcher' ] ); ?>
		</div>
		<div class="header-container">
			<div class="logo"></div>
			<h1> 
				<?php _e('[:ru]Реклама в каналах  и на сайте[:en]Advertising on Our Channel & Website[:zh]在我们的频道和网站上刊登广告[:]'); ?>
			</h1>
		</div>
	</div>