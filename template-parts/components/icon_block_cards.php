<?php

/**
 * Component: Icon Block Cards
 * Layout: icon_block_cards
 */

$title = get_sub_field('title');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
  <div class="container mx-auto px-4">

    <?php if ($title) : ?>
      <h2 class="lg:text-4xl font-semibold mb-12"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if (have_rows('icon_block_cards')) : ?>
      <div class="grid md:grid-cols-3 gap-8">
        <?php
        while (have_rows('icon_block_cards')) : the_row();
          $icon        = get_sub_field('icon');
          $card_title  = get_sub_field('title');
          $card_text   = get_sub_field('text');
          $add_button  = get_sub_field('add_button');
          $button_text = get_sub_field('button_text');
          $button_link = get_sub_field('button_link');
        ?>
          <div class="p-8 border border-gray-400 rounded-lg h-full flex flex-col">

            <div class="flex items-center mb-4">
              <?php if ($icon) : ?>
                <div class="shrink-0 mr-4 w-12 h-12">
                  <?php echo goodshep_icon(array('icon' => $icon, 'group' => 'custom', 'class' => 'h-12 w-12')); ?>
                </div>
              <?php endif; ?>

              <?php if ($card_title) : ?>
                <h3 class="text-2xl font-semibold mb-0"><?php echo esc_html($card_title); ?></h3>
              <?php endif; ?>
            </div>

            <?php if ($card_text) : ?>
              <div class="mb-auto leading-loose text-default">
                <?php echo wp_kses_post($card_text); ?>
              </div>
            <?php endif; ?>

            <?php
            if ($add_button && $button_link) :
              $url = is_array($button_link) ? $button_link['url'] : $button_link;
              $target = is_array($button_link) ? ($button_link['target'] ?: '_self') : '_self';
            ?>
              <div class="mt-6">
                <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>"
                  class="text-red font-medium uppercase hover:opacity-80 transition-opacity no-underline">
                  <?php echo esc_html($button_text); ?>
                </a>
              </div>
            <?php endif; ?>

          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</section>