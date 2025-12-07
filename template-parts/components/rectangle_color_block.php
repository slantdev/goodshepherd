<?php
/**
 * Component: Rectangle Color Block
 * Layout: rectangle_color_block
 */

$content = get_sub_field('content');
$bg      = get_sub_field('rectangle_background');

// Content
$heading    = $content['heading'] ?? '';
$subheading = $content['sub_heading'] ?? '';
$desc       = $content['description'] ?? '';
$logo       = $content['logo_image'] ?? '';
$text_color = $content['text_color'] ?? '';
$align      = $content['text_alignment'] ?? 'left';

// Background
$bg_color = $bg['background_color'] ?? '';
$bg_img   = $bg['background_image'] ?? '';

// Inline Styles
$style = '';
if ( $bg_color ) {
    $style .= 'background-color: ' . esc_attr( $bg_color ) . ';';
}
if ( $text_color ) {
    $style .= 'color: ' . esc_attr( $text_color ) . ';';
}
if ( ! empty( $bg_img['url'] ) ) {
    $style .= "background-image: url('" . esc_url( $bg_img['url'] ) . "'); background-size: cover; background-position: center;";
}

// Alignment Class
$align_class = 'text-' . $align;

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <div class="md:max-w-6xl mx-auto px-6 md:px-20 py-14 lg:py-20 rounded-lg <?php echo esc_attr( $align_class ); ?>" 
             style="<?php echo $style; ?>">
            
            <div class="mx-auto max-w-lg">
                <?php if ( $heading ) : ?>
                    <h2 class="font-extrabold text-3xl mb-2 text-inherit"><?php echo esc_html( $heading ); ?></h2>
                <?php endif; ?>

                <?php if ( $subheading ) : ?>
                    <h3 class="text-lg font-semibold mb-4 text-inherit"><?php echo esc_html( $subheading ); ?></h3>
                <?php endif; ?>

                <?php if ( $desc ) : ?>
                    <div class="prose max-w-none text-base mt-8 text-inherit opacity-90">
                        <?php echo wp_kses_post( $desc ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $logo ) : ?>
                    <div class="mt-8">
                        <div class="inline-block max-w-[192px]">
                            <?php 
                            if ( is_array( $logo ) && isset( $logo['id'] ) ) {
                                echo wp_get_attachment_image( $logo['id'], 'large' ); 
                            } elseif ( is_numeric( $logo ) ) {
                                echo wp_get_attachment_image( $logo, 'large' );
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>