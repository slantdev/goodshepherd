<?php

/**
 * Template part for displaying the site footer
 */

$flags_repeater = get_field('flags', 'option');
?>

<footer id="colophon" class="site-footer bg-white pt-8">
  <div class="container mx-auto flex flex-wrap pt-6 pb-2 px-4 text-base lg:py-12">

    <!-- Left Column -->
    <div class="w-full mb-4 lg:w-3/5 lg:pr-8">
      <div class="flex flex-col lg:flex-row gap-4 lg:gap-12">

        <!-- Inner Left -->
        <div class="mb-4 w-full lg:w-1/2">
          <div class="prose leading-normal mb-4 lg:mb-10 text-body">
            <?php echo wp_kses_post(get_field('footer_text', 'option')); ?>
          </div>

          <div class="flex items-center my-4 gap-4 flex-wrap">
            <?php if ($flags_repeater): ?>
              <?php foreach ($flags_repeater as $flag):
                $flag_image = $flag['flag_image'];
                if (empty($flag_image['url'])) continue;

                $title = $flag['title'];
                $description = $flag['description'];
                $link = $flag['link'];
                $link_url = $link['url'] ?? '';
                $popover_class = $description ? 'flag-popover-trigger cursor-help' : '';
              ?>
                <img class="w-auto h-10 md:h-12 <?php echo esc_attr($popover_class); ?>"
                  src="<?php echo esc_url($flag_image['url']); ?>"
                  width="80" height="48"
                  alt="<?php echo esc_attr($flag_image['alt']); ?>"
                  data-title="<?php echo esc_attr($title); ?>"
                  data-description="<?php echo esc_attr($description); ?>"
                  data-link="<?php echo esc_url($link_url); ?>">
              <?php endforeach; ?>
            <?php endif; ?>

            <?php
            // Rainbow Tick
            if (is_single(3879) || is_single(3987) || is_tax('service_category', 'family-violence-services')): ?>
              <img class="w-auto h-10 md:h-12" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/rainbow-tick.png'); ?>" width="104" height="50" alt="rainbow tick">
            <?php endif; ?>

            <!-- Registered Charity -->
            <img class="w-auto h-14 md:h-16" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/registered-charity-4.png'); ?>" width="64" height="64" alt="registered charity">
          </div>
        </div>

        <!-- Inner Right -->
        <div class="w-full mb-4 lg:w-1/2">
          <div class="prose leading-normal mb-4 lg:mb-10 text-body">
            <?php echo wp_kses_post(get_field('footer_text_2', 'option')); ?>
          </div>
        </div>

      </div>
    </div>

    <!-- Right Column (Menus) -->
    <div class="flex flex-wrap w-full mb-4 lg:w-2/5 lg:pl-4">

      <!-- Menu Column 1 & 2 -->
      <div class="w-full mb-4 md:w-1/2 md:px-4">
        <div class="mb-6">
          <h2 class="text-lg tracking-normal font-semibold mb-4 text-off-black"><?php echo esc_html(get_field('footer_menu_header_02', 'option')); ?></h2>
          <?php if (has_nav_menu('footer_menu_02')): ?>
            <?php wp_nav_menu(array(
              'theme_location' => 'footer_menu_02',
              'menu_id' => 'footer_menu_02',
              'container' => false,
              'menu_class' => 'footer-menu list-none m-0 p-0 space-y-2.5'
            )); ?>
          <?php endif; ?>
        </div>

        <div class="mb-6">
          <h2 class="text-lg tracking-normal font-semibold mb-4 text-off-black"><?php echo esc_html(get_field('footer_menu_header_01', 'option')); ?></h2>
          <?php if (has_nav_menu('footer_menu_01')): ?>
            <?php wp_nav_menu(array(
              'theme_location' => 'footer_menu_01',
              'menu_id' => 'footer_menu_01',
              'container' => false,
              'menu_class' => 'footer-menu list-none m-0 p-0 space-y-2.5'
            )); ?>
          <?php endif; ?>
        </div>
      </div>

      <!-- Menu Column 3 & Address -->
      <div class="w-full mb-6 md:w-1/2 md:pl-4">
        <h2 class="text-lg tracking-normal font-semibold mb-4 text-off-black"><?php echo esc_html(get_field('footer_menu_header_03', 'option')); ?></h2>
        <?php if (has_nav_menu('footer_menu_03')): ?>
          <?php wp_nav_menu(array(
            'theme_location' => 'footer_menu_03',
            'menu_id' => 'footer_menu_03',
            'container' => false,
            'menu_class' => 'footer-menu list-none m-0 p-0 space-y-2.5'
          )); ?>
        <?php endif; ?>

        <div class="mt-8">
          <p class="leading-loose text-dark-purple"><?php echo wp_kses_post(get_field('address', 'option')); ?></p>
        </div>
      </div>

    </div>

  </div>

  <!-- Bottom Bar -->
  <div class="bg-light-purple py-4">
    <div class="container mx-auto flex flex-wrap px-4 pt-3 pb-24 md:pb-4 justify-between items-center">

      <div class="text-sm text-center w-full mb-6 lg:text-left lg:w-auto lg:mb-0 text-off-black">
        &copy; <?php echo date('Y'); ?> Good Shepherd
      </div>

      <div class="text-sm flex flex-wrap w-full lg:w-auto justify-center lg:justify-end">
        <ul class="w-full text-center lg:flex lg:w-auto lg:mr-8 lg:text-left space-x-2">
          <?php
          $bottom_links = [
            'terms_&_conditions_link',
            'privacy_policy_link',
            'site_map_link'
          ];
          foreach ($bottom_links as $field_name):
            $link = get_field($field_name, 'option');
            if ($link):
              $url = $link['url'] ?? '';
              $title = $link['title'] ?? '';
              $target = $link['target'] ?? '_self';
          ?>
              <li>
                <a class="inline-block px-2 text-body no-underline hover:text-purple transition-colors" href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
                  <?php echo esc_html($title); ?>
                </a>
              </li>
          <?php endif;
          endforeach; ?>
        </ul>

        <!-- Social Icons -->
        <ul class="flex mt-6 mb-4 mx-auto lg:mx-0 lg:my-0 gap-2">
          <?php
          $socials = [
            'facebook' => 'link_facebook',
            'instagram' => 'link_instagram',
            'twitter' => 'link_twitter',
            'youtube' => 'link_youtube'
          ];
          foreach ($socials as $icon => $field):
            $link = get_field($field, 'option');
            if ($link):
          ?>
              <li>
                <a class="inline-block px-1 text-purple hover:text-dark-purple transition-colors" href="<?php echo esc_url($link['url']); ?>" target="_blank" aria-label="<?php echo esc_attr($icon); ?>">
                  <?php echo goodshep_icon(array('icon' => $icon, 'group' => 'social', 'class' => 'w-5 h-5 fill-current')); ?>
                </a>
              </li>
          <?php endif;
          endforeach; ?>
        </ul>
      </div>

    </div>
  </div>
</footer>

<!-- Quick Exit Button -->
<?php
// Quick Exit Logic
$post_id = get_the_ID();
if (is_archive()) {
  $object = get_queried_object();
  if (isset($object->taxonomy)) {
    $post_id = $object->taxonomy . '_' . $object->term_id;
  }
}

if (get_field('quick_escape', $post_id)):
?>
  <section id="quick_exit_button" class="fixed bottom-0 w-full py-6 bg-red text-2xl text-center text-white font-semibold shadow cursor-pointer z-50 transition-all duration-500 hover:bg-opacity-90">
    <?php esc_html_e('Click here to exit quickly', 'goodshep-theme'); ?>
  </section>
<?php endif; ?>