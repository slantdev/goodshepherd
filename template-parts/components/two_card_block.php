<?php

/**
 * Component: Two Card Block
 * Layout: two_card_block
 */

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <?php if (have_rows('two_card_block_cards')) : ?>
            <div class="md:max-w-5xl mx-auto grid md:grid-cols-2 gap-10">
                <?php
                while (have_rows('two_card_block_cards')) : the_row();
                    $title = get_sub_field('title');
                    $text  = get_sub_field('text');
                    $icon  = get_sub_field('icon');
                ?>
                    <div class="bg-purple-50 shadow-lg hover:shadow-xl transition-shadow duration-200 rounded-xl p-8 relative h-full">

                        <?php if ($icon) : ?>
                            <div class="absolute right-0 top-0 -mr-2 -mt-2 w-12 h-12 md:w-16 md:h-16">
                                <?php echo goodshep_icon(array('icon' => $icon, 'class' => 'w-full h-full fill-current text-purple')); ?>
                            </div>
                        <?php endif; ?>

                        <div class="relative z-10">
                            <?php if ($title) : ?>
                                <h3 class="font-semibold mb-8 text-2xl pr-8"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if ($text) : ?>
                                <div class="prose max-w-none text-gray-700">
                                    <?php echo wp_kses_post($text); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>