<?php

/**
 * Component: Download PDF Block
 * Layout: download_pdf_block
 */

$image    = get_sub_field('image_source'); // Image array or ID
$title    = get_sub_field('title');
$text     = get_sub_field('text');
$pdf_link = get_sub_field('pdf_link'); // Link Array

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4 md:px-24">

        <div class="flex flex-col md:flex-row mx-auto bg-white shadow-lg hover:shadow-xl transition-shadow rounded-sm py-6 px-12 max-w-5xl items-center text-center md:text-left gap-6">

            <!-- Icon/Image -->
            <?php if ($image) : ?>
                <div class="flex-none">
                    <?php
                    if (is_array($image) && isset($image['ID'])) {
                        echo wp_get_attachment_image($image['ID'], 'medium', false, array('class' => 'h-12 w-auto'));
                    } elseif (is_numeric($image)) {
                        echo wp_get_attachment_image($image, 'medium', false, array('class' => 'h-12 w-auto'));
                    } elseif (is_string($image)) {
                        echo '<img src="' . esc_url($image) . '" class="h-12 w-auto" alt="">';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <!-- Text Content -->
            <div class="grow">
                <?php if ($title) : ?>
                    <h3 class="text-xl font-semibold mb-2"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="font-medium text-gray-600">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- PDF Download Link -->
            <?php if ($pdf_link) : ?>
                <div class="flex-none flex flex-col items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/pdf.svg" alt="PDF Icon" class="h-12 w-auto mb-2" />

                    <a href="<?php echo esc_url($pdf_link['url']); ?>"
                        target="<?php echo esc_attr($pdf_link['target'] ?: '_self'); ?>"
                        class="text-purple-600 hover:text-purple-800 font-medium no-underline">
                        Download PDF
                    </a>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>