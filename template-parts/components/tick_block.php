<?php

/**
 * Component: Tick Block
 * Layout: tick_block
 */

$main_title   = get_sub_field('title');
$main_text    = get_sub_field('text');
$image        = get_sub_field('image_source');
$image_alt    = get_sub_field('image_alt');
$second_title = get_sub_field('second_title');
$add_button   = get_sub_field('add_button');
$button_text  = get_sub_field('button_text');
$button_link  = get_sub_field('button_link');
$button_style = get_sub_field('button_style');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <!-- Main Header -->
        <?php if ( $main_title ) : ?>
            <h2 class="text-3xl font-semibold text-red mb-8"><?php echo esc_html( $main_title ); ?></h2>
        <?php endif; ?>

        <?php if ( $main_text ) : ?>
            <div class="mb-12 prose max-w-none text-lg text-gray-700">
                <?php echo wp_kses_post( $main_text ); ?>
            </div>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 gap-10 lg:gap-20">
            
            <!-- Image Column -->
            <div class="mb-8 md:mb-0">
                <?php if ( $image ) : ?>
                    <img src="<?php echo esc_url( $image ); ?>" 
                         alt="<?php echo esc_attr( $image_alt ); ?>" 
                         class="rounded-lg w-full h-auto object-cover shadow-md">
                <?php endif; ?>
            </div>

            <!-- Content Column -->
            <div>
                <?php if ( $second_title ) : ?>
                    <h3 class="font-semibold text-2xl mb-12"><?php echo esc_html( $second_title ); ?></h3>
                <?php endif; ?>

                <?php if ( have_rows('tick_items') ) : ?>
                    <div class="mb-12 space-y-6">
                        <?php while ( have_rows('tick_items') ) : the_row(); 
                            $tick_text = get_sub_field('text');
                        ?>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4 mt-1 text-green-500">
                                    <!-- Tick Icon (Inline or use helper) -->
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="text-lg leading-loose text-gray-700">
                                    <?php echo wp_kses_post( $tick_text ); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php 
                if ( $add_button && $button_link ) : 
                    $url = is_array( $button_link ) ? $button_link['url'] : $button_link;
                    $target = is_array( $button_link ) ? ( $button_link['target'] ?: '_self' ) : '_self';
                ?>
                    <div>
                        <a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" 
                           class="inline-block bg-red text-white font-bold py-3 px-8 rounded hover:opacity-90 transition-colors no-underline">
                            <?php echo esc_html( $button_text ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>