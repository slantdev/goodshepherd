<?php
/**
 * Component: Two Line CTA
 * Layout: two_line_cta
 */

$title       = get_sub_field('title');
$text        = get_sub_field('text');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');
$button_style= get_sub_field('button_style');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <div class="bg-light-purple shadow-md hover:shadow-lg transition-shadow rounded-lg px-6 md:px-28 py-20 flex flex-col lg:flex-row items-center justify-between gap-8">
            
            <div class="lg:w-3/4 text-center lg:text-left">
                <?php if ( $title ) : ?>
                    <h3 class="font-semibold text-purple text-2xl mb-3"><?php echo esc_html( $title ); ?></h3>
                <?php endif; ?>

                <?php if ( $text ) : ?>
                    <div class="text-xl font-medium text-gray-900 leading-relaxed">
                        <?php echo wp_kses_post( $text ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php 
            if ( $button_text && $button_link ) : 
                $url = is_array( $button_link ) ? $button_link['url'] : $button_link;
                $target = is_array( $button_link ) ? ( $button_link['target'] ?: '_self' ) : '_self';
            ?>
                <div class="lg:w-1/4 text-center">
                    <a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" 
                       class="inline-block py-3 px-8 bg-red text-white font-bold rounded hover:opacity-90 transition-colors no-underline">
                        <?php echo esc_html( $button_text ); ?>
                    </a>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>