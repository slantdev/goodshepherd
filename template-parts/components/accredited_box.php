<?php
/**
 * Component: Accredited Box
 * Layout: accredited_box
 */

$text     = get_sub_field('text');
$image    = get_sub_field('image');
$settings = get_sub_field('box_settings');

// Wrapper Attributes
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes(); 
$bg_style      = goodshep_get_bg_image_style();

// Inner Box Settings
$inner_bg_color = $settings['background_color'] ?? '';
$padding_top    = $settings['padding_top'] ?? '';
$padding_bottom = $settings['padding_bottom'] ?? '';

// Combine inner classes
$inner_classes = array_filter([ 
    'px-6 md:px-12 lg:px-20', 
    'rounded-lg',
    $padding_top,
    $padding_bottom 
]);
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <div class="<?php echo esc_attr( implode( ' ', $inner_classes ) ); ?>" style="<?php echo $inner_bg_color ? 'background-color: ' . esc_attr( $inner_bg_color ) . ';' : ''; ?>">
            
            <div class="flex flex-col items-center md:flex-row gap-y-4 md:gap-y-0 md:gap-x-12 lg:gap-x-16">
                
                <?php if ( $text ) : ?>
                    <div class="w-full md:w-3/4 md:text-xl md:leading-normal prose max-w-none">
                        <?php echo wp_kses_post( $text ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $image ) : ?>
                    <div class="w-full md:w-1/4">
                        <?php echo wp_get_attachment_image( $image['ID'], 'medium', false, array( 'class' => 'w-auto h-auto mx-auto md:mx-0' ) ); ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>
</section>