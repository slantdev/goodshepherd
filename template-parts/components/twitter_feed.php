<?php
/**
 * Component: Twitter Feed
 * Layout: twitter_feed
 */

$title     = get_sub_field('title');
$shortcode = get_sub_field('form_shortcode'); // Reference calls it 'form_shortcode' in get_twitter_feed_content

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr( $block_classes ); ?>" style="<?php echo esc_attr( $bg_style ); ?>">
    <div class="container mx-auto px-4">
        
        <?php if ( $title ) : ?>
            <h2 class="text-red font-semibold mb-4 text-3xl"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( $shortcode ) : ?>
            <div class="twitter-feed-container">
                <?php echo do_shortcode( $shortcode ); ?>
            </div>
        <?php endif; ?>

    </div>
</section>