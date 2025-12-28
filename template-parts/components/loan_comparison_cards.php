<?php

/**
 * Component: Loan Comparison Cards
 * Layout: loan_comparison_cards
 */

$title = get_sub_field('title');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <?php if ($title) : ?>
            <div class="mb-12">
                <h2 class="font-semibold mb-0 text-3xl"><?php echo esc_html($title); ?></h2>
            </div>
        <?php endif; ?>

        <?php if (have_rows('loan_comparison_cards')) : ?>
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                while (have_rows('loan_comparison_cards')) : the_row();
                    // Section 1
                    $icon     = get_sub_field('icon');
                    $title_01 = get_sub_field('title');
                    $text_01  = get_sub_field('text');

                    // Section 2
                    $title_02  = get_sub_field('buttons_title');
                    $btn1_group = get_sub_field('button_01');
                    $btn2_group = get_sub_field('button_02');

                    // Section 3 (Featured Points)
                    // The reference hardcodes 3 points. I'll loop or access them directly.
                    $points = [
                        [
                            'title' => get_sub_field('featured_point_01_title'),
                            'text'  => get_sub_field('featured_point_01_text'),
                        ],
                        [
                            'title' => get_sub_field('featured_point_02_title'),
                            'text'  => get_sub_field('featured_point_02_text'),
                        ],
                        [
                            'title' => get_sub_field('featured_point_03_title'),
                            'text'  => get_sub_field('featured_point_03_text'),
                        ],
                    ];
                ?>
                    <div class="border border-gray-400 rounded-lg px-6 py-8 divide-y divide-gray-200 bg-white h-full flex flex-col">

                        <!-- Section 1: Header & Features -->
                        <div class="pb-6 grow">
                            <?php if ($icon) : ?>
                                <div class="mb-6 w-12 h-12 text-purple">
                                    <?php echo goodshep_icon(array('icon' => $icon, 'class' => 'w-12 h-12 fill-current')); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($title_01) : ?>
                                <h3 class="text-2xl font-semibold mb-2 text-gray-900"><?php echo esc_html($title_01); ?></h3>
                            <?php endif; ?>

                            <?php if ($text_01) : ?>
                                <div class="text-default mb-4"><?php echo wp_kses_post($text_01); ?></div>
                            <?php endif; ?>

                            <?php if (have_rows('list')) : ?>
                                <div class="mt-4 space-y-2">
                                    <?php while (have_rows('list')) : the_row();
                                        $item = get_sub_field('list_item');
                                    ?>
                                        <div class="flex items-start">
                                            <div class="shrink-0 mr-3 mt-1 text-green-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm"><?php echo esc_html($item); ?></span>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Section 2: Buttons -->
                        <div class="py-8">
                            <?php if ($title_02) : ?>
                                <h3 class="text-xl font-semibold mb-6 text-gray-900"><?php echo esc_html($title_02); ?></h3>
                            <?php endif; ?>

                            <div class="grid grid-cols-2 gap-3">
                                <?php
                                // Button 1 (Secondary style in ref)
                                if (! empty($btn1_group['add_button']) && ! empty($btn1_group['button_link'])) :
                                    $b1 = $btn1_group;
                                ?>
                                    <a href="<?php echo esc_url($b1['button_link']); ?>" class="text-center py-3 border border-purple text-purple rounded font-medium hover:opacity-80 transition-opacity no-underline text-sm">
                                        <?php echo esc_html($b1['button_text']); ?>
                                    </a>
                                <?php endif; ?>

                                <?php
                                // Button 2 (Primary style in ref)
                                if (! empty($btn2_group['add_button']) && ! empty($btn2_group['button_link'])) :
                                    $b2 = $btn2_group;
                                ?>
                                    <a href="<?php echo esc_url($b2['button_link']); ?>" class="text-center py-3 bg-red text-white rounded font-medium hover:opacity-90 transition-opacity no-underline text-sm">
                                        <?php echo esc_html($b2['button_text']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Section 3: Details -->
                        <div class="pt-8 space-y-6">
                            <?php foreach ($points as $point) :
                                if ($point['title'] || $point['text']) :
                            ?>
                                    <div>
                                        <?php if ($point['title']) : ?>
                                            <h4 class="font-semibold mb-1 text-gray-900"><?php echo esc_html($point['title']); ?></h4>
                                        <?php endif; ?>

                                        <?php if ($point['text']) : ?>
                                            <div class="text-sm text-gray-600"><?php echo wp_kses_post($point['text']); ?></div>
                                        <?php endif; ?>
                                    </div>
                            <?php endif;
                            endforeach; ?>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>