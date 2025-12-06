<?php
/**
 * Component: Full Black Image (We Are Section)
 * Layout: full_black_image
 */

$icon      = get_sub_field('icon');
$text      = get_sub_field('text');
$bg_group  = get_sub_field('background_image');
$bg_mobile = $bg_group['mobile'] ?? '';
$bg_desk   = $bg_group['desktop'] ?? '';
$bg_color  = get_sub_field('background_color') ?: '#000000';

$section_id = goodshep_get_section_id();
?>

<section <?php echo $section_id; ?> class="relative mt-12 bg-black bg-no-repeat bg-bottom bg-contain overflow-hidden" style="background-color: <?php echo esc_attr( $bg_color ); ?>;">
    
    <!-- Mobile BG -->
    <?php if ( $bg_mobile ) : ?>
        <div class="absolute inset-0 w-full h-full bg-contain bg-bottom bg-no-repeat z-0 md:hidden"
             style="background-image: url('<?php echo esc_url( $bg_mobile['url'] ); ?>');">
        </div>
    <?php endif; ?>

    <!-- Desktop BG -->
    <?php if ( $bg_desk ) : ?>
        <div class="absolute inset-0 w-full h-full bg-contain bg-bottom bg-no-repeat z-0 hidden md:block"
             style="background-image: url('<?php echo esc_url( $bg_desk['url'] ); ?>');">
        </div>
    <?php endif; ?>

    <div class="container relative mx-auto px-4 flex flex-wrap items-center z-10">
        <div class="w-full text-white pt-10 pb-64 md:pb-48 lg:w-1/2 lg:py-20">
            
            <?php if ( $icon ) : ?>
                <div class="mb-8">
                    <img src="<?php echo esc_url( $icon['url'] ); ?>" width="90" class="-ml-2 w-20 lg:w-auto" alt="<?php echo esc_attr( $icon['alt'] ); ?>">
                </div>
            <?php endif; ?>

            <?php if ( $text ) : ?>
                <div class="prose prose-invert max-w-none text-white leading-relaxed text-lg">
                    <?php echo wp_kses_post( $text ); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

</section>