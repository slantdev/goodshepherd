<?php
/**
 * Advanced Custom Fields (ACF) Configurations
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Customize ACF Settings
 */

/**
 * ACF Google Maps API Key
 * 
 * Sets the API key for ACF Google Map field.
 * Fallbacks to a default key if 'google_maps_api_key' is not found in options.
 */
function goodshep_acf_google_map_api( $api ) {
	// Get API key from Theme Settings
	$api_key = get_field( 'google_maps_api_key', 'option' );

	// Fallback Key (Consider defining this in wp-config.php instead for security)
	if ( empty( $api_key ) ) {
		$api_key = defined( 'GOOGLE_MAPS_API_KEY' ) ? constant( 'GOOGLE_MAPS_API_KEY' ) : 'AIzaSyDLizIQzcRNunD-P-YufBK-nS3mwl9V0As'; 
	}

	if ( $api_key ) {
		$api['key'] = $api_key;
	}

	return $api;
}
add_filter( 'acf/fields/google_map/api', 'goodshep_acf_google_map_api' );


/**
 * 2. Add Options Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	
	acf_add_options_page( array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );

}

/**
 * 3. Register Local JSON for Syncing
 * 
 * This saves ACF field groups as JSON files in your theme,
 * allowing you to version control them.
 */
function goodshep_acf_json_save_point( $path ) {
	// Update path to the /acf-json folder in the theme
	return get_template_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'goodshep_acf_json_save_point' );

function goodshep_acf_json_load_point( $paths ) {
	// Remove original path (optional)
	unset( $paths[0] );

	// Append our new path
	$paths[] = get_template_directory() . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'goodshep_acf_json_load_point' );


/**
 * 4. ACF Extended Layout Thumbnails
 * 
 * Dynamically sets the thumbnail for Flexible Content layouts.
 * Reduces repetitive code by using a dynamic filter logic.
 * 
 * @link https://www.acf-extended.com/features/fields/flexible-content/advanced-settings
 */

// List of layouts and their image filenames (if different from layout name)
// Assuming image format is .jpg and resides in /assets/acf-layouts/
$goodshep_acf_layouts = [
	'full_text',
	'good_money_application',
	'accredited_box',
	'buttons',
	'full_width_banner',
	'rectangle_color_block',
	'accordion',
	'text_and_image',
	'wide_text_and_image',
	'color_text_block_with_image',
	'color_text_block',
	'text_with_large_quotes',
	'tick_block',
	'step_block_cards',
	'solid_color_cta',
	'cta_with_image',
	'two_line_cta',
	'three_card_cta',
	'donate_now_form',
	'subscribe_to_newsletter',
	'contact_form',
	'page_form',
	'text_block_cards',
	'icon_block_cards',
	'image_and_icon_cards',
	'small_photo_cards',
	'testimonial_cards',
	'contact_details_cards',
	'loan_comparison_cards',
	'two_card_block',
	'four_card_block',
	'full_black_image',
	'gallery_block_02',
	'gallery_block_01',
	'four_logos_block' => 'gallery_block_01', // Mapped to existing image
	'text_and_logo_block',
	'gallery_slider',
	'our_board',
	'people_blocks',
	'key_contacts',
	'shortcut_blocks',
	'twitter_feed',
	'frequently_asked_questions',
	'news_archive',
	'download_pdf_block',
	'html_block',
	'video_block',
	'client_stories',
];

foreach ( $goodshep_acf_layouts as $key => $value ) {
	// Handle array key vs value for mapped images
	$layout_name = is_int( $key ) ? $value : $key;
	$image_name  = $value;

	add_filter( "acfe/flexible/thumbnail/layout={$layout_name}", function( $thumbnail, $field, $layout ) use ( $image_name ) {
		return get_stylesheet_directory_uri() . "/assets/acf-layouts/{$image_name}.jpg";
	}, 10, 3 );
}