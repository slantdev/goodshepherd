<?php
/**
 * Component: Gallery Block 02
 * Layout: gallery_block_02
 */

$main_image = get_sub_field('image_source'); // Single Image
$thumbnails = get_sub_field('gallery_images'); // Repeater

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <div class="grid md:grid-cols-2 gap-4 md:gap-8">
            
            <!-- Left: Thumbnails Grid -->
            <div class="grid grid-cols-2 gap-4">
                <?php 
                if ( have_rows('gallery_images') ) :
                    while ( have_rows('gallery_images') ) : the_row();
                        $img = get_sub_field('image_source');
                        if ( $img ) :
                ?>
                    <div class="h-40 md:h-64 w-full rounded-md overflow-hidden bg-gray-100">
                        <?php 
                        if ( is_array( $img ) && isset( $img['ID'] ) ) {
                            echo wp_get_attachment_image( $img['ID'], 'large', false, array( 'class' => 'h-full w-full object-cover' ) );
                        } elseif ( is_numeric( $img ) ) {
                            echo wp_get_attachment_image( $img, 'large', false, array( 'class' => 'h-full w-full object-cover' ) );
                        } elseif ( is_string( $img ) ) {
                            echo '<img src="' . esc_url( $img ) . '" class="h-full w-full object-cover" alt="">';
                        }
                        ?>
                    </div>
                <?php 
                        endif;
                    endwhile;
                endif;
                ?>
            </div>

            <!-- Right: Main Image -->
            <div class="h-64 md:h-full w-full rounded-md overflow-hidden bg-gray-100 min-h-[20rem]">
                <?php 
                if ( $main_image ) {
                    if ( is_array( $main_image ) && isset( $main_image['ID'] ) ) {
                        echo wp_get_attachment_image( $main_image['ID'], 'full', false, array( 'class' => 'h-full w-full object-cover' ) );
                    } elseif ( is_numeric( $main_image ) ) {
                        echo wp_get_attachment_image( $main_image, 'full', false, array( 'class' => 'h-full w-full object-cover' ) );
                    } elseif ( is_string( $main_image ) ) {
                        echo '<img src="' . esc_url( $main_image ) . '" class="h-full w-full object-cover" alt="">';
                    }
                }
                ?>
            </div>

        </div>

    </div>
</section>