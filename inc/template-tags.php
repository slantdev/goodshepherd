<?php

/**
 * Custom template tags and helper functions for the theme.
 */

// Prevent direct access
if (! defined('ABSPATH')) {
  exit;
}

/**
 * Generate slug from string (Helper)
 */
function goodshep_slugify($text)
{
  // Replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // Transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // Remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // Trim
  $text = trim($text, '-');
  // Lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

/**
 * Get Section ID Attribute
 * 
 * Returns the ID attribute if 'section_id' subfield exists.
 */
function goodshep_get_section_id()
{
  $id = get_sub_field('section_id');
  if ($id) {
    return 'id="' . esc_attr(goodshep_slugify($id)) . '"';
  }
  return '';
}

/**
 * Get Background Image Style
 */
function goodshep_get_bg_image_style()
{
  $bg_img = get_sub_field('background_image');
  if ($bg_img && is_array($bg_img)) {
    return 'background-image: url(' . esc_url($bg_img['url']) . '); background-repeat: no-repeat; background-size: cover; background-position: center center;';
  }
  return '';
}

/**
 * Get Block Classes (Background Color, Text Color, Spacing)
 */
function goodshep_get_block_classes($extra_classes = '')
{

  // 1. Colors
  $block_color = get_sub_field('block_colour') ?: 'white';

  // Map colors to Tailwind classes (Update these based on your Tailwind config)
  $bg_map = [
    'purple'     => 'bg-purple',
    'red'        => 'bg-red',
    'black'      => 'bg-off-black',
    'white'      => 'bg-white',
    'light_grey' => 'bg-light-grey',
    'off_white'  => 'bg-off-white',
  ];

  $text_map = [
    'purple'     => 'text-white',
    'red'        => 'text-white',
    'black'      => 'text-white',
    'white'      => 'text-default',
    'light_grey' => 'text-default',
    'off_white'  => 'text-default',
  ];

  // Default fallback
  $bg_class   = $bg_map[$block_color] ?? 'bg-transparent';
  $text_class = $text_map[$block_color] ?? 'text-gray-900';

  // 2. Spacing (Map old values to Tailwind v4)
  // Assuming 'pt-12' etc are standard Tailwind.
  $spacing_top    = get_sub_field('spacing_top') ?: 'pt-12';
  $spacing_bottom = get_sub_field('spacing_bottom') ?: 'pb-12';

  return implode(' ', [$bg_class, $text_class, $spacing_top, $spacing_bottom, $extra_classes]);
}

/**
 * Get Icon
 * 
 * Retrieves an SVG icon from the assets/icons directory.
 * 
 * @param array $atts {
 *     @type string $icon   Icon filename (without extension).
 *     @type string $group  Subdirectory name (default: 'utility').
 *     @type int    $size   Width/Height in pixels (default: 16).
 *     @type string $class  Additional CSS classes.
 *     @type string $label  Aria label for accessibility.
 * }
 * @return string|void SVG markup or void if not found.
 */
function goodshep_icon($atts = array())
{

  $atts = shortcode_atts(array(
    'icon'  => false,
    'group' => 'utility',
    'size'  => 16,
    'class' => false,
    'label' => false,
  ), $atts);

  if (empty($atts['icon'])) {
    return;
  }

  // Path to SVG
  $icon_path = get_template_directory() . '/assets/icons/' . $atts['group'] . '/' . $atts['icon'] . '.svg';

  if (! file_exists($icon_path)) {
    return;
  }

  $icon = file_get_contents($icon_path);

  // Build Class Attribute
  $class = 'svg-icon';
  if (! empty($atts['class'])) {
    $class .= ' ' . esc_attr($atts['class']);
  }

  // Inject attributes into <svg> tag
  if (false !== $atts['size']) {
    $repl = sprintf('<svg class="%s" width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $class, $atts['size'], $atts['size']);
    $svg  = preg_replace('/^<svg /', $repl, trim($icon));
  } else {
    $svg = preg_replace('/^<svg /', '<svg class="' . $class . '"', trim($icon));
  }

  // Clean up whitespace
  $svg = preg_replace("/([\n\t]+)/", ' ', $svg);
  $svg = preg_replace('/>\s*</', '><', $svg);

  // Add Aria Label if present
  if (! empty($atts['label'])) {
    $svg = str_replace('<svg class', '<svg aria-label="' . esc_attr($atts['label']) . '" class', $svg);
    $svg = str_replace('aria-hidden="true"', '', $svg);
  }

  return $svg;
}

/**
 * Map Color Name to Tailwind Classes
 * 
 * @param string $color_name The ACF color value (e.g., 'purple', 'red').
 * @return string Tailwind classes.
 */
function goodshep_map_color_class($color_name)
{
  $colors = [
    'purple'     => 'bg-purple text-white',
    'red'        => 'bg-red text-white',
    'black'      => 'bg-off-black text-white',
    'white'      => 'bg-white text-default',
    'light_grey' => 'bg-light-grey text-default',
    'off_white'  => 'bg-off-white text-default',
  ];

  return $colors[$color_name] ?? 'bg-white text-default';
}

/**
 * Debug Helper: Preformatted print_r
 * 
 * @param mixed $data Data to debug
 */
function preint_r($data)
{
  //if ( current_user_can( 'manage_options' ) ) {
  echo '<pre style="background: #fff; color: #000; padding: 10px; z-index: 9999; position: relative; border: 1px solid red; text-align: left;" class="text-xs leading-none">';
  print_r($data);
  echo '</pre>';
  //}
}

/**
 * Display Breadcrumbs
 */
function goodshep_breadcrumbs()
{
  $home = '<a href="' . home_url() . '" class="no-underline text-body inline-block hover:text-red transition-colors">' . __('Home', 'goodshep-theme') . '</a>';
  $separator = '<span class="inline-block mx-2 text-gray-400">/</span>';
  $parent = '';
  $current_page = '<span class="inline-block font-medium text-off-black">' . get_the_title() . '</span>';

  if (is_tax(['service_category', 'service_tag'])) {
    $term = get_queried_object();
    $term_name =  $term->name;
    $parent = '<span class="inline-block">' . __('Our Services', 'goodshep-theme') . '</span>';
    $current_page = '<span class="inline-block text-red">' . $term_name . '</span>';
  } else if (is_singular('services')) {
    $parent = '<span class="inline-block">' . __('Our Services', 'goodshep-theme') . '</span>';
  } else if (is_singular('jobs')) {
    $parent = '<span class="inline-block">' . __('Get Involved', 'goodshep-theme') . '</span>' . $separator . '<span class="inline-block"><a class="text-body no-underline hover:text-red transition-colors" href="/careers-with-us/">' . __('Careers with Us', 'goodshep-theme') . '</a></span>';
  } else if (is_page_template('page-templates/media-coverage.php')) {
    $parent = '<span class="inline-block">' . __('News and Events', 'goodshep-theme') . '</span>';
  } else if (is_singular('publications')) {
    $current_page = '<span class="inline-block">' . __('Our Research', 'goodshep-theme') . '</span>';
  } else if (is_singular('events')) {
    $parent = '<span class="inline-block">' . __('Events', 'goodshep-theme') . '</span>';
  } else if (is_singular('media_coverage')) {
    $parent = '<span class="inline-block">' . __('Media Releases', 'goodshep-theme') . '</span>';
  }

  $output = '<nav aria-label="Breadcrumb" class="breadcrumbs text-sm mb-4 lg:mb-0">';
  $output .= $home;
  $output .= $separator;

  if ($parent) {
    $output .= $parent;
    $output .= $separator;
  }

  $output .= $current_page;
  $output .= '</nav>';

  echo $output;
}

/**
 * Display Page Anchor Navigation (Jump Links) - Dropdown Style
 */
function goodshep_page_anchor_nav($post_id = null)
{
  if (!$post_id) {
    $post_id = get_the_ID();
  }

  if (have_rows('content_management', $post_id)) {
    $anchors = [];
    while (have_rows('content_management', $post_id)) {
      the_row();
      if (get_sub_field('page_anchor')) {
        $section_id = get_sub_field('section_id');
        if ($section_id) {
          $anchors[] = [
            'id' => goodshep_slugify($section_id),
            'title' => $section_id
          ];
        }
      }
    }

    if (!empty($anchors)) {
?>
      <div class="page-anchor-nav relative z-40 -translate-y-1/2">
        <div class="container mx-auto px-4">
          <div class="max-w-screen-md mx-auto">
            <!-- Custom Select Container -->
            <div class="relative js-anchor-select group">

              <!-- Trigger -->
              <button type="button"
                class="js-anchor-select-trigger w-full bg-purple text-white rounded-md px-4 xl:px-8 py-3 flex items-center justify-between transition-colors focus:outline-none relative h-14 xl:h-[88px]"
                aria-haspopup="listbox"
                aria-expanded="false">
                <span class="flex flex-col items-start text-left w-full relative h-full justify-center">
                  <!-- Floating Label -->
                  <span class="js-anchor-label absolute left-0 text-xl font-medium transition-all duration-200 origin-top-left pointer-events-none ease-in-out">
                    <?php _e('On this page', 'goodshep-theme'); ?>
                  </span>
                  <!-- Selected Text -->
                  <span class="js-anchor-selected-text text-lg font-medium mt-4 block opacity-0 transition-opacity duration-200 truncate w-full pr-8 text-white"></span>
                </span>

                <div class="flex items-center gap-2">
                  <!-- Clear Button -->
                  <span class="js-anchor-clear hidden p-2 hover:bg-white/20 rounded-full cursor-pointer transition-colors z-10" role="button" aria-label="Clear selection">
                    <?php echo goodshep_icon(array('icon' => 'close', 'group' => 'utility', 'class' => 'w-3 h-3 fill-current text-white')); ?>
                  </span>
                  <!-- Caret -->
                  <svg class="w-2.5 h-2.5 fill-current text-white transition-transform duration-200 shrink-0" viewBox="7 10 10 5" focusable="false">
                    <polygon stroke="none" fill-rule="evenodd" points="7 10 12 15 17 10"></polygon>
                  </svg>
                </div>
              </button>

              <!-- Dropdown Menu -->
              <ul class="js-anchor-select-dropdown absolute top-full left-0 w-full bg-white shadow-xl max-h-60 overflow-y-auto rounded-b-md z-50 hidden opacity-0 transition-opacity duration-200 border border-gray-100 py-2"
                role="listbox">
                <?php foreach ($anchors as $index => $anchor): ?>
                  <li class="border-none">
                    <a href="#<?php echo esc_attr($anchor['id']); ?>"
                      class="js-anchor-item block px-4 xl:px-8 py-4 text-lg text-body hover:bg-gray-100 transition-colors no-underline"
                      data-value="<?php echo esc_attr($anchor['id']); ?>">
                      <?php echo esc_html($anchor['title']); ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>

            </div>
          </div>
        </div>
      </div>
<?php
    }
  }
}

/**
 * Render Page Header
 */
function goodshep_page_header()
{
  get_template_part('template-parts/global/page-header');
}
