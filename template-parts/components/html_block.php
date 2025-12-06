<?php
/**
 * Component: HTML Block
 * Layout: html_block
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
        
        <?php if ( $title ) : ?>
            <h2 class="text-2xl mb-4 font-semibold"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( $text ) : ?>
            <div class="prose max-w-none text-base mb-4">
                <?php echo $text; // Allow raw HTML ?>
            </div>
        <?php endif; ?>

    </div>
</section>