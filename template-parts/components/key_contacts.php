<?php

/**
 * Component: Key Contacts
 * Layout: key_contacts
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
      <h2 class="font-semibold mb-10 text-3xl md:text-4xl"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if ($text) : ?>
      <div class="mb-16 text-xl leading-relaxed prose max-w-none">
        <?php echo wp_kses_post($text); ?>
      </div>
    <?php endif; ?>

    <?php if (have_rows('key_contacts')) : ?>
      <div class="lg:px-24 mx-auto grid md:grid-cols-2 gap-8 lg:gap-20">
        <?php
        while (have_rows('key_contacts')) : the_row();
          $image    = get_sub_field('image_source');
          $name     = get_sub_field('name');
          $position = get_sub_field('position');
          $email    = get_sub_field('email');
          $desc     = get_sub_field('text');
        ?>
          <div class="grid grid-cols-3 gap-6 mb-8">

            <!-- Image Column -->
            <div class="col-span-1">
              <?php if ($image) : ?>
                <div class="aspect-w-3 aspect-h-4 w-full rounded overflow-hidden">
                  <img class="object-cover h-full w-full"
                    src="<?php echo esc_url(is_array($image) ? $image['url'] : $image); ?>"
                    alt="<?php echo esc_attr(is_array($image) ? $image['alt'] : $name); ?>">
                </div>
              <?php endif; ?>
            </div>

            <!-- Info Column -->
            <div class="col-span-2 flex flex-col">
              <?php if ($name) : ?>
                <h3 class="text-2xl mb-2 font-semibold"><?php echo esc_html($name); ?></h3>
              <?php endif; ?>

              <?php if ($position) : ?>
                <p class="text-base mb-2 text-gray-500"><?php echo esc_html($position); ?></p>
              <?php endif; ?>

              <?php if ($desc) : ?>
                <div class="text-base mb-4 text-gray-700">
                  <?php echo wp_kses_post($desc); ?>
                </div>
              <?php endif; ?>

              <?php if ($email) : ?>

                <a href="mailto:<?php echo esc_attr($email); ?>" class="text-sm text-purple hover:opacity-80 transition-opacity break-all mt-auto">

                  <?php echo esc_html($email); ?>

                </a>

              <?php endif; ?>
            </div>

          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</section>