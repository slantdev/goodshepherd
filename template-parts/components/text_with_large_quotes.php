<?php
/**
 * Component: Text with Large Quotes (or Text Block)
 * Layout: text_with_large_quotes
 */

$title = get_sub_field('title');
$text  = get_sub_field('text');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
            
            <div>
                <?php if ( $title ) : ?>
                    <h2 class="text-3xl lg:text-4xl font-bold mb-4 text-inherit leading-tight"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>
            </div>

            <div>
                <?php if ( $text ) : ?>
                    <div class="text-xl leading-relaxed text-inherit opacity-90">
                        <?php echo wp_kses_post( $text ); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>