<?php
/**
 * Component: Gallery Block 01
 * Layout: gallery_block_01
 */

$title  = get_sub_field('title');
$text   = get_sub_field('text');
$images = get_sub_field('gallery_images'); // Repeater: image_source, image_alt

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
            
            <!-- Info Box (First Item) -->
            <div class="flex flex-col justify-center items-center text-center p-8 border border-gray-400 rounded-md bg-white min-h-64">
                <?php if ( $title ) : ?>
                    <h3 class="text-xl font-semibold mb-4"><?php echo esc_html( $title ); ?></h3>
                <?php endif; ?>
                
                <?php if ( $text ) : ?>
                    <div class="text-base leading-relaxed text-gray-600">
                        <?php echo wp_kses_post( $text ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Images -->
            <?php 
            if ( have_rows('gallery_images') ) :
                while ( have_rows('gallery_images') ) : the_row(); 
                    $img = get_sub_field('image_source');
                    if ( $img ) :
            ?>
                <div class="h-64 w-full rounded-md overflow-hidden bg-gray-100">
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

    </div>
</section>