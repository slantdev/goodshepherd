<?php

/**
 * Component: Stats Slider
 * Layout: stats_slider
 */

$content = get_sub_field('content');
$slides  = $content['stats_slide'] ?? [];
$style   = $content['style'] ?? [];

// Styles
$bg_color   = $style['background_color'] ?? '#b86aab';
$text_color = $style['text_color'] ?? '#ffffff';

$section_style = "background-color: {$bg_color}; color: {$text_color};";

// Wrapper Attributes
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes('py-12 md:py-20');
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($section_style); ?>">
  <div class="container mx-auto px-4">

    <?php if (!empty($slides)) : ?>
      <div class="swiper stats-slider">
        <div class="swiper-wrapper items-stretch">
          <?php foreach ($slides as $index => $slide) :
            $icon   = $slide['icon_image'];
            $number = $slide['number'];
            $text   = $slide['text'];
          ?>
            <div class="swiper-slide h-auto border-r border-current/30 last:border-r-0 border-opacity-30">
              <div class="px-6 md:px-8 flex flex-col h-full justify-between">

                <!-- Row 1 -->
                <div class="flex items-center gap-4 mb-4 xl:mb-6">
                  <!-- Icon (1/3 approx) -->
                  <div class="w-1/3 shrink-0">
                    <?php if ($icon) : ?>
                      <img src="<?php echo esc_url($icon['url']); ?>"
                        alt="<?php echo esc_attr($icon['alt']); ?>"
                        class="w-full h-auto object-contain max-h-16">
                    <?php endif; ?>
                  </div>

                  <!-- Number (2/3) -->
                  <div class="w-2/3">
                    <span class="text-4xl md:text-5xl font-semibold leading-none block">
                      <?php echo esc_html($number); ?>
                    </span>
                  </div>
                </div>

                <!-- Row 2 -->
                <div class="text-lg md:text-xl leading-tight">
                  <?php echo wp_kses_post($text); ?>
                </div>

              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Optional: Pagination if needed, usually stats sliders might just loop or allow swipe -->
        <div class="swiper-pagination mt-8 relative"></div>
      </div>
    <?php endif; ?>

  </div>
</section>