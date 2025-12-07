<?php
/**
 * Component: Wide Text and Image
 * Layout: wide_text_and_image
 */

$title        = get_sub_field('title');
$text         = get_sub_field('text');
$image_source = get_sub_field('image_source');
$image_alt    = get_sub_field('image_alt');
$image_side   = get_sub_field('image_side');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();

// Order Classes
$text_order  = ($image_side === 'left') ? 'md:order-2' : 'md:order-1';
$image_order = ($image_side === 'left') ? 'md:order-1' : 'md:order-2';
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <?php if ( $title ) : ?>
            <h2 class="font-semibold text-red text-3xl lg:text-4xl mb-12"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 gap-8 lg:gap-16">
            
            <!-- Image Column -->
            <div class="<?php echo esc_attr( $image_order ); ?>">
                <?php if ( $image_source ) : ?>
                    <img src="<?php echo esc_url( $image_source ); ?>" 
                         alt="<?php echo esc_attr( $image_alt ); ?>" 
                         class="rounded-lg w-full h-full object-cover shadow-md">
                <?php endif; ?>
            </div>

            <!-- Text Column -->
            <div class="<?php echo esc_attr( $text_order ); ?>">
                <?php if ( $text ) : ?>
                    <div class="prose max-w-none text-xl leading-9 text-gray-700">
                        <?php echo wp_kses_post( $text ); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>