<?php

/**
 * Template part for displaying the page header (Hero)
 */

$term = is_archive() ? get_queried_object() : null;
$context = $term ?: get_the_ID();

// Get ACF Fields
$disable_page_header = get_field('disable_page_header', $context);

if ($disable_page_header) {
  return;
}

$header_title = get_field('header_title', $context);
$header_description = get_field('header_description', $context);
$header_image = get_field('header_image', $context);
$background_color = get_field('background_color', $context);
$page_navigation = get_field('page_navigation', $context);
$header_breadcrumbs = get_field('header_breadcrumbs', $context);
$language_switcher = get_field('language_switcher', $context);

// Defaults
if (empty($header_title)) {
  if (is_archive()) {
    $header_title = get_the_archive_title();
  } elseif (is_singular('publications')) {
    $header_title = get_the_title();
  } else {
    $header_title = get_the_title();
  }
}

$bg_style = 'background-color: ' . ($background_color ?: '#000') . ';';
if ($header_image) {
  $bg_style .= ' background-image: url(' . esc_url($header_image['url']) . '); background-size: cover; background-position: center;';
}

$header_date = '';
if (is_singular('post') || is_singular('blogs')) {
  $header_date = '<div class="text-lg mb-2 font-medium opacity-90">' . get_the_date('d F Y') . '</div>';
}
?>

<div class="page-header relative overflow-hidden" style="<?php echo esc_attr($bg_style); ?>">
  <!-- Overlay for better text readability if image exists -->
  <?php if ($header_image): ?>
    <div class="absolute inset-0 bg-black/40"></div>
  <?php endif; ?>

  <div class="container mx-auto relative z-10">
    <div class="min-h-[400px] w-full flex items-center px-4 py-16 md:py-24">
      <div class="w-full lg:w-2/3 text-white">

        <?php echo $header_date; ?>

        <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
          <?php echo wp_kses_post($header_title); ?>
        </h1>

        <?php if ($header_description): ?>
          <div class="text-lg md:text-xl opacity-90 leading-relaxed max-w-3xl">
            <?php echo wp_kses_post($header_description); ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<?php
// Page Anchor Navigation
if ($page_navigation) {
  goodshep_page_anchor_nav();
}
?>

<?php
// Breadcrumbs & Language Switcher
if ($header_breadcrumbs || $language_switcher): ?>
  <div class="bg-white">
    <div class="container mx-auto px-4 py-4 lg:py-8">
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <?php if ($header_breadcrumbs): ?>
          <div class="breadcrumbs-wrapper">
            <?php goodshep_breadcrumbs(); ?>
          </div>
        <?php endif; ?>

        <?php if ($language_switcher): ?>
          <div class="lang-switcher flex items-center gap-3">
            <span class="text-sm font-bold text-off-black whitespace-nowrap"><?php esc_html_e('Languages:', 'goodshep-theme'); ?></span>
            <?php
            if (has_nav_menu('language_switcher')) {
              wp_nav_menu(array(
                'theme_location' => 'language_switcher',
                'menu_class'     => 'flex flex-wrap gap-x-3 text-sm font-medium text-purple',
                'container'      => false
              ));
            }
            ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
<?php endif; ?>