<?php
/**
 * Component: Four Logos Block
 * Layout: four_logos_block
 */

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <?php if ( have_rows('gallery_images') ) : ?>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12 items-center justify-items-center">
                <?php 
                while ( have_rows('gallery_images') ) : the_row(); 
                    $img = get_sub_field('image_source'); // Image array, ID, or URL
                    if ( $img ) :
                ?>
                    <div class="w-full h-40 md:h-64 flex items-center justify-center p-4">
                        <?php 
                        if ( is_array( $img ) && isset( $img['ID'] ) ) {
                            echo wp_get_attachment_image( $img['ID'], 'large', false, array( 'class' => 'max-h-full w-auto object-contain' ) );
                        } elseif ( is_numeric( $img ) ) {
                            echo wp_get_attachment_image( $img, 'large', false, array( 'class' => 'max-h-full w-auto object-contain' ) );
                        } elseif ( is_string( $img ) ) {
                            echo '<img src="' . esc_url( $img ) . '" class="max-h-full w-auto object-contain" alt="">';
                        }
                        ?>
                    </div>
                <?php endif; endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>