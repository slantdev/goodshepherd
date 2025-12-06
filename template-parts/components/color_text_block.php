<?php
/**
 * Component: Color Text Block
 * Layout: color_text_block
 */

// Fields
$title = get_sub_field('title');
$text  = get_sub_field('text');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes(); 
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4 lg:px-12">
        
        <div class="grid md:grid-cols-3">
            <div class="md:col-span-2">
                
                <?php if ( $title ) : ?>
                    <h2 class="font-semibold text-3xl md:text-4xl mb-8 text-inherit">
                        <?php echo esc_html( $title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( $text ) : ?>
                    <div class="prose prose-lg max-w-none text-xl leading-relaxed text-inherit opacity-90">
                        <?php echo wp_kses_post( $text ); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>