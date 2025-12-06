<?php
/**
 * AJAX Handlers
 * 
 * Handles asynchronous requests for filtering and pagination.
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter Client Stories (AJAX)
 */
function goodshep_ajax_filter_client_stories() {
    // Verify Nonce (Implementation required in JS first)
    // check_ajax_referer( 'goodshep_ajax_nonce', 'nonce' );

    $category       = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    $posts_per_page = isset($_POST['postsperpage']) ? intval($_POST['postsperpage']) : -1;

    $args = array(
        'post_type'      => 'client-story',
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'posts_per_page' => $posts_per_page,
    );

    if ( $category !== 'all' ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'story-category',
                'field'    => 'term_id',
                'terms'    => $category,
            ),
        );
    }

    $ajax_query = new WP_Query( $args );

    if ( $ajax_query->have_posts() ) {
        
        // Return ONLY the grid items, not the container, 
        // assuming the JS will .html() the .stories-grid container
        // Or if JS replaces .stories-grid, we output the wrapper.
        // Based on reference: $(".stories-grid").html("").prepend(response);
        // So we just output the items.
        
        while ( $ajax_query->have_posts() ) {
            $ajax_query->the_post();
            get_template_part( 'template-parts/components/client_stories_item' );
        }
        
    } else {
        echo '<div class="col-span-full text-center py-4 px-8 text-gray-500">Sorry, no stories matched your criteria.</div>';
    }

    wp_reset_postdata();
    die();
}
add_action( 'wp_ajax_filter_client_stories', 'goodshep_ajax_filter_client_stories' );
add_action( 'wp_ajax_nopriv_filter_client_stories', 'goodshep_ajax_filter_client_stories' );

/**
 * Pagination Load Client Stories (AJAX)
 * Reference implementation migration
 */
function goodshep_ajax_pagination_load_client_stories() {
    
    $page       = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $per_page   = isset($_POST['per_page']) ? intval($_POST['per_page']) : -1;
    $offset     = ($page - 1) * $per_page;

    $args = array(
        'post_type'      => 'client-story',
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'posts_per_page' => $per_page,
        'offset'         => $offset,
    );

    $ajax_query = new WP_Query( $args );

    if ( $ajax_query->have_posts() ) {
        while ( $ajax_query->have_posts() ) {
            $ajax_query->the_post();
            get_template_part( 'template-parts/components/client_stories_item' );
        }
    } else {
        // No posts
    }

    wp_reset_postdata();
    die();
}
add_action( 'wp_ajax_pagination_load_client_stories', 'goodshep_ajax_pagination_load_client_stories' );
add_action( 'wp_ajax_nopriv_pagination_load_client_stories', 'goodshep_ajax_pagination_load_client_stories' );