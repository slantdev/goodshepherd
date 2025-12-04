<?php

/**
 * Theme setup and custom theme supports.
 */

if (! function_exists('goodshep_setup')) :
	function goodshep_setup()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Let WordPress manage the document title.
		add_theme_support('title-tag');

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');

		// Add support for custom logo.
		add_theme_support('custom-logo', array(
			'height'      => 276,
			'width'       => 95,
			'flex-width'  => true,
			'flex-height' => true,
		));

		// Register Navigation Menus
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'goodshep-theme'),
		));

		// Switch default core markup to output valid HTML5.
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		));
	}
endif;
add_action('after_setup_theme', 'goodshep_setup');
