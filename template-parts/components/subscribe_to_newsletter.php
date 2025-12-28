<?php

/**
 * Component: Subscribe to Newsletter
 * Layout: subscribe_to_newsletter
 */

$title     = get_sub_field('title');
$text      = get_sub_field('text');
$shortcode = get_sub_field('form_shortcode');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4 relative">

        <div class="max-w-xl mx-auto text-center relative">

            <!-- Decorative Heart -->
            <div class="absolute -top-4 -left-12 hidden md:block opacity-80">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gs_heart.svg" alt="" class="h-12 w-auto">
            </div>

            <?php if ($title) : ?>
                <h2 class="font-semibold text-3xl mb-4"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($text) : ?>
                <div class="text-xl leading-relaxed mb-8 text-default">
                    <?php echo wp_kses_post($text); ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="max-w-2xl mx-auto py-8 text-center">
            <?php
            if ($shortcode) {
                echo '<div class="form-wrapper">' . do_shortcode($shortcode) . '</div>';
            } elseif (is_user_logged_in()) {
                echo '<p class="p-4 bg-gray-100 border border-dashed text-gray-500">Select a form in the editor.</p>';
            }
            ?>
        </div>

    </div>
</section>