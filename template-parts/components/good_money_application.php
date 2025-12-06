<?php
/**
 * Component: Good Money Application
 * Layout: good_money_application
 */

// Fields: CTA
$cta        = get_sub_field('cta');
$cta_title  = $cta['title'] ?? '';
$cta_text   = $cta['text'] ?? '';
$cta_btn    = $cta['button'] ?? [];
// $cta_btn_style = $cta['cta_button_style'] ?? 'primary';

// Fields: Text Tick
$tick_group = get_sub_field('text_tick_checkbox');
$headline   = $tick_group['headline'] ?? '';
$desc       = $tick_group['description'] ?? '';
$image      = $tick_group['image'] ?? [];
$sub_title  = $tick_group['sub_title'] ?? '';
$ticks      = $tick_group['tick_items'] ?? []; // Repeater
$text_after = $tick_group['text_after'] ?? '';
$tick_btn   = $tick_group['button'] ?? [];

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <!-- Part 1: Top CTA -->
        <?php if ( $cta_title ) : ?>
            <div class="pb-12 border-b border-gray-200 mb-12">
                <div class="bg-purple-50 px-6 md:px-28 py-20 rounded-lg shadow-md flex flex-col lg:flex-row items-center justify-between gap-8 hover:shadow-lg transition-shadow">
                    <div class="lg:w-3/4 text-center lg:text-left">
                        <h3 class="font-semibold text-purple-600 text-2xl mb-3"><?php echo esc_html( $cta_title ); ?></h3>
                        <div class="text-xl font-medium text-gray-900">
                            <?php echo wp_kses_post( $cta_text ); ?>
                        </div>
                    </div>
                    <?php 
                    if ( ! empty( $cta_btn['url'] ) ) : 
                        $url    = $cta_btn['url'];
                        $target = $cta_btn['target'] ?: '_self';
                        $title  = $cta_btn['title'];
                    ?>
                        <div class="lg:w-1/4 text-center">
                            <a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" 
                               class="inline-block py-3 px-8 bg-red-600 text-white font-bold rounded hover:bg-red-700 transition-colors no-underline">
                                <?php echo esc_html( $title ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Part 2: Tick Block -->
        <?php if ( $headline ) : ?>
            <div class="pt-6">
                <div class="mb-16">
                    <h2 class="text-red-600 font-semibold text-3xl lg:text-4xl mb-8"><?php echo esc_html( $headline ); ?></h2>
                    <div class="prose max-w-none text-lg leading-relaxed text-gray-700">
                        <?php echo wp_kses_post( $desc ); ?>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-10 lg:gap-20">
                    <!-- Image -->
                    <div class="mb-8 md:mb-0">
                        <?php if ( ! empty( $image['url'] ) ) : ?>
                            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="rounded-lg w-full object-cover h-auto shadow-md">
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div>
                        <?php if ( $sub_title ) : ?>
                            <h3 class="font-semibold text-2xl mb-8"><?php echo esc_html( $sub_title ); ?></h3>
                        <?php endif; ?>

                        <?php if ( $ticks ) : ?>
                            <div class="mb-12 space-y-6">
                                <?php foreach ( $ticks as $item ) : ?>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-4 mt-1 text-purple-600">
                                            <!-- Tick Icon -->
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <div class="text-lg leading-loose text-gray-700">
                                            <?php echo wp_kses_post( $item['text'] ); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( $text_after ) : ?>
                            <div class="mb-12 prose max-w-none text-lg leading-relaxed text-gray-700">
                                <?php echo wp_kses_post( $text_after ); ?>
                            </div>
                        <?php endif; ?>

                        <?php 
                        if ( ! empty( $tick_btn['button_link']['url'] ) ) : 
                            $lnk = $tick_btn['button_link'];
                        ?>
                             <a href="<?php echo esc_url( $lnk['url'] ); ?>" target="<?php echo esc_attr( $lnk['target'] ?: '_self' ); ?>" 
                                class="inline-block py-3 px-8 bg-red-600 text-white font-bold rounded hover:bg-red-700 transition-colors no-underline">
                                <?php echo esc_html( $lnk['title'] ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>