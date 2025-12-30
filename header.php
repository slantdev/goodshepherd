<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site">
		<a class="skip-link sr-only" href="#primary"><?php esc_html_e('Skip to content', 'goodshep-theme'); ?></a>

		<?php get_template_part('template-parts/global/hello-bar'); ?>
		<?php get_template_part('template-parts/global/site-header'); ?>

		<div id="content" class="site-content">