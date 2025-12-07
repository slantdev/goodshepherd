<?php

/**
 * Component: Four Card Block
 * Layout: four_card_block
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
      <h2 class="text-red mb-10 text-3xl font-semibold"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if ($text) : ?>
      <div class="mb-14 prose max-w-none">
        <?php echo wp_kses_post($text); ?>
      </div>
    <?php endif; ?>

    <?php if (have_rows('card_block_cards')) : ?>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php
        while (have_rows('card_block_cards')) : the_row();
          $card_title = get_sub_field('title');
          $card_text  = get_sub_field('text');
          $icon       = get_sub_field('icon');
        ?>
          <div class="bg-gray-50 border border-gray-300 p-8 rounded-lg hover:shadow-lg transition-shadow duration-200 relative">

            <?php if ($icon) : ?>
              <div class="absolute top-4 right-4 h-8 w-8">
                <?php echo goodshep_icon(array('icon' => $icon, 'group' => 'custom', 'class' => 'h-full w-full text-purple fill-current')); ?>
              </div>
            <?php endif; ?>

            <div class="relative z-10">
              <?php if ($card_title) : ?>
                <h3 class="text-xl font-semibold mb-4 pr-8"><?php echo esc_html($card_title); ?></h3>
              <?php endif; ?>

              <div class="text-base leading-loose text-gray-700">
                <?php echo wp_kses_post($card_text); ?>
              </div>
            </div>

          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</section>