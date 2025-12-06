<?php
/**
 * Component: Buttons
 * Layout: buttons
 */

// Wrapper Attributes
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <?php if ( have_rows('buttons_repeater') ) : ?>
            <div class="flex flex-wrap items-center justify-center gap-4 xl:gap-x-8 xl:gap-y-5">
                
                <?php 
                while ( have_rows('buttons_repeater') ) : the_row(); 
                    $link   = get_sub_field('button_link');
                    $colors = get_sub_field('button_color'); // Array: background_color, border_color, text_color
                    
                    if ( $link ) :
                        // Build inline styles safely
                        $bg_color     = $colors['background_color'] ?? '';
                        $border_color = $colors['border_color'] ?? '';
                        $text_color   = $colors['text_color'] ?? '';
                        
                        $style_attr = '';
                        if ( $bg_color )     $style_attr .= 'background-color: ' . esc_attr( $bg_color ) . ';';
                        if ( $border_color ) $style_attr .= 'border-color: ' . esc_attr( $border_color ) . ';';
                        if ( $text_color )   $style_attr .= 'color: ' . esc_attr( $text_color ) . ';';
                ?>
                    <a href="<?php echo esc_url( $link['url'] ); ?>" 
                       target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>"
                       class="inline-block max-w-sm font-semibold text-xl text-center px-12 py-3 border border-solid rounded-md hover:underline transition-opacity hover:opacity-90 no-underline"
                       style="<?php echo $style_attr; ?>">
                        <?php echo esc_html( $link['title'] ); ?>
                    </a>
                <?php 
                    endif;
                endwhile; 
                ?>

            </div>
        <?php endif; ?>

    </div>
</section>