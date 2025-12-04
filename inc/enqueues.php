<?php
/**
 * Enqueue scripts and styles.
 */

// Define development mode based on environment or constant
if (!defined('IS_VITE_DEVELOPMENT')) {
    define('IS_VITE_DEVELOPMENT', (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local'));
}

function goodshep_enqueue_scripts() {
    if (IS_VITE_DEVELOPMENT) {
        // Development: Vite Dev Server (HMR)
        wp_enqueue_script('vite-client', 'http://localhost:5173/@vite/client', [], null, false);
        wp_enqueue_script('goodshep-main', 'http://localhost:5173/src/main.js', ['jquery'], null, false);
    } else {
        // Production: Built Assets
        wp_enqueue_style(
            'goodshep-style', 
            get_template_directory_uri() . '/assets/css/main.css', 
            [], 
            filemtime(get_template_directory() . '/assets/css/main.css')
        );

        wp_enqueue_script(
            'goodshep-main', 
            get_template_directory_uri() . '/assets/js/main.js', 
            ['jquery'], 
            filemtime(get_template_directory() . '/assets/js/main.js'), 
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'goodshep_enqueue_scripts');

/**
 * Add 'type="module"' to Vite scripts
 */
function goodshep_add_module_to_vite_scripts($tag, $handle, $src) {
    if (in_array($handle, ['vite-client', 'goodshep-main'])) {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'goodshep_add_module_to_vite_scripts', 10, 3);
