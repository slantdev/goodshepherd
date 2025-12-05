<?php

/**
 * Register Custom Post Types & Taxonomies
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper function to register CPTs properly
 */
function goodshep_register_cpt( $slug, $singular, $plural, $icon = 'dashicons-admin-post', $args = [] ) {
	$labels = array(
		'name'                  => $plural,
		'singular_name'         => $singular,
		'menu_name'             => $plural,
		'name_admin_bar'        => $singular,
		'add_new'               => 'Add New',
		'add_new_item'          => 'Add New ' . $singular,
		'new_item'              => 'New ' . $singular,
		'edit_item'             => 'Edit ' . $singular,
		'view_item'             => 'View ' . $singular,
		'all_items'             => 'All ' . $plural,
		'search_items'          => 'Search ' . $plural,
		'parent_item_colon'     => 'Parent ' . $plural . ':',
		'not_found'             => 'No ' . $plural . ' found.',
		'not_found_in_trash'    => 'No ' . $plural . ' found in Trash.',
	);

	$defaults = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $slug, 'with_front' => true ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => $icon,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'author' ),
		'show_in_rest'       => true, // Gutenberg support
	);

	$args = wp_parse_args( $args, $defaults );

	register_post_type( $slug, $args );
}

/**
 * Helper function to register Taxonomies properly
 */
function goodshep_register_tax( $slug, $post_types, $singular, $plural, $rewrite_slug = null, $hierarchical = true, $public = true ) {
	$labels = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'search_items'      => 'Search ' . $plural,
		'all_items'         => 'All ' . $plural,
		'parent_item'       => 'Parent ' . $singular,
		'parent_item_colon' => 'Parent ' . $singular . ':',
		'edit_item'         => 'Edit ' . $singular,
		'update_item'       => 'Update ' . $singular,
		'add_new_item'      => 'Add New ' . $singular,
		'new_item_name'     => 'New ' . $singular . ' Name',
		'menu_name'         => $plural,
	);

	$args = array(
		'hierarchical'      => $hierarchical,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => $rewrite_slug ?: $slug ),
		'show_in_rest'      => true,
		'public'            => $public,
	);

	register_taxonomy( $slug, $post_types, $args );
}

/**
 * Initialize Post Types & Taxonomies
 */
function goodshep_init_post_types() {

	// 1. Services
	goodshep_register_cpt( 'services', 'Service', 'Services', 'dashicons-star-filled', [
		'rewrite' => [ 'slug' => 'services', 'with_front' => true ],
	] );

	goodshep_register_tax( 'service_category', 'services', 'Service Category', 'Service Categories', 'services', true );
	goodshep_register_tax( 'service_tag', 'services', 'Service Tag', 'Service Tags', 'service-tag', false );

	// 2. Service Providers
	goodshep_register_cpt( 'service_provider', 'Service Provider', 'Service Providers', 'dashicons-location', [
		'rewrite'     => [ 'slug' => 'service-provider', 'with_front' => true ],
		'has_archive' => true,
	] );

	goodshep_register_tax( 'service_provider_category', 'service_provider', 'Provider Category', 'Provider Categories', 'service_provider_category' );
	goodshep_register_tax( 'service_provider_program', 'service_provider', 'Provider Program', 'Provider Programs', 'service_provider_program' );
	goodshep_register_tax( 'service_provider_area', 'service_provider', 'Provider Area', 'Provider Areas', 'service_provider_area' );
	goodshep_register_tax( 'service_provider_status', 'service_provider', 'Status', 'Statuses', 'service_provider_status' );

	// 3. Jobs
	goodshep_register_cpt( 'jobs', 'Job', 'Jobs', 'dashicons-id-alt', [
		'rewrite' => [ 'slug' => 'jobs', 'with_front' => true ],
	] );

	goodshep_register_tax( 'department', 'jobs', 'Department', 'Departments', 'jobs' );
	goodshep_register_tax( 'position-type', 'jobs', 'Position Type', 'Position Types', 'jobs' );

	// 4. Media Coverage
	goodshep_register_cpt( 'media_coverage', 'Media Coverage', 'Media Coverage', 'dashicons-rss', [
		'rewrite' => [ 'slug' => 'media-releases', 'with_front' => true ],
	] );

	// 5. Publications
	goodshep_register_cpt( 'publications', 'Publication', 'Publications', 'dashicons-media-text', [
		'rewrite' => [ 'slug' => 'publications', 'with_front' => true ],
	] );

	goodshep_register_tax( 'publications_type', 'publications', 'Publication Type', 'Publication Types', 'publications', true, false );
	goodshep_register_tax( 'publications_tags', 'publications', 'Publication Tag', 'Publication Tags', 'publications', false, false );

	// 6. Events
	goodshep_register_cpt( 'events', 'Event', 'Events', 'dashicons-calendar-alt', [
		'rewrite' => [ 'slug' => 'events', 'with_front' => true ],
	] );

	// 7. People
	goodshep_register_cpt( 'people', 'Person', 'People', 'dashicons-groups', [
		'public'              => true, // Needs to be true to be "active"
		'publicly_queryable'  => false, // But not queryable on frontend
		'exclude_from_search' => true,
		'show_in_nav_menus'   => false,
		'rewrite'             => [ 'slug' => 'people', 'with_front' => true ],
		'query_var'           => false,
	] );

	goodshep_register_tax( 'people_role', 'people', 'People Role', 'People Roles', 'people', true, false );

}
add_action( 'init', 'goodshep_init_post_types' );


/**
 * Fix Custom Taxonomy Pagination 404 Errors
 * 
 * Ensures taxonomies sharing the same rewrite slug as their CPT work correctly.
 */
function goodshep_generate_taxonomy_rewrite_rules( $wp_rewrite ) {
	$rules      = array();
	$post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );
	$taxonomies = get_taxonomies( array( 'public' => true, '_builtin' => false ), 'objects' );

	foreach ( $post_types as $post_type ) {
		$post_type_slug = $post_type->rewrite['slug'] ?? '';
        if (empty($post_type_slug)) continue;

		foreach ( $taxonomies as $taxonomy ) {
			if ( in_array( $post_type->name, $taxonomy->object_type ) ) {
				$terms = get_terms( array(
					'taxonomy'   => $taxonomy->name,
					'hide_empty' => false,
				) );

                if ( is_wp_error( $terms ) ) continue;

				foreach ( $terms as $term ) {
					$rules[ $post_type_slug . '/' . $term->slug . '/?$' ]                               = 'index.php?' . $term->taxonomy . '=' . $term->slug;
					$rules[ $post_type_slug . '/' . $term->slug . '/page/?([0-9]{1,})/?$' ]             = 'index.php?' . $term->taxonomy . '=' . $term->slug . '&paged=' . $wp_rewrite->preg_index( 1 );
				}
			}
		}
	}
	$wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_action( 'generate_rewrite_rules', 'goodshep_generate_taxonomy_rewrite_rules' );