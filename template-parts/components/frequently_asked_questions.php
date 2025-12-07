<?php
/**
 * Component: Frequently Asked Questions
 * Layout: frequently_asked_questions
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
            <div class="mb-16">
                <h2 class="text-red-600 text-3xl font-semibold"><?php echo esc_html( $title ); ?></h2>
            </div>
        <?php endif; ?>

        <div class="flex flex-col md:flex-row mx-auto max-w-screen-lg">
            
            <!-- Icon (Left on Desktop) -->
            <div class="mr-10 w-16 shrink-0 hidden md:block">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/faqs.svg" alt="FAQs" class="h-16 w-16" />
            </div>

            <!-- Grid -->
            <?php if ( have_rows('faq_cards') ) : ?>
                <div class="grid md:grid-cols-2 gap-y-12 md:gap-x-24 grow">
                    <?php 
                    while ( have_rows('faq_cards') ) : the_row(); 
                        $question = get_sub_field('question');
                        $answer   = get_sub_field('answer');
                    ?>
                        <div class="mb-8 md:mb-0">
                            <?php if ( $question ) : ?>
                                <h3 class="text-2xl font-semibold mb-4"><?php echo esc_html( $question ); ?></h3>
                            <?php endif; ?>

                            <?php if ( $answer ) : ?>
                                <div class="prose max-w-none text-gray-700">
                                    <?php echo wp_kses_post( $answer ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>