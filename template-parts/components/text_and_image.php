<?php

/**
 * Component: Text and Image
 * Layout: text_and_image
 */

$title        = get_sub_field('title');
$text         = get_sub_field('text');
$image_source = get_sub_field('image_source');
$image_alt    = get_sub_field('image_alt');
$image_side   = get_sub_field('image_side');
$add_button   = get_sub_field('add_button');
$button_text  = get_sub_field('button_text');
$button_link  = get_sub_field('button_link');
$button_style = get_sub_field('button_style');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();

// Order Classes
$text_order  = ($image_side === 'left') ? 'md:order-2' : 'md:order-1';
$image_order = ($image_side === 'left') ? 'md:order-1' : 'md:order-2';
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <div class="grid md:grid-cols-2 gap-8 lg:gap-16 items-center">

            <!-- Image Column -->
            <div class="<?php echo esc_attr($image_order); ?>">
                <?php if ($image_source) : ?>
                    <img src="<?php echo esc_url($image_source); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        class="rounded-lg w-full h-full object-cover shadow-md">
                <?php endif; ?>
            </div>

            <!-- Text Column -->
            <div class="<?php echo esc_attr($text_order); ?>">
                <?php if ($title) : ?>
                    <h2 class="font-semibold text-3xl mb-6"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="prose max-w-none text-lg text-gray-700 mb-8">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php 
                if ( $add_button && $button_link ) : 
                    $btn_class = ($button_style === 'secondary') 
                        ? 'bg-transparent border-2 border-purple text-purple hover:bg-purple/10' 
                        : 'bg-red text-white border-2 border-transparent hover:opacity-90';
                ?>
                    <div>
                        <a href="<?php echo esc_url($button_link); ?>"
                            class="inline-block py-3 px-8 rounded font-bold transition-colors no-underline <?php echo esc_attr($btn_class); ?>">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>