<?php
/**
 * Component: Gallery Slider
 * Layout: gallery_slider
 */

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <?php if ( have_rows('gallery_images') ) : ?>
            <div class="swiper w-full rounded-lg overflow-hidden shadow-lg">
                <div class="swiper-wrapper">
                    <?php 
                    while ( have_rows('gallery_images') ) : the_row(); 
                        $img = get_sub_field('image_source');
                        if ( $img ) :
                    ?>
                        <div class="swiper-slide">
                            <div class="h-64 md:h-128 w-full bg-gray-100">
                                <?php 
                                if ( is_array( $img ) && isset( $img['ID'] ) ) {
                                    echo wp_get_attachment_image( $img['ID'], 'full', false, array( 'class' => 'h-full w-full object-cover' ) );
                                } elseif ( is_numeric( $img ) ) {
                                    echo wp_get_attachment_image( $img, 'full', false, array( 'class' => 'h-full w-full object-cover' ) );
                                } elseif ( is_string( $img ) ) {
                                    echo '<img src="' . esc_url( $img ) . '" class="h-full w-full object-cover" alt="">';
                                }
                                ?>
                            </div>
                        </div>
                    <?php 
                        endif;
                    endwhile; 
                    ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev text-white drop-shadow-md"></div>
                <div class="swiper-button-next text-white drop-shadow-md"></div>
            </div>
        <?php endif; ?>

    </div>
</section>