<?php
/**
 * Component: Donate Now Form
 * Layout: donate_now_form
 */

$title     = get_sub_field('title');
$shortcode = get_sub_field('form_shortcode');

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6 md:p-12">
            
            <?php if ( $title ) : ?>
                <h2 class="text-purple-600 font-semibold text-2xl md:text-3xl mb-6">
                    <?php echo esc_html( $title ); ?>
                </h2>
            <?php endif; ?>

            <?php 
            if ( $shortcode ) {
                echo '<div class="form-wrapper">' . do_shortcode( $shortcode ) . '</div>';
            } elseif ( is_user_logged_in() ) {
                echo '<p class="p-4 bg-gray-100 border border-dashed text-gray-500 text-center">Select a form in the editor to display it here.</p>';
            }
            ?>

        </div>

    </div>
</section>