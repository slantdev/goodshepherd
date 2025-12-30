<?php

/**
 * Component: Hero Slider
 * Layout: hero_slider
 */

$content_group = get_sub_field('content');
$slides        = $content_group['slide'] ?? [];

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes('relative p-0'); // Remove default padding for full hero
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>">

  <?php if (!empty($slides)) : ?>
    <div class="swiper hero-slider w-full h-[600px] xl:h-[700px]" style="--swiper-navigation-sides-offset: 16px;--swiper-navigation-color: white;--swiper-navigation-size: 24px;--swiper-pagination-bottom:40px;">
      <div class="swiper-wrapper">
        <?php foreach ($slides as $slide) :
          $heading     = $slide['heading'] ?? '';
          $desc        = $slide['description'] ?? '';
          $text_color  = $slide['text_color'] ?? ''; // Hex string
          $bg_image    = $slide['background_image'] ?? '';
          $buttons     = $slide['buttons'] ?? [];

          // Inline Styles
          $text_style = $text_color ? "color: {$text_color};" : 'color: #ffffff;';
        ?>
          <div class="swiper-slide relative flex items-center justify-center bg-gray-900 overflow-hidden">

            <!-- Background Image -->
            <?php if ($bg_image) :
              $bg_url = is_array($bg_image) ? $bg_image['url'] : $bg_image;
            ?>
              <div class="absolute inset-0 z-0">
                <img src="<?php echo esc_url($bg_url); ?>" alt="" class="w-full h-full object-cover opacity-60">
              </div>
            <?php endif; ?>

            <!-- Content -->
            <div class="container mx-auto px-4 xl:px-32 relative z-10 h-full flex items-center">
              <div class="max-w-4xl" style="<?php echo esc_attr($text_style); ?>">

                <?php if ($heading) : ?>
                  <h2 class="text-4xl md:text-5xl xl:text-[56px] font-bold mb-6 xl:mb-10 leading-tight text-inherit">
                    <?php echo esc_html($heading); ?>
                  </h2>
                <?php endif; ?>

                <?php if ($desc) : ?>
                  <div class="text-lg md:text-xl mb-10 leading-relaxed opacity-90 text-inherit prose max-w-none mx-auto">
                    <?php echo wp_kses_post($desc); ?>
                  </div>
                <?php endif; ?>

                <!-- Buttons -->
                <?php if ($buttons) : ?>
                  <div class="flex flex-wrap gap-4 xl:gap-6">
                    <?php foreach ($buttons as $btn_row) :
                      $btn_group = $btn_row['button'] ?? [];
                      $link      = $btn_group['button_link'] ?? [];
                      $style     = $btn_group['button_style'] ?? 'filled-red';

                      if (empty($link['url'])) continue;

                      // Button Classes
                      $base_class = 'inline-block py-2 px-8 rounded-md font-semibold transition-all duration-300 no-underline';
                      $style_class = '';

                      // Map Styles
                      switch ($style) {
                        case 'filled-red':
                          $style_class = 'bg-red text-white hover:bg-red-700 hover:text-white border-2 border-transparent';
                          break;
                        case 'filled-purple':
                          $style_class = 'bg-purple text-white hover:bg-purple-800 hover:text-white border-2 border-transparent';
                          break;
                        case 'filled-white':
                          $style_class = 'bg-white text-gray-900 hover:bg-gray-100 hover:text-gray-900 border-2 border-transparent';
                          break;
                        case 'outline-red':
                          $style_class = 'bg-transparent border-2 border-red text-red hover:bg-red hover:text-white';
                          break;
                        case 'outline-purple':
                          $style_class = 'bg-transparent border-2 border-purple text-purple hover:bg-purple hover:text-white';
                          break;
                        case 'outline-white':
                          $style_class = 'bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900';
                          break;
                        default:
                          $style_class = 'bg-red text-white border-2 border-transparent';
                      }
                    ?>
                      <a href="<?php echo esc_url($link['url']); ?>"
                        target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                        class="<?php echo esc_attr("$base_class $style_class"); ?>">
                        <?php echo esc_html($link['title']); ?>
                      </a>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>

              </div>
            </div>

          </div>
        <?php endforeach; ?>
      </div>

      <!-- Navigation & Pagination -->
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev text-white hidden md:flex"></div>
      <div class="swiper-button-next text-white hidden md:flex"></div>
    </div>
  <?php endif; ?>

</section>