<?php

/**
 * Component: Featured with Filter
 * Layout: featured_with_filter
 */

$intro = get_sub_field('section_intro');
$headline = $intro['headline'] ?? '';
$description = $intro['description'] ?? '';

$filter_group = get_sub_field('filters');
$enable_filter = $filter_group['enable_filter'] ?? false;
$filters = $filter_group['filters'] ?? [];

// Updated repeater name to 'featured_content'
$featured_content_groups = get_sub_field('featured_content') ?? [];

// Wrapper Attributes
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes('relative');
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?> js-featured-filter-section" style="<?php echo esc_attr($bg_style); ?>">
  <div class="container mx-auto px-4">

    <!-- Intro Content -->
    <?php if ($headline || $description) : ?>
      <div class="max-w-6xl mx-auto mb-12 text-center">
        <?php if ($headline) : ?>
          <h2 class="text-3xl lg:text-4xl font-semibold mb-6"><?php echo esc_html($headline); ?></h2>
        <?php endif; ?>

        <?php if ($description) : ?>
          <div class="prose max-w-none text-lg leading-relaxed text-default">
            <?php echo wp_kses_post($description); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- Filters -->
    <?php if ($enable_filter && !empty($filters)) : ?>
      <div class="mb-12 flex flex-nowrap items-center justify-center gap-4 py-4 overflow-x-auto">
        <button type="button"
          class="js-featured-filter-btn flex items-center gap-3 px-6 py-3 rounded-full bg-off-white shadow-sm text-default text-lg text-left transition-all hover:shadow-md cursor-pointer active"
          data-filter="all">
          <div class="inline-flex w-6 h-6 bg-white inset-shadow-sm/20 rounded-full items-center justify-center">
            <div class="active-indicator inline-block w-3 h-3 bg-blue rounded-full"></div>
          </div>
          <span><?php _e('All', 'goodshep-theme'); ?></span>
        </button>
        <?php foreach ($filters as $f) :
          $f_text = $f['filter_text'] ?? '';
          $f_slug = $f['filter_slug'] ?? '';
          if (!$f_text) continue;
        ?>
          <button type="button"
            class="js-featured-filter-btn flex items-center gap-3 px-6 py-3 rounded-full bg-off-white shadow-sm text-default text-left text-lg transition-all hover:shadow-md cursor-pointer"
            data-filter="<?php echo esc_attr($f_slug); ?>">
            <div class="inline-flex w-6 h-6 bg-white inset-shadow-sm/20 rounded-full items-center justify-center shrink-0">
              <div class="active-indicator inline-block w-3 h-3 bg-transparent rounded-full invisible"></div>
            </div>
            <span><?php echo esc_html($f_text); ?></span>
          </button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Items Grid / Slider -->
    <div class="featured-filter-slider swiper relative pb-16! pt-4! px-4! lg:px-5! xl:px-8!" style="--swiper-navigation-sides-offset:-8px;">
      <div class="swiper-wrapper">
        <?php
        // 1. Process Data to Deduplicate Posts
        $unique_posts = [];

        foreach ($featured_content_groups as $group) {
          $filter_slug = $group['assigned_filter_slug'] ?? '';
          $posts = $group['content_cards'] ?? [];

          if ($posts) {
            foreach ($posts as $post_obj) {
              $p_id = $post_obj->ID;

              // If post already exists, just append the new filter category
              if (isset($unique_posts[$p_id])) {
                if ($filter_slug && !in_array($filter_slug, $unique_posts[$p_id]['categories'])) {
                  $unique_posts[$p_id]['categories'][] = $filter_slug;
                }
              } else {
                // Initialize post data
                $unique_posts[$p_id] = [
                  'obj' => $post_obj,
                  'categories' => $filter_slug ? [$filter_slug] : []
                ];
              }
            }
          }
        }

        // 2. Render Unique Posts
        foreach ($unique_posts as $p_id => $item) :
          $post_obj = $item['obj'];
          $cats = implode(' ', $item['categories']); // Space separated for easy JS check

          $p_title = get_the_title($p_id);
          $p_link = get_permalink($p_id);
          $p_excerpt = get_the_excerpt($p_id);
          $p_thumb = get_the_post_thumbnail_url($p_id, 'large');
        ?>
          <div class="swiper-slide js-featured-filter-item h-auto!" data-categories="<?php echo esc_attr($cats); ?>">
            <div class="rounded-2xl shadow-lg hover:shadow-xl transition-shadow h-full overflow-hidden flex flex-col bg-white group">

              <!-- Image -->
              <div class="relative h-64 flex-none">
                <a href="<?php echo esc_url($link); ?>" class="block h-full w-full">
                  <?php if ($p_thumb) : ?>
                    <img src="<?php echo esc_url($p_thumb); ?>"
                      class="object-cover h-full w-full transition-transform duration-500 group-hover:scale-105"
                      alt="<?php echo esc_attr($p_title); ?>">
                  <?php else : ?>
                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                      <?php echo goodshep_icon(['icon' => 'image', 'class' => 'w-12 h-12']); ?>
                    </div>
                  <?php endif; ?>
                </a>
              </div>

              <!-- Content -->
              <div class="pt-8 px-8 pb-8 flex flex-col grow">
                <h3 class="text-2xl font-semibold mb-6">
                  <a href="<?php echo esc_url($p_link); ?>" class="text-gray-900 hover:text-purple transition-colors no-underline">
                    <?php echo esc_html($p_title); ?>
                  </a>
                </h3>

                <?php if ($p_excerpt) : ?>
                  <div class="mb-8 text-default text-base leading-relaxed grow line-clamp-3">
                    <?php echo wp_kses_post($p_excerpt); ?>
                  </div>
                <?php endif; ?>

                <div class="mt-auto">
                  <a href="<?php echo esc_url($p_link); ?>"
                    class="inline-flex items-center text-red text-base font-medium uppercase tracking-wide hover:underline hover:opacity-80 transition-opacity no-underline">
                    <span><?php _e('Learn More', 'goodshep-theme'); ?></span>
                    <?php echo goodshep_icon(array('icon' => 'navigate-right', 'group' => 'utility', 'class' => 'w-2 h-2 ml-2 fill-current')); ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php
        endforeach;
        ?>
      </div>

      <div class="swiper-pagination bottom-0!"></div>
      <div class="swiper-button-prev text-purple"></div>
      <div class="swiper-button-next text-purple"></div>
    </div>

  </div>
</section>