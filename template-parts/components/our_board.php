<?php

/**
 * Component: Our Board
 * Layout: our_board
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
            <h2 class="text-red mb-10 text-3xl font-semibold"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($text) : ?>
            <div class="mb-16 prose max-w-none text-lg text-default">
                <?php echo wp_kses_post($text); ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('members')) : ?>
            <div class="grid md:grid-cols-3 gap-10">
                <?php
                while (have_rows('members')) : the_row();
                    $image    = get_sub_field('image_source');
                    $name     = get_sub_field('name');
                    $position = get_sub_field('position');
                    $desc     = get_sub_field('text');
                    $link     = get_sub_field('button_link');
                ?>
                    <div class="flex flex-col h-full mb-12 md:mb-0">

                        <?php if ($image) : ?>
                            <div class="h-64 w-full mb-6 rounded-md overflow-hidden">
                                <img class="object-cover h-full w-full"
                                    src="<?php echo esc_url(is_array($image) ? $image['url'] : $image); ?>"
                                    alt="<?php echo esc_attr($name); ?>">
                            </div>
                        <?php endif; ?>

                        <div class="pb-4 mb-6 border-b border-gray-200">
                            <?php if ($name) : ?>
                                <h3 class="text-xl font-semibold mb-1"><?php echo esc_html($name); ?></h3>
                            <?php endif; ?>

                            <?php if ($position) : ?>
                                <p class="text-gray-500"><?php echo esc_html($position); ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="grow mb-6 text-default text-base leading-relaxed">
                            <?php echo wp_kses_post($desc); ?>
                        </div>

                        <?php if ($link) : ?>
                            <div class="mt-auto">
                                <a href="<?php echo esc_url($link); ?>" class="text-red font-medium uppercase tracking-wider hover:opacity-80 transition-opacity no-underline">
                                    Read More
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>