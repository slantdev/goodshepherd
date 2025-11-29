<?php

function goodshep_enqueue_scripts() {
  // In development, Vite handles the styles and scripts.
  if (defined('IS_VITE_DEVELOPMENT') && IS_VITE_DEVELOPMENT) {
    // Enqueue the Vite client.
    wp_enqueue_script('vite-client', 'http://localhost:5173/@vite/client', [], null, true);
    // Enqueue your main JS file.
    wp_enqueue_script('main-js', 'http://localhost:5173/src/main.js', [], null, true);
  } else {
    // In production, enqueue the bundled assets.
    // You'll need to generate a manifest file and read from it.
    // This is a placeholder for production asset enqueuing.
    wp_enqueue_style('main-css', get_template_directory_uri() . '/dist/main.css');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/dist/main.js', [], null, true);
  }
}
add_action('wp_enqueue_scripts', 'goodshep_enqueue_scripts');

// Add this to your wp-config.php file for development:
// define('IS_VITE_DEVELOPMENT', true);
