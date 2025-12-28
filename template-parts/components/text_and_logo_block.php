<?php

/**
 * Component: Text and Logo Block
 * Layout: text_and_logo_block
 */

$title = get_sub_field('title');
$text  = get_sub_field('text');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <div class="flex flex-col lg:flex-row items-center justify-center gap-8 lg:gap-16">

            <?php if ($title || $text) : ?>
                <div class="max-w-md text-center lg:text-left">
                    <?php if ($title) : ?>
                        <h2 class="text-3xl font-semibold mb-4"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <div class="text-xl leading-relaxed text-default">
                            <?php echo wp_kses_post($text); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (have_rows('gallery_images')) : ?>
                <div class="flex flex-wrap justify-center gap-8 items-center">
                    <?php
                    while (have_rows('gallery_images')) : the_row();
                        $img = get_sub_field('image_source');
                        if ($img) :
                    ?>
                            <div class="h-32 w-auto flex items-center">
                                <?php
                                if (is_array($img) && isset($img['ID'])) {
                                    echo wp_get_attachment_image($img['ID'], 'medium', false, array('class' => 'h-full w-auto object-contain'));
                                } elseif (is_numeric($img)) {
                                    echo wp_get_attachment_image($img, 'medium', false, array('class' => 'h-full w-auto object-contain'));
                                } elseif (is_string($img)) {
                                    echo '<img src="' . esc_url($img) . '" class="h-full w-auto object-contain" alt="">';
                                }
                                ?>
                            </div>
                    <?php
                        endif;
                    endwhile;
                    ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>