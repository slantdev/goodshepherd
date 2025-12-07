<?php

/**
 * Component: Image and Icon Cards
 * Layout: image_and_icon_cards
 */

$title = get_sub_field('title');
$text  = get_sub_field('text');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <?php if ($title) : ?>
            <h2 class="lg:text-4xl font-semibold mb-8"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($text) : ?>
            <div class="mb-16 prose max-w-none text-lg text-gray-700">
                <?php echo wp_kses_post($text); ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('image_and_icon_cards')) : ?>
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                while (have_rows('image_and_icon_cards')) : the_row();
                    $image         = get_sub_field('image_source');
                    $icon          = get_sub_field('icon');
                    $card_title    = get_sub_field('title');
                    $card_text     = get_sub_field('text');
                    $date          = get_sub_field('date');
                    $button_text   = get_sub_field('button_text');
                    $button_link   = get_sub_field('button_link'); // often used as the card link

                    // Determine Card Link
                    $card_url = '';
                    if (is_array($button_link)) {
                        $card_url = $button_link['url'];
                    } elseif (is_string($button_link)) {
                        $card_url = $button_link;
                    }
                ?>
                    <div class="rounded-2xl shadow-lg hover:shadow-xl transition-shadow h-full overflow-hidden flex flex-col bg-white group">

                        <!-- Image Header -->
                        <div class="relative h-64 flex-none">
                            <?php if ($image) : ?>
                                <img class="object-cover h-full w-full transition-transform duration-500 group-hover:scale-105"
                                    src="<?php echo esc_url(is_array($image) ? $image['url'] : $image); ?>"
                                    alt="">
                            <?php endif; ?>

                            <!-- Icon Overlay -->
                            <?php if ( $icon ) : ?>
                                <div class="absolute bottom-0 right-0 -mb-10 mr-8 flex items-center justify-center h-20 w-20 bg-purple rounded-full p-3 z-10">
                                    <?php echo goodshep_icon( array( 'icon' => $icon, 'class' => 'h-10 w-10 text-white fill-current' ) ); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Body -->
                        <div class="pt-14 px-8 pb-8 flex flex-col grow">
                            
                            <?php if ( $date ) : ?>
                                <div class="text-base text-gray-500 mb-2">
                                    <?php echo esc_html( date_i18n( 'd F Y', strtotime( $date ) ) ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $card_title ) : ?>
                                <h3 class="text-2xl lg:text-3xl font-semibold mb-6">
                                    <?php if ( $card_url ) : ?>
                                        <a href="<?php echo esc_url( $card_url ); ?>" class="text-gray-900 hover:text-purple transition-colors no-underline">
                                            <?php echo esc_html( $card_title ); ?>
                                        </a>
                                    <?php else : ?>
                                        <?php echo esc_html( $card_title ); ?>
                                    <?php endif; ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ( $card_text ) : ?>
                                <div class="mb-8 leading-loose text-gray-700">
                                    <?php echo wp_kses_post( $card_text ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $button_text && $card_url ) : ?>
                                <div class="mt-auto">
                                    <a href="<?php echo esc_url( $card_url ); ?>" class="text-red font-medium uppercase tracking-wider hover:opacity-80 transition-opacity no-underline">
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