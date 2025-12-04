<?php
/**
 * Good Shepherd Theme Functions
 * 
 * This file is the main entry point for the theme's PHP logic.
 * It intentionally only includes other files to keep the structure clean.
 */

// Theme Setup (Theme Support, Nav Menus, etc.)
require get_template_directory() . '/inc/setup.php';

// Enqueue Scripts & Styles (Vite Integration)
require get_template_directory() . '/inc/enqueues.php';
