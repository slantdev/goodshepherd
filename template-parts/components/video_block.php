<?php

/**
 * Component: Video Block
 * Layout: video_block
 */

$title       = get_sub_field('title');
$text        = get_sub_field('text');
$add_button  = get_sub_field('add_button');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');
$videos      = get_sub_field('videos'); // Repeater: video

// Styling
$section_id    = goodshep_get_section_id();
$block_classes = goodshep_get_block_classes();
$bg_style      = goodshep_get_bg_image_style();

// Grid Logic
$count = $videos ? count($videos) : 0;
$grid_class = 'grid-cols-1';
if ($count === 2) {
    $grid_class = 'grid-cols-1 lg:grid-cols-2';
} elseif ($count >= 3) {
    $grid_class = 'grid-cols-1 lg:grid-cols-3';
}
?>

<section <?php echo $section_id; ?> class="<?php echo esc_attr($block_classes); ?>" style="<?php echo esc_attr($bg_style); ?>">
    <div class="container mx-auto px-4">

        <!-- Header Content -->
        <?php if ($title || $text || ($add_button && $button_link)) : ?>
            <div class="mb-12 max-w-4xl">
                <?php if ($title) : ?>
                    <h2 class="text-3xl font-semibold mb-6"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($text) : ?>
                    <div class="prose max-w-none text-lg text-gray-700 mb-6">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php 
                if ( $add_button && $button_link ) : 
                    $url = is_array( $button_link ) ? $button_link['url'] : $button_link;
                    $target = is_array( $button_link ) ? ( $button_link['target'] ?: '_self' ) : '_self';
                ?>
                    <a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" 
                       class="inline-block bg-red text-white font-bold py-3 px-8 rounded hover:opacity-90 transition-colors no-underline">
                        <?php echo esc_html( $button_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Video Grid -->
        <?php if ($videos) : ?>
            <div class="grid <?php echo esc_attr($grid_class); ?> gap-8">
                <?php foreach ($videos as $video_item) : ?>
                    <div class="w-full">
                        <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-lg bg-black">
                            <?php echo $video_item['video']; // oEmbed HTML 
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>