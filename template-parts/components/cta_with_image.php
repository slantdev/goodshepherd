<?php

/**
 * Component: CTA With Image
 * Layout: cta_with_image
 */

$title        = get_sub_field('title');
$text         = get_sub_field('text');
$image_source = get_sub_field('image_source');
$add_button   = get_sub_field('add_button');
$button_text  = get_sub_field('button_text');
$button_link  = get_sub_field('button_link');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <div class="flex flex-col md:flex-row bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden">

            <!-- Image (Left) -->
            <div class="w-full md:w-1/3 flex-none h-64 md:h-auto relative">
                <?php if ($image_source) : ?>
                    <img class="absolute inset-0 w-full h-full object-cover" src="<?php echo esc_url($image_source); ?>" alt="">
                <?php endif; ?>
            </div>

            <!-- Text (Right) -->
            <div class="w-full md:w-2/3 py-10 px-6 md:px-20 flex flex-col justify-center">

                <?php if ($title) : ?>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="prose max-w-none mb-8 text-default">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php
                if ($add_button && $button_link) :
                    $url    = is_array($button_link) ? $button_link['url'] : $button_link;
                    $target = is_array($button_link) ? ($button_link['target'] ?: '_self') : '_self';
                ?>
                    <div>
                        <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>"
                            class="inline-block bg-red text-white font-bold py-3 px-8 rounded hover:bg-red-800 transition-colors no-underline">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>
</section>