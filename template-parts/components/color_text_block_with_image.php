<?php
/**
 * Component: Color Text Block With Image
 * Layout: color_text_block_with_image
 */

// Fields
$title        = get_sub_field('title');
$text         = get_sub_field('text');
$blockquote   = get_sub_field('blockquote'); // array: quote_text, quote_author
$image_source = get_sub_field('image_source'); // URL string in old code
$image_side   = get_sub_field('image_side'); // 'left' or 'right'
$add_button   = get_sub_field('add_button');
$button_text  = get_sub_field('button_text');
$button_link  = get_sub_field('button_link');
$after_button = get_sub_field('after_button');

// Styling
$section_id    = goodshep_get_section_id();
// Note: We apply the block colors to the text container, not the whole section
$block_classes = goodshep_get_block_classes( 'flex flex-col justify-center h-full' ); 

// Determine Order
$text_order  = ( $image_side === 'left' ) ? 'md:order-2' : 'md:order-1';
$image_order = ( $image_side === 'left' ) ? 'md:order-1' : 'md:order-2';
?>

<section <?php echo $section_id; ?> class="relative w-full overflow-hidden">
    <div class="grid md:grid-cols-2 min-h-[600px]">
        
        <!-- Image Column -->
        <div class="relative h-64 md:h-auto w-full <?php echo esc_attr( $image_order ); ?>">
            <?php if ( $image_source ) : ?>
                <div class="absolute inset-0 w-full h-full bg-cover bg-center" 
                     style="background-image: url('<?php echo esc_url( $image_source ); ?>');">
                </div>
            <?php endif; ?>
        </div>

        <!-- Text Column -->
        <div class="<?php echo esc_attr( $text_order ); ?>">
            <!-- Inner container for color background -->
            <div class="<?php echo esc_attr( $block_classes ); ?> px-6 py-12 md:p-12 lg:p-20">
                
                <?php if ( $title ) : ?>
                    <h2 class="font-bold text-3xl lg:text-4xl leading-tight mb-8 text-inherit">
                        <?php echo esc_html( $title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( ! empty( $blockquote['quote_text'] ) ) : ?>
                    <figure class="mb-8 lg:mb-12 border-l-4 border-current pl-6 opacity-90">
                        <blockquote class="text-2xl md:text-3xl font-normal leading-snug">
                            &ldquo;<?php echo esc_html( $blockquote['quote_text'] ); ?>&rdquo;
                        </blockquote>
                        <?php if ( ! empty( $blockquote['quote_author'] ) ) : ?>
                            <figcaption class="text-lg mt-4 font-medium">
                                &mdash; <?php echo esc_html( $blockquote['quote_author'] ); ?>
                            </figcaption>
                        <?php endif; ?>
                    </figure>
                <?php endif; ?>

                <?php if ( $text ) : ?>
                    <div class="prose prose-lg max-w-none mb-8 text-inherit opacity-90">
                        <?php echo wp_kses_post( $text ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $add_button && $button_text && $button_link ) : ?>
                    <div class="mt-4">
                        <a href="<?php echo esc_url( $button_link ); ?>" 
                           class="inline-block bg-white text-gray-900 font-bold py-3 px-8 rounded shadow hover:bg-gray-100 transition-colors">
                            <?php echo esc_html( $button_text ); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ( $after_button ) : ?>
                    <div class="mt-8 text-inherit opacity-80">
                        <?php echo wp_kses_post( $after_button ); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>