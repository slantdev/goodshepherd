<?php
/**
 * Component: Small Photo Cards
 * Layout: small_photo_cards
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
            <h2 class="lg:text-4xl font-semibold text-red-600 mb-4 lg:mb-8"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( $text ) : ?>
            <div class="mb-16 max-w-4xl prose max-w-none text-lg text-gray-700">
                <?php echo wp_kses_post( $text ); ?>
            </div>
        <?php endif; ?>

        <?php if ( have_rows('small_photo_cards') ) : ?>
            <div class="grid md:grid-cols-3 gap-8">
                <?php 
                while ( have_rows('small_photo_cards') ) : the_row(); 
                    $image       = get_sub_field('image_source');
                    $card_title  = get_sub_field('title');
                    $card_text   = get_sub_field('text');
                    $button_text = get_sub_field('button_text');
                    $button_link = get_sub_field('button_link');
                ?>
                    <div class="rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 bg-white overflow-hidden flex flex-col h-full">
                        
                        <?php if ( $image ) : ?>
                            <div class="h-64 w-full mb-4 bg-gray-100">
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

                        <div class="px-6 pb-6 flex flex-col flex-grow">
                            <?php if ( $card_title ) : ?>
                                <h3 class="text-xl font-medium mb-4"><?php echo esc_html( $card_title ); ?></h3>
                            <?php endif; ?>

                            <?php if ( $card_text ) : ?>
                                <div class="text-gray-700 mb-6 flex-grow">
                                    <?php echo wp_kses_post( $card_text ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $button_text && $button_link ) : ?>
                                <div class="mt-auto">
                                    <a href="<?php echo esc_url( $button_link ); ?>" class="text-red font-medium uppercase tracking-wider hover:opacity-80 transition-colors no-underline text-sm">
                                        <?php echo esc_html( $button_text ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>