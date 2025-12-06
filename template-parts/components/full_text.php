<?php
/**
 * Component: Full Text Block
 * Layout: full_text
 */

$title    = get_sub_field('title');
$text     = get_sub_field('text');
$settings = get_sub_field('full_text_settings');

// Layout Logic
$width     = $settings['container_width'] ?? '';
$align     = $settings['text_alignment'] ?? 'left';

$inner_classes = [];

// Width Map (based on NOTES.md)
if ( $width === 'medium' ) {
    $inner_classes[] = 'lg:px-24'; // gs_3xl
} elseif ( $width === 'small' ) {
    $inner_classes[] = 'max-w-3xl mx-auto';
} else {
    $inner_classes[] = 'mx-auto';
}

// Alignment
$inner_classes[] = 'text-' . $align;

// Join classes
$container_class = implode( ' ', $inner_classes );

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <div class="<?php echo esc_attr( $container_class ); ?>">
            
            <?php if ( $title ) : ?>
                <div class="mb-4"> <!-- gs_md -->
                    <h2 class="lg:text-4xl text-3xl font-semibold text-red-600">
                        <?php echo esc_html( $title ); ?>
                    </h2>
                </div>
            <?php endif; ?>

            <?php if ( $text ) : ?>
                <div class="prose max-w-none text-lg mb-6">
                    <?php echo wp_kses_post( $text ); ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>