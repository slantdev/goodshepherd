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
			'height'      => 95,
			'width'       => 276,
			'flex-width'  => true,
			'flex-height' => true,
		));

		// Remove admin bar styling
		//add_theme_support('admin-bar', array('callback' => '__return_false'));


		// Register Navigation Menus
		register_nav_menus(array(
			'primary'           => esc_html__('Primary Navigation Menu', 'goodshep-theme'),
			'secondary'         => esc_html__('Secondary Navigation Menu', 'goodshep-theme'),
			'home_hero'         => esc_html__('Homepage Hero Select', 'goodshep-theme'),
			'footer_menu_01'    => esc_html__('Footer Menu 01', 'goodshep-theme'),
			'footer_menu_02'    => esc_html__('Footer Menu 02', 'goodshep-theme'),
			'footer_menu_03'    => esc_html__('Footer Menu 03', 'goodshep-theme'),
			'language_switcher' => esc_html__('Language Switcher', 'goodshep-theme'),
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
