<?php
/**
 * Component: Shortcut Blocks
 * Layout: shortcut_blocks
 */

$title = get_sub_field('title');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <?php if ( $title ) : ?>
            <h2 class="font-semibold mb-10 text-3xl md:text-4xl"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( have_rows('shortcut_blocks') ) : ?>
            <div class="grid md:grid-cols-3 gap-8 lg:gap-10">
                <?php 
                while ( have_rows('shortcut_blocks') ) : the_row(); 
                    $image = get_sub_field('image_source');
                    $card_title = get_sub_field('title');
                    $text  = get_sub_field('text');
                    $link  = get_sub_field('button_link');
                ?>
                    <div class="flex flex-col h-full mb-12 md:mb-0">
                        
                        <?php if ( $image ) : ?>
                            <div class="h-64 w-full mb-8 rounded-md overflow-hidden bg-gray-100">
                                <?php 
                                if ( is_array( $image ) && isset( $image['ID'] ) ) {
                                    echo wp_get_attachment_image( $image['ID'], 'large', false, array( 'class' => 'h-full w-full object-cover' ) );
                                } elseif ( is_numeric( $image ) ) {
                                    echo wp_get_attachment_image( $image, 'large', false, array( 'class' => 'h-full w-full object-cover' ) );
                                } elseif ( is_string( $image ) ) {
                                    echo '<img src="' . esc_url( $image ) . '" class="h-full w-full object-cover" alt="">';
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( $card_title ) : ?>
                            <h4 class="text-xl font-semibold mb-4"><?php echo esc_html( $card_title ); ?></h4>
                        <?php endif; ?>

                        <?php if ( $text ) : ?>
                            <div class="grow text-gray-600 text-base leading-relaxed mb-6">
                                <?php echo wp_kses_post( $text ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( $link ) : ?>
                            <div class="mt-auto">
                                <a href="<?php echo esc_url( $link ); ?>" class="text-red font-medium uppercase tracking-wider hover:opacity-80 transition-opacity no-underline text-base">
                                    Learn More
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>