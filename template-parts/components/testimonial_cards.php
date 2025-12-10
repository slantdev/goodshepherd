<?php

/**
 * Component: Testimonial Cards
 * Layout: testimonial_cards
 */

$title = get_sub_field('title');
$text  = get_sub_field('text');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
  <div class="container mx-auto px-4">

    <?php if ($title) : ?>
      <h2 class="lg:text-4xl font-semibold mb-0 text-red-600"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if ($text) : ?>
      <div class="mb-16 prose max-w-none text-lg text-gray-700">
        <?php echo wp_kses_post($text); ?>
      </div>
    <?php endif; ?>

    <?php if (have_rows('testimonial_cards')) : ?>
      <div class="grid md:grid-cols-3 gap-8">
        <?php
        while (have_rows('testimonial_cards')) : the_row();
          $image    = get_sub_field('image_source');
          $name     = get_sub_field('title'); // Person Name
          $position = get_sub_field('position_text');
          $desc     = get_sub_field('text');
          $color    = get_sub_field('block_colour');

          // Get card specific color classes
          $card_class = goodshep_map_color_class($color);
        ?>
          <div class="rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-200 pt-6 pb-16 relative flex flex-col items-center text-center <?php echo esc_attr($card_class); ?>">

            <?php if ($image) : ?>
              <div class="mb-6 h-56 w-56 rounded-full overflow-hidden mx-auto border-4 border-white/20">
                <?php
                if (is_array($image) && isset($image['ID'])) {
                  echo wp_get_attachment_image($image['ID'], 'medium', false, array('class' => 'h-full w-full object-cover'));
                } elseif (is_numeric($image)) {
                  echo wp_get_attachment_image($image, 'medium', false, array('class' => 'h-full w-full object-cover'));
                } elseif (is_string($image)) {
                  echo '<img src="' . esc_url($image) . '" class="h-full w-full object-cover" alt="">';
                }
                ?>
              </div>
            <?php endif; ?>

            <div class="px-6 pb-6 relative z-10">
              <?php if ($name) : ?>
                <h3 class="text-base font-medium mb-0 leading-6 uppercase tracking-wide"><?php echo esc_html($name); ?></h3>
              <?php endif; ?>

              <?php if ($position) : ?>
                <div class="text-base font-medium uppercase leading-6 mb-6 opacity-80"><?php echo wp_kses_post($position); ?></div>
              <?php endif; ?>

              <?php if ($desc) : ?>
                <div class="text-xl lg:text-2xl leading-relaxed italic opacity-90">
                  &ldquo;<?php echo wp_kses_post($desc); ?>&rdquo;
                </div>
              <?php endif; ?>
            </div>

            <!-- Decorative Heart Icon (Bottom Centered) -->
            <div class="absolute bottom-6 left-0 w-full flex justify-center opacity-30">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/heart-white.svg" alt="" class="h-12 w-auto">
            </div>

          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</section>