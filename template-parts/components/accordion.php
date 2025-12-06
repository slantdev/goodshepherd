<?php

/**
 * Component: Accordion
 * Layout: accordion
 */

$intro_title = get_sub_field('intro')['title'] ?? '';
$intro_text  = get_sub_field('intro')['text'] ?? '';
$unique_id   = uniqid('accordion-group-');

// Wrapper Attributes
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes('relative');
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
  <div class="container mx-auto px-4 lg:px-0">

    <!-- Intro Content -->
    <?php if ($intro_title || $intro_text) : ?>
      <div class="prose max-w-3xl mx-auto mb-12">
        <?php if ($intro_title) : ?>
          <h2 class="text-center text-3xl lg:text-4xl mb-8 font-semibold"><?php echo esc_html($intro_title); ?></h2>
        <?php endif; ?>

        <?php if ($intro_text) : ?>
          <div class="text-center">
            <?php echo wp_kses_post($intro_text); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- Accordion Items -->
    <?php if (have_rows('accordion')) : ?>
      <div class="max-w-5xl mx-auto space-y-4">

        <?php while (have_rows('accordion')) : the_row(); ?>
          <details class="group bg-gray-100 border border-gray-300 rounded-lg open:bg-white open:ring-1 open:ring-gray-200 transition-all duration-200" name="<?php echo esc_attr($unique_id); ?>">

            <!-- Summary (Title) -->
            <summary class="flex items-center justify-between cursor-pointer py-4 px-5 lg:py-5 lg:pl-8 lg:pr-8 text-xl font-semibold text-gray-900 list-none marker:hidden focus:outline-none">
              <span><?php echo esc_html(get_sub_field('title')); ?></span>

              <!-- Icon (+ / -) -->
              <span class="relative ml-4 h-6 w-6 shrink-0">
                <svg class="absolute inset-0 w-6 h-6 transition-transform duration-200 ease-out group-open:rotate-180 group-open:opacity-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <svg class="absolute inset-0 w-6 h-6 transition-transform duration-200 ease-out opacity-0 rotate-90 group-open:rotate-0 group-open:opacity-100 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                </svg>
              </span>
            </summary>

            <!-- Content -->
            <div class="px-5 pb-6 lg:px-8 lg:pb-8 prose max-w-none border-t border-gray-200 mt-2 pt-4">
              <?php echo wp_kses_post(get_sub_field('text')); ?>
            </div>

          </details>
        <?php endwhile; ?>

      </div>
    <?php endif; ?>

  </div>
</section>