<?php

/**
 * Component: Contact Details Cards
 * Layout: contact_details_cards
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
      <h2 class="font-semibold mb-12 text-3xl"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if (have_rows('contact_details_cards')) : ?>
      <div class="grid lg:grid-cols-2 gap-10">
        <?php
        while (have_rows('contact_details_cards')) : the_row();
          $card_title = get_sub_field('title');
        ?>
          <div class="border border-purple rounded-lg py-10 px-6 md:px-12 bg-white h-full shadow-sm hover:shadow-md transition-shadow">

            <?php if ($card_title) : ?>
              <h3 class="text-purple text-2xl font-semibold mb-6"><?php echo esc_html($card_title); ?></h3>
            <?php endif; ?>

            <?php if (have_rows('contact_details')) : ?>
              <div class="space-y-4">
                <?php
                while (have_rows('contact_details')) : the_row();
                  $icon = get_sub_field('contact_detail_icon');
                  $text = get_sub_field('contact_detail_text');
                ?>
                  <div class="flex items-start">
                    <?php if ($icon) : ?>
                      <div class="shrink-0 mr-6 hidden md:block text-purple">
                        <?php echo goodshep_icon(array('icon' => $icon, 'group' => 'custom', 'class' => 'h-6 w-6 fill-current')); ?>
                      </div>
                    <?php endif; ?>

                    <div class="prose max-w-none leading-relaxed text-default">
                      <?php echo wp_kses_post($text); ?>
                    </div>
                  </div>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>

          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</section>