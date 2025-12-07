<?php

/**
 * Component: Step Block Cards
 * Layout: step_block_cards
 */

$title = get_sub_field('title');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <?php if ( $title ) : ?>
            <h2 class="font-semibold text-red mb-6 lg:mb-16 text-3xl"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( have_rows('step_block_cards') ) : ?>
            <div class="grid md:grid-cols-3 gap-8 lg:gap-12 md:px-12">
                <?php 
                $i = 1;
                while ( have_rows('step_block_cards') ) : the_row(); 
                    $card_title = get_sub_field('title');
                    $card_text  = get_sub_field('text');
                ?>
                    <div class="border border-purple rounded-lg p-6 h-full">
                        
                        <div class="flex items-center mb-4">
                            <div class="bg-purple text-white rounded-full flex h-8 w-8 justify-center items-center text-base flex-shrink-0 mr-4">
                                <?php echo intval( $i ); ?>
                            </div>

                            <?php if ($card_title) : ?>
                                <h3 class="text-2xl font-semibold mb-0"><?php echo esc_html($card_title); ?></h3>
                            <?php endif; ?>
                        </div>

                        <?php if ($card_text) : ?>
                            <div class="text-gray-600 leading-relaxed">
                                <?php echo wp_kses_post($card_text); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php $i++;
                endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>