<?php

/**
 * Template part for displaying the site navigation
 */
?>

<?php
$menu_items_repeater = get_field('menu_items', 'option') ?? ''; // Repeater
?>

<div class="container mx-auto px-4">

  <?php if (have_rows('menu_items', 'option')): ?>
    <div class="relative w-full flex justify-between items-center z-20">
      <nav id="site-navigation" class="w-full" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'goodshep-theme'); ?>">
        <ul class="menu--ul flex">
          <?php
          while (have_rows('menu_items', 'option')) : the_row();
            $menu_item = get_sub_field('menu_item');
            if (empty($menu_item)) continue;

            $menu_item_title = $menu_item['title'] ?? '';
            $menu_item_url = $menu_item['url'] ?? '#';
            $menu_item_target = $menu_item['target'] ?? '_self';

            $has_submenu = get_sub_field('has_submenu');
            $submenu_type = get_sub_field('submenu_type') ?? ''; // megamenu or dropdown

            // Link Classes
            $link_classes = 'parent--link font-semibold text-xl text-body no-underline flex px-4 py-[18px] gap-x-3 items-center group-hover:text-red focus:text-red transition-colors';
          ?>

            <li class="menu--li pr-5 group static">
              <a href="<?php echo esc_url($menu_item_url); ?>"
                target="<?php echo esc_attr($menu_item_target); ?>"
                class="<?php echo esc_attr($link_classes); ?>"
                <?php echo $has_submenu ? 'aria-haspopup="true" aria-expanded="false"' : ''; ?>>

                <span><?php echo esc_html($menu_item_title); ?></span>

                <?php if ($has_submenu): ?>
                  <span class="inline-block transition-transform duration-200 group-hover:-rotate-180 group-focus-within:-rotate-180">
                    <svg class="w-3 h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 336.36">
                      <path d="M42.47.01 469.5 0C492.96 0 512 19.04 512 42.5c0 11.07-4.23 21.15-11.17 28.72L294.18 320.97c-14.93 18.06-41.7 20.58-59.76 5.65-1.8-1.49-3.46-3.12-4.97-4.83L10.43 70.39C-4.97 52.71-3.1 25.86 14.58 10.47 22.63 3.46 32.57.02 42.47.01z" />
                    </svg>
                  </span>
                <?php endif; ?>
              </a>

              <?php if ($has_submenu && $submenu_type === 'megamenu'):
                $megamenu_items = get_sub_field('megamenu_items');
                $megamenu_heading = $megamenu_items['menu_heading'] ?? '';
                $megamenu_submenu_type = $megamenu_items['submenu_type'] ?? '';
                $megamenu_submenu_repeater = $megamenu_items['submenu_group'] ?? [];
              ?>
                <div class="megamenu--submenu absolute left-0 right-0 top-full bg-off-white p-8 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible group-focus-within:opacity-100 group-focus-within:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 group-focus-within:translate-y-0 z-50 border-t border-gray-100">

                  <?php if ($megamenu_heading): ?>
                    <div class="megamenu--heading hidden md:block mb-6 px-4">
                      <h2 class="text-3xl font-semibold text-off-black"><?php echo esc_html($megamenu_heading); ?></h2>
                    </div>
                  <?php endif; ?>

                  <?php if ($megamenu_submenu_type === 'link-list' && !empty($megamenu_submenu_repeater)): ?>
                    <div class="megamenu--grid grid grid-cols-4">
                      <?php foreach ($megamenu_submenu_repeater as $submenu):
                        $submenu_heading = $submenu['submenu_heading'] ?? '';
                        $submenu_items = $submenu['submenu_items'] ?? [];
                      ?>
                        <div class="px-4 pb-4">
                          <?php if ($submenu_heading): ?>
                            <h3 class="submenu--heading text-xl font-semibold text-off-black mb-4">
                              <?php echo esc_html($submenu_heading); ?>
                            </h3>
                          <?php endif; ?>

                          <?php if (!empty($submenu_items)): ?>
                            <ul class="submenu--ul space-y-2">
                              <?php foreach ($submenu_items as $item):
                                $link = $item['submenu_link'] ?? [];
                                $title = $link['title'] ?? '';
                                $url = $link['url'] ?? '#';
                                $target = $link['target'] ?? '_self';
                              ?>
                                <li class="submenu--li">
                                  <a href="<?php echo esc_url($url); ?>"
                                    target="<?php echo esc_attr($target); ?>"
                                    class="submenu--link text-[17px] leading-6 text-grey hover:text-red focus:text-red no-underline inline-block py-1 transition-colors">
                                    <?php echo esc_html($title); ?>
                                  </a>
                                </li>
                              <?php endforeach; ?>
                            </ul>
                          <?php endif; ?>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>

                </div>
              <?php endif; ?>
            </li>
          <?php endwhile; ?>
        </ul>
      </nav>
    </div>
  <?php endif; ?>

  <nav id="site-navigation" class="main-navigation w-full hidden" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'goodshep-theme'); ?>">
    <?php
    wp_nav_menu(array(
      'theme_location' => 'primary',
      'menu_id'        => 'primary-menu',
      'container'      => false,
      'menu_class'     => 'flex flex-wrap gap-x-8 text-base font-medium text-off-black py-4',
    ));
    ?>
  </nav>

  <!-- Desktop Search Toggle -->
  <div class="header-search-toggle ml-4 border-l border-gray-200 pl-4 hidden">
    <button id="search-toggle" class="flex items-center text-purple focus:outline-none hover:text-off-black transition-colors">
      <span class="sr-only"><?php esc_html_e('Search', 'goodshep-theme'); ?></span>
      <?php echo goodshep_icon(array('icon' => 'search', 'group' => 'utility', 'class' => 'w-6 h-6')); ?>
    </button>
  </div>

  <!-- Desktop Search Form (Hidden by default) -->
  <div id="header-search-form" class="hidden absolute right-0 top-full bg-white shadow-lg p-4 z-50 w-80 border-t border-gray-100">
    <?php get_search_form(); ?>
  </div>
</div>