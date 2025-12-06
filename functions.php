<?php
/**
 * Good Shepherd Theme Functions
 * 
 * This file is the main entry point for the theme's PHP logic.
 * It intentionally only includes other files to keep the structure clean.
 */

// Theme Setup (Theme Support, Nav Menus, etc.)
require get_template_directory() . '/inc/setup.php';

// Template Tags & Helpers
require get_template_directory() . '/inc/template-tags.php';

// AJAX Handlers
require get_template_directory() . '/inc/ajax-handlers.php';

// Custom Post Types
require get_template_directory() . '/inc/post-types.php';

// ACF Settings
require get_template_directory() . '/inc/acf.php';

// Page Builder Logic
require get_template_directory() . '/inc/page-builder.php';

// Enqueue Scripts & Styles (Vite Integration)
require get_template_directory() . '/inc/enqueues.php';
