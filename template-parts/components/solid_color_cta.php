<?php

/**
 * Component: Solid Color CTA
 * Layout: solid_color_cta
 */

$title       = get_sub_field('title');
$text        = get_sub_field('text');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link')['url'];
$btn_style   = get_sub_field('button_style');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
  <div class="container mx-auto px-4 lg:px-0">

    <div class="md:max-w-6xl mx-auto grid md:grid-cols-3 gap-8 items-center">

      <div class="md:col-span-2 text-center md:text-left">
        <?php if ($title) : ?>
          <h2 class="font-normal mb-2 text-inherit text-3xl"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($text) : ?>
          <div class="text-xl leading-relaxed font-normal text-inherit opacity-90">
            <?php echo wp_kses_post($text); ?>
          </div>
        <?php endif; ?>
      </div>

      <?php if ($button_text && $button_link) :
        $btn_class = ($btn_style === 'secondary')
          ? 'bg-transparent border-2 border-current text-inherit hover:opacity-80'
          : 'bg-white text-gray-900 border-2 border-transparent hover:bg-gray-100';
      ?>
        <div class="text-center">
          <a href="<?php echo esc_url($button_link); ?>"
            class="inline-block py-3 px-8 rounded font-bold transition-colors no-underline <?php echo esc_attr($btn_class); ?>">
            <?php echo esc_html($button_text); ?>
          </a>
        </div>
      <?php endif; ?>

    </div>

  </div>
</section>