<?php

/**
 * Component: Video Block 2
 * Layout: video_block_2
 */

$content = get_sub_field('content');
$video   = $content['video'] ?? '';
$text    = $content['text'] ?? [];
$txt_left  = $text['text_left'] ?? '';
$txt_right = $text['text_right'] ?? '';

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <!-- Row 1: Video -->
        <?php if ($video) : ?>
            <div class="w-full mb-12">
                <div class="aspect-video w-full rounded-lg overflow-hidden shadow-lg bg-black [&_iframe]:w-full [&_iframe]:h-full">
                    <?php echo $video; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Row 2: Text Columns -->
        <?php if ($txt_left || $txt_right) : ?>
            <div class="grid md:grid-cols-2 gap-8 lg:gap-12">

                <div class="prose max-w-none text-lg text-default leading-relaxed">
                    <?php echo wp_kses_post($txt_left); ?>
                </div>

                <div class="prose max-w-none text-lg text-default leading-relaxed">
                    <?php echo wp_kses_post($txt_right); ?>
                </div>

            </div>
        <?php endif; ?>

    </div>
</section>